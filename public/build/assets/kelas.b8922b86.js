let h="http://sekolahskillapi.test/api",k="http://admin-skill.test";$("#modalAdd").on("click",function(n){n.preventDefault(),v("addkelas").done(t=>{$("#modal-content-add").html(t.html);let o=document.getElementById("guru"),l=document.getElementById("namaPemateri");$("#summernote").summernote({placeholder:"Isi Disnini",tabsize:2,focus:!0,height:100}),$("#summernoteProfile").summernote({placeholder:"Isi Disnini",tabsize:2,focus:!0,height:100}),$("<input>").attr({type:"hidden",id:"idmapelo",name:"categorise_id",value:$(this).data("id"),readonly:!0}).appendTo("form");let e=$(".add"),s=10,i=1,d=$(".wrapper"),b=`
                            <div class="d-flex justify-content-between gap-1 mt-2">
                                    <input name="kurikulum[]" id="" type="text" placeholder="Name" class="required-entry form-control">
                                    <a class="btn btn-danger remove" href="javascript:void()0" >Remove</a>
                            </div>
                        `;$(e).click(function(m){m.preventDefault(),console.log("hellos"),i<s&&(i++,$(d).append(b))}),$(d).on("click",".remove",function(m){m.preventDefault(),$(this).parent("div").remove(),i--}),o.addEventListener("input",()=>{l.value=o.value}),$("#modal-add").modal("show");let c=$("#formAdd"),y=c.find("#gambar"),S=c.find("#photo");c.on("submit",function(m){m.preventDefault();let D=c.serializeArray(),u=new FormData;D.forEach(a=>{console.log(a.name),u.append(a.name,a.value)}),u.append("gambar",y[0].files[0]),u.append("photo",S[0].files[0]),g("add",u).then(a=>{console.log(a[0].code),a[0].code==401?Swal.fire({icon:"warning",title:"Error",text:"waktu sesi anda sebagai admin telah habis, silahkan login kembali"}).then(r=>{r.isConfirmed&&(f("modal-add","formAdd"),$("#renderKelas").html(a.html))}):a[0].code==400?Swal.fire({icon:"warning",title:"Data Corrected",text:"Opps Kelas Sudah Tersedia"}).then(r=>{r.isConfirmed&&(f("modal-add","formAdd"),$("#renderKelas").html(a.html))}):a[0].code==0?Swal.fire({icon:"warning",title:"token",text:"Opps Tidak Valid"}).then(r=>{r.isConfirmed&&(f("modal-add","formAdd"),$("#renderKelas").html(a.html))}):Swal.fire({icon:"success",title:"Data Updated",text:"berhasil nambah kelas"}).then(r=>{r.isConfirmed&&(f("modal-add","formAdd"),$("#renderKelas").html(a.html))})}).catch(a=>{if(console.log(a),a.responseJSON)if(console.log(a.responseJSON.errors),a.responseJSON.errors){const r=a.responseJSON.errors;let w="";for(const p in r)w+=`${p}: ${r[p][0]}
`;Swal.fire({icon:"warning",title:"Input Corrected",text:w}).then(p=>{p.isConfirmed})}else Swal.fire({icon:"warning",title:"Form",text:"Ada kesalahan dalam pengisian form"}).then(r=>{r.isConfirmed});else Swal.fire({icon:"warning",title:"Proccesing Data",text:"Ada kesalahan dalam Server"}).then(r=>{r.isConfirmed})})})}).fail(t=>{console.log(t)})});$("#renderKelas").on("click",".btn-delete",function(n){n.preventDefault(),console.log("hellos");let t={kelas_id:$(this).data("id"),category:$(this).data("category")};$("#modal-hapus").modal("show"),$("#catgeoriDeleteForm").on("submit",function(o){o.preventDefault(),g("delete",t).then(l=>{Swal.fire({icon:"success",title:"Hapus",html:"<span> Yangkin Menghapus Data Ini</span>"}).then(e=>{e.isConfirmed&&(f("modal-hapus","catgeoriDeleteForm"),$("#renderKelas").html(l.html))})}).catch(l=>{console.log(l)})})});$("#renderKelas").on("click",".btn-edit",function(n){n.preventDefault(),v("editkelas",$(this).data("slug")).done(t=>{$("#modal-content").html(t.html),$("#summernoteEdit").summernote({placeholder:"Isi Disnini",tabsize:2,focus:!0,height:100}),$("#summernoteProfileEdit").summernote({placeholder:"Isi Disnini",tabsize:2,focus:!0,height:100});let o=$(".add"),l=10,e=1,s=$(".wrapper"),i=`
            <div class="d-flex justify-content-between gap-1 mt-2">
                    <input name="kurikulum[]" id="" type="text" placeholder="Name" class="required-entry form-control">
                    <a class="btn btn-danger remove" href="javascript:void()0" >Remove</a>
            </div>
        `;$(o).click(function(d){d.preventDefault(),console.log("hellos"),e<l&&(e++,$(s).append(i))}),$(s).on("click",".remove",function(d){d.preventDefault(),$(this).parent("div").remove(),e--}),$("#modal-edit").modal("show")}).fail(t=>{console.log(t)})});$(document).on("submit","#formEdit",function(n){n.preventDefault();let t=$("#formEdit"),o=t.find("#gambar"),l=t.find("#photo"),e=$("#formEdit").serializeArray(),s=new FormData;for(let i=0;i<e.length;i++)s.append(e[i].name,e[i].value);s.append("gambar",o[0].files[0]),s.append("photo",l[0].files[0]),g("edit",s).then(i=>{$("#renderKelas").html(i.html)}).catch(i=>{console.info("error",i)})});$(".btn-cancel").on("click",function(){$("#modal-content").empty(),$("#modal-content-add").empty()});function g(n=null,t=null){if(n=="add")return new Promise((o,l)=>{$.ajax({url:h+"/kelas",type:"POST",data:t,dataType:"json",contentType:!1,processData:!1,beforeSend:function(){Swal.fire({title:"Please Wait !",allowOutsideClick:!1,showConfirmButton:!1,onBeforeOpen(){Swal.showLoading()},timer:5e3})},success:e=>{o(e)},error:e=>{l(e)}})});if(n=="edit")return new Promise((o,l)=>{$.ajax({url:h+"/kelas/"+t.get("id"),type:"POST",data:t,dataType:"json",contentType:!1,processData:!1,beforeSend:function(){Swal.fire({title:"Please Wait !",allowOutsideClick:!1,showConfirmButton:!1,onBeforeOpen(){Swal.showLoading()},timer:4e3})},success:e=>{o(e)},error:e=>{l(e)}})});if(n=="delete")return new Promise((o,l)=>{$.ajax({url:h+"/kelas/"+t.kelas_id,type:"DELETE",data:{category:t.category},beforeSend:function(){Swal.fire({title:"Please Wait !",allowOutsideClick:!1,showConfirmButton:!1,onBeforeOpen(){Swal.showLoading()},timer:4e3})},success:e=>{o(e)},error:e=>{l(e)}})});if(n=="detail")return new Promise((o,l)=>{$.ajax({url:h+"/api/kelas/"+t.slug,type:"GET",beforeSend:function(){Swal.fire({title:"Please Wait !",allowOutsideClick:!1,showConfirmButton:!1,onBeforeOpen(){Swal.showLoading()},timer:4e3})},success:function(e){o(e)},error:function(e){l(e)}})})}function v(n=null,t=null){if(n=="editkelas")return $.ajax({url:`${k}/form/edit-kelas/${t}`,type:"GET"});if(n=="addkelas")return $.ajax({url:`${k}/form/add-kelas`,type:"GET"})}function f(n,t){$(`#${n}`).modal("hide"),$(`#${t}`)[0].reset()}