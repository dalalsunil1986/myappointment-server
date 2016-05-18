<nav class="navbar-default navbar-static-top" role="navigation">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <h1> <a class="navbar-brand" href="/admin">MyAppointment</a></h1>
    </div>
    <div class=" border-bottom">
        {{--<div class="full-left">--}}
            {{--<section class="full-top">--}}
                {{--<button id="toggle"><i class="fa fa-arrows-alt"></i></button>--}}
            {{--</section>--}}
            {{--<form class=" navbar-left-right">--}}
                {{--<input type="text"  value="Search..." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search...';}">--}}
                {{--<input type="submit" value="" class="fa fa-search">--}}
            {{--</form>--}}
            {{--<div class="clearfix"> </div>--}}
        {{--</div>--}}

        <!-- Brand and toggle get grouped for better mobile display -->

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="drop-men" style="padding-top: 20px">
            <ul class=" nav_1" style="padding-left: 20px">

                {{--<li class="dropdown at-drop">--}}
                    {{--<a href="#" class="dropdown-toggle dropdown-at " data-toggle="dropdown"><i class="fa fa-globe"></i> <span class="number">5</span></a>--}}
                    {{--<ul class="dropdown-menu menu1 " role="menu">--}}
                        {{--<li>--}}
                            {{--<a href="#">--}}
                                {{--<div class="user-new">--}}
                                    {{--<p>New user registered</p>--}}
                                    {{--<span>40 seconds ago</span>--}}
                                {{--</div>--}}
                                {{--<div class="user-new-left">--}}
                                    {{--<i class="fa fa-user-plus"></i>--}}
                                {{--</div>--}}
                                {{--<div class="clearfix"> </div>--}}
                            {{--</a></li>--}}

                        {{--<li>--}}
                            {{--<a href="#" class="view">View all messages</a>--}}
                        {{--</li>--}}
                    {{--</ul>--}}
                {{--</li>--}}
                <li class="dropdown" style="padding-left:60px">
                    <a href="#" class="dropdown-toggle dropdown-at" data-toggle="dropdown"><span class=" name-caret">{{ auth()->user()->name_en }}<i class="caret"></i></span><span class="" style="height:100px;margin:20px">&nbsp;</span></a>
                    <ul class="dropdown-menu " role="menu">
                        <li><a href="/logout"><i class="fa fa-sign-out"></i>Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
        <div class="clearfix"></div>

        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">

                    <li>
                        <a href="/admin" class=" hvr-bounce-to-right"><i class="fa fa-dashboard nav_icon "></i><span class="nav-label">Dashboards</span> </a>
                    </li>

                    <li>
                        <a href="{{ action('Admin\CompanyController@index') }}" class=" hvr-bounce-to-right">
                            <i class="fa fa-picture-o nav_icon"></i>
                            <span class="nav-label">Companies</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ action('Admin\ServiceController@index') }}" class=" hvr-bounce-to-right">
                            <i class="fa fa-picture-o nav_icon"></i>
                            <span class="nav-label">Services</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ action('Admin\UserController@index') }}" class=" hvr-bounce-to-right">
                            <i class="fa fa-picture-o nav_icon"></i>
                            <span class="nav-label">Users</span>
                        </a>
                    </li>

                    {{--<li>--}}
                        {{--<a href="#" class=" hvr-bounce-to-right"><i class="fa fa-desktop nav_icon"></i> <span class="nav-label">Pages</span><span class="fa arrow"></span></a>--}}
                        {{--<ul class="nav nav-second-level">--}}
                            {{--<li><a href="404.html" class=" hvr-bounce-to-right"> <i class="fa fa-info-circle nav_icon"></i>Error 404</a></li>--}}
                            {{--<li><a href="faq.html" class=" hvr-bounce-to-right"><i class="fa fa-question-circle nav_icon"></i>FAQ</a></li>--}}
                            {{--<li><a href="blank.html" class=" hvr-bounce-to-right"><i class="fa fa-file-o nav_icon"></i>Blank</a></li>--}}
                        {{--</ul>--}}
                    {{--</li>--}}
                </ul>
            </div>
        </div>
    </div>
</nav>