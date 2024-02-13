console.log("event.js loaded!");$(document).ready(function(){});let i=$("#table-event").DataTable({ajax:{deferLoading:-1,url:"http://sekolahskillapi.test/api/event/data-table",data:function(t){},type:"GET"},searching:!0,ordering:!1,lengthChange:!1,aLengthMenu:[[20,50,100],[20,50,100]],columns:[{title:"No",render:function(t,e,l,a){return a.row+a.settings._iDisplayStart+1}},{title:"Action",render:(t,e,l,a)=>`<a class="btn btn-warning btn-sm" mode="detail")">Detail</a>
             <a mode="edit" class="btn btn-primary btn-sm">Edit</a>
             <a mode="hapus" class="btn btn-danger btn-sm">Hapus</a>`,className:"text-nowrap"},{title:"Event",data:"event_name",className:"text-nowrap"},{title:"Tanggal Mulai",data:"event_date",className:"text-nowrap"},{title:"Jam Mulai",data:"event_jam_mulai",className:"text-nowrap"},{title:"Jam Akhir",data:"event_jam_akhir",className:"text-nowrap"}],buttons:[{text:'<i class="fa fa-plus"></i>',action:()=>{$("#add").modal("show")},titleAttr:"Add Kategori",className:"add_sample"}]});$("#table-event tbody").on("click","a",function(){let t=$(this).parents("tr");var e=i.row(t).data();let l=$(this).attr("mode");if(l=="detail"){console.log("detail",e);var a=null;a=`<div class='row'>
    <div class="col-md-7 py-1 px-1"> 
      <img style="width:200px" class="img" src="http://image-sekolahskill.test/${e.event_image}"/>
    </div>
    <div class="col-md-5">
      <ul>
        <li>${e.event_name}</li>
        <li>${e.event_pengisi}</li>
        <li>${e.event_date}</li>
        <li>${e.event_jam_mulai}</li>
        <li>${e.event_jam_akhir}</li>
        <li>${e.event_jabatan}</li>
        <li>${e.event_type}</li>
        <li>${e.event_location}</li>
      </ul>
    </div>
    </div>`,$("#detail-event").html(a),$("#detail").modal("show")}else l=="edit"?(console.log("edti",e),$("#edit").modal("show")):l=="hapus"&&(console.log("hapus",e),$("#hapus").modal("show"))});$("#addEvent").on("click",function(t){t.preventDefault(),$("#tambah").modal("show")});$("#event_description").summernote({placeholder:"Isi Disnini",tabsize:2,focus:!0,height:100});
