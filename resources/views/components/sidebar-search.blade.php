<div>
    <div class="row">
        <div class="col-md-12">
            <div class="section-title">
                <h4 class="title">Search</h4>
            </div>
            <form action="{{ route('search_posts') }}" method="GET" class="form-sidebar">
                <div>
                    <input type="search" id="search-query" class="form-control rounded-0" placeholder="Search" value="{{ request('q') ? request('q') : '' }}" name="q">
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>