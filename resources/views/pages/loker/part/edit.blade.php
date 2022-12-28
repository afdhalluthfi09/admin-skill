<div class="container mt-2 mb-2">
    <form action="{{ route('loker.updatekerjaan') }}" method="POST">
       @csrf
        <div class="row">
            <div class="col-md-8">
              <div class="form-group" id="inputEdit">
                <input type="text" class="form-control" name="nameEditKerjaan" id="inpEditKerjaan"  placeholder="ex: buat kategori kerjaan" required>
                <input type="hidden" name="ideditkerjaan" id="ideditkerjaan">
              </div>
            </div>
            <!-- /.col -->
            <div class="col-md-4">
              <div class="form-group">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-success">Ubah</button>
              </div>
            </div>
        </div>
    </form>
</div>
