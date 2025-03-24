@extends('front.layout.pages-layout')
@section('pageTitle',isset($pageTitle) ? $pageTitle : 'Document Title')
@section('meta_tags')
{!! SEO::generate() !!}
@endsection
@section('content')
<div class="col-md-8">
    <!-- hot-post -->
    @if(!empty(latest_posts(0,1)))
    @foreach (latest_posts(0,1) as $post)
    <div class="hot-post no-top-padding">
        <div class="row">
            <div class="col-md-12 hot-post-left">
                <div class="post post-thumb">
                    <a href="{{ route('read_post',$post->slug) }}" class="post-img">
                        <img src="/images/posts/{{ $post->featured_image }}" alt="">
                    </a>
                    <div class="post-body">
                        <div class="post-category">
                            <a href="{{ route('category_posts', $post->post_category->slug) }}">Category :
                                {{$post->post_category->name}}</a>
                        </div>
                        <h3 class="post-title title-lg">
                            <a href="{{ route('read_post',$post->slug) }}">
                                {{ $post->title }}
                            </a>
                        </h3>
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
                            {!! Str::ucfirst(words($post->content, 45)) !!}
                        </p>
                        <a href="{{ route('read_post',$post->slug) }}" class="btn btn-outline-primary"> Read more...</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    @endif
    <!-- end hot-post -->

					<!-- recent-posts -->
					<div class="recent-post">
                        <div class="row mb-15">
                            <div class="col-md-12">
                                <div class="section-title">
                                    <h3 class="title">Recent Posts</h3>
                                </div>
                            </div>
                        </div>
						<div class="row">
                            @if(!empty(latest_posts(1,4)))
                            @foreach (latest_posts(1,4) as $post)
							<div class="col-md-6 mb-3">
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
                            @endforeach
                            @endif
						</div>
                        <div class="row">
                            <div class="col-md-12">
                                <a href="{{route('all_posts')}}" class="btn btn-outline-primary btn-lg btn-block">View More</a>
                            </div>
                        </div>
						
					</div>

				</div>

                <div class="col-md-4">
					@include('front.layout.sidebar-front')
				</div>
@endsection