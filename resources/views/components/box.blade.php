@props(['title', 'jumlah', 'route', 'icon', 'background'])
<div class="col-lg-3 col-6">
    <div class="small-box {{ $background }}">
        <div class="inner">
            <h3 class="text-light">{{ $jumlah }}</h3>
            <p class="text-light">{{ $title }}</p>
        </div>
        <div class="icon">
            <i class="{{ $icon }}"></i>
        </div>
        <a href="{{ $route }}" class="small-box-footer">
            <p class="text-light">Lihat <i class="fas fa-arrow-circle-right"></i></p>
        </a>
    </div>
</div>
