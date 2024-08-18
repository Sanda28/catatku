@extends('layout.app')

@section('title', 'Home')

@section('content')
    <section class="hero">
        <div class="container">
            <h1>Kelola Keuangan Anda dengan Mudah</h1>
            <p>Catat pemasukan dan pengeluaran dengan cepat, pantau keuangan Anda kapan saja.</p>
            <a href="#" class="cta-button">Mulai Sekarang</a>
        </div>
    </section>

    <section class="features">
        <div class="container">
            <h2>Fitur Utama</h2>
            <div class="feature-grid">
                <div class="feature">
                    <img src="#" alt="Icon Pencatatan">
                    <h3>Pencatatan Transaksi</h3>
                    <p>Catat pemasukan dan pengeluaran dengan mudah dan cepat.</p>
                </div>
                <div class="feature">
                    <img src="#" alt="Icon Pelaporan">
                    <h3>Pelaporan Lengkap</h3>
                    <p>Dapatkan laporan keuangan dalam berbagai format.</p>
                </div>
                <div class="feature">
                    <img src="#" alt="Icon Analisis">
                    <h3>Analisis Keuangan</h3>
                    <p>Pantau dan analisis pengeluaran Anda untuk pengambilan keputusan yang lebih baik.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="testimonials">
        <div class="container">
            <h2>Testimoni Pengguna</h2>
            <div class="testimonial">
                <p>"Aplikasi ini sangat membantu saya dalam mengelola keuangan pribadi saya."</p>
                <span>- User A</span>
            </div>
            <div class="testimonial">
                <p>"Sekarang saya bisa lebih mudah mengontrol pengeluaran saya setiap bulan."</p>
                <span>- User B</span>
            </div>
        </div>
    </section>
@endsection
