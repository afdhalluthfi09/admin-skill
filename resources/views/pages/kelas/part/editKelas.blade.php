<form action="{{ route('kelas.updateKelas') }}" method="post" enctype='multipart/form-data' id="formEdit" >
    @csrf
    <div class="modal-body">
        {{-- kelas --}}
        <section class="content">
            <div class="container-fluid">
                <div class="card card-default">
                    <div class="card-header">
                        <h5>Kelas</h5>
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
                        {{-- nama kelas,event,pengisi kelas,tanggal kelas,status,harga,gambar,deskirpsi --}}
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control" id="editName" name="name" placeholder="ex: kelas" required>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Event</label>
                            <select id="editStatus" class="form-control select2" name="status" style="width: 100%;" required>
                                <option>Pilih Status</option>
                                <option value="{{$status}}">{{$status}}</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Pengisi Kelas</label>
                            <input type="text" class="form-control" id="editGuru" name="guru" placeholder="ex: nama pengisi kelas" required>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Tanggal Kelas</label>
                            <input type="date" class="form-control" id="editJadwal" name="jadwal" placeholder="ex: tanggal" required>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Harga</label>
                            <input type="text" class="form-control" id="editHarga" name="harga" placeholder="ex: harga" required>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div id="formImagesEdit" class="form-group">
                            <label>Poster</label>
                            <button type="button" class="btn-upload-image">Upload ?</button>
                            <input type="file" class="form-control" class="d-none" id="editGambar" name="gambar" placeholder="ex: gambar" required>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>IDHASH</label>
                            <input type="text" class="form-control" id="editIdhash" name="idhash" placeholder="ex: id list youtube" required>
                          </div>
                        </div>
                      </div>
                      <div class="row mt-2">
                        <div class="col-md-12">
                          <label class="form-group">Deskirpsi</label>
                          <textarea name="description" id="summernoteEdit" cols="55" rows="10"></textarea>
                        </div>
                      </div>
                    </div>
                  </div>
            </div>
        </section>
        {{-- profile pemateri --}}
        <section class="content">
            <div class="container-fluid">
                <div class="card card-default">
                    <div class="card-header">
                        <h5>Profile Pemateri</h5>
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
                                    <label for="namaPemateri" class="form-label">Nama Pemateri</label>
                                    <input type="text" id="namaPemateri" name="name" class="form-control"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="emailPemateri" class="form-label">email</label>
                                    <input type="email" id="emailPemateri" name="email" class="form-control"/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="agePemateri" class="form-label">umur</label>
                                    <input type="text" id="agePemateri" name="age" class="form-control"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="emailPemateri" class="form-label">Profesi</label>
                                    <input type="email" id="emailPemateri" name="profesi" class="form-control"/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="form-label">Photo</label>
                                <input type="file" class="form-control" name="photo">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="form-label">Deskirpsi</label>
                                <textarea id="summernoteProfileEdit" name="deskripsi"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{-- module  --}}
        <section class="content">
            <div class="container-fluid">
                <div class="card card-default">
                    <div class="card-header">
                        <h5>Kurikulum</h5>
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
                        <label>
                            <select id="participants" class="input-mini required-entry">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                            </select></label>

                        <table class="table table-hover" id="participantTable">
                                <thead>
                                    <tr>
                                        <th>&nbsp;</th>
                                        <th>kurikukm</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tr class="participantRow">
                                    <td>&nbsp;</td>
                                    <td><input name="kurikulum[]" id="" type="text" placeholder="Name" class="required-entry form-control"></td>
                                    <td><button class="btn btn-danger remove" type="button">Remove</button></td>
                                </tr>
                                <tr id="addButtonRow">
                                    <td colspan="4"><center><button class="btn btn-large btn-success add" type="button">Add</button></center></td>
                                </tr>
                        </table>
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
