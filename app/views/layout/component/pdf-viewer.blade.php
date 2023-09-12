<div class="modal draggable fade" id="modalPDFViewer"  data-backdrop="static"  role="dialog">
    <div class="modal-dialog formduyet">
        <div class="modal-content">
            <div class="modal-header">
                {{Helpers::generateHeading("PDF-Viewer","",false,"")}}
            </div>
            <div class="modal-body"  style="float: left; background: #fff; padding: 10px; width: 100%;">
                <div id="divPDFContent" style="margin-top: 3px">
                    <iframe src="{{$url}}" style="width:100%; height:100%;" frameborder="0"></iframe>
                </div>

            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        setTimeout(function(){
            $("#divPDFContent").height($(".modal-content").height() - 60);
        }, 500);

        //$("#divPDFContent").height($(".modal-content").height() - 60);
    });

 </script>