@extends('layouts.master')

@section('title', 'Home')

@section('content')
    <div class="home">
        <div class="row">
            <div class="col-lg-4 offset-lg-2 col-md-6 col-12 kiri">
                <h1 class="title">Gerbang Menuju Ke<span class="highlight">ajaib</span>an</h1>
                <p class="description">Memulai perjalanan ke dunia yang tersembunyi di antara bintang dan bayangan, di mana rahasia magis menunggu untuk diungkap.</p>
                <button class="choose-button mb-5"><a href="{{ route('about') }}">Pilih Jalanmu</a></button>
            </div>
            <div class="col-4 kanan">
                <div class="img">
                    <img src="{{ URL('images/Book.jpeg') }}" alt="Magic Book" width="350px">
                </div>
            </div>
        </div>
    </div>
@endsection
