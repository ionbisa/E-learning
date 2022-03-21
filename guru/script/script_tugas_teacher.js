var table;

$(function(){
   table = $('.table').DataTable({
     "processing" : true,
     "ajax" : {
        "url" : "ajax/ajax_tugas_teacher.php",
        "type" : "POST"
     }
   });
});
