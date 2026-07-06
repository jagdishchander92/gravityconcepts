<x-layout :title="$page->title ?? ''" :meta_title="$page->meta_title ?? ''" :meta_desc="$page->meta_description ?? ''">
    @if ($breadcrumb && isset($breadcrumb['breadcrumb_title']) && $breadcrumb['breadcrumb_title'])
        <div class="breadcumb-area"
            @if ($breadcrumb['image']) style="background-image: url({{ $breadcrumb['image'] }})" @endif>
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12 text-center">
                        <div class="breadcumb-content">
                            <div class="breadcumb-title">
                                <h4>{{ $breadcrumb['breadcrumb_title'] ?? '' }}</h4>
                            </div>
                            <ul>
                                <li><a href="/">Home</a></li>
                                <li>{{ $breadcrumb['breadcrumb_title'] ?? '' }}</li>
                            </ul>
                            <p class="text-white">{{ $breadcrumb['breadcrumb_subtitle'] ?? '' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="pagecraft-preview">

        @if (!empty($sections))
            @foreach ($sections as $section)
                {!! renderNode($section) !!}
            @endforeach
        @endif
    </div>
</x-layout>

@php
    function renderNode($node): string
    {
        if (($node['nodeType'] ?? null) === 'div') {
            return renderDiv($node);
        }
        if (in_array($node['type'] ?? null, ['section', 'bs-row'])) {
            return renderSection($node);
        }
        return renderWidget($node);
    }

    function renderSection($section): string
    {
        if (!isset($section['cols']) || !is_array($section['cols'])) {
            return '';
        }

        $sty = $section['style'] ?? [];
        $isBsRow = ($section['type'] ?? '') === 'bs-row';

        $pad = buildPadding($sty);
        $mar = buildMargin($sty);

        $bgStyle = !empty($sty['bgImage'])
            ? "background-image:url({$sty['bgImage']});background-size:" .
                get($sty, 'bgSize', 'cover') .
                ';background-position:' .
                get($sty, 'bgPosition', 'center') .
                ';background-repeat:' .
                get($sty, 'bgRepeat', 'no-repeat') .
                ';'
            : '';

        $flexStyle = !$isBsRow
            ? 'display:flex;flex-wrap:' .
                get($sty, 'flexWrap', 'wrap') .
                ';gap:' .
                get($sty, 'gap', '0') .
                ';flex-direction:' .
                get($sty, 'flexDirection', 'row') .
                ';align-items:' .
                get($sty, 'alignItems', 'stretch') .
                ';justify-content:' .
                get($sty, 'justifyContent', 'flex-start') .
                ';'
            : '';

        $styleParts = array_filter([
            $flexStyle,
            get($sty, 'background') ? "background:{$sty['background']};" : null,
            $bgStyle,
            $pad ?: null,
            $mar ?: null,
            get($sty, 'border') ? "border:{$sty['border']};" : null,
            get($sty, 'borderRadius') ? "border-radius:{$sty['borderRadius']};" : null,
            get($sty, 'minHeight') ? "min-height:{$sty['minHeight']};" : null,
        ]);

        $style = trim(implode('', $styleParts));
        $classes = trim(get($sty, 'classes', '') . ($isBsRow ? ' row' : ''));

        $html = "<div class=\"{$classes}\" style=\"{$style}\">";

        foreach ($section['cols'] as $col) {
            if (!isset($col['widgets']) || empty($col['widgets'])) {
                continue;
            }

            // Column styles
            if ($isBsRow) {
                $colClass = get($col, 'bsCol', 'col-md-6');
                $html .= "<div class=\"{$colClass}\">";
            } else {
                $width = get($col, 'width', 100 / count($section['cols']));
                $colFlex = $col['flex'] ?? [];
                $colStyleParts = [
                    "flex:0 0 calc({$width}% - 3px);",
                    get($colFlex, 'flexDirection') ? "flex-direction:{$colFlex['flexDirection']};" : null,
                    get($colFlex, 'alignItems') ? "align-items:{$colFlex['alignItems']};" : null,
                    get($colFlex, 'justifyContent') ? "justify-content:{$colFlex['justifyContent']};" : null,
                    get($colFlex, 'gap') ? "gap:{$colFlex['gap']};" : null,
                ];
                $colStyle = trim(implode('', array_filter($colStyleParts)));
                $html .= "<div style=\"{$colStyle}\">";
            }

            // Render widgets/divs/sections INSIDE column
            foreach ($col['widgets'] as $widget) {
                $html .= renderNode($widget); // <-- KEY FIX: Use renderNode() recursively
            }

            $html .= '</div>';
        }

        return $html . '</div>';
    }

    function renderDiv($div): string
    {
        $s = $div['inlineStyles'] ?? [];

        $pad = buildPadding($s);
        $mar = buildMargin($s);

        $bgStyle = !empty($s['bgImage'])
            ? "background-image:url({$s['bgImage']});background-size:" .
                get($s, 'bgSize', 'cover') .
                ';background-position:' .
                get($s, 'bgPosition', 'center') .
                ';'
            : '';

        $styleParts = array_filter([
            get($s, 'background') ? "background:{$s['background']};" : null,
            $pad ?: null,
            $mar ?: null,
            get($s, 'border') ? "border:{$s['border']};" : null,
            get($s, 'borderRadius') ? "border-radius:{$s['borderRadius']};" : null,
            get($s, 'display') ? "display:{$s['display']};" : null,
            get($s, 'flexDirection') ? "flex-direction:{$s['flexDirection']};" : null,
            get($s, 'alignItems') ? "align-items:{$s['alignItems']};" : null,
            get($s, 'justifyContent') ? "justify-content:{$s['justifyContent']};" : null,
            get($s, 'gap') ? "gap:{$s['gap']};" : null,
            get($s, 'width') ? "width:{$s['width']};" : null,
            get($s, 'height') ? "height:{$s['height']};" : null,
            get($s, 'color') ? "color:{$s['color']};" : null,
            get($s, 'fontSize') ? "font-size:{$s['fontSize']};" : null,
            get($s, 'fontWeight') ? "font-weight:{$s['fontWeight']};" : null,
            get($s, 'textAlign') ? "text-align:{$s['textAlign']};" : null,
            $bgStyle,
            get($s, 'boxShadow') ? "box-shadow:{$s['boxShadow']};" : null,
            $div['divStyle'] ?? '',
        ]);

        $style = trim(implode('', $styleParts));
        $html = "<div class=\"" . ($div['divClasses'] ?? '') . "\" style=\"{$style}\">";

        foreach ($div['children'] ?? [] as $child) {
            $html .= renderNode($child); // <-- RECURSIVE: handles nested divs/sections/widgets
        }

        return $html . '</div>';
    }

    function renderWidget($widget): string
    {
        $type = $widget['type'] ?? 'unknown';
        $p = $widget['props'] ?? [];
        $s = $widget['style'] ?? [];

        $pad = buildPadding($s);
        $mar = buildMargin($s);

        $bgStyle = !empty($s['bgImage'])
            ? "background-image:url({$s['bgImage']});background-size:" .
                get($s, 'bgSize', 'cover') .
                ';background-position:' .
                get($s, 'bgPosition', 'center') .
                ';'
            : '';

        $styleParts = array_filter([
            get($s, 'background') ? "background:{$s['background']};" : null,
            $pad ?: null,
            $mar ?: null,
            get($s, 'border') ? "border:{$s['border']};" : null,
            get($s, 'borderRadius') ? "border-radius:{$s['borderRadius']};" : null,
            get($s, 'color') ? "color:{$s['color']};" : null,
            get($s, 'fontSize') ? "font-size:{$s['fontSize']};" : null,
            get($s, 'fontWeight') ? "font-weight:{$s['fontWeight']};" : null,
            get($s, 'textAlign') ? "text-align:{$s['textAlign']};" : null,
            $bgStyle,
            get($s, 'boxShadow') ? "box-shadow:{$s['boxShadow']};" : null,
            get($s, 'opacity') ? "opacity:{$s['opacity']};" : null,
        ]);

        $widgetStyle = trim(implode('', $styleParts));
        $classes = ' ' . get($s, 'classes', '');

        return match ($type) {
            'heading' => view('pagecraft.partials.heading', compact('p', 'widgetStyle', 'classes'))->render(),
            'heading-n' => renderHeadingN($p, $widgetStyle, $p['classes']),
            'subheading' => renderSubHeading($p, $widgetStyle, $p['classes']),
            'text' => renderText($p, $widgetStyle, $classes),
            'button' => renderButton($p, $widgetStyle, $classes),
            'image' => renderImage($p, $widgetStyle, $classes),
            'card-img' => view('pagecraft.partials.card-img', compact('p', 'widgetStyle', 'classes'))->render(),
            'icon-card' => view('pagecraft.partials.icon-card', compact('p', 'widgetStyle', 'classes'))->render(),
            'stats' => view('pagecraft.partials.stats', compact('p', 'widgetStyle', 'classes'))->render(),
            'counter' => view('pagecraft.partials.counter', compact('p', 'widgetStyle', 'classes'))->render(),
            'progress' => view('pagecraft.partials.progress', compact('p', 'widgetStyle', 'classes'))->render(),
            'accordion' => view('pagecraft.partials.accordion', compact('p', 'widgetStyle', 'classes'))->render(),
            // 'testimonial' => renderTestimonial($p, $widgetStyle, $classes),
            'alert' => view('pagecraft.partials.alert', compact('p', 'widgetStyle', 'classes'))->render(),
            'list' => view('pagecraft.partials.list', compact('p', 'widgetStyle', 'classes'))->render(),
            'video' => view('pagecraft.partials.video', compact('p', 'widgetStyle', 'classes'))->render(),
            'html' => renderHtml($p, $widgetStyle, $classes),
            'spacer' => renderSpacer($p, $widgetStyle, $classes),
            'theme-section' => view(
                'pagecraft.partials.theme-section',
                compact('p', 'widgetStyle', 'classes'),
            )->render(),
            'divider' => view('pagecraft.partials.divider', compact('p', 'widgetStyle', 'classes'))->render(),
            'badges' => view('pagecraft.partials.badges', compact('p', 'widgetStyle', 'classes'))->render(),
            'icon' => view('pagecraft.partials.icon', compact('p', 'widgetStyle', 'classes'))->render(),
            'process' => view('pagecraft.partials.process', compact('p', 'widgetStyle', 'classes'))->render(),
            'brands-listing' => view(
                'pagecraft.partials.brands-listing',
                compact('p', 'widgetStyle', 'classes'),
            )->render(),
            'working-process-section' => view(
                'pagecraft.partials.working-process-section',
                compact('p', 'widgetStyle', 'classes'),
            )->render(),
            'shortcode' => renderShortCode($p),
            default
                => "<div class=\"widget-unknown{$classes}\" style=\"{$widgetStyle};padding:14px;border:1px dashed #d6dae4;border-radius:5px;color:#8a90a8;font-size:11px;text-align:center;\">{$type}</div>",
        };
    }

    function renderSubHeading($p, $styles, $classes): string
    {
        return "<p class=\"{$classes}\" style=\"{$styles}\">" . nl2br(e($p['text'] ?? '')) . '</p>';
    }
    // Individual widget renderers
    function renderHeading($p, $styles, $classes): string
    {
        return view('pagecraft.partials.section_heading', compact('p', 'styles', 'classes'));
    }
    function renderHeadingN($p, $style, $classes): string
    {
        $level = $p['level'] ?? 'h2';
        return "<{$level} class=\"{$classes} title text-anime-3\" style=\"{$style}\">" .
            ($p['text'] ?? 'Heading') .
            "</{$level}>";
    }
    function renderSpacer($p, $style, $classes): string
    {
        $style .= 'height:' . $p['height'] . 'px;';
        $content = "<div class=\"{$classes}\" style=\"$style\"></div>";
        return $content;
    }

    function renderText($p, $style, $classes): string
    {
        return "<p class=\"{$classes}\" style=\"{$style}\">" . nl2br(e($p['content'] ?? '')) . '</p>';
    }
    function renderButton($p, $style, $classes): string
    {
        if ($p['style'] == 'outline') {
            return "<a href=\"{$p['href']}\" class=\"primary-btn-outline {$classes}\" style=\"{$style}\">" .
                nl2br(e($p['label'] ?? '')) .
                "<i class=\"ms-1 fa-solid fa-arrow-right\"></i><span style=\"top: 61.2031px; left: 45.5px;\"></span></a>";
        } else {
            return "<a class=\"primary-btn-solid {$classes}\"  style=\"{$style}\" href=\"{$p['href']}\">" .
                nl2br(e($p['label'] ?? '')) .
                "<i class=\"ms-1 fa-solid fa-arrow-right\"></i></a>";
        }
    }

    function renderHtml($p, $style, $classes)
    {
        return $p['code'];
    }

    function renderImage($p, $style, $classes): string
    {
        $size = $p['size'] ?? 'original';
        $url = '';
        if ($size == 'small') {
            $url = changeSize(imgUrl($p['src']), '150x150');
        } elseif ($size == 'medium') {
            $url = changeSize(imgUrl($p['src']), '300x300');
        } elseif ($size == 'large') {
            $url = changeSize(imgUrl($p['src']), '1024x1024');
        } elseif ($size == 'original') {
            $url = $p['src'];
        } else {
            $url = $p['src'];
        }
        return "<img src=\"{$url}\" alt=\"{$p['alt']}\" class=\"{$classes}\" style=\"{$classes}\">";
    }

    function get($array, $key, $default = ''): string
    {
        return $array[$key] ?? $default;
    }

    // REPLACED: buildSpacing removed, use buildPadding / buildMargin instead
    function buildPadding(array $s): string
    {
        $css = '';
        if (isset($s['pt']) && $s['pt'] !== '') {
            $css .= "padding-top:{$s['pt']};";
        }
        if (isset($s['pr']) && $s['pr'] !== '') {
            $css .= "padding-right:{$s['pr']};";
        }
        if (isset($s['pb']) && $s['pb'] !== '') {
            $css .= "padding-bottom:{$s['pb']};";
        }
        if (isset($s['pl']) && $s['pl'] !== '') {
            $css .= "padding-left:{$s['pl']};";
        }
        return $css;
    }

    function buildMargin(array $s): string
    {
        $css = '';
        if (isset($s['mt']) && $s['mt'] !== '') {
            $css .= "margin-top:{$s['mt']};";
        }
        if (isset($s['mr']) && $s['mr'] !== '') {
            $css .= "margin-right:{$s['mr']};";
        }
        if (isset($s['mb']) && $s['mb'] !== '') {
            $css .= "margin-bottom:{$s['mb']};";
        }
        if (isset($s['ml']) && $s['ml'] !== '') {
            $css .= "margin-left:{$s['ml']};";
        }
        return $css;
    }

    function renderShortCode($p)
    {
        $shortcode = explode(':', $p['id'])[0] ?? '';
        $data = explode(':', $p['id'])[1] ?? '';
        switch ($shortcode) {
            case 'contact-form':
                return view('pagecraft.partials.contact-form', compact('data'))->render();
                break;
            case 'testimonials':
                return view('pagecraft.partials.testimonials', compact('data'))->render();
                break;
            case 'slider-1':
                return view('pagecraft.partials.slider-1', compact('data'))->render();
                break;
            case 'services':
                return view('pagecraft.partials.services', compact('data'))->render();
                break;
            case 'features':
                return view('pagecraft.partials.features', compact('data'))->render();
                break;
            case 'latest_blogs':
                return view('pagecraft.partials.latest_blogs', compact('data'))->render();
                break;
            case 'contact-map':
                return view('pagecraft.partials.contact-map', compact('data'))->render();
                break;
            case 'quick-contact':
                return view('pagecraft.partials.quick-contact', compact('data'))->render();
                break;

            default:
                return '<p>Not a valid shortcode</p>';
                break;
        }
    }
@endphp
