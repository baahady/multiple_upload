<?php
echo"<pre>";
print_r($_FILES);
$count = count($_FILES['image']['name']);
$canUpload = 1;
for($i=0;$i<$count;$i++){

	if($i==0){
		$p="personal";
	}elseif($i==1){
		$p="visa";
	}elseif($i==2){
		$p="parent";
	}

	if($_FILES['image']['name'][$p] !== ""){
	    $finfo = finfo_open(FILEINFO_MIME_TYPE);
	    $mime = finfo_file($finfo, $_FILES['image']['tmp_name'][$p]);
	    finfo_close($finfo);
	    if($mime!="image/jpeg" && $mime!="application/pdf" && $mime!="application/png"){
	    	$canUpload = 0;
	    }
	    
	}

	if($canUpload==0){
		echo"problem";
	}else{
		$ext = pathinfo($_FILES['image']['name'][$p], PATHINFO_EXTENSION);
		$newname = rand().time().".".$ext;
		move_uploaded_file($_FILES['image']['tmp_name'][$p], "upload/$newname");	
	}

}
?>