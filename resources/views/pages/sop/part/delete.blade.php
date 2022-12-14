<form action="{{ route('sop.delete') }}" id="DeleteShop" method="POST">
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
                        <div class="col-md-12">
                          Yakin Menghapus Data Ini?
                        </div>
                      </div>
                    </div>
                  </div>
            </div>
        </section>
    </div>
    <div class="modal-footer justify-content-between">
      <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
      <button type="submit" class="btn btn-primary">Hapus</button>
    </div>
</form>
