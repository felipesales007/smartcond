<div class="align-items-center mb-4 mt-md--3 mt-xl--5 ml-md-3 ml-sm-0">
    <div class="col-lg-6 col-7">
        <h6 class="h2 text-white d-inline-block fe-mouse-default mb-0">{{ $title }}</h6>
        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-3">
            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                <li class="breadcrumb-item">
                    <a href="{{ app('router')->has('home.index') ? route('home.index') : url('/') }}">
                        <i class="fas fa-home"></i>
                    </a>
                </li>
                {{ $slot }}
            </ol>
        </nav>
    </div>
</div>
