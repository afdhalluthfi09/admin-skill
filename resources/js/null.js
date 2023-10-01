let baseUrl = import.meta.env.VITE_APP_LOCAL;
let baseApp = import.meta.env.VITE_APP_URL;
$(document).ready(function(){
    console.log('hellos');
    $('.btn-edit').click(function(){
      $('#editName').val($(this).data('name'));
      $('#Editstatus').val($(this).data('status'));
      $('<input>').attr({
              type: 'hidden',
              id: 'idmapelo',
              name: 'id',
              value: $(this).data('id'),
              readonly: true
        }).appendTo('form');

        // update
        $('#categoryFormEdit').on('submit',function(e){
            e.preventDefault();
            console.log($(this).serialize());
            let data =$(this).serialize();
            makeAjaxRequest('update',data)
                .then((data)=>{
                    $('#cardCategory').html(data)
                    formReset('modal-edit-category','categoryFormEdit')
                })
                .catch((error)=>{
                    console.log(error);
                })
        })
      // console.log($('#Editstatus').val($(this).data('status')));
    })
})
// console.log($('#modal-delete-category'));
//add-catgoricategoryFormEdit
$('#formAddCategory').on('submit',function(e){
    e.preventDefault();
    let data =$(this).serialize();
    makeAjaxRequest('add',data)
      .then(data =>{
        $('#cardCategory').html(data)
        formReset('modal-lg','formAddCategory')
      })
      .catch(error =>{console.log(error);})
});
// delete-categori
$('#cardCategory').on('click','.btn-delete',function(){
    console.log('submit barusxx`');
    $('<input>').attr({
            type: 'hidden',
            id: 'idmapelo',
            name: 'id',
            value: $(this).data('id'),
            readonly: true
      }).appendTo('form');
      $('#catgeoriDeleteForm').on('submit',function(e){
          e.preventDefault();
          let data =$(this).serialize();
          makeAjaxRequest('delete',data)
                    .then((data)=>{
                      $('#cardCategory').html(data)
                      formReset('modal-delete-category','catgeoriDeleteForm')
                    })
                    .catch((error)=>{
                      console.log(error);
                    })
      })
  })

//redirec-halaman kelasbyCategory
$('#formLihat').on('submit',function(e){
    e.preventDefault();
    let slug =$('#slug').val();
    console.log(slug);
    let urlListKelasByCat=baseUrl+'kelas/list/'+slug;
    $.ajax({
        type: 'GET', // Atau sesuaikan dengan metode Anda
        url: urlListKelasByCat,
        success: function(response) {
            window.location.href = response.redirectTo; // Ganti dengan URL yang sesuai
        },
        error: function(error) {
            // Penanganan kesalahan jika diperlukan
        }
    });
});

//written by : afdhalluthfi09,func enpoint;
function makeAjaxRequest(mode=null, data=null) {
    if(mode == 'add'){
        return new Promise(function (resolve, reject) {
            $.ajax({
                url: baseUrl+'/categories', // Ganti dengan URL yang sesuai
                type: 'POST', // Ubah metode ke POST
                data: data, // Kirim data yang ingin Anda kirimkan
                success: function (data) {
                    resolve(data); // Resolves promise with data
                },
                error: function (xhr, status, error) {
                    reject(error); // Rejects promise with error message
                }
            });
        });
    }else if(mode == 'update'){
        return new Promise(function(resolve,reject){
            $.ajax({
                url:baseUrl+'/categories/update',
                type:'POST',
                data:data,
                success:function(data){
                    resolve(data);
                },
                error:function(xhr,status,error){
                    reject(error);
                }
            })
        })
    }else if(mode == 'delete'){
        return new Promise(function(resolve,reject){
            $.ajax({
                url:baseUrl+'/categories/delete',
                type:"POST",
                data:data,
                success:function(data){
                    resolve(data);
                },
                error:function(error){
                    reject(error);
                }
            })
        })
    }
}
//written by : afdhalluthfi09,func resetForm;
function formReset(idElement,idForm){
    $(`#${idElement}`).modal('hide');
    $(`#${idForm}`)[0].reset();
}

