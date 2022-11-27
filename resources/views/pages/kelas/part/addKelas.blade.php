<form action="{{ route('kelas.addKelas') }}" method="post" enctype='multipart/form-data' >
    @csrf
    <div class="modal-body">
        <section class="content">
            <div class="container-fluid">
                <div class="card card-default">
                    <div class="card-header">
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
                        {{-- nama kelas,event,pengisi kelas,tanggal kelas,status,harga,gambar,deskirpsi --}}
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control" id="min" name="name" placeholder="ex: kelas" required>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Event</label>
                            <select id="addStatus" class="form-control select2" name="status" style="width: 100%;" required>
                                <option selected="selected">Pilih Status</option>
                                <option>{{$status}}</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Pengisi Kelas</label>
                            <input type="text" class="form-control" id="guru" name="guru" placeholder="ex: nama pengisi kelas" required>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Tanggal Kelas</label>
                            <input type="date" class="form-control" id="jadwal" name="jadwal" placeholder="ex: tanggal" required>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Harga</label>
                            <input type="text" class="form-control" id="harga" name="harga" placeholder="ex: harga" required>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Poster</label>
                            <input type="file" class="form-control" id="gambar" name="gambar" placeholder="ex: gambar" required>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>IDHASH</label>
                            <input type="text" class="form-control" id="idhash" name="idhash" placeholder="ex: id list youtube" required>
                          </div>
                        </div>
                      </div>
                      <div class="row mt-2">
                        <div class="col-md-12">
                          <label>Deskirpsi</label>
                          <textarea name="description" id="description" cols="55" rows="10"></textarea>
                        </div>
                      </div>
                    </div>
                  </div>
            </div>
        </section>
    </div>
    <div class="modal-footer justify-content-between">
      <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
      <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>