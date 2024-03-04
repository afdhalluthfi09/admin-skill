console.log('event.js loadesd!');
let baseUrlApi = import.meta.env.VITE_APP_LOCAL;
let baseUrl = import.meta.env.VITE_APP_URL;
let baseUrImage = import.meta.env.VITE_APP_IMAGE;
var Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000
});
$(document).ready(function () {});

var getApi = (mode = null, id = null, data = null) => {
  let defrred = $.Deferred();
  if (mode == 'add') {
    $.ajax({
      url: baseUrlApi + '/event/add-event',
      method: "POST",
      data: data,
      dataType: 'json',
      contentType: false,
      processData: false,
      beforeSend: function () {
        Swal.fire({
          title: "Please Wait !",
          allowOutsideClick: !1,
          showConfirmButton: !1,
          onBeforeOpen() {
            Swal.showLoading()
          },
        })
      },
      success: (data) => { defrred.resolve(data); },
      error: (error) => { defrred.reject(error); },
    });
  } else if (mode == "update") {
    $.ajax({
      url: baseUrlApi + '/event/update-event',
      method: "POST",
      data: data,
      dataType: 'json',
      contentType: false,
      processData: false,
      success: (data) => { defrred.resolve(data); },
      error: (error) => { defrred.reject(error); },
    });
  } else if (mode == 'addCategori') {
    $.ajax({
      url: baseUrlApi + '/event/add-category',
      method: "POST",
      dataType: "Json",
      data: data,
      success: (d) => { defrred.resolve(d) },
      error: (error) => { defrred.reject(error); },
    });
  } else if (mode == 'updateCategori') {
    $.ajax({
      url: baseUrlApi + '/event/update-category',
      method: "POST",
      dataType: "Json",
      data: data,
      success: (d) => { defrred.resolve(d), console.log('adad disini', d) },
      error: (error) => { defrred.reject(error); },
    });
  }else if(mode == 'nonactive'){
    $.ajax({
      url: baseUrlApi + '/event/delete-event',
      method: "POST",
      dataType: "Json",
      data: id,
      success: (d) => { defrred.resolve(d), console.log('adad disini', d) },
      error: (error) => { defrred.reject(error); },
    });
  }else if(mode =='nonactiveCategori'){
    $.ajax({
      url: baseUrlApi + '/event/delete-event-category',
      method: "POST",
      dataType: "Json",
      data: {id:id,mode:'deleteCategory'},
      success: (d) => { defrred.resolve(d), console.log('adad disini', d) },
      error: (error) => { defrred.reject(error); },
    });
  }else if(mode =="post"){
    console.log('id',id);
    $.ajax({
      url: baseUrlApi + '/event/update-post',
      method: "POST",
      dataType: 'Json',
      data: {id:id,mode:'post'},
      success: (data) => { defrred.resolve(data); },
      error: (error) => { defrred.reject(error); },
    });
  }

  return defrred.promise();
}

//let dataTable =$('#table-event').dataTable();
let table = $('#table-event').DataTable({
  "ajax": {
    "deferLoading": -1,
    "url": baseUrlApi + '/event/data-table',
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
      "render": (data, type, row, meta) => {
        return `<a class="btn btn-warning btn-sm" mode="detail")">Detail</a>
             <a mode="edit" class="btn btn-primary btn-sm">Edit</a>
             <a mode="hapus" class="btn btn-danger btn-sm">Hapus</a>
             <a mode="post" class="btn btn-success btn-sm">Post</a>`;
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
      text: 'Tambah',
      action: () => {
        $('#add').modal('show');
      },

      titleAttr: 'Add Kategori',
      className: 'add_sample',
    }
  ],
})
$('#table-event tbody').on('click', 'a', function () {
  let rowSelected = $(this).parents('tr');
  var rowData = table.row(rowSelected).data();
  let mode = $(this).attr('mode');
  if (mode == 'detail') {
    console.log('detail', rowData);
    console.log(baseUrl, baseUrlApi);
    var html = null;
    html = `<div class='row'>
            <div class="col-md-7"> 
              <img style="width:200px" class="img ml-5 mt-5 mr-5 mb-5" src="${baseUrImage}/${rowData.event_image}"/>
            </div>
            <div class="col-md-5 pt-5">
              <table class="table table-auto">
                <tr>
                  <td>
                    ${rowData.event_name}
                  </td>
                </tr>
                <tr>
                  <td>
                    ${rowData.event_pengisi}
                  </td>
                </tr>
                <tr>
                  <td>
                    ${rowData.event_jabatan}
                  </td>
                </tr>
              </table>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <table class="table table-auto">
                <thead>
                  <tr>
                    <td>Tanggal</td>
                    <td>Jam Mulai</td>
                    <td>Jam Akhir</td>
                    <td>Kategori</td>
                    <td>Lokasi</td>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>${rowData.event_date}</td>
                    <td>${rowData.event_jam_mulai}</td>
                    <td>${rowData.event_jam_akhir}</td>
                    <td>${rowData.event_type}</td>
                    <td>${rowData.event_location}</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>`;
    $('#detail-event').html(html);
    $('#detail').modal('show');
  } else if (mode == 'edit') {
    console.log('edti', rowData);
    
    $('#event_description_edit').val('');
   description('event_description_edit')
   $('#id_event_update').val(rowData.id)
   $('#event_name_edit').val(rowData.event_name)
   $('#event_pengisi_edit').val(rowData.event_pengisi)
   $('#event_image_od').val(rowData.event_image)
   $('#event_description_edit').summernote('code',rowData.event_description)
   $('#event_date_edit').val(rowData.event_date)
   $('#event_location_edit').val(rowData.event_location)
   $('#event_jam_mulai_edit').val(rowData.event_jam_mulai)
   $('#event_jam_akhir_edit').val(rowData.event_jam_akhir)
   $('#event_jabatan_edit').val(rowData.event_jabatan)
   $('#event_type_edit').val(rowData.event_type)
   $('#image-event').attr('src',`${baseUrImage}/${rowData.event_image}`)
    
    $('#edit').modal('show');
  } else if (mode == 'hapus') {
    console.log('hapus', rowData);
    // event-cancle,h5-cancle
    $('#h5-cancle').html('');
    $('#h5-cancle').html('Apaka Anda Yakin Cancle Event Dengan Tema '+rowData.event_name+' ?');
    $('#id-cancle-hidden').val(rowData.id);
    $('#hapus').modal('show');
  } else if(mode =='post'){
    console.log('post',rowData);
    Swal.fire({
      title: "Apakah Anda Ingin Posting Event Ini?",
      showDenyButton: true,
      showCancelButton: false,
      confirmButtonText: "post",
      denyButtonText: `don't post`
    }).then((result) => {
      /* Read more about isConfirmed, isDenied below */
      if (result.isConfirmed) {
          $.when(getApi('post',rowData.id))
            .then((data)=>{
              Toast.fire({
                icon: 'success',
                title: data.message
              })
              console.log(data);
              tableKageori.ajax.reload();
            })
            .catch((err)=>{
              Toast.fire({
                icon: 'error',
                title: data.message
              })
            })
      } else if (result.isDenied) {
        Swal.fire("Posting event Di Batalkan", "", "info");
      }
    });
  }
});

/* setting/katgeori */
let tableKageori = $('#event-kategori').DataTable({
  "ajax": {
    "deferLoading": -1,
    "url": baseUrlApi + '/event/data-kategeori',
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
      "render": (data, type, row, meta) => {
        return `
              <a mode="edit" class="btn btn-primary btn-sm">Edit</a>
              <a mode="hapus" class="btn btn-danger btn-sm">Hapus</a>`;
      },
      "className": "text-nowrap"
    },
    {
      "title": "Kategori",
      "data": "name",
      "className": "text-nowrap"
    },
  ],
});
$('#event-kategori tbody').on('click', 'a', function (e) {
  let rowSelectedCat = $(this).parents('tr');
  var rowDataCat = tableKageori.row(rowSelectedCat).data();
  let modeCat = $(this).attr('mode');
  if (modeCat == 'edit') {
    $('#inpkatgeoriEdit').val(rowDataCat.name)
    $('#inpIdEdit').val(rowDataCat.id)
    $('#edit-category-event').modal('show');
  }else if(modeCat == 'hapus'){
    Swal.fire({
      title: "Apakah Anda Yakin Hapus Kategori : "+rowDataCat.name,
      showDenyButton: true,
      showCancelButton: false,
      confirmButtonText: "Ya",
      denyButtonText: `Batal`
    }).then((result) => {
      /* Read more about isConfirmed, isDenied below */
      if (result.isConfirmed) {
        $.when(getApi('nonactiveCategori',rowDataCat.id))
          .then((data)=>{
            Toast.fire({
              icon: 'success',
              title: data.message
            })
            tableKageori.ajax.reload();
          })
          .catch((err)=>{
            Toast.fire({
              icon: 'error',
              title: data.message
            })
          })
      } else if (result.isDenied) {
        Swal.fire("tidak Ada Yang Di Batalkan", "", "info");
      }
    });

  }
})

$('#addEvent').on('click', function (e) {
  e.preventDefault();
  $('#tambah').modal('show');
})
// function
function edit(id) {
  console.log('edit', id);
}
function hapus(id) {
  console.log('hapus', id);
}
function description(id) {
  $(`#${id}`).summernote({
    height: 100, // Sesuaikan tinggi sesuai kebutuhan
    codemirror: {
      mode: 'text/html',
      htmlMode: true,
      lineNumbers: true,
      theme: 'monokai'
    },
    callbacks: {
      onInit: function () {
        $(`#${id}`).summernote('focus');
      },
      onFocus: function() {
        // Tambahkan logika onFocus jika diperlukan
      },
      onBlur: function() {
        var $self = $(this);
        setTimeout(function() {
          if ($self.summernote('isEmpty') && !$self.summernote('codeview.isActivated')) {
            // Tambahkan logika onBlur jika diperlukan
          }
        }, 300);
      }
    }
  });
}

$('#event_description').summernote({
  placeholder: 'Isi Disnini',
  tabsize: 2,
  focus: true,
  // airMode: true,
  height: 100
});

// action event
$('#form-event').on('submit', function (e) {
  e.preventDefault();
  let dataForm = $(this).serializeArray();
  let inputGambar = $('#event_image');
  let form = new FormData();
  for (let i = 0; i < dataForm.length; i++) {
    form.append(dataForm[i].name, dataForm[i].value);
  }
  form.append('event_image', inputGambar[0].files[0]);
  form.append('mode', 'add');
  $.when(getApi('add', null, form))
    .then((data) => {
      Toast.fire({
        icon: 'success',
        title: data.message
      })
      table.ajax.reload();
      $('#form-event').trigger('reset');
      $('.btn-cancel').trigger('click');
    })
    .catch((erro) => { 
      Toast.fire({
        icon: 'danger',
        title: erro
      })
    });
})

$('#form-event-edit').on('submit', function (e) {
  e.preventDefault();
  let dataForm = $(this).serializeArray();
  let inputGambar = $('#event_image_edit');
  console.log(inputGambar[0].files[0]);
  let form = new FormData();
  for (let i = 0; i < dataForm.length; i++) {
    form.append(dataForm[i].name, dataForm[i].value);
  }
  form.append('mode', 'update');
  if ($('#event_image_edit').hasClass('d-none')) {
    console.log("Element is hidden, not appending event_image data");
  } else {
    form.append('event_image', inputGambar[0].files[0]);
  }

  $.when(getApi('update', null, form))
    .then((data) => {
      Toast.fire({
        icon: 'success',
        title: data.message
      })
      table.ajax.reload();
      $('#form-event-edit').trigger('reset');
      $('.btn-cancel').trigger('click');
    })
    .catch((erro) => { 
      Toast.fire({
        icon: 'danger',
        title: erro
      })
    });
})

$('#form-event-edit').on('click', '#ubah-image', function (e) {
  let hiddenInputOdd = $('#event_image_od');
  let hiddenInputNew =$('#event_image_edit');
  hiddenInputOdd.prop('disabled', !hiddenInputOdd.prop('disabled'));
  hiddenInputNew.prop('disabled', !hiddenInputNew.prop('disabled'));
  
  $('#event_image_edit').toggleClass('d-none');
  $('#event_image_od').toggleClass('d-none');
})

$('#form-event-cancle').on('submit',function(e){
    e.preventDefault();
    let FormData =$(this).serialize();
    console.log(FormData);
    $.when(getApi('nonactive',FormData,null))
      .then((data)=>{
        Toast.fire({
          icon: 'success',
          title: data.message
        })
        table.ajax.reload();
        $('#form-event-cancle').trigger('reset');
        $('.btn-cancel').trigger('click');
      })
      .catch((err) => { 
        Toast.fire({
          icon: 'danger',
          title: err
        })
       })
})



// action event category
$('#form-categori').on('submit', function (e) {
  e.preventDefault();
  let dataForm1 = $(this).serializeArray();
  let dataParam = $.param(dataForm1);
  // console.log(dataParam);
  $.when(getApi('addCategori', null, dataParam))
    .then((data) => {
      $('#form-categori').trigger('reset')
      tableKageori.ajax.reload()
    })
    .catch((err) => { console.log(err); })
})
$('#form-catgeory-edit').on('submit', function (e) {
  e.preventDefault();
  let dataForm1 = $(this).serializeArray();
  let dataParam = $.param(dataForm1);
  // console.log(dataParam);
  $.when(getApi('updateCategori', null, dataParam))
    .then((data) => {
      $('#form-catgeory-edit').trigger('reset')
      $('#btn-close-event-category').trigger('click')
      Toast.fire({
        icon: 'success',
        title: data.message
      })
      tableKageori.ajax.reload()
    })
    .catch((err) => { console.log(err); })
})



