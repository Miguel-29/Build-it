<div class="container-fluid">
    <div class="d-flex">
       <a class="header-brand" href="{{URL::to('/home')}}">
       <!--<img alt="vobilet logo" class="header-brand-img" src="{{ URL::asset('assets/admin/images/imagenes/logo-built-it.png') }}">-->
       <img alt="vobilet logo" class="header-brand-img" src="{{ URL::asset('assets/admin/images/brand/logo.png') }}">
        </a>
       <a aria-label="Hide Sidebar" class="app-sidebar__toggle" data-toggle="sidebar" href="#"></a>

       <div class="d-flex order-lg-2 ml-auto">
          <div class="dropdown d-none d-md-flex">
             <a class="nav-link icon" data-toggle="dropdown">
             <i class="fa fa-user-o"></i> 
             <span class="nav-unread bg-green"></span>
             </a>
             <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                <a class="dropdown-item d-flex pb-3" href="#">
                   <span class="avatar brround mr-3 align-self-center" style="background-image: url({{ URL::asset('assets/admin/images/faces/male/4.jpg') }}"></span>
                   <div>
                      <strong>Madeleine Scott</strong> Sent you add request
                      <div class="small text-muted">
                         view profile
                      </div>
                   </div>
                </a>
                <a class="dropdown-item d-flex pb-3" href="#">
                   <span class="avatar brround mr-3 align-self-center" style="background-image: url({{ URL::asset('assets/admin/images/faces/female/14.jpg') }}"></span>
                   <div>
                      <strong>rebica</strong> Suggestions for you
                      <div class="small text-muted">
                         view profile
                      </div>
                   </div>
                </a>
                <a class="dropdown-item d-flex pb-3" href="#">
                   <span class="avatar brround mr-3 align-self-center" style="background-image: url({{ URL::asset('assets/admin/images/faces/male/1.jpg') }}"></span>
                   <div>
                      <strong>Devid robott</strong> sent you add request
                      <div class="small text-muted">
                         view profile
                      </div>
                   </div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item text-center text-muted-dark" href="#">View all contact list</a>
             </div>
          </div>
          <div class="dropdown d-none d-md-flex">
             <a class="nav-link icon" data-toggle="dropdown">
             <i class="fa fa-bell-o"></i> 
             <span class="nav-unread bg-danger"></span>
             </a>
             <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                <a class="dropdown-item d-flex pb-3" href="#">
                   <div class="notifyimg">
                      <i class="fa fa-thumbs-o-up"></i>
                   </div>
                   <div>
                      <strong>Someone likes our posts.</strong>
                      <div class="small text-muted">
                         3 hours ago
                      </div>
                   </div>
                </a>
                <a class="dropdown-item d-flex pb-3" href="#">
                   <div class="notifyimg">
                      <i class="fa fa-commenting-o"></i>
                   </div>
                   <div>
                      <strong>3 New Comments</strong>
                      <div class="small text-muted">
                         5 hour ago
                      </div>
                   </div>
                </a>
                <a class="dropdown-item d-flex pb-3" href="#">
                   <div class="notifyimg">
                      <i class="fa fa-cogs"></i>
                   </div>
                   <div>
                      <strong>Server Rebooted.</strong>
                      <div class="small text-muted">
                         45 mintues ago
                      </div>
                   </div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item text-center text-muted-dark" href="#">View all Notification</a>
             </div>
          </div>
          <div class="dropdown d-none d-md-flex">
             <a class="nav-link icon" data-toggle="dropdown"><i class="fa fa-envelope-o"></i> <span class=" nav-unread badge badge-info badge-pill">2</span></a>
             <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                <a class="dropdown-item text-center text-dark" href="#">2 New Messages</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item d-flex pb-3" href="#">
                   <span class="avatar brround mr-3 align-self-center" style="background-image: url({{ URL::asset('assets/admin/images/faces/male/41.jpg') }}"></span>
                   <div>
                      <strong>Madeleine</strong> Hey! there I' am available....
                      <div class="small text-muted">
                         3 hours ago
                      </div>
                   </div>
                </a>
                <a class="dropdown-item d-flex pb-3" href="#">
                   <span class="avatar brround mr-3 align-self-center" style="background-image: url({{ URL::asset('assets/admin/images/faces/female/1.jpg') }}"></span>
                   <div>
                      <strong>Anthony</strong> New product Launching...
                      <div class="small text-muted">
                         5 hour ago
                      </div>
                   </div>
                </a>
                <a class="dropdown-item d-flex pb-3" href="#">
                   <span class="avatar brround mr-3 align-self-center" style="background-image: url({{ URL::asset('assets/admin/images/faces/female/18.jpg') }}"></span>
                   <div>
                      <strong>Olivia</strong> New Schedule Realease......
                      <div class="small text-muted">
                         45 mintues ago
                      </div>
                   </div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item text-center text-muted-dark" href="#">See all Messages</a>
             </div>
          </div>
          <div class="dropdown">
             <a class="nav-link pr-0 leading-none d-flex" data-toggle="dropdown" href="#">
             <span class="avatar avatar-md brround" style="background-image: url({{ URL::asset('assets/admin/images/user-2.png') }})"></span> 
             <span class="ml-2 d-none d-lg-block">
             <span class="text-white">
                @if(Auth::user() !== null) 
                    {{Auth::user()->name}}
                @endif
            </span>
             </span>
             </a>
             <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                <!--<a class="dropdown-item" href="#"><i class="dropdown-icon mdi mdi-account-outline"></i> Profile</a>
                <a class="dropdown-item" href="#"><i class="dropdown-icon mdi mdi-settings"></i> Settings</a> 
                <a class="dropdown-item" href="#"><span class="float-right"><span class="badge badge-primary">6</span></span> <i class="dropdown-icon mdi mdi-message-outline"></i> Inbox</a> 
                <a class="dropdown-item" href="#"><i class="dropdown-icon mdi mdi-comment-check-outline"></i> Message</a>-->
                <div class="dropdown-divider"></div>
                <!--<a class="dropdown-item" href="#"><i class="dropdown-icon mdi mdi-compass-outline"></i> Need help?</a> -->
                <a class="dropdown-item" href="{{ URL::to('/logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                    class="dropdown-icon mdi mdi-logout-variant"></i>Salir</a>
                <form id="logout-form" action="{{ URL::to('/logout') }}"
                method="POST" style="display: none;">
                @csrf
                </form>
            </div>
          </div>
       </div>
    </div>
 </div>