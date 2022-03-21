var table;

$(function(){
   var tugas = $('#id_tugas').val();
   var kelas = $('#id_kelas').val();
   table = $('.table').DataTable({
      "processing" : true,
      "pageLength" : 50,
      "paging" : false,
      "ajax" : {
         "url" : "ajax/ajax_nilai.php?action=table_data&tugas=" + tugas + "&kelas=" + kelas,
         "type" : "POST"
      }
   });
});

function export_nilai(){
   tugas = $('#id_tugas').val();
   kelas = $('#id_kelas').val();
   window.open("export/excel_nilai.php?tugas=" + tugas + "&kelas=" + kelas, "Export Nilai");
}
