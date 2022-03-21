var save_method, table;

//Ketika tombol tambah diklik
function form_add(){
   save_method = "add";
   $('#modal_diskusi').modal('show');
   $('#modal_diskusi form')[0].reset();
   $('.modal-title').text('Tambah Diskusi');
}

function form_edit(id){
   save_method = "edit";
   $('#modal_diskusi form')[0].reset();
   $.ajax({
      url : "ajax/ajax_diskusi.php?action=form_data&id="+id,
      type : "GET",
      dataType : "JSON",
      success : function(data){
         $('#modal_diskusi').modal('show');
         $('.modal-title').text('Edit Pesan');
			
         $('#id').val(data.id_diskusi);
         $('#pesan').val(data.isi);
      },
      error : function(){
         alert("Tidak dapat menampilkan data!");
      }
   });
}

//Ketika tombol simpan pada modal diklik
function save_data(){
   tugas = $('#id_tugas').val();
   kelas = $('#id_kelas').val();
   if(save_method == "add") {
      url = "ajax/ajax_diskusi.php?action=insert&tugas="+tugas+"&kelas="+kelas;
   }
   else { url = "ajax/ajax_diskusi.php?action=update"; }

   $.ajax({
      url : url,
      type : "POST",
      data : $('#modal_diskusi form').serialize(),
      success : function(data){
		if(data=="ok"){
		  $('#modal_diskusi').removeClass('fade');$('#modal_diskusi').modal('hide');
		  $('#content').load('view/view_diskusi.php?tugas='+tugas+'&kelas='+kelas);
		}else{
            alert(data);
        }
      },
      error : function(){
         alert("Tidak dapat menyimpan data!");
      }			
   });
   return false;
}

function delete_data(id){
   tugas = $('#id_tugas').val();
   kelas = $('#id_kelas').val();
   if(confirm("Apakah yakin pesan akan dihapus?")){
      $.ajax({
         url : "ajax/ajax_diskusi.php?action=delete&id="+id,
         type : "GET",
         success : function(data){
			$('#content').load('view/view_diskusi.php?tugas='+tugas+'&kelas='+kelas);
		  },
         error : function(){
           alert("Tidak dapat menghapus data!");
         }
      });
   }
}
