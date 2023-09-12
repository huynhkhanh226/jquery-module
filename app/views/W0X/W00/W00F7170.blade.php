@extends('layout.adminlogin')
@section('lcontent')
    <div class="container">
        <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
                <div class="row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-8 " id="modalW00F7170">
                        <div class="row">
                            <div class="panel panel-primary">
                                {{Helpers::generateHeading("System Administrator - Attachment Setup <a href='".url('W00F7111')."' class='homeadmin fa fa-home'></a>","",false,"",false)}}
                                <div class="panel-body login-box-body">
                                    <form class="form-horizontal" action="" method="post" id="frmW00F7170"
                                          enctype="multipart/form-data">
                                        <div class="box-body">
                                            <div class="form-group has-error {{$show}}">
                                                <label class="control-label" id=""
                                                       for="inputError1">{{$message}}</label>
                                            </div>
                                            <div class="row">
                                                <div class = "col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                                    <label class="control-label text-left">File Extension</label>
                                                </div>
                                                <div class = "col-xs-8 col-sm-8 col-md-8 col-lg-8">
                                                    <div class="row">
                                                        <div class = "col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" id = "doc" name = "doc" {{Config::get('attachment.fileExtension.doc.val') == true?"checked":""}}>
                                                                    .doc
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class = "col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" id = "docx" name = "docx" {{Config::get('attachment.fileExtension.docx.val') == true?"checked":""}}>
                                                                    .docx
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class = "col-xs-4 col-sm-4 col-md-4 col-lg-4">

                                                </div>
                                                <div class = "col-xs-8 col-sm-8 col-md-8 col-lg-8">
                                                    <div class="row">
                                                        <div class = "col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" id = "xls" name = "xls" {{Config::get('attachment.fileExtension.xls.val') == true?"checked":""}}>
                                                                    .xls
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class = "col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" id = "xlsx" name = "xlsx" {{Config::get('attachment.fileExtension.xlsx.val') == true?"checked":""}}>
                                                                    .xlsx
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class = "col-xs-4 col-sm-4 col-md-4 col-lg-4">

                                                </div>
                                                <div class = "col-xs-8 col-sm-8 col-md-8 col-lg-8">
                                                    <div class="row">
                                                        <div class = "col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" id = "jpeg" name = "jpeg" {{Config::get('attachment.fileExtension.jpeg.val') == true?"checked":""}}>
                                                                    .jpeg (.jpg)
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class = "col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" id = "png" name = "png" {{Config::get('attachment.fileExtension.png.val') == true?"checked":""}}>
                                                                    .png
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class = "col-xs-4 col-sm-4 col-md-4 col-lg-4">

                                                </div>
                                                <div class = "col-xs-8 col-sm-8 col-md-8 col-lg-8">
                                                    <div class="row">
                                                        <div class = "col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" id = "zip" name = "zip" {{Config::get('attachment.fileExtension.zip.val') == true?"checked":""}}>
                                                                    .zip
                                                                </label>
                                                            </div>

                                                            <div class="checkbox hidden">
                                                                <label>
                                                                    <input type="checkbox" id = "jpg" name = "jpg" {{Config::get('attachment.fileExtension.jpg.val') == true?"checked":""}}>
                                                                    .jpg
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class = "col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" id = "pdf" name = "pdf" {{Config::get('attachment.fileExtension.pdf.val') == true?"checked":""}}>
                                                                    .pdf
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class = "col-xs-4 col-sm-4 col-md-4 col-lg-4">

                                                </div>
                                                <div class = "col-xs-8 col-sm-8 col-md-8 col-lg-8">
                                                    <div class="row">
                                                        <div class = "col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" id = "txt" name = "txt" {{Config::get('attachment.fileExtension.txt.val') == true?"checked":""}}>
                                                                    .txt
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class = "col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" id = "rar" name = "rar" {{Config::get('attachment.fileExtension.rar.val') == true?"checked":""}}>
                                                                    .rar
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mgt10">
                                                <div class = "col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                                    <label class="control-label text-left">File Size</label>
                                                </div>
                                                <div class = "col-xs-7 col-sm-7 col-md-7 col-lg-7">
                                                    <input class="form-control" type="text" name = "txtFileSize" id = "txtFileSize" style = "" value="{{Config::get('attachment.fileSize')}}" required>
                                                </div>
                                                <div class = "col-xs-1 col-sm-1 col-md-1 col-lg-1">
                                                    <div class="row">
                                                        <label style="height: 34px; display: table-cell; vertical-align: middle;">KB</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mgt10 text-right">
                                                <div class = "col-xs-11 col-sm-11 col-md-11 col-lg-11">
                                                    <label class="control-label text-left">Max file size: <span class="text-red">5MB</span></label>
                                                    <label class="control-label text-left text-primary">(5120KB = 5MB)</label>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.box-body -->
                                        <div class="box-footer">
                                            <div class="row">
                                                <button type="button" onclick="window.history.back()"
                                                        class="btn btn-primary smallbtn pull-left"><i class="fa fa-backward"></i>
                                                    Return
                                                </button>
                                                <button class="btn btn-primary smallbtn pull-right">Save</button>
                                            </div>
                                        </div>
                                        <!-- /.box-footer -->
                                    </form>
                                   {{-- <form id="#modalW00F7140" action="demo_form.asp" method="post">
                                        <input type="text" name="fname" required>
                                        <input type="submit" value="Submit">
                                    </form>--}}
                                </div>
                                <!-- /.login-box-body -->
                            </div>
                        </div>

                    </div>
                    <div class="col-sm-2"></div>
                </div>
            </div>
            <div class="col-sm-2"></div>
        </div>

    </div>

@stop
<style>
    /*Hide arrow type number*/
    input[type='number'] {
        -moz-appearance:textfield;
    }

    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
    }
</style>
@section('script')
    <script type="text/javascript">
        $(document).ready(function () {
            $(".container").css("marginTop", ($(document).height() - $(".container").height()) / 2 - 20);
        });
        $(window).resize(function () {
            $(".container").css("marginTop", ($(document).height() - $(".container").height()) / 2) - 20;
        });

        var updateFileSetup = function () {
            $.ajax({
                method: "post",
                url: '{{Request::url()}}',
                data: $("#frmW00F7170").serialize() + "&FileSize=" + Number($('#txtFileSize').val().replace(/,/g,"")),
                success: function (data) {
                    //console.log(data);
                    $(".has-error > label").html(data);
                    $(".has-error").removeClass('hide');
                }
            });
        };

        //button save submit -> require input
        $( "#frmW00F7170" ).submit(function( e ) {
            e.preventDefault();
            updateFileSetup();
        });

        $('#txtFileSize').inputmask("numeric", {
            radixPoint: ".",
            groupSeparator: ",",
            digits: 0,
            min:0,
            max:Number("{{Config::get('attachment.maxFileSize')}}"),
            autoGroup: true,
            //prefix: '$', //No Space, this will truncate the first character
            rightAlign: true,
            oncleared: function () {
                //self.Value('');
            }
        });
    </script>
@stop





