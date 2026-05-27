<!-- latest blog section one -->
<div class="latest-blog-section-one">
    <div class="auto-container">
        <div class="row">
            <div class="col-lg-12">
                <div class="sec-title text-center">
                    <div class="section-sub-title">
                        <h1 class="sub-title"><img src="{{ asset('frontend/images/main-home/sub-title-icon.png') }}"
                                alt="sub-icon">Latest Blog
                        </h1>
                    </div>
                    <div class="section-title">
                        <h1 class="title text-anime-3">Read Our Latest Blogs</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="row fade-wrapper">
            @php
                $latest_blogs = \App\Models\Blog::latest()->take(4)->get();
            @endphp

            @if ($latest_blogs->count())
                @php $firstBlog = $latest_blogs->first(); @endphp

                <div class="col-xl-6 col-lg-12">
                    <div class="single-blog-box fade-up">
                        <div class="blog-thumb reveal">
                            <img src="{{ asset($firstBlog->img ?? 'frontend/images/main-home/blog-thumb.png') }}"
                                alt="{{ $firstBlog->title }}" >
                        </div>

                        <div class="blog-content">
                            <div class="blog-meta">
                                <a href="{{ route('blog.details', $firstBlog->slug) }}">
                                    {{ $firstBlog->category->name ?? 'BLOG' }}
                                </a>

                                <p>{{ \Carbon\Carbon::parse($firstBlog->created_at)->format('d F, Y') }}</p>
                            </div>

                            <h2 class="blog-title">
                                <a href="{{ route('blog.details', $firstBlog->slug) }}" data-cursor-text="View">
                                    {{ $firstBlog->title }}
                                </a>
                            </h2>

                            <div class="blog-btn">
                                <a href="{{ route('blog.details', $firstBlog->slug) }}">
                                    Read More
                                    <i class="fa-solid fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6 col-lg-12">
                    @foreach ($latest_blogs->skip(1) as $blog)
                        <div class="blog-single-box fade-up">
                            <div class="blog-thumb reveal">
                                <img src="{{ asset($blog->img ?? 'frontend/images/main-home/blog-thumb2.png') }}"
                                    alt="{{ $blog->title }}" width="280">
                            </div>

                            <div class="blog-content">
                                <div class="blog-meta">
                                    <a href="{{ route('blog.details', $blog->slug) }}">
                                        {{ $blog->category->name ?? 'BLOG' }}
                                    </a>

                                    <p>{{ \Carbon\Carbon::parse($blog->created_at)->format('d F, Y') }}</p>
                                </div>

                                <h2 class="blog-title">
                                    <a href="{{ route('blog.details', $blog->slug) }}" data-cursor-text="View">
                                        {{ $blog->title }}
                                    </a>
                                </h2>

                                <div class="blog-btn">
                                    <a href="{{ route('blog.details', $blog->slug) }}">
                                        Read More
                                        <i class="fa-solid fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    
                </div>
            @endif
        </div>
    </div>
</div>
<!-- latest blog section one -->
