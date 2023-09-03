<form id="categoryFormEdit" method="post">
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
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control" id="editName" name="name" placeholder="ex: kelas" required>
                          </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Status</label>
                            <select class="form-control select2" id="Editstatus" name="status" style="width: 100%;" required>
                                <option selected="selected">Pilih Status</option>
                                <option>Kelas</option>
                                <option>Events</option>
                            </select>
                          </div>
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
