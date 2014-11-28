<?php
	$target_dir="pictmp/";
	$target_file = $target_dir . date("mdy-hms");
	$uploadOk=1;
	$imageFileType=pathinfo($_POST["imgfile"]["name"]);
	$imageFileType=$imageFileType['extension'];
	echo $imageFileType;
//	if(isset($_POST["submit"])){
/*		$check = getimagesize($_FILES["imgfile"]["tmp_name"]);
		if($check == false)	echo "error, file is not an image.";
		else if(move_uploaded_file($_FILES["imgfile"]["tmp_name"], $target_file))
			echo $target_file;
		else
			echo "upload error";
			
//	}
//	echo "error wrong";
?>
