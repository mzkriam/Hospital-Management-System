{{-- @extends('Dashboard.layouts.master')
@section('css')
<!--  Owl-carousel css-->
<link href="{{URL::asset('Dashboard/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet" />
<!-- Maps css -->
<link href="{{URL::asset('Dashboard/plugins/jqvmap/jqvmap.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="left-content">
        <div>
            <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">لوحة تحكم المريض</h2><br>
            <p class="mg-b-0">مرحبا بعودتك مرة اخري {{auth()->user()->name}}</p>
        </div>
    </div>
</div>
<!-- /breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row row-sm">
    <div class="col-xl-6 col-lg-6 col-md-6 col-xm-12">
        <div class="card overflow-hidden sales-card bg-primary-gradient">
            <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                <div class="">
                    <h6 class="mb-3 tx-12 text-white">اجمالي عدد الفواتير</h6>
                </div>
                <div class="pb-0 mt-0">
                    <div class="d-flex">
                        <div class="">
                            <h4 class="tx-20 font-weight-bold mb-1 text-white">{{App\Models\Ray::count()}}</h4>
                        </div>
                    </div>
                </div>
            </div>
            <span id="compositeline" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
        </div>
    </div>
    <div class="col-xl-6 col-lg-6 col-md-6 col-xm-12">
        <div class="card overflow-hidden sales-card bg-danger-gradient">
            <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                <div class="">
                    <h6 class="mb-3 tx-12 text-white">اجمالي المدفوعات</h6>
                </div>
                <div class="pb-0 mt-0">
                    <div class="d-flex">
                        <div class="">
                            <h4 class="tx-20 font-weight-bold mb-1 text-white"><a style="color: white"
                                    href="{{route('payments.patient')}}">{{App\Models\PatientAccount::where('patient_id',auth()->user()->id)->sum('credit')}}</a>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
            <span id="compositeline2" class="pt-1">3,2,4,6,12,14,8,7,14,16,12,7,8,4,3,2,2,5,6,7</span>
        </div>
    </div>

</div>
<div class="row row-sm row-deck">
    <div class="col-md-12 col-lg-12 col-xl-12">
        <div class="card card-table-two">
            <div class="d-flex justify-content-between">
                <h2 class="card-title mb-1">اخر 5 فواتير علي النظام</h2>
            </div><br>
            <div class="table-responsive country-table">
                <table class="table table-striped table-bordered mb-0 text-sm-nowrap text-lg-nowrap text-xl-nowrap">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>تاريخ الفاتورة</th>
                            <th>اسم المريض</th>
                            <th>اسم الطبيب</th>
                            <th>حالة الفاتورة</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse(\App\Models\Invoice::latest()->take(5)->where('patient_id',auth()->user()->id)->get()
                        as $invoice )
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td class="tx-right tx-medium tx-inverse">{{$invoice->created_at}}</td>
                            <td class="tx-right tx-medium tx-danger">{{$invoice->patient->name}}</td>
                            <td class="tx-right tx-medium tx-inverse">{{$invoice->doctor->name}}</td>
                            <td class="tx-right tx-medium tx-inverse">
                                @if($invoice->case == 0)
                                <span class="badge badge-danger">تحت الاجراء</span>
                                @else
                                <span class="badge badge-success">مكتملة</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        لاتوجد بيانات
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /row -->
</div>
</div>
<!-- Container closed -->
@endsection
@section('js')
<!--Internal  Chart.bundle js -->
<script src="{{URL::asset('Dashboard/plugins/chart.js/Chart.bundle.min.js')}}"></script>
<!-- Moment js -->
<script src="{{URL::asset('Dashboard/plugins/raphael/raphael.min.js')}}"></script>
<!--Internal  Flot js-->
<script src="{{URL::asset('Dashboard/plugins/jquery.flot/jquery.flot.js')}}"></script>
<script src="{{URL::asset('Dashboard/plugins/jquery.flot/jquery.flot.pie.js')}}"></script>
<script src="{{URL::asset('Dashboard/plugins/jquery.flot/jquery.flot.resize.js')}}"></script>
<script src="{{URL::asset('Dashboard/plugins/jquery.flot/jquery.flot.categories.js')}}"></script>
<script src="{{URL::asset('Dashboard/js/dashboard.sampledata.js')}}"></script>
<script src="{{URL::asset('Dashboard/js/chart.flot.sampledata.js')}}"></script>
<!--Internal Apexchart js-->
<script src="{{URL::asset('Dashboard/js/apexcharts.js')}}"></script>
<!-- Internal Map -->
<script src="{{URL::asset('Dashboard/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{URL::asset('Dashboard/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<script src="{{URL::asset('Dashboard/js/modal-popup.js')}}"></script>
<!--Internal  index js -->
<script src="{{URL::asset('Dashboard/js/index.js')}}"></script>
<script src="{{URL::asset('Dashboard/js/jquery.vmap.sampledata.js')}}"></script>
@endsection --}}
@extends('Dashboard.layouts.master')
@section('title')
{{trans('Dashboard/dashboard.dashboard_admin')}}
@endsection
@section('page-header')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{trans('Dashboard/dashboard.dashboard_admin')}}</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>
    @endsection
    @section('content')
    <div class="row">
        <div class="col-xl-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                {{trans('Dashboard/dashboard.appointments')}}
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{\App\Models\Appointment::whereBetween('appointment',[now()->addDays(-1)->startOfDay(),
                                now()->addDays(1)->startOfDay()])->count()
                                }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                {{trans('Dashboard/dashboard.appointment')}}
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ \App\Models\Appointment::where('patient_id',auth()->user()->id)->count()}}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-3 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                {{trans('Dashboard/dashboard.treatments')}}
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{\App\Models\Treatment::where('patient_id',auth()->user()->id)->count()}}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-x-ray fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                {{trans('Dashboard/dashboard.operations')}}
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{\App\Models\Operation::where('patient_id',auth()->user()->id)->count()}}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-flask fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                {{trans('Dashboard/dashboard.ray_process')}}
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{\App\Models\RayService::where('patient_id',auth()->user()->id)->count()}}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-x-ray fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                {{trans('Dashboard/dashboard.laboratories_process')}}
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{\App\Models\LabService::where('patient_id',auth()->user()->id)->count()}}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-flask fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-3 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                {{trans('Dashboard/dashboard.total_of_individual_invoices')}}
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{App\Models\Invoice::where('patient_id',auth()->user()->id)->sum('total_with_tax')}}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                {{trans('Dashboard/dashboard.Total_from_bundled_services')}}
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                        {{App\Models\group_invoice::where('patient_id',auth()->user()->id)->sum('total_with_tax')}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                {{trans('Dashboard/dashboard.total_credit')}}
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{
                                \App\Models\PatientAccount::where('patient_id',auth()->user()->id)->sum('credit')
                                }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                {{trans('Dashboard/dashboard.total_debit')}}
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{\App\Models\PatientAccount::where('patient_id',auth()->user()->id)->sum('Debit')}}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                {{trans('Dashboard/dashboard.total_bills_of_exchange')}}
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{\App\Models\ReceiptAccount::where('patient_id',auth()->user()->id)->sum('amount')}}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                {{trans('Dashboard/dashboard.total_bills_receivable')}}
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                        {{\App\Models\PaymentAccount::where('patient_id',auth()->user()->id)->sum('amount')}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@endsection
</body>

</html>