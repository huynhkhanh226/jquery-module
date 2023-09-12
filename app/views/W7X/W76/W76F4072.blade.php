<div class="modal fade draggable" id="modalW76F4072" data-backdrop="static" role="dialog">
    <div class="modal-dialog" style="width:750px;">
        <div class="modal-content">
            <div class="modal-header logodg pdl0">
                {{Helpers::generateHeading('Memo',"W76F4072")}}
            </div>
            <div class="modal-body">
                @if (count($memo)>0)
                    <div class="chat mgt10" id="divMemoW76F4072" style="height: 350px">
                        @foreach($memo as $row)
                            @include('W7X.W76.W76F4072_item')
                        @endforeach
                    </div>
            @endif
            <!-- /.chat -->
                <div class="box-footer">
                    <form id="frmW76F4072" name="frmW76F4072">
                        <div class="row">
                            <div class="col-md-12">
                                <textarea name="txtMemoContent" id="txtMemoContent" class="form-control" style="height: 55px;"></textarea>
                                <input type="hidden" name="hdTaskID" value="{{$id}}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 pdt10">
                                <button id="frm_btnAttachment" type="button"
                                        class="btn btn-default smallbtn mgr10"><span
                                            class="fa fa-paperclip mgr5"></span> {{Helpers::getRS($g,"Dinh_kem")}}
                                </button>
                            </div>
                            <div class="col-md-8 pdt10">
                                <div class="form-control pdt0 pdl0 pdb0 div-att" id="divAttachment">
                                </div>
                                <input type="file" id="FileAttW76F4072" class="hide"
                                       accept="{{implode(", ",$arrFileType)}}" multiple>
                                <input type="hidden" id="hdAttFileNameW76F4072" name="hdAttFileNameW76F4072" value="">
                            </div>
                            <div class="col-md-2 pdr5 pdt10">
                                <button id="frm_btnSave"
                                        class="btn btn-default smallbtn pull-right mgr10"><span
                                            class="glyphicon glyphicon-floppy-saved mgr5"></span> {{Helpers::getRS($g,"Luu")}}
                                </button>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 col-xs-12">
                                <div class = "row">
                                    <div class="col-md-7 col-xs-7">
                                        <div class="pull-left">
                                            <span style="font-size: 11px">{{Helpers::getRS($g, 'Loai_tap_tin_ho_tro')}}: </span>
                                            @foreach($arrFileType as $key=>$value)
                                                <span style="font-size: 11px" class = "text-red">&nbsp;{{$value}}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-xs-3">
                                        <div class="pull-left">
                                            <span style="font-size: 11px">{{Helpers::getRS($g, 'Kich_co_toi_da')}}:</span>
                                            <span style="font-size: 11px" class = "text-red">&nbsp;{{Config::get('attachment.fileSize')}} KB</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $("#modalW76F4072").find("#divMemoW76F4072").mCustomScrollbar({
            axis: "y",
            scrollButtons: {enable: true},
            theme: "minimal-dark",
            scrollbarPosition: "outside",
            scrollInertia: 50
        });
    });

    //Hàm kiểm tra các file hợp lệ khi đính kèm
    function check_file_type(filename) {
        var extension = filename.substr(filename.lastIndexOf('.')).toLowerCase();
        //var allowedExtensions = ['exe', 'bat', 'php', 'js', 'css', 'html'];
        var allowedExtensions = {{json_encode($arrFileType)}};
//        console.log(allowedExtensions.indexOf(extension));
        if (extension.length > 0)
        {
            if (allowedExtensions.indexOf(extension) === -1)
            {
                return false;
            }
        }

        return true;
    }

    $('#modalW76F4072').on('submit','#frmW76F4072', function (e) {
        e.preventDefault();
        $("#modalW76F4072 #frm_btnSave").prop("disabled","disabled");
        $("#modalW76F4072 #frm_btnAttachment").prop("disabled","disabled");
        var formData = new FormData($('#frmW76F4072')[0]);
        formData.append('delAttachment', JSON.stringify(delAttachment));
        $.each(validatedFiles, function (key, value) {
            formData.append('file[]', value);
        });
        $.ajax({
            enctype: 'multipart/form-data',
            method: "POST",
            url: "{{Request::url()}}",
            data: formData,
            processData: false, // Don't process the files
            contentType: false, // Set content type to false as jQuery will tell the server its a query string request
            success: function (data) {
                if (data == 1){

                }else{
                    $("#modalW76F4072 #frm_btnSave").prop("disabled","");
                    $("#modalW76F4072 #frm_btnAttachment").prop("disabled","");
                    $('#modalW76F4072 #txtMemoContent').val('');
                    $('#modalW76F4072').find('#divAttachment').html('');
                    validatedFiles = {};
                    delAttachment = [];
                    $("#modalW76F4072").find("#divMemoW76F4072").mCustomScrollbar('destroy');
                    $('#divMemoW76F4072').append(data);
                    $("#modalW76F4072").find("#divMemoW76F4072").mCustomScrollbar({
                        axis: "y",
                        scrollButtons: {enable: true},
                        theme: "minimal-dark",
                        scrollbarPosition: "outside",
                        scrollInertia: 50
                    });
                    $("#modalW76F4072").find("#divMemoW76F4072").mCustomScrollbar("scrollTo","bottom");
                }
            }
        });
    });

    $("#modalW76F4072 #frm_btnAttachment").on("click", function(e){
        $("#frmW76F4072").find("#FileAttW76F4072").click();
    });


    $('#modalW76F4072').on('click','.btnDelete', function () {
        var item = $(this);
        var id= item.attr('data-memoid');
        ask_delete(function () {
            $.ajax({
                method: "POST",
                url: "{{url("W76F4072/action")}}" ,
                data:{id:id},
                success: function (data) {
                    if (data==1)
                        $(item.closest( ".item" )).remove();
                    else
                        alert_error(data);
                }
            });
        });
    });

    $(document).on('hide.bs.modal', ' #modalW76F4072', function () {
        $("#divMemoW76F4072").getNiceScroll().remove();
    });

    var validatedFiles = {}, delAttachment = [];
    $("#FileAttW76F4072").on("change", function (event) {
        var arrFile = this.files;
        var sizeLimit = "{{Config::get('attachment.fileSize')}}";
        console.log(Number(sizeLimit));
        for (var i = 0; i < arrFile.length; i++) {
            if ((arrFile[i].size/ 1024) > Number(sizeLimit)) {
                alert_warning('Dung lượng File không được lớn hơn ' + sizeLimit + ' KB');
            } else if (check_file_type(arrFile[i].name) == false) {
                alert_warning('Định dạng file không hợp lệ');
            }
            else {
                var dtime = new Date().getTime() + i;
                validatedFiles[dtime] = arrFile[i];
                var li = '<button type="button" class="btn btn-xs btn-default file-att" onclick="removeFile(this,\'' + dtime + '\');">' + arrFile[i].name + ' <span class="select2-selection__choice__remove" role="presentation">×</span></button>';
                $('#modalW76F4072').find('#divAttachment').append(li);
            }
        }
    });

    var removeFile = function (li, id) {
        $(li).remove();
        delete validatedFiles[id];
    };

    var addDelAttachment = function (li, id) {
        $(li).remove();
        delAttachment.push(id);
    };
</script>

