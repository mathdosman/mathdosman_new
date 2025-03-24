<div>
    <div class="row">
        <div class="col-md-12">
            <div class="section-title">
                <h4 class="title">Categories</h4>
            </div>
            <ul class="list-group list-group-flush">
                @foreach (sidebar_categories() as $item)
                <li class="list-group-item">
                    <a href="{{ route('category_posts',$item->slug) }}">{{ $item->name }}</a>
                    <small>({{ $item->posts->count() }})</small>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>