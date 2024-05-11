<form action="{{ route('kelas.deletKelas') }}" method="post" enctype='multipart/form-data' >
    @csrf
    <div class="modal-body">
        {{-- kelas --}}
        <section class="content">
            <div class="container-fluid">
                <div class="card card-default">
                    <div class="card-header">
                        <h5></h5>
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
                        <h5>Yakin Mau Menghapus Kelas Ini?</h5>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Hapus ?</button>
      </div>
</form>
