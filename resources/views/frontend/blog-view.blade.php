<x-layout :title="$blog->title" :meta_title="$blog->meta_title" :meta_desc='$blog->meta_desc'>
    <!-- breadcumb Section-->
    <div class="breadcumb-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12 text-center">
                    <div class="breadcumb-content">
                        <div class="breadcumb-title">
                            <h4>Blog Details</h4>
                        </div>
                        <ul>
                            <li><a href="index.html">loginet</a></li>
                            <li>Blog Details</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--breadcumb Section-->


    <!-- blog list area -->
    <div class="blog-details-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="blog-details-thumb">
                                <img src="{{ $blog->img }}" alt="details thumb">
                            </div>
                            <div class="blog-details-content">
                                <div class="meta-blog">
                                    <span class="mate-text">By <a href="{{ url('/author-profile') }}">Author</a></span>
                                    <span><i
                                            class="fa-regular fa-calendar-days"></i>{{ $blog->published_at?->format('d M, Y') }}</span>
                                    <span><img src="{{ asset('frontend/images/inner-image/category-icon.png') }}"
                                            alt="icon"><a
                                            href="{{ url("category/{$blog->category->slug}") }}">{{ $blog->category->title }}</a></span>
                                </div>
                                <h4 class="blog-details-title">{{ $blog->title }}</h4>



                                <div class="blog-details-desc">
                                    {!! html_entity_decode($blog->description) !!}
                                </div>
                            </div>
                            <div class="blog-details-socila-box">
                                <div class="row align-items-center">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="d-flex align-items-center">
                                            <p class="mb-0"><strong class="fw-bold">Share:</strong></p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="blog-details-social-icon">
                                            @php
                                                $url = urlencode(request()->fullUrl());
                                                $title = urlencode($blog->title ?? ''); // optional
                                            @endphp
                                            <ul>
                                                <li>
                                                    <a href="https://api.whatsapp.com/send?text={{ $title }}%20{{ $url }}"
                                                        target="_blank" rel="noopener noreferrer">
                                                        <i class="fab fa-whatsapp"></i>
                                                    </a>
                                                </li>

                                                <!-- Facebook -->
                                                <li>
                                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ $url }}"
                                                        target="_blank">
                                                        <i class="fab fa-facebook-f ml-0"></i>
                                                    </a>
                                                </li>

                                                <!-- Twitter (X) -->
                                                <li>
                                                    <a href="https://twitter.com/intent/tweet?url={{ $url }}&text={{ $title }}"
                                                        target="_blank">
                                                        <i class="fa-brands fa-x-twitter"></i>
                                                    </a>
                                                </li>

                                                <!-- LinkedIn -->
                                                <li>
                                                    <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ $url }}"
                                                        target="_blank">
                                                        <i class="fab fa-linkedin-in"></i>
                                                    </a>
                                                </li>

                                                <!-- Pinterest -->
                                                <li>
                                                    <a href="https://pinterest.com/pin/create/button/?url={{ $url }}&description={{ $title }}"
                                                        target="_blank">
                                                        <i class="fab fa-pinterest"></i>
                                                    </a>
                                                </li>

                                                <!-- Email -->
                                                <li>
                                                    <a
                                                        href="mailto:?subject={{ $title }}&body={{ $url }}">
                                                        <i class="fas fa-envelope mr-2"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="blog-details-post">
                                <div class="row">
                                    <div class="swiper blog-details-active">
                                        <div class="swiper-wrapper">
                                            @foreach ($related_blogs as $item)
                                                <div class="swiper-slide">
                                                    <div class="col-lg-12">
                                                        <div class="blog-post-box">
                                                            <div class="blog-post-thumb">
                                                                <img src="{{ asset(changeSize(imgUrl($item->img), '150x150')) }}"
                                                                    alt="blog post" width="80">
                                                            </div>
                                                            <div class="blog-post-content">
                                                                <a
                                                                    href="{{ url("blog/$item->slug") }}">{{ $item->title }}</a>
                                                                <p>{{ $item->published_at?->format('M d, Y') }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="loginet-blog-details-arrow-box">
                                            <button class="slider-prev" tabindex="0" aria-label="Previous Slide">
                                                <i class="fa-light fa-angles-left"></i>
                                            </button>
                                            <button class="slider-next" tabindex="0" aria-label="Next Slide">
                                                <i class="fa-light fa-angles-right"></i>
                                            </button>
                                        </div>
                                        <div class="blog-nav-buttons">
                                            <button id="prevBtn">Previous Post</button>
                                            <button id="nextBtn">Next Post</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="single-comment-area">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="blog-details-comment-title">
                                        <h4>‘{{ $blog->comments->count() }}’ Comments</h4>
                                    </div>
                                    @forelse ($blog->comments as $comment)
                                        @php
                                            $words = explode(' ', trim($comment->name));
                                            $initials = '';

                                            foreach ($words as $word) {
                                                $initials .= strtoupper(substr($word, 0, 1));
                                            }

                                            $initials = substr($initials, 0, 2);
                                        @endphp

                                        <div class="blog-details-comment">

                                            <div class="blog-details-comment-thumb initials-avatar">
                                                {{ $initials }}
                                            </div>

                                            <div class="blog-details-comment-content">
                                                <h2>{{ ucfirst($comment->name) }}</h2>
                                                <span>{{ $comment->created_at->format('d M, Y') }}</span>
                                                <p>{{ $comment->message }}</p>
                                            </div>
                                        </div>
                                    @empty
                                    @endforelse
                                </div>
                            </div>
                            <div class="blog-details-contact">
                                <div class="blog-details-contact-title">
                                    <h2>Leave A Comments</h2>
                                </div>
                                <form id="comment-form" method="POST">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="contact-input-box">
                                                <input type="hidden" name="blog_id" value="{{ $blog->id }}">
                                                <input type="text" name="name" data-minlength="3"
                                                    class="form-control" placeholder="Name" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="contact-input-box">
                                                <input type="email" name="email" data-minlength="3"
                                                    class="form-control" placeholder="Email" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="contact-input-box">
                                                <input type="text" name="phone" data-minlength="3"
                                                    class="form-control" placeholder="Phone" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="contact-input-box">
                                                <input type="text" name="address" data-minlength="3"
                                                    class="form-control" placeholder="City" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="contact-input-box">
                                                <textarea name="message" data-minlength="3" class="form-control" placeholder="Message" required></textarea>
                                            </div>
                                        </div>
                                        <div class="col-12 input-group p-0">
                                            <div class="blog-details-submi-button">
                                                <button type="button" id="submit-comment-form">Post Comments</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="widget-sidber">
                                <div class="widget_search">
                                    <form action="#" method="get">
                                        <input type="text" name="s" value=""
                                            placeholder="Search Here" title="Search for:">
                                        <button type="submit" class="icons">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <div class="widget-sidber">
                                <div class="widget-sidber-content">
                                    <h2>Categories</h2>
                                </div>
                                <div class="widget-category">
                                    <ul>
                                        @foreach ($categories as $category)
                                            <li><a href="{{ url("category/$category->slug") }}">
                                                    <img src="{{ asset('frontend/images/inner-image/category-icon.png') }}"
                                                        alt="icon">
                                                    {{ $category->title }}
                                                    <i class="fa-solid fa-arrow-right-long"></i>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="widget-sidber">
                                <div class="widget-sidber-content">
                                    <h2>Popular Post</h2>
                                </div>
                                @foreach ($top_5_blogs as $item)
                                    <div class="sidber-widget-recent-post">
                                        <div class="recent-widget-thumb">
                                            <img src="{{ asset(changeSize(imgUrl($item->img), '150x150')) }}"
                                                alt="img" width="100">
                                        </div>
                                        <div class="recent-widget-content">
                                            <a href="{{ url("blog/$item->slug") }}">{{ $item->title }}</a>
                                            <p> {{ $item->category->title }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="widget-sidber">
                                <div class="widget-sidber-content">
                                    <h2>Tags</h2>
                                </div>
                                <div class="widget-catefories-tags">
                                    @foreach ($blog->tags as $tag)
                                        <a href="{{ url('blogs') }}?tags={{$tag}}">{{ ucfirst($tag) }}</a>
                                    @endforeach


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- blog list area -->

    @push('scripts')
        <script>
            $(document).on('click', '#submit-comment-form', function(e) {
                e.preventDefault();

                let form = $('#comment-form');
                let formData = form.serialize();

                $.ajax({
                    url: "{{ route('comments.store') }}", // change to your route
                    type: "POST",
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.message || 'Comment submitted successfully!'
                        });

                        form[0].reset();
                    },
                    error: function(xhr) {
                        let errors = xhr.responseJSON?.errors;
                        let errorMsg = 'Something went wrong';

                        if (errors) {
                            errorMsg = Object.values(errors).map(e => e[0]).join('\n');
                        }

                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: errorMsg
                        });
                    }
                });
            });
        </script>
    @endpush
</x-layout>
