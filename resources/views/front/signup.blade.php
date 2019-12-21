@extends('front.layouts.app')
@section('page-title')
    <title>signup</title>
@endsection
@section('content')
    <!-- Navigator Start -->
    <section id="navigator">
        <div class="container">
            <div class="path">
                <div class="path-main" style="color: darkred; display:inline-block;">Home</div>
                <div class="path-directio" style="color: grey; display:inline-block;"> / Sign up</div>
            </div>

        </div>
    </section>
    <!-- Navigator End -->

    <!-- Sign Up Start -->
    <section id="sign-up">
        <div class="container">
            <img src="{{asset('front/imgs/logo.png')}}" alt="">
            @include('flash::message')
            <form action="{{url('front/signup')}}" method="post">
                @csrf
                <input type="text"  name="name" placeholder="Name" required>
                <input type="password"  name="password" placeholder="Password" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="date" name="dob" placeholder="Birth date">
                <select name="blood_type_id" id="type" required="">
                    <option value="Blood Type">Blood Type</option>
                    @foreach($blood_types as $blood_type)
                        <option value="{{$blood_type->id}}">{{$blood_type->name}}</option>
                    @endforeach

                </select>
                <select name="gov_id" id="Gov" required="">
                    <option value="gov" >Governorates</option>
                    @foreach($governorates as $gov)
                        <option  value="{{$gov->id}}">{{$gov->name}}</option>
                    @endforeach

                </select>
                <select name="city_id" id="city" required="">
                    <option value="City">City</option>




                </select>
                <input type="Phone" name="phone" placeholder="Phone Number" required="">
                <input type="date" name="last_donation_date">
                <div class="reg-group">
                    <input class="check" type="checkbox" required="" style="height: auto; display:inline; margin: 0 auto;">Agree on terms and conditions<br>
                    <button class="submit" type="submit" style="background-color: rgb(51, 58, 65);">Submit</button>
                </div>
            </form>
        </div>
    </section>
    <!-- Sign Up End -->
    @push('scripts')
        <script>
            $('#Gov').change(function (e) {
                // alert('good');
                e.preventDefault();
                //get gov

                //send ajax

                //append cities
                var governorate_id=$('#Gov').val();
                if(governorate_id){
                    $.ajax({
                        url:'{{url('api/v1/cities?governorate_id=')}}'+governorate_id ,
                        type:'get',
                        success:function (data) {

                            if(data.status==1){
                                $('#city').empty();
                                $('#city').append('<option value=""> city</option>');

                                $.each(data.data ,function (index, city) {
                                    $('#city').append('<option value="'+city.id+'">'+city.name+'</option>');
                                });

                            }
                        }
                    });

                }else{
                    $('#city').empty();
                    $('#city').append('<option value=""> city</option>');

                }



            });

        </script>

    @endpush
@endsection
