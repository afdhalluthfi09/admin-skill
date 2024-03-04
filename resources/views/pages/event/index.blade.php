<x-ladmin>
    @push('vite')
        @vite(['resources/js/event.js'])
    @endpush
    <div class="py-12">
     <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
       <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
         <div class="p-6 text-gray-900">
           {{-- @dump($artikel) --}}
             <div class="d-flex ml-2 mr-2 mt-2 px-2 py-2">
                 <h1 class="h3 mb-4 text-gray-800">{{__('event')}}</h1>
                 <a role="button" href="#" id="addEvent" class="button ml-auto">
                   Tambah Event
                 </a>
             </div>
             <div class="row mt-2">
              <div class="container">
                 <table id="table-event"></table>
              </div>
             </div>
         </div>
       </div>
     </div>
 </div>
 {{-- detail --}}
 <x-modals.modal type='detail' judul='detail' class="modal-lg">
     <div id="modal-content">
      <div id="detail-event" class="container">
        
      </div>
     </div>
     <button type="button" class="btn btn-default btn-cancel" data-dismiss="modal">Batal</button>
 </x-modals.modal>
 {{-- edit --}}
 <x-modals.modal type='edit' judul='edit' class="modal-md">
  <div id="modal-content-edit">
    <div class="container">
      <form class="form" id="form-event-edit">
        <div class="d-none row">
          <div class="col-md-12">
            <input type="hidden"  id="id_event_update" name="id">
          </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6">
              <label for="event_name_edit">Nama Event</label>
              <input type="text" class="form-control" id="event_name_edit" name="event_name" required>
            </div>
            <div class="col-md-6">
              <label for="event_pengisi_edit">Pengisi</label>
              <input type="text" class="form-control" id="event_pengisi_edit" name="event_pengisi" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
              <label for="event_image_edit">Poster</label>
              <img style="width:200px" id="image-event" class="img ml-5 mt-5 mr-5 mb-5">
              <input type="hidden" id="event_image_od" name="event_image"/>
              <input type="file" class="form-control d-none" id="event_image_edit" name="event_image" disabled/>
              <button type="button" id="ubah-image" class="btn-primary border-t-neutral-500 btn-small">ubah poster ?</button>
            </div>
        </div>
        <div class="form-group row">
          <div class="col-md-12">
              <label for="event_description_edit">Deskripsi</label>
              <textarea class="form-control" id="event_description_edit" name="event_description" required>   </textarea>
          </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6">
              <label for="event_date_edit">Tanggal</label>
              <input type="date" class="form-control" id="event_date_edit" name="event_date" required>
            </div>
            <div class="col-md-6">
              <label for="event_location_edit">Lokasi</label>
              <input type="text" class="form-control" id="event_location_edit" name="event_location" required>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6">
              <label for="event_jam_mulai_edit">Jam Mulai</label>
              <input type="time" class="form-control" id="event_jam_mulai_edit" name="event_jam_mulai" required>
            </div>
            <div class="col-md-6">
            <label for="event_jam_akhir_edit">Jam Akhir</label>
            <input type="time" class="form-control" id="event_jam_akhir_edit" name="event_jam_akhir" required>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6">
              <label for="event_jabatan_edit">Jabatan</label>
              <input type="text" class="form-control" id="event_jabatan_edit" name="event_jabatan" required>
            </div>
            <div class="col-md-6">
              <label for="event_type_edit">Tipe</label>
              <select class="form-control" id="event_type_edit" name="event_type" required>
                <option value="1">Internal</option>
                <option value="2">Eksternal</option>
              </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>
  <button type="button" class="btn btn-default btn-cancel" data-dismiss="modal">Batal</button>
</x-modals.modal>
 {{-- add --}}
 <x-modals.modal type='tambah' judul='buat baru' class="modal-lg">
  <div id="modal-content">
   <div class="container">
     <form class="form" id="form-event" enctype="multipart/form-data">
       <div class="form-group row">
          <div class="col-md-4">
             <label for="event_name">Nama Event</label>
             <input type="text" class="form-control" id="event_name" name="event_name" required>
          </div>
          <div class="col-md-4">
           <label for="event_pengisi">Pengisi</label>
           <input type="text" class="form-control" id="event_pengisi" name="event_pengisi" required>
          </div>
          <div class="col-md-4">
            <label for="event_image">Poster</label>
            <input type="file" class="form-control" id="event_image" name="event_image" required>
          </div>
       </div>
       <div class="form-group row">
         <div class="col-md-12">
            <label for="event_description">Deskripsi</label>
            <textarea class="form-control" id="event_description" name="event_description" required></textarea>
         </div>
       </div>
       <div class="form-group row">
          <div class="col-md-6">
             <label for="event_date">Tanggal</label>
             <input type="date" class="form-control" id="event_date" name="event_date" required>
          </div>
          <div class="col-md-6">
             <label for="event_location">Lokasi</label>
             <input type="text" class="form-control" id="event_location" name="event_location" required>
          </div>
       </div>
       <div class="form-group row">
          <div class="col-md-6">
             <label for="event_jam_mulai">Jam Mulai</label>
             <input type="time" class="form-control" id="event_jam_mulai" name="event_jam_mulai" required>
          </div>
          <div class="col-md-6">
           <label for="event_jam_akhir">Jam Akhir</label>
           <input type="time" class="form-control" id="event_jam_akhir" name="event_jam_akhir" required>
          </div>
       </div>
       <div class="form-group row">
          <div class="col-md-6">
            <label for="event_jabatan">Jabatan</label>
            <input type="text" class="form-control" id="event_jabatan" name="event_jabatan" required>
          </div>
          <div class="col-md-6">
            <label for="event_type">Tipe</label>
            <select class="form-control" id="event_type" name="event_type" required>
              <option value="1">Internal</option>
              <option value="2">Eksternal</option>
            </select>
          </div>
       </div>
       <button type="submit" class="btn btn-primary">Submit</button>
     </form>
   </div>
  </div>
  <button type="button" class="btn btn-default btn-cancel" data-dismiss="modal">Batal</button>
</x-modals.modal>
{{-- hapus --}}
<x-modals.modal type='hapus' judul='hapus' class="modal-md">
 <div id="modal-content">
  <form id="form-event-cancle">
    <div class="container">
        <input type="hidden" id="id-cancle-hidden" name="id" />
        <div class="d-flex flex-row gap-3">
          <h5 id="h5-cancle"></h5>
          <button type="submit" class="btn border-t-neutral-400 btn-danger">Ya</button>
        </div>
    </div>

  </form>
 </div>
 <button type="button" class="btn btn-default btn-cancel" data-dismiss="modal">Batal</button>
</x-modals.modal>
 @push('script')
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 <script src="{{ asset('summernote/summernote-bs4.js') }}"></script>
@endpush
</x-ladmin>
