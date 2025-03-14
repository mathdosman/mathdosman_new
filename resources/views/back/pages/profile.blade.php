@extends('back.layout.pages-layout')
@section('pageTitle', isset($pageTitle)? $pageTitle : "Page Title Here")
@section('content')
<div class="page-header">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="title">
                <h4>Profile</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admindashboard') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Profile
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>

@livewire('admin.profile')
@endsection
@push('scripts')
    <script>
        toastr.options = {
            "timeOut": "10000",
            "extendedTimeOut": "2000",
            "closeButton": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": true
        };
       $('input[type="file"][id="profilePictureFile"]').kropify({
        preview:'image#profilePicturePreview',
        viewMode:1,
        aspectRatio:1,
        cancelButtonText:'Cancel',
        resetButtonText:'Reset',
        cropButtonText:'Crop & update',
        processURL:'{{route("adminupdate_profile_picture")}}',
        maxSize:2097152, //2MB
        showLoader:true,
        animationClass:'headShake', //headShake, bounceIn, pulse
        fileName:'profilePictureFile',
        success:function(data){
            if (data.status == 1) {
                Livewire.dispatch('updateTopUserInfo',[]);
                Livewire.dispatch('updateProfile',[]);
                toastr.success(data.message);
            } else {
                toastr.error(data.message);
            }
        },
          errors:function(error, text){
            console.log(text);
          },
        });
    </script>
@endpush
