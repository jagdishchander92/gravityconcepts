 <div class="modal fade" id="stylesCardIcon">
     <div class="modal-dialog modal-dialog-centered modal-xl">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title">Styles Preview</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
             </div>
             <div class="modal-body">
                 <div class="row g-3">
                     @foreach (['style_1', 'style_2', 'style_3', 'style_4'] as $s)
                         <div class="col-md-6">
                             <div class="card h-100">
                                 <img src="{{ asset("backend/ui/card_icon/$s.png") }}" class="card-img-top h-100"
                                     alt="{{ $s }}">
                                 <div class="card-body py-2">
                                     <h6 class="card-title mb-0">{{ $s }}</h6>
                                 </div>
                             </div>
                         </div>
                     @endforeach
                 </div>
             </div>
         </div>
     </div>
 </div>
 <div class="modal fade" id="stylesCardImg">
     <div class="modal-dialog modal-dialog-centered modal-xl">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title">Styles Preview</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
             </div>
             <div class="modal-body">
                 <div class="row g-3">
                     @foreach (['style_1', 'style_2'] as $s)
                         <div class="col-md-6">
                             <div class="card h-100">
                                 <img src="{{ asset("backend/ui/card_img/$s.png") }}" class="card-img-top h-100"
                                     alt="{{ $s }}">
                                 <div class="card-body py-2">
                                     <h6 class="card-title mb-0">{{ $s }}</h6>
                                 </div>
                             </div>
                         </div>
                     @endforeach
                 </div>
             </div>
         </div>
     </div>
 </div>
 <div class="modal fade" id="stylesCardBasic">
     <div class="modal-dialog modal-dialog-centered modal-xl">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title">Styles Preview</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
             </div>
             <div class="modal-body">
                 <div class="row g-3">
                     @foreach (['style_1'] as $s)
                         <div class="col-md-6">
                             <div class="card h-100">
                                 <img src="{{ asset("backend/ui/card_basic/$s.png") }}" class="card-img-top h-100"
                                     alt="{{ $s }}">
                                 <div class="card-body py-2">
                                     <h6 class="card-title mb-0">{{ $s }}</h6>
                                 </div>
                             </div>
                         </div>
                     @endforeach
                 </div>
             </div>
         </div>
     </div>
 </div>
 <div class="modal fade" id="stylesUl">
     <div class="modal-dialog modal-dialog-centered modal-xl">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title">Styles Preview</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
             </div>
             <div class="modal-body">
                 <div class="row g-3">
                     @foreach (['style_1'] as $s)
                         <div class="col-md-6">
                             <div class="card h-100">
                                 <img src="{{ asset("backend/ui/ul/$s.png") }}" class="card-img-top h-100"
                                     alt="{{ $s }}">
                                 <div class="card-body py-2">
                                     <h6 class="card-title mb-0">{{ $s }}</h6>
                                 </div>
                             </div>
                         </div>
                     @endforeach
                 </div>
             </div>
         </div>
     </div>
 </div>
 <div class="modal fade" id="stylesOl">
     <div class="modal-dialog modal-dialog-centered modal-xl">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title">Styles Preview</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
             </div>
             <div class="modal-body">
                 <div class="row g-3">
                     @foreach (['style_1'] as $s)
                         <div class="col-md-6">
                             <div class="card h-100">
                                 <img src="{{ asset("backend/ui/ol/$s.png") }}" class="card-img-top h-100"
                                     alt="{{ $s }}">
                                 <div class="card-body py-2">
                                     <h6 class="card-title mb-0">{{ $s }}</h6>
                                 </div>
                             </div>
                         </div>
                     @endforeach
                 </div>
             </div>
         </div>
     </div>
 </div>
 <div class="modal fade" id="stylesIconList">
     <div class="modal-dialog modal-dialog-centered modal-xl">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title">Styles Preview</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
             </div>
             <div class="modal-body">
                 <div class="row g-3">
                     @foreach (['style_1'] as $s)
                         <div class="col-md-6">
                             <div class="card h-100">
                                 <img src="{{ asset("backend/ui/icon_list/$s.png") }}" class="card-img-top h-100"
                                     alt="{{ $s }}">
                                 <div class="card-body py-2">
                                     <h6 class="card-title mb-0">{{ $s }}</h6>
                                 </div>
                             </div>
                         </div>
                     @endforeach
                 </div>
             </div>
         </div>
     </div>
 </div>
 <div class="modal fade" id="stylesDescOnly">
     <div class="modal-dialog modal-dialog-centered modal-xl">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title">Styles Preview</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
             </div>
             <div class="modal-body">
                 <div class="row g-3">
                     @foreach (['style_1'] as $s)
                         <div class="col-md-6">
                             <div class="card h-100">
                                 <img src="{{ asset("backend/ui/desc_only/$s.png") }}" class="card-img-top h-100"
                                     alt="{{ $s }}">
                                 <div class="card-body py-2">
                                     <h6 class="card-title mb-0">{{ $s }}</h6>
                                 </div>
                             </div>
                         </div>
                     @endforeach
                 </div>
             </div>
         </div>
     </div>
 </div>
 <div class="modal fade" id="stylesZigZag">
     <div class="modal-dialog modal-dialog-centered modal-xl">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title">Styles Preview</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
             </div>
             <div class="modal-body">
                 <div class="row g-3">
                     @foreach (['style_1'] as $s)
                         <div class="col-md-6">
                             <div class="card h-100">
                                 <img src="{{ asset("backend/ui/zig_zag/$s.png") }}" class="card-img-top h-100"
                                     alt="{{ $s }}">
                                 <div class="card-body py-2">
                                     <h6 class="card-title mb-0">{{ $s }}</h6>
                                 </div>
                             </div>
                         </div>
                     @endforeach
                 </div>
             </div>
         </div>
     </div>
 </div>
 <div class="modal fade" id="stylesCounter">
     <div class="modal-dialog modal-dialog-centered modal-xl">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title">Styles Preview</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
             </div>
             <div class="modal-body">
                 <div class="row g-3">
                     @foreach (['style_1'] as $s)
                         <div class="col-md-12">
                             <div class="card h-100">
                                 <img src="{{ asset("backend/ui/counter/$s.png") }}" class="card-img-top h-100"
                                     alt="{{ $s }}">
                                 <div class="card-body py-2">
                                     <h6 class="card-title mb-0">{{ $s }}</h6>
                                 </div>
                             </div>
                         </div>
                     @endforeach
                 </div>
             </div>
         </div>
     </div>
 </div>
 <div class="modal fade" id="stylesFaq">
     <div class="modal-dialog modal-dialog-centered modal-xl">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title">Styles Preview</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
             </div>
             <div class="modal-body">
                 <div class="row g-3">
                     @foreach (['style_1'] as $s)
                         <div class="col-md-6">
                             <div class="card h-100">
                                 <img src="{{ asset("backend/ui/faq/$s.png") }}" class="card-img-top h-100"
                                     alt="{{ $s }}">
                                 <div class="card-body py-2">
                                     <h6 class="card-title mb-0">{{ $s }}</h6>
                                 </div>
                             </div>
                         </div>
                     @endforeach
                 </div>
             </div>
         </div>
     </div>
 </div>
 <div class="modal fade" id="stylesGallary">
     <div class="modal-dialog modal-dialog-centered modal-xl">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title">Styles Preview</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
             </div>
             <div class="modal-body">
                 <div class="row g-3">
                     @foreach (['style_1'] as $s)
                         <div class="col-md-6">
                             <div class="card h-100">
                                 <img src="{{ asset("backend/ui/gallary/$s.png") }}" class="card-img-top h-100"
                                     alt="{{ $s }}">
                                 <div class="card-body py-2">
                                     <h6 class="card-title mb-0">{{ $s }}</h6>
                                 </div>
                             </div>
                         </div>
                     @endforeach
                 </div>
             </div>
         </div>
     </div>
 </div>
 <div class="modal fade" id="stylesAboutSec1">
     <div class="modal-dialog modal-dialog-centered modal-xl">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title">Styles Preview</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
             </div>
             <div class="modal-body">
                 <div class="row g-3">
                     <div class="col-md-12">
                         <div class="card h-100">
                             <img src="{{ asset('backend/ui/more/about_sec_1.png') }}" class="card-img-top h-100"
                                 alt="">
                             <div class="card-body py-2">
                                 <h6 class="card-title mb-0"></h6>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <div class="modal fade" id="stylesCompanyAboutSec1">
     <div class="modal-dialog modal-dialog-centered modal-xl">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title">Styles Preview</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
             </div>
             <div class="modal-body">
                 <div class="row g-3">
                     <div class="col-md-12">
                         <div class="card h-100">
                             <img src="{{ asset('backend/ui/more/comp_about_sec_1_light.png') }}" class="card-img-top h-100"
                                 alt="">
                             <div class="card-body py-2">
                                 <h6 class="card-title mb-0"></h6>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <div class="modal fade" id="stylesCompanyAboutSec2">
     <div class="modal-dialog modal-dialog-centered modal-xl">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title">Styles Preview</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
             </div>
             <div class="modal-body">
                 <div class="row g-3">
                     <div class="col-md-12">
                         <div class="card h-100">
                             <img src="{{ asset('backend/ui/more/comp_about_sec_2_dark.png') }}" class="card-img-top h-100"
                                 alt="">
                             <div class="card-body py-2">
                                 <h6 class="card-title mb-0"></h6>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <div class="modal fade" id="stylesResultsCounter">
     <div class="modal-dialog modal-dialog-centered modal-xl">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title">Styles Preview</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
             </div>
             <div class="modal-body">
                 <div class="row g-3">
                     <div class="col-md-12">
                         <div class="card h-100">
                             <img src="{{ asset('backend/ui/more/results_counter.png') }}" class="card-img-top h-100"
                                 alt="">
                             <div class="card-body py-2">
                                 <h6 class="card-title mb-0"></h6>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <div class="modal fade" id="stylesProgress">
     <div class="modal-dialog modal-dialog-centered modal-xl">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title">Styles Preview</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
             </div>
             <div class="modal-body">
                 <div class="row g-3">
                     <div class="col-md-12">
                         <div class="card h-100">
                             <img src="{{ asset('backend/ui/more/progress.png') }}" class="card-img-top h-100"
                                 alt="">
                             <div class="card-body py-2">
                                 <h6 class="card-title mb-0"></h6>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <div class="modal fade" id="stylesCompAboutSec">
     <div class="modal-dialog modal-dialog-centered modal-xl">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title">Styles Preview</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
             </div>
             <div class="modal-body">
                 <div class="row g-3">
                     <div class="col-md-12">
                         <div class="card h-100">
                             <img src="{{ asset('backend/ui/more/comp_about_sec_3.png') }}" class="card-img-top h-100"
                                 alt="">
                             <div class="card-body py-2">
                                 <h6 class="card-title mb-0"></h6>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
