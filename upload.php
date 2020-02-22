<?php
echo"<pre>";
print_r($_FILES);
$count = count($_FILES['image']['name']);

for($i=0;$i<$count;$i++){
	$canUpload = 1;
	if($i==0){
		$p="personal";
	}elseif($i==1){
		$p="visa";
	}elseif($i==2){
		$p="parent";
	}
	############### check mime type
	if($_FILES['image']['name'][$p] !== ""){
	    $finfo = finfo_open(FILEINFO_MIME_TYPE);
	    $mime = finfo_file($finfo, $_FILES['image']['tmp_name'][$p]);
	    finfo_close($finfo);
	    if($mime!="image/jpeg" && $mime!="application/pdf" && $mime!="image/png"){
	    	$canUpload = 0;
	    	$message = "file format is incorrect";
	    }
	    
	}
	############### check mandatory fields
	if($p == "personal" && $_FILES['image']['name']['personal'] == ""){
	    	$canUpload = 0;
	    	$message = "Filling personal section is mandatory";	
	}elseif($p == "visa" && $_FILES['image']['name']['visa'] == ""){
	    	$canUpload = 0;
	    	$message = "Filling visa section is mandatory";		
	}
	############### upload files
	if($canUpload==0){
		echo $message;
		echo"<br>";
	}else{
		$ext = pathinfo($_FILES['image']['name'][$p], PATHINFO_EXTENSION);
		$newname = rand().time().".".$ext;
		move_uploaded_file($_FILES['image']['tmp_name'][$p], "upload/$newname");	
	}

}
?>