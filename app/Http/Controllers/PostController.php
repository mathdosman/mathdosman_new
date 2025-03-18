<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ParentCategory;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    public function addPost() {
        $categories_html = '';
        $pcategories = ParentCategory::whereHas('children')->orderBy('name', 'asc')->get();
        $categories = Category::where('parent', 0)->orderBy('name', 'asc')->get();

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

        $data = [
            'pageTitle' => 'Add new post',
            'categories_html' => $categories_html,
        ];

        return view('back.pages.add_post', $data);
    }

    public function createPost(Request $request) {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:posts,title',
            'content' => 'required',
            'category' => 'required|exists:categories,id',
            'featured_image' => 'required|mimes:png,jpg,jpeg|max:1024'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'message' => 'Validasi gagal.',
                'errors' => $validator->errors(),
            ], 422); // Mengembalikan kode status 422
        }

        // Penanganan upload gambar
        if ($request->hasFile('featured_image')) {
            $path = public_path('images/posts/'); // Menggunakan public_path()
            $file = $request->file('featured_image');
            $filename = $file->getClientOriginalName();
            $new_filename = time() . '_' . $filename;

            if ($file->move($path, $new_filename)) {
                $resized_path = $path . 'resized/'; // Menggunakan public_path()
                if (!File::isDirectory($resized_path)) {
                    try {
                        File::makeDirectory($resized_path, 0755, true, true); // Izin 0755
                    } catch (\Exception $e) {
                        return response()->json([
                            'status' => 0,
                            'message' => 'Gagal membuat direktori resized: ' . $e->getMessage(),
                        ]);
                    }
                }

                try {
                    // Thumbnail aspect ratio 1
                    Image::make($path . $new_filename)
                        ->fit(250, 250)
                        ->save($resized_path . 'thumb_' . $new_filename);

                    // Resized aspect ratio 1.6
                    Image::make($path . $new_filename)
                        ->fit(512, 320)
                        ->save($resized_path . 'resized_' . $new_filename);
                } catch (\Exception $e) {
                    return response()->json([
                        'status' => 0,
                        'message' => 'Gagal memproses gambar: ' . $e->getMessage(),
                    ]);
                }

                // Membuat posting baru dengan transaksi
                DB::beginTransaction();
                try {
                    $post = new Post();
                    $post->author_id = auth()->id();
                    $post->category = $request->category;
                    $post->title = $request->title;
                    $post->content = $request->content;
                    $post->featured_image = $new_filename;
                    $post->tags = $request->tags;
                    $post->meta_keywords = $request->meta_keywords;
                    $post->meta_description = $request->meta_description;
                    $post->visibility = $request->visibility;
                    $post->save();

                    DB::commit();
                    return response()->json([
                        'status' => 1,
                        'message' => 'Postingan baru berhasil dibuat.',
                    ]);
                } catch (\Exception $e) {
                    DB::rollback();
                    return response()->json([
                        'status' => 0,
                        'message' => 'Gagal menyimpan postingan: ' . $e->getMessage(),
                    ]);
                }
            } else {
                // Respon gagal upload gambar
                return response()->json([
                    'status' => 0,
                    'message' => 'Gagal mengupload gambar unggulan.',
                ]);
            }
        }
    }
}
