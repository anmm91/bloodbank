@extends('front.layouts.app')
@section('page-title')
    <title>login</title>
@endsection
@section('content')
    <!-- Navigator Start -->
    <section id="navigator">
        <div class="container">
            <div class="path">
                <div class="path-main" style="color: darkred; display:inline-block;">Home</div>
                <div class="path-directio" style="color: grey; display:inline-block;"> / Login</div>
            </div>

        </div>
    </section>
    <!-- Navigator End -->

    <!-- Login Start -->
    <section id="login">
        <div class="container">
            <img src="imgs/logo.png" alt="">
            <form action="{{url('front/login')}}" method="post">
                @csrf
                <input class="username" type="text" name="email" placeholder="Email" required>
                <input class="password" type="password" name="password" placeholder="Password" required>
                <input class="check" type="checkbox">Remember me
                <a href="#">Forget Password ?</a><br>
                <div class="reg-group">
                    <input style="background-color: darkred;" type="submit">Login</input>
                    <button style="background-color: rgb(51, 58, 65);">Make new account</button>
                </div>
            </form>
        </div>
    </section>
    <!-- Login End -->
@endsection
