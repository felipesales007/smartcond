<div class="header pb-9 pt-8 mb--8 align-items-center fe-img-center" style="background-image: url({{ auth()->user()->profileBackground() }});">
    <!-- máscara de gradiente -->
    <span class="mask bg-primary opacity-5"></span>
    <div class="align-items-center mt--5 ml-md-3 ml-sm-0">
        <!-- título e descrição -->
        <div class="col-12">
            @if (isset($title) && $title) <h1 class="text-white {{ strlen($title) > 17 ? 'display-3' : 'display-2' }}">{{ $title }}</h1> @endif
            @if (isset($description) && $description) <p class="text-white">{!! $description !!}</p> @endif
        </div>
    </div>
</div>
