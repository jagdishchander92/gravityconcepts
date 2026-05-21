<x-app>
    <div class="container-fluid">
        <div class="card card-shadow mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h3 class="fs-3">Manage Cards</h3>
                    </div>
                    <div>
                        <a href="{{ route('cards.create') }}">
                            <button class="btn btn-primary">
                                <i class="ti ti-plus"></i>
                                Add Card
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-shadow">
            <x-alert />
            <div class="card-body">
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                                <td>#Id</td>
                                <td>Title</td>
                                <td>Sub Title</td>
                                <td>Card Type</td>
                                <td>Card Img</td>
                                <td>Action</td>
                            </thead>
                            <tbody>
                                @foreach ($cards as $card)
                                    <tr>
                                        <td>
                                            {{ $card->id }}
                                        </td>
                                        <td>
                                            {{ $card->title }}
                                        </td>
                                        <td>
                                            {{ $card->sub_title }}
                                        </td>
                                        <td>
                                            {{ $card->card_type }}
                                        </td>
                                        <td>
                                            {{ $card->card_type }}
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('cards.edit', $card->id) }}"><button
                                                        class="btn btn-sm btn-warning" title="Edit"> <i
                                                            class="ti ti-edit"></i>
                                                    </button></a>
                                                <a href="javascript:void(0);"
                                                    class="btn btn-sm btn-danger btn-delete-card"
                                                    data-url="{{ route('cards.delete', $card->id) }}" title="Delete">
                                                    <i class="ti ti-trash"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            $(document).on('click', '.btn-delete-card', function() {
                let url = $(this).data('url');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "This Card will be deleted permanently!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = url;
                    }
                });
            });
        </script>
    @endpush
</x-app>
