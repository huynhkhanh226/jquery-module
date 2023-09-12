<a class="dropdown-toggle" data-toggle="dropdown">
    <i class="fa fa-bell-o"></i>
    @if($countAlert>0)
        <span class="label label-warning">
         {{$countAlert}}
      </span>
    @endif
</a>
<ul class="dropdown-menu">
    {{--<li class="header">Bạn có {{$countAlert}} thông báo </li>--}}
    <li>
        <!-- inner menu: contains the actual data -->
        <ul class="menu">
            @foreach($connection->select("EXEC W84P0010 '".Session::get("W91P0000")['DivisionID']."', ".Session::get("W91P0000")['TranMonth'] . ",". Session::get("W91P0000")['TranYear'] .",'".Auth::user()->user()->UserID."', 1, '". Session::get('Lang')."','', '".Helpers::decrypt_userpass(Session::get("CONDEFAULT")["database"])."', '".Helpers::decrypt_userpass(Config::get('database.connections.sqlsrvHR.database'))."',".intval(Config::get('database.LWProduct','0'))) as $index => $r)
                <li>
                    <?php
                    $params = isset($r["Param"]) == true ? $r["Param"] : "";
                    ?>
                    @if ($r['FormActive'] == $r['FormCall'])
                            @if ($r['FormActive'] == 'W75F4070')
                                <a onclick="showFormDialogPost('{{url( $r['FormCall'] . "/" . $r['FormPermission'] . "/" . $r['ModuleGroup'])}}','modal{{$r['FormCall']}}','{{$params}}', 2)">
                                    <i class="fa fa-edit text-yellow"></i> {{$r['DetailLink']}}
                                </a>
                            @else
                                <a onclick="showFormDialog('{{url( $r['FormCall'] . "/" . $r['FormPermission'] . "/" . $r['ModuleGroup'])}}','modal{{$r['FormCall']}}')">
                                    <i class="fa fa-edit text-yellow"></i> {{$r['DetailLink']}}
                                </a>
                            @endif
                    @else
                            <a onclick="showFormDialog('{{url( $r['FormActive'] . "/" . $r['FormPermission']. "/" . $r['FormCall'] . "/" .  $r['ModuleGroup'].'/'.$r['ModuleID'])}}','modalW84F2020')">
                                <i class="fa fa-edit text-yellow"></i> {{$r['DetailLink']}}
                            </a>
                    @endif
                </li>
            @endforeach
        </ul>
    </li>

</ul>