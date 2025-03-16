@extends('back.layout.pages-layout')
@section('pageTitle', isset($pageTitle)? $pageTitle : "Page Title Here")
@section('content')

<div class="page-header">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="title">
                <h4>Settings</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admindashboard') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Settings
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="pd-20 card-box mb-4">
    @livewire('admin.settings')
</div>

@endsection

@push('scripts')
<script>

    $(document).ready(function() {
        // Konfigurasi Toastr
        toastr.options = {
            "timeOut": "5000",
            "positionClass": "toast-top-right"
        };

        $('#site_logo').change(function(e) {
            const file = e.target.files[0];
            const preview = $('#preview_site_logo');

            if (file) {
                if (!file.type.startsWith('image/')) {
                    toastr.error('Hanya file gambar yang diizinkan.');
                    $(this).val('');
                    preview.attr('src', '#').hide();
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(event) {
                    preview.attr('src', event.target.result).show();
                    new Viewer(preview[0]);
                }
                reader.readAsDataURL(file);
            } else {
                preview.attr('src', '#').hide();
            }
        });

        $('#updateLogoForm').submit(function(e) {
            e.preventDefault();
            const form = this;
            const file = $(form).find('input[type="file"]')[0].files[0];
            const errorElement = $(form).find('span.text-danger');

            if (file) {
                $.ajax({
                    url: $(form).attr('action'),
                    method: $(form).attr('method'),
                    data: new FormData(form),
                    processData: false,
                    dataType: 'json',
                    contentType: false,
                    success: function(data) {
                        if (data.status == 1) {
                            $(form)[0].reset();
                            toastr.success(data.message);
                            $('img.site_logo').each(function() {
                                $(this).attr('src', '/' + data.image_path);
                            });
                        } else {
                            toastr.error(data.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                        toastr.error('An error occurred. Please try again.');
                    }
                });
            } else {
                errorElement.text('Please, select an image file');
            }
        });
    });

</script>
@endpush
