<x-app>
    <div class="container-fluid">
        <div class="card card-shadow mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h3 class="fs-3">Manage Cards</h3>
                    </div>
                    <div>
                        <a href="{{ route('cards.index') }}">
                            <button class="btn btn-primary">
                                <i class="ti ti-list"></i>
                                Cards
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-shadow">
            <x-alert />
            <div class="card-body">
                <form action="{{ $card ? route('cards.update', $card->id) : route('cards.store') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="card_title" class="form-label">Card Title</label>
                                <input type="text" name="card_title" id="card_title" class="form-control"
                                    placeholder="Card Title" value="{{ old('card_title', $card->title ?? '') }}">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="sub_title" class="form-label">Sub Title</label>
                                <input type="text" name="sub_title" id="sub_title" class="form-control"
                                    placeholder="Sub Title" value="{{ old('sub_title', $card->sub_title ?? '') }}">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="card_type" class="form-label">Card Type</label>
                                <select name="card_type" id="card_type" class="form-select">
                                    <option value="">Select Card Type</option>
                                    <option value="service_card"
                                        {{ old('card_type', $card->card_type ?? '') == 'service_card' ? 'selected' : '' }}>
                                        Service Card
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="card_img" class="form-label">Card Image</label>
                                <input type="file" name="card_img" id="card_img" class="form-control">
                                @if (!empty($card?->card_img))
                                    <img src="{{ asset($card->card_img) }}" width="80" class="mt-2">
                                @endif
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="card_icon" class="form-label">Card Icon</label>
                                <input type="file" name="card_icon" id="card_icon" class="form-control">
                                @if (!empty($card?->card_icon))
                                    <img src="{{ asset($card->card_icon) }}" width="80" class="mt-2">
                                @endif
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="btn_title" class="form-label">Btn Title</label>
                                <input type="text" name="btn_title" id="btn_title" class="form-control"
                                    placeholder="Btn Title" value="{{ old('btn_title', $card->btn_title ?? '') }}">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="btn_url" class="form-label">Btn URL</label>
                                <input type="text" name="btn_url" id="btn_url" class="form-control"
                                    placeholder="Btn URL" value="{{ old('btn_url', $card->btn_url ?? '') }}">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="d-flex align-items-end h-100">
                                <button class="btn btn-primary mb-3">
                                    {{ $card ? 'Update' : 'Save' }}
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app>
