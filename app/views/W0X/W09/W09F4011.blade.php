<div class="modal fade" id="modalW09F4011" data-backdrop="static" role="dialog">
    <div class="modal-dialog"  style="width: 80%">
        <div class="modal-content" style = "height: 480px">
            <div class="modal-header logodg pdl0">
                {{Helpers::generateHeading(Helpers::getRS($g, 'Cap_nhat_dinh_kem'),"W09F4011",true,"closePopW09F4011")}}
            </div>

            <div class="modal-body" style="padding:10px">
                <form class="form-horizontal" id="frmW09F4011" enctype="multipart/form-data" method="POST">
                    <div class="row form-group">
                        <div class="col-md-2 col-xs-2">
                            <label class="lbl-normal">{{Helpers::getRS($g,"Tap_tin")}}</label>
                        </div>
                        <div class="col-md-10 col-xs-10">
                            <div class="row">
                                <div class="col-md-12 col-xs-12">
                                    <div class="custom-file-input">
                                        <input type="file" id = "txtURLW09F4011" @if($task == 'view') disabled @endif>
                                        <input type="text" id = "txtFileW09F4011" style = "width: 81%" @if($task == 'view')disabled @endif>
                                        <button style="margin-bottom: 4px;" type="button" id="btnBrowseW09F4011" name="btnBrowseW09F4011"
                                                @if($task == 'view')disabled @endif
                                                class="btn btn-default smallbtn"><span
                                                    class="fa fa-folder text-yellow mgr5"></span> {{Helpers::getRS($g,"Chon")}}
                                        </button>
                                    </div>
                                </div>
                                <!--div class="col-md-1 col-xs-1">
                                    <button type="button" id="btnBrowseW09F4011" name="btnBrowseW09F4011"
                                            onclick=""
                                            class="btn btn-default smallbtn pull-right"><span
                                                class="fa fa-folder text-yellow mgr5"></span> Upload
                                    </button>
                                </div-->
                            </div>
                        </div>
                    </div>

                    <div class="row form-group" style="margin-bottom: 15px;">
                        <div class="col-md-2 col-xs-2">
                            <label class="lbl-normal">{{Helpers::getRS($g,"Dien_giai")}}</label>
                        </div>
                        <div class="col-md-10 col-xs-10">
                            <input class="form-control" type="text" id="txtDescriptionW09F4011" name="txtDescriptionW09F4011">
                        </div>
                    </div>

                    <div class="row form-group" style="margin-bottom: 15px;">
                        <div class="col-md-2 col-xs-2">
                            <label class="lbl-normal">{{Helpers::getRS($g,"Do_lon")}}</label>
                        </div>
                        <div class="col-md-10 col-xs-10">
                            <div class="row">
                                <div class="col-md-3 col-xs-3">
                                    <div class="row">
                                        <div class="col-md-10 col-xs-10">
                                            <input class="form-control" type="text" id="txtFileSizeW09F4011" name="txtFileSizeW09F4011" readonly>
                                        </div>
                                        <div class="col-md-2 col-xs-2">
                                            <label class="lbl-normal pull-left">(KB)</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-9 col-xs-9">
                                    <div class="row">
                                        <div class="col-md-6 col-xs-6">
                                            <div class="row">
                                                <div class="col-md-4 col-xs-4">
                                                    <label class="lbl-normal">{{Helpers::getRS($g,"Ngay_tao")}}</label>
                                                </div>
                                                <div class="col-md-8 col-xs-8">
                                                    <input class="form-control" value="{{date('d/m/Y')}}" type="text" id="txtCreateDateW09F4011" name="txtCreateDateW09F4011" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-xs-6">
                                            <div class="row">
                                                <div class="col-md-4 col-xs-4">
                                                    <label class="lbl-normal">{{Helpers::getRS($g,"Nguoi_tao")}}</label>
                                                </div>
                                                <div class="col-md-8 col-xs-8">
                                                    <input class="form-control" type="text" id="txtCreateUserIDW09F4011" name="txtCreateUserIDW09F4011" value="{{$creatorName}}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="row form-group" style="margin-bottom: 15px;">
                        <div class="col-md-2 col-xs-2">
                            <label class="lbl-normal">{{Helpers::getRS($g,"Ghi_chu")}}</label>
                        </div>
                        <div class="col-md-10 col-xs-10">
                            <textarea class="form-control" id="txtNotesW09F4011" rows="12" name="txtNotesW09F4011"></textarea>
                        </div>
                    </div>

                    @if($task == 'edit' || $task == 'add')
                    <div class="row form-group">
                        <div class="col-md-12 col-xs-12">
                            <div class = "row">
                                <div class="col-md-5 col-xs-5">
                                    <div class="pull-left">
                                        <span style="font-size: 11px">{{Helpers::getRS($g, "Loai_tap_tin_ho_tro")}}: </span>
                                        @foreach($arrFileType as $key=>$value)
                                            <span style="font-size: 11px" class = "text-red">&nbsp;.{{$value}}</span>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-md-3 col-xs-3">
                                    <div class="pull-left">
                                        <span style="font-size: 11px">{{Helpers::getRS($g, 'Kich_co_toi_da')}}:</span>
                                        <span style="font-size: 11px" class = "text-red">&nbsp;{{Config::get('attachment.fileSize')}} KB</span>
                                    </div>
                                </div>
                                <div class="col-md-4 col-xs-4">
                                    <div class="pull-right">
                                        <button type="button" id="btnSaveW09F4011" name="btnSaveW09F4011"
                                                onclick="ask_save(function(){saveData()})"
                                                class="btn btn-default smallbtn"><span
                                                    class="fa fa-floppy-o mgr5 text-blue"></span> {{Helpers::getRS($g,"Luu")}}
                                        </button>
                                        <button type="button" id="btnNextW09F4011" name="btnNextW09F4011"
                                                class="btn btn-default smallbtn @if($task == 'edit') hide @endif" disabled ><span
                                                    class="fa fa-arrow-right text-orange mgr5"></span> {{Helpers::getRS($g,"Nhap_tiep")}}
                                        </button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
<style>
    .custom-file-input{
        width: 100%;
        display: inline-block;
        overflow: hidden;
        position: relative;
    }
    .custom-file-input input[type="file"]{
        width: 100%;
        height: 100%;
        opacity: 0;
        filter: alpha(opacity=0);
        zoom: 1;  /* Fix for IE7 */
        position: absolute;
        top: 0;
        left: 0;
        z-index: 999;
    }
</style>
<script type="text/javascript">
    var keyIDW09F4011 = "{{$keyID}}";
    var keyIDW09F40112 = "{{$key2ID}}";
    var keyIDW09F40113 = "{{$key3ID}}";
    var keyIDW09F40114 = "{{$key4ID}}";
    var keyIDW09F40115 = "{{$key5ID}}";
    var action = "{{$task}}";
    var AttachmentID = "";
    var editFlag = 0; // biến nhận biết có chọn lại file mới hay không// 0: ko chọn //1: đã chọn
    var FileExt = "";
    var tableName = "{{$tableName}}";
    var SizeLimit = {{Config::get('attachment.fileSize')}}; //giới hạn size lấy từ config
    console.log(tableName);
    $(document).ready(function(){
        //console.log({{json_encode($arrRSFileEXT)}});
        $('.custom-file-input input[type="file"]').change(function(e){
            $(this).siblings('input[type="text"]').val(e.target.files[0].name);
            $('#txtFileSizeW09F4011').val((e.target.files[0].size)/1024);
            editFlag = 1;
        });
        console.log(action);
        @if($task == 'view')//truong hop view
            $('#txtDescriptionW09F4011').prop('disabled', true).val("{{$dataATT['Description']}}");
            $('#txtFileSizeW09F4011').prop('disabled', true).val("{{$dataATT['FileSize']}}");
            $('#txtCreateDateW09F4011').prop('disabled', true).val("{{$dataATT['CreateDate']}}");
            $('#txtCreateUserIDW09F4011').prop('disabled', true).val("{{$dataATT['CreateUserName']}}");
            $('#txtNotesW09F4011').prop('disabled', true).val("{{$dataATT['Notes']}}");
            $('#txtFileW09F4011').prop('disabled', true).val("{{$dataATT['FileName']}}");
        @endif

        @if($task == 'edit')//truong hop edit
            $('#txtDescriptionW09F4011').val("{{$dataATT['Description']}}");
            $('#txtFileSizeW09F4011').val("{{$dataATT['FileSize']}}");
            $('#txtCreateDateW09F4011').val("{{$dataATT['CreateDate']}}");
            $('#txtCreateUserIDW09F4011').val("{{$dataATT['CreateUserName']}}");
            $('#txtNotesW09F4011').val("{{$dataATT['Notes']}}");
            $('#txtFileW09F4011').val("{{$dataATT['FileName']}}");
            AttachmentID = "{{$dataATT['AttachmentID']}}";
            FileExt = "{{$dataATT['FileExt']}}";
        @endif
    });

    $("#btnNextW09F4011").click(function () {
        loadFormW09F4011('loadNext');
    });

    function closePopW09F4011() {
        LoadDataW09F4011(keyIDW09F4011, keyIDW09F40112, keyIDW09F40113,keyIDW09F40114,keyIDW09F40115, tableName);
        $("#modalW09F4011").modal('hide');
    }
    
    $('#txtFileSizeW09F4011').inputmask("numeric", {
        radixPoint: ".",
        groupSeparator: ",",
        digits: 0,
        autoGroup: true,
        //prefix: '$', //No Space, this will truncate the first character
        rightAlign: false,
        oncleared: function () {
            self.Value('');
        }
    });

    function loadFormW09F4011(mode) {//ham load lai man hinh
        switch (mode){
            case "afterSave": //sau khi luu thanh cong
                $('#txtDescriptionW09F4011').prop('disabled', true);
                $('#txtFileSizeW09F4011').prop('disabled', true);
                $('#txtNotesW09F4011').prop('disabled', true);
                $('#txtFileW09F4011').prop('disabled', true);
                $('#txtURLW09F4011').prop('disabled', true);
                $('#btnBrowseW09F4011').prop('disabled', true);

                $('#btnSaveW09F4011').prop('disabled', true);
                $('#btnNextW09F4011').prop('disabled', false);
                break;
            case "loadNext": //nhap tiep
                $('#txtDescriptionW09F4011').prop('disabled', false).val("");
                $('#txtFileSizeW09F4011').prop('disabled', false).val("");
                $('#txtNotesW09F4011').prop('disabled', false).val("");
                $('#txtFileW09F4011').prop('disabled', false).val("");
                $('#txtURLW09F4011').prop('disabled', false).val("");
                $('#btnBrowseW09F4011').prop('disabled', false);

                $('#btnSaveW09F4011').prop('disabled', false);
                $('#btnNextW09F4011').prop('disabled', true);
                break;
        }
    }

    function saveData(){
        var type = '';
        //var type1 =
        var size = 0;
        var sizeFile = 0;
        @if($task == 'edit')//lấy type của file
        if(FileExt == "doc"){
            type = "application/msword";
        }
        if(FileExt == "jpeg"){
            type = "image/jpeg";
        }
        if(FileExt == "xls"){
            type = "application/vnd.ms-excel";
        }
        if(FileExt == "xlsx"){
            type = "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet";
        }
        if(FileExt == "docx"){
            type = "application/vnd.openxmlformats-officedocument.wordprocessingml.document";
        }
        if(FileExt == "png"){
            type = "image/png";
        }
        if(FileExt == "jpg"){
            type = "image/jpg";
        }
        if(FileExt == "txt"){
            type = "text/plain";
        }
        if(FileExt == "rar"){
            type = "";
        }
        if(FileExt == "zip"){
            type = "application/zip";
        }else{
            type = "application/pdf";
        }
        @endif
        if(Number(editFlag) == 1){//có chọn file
            var valueFile = document.getElementById("txtURLW09F4011");
            var file = valueFile.files[0];
            type = file.type;
            sizeFile = file.size;
            size = Number($('#txtFileSizeW09F4011').val().replace(/,/g,""));
            console.log(file);
        }
        //var match= ["image/jpeg","image/png","image/jpg","application/pdf", "application/msword", "application/vnd.openxmlformats-officedocument.wordprocessingml.document", "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet", "application/vnd.ms-excel"];
        var match = {{json_encode($arrRSFileEXT)}};
        if(type == match[0] || type == match[1] || type == match[2] || type == match[3] || type == match[4] || type == match[5]  || type == match[6] || type == match[7]|| type == match[8]  || type == match[9] || type == match[10]|| type == match[11])
        {
            if(size <= SizeLimit){
                //khởi tạo đối tượng form data
                var form_data = new FormData();

                //thêm files vào trong form data
                form_data.append('file', file);

                //thêm giá trị các control vào form data
                form_data.append('txtDescriptionW09F4011', $('#txtDescriptionW09F4011').val());
                form_data.append('txtFileSizeW09F4011', sizeFile);
                form_data.append('txtCreateDateW09F4011', $('#txtCreateDateW09F4011').val());
                form_data.append('txtCreateUserIDW09F4011', $('#txtCreateUserIDW09F4011').val());
                form_data.append('txtNotesW09F4011', $('#txtNotesW09F4011').val());
                form_data.append('keyID', keyIDW09F4011);
                form_data.append('key2ID', keyIDW09F40112);
                form_data.append('key3ID', keyIDW09F40113);
                form_data.append('key4ID', keyIDW09F40114);
                form_data.append('key5ID', keyIDW09F40115);
                form_data.append('action', action);
                form_data.append('type', type);
                form_data.append('tableName', tableName);
                @if($task == 'edit')//truong hop edit
                form_data.append('AttachmentID', AttachmentID);
                form_data.append('editFlag', editFlag);
                @endif

                //sử dụng ajax post
                //$(".l3loading").removeClass('hide');
                $.ajax({
                    method: "POST",
                    url: '{{url("/W09F4011/$pForm/$g/save")}}',
                    dataType: 'text',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,
                    success: function (data) {
                        console.log(data);
                        var result = $.parseJSON(data);
                        //console.log(data);
                        //$(".l3loading").addClass('hide');
                        if(result.status == "SUCCESS"){
                            save_ok();
                            loadFormW09F4011('afterSave');
                        }else{
                            alert_error(result.message);
                        }
                    }
                });
            }else{
                alert_warning('Dung lượng File không được lớn hơn ' + SizeLimit + ' KB');
                $('#txtURLW09F4011').val('');
                $('#txtFileW09F4011').val('');
            }

        } else{
            alert_warning('Định dạng file không hợp lệ');
            $('#txtURLW09F4011').val('');
            $('#txtFileW09F4011').val('');
        }
    }
</script>