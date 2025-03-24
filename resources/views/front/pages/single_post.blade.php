@extends('front.layout.pages-layout')
@section('pageTitle',isset($pageTitle) ? $pageTitle : 'Document Title')
@section('meta_tags')
{!! SEO::generate() !!}
@endsection
@section('content')
            <div class="col-md-8">
                
                <!-- main-post -->
                <article class="main-post">
                        <style>
                            .post-content img {
                                width: 100%; 
                                height: auto; 
                                display: block;
                                object-fit: cover; 
                            }
                        </style>
                        <figure class="post-content">
                            <img src="/images/posts/{{ $post->featured_image }}" alt="">
                        </figure>
                    <h1 class="text-center">{{ $post->title }}</h1>
                    <div class="share-buttons ml-2">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('read_post', $post->slug)) }}" target="_blank" class="btn-facebook">
                            <i class="ti-facebook"></i>
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('read_post', $post->slug)) }}&amp;text={{ urlencode($post->title) }}" target="_blank" class="btn-twitter">
                            <i class="ti-twitter-alt"></i>
                        </a>
                        <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(route('read_post', $post->slug)) }}" target="_blank" class="btn-linkedin">
                            <i class="ti-linkedin"></i>
                        </a>
                        <a href="https://www.pinterest.com/pin/create/button?url={{ urlencode(route('read_post', $post->slug)) }}&description={{ urlencode($post->title) }}" target="_blank" class="btn-pinterest">
                            <i class="ti-pinterest"></i>
                        </a>
                        <a href="mailto:?subject={{ urlencode('Check out this post: ' . $post->title) }}&amp;body={{ urlencode('I found this interesting post: ' . route('read_post', $post->slug)) }}" target="_blank" class="btn-email">
                            <i class="ti-email"></i>
                        </a>
                    </div>
                    <div class="post-meta ml-2">
                        <span class="date">{{ date('F j, Y', strtotime($post->created_at)) }}</span>
                        <span class="author">By <a href="{{ route('author_posts', $post->author->username) }}">{{ $post->author->username }}</a></span>
                        <span class="comments"><a href="#">3 Comments</a></span>
                    </div>

                    <div class="post-info">
                        <ul class="list-tags">
                            @if(!empty($tags) && count($tags) > 0)
                                <li>Tags:</li>
                                @foreach ($tags as $tag)
                                    <li>
                                        <a href="{{ route('tag_posts', urlencode(trim($tag))) }}">{{ $tag }}</a>
                                    </li>
                                @endforeach
                            @endif

                            <li>Category: <a href="{{ route('category_posts',$post->post_category->slug) }}">
                            {{ $post->post_category->name }}    
                            </a> 
                        </li> 

                        </ul>
                        <div class="post-author">

                            <a href="{{ route('author_posts', $post->author->username) }}" class="name"> {{ $post->author->username }}</a>
                            <img src="/images/users/{{ $authorPicture }}" alt="">
                        </div>
                    </div>
                    <div class="post-content">
                        {!! $post->content !!}
                    </div>
                </article>
                <!-- end main-post -->

                <!-- nav-post -->
                <div class="row row-nav-post">
                    <div class="col-md-6">
                        <div class="nav-post">
                            @if($prevPost)
                            <div class="post-body">
                                <a href="{{ route('read_post',$prevPost->slug) }}">
                                    <h5>{{ $prevPost->title }}</h5>
                                    <span class="label"><< Previous post</span>
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="nav-post right">
                            @if($nextPost)
                            <div class="post-body">
                                <a href="{{ route('read_post',$nextPost->slug) }}">
                                    <h5>{{ $nextPost->title }}</h5>
                                    <span class="label">Next post >></span>
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- end-nav-post -->

                <!-- featured-posts -->
                <div class="featured-posts small">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="section-title">
                                <h3 class="title">Related Posts</h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @if ($relatedPosts)
                        @foreach ($relatedPosts as $item)
                        <div class="col-md-3 col-6">
                            <div class="post post-thumb">
                                <a href="{{ route('read_post',$item->slug) }}" class="post-img">
                                    <img src="/images/posts/resized/thumb_{{ $item->featured_image }}" alt="">
                                </a>
                                <div class="post-body">
                                    <div class="post-category">
                                        <a href="{{ route('category_posts', $item->post_category->slug) }}">Category :
                                            {{$item->post_category->name}}</a>
                                    </div>
                                    <h3 class="post-title">
                                        <a href="{{ route('read_post',$item->slug) }}">
                                            {{ $item->title }}
                                        </a>
                                    </h3>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @else
                        <div class="col-md-12">
                            <p>No related posts found.</p>
                        </div>
                        @endif
                       
                    </div>
                </div>
                <!-- end featured-posts -->

                <section class="comments">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="disqus_thread"></div>
                            <script>
                                /**
                                *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
                                *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables    */
                                
                                var disqus_config = function () {
                                    this.page.url = "{{ route('read_post', $post->slug) }}";  // URL unik untuk halaman ini
                                    this.page.identifier = "PID_{{ $post->id }}"; // Identifier unik untuk halaman ini
                                };
                                
                                (function() { // DON'T EDIT BELOW THIS LINE
                                var d = document, s = d.createElement('script');
                                s.src = 'https://mathdosman.disqus.com/embed.js';
                                s.setAttribute('data-timestamp', +new Date());
                                (d.head || d.body).appendChild(s);
                                })();
                            </script>
                            <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
                        </div>
                    </div>
                </section>
                
                <!-- end form-comments -->

            </div>

            <div class="col-md-4">
                @include('front.layout.sidebar-front')
            </div>


@endsection

@push('scripts')
<script>
    $(document).on('click', '.share-buttons > a', function(e) {
        e.preventDefault();
        window.open($(this).attr('href'), '', 'height=450,width=450,top=' + ($(window).height() / 2 - 275) + ', left=' + ($(window).width() / 2 - 225) + ', toolbar=0, location=0, menubar=0, directories=0, scrollbars=0');
        return false;
    });
</script>
@endpush