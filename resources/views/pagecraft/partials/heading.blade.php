 <div class="sec-title {{ $classes }}" style="{{ $widgetStyle }}">
     @if (isset($p['sub']) && $p['sub'])
         <div class="section-sub-title">
             <h1 class="sub-title"><img src="{{ url('frontend/images') }}/main-home/sub-title-icon.png"
                     alt="sub-icon">{{ $p['sub'] ?? '' }}
             </h1>
         </div>
     @endif
     @php
         $level = $p['level'] ?? 'h2';
     @endphp
     <div class="section-title">
         <{{ $level }}>
             {{ $p['text'] ?? '' }}
             </{{ $level }}>
     </div>
 </div>
