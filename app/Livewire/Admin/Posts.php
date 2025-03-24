<?php

namespace App\Livewire\Admin;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ParentCategory;
use App\Models\Category;
use Illuminate\Support\Facades\File;

use Illuminate\Support\Facades\Storage;

class Posts extends Component
{
    use WithPagination;

    public $perPage=10;

    public $categories_html;

    public $search = null;
    public $author = null;
    public $category = null;
    public $visibility = null;
    public $sortBy = 'desc';
    public $post_visibility;

    protected $queryString = [
        'search' =>['except'=>''],
        'author' =>['except'=>''],
        'category' =>['except'=>''],
        'visibility' =>['except'=>''],
        'sortBy' =>['except'=>''],
    ];

    protected $listeners = [
        'deletePostAction'
    ];

    public function updatedSearch(){
        $this->resetPage();
    }

    public function updatedAuthor(){
        $this->resetPage();
    }

    public function updatedCategory(){
        $this->resetPage();
    }

    public function updatedVisibility(){
        $this->resetPage();
        $this->post_visibility = $this->visibility == 'public' ? 1 : 0 ;
    }


    public function mount(){
        $this ->author = auth()->user()->type == "superAdmin" ? auth()->user()->id : '';
        $this->post_visibility = $this->visibility == 'public' ? 1 : 0 ;
        //prepare
        $categories_html = '';
        $pcategories = ParentCategory::whereHas('children',function($q){
            $q->whereHas('posts');
        })->orderBy('name','asc')->get();

        $categories = Category::whereHas('posts')->where('parent',0)->orderBy('name','asc')->get();

        if (count($pcategories) > 0) {
            foreach ($pcategories as $item) {
                $categories_html .= '<optgroup label="' . $item->name . '">';
                foreach ($item->children as $category) {
                    $categories_html .= '<option value="' . $category->id . '">' . $category->name . '</option>';
                }
                $categories_html .= '</optgroup>';
            }
        }

        if (count($categories) > 0) {
            foreach ($categories as $item) {
                $categories_html .= '<option value="' . $item->id . '">' . $item->name . '</option>';
            }
        }

        $this->categories_html = $categories_html;

    }

    public function deletePost($id){
        $this->dispatch('deletePost',['id'=>$id]);
    }

    public function deletePostAction($id){
    $post = Post::findOrFail($id);
    $path = "images/posts/";
    $resized_path = $path . 'resized/';
    $old_featured_image = $post->featured_image;

    // Delete featured image
    if ($old_featured_image != "" && File::exists(public_path($path . $old_featured_image))) {
        File::delete(public_path($path . $old_featured_image));

        // Delete Resized Image
        if (File::exists(public_path($resized_path . 'resized_' . $old_featured_image))) {
        File::delete(public_path($resized_path . 'resized_' . $old_featured_image));
        }

        // Delete thumbnail
        if (File::exists(public_path($resized_path . 'thumb_' . $old_featured_image))) {
        File::delete(public_path($resized_path . 'thumb_' . $old_featured_image));
        }
    }

    $delete = $post->delete();

    if ($delete) {
        $this->dispatch('postDeleted', ['message' => 'Post has been deleted successfully', 'status' => 'success']);
        } else {
        $this->dispatch('postDeleted', ['message' => 'Failed to delete post', 'status' => 'error']);
        }

    }


    public function render()
    {
        return view('livewire.admin.posts',[
            'posts'=>auth()->user()->type == "superAdmin" ?
                    Post::search(trim($this->search))
                    ->when($this->author, function($query){
                        $query->where('author_id',$this->author);
                    })
                    ->when($this->category,function($query){
                        $query->where('category',$this->category);
                    })
                    ->when($this->visibility, function($query){
                        $query->where('visibility',$this->post_visibility);
                    })
                    ->when($this->sortBy, function($query){
                        $query->orderBy('id',$this->sortBy);
                    })
                    ->paginate($this->perPage) :

                    Post::search(trim($this->search))
                    ->when($this->author, function($query){
                        $query->where('author_id',$this->author);
                    })
                    ->when($this->category,function($query){
                        $query->where('category',$this->category);
                    })
                    ->when($this->visibility, function($query){
                        $query->where('visibility',$this->post_visibility);
                    })
                    ->when($this->sortBy, function($query){
                        $query->orderBy('id',$this->sortBy);
                    })
                    ->where('author_id',auth()->id())->paginate($this->perPage)
        ]);
    }
}
