<script src="{{asset('Dashboard/assets/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('Dashboard/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- Core plugin JavaScript-->
<script src="{{asset('Dashboard/assets/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

<!-- Custom scripts for all pages-->
<script src="{{asset('Dashboard/assets/js/sb-admin-2.min.js')}}"></script>

<!-- Page level plugins -->
<script src="{{asset('Dashboard/assets/vendor/chart.js/Chart.min.js')}}"></script>

<!-- Page level custom scripts -->
<script src="{{asset('Dashboard/assets/js/demo/chart-area-demo.js')}}"></script>
<script src="{{asset('Dashboard/assets/js/demo/chart-pie-demo.js')}}"></script>


<script src="{{URL::asset('Dashboard/plugins/notify/js/notifIt.js')}}"></script>
<script src="{{URL::asset('Dashboard/plugins/notify/js/notifit-custom.js')}}"></script>
{{-- <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script>
    Pusher.logToConsole = true;
    var pusher = new Pusher('b64d1d980b52d3015179', {
        cluster: 'mt1'
});
</script> --}}
@yield('js')
@livewireScripts