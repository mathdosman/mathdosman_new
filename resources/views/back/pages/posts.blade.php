@extends('back.layout.pages-layout')
@section('pageTitle', isset($pageTitle)? $pageTitle : "Page Title Here")
@section('content')

<div class="page-header">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="title">
                <h4>Posts</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admindashboard') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        List
                    </li>
                </ol>
            </nav>
        </div>
        <div class="col-md-6 col-sm-12 text-right">
            <a href="{{ route('adminadd_post') }}" class="btn btn-primary">
                <i class="icon-copy bi bi-plus-circle"> </i>Add Post
            </a>
        </div>
    </div>
</div>

@livewire('admin.posts')

@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Konfigurasi Toastr
        toastr.options = {
            "timeOut": "3000",
            "positionClass": "toast-center"
        };

        window.addEventListener('deletePost', function(event) {
            var id = event.detail[0].id;
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to delete this post.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Delete'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.dispatch('deletePostAction', [id]);
                }
            });
        });

        window.addEventListener('postDeleted', function(event) {
            var message = event.detail[0].message;
            var status = event.detail[0].status;

            if (status === 'success') {
                toastr.success(message);
            } else if (status === 'error') {
                toastr.error(message);
            } else {
              toastr.info(message);
            }

        });
    });
</script>
@endpush
