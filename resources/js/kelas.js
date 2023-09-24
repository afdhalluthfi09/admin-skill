$('#modalAdd').on('click',function(e){
    e.preventDefault();

    form('addkelas')
        .done((data)=>{
            $('#modal-content-add').html(data.html)
            let inputGuru =document.getElementById('guru');
            let inputNameProfile =document.getElementById('namaPemateri');
            $('#summernote').summernote({
                placeholder: 'Isi Disnini',
                tabsize: 2,
                focus: true,
                // airMode: true,
                height: 100
            });
            $('#summernoteProfile').summernote({
                    placeholder: 'Isi Disnini',
                    tabsize: 2,
                    focus: true,
                    // airMode: true,
                    height: 100
            });
            $('<input>').attr({
                type: 'hidden',
                id: 'idmapelo',
                name: 'categorise_id',
                value: $(this).data('id'),
                readonly: true
            }).appendTo('form');
            let addButton=$('.add');
                        let maxCount =10;
                        let x =1;
                        let wrapper =$('.wrapper');
                        let fieldHtml=`
                            <div class="d-flex justify-content-between gap-1 mt-2">
                                    <input name="kurikulum[]" id="" type="text" placeholder="Name" class="required-entry form-control">
                                    <a class="btn btn-danger remove" href="javascript:void()0" >Remove</a>
                            </div>
                        `;
                        $(addButton).click(function(e){
                            e.preventDefault();
                            console.log('hellos');
                            if(x < maxCount){
                                x++;
                                // console.log(wrapper);
                                $(wrapper).append(fieldHtml)
                            }
                        });
                        $(wrapper).on('click','.remove',function(e){
                            e.preventDefault()
                            $(this).parent('div').remove();
                            x--;
                        })
                        inputGuru.addEventListener('input',()=>{
                            inputNameProfile.value =inputGuru.value
                        })
            $('#modal-add').modal('show')
            // proses kirim
            let formAdd =$('#formAdd');
            let inputGambar = formAdd.find('#gambar');
            let inputPhoto = formAdd.find('#photo');

            formAdd.on('submit',function(e){
                e.preventDefault()
                let formArray =formAdd.serializeArray();
                let formData = new FormData();
                formArray.forEach(item => {
                    console.log(item.name);
                    formData.append(item.name,item.value)
                });
                formData.append('gambar',inputGambar[0].files[0])
                formData.append('photo',inputPhoto[0].files[0])
                makeAjaxRequest('add',formData)
                    .then((data)=>{
                        console.log(data);
                        Swal.fire({
                            icon: 'success',
                            title: 'Data Updated',
                            text: data.message,
                        }).then((result)=>{
                            if (result.isConfirmed) {
                                formReset('modal-add','formAdd');
                                $('#renderKelas').html(data.html);
                            }
                        })
                    })
                    .catch((erro)=>{console.log(erro);})
            })
        })
        .fail((error)=>{console.log(error);})

})

// btn-delete
$('#renderKelas').on('click','.btn-delete',function(e){
    e.preventDefault();
    console.log('hellos');
    let data ={
        kelas_id:$(this).data('id'),
        category:$(this).data('category')
    }
    $('#modal-hapus').modal('show');

    $('#catgeoriDeleteForm').on('submit',function(e){
        e.preventDefault();
        makeAjaxRequest('delete',data)
        .then((data)=>{
            Swal.fire({
                icon: 'success',
                title: 'Hapus',
                html:`<span> Yangkin Menghapus Data Ini</span>` ,
            }).then((result)=>{
                if(result.isConfirmed){
                    formReset('modal-hapus','catgeoriDeleteForm')
                    $('#renderKelas').html(data.html);
                }
            })
        }).catch((error)=>{console.log(error);})
    })

})

// btn-edit
$('#renderKelas').on('click','.btn-edit',function(e){
    e.preventDefault();
    form('editkelas',$(this).data('slug'))
     .done((data)=>{
        // console.log(data);
        $('#modal-content').html(data.html);

        //written by : afdhalluthfi09, plugin summernote;
        $('#summernoteEdit').summernote({
            placeholder: 'Isi Disnini',
            tabsize: 2,
            focus: true,
            // airMode: true,
            height: 100
        });
        $('#summernoteProfileEdit').summernote({
                placeholder: 'Isi Disnini',
                tabsize: 2,
                focus: true,
                // airMode: true,
                height: 100
        });

        //written by : afdhalluthfi09,prosess add kurikum;
        let addButton=$('.add');
        let maxCount =10;
        let x =1;
        let wrapper =$('.wrapper');
        let fieldHtml=`
            <div class="d-flex justify-content-between gap-1 mt-2">
                    <input name="kurikulum[]" id="" type="text" placeholder="Name" class="required-entry form-control">
                    <a class="btn btn-danger remove" href="javascript:void()0" >Remove</a>
            </div>
        `;
        $(addButton).click(function(e){
            e.preventDefault();
            console.log('hellos');
            if(x < maxCount){
                x++;
                // console.log(wrapper);
                $(wrapper).append(fieldHtml)
            }
        });
        $(wrapper).on('click','.remove',function(e){
            e.preventDefault()
            $(this).parent('div').remove();
            x--;
        })
        $('#modal-edit').modal('show');
     })
     .fail((error)=>{console.log(error);})
})
// button submit
$(document).on('submit','#formEdit',function(e){
    e.preventDefault();
    // console.log($('#formEdit').serializeArray());
    let formAdd =$('#formEdit');
    let inputGambar = formAdd.find('#gambar');
    let inputPhoto = formAdd.find('#photo');
    let dataArray = $('#formEdit').serializeArray();
    let form = new FormData();
    for(let i =0; i < dataArray.length; i++){
        form.append(dataArray[i].name,dataArray[i].value);
    }
    form.append('gambar',inputGambar[0].files[0])
    form.append('photo',inputPhoto[0].files[0])
    /* for (const pair of form.entries()) {
        console.log(pair[0] + ': ' + pair[1]);
    } */
    makeAjaxRequest('edit',form)
            .then((data)=>{$('#renderKelas').html(data.html);})
            .catch((erro)=>{console.info('error',erro);});
})
$('.btn-cancel').on('click',function(){
    $('#modal-content').empty()
    $('#modal-content-add').empty()
})

//written by : afdhalluthfi09,func for enpoint;

function makeAjaxRequest(mode=null, data=null){
    if(mode == 'add'){
        return new Promise((resolve, reject) => {
            $.ajax({
                url:'http://sekolahskillapi.test/api/kelas',
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
                success:(data)=>{resolve(data);},
                error:(error)=>{reject(error);},
            });
        });
    }else if(mode == 'edit'){
        return new Promise((resolve,reject)=>{
            $.ajax({
                url:'http://sekolahskillapi.test/api/kelas/' + data.get('id'),
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
                        timer:4000
                    })
                },
                success:(data)=>{resolve(data);},
                error:(error)=>{reject(error);},
            });
        });
    }else if(mode == 'delete'){
        return new Promise((resolve,reject)=>{
            $.ajax({
                url:"http://sekolahskillapi.test/api/kelas/"+data.kelas_id,
                type:"DELETE",
                data:{category:data.category},
                beforeSend: function () {
                    Swal.fire({
                        title: "Please Wait !",
                        allowOutsideClick: !1,
                        showConfirmButton: !1,
                        onBeforeOpen() {
                            Swal.showLoading()
                        },
                        timer:4000
                    })
                },
                success:(data)=>{resolve(data);},
                error:(data)=>{reject(data);}
            });
        });
    }else if(mode == 'detail'){
        return new Promise((resolve,reject)=>{
            $.ajax({
                url:"http://sekolahskillapi.test/api/kelas/"+data.slug,
                type:"GET",
                beforeSend: function () {
                    Swal.fire({
                        title: "Please Wait !",
                        allowOutsideClick: !1,
                        showConfirmButton: !1,
                        onBeforeOpen() {
                            Swal.showLoading()
                        },
                        timer:4000
                    })
                },
                success:function(data){resolve(data)},
                error:function(error){reject(error)}
            })
        })
    }
}

//written by : afdhalluthfi09,func for render form;
function form(mode =null,data=null){
    if(mode == 'editkelas'){
        return $.ajax({
            url: "http://admin-skill.test/form/edit-kelas/"+data,
            type:"GET",
        })
    }else if(mode == 'addkelas'){
        return $.ajax({
            url:"http://admin-skill.test/form/add-kelas",
            type:"GET"
        });
    }
}

//written by : afdhalluthfi09,reset from;
function formReset(idModal,idForm){
    $(`#${idModal}`).modal('hide')
    $(`#${idForm}`)[0].reset();
}

