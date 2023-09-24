//written by : afdhalluthfi09,dom;
$('#addArtikel').on('click',function(){
    form('add')
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
})

//written by : afdhalluthfi09, function;
function form(model=null, data=null){
    if(model == 'add'){
        return $.ajax({
            url:'http://admin-skill.test/form/add-artikel',
            type:"GET"
        })
    }
} //written by : afdhalluthfi09,function for render form;

function formReset(idModal,idForm){
    $(`#${idModal}`).modal('hide')
    $(`#${idForm}`)[0].reset();
} //written by : afdhalluthfi09,reset form;
