@switch($node['type'])

    @case('section')

        <section class="{{ $node['settings']['class'] ?? '' }}">

            @foreach($node['children'] ?? [] as $child)
                {!! renderNode($child) !!}
            @endforeach

        </section>

    @break


    @case('row')

        <div class="row">

            @foreach($node['children'] ?? [] as $child)
                {!! renderNode($child) !!}
            @endforeach

        </div>

    @break


    @case('column')

        <div class="col-lg-{{ $node['settings']['width'] ?? 12 }}">

            @foreach($node['children'] ?? [] as $child)
                {!! renderNode($child) !!}
            @endforeach

        </div>

    @break


    @case('heading')

        <h2>
            {{ $node['data']['text'] ?? '' }}
        </h2>

    @break

@endswitch