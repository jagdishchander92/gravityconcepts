@props(['section_title', 'section_subtitle', 'section_desc' => '', 'items' => []])
<section id="gallery" class="section-3 offers">
    <div class="overflow-holder">
        <div class="container">
            <div class="row text-center intro">
                <div class="col-12">
                    <span class="pre-title">{!! $section_subtitle !!}</span>
                    <h2>{!! $section_title !!}</h2>
                    <p class="text-max-800">{!! $section_desc !!}.</p>
                </div>
            </div>
            <div class="row gallery justify-content-center items">
                @foreach ($items as $item)
                    <a class="col-12 col-md-6 col-lg-4 item" href="{{ asset(imgUrl($item['img'])) }}">
                        <img src="{{ asset(changeSize(imgUrl($item['img']),'300x300')) }}" alt="Project" class="w-100">
                    </a>
                @endforeach



            </div>
        </div>
    </div>
</section>
