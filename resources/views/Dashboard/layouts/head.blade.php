<title>
    @yield('title')
</title>

@livewireStyles
<link href="{{asset('Dashboard/assets/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
<link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.rtl.min.css">


<!--Internal   Notify -->
<link href="{{URL::asset('Dashboard/plugins/notify/css/notifIt.css')}}" rel="stylesheet">

@if(App::getLocale() == 'ar')
<link href="{{asset('Dashboard/assets/css/sb-admin-2-rtl.css')}}" rel="stylesheet">
@else
@endif
<link href="{{asset('Dashboard/assets/css/sb-admin-2.min.css')}}" rel="stylesheet">
@yield('css')