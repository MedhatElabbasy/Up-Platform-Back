<div id="header"
class="mdk-header js-mdk-header m-0"
data-fixed>
<div class="mdk-header__content">

   <div class="navbar navbar-expand-sm navbar-main navbar-light bg-light  pr-0"
        id="navbar"
        data-primary>
       <div class="container-fluid p-0">

           <!-- Navbar toggler -->

           <button class="navbar-toggler navbar-toggler-custom navbar-toggler-right d-block"
                   type="button"
                   data-toggle="sidebar">
               <span class="material-icons">apps</span>
           </button>

           <!-- Navbar Brand -->
           <a href="{{route('dashboard.home')}}"
              class="navbar-brand ">
              <img class="navbar-brand-icon"
              src="{{url('dashboard-assets')}}/images/logo.png"
              width="25"
              alt="Up-Platform">
              
            <span>Up-Platform</span>
           </a>

           @include('layouts.dashboard.navbar')

           <!--
           <ul class="nav navbar-nav ml-auto d-none d-md-flex">
               <li class="nav-item dropdown">
                   <a href="#notifications_menu"
                      class="nav-link dropdown-toggle"
                      data-toggle="dropdown"
                      data-caret="false">
                       <i class="material-icons nav-icon navbar-notifications-indicator">notifications</i>
                   </a>
                   <div id="notifications_menu"
                        class="dropdown-menu dropdown-menu-right navbar-notifications-menu">
                       <div class="dropdown-item d-flex align-items-center py-2">
                           <span class="flex navbar-notifications-menu__title m-0">Notifications</span>
                           <a href="javascript:void(0)"
                              class="text-muted"><small>Clear all</small></a>
                       </div>
                       <div class="navbar-notifications-menu__content"
                            data-perfect-scrollbar>
                           <div class="py-2">

                               <div class="dropdown-item d-flex">
                                   <div class="mr-3">
                                       <div class="avatar avatar-sm"
                                            style="width: 32px; height: 32px;">
                                           <img src="assets/images/256_daniel-gaffey-1060698-unsplash.jpg"
                                                alt="Avatar"
                                                class="avatar-img rounded-circle">
                                       </div>
                                   </div>
                                   <div class="flex">
                                       <a href="">A.Demian</a> left a comment on <a href="">FlowDash</a><br>
                                       <small class="text-muted">1 minute ago</small>
                                   </div>
                               </div>
                               <div class="dropdown-item d-flex">
                                   <div class="mr-3">
                                       <a href="#">
                                           <div class="avatar avatar-xs"
                                                style="width: 32px; height: 32px;">
                                               <span class="avatar-title bg-purple rounded-circle"><i class="material-icons icon-16pt">person_add</i></span>
                                           </div>
                                       </a>
                                   </div>
                                   <div class="flex">
                                       New user <a href="#">Peter Parker</a> signed up.<br>
                                       <small class="text-muted">1 hour ago</small>
                                   </div>
                               </div>
                               <div class="dropdown-item d-flex">
                                   <div class="mr-3">
                                       <a href="#">
                                           <div class="avatar avatar-xs"
                                                style="width: 32px; height: 32px;">
                                               <span class="avatar-title rounded-circle">JD</span>
                                           </div>
                                       </a>
                                   </div>
                                   <div class="flex">
                                       <a href="#">Big Joe</a> <small class="text-muted">wrote:</small><br>
                                       <div>Hey, how are you? What about our next meeting</div>
                                       <small class="text-muted">2 minutes ago</small>
                                   </div>
                               </div>

                               <div class="dropdown-item d-flex">
                                   <div class="mr-3">
                                       <div class="avatar avatar-sm"
                                            style="width: 32px; height: 32px;">
                                           <img src="assets/images/256_daniel-gaffey-1060698-unsplash.jpg"
                                                alt="Avatar"
                                                class="avatar-img rounded-circle">
                                       </div>
                                   </div>
                                   <div class="flex">
                                       <a href="">A.Demian</a> left a comment on <a href="">FlowDash</a><br>
                                       <small class="text-muted">1 minute ago</small>
                                   </div>
                               </div>
                               <div class="dropdown-item d-flex">
                                   <div class="mr-3">
                                       <a href="#">
                                           <div class="avatar avatar-xs"
                                                style="width: 32px; height: 32px;">
                                               <span class="avatar-title bg-purple rounded-circle"><i class="material-icons icon-16pt">person_add</i></span>
                                           </div>
                                       </a>
                                   </div>
                                   <div class="flex">
                                       New user <a href="#">Peter Parker</a> signed up.<br>
                                       <small class="text-muted">1 hour ago</small>
                                   </div>
                               </div>
                               <div class="dropdown-item d-flex">
                                   <div class="mr-3">
                                       <a href="#">
                                           <div class="avatar avatar-xs"
                                                style="width: 32px; height: 32px;">
                                               <span class="avatar-title rounded-circle">JD</span>
                                           </div>
                                       </a>
                                   </div>
                                   <div class="flex">
                                       <a href="#">Big Joe</a> <small class="text-muted">wrote:</small><br>
                                       <div>Hey, how are you? What about our next meeting</div>
                                       <small class="text-muted">2 minutes ago</small>
                                   </div>
                               </div>

                               <div class="dropdown-item d-flex">
                                   <div class="mr-3">
                                       <div class="avatar avatar-sm"
                                            style="width: 32px; height: 32px;">
                                           <img src="assets/images/256_daniel-gaffey-1060698-unsplash.jpg"
                                                alt="Avatar"
                                                class="avatar-img rounded-circle">
                                       </div>
                                   </div>
                                   <div class="flex">
                                       <a href="">A.Demian</a> left a comment on <a href="">FlowDash</a><br>
                                       <small class="text-muted">1 minute ago</small>
                                   </div>
                               </div>
                               <div class="dropdown-item d-flex">
                                   <div class="mr-3">
                                       <a href="#">
                                           <div class="avatar avatar-xs"
                                                style="width: 32px; height: 32px;">
                                               <span class="avatar-title bg-purple rounded-circle"><i class="material-icons icon-16pt">person_add</i></span>
                                           </div>
                                       </a>
                                   </div>
                                   <div class="flex">
                                       New user <a href="#">Peter Parker</a> signed up.<br>
                                       <small class="text-muted">1 hour ago</small>
                                   </div>
                               </div>
                               <div class="dropdown-item d-flex">
                                   <div class="mr-3">
                                       <a href="#">
                                           <div class="avatar avatar-xs"
                                                style="width: 32px; height: 32px;">
                                               <span class="avatar-title rounded-circle">JD</span>
                                           </div>
                                       </a>
                                   </div>
                                   <div class="flex">
                                       <a href="#">Big Joe</a> <small class="text-muted">wrote:</small><br>
                                       <div>Hey, how are you? What about our next meeting</div>
                                       <small class="text-muted">2 minutes ago</small>
                                   </div>
                               </div>

                           </div>
                       </div>
                       <a href="javascript:void(0);"
                          class="dropdown-item text-center navbar-notifications-menu__footer">View All</a>
                   </div>
               </li>
           </ul>
            -->

           <ul class="nav navbar-nav d-none d-sm-flex border-left navbar-height align-items-center">
            <li class="nav-item dropdown">
                <a href="#account_menu"
                   class="nav-link dropdown-toggle"
                   data-toggle="dropdown"
                   data-caret="false">
                   <img src="{{url('dashboard-assets')}}/images/avatar/user.png"
                   class="rounded-circle"
                   width="32"
                   alt="{{ auth()->user()->name }}">
                    <span class="mr-1 d-flex-inline">
                        <span class="text-light">{{ auth()->user()->name }}</span>
                    </span>
                </a>
                <div id="account_menu"
                     class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-item-text dropdown-item-text--lh">
                        <div><strong>{{ auth()->user()->name }}</strong></div>
                    </div>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item active"
                       href="{{route('dashboard.home')}}"><i class="material-icons">dvr</i> لوحة التحكم</a>
                    <a class="dropdown-item"
                       href="{{route('dashboard.profile.index')}}"><i class="material-icons">account_circle</i> حسابك</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item"
                       href="{{ route('dashboard.logout') }}"><i class="material-icons">exit_to_app</i> تسجيل الخروج</a>
                </div>
            </li>
        </ul>

       </div>
   </div>

</div>
</div>
