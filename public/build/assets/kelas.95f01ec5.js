let c="http://sekolahskillapi.test/api",p="http://admin-skill.test";$("#modalAdd").on("click",function(a){a.preventDefault(),h("addkelas").done(t=>{$("#modal-content-add").html(t.html);let n=document.getElementById("guru"),l=document.getElementById("namaPemateri");$("#summernote").summernote({placeholder:"Isi Disnini",tabsize:2,focus:!0,height:100}),$("#summernoteProfile").summernote({placeholder:"Isi Disnini",tabsize:2,focus:!0,height:100}),$("<input>").attr({type:"hidden",id:"idmapelo",name:"categorise_id",value:$(this).data("id"),readonly:!0}).appendTo("form");let e=$(".add"),i=10,o=1,s=$(".wrapper"),w=`
                            <div class="d-flex justify-content-between gap-1 mt-2">
                                    <input name="kurikulum[]" id="" type="text" placeholder="Name" class="required-entry form-control">
                                    <a class="btn btn-danger remove" href="javascript:void()0" >Remove</a>
                            </div>
                        `;$(e).click(function(d){d.preventDefault(),console.log("hellos"),o<i&&(o++,$(s).append(w))}),$(s).on("click",".remove",function(d){d.preventDefault(),$(this).parent("div").remove(),o--}),n.addEventListener("input",()=>{l.value=n.value}),$("#modal-add").modal("show");let u=$("#formAdd"),v=u.find("#gambar"),k=u.find("#photo");u.on("submit",function(d){d.preventDefault();let y=u.serializeArray(),m=new FormData;y.forEach(r=>{console.log(r.name),m.append(r.name,r.value)}),m.append("gambar",v[0].files[0]),m.append("photo",k[0].files[0]),f("add",m).then(r=>{console.log(r),Swal.fire({icon:"success",title:"Data Updated",text:r.message}).then(b=>{b.isConfirmed&&(g("modal-add","formAdd"),$("#renderKelas").html(r.html))})}).catch(r=>{console.log(r)})})}).fail(t=>{console.log(t)})});$("#renderKelas").on("click",".btn-delete",function(a){a.preventDefault(),console.log("hellos");let t={kelas_id:$(this).data("id"),category:$(this).data("category")};$("#modal-hapus").modal("show"),$("#catgeoriDeleteForm").on("submit",function(n){n.preventDefault(),f("delete",t).then(l=>{Swal.fire({icon:"success",title:"Hapus",html:"<span> Yangkin Menghapus Data Ini</span>"}).then(e=>{e.isConfirmed&&(g("modal-hapus","catgeoriDeleteForm"),$("#renderKelas").html(l.html))})}).catch(l=>{console.log(l)})})});$("#renderKelas").on("click",".btn-edit",function(a){a.preventDefault(),h("editkelas",$(this).data("slug")).done(t=>{$("#modal-content").html(t.html),$("#summernoteEdit").summernote({placeholder:"Isi Disnini",tabsize:2,focus:!0,height:100}),$("#summernoteProfileEdit").summernote({placeholder:"Isi Disnini",tabsize:2,focus:!0,height:100});let n=$(".add"),l=10,e=1,i=$(".wrapper"),o=`
            <div class="d-flex justify-content-between gap-1 mt-2">
                    <input name="kurikulum[]" id="" type="text" placeholder="Name" class="required-entry form-control">
                    <a class="btn btn-danger remove" href="javascript:void()0" >Remove</a>
            </div>
        `;$(n).click(function(s){s.preventDefault(),console.log("hellos"),e<l&&(e++,$(i).append(o))}),$(i).on("click",".remove",function(s){s.preventDefault(),$(this).parent("div").remove(),e--}),$("#modal-edit").modal("show")}).fail(t=>{console.log(t)})});$(document).on("submit","#formEdit",function(a){a.preventDefault();let t=$("#formEdit"),n=t.find("#gambar"),l=t.find("#photo"),e=$("#formEdit").serializeArray(),i=new FormData;for(let o=0;o<e.length;o++)i.append(e[o].name,e[o].value);i.append("gambar",n[0].files[0]),i.append("photo",l[0].files[0]),f("edit",i).then(o=>{$("#renderKelas").html(o.html)}).catch(o=>{console.info("error",o)})});$(".btn-cancel").on("click",function(){$("#modal-content").empty(),$("#modal-content-add").empty()});function f(a=null,t=null){if(a=="add")return new Promise((n,l)=>{$.ajax({url:c+"/kelas",type:"POST",data:t,dataType:"json",contentType:!1,processData:!1,beforeSend:function(){Swal.fire({title:"Please Wait !",allowOutsideClick:!1,showConfirmButton:!1,onBeforeOpen(){Swal.showLoading()},timer:5e3})},success:e=>{n(e)},error:e=>{l(e)}})});if(a=="edit")return new Promise((n,l)=>{$.ajax({url:c+"/kelas/"+t.get("id"),type:"POST",data:t,dataType:"json",contentType:!1,processData:!1,beforeSend:function(){Swal.fire({title:"Please Wait !",allowOutsideClick:!1,showConfirmButton:!1,onBeforeOpen(){Swal.showLoading()},timer:4e3})},success:e=>{n(e)},error:e=>{l(e)}})});if(a=="delete")return new Promise((n,l)=>{$.ajax({url:c+"/kelas/"+t.kelas_id,type:"DELETE",data:{category:t.category},beforeSend:function(){Swal.fire({title:"Please Wait !",allowOutsideClick:!1,showConfirmButton:!1,onBeforeOpen(){Swal.showLoading()},timer:4e3})},success:e=>{n(e)},error:e=>{l(e)}})});if(a=="detail")return new Promise((n,l)=>{$.ajax({url:c+"/api/kelas/"+t.slug,type:"GET",beforeSend:function(){Swal.fire({title:"Please Wait !",allowOutsideClick:!1,showConfirmButton:!1,onBeforeOpen(){Swal.showLoading()},timer:4e3})},success:function(e){n(e)},error:function(e){l(e)}})})}function h(a=null,t=null){if(a=="editkelas")return $.ajax({url:`${p}/form/edit-kelas/${t}`,type:"GET"});if(a=="addkelas")return $.ajax({url:`${p}/form/add-kelas`,type:"GET"})}function g(a,t){$(`#${a}`).modal("hide"),$(`#${t}`)[0].reset()}
