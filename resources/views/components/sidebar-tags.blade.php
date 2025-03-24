<div>
    <div class="row">
        <div class="col-md-12">
            <div class="section-title">
                <h4 class="title">Tags</h4>
            </div>
            <ul class="list-tags">
                @foreach (getTags(10) as $tag)
                <li>
                    <a href="{{ route('tag_posts',urlencode($tag)) }}" class="btn btn-primary btn-sm">{{ $tag }}</a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>