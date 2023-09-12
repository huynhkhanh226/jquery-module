<div class="modal fade" id="modalW09F5605" data-backdrop="static" role="dialog">
    <div class="modal-dialog" style="width: 80%;height:70%">
        <div class="modal-content">
            <div class="modal-header">
                {{Helpers::generateHeading(Helpers::getRS($g,"Chon_nhan_vien"),"W09F5605",true,"closeW09F5605")}}
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="frmW09F5605">
                    <div class="box-body">
                        <fieldset>
                            <legend class="legend">{{Helpers::getRS($g,"Thong_tin_loc")}}</legend>
                            <div class="form-group">
                                <div class="col-md-6 col-xs-6">
                                    <div class="row">
                                        <div class="col-md-3 liketext">
                                            <b><label class="lbl-normal">{{Helpers::getRS($g,"Phong_ban")}}</label></b>
                                        </div>
                                        <div class="col-md-9 col-xs-9">
                                            <select class="form-control select2" id="cboDepartmentIDW09F5605"
                                                    name="cboDepartmentIDW09F5605" required>
                                                <option value=''></option>
                                                @foreach($department as $key=>$value)
                                                    <option value="{{$key}}">{{$value}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xs-6">
                                    <div class="row">
                                        <div class="col-md-3 liketext">
                                            <b><label class="lbl-normal">{{Helpers::getRS($g,"Ma_NV")}}</label></b>
                                        </div>
                                        <div class="col-md-9 col-xs-9">
                                            <input class="form-control text-right" type="text" id="txtEmployeeIDW09F5605"
                                                   name="txtEmployeeIDW09F5605" value="" placeholder="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-xs-6">
                                    <div class="row">
                                        <div class="col-md-3 liketext">
                                            <b><label class="lbl-normal">{{Helpers::getRS($g,"To_nhom")}}</label></b>
                                        </div>
                                        <div class="col-md-9 col-xs-9">
                                            <select class="form-control select2" id="cboTeamIDW09F5605" name="cboTeamIDW09F5605">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xs-6">
                                    <div class="row">
                                        <div class="col-md-3 liketext">
                                            <b><label class="lbl-normal">{{Helpers::getRS($g,"Ten_NV")}}</label></b>
                                        </div>
                                        <div class="col-md-9 col-xs-9">
                                            <input class="form-control text-right" type="text" id="txtEmployeeNameW09F5605"
                                                   name="txtEmployeeNameW09F5605" value="" placeholder="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12 col-xs-12 text-right">
                                    <button type="submit" id="btnFilterW09F5605"
                                            class="btn btn-default smallbtn confirmation-save">
                                        <span class="glyphicon glyphicon-filter mgr5"></span>{{Helpers::getRS($g,"Loc")}}
                                    </button>
                                </div>
                            </div>
                        </fieldset>
                        <div class="form-group">
                            <div class="col-md-12 col-xs-12">
                                <div class="l3loading hide">
                                    <i class="fa fa-refresh fa-spin"></i>
                                </div>
                                <section id="divEmployeeW09F5605"></section>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer hide">
                        <div class="row">
                            <div class="col-md-12 col-xs-12">
                                <button type="button" id="btnSelect" name="btnSelect" class="btn btn-default smallbtn pull-right test123456"><span
                                            class="glyphicon glyphicon-ok mgr5"></span> {{Helpers::getRS($g,"Chon")}}</button>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="hdProposalIDW09F5605" name="hdProposalIDW09F5605" value="">
                    <input type="hidden" id="hdProBatchIDW09F5605" name="hdProBatchIDW09F5605" value="">
                    <input type="hidden" id="hdTrainingCourseIDW09F5605" name="hdTrainingCourseIDW09F5605" value="">
                </form>
            </div>

        </div>
    </div>
</div>

<script type="text/javascript">
    var tEmArr = "{{isset($tEmArr) ? json_encode($tEmArr) : ''}}";
    function closeW09F5605() {
        $("#modalW09F5605").modal('hide');
        $("#divEmployeeW09F5605").html("")
        reloadGridD09F5605(false);
    }
    $(document).ready(function () {
        $("#frmW09F5605").find("#cboDepartmentIDW09F5605").change(function () {
            $.ajax({
                method: "POST",
                url: '{{url("/W09F5605/".$pForm."/".$g."/combo/team")}}',
                data: {cboDepartmentID: $("#cboDepartmentIDW09F5605").val()},
                success: function (data) {
                    $("#cboTeamIDW09F5605").html(data);
                }
            });
        });
    });

    $("#modalW09F5605").on('submit', '#frmW09F5605', function (e) {
        e.preventDefault();
        $("#modalW09F5605").find(".l3loading").removeClass('hide');
        $.ajax({
            method: "POST",
            url: '{{url("/W09F5605/".$pForm."/".$g."/filter")}}',
            data: $("#frmW09F5605").serialize(),
            success: function (data) {
                $("#modalW09F5605").find(".l3loading").addClass('hide');
                $("#divEmployeeW09F5605").html(data);
                $("#modalW09F5605").find(".box-footer").removeClass('hide');
            }
        });

    });


    //Get selected data
    $('#btnSelect').click(function () {
        $("#tblEmployeeIDW09F5605").pqGrid("reset", {group: true, filter: true});
        var employeeids = new Array();
       // var arr = $("#tblEmployeeIDW09F5605").pqGrid("selection", {type: 'row', method: 'getSelection'});
        console.log(tEmArr);
        var obj = $("#tblEmployeeIDW09F5605").pqGrid("option", "dataModel.data");
        var arr = $.grep(obj, function (d) {
            return d["IsUsed"] == 1 || d["IsUsed"] == true;
        });
        console.log(arr);
        if (arr.length < 1) {
            alert_warning("{{Helpers::getRS($g,"Ban_chua_chon_nhan_vien")}}");
        } else {
            for (var i = 0; i < arr.length; i++) {
                var id = arr[i]["EmployeeID"];
                employeeids[i] = id;
            }
            /*if(tEmArr.length == 0){
                tEmArr = employeeids;
            }else{
                for(var i = 0; i < tEmArr.length; i++){
                    for(var j = i + 1; j < employeeids.length; ++j){
                        if(employeeids[j] != tEmArr[i]){
                            tEmArr.push(employeeids[j]);
                        }
                    }
                }
            }*/
            console.log(tEmArr);
            if (employeeids.length > 0) {
                //Luu xuong bang tam
                $.ajax({
                    method: "POST",
                    url: '{{url("/W09F5605/".$pForm."/".$g."/save")}}',
                    data: {employeeids: employeeids,
                            tEmArr: tEmArr
                    },
                    success: function (data) {
                        var result = $.parseJSON(data);
                        console.log(result)
                        if (result.bSaved) {
                            $("#hdSelectedW38F2000").val("1");
                            closeW09F5605();
                            updateGridW09F5605(result.tArr);
                        }
                    }
                });
            }
        }
    });

</script>




