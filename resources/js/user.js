let tableUser=$('#table-user').DataTable({
    dom: 'Bfrtip',
    ajax: {
        "url": "http://sekolahskillapi.test/api/user",
        "type": "GET"
    },
    searching: true,
    ordering: false,
    lengthChange: false,
    scrollY:false,
    scrollX: false, // Perbaikan penulisan
    scrollCollapse: false, // Perbaikan penulisan
    aLengthMenu: [
        [100, 50, 100],
        [100, 50, 100]
    ],
    columns:[
        {
            title:"No",
            "render": function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            }
        },
        {
            title: "action",
            render: (data, type, raw) => {
                return `<div class="d-flex flex-row justify-between"><button class="btn btn-primary mr-4 btn-sm">Edit</button><button class="btn btn-danger btn-sm">Block</button></div>`;
            }
        },
        {
            title:"Nama",
            data: "name",
            className: "text-nowrap"
        },
        {
            title:"Email",
            data: "email",
            className: "text-nowrap"
        },
        {
            title:"ResetPassword",
            render:(data,type,raw)=>{
                return `<button class="btn btn-warning btn-sm">Reset Password</button>`;
            }
        },
        {
            title:"Alamat",
            data: "alamat",
            className: "text-nowrap"
        }
    ],
    buttons: [
        {
           text:'Tambah',
           action:()=>{
            form('add').done((data)=>{
                $('#modal-content-add').html(data.html)
                $('#modal-lg').modal('show');
            }).fail((error)=>{console.log(error);})
           },
           title:'Tambah User',
           className:['btn btn-success btn-sm']

        }
    ],
    drawCallback: ()=> {}
});

//dom
$('.btn-cancel').on('click',function(){
    $('#modal-content').empty()
    $('#modal-content-add').empty()
})



//form
function form(mode=null,data=null)
{
    if(mode == 'add')
    {
        return $.ajax({
            url:'http://admin-skill.test/form/add-user',
            type:"GET"
        })
    }
}
//written by : afdhalluthfi09,reset from;
function formReset(idModal,idForm){
    $(`#${idModal}`).modal('hide')
    $(`#${idForm}`)[0].reset();
}
