<!DOCTYPE html>
<html>

<head>
    <title>Slide Navbar</title>
    <link rel="stylesheet" href="{{asset('login/assets/css/style.css')}}">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <style>
        .panel {
            display: none;
        }
    </style>
</head>

<body>
    <section> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span>
        <div class="main">
            <input type="checkbox" id="chk" aria-hidden="true">
            <div class="signup">
                <label for="chk" aria-hidden="true">{{trans('Auth/login.login')}}</label>
                <select class="select" id="sectionChooser">
                    <option selected value="" disabled>{{trans('Auth/login.open')}}</option>
                    <option value="user">{{trans('Auth/login.user')}}</option>
                    <option value="admin">{{trans('Auth/login.admin')}}</option>
                    <option value="patient">{{trans('Auth/login.patient')}}</option>
                    <option value="doctor">{{trans('Auth/login.doctor')}}</option>
                    <option value="ray_employee">{{trans('Auth/login.ray_employee')}}</option>
                    <option value="laboratory_employee">{{trans('Auth/login.laboratory_employee')}}</option>
                    <option value="pharmacy_employee">{{trans('Auth/login.pharmacy_employee')}}</option>
                    <option value="reception_employee">{{trans('Auth/login.reception_employee')}}</option>
                    <option value="accounting_employee">{{trans('Auth/login.accounting_employee')}}</option>
                </select>
                <div class="panel" id="user">
                    <h5 class="auth">{{trans('Auth/login.login_as_user')}}</h5>
                    <form method="POST" action="{{ route('user.login') }}">
                        @csrf
                        <input type="email" name="email" placeholder="{{trans('Auth/login.email')}}"
                            :value="old('email')" required>
                        <input placeholder="{{trans('Auth/login.enter_password')}}" type="password" name="password"
                            required autocomplete="current-password">
                        <button type="submit">{{trans('Auth/login.login')}}</button>
                    </form>
                </div>
                {{-- Begin Form Admin --}}
                <div class="panel" id="admin">
                    <h5 class="auth">{{trans("Auth/login.login_as_admin")}}
                    </h5>
                    <form method="POST" action="{{ route('admin.login') }}">
                        @csrf
                        <input type="email" name="email" placeholder="{{trans('Auth/login.email')}}"
                            :value="old('email')" required>
                        <input placeholder="{{trans('Auth/login.enter_password')}}" type="password" name="password"
                            required autocomplete="current-password">
                        <button type="submit">{{trans('Auth/login.login')}}</button>
                    </form>
                </div>
                {{-- Begin Form patient --}}
                <div class="panel" id="patient">
                    <h5 class="auth">
                        {{trans("Auth/login.login_as_patient")}}
                    </h5>
                    <form method="POST" action="{{ route('patient.login') }}">
                        @csrf
                        <input type="email" name="email" placeholder="{{trans('Auth/login.email')}}"
                            :value="old('email')" required>
                        <input placeholder="{{trans('Auth/login.enter_password')}}" type="password" name="password"
                            required autocomplete="current-password">
                        <button type="submit">{{trans('Auth/login.login')}}</button>
                    </form>
                </div>
                {{-- Begin Form doctor --}}
                <div class="panel" id="doctor">
                    <h5 class="auth">
                        {{trans("Auth/login.login_as_doctor")}}
                    </h5>
                    <form method="POST" action="{{ route('doctor.login') }}">
                        @csrf
                        <input type="email" name="email" placeholder="{{trans('Auth/login.email')}}"
                            :value="old('email')" required>
                        <input placeholder="{{trans('Auth/login.enter_password')}}" type="password" name="password"
                            required autocomplete="current-password">
                        <button type="submit">{{trans('Auth/login.login')}}</button>
                    </form>
                </div>
                {{-- Begin Form ray_employee --}}
                <div class="panel" id="ray_employee">
                    <h5 class="auth">
                        {{trans("Auth/login.login_as_ray_employee")}}
                    </h5>
                    <form method="POST" action="{{ route('ray_employee.login') }}">
                        @csrf
                        <input type="email" name="email" placeholder="{{trans('Auth/login.email')}}"
                            :value="old('email')" required>
                        <input placeholder="{{trans('Auth/login.enter_password')}}" type="password" name="password"
                            required autocomplete="current-password">
                        <button type="submit">{{trans('Auth/login.login')}}</button>
                    </form>
                </div>
                {{-- Begin Form LaboratoryEmployee --}}
                <div class="panel" id="laboratory_employee">
                    <h5 class="auth">
                        {{trans("Auth/login.login_as_laboratory_employee")}}
                    </h5>
                    <form method="POST" action="{{ route('laboratory_employee.login') }}">
                        @csrf
                        <input type="email" name="email" placeholder="{{trans('Auth/login.email')}}"
                            :value="old('email')" required>
                        <input placeholder="{{trans('Auth/login.enter_password')}}" type="password" name="password"
                            required autocomplete="current-password">
                        <button type="submit">{{trans('Auth/login.login')}}</button>
                    </form>
                </div>
                {{-- Begin Form PharmacyEmployee --}}
                <div class="panel" id="pharmacy_employee">
                    <h5 class="auth">
                        {{trans("Auth/login.login_as_pharmacy_employee")}}
                    </h5>
                    <form method="POST" action="{{ route('pharmacy_employee.login') }}">
                        @csrf
                        <input type="email" name="email" placeholder="{{trans('Auth/login.email')}}"
                            :value="old('email')" required>
                        <input placeholder="{{trans('Auth/login.enter_password')}}" type="password" name="password"
                            required autocomplete="current-password">
                        <button type="submit">{{trans('Auth/login.login')}}</button>
                    </form>
                </div>
                {{-- Begin Form ReceptionEmployee --}}
                <div class="panel" id="reception_employee">
                    <h5 class="auth">
                        {{trans("Auth/login.login_as_reception_employee")}}
                    </h5>
                    <form method="POST" action="{{ route('reception_employee.login') }}">
                        @csrf
                        <input type="email" name="email" placeholder="{{trans('Auth/login.email')}}"
                            :value="old('email')" required>
                        <input placeholder="{{trans('Auth/login.enter_password')}}" type="password" name="password"
                            required autocomplete="current-password">
                        <button type="submit">{{trans('Auth/login.login')}}</button>
                    </form>
                </div>
                <div class="panel" id="accounting_employee">
                    <h5 class="auth">
                        {{trans("Auth/login.login_as_accounting_employee")}}
                    </h5>
                    <form method="POST" action="{{ route('accounting_employee.login') }}">
                        @csrf
                        <input type="email" name="email" placeholder="{{trans('Auth/login.email')}}"
                            :value="old('email')" required>
                        <input placeholder="{{trans('Auth/login.enter_password')}}" type="password" name="password"
                            required autocomplete="current-password">
                        <button type="submit">{{trans('Auth/login.login')}}</button>
                    </form>
                </div>
            </div>
            <div class="login">
                <form>
                    <label for="chk" aria-hidden="true">Login</label>
                    <input type="email" name="email" placeholder="Email" required="">
                    <input type="password" name="pswd" placeholder="Password" required="">
                    <button>Login</button>
                </form>
            </div>
        </div>
    </section>
</body>
<script>
    $('#sectionChooser').change(function(){
        var myId = $(this).val();
        $('.panel').each(function(){
        myId === $(this).attr('id') ? $(this).show() : $(this).hide();
        });
        })
</script>

</html>