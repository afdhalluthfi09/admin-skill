<x-dashboard-layout>
    <div class="py-12">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                {{ $dataTable->table() }}
            </div>
        </div>
    </div>
    <x-modals.modal type='modal-pembelian-edit' judul='Ubah Status' class="modal-md">
        @include('pages.Pembelian.part.edit')
    </x-modals.modal>
    @push('scripts')
        {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
        <script>
            $('document').ready(function(){
                $('.table').on('click','.btn-edit',function(e){
                    // $('#modal-pembelian-edit').modal('show');
                    $('<input>').attr({
                        type: 'hidden',
                        id: 'idmapelo',
                        name: 'id',
                        value: $(this).data('id'),
                        readonly: true
                    }).appendTo('#formPembelian');
                    $('<input>').attr({
                        type: 'hidden',
                        id: 'email',
                        name: 'email',
                        value: $(this).data('email'),
                        readonly: true
                    }).appendTo('#formPembelian');
                })
            })
        </script>
    @endpush
</x-dashboard-layout>
