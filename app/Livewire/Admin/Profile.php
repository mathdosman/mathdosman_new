<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Illuminate\Http\Request;

class Profile extends Component
{

    public $tab = null;
    public $tabname = 'personal_details';
    protected $queryString = ['tab'=>['keep'=>true]];

    public $name, $email, $username, $bio;

    public function selectTab($tab){
        $this->tab = $tab;
    }

    public function mount(){
        $this->tab = Request('tab') ? Request('tab') : $this->tabname;
        //Populate
        $user = User::findOrFail(auth()->id());
        $this->name = $user->name;
        $this->email = $user->email;
        $this->username = $user->username;
        $this->bio = $user->bio;
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
            $this->dispatch('updateTopUserInfo')->to(TopUserInfo::class);
        } catch (\Exception $e) {
        }
    }

    public function render()
    {
        return view('livewire.admin.profile',[
            'user'=>User::findOrFail(auth()->id())
        ]);
    }
}
