<x-dashboard-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="d-flex ml-2 mr-2 mt-2">
                        <h1 class="h3 mb-4 text-gray-800">Loker</h1>
                        <button type="button" class="button ml-auto" data-toggle="modal" data-target="#modal-lg">
                          Buat Loker
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-modals.modal type='modal-lg' judul='Buat Loker' class="modal-lg">
        @include('pages.loker.part.add', ['kerjaan' => $kerjaan,'perusahaan'=>$perusahaan ])
    </x-modals.modal>
</x-dashboard-layout>
