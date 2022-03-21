var save_method, table;

//Menampilkan data dengan plugin datatables
$(function(){
   table = $('.table').DataTable({
      "processing" : true,
      "ajax" : {
         "url" : "ajax/ajax_kelas.php?action=table_data",
         "type" : "POST"
      }
   });
});



//Ketika tombol tambah diklik
function form_add(){
   save_method = "add";
   $('#modal_kelas').modal('show');
   $('#modal_kelas form')[0].reset();
   $('.modal-title').text('Tambah Kelas');
}
	
//Ketika tombol edit diklik
function form_edit(id){
   save_method = "edit";
   $('#modal_kelas form')[0].reset();
   $.ajax({
      url : "ajax/ajax_kelas.php?action=form_data&id="+id,
      type : "GET",
      dataType : "JSON",
      success : function(data){
         $('#modal_kelas').modal('show');
         $('.modal-title').text('Edit Kelas');
			
         $('#id').val(data.id_kelas);
         $('#kelas').val(data.kelas);
      },
      error : function(){
         alert("Tidak dapat menampilkan data!");
      }
   });
}

//Ketika tombol simpan diklik
function save_data(){
   if(save_method == "add") url = "ajax/ajax_kelas.php?action=insert";
   else url = "ajax/ajax_kelas.php?action=update";
   
   $.ajax({
      url : url,
      type : "POST",
      data : $('#modal_kelas form').serialize(),
      success : function(data){
         $('#modal_kelas').modal('hide');
         table.ajax.reload();
      },
      error : function(){
      alert("Tidak dapat menyimpan data!");
		}			
   });
   return false;
}
	
//Ketika tombol hapus diklik
function delete_data(id){
   if(confirm("Apakah yakin data akan dihapus?")){
      $.ajax({
         url : "ajax/ajax_kelas.php?action=delete&id="+id,
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
