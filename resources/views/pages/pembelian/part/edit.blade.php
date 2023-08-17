<div class="container px-2 py-3">
    <form action="{{ route('trasaction.edit') }}" id="formPembelian" method="POST">
        @csrf
        <select class="form-control" name="status" id="status">
            <option value="belum lunas">Belum Lunas</option>
            <option value="Lunas">Lunas</option>
        </select>

        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary btn-small">Ubah</button>
        </div>
    </form>
</div>
