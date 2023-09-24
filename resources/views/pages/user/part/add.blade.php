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
                    {{-- nama dan email --}}
                  <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="isi nama lengkap" />
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="isi nama lengkap" />
                        </div>
                    </div>
                  </div>
                  {{-- password --}}
                  <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="pasword" />
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="repassword" class="form-label">Ulangi Password</label>
                            <input type="password" name="repassword" id="repassword" class="form-control" placeholder="Ulangi Password" />
                        </div>
                    </div>
                  </div>
                  {{-- no_hp --}}
                  <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="no_hp" class="form-label">No Hp Aktif</label>
                            <input type="text" class="form-control" name="no_hp" placeholder="isi no aktif">
                        </div>
                    </div>
                  </div>
                  {{-- alamat --}}
                  <div class="row">
                    <div class="col-sm-12">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea name="alamat" id="alamat" cols="30" rows="10" class="form-control"></textarea>
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
