<div class="modal draggable fade" id="mPopFolderTree" data-backdrop="static" role="dialog">
    <div class="modal-dialog" style="width: 80%">
        <div class="modal-content">
            <div class="modal-header">
                {{Helpers::generateHeading(Helpers::getRS(0,"Chon_tap_tin"),"",false,"closeFolderTreePop")}}
            </div>
            <div class="modal-body">
                <div class="row mgt5 mgb5">
                    <div class="col-md-12 mgb5" id="listFolder" style="overflow: auto;width: 99%">
                        <ul class="filetree start"><li class="wait"><li></ul>
                    </div>
                </div>
                <input type="hidden" id="hdPathFolderTree">
            </div>
            <div class="modal-footer">
                <div class="box-footer">
                    <button type="button" class="btn btn-primary smallbtn btnChooseFolder">{{Helpers::getRS(0,"Chon")}}</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript">
    var closeFolderTreePop = function () {
        $("#listFolder").getNiceScroll().resize().hide();
        $("#mPopFolderTree").modal('hide');
    };
    $("#listFolder").css("max-height", documentHeight- 240);
    $("#listFolder").niceScroll({
        cursoropacitymin: 0.3,
        autohidemode: false
    });
    getfilelist($('#listFolder'), '');

    function getfilelist(cont, root) {
        $(cont).addClass('wait');
        $.ajax({
            method: "POST",
            url: '{{url("/getDirectory/")}}',
            data: {dir: root, mode:'{{$mode}}'},
            success: function (data) {
                $(cont).find( '.start' ).html( '' );
                $(cont).removeClass( 'wait' ).append( data );
                $(cont).find('UL:hidden').show();
                if(root == "")
                    $(cont).find('UL:hidden').show();
                else
                    $(cont).find('UL:hidden').slideDown({ duration: 500, easing: null });
                $("#listFolder").getNiceScroll().resize();
            }
        });
    }

    $('#listFolder').on('dblclick', 'li a', function() {
        var entry = $(this).parent();
        if( entry.hasClass('folder') ) {
            if( entry.hasClass('collapsed') ) {
                entry.find('ul').remove();
                getfilelist( entry, escape( $(this).attr('rel') ));
                entry.removeClass('collapsed').addClass('expanded');
            }
            else {
                entry.find('UL').slideUp({ duration: 500, easing: null });
                entry.removeClass('expanded').addClass('collapsed');
            }
        } else {
            $('#selected_file').text( "File:  " + $(this).attr( 'rel' ));
        }
        return false;
    });

    $('#listFolder').on('click', 'li a', function() {
        $("#listFolder").find("li a").removeClass("selected");
        var entry = $(this).parent();
        if( entry.hasClass('folder') ) {
            $(this).addClass('selected');
        }
    });

    $('.btnChooseFolder').on('click', function() {
        var sl = $("#listFolder").find("a.selected");
        $("#hdPathFolderTree").val($(sl).attr('rel'));
        closeFolderTreePop();
    });
</script>