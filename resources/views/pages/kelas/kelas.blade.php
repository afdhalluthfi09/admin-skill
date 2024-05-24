<x-ladmin>
    @push('vite')
        @vite(['resources/js/kelas.js'])
    @endpush
    {{-- @dump($kelas) --}}
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
          <div class="d-flex ml-2 mr-2 mt-2">
            <h1 class="h3 mb-4 text-gray-800">Kelas</h1>
            <button id="modalAdd" type="button" class="button ml-auto btn-add" data-toggle="modal" data-id="{{$kategori['data']['id']}}"
              data-target="#modal-lg">
              Tambah Kelas
            </button>
          </div>
          <div id="renderKelas" class="row mt-2 container">
              @dump($kelas)
            @forelse ($kelas as $item)
                <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-success">
                    <div class="inner">
                    <div class="text-left dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                        <span>options</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <a role="button" class="dropdown-item dropdown-header btn-edit" data-toggle="modal"
                                            data-id="{{$item['kelas_id']}}" data-slug="{{$item['slug']}}" >Edit</a>
                            <div class="dropdown-divider"></div>
                            <a role="button" class="dropdown-item dropdown-header btn-delete" data-toggle="modal" data-id="{{$item['kelas_id']}}" data-category="{{$item['categorise']['name']}}" >Hapus</a>
                            <div class="dropdown-divider"></div>
                            {{-- <a role="button" class="dropdown-item dropdown-header" href="{{ route('kelas.show', ['id'=>$item->id,'slug'=>$item->idhash]) }}">lihat</a> --}}
                        </div>
                    </div>
                    <h5>{{$item['kelas']}}</h5>
                    <p>Rp.{{$item['harga']}}</p>
                    </div>
                    <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="{{ route('kelas.listkelas',['idhash'=>$item['youtube_id']]) }}" class="small-box-footer">
                    Lihat Detail <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
                </div>
            @empty
                <div class="col-lg-3 col-6">
                    <div class="d-flex justify-center flex-row"><h3>Belum Di Tambkan</h3></div>
                </div>
            @endforelse
          </div>
        </div>
      </div>
    </div>
</div>

<x-modals.modal type='modal-add' judul='Buat Kelas' class="modal-lg">
    <div id="modal-content-add"></div>
    <button type="button" class="btn btn-default btn-cancel" data-dismiss="modal">Batal</button>
  </x-modals.modal>
<x-modals.modal type='modal-edit' judul='Edit Kelas' class="modal-lg">
    <div id="modal-content"></div>
    <button type="button" class="btn btn-default btn-cancel" data-dismiss="modal">Batal</button>
  </x-modals.modal>
<x-modals.modal type='modal-hapus' judul='Buat Kelas' class="modal-sm">
    @include('pages.kelas.part.delete')
</x-modals.modal>
  @push('script')
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="{{ asset('summernote/summernote-bs4.js') }}"></script>
  @endpush
</x-ladmin>
