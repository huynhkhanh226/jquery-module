@extends('layout.layoutM')
@section('content')
        <div class="row">
            <div class="col-xs-12" style="padding: 0px;">

                <div class="box box-solid">
                    <div class="box-body" style="padding: 10px 0">
                        <ul class="nav nav-pills nav-stacked">
                            @foreach($connectionLMS->select("EXEC W00P1010 '". Helpers::decrypt_userpass(Session::get("CONDEFAULT")["database"])."', '".Auth::user()->user()->UserID."', '%', '". Session::get('Lang') ."', '".Helpers::decrypt_userpass(Config::get('database.connections.sqlsrvHR.database'))."','','0','M'") as $row)
                                <li class="hideshowLogoM"><a href="{{url( $row['FormCall']. "/" . $row['FormID'] .'/' . $row['ModuleGroup'])}}"><i class="fa fa-area-chart text-yellow"></i> {{$row['FormDesc']}} <i class="fa fa-angle-right pull-right"></i></a></li>
                            @endforeach
                        </ul>
                    </div><!-- /.box-body -->
                </div><!-- /. box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
@stop
