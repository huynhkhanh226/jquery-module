<div class="modal draggable fade modal" id="modalW94F4002" data-keyboard="false" data-backdrop="static" role="dialog">
    <div class="modal-dialog modal-lg formduyet">
        <div class="modal-content">
            <form class="form-horizontal" id="frmW94F4002" method="post" action="">
                <div class="modal-header">
                    {{Helpers::generateHeading($title,"W94F4002")}}
                </div>
                <div class="modal-body pd10">
                    <form id="frmW94F4002">
                        <div class="row form-group">
                            <div class="col-md-1">
                                <div class="radio pdt5">
                                    <label>
                                        <input name="optIsYearW94F4002" id="optIsYearW94F4002_1" value="1" checked type="radio">
                                        {{Helpers::getRS($g,"Nam")}}
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="radio pdt5">
                                    <label>
                                        <input name="optIsYearW94F4002" id="optIsYearW94F4002_0" value="0" type="radio">
                                        {{Helpers::getRS($g,"Quy")}}
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-1 col-xs-1">
                                <div class="liketext">
                                    <label class="lbl-normal">{{Helpers::getRS($g,"Don_vi")}}</label>
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-6">
                                <select id="cboDivisionW94F4002"
                                        name="cboDivisionW94F4002"
                                        class="form-control selectpicker required" multiple data-actions-box="true"
                                        data-live-search="true" multiple data-max-options="20"
                                        required>
                                    @foreach($rsDivision as $row)
                                        <option title="{{$row["DivisionID"]}}" value="{{$row["DivisionID"]}}">{{$row["DivisionName"]}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-1">
                                <button id="btnFilterW94F4002" type="button"
                                        class="btn btn-default smallbtn pull-left mgr5"><span
                                            class="digi digi-filter"></span>
                                    &nbsp;{{Helpers::getRS($g,"Loc")}}</button>
                                <input type="submit" class="hide" id="btnSubmitFilterW94F4002"/>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-1 col-xs-2">
                                <div class="liketext">
                                    <label class="lbl-normal">{{Helpers::getRS($g,"Nam")}}</label>
                                </div>
                            </div>
                            <div class="col-md-1 col-xs-1">
                                <select class="form-control noUseValidHTML5 select2" id="cboYearW94F4002"
                                        name="cboYearW94F4002" required>
                                    @foreach($rsYear as $rowYear)
                                        <option value="{{$rowYear["Year"]}}">{{$rowYear["Year"]}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-1 col-xs-1">
                                <div class="liketext">
                                    <label class="lbl-normal">{{Helpers::getRS($g,"Phong_ban")}}</label>
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-6">
                                <select class="form-control noUseValidHTML5 required" id="cboDepartmentW94F4002"
                                        class="form-control selectpicker required" multiple data-actions-box="true"
                                        data-live-search="true" multiple data-max-options="20"
                                        name="cboDepartmentW94F4002" required>
                                </select>
                            </div>
                            <div class="col-md-2 col-xs-2">
                                <div class="liketext">
                                    <label class="lbl-normal">{{Helpers::getRS($g,"Don_vi_tinh")}} : <strong id="lblUnitName"></strong></label>
                                </div>
                            </div>

                        </div>
                    </form>
                    <div class="row form-group">
                        <div class="col-md-12 col-xs-12">
                            <div id="divContentW94F4002"></div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $("#modalW94F4002").find(".modal-content").height($(document).height() - 20);
        //$("#cboDivisionW94F4002").select2();
        $("#cboDivisionW94F4002").selectpicker({
            maxOptions: 20,
            maxOptionsText: "{{Helpers::getRS(0,'Ban_chi_duoc_chon_toi_da').' 20 '. Helpers::getRS(0,'Don_vi')}}"
        });
        $("#cboDepartmentW94F4002").selectpicker({
            maxOptions: 20,
            maxOptionsText: "{{Helpers::getRS(0,'Ban_chi_duoc_chon_toi_da').' 20 '. Helpers::getRS(0,'Phong_ban')}}"
        });


        //$('#cboDivisionW94F4002').selectpicker('hideAllButons');
        $('#cboDivisionW94F4002').on('changed.bs.select', function (e) {
            console.log("test");
            var subdiv = $(this).val();
            if (subdiv != null) {
                if (subdiv[0] == '%') {
                    $('#cboDivisionW94F4002').selectpicker('deselectAll');
                    $('#cboDivisionW94F4002').selectpicker('val', '%');
                    $('#cboDivisionW94F4002').find('[value!="%"]').prop('disabled', 'disabled');
                    $('#cboDivisionW94F4002').selectpicker('refresh');

                }else{
                    $('#cboDivisionW94F4002').find('[value="%"]').prop('disabled', 'disabled');
                    $('#cboDivisionW94F4002').selectpicker('refresh');

                }


            } else {
                $('#cboDivisionW94F4002').find('[value!="%"]').prop('disabled', '');
                $('#cboDivisionW94F4002').find('[value="%"]').prop('disabled', '');
                $('#cboDivisionW94F4002').selectpicker('refresh');

            }
            $(".l3loading").removeClass('hide');
            var divisionIDList = "";
            if (subdiv != null){
                divisionIDList = subdiv.join(";");
            }
            postMethod('{{url('/W94F4002/D94F4002/0/loaddepartment')}}', function (res) {
                $("#cboDepartmentW94F4002").html(res);
                $('#cboDepartmentW94F4002').selectpicker('val', '%');
                $('#cboDepartmentW94F4002').selectpicker('refresh');
                $(".l3loading").addClass('hide');
                //$("#btnSubmitFilterW94F4002").click();
            }, {divisionIDList: divisionIDList})

        });

        $('#cboDepartmentW94F4002').on('changed.bs.select', function (e) {
            console.log("test");
            var subdiv = $(this).val();
            if (subdiv != null) {
                if (subdiv[0] == '%') {
                    $('#cboDepartmentW94F4002').selectpicker('deselectAll');
                    $('#cboDepartmentW94F4002').selectpicker('val', '%');
                    $('#cboDepartmentW94F4002').find('[value!="%"]').prop('disabled', 'disabled');
                    $('#cboDepartmentW94F4002').selectpicker('refresh');
                } else {
                    $('#cboDepartmentW94F4002').find('[value="%"]').prop('disabled', 'disabled');
                    $('#cboDepartmentW94F4002').selectpicker('refresh');
                }
            } else {
                $('#cboDepartmentW94F4002').find('[value!="%"]').prop('disabled', '');
                $('#cboDepartmentW94F4002').find('[value="%"]').prop('disabled', '');
                $('#cboDepartmentW94F4002').selectpicker('refresh');
            }

        });

        $('#cboDivisionW94F4002').selectpicker('val', '%');
        $('#cboDivisionW94F4002').trigger("change");
//        $("#cboDepartmentW94F4002").select2({
//            containerCssClass : "required"
//        });

        $("#btnFilterW94F4002").click(function(){
            validationElements($("#frmW94F4002"),function(){
                $("#btnSubmitFilterW94F4002").click();
            });
        });

        $("#frmW94F4002").submit(function(e){
            e.preventDefault();
            var divs = $('#cboDivisionW94F4002').selectpicker('val').join(";");
            var parts = $('#cboDepartmentW94F4002').selectpicker('val').join(";");
            $(".l3loading").removeClass("hide");
            postMethod('{{url('/W94F4002/D94F4002/0/loadgrid')}}', function (res) {
                $("#divContentW94F4002").html(res);
                $(".l3loading").addClass("hide");
            }, $("#frmW94F4002").serialize() + "&divisionIDList=" + divs + "&departmentIDList=" + parts)
        });
    });
</script>
<style>
    .pq-grid-title-row{
        background-color: azure;
    }
</style>