$(document).ready(function(){
    console.log('hellos');
    // scoope catgori
    //edit-catgoeri
    $('.btn-edit').click(function(){
      // console.log('hellos');
      // $('#modal-edit-category').modal('show');
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
                })
                .catch((error)=>{
                    console.log(error);
                })
        })
      // console.log($('#Editstatus').val($(this).data('status')));
    })
})
console.log($('#modal-delete-category'));
//add-catgori
$('#formAddCategory').on('submit',function(e){
    e.preventDefault();
    let data =$(this).serialize();
    makeAjaxRequest('add',data)
      .then(data =>{

        $('#cardCategory').html(data)
      })
      .catch(error =>{console.log(error);})
});
// delete-categori
$('.btn-delete').on('click',function(){
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
                    })
                    .catch((error)=>{
                      console.log(error);
                    })
      })
  })
// prosess data categori
function makeAjaxRequest(mode=null, data=null) {
    if(mode == 'add'){
        return new Promise(function (resolve, reject) {
            $.ajax({
                url: 'http://sekolahskillapi.test/api/categories', // Ganti dengan URL yang sesuai
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
                url:'http://sekolahskillapi.test/api/categories/update',
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
                url:'http://sekolahskillapi.test/api/categories/delete',
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
