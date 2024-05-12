<x-ladmin>
    @push('vite')
        @vite(['resources/js/event.js'])
    @endpush
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">
                        <h4>Kategori</h4>
                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                          <i class="fas fa-minus"></i>
                        </button>
                      </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <form id="form-categori">
                        <div class="row">
                            <div class="col-md-8">
                              <div class="form-group">
                                <input type="text" class="form-control" id="inpkatgeori" name="name"  placeholder="ex: Buat Kategori Event" required>
                              </div>
                            </div>
                          <!-- /.col -->
                            <div class="col-md-4">
                              <div class="form-group">
                                <button type="submit" id='tambah-kategori' class="btn btn-success">Buat</button>
                              </div>
                            </div>
                        </div>
                      </form>
                      <div class="row">
                        <div class="col-md-12">
                          <table id="event-kategori" class="table table-bordered "></table>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- modal --}}
    <x-modals.modal type='edit-category-event' judul='Edit' class="modal-lg">
      <div id="modal-content" class="container px-2 py-2">
        <form id="form-catgeory-edit">
              <div class="row">
                <div class="col-md-8">
                  <div class="form-group">
                    <input type="text" class="form-control" id="inpkatgeoriEdit" name="name"  placeholder="ex: Buat Kategori Event" required>
                    <input type="hidden" class="form-control" id="inpIdEdit" name="id" required>
                  </div>
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                  <div class="form-group">
                    <button type="submit" id='tambah-kategori' class="btn btn-success">simpan</button>
                  </div>
                </div>
              </div>
        </form>
      </div>
      <button type="button" id="btn-close-event-category" class="btn btn-default btn-cancel" data-dismiss="modal">Batal</button>
    </x-modals.modal>
    @push('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('summernote/summernote-bs4.js') }}"></script>
    @endpush
</x-ladmin>