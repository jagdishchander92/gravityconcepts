@props(['section_title', 'section_subtitle', 'items' => []])
<section id="about-2" class="section-4 odd highlights team image-right" >
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-8 align-self-top text">
                <div class="row intro m-0">
                    <div class="col-12 p-0">
                        <span class="pre-title m-0"> {!! html_entity_decode($section_subtitle) !!} </span>
                        <h2>{!! html_entity_decode($section_title) !!} </h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 p-0 pr-md-5">
                        {!! html_entity_decode($items[0]['desc'] ?? '') !!}
                    </div>
                </div>

                <!-- Action -->
                <div data-aos="fade-up" class="buttons aos-init aos-animate">
                    <div class="d-sm-inline-flex mt-4">
                        <a href="{{ $items[0]['btn_url'] ?? '' }}"
                            class="smooth-anchor mt-4 btn primary-button">{{ $items[0]['btn_text'] ?? '' }}</a>
                    </div>
                </div>
            </div>
            <div data-aos="zoom-in" class="col-12 col-lg-4 align-self-end aos-init aos-animate">
                <div class="quote">
                    <div class="quote-content">
                        <h4>{!! html_entity_decode($items[0]['card_heading'] ?? '') !!}</h4>
                        {!! html_entity_decode($items[0]['card_desc'] ?? '') !!}
                        <h5>{!! html_entity_decode($items[0]['card_footer'] ?? '') !!}</h5>
                    </div>
                    <i class="quote-right fas fa-quote-right"></i>
                </div>
            </div>
        </div>
    </div>
</section>
