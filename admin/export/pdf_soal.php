<?php
session_start();
ob_start();
?>
<html>
<head>
   <style type="text/css">
      .box{
         border: 1px solid #000;
      }
      .header td{
         border-bottom: 1px solid #000;
      }
      .box td{
         padding: 5px 10px;
      }
   </style>
</head>
<body>

<?php
   
include "../../library/config.php";

$ru = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM tugas WHERE id_tugas='$_GET[tugas]'"));
echo '<hr/><div class="alert alert-info"><table width="100% no-ajax">
   <tr>
      <td>Judul tugas</td><td>:<b> '.$ru['judul'].'</b></td>
      <td width="15%"></td>
      <td>Tanggal</td><td>:<b> ' .tgl_indonesia($ru['tanggal']).' </b></td>
   </tr>
   <tr>
      <td>Nama Mapel</td><td>:<b> '.$ru['nama_mapel'].'</b></td>
      <td width="15%"></td>
      <td>Jml. Soal</td><td>:<b> '.$ru['jml_soal'].'</b></td>
   </tr>
</table>
<input type="hidden" id="id_tugas" value="'.$_GET['tugas'].'">
</div>';




  if($no%2==0) echo "</tr><tr>";
  $no++;

}
echo "</tr></table>";
?>
</body>
</html>

<?php
require_once('../../assets/html2pdf/html2pdf.class.php');
$content = ob_get_clean();
$html2pdf = new HTML2PDF('P','A4','en');
$html2pdf->WriteHTML($content);
$html2pdf->Output('Soal.pdf');
?>
