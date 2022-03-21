var menit, detik;
var tugas, sisa_waktu;

//Mengatur agar waktu tugas berjalan mundur
$(function(){		
   setInterval(function(){
	  menit = parseInt($('.menit').text())
      detik = parseInt($('.detik').text());
	  
      detik--;
      if(detik<0 && menit>0){
         menit--;
         detik = 59;
      }

      if(menit<=0) menit = 0;
      if(menit<10) menit = "0"+menit;
      if(detik<10) detik = "0"+detik;
		
      $('.menit').text(menit);
      $('.detik').text(detik);
      $('#sisa_waktu').val(menit+':'+detik);
		
      if(menit == "00" && detik == "00"){
         selesai();
         $('#modal-selesai .modal-title').text("Waktu Habis!");
         $('#modal-selesai .modal-body').text("Waktu Habis. Klik Selesai untuk memproses nilai!");
         $('#modal-selesai .btn-warning').hide();
      }
   }, 1000);
});

//Ketika tombol nomor soal atau tombol navigasi diklik
function tampil_soal(no){
   $('.blok-soal').removeClass('active');	
   $('.soal-'+no).addClass('active');	
}

//Ketika ragu-ragu dicentang
function ragu_ragu(no){
   if($('.tombol-'+no).hasClass('yellow')){
      $('.tombol-'+no).removeClass('yellow');
   }else{
      $('.tombol-'+no).addClass('yellow');
   }
}

//Ketika tugas selesai
function selesai(){
   $('#modal-selesai').modal({
      'show' : true,
      'backdrop' : 'static'
   });
}

//Ketika memilih jawaban
function kirim_jawaban(index, jawab){
   tugas = $('#tugas').val();
   sisa_waktu = $('#sisa_waktu').val();
   $.ajax({
      url: "ajax_tugas.php?action=kirim_jawaban",
      type: "POST",
      data: "tugas=" + tugas + "&index=" + index + "&sisa_waktu=" + sisa_waktu + "&jawab=" + jawab,
      success: function(data){
         if(data=="ok"){
            no = index+1;
            $('.tombol-'+no).addClass("green");
         }else{
            alert(data);
         }
      },
      error: function(){
         alert('Tidak dapat mengirim jawaban!');
      }
   });
}
