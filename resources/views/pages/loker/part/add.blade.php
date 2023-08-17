<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header">
                    <h4>Gambar/Logo Perusahaan</h4>
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
                    <div class="form-group">
                        <label class ="form-label" for="img_hero" >Gamabr Panel</label>
                        <input class="form-control" type="file" name="img_hero" id="img_hero" />
                    </div>
                    <div class="form-group">
                        <label  class ="form-label" for="img_thumb" >Logo</label>
                        <input  class="form-control" type="file" name="img_thumb" id="img_thumb" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header">
                    <h4>Kategori</h4>
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
                    <div class="form-group">
                        <label class ="form-label" for="img_hero" >Waktu Kerja</label>
                        <select class="form-control" name="kategori_kerja_id" id="">
                            @if ($kerjaan->isEmpty())
                            <option>{{__('Belum Di Input')}}</option>
                        @else
                            @foreach ($kerjaan as $item)
                                <option>{{$item->name}}</option>
                            @endforeach
                        @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label  class ="form-label" for="img_thumb" >Jenis Perusahaan</label>
                        <select class="form-control" name="kategori_perusahaan_id" id="">
                            <option>Pilih</option>
                            @if ($perusahaan->isEmpty())
                                    <option>{{__('Belum Di Input')}}</option>
                                @else
                                    @foreach ($perusahaan as $item)
                                        <option>{{$item->name}}</option>
                                    @endforeach
                                @endif
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header">
                    <h4>Detail</h4>
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
                <div class="card-body"></div>
            </div>
        </div>
    </div>
</div>
