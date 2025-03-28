<!-- sidebar -->
<div class="sidebar">
    <div class="row">
        <div class="col-md-12">
            <div class="section-title">
                <h4 class="title">Popular Post</h4>
            </div>
            <ul class="last-posts">
                @foreach (popularPosts() as $item)
                <li class="last-posts-item">
                    <a href="{{ route('read_post',$item->slug) }}" class="post-img">
                        <img src="/images/posts/resized/thumb_{{ $item->featured_image }}" alt="">
                    </a>
                    <div class="post-body">
                        <div class="post-category">
                            <a href="{{ route('category_posts', $item->post_category->slug) }}">Category :
                                {{$item->post_category->name}}</a>
                        </div>
                        <a href="{{ route('read_post',$item->slug) }}">
                            <h5>{{ $item->title }}</h4>
                        </a>
                        <small>{{ date_formatter($item->created_at) }}</small>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
    <x-sidebar-search></x-sidebar-search>

    <x-sidebar-categories></x-sidebar-categories>
    <x-sidebar-tags></x-sidebar-tags>
    @livewire('newsletter-form')

</div>
<!-- end sidebar -->
