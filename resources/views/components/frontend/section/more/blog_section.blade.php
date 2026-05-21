@props([
    'category' => '',
])
@php
    $blogs = \App\Models\Blog::where('category_id', $category)->limit(3)->latest('id')->get();
    $category_name = \App\Models\Category::find($category);
@endphp
<section id="blog" class="section-3 single showcase projects" style="background-image: url({{ asset('frontend/images/10.jpg') }})">
    <div class="container">
        <div class="col-12 align-self-center text-center mb-5">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <span class="pre-title m-1">{{ $category_name->title }}</span>
                    <h2 class="mb-0">Our Latest <span class="featured"><span>Blogs</span></span></h2>
                </div>
                <a href="{{ url('/blogs') }}"> <button class="btn ml-lg-auto primary-button">All Blogs</button></a>
            </div>
        </div>
        <div class="row items">
            @foreach ($blogs as $blog)
                <div class="col-12 col-md-4 item">
                    <div class="row card p-0 text-center">
                        <div class="image-over">
                            <img src="{{ asset(imgUrl($blog->img)) }}" alt="{{ $blog->img_desc ?? $blog->title }}">
                        </div>
                        <div class="card-footer d-lg-flex align-items-center justify-content-center">
                            <a href="#" class="d-lg-flex align-items-center"><i class="icon-user"></i>Pankaj
                                Mehta</a>
                            <a href="#" class="d-lg-flex align-items-center">
                                <i class="icon-clock"></i>{{ $blog->published_at->shortAbsoluteDiffForHumans() }}
                                ago</a>
                        </div>
                        <div class="card-caption col-12 p-0">
                            <div class="card-body">
                                <a href="{{ url('blog/' . $blog->slug) }}">
                                    <h4>{{ $blog->title }}</h4>
                                    <p style="white-space: unset;">
                                        {{ \Illuminate\Support\Str::limit($blog->summary, 60, '...') }}
                                    </p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
