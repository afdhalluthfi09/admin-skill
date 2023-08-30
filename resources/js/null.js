$(document).ready(function(){
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
      // console.log($('#Editstatus').val($(this).data('status')));
    })
    $('.btn-delete').click(function(){
      $('#modal-delete-category').modal('show');
      $('<input>').attr({
              type: 'hidden',
              id: 'idmapelo',
              name: 'id',
              value: $(this).data('id'),
              readonly: true
        }).appendTo('form');
      // console.log($('#Editstatus').val($(this).data('status')));
    })
  })
