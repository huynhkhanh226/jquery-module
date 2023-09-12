<div class="modal draggable fade" id="modalResizeImage" data-backdrop="static" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                {{Helpers::generateHeading('Resize image tool',"",false,"")}}
            </div>
            <div class="modal-body">
                <div class="row form-group">
                    <div class="col-xs-12 col-md-12">
                        <div id="crop-select"></div>
                        <input type="hidden" id="urlImage" class="hidden" value="">
                    </div>

                </div>
                <div class="row">
                    <div class="col-xs-12 col-md-6">
                        <button type="button" id="frm_btnCancel"
                                class="btn btn-default smallbtn pull-right">
                            <span class="fas fa-crop-alt"></span> Crop
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#crop-select').CropSelectJs({
            imageSrc: "",
            selectionResize: function(data) {
                console.log(data);
            },
        });
        var width = 400;
        var height = 200;
        $('#crop-select').CropSelectJs('setSelectionAspectRatio', width / height);
        $('#crop-select').on('crop-select-js.selection.resize', function(payload) {
            console.log(payload);
        });
    });
</script>