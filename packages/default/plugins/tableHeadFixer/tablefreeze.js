/**
 * Freezes table rows and cols; Having freeze means scrolling is available;
 *
 * Shows scroll bar!
 *
 * @param {type} $
 * @returns {undefined}
 */

;
(function($){

    var data_key = "tableFreeze";

    var defaults = {
        'cols': 1,
        'threshold-x': 35,
        'threshold-y': 35,
        'scrollbar': 1
    };

    var keys = [37, 38, 39, 40];

    $.tableFreeze = function(tbl, options){
        this.$this = $(tbl); //IMPORTANT! 
        this.options = $.extend({}, defaults, options);

        this.x = 0;
        this.y = 0;

        this.hdr = []; //cache to store complex header architecture! 

        this.h = this.$this.height();
        this.w = this.$this.width();

        var $p = this.$this.parent(), wi = $p.width(), hi = $p.outerHeight();

        var __this = this;
        if( this.options.scrollbar ){
            this.sb = this.$this.scrollbar();
//            $.loadJs('scrollbar/scrollbar.js', (function(){
//                this.sb = this.$this.scrollbar(); //shows scrollbar
//            }).bind(this)  );
        }

        //Unit widths and lengths for scrollbar. 
        //w = width of td; 
        //uw = 1 - (w-wi)/(w-this.w); 
        var wtd = this.$this.find('tbody tr').filter(function(){ return $(this).find('td[colspan]').length == 0; }).eq(0).find('td:visible').eq(this.options.cols).outerWidth();
        var htd = this.$this.find('tbody tr').eq(0).height();

        var wsc = wi*wi/this.w, hsc = hi*hi/this.h; //scrollbar dim
        this.uw = (this.w-wi)/wtd/(wi-wsc);
        this.uh = (this.h-hi)/htd/(hi-hsc); //1 - (htd-hi)/(htd-this.h);

        this.currX=0;
        this.currY=0;

        this.$this.on('scrollbar::dragX', (function(e, amt){ //amount has css:left; 
            var num = Math.ceil(amt*this.uw), d=num-this.currX, dir = d > 0? 0 : 1; //number to hide - number already hidden; 
            this.currX = num;
            d = Math.abs(d);
            for(var i=0; i<d; i++) setFreezeX.call(this, dir);
        }).bind(this)  ).on('scrollbar::dragY', (function(e, amt){
            var num = Math.ceil(amt*this.uh), d=num-this.currY, dir = d > 0? 0 : 1; //number to hide - number already hidden; 
            this.currY = num;
            d = Math.abs(d);
            for(var i=0; i<d; i++) setFreezeY.call(this, dir);
        }).bind(this) );

        //Set scrolling event handlers
        var __this = this;

        //For those doing touch
        var ongoingTouches = {};
        this.$this.on('touchstart', function(e){
            e.preventDefault();
            var tch = e.originalEvent.changedTouches;
            for(var i=0; i<tch.length; i++) ongoingTouches[ tch[i].identifier ] = [tch[i].pageX, tch[i].pageY];

        })
            .on('touchend touchleave touchcancel', function(e){
                e.preventDefault();
                var tch = e.originalEvent.changedTouches;
                for(var i=0; i<tch.length; i++ ) ongoingTouches[tch[i].identifier] = null;
            })
            .on('touchmove', function(e){
                e.preventDefault();
                var tch = e.originalEvent.changedTouches, id, c;

                __this.x = 0; __this.y = 0;

                for(var i=0; i<tch.length; i++){
                    id = tch[i].identifier;
                    if( !ongoingTouches[id] ) continue;

                    c = ongoingTouches[id];

                    __this.x -= tch[i].pageX - c[0];
                    __this.y += tch[i].pageY - c[1];
                }

                if( updateX.call(__this) ){
                    for(var i=0; i<tch.length; i++){
                        id = tch[i].identifier;
                        ongoingTouches[id][0] = tch[i].pageX;
                    }
                }

                if( updateY.call(__this) ){
                    for(var i=0; i<tch.length; i++){
                        id = tch[i].identifier;
                        ongoingTouches[id][0] = tch[i].pageY;
                    }
                }


            });

        //For those using the mouse
        this.$this.on('mousewheel', function(e){
            var x, y;
            if( e.originalEvent.wheelDeltaX || e.originalEvent.wheelDeltaY){
                x = e.originalEvent.wheelDeltaX/-40;
                y = e.originalEvent.wheelDeltaY;
            }else{
                x = e.originalEvent.deltaX;
                y = e.originalEvent.deltaY;
            }

            __this.x += x; __this.y+=y;

            updateX.call(__this);
            updateY.call(__this);

            e.preventDefault();
            e.stopPropagation();
        });

        function updateX(){
            if( Math.abs(this.x) > this.options['threshold-x'] ){
                (this.x > 0)? setFreeze.call(this, 0, 0) : setFreeze.call(this, 0, 1);
                return true;
            }
        }

        function updateY(){
            if( Math.abs(this.y) > this.options['threshold-y'] ){
                (this.y > 0)? setFreeze.call(this, 1, 1) : setFreeze.call(this, 1, 0);
                return true;
            }
        }

    };

    $.tableFreeze.prototype.$get = function(){ return this.$this; };

    $.tableFreeze.prototype.set = function(cols, rows){
        this.options.cols = cols;
        this.options.rows = rows;
    };

    /**
     * Update scroll bars
     */
    $.tableFreeze.prototype.updateScrollbars = function(){
        var $p = this.$this.parent(), w=$p.width(), h=$p.height(),
            wi = this.$this.width(), hi = this.$this.height();

        if( hi < h ) hi = h;
        if( wi < w ) wi = w;

        this.sb.update( 1-(w-wi)/(w-this.w) ,  1-(h-hi)/(h-this.h) );
    };

    $.tableFreeze.prototype.resetScrollbars = function(){
        this.h = this.$this.height();
        this.w = this.$this.width();

        //Recalculate!
        var $p = this.$this.parent(), wi = $p.width(), hi = $p.outerHeight();
        var wtd = this.$this.find('tbody tr').filter(function(){ return $(this).find('td[colspan]').length == 0; }).eq(0).find('td').eq(this.options.cols).outerWidth();
        var htd = this.$this.find('tbody tr').eq(0).height();

        var wsc = wi*wi/this.w, hsc = hi*hi/this.h; //scrollbar dim
        this.uw = (this.w-wi)/wtd/(wi-wsc);
        this.uh = (this.h-hi)/htd/(hi-hsc); //1 - (htd-hi)/(htd-this.h);

        this.sb.reset();
        this.updateScrollbars();
    };

    /**
     * Freezes the rows and columns by showing/hiding when scrolling;
     * need to determine when to stop hiding and when to show;
     * @param dir - direction of freeze; 0 - x ; 1 - y;
     * @param amt - 0 - left/up; 1 - right/down;
     */
    function setFreeze(dir, amt){
        (dir)? setFreezeY.call(this, amt) : setFreezeX.call(this, amt);
        this.updateScrollbars();
    }

    function setFreezeX(amt){
        var hidden = [], numCols = this.options.cols;

        //Go right
        if( amt ){
            //Need to deal with grouped th; 
            this.$this.find('thead tr').each(function(){
                var $col = $(this).find('th').not('.hidden').eq(numCols);
                var colspan = parseInt($col.attr('colspan')), maxColSpan = $col.attr('max-colspan');

                if( maxColSpan && parseInt( maxColSpan ) != colspan ){
                    hidden.push( $col );
                    $col.attr('colspan', colspan+1);
                }else{
                    hidden.push( $(this).find('th.hidden').last().removeClass('hidden') );
                }
            });
            this.$this.find('tbody tr').each(function(){
                hidden.push( $(this).find('td.hidden').last().removeClass('hidden') );
            });
            this.$this.trigger('tableFreeze::unfrozen', [0, hidden]);

            //Go left if not isStop
        }else if( !isStopX.call(this) ){
            var col = this.options.cols;

            this.$this.find('thead tr').each(function(){
                var curr = $(this).find('th:not(.hidden)').eq(col);
                var colspan = curr.attr('colspan');
                if( colspan && parseInt(colspan) > 1){
                    curr.attr('colspan', parseInt(colspan)-1 );
                    if( !curr.attr('max-colspan') ) curr.attr('max-colspan', parseInt(colspan));
                }else{
                    curr.addClass('hidden');
                    hidden.push( curr );
                }
            });

            this.$this.find('tbody tr').each(function(){
                hidden.push( $(this).find('td:not(.hidden)').eq(col).addClass('hidden'));
            });
            this.$this.trigger('tableFreeze::frozen', [0, hidden]);
        }

        this.x = 0;
    }

    function setFreezeY(amt){
        var t = [];

        //Go down
        if( amt ){
            t.push( this.$this.find('tbody tr.hidden').last().removeClass('hidden') );
            this.$this.trigger('tableFreeze::unfrozen', [1, t]);
            //Go up if not isStop
        }else if( !isStopY.call(this) ){
            t.push( this.$this.find('tbody tr:not(.hidden)').first().addClass('hidden') );
            this.$this.trigger('tableFreeze::frozen', [1, t]);
        }

        this.y = 0;
    }

    /**
     * Determines when to stop freezing (when width of table == width of container)
     */
    function isStopX(){
        return this.$this.width()+15 <= this.$this.parent().width(); //Doesn't work in Safari!
    }

    /**
     * Determines when to stop freezing ( when height of table == height of container)
     */
    function isStopY(){
        return this.$this.height()+15 <= this.$this.parent().height();
    }

    /**
     * Freezes columns and rows on a table.
     * @param {type} options
     * @returns {Array}
     */
    $.fn.tableFreeze = function(options){
        if( $(this).length != 1 ){
            var arr = [];
            $(this).each(function(){
                arr.push( $(this).tableFreeze(this, options) );
            });
            return arr;
        }

        var l = $(this).data(data_key);
        if( l instanceof $.tableFreeze ) return l;

        l = new $.tableFreeze(this, options);
        $(this).data(data_key, l);
        return l;
    };

})(jQuery);