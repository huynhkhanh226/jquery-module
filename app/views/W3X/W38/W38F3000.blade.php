<section class="content" id="secW38F3000">
    <form id="frmW38F3000" name="frmW38F3000" method="post">
        <div class="row">
            <div class="col-md-6">
                <div class="row ">
                    <div class="col-md-4">
                        <label class="lbl-normal pdr0 ">{{Helpers::getRS($g,"Thoi_gian_dao_tao")}}</label>
                    </div>
                    <div class="col-md-8">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input class="col-md-12 active " id="txtDate" type="text" name="txtDate" readonly="true" value="{{date('01/m/Y').' - '.date('t/m/Y')}}" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5" style="padding-left: 0px">

            </div>
        </div>

        <div class="row pdt10">
            <div class="col-md-6">
                <div class="row ">
                    <div class="col-md-4">
                        <label class="lbl-normal pdr0 ">{{Helpers::getRS($g,"Ke_hoach_tong_the")}}</label>
                    </div>
                    <div class="col-md-8">
                        <select id="slTransIDW38F3000" name="slTransIDW38F3000"
                                class="form-control">
                            <option value="%"><--Tất cả--></option>
                            @foreach($cbTransID as $row)
                                <option value="{{$row['TransID']}}">{{$row['ProposalName']}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-5" style="padding-left: 0px">
                <div class="row">
                    <div class="col-md-3">
                        <label class="lbl-normal pdr0 ">{{Helpers::getRS($g,"Trang_thai")}}</label>
                    </div>
                    <div class="col-md-9">
                        {{Form::select("slAppStatusID", $rsStatus ,"All",["class" => "col-md-12  form-control", "id" => "slAppStatusID"])}}

                    </div>
                </div>
            </div>
        </div>

        <div class="row pdt10">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4">
                        <label class="lbl-normal pdr0 ">{{Helpers::getRS($g,"Tim_kiem")}}</label>
                    </div>
                    <div class="col-md-8">
                        {{ Form::select("slSearchFieldID", $rsFilter ,0,["class" => "col-md-12 form-control", "id" => "slSearchFieldID"])}}
                    </div>
                </div>
            </div>
            <div class="col-md-5" style="padding-left: 0px">
                <div class="row">
                    <div class="col-md-12">
                        <input type="text" class="form-control" id="txtSearchValue" name="txtSearchValue">
                    </div>
                </div>
            </div>
            <div class="col-md-1" style="padding-left: 0px">
                <button class="btn btn-default smallbtn" style="padding-top: 3px"><span class="digi digi-filter"></span>&nbsp;{{Helpers::getRS($g,"Loc")}}</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <div id="idAddGroup" class="btn-group">
                    <a onclick="showFormDialogPost('{{asset("W38F2000/$pForm/$g/master/")}}','modalW38F2000')" class="btn btn-default smallbtn" title="{{Helpers::getRS($g,"Them_moi1")}}">
                        <span class="glyphicon glyphicon-plus"></span> {{Helpers::getRS($g,"Them_moi1")}}
                    </a>
                </div>
            </div>
        </div>
        <input type="hidden" id="hdpForm" name="hdpForm" value="{{Session::get($pForm)}}">
    </form>
</section>
<section class="content" id="tbW38F3000"></section>

<script type="text/javascript">
    var sKeyW38F3000 = "";
    var statusW38F3000 = 0;//0:filter, 1:addnew, 2:edit
    $(document).ready(function() {
        $('#txtDate').daterangepicker({format: 'DD/MM/YYYY'});
        if ($("#hdpForm").val() < 2)
            $('#frmW38F3000').find("#idAddGroup").children().attr("disabled","disabled");

    });

    $("#frmW38F3000").on('submit', function (e) {
        e.preventDefault();
        LoadDataW38F3000();
    });

    function LoadDataW38F3000(){
        var datef = $('#txtDate').data('daterangepicker').startDate.format('DD/MM/YYYY');
        var datet = $('#txtDate').data('daterangepicker').endDate.format('DD/MM/YYYY');
        $.ajax({
            method: "POST",
            url: '{{url("/W38F3000/view/$pForm/$g/filter")}}',
            data: $("#frmW38F3000").serialize() + '&datefrom='+datef+'&dateto='+datet+"&status="+statusW38F3000+"&key="+sKeyW38F3000,
            success: function (data) {
                if (statusW38F3000==0)
                    $("#tbW38F3000").html(data);
                else if(statusW38F3000==1)//Them moi
                {
                    var currentObject = $.parseJSON(data);
                    update4ParamGrid($("#pqgrid_W38F3000"), currentObject, 'add');
                }
                else
                {
                    var currentObject = $.parseJSON(data); //edit
                    update4ParamGrid($("#pqgrid_W38F3000"), currentObject, 'edit');
                }
                statusW38F3000 = 0;
                sKeyW38F3000="";
                reloadFilter();
            }
        });
    }

    function ReloadData() {
        if (sKeyW38F3000 != "")
            LoadDataW38F3000();
        else{
            statusW38F3000 = 0;
            sKeyW38F3000="";
        }
    }

    function reloadFilter() {
        //alert("da chay rlfilter");
        $grid = $("#pqgrid_W38F3000");
        var column = $grid.pqGrid("getColumn", {dataIndx: "StatusName"});
        var filter = column.filter;
        filter.cache = null;
        filter.options = $grid.pqGrid("getData", {dataIndx: ["StatusName"]});
        $grid.pqGrid("refreshDataAndView");
    }
</script>

