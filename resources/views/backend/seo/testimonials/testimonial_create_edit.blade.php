<x-app>
    <div class="card card-shadow">
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="mb-6 d-flex justify-content-between">
                        <h1 class="fs-3 mb-1">{{ $testimonial->id ? 'Edit' : 'Create' }} Testimonial</h1>
                        <a href="{{ route('admin.testimonials') }}"> <button
                                class="btn btn-sm btn-primary">Testimonials</button></a>
                    </div>
                </div>
            </div>

            <form
                action="{{ $testimonial->id ? route('admin.testimonials.update', $testimonial) : route('admin.testimonials.store') }}"
                method="post" enctype="multipart/form-data">
                @csrf()
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" id="name" class="form-control"
                                value="{{ old('name', $testimonial->name ?? '') }}" placeholder="Name" />
                            @error('name')
                                <span class="text-danger mt-1">{{ $message }}</span>
                            @enderror

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="designation" class="form-label">Designation</label>
                            <input type="text" name="designation" id="designation" class="form-control"
                                value="{{ old('designation', $testimonial->designation ?? '') }}"
                                placeholder="Designation" />
                            @error('designation')
                                <span class="text-danger mt-1">{{ $message }}</span>
                            @enderror

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="img" class="form-label">Image</label>
                            <input type="file" name="img" id="img" class="form-control" />
                            @error('img')
                                <span class="text-danger mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="rating" class="form-label">Rating</label>
                            <input type="number" step="0.01" name="rating" id="rating" class="form-control"
                                value="{{ old('rating', $testimonial->rating ?? '') }}" placeholder="Rating" />
                            @error('rating')
                                <span class="text-danger mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="description" class="form-label">Description</label>
                            <input type="text" name="description" id="description" class="form-control"
                                value="{{ old('description', $testimonial->description ?? '') }}"
                                placeholder="Description" />
                            @error('description')
                                <span class="text-danger mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label class="form-label">Status</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="statusActive"
                                    value="1" {{ $testimonial->status == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="statusActive">Active</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="statusInActive"
                                    value="0" {{ $testimonial->status != 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="statusInActive">Inactive</label>
                            </div>
                            @error('description')
                                <span class="text-danger mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-success">Submit</button>
                    </div>
                </div>
            </form>


        </div>
    </div>

</x-app>
