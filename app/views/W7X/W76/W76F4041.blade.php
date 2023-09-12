<div class="modal fade modal" id="modalW76F4041" data-keyboard="false" data-backdrop="static" role="dialog">
    <div class="modal-dialog" style="width:50%">
        <div class="modal-content">
            <form class="form-horizontal" id="frmW76F4041" method="post" action="">
                <div class="modal-header">
                    {{Helpers::generateHeading($modalTitle,"W76F4041",true,"closePopW76F4041")}}
                </div>
                <div class="modal-body">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12" style="padding-left: 9px !important;padding-right: 9px !important;"
                                 id="sliderW76F4041">
                                <div id="containerW76F4041" class="jp-video" role="application"
                                     aria-label="media player">
                                    <div class="jp-type-playlist">
                                        <div id="jpW76F4041" class="jp-jplayer"></div>
                                        <div class="jp-gui">
                                            <div class="jp-video-play">
                                                <button class="jp-video-play-icon" role="button" tabindex="0">play
                                                </button>
                                            </div>
                                            <div class="jp-interface">
                                                <div class="jp-progress">
                                                    <div class="jp-seek-bar">
                                                        <div class="jp-play-bar"></div>
                                                    </div>
                                                </div>
                                                <div class="jp-current-time" role="timer" aria-label="time">&nbsp;</div>
                                                <div class="jp-duration" role="timer" aria-label="duration">&nbsp;</div>
                                                <div class="jp-controls-holder">
                                                    <div class="jp-controls">
                                                        <button class="jp-previous" role="button" tabindex="0">
                                                            previous
                                                        </button>
                                                        <button class="jp-play" role="button" tabindex="0">play</button>
                                                        <button class="jp-next" role="button" tabindex="0">next</button>
                                                        <button class="jp-stop" role="button" tabindex="0">stop</button>
                                                    </div>
                                                    <div class="jp-volume-controls">
                                                        <button class="jp-mute" role="button" tabindex="0">mute</button>
                                                        <button class="jp-volume-max" role="button" tabindex="0">max
                                                            volume
                                                        </button>
                                                        <div class="jp-volume-bar">
                                                            <div class="jp-volume-bar-value"></div>
                                                        </div>
                                                    </div>
                                                    <div class="jp-toggles">
                                                        <button class="jp-repeat" role="button" tabindex="0">repeat
                                                        </button>
                                                        <button class="jp-shuffle" role="button" tabindex="0">shuffle
                                                        </button>
                                                        <button class="jp-full-screen" role="button" tabindex="0">full
                                                            screen
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="jp-details">
                                                    <div class="jp-title" aria-label="title">&nbsp;</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="jp-playlist">
                                            <ul>
                                                <!-- The method Playlist.displayPlaylist() uses this unordered list -->
                                                <li>&nbsp;</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        var myPlaylist = new jPlayerPlaylist(
            {
                jPlayer: "#jpW76F4041",
                cssSelectorAncestor: "#containerW76F4041"
            },
            [
                @foreach($rsList as $row)
                <?php
                $path = $row["LocationPath"];
                $path = ($path!=""?$path."/":"");
                $path = str_replace("\\","/","audios/".$path.$row["RemarkU"]);
                $path = str_replace("./","/",$path);
                $path = str_replace(".\\","/",$path);
                $path = str_replace("//","/",$path);
                $path = str_replace("+","%2B",$path);
                $thumb = $row["ThumbNail"];
                if ($thumb == "")
                    $thumb = url("packages/default/plugins/jplayer/equalizer.jpg");
                ?>
                {
                    title: "{{$row["RemarkU"]}}",
                    artist: "",
                    mp3: "{{$path}}",
                    poster: "{{$thumb}}"
                },
                @endforeach
            ]
            ,{
                playlistOptions: {
                    enableRemoveControls: true,
                    autoPlay: true,
                    size: {width:"100%",height:"300px"}
                },
                swfPath: "{{url("packages/default/plugins/jplayer")}}",
                supplied: "mp3",
                useStateClassSkin: true,
                autoBlur: false,
                smoothPlayBar: true,
                keyEnabled: true,
                audioFullScreen: true,
                solution: "html, flash",
                errorAlerts: true,
                warningAlerts: false,
                wmode: "window",
                size: {width:"100%",height:"300px"},
                sizeFull: {width:"100%",height:"300px"}
            });
    });

    $("#modalW76F4041").on('hidden.bs.modal', function () {
        $(this).data('bs.modal', null);
    });

    function closePopW76F4041() {
        $("#modalW76F4041").modal("hide");
        $("#modalW76F4041").html("");
    }

</script>
