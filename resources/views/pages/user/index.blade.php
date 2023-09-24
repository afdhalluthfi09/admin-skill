<x-ladmin>
    @push('vite')
        @vite(['resources/js/user.js'])
    @endpush
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class=" text-gray-900 px-5 py-5">
                    <table id="table-user" class="table-responsive table-border"></table>
                </div>
            </div>
        </div>
    </div>
    <x-modals.modal type='modal-lg' judul='Buat Kategori' class="modal-md">
        <div id="modal-content-add"></div>
        <button type="button" class="btn btn-default btn-cancel" data-dismiss="modal">Batal</button>
    </x-modals.modal>
</x-ladmin>
