<div class="modal fade" id="modalW09F1020" data-backdrop="static" role="dialog">
    <div class="modal-dialog formduyet">
        <div class="modal-content">
            <div class="modal-header logodg pdl0">
                {{Helpers::generateHeading($titleW09F1020,"W09F1020",true,"")}}
            </div>
            <div class="modal-body" style="padding: 10px">
                <div>
                    <div class = "form-group" style="background-color: #edf4f9; border: 1px solid #aed0ea; border-radius: 5px; overflow: hidden">
                        <div class = "col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            <div class = "row mgt5">
                                <div class="col-md-3 col-xs-3">
                                    <label class="lbl-normal liketext">{{Helpers::getRS($g,'Co_cau_to_chuc')}}</label>
                                </div>
                                <div class="col-md-8 col-xs-8">
                                    <div id="slOrgChartIDW09F1020" style="height: 26px"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            <div class = "row">
                                <div id="toolbarW09F1020"></div>
                            </div>
                        </div>

                    </div>
                    <div id="chart-container" style="text-align: center; overflow: auto;"></div>
                </div>
            </div>
        </div>
    </div>
</div>


<style type="text/css">
    #chart-container {
        background-color: #fff;
        border: 1px solid #aed0ea;
        border-radius: 5px;
    }
    .orgchart { background: #fff; }
    #toolbarW09F1020 .toolbar-menu{
        border: 0px !important;
        display: block;
        text-align: right;
    }
</style>


<script type="text/javascript">
    var datasource = {{json_encode($result)}};
    var dataCombo = {{json_encode($cbOrgChart)}};

    console.log(datasource);
    
    $(document).ready(function () {
        $("#chart-container").height($(document).height() - 200);
        $("#chart-container").width($(document).width() - 35);
        setTimeout(function(){
            /*$("#modalW09F1020").find("#chart-container").mCustomScrollbar({
                //axis: "y",
                scrollButtons: {enable: true},
                theme: "minimal-dark",
                scrollbarPosition: "outside",
                scrollInertia: 50,
                setWidth: 250
            });*/

        },3000);

        $('#slOrgChartIDW09F1020').dxDropDownBox()
            .dxDropDownBoxTreeLoad({
                sValueMember: "OrgChartID",
                sDisplayMember: "OrgName",
                dataSource: dataCombo
            })
            .dxDropDownBoxTreeTemplateSingleSelect("OrgChartParentID");

        $("#slOrgChartIDW09F1020").dxDropDownBox("instance")
            .on('valueChanged', function (e) {
                var value = "";
                if(e.value != null){
                    value = e.value[0];
                }
                console.log(value);
                reloadOrgChartW09F1020(value);
            });
        
        $("#toolbarW09F1020").digiMenu({
                showText: true,
                buttonList: [
                    {
                        ID: "btnShowFormW09F1020",
                        icon: "fa fa-gear text-yellow",
                        title: "Thiết lập sơ đồ tổ chức",
                        enable: true,
                        hidden: false,
                        type: "button",
                        render: function (ui) {
                        },
                        postRender: function (ui) {
                            ui.$btn.click(function () {
                                showFormDialogPost('{{url("/W09F1021/$pForm/$g")}}', "modalW09F1021",
                                    {

                                    },null);
                            });
                        }
                    },  {
                        ID: "btnRefreshW09F1020",
                        icon: "fa fa-refresh text-blue",
                        title: "Refresh",
                        enable: function () {
                            return true;
                        },
                        hidden: false,
                        type: "button",
                        render: function (ui) {
                        },
                        postRender: function (ui) {
                            ui.$btn.click(function () {
                                //$('#slOrgChartIDW09F1020').val('');
                                //alert('sdsd');
                                oc.init({ 'data': datasource });
                            });
                        }
                    }
                    ,  {
                        ID: "btnExpImageW09F1020",
                        icon: "fa fa-file-image-o text-red",
                        title: "Xuất ảnh",
                        enable: function () {
                            return true;
                        },
                        hidden: false,
                        type: "button",
                        render: function (ui) {
                        },
                        postRender: function (ui) {
                            ui.$btn.click(function () {
                                oc.init({ 'data': [] });//dổ DL rỗng để gán lại DL mới nhằm load  lại lưới
                                setTimeout(function () {
                                    oc.init({ 'data': datasource });
                                }, 1);
                                setTimeout(function () {
                                    $('.oc-export-btn').trigger('click');
                                }, 5);
                            });
                        }
                    }

                ]
            }
        );
    });

    var nodeTemplate = function(data) {
        var dataLink = "{{asset('packages/default/L3/images/icon-user-default.png')}}";
        if(data.ImageID != 'data:image/jpeg;base64,'){
            dataLink = data.ImageID;
        }
        var str = '<div class="title" style = "background-color: '+ data.className +'">'+data.EmployeeName+'</div>';
        str += '<div class="content" style="height: auto; text-align: left; width: auto; border-color: '+ data.className + '">';
        str += '<div class="row">';
        str += '<div class="col-md-4 col-xs-4">';
        str += '<div><img style = "height: 70px; width: 60px;" src="'+ dataLink +'" /></div>';
        str += '</div>';
        str += '<div class="col-md-8 col-xs-8">';
        str += '<div class="text-bold">'+ data.OrgName +'</div>';
        str += '<div>'+ data.DutyName +'</div>';
        str += '<div>ID: '+ data.EmployeeID +'</div>';
        str += '</div>';
        str += '</div>';
        str += '</div>';
        return str;
    };

    var oc = $('#chart-container').orgchart({
        'data' : datasource,
        'nodeTemplate': nodeTemplate,
        'exportButton': true,
        'exportFilename': 'OrgChart',
        'createNode': function($node, data) {
            $node.click(function () {
                console.log(data);
            });
        }
        //'exportFileextension': 'pdf',
        //'pan': true,
        //'zoom': true,
        //'toggleSiblingsResp': true
    });

    function hello() {
        //console.log(data);
    }

    function reloadOrgChartW09F1020(OrgChartID) {
        $.ajax({
            method: "POST",
            url: '{{url("/W09F1020/$pForm/$g/reloadCBOrgChartID")}}',
            data: {OrgChartID: OrgChartID},
            success: function (data) {
                //console.log(data);
                datasource = data;
                oc.init({ 'data': datasource });
            }
        });
    }
</script>