<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\GeneralSetting;
use Illuminate\Support\Facades\Session;

class Settings extends Component
{
    public $tab = null;
    public $default_tab = 'general_settings';
    protected $queryString = ['tab'=>['keep'=>true]];

    //General setting form properties
    public $site_title, $site_email, $site_phone, $site_meta_keyword, $site_meta_description;

    public function selectTab($tab){
        $this->tab = $tab;
    }
    public function mount(){
        $this->tab = Request('tab') ? Request('tab') : $this->default_tab;

        //Populate General Settings
        $settings = GeneralSetting::take(1)->first();
        if(!is_null($settings)){
            $this->site_title = $settings->site_title;
            $this->site_email = $settings->site_email;
            $this->site_phone = $settings->site_phone;
            $this->site_meta_keyword = $settings->site_meta_keyword;
            $this->site_meta_description = $settings->site_meta_description;

        }
    }

    public function updateSiteInfo(){
        $this->validate([
            'site_title'=>'required',
            'site_email'=>'required|email'
        ]);

        $settings = GeneralSetting::take(1)->first();

    $data = array(
        'site_title' => $this->site_title,
        'site_email' => $this->site_email,
        'site_phone' => $this->site_phone,
        'site_meta_keyword' => $this->site_meta_keyword,
        'site_meta_description' => $this->site_meta_description,
    );

    if(!is_null($settings)){
        $query = $settings->update($data);
    }else{
        $query = GeneralSetting::insert($data);
    }

    if($query){
        Session::flash('success','General settings have been updated successfully.');
        }else{
        Session::flash('fail','Something went wrong');
        }

    }


    public function render()
    {
        return view('livewire.admin.settings');
    }
}
