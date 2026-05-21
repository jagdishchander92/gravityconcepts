<x-app>

    {{-- <div class="card card-shadow">
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="mb-6 d-flex justify-content-between">
                        <h1 class="fs-3 mb-1">Manage SEO</h1>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="row">
        <x-alert/>
        <div class="col-md-4">
            <div class="card mt-3">
                <div class="card-header">
                    <h4 class="card-heading">
                        Blog Listing
                    </h4>
                </div>
                <form action="{{ route('seo.store-blogs-seo') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label for="" class="form-label">Slug</label>
                                    <input type="text" value="/blogs" readonly class="form-control">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="" class="form-label">Title</label>
                                    <input type="text" placeholder="Title" name="title" class="form-control"
                                        value="{{ $blogs_listing['title'] ?? '' }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="" class="form-label">Meta Title</label>
                                    <input type="text" placeholder="Meta Title" name="meta_title"
                                        class="form-control" value="{{ $blogs_listing['meta_title'] ?? '' }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="" class="form-label">Meta Description</label>
                                    <textarea type="text" placeholder="Meta Description" rows="4" name="meta_desc" class="form-control">{{ $blogs_listing['meta_desc'] ?? '' }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-success">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mt-3">
                <div class="card-header">
                    <h4 class="card-heading">
                        Contact us
                    </h4>
                </div>
                <form action="{{ route('seo.store-contact-us-seo') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label for="" class="form-label">Slug</label>
                                    <input type="text" value="/contact-us" readonly class="form-control">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="" class="form-label">Title</label>
                                    <input type="text" placeholder="Title" name="title"
                                        value="{{ $contact_us['title'] ?? '' }}" class="form-control">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="" class="form-label">Meta Title</label>
                                    <input type="text" placeholder="Meta Title" name="meta_title"
                                        class="form-control" value="{{ $contact_us['meta_title'] ?? '' }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="" class="form-label">Meta Description</label>
                                    <textarea type="text" placeholder="Meta Description" rows="4" name="meta_desc" class="form-control">{{ $contact_us['meta_desc'] ?? '' }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-success">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mt-3">
                <div class="card-header">
                    <h4 class="card-heading">
                        Google Analytics
                    </h4>
                </div>
                <form action="{{ route('seo.store-analytics') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label for="" class="form-label">Header Codes</label>
                                    <textarea type="text" placeholder="Header Codes" rows="6" name="header_codes" class="form-control">{{ $google_analytics['header_codes'] ?? '' }}</textarea>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="" class="form-label">Footer Codes</label>
                                    <textarea type="text" placeholder="Footer Codes" rows="7" name="footer_codes" class="form-control">{{ $google_analytics['footer_codes'] ?? '' }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-success">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-app>
