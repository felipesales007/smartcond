<!-- capa -->
<div class="header pb-8 pt-8 d-flex align-items-center fe-img-center" style="background-image: url({{ url('images/default/default-background.png') }});">
    <!-- máscara de gradiente -->
    <span class="mask bg-dark opacity-5"></span>
    <!-- título e descrição -->
    <div class="container-fluid d-flex align-items-center">
        <div class="row">
            <div class="col-md-12">
                @if (isset($logo) && $logo)
                    <span class="avatar avatar-xl float-left mr-3 {{ strlen($title) > 17 ? 'mt-3' : 'mt--1 mb-4' }}">
                        <img src="{{ url('storage/images/companies/logo/' . $logo) }}" class="fe-img-center" alt="">
                    </span>
                @endif
                @if (isset($title) && $title) <h1 class="text-white {{ strlen($title) > 17 ? 'display-3' : 'display-2' }}">{{ $title }}</h1> @endif
                @if (isset($description) && $description) <p class="text-white d-inline-block mt-0 mb-5">{!! $description !!}</p> @endif
            </div>
        </div>
    </div>
</div>
