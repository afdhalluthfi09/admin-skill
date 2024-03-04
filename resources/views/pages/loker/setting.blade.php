<x-dashboard-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">
                        <h4>Kerjaan</h4>
                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                          <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                          <i class="fas fa-times"></i>
                        </button>
                      </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-8">
                          <div class="form-group">
                            <input type="text" class="form-control" id="inpKerjaan"  placeholder="ex: buat kategori kerjaan" required>
                          </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-md-4">
                          <div class="form-group">
                            <button id='addKerjaan' class="btn btn-success">Buat</button>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <td></td>
                                    <th>Nama</th>
                                </tr>
                            </thead>
                            <tbody id="katkerjaan">
                                {{-- @dump($kerjaan) --}}
                                @if ($kerjaan->isEmpty())
                                    <tr>
                                        <td>{{__('Belum Di Input')}}</td>
                                    </tr>
                                @else
                                    @foreach ($kerjaan as $item)
                                        <tr>
                                            <td>
                                                <button data-toggle="modal" data-id="{{$item->id}}" data-kerjaan="{{$item->name}}" data-target="#modal-edit-kerjaan" class="btn btn-primary btn-edit">Edit</button>
                                                <button data-toggle="modal" data-id="{{$item->id}}" data-target="#modal-hapus-kerjaan" class="btn btn-danger btn-hapus">Hapus</button>
                                            </td>
                                            <td>{{$item->name}}</td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                      </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">
                        <h4>Perushaan</h4>
                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                          <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                          <i class="fas fa-times"></i>
                        </button>
                      </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                          <div class="col-md-8">
                            <div class="form-group">
                              <input type="text" class="form-control" id="min" name="name" placeholder="ex: buat kategori kerjaan" required>
                            </div>
                          </div>
                          <!-- /.col -->
                          <div class="col-md-4">
                            <div class="form-group">
                              <button class="btn btn-success">Buat</button>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <table class="table table-bordered">
                              <thead>
                                  <tr>
                                      <td></td>
                                      <th>Nama</th>
                                  </tr>
                              </thead>
                              <tbody id="perusahaan">
                                {{-- @dump($perusahaan) --}}
                                @if ($perusahaan->isEmpty())
                                    <tr>
                                        <td>{{__('Belum Di Input')}}</td>
                                    </tr>
                                @else
                                    @foreach ($perusahaan as $item)
                                        <tr>
                                            <td>
                                                <button  class="btn btn-primary btn-edit">Edit</button>
                                                <button  class="btn btn-danger btn-hapus">Hapus</button>
                                            </td>
                                            <td>{{$item->name}}</td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                          </table>
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </div>
    <x-modals.modal type='modal-edit-kerjaan' judul='Edit Kerjaan' class="modal-lg">
        @include('pages.loker.part.edit')
    </x-modals.modal>
    <x-modals.modal type='modal-hapus-kerjaan' judul='Hapus Kerjaan' class="modal-lg">
        @include('pages.loker.part.hapus')
    </x-modals.modal>
    @push('scripts')
        <script>
            $('document').ready(function(){
                $('#addKerjaan').click(function(e){
                    e.preventDefault();
                    let name =$('#inpKerjaan').val();
                    $.ajax({
                        url:'{!! route('loker.addkerjaan') !!}',
                        method:'POST',
                        data:{
                            name:name,
                            _token:'{{csrf_token()}}'
                        },
                        success:function(data){ $('#katkerjaan').append(data);}
                    })
                })

                $('.btn-edit').click(function(e){
                    e.preventDefault();


                    console.log($(this).data('kerjaan'));

                    $('#ideditkerjaan').val($(this).data('id'));
                    $('#inpEditKerjaan').val($(this).data('kerjaan'));


                })
                $('.btn-hapus').click(function(e){
                    console.log('hhhe');
                    let id =$(this).data('id');
                    $('#idehapuskerjaan').val(id);

                })
            })
        </script>
    @endpush
</x-dashboard-layout>
