<div>
    <div class="tab">
        <ul class="nav nav-tabs customtab" role="tablist">
            <li class="nav-item">
                <a wire:click="selectTab('general_settings')" class="nav-link {{ $tab == 'general_settings' ? 'active' : '' }}" data-toggle="tab" href="#general_settings" role="tab" aria-selected="false">General settings</a>
            </li>
            <li class="nav-item">
                <a wire:click="selectTab('logo_favicon')" class="nav-link {{ $tab == 'logo_favicon' ? 'active' : '' }}" data-toggle="tab" href="#logo_favicon" role="tab" aria-selected="false">Logo & Favicon</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade {{ $tab == 'general_settings' ? 'active show' : '' }}" id="general_settings" role="tabpanel">
                <div class="pd-20">
                    <form wire:submit='updateSiteInfo()'>
                        <x-form-alerts></x-form-alerts>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><b>Site title</b></label>
                                    <input type="text" class="form-control" wire:model="site_title" placeholder="Enter site title">
                                    @error('site_title')
                                        <span class="text-danger ml-1">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><b>Site email</b></label>
                                    <input type="text" class="form-control" wire:model="site_email" placeholder="Enter site email">
                                    @error('site_email')
                                        <span class="text-danger ml-1">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><b>Site phone number</b> <small>(optional)</small></label>
                                    <input type="text" class="form-control" wire:model="site_phone" placeholder="Enter site contact phone">
                                    @error('site_phone')
                                        <span class="text-danger ml-1">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><b>Site Meta Keyword</b> <small>(optional)</small></label>
                                    <input type="text" class="form-control" wire:model="site_meta_keyword" placeholder="Eg: ecommerce, free api, laravel">
                                    @error('site_meta_keyword')
                                        <span class="text-danger ml-1">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for=""><b>Site Meta Description</b> <small>(optional)</small></label>
                            <textarea wire:model="site_meta_description" class="form-control" cols="4" rows="4" placeholder="Type site meta description..."></textarea>
                            @error('site_meta_description')
                                <span class="text-danger ml-1">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
            <div class="tab-pane fade {{ $tab == 'logo_favicon' ? 'active show' : '' }}" id="logo_favicon" role="tabpanel">
                <div class="pd-20">
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Site Logo</h6>
                            <div class="mb-2 mt-1" style="max-width: 200px">
                                <img alt="Site Logo" src="{{ asset('images/site/' . (settings()->site_logo ?? 'default.png')) }}" class="img-thumbnail" id="preview_site_logo">
                            </div>
                            <form action="{{ route('adminupdate_logo') }}" method="POST" enctype="multipart/form-data" id="updateLogoForm">
                                @csrf
                                <div class="mb-2">
                                    <input type="file" id="site_logo" name="site_logo" class="form-control">
                                    <span class="text-danger ml-1"></span>
                                </div>
                                <button class="btn btn-primary">Change Logo</button>
                            </form>
                        </div>
                        <div class="col-md-4">
                            <h6>Site Favicon</h6>
                            <div class="mb-2 mt-1" style="max-width: 200px">
                                <img alt="Site Favicon" src="{{ asset('images/site/' . (settings()->site_favicon ?? 'default_favicon.png')) }}" class="img-thumbnail" id="preview_site_favicon">
                            </div>
                            <form action="{{ route('adminupdate_favicon') }}" method="POST" enctype="multipart/form-data" id="updateFaviconForm">
                                @csrf
                                <div class="mb-2">
                                    <input type="file" id="site_favicon" name="site_favicon" class="form-control">
                                    <span class="text-danger ml-1"></span>
                                </div>
                                <button class="btn btn-primary">Change Favicon</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function previewImage(inputId, previewId) {
        document.getElementById(inputId).addEventListener('change', function(event) {
            var file = event.target.files[0];
            var imageType = /^image\//;

            if (!imageType.test(file.type)) {
                alert("Hanya file gambar yang diizinkan!");
                event.target.value = "";
                document.getElementById(previewId).src = "";
                return;
            }

            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById(previewId);
                output.src = reader.result;
            };
            reader.readAsDataURL(file);
        });
    }

    previewImage('site_logo', 'preview_site_logo');
    previewImage('site_favicon', 'preview_site_favicon');
</script>
<script>
    @if(session('success'))
        toastr.success('{{ session('success') }}');
    @elseif(session('error'))
        toastr.error('{{ session('error') }}');
    @endif
</script>
