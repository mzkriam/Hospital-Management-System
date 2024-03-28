@extends('WebSite.master')
@section('content')
<main>
    <article>
        <section class="section hero" style="background-image:url('/WebSite/assets/images/hero-bg.png"
            aria-label="home">
            <div class="container">
                <div class="hero-content">
                    <p class="hero-subtitle has-before" data-reveal="left">Welcome To Hospital</p>
                    <h1 class="headline-lg hero-title" data-reveal="left">
                        Find Nearest <br>
                        Doctor.
                    </h1>
                    <div class="hero-card" data-reveal="left">
                        <p class="title-lg card-text">
                            Search doctors. clinics. hospitals. etc.
                        </p>

                        <div class="wrapper">
                            <div class="input-wrapper title-lg">
                                <input type="text" name="location" placeholder="Locations" class="input-field">
                                <ion-icon name="location"></ion-icon>
                            </div>
                            <button class="btn has-before">
                                <ion-icon name="search"></ion-icon>

                                <span class="span title-md">Find Now</span>
                            </button>
                        </div>
                    </div>
                </div>
                <figure class="hero-banner" data-reveal="right">
                    <img src="{{asset('WebSite/assets/images/hero-banner.png')}}" width="590" height="517"
                        loading="eager" alt="hero banner" class="w-100">
                </figure>
            </div>
        </section>

        <section class="service" aria-label="service">
            <div class="container">
                <ul class="service-list">
                    <li>
                        <div class="service-card" data-reveal="bottom">
                            <div class="card-icon">
                                <img src="{{asset('WebSite/assets/images/icon-1.png')}}" width="71" height="71"
                                    loading="lazy" alt="icon">
                            </div>
                            <h3 class="headline-sm card-title">
                                <a href="#">Psychiatry</a>
                            </h3>

                            <p class="card-text">
                                Lorem ipsum dolor sit amet, consectetur adipisicing
                            </p>

                            <button class="btn-circle" aria-label="read more about psychiatry">
                                <ion-icon name="arrow-forward" aria-hidden="true"></ion-icon>
                            </button>

                        </div>
                    </li>

                    <li>
                        <div class="service-card" data-reveal="bottom">

                            <div class="card-icon">
                                <img src="{{asset('WebSite/assets/images/icon-2.png')}}" width="71" height="71"
                                    loading="lazy" alt="icon">
                            </div>

                            <h3 class="headline-sm card-title">
                                <a href="#">Gynecology</a>
                            </h3>

                            <p class="card-text">
                                Lorem ipsum dolor sit amet, consectetur adipisicing
                            </p>

                            <button class="btn-circle" aria-label="read more about Gynecology">
                                <ion-icon name="arrow-forward" aria-hidden="true"></ion-icon>
                            </button>

                        </div>
                    </li>

                    <li>
                        <div class="service-card" data-reveal="bottom">

                            <div class="card-icon">
                                <img src="{{asset('WebSite/assets/images/icon-3.png')}}" width="71" height="71"
                                    loading="lazy" alt="icon">
                            </div>

                            <h3 class="headline-sm card-title">
                                <a href="#">Pulmonology</a>
                            </h3>

                            <p class="card-text">
                                Lorem ipsum dolor sit amet, consectetur adipisicing
                            </p>

                            <button class="btn-circle" aria-label="read more about Pulmonology">
                                <ion-icon name="arrow-forward" aria-hidden="true"></ion-icon>
                            </button>

                        </div>
                    </li>

                    <li>
                        <div class="service-card" data-reveal="bottom">

                            <div class="card-icon">
                                <img src="{{asset('WebSite/assets/images/icon-4.png')}}" width="71" height="71"
                                    loading="lazy" alt="icon">
                            </div>

                            <h3 class="headline-sm card-title">
                                <a href="#">Orthopedics</a>
                            </h3>

                            <p class="card-text">
                                Lorem ipsum dolor sit amet, consectetur adipisicing
                            </p>

                            <button class="btn-circle" aria-label="read more about Orthopedics">
                                <ion-icon name="arrow-forward" aria-hidden="true"></ion-icon>
                            </button>

                        </div>
                    </li>

                </ul>

            </div>
        </section>

        <section class="section about" aria-labelledby="about-label">
            <div class="container">
                <div class="about-content">
                    <p class="section-subtitle title-lg has-after" id="about-label" data-reveal="left">About Us</p>
                    <h2 class="headline-md" data-reveal="left">Experienced Workers</h2>
                    <p class="section-text" data-reveal="left">
                        Aliquam faucibus, odio nec commodo aliquam, neque felis placerat dui, a porta ante lectus
                        dapibus est.
                        Aliquam
                    </p>
                    <ul class="tab-list" data-reveal="left">

                        <li>
                            <button class="tab-btn active">Vision</button>
                        </li>

                        <li>
                            <button class="tab-btn">Mission</button>
                        </li>

                        <li>
                            <button class="tab-btn">Strategy</button>
                        </li>

                    </ul>
                    <p class="tab-text" data-reveal="left">
                        Aliquam faucibus, odio nec commodo aliquam, neque felis placerat dui, a porta ante lectus
                        dapibus est.
                        Aliquam a bibendum mi, sed condimentum
                    </p>
                    <div class="wrapper">
                        <ul class="about-list">
                            <li class="about-item" data-reveal="left">
                                <ion-icon name="checkmark-circle-outline"></ion-icon>
                                <span class="span">Sonsectetur adipisicing elit</span>
                            </li>
                            <li class="about-item" data-reveal="left">
                                <ion-icon name="checkmark-circle-outline"></ion-icon>
                                <span class="span">Exercitation ullamco laboris</span>
                            </li>
                            <li class="about-item" data-reveal="left">
                                <ion-icon name="checkmark-circle-outline"></ion-icon>
                                <span class="span">Eiusmod tempor incididunt</span>
                            </li>
                            <li class="about-item" data-reveal="left">
                                <ion-icon name="checkmark-circle-outline"></ion-icon>
                                <span class="span">Aolore magna aliqua</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <figure class="about-banner" data-reveal="right">
                    <img src="{{asset('WebSite/assets/images/about-banner.png')}}" width="554" height="678"
                        loading="lazy" alt="about banner" class="w-100">
                </figure>
            </div>
        </section>
        <section class="section appointment-section-two">
            <div class="container">
                <livewire:appointments.external.add>
            </div>
        </section>
        <section class="section listing" aria-labelledby="listing-label">
            <div class="container">

                <ul class="grid-list">

                    <li>
                        <p class="section-subtitle title-lg" id="listing-label" data-reveal="left">Doctors Listig
                        </p>

                        <h2 class="headline-md" data-reveal="left">Browse by specialist</h2>
                    </li>

                    <li>
                        <div class="listing-card" data-reveal="bottom">

                            <div class="card-icon">
                                <img src="{{asset('WebSite/assets/images/icon-1.png')}}" width="71" height="71"
                                    loading="lazy" alt="icon">
                            </div>

                            <div>
                                <h3 class="headline-sm card-title">Psychiatry</h3>

                                <p class="card-text">Porta velit</p>
                            </div>

                        </div>
                    </li>

                    <li>
                        <div class="listing-card" data-reveal="bottom">

                            <div class="card-icon">
                                <img src="{{asset('WebSite/assets/images/icon-2.png')}}" width="71" height="71"
                                    loading="lazy" alt="icon">
                            </div>

                            <div>
                                <h3 class="headline-sm card-title">Gynecology</h3>

                                <p class="card-text">Mattis augue</p>
                            </div>

                        </div>
                    </li>

                    <li>
                        <div class="listing-card" data-reveal="bottom">

                            <div class="card-icon">
                                <img src="{{asset('WebSite/assets/images/icon-4.png')}}" width="71" height="71"
                                    loading="lazy" alt="icon">
                            </div>

                            <div>
                                <h3 class="headline-sm card-title">Pulmonology</h3>

                                <p class="card-text">Mauris laoreet</p>
                            </div>

                        </div>
                    </li>

                    <li>
                        <div class="listing-card" data-reveal="bottom">

                            <div class="card-icon">
                                <img src="{{asset('WebSite/assets/images/icon-5.png')}}" width="71" height="71"
                                    loading="lazy" alt="icon">
                            </div>

                            <div>
                                <h3 class="headline-sm card-title">Orthopedics</h3>

                                <p class="card-text">Convallis vulputate</p>
                            </div>

                        </div>
                    </li>

                    <li>
                        <div class="listing-card" data-reveal="bottom">

                            <div class="card-icon">
                                <img src="{{asset('WebSite/assets/images/icon-6.png')}}" width="71" height="71"
                                    loading="lazy" alt="icon">
                            </div>

                            <div>
                                <h3 class="headline-sm card-title">Pediatrics</h3>

                                <p class="card-text">Posuere maecenas</p>
                            </div>

                        </div>
                    </li>

                    <li>
                        <div class="listing-card" data-reveal="bottom">

                            <div class="card-icon">
                                <img src="{{asset('WebSite/assets/images/icon-7.png')}}" width="71" height="71"
                                    loading="lazy" alt="icon">
                            </div>

                            <div>
                                <h3 class="headline-sm card-title">Osteology</h3>

                                <p class="card-text">Nisi nullam</p>
                            </div>

                        </div>
                    </li>

                </ul>

            </div>
        </section>


        <section class="section blog" aria-labelledby="blog-label">
            <div class="container">

                <p class="section-subtitle title-lg text-center" id="blog-label" data-reveal="bottom">
                    News & Article
                </p>

                <h2 class="section-title headline-md text-center" data-reveal="bottom">Latest Articles</h2>

                <ul class="grid-list">

                    <li>
                        <div class="blog-card has-before has-after" data-reveal="bottom">

                            <div class="meta-wrapper">

                                <div class="card-meta">
                                    <ion-icon name="person-outline"></ion-icon>

                                    <span class="span">By Admin</span>
                                </div>

                                <div class="card-meta">
                                    <ion-icon name="folder-outline"></ion-icon>

                                    <span class="span">Specialist</span>
                                </div>

                            </div>

                            <h3 class="headline-sm card-title">Could intermittent fasting reduce breast cancer</h3>

                            <time class="title-sm date" datetime="2022-01-28">28 January, 2022</time>

                            <p class="card-text">
                                Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod
                                tempor invidunt ut
                                labore et dolore magna aliquyam erat
                            </p>

                            <a href="#" class="btn-text title-lg">Read More</a>

                        </div>
                    </li>

                    <li>
                        <div class="blog-card has-before has-after" data-reveal="bottom">

                            <div class="meta-wrapper">

                                <div class="card-meta">
                                    <ion-icon name="person-outline"></ion-icon>
                                    <span class="span">By Admin</span>
                                </div>
                                <div class="card-meta">
                                    <ion-icon name="folder-outline"></ion-icon>
                                    <span class="span">Specialist</span>
                                </div>
                            </div>
                            <h3 class="headline-sm card-title">Give children more autonomy during the pandemic</h3>
                            <time class="title-sm date" datetime="2022-01-28">28 January, 2022</time>
                            <p class="card-text">
                                Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod
                                tempor invidunt ut
                                labore et dolore magna aliquyam erat
                            </p>
                            <a href="#" class="btn-text title-lg">Read More</a>
                        </div>
                    </li>
                    <li>
                        <div class="blog-card has-before has-after" data-reveal="bottom">
                            <div class="meta-wrapper">
                                <div class="card-meta">
                                    <ion-icon name="person-outline"></ion-icon>
                                    <span class="span">By Admin</span>
                                </div>
                                <div class="card-meta">
                                    <ion-icon name="folder-outline"></ion-icon>
                                    <span class="span">Specialist</span>
                                </div>
                            </div>
                            <h3 class="headline-sm card-title">How do binge eating and drinking impact the liver?
                            </h3>
                            <time class="title-sm date" datetime="2022-01-28">28 January, 2022</time>
                            <p class="card-text">
                                Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod
                                tempor invidunt ut
                                labore et dolore magna aliquyam erat
                            </p>
                            <a href="#" class="btn-text title-lg">Read More</a>
                        </div>
                    </li>
                </ul>
            </div>
        </section>
    </article>
</main>
@endsection