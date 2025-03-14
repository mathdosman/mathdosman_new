<?php

namespace App\Livewire\Admin;

use App\Helpers\CMail;
use App\Livewire\Admin\TopUserInfo;
use App\Models\User;
use App\Models\UserSosialLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Profile extends Component
{

    public $tab = null;
    public $tabname = 'personal_details';
    protected $queryString = ['tab'=>['keep'=>true]];

    public $name, $email, $username, $bio;

    public $current_password, $new_password, $new_password_confirm;

    public $facebook_url, $instagram_url, $youtube_url, $twitter_url;

    protected $listeners = [
        'updateProfile'=>'$refresh'
    ];

    public function selectTab($tab){
        $this->tab = $tab;
    }

    public function mount(){
        $this->tab = Request('tab') ? Request('tab') : $this->tabname;
        //Populate
        $user = User::with('sosial_links')->findOrFail(auth()->id());
        $this->name = $user->name;
        $this->email = $user->email;
        $this->username = $user->username;
        $this->bio = $user->bio;

        //Populate sosial link form
        if(!is_null($user->sosial_links)){
            $this->facebook_url = $user->sosial_links->facebook_url;
            $this->instagram_url = $user->sosial_links->instagram_url;
            $this->youtube_url = $user->sosial_links->youtube_url;
            $this->twitter_url = $user->sosial_links->twitter_url;
        }
    }

    public function updatePersonalDetail(){
        $user = User::findOrFail(auth()->id());
        $this->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username,'.$user->id,
        ]);

        //Update
        $user->name = $this->name;
        $user->username = $this->username;
        $user->bio = $this->bio;
        $updated = $user->save;

        sleep(0.5);

        try {
            $user->save();
            Session::flash('success','Your sosial links have been updated successfully.');
            $this->dispatch('updateTopUserInfo')->to(TopUserInfo::class);
        } catch (\Exception $e) {
            Session::flash('error','Someting went wrong');
        }
    }

    public function updatePassword(){
        $user = User::findOrFail(auth()->id());

        // Validate
        $this ->validate([
                'current_password'=>[
                    'required',
                    'min:5',
                function($attribute,$value,$fail) use ($user){
                    if(!Hash::check($value, $user->password)){
                        return $fail(__('Your current password does not match our records.'));
                    }
                }
            ],
            'new_password'=>'required|min:5|same:new_password_confirm'
        ]);

        $updated = $user->update([
            'password'=>Hash::make($this->new_password)
        ]);

        if($updated){
            $data = array(
                'user'=>$user,
                'new_password'=>$this->new_password
            );

        $mail_body = view('email-templates.password-changes-template',$data)->render();

        $mail_config = array(
            'recipient_address'=>$user->email,
            'recipient_name'=>$user->name,
            'subject'=>'Password Changed',
            'body'=> $mail_body
        );
        CMail::send($mail_config);
        //LOgout
        auth()->logout();
        Session::flash('info','Your password has been successfully changed. Please login with your new password.');
        $this->redirectRoute('adminlogin');
        }else{
            Session::flash('error','Someting went wrong');
        }
    }

    public function updateSosialLinks(){
        $this->validate([
            'facebook_url'=>'nullable|url',
            'instagram_url'=>'nullable|url',
            'youtube_url'=>'nullable|url',
            'twitter_url'=>'nullable|url',
        ]);

        $user = User::findOrFail(auth()->id());

        $data = array(
            'facebook_url' => $this->facebook_url,
            'instagram_url' => $this->instagram_url,
            'youtube_url' => $this->youtube_url,
            'twitter_url' => $this->twitter_url,
        );
        if(!is_null($user->sosial_links)){
            $query = $user->sosial_links()->update($data);
        }else{
            $data['user_id']=$user->id;
            $query = UserSosialLink::insert($data);
        }

        if($query){
            Session::flash('success','Your sosial links have been updated successfully.');
            }else{
            Session::flash('fail','Something went wrong');
            }

    }

    public function render()
    {
        return view('livewire.admin.profile',[
            'user'=>User::findOrFail(auth()->id())
        ]);
    }
}