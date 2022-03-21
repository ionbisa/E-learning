var save_method, table;

//Menampilkan data ke tabel dengan plugin dataTable
$(function(){
   table = $('.table').DataTable({
      "processing" : true,
      "ajax" : {
         "url" : "ajax/ajax_siswa.php?action=table_data",
         "type" : "POST"
      }
   });
});

//Ketika tombol tambah diklik
function form_add(){
   save_method = "add";
   $('#nis').removeAttr('readonly');
   $('#modal_siswa').modal('show');
   $('#modal_siswa form')[0].reset();
   $('.modal-title').text('Tambah Siswa');
}
	
//Ketika tombol edit diklik
function form_edit(id){
   save_method = "edit";
   $('#modal_siswa form')[0].reset();
   $.ajax({
      url : "ajax/ajax_siswa.php?action=form_data&id="+id,
      type : "GET",
      dataType : "JSON",
      success : function(data){
         $('#modal_siswa').modal('show');
         $('.modal-title').text('Edit Siswa');

         $('#nis').val(data.nis).attr('readonly',true);
         $('#nama').val(data.nama);
         $('#tl').val(data.tmpt_lahir);
         $('#tgl').val(data.tgl_lahir);
         $('#jk').val(data.jk);
         $('#kelas').val(data.id_kelas);
      },
      error : function(){
         alert("Tidak dapat menampilkan data!");
      }
   });
}

//Ketika tombol simpan diklik
function save_data(){
	var reg = /^[a-zA-Z .]*$/;
    var nama = $('#nama').val();
    var tempat = $('#tl').val();
    var id = $('#nis').val();
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
		  url = "ajax/ajax_siswa.php?action=insert";
	   else url = "ajax/ajax_siswa.php?action=update";
	   $.ajax({
		  url : url,
		  type : "POST",
		  data : $('#modal_siswa form').serialize(),
		  success : function(data){
			 if(data=="ok"){
				$('#modal_siswa').modal('hide');
				table.ajax.reload();
			 }else{
				alert(data);
				$('#nis').focus();
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
         url : "ajax/ajax_siswa.php?action=reset&id="+id,
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

//Ketika tombol hapus diklik
function delete_data(id){
   if(confirm("Apakah yakin data akan dihapus?")){
      $.ajax({
         url : "ajax/ajax_siswa.php?action=delete&id="+id,
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

//Ketika tombol Cetak Kartu diklik
function form_print(){
   $('#modal_print').modal('show');
   $('.modal-title').text('Cetak Kartu tugas');
   $('#modal_print form')[0].reset();
}

//Ketika tombol Cetak pada modal diklik
function print_data(){
   $('#modal_print').modal('hide');
window.open("export/pdf_kartu.php?kelas="+$('#kelas_print').val(), "Cetak Kartu tugas", "height=650, width=1024, left=150, scrollbars=yes");
   return false;
}

//Ketika tombol import diklik
function form_import(){
   $('#modal_import').modal('show');
   $('.modal-title').text('Import Excel');
   $('#modal_import form')[0].reset();
}

//Ketika tombol import pada modal diklik
function import_data(){
   var formdata = new FormData();      
   var file = $('#file')[0].files[0];
   formdata.append('file', file);
   $.each($('#modal_import form').serializeArray(), function(a, b){
      formdata.append(b.name, b.value);
   });
   $.ajax({
      url: 'ajax/ajax_siswa.php?action=import',
      data: formdata,
      processData: false,
      contentType: false,
      type: 'POST',
      success: function(data) {
         if(data=="ok"){
            $('#modal_import').modal('hide');
            table.ajax.reload();
         }else{
            alert(data);
         }
      },
      error: function(data){
         alert('Tidak dapat mengimport data!');
      }
   });
   return false;
}
