var save_method, table;
//Menerapkan plugin datatables
$(function(){
   table = $('.table').DataTable({
      "processing" : true,
      "ajax" : {
         "url" : "ajax/ajax_user.php?action=table_data",
         "type" : "POST"
      }
   });
   
});

//Tombol tambah diklik
function form_add(){
   save_method = "add";
   $('#idguru').removeAttr('readonly');
   $('#modal_user').modal('show');
   $('#modal_user form')[0].reset();
   $('.modal-title').text('Tambah Guru');
}

//Tombol edit diklik
function form_edit(id){
   save_method = "edit";
   $('#modal_user form')[0].reset();
   $.ajax({
      url : "ajax/ajax_user.php?action=form_data&id="+id,
      type : "GET",
      dataType : "JSON",
      success : function(data){
         $('#modal_user').modal('show');
         $('.modal-title').text('Edit Guru');
			
         $('#idguru').val(data.id_guru).attr('readonly',true);
         $('#nama').val(data.nama);
         $('#tl').val(data.tmptlahir);
         $('#tgl').val(data.tgllahir);
         $('#telp').val(data.telp);
         $('#jk').val(data.jk_guru);
         $('#keterangan').val(data.keterangan);
      },
      error : function(){
         alert("Tidak dapat menampilkan data!");
      }
   });
}

//Tombol simpan diklik
function save_data(){
	var reg = /^[a-zA-Z .]*$/;
    var tempat = $('#tl').val();
	var nama = $('#nama').val();
	if(!reg.test(nama)){
		alert('Hanya huruf yang diperbolehkan untuk nama!');
        $('#nama').focus();
	return false;
	}else if(!reg.test(tempat)){
		alert('Hanya huruf yang diperbolehkan untuk Tempat Lahir!');
        $('#tl').focus();		
	return false;
	}else{
	   if(save_method == "add")
		  url = "ajax/ajax_user.php?action=insert";
	   else url = "ajax/ajax_user.php?action=update";	
	   $.ajax({
		  url : url,
		  type : "POST",
		  data : $('#modal_user form').serialize(),
		  success : function(data){
			  if(data=="ok"){
				 $('#modal_user').modal('hide');
				 table.ajax.reload();
			  }else{
				  alert(data);
				  $('#idguru').focus();
			  }
		  },
		  error : function(){
			 alert("Tidak dapat menyimpan data!");
		  }			
	   });
	return false;
	}
}

//Ketika tombol reset diklik
function reset_data(id){
   if(confirm("Apakah yakin anda akan mereset password?")){
      $.ajax({
         url : "ajax/ajax_user.php?action=reset&id="+id,
         type : "GET",
         success : function(data){
            table.ajax.reload();
         },
         error : function(){
            alert("Tidak dapat mereset password!");
         }
      });
   }
}	

//Tombol hapus diklik
function delete_data(id){
   if(confirm("Apakah yakin data akan dihapus?")){
      $.ajax({
         url : "ajax/ajax_user.php?action=delete&id="+id,
         type : "GET",
         success : function(data){
            table.ajax.reload();
         },
         error : function(){
            alert("Tidak dapat menghapus data!");
         }
      });
   }
}

