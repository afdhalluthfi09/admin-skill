//written by : afdhalluthfi09,dom;
let baseUrl = import.meta.env.VITE_APP_LOCAL;
let baseUrlLocal = import.meta.env.VITE_APP_URL;
$('#addArtikel').on('click',function(e){
    e.preventDefault();
    form('add')
        .done((data)=>{
            $('#modal-content').html(data.html)
            $('#summernote').summernote();
            $('#modal-lg').modal('show');
        })
        .fail((error)=>{console.log(error);})
})

$('.editArtikel').on('click',function(e){
    e.preventDefault();
    var dataId=$(this).data('id');
    form('edit',dataId)
        .done((data)=>{
            $('#modal-content').html(data.html)
            $('#summernote').summernote();
            $('#modal-lg').modal('show');
        })
        .fail((error)=>{console.log(error);})
})

$('.btn-cancel').on('click',function(){
    $('#modal-content').empty()
    $('#modal-content-add').empty()
    console.log('ss');
})


/* submit */
$('#modal-content').on('submit','#sumbitArtikel',function(e){
    e.preventDefault();
    var dataForm =$('#modal-content').find('#sumbitArtikel');
    var inputGambar =dataForm.find('#gambar');

    let formArray =dataForm.serializeArray();
    let formData = new FormData();

    formArray.forEach(item => {
        console.log(item.name);
        formData.append(item.name,item.value)
    });
    formData.append('gambar',inputGambar[0].files[0])
    formData.append('mode','add')

    makeAjaxRequest('add',formData)
                    .then((data)=>{
                        Swal.fire({
                            icon: 'success',
                            title: 'Data Updated',
                            text: 'berhasil nambah kelas',
                        }).then((result)=>{
                            if (result.isConfirmed) {
                                formReset('modal-add','formAdd');
                                $('#renderKelas').html(data.html);
                            }
                        })

                    }).catch((error) => {
                        // Tangani error di sini
                        console.log('Error:', error);
                        if (error.status === 500) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error System',
                                text: error.response.message,
                            });
                        }
                    });

})
//written by : afdhalluthfi09, function;
function form(model=null, data=null){
    if(model == 'add'){
        return $.ajax({
            url:`${baseUrlLocal}/form/add-artikel`,
            type:"GET"
        })
    }else if(model == 'edit'){
        return $.ajax({
            url:`${baseUrlLocal}/form/edit-artikel/${data}`,
            type:"GET"
        })
    }
} //written by : afdhalluthfi09,function for render form;

function formReset(idModal,idForm){
    $(`#${idModal}`).modal('hide')
    $(`#${idForm}`)[0].reset();
} //written by : afdhalluthfi09,reset form;

function makeAjaxRequest(mode=null, data=null){
    if(mode == 'add'){
        return new Promise((resolve, reject) => {
            $.ajax({
                url:baseUrl+'/artikel/add',
                type:"POST",
                data:data,
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
                        timer:5000
                    })
                },
                success: (data, textStatus, jqXHR) => {
                    if (jqXHR.status === 200) {
                        resolve(data);
                    } else {
                        reject({
                            status: jqXHR.status,
                            response: data
                        });
                    }
                },
                error: (jqXHR, textStatus, errorThrown) => {
                    reject({
                        status: jqXHR.status,
                        response: jqXHR.responseJSON || errorThrown
                    });
                },
            });
        });
    }else if(mode == 'edit'){

    }
}
