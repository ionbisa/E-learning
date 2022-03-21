var save_method, table;

//Menampilkan data dengan plugin dataTable
$(function(){
   table = $('.table').DataTable({
     "processing" : true,
     "ajax" : {
     "url" : "ajax/ajax_tugas_operator.php?action=table_data",
        "type" : "POST"
     }
   });
});
	
//Ketika nama kelas diklik
function edit_data(kelas, tugas){
   $.ajax({
      url : "ajax/ajax_tugas_operator.php?action=update&kelas=" + kelas + "&tugas=" + tugas,
   type : "GET",
   success : function(data){
      table.ajax.reload();
   },
      error : function(){
        alert('Tidak dapat mengubah data');
      }
   });		
}
