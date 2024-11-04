@extends('layouts.main')
@section('content')
<section class="gallery" id="gallery">
    <div class="gallery-content">
        <h1 style="color: #AF69EF;">Gallery</h1>
        <div>
            <img src="{{ asset("Image/ervinProfile.jpg")}}" alt="">
            <img src="{{ asset("Image/ervinProfile.jpg")}}" alt="">
            <img src="{{ asset("Image/ervinProfile.jpg")}}" alt="">
            <img src="{{ asset("Image/ervinProfile.jpg")}}" alt="">
            <img src="{{ asset("Image/ervinProfile.jpg")}}" alt="">
            <img src="{{ asset("Image/ervinProfile.jpg")}}" alt="">
        </div>
    </div>
</section>
@endsection

