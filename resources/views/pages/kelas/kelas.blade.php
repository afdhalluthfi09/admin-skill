<x-dashboard-layout>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
          <div class="d-flex ml-2 mr-2 mt-2">
            <h1 class="h3 mb-4 text-gray-800">Kelas</h1>
            <button type="button" class="button ml-auto btn-add" data-toggle="modal" data-id="{{$kategori_id}}"
              data-target="#modal-lg">
              Tambah Kelas
            </button>
          </div>
          <div class="row mt-2">
            @foreach ( $kelas->whereIn('categorise_id', $kategori_id) as $item)
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
                                           data-name="{{$item->name}}"
                                           data-status="{{$item->status}}"
                                           data-id="{{$item->id}}"
                                           data-gambar="{{$item->gambar}}"
                                           data-idhash="{{$item->idhash}}"
                                           data-jadwal="{{$item->jadwal}}"
                                           data-guru="{{$item->guru}}"
                                           data-description="{{$item->description}}"
                                           data-harga="{{$item->harga}}">Edit</a>
                          <div class="dropdown-divider"></div>
                          <a role="button" class="dropdown-item dropdown-header btn-delete" data-toggle="modal" data-id="{{$item->id}}" >Hapus</a>
                          <div class="dropdown-divider"></div>
                          <a role="button" class="dropdown-item dropdown-header" href="{{ route('kelas.show', ['id'=>$item->id,'slug'=>$item->slug]) }}">Lihat</a>
                      </div>
                    </div>
                    <h5>{{$item->name}}</h5>
                    <p>Rp.{{$item->harga}}</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                  </div>
                  <a href="#" class="small-box-footer">
                    Lihat Detail <i class="fas fa-arrow-circle-right"></i>
                  </a>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
  <x-modals.modal type='modal-lg' judul='Buat Kelas' class="modal-md">
    @include('pages.kelas.part.addKelas',['status' => $slug])
  </x-modals.modal>
  <x-modals.modal type='modal-edit-kelas' judul='Edit Kelas' class="modal-md">
    @include('pages.kelas.part.editKelas',['status' => $slug])
  </x-modals.modal>
  @push('scripts')
  <script>
    $(document).ready(function(){
          $('.btn-add').click(function(){
            $('<input>').attr({
                    type: 'hidden',
                    id: 'idmapelo',
                    name: 'categorise_id',
                    value: $(this).data('id'),
                    readonly: true
              }).appendTo('form');
            // console.log($('#Editstatus').val($(this).data('status')));
          })
          $('.btn-edit').click(function(){
            $('#modal-edit-kelas').modal('show');
            $('#editName').val($(this).data('name'));
            $('#editStatus').val($(this).data('status'));
            $('#editGuru').val($(this).data('guru'));
            $('#editJadwal').val($(this).data('jadwal'));
            $('#editHarga').val($(this).data('harga'));
            $('#editGambar').val($(this).data('gambar'));
            $('#editIdhash').val($(this).data('idhash'));
            $('#editDescription').val($(this).data('description'));
            $('<input>').attr({
                    type: 'hidden',
                    id: 'idmapelo',
                    name: 'categorise_id',
                    value: $(this).data('id'),
                    readonly: true
              }).appendTo('form');
            // console.log($('#Editstatus').val($(this).data('status')));
          })
        })
  </script>
  @endpush
</x-dashboard-layout>