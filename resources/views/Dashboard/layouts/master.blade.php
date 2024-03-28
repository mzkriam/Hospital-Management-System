<!DOCTYPE html>
@if(App::getLocale() == 'ar')
<html lang="ar" dir='rtl'>
@else
<html lang="en" dir='ltr'>
@endif

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    @include('Dashboard.layouts.head')

</head>

<body id="page-top">
    <div id="wrapper">
        @include('Dashboard.layouts.main-sidebar')
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('Dashboard.layouts.main-header')
                @yield('page-header')
                @yield('content')
                @include('Dashboard.layouts.footer')
                @include('Dashboard.layouts.footer-scripts')
</body>

</html>