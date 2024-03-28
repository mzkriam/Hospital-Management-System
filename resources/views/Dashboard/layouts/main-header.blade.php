<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>
    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
        <div class="input-group">
            <input type="text" class="form-control bg-light border-0 small"
                placeholder="{{trans('Dashboard/header.search')}}" aria-label="Search" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                    <i class="fas fa-search fa-sm"></i>
                </button>
            </div>
        </div>
    </form>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown no-arrow d-sm-none">
            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
            </a>
            <!-- Dropdown - Messages -->
            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small"
                            placeholder="{{trans('Dashboard/header.search')}}" aria-label="Search"
                            aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>
        <li class="nav-item dropdown no-arrow mx-1">
            <a href="#" class="nav-link dropdown-toggle" id="dropdownMenuButton" drole="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                @if (App::getLocale() == 'ar')
                <strong class="mr-2 ml-2 my-auto">{{ LaravelLocalization::getCurrentLocaleName() }}</strong>
                @else
                <strong class="mr-2 ml-2 my-auto">{{ LaravelLocalization::getCurrentLocaleName() }}</strong>
                @endif
            </a>
            <ul class="dropdown-list dropdown-menu  shadow animated--grow-in" aria-labelledby="dropdownMenuButton">
                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                <li class="">
                    <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}"
                        href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                        @if($properties['native'] == "English")
                        <i class="flag-icon flag-icon-us"></i>
                        @elseif($properties['native'] == "العربية")
                        <i class="flag-icon flag-icon-eg"></i>
                        @endif
                        {{ $properties['native'] }}
                    </a>
                </li>
                @endforeach
            </ul>
        </li>



        <!-- Nav Item - Messages -->
        @if(auth('doctor')->check())
        <li class="nav-item dropdown no-arrow mx-1">
            <div class="dropdown-notifications">
                <a href="#" class="nav-link dropdown-toggle" id="messagesDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-envelope fa-fw"></i>
                    <span data-count="{{App\Models\Notification::countNotification(auth()->user()->id)->count()}}"
                        class="badge badge-danger badge-counter notif-count">
                        {{App\Models\Notification::countNotification(auth()->user()->id)->count()}}
                    </span>
                </a>
                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                    aria-labelledby="messagesDropdown">
                    <h6 class="dropdown-header">
                        {{trans('Dashboard/header.messages')}}
                    </h6>
                    <ul>
                        <li class="mb-2">
                            <div class="mb-2 new_message">
                                <div>
                                    <div class="notification-label text-truncate"></div>
                                    <p class="notification-subtext text-xs text-secondary mb-0"></p>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <ul>
                        @foreach(App\Models\Notification::where('user_id',auth()->user()->id)->where('reader_status',0)->get()
                        as $notification )
                        <li class="mb-2">
                            <a class="dropdown-item d-flex align-items-center"
                                href="{{route('invoice_details',$notification->id)}}">
                                <div>
                                    <div class="notification-label text-truncate">
                                        {{$notification->message}}
                                    </div>
                                    <p class="notification-subtext small text-gray-500">
                                        {{$notification->created_at}}
                                    </p>
                                </div>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                    <a class="dropdown-item text-center small text-gray-500"
                        href="#">{{trans('Dashboard/header.read')}}</a>
                </div>
            </div>
        </li>
        @endif
        @if(auth('ray_employee')->check())
        <li class="nav-item dropdown no-arrow mx-1">
            <div class="dropdown-notifications">
                <a href="#" class="nav-link dropdown-toggle" id="messagesDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-envelope fa-fw"></i>
                    <span
                        data-count="{{App\Models\Notification::where('section', 'ray')->where('reader_status', 0)->count()}}"
                        class="badge badge-danger badge-counter notif-count">
                        {{App\Models\Notification::where('section', 'ray')->where('reader_status', 0)->count()}}
                    </span>
                </a>
                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                    aria-labelledby="messagesDropdown">
                    <h6 class="dropdown-header">
                        {{trans('Dashboard/header.messages')}}
                    </h6>
                    <ul>
                        <li class="mb-2">
                            <div class="mb-2 new_message">
                                <div>
                                    <div class="notification-label text-truncate"></div>
                                    <p class="notification-subtext text-xs text-secondary mb-0"></p>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <ul>
                        @foreach(App\Models\Notification::where('section','ray')->where('reader_status',0)->get()
                        as $notification )
                        <li class="mb-2">
                            <a class="dropdown-item d-flex align-items-center"
                                href="{{route('ray_view_notification',$notification->id)}}">
                                <div>
                                    <div class="notification-label text-truncate">
                                        {{$notification->message}}
                                    </div>
                                    <p class="notification-subtext small text-gray-500">
                                        {{$notification->created_at}}
                                    </p>
                                </div>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                    <a class="dropdown-item text-center small text-gray-500"
                        href="#">{{trans('Dashboard/header.read')}}</a>
                </div>
            </div>
        </li>
        @endif
        @if(auth('laboratory_employee')->check())
        <li class="nav-item dropdown no-arrow mx-1">
            <div class="dropdown-notifications">
                <a href="#" class="nav-link dropdown-toggle" id="messagesDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-envelope fa-fw"></i>
                    <span
                        data-count="{{App\Models\Notification::where('section', 'laboratory')->where('reader_status', 0)->count()}}"
                        class="badge badge-danger badge-counter notif-count">
                        {{App\Models\Notification::where('section', 'laboratory')->where('reader_status', 0)->count()}}
                    </span>
                </a>
                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                    aria-labelledby="messagesDropdown">
                    <h6 class="dropdown-header">
                        {{trans('Dashboard/header.messages')}}
                    </h6>
                    <ul>
                        <li class="mb-2">
                            <div class="mb-2 new_message">
                                <div>
                                    <div class="notification-label text-truncate"></div>
                                    <p class="notification-subtext text-xs text-secondary mb-0"></p>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <ul>
                        @foreach(App\Models\Notification::where('section','laboratory')->where('reader_status',0)->get()
                        as $notification )
                        <li class="mb-2">
                            <a class="dropdown-item d-flex align-items-center"
                                href="{{route('lab_view_notification',$notification->id)}}">
                                <div>
                                    <div class="notification-label text-truncate">
                                        {{$notification->message}}
                                    </div>
                                    <p class="notification-subtext small text-gray-500">
                                        {{$notification->created_at}}
                                    </p>
                                </div>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                    <a class="dropdown-item text-center small text-gray-500"
                        href="#">{{trans('Dashboard/header.read')}}</a>
                </div>
            </div>
        </li>
        @endif
        @if(auth('pharmacy_employee')->check())
        <li class="nav-item dropdown no-arrow mx-1">
            <div class="dropdown-notifications">
                <a href="#" class="nav-link dropdown-toggle" id="messagesDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-envelope fa-fw"></i>
                    <span data-count="{{App\Models\Notification::whereIn('section', ['treatment'
                        ,'operation'])->where('reader_status', 0)->count()}}"
                        class="badge badge-danger badge-counter notif-count">
                        {{App\Models\Notification::whereIn('section', ['treatment'
                        ,'operation'])->where('reader_status', 0)->count()}}
                    </span>
                </a>
                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                    aria-labelledby="messagesDropdown">
                    <h6 class="dropdown-header">
                        {{trans('Dashboard/header.messages')}}
                    </h6>
                    <ul>
                        <li class="mb-2">
                            <div class="mb-2 new_message">
                                <div>
                                    <div class="notification-label text-truncate"></div>
                                    <p class="notification-subtext text-xs text-secondary mb-0"></p>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <ul>
                        @foreach(App\Models\Notification::whereIn('section',['treatment'
                        ,'operation'])->where('reader_status',0)->get()
                        as $notification )
                        <li class="mb-2">
                            <a class="dropdown-item d-flex align-items-center"
                                href="{{route('pha_view_notification',$notification->id)}}">
                                <div>
                                    <div class="notification-label text-truncate">
                                        {{$notification->message}}
                                    </div>
                                    <p class="notification-subtext small text-gray-500">
                                        {{$notification->created_at}}
                                    </p>
                                </div>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                    <a class="dropdown-item text-center small text-gray-500"
                        href="#">{{trans('Dashboard/header.read')}}</a>
                </div>
            </div>
        </li>
        @endif

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{auth()->user()->name}}</span>
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    {{trans('Dashboard/header.logout')}}
                </a>
            </div>
        </li>
    </ul>
</nav>


<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                @if(auth('web')->check())
                <form method="POST" action="{{ route('logout.user') }}">
                    @endif
                    @if(auth('admin')->check())
                    <form method="POST" action="{{ route('logout.admin') }}">
                        @endif
                        @if(auth('doctor')->check())
                        <form method="POST" action="{{ route('logout.doctor') }}">
                            @endif
                            @if(auth('ray_employee')->check())
                            <form method="POST" action="{{ route('logout.ray_employee') }}">
                                @endif
                                @if(auth('laboratory_employee')->check())
                                <form method="POST" action="{{ route('logout.laboratory_employee') }}">
                                    @endif
                                    @if(auth('patient')->check())
                                    <form method="POST" action="{{ route('logout.patient') }}">
                                        @endif
                                        @if(auth('pharmacy_employee')->check())
                                        <form method="POST" action="{{ route('logout.pharmacy_employee') }}">
                                            @endif
                                            @if(auth('reception_employee')->check())
                                            <form method="POST" action="{{ route('logout.reception_employee') }}">
                                                @endif
                                                @if(auth('accounting_employee')->check())
                                                <form method="POST" action="{{ route('logout.accounting_employee') }}">
                                                    @endif
                                                    @csrf
                                                    <a class="btn btn-primary" href="#"
                                                        onclick="event.preventDefault();
                                                        this.closest('form').submit();">{{trans('Dashboard/header.logout')}}</a>
                                                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>

<script src="{{asset('js/app.js')}}"></script>


@if(auth('ray_employee')->check())
<script>
    var notificationsWrapper = $('.dropdown-notifications');
    var notificationsCountElem = notificationsWrapper.find('span[data-count]');
    var notificationsCount = parseInt(notificationsCountElem.data('count'));
    var notifications = notificationsWrapper.find('div.notification-label');
    var new_message = notificationsWrapper.find('.new_message');
    new_message.hide();
    var pusher = new Pusher('b64d1d980b52d3015179', {
    cluster: 'mt1'
    });
    var channel = pusher.subscribe('transfer-to-ray');
    channel.bind('transfer-to-ray', function(data) {
    var newNotificationHtml = `
<a class="dropdown-item" href="/ray employee/ray_view_required/` + data.ray_service_id + `">
    <h4 class="notification-label mb-1">` + data.message + data.patient + `</h4>
    <div class="notification-subtext">` + data.created_at + `</div>
</a>`;

new_message.show();
notifications.html(newNotificationHtml);
notificationsCount += 1;
notificationsCountElem.attr('data-count', notificationsCount);
notificationsWrapper.find('.notif-count').text(notificationsCount);
notificationsWrapper.show();
    });
</script>
@endif



@if(auth('laboratory_employee')->check())
<script>
    var notificationsWrapper = $('.dropdown-notifications');
    var notificationsCountElem = notificationsWrapper.find('span[data-count]');
    var notificationsCount = parseInt(notificationsCountElem.data('count'));
    var notifications = notificationsWrapper.find('div.notification-label');
    var new_message = notificationsWrapper.find('.new_message');
    new_message.hide();
    var pusher = new Pusher('b64d1d980b52d3015179', {
    cluster: 'mt1'
    });
    var channel = pusher.subscribe('transfer-to-laboratory');
    channel.bind('transfer-to-laboratory', function(data) {
    var newNotificationHtml = `
<a class="dropdown-item" href="/laboratory employee/lab_view_required/` + data.lab_service_id + `">
    <h4 class="notification-label mb-1">` + data.message + data.patient + `</h4>
    <div class="notification-subtext">` + data.created_at + `</div>
</a>`;

new_message.show();
notifications.html(newNotificationHtml);
notificationsCount += 1;
notificationsCountElem.attr('data-count', notificationsCount);
notificationsWrapper.find('.notif-count').text(notificationsCount);
notificationsWrapper.show();
    });
</script>
@endif


@if(auth('pharmacy_employee')->check())
<script>
    var notificationsWrapper = $('.dropdown-notifications');
    var notificationsCountElem = notificationsWrapper.find('span[data-count]');
    var notificationsCount = parseInt(notificationsCountElem.data('count'));
    var notifications = notificationsWrapper.find('div.notification-label');
    var new_message = notificationsWrapper.find('.new_message');
    new_message.hide();
    var pusher = new Pusher('b64d1d980b52d3015179', {
    cluster: 'mt1'
    });
    var channel = pusher.subscribe('transfer-to-pharmacy');
    channel.bind('transfer-to-pharmacy', function(data) {
   var newNotificationHtml = `
<a class="dropdown-item"
    href="/Pharmacy employee/pha_view_notification/` + data.notification_id + `">
    <h4 class="notification-label mb-1">` + data.message + data.patient + `</h4>
    <div class="notification-subtext">` + data.created_at + `</div>
</a>`;

new_message.show();
notifications.html(newNotificationHtml);
notificationsCount += 1;
notificationsCountElem.attr('data-count', notificationsCount);
notificationsWrapper.find('.notif-count').text(notificationsCount);
notificationsWrapper.show();
    });
</script>
@endif



@if(auth('doctor')->check())
<script>
    var notificationsWrapper = $('.dropdown-notifications');
    var notificationsCountElem = notificationsWrapper.find('span[data-count]');
    var notificationsCount = parseInt(notificationsCountElem.data('count'));
    var notifications = notificationsWrapper.find('div.notification-label');
    var new_message = notificationsWrapper.find('.new_message');
    new_message.hide();
    Echo.private('create-invoice.{{ auth()->user()->id }}').listen('.create-invoice',
    (data) => {
    var newNotificationHtml = `
    <a class="dropdown-item" href="/doctor/patient_details/` + data.invoice_id + `">
        <h4 class="notification-label mb-1">` + data.message + data.patient + `</h4>
        <div class="notification-subtext">` + data.created_at + `</div>
    </a>`;

    new_message.show();
    notifications.html(newNotificationHtml);
    notificationsCount += 1;
    notificationsCountElem.attr('data-count', notificationsCount);
    notificationsWrapper.find('.notif-count').text(notificationsCount);
    notificationsWrapper.show();
    });
</script>
@endif