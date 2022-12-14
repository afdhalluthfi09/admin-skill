<form action="{{ route('sop.store') }}" id="formSop" method="POST">
    @csrf
    <div class="form-group">
        <label for="judul" class="form-label">Jenis Sop</label>
        <select name="type" id="" class="form-control">
            <option value="intraining">In Training House</option>
            <option value="beli_online">Beli Online</option>
            <option value="zoom">Zoom</option>
            <option value="event">Event</option>
        </select>
    </div>
    <div class="form-group">
        <label for="judul" class="form-label">Deskripsi</label>
        <textarea name="description" id="summernote"></textarea>
    </div>
    <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default">Batal</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
</form>