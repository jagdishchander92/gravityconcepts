@props(['section_title', 'section_subtitle', 'section_desc' => '', 'items' => []])
<style>
    /* LIST STYLE */
    .icon-list-section .ul {
        /* display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        padding: 0;
        margin: 0; */
    }

    .icon-list-section .ul li {
        list-style: none;
        margin-bottom: 1rem;
    }

    /* CARD STYLE */
    .icon-list-section .ul li .d-flex {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 18px 20px;
        border-radius: 12px;
        background: #ffffff;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }

    .icon-list-section .ul li .d-flex:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
    }

    /* ICON STYLE */
    .icon-list-section .ul li i {
        font-size: 20px;
        color: var(--primary-color);
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--primary-bg-color-3);
        border-radius: 50%;
    }

    /* TEXT STYLE */
    .icon-list-section .ul li span {
        /* font-size: 15px; */
        color: #374151;
        line-height: 1.5;
    }
</style>
<section class="icon-list-section section-3 offers">
    <div class="overflow-holder">
        <div class="container">
            <div class="row text-center intro">
                <div class="col-12">
                    <span class="pre-title">{!! html_entity_decode($section_subtitle) !!}</span>
                    <h2>{!! html_entity_decode($section_title) !!}</h2>
                    <p class="text-max-800">{!! html_entity_decode($section_desc) !!}</p>
                </div>
            </div>
            <div class="ul">
                @foreach ($items as $item)
                    <li>
                        <div class="d-flex">
                            <i class="{{ $item['icon'] }}"></i>
                            <span>{!! html_entity_decode($item['text']) !!}</span>
                        </div>
                    </li>
                @endforeach

            </div>
        </div>
    </div>
</section>
