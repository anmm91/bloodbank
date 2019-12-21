<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />


    <!-- website font  -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
          integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="{{asset('front/css/swiper.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('front/css/animate.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('front/css/style.css')}}" />

    @yield('page-title')

<body>

<!-- Navbar 1 Start -->
<section id="Nav1">
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <div class="container">
            <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <i class="fas fa-phone-volume" style="border-right: 1px solid gray;"> +20 127 245 6884
                            &nbsp; &nbsp; </i>
                    </li>
                    <li class="nav-item">
                        <i class="far fa-envelope" style="padding-left: 15px;"> InfoBloodBank@gmail.com</i>
                    </li>
                </ul>
            </div>
            <div class="mx-auto order-0 navbar-brand mx-auto">
                <a href="https://www.instagram.com/ipda3.tech/"><i
                        class="fab fa-instagram github">&nbsp;&nbsp;</i></a>
                <a href="https://www.facebook.com/ipda3tech/"><i
                        class="fab fa-facebook-f facebook">&nbsp;&nbsp;</i></a>
                <a href="https://twitter.com/ipda3_tech"><i class="fab fa-twitter twitter">&nbsp;&nbsp;</i></a>
                <a href="https://api.whatsapp.com/send?phone=+201097571186"><i
                        class="fab fa-whatsapp whats">&nbsp;&nbsp;</i></a>
            </div>
            <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link selected" style="border-right: 1px solid gray;" href="#">EN &nbsp;</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" style="padding-left: 15px;" href="#">AR</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</section>
<!-- Navbar 1 End -->

<!-- Navbar 2 Start -->
<section id="Nav2">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <img src="{{asset('front/imgs/logo.png')}}" width="18%"></img>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link selected" href="{{url('front/index')}}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('front/about-us')}}">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href={{url('front/articles')}}>Articles</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('front/donations')}}">Donations</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('front/create-donations')}}">create Donation</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('front/who-are-you')}}">Who We Are ?</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('front/contact-us')}}">Contact Us</a>
                </li>
            </ul>
            <button class="btn signup" onclick= "window.location.href = '{{url('front/signup')}}';">New Account</button>
            <button class="btn login" onclick= "window.location.href = '{{url('front/login')}}';">Login</button>
{{--            <a class="btn login" href = "{{url('front/logout')}}">Logout</a>--}}
            <li>
                <script type="">
                    function submitSignout() {
                        document.getElementById('signoutForm').submit();

                    }
                </script>
                {!! Form::open(['method' => 'post', 'url' => url('logout'),'id'=>'signoutForm']) !!}

                {!! Form::close() !!}

                <a href="#" onclick="submitSignout()">
                    <i class="fa fa-sign-out"></i> تسجيل الخروج
                </a>
            </li>
        </div>
    </nav>
</section>
<!-- Navbar 2 End -->

@yield('content')
<!-- Footer Start -->
<section id="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <div class="foot-info">
                    <img src="{{asset('front/imgs/logo.png')}}" alt="">
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quos ut sit natus earum ea cum
                        doloremque fugit. Sit non ex suscipit fugiat molestias, ipsa rerum tempore voluptates
                        adipisci rem cum?</p>
                </div>
            </div>
            <div class="col-md-3">
                <ul class="menu">
                    <a href="{{url('front/index')}}">
                        <li>Home</li>
                    </a>
                    <a href="{{url('front/about-us')}}">
                        <li>About Us</li>
                    </a>
                    <a href="#articles">
                        <li>Articles</li>
                    </a>
                    <a href="{{url('front/donations')}}">
                        <li>Donations</li>
                    </a>

                    <a href="{{url('front/who-are-you')}}">
                        <li>Who We Are?</li>
                    </a>
                    <a href="{{url('front/contact-us')}}">
                        <li>Contact Us</li>
                    </a>
                </ul>
            </div>
            <div class="col-md-4">
                <ul class="options">
                    <li>
                        <h5>Available On</h5>
                    </li>
                    <li><img src="{{asset('front/imgs/ios1.png')}}" alt=""></li>
                    <li><img src="{{asset('front/imgs/google1.png')}}" alt=""></li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!-- Footer End -->

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script type="text/javascript" src="{{asset('front/js/swiper.min.js')}}"></script>
<script type="text/javascript" src="{{asset('front/js/wow.min.js')}}"></script>
<script type="text/javascript" src="{{asset('front/js/main.js')}}"></script>
@stack('scripts')
</body>

</html>
