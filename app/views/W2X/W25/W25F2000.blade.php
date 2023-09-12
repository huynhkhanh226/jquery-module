<section class="content" id="secW25F2000">
    <form id="frmW25F2000" name="frmW25F2000" method="post">
        <div class="row">
            <div class="col-md-5">
                <div class="row">
                    <div class="col-md-3 liketext">
                        <label class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Thoi_gian")}}</label>
                    </div>
                    <div class="col-md-9">
                        {{ Form::select("slTimeID", $time ,"2",["class" => "form-control liketext", "id" => "slTimeID"])}}
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="row">
                    <div class="col-md-3 liketext">
                        <label class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Trang_thai")}}</label>
                    </div>
                    <div class="col-md-9">
                        {{Form::select("slAppStatusID", $rsStatus ,"All",["class" => "form-control liketext", "id" => "slAppStatusID"])}}
                    </div>
                </div>
            </div>
            <div class="checkbox col-md-2 mgt10">
                <label>
                    <input type="checkbox" id="chkIsInStock"
                           name="chkIsInStock"> {{Helpers::getRS($g,"De_xuat_con_ton")}}
                </label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="row">
                    <div class="col-md-3">
                        <label class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Tim_kiem")}}</label>
                    </div>
                    <div class="col-md-9">
                        {{ Form::select("slSearchFieldID", $rsFilter ,0,["class" => "form-control", "id" => "slSearchFieldID"])}}
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <input type="text" class="form-control" id="txtSearchValue" name="txtSearchValue">
            </div>
            <div class="col-md-2">
                <button class="btn btn-default smallbtn" style="padding-top: 4px"><span class="digi digi-filter"></span>
                    &nbsp;{{Helpers::getRS($g,"Loc")}}</button>
            </div>
        </div>
        <div class="row mgt5">
            <div class="col-md-12 col-xs-12">
                @if(Session::get($pForm) >=2)
                    <a onclick="showFormDialogPost('{{url("/W25F2010/".$pForm."/add/0/0/")}}','modalW25F2010')"
                       class="btn btn-default smallbtn mgr5" title="{{Helpers::getRS($g,"Them_moi1")}}">
                        <span class="glyphicon glyphicon-plus"></span> {{Helpers::getRS($g,"Them_moi1")}}
                    </a>
                @endif
           {{--     <a class="btn btn-default smallbtn" title="In">
                    <span class="glyphicon glyphicon-print"></span> {{Helpers::getRS($g,'InU')}}
                </a>--}}
                <a  onclick="W25F2000ExportExcel()" class="btn btn-default smallbtn" title="{{Helpers::getRS($g,'Xuat_Excel_U')}}">
                    <span class="fa fa-file-excel-o"></span> {{Helpers::getRS($g,'Xuat_Excel_U')}}
                </a>
                <div class="btn-group">

                </div>
            </div>
        </div>
    </form>
</section>
<section class="content" id="tbW25F2000">
</section>
<script type="text/javascript">
    var sKeyW25F2000 = "";
    var statusW25F2000 = 0;//0:filter, 1:addnew, 2:edit
    $(document).ready(function () {
        $("#slSearchFieldID").on("change", function (e) {
            $("#txtSearchValue").val("");
        })
    });

    $("#frmW25F2000").on('submit', function (e) {
        e.preventDefault();
        LoadDataW25F2000();
    });

    function LoadDataW25F2000() {

            if (statusW25F2000!=0)
                $("#pqgrid_W25F2000").pqGrid( "showLoading" );
            $.ajax({
                method: "POST",
                url: '{{url("/W25F2000/view/$pForm/$g/filter")}}',
                data: $("#frmW25F2000").serialize()+"&status="+statusW25F2000+"&key="+sKeyW25F2000,
                success: function (data) {
                    console.log(data, statusW25F2000);
                    if (statusW25F2000==0){
                        try{
                        if(data != "null")
                            $("#tbW25F2000").html(data);
                        }catch(err) {
                            console.log(err);
                        }
                    }
                    else if(statusW25F2000==1)//Thêm mới
                    {
                        if(data != "null"){
                            //var currentObject = $.parseJSON(data);
                            update4ParamGrid($("#pqgrid_W25F2000"), data, 'add');
                        }
                        $("#pqgrid_W25F2000").pqGrid( "hideLoading" );
                    }
                    else
                    {
                        if(data != "null") {
                            //var currentObject = $.parseJSON(data); //sửa
                            update4ParamGrid($("#pqgrid_W25F2000"), data, 'edit');
                        }
                        $("#pqgrid_W25F2000").pqGrid("hideLoading");
                    }
                    statusW25F2000 = 0;
                    sKeyW25F2000="";
                }
            });
    }

    function ReloadDataW25F2000() {
        if (sKeyW25F2000 != "")
            LoadDataW25F2000();
        else{
            statusW25F2000 = 0;
            sKeyW25F2000="";
        }
    }

    var W25F2000ExportExcel=function() {
        var _title = [];
        var _dataIndx =[];
        var _align = [];
        var _format = [];
        initExportExcell($("#pqgrid_W25F2000"),_title,_dataIndx,_align,_format);
        var _data = JSON.stringify($("#pqgrid_W25F2000").pqGrid("option", "dataModel.data"));
        var now = new Date();
        var toDay = convertDate(now.toLocaleDateString());
        $.ajax({
            method: "POST",
            data: {title: _title, data:_data, dataIndx: _dataIndx, align:_align, format: _format},
            url: "{{url('/Export')}}",
            success: function (data) {
                if(data==0) {
                    alert_error('{{Helpers::getRS(5,'Loi_xuat_file')}}')
                }
                else {
                    var downloadLink = document.createElement("a");
                    downloadLink.download = "Recruitment_" + toDay+".xls";
                    downloadLink.innerHTML = "Recruitment File";
                    downloadLink.href =data;
                    downloadLink.onclick = destroyClickedElement;
                    downloadLink.style.display = "none";
                    document.body.appendChild(downloadLink);
                    downloadLink.click();
                }
            }
        });
    };

    function convertDate(day) {
        var arr = day.split("/");
        var rsDay = arr[1] + "_" + arr[0] + "_" + arr[2];
        return rsDay;
    }
</script>

