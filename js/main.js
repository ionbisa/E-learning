$(function(){
   $('#content').load('home.php');	
	
   $('.navigation').each(function(){
      $(this).click(function(){
         var link = $(this).attr('href');
         $('#content').load(link);
         return false;			
      });
   });	
});

function show_diskusi(kelas, tugas){
    $('#content').load('view/view_diskusi.php?tugas=' + tugas + '&kelas=' + kelas);
}

function show_detail(tugas){
   $('#content').load('detail.php?tugas='+tugas);	
}

function show_petunjuk(tugas){
   $('#content').load('petunjuk.php?tugas='+tugas);		
}

function show_tugas(tugas){
   $('#content').load('tugas.php?tugas='+tugas);	
   return false;
}

function selesai_tugas(tugas){
   $.ajax({
      url: "ajax_tugas.php?action=selesai_tugas",
      type: "POST",
      data: "tugas="+tugas,
      success: function(data){
         if(data=="ok"){
            $('#modal-selesai').modal('hide');
            $('#modal-selesai').on('hidden.bs.modal', function(){
               $('#content').load('home.php');
            });	
         }else{
            alert(data);
         }
      },
      error: function(){
         alert('Tidak dapat memproses nilai!');
      }
   });
   return false;
}