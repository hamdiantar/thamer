<!DOCTYPE html>
<html lang="{{app()->getLocale()}}" dir="{{app()->getLocale() == 'ar' ? 'rtl' : 'ltr'}}">
<head>
    <meta name="description" content="">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>  </title>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@if(app()->getLocale() == 'ar')
        <link href='https://fonts.googleapis.com/css?family=Cairo' rel='stylesheet'>
        <link rel="stylesheet" type="text/css" href="{{asset('admin/css/ar.css')}}">
    @else
        <link rel="stylesheet" type="text/css" href="{{asset('admin/css/main.css')}}">
    @endif

    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/css/confirm.css')}}">

    @stack('css')
</head>
<body class="app sidebar-mini rtl">
@if ($errors->any())
    @foreach ($errors->all() as $error)
        @php
            toastr()->error($error);
        @endphp
    @endforeach
@endif
<header class="app-header"><a class="app-header__logo" href="#">
        <img height="66px" src="{{asset('logo.png')}}" class="logo" alt="" />
    </a>
    <a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
    <!-- Navbar Right Menu-->
    <ul class="app-nav">
        <li class="app-search">
            <input class="app-search__input" type="search" placeholder="Search">
            <button class="app-search__button"><i class="fa fa-search"></i></button>
        </li>
        <li class="dropdown">
            <a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Show notifications">
                <i class="fa fa-bell"></i>
            </a>
            <ul class="app-notification dropdown-menu dropdown-menu-right">
                <li class="app-notification__title">الإشعارات </li>
                <div class="app-notification__content"></div>
            </ul>
        </li>

        <!-- User Menu-->
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i
                    class="fa fa-user fa-lg"></i></a>
            <ul class="dropdown-menu settings-menu dropdown-menu-right">
                <li><a class="dropdown-item" href="#" onclick="confirmationLogout('FormLogout')"><i class="fa fa-sign-out fa-lg"></i> Logout</a></li>
                <form id="FormLogout" class="d-none" action="{{route('admin.logout')}}" method="post">@csrf</form>
            </ul>
        </li>
    </ul>
</header>
<!-- Sidebar menu-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <div class="app-sidebar__user">
        <img height="50px;" class="app-sidebar__user-avatar" src="{{asset('def.png')}}" alt="User Image">
        <div>
            <p style="    font-size: 14px;margin-bottom: 9px;" class="app-sidebar__user-name">مرحبا بك : {{auth()->user()->name}}  </p>

            <p style="    font-size: 11px;" class="app-sidebar__user-designation">{{auth()->user()->role }}</p>
        </div>
    </div>
    <ul class="app-menu">
        <li>
            <a class="app-menu__item {{isNavbarActive('home')}}" href="{{route('admin.home')}}">
                <i class="app-menu__icon fa fa-dashboard"></i>
                <span class="app-menu__label">الرئيسية</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item {{isNavbarActive('my_profile')}}" href="{{route('admin.profile')}}">
                <i class="app-menu__icon fa fa-user"></i>
                <span class="app-menu__label">الملف الشخصى</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item {{isNavbarActive('users*')}}" href="{{route('admin.users.index')}}">
                <i class="app-menu__icon fa fa-users"></i>
                <span class="app-menu__label">المستخدميين</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item {{ isNavbarActive('years*') }}" href="{{ route('admin.years.index') }}">
                <i class="app-menu__icon fa fa-calendar"></i>
                <span class="app-menu__label">السنوات</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item {{ isNavbarActive('levels*') }}" href="{{ route('admin.levels.index') }}">
                <i class="app-menu__icon fa fa-list"></i>
                <span class="app-menu__label">المستويات</span>
            </a>
        </li>

        <li>
            <a class="app-menu__item {{isNavbarActive('semesters*')}}" href="{{route('admin.semesters.index')}}">
                <i class="app-menu__icon fa fa-file"></i>
                <span class="app-menu__label">الفصول الدراسية</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item {{isNavbarActive('groups*')}}" href="{{route('admin.groups.index')}}">
                <i class="app-menu__icon fa fa-users"></i>
                <span class="app-menu__label">المجموعات الدراسية</span>
            </a>
        </li>

        <li>
            <a class="app-menu__item {{isNavbarActive('departments*')}}" href="{{route('admin.departments.index')}}">
                <i class="app-menu__icon fa fa-building"></i>
                <span class="app-menu__label">الأقسام</span>
            </a>
        </li>
{{--        <li>--}}
{{--            <a class="app-menu__item {{isNavbarActive('instructors*')}}" href="{{route('admin.instructors.index')}}">--}}
{{--                <i class="app-menu__icon fa fa-users"></i>--}}
{{--                <span class="app-menu__label">المحاضرون</span>--}}
{{--            </a>--}}
{{--        </li>--}}

        <li>
            <a class="app-menu__item {{isNavbarActive('rooms*')}}" href="{{route('admin.rooms.index')}}">
                <i class="app-menu__icon fa fa-home"></i>
                <span class="app-menu__label">القاعات</span>
            </a>
        </li>

        <li>
            <a class="app-menu__item {{isNavbarActive('periods*')}}" href="{{route('admin.periods.index')}}">
                <i class="app-menu__icon fa fa-clock-o"></i>
                <span class="app-menu__label">الفترات الزمنية</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item {{isNavbarActive('courses*')}}" href="{{route('admin.courses.index')}}">
                <i class="app-menu__icon fa fa-book"></i>
                <span class="app-menu__label">المواد الدراسية </span>
            </a>
        </li>

        <li>
            <a class="app-menu__item {{isNavbarActive('timetable*')}}" href="{{route('admin.timetable')}}">
                <i class="app-menu__icon fa fa-calendar"></i>
                <span class="app-menu__label">الجدول الزمني</span>
            </a>
        </li>
    </ul>
</aside>
@yield('content')
<div id="scroller"></div>
@include('admin.footer')
</body>
</html>
