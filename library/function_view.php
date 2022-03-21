<?php
//Fungsi untuk membuat judul konten
function create_title($icon, $title){
   echo '<h3 class="title"><i class="glyphicon glyphicon-'.$icon.'"></i> '.$title.'</h3>';
}

//Fungsi untuk membuat tombol pada bagian atas tabel
function create_button($color, $icon, $text, $class = "", $action=""){
   echo '<a class="btn btn-'.$color.' '.$class.' btn-top pull-right" onclick="'.$action.'"><i class="glyphicon glyphicon-'.$icon.'"></i> '.$text.'</a>';
}

//Fungsi untuk membuat tabel
function create_table($header){
   echo'<hr/><div class="table-responsive">
   <table class="table table-striped" width="100%">
   <thead>
   <tr>
	<th style="width: 10px">No</th>';
	foreach($header as $h){
		echo '<th>'.$h.'</th>';
	}			
	
   echo '</tr>
   </thead>
   <tbody></tbody>
   </table>
   </div><br/>';
}


//Fungsi untuk membuat tombol aksi pada tabel
function create_action($id, $edit=true, $delete=true){
   $view = "";
   if($edit) $view .= ' <a class="btn btn-primary btn-edit" onclick="form_edit('.$id.')"><i class="glyphicon glyphicon-pencil"></i></a>';
   if($delete)	$view .= ' <a class="btn btn-danger btn-delete" onclick="delete_data('.$id.')"><i class="glyphicon glyphicon-trash"></i></a>';
   return $view;
 }
function create_actionedit($id, $edit=true){
   $view = "";
   if($edit) $view .= ' <a class="btn btn-primary btn-edit" onclick="form_edit('.$id.')"><i class="glyphicon glyphicon-pencil"></i></a>';
   return $view;
 }
function create_actiontambah($id, $edit=true, $delete=true, $reset=true){
   $view = "";
   if($edit) $view .= ' <a class="btn btn-primary btn-edit" onclick="form_edit('.$id.')"><i class="glyphicon glyphicon-pencil"></i></a>';
   if($delete)	$view .= ' <a class="btn btn-danger btn-delete" onclick="delete_data('.$id.')"><i class="glyphicon glyphicon-trash"></i></a>';
   if($reset)	$view .= ' <a class="btn btn-danger btn-refresh" onclick="reset_data('.$id.')"><i class="glyphicon glyphicon-refresh"></i></a>';
   return $view;
 }
?>
