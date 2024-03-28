<header class="header" data-header>
    <div class="container">
        <a href="#" class="logo">
            <img src="{{asset('WebSite/assets/images/logo.svg')}}" width="136" height="46" alt="Hospital home">
        </a>
        <nav class="navbar" data-navbar>
            <div class="navbar-top">
                <a href="#" class="logo">
                    <img src="{{asset('WebSite/assets/images/logo.svg')}}" width="136" height="46" alt="Hospital home">
                </a>
                <button class="nav-close-btn" aria-label="clsoe menu" data-nav-toggler>
                    <ion-icon name="close-outline" aria-hidden="true"></ion-icon>
                </button>
            </div>
            <ul class="navbar-list">
                <li class="navbar-item">
                    <a href="#" class="navbar-link title-md">Home</a>
                </li>
                <li class="navbar-item">
                    <a href="#" class="navbar-link title-md">Doctors</a>
                </li>
                <li class="navbar-item">
                    <a href="#" class="navbar-link title-md">Services</a>
                </li>
                <li class="navbar-item">
                    <a href="#" class="navbar-link title-md">Blog</a>
                </li>
                <li class="navbar-item">
                    <a href="#" class="navbar-link title-md">Contact</a>
                </li>
                <li class="navbar-item">
                    <a class="navbar-link title-md" title="تسجيل دخول" href="{{route('login')}}">Login</a>
                </li>
            </ul>
            <ul class="social-list">
                <li>
                    <a href="#" class="social-link">
                        <ion-icon name="logo-twitter"></ion-icon>
                    </a>
                </li>

                <li>
                    <a href="#" class="social-link">
                        <ion-icon name="logo-facebook"></ion-icon>
                    </a>
                </li>

                <li>
                    <a href="#" class="social-link">
                        <ion-icon name="logo-pinterest"></ion-icon>
                    </a>
                </li>

                <li>
                    <a href="#" class="social-link">
                        <ion-icon name="logo-instagram"></ion-icon>
                    </a>
                </li>

                <li>
                    <a href="#" class="social-link">
                        <ion-icon name="logo-youtube"></ion-icon>
                    </a>
                </li>

            </ul>

        </nav>

        <button class="nav-open-btn" aria-label="open menu" data-nav-toggler>
            <ion-icon name="menu-outline"></ion-icon>
        </button>

        <a href="#" class="btn has-before title-md">Make Appointment</a>

        <div class="overlay" data-nav-toggler data-overlay></div>

    </div>
</header>