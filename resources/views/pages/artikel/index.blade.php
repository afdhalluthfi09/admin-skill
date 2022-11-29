<x-dashboard-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
              {{-- @dump($artikel) --}}
                <div class="d-flex ml-2 mr-2 mt-2 px-2 py-2">
                    <h1 class="h3 mb-4 text-gray-800">{{__('artikel')}}</h1>
                    <a role="button" href="{{ route('artikel.add') }}" class="button ml-auto">
                      Tambah Artikel
                    </a>
                </div>
                <div class="row mt-2">
                  @foreach ($artikel as $art)
                    <div class="col-md-3">
                      <div class="info-box shadow-sm">
                        <span ></span>
                        <img class="info-box-icon" src="https://images.test/{{$art->gambar}}" alt="">
                        <div class="info-box-content">
                          <span class="info-box-text">{{$art->judul}}</span>
                          <span class="info-box-number">{{$art->kategori}}</span>
                          <div class="d-flex">
                            <a href="{{ route('artikel.edit', ['slug'=>$art->slug]) }}" class="badge text-bg-primary">edit</a>
                            <a role="button"  class="badge text-bg-danger btn-hapus" data-toggle="modal" data-id="{{$art->id}}">hapus</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  @endforeach
                </div>
            </div>
          </div>
        </div>
    </div>
    <x-modals.modal type='modal-lg' judul='Hapus Artikel' class="modal-md">
      @include('pages.artikel.part.deleteKelas')
    </x-modals.modal>

    @push('scripts')
      <script>
        $(document).ready(function(){
          console.log('ready');
          $('.btn-hapus').click(function(){
            $('#modal-lg').modal('show');
            $('<input>').attr({
                      type: 'hidden',
                      id: 'idmapelo',
                      name: 'id',
                      value: $(this).data('id'),
                      readonly: true
                }).appendTo('form');
          })
          })
      </script>
    @endpush
</x-dashboard-layout>