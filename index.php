<head>
	<script src="masonry.pkgd.min.js"></script>
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
	<style>
html, body{ width:100%; height:100%;}
#container{ width:80%; display: inline-block; }
#left{ width:18%; display: inline-block; }
.item{	width:350px; margin:0;}
.item *{width:350px;}
	</style>
	<script>
docReady( function() {
	$(".item").each(function(){
		var H = $(this).find("img").height();
		$(this).height(H);
	});
  var container = document.querySelector('#container');
  var msnry = new Masonry( container, {
    columnWidth: 350
  });
});
	</script>
</head>
<?php
	require_once("db_const.php");
	$mysqli=new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
	$sql="SELECT * FROM `pictures`";
	$result=$mysqli->query($sql);
?>
<body>
	<div id="left"></div>
	<div id="container">
<?php
	$i=1;
	while($rows=$result->fetch_array()){
	    echo '<div class="item h'.$i.'">';
		echo '<img src="'.$rows['path'].'"/>';
		echo '</div>';
		++$i;
		if($i>3) $i=1;
	}
?>
	</div>
</body>
