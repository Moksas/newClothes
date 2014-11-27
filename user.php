<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<meta http-equiv="keywords" content="快速穿搭,懶人搭配,穿搭入門,穿搭教學,穿搭分享,簡易穿搭,基礎穿搭,台南穿搭">
	<meta http-equiv="description" content="教你如何簡單穿搭，搜尋你擁有的衣物，快速找出適合且流行的的穿著搭配，讓你不用為此煩惱">
	<meta name="Robots" content="all">
	<title>宅宅的平價時尚穿搭</title>
	<link rel="stylesheet" type="text/css" href="css/main.css"/>
	<link rel="stylesheet" type="text/css" href="css/tag.css"/>
	<link rel="stylesheet" type="text/css" href="css/login.css"/>
	<link rel="stylesheet" type="text/css" href="css/font-awesome.css"/>
	<link rel="stylesheet" type="text/css" href="css/jquery.modal.css" media="screen"/>
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
	<script src="js/masonry.pkgd.min.js"></script>
	<script src="js/jquery.modal.min.js"></script>
	<script src="js/foldtoggle.js"></script>
	<script>
docReady( function() {
  $('#Loginbutton').click(function(){
 	 $('#loginform').modal({
 	         fadeDuration: 250,
 	   	      fadeDelay: 1.5
 	 });
	 return false;
  });
});
jQuery(window).load(function(){
	$(".item").each(function(){
		var H = $(this).height();
//		var H = $(this).find("img").height();
		$(this).height(H+15);
	});
  var container = document.querySelector('#container');
  var msnry = new Masonry( container, {
    columnWidth: 350
  });
});
	</script>
</head>


<div style="width:100%;">
test header
</div>

<body>
	<div id="left">
<?php
	session_start();
	if(!(isset($_SESSION['id']) && !empty($_SESSION['id']))){
		echo "<script>location.replace('./');</script>";
		return;
	}
	require_once("db_const.php");
	$sql="SELECT `name` FROM `user` WHERE `id`=".$_SESSION['id'];
	$result=$mysqli->query($sql);
	$row=$result->fetch_array();
	echo "<h1>Hello ".$row['name']."~</h1>";
?>
		<ul>
			<li><a id="Loginbutton"  href="#Uploadform" rel="modal:open">Upload</a></li>
			<li><a href="#Settingform" rel="modal:open">Setting</a></li>
			<li><a href="logout.php">Logout</a></li>
		</ul>
	</div>
	<div id="container">
<?php
	$sql="SELECT * FROM `pictures` where `userid`=".$_SESSION['id']." order by `id` DESC";
		
	$result=$mysqli->query($sql);

	$i=1;
	while($rows=$result->fetch_array()){
	    echo '<div class="item h'.$i.'">';
		echo '<img src="'.$rows['path'].'"/>';
		echo '<div class="content">';
		echo '<ul class="tags green">';
		$tmp = $rows['top'];
		$tok = strtok($tmp, ";");
		while($tok !== false){
			if($tok !== ' ')
				echo '<li><a href="./index.php?key='.$tok.'&loc=1">'.$tok.'</a><span></span></li>';
			$tok = strtok(";");
		}
		echo '</ul>';
		echo '<ul class="tags blue">';
		$tmp = $rows['down'];
		$tok = strtok($tmp, ";");
		while($tok !== false){
			if($tok !== ' ')
				echo '<li><a href="./index.php?key='.$tok.'&loc=2">'.$tok.'</a><span></span></li>';
			$tok = strtok(";");
		}
		echo '</ul>';
		echo '<div style="color:#463837;text-align:left;padding:0 0 10px 30px;">Upload from: '.$row['name'].'</div>';
		echo '</div>';
		echo '</div>';
		++$i;
		if($i>3) $i=1;
	}
?>
	</div>
	<div id="Settingform" class="modal" action="user.php" method="post">
		<div id="facebook">
			<i class="fa fa-facebook"></i>
			<div id="connect">Connect with Facebook</div>
		</div>
		<div id="mainlogin">
			<div id="or">or</div>
			<h1>Change name~</h1>
			<form action="#">
				<button type="submit"><i class="fa fa-arrow-right"></i></button>
			</form>
<!--			<div id="note">
				<a href="#">Forgot your password?</a>
			</div>
-->
		</div>
	</div>
</body>

