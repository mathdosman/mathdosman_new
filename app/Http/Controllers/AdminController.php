<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\File;
use SawaStacks\Utils\Kropify;
use App\Models\GeneralSetting;


class AdminController extends Controller
{
    public function adminDashboard(Request $request){
        $data = [
            'pageTitle'=>'Dashboard'
        ];
        return view('back.pages.dashboard', $data);
    }

    public function logoutHandler(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        if(isset($request->source)){
            return redirect()->back();
        }
        return redirect()->route('adminlogin')->with('fail','You are now logged out!.');
    }

    public function profileView(Request $request){
        $data = [
            'pageTitle'=>'Profile'
        ];
        return view ('back.pages.profile',$data);
    }

    public function updateProfilePicture(Request $request){
        $user = User::findOrFail(auth()->id());
        $path = 'images/users/';
        $file = $request->file('profilePictureFile');
        $old_picture = $user->getAttributes()['picture'];
        $filename = 'IMG_'.uniqid().'.png';

        $upload = Kropify::getFile($file, $filename)->maxWoH(255)->save($path);


        if($upload){
            if($old_picture != null && File::exists(public_path($path.$old_picture))){
            File::delete(public_path($path.$old_picture));
            }
            //Update
            $user->update(['picture'=>$filename]);
            return response()->json(['status'=>1,'message'=>'Your profile picture has been updated successfully.']);
        } else{
            return response()->json(['status'=>0,'message'=>'Something went wrong.']);
        }
    }

    public function generalSettings(Request $request){
        $data=[
            'pageTitle'=>'General Settings'
        ];

        return view('back.pages.general_settings', $data);
    }

    public function updateLogo(Request $request)
    {
        $settings = GeneralSetting::take(1)->first();

        if(!is_null($settings)){
            $path = 'images/site/';
            $old_logo = $settings->site_logo;
            $file=$request->file('site_logo');
            $filename = 'logo_'.uniqid().'.png';

        // Validasi file
            if($request->hasFile('site_logo')){
                $upload = $file->move(public_path($path),$filename);

                if($upload){
                    if($old_logo != null && File::exists(public_path($path.$old_logo))){
                        File::delete(public_path($path.$old_logo));
                    }
                    $settings->update(['site_logo'=>$filename]);
                    return response()->json(['status'=>1,'image_path'=>$path.$filename,'message'=>'Site logo has been updated successfully.']);
                }else{
                    return response()->json(['status'=>0,'Something went wrong in uploading new logo.']);
                }
            }else {
                return response()->json(['status' => 0, 'message' => 'No file uploaded.']);
            }

        }else{
            return response()->json(['status'=>0,'message'=>'Make sure you updated general settings form list.'
        ]);
        }
    }

    public function updateFavicon(Request $request)
    {
        $settings = GeneralSetting::take(1)->first();

        if (!is_null($settings)) {
            $path = 'images/site/';
            $old_favicon = $settings->site_favicon;
            $file = $request->file('site_favicon');

            // Validasi file
            if ($request->hasFile('site_favicon')) {
                $filename = 'favicon_' . uniqid() . '.' . $file->getClientOriginalExtension(); // Menggunakan ekstensi asli

                $upload = $file->move(public_path($path), $filename);

                if ($upload) {
                    if ($old_favicon != null && File::exists(public_path($path . $old_favicon))) {
                        File::delete(public_path($path . $old_favicon));
                    }
                    $settings->update(['site_favicon' => $filename]);

                    return redirect()->back()->with('success', 'Site favicon has been updated successfully.'); // Menggunakan session flash
                } else {
                    return redirect()->back()->with('error', 'Something went wrong in uploading new favicon.'); // Menggunakan session flash
                }
            } else {
                return redirect()->back()->with('error', 'No file uploaded.'); // Menggunakan session flash
            }
        } else {
            return redirect()->back()->with('error', 'Make sure you updated general settings form list.'); // Menggunakan session flash
        }
    }

    public function uploadImage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // 2MB
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $path = $image->move(public_path('images/site'), $filename); // Simpan di public/images/site

            return response()->json(['success' => true, 'message' => 'Gambar berhasil diunggah.', 'path' => '/images/site/' . $filename]); // Sesuaikan path untuk frontend
        }

        return response()->json(['success' => false, 'message' => 'Gagal mengunggah gambar.']);
    }

    public function categoriesPage(Request $request){
        $data = [
            'pageTitle'=>'Manage categories'
        ];
        return view('back.pages.categories_page',$data);
    }


}