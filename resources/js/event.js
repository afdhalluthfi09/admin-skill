console.log('event.js loaded!');
$(document).ready(function() {});

var getApi=(mode=null,$id=null,$data=null)=>{
}

//let dataTable =$('#table-event').dataTable();
let table = $('#table-event').DataTable({
 "ajax": {
     "deferLoading": -1,
     "url": 'http://sekolahskillapi.test/api/event/data-table',
     "data": function (data) {
     },
     "type": "GET"
 },
 "searching": true,
 "ordering": false,
 "lengthChange": false,
 "aLengthMenu": [
     [20, 50, 100],
     [20, 50, 100]
 ],
 "columns": [
     {
         "title": "No",
         "render": function (data, type, row, meta) {
             return meta.row + meta.settings._iDisplayStart + 1;
         }
     },
     {
         "title": "Action",
         "render": (data,type,row,meta)=>{
             return `<a class="btn btn-warning btn-sm" mode="detail")">Detail</a>
             <a mode="edit" class="btn btn-primary btn-sm">Edit</a>
             <a mode="hapus" class="btn btn-danger btn-sm">Hapus</a>`;
         },
         "className": "text-nowrap"
     },
     {
         "title": "Event",
         "data": "event_name",
         "className": "text-nowrap"
     },
     {
         "title": "Tanggal Mulai",
         "data": "event_date",
         "className": "text-nowrap"
     },
     {
         "title": "Jam Mulai",
         "data": "event_jam_mulai",
         "className": "text-nowrap"
     },
     {
         "title": "Jam Akhir",
         "data": "event_jam_akhir",
         "className": "text-nowrap"
     },
 ],
buttons: [
        {
             text: '<i class="fa fa-plus"></i>',
             action: () => {
                 $('#add').modal('show');
             },

             titleAttr: 'Add Kategori',
             className: 'add_sample',
}
 ],
})

$('#table-event tbody').on('click', 'a', function(){
    /* 
        
    event_description
    event_image
    
    */
  let rowSelected = $(this).parents('tr');
  var rowData = table.row(rowSelected).data();
  let mode = $(this).attr('mode');
  if(mode == 'detail'){
    console.log('detail',rowData);
    var html =null;
    html =`<div class='row'>
    <div class="col-md-7 py-1 px-1"> 
      <img style="width:200px" class="img" src="http://image-sekolahskill.test/${rowData.event_image}"/>
    </div>
    <div class="col-md-5">
      <ul>
        <li>${rowData.event_name}</li>
        <li>${rowData.event_pengisi}</li>
        <li>${rowData.event_date}</li>
        <li>${rowData.event_jam_mulai}</li>
        <li>${rowData.event_jam_akhir}</li>
        <li>${rowData.event_jabatan}</li>
        <li>${rowData.event_type}</li>
        <li>${rowData.event_location}</li>
      </ul>
    </div>
    </div>`;
    $('#detail-event').html(html);
    $('#detail').modal('show');
    // $('#detail #event_name').val(rowData.event_name);
    // $('#detail #event_date').val(rowData.event_date);
    // $('#detail #event_jam_mulai').val(rowData.event_jam_mulai);
    // $('#detail #event_jam_akhir').val(rowData.event_jam_akhir);
  }else if(mode == 'edit'){
      console.log('edti',rowData);
    $('#edit').modal('show');
    // $('#edit #event_name').val(rowData.event_name);
    // $('#edit #event_date').val(rowData.event_date);
    // $('#edit #event_jam_mulai').val(rowData.event_jam_mulai);
    // $('#edit #event_jam_akhir').val(rowData.event_jam_akhir);
    // $('#edit #id').val(rowData.id);
  }else if(mode == 'hapus'){
    console.log('hapus',rowData);
    $('#hapus').modal('show');
    // $('#hapus #event_name').val(rowData.event_name);
    // $('#hapus #event_date').val(rowData.event_date);
    // $('#hapus #event_jam_mulai').val(rowData.event_jam_mulai);
    // $('#hapus #event_jam_akhir').val(rowData.event_jam_akhir);
    // $('#hapus #id').val(rowData.id);

  }

});

$('#addEvent').on('click',function(e){
   e.preventDefault();
   $('#tambah').modal('show');
})
// function
function edit(id){
  console.log('edit',id);
}
function hapus(id){
  console.log('hapus',id);
}

$('#event_description').summernote({
    placeholder: 'Isi Disnini',
    tabsize: 2,
    focus: true,
    // airMode: true,
    height: 100
});
