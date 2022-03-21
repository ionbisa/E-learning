var save_method, table;

//Menampilkan data dengan plugin dataTable
$(function(){
   var tugas = $('#id_tugas').val();
   table = $('.table').DataTable({
      "processing" : true,
      "ajax" : {
         "url" : "ajax/ajax_soal.php?action=table_data&tugas="+tugas,
         "type" : "POST"
      }
   });
});

//Ketika tombol tambah diklik
function form_add(){
   save_method = "add";
   $('#modal_soal').modal('show');
   tinymce_config();
   tinymce_config_simple();
   $('#soal, #pil_1, #pil_2, #pil_3, #pil_4, #pil_5').val('');
	
   $('#modal_soal form')[0].reset();
   $('.modal-title').text('Tambah Soal');
}
	
//Ketika tombol edit diklik
function form_edit(id){
   save_method = "edit";
   $('#modal_soal form')[0].reset();
   $.ajax({
      url : "ajax/ajax_soal.php?action=form_data&id="+id,
      type : "GET",
      dataType : "JSON",
      success : function(data){
         $('#modal_soal').modal('show');
         tinymce_config();
         tinymce_config_simple();
         $('.modal-title').text('Edit Soal');
			
         $('#id').val(data.id_soal);
         $('#soal').val(data.soal);
         $('#pil_1').val(data.pilihan_1);
         $('#pil_2').val(data.pilihan_2);
         $('#pil_3').val(data.pilihan_3);
         $('#pil_4').val(data.pilihan_4);
         $('#pil_5').val(data.pilihan_5);
         $('#kunci').val(data.kunci);
      },
      error : function(){
         alert("Tidak dapat menampilkan data!");
      }
   });
}

//Ketika tombol simpan pada modal diklik
function save_data(){
   tugas = $('#id_tugas').val();
   if(save_method == "add") {
      url = "ajax/ajax_soal.php?action=insert&tugas="+tugas;
   }
   else { url = "ajax/ajax_soal.php?action=update"; }

   $.ajax({
      url : url,
      type : "POST",
      data : $('#modal_soal form').serialize(),
      success : function(data){
         if(data=="ok"){
            $('#modal_soal').modal('hide');
            table.ajax.reload();
            
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
	
//Ketika tombol hapus diklik
function delete_data(id){
   if(confirm("Apakah yakin data akan dihapus?")){
      $.ajax({
         url : "ajax/ajax_soal.php?action=delete&id="+id,
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

//Konfigurasi tinyMCE dengan fitur full
function tinymce_config(){
   tinyMCE.init({
      selector: ".richtext",
      height: 150,
      images_dataimg_filter: function(img) {
    return img.hasAttribute('internal-blob');
  },
      setup: function (editor) {
         editor.on('change', function () {
            tinymce.triggerSave();
         });
      },
      plugins: [
         "advlist autolink lists link image charmap print preview anchor",
         "searchreplace visualblocks code fullscreen",
         "insertdatetime media table contextmenu paste imagetools responsivefilemanager tiny_mce_wiris"
      ],
      toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | responsivefilemanager tiny_mce_wiris_formulaEditor",
	      
      external_filemanager_path:"../assets/filemanager/",
      filemanager_title:"File Manager" ,
      external_plugins: { "filemanager" : "../filemanager/plugin.min.js"}
   });
}

//Konfigurasi tinyMCE tanpa menu bar
function tinymce_config_simple(){
   tinyMCE.init({
      selector: ".richtextsimple",
      height: 30,
      setup: function (editor) {
         editor.on('change', function () {
            tinymce.triggerSave();
         });
      },
      plugins: [
         "advlist autolink lists link image charmap print preview anchor",
         "searchreplace visualblocks code fullscreen",
         "insertdatetime media table contextmenu paste imagetools responsivefilemanager tiny_mce_wiris"
      ],
      toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | responsivefilemanager tiny_mce_wiris_formulaEditor",
	      
      external_filemanager_path:"../assets/filemanager/",
      filemanager_title:"File Manager" ,
      external_plugins: { "filemanager" : "../filemanager/plugin.min.js"},
      menubar: false
   });
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
	
   tugas = $('#id_tugas').val();
   $.ajax({
      url: 'ajax/ajax_soal.php?action=import&tugas='+tugas,
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

// TAMBAHAN PRINT

//Ketika tombol Cetak Kartu diklik
function form_print(){
   $('#modal_print').modal('show');
   $('.modal-title').text('Cetak soal tugas');
   $('#modal_print form')[0].reset();
}

//Ketika tombol Cetak pada modal diklik
function print_data(){
   $('#modal_print').modal('hide');
window.open("export/pdf_soal.php?kelas="+$('#kelas_print').val(), "Cetak soal tugas", "height=650, width=1024, left=150, scrollbars=yes");
   return false;
}