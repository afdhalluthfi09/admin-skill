let n="http://sekolahskillapi.test/api";$("#table-user").DataTable({dom:"Bfrtip",ajax:{url:n+"/user",type:"GET"},searching:!0,ordering:!1,lengthChange:!1,scrollY:!1,scrollX:!1,scrollCollapse:!1,aLengthMenu:[[100,50,100],[100,50,100]],columns:[{title:"No",render:function(t,a,e,l){return l.row+l.settings._iDisplayStart+1}},{title:"action",render:(t,a,e)=>'<div class="d-flex flex-row justify-between"><button class="btn btn-primary mr-4 btn-sm">Edit</button><button class="btn btn-danger btn-sm">Block</button></div>'},{title:"Nama",data:"name",className:"text-nowrap"},{title:"Email",data:"email",className:"text-nowrap"},{title:"ResetPassword",render:(t,a,e)=>'<button class="btn btn-warning btn-sm">Reset Password</button>'},{title:"Alamat",data:"alamat",className:"text-nowrap"}],buttons:[{text:"Tambah",action:()=>{s("add").done(t=>{$("#modal-content-add").html(t.html),$("#modal-lg").modal("show")}).fail(t=>{console.log(t)})},title:"Tambah User",className:["btn btn-success btn-sm"]}],drawCallback:()=>{}});$(".btn-cancel").on("click",function(){$("#modal-content").empty(),$("#modal-content-add").empty()});function s(t=null,a=null){if(t=="add")return $.ajax({url:"http://admin-skill.test/form/add-user",type:"GET"})}
