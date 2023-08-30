<x-ladmin>
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
          <div class="row">
            <div class="col-md-12">

                {{-- @dump($test["profil"]["name"]) --}}
                {{-- @foreach ($test->whereIn('categorise_id', $kategori_id) as $item)
                    {{$item['pemateri']}}
                @endforeach --}}
            </div>
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
                                           data-slug="{{$item['slug']}}"
                                           data-id ="{{$item['id']}}">Edit</a>
                          <div class="dropdown-divider"></div>
                          <a role="button" class="dropdown-item dropdown-header btn-delete" data-toggle="modal" data-id="{{$item['id']}}" >Hapus</a>
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
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
  <x-modals.modal type='modal-lg' judul='Buat Kelas' class="modal-lg">
    @include('pages.kelas.part.addKelas',['status' => $slug])
  </x-modals.modal>
  <x-modals.modal type='modal-edit-kelas' judul='Edit Kelas' class="modal-lg">
    @include('pages.kelas.part.editKelas',['status' => $slug])
  </x-modals.modal>
  <x-modals.modal type='modal-hapus-kelas' judul='Hapus Kelas' class="modal-lg">
    @include('pages.kelas.part.hapusKelas',['status' => $slug])
  </x-modals.modal>
  @include('sweetalert::alert')
  @push('scripts')
  <script>
    $(document).ready(function(){
        let inputGuru =document.getElementById('guru');
        let inputNameProfile =document.getElementById('namaPemateri');
          $('.btn-add').click(function(){
                $('#summernote').summernote({
                            placeholder: 'Isi Disnini',
                            tabsize: 2,
                            focus: true,
                            // airMode: true,
                            height: 100
                });
                $('#summernoteProfile').summernote({
                            placeholder: 'Isi Disnini',
                            tabsize: 2,
                            focus: true,
                            // airMode: true,
                            height: 100
                });
                $('<input>').attr({
                        type: 'hidden',
                        id: 'idmapelo',
                        name: 'categorise_id',
                        value: $(this).data('id'),
                        readonly: true
                }).appendTo('form');

                let addButton=$('.add');
                let maxCount =10;
                let x =1;
                let wrapper =$('.wrapper');
                let fieldHtml=`
                    <div class="d-flex justify-content-between gap-1 mt-2">
                            <input name="kurikulum[]" id="" type="text" placeholder="Name" class="required-entry form-control">
                            <a class="btn btn-danger remove" href="javascript:void()0" >Remove</a>
                    </div>
                `;
                $(addButton).click(function(e){
                    e.preventDefault();
                    console.log('hellos');
                    if(x < maxCount){
                        x++;
                        // console.log(wrapper);
                        $(wrapper).append(fieldHtml)
                    }
                });
                $(wrapper).on('click','.remove',function(e){
                    e.preventDefault()
                    $(this).parent('div').remove();
                    x--;
                })
                inputGuru.addEventListener('input',()=>{
                    inputNameProfile.value =inputGuru.value
                })
            // console.log($('#Editstatus').val($(this).data('status')));
          })
          $('.btn-edit').click(function(e){
                e.preventDefault()

                $('#modal-edit-kelas').modal('show');
                // console.log($('#formEdit'));
                let slug=$(this).data('slug');
                let id=$(this).data('id');
                console.log(slug);
                $.ajax({
                            type:'POST',
                            url:'{!! route('kelas.edit') !!}',
                            // data:'slug='+slug+'&_token={{csrf_token()}}',
                            data:{
                                slug:slug,
                                id:id,
                                _token:'{{csrf_token()}}'
                            },
                            success:function(data){
                            $('#formEdit').append(data)
                            //    console.log('kamu dulu');
                            $('#summernoteEdit').summernote({
                                            placeholder: 'Isi Disnini',
                                            tabsize: 2,
                                            focus: true,
                                            // airMode: true,
                                            height: 100
                                });
                                $('#summernoteProfileEdit').summernote({
                                            placeholder: 'Isi Disnini',
                                            tabsize: 2,
                                            focus: true,
                                            // airMode: true,
                                            height: 100
                                });
                                let addButton=$('.add');
                                let maxCount =10;
                                let x =1;
                                let wrapper =$('.wrapper');
                                let fieldHtml=`
                                    <div class="d-flex justify-content-between gap-1 mt-2">
                                        <input name="kurikulum[]" id="" type="text" placeholder="Name" class="required-entry form-control">
                                        <a class="btn btn-danger remove" href="javascript:void(0)" >Remove</a>
                                    </div>
                                `;
                                $(addButton).click(function(e){
                                    e.preventDefault();
                                    // console.log('hellos');
                                    if(x < maxCount){
                                        x++;
                                        // console.log(wrapper);
                                        $(wrapper).append(fieldHtml)
                                    }
                                });
                                $(wrapper).on('click','.remove',function(e){
                                    e.preventDefault()
                                    $(this).parent('div').remove();
                                    x--;
                                })

                                $('.btn-upload-image').on('click',function(e){
                                    console.log($('#editGambar'));
                                    $('#editGambar').toggleClass('d-none');
                                    $('#inputGambar').toggleClass('d-none');
                                })
                                $('.btn-upload-profil').on('click',function(e){
                                    // console.log($('#editGambar'));
                                    $('#editPhoto').toggleClass('d-none');
                                    $('#inputPhoto').toggleClass('d-none');
                                })
                                $('.close').on('click',function(){
                                    // console.log('heloos');
                                    $('#modalBody').remove();
                                    $('#modalFooter').remove();
                                })
                            },
                            error:function(err){
                                console.log(err)
                            }
                })
          })
          $('.btn-delete').click(function(e){
            e.preventDefault()
            $('#modal-hapus-kelas').modal('show');
            $('<input>').attr({
                        type: 'hidden',
                        id: 'idkelas',
                        name: 'kelas_id',
                        value: $(this).data('id'),
                        readonly: true
                }).appendTo('form');
          })
    })
  </script>
  @endpush
</x-ladmin>
