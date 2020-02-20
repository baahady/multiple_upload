<?php
echo"<pre>";
print_r($_FILES);
$count = count($_FILES['image']['name']);
for($i=0;$i<$count;$i++){

	if($i==0){
		$p="personal";
	}elseif($i==1){
		$p="visa";
	}elseif($i==2){
		$p="parent";
	}

	$ext = pathinfo($_FILES['image']['name'][$p], PATHINFO_EXTENSION);
	$newname = rand().time().".".$ext;
	move_uploaded_file($_FILES['image']['tmp_name'][$p], "upload/$newname");
}
?>