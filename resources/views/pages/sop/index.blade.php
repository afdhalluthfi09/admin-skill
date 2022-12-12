<x-dashboard-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="d-flex ml-2 mr-2 mt-2">
                        <h1 class="h3 mb-4 text-gray-800">Sop</h1>
                        <button type="button" class="button ml-auto" data-toggle="modal" data-target="#modal-sop">
                          {{__('Buat Sop Baru')}}
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <x-modals.modal type='modal-sop' judul='Buat Sop' class="modal-md">
        @include('pages.sop.part.add')
      </x-modals.modal>
    {{$data}}
    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#summernote').summernote({
                    placeholder: 'Hello stand alone ui',
                    tabsize: 2,
                    height: 100
                });
            });
        </script>
    @endpush
</x-dashboard-layout>