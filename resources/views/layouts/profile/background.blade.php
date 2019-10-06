<!-- capa -->
<div class="header pb-8 pt-8 d-flex align-items-center fe-img-center" style="background-image: url({{ auth()->user()['background'] ? url('storage/img/users/background/' . auth()->user()['background']) : url('img/default/default-background.png') }});">
    <!-- máscara de gradiente -->
    <span class="mask bg-gradient-primary opacity-5"></span>
    <!-- título e descrição -->
    <div class="container-fluid d-flex align-items-center">
        <div class="row">
            <div class="col-md-12">
                @if (isset($title) && $title) <h1 class="text-white {{ strlen($title) > 17 ? 'display-3' : 'display-2' }}">{{ $title }}</h1> @endif
                @if (isset($description) && $description) <p class="text-white mt-0 mb-5">{!! $description !!}</p> @endif
            </div>
        </div>
    </div>
</div>
