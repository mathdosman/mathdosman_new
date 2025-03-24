<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;
use App\MOdels\ParentCategory;
use Illuminate\Support\Facades\Session;
use Livewire\WithPagination;

class Categories extends Component
{
    use WithPagination;

    public $isUpdateParentCategoryMode = false;
    public $pcategory_id, $pcategory_name;

    public $isUpdateCategoryMode = false;
    public $category_id, $parent=0, $category_name;

    public $pcategoriesPerPage=5;
    public $categoriesPerPage=10;


    protected $listeners = [
        'updateParentCategoryOrdering',
        'updateCategoryOrdering',
        'deleteParentCategoryAction',
        'deleteCategoryAction'
    ];

    public function addParentCategory(){
        $this->pcategory_id=null;
        $this->pcategory_name=null;
        $this->isUpdateParentCategoryMode = false;
        $this->showParentCategoryModalForm();
    }

    public  function createParentCategory(){
        $this->validate([
            'pcategory_name'=>'required|unique:parent_categories,name'
        ],[
            'pcategory_name.required'=>'Parent category field is required.',
            'pcategory_name.unique'=>'Parent category name is already exists.'
        ]);
        //Store P category
        $pcategory = new ParentCategory();
        $pcategory->name = $this->pcategory_name;
        $saved = $pcategory->save();

        if($saved){
            $this->hideParentCategoryModalForm();
            $this->dispatch('postDeleted', ['message' => 'New parent category has been successfully.', 'status' => 'success']);
        }else{
            $this->dispatch('postDeleted', ['message' => 'Something went wrong', 'status' => 'error']);
        }
    }

    public function editParentCategory($id){
        $pcategory = ParentCategory::findOrFail($id);
        $this->pcategory_id = $pcategory->id;
        $this->pcategory_name = $pcategory->name;
        $this->isUpdateParentCategoryMode = true;
        $this->showParentCategoryModalForm();
    }

    public function updateParentCategory(){
        $pcategory = ParentCategory::findOrFail($this->pcategory_id);

        $this->validate([
            'pcategory_name'=>'required|unique:parent_categories,name,'.$pcategory->id
        ],[
            'pcategory_name.required'=>'Parent category field is required.',
            'pcategory_name.unique'=>'Parent category name is taken.'
        ]);

        //Update data
        $pcategory->name = $this->pcategory_name;
        $pcategory->slug = null;
        $updated = $pcategory->save();

        if($updated){
            $this->hideParentCategoryModalForm();
            $this->dispatch('postDeleted', ['message' => 'Parent category has been updated successfully.', 'status' => 'success']);
        }else{
            $this->dispatch('postDeleted', ['message' => 'Something went wrong', 'status' => 'error']);
        }
    }

    public function updateParentCategoryOrdering($positions){
        // dd($position);
        foreach($positions as $position){
            $index = $position[0];
            $new_position = $position[1];
            ParentCategory::where('id',$index)->update([
                'ordering'=>$new_position
            ]);
            $this->dispatch('postDeleted', ['message' => 'Parent categories ordering has been updated successfully.', 'status' => 'success']);

        }
    }

    public function deleteCategory($id){
        $this->dispatch('deleteCategory',['id'=>$id]);
    }

    public function updateCategoryOrdering($positions){
        // dd($position);
        foreach($positions as $position){
            $index = $position[0];
            $new_position = $position[1];
            Category::where('id',$index)->update([
                'ordering'=>$new_position
            ]);
            $this->dispatch('postDeleted', ['message' => 'Categories ordering has been updated successfully', 'status' => 'success']);
        }
    }

    public function deleteParentCategory($id){
        $this->dispatch('deleteParentCategory',['id'=>$id]);
    }

    public function deleteParentCategoryAction($id){
        $pcategory = ParentCategory::findOrFail($id);

        //Check if this parent category as children
        if($pcategory->children->count()>0){
            foreach($pcategory->children as $category){
                Category::where('id',$category->id)->update(['parent'=>0]);
            }
        }

        //Delete parent category
        $delete = $pcategory->delete();

        if($delete){
            $this->dispatch('postDeleted', ['message' => 'Parent category has been deleted successfully.', 'status' => 'success']);
        }else{
            $this->dispatch('postDeleted', ['message' => 'Something went wrong', 'status' => 'error']);
        }
    }

    public function addCategory(){
        $this->category_id = null;
        $this->parent = 0;
        $this->category_name = null;
        $this->isUpdateCategoryMode=false;
        $this->showCategoryModalForm();
    }

    public function createCategory(){
        $this->validate([
            'category_name'=>'required|unique:categories,name',
        ],[
            'category_name.required'=>'Category field is required',
            'category_name.unique'=>'Category name is already exists.'
        ]);
        //Store new
        $category = new Category();
        $category->parent = $this->parent;
        $category->name = $this->category_name;
        $saved = $category->save();

        if($saved){
            $this->hideCategoryModalForm();
            $this->dispatch('postDeleted', ['message' => 'New category has been successfully.', 'status' => 'success']);
        }else{
            $this->dispatch('postDeleted', ['message' => 'Something went wrong', 'status' => 'error']);
        }
    }


    public function editCategory($id){
        $category = Category::findOrFail($id);
        $this->category_id = $category->id;
        $this->parent = $category->parent;
        $this->category_name = $category->name;
        $this->isUpdateCategoryMode = true;
        $this->showCategoryModalForm();
    }

    public function updateCategory(){
        $category = Category::findOrFail($this->category_id);
        $this->validate([
            'category_name'=>'required|unique:categories,name,'.$category->id
        ],[
            'category_name.required'=>'Category field is required.',
            'category_name.unique'=>'Category name is already exsists.'
        ]);

        //update category
        $category->name = $this->category_name;
        $category->parent = $this->parent;
        $category->slug = null;
        $updated = $category->save();

        if($updated){
            $this->hideCategoryModalForm();
            $this->dispatch('postDeleted', ['message' => 'Category has been updated successfully.', 'status' => 'success']);
        }else{
            $this->dispatch('postDeleted', ['message' => 'Something went wrong', 'status' => 'error']);
        }
    }

    public function deleteCategoryAction($id){
        $category = Category::findOrFail($id);

        //Check related Post
        if($category->posts->count() > 0){
            $count = $category->posts->count();
            $this->dispatch('postDeleted', ['message' => 'This category has ('.$count.') related post(s). Can not be deleted', 'status' => 'error']);
        }else{
            //Dalete Category
            $delete = $category->delete();
            if($delete){
                $this->dispatch('postDeleted', ['message' => 'Category has been deleted successfully.', 'status' => 'success']);
            }else{
                $this->dispatch('postDeleted', ['message' => 'Something went wrong', 'status' => 'error']);
            }
        }
    }

    public function showParentCategoryModalForm(){
        $this->resetErrorBag();
        $this->dispatch('showParentCategoryModalForm');
    }

    public function hideParentCategoryModalForm(){
        $this->dispatch('hideParentCategoryModalForm');
        $this->isUpdateParentCategoryMode = false;
        $this->pcategory_id = $this ->pcategory_name = null;
    }

    public function showCategoryModalForm(){
        $this->resetErrorBag();
        $this->dispatch('showCategoryModalForm');
    }

    public function hideCategoryModalForm(){
        $this->dispatch('hideCategoryModalForm');
        $this->isUpdateCategoryMode = false;
        $this->category_id = $this ->category_name = null;
        $this->parent = 0;
    }

    public function render()
    {
        return view('livewire.admin.categories',[
            'pcategories'=>ParentCategory::orderBy('ordering','asc')->paginate($this->pcategoriesPerPage,['*'],'pcat_page'),
            'categories'=>Category::orderBy('ordering','asc')->paginate($this->categoriesPerPage,['*'],'cat_page')
        ]);
    }
}