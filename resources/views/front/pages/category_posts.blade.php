@extends('front.layout.pages-layout')
@section('pageTitle',isset($pageTitle) ? $pageTitle : 'Document Title')
@section('meta_tags')
{!! SEO::generate() !!}
@endsection
@section('content')
<div class="col-md-12">
					<!-- recent-posts -->
					<div class="recent-post">
                        <div class="row mb-15">
                            <div class="col-md-12">
                                <div class="section-title">
                                    <h3 class="title">{{ $pageTitle }}</h3>
                                </div>
                            </div>
                        </div>
                        @if($posts->count() > 0)
                        
						<div class="row">
                            @foreach ($posts as $post)
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
                            @endforeach

						</div>
                        <div class="text-center">
                            {{ $posts->appends(request()->input())->links('custom_pagination') }}
                        </div>
		{{-- end row --}}
					</div> 
                    

                    @else
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-danger" role="alert">
                                No posts found in this category.
                            </div>
                        </div>
                    @endif
@endsection