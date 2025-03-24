<div>
    <div class="tab">
        <ul class="nav nav-tabs customtab" role="tablist">
            <li class="nav-item">
                <a wire:click="selectTab('general_settings')"
                    class="nav-link {{ $tab == 'general_settings' ? 'active' : '' }}" data-toggle="tab"
                    href="#general_settings" role="tab" aria-selected="false">General settings</a>
            </li>
            <li class="nav-item">
                <a wire:click="selectTab('logo_favicon')" class="nav-link {{ $tab == 'logo_favicon' ? 'active' : '' }}"
                    data-toggle="tab" href="#logo_favicon" role="tab" aria-selected="false">Logo & Favicon</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade {{ $tab == 'general_settings' ? 'active show' : '' }}" id="general_settings"
                role="tabpanel">
                <div class="pd-20">
                    <form wire:submit='updateSiteInfo()'>
                        <x-form-alerts></x-form-alerts>
                        <div class="row">
                        </div>
                        <div class="form-group">
                        </div>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>






            <div class="tab-pane fade {{ $tab == 'logo_favicon' ? 'active show' : '' }}" id="logo_favicon"
                role="tabpanel">
                <div class="pd-20">
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Site Logo</h6>
                            <div class="mb-2 mt-1" style="max-width: 200px">
                                <img alt="Site Logo"
                                    src="{{ asset('/images/site/' . (settings()->site_logo ?? 'default.png')) }}"
                                    class="img-thumbnail" id="preview_site_logo">
                            </div>
                            <form action="{{ route('adminupdate_logo') }}" method="POST" enctype="multipart/form-data"
                                id="updateLogoForm">
                                @csrf
                                <div class="mb-2">
                                    <input type="file" id="site_logo" name="site_logo" class="form-control">
                                    <span class="text-danger ml-1"></span>
                                </div>
                                <button class="btn btn-primary">Change Logo</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>








        </div>
    </div>
</div>

<script>
document.getElementById('site_logo').addEventListener('change', function(event) {
    var file = event.target.files[0];
    var imageType = /^image\//;

    if (!imageType.test(file.type)) {
        alert("Hanya file gambar yang diizinkan!");
        event.target.value = "";
        document.getElementById('preview_site_logo').src = "";
        return;
    }

    var reader = new FileReader();
    reader.onload = function() {
        var output = document.getElementById('preview_site_logo');
        output.src = reader.result;
    };
    reader.readAsDataURL(file);
});
</script>
