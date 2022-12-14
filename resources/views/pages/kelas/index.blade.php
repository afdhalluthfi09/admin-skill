<x-dashboard-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="d-flex ml-2 mr-2 mt-2">
                        <h1 class="h3 mb-4 text-gray-800">Kelas</h1>
                        <button type="button" class="button ml-auto" data-toggle="modal" data-target="#modal-lg">
                          Tambah Kategori
                        </button>
                    </div>
                    <div id="cardCategory" class="row mt-2 ml-2">
                      {{-- @dd($kategori->whereIn('status', ['Kelas','Events'])) --}}
                        @foreach ($kategori->whereIn('status', ['Kelas','Events']) as $item) 
                          <div class="col-md-4">
                              <div  class="card card-widget widget-user">
                                <!-- Add the bg color to the header using any of the bg-* classes -->
                                <div class="widget-user-header text-white"
                                    style="background: url('../dist/img/photo1.png') center center;">
                                  <div class="text-right dropdown">
                                    <a class="nav-link" data-toggle="dropdown" href="#">
                                      <span>...</span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                        <a role="button" class="dropdown-item dropdown-header btn-edit" 
                                                         data-toggle="modal" data-name="{{$item->name}}" 
                                                         data-status="{{$item->status}}" 
                                                         data-id="{{$item->id}}" 
                                                         data-target="#modal-edit-category">Edit</a>
                                        <div class="dropdown-divider"></div>
                                        <a role="button" class="dropdown-item dropdown-header btn-delete" data-toggle="modal" data-id="{{$item->id}}" >Hapus</a>
                                        <div class="dropdown-divider"></div>
                                        <a role="button" class="dropdown-item dropdown-header" href="{{ route('kelas.show', ['id'=>$item->id,'slug'=>$item->slug]) }}">Lihat</a>
                                    </div>
                                  </div>
                                  <h3 class="widget-user-username text-right">Sekolah Skill</h3>
                                  <h5 class="widget-user-desc text-right">{{$item->name}}</h5>
                                </div>
                                <div class="widget-user-image">
                                  <img class="img-circle" src="{{ asset('dist/img/logo_pbs.png') }}" alt="sekolahskill.com">
                                </div>
                                <div class="card-footer">
                                  <div class="row">
                                    <div class="col-sm-4 border-right">
                                      <div class="description-block">
                                        <h5 class="description-header">3,200</h5>
                                        @if ($item->status == 'Kelas')
                                          <span class="description-text">Kelas</span>
                                        @elseif ($item->status == 'Events')
                                          <span class="description-text">Events</span>
                                        @endif
                                      </div>
                                    </div>
                                    <div class="col-sm-4 border-right">
                                      <div class="description-block">
                                        <h5 class="description-header">13,000</h5>
                                        <span class="description-text">Total Peserta</span>
                                      </div>
                                    </div>
                                    <div class="col-sm-4">
                                      <div class="description-block">
                                        <h5 class="description-header">35</h5>
                                        <span class="description-text">PRODUCTS</span>
                                      </div>
                                      <!-- /.description-block -->
                                    </div>
                                    <!-- /.col -->
                                  </div>
                                  <!-- /.row -->
                                </div>
                              </div>
                          </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-modals.modal type='modal-lg' judul='Buat Kategori' class="modal-md">
      @include('pages.kelas.part.add')
    </x-modals.modal>
    <x-modals.modal type='modal-edit-category' judul='Buat Kategori' class="modal-md">
      @include('pages.kelas.part.edit')
    </x-modals.modal>
    <x-modals.modal type='modal-delete-category' judul='Buat Kategori' class="modal-md">
      @include('pages.kelas.part.delete')
    </x-modals.modal>
    @push('scripts')
      <script>
        $(document).ready(function(){
          $('.btn-edit').click(function(){
            // console.log('hellos');
            // $('#modal-edit-category').modal('show');
            $('#editName').val($(this).data('name'));
            $('#Editstatus').val($(this).data('status'));
            $('<input>').attr({
                    type: 'hidden',
                    id: 'idmapelo',
                    name: 'id',
                    value: $(this).data('id'),
                    readonly: true
              }).appendTo('form');
            // console.log($('#Editstatus').val($(this).data('status')));
          })
          $('.btn-delete').click(function(){
            $('#modal-delete-category').modal('show');
            $('<input>').attr({
                    type: 'hidden',
                    id: 'idmapelo',
                    name: 'id',
                    value: $(this).data('id'),
                    readonly: true
              }).appendTo('form');
            // console.log($('#Editstatus').val($(this).data('status')));
          })
        })
      </script>
    @endpush
</x-dashboard-layout>