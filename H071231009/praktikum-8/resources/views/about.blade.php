@extends('layouts/master')

@section('title', 'About')

@section('content')
    <div class="About about mb-5">
        <h1 class="text-center title">About</h1>
        <div class="row my-4 about-content">
            <div class="col-lg-5 about-column">
                <p>Selamat datang di Book Magis, dunia di mana kata-kata menghidupkan imajinasi dan membawa Anda pada petualangan tak terlupakan. Di sini, setiap halaman adalah jendela menuju dimensi lain, di mana keajaiban, misteri, dan petualangan menunggu untuk ditemukan.</p>
            </div>
            <div class="col-lg-6 offset-lg-1 about-column">
                <p>Pada Book Magis, kami percaya bahwa buku bukan hanya sekadar kumpulan kata-kata, tetapi portal menuju dunia yang penuh dengan keajaiban. Dari kisah klasik hingga novel modern, setiap cerita memiliki daya tarik dan pesona yang unik, mengajak pembaca untuk merasakan pengalaman baru dan menyelami kedalaman pikiran penulis.</p>
            </div>
        </div>
        <div class="row kotak-card" style="display: flex; justify-content: center; gap: 20px;">
            <div class="card" style="width: 14rem;background-color: rgba(235, 196, 196, 0.642);">
                <img src="https://i.pinimg.com/474x/60/86/09/608609cb613363a4bec0992fd87c1f9f.jpg" class="card-img-top mt-3" alt="..." height="250px">
                <div class="card-body">
                    <h4>Harry Potter</h4>
                    <a href="https://g.co/kgs/NFwXbZp" class="btn">Lihat Buku</a>
                </div>
            </div>
            <div class="card" style="width: 14rem;background-color: rgba(235, 196, 196, 0.642);">
                <img src="https://i.pinimg.com/736x/c0/b1/2b/c0b12bbc373b6ca38d0b44ae613dbca5.jpg" class="card-img-top mt-3" alt="..." height="250px">
                <div class="card-body">
                    <h4>Jumanji</h4>
                    <a href="https://id.wikipedia.org/wiki/Jumanji_(waralaba)" class="btn">Lihat Buku</a>
                </div>
            </div>
            <div class="card" style="width: 14rem;background-color: rgba(235, 196, 196, 0.642);">
                <img src="https://i.pinimg.com/736x/e1/90/37/e19037ca94de450a1e8937699e649c85.jpg" class="card-img-top mt-3" alt="..." height="250px">
                <div class="card-body">
                    <h4>Narnia</h4>
                    <a href="https://g.co/kgs/wdPrgQK" class="btn">Lihat Buku</a>
                </div>
            </div>
        </div>
    </div>

@endsection