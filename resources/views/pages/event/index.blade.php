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
 <x-modals.modal type='detail' judul='detail' class="modal-md">
     <div id="modal-content">
      <div id="detail-event" class="container">
        
      </div>
     </div>
     <button type="button" class="btn btn-default btn-cancel" data-dismiss="modal">Batal</button>
 </x-modals.modal>
 {{-- edit --}}
 <x-modals.modal type='edit' judul='edit' class="modal-md">
  <div id="modal-content"></div>
  <button type="button" class="btn btn-default btn-cancel" data-dismiss="modal">Batal</button>
</x-modals.modal>
 {{-- add --}}
 <x-modals.modal type='tambah' judul='buat baru' class="modal-lg">
  {{--
    event_name
    event_description
    event_date
    event_jam_mulai
    event_jam_akhir
    event_jabatan
    event_pengisi
    event_location
    event_image
    event_type
   --}}
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
 <div id="modal-content"></div>
 <button type="button" class="btn btn-default btn-cancel" data-dismiss="modal">Batal</button>
</x-modals.modal>
 @push('script')
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 <script src="{{ asset('summernote/summernote-bs4.js') }}"></script>
@endpush
</x-ladmin>
