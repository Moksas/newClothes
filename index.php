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
	<link rel="stylesheet" type="text/css" href="css/search.css"/>
	<link rel="stylesheet" type="text/css" href="css/jquery.modal.css" media="screen"/>
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
	<script src="js/masonry.pkgd.min.js"></script>
	<script src="js/jquery.modal.min.js"></script>
	<script src="js/foldtoggle.js"></script>
	<script src="js/login.js"></script>
 <script src="js/search.js"></script>

	<script>
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



<body>
<div id="header" style="width:100%; height:327px">
	 <img src="pics/LOGO DESIGN.png" height="327" width="293"style=" display: inline;"  >
	
	
	<div id="Logo" style="font-size:64px; color:#57869A;position:absolute;left:38%; top:20% " >
		宅 宅 的 平 價 時 尚
	
	</div>
</div>
	<div id="left">
		<ul>
			<li><a id="Loginbutton"  href="#loginform" rel="modal:open" onClick="loginOpen();">Login</a></li>
			 <li id="topclothesheader" ><a>上衣</a></li>
			 <div id="topclothes">
			      <a href="./index.php?key=針織衫">針織衫</a><br/>
			      <a href="./index.php?key=襯衫">襯衫</a><br/>
			</div>
			 <li id="coatheader" ><a>外套</a></li>
                         <div id="coat">
                              <a href="./index.php?key=風衣">風衣</a><br/>
                              <a href="./index.php?key=夾克">夾克</a><br/>
                            
			</div>
			 <li id="underclothesheader" ><a>下半身</a></li>
                         <div id="underclothes">
                              <a href="./index.php?key=牛仔褲">牛仔褲</a><br/>
                              <a href="./index.php?key=休閒褲">休閒褲</a><br/>
                              <a href="./index.php?key=休閒鞋">休閒鞋</a><br/>
                              <a href="./index.php?key=運動鞋">運動鞋</a><br/>
                              <a href="./index.php?key=皮鞋">皮鞋</a><br/>
			</div>
		</ul>
	      <form  >
		           <input type="text" name="key" class="search-input" placeholder="Search..." />
		                  <input class="search-btn" type="submit" value="Go" />
		   </form>

	</div>

	<div id="container">
<?php
	session_start();
	if(isset($_SESSION['id']) && !empty($_SESSION['id'])){
		echo "<script>location.replace('user.php');</script>";
		return;
	}
	require_once("db_const.php");
	$keyWord = htmlspecialchars($_GET['key']);
	$location = $_GET['loc'];
	$sql="SELECT `pictures`.*, `user`.name FROM `pictures`,`user` where `pictures`.userid=`user`.id ";
	if(!$keyWord) ;
	else if($location=="1")
		$sql.="AND `pictures`.`top` LIKE '%".$keyWord."%'";
	else if($location=="2")
		$sql.="AND `pictures`.`down` LIKE '%".$keyWord."%'";
	else
		$sql.="AND (`pictures`.`top` LIKE '%".$keyWord."%' OR `pictures`.`down` LIKE '%".$keyWord."%')";
	$sql.=" order by `pictures`.id DESC";
		
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
		echo '<div style="color:#463837;text-align:left;padding:0 0 10px 30px;">Upload from: '.$rows['name'].'</div>';
		echo '</div>';
		echo '</div>';
		++$i;
		if($i>3) $i=1;
	}
?>
	</div>
	<div id="loginform" class="modal">
		<div id="facebook">
			<i class="fa fa-facebook"></i>
			<div id="connect">Connect with Facebook</div>
		</div>
		<div id="mainlogin">
			<div id="or">or</div>
			<h1>Login to Upload your clothes</h1>
			<form id="LoginLogin" action="#">
				<input type="text" id="text" placeholder="your id" value="" required>
				<input type="password" id="password" placeholder="password" value="" required>
				<span id="formHide" style="display:none">
					<input type="password" id="password2" placeholder="password again" value="">
					<input type="text" id="name" placeholder="name" value="">
				
				</span>
				<button type="submit"><i class="fa fa-arrow-right"></i></button>
			</form>
			<div id="note">
				<a href="#">new user?</a>
			</div>

		</div>
	</div>
</body>
