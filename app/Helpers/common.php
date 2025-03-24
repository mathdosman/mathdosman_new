<?php
use App\Models\GeneralSetting;
use App\Models\ParentCategory;
use App\Models\Category;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Support\Str;

if(!function_exists('settings')){
    function settings(){
        $settings = GeneralSetting::take(1)->first();
        if(!is_null($settings)){return $settings;}
    }
}

//Dynamic Menus
if(!function_exists('navigations')){
    function navigations(){
        $navigations_html = '';

        // With dropdown
        $pcategories = ParentCategory::whereHas('children', function ($q) {
            $q->whereHas('posts');
        })->orderBy('name', 'asc')->get();

        // Without Dropdown
        $categories = Category::whereHas('posts')->where('parent', 0)->orderBy('name', 'asc')->get();

        if (count($pcategories) > 0) {
            foreach ($pcategories as $item) {
                $navigations_html .= '
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#!" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' . $item->name . ' <i class="ti-angle-down ml-1"></i></a>
                        <div class="dropdown-menu">
                ';

                foreach ($item->children as $category) {
                    if ($category->posts->count() > 0) {
                        $navigations_html .= '<a class="dropdown-item" href="'.route('category_posts',$category->slug).'"> ' . $category->name . ' </a>';
                    }
                }

                $navigations_html .= '
                        </div>
                    </li>
                ';
            }
        }

        if (count($categories) > 0) {
            foreach ($categories as $item) {
                $navigations_html .= '
                    <li class="nav-item">
                        <a class="nav-link" href="'.route('category_posts',$item->slug).'"> ' . $item->name . ' </a>
                    </li>
                ';
            }
        }

        return $navigations_html;

    }
}

//DATE FORMAT eg, January 12,2024
if (!function_exists('date_formatter')) {
    function date_formatter($value) {
        return Carbon::createFromFormat('Y-m-d H:i:s', $value)->isoFormat('LL');
    }
}

if (!function_exists('words')) {
    function words($value, $words = 15, $end = "...") {
        return Str::words(strip_tags($value), $words, $end);
    }
}

/**
 * CALCULATE POST READING DURATION
 */
if (!function_exists('readDuration')) {
    function readDuration(...$text) {
        Str::macro('timeCounter', function($text) {
            $totalWords = str_word_count(implode(" ", $text));
            $minutesToRead = round($totalWords / 200);
            return (int)max(1, $minutesToRead);
        });
        return Str::timeCounter($text);
    }
}

/**
 * DISPLAY LATEST POST ON HOMEPAGE
 */
if (!function_exists('latest_posts')) {
    function latest_posts($skip = 0, $limit = 5) {
        return Post::skip($skip)
            ->limit($limit)
            ->where('visibility', 1)
            ->orderBy('created_at', 'desc')
            ->get();
    }
}

/**
 * LISTING CATEGORIES WITH NUMBER OF POSTS ON SIDEBAR
 */
if (!function_exists('sidebar_categories')) {
    function sidebar_categories($limit = 8) {
        return Category::withCount('posts')
            ->having('posts_count', '>', 0)
            ->limit($limit)
            ->orderBy('posts_count', 'desc')
            ->get();
    }
}

/**
 * FETCH ALL TAGS FROM THE 'posts' TABLE
 */
if (!function_exists('getTags')) {
    function getTags($limit = null) {
        $tags = Post::where('tags', '!=', '')->pluck('tags');
        // Split the tags into an array and remove duplicate
        $uniqueTags = $tags->flatMap(function($tagsString) {
            return explode(',', $tagsString);
        })->map(fn($tag) => trim($tag)) // Trim any extra whitespace
          ->unique()
          ->sort()
          ->values();

          if($limit){
                $uniqueTags = $uniqueTags->take($limit);
          }

        return $uniqueTags->all();
    }
}


if (!function_exists('sidebar_latest_posts')) {
    function sidebar_latest_posts($limit = 5, $except = null) {
        $posts = Post::limit($limit);
        if ($except) {
            $posts = $posts->where('id', '!=', $except);
        }
        return $posts->where('visibility', 1)
                     ->orderBy('created_at', 'desc')
                     ->get();
    }
}

?>