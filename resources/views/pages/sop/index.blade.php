<x-dashboard-layout page='null'>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="d-flex ml-2 mr-2 mt-2">
                        <h1 class="h3 mb-4 text-gray-800">Sop</h1>
                        <button type="button" class="button ml-auto btn-add" data-toggle="modal">
                          {{__('Buat Sop Baru')}}
                        </button>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Action</th>
                                <th>No</th>
                                <th>Type</th>
                                <th>Deskripsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ( $sop as $key => $value )
                                <tr>
                                    <td>
                                        <a role="button" data-id="{{$value->id}}"
                                                        data-description="{{$value->description}}"
                                                        data-type="{{$value->type}}"
                                                        data-toggle="modal"
                                                        class="btn btn-primary btn-sm btn-edit">Edit</a>
                                                        <a role="button" data-toggle="modal" data-type="{{$value->type}}" data-description="{{$value->description}}"  class="btn btn-success btn-sm btn-detail">Detail</a>
                                                        <a role="button" data-toggle="modal" data-id="{{$value->id}}" class="btn btn-danger btn-sm btn-hapus">Delete</a>
                                    </td>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $value->type }}</td>
                                    <td><input type="hidden" name=""></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <x-modals.modal type='modal-sop' judul='Buat Sop' class="modal-md">
        @include('pages.sop.part.add')
    </x-modals.modal>
    <x-modals.modal type='modal-sop-edit' judul='Edit Sop' class="modal-md">
        @include('pages.sop.part.edit')
    </x-modals.modal>
    <x-modals.modal type='modal-sop-delete' judul='Hapus Sop' class="modal-md">
        @include('pages.sop.part.delete')
    </x-modals.modal>
    <x-modals.modal type='modal-sop-detail' judul='Detail Sop' class="modal-md">
        @include('pages.sop.part.detail')
    </x-modals.modal>
    {{-- @include('sweetalert::alert') --}}
    @push('scripts')
        <script>
            $(document).ready(function() {

                $('.btn-add').on('click', function() {
                    $('#modal-sop').modal('show');
                    $('#summernote').summernote({
                        placeholder: 'Hello stand alone ui',
                        tabsize: 2,
                        height: 100
                    });
                });

                $('.btn-edit').on('click', function() {
                    $('#modal-sop-edit').modal('show');
                    $('#summernoteEdit').val($(this).data('description'));
                    $('#EditShop #editType').val($(this).data('type'));
                    $('#summernoteEdit').summernote({
                        placeholder: 'Hello stand alone ui',
                        tabsize: 2,
                        height: 100
                    });
                    $('<input>').attr({
                        type: 'hidden',
                        id: 'idmapelo',
                        name: 'id',
                        value: $(this).data('id'),
                        readonly: true
                    }).appendTo('#EditShop');
                });

                $('.btn-hapus').on('click', function() {
                    $('#modal-sop-delete').modal('show');
                    $('<input>').attr({
                        type: 'hidden',
                        id: 'idmapelo',
                        name: 'id',
                        value: $(this).data('id'),
                        readonly: true
                    }).appendTo('#DeleteShop');
                });

                $('.btn-detail').on('click', function() {
                    $('#modal-sop-detail').modal('show');
                    $('div')
                        .html($(this).data('description'))
                        .appendTo('#detailSop');
                });

            });
        </script>
    @endpush
</x-dashboard-layout>
