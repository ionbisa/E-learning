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

//Ketika tombol edit diklik
function show_soal(tugas){
   $('#content').load('view/view_soal.php?tugas='+tugas);	
}

//Ketika nama kelas diklik
function show_nilai(kelas, tugas){
    $('#content').load('view/view_nilai.php?tugas=' + tugas + '&kelas=' + kelas);		
}

//Ketika nama kelas diklik
function show_diskusi(kelas, tugas){
    $('#content').load('view/view_diskusi.php?tugas=' + tugas + '&kelas=' + kelas);
}
