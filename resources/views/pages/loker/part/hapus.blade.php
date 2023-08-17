<div class="container mt-2 mb-2">
    <form action="{{ route('loker.hapuskerjaan') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-md-8">
              <div class="form-group" id="inputEdit">
                Yakin Hapus Data Ini ?
                <input type="hidden" name="idehapuskerjaan" id="idehapuskerjaan">
              </div>
            </div>
            <!-- /.col -->
            <div class="col-md-4">
              <div class="form-group">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <button type="submit" id='hapusKerjaan' class="btn btn-success">hapus</button>
              </div>
            </div>
        </div>
    </form>
</div>
