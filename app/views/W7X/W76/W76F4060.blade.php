<div class="modal fade pd0" id="modalW76F4060" data-backdrop="static" role="dialog">
    <div id="test" class="modal-dialog modal-lg formduyet">
        <div class="modal-content">
            <div class="modal-header logodg pdl0">
                {{Helpers::generateHeading($caption,"W76F4060")}}
            </div>
            <div class="modal-body">
                @if ($per == -1)
                <form class="form-horizontal" id="frmW76F4060" name="frmW76F4060" method="post">
                    <div class="row pdt5" style="margin-left: 2px !important;">
                        <div class="col-md-5 pdt10">
                            <div class="form-group">
                                <div class="col-md-3">
                                    <label class="lbl-normal liketext">{{Helpers::getRS($g,"Nhom_tai_lieu")}}</label>
                                </div>
                                <div class="col-md-9">
                                    <select id="slDocCategoryID" name="slDocCategoryID" class="form-control">
                                        <option value="%">{{Helpers::getRS($g,"Tat_ca_Web")}}</option>
                                        @foreach($rsCategory as $row)
                                            <option value="{{$row["DocCatID"]}}">{{$row["DocCategoryName"]}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7 pdt10">
                            <div class="form-group">
                                <div class="col-md-9">
                                    <input type="text" id="txtStrFind" name="txtStrFind" class="form-control">
                                </div>
                                <div class="col-md-3">
                                    <button class="btn btn-default smallbtn"><span
                                                class="fa fa-search"></span>
                                        &nbsp;{{Helpers::getRS($g,"Tim_kiem")}}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                @else
                <div class="row pdt5 mgb5">
                    <div class="col-md-3">
                        <div class="btn-group">
                            <a onclick="callW76F4061('');"
                               class="btn btn-default smallbtn">
                                <span class="glyphicon glyphicon-plus"></span> {{Helpers::getRS($g,"Them_moi1")}}
                            </a>
                        </div>
                    </div>
                </div>
                @endif
                <div class="row">
                    <div class="col-md-12" id="divGridW76F4060" style="padding-left: 16px !important;"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.modal-content -->
</div>
<section id="secDetailW76F4060">
</section>
<iframe id="iframeDown"></iframe>
<script type="text/javascript">
    @if ($per == -1)
        $("#frmW76F4060").on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            method: "POST",
            url: "{{Request::url()}}",
            data: $("#frmW76F4060").serialize(),
            success: function (data) {
                $("#divGridW76F4060").html(data);
            }
        });
    });
    @else
    function loadGrid(){
        $.ajax({
            method: "POST",
            url: "{{Request::url()}}",
            success: function (data) {
                $("#divGridW76F4060").html(data);
            }
        });
    }
    loadGrid();
    @endif


    function callW76F4061(id) {
        $.ajax({
            method: "GET",
            url: "{{url("W76F4061")}}/" + id,
            success: function (data) {
                $("#secDetailW76F4060").html(data);
                $("#modalW76F4061").modal("show");
            }
        });
    }

    function GetFileW76F4060(docID, name)
    {
        $.ajax({
            method: "POST",
            url: '{{url("/W76F4060/getfile")}}',
            data: { id: docID},
            success: function (response) {
                if (response!='')
                {
                    var link = document.createElement('a');
                    link.href = response;
                    link.target = "_blank";
                    $("#iframeDown").html(link);
                    link.click();
                }
            }
        });
    }

    function deleteW76F4060(id){
        ask_delete(function(){
            $.ajax({
                method: "DELETE",
                url: "{{url("W76F4061")}}/" + id,
                success: function (data) {
                    var result = $.parseJSON(data);
                    if (result.code==1)
                        update4ParamGrid($("#pqgrid_W76F4060"), "", "delete");
                    else{
                        alert_error(result.mess);
                    }
                }
            });
        });
    }
</script>


