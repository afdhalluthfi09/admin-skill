let p="http://sekolahskillapi.test/api",g="http://sekolahskill-admin.test";$("#modalAdd").on("click",function(n){n.preventDefault(),w("addkelas").done(a=>{$("#modal-content-add").html(a.html);let o=document.getElementById("guru"),l=document.getElementById("namaPemateri");$("#summernote").summernote({placeholder:"Isi Disnini",tabsize:2,focus:!0,height:100}),$("#summernoteProfile").summernote({placeholder:"Isi Disnini",tabsize:2,focus:!0,height:100}),$("<input>").attr({type:"hidden",id:"idmapelo",name:"categorise_id",value:$(this).data("id"),readonly:!0}).appendTo("form");let e=$(".add"),i=10,t=1,d=$(".wrapper"),k=`
                            <div class="d-flex justify-content-between gap-1 mt-2">
                                    <input name="kurikulum[]" id="" type="text" placeholder="Name" class="required-entry form-control">
                                    <a class="btn btn-danger remove" href="javascript:void()0" >Remove</a>
                            </div>
                        `;$(e).click(function(m){m.preventDefault(),console.log("hellos"),t<i&&(t++,$(d).append(k))}),$(d).on("click",".remove",function(m){m.preventDefault(),$(this).parent("div").remove(),t--}),o.addEventListener("input",()=>{l.value=o.value}),$("#modal-add").modal("show");let f=$("#formAdd"),v=f.find("#gambar"),b=f.find("#photo");f.on("submit",function(m){m.preventDefault();let S=f.serializeArray(),c=new FormData;S.forEach(s=>{console.log(s.name),c.append(s.name,s.value)}),c.append("gambar",v[0].files[0]),c.append("photo",b[0].files[0]),h("add",c).then(s=>{console.log(s),Swal.fire({icon:"success",title:"Data Updated",text:"berhasil nambah kelas"}).then(r=>{r.isConfirmed&&(u("modal-add","formAdd"),$("#renderKelas").html(s.html))})}).catch(s=>{console.log("Error:",s),s.status===419?Swal.fire({icon:"error",title:"Session Expired",text:"Please reload the page and try again."}):s.status===200?Swal.fire({icon:"success",title:"Data Updated",text:s.response.message}).then(r=>{r.isConfirmed&&(u("modal-add","formAdd"),$("#renderKelas").html(s.response.html))}):s.status===401?Swal.fire({icon:"warning",title:"Error",text:"waktu sesi anda sebagai admin telah habis, silahkan login kembali"}).then(r=>{r.isConfirmed&&(u("modal-add","formAdd"),$("#renderKelas").html(a.html))}):s.status===400?Swal.fire({icon:"warning",title:"Data Corrected",text:"Opps Kelas Sudah Tersedia"}).then(r=>{r.isConfirmed&&(u("modal-add","formAdd"),$("#renderKelas").html(a.html))}):s.status===0?Swal.fire({icon:"warning",title:"token",text:"Opps Tidak Valid"}).then(r=>{r.isConfirmed&&(u("modal-add","formAdd"),$("#renderKelas").html(a.html))}):Swal.fire({icon:"error",title:"An error occurred",text:s.response?s.response.message:"Unknown error"})})})}).fail(a=>{console.log(a)})});$("#renderKelas").on("click",".btn-delete",function(n){n.preventDefault(),console.log("hellos");let a={kelas_id:$(this).data("id"),category:$(this).data("category")};$("#modal-hapus").modal("show"),$("#catgeoriDeleteForm").on("submit",function(o){o.preventDefault(),h("delete",a).then(l=>{Swal.fire({icon:"success",title:"Hapus",html:"<span> Yangkin Menghapus Data Ini</span>"}).then(e=>{e.isConfirmed&&(u("modal-hapus","catgeoriDeleteForm"),$("#renderKelas").html(l.html))})}).catch(l=>{console.log(l)})})});$("#renderKelas").on("click",".btn-edit",function(n){n.preventDefault(),w("editkelas",$(this).data("slug")).done(a=>{$("#modal-content").html(a.html),$("#summernoteEdit").summernote({placeholder:"Isi Disnini",tabsize:2,focus:!0,height:100}),$("#summernoteProfileEdit").summernote({placeholder:"Isi Disnini",tabsize:2,focus:!0,height:100});let o=$(".add"),l=10,e=1,i=$(".wrapper"),t=`
            <div class="d-flex justify-content-between gap-1 mt-2">
                    <input name="kurikulum[]" id="" type="text" placeholder="Name" class="required-entry form-control">
                    <a class="btn btn-danger remove" href="javascript:void()0" >Remove</a>
            </div>
        `;$(o).click(function(d){d.preventDefault(),console.log("hellos"),e<l&&(e++,$(i).append(t))}),$(i).on("click",".remove",function(d){d.preventDefault(),$(this).parent("div").remove(),e--}),$("#modal-edit").modal("show")}).fail(a=>{console.log(a)})});$(document).on("submit","#formEdit",function(n){n.preventDefault();let a=$("#formEdit"),o=a.find("#gambar"),l=a.find("#photo"),e=$("#formEdit").serializeArray(),i=new FormData;for(let t=0;t<e.length;t++)i.append(e[t].name,e[t].value);i.append("gambar",o[0].files[0]),i.append("photo",l[0].files[0]),h("edit",i).then(t=>{$("#renderKelas").html(t.html)}).catch(t=>{console.info("error",t)})});$(".btn-cancel").on("click",function(){$("#modal-content").empty(),$("#modal-content-add").empty()});function h(n=null,a=null){if(n=="add")return new Promise((o,l)=>{$.ajax({url:p+"/kelas",type:"POST",data:a,dataType:"json",contentType:!1,processData:!1,beforeSend:function(){Swal.fire({title:"Please Wait !",allowOutsideClick:!1,showConfirmButton:!1,onBeforeOpen(){Swal.showLoading()},timer:5e3})},success:(e,i,t)=>{t.status===200?o(e):l({status:t.status,response:e})},error:(e,i,t)=>{l({status:e.status,response:e.responseJSON||t})}})});if(n=="edit")return new Promise((o,l)=>{$.ajax({url:p+"/kelas/"+a.get("id"),type:"POST",data:a,dataType:"json",contentType:!1,processData:!1,beforeSend:function(){Swal.fire({title:"Please Wait !",allowOutsideClick:!1,showConfirmButton:!1,onBeforeOpen(){Swal.showLoading()},timer:4e3})},success:(e,i,t)=>{t.status===200?o(e):l({status:t.status,response:e})},error:(e,i,t)=>{l({status:e.status,response:e.responseJSON||t})}})});if(n=="delete")return new Promise((o,l)=>{$.ajax({url:p+"/kelas/"+a.kelas_id,type:"DELETE",data:{category:a.category},beforeSend:function(){Swal.fire({title:"Please Wait !",allowOutsideClick:!1,showConfirmButton:!1,onBeforeOpen(){Swal.showLoading()},timer:4e3})},success:e=>{o(e)},error:e=>{l(e)}})});if(n=="detail")return new Promise((o,l)=>{$.ajax({url:p+"/api/kelas/"+a.slug,type:"GET",beforeSend:function(){Swal.fire({title:"Please Wait !",allowOutsideClick:!1,showConfirmButton:!1,onBeforeOpen(){Swal.showLoading()},timer:4e3})},success:(e,i,t)=>{t.status===200?o(e):l({status:t.status,response:e})},error:(e,i,t)=>{l({status:e.status,response:e.responseJSON||t})}})})}function w(n=null,a=null){if(n=="editkelas")return $.ajax({url:`${g}/form/edit-kelas/${a}`,type:"GET"});if(n=="addkelas")return $.ajax({url:`${g}/form/add-kelas`,type:"GET"})}function u(n,a){$(`#${n}`).modal("hide"),$(`#${a}`)[0].reset()}
