<header class="main-header">

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

                <li class="dropdown notifications-menu">
                    {{--<a class="dropdown-toggle" data-toggle="dropdown">--}}
                    {{--<i class="fa fa-bell-o"></i>--}}
                    {{--@if($countAlert)--}}
                    {{--<span class="label label-warning">--}}
                    {{--{{$countAlert}}--}}
                    {{--</span>--}}
                    {{--@endif--}}
                    {{--</a>--}}
                    {{--@if($countAlert)--}}
                    {{--<ul class="dropdown-menu">--}}
                    {{--<li class="header">B?n c� {{$countAlert}} th�ng b�o </li>--}}
                    {{--<li>--}}
                    {{--<!-- inner menu: contains the actual data -->--}}
                    {{--<ul class="menu">--}}
                    {{--@foreach($rData as $r)--}}
                    {{--<li>--}}
                    {{--<a onclick="showFormDialog('{{asset( $r['FormCall'] . "/" . $r['FormPermission'] . "/" . $r['ModuleGroup'])}}','modal{{$r['FormCall']}}')">--}}
                    {{--<i class="fa fa-edit text-yellow"></i> {{$r['DetailLink']}}--}}
                    {{--</a>--}}
                    {{--</li>--}}
                    {{--@endforeach--}}
                    {{--</ul>--}}
                    {{--</li>--}}

                    {{--</ul>--}}
                    {{--@endif--}}
                </li>
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        @if(Auth::ess()->user()->Avatar()['EmployeePicture']!="")

                            <img src="{{"data:image/jpeg;base64,". base64_encode(pack('H'.strlen(Auth::ess()->user()->Avatar()['EmployeePicture']), Auth::ess()->user()->Avatar()['EmployeePicture']))}}"
                                 class="user-image" alt="User Image"/>

                        @else
                            <i class="fa fa-user"></i>
                        @endif
                        <span class="hidden-xs">{{Auth::ess()->user()->UserID}}</span>
                    </a>
                    <ul class="dropdown-menu" style="width: 300px;">

                        <li class="user-body">
                            <div class="col-md-12 ">
                                <a onclick="addTab('D76F0000_W76F0000_W76F0000','eOffice',4);">
                                    <i class="digi digi-D76 text-yellow"></i>eOffice

                                </a>
                            </div>


                            <!--Sefl service sẽ đổi thành Employee Self service và Manager Self Service theo Incident
                              Incident: 96985
                              Employee Self Service : Hiển thị theo thiết lập admin page
                              Manager Self Service : Hiển thị theo phân quyền store
                             -->
                            <div class="col-md-12 ">
                                <a onclick="addTab('D75F0000_W75F0000_W75F0000','Employee Self Service',4)">
                                    <i class="fa fa-user  text-yellow"></i>Employee Self Service

                                </a>
                            </div>
                            <?php
                                $userID = (Auth::user()->check()) ? Auth::user()->user()->UserID :  Auth::ess()->user()->UserID;
                                $perRowCount = count($connectionLMS->select("EXEC W00P1011 '".Helpers::decrypt_userpass(Session::get("CONDEFAULT")["database"])."','".$userID."','%','".Session::get('Lang')."','".Helpers::decrypt_userpass(Config::get('database.connections.sqlsrvHR.database'))."'"));
                                \Debugbar::info($perRowCount);
                            ?>

                            @if ($perRowCount > 0)
                                <div class="col-md-12 ">
                                    <a onclick="addTab('D75F0001_W75F0001_W75F0001','Manager Self Service',4)">
                                        <i class="digi digi-D75  text-yellow"></i>Manager Self Service

                                    </a>
                                </div>
                            @endif


                            <div class="col-md-12 ">
                                <a onclick="showFormDialog('{{asset("W00F0253/changepass")}}/{{Auth::ess()->user()->UserID}}','modalW00F0253')">
                                    <i class="fa fa-key text-yellow"></i>{{Helpers::getRS($g,'Doi_mat_khauU')}}

                                </a>
                            </div>


                        </li>

                    </ul>
                </li>
                <li>
                    <a href="{{url("esslogout")}}" class="mg0 pd0 mgt10"><i
                                class="glyphicon glyphicon-log-out fa-2x"></i></a>
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
    <section class="sidebar">


        <!-- sidebar menu: : style can be found in sidebar.less -->

        <ul class="sidebar-menu">
            @define $userid = (Auth::user()->check()) ? Auth::user()->user()->UserID : Auth::ess()->user()->UserID;
            <li class="header"></li>

            @foreach(Helpers::LeftMenu($connectionLMS->select("EXEC W00P1010 '". Helpers::decrypt_userpass(Session::get("CONDEFAULT")["database"]) ."', '".$userid."', '%', '". Session::get('Lang') ."', '".Helpers::decrypt_userpass(Config::get('database.connections.sqlsrvHR.database'))."','',1"),'ModuleName','ModuleIcon','FormID','Permission') as $row)
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
                                    @if($row[$i]['IsTab']==1)
                                        <a class="menuitem" modulegroup="{{$row[$i]['ModuleGroup']}}"
                                           formid="{{$row[$i]['FormID']}}" formactive="{{$row[$i]['FormActive']}}"
                                           formcall="{{$row[$i]['FormCall']}}"><i id = "animationMenuItem"
                                                    class="{{$row[$i]['ScreenTypeIcon']!="" ? $row[$i]['ScreenTypeIcon'] : 'icon icon-detective1' }} text-yellow"></i> {{$row[$i]['FormDesc']}}
                                        </a>

                                    @else
                                        <a onclick="showFormDialog('{{asset( $row[$i]['FormCall'] . "/" . $row[$i]['FormID'] . "/" .  $row[$i]['ModuleGroup'])}}','modal{{$row[$i]['FormCall']}}')"><i
                                                    id = "animationMenuItem"     class="{{$row[$i]['ScreenTypeIcon']!="" ? $row[$i]['ScreenTypeIcon'] : 'icon icon-detective1' }} text-yellow"></i> {{$row[$i]['FormDesc']}}
                                        </a>
                                    @endif

                                </li>

                            @endfor

                        </ul>
                    </li>
                @endif
            @endforeach

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
<script type="text/javascript">
</script>