<section class="content">
    <div class="row">

        {{--<div class="col-md-12 col-xs-12">--}}
            {{--<div class="btn-group">--}}
                {{--@if(Session::get($pForm)>1)--}}
                    {{--<a onclick="showFormDialog('{{url("/W76F2051/$pForm")}}','modalW76F2051')"--}}
                       {{--class="btn btn-default smallbtn">--}}
                        {{--<span class="glyphicon glyphicon-plus"></span> {{Helpers::getRS($g,"Them_moi1")}}--}}
                    {{--</a>--}}
                {{--@endif--}}
            {{--</div>--}}
        {{--</div>--}}

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div id="toolbarW76F2050">
            </div>
        </div>

    </div>
    <div class="row pdt5">
        <div class="col-md-12" id="tbW76F2050">

        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <div class="checkbox mgb5">
                <label>
                    <input type="checkbox" id="chkShowDisabledW76F2050" name="chkShowDisabledW76F2050"> {{Helpers::getRS($g,'Hien_thi_danh_muc_khong_su_dung')}}
                </label>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    function loadTable() {
        $(".l3loading").removeClass('hide');
        $.ajax({
            method: 'POST',
            url: '{{Request::url()}}',
            success: function (data) {
                $("#tbW76F2050").html(data);
                $(".l3loading").addClass('hide');
            }
        });
    }

    $(document).ready(function () {

        var permission = "{{Session::get($pForm)}}";
        //permission = 1;
        $("#toolbarW76F2050").digiMenu({
                showText: true,
                buttonList: [
                    {
                        ID: "btnAddW39F2000",
                        icon: "fa fa-plus text-blue",
                        title: "{{Helpers::getRS($g,'Them_moi1')}}",
                        enable: true,
                        hidden: !(permission > 1),
                        type: "button",
                        render: function (ui) {
                        },
                        postRender: function (ui) {
                            //console.log(ui);
                            ui.$btn.click(function () {
                                showFormDialog('{{url("/W76F2051/$pForm/$g")}}'  + "/add",'modalW76F2051', null, 2);
                            });
                        },
                    }

                ]
            }
        );


        $('#chkShowDisabledW76F2050').click(function () {
            filterDisabled("pqgrid_W76F2050", $("#chkShowDisabledW76F2050").is(":checked") ? "" : 0);
        });
    });


    loadTable();
</script>
