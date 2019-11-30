<div class="header bg-gradient-primary pb-7 pb-xl-8 pt-6 pt-md-7 pt-xl-8 mb--7 mb-xl--8">
    <div class="align-items-center mb-4 mt-md--3 mt-xl--5 ml-md-3 ml-sm-0">
        <div class="col-lg-10 col-sm-8 col-6">
            <h6 class="h2 text-white d-inline-block fe-mouse mb-0">{{ $title }}</h6>
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
        @if (isset($link))
            <div class="col-lg-2 col-sm-4 col-6 position-absolute text-right right-0 mt--4-5 mr-0 mr-md-3">{{ $link }}</div>
        @endif
    </div>
</div>
@if (isset($xl))
    <div class="bg-gradient-primary position-absolute w-100 mt-7 mt-xl-0 pt-9 pb-8"></div>
@endif
