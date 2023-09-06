console.log('hells');
$('#modalAdd').on('click',function(e){
    e.preventDefault();
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
                Swal.fire({
                    icon: 'success',
                    title: 'Data Updated',
                    text: data.message,
                }).then((result)=>{
                    if (result.isConfirmed) {
                        $('#renderKelas').html(data.html);
                    }
                })
             })
             .catch((erro)=>{console.log(erro);})
    })
})


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
                success:(data)=>{resolve(data);},
                error:(error)=>{reject(error);},
            });
        });
    }else if(mode == 'edit'){
        return new Promise((resolve,reject)=>{
            $.ajax({
                url:'http://enpoint.com',
                type:"POST",
                data:data,
                success:(data)=>{resolve(data);},
                error:(error)=>{reject(error);},
            });
        });
    }else if(mode == 'delete'){
        return new Promise((resolve,reject)=>{
            $.ajax({
                url:"http://enpoint.com",
                type:"POST",
                data:data,
                success:(data)=>{resolve(data);},
                error:(data)=>{reject(data);}
            });
        });
    }
}
async function fetchUpdateP(formData) {
    let headersList = {
        "withCredentials":true
    }

    await fetch('http://sekolahskillapi.test/api/kelas', {
        method: 'POST',
        body: formData,
        headers:headersList
    })
        .then((response) => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then((data) => {
            console.log(data);
        })
        .catch((error) => {
            console.log(error);
        });
}
