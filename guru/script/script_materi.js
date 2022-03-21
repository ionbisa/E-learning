var save_method, table;

//Menampilkan data dengan plugin dataTable
$(function(){
   table = $('.table').DataTable({
      "processing" : true,
      "ajax" : {
         "url" : "ajax/ajax_materi.php?action=table_data",
         "type" : "POST"
      }
   });

   //Konfigurasi datepicker
   $('.datepicker').datepicker({
      format: 'yyyy-mm-dd', 
      autoclose: true
   });
});


//Ketika tombol import diklik
function form_import(){
   $('#modal_import').modal('show');
   $('.modal-title').text('Upload Materi');
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
      url: 'ajax/ajax_materi.php?action=import',
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
         alert('Tidak dapat upload data!');
      }
   });
   return false;
}