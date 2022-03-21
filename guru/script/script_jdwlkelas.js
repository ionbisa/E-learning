var save_method, table;

//Menampilkan data dengan plugin dataTable
$(function(){
   table = $('.table').DataTable({
      "processing" : true,
      "ajax" : {
         "url" : "ajax/ajax_jdwlkelas.php?action=table_data",
         "type" : "POST"
      }
   });
});
	
//Ketika tombol edit diklik
function form_edit(id){
   $.ajax({
      url : "ajax/ajax_jdwlkelas.php?action=form_data&id="+id,
      type : "GET",
      dataType : "JSON",
      success : function(data){
         $('#modal_jdwlkelas form')[0].reset();
         $('#modal_jdwlkelas').modal('show');
         $('.modal-title').text('Edit Kelas tugas');
			
         $('#id').val(id);
         var kelas = data.kelas.split(',');
         for(i=0; i<kelas.length; i++){
            $('[value='+kelas[i]+']').attr('checked', true);
         }
      },
      error : function(){
         alert('Tidak dapat menampilkan data');
      }
   });
	
   $('#kelas input').attr('checked', false);		
}

//Ketika tombol simpan diklik
function save_data(){
   url = "ajax/ajax_jdwlkelas.php?action=update";
   $.ajax({
      url : url,
      type : "POST",
      data : $('#modal_jdwlkelas form').serialize(),
      success : function(data){
         $('#modal_jdwlkelas').modal('hide');
         table.ajax.reload();
      },
      error : function(){
         alert("Tidak dapat menyimpan data!");
      }			
   });
   return false;
}
