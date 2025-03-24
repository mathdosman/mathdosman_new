@extends('front.layout.pages-layout')
@section('pageTitle',isset($pageTitle) ? $pageTitle : 'Document Title')
@section('meta_tags')
{!! SEO::generate() !!}
@endsection
@section('content')
<style>
    .author-profile {
    text-align: center;
    padding: 20px;
    background-color: #f8f8f8; /* Atau warna latar belakang yang diinginkan */
    border-radius: 10px; /* Untuk sudut bulat */
    font-family: sans-serif; /* Ganti dengan font yang diinginkan */
    width: 100%; /* Lebar penuh sesuai halaman */
    max-width: 1200px; /* Opsional: Batas maksimum lebar */
    margin: 0 auto; /* Pusatkan jika ada batas maksimum */
}

.author-image img {
    width: 150px; /* Sesuaikan ukuran gambar */
    height: 150px;
    border-radius: 50%; /* Membuat gambar bulat */
    object-fit: cover; /* Memastikan gambar tidak terdistorsi */
    margin-bottom: 20px;
}

.author-name {
    color: purple; /* Warna nama */
    margin-bottom: 5px;
}

.author-title {
    color: #555; /* Warna judul */
    margin-bottom: 15px;
}

.author-description {
    color: #333; /* Warna deskripsi */
    line-height: 1.6; /* Spasi baris */
    margin-bottom: 20px;
}

.social-icons a {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 30px; /* Sesuaikan ukuran ikon */
    height: 30px;
    margin: 0 5px;
    color: #333; /* Warna ikon */
    text-decoration: none;
    font-size: 20px; /* Ukuran ikon */
}

.social-icons a:hover {
    color: purple; /* Warna ikon saat dihover */
}
</style>


            <div class="author-profile">
                <div class="author-image">
                    <img src="{{ $author->picture }}" alt="Author Photo">
                </div>
                <h2 class="author-name">{{ $author->name }}</h2>
                <p class="author-title">{{ $author->username }}</p>
                <p class="author-description">
                    {{ $author->bio }}
                </p>
                @if($author->sosial_links)
    
                <div class="social-links mt-3">
                
                    @if($author->sosial_links->facebook_url)
                        <a href="{{ $author->sosial_links->facebook_url }}" target="_blank" title="Facebook"><i class="ti-facebook"></i></a>
                    @endif
                
                    @if($author->sosial_links->instagram_url)
                        <a href="{{ $author->sosial_links->instagram_url }}" target="_blank" title="Instagram"><i class="ti-instagram"></i></a>
                    @endif
                
                    @if($author->sosial_links->youtube_url)
                        <a href="{{ $author->sosial_links->youtube_url }}" target="_blank" title="YouTube"><i class="ti-youtube"></i></a>
                    @endif
                    @if($author->sosial_links->twitter_url)
                        <a href="{{ $author->sosial_links->twitter_url }}" target="_blank" title="Twitter"><i class="ti-twitter"></i></a>
                    @endif
                
                </div>
                
                @endif
            </div>
{{-- Post -------------------------------------------------------------------------------- --}}
            <div class="col-md-12">
                <!-- recent-posts -->
                <div class="recent-post">
                    <div class="row mb-15">
                        <div class="col-md-12">
                            <div class="section-title mt-4">
                                <h3 class="title">{{ $author->username }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                    @forelse ($posts as $post)
                        <div class="col-md-4 mb-3">
                            <div class="card rounded-0 border-0">
                                <a href="{{ route('read_post',$post->slug) }}" class="post-img">
                                    <img src="/images/posts/resized/resized_{{ $post->featured_image }}" class="card-img-top rounded-0" alt="">
                                </a>
                                <div class="card-body">
                                    <div class="post-category">
                                        <a href="{{ route('category_posts', $post->post_category->slug) }}">Category :
                                            {{$post->post_category->name}}</a>
                                    </div>
                                    <a href="{{ route('read_post',$post->slug) }}">
                                        <h5 class="card-title">{{ $post->title }}</h5>
                                    </a>
                                    <ul class="post-meta">
                                        <li>
                                            <i class="ti-user mr-1"></i> <a
                                                href="{{ route('author_posts', $post->author->username) }}">{{ $post->author->name }}</a>
                                        </li>
                                        <li>
                                            <i class="ti-calendar mr-1"></i>{{ date_formatter($post->created_at) }}
                                        </li>
                                        <li>
                                            <i class="ti-timer mr-1"></i> {{ readDuration($post->title,$post->content) }}
                                            @choice('min|mins', readDuration($post->title,$post->content))
                                        </li>
                                    </ul>
                                    <p>
                                        {!! Str::ucfirst(words($post->content, 25)) !!}
                                    </p>
                                    <a href="{{ route('read_post',$post->slug) }}" class="btn btn-outline-primary"> Read
                                        more...</a>
                                </div>
                            </div>
                        </div>

    @empty
    <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-danger" role="alert">
                            No posts found for this author!
                        </div>
                    </div>
                </div>
                @endforelse
                
            </div>
            <div class="text-center">
                {{ $posts->appends(request()->input())->links('custom_pagination') }}
            </div>
{{-- end row --}}
            </div> 
            </div>
@endsection