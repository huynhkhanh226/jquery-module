<header class="main-header">
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" onclick="callScrollMainMenu();" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" id="mnuChangeDivision"
                       onclick="showFormDialog('{{asset("changedivision")}}','mcChangeDivision')">
                        <b style="background-color: white;padding: 5px;color: black;">{{Session::get("W91P0000")['DivisionID']}}</b>
                        <b style="background-color: lightgrey;padding: 5px;color: black; margin-left: -3px; ">{{Session::get("W91P0000")['TranMonth']}}
                            /{{Session::get("W91P0000")['TranYear']}}</b>
                    </a>
                </li>
                <li class="dropdown notifications-menu no-menu-alert">
                    <a class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        @if($countAlert)
                            <span class="label label-warning">
                                         {{$countAlert}}
                                      </span>
                        @endif
                    </a>
                    @if($countAlert)
                        <ul class="dropdown-menu" style="width: 330px">
                            {{--<li class="header">B?n có {{$countAlert}} thông báo </li>--}}
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu">
                                    @foreach($rData as $r)
                                        <li>
                                            <?php
                                            $params = isset($r["Param"]) == true ? $r["Param"] : "";
                                            ?>

                                            @if ($r['FormActive'] == $r['FormCall'])
                                                @if ($r['FormActive'] == 'W75F4070')
                                                    <a onclick="showFormDialogPost('{{url( $r['FormCall'] . "/" . $r['FormPermission'] . "/" . $r['ModuleGroup'])}}','modal{{$r['FormCall']}}','{{$params}}',2)">
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
                    @endif
                </li>
                <li class="dropdown notifications-menu">
                    <a class="dropdown-toggle" data-toggle="dropdown"><span class="menu-bookmark"></span></a>
                    <ul class="dropdown-menu">
                        <li>
                            <ul class="menu" id="ulListBookmark">
                                {{str_replace("hide","",str_replace("item-book","",$ls1))}}
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        @if(Auth::user()->user()->Avatar()['EmployeePicture']!="")
                            <img src="{{"data:image/jpeg;base64,". base64_encode(pack('H'.strlen(Auth::user()->user()->Avatar()['EmployeePicture']), Auth::user()->user()->Avatar()['EmployeePicture']))}}"
                                 class="user-image" alt="User Image"/>

                        @else
                            <i class="fa fa-user"></i>
                        @endif
                        <span class="hidden-xs">{{Auth::user()->user()->UserID}}</span>
                    </a>
                    <ul class="dropdown-menu" style="width: 330px ">
                        <li class="user-body">
                            @if (Config::get('services.showModule.W76') == true)
                                <div class="col-md-12 ">
                                    <a onclick="addTab('D76F0000_W76F0000_W76F0000','eOffice',4)">
                                        <i class="digi digi-D76 text-yellow"></i>eOffice

                                    </a>
                                </div>
                            @endif

                        <!--Sefl service sẽ đổi thành Employee Self service và Manager Self Service theo Incident
                              Incident: 96985
                              Employee Self Service : Hiển thị theo thiết lập admin page
                              Manager Self Service : Hiển thị theo phân quyền store
                             -->
                            @if (Config::get('services.showModule.W75') == true)
                                <div class="col-md-12 ">
                                    <a id="idEss"
                                       onclick="addTab('D75F0000_W75F0000_W75F0000','Employee Self Service',4)">
                                        <i class="fa fa-user  text-yellow"></i>Employee Self Service

                                    </a>
                                </div>
                            @endif
                            <?php
                            $temList = $connectionLMS->select("EXEC W00P1011 '" . Helpers::decrypt_userpass(Session::get("CONDEFAULT")["database"]) . "','" . Auth::user()->user()->UserID . "','%','" . Session::get('Lang') . "','" . Helpers::decrypt_userpass(Config::get('database.connections.sqlsrvHR.database')) . "'");
                            $menuMSS = array_filter($temList, function ($row) {
                                return $row["ModuleGroupID"] == "MSS";
                            });
                            ?>

                            @if (count($menuMSS) > 0 && Config::get('services.showModule.W75') == true)
                                <div class="col-md-12 ">
                                    <a onclick="addTab('D75F0001_W75F0001_W75F0001','Manager Self Service',4)">
                                        <i class="digi digi-D75  text-yellow"></i>Manager Self Service

                                    </a>
                                </div>
                            @endif
                            <div class="col-md-12 ">
                                <a onclick="showFormDialog('{{asset("W00F0253/changepass")}}/{{Auth::user()->user()->UserID}}','modalW00F0253')">
                                    <i class="fa fa-key text-yellow"></i>{{Helpers::getRS($g,'Doi_mat_khauU')}}
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{url("logout")}}" class="mg0 pd0 mgt10"><i class="glyphicon glyphicon-log-out fa-2x"></i></a>
                </li>
            </ul>
            <!-- mini logo for sidebar mini 50x50 pixels -->
        {{--<img src="{{asset("packages/default/L3/companylogo.gif")}}" >--}}
        <!-- logo for regular state and mobile devices -->
            {{--<div class="nlogo">--}}
            {{--<img src="{{asset("packages/default/L3/images/companylogo-large.png")}}"--}}
            {{--class="bgWhite pull-right"--}}
            {{--style="padding: 0px 10px; margin-top: 5px; padding-top: 5px; height: 40px">--}}
            {{--</div>--}}
        </div>
        <a style="cursor: default" class="logo bgnone">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini">{{mb_strtoupper(Session::get("W91P0000")['CompanyName'],"utf-8")}}</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg">{{mb_strtoupper(Session::get("W91P0000")['CompanyName'],"utf-8")}}</span>
        </a>
    </nav>
</header>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar" style="padding-bottom: 0px">
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
        @if(Auth::user()->check())
            <!-- <li class="header"></li>-->
                @foreach(Helpers::LeftMenu($connectionLMS->select("EXEC W00P1010 '". Helpers::decrypt_userpass(Session::get("CONDEFAULT")["database"])."', '".Auth::user()->user()->UserID."', '%', '". Session::get('Lang') ."', '".Helpers::decrypt_userpass(Config::get('database.connections.sqlsrvHR.database'))."','', 0, 'D', ".intval(Config::get('database.LWProduct','0'))),'ModuleName','ModuleIcon','FormID','Permission') as $row)
                    @if(count($row)==0)
                        <li><a href="#"><i class="fa {{$row[0]}} text-aqua"></i> <span>{{$row[1]}}</span></a></li>
                    @else
                        <li class="treeview">
                            <a href="#">
                                <i class="{{$row[0]=="" ? "fa fa-th" : $row[0] }} text-aqua"></i>
                                <span>{{$row[1]}}</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                @for($i=2;$i<count($row); $i++)
                                    <li>
                                        @if ($row[$i]['FormActive']=="W94F3000" && (\Config::get("birt.BIRTCallingMode") == "VT" || \Config::get("birt.BIRTCallingMode") == "RT"))
                                            <i class="{{$row[$i]['ScreenTypeIcon']!="" ? $row[$i]['ScreenTypeIcon'] : 'icon icon-detective1' }} text-yellow"></i>
                                            <a href="{{url("W94F3000/".$row[$i]['FormID']."/".$row[$i]['ModuleGroup'])}}"
                                               target="_blank"> {{$row[$i]['FormDesc']}}
                                            </a>
                                        @elseif($row[$i]['IsTab']==1)
                                            <i class="{{$row[$i]['ScreenTypeIcon']!="" ? $row[$i]['ScreenTypeIcon'] : 'icon icon-detective1' }} text-yellow"></i>
                                            <a class="menuitem" modulegroup="{{$row[$i]['ModuleGroup']}}"
                                               formid="{{$row[$i]['FormID']}}" formactive="{{$row[$i]['FormActive']}}"
                                               formcall="{{$row[$i]['FormCall']}}"> {{$row[$i]['FormDesc']}}
                                            </a>
                                        @else
                                            @if ($row[$i]['FormActive'] == $row[$i]['FormCall'])
                                                <i class="{{$row[$i]['ScreenTypeIcon']!="" ? $row[$i]['ScreenTypeIcon'] : 'icon icon-detective1' }} text-yellow"></i>
                                                <a onclick="showFormDialog('{{asset( $row[$i]['FormCall'] . "/" . $row[$i]['FormID'] . "/" .  $row[$i]['ModuleGroup'])}}','modal{{$row[$i]['FormCall']}}')"> {{$row[$i]['FormDesc']}}
                                                </a>
                                            @else
                                                <i class="{{$row[$i]['ScreenTypeIcon']!="" ? $row[$i]['ScreenTypeIcon'] : 'icon icon-detective1' }} text-yellow"></i>
                                                <a onclick="showFormDialog('{{asset( $row[$i]['FormActive'] . "/" . $row[$i]['FormID']. "/" . $row[$i]['FormCall'] . "/" .  $row[$i]['ModuleGroup'].'/'.$row[$i]['ModuleID'])}}','modalW84F2020')"> {{$row[$i]['FormDesc']}}
                                                </a>
                                            @endif
                                        @endif

                                    </li>

                                @endfor
                                @if (\Config::get("app.debug") == true)
                                    <li class="hide">
                                        <i class="glyphicon glyphicon-list-alt text-yellow"></i>
                                        <a class="menuitem" modulegroup="0" formid="D94F1000" formactive="W94F9999"
                                           formcall="W94F9999">Danh mục chung a

                                    </li>

                                    <li class="">
                                        <i class="glyphicon glyphicon-list-alt text-yellow"></i>
                                        <a class="menuitem" modulegroup="0" formid="W76F1555" formactive="W76F1555"
                                           formcall="D94F1000"> Danh mục chung
                                        </a>

                                    </li>
                                @endif

                            </ul>
                        </li>
                    @endif
                @endforeach

            @endif
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
{{--@include('layout.component.changedivision')--}}

