<x-layout>
    <!-- breadcumb Section-->
    <div class="breadcumb-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12 text-center">
                    <div class="breadcumb-content">
                        <div class="breadcumb-title">
                            <h4>Blogs</h4>
                        </div>
                        <ul>
                            <li><a href="/">Home</a></li>
                            <li>Blogs</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--breadcumb Section-->

    <!-- latest blog section classic -->
    <div class="latest-blog-section-classic">
        <div class="auto-container">
            <div class="row">
                @foreach ($blogs as $blog)
                    <div class="col-xl-4 col-lg-6 col-md-6">
                        <div class="single-blog-box">
                            <div class="blog-thumb reveal">
                                <img src="{{ $blog->img }}" alt="thumb">
                            </div>
                            <div class="blog-content">
                                <div class="blog-meta">
                                    <a
                                        href="{{ url("blog/$blog->slug") }}">{{ $blog->published_at?->format('d M, Y') }}</a>
                                </div>
                                <h3 class="blog-title"><a href="{{ url("blog/$blog->slug") }}"
                                        data-cursor-text="View">{{ $blog->title }}</a></h3>
                                <div class="blog-autor">
                                    <a href="blog-details.html">By - <span>Pankaj Mehta</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row mt-3">
                {{ $blogs->links() }}
            </div>
        </div>
    </div>
    <!-- latest blog section classic -->
</x-layout>
