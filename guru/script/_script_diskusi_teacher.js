var table;

$(function(){
   table = $('.table').DataTable({
     "processing" : true,
     "ajax" : {
        "url" : "ajax/ajax_diskusi_teacher.php",
        "type" : "POST"
     }
   });
});
