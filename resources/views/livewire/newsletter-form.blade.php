<div>

    <div class="row">
        <div class="col-md-12">
            <div class="section-title">
                <h4 class="title">Newsletter</h4>
            </div>
            <form class="form-sidebar subscription" wire:submit="subscribe()" method="post">
                @csrf
                <x-form-alerts></x-form-alerts>
                <p>Masukan Email Untuk Berlangganan Konten Terbaru!</p>
                <div>
                    <input type="text" wire:model.live="email" class="form-control rounded-0" placeholder="Your Email Address">
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="fa fa-paper-plane"></i>
                    </button>
                </div>
                @error('email')
                    <span class="text-danger ml-1">
                        {{ $message }}
                    </span>
                @enderror
            </form>
        </div>
    </div>

</div>
