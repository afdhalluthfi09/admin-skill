console.log("event.js loadesd!");let l="http://sekolahskillapi.test/api",u="http://sekolahskill-admin.test",m="http://image-sekolahskill.test";var o=Swal.mixin({toast:!0,position:"top-end",showConfirmButton:!1,timer:3e3});$(document).ready(function(){});var r=(i=null,e=null,n=null)=>{let a=$.Deferred();return i=="add"?$.ajax({url:l+"/event/add-event",method:"POST",data:n,dataType:"json",contentType:!1,processData:!1,beforeSend:function(){Swal.fire({title:"Please Wait !",allowOutsideClick:!1,showConfirmButton:!1,onBeforeOpen(){Swal.showLoading()}})},success:t=>{a.resolve(t)},error:t=>{a.reject(t)}}):i=="update"?$.ajax({url:l+"/event/update-event",method:"POST",data:n,dataType:"json",contentType:!1,processData:!1,success:t=>{a.resolve(t)},error:t=>{a.reject(t)}}):i=="addCategori"?$.ajax({url:l+"/event/add-category",method:"POST",dataType:"Json",data:n,success:t=>{a.resolve(t)},error:t=>{a.reject(t)}}):i=="updateCategori"?$.ajax({url:l+"/event/update-category",method:"POST",dataType:"Json",data:n,success:t=>{a.resolve(t),console.log("adad disini",t)},error:t=>{a.reject(t)}}):i=="nonactive"?$.ajax({url:l+"/event/delete-event",method:"POST",dataType:"Json",data:e,success:t=>{a.resolve(t),console.log("adad disini",t)},error:t=>{a.reject(t)}}):i=="nonactiveCategori"?$.ajax({url:l+"/event/delete-event-category",method:"POST",dataType:"Json",data:{id:e,mode:"deleteCategory"},success:t=>{a.resolve(t),console.log("adad disini",t)},error:t=>{a.reject(t)}}):i=="post"&&(console.log("id",e),$.ajax({url:l+"/event/update-post",method:"POST",dataType:"Json",data:{id:e,mode:"post"},success:t=>{a.resolve(t)},error:t=>{a.reject(t)}})),a.promise()};let c=$("#table-event").DataTable({ajax:{deferLoading:-1,url:l+"/event/data-table",data:function(i){},type:"GET"},searching:!0,ordering:!1,lengthChange:!1,aLengthMenu:[[20,50,100],[20,50,100]],columns:[{title:"No",render:function(i,e,n,a){return a.row+a.settings._iDisplayStart+1}},{title:"Action",render:(i,e,n,a)=>`<a class="btn btn-warning btn-sm" mode="detail")">Detail</a>
             <a mode="edit" class="btn btn-primary btn-sm">Edit</a>
             <a mode="hapus" class="btn btn-danger btn-sm">Hapus</a>
             <a mode="post" class="btn btn-success btn-sm">Post</a>`,className:"text-nowrap"},{title:"Event",data:"event_name",className:"text-nowrap"},{title:"Tanggal Mulai",data:"event_date",className:"text-nowrap"},{title:"Jam Mulai",data:"event_jam_mulai",className:"text-nowrap"},{title:"Jam Akhir",data:"event_jam_akhir",className:"text-nowrap"}],buttons:[{text:"Tambah",action:()=>{$("#add").modal("show")},titleAttr:"Add Kategori",className:"add_sample"}]});$("#table-event tbody").on("click","a",function(){let i=$(this).parents("tr");var e=c.row(i).data();let n=$(this).attr("mode");if(n=="detail"){console.log("detail",e),console.log(u,l);var a=null;a=`<div class='row'>
            <div class="col-md-7"> 
              <img style="width:200px" class="img ml-5 mt-5 mr-5 mb-5" src="${m}/${e.event_image}"/>
            </div>
            <div class="col-md-5 pt-5">
              <table class="table table-auto">
                <tr>
                  <td>
                    ${e.event_name}
                  </td>
                </tr>
                <tr>
                  <td>
                    ${e.event_pengisi}
                  </td>
                </tr>
                <tr>
                  <td>
                    ${e.event_jabatan}
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
                    <td>${e.event_date}</td>
                    <td>${e.event_jam_mulai}</td>
                    <td>${e.event_jam_akhir}</td>
                    <td>${e.event_type}</td>
                    <td>${e.event_location}</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>`,$("#detail-event").html(a),$("#detail").modal("show")}else n=="edit"?(console.log("edti",e),$("#event_description_edit").val(""),v("event_description_edit"),$("#id_event_update").val(e.id),$("#event_name_edit").val(e.event_name),$("#event_pengisi_edit").val(e.event_pengisi),$("#event_image_od").val(e.event_image),$("#event_description_edit").summernote("code",e.event_description),$("#event_date_edit").val(e.event_date),$("#event_location_edit").val(e.event_location),$("#event_jam_mulai_edit").val(e.event_jam_mulai),$("#event_jam_akhir_edit").val(e.event_jam_akhir),$("#event_jabatan_edit").val(e.event_jabatan),$("#event_type_edit").val(e.event_type),$("#image-event").attr("src",`${m}/${e.event_image}`),$("#edit").modal("show")):n=="hapus"?(console.log("hapus",e),$("#h5-cancle").html(""),$("#h5-cancle").html("Apaka Anda Yakin Cancle Event Dengan Tema "+e.event_name+" ?"),$("#id-cancle-hidden").val(e.id),$("#hapus").modal("show")):n=="post"&&(console.log("post",e),Swal.fire({title:"Apakah Anda Ingin Posting Event Ini?",showDenyButton:!0,showCancelButton:!1,confirmButtonText:"post",denyButtonText:"don't post"}).then(t=>{t.isConfirmed?$.when(r("post",e.id)).then(s=>{o.fire({icon:"success",title:s.message}),console.log(s),d.ajax.reload()}).catch(s=>{o.fire({icon:"error",title:data.message})}):t.isDenied&&Swal.fire("Posting event Di Batalkan","","info")}))});let d=$("#event-kategori").DataTable({ajax:{deferLoading:-1,url:l+"/event/data-kategeori",data:function(i){},type:"GET"},searching:!0,ordering:!1,lengthChange:!1,aLengthMenu:[[20,50,100],[20,50,100]],columns:[{title:"No",render:function(i,e,n,a){return a.row+a.settings._iDisplayStart+1}},{title:"Action",render:(i,e,n,a)=>`
              <a mode="edit" class="btn btn-primary btn-sm">Edit</a>
              <a mode="hapus" class="btn btn-danger btn-sm">Hapus</a>`,className:"text-nowrap"},{title:"Kategori",data:"name",className:"text-nowrap"}]});$("#event-kategori tbody").on("click","a",function(i){let e=$(this).parents("tr");var n=d.row(e).data();let a=$(this).attr("mode");a=="edit"?($("#inpkatgeoriEdit").val(n.name),$("#inpIdEdit").val(n.id),$("#edit-category-event").modal("show")):a=="hapus"&&Swal.fire({title:"Apakah Anda Yakin Hapus Kategori : "+n.name,showDenyButton:!0,showCancelButton:!1,confirmButtonText:"Ya",denyButtonText:"Batal"}).then(t=>{t.isConfirmed?$.when(r("nonactiveCategori",n.id)).then(s=>{o.fire({icon:"success",title:s.message}),d.ajax.reload()}).catch(s=>{o.fire({icon:"error",title:data.message})}):t.isDenied&&Swal.fire("tidak Ada Yang Di Batalkan","","info")})});$("#addEvent").on("click",function(i){i.preventDefault(),$("#tambah").modal("show")});function v(i){$(`#${i}`).summernote({height:100,codemirror:{mode:"text/html",htmlMode:!0,lineNumbers:!0,theme:"monokai"},callbacks:{onInit:function(){$(`#${i}`).summernote("focus")},onFocus:function(){},onBlur:function(){var e=$(this);setTimeout(function(){e.summernote("isEmpty")&&e.summernote("codeview.isActivated")},300)}}})}$("#event_description").summernote({placeholder:"Isi Disnini",tabsize:2,focus:!0,height:100});$("#form-event").on("submit",function(i){i.preventDefault();let e=$(this).serializeArray(),n=$("#event_image"),a=new FormData;for(let t=0;t<e.length;t++)a.append(e[t].name,e[t].value);a.append("event_image",n[0].files[0]),a.append("mode","add"),$.when(r("add",null,a)).then(t=>{o.fire({icon:"success",title:t.message}),c.ajax.reload(),$("#form-event").trigger("reset"),$(".btn-cancel").trigger("click")}).catch(t=>{o.fire({icon:"danger",title:t})})});$("#form-event-edit").on("submit",function(i){i.preventDefault();let e=$(this).serializeArray(),n=$("#event_image_edit");console.log(n[0].files[0]);let a=new FormData;for(let t=0;t<e.length;t++)a.append(e[t].name,e[t].value);a.append("mode","update"),$("#event_image_edit").hasClass("d-none")?console.log("Element is hidden, not appending event_image data"):a.append("event_image",n[0].files[0]),$.when(r("update",null,a)).then(t=>{o.fire({icon:"success",title:t.message}),c.ajax.reload(),$("#form-event-edit").trigger("reset"),$(".btn-cancel").trigger("click")}).catch(t=>{o.fire({icon:"danger",title:t})})});$("#form-event-edit").on("click","#ubah-image",function(i){let e=$("#event_image_od"),n=$("#event_image_edit");e.prop("disabled",!e.prop("disabled")),n.prop("disabled",!n.prop("disabled")),$("#event_image_edit").toggleClass("d-none"),$("#event_image_od").toggleClass("d-none")});$("#form-event-cancle").on("submit",function(i){i.preventDefault();let e=$(this).serialize();console.log(e),$.when(r("nonactive",e,null)).then(n=>{o.fire({icon:"success",title:n.message}),c.ajax.reload(),$("#form-event-cancle").trigger("reset"),$(".btn-cancel").trigger("click")}).catch(n=>{o.fire({icon:"danger",title:n})})});$("#form-categori").on("submit",function(i){i.preventDefault();let e=$(this).serializeArray(),n=$.param(e);$.when(r("addCategori",null,n)).then(a=>{$("#form-categori").trigger("reset"),d.ajax.reload()}).catch(a=>{console.log(a)})});$("#form-catgeory-edit").on("submit",function(i){i.preventDefault();let e=$(this).serializeArray(),n=$.param(e);$.when(r("updateCategori",null,n)).then(a=>{$("#form-catgeory-edit").trigger("reset"),$("#btn-close-event-category").trigger("click"),o.fire({icon:"success",title:a.message}),d.ajax.reload()}).catch(a=>{console.log(a)})});
