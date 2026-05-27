 <!-- work process section one -->
 <section class="work-process-section-one mt-3">
     <div class="auto-container">
         <div class="row">
             <div class="col-lg-12">
                 <div class="sec-title text-center">
                     <div class="section-sub-title">
                         <h1 class="sub-title"><img src="{{ asset('frontend/images/main-home/sub-title-icon.png') }}"
                                 alt="sub-icon">{!! html_entity_decode($p['subtitle'] ?? '') !!}</h1>
                     </div>
                     <div class="section-title">
                         <h1 class="title text-white text-anime-3">{!! html_entity_decode($p['title'] ?? '') !!}</h1>
                     </div>
                 </div>
             </div>
         </div>
         <div class="row">
             <div class="col-xl-4 col-lg-6 col-md-6">
                 <div class="working-process-box first before-transprent after-transprent fade-in">
                     <div class="process-icon">
                         <i class="fa {{ $p['cards'][0]['icon'] }} fs-1 text-white"></i>
                     </div>
                     <div class="process-content">
                         <h2> {{ $p['cards'][0]['text'] }} </h2>
                         <p>{{ $p['cards'][0]['desc'] }}</p>
                     </div>
                 </div>
             </div>
             <div class="col-xl-4 col-lg-6 col-md-6">
                 <div class="working-process-box after-transprent fade-in">
                     <div class="process-icon">
                         <i class="fa {{ $p['cards'][1]['icon'] }} fs-1 text-white"></i>
                     </div>
                     <div class="process-content">
                         <h2> {{ $p['cards'][1]['text'] }} </h2>
                         <p>{{ $p['cards'][1]['desc'] }}</p>
                     </div>
                 </div>
             </div>
             <div class="col-xl-4 col-lg-6 col-md-6">
                 <div class="working-process-box first before-transprent fade-in">
                     <div class="process-icon">
                         <i class="fa {{ $p['cards'][2]['icon'] }} fs-1 text-white"></i>
                     </div>
                     <div class="process-content">
                         <h2> {{ $p['cards'][2]['text'] }} </h2>
                         <p>{{ $p['cards'][2]['desc'] }}</p>
                     </div>
                 </div>
             </div>
         </div>
         <div class="work-process-shape1">
             <img src="{{ asset('frontend/images/main-home/process-shape1.png') }}" alt="shape1">
         </div>
         <div class="work-process-shape2">
             <img src="{{ asset('frontend/images/main-home/process-shape2.png') }}" alt="shape2">
         </div>
     </div>
 </section>
 <!-- work process section one -->
