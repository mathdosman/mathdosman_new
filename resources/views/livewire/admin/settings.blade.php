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
                                <img wire:ignore src="" alt="" class="img-thumbnail" data-ijabo-default-img="/back/site/{{ isset(settings()->site_logo) ? settings()->site_logo : '' }}" id="preview_site_logo">
                            </div>
                            <form action="{{ route('adminupdate_logo') }}" method="POST" enctype="multipart/form-data" id="updateLogoForm">
                            @csrf
                            <div class="mb-2">
                                <input type="file" id="site_logo" name="site_logo" id="" class="form-control">
                                <span class="text-danger ml-1"></span>
                            </div>
                            <button class="btn btn-primary"> Change Logo</button>
                            </form>
                        </div>


                        {{-- <div class="col-md-6">
                            <h6>Unggah Gambar</h6>
                            <div class="mb-2 mt-1" style="max-width: 200px">
                                <img id="preview_image" src="#" alt="Pratinjau Gambar" style="display: none; max-width: 100%;" class="img-thumbnail">
                            </div>
                            <form action="{{ route('adminupdate_logo') }}" method="POST" enctype="multipart/form-data" id="uploadImageForm">
                                @csrf
                                <div class="mb-2">
                                    <input type="file" id="image_upload" name="image" class="form-control">
                                    <span class="text-danger ml-1" id="image_error"></span>
                                </div>
                                <button type="submit" class="btn btn-primary">UChange Logo</button>
                            </form>
                        </div> --}}




                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
