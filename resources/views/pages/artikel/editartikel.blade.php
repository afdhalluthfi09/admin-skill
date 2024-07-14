<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <form action="{{ route('artikel.editArtikel', ['id'=>$artikel['id']]) }}" method="post" enctype='multipart/form-data'>
                @csrf
                <section>
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
                                    <label>Judul</label>
                                    <input type="text" class="form-control" id="judul" name="judul" value="{{$artikel['judul']}}" placeholder="ex: judul" required>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label>Status</label>
                                    <select id="kategori" class="form-control select2" name="kategori" style="width: 100%;" required>
                                        <option>Pilih katgori</option>
                                        <option @php echo ( $artikel['kategori'] == 'Umkm') ? 'selected' : '' @endphp value='Umkm' >Umkm</option>
                                        <option @php echo ( $artikel['kategori'] == 'Management') ? 'selected' : '' @endphp value='Management' >Management</option>
                                        <option @php echo ( $artikel['kategori'] == 'TipsAndTrick') ? 'selected' : '' @endphp value="TipsAndTrick">Tips And Trick</option>
                                    </select>
                                  </div>
                                </div>
                             </div>
                              <div class="row mt-2">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Gambar Judul</label>
                                        <input type="file" class="form-control" id="gambar" name="gambar" placeholder="ex: gambar" required>
                                      </div>
                                </div>
                              </div>
                            </div>
                          </div>
                      </div>
                </section>
                <section class="content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-outline card-info">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        Summernote
                                    </h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <textarea id="summernote" name="isi" required>
                                        {{$artikel['isi']}}
                                    </textarea>
                                </div>
                                <div class="card-footer">
                                    Visit <a href="https://github.com/summernote/summernote/">Summernote</a> documentation for more
                                    examples and information about the plugin.
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default btn-cancel">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
      </div>
    </div>
</div>
