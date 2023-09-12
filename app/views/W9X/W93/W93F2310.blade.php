<section class="content">
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <form id="frmW93F3210" >


            <div class="btn-group">

                <input type="file" id="FileW93F3210" name="FileW93F3210"> <br>
                <button type="submit" class="btn  btn-default">
                    <span class="glyphicon glyphicon-plus"></span> Import
                </button>

            </div>
            </form>
        </div>
    </div>

</section>
<section class="content" id="tbW93F3210">
    <div class="row">
        <div class="col-md-12 col-xs-12" id="contentW93F3210">
            <div id="pqgrid_W93F3210" style="margin:auto;"></div>
        </div>
    </div>

</section>
<script type="text/javascript">
    var iW93F3210Height;
    var iW93F3210Width;

    $(document).ready(function () {
        iW93F3210Width =  $("#contentW93F3210").width()- 10;
        iW93F3210Height = $(".contenttab").height() - 100;
        var obj = {
            width: iW93F3210Width,
            height: iW93F3210Height,
            showTitle: false,
            collapsible: false,
            editable: false,
            selectionModel: { type: 'row', mode: 'single'},
            pageModel : { rPP: 100, type: "local" }
        };
        obj.colModel = [
            {
                title: "Mã chỉ tiêu",
                width: 100,
                dataType: "string"

            },
            {
                title: "Diễn giải",
                minWidth: 200,
                dataType: "string"

            },
            {
                title: "Kỳ này",
               width:100,
                cls: "text-right",
                dataType: "float",
                render: function (ui) {

                    return format2(ui.cellData,"",0);
                }


            },
            {
                title: "Kỳ trước",
                width: 120,
                cls: "text-right",
                dataType: "float",
                render: function (ui) {

                    return format2(ui.cellData,"",0);
                }


            },
            {
                title: "Ghi chú",
                dataType: "string",
                minWidth: 120


            }
        ];
        obj.dataModel = {
            data: {}
        };

         $("#pqgrid_W93F3210").pqGrid(obj);

    });
    $("#frmW93F3210").submit(function(evt){
        evt.preventDefault();

        var formData = new FormData($(this)[0]);

        $.ajax({
            url: '{{Request::url()}}',
            type: 'POST',
            data: formData,
            async: false,
            cache: false,
            contentType: false,
            enctype: 'multipart/form-data',
            processData: false,
            success: function (response) {
                $("#pqgrid_W93F3210").pqGrid( "option", "dataModel", { data: response } );
                $("#pqgrid_W93F3210").pqGrid( "refreshDataAndView" );
            }
        });

        return false;
    });
</script>