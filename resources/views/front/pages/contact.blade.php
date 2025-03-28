@extends('front.layout.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Hubungi Kami')
@section('meta_tags')
{!! SEO::generate() !!}
@endsection
@section('content')
<aside class="single-header">
    <div class="container">
        <div class="row">
            <div class="col-md-12 breadcrumbs">
                <p>
                    <span>
                        <a href="{{ url('/') }}">Home</a>
                    </span> /
                    <span>Contact</span>
                </p>
            </div>
        </div>
    </div>
</aside>
<main class="main">
    <div class="container">
        <div class="row">
            <!-- Bagian Formulir Kontak -->
            <div class="col-md-8">
                <div class="contact-text">
                    <div class="section-title">
                        <h3 class="title">Hubungi Kami</h3>
                    </div>
                    <p>
                        Kami menghargai setiap masukan dan pertanyaan Anda. Silakan isi formulir di bawah ini, dan tim kami akan segera menghubungi Anda. Apakah Anda memiliki pertanyaan, saran, atau membutuhkan bantuan? Kami siap membantu.
                    </p>
                </div>
                <form class="form-contact" action="{{ route('contact') }}" method="POST">
                    @csrf
                    <x-form-alerts></x-form-alerts>
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" name="name" class="form-control" placeholder="Nama Anda" value="{{ old('name') }}">
                            @error('name')
                                <span class="text-danger ml-1" >{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <input type="email" name="email" class="form-control" placeholder="Email Anda" value="{{ old('email') }}">
                            @error('email')
                                <span class="text-danger ml-1" >{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <input type="text" name="subject" class="form-control" placeholder="Subjek" value="{{ old('subject') }}">
                            @error('subject')
                            <span class="text-danger ml-1" >{{ $message }}</span>
                        @enderror
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <textarea name="message" class="form-control" placeholder="Pesan Anda" rows="5" value="{{ old('message') }}"></textarea>
                            @error('message')
                            <span class="text-danger ml-1" >{{ $message }}</span>
                        @enderror
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary btn-block">Kirim Pesan</button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Bagian Informasi Kontak -->
            <div class="col-md-4">
                <div class="sidebar">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="section-title">
                                <h4 class="title">Informasi Kontak</h4>
                            </div>
                            <div class="contact-info">
                                <p class="address">
                                    <strong>Alamat Kantor:</strong><br>
                                    Jalan Raya Utama No. 123,<br>
                                    Jakarta, Indonesia
                                </p>
                                <p class="phone">
                                    <i class="fa fa-phone-square"></i>
                                    <strong>Telepon:</strong> +62 812 3456 7890
                                </p>
                                <p class="email">
                                    <i class="fa fa-envelope"></i>
                                    <strong>Email:</strong> <a href="mailto:support@email.com">support@email.com</a>
                                </p>
                                <p class="web">
                                    <i class="fa fa-globe"></i>
                                    <strong>Website:</strong> <a href="http://urlsite.com">www.urlsite.com</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="section-title">
                                <h4 class="title">Ikuti Kami</h4>
                            </div>
                            <ul class="social-links">
                                <li><a href="#"><i class="fab fa-twitter-square"></i></a></li>
                                <li><a href="#"><i class="fab fa-facebook-square"></i></a></li>
                                <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fab fa-youtube-square"></i></a></li>
                                <li><a href="#"><i class="fab fa-instagram-square"></i></a></li>
                                <li><a href="#"><i class="fab fa-pinterest-square"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
