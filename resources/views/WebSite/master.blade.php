<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="Hospital">
    <meta name="description" content="This is a Hospital management system">
    @include('WebSite.style')
    @livewireStyles
</head>

<body id="top">
    <div class="page-wrapper {{ LaravelLocalization::getCurrentLocale() ==='ar' ? 'rtl': ''}}">
        <div class="preloader" data-preloader>
            <div class="circle"></div>
        </div>

        @include('WebSite.header')

        @yield('content')
        @include('WebSite.footer')
    </div>
    <a href="#top" class="back-top-btn" aria-label="back to top" data-back-top-btn>
        <ion-icon name="chevron-up"></ion-icon>
    </a>
    @include('WebSite.scripts')
    @livewireScripts
</body>

</html>