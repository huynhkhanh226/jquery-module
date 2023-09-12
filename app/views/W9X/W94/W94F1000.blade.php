<section class="content">
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <div class="btn-group">
                @if(Session::get($pForm) >1)
                    <a onclick="showFormDialogGet('{{url("/W94F1000/".$pForm."/add")}}','modalW94F1000')"
                       class="btn btn-default smallbtn" title="Thêm mới">
                        <span class="glyphicon glyphicon-plus"></span> {{Helpers::getRS($g,"Them_moi1")}}
                    </a>
                @endif
            </div>
        </div>
    </div>
    <input type="hidden" id="hdSaveOKW94F1000" value="0">
</section>
<section class="content" id="tbW94F1000">
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <div style="margin:auto;">
                <input type="checkbox" id="chkShowDisabledW94F1100" name="chkShowDisabledW94F1100" value="0"
                       style="float: left;"/>

                <p style="float: left;padding-left: 10px;">{{Helpers::getRS($g,'Hien_thi_danh_muc_khong_su_dung')}}</p>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    function loadTable() {
        $(".l3loading").removeClass('hide');
        $.ajax({
            method: 'POST',
            url: '{{Request::url("/W94F1000/view/$pForm/$g/ajax")}}',
            success: function (data) {
                $("#tbW94F1000").html(data);
                $(".l3loading").addClass('hide');
            }
        });
    }

    $(document).ready(function () {
        loadTable();
        $(document).on('hidden.bs.modal', ' #modalW94F1000', function () {
            $("#myModal").html('');
        });

        $('#chkShowDisabledW94F1100').click(function () {
            filterDisabled("pqgrid_W94F1000", $("#chkShowDisabledW94F1100").is(":checked") ? "" : 0);
        });
    });

</script>
