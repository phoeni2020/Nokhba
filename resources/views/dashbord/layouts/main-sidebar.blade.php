@if($user->role == 'admin')
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar sidebar-scroll">
        <div class="main-sidebar-header active">
            <a class="desktop-logo logo-light" href="{{ url('/' . $page='index') }}">
                <img src="{{URL::asset('assets/img/brand/BeFunky-design.png')}}" class="main-logo" alt="logo">
            </a>
            <a class="desktop-logo logo-dark active" href="{{ url('/admin/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/hat.png')}}" class="main-logo dark-theme" alt="logo"></a>
            <a class="logo-icon mobile-logo icon-light active" href="{{ url('/admin/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/hat.png')}}" class="logo-icon" alt="logo"></a>
            <a class="logo-icon mobile-logo icon-dark active" href="{{ url('/admin/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/hat.png')}}" class="logo-icon dark-theme" alt="logo"></a>
        </div>
        <div class="main-sidemenu">
            <div class="app-sidebar__user clearfix">
                <div class="dropdown user-pro-body">
                    <div class="">
                        <img alt="user-img" class="avatar avatar-xl brround" src="{{URL::asset('assets/img/faces/6.jpg')}}"><span class="avatar-status profile-status bg-green"></span>
                    </div>
                    <div class="user-info">
                        <h4 class="font-weight-semibold mt-3 mb-0">{{auth()->user()->fullName()}}</h4>
                    </div>
                </div>
            </div>
            <ul class="side-menu">
                <li class="slide">
                    <a class="side-menu__item" href="{{ route('admin.catgory.index') }}">
                        <ion-icon class="side-menu__icon fa fa-list-alt"></ion-icon>
                        <span class="side-menu__label">التصنيفات</span>
                    </a>
                </li>
                <li class="slide">
                    <a class="side-menu__item" href="{{ route('admin.course.index') }}">
                        <i class="fas fa-atom side-menu__icon"></i>
                        <span class="side-menu__label">كورسات</span>
                    </a>
                </li>
                <li class="slide">
                    <a class="side-menu__item" href="{{ route('admin.qrcode.index') }}">
                        <i class="fas fa-qrcode side-menu__icon"></i>
                        <span class="side-menu__label">QRCodes</span>
                    </a>
                </li>
                <li class="slide">
                    <a class="side-menu__item" href="{{ route('admin.attach.index') }}">
                        <i class="fas fa-paperclip side-menu__icon"></i>
                        <span class="side-menu__label">المرفقات</span>
                    </a>
                </li>
                <li class="slide">
                    <a class="side-menu__item" href="{{ route('admin.notifications.index') }}">
                        <i class="far fa-bell side-menu__icon "></i>
                        <span class="side-menu__label">اﻻشعارات</span>
                    </a>
                </li>
                <li class="slide">
                    <a class="side-menu__item" href="{{ route('admin.students.index') }}">
                        <i class="fas fa-user-graduate side-menu__icon"></i>
                        <span class="side-menu__label">الطلبه</span>
                    </a>
                </li>
                <li class="slide">
                    <a class="side-menu__item" href="{{ route('admin.exam.index') }}">
                        <i class="fas fa-question side-menu__icon"></i>
                        <span class="side-menu__label">اﻻمتحانات</span>
                    </a>
                </li>
                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" href="#">
                        <i class="fas fa-cogs side-menu__icon"></i>
                        <span class="side-menu__label">اعدادت اﻻستاذ</span><i class="angle fe fe-chevron-down"></i>
                    </a>
                    <ul class="slide-menu">
                        <li>
                            <a class="slide-item" href="{{ route('admin.add.assitant') }}">
                                <i class="fas fa-user-plus"></i>
                                اضافه المساعدين
                            </a>
                        </li>
                        <li>
                            <a class="slide-item" href="{{ route('admin.teachers.settings') }}">
                                <i class="fas fa-cogs side-menu__icon"></i>
                                اعدادت اﻻستاذ
                            </a>
                        </li>
                        <li>
                            <a class="slide-item" href="{{ route('admin.teachers.links.index') }}">
                                <i class="fas fa-link side-menu__icon"></i>
                                طرق الدفع و الروابط
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" href="#">
                        <i class="fas fa-cogs side-menu__icon"></i>
                        <span class="side-menu__label">اعدادت التطبيق</span><i class="angle fe fe-chevron-down"></i>
                    </a>
                    <ul class="slide-menu">
                        <li>
                            <a class="slide-item" href="{{ route('admin.app.developer.settings') }}">
                                <i class="fas fa-tools"></i>
                                اعدادت خاصه بالمطورين
                            </a>
                        </li>
                        <li>
                            <a class="slide-item" href="{{ route('admin.teachers.settings') }}">
                                <i class="fas fa-cogs side-menu__icon"></i>
                                اعدادت اﻻستاذ
                            </a>
                        </li>

                    </ul>
                </li>
                <div class="side-item side-item-category"></div>
            </ul>
        </div>
    </aside>
@elseif($user->role == 'moderator')
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar sidebar-scroll">
        <div class="main-sidebar-header active">
            <a class="desktop-logo logo-light" href="{{ url('/' . $page='index') }}">
                <img src="{{URL::asset('assets/img/brand/BeFunky-design.png')}}" class="main-logo" alt="logo">
            </a>
            <a class="desktop-logo logo-dark active" href="{{ url('/admin/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/hat.png')}}" class="main-logo dark-theme" alt="logo"></a>
            <a class="logo-icon mobile-logo icon-light active" href="{{ url('/admin/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/hat.png')}}" class="logo-icon" alt="logo"></a>
            <a class="logo-icon mobile-logo icon-dark active" href="{{ url('/admin/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/hat.png')}}" class="logo-icon dark-theme" alt="logo"></a>
        </div>
        <div class="main-sidemenu">
            <div class="app-sidebar__user clearfix">
                <div class="dropdown user-pro-body">
                    <div class="">
                        <img alt="user-img" class="avatar avatar-xl brround" src="{{URL::asset('assets/img/faces/6.jpg')}}"><span class="avatar-status profile-status bg-green"></span>
                    </div>
                    <div class="user-info">
                        <h4 class="font-weight-semibold mt-3 mb-0">{{auth()->user()->fullName()}}</h4>
                    </div>
                </div>
            </div>
            <ul class="side-menu">
                <li class="slide">
                    <a class="side-menu__item" href="{{ route('admin.catgory.index') }}">
                        <ion-icon class="side-menu__icon fa fa-list-alt"></ion-icon>
                        <span class="side-menu__label">التصنيفات</span>
                    </a>
                </li>
                <li class="slide">
                    <a class="side-menu__item" href="{{ route('admin.course.index') }}">
                        <i class="fas fa-atom side-menu__icon"></i>
                        <span class="side-menu__label">كورسات</span>
                    </a>
                </li>
                <li class="slide">
                    <a class="side-menu__item" href="{{ route('admin.qrcode.index') }}">
                        <i class="fas fa-qrcode side-menu__icon"></i>
                        <span class="side-menu__label">QRCodes</span>
                    </a>
                </li>
                <li class="slide">
                    <a class="side-menu__item" href="{{ route('admin.attach.index') }}">
                        <i class="fas fa-paperclip side-menu__icon"></i>
                        <span class="side-menu__label">المرفقات</span>
                    </a>
                </li>
                <li class="slide">
                    <a class="side-menu__item" href="{{ route('admin.notifications.index') }}">
                        <i class="far fa-bell side-menu__icon "></i>
                        <span class="side-menu__label">اﻻشعارات</span>
                    </a>
                </li>
                <li class="slide">
                    <a class="side-menu__item" href="{{ route('admin.students.index') }}">
                        <i class="fas fa-user-graduate side-menu__icon"></i>
                        <span class="side-menu__label">الطلبه</span>
                    </a>
                </li>
                <li class="slide">
                    <a class="side-menu__item" href="{{ route('admin.exam.index') }}">
                        <i class="fas fa-question side-menu__icon"></i>
                        <span class="side-menu__label">اﻻمتحانات</span>
                    </a>
                </li>
                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" href="#">
                        <i class="fas fa-cogs side-menu__icon"></i>
                        <span class="side-menu__label">اعدادت اﻻستاذ</span><i class="angle fe fe-chevron-down"></i>
                    </a>
                    <ul class="slide-menu">
                        <li>
                            <a class="slide-item" href="{{ route('admin.add.assitant') }}">
                                <i class="fas fa-user-plus"></i>
                                اضافه المساعدين
                            </a>
                        </li>
                        <li>
                            <a class="slide-item" href="{{ route('admin.teachers.settings') }}">
                                <i class="fas fa-cogs side-menu__icon"></i>
                                اعدادت اﻻستاذ
                            </a>
                        </li>
                        <li>
                            <a class="slide-item" href="{{ route('admin.teachers.links.index') }}">
                                <i class="fas fa-cogs side-menu__icon"></i>
                                طرق الدفع و الروابط
                            </a>
                        </li>
                    </ul>
                </li>
                <div class="side-item side-item-category"></div>
            </ul>
        </div>
    </aside>

@elseif($user->role == 'teacher')
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar sidebar-scroll">
        <div class="main-sidebar-header active">
            <a class="desktop-logo logo-light" href="{{ url('/' . $page='index') }}">
                <img src="{{URL::asset('assets/img/brand/BeFunky-design.png')}}" class="main-logo" alt="logo">
            </a>
            <a class="desktop-logo logo-dark active" href="{{ url('/admin/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/hat.png')}}" class="main-logo dark-theme" alt="logo"></a>
            <a class="logo-icon mobile-logo icon-light active" href="{{ url('/admin/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/hat.png')}}" class="logo-icon" alt="logo"></a>
            <a class="logo-icon mobile-logo icon-dark active" href="{{ url('/admin/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/hat.png')}}" class="logo-icon dark-theme" alt="logo"></a>
        </div>
        <div class="main-sidemenu">
            <div class="app-sidebar__user clearfix">
                <div class="dropdown user-pro-body">
                    <div class="">
                        <img alt="user-img" class="avatar avatar-xl brround" src="{{URL::asset('assets/img/faces/6.jpg')}}"><span class="avatar-status profile-status bg-green"></span>
                    </div>
                    <div class="user-info">
                        <h4 class="font-weight-semibold mt-3 mb-0">{{auth()->user()->fullName()}}</h4>
                    </div>
                </div>
            </div>
            <ul class="side-menu">
                <li class="slide">
                    <a class="side-menu__item" href="{{ route('admin.catgory.index') }}">
                        <ion-icon class="side-menu__icon fa fa-list-alt"></ion-icon>
                        <span class="side-menu__label">التصنيفات</span>
                    </a>
                </li>
                <li class="slide">
                    <a class="side-menu__item" href="{{ route('admin.course.index') }}">
                        <i class="fas fa-atom side-menu__icon"></i>
                        <span class="side-menu__label">كورسات</span>
                    </a>
                </li>
                <li class="slide">
                    <a class="side-menu__item" href="{{ route('admin.qrcode.index') }}">
                        <i class="fas fa-qrcode side-menu__icon"></i>
                        <span class="side-menu__label">QRCodes</span>
                    </a>
                </li>
                <li class="slide">
                    <a class="side-menu__item" href="{{ route('admin.attach.index') }}">
                        <i class="fas fa-paperclip side-menu__icon"></i>
                        <span class="side-menu__label">المرفقات</span>
                    </a>
                </li>
                <li class="slide">
                    <a class="side-menu__item" href="{{ route('admin.notifications.index') }}">
                        <i class="far fa-bell side-menu__icon "></i>
                        <span class="side-menu__label">اﻻشعارات</span>
                    </a>
                </li>
                <li class="slide">
                    <a class="side-menu__item" href="{{ route('admin.students.index') }}">
                        <i class="fas fa-user-graduate side-menu__icon"></i>
                        <span class="side-menu__label">الطلبه</span>
                    </a>
                </li>
                <li class="slide">
                    <a class="side-menu__item" href="{{ route('admin.exam.index') }}">
                        <i class="fas fa-question side-menu__icon"></i>
                        <span class="side-menu__label">اﻻمتحانات</span>
                    </a>
                </li>
                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" href="{{ url('/admin/' . $page='#') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" class="side-menu__icon" viewBox="0 0 24 24" ><g><rect fill="none"/></g><g><g/><g>
                                    <path d="M21,5c-1.11-0.35-2.33-0.5-3.5-0.5c-1.95,0-4.05,0.4-5.5,1.5c-1.45-1.1-3.55-1.5-5.5-1.5S2.45,4.9,1,6v14.65 c0,0.25,0.25,0.5,0.5,0.5c0.1,0,0.15-0.05,0.25-0.05C3.1,20.45,5.05,20,6.5,20c1.95,0,4.05,0.4,5.5,1.5c1.35-0.85,3.8-1.5,5.5-1.5 c1.65,0,3.35,0.3,4.75,1.05c0.1,0.05,0.15,0.05,0.25,0.05c0.25,0,0.5-0.25,0.5-0.5V6C22.4,5.55,21.75,5.25,21,5z M3,18.5V7 c1.1-0.35,2.3-0.5,3.5-0.5c1.34,0,3.13,0.41,4.5,0.99v11.5C9.63,18.41,7.84,18,6.5,18C5.3,18,4.1,18.15,3,18.5z M21,18.5 c-1.1-0.35-2.3-0.5-3.5-0.5c-1.34,0-3.13,0.41-4.5,0.99V7.49c1.37-0.59,3.16-0.99,4.5-0.99c1.2,0,2.4,0.15,3.5,0.5V18.5z"/><path d="M11,7.49C9.63,6.91,7.84,6.5,6.5,6.5C5.3,6.5,4.1,6.65,3,7v11.5C4.1,18.15,5.3,18,6.5,18 c1.34,0,3.13,0.41,4.5,0.99V7.49z" opacity=".3"/></g><g>
                                    <path d="M17.5,10.5c0.88,0,1.73,0.09,2.5,0.26V9.24C19.21,9.09,18.36,9,17.5,9c-1.28,0-2.46,0.16-3.5,0.47v1.57 C14.99,10.69,16.18,10.5,17.5,10.5z"/><path d="M17.5,13.16c0.88,0,1.73,0.09,2.5,0.26V11.9c-0.79-0.15-1.64-0.24-2.5-0.24c-1.28,0-2.46,0.16-3.5,0.47v1.57 C14.99,13.36,16.18,13.16,17.5,13.16z"/><path d="M17.5,15.83c0.88,0,1.73,0.09,2.5,0.26v-1.52c-0.79-0.15-1.64-0.24-2.5-0.24c-1.28,0-2.46,0.16-3.5,0.47v1.57 C14.99,16.02,16.18,15.83,17.5,15.83z"/>
                                </g>
                            </g>
                        </svg>
                        <span class="side-menu__label">Pages</span><i class="angle fe fe-chevron-down"></i>
                    </a>
                    <ul class="slide-menu">
                        <li >
                            <a class="side-menu__item" href="{{ route('admin.exam.index') }}">
                                <i class="fas fa-question side-menu__icon"></i>
                                <span class="side-menu__label">اضافه مساعدين</span>
                            </a>
                        </li>
                        <li>
                            <a class="side-menu__item" href="{{ route('admin.teachers.settings') }}">
                                <i class="fas fa-cogs side-menu__icon"></i>
                                <span class="side-menu__label">اعدادت اﻻستاذ</span>
                            </a>
                        </li>
                        <li>
                            <a class="slide-item" href="{{ route('admin.teachers.links.index') }}">
                                <i class="fas fa-cogs side-menu__icon"></i>
                                طرق الدفع و الروابط
                            </a>
                        </li>
                    </ul>
                </li>
                <div class="side-item side-item-category"></div>
            </ul>
        </div>
    </aside>
@elseif($user->role == 'assitant')
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar sidebar-scroll">
        <div class="main-sidebar-header active">
            <a class="desktop-logo logo-light" href="{{ url('/' . $page='index') }}">
                <img src="{{URL::asset('assets/img/brand/BeFunky-design.png')}}" class="main-logo" alt="logo">
            </a>
            <a class="desktop-logo logo-dark active" href="{{ url('/admin/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/hat.png')}}" class="main-logo dark-theme" alt="logo"></a>
            <a class="logo-icon mobile-logo icon-light active" href="{{ url('/admin/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/hat.png')}}" class="logo-icon" alt="logo"></a>
            <a class="logo-icon mobile-logo icon-dark active" href="{{ url('/admin/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/hat.png')}}" class="logo-icon dark-theme" alt="logo"></a>
        </div>
        <div class="main-sidemenu">
            <div class="app-sidebar__user clearfix">
                <div class="dropdown user-pro-body">
                    <div class="">
                        <img alt="user-img" class="avatar avatar-xl brround" src="{{URL::asset('assets/img/faces/6.jpg')}}"><span class="avatar-status profile-status bg-green"></span>
                    </div>
                    <div class="user-info">
                        <h4 class="font-weight-semibold mt-3 mb-0">{{auth()->user()->fullName()}}</h4>
                    </div>
                </div>
            </div>
            <ul class="side-menu">
                <li class="slide">
                    <a class="side-menu__item" href="{{ route('admin.catgory.index') }}">
                        <ion-icon class="side-menu__icon fa fa-list-alt"></ion-icon>
                        <span class="side-menu__label">التصنيفات</span>
                    </a>
                </li>
                <li class="slide">
                    <a class="side-menu__item" href="{{ route('admin.course.index') }}">
                        <i class="fas fa-atom side-menu__icon"></i>
                        <span class="side-menu__label">كورسات</span>
                    </a>
                </li>
                <li class="slide">
                    <a class="side-menu__item" href="{{ route('admin.qrcode.index') }}">
                        <i class="fas fa-qrcode side-menu__icon"></i>
                        <span class="side-menu__label">QRCodes</span>
                    </a>
                </li>
                <li class="slide">
                    <a class="side-menu__item" href="{{ route('admin.attach.index') }}">
                        <i class="fas fa-paperclip side-menu__icon"></i>
                        <span class="side-menu__label">المرفقات</span>
                    </a>
                </li>
                <li class="slide">
                    <a class="side-menu__item" href="{{ route('admin.notifications.index') }}">
                        <i class="far fa-bell side-menu__icon "></i>
                        <span class="side-menu__label">اﻻشعارات</span>
                    </a>
                </li>
                <li class="slide">
                    <a class="side-menu__item" href="{{ route('admin.students.index') }}">
                        <i class="fas fa-user-graduate side-menu__icon"></i>
                        <span class="side-menu__label">الطلبه</span>
                    </a>
                </li>
                <li class="slide">
                    <a class="side-menu__item" href="{{ route('admin.exam.index') }}">
                        <i class="fas fa-question side-menu__icon"></i>
                        <span class="side-menu__label">اﻻمتحانات</span>
                    </a>
                </li>
                <div class="side-item side-item-category"></div>
            </ul>
        </div>
    </aside>
@elseif($user->role == 'developer')
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar sidebar-scroll">
        <div class="main-sidebar-header active">
            <a class="desktop-logo logo-light" href="{{ url('/' . $page='index') }}">
                <img src="{{URL::asset('assets/img/brand/BeFunky-design.png')}}" class="main-logo" alt="logo">
            </a>
            <a class="desktop-logo logo-dark active" href="{{ url('/admin/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/hat.png')}}" class="main-logo dark-theme" alt="logo"></a>
            <a class="logo-icon mobile-logo icon-light active" href="{{ url('/admin/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/hat.png')}}" class="logo-icon" alt="logo"></a>
            <a class="logo-icon mobile-logo icon-dark active" href="{{ url('/admin/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/hat.png')}}" class="logo-icon dark-theme" alt="logo"></a>
        </div>
        <div class="main-sidemenu">
            <div class="app-sidebar__user clearfix">
                <div class="dropdown user-pro-body">
                    <div class="">
                        <img alt="user-img" class="avatar avatar-xl brround" src="{{URL::asset('assets/img/faces/6.jpg')}}"><span class="avatar-status profile-status bg-green"></span>
                    </div>
                    <div class="user-info">
                        <h4 class="font-weight-semibold mt-3 mb-0">{{auth()->user()->fullName()}}</h4>
                    </div>
                </div>
            </div>
            <ul class="side-menu">
                <li class="slide">
                    <a class="side-menu__item" href="{{ route('admin.catgory.index') }}">
                        <ion-icon class="side-menu__icon fa fa-list-alt"></ion-icon>
                        <span class="side-menu__label">التصنيفات</span>
                    </a>
                </li>
                <li class="slide">
                    <a class="side-menu__item" href="{{ route('admin.course.index') }}">
                        <i class="fas fa-atom side-menu__icon"></i>
                        <span class="side-menu__label">كورسات</span>
                    </a>
                </li>
                <li class="slide">
                    <a class="side-menu__item" href="{{ route('admin.qrcode.index') }}">
                        <i class="fas fa-qrcode side-menu__icon"></i>
                        <span class="side-menu__label">QRCodes</span>
                    </a>
                </li>
                <li class="slide">
                    <a class="side-menu__item" href="{{ route('admin.notifications.index') }}">
                        <i class="far fa-bell side-menu__icon "></i>
                        <span class="side-menu__label">اﻻشعارات</span>
                    </a>
                </li>
                <li class="slide">
                    <a class="side-menu__item" href="{{ route('admin.students.index') }}">
                        <i class="fas fa-user-graduate side-menu__icon"></i>
                        <span class="side-menu__label">الطلبه</span>
                    </a>
                </li>
                <li class="slide">
                    <a class="side-menu__item" href="{{ route('admin.exam.index') }}">
                        <i class="fas fa-question side-menu__icon"></i>
                        <span class="side-menu__label">اﻻمتحانات</span>
                    </a>
                </li>
                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" href="#">
                        <i class="fas fa-cogs side-menu__icon"></i>
                        <span class="side-menu__label">اعدادت التطبيق</span><i class="angle fe fe-chevron-down"></i>
                    </a>
                    <ul class="slide-menu">
                        <li>
                            <a class="slide-item" href="{{ route('admin.app.developer.settings') }}">
                                <i class="fas fa-tools"></i>
                                اعدادت خاصه بالمطورين
                            </a>
                        </li>
                        <li>
                            <a class="slide-item" href="{{ route('admin.teachers.settings') }}">
                                <i class="fas fa-cogs side-menu__icon"></i>
                                اعدادت اﻻستاذ
                            </a>
                        </li>

                    </ul>
                </li>
                <div class="side-item side-item-category"></div>
            </ul>
        </div>
    </aside>

@endif
