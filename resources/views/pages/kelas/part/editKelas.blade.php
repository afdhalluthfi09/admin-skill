<form enctype='multipart/form-data' id="formEdit">
    @csrf
    <input type="hidden" name="id" value="{{$kelas['id']}}" />
    <div id="modalEditForm" class="modal-body">
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
                                    <input type="text" class="form-control" value="{{ $kelas['name'] }}"
                                        id="min" name="namekelas" placeholder="ex: kelas" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Event</label>
                                    <select id="addStatus" class="form-control select2" name="type"
                                        style="width: 100%;" required>
                                        <option>Pilih Status</option>
                                        @foreach ($status as $item)
                                            <option
                                                {{ $item['id'] == $kelas['categorise_id']['id'] ? 'selected' : '' }}
                                                value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Pengisi Kelas</label>
                                    <input type="text" value="{{ $kelas['guru'] }}" class="form-control"
                                        id="guru" name="guru" placeholder="ex: nama pengisi kelas" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tanggal Kelas</label>
                                    <input type="date" value="{{ \Carbon\Carbon::parse($kelas['jadwal'])->format('Y-m-d') }}"
                                            class="form-control" id="jadwal" name="jadwal" placeholder="ex: tanggal" required>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Harga</label>
                                    <input type="text" value="{{ $kelas['harga'] }}" class="form-control"
                                        id="harga" name="harga" placeholder="ex: harga" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Poster</label>
                                    @if ($kelas['gambar'] == null)
                                        <input type="file" class="form-control" id="gambar" name="gambar"
                                            placeholder="ex: gambar">
                                    @else
                                        <img src="http://image-sekolahskill.test/{{$kelas['gambar']}}" alt="" sizes="200px" srcset="">
                                        <input type="file" class="form-control mt-2" id="gambar" name="gambar" placeholder="ex: gambar">
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>IDHASH</label>
                                    <input type="text" value="{{ $kelas['idhash'] }}" class="form-control"
                                        id="idhash" name="idhash" placeholder="ex: id list youtube" required>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <label>Deskirpsi</label>
                                <textarea name="description" id="summernoteEdit">{{ $kelas['description'] }}</textarea>
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
                                    <input type="text" value="{{ $kelas['profil']['data']['name'] }}"
                                        id="namaPemateri" name="nameProfile" class="form-control" readonly />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="emailPemateri" class="form-label">email</label>
                                    <input type="email" value="{{ $kelas['profil']['data']['email'] }}"
                                        id="emailPemateri" name="email" class="form-control" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="agePemateri" class="form-label">umur</label>
                                    <input type="text" value="{{ $kelas['profil']['data']['age'] }}"
                                        id="agePemateri" name="age" class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="profesiPemateri" class="form-label">Profesi</label>
                                    <input type="text" value="{{ $kelas['profil']['data']['profesi'] }}"
                                        id="profesiPemateri" name="profesi" class="form-control" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="form-label">Photo</label>
                                @if ($kelas['profil']['data']['photo'] == null)
                                    <input type="file" class="form-control" id="photo" name="photo">
                                @else
                                    <img src="http://image-sekolahskill.test/{{$kelas['profil']['data']['photo']}}" alt="photo" sizes="200px" srcset="">
                                    <input type="file" class="form-control mt-2" id="photo" name="photo">
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="form-label">Deskirpsi</label>
                                <textarea id="summernoteProfileEdit" name="deskripsi">{{ $kelas['profil']['data']['deskripsi'] }}</textarea>
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

                        <div class="wrapper" id="participantTable">
                            @isset($kelas['kurikulum']['data']['kurikulum'])
                                    @foreach ($kelas['kurikulum']['data']['kurikulum'] as $item)
                                        <div class="d-flex justify-content-between gap-1 mt-2">
                                            <input name="kurikulum[]" value="{{ $item }}" type="text"
                                                placeholder="Name" class="required-entry form-control"/>
                                                <a class="btn btn-danger remove" href="javascript:void()0">Remove</a>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="d-flex justify-content-between gap-1">
                                        <input name="kurikulum[]" value="" type="text" placeholder="Name"
                                            class="required-entry form-control">
                                            <a class="btn btn-danger remove" href="javascript:void()0">Remove</a>
                                    </div>
                                @endisset
                        </div>
                        <div class="d-flex justify-content-center mt-2">
                            <a href="javascript:void()0" class="btn btn-large btn-success add" type="button">Add</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="modal-footer justify-content-between">
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>
