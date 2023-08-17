<x-dashboard-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ $dataTable->table() }}
                </div>
            </div>
        </div>
    </div>
    <x-modals.modal type='modal-lg' judul='Buat Kategori' class="modal-md">
        @include('pages.user.part.add')
      </x-modals.modal>
    @push('scripts')
        {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    @endpush
</x-dashboard-layout>                