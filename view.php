<html>
<head>
<title>Play video</title>
</head>
<body>
<?php
	include_once 'connect_db.php';
	$strSQL = "SELECT * FROM crud_video WHERE id = '".$_GET["id"]."' ";
	$objQuery = mysqli_query($strSQL) or die ("Error Query [".$strSQL."]");
	$objResult = mysqli_fetch_array($objQuery);
?>
<?php
    if(!empty($_GET['play'])){


	
	<div id="container"><a href="http://www.macromedia.com/go/getflashplayer">Get the Flash Player</a> to see this player.</div>
	<script type="text/javascript" src="swfobject.js"></script>
	<script type="text/javascript">
		var s1 = new SWFObject("player.swf","mediaplayer","500","500","8");
		s1.addParam('allowscriptaccess','always');
		s1.addParam("allowfullscreen","true");
		s1.addVariable("file","upload_file/<?php echo $objResult["filename"];?>");
		s1.addVariable('displayheight','240');
		s1.addVariable('autoscroll','true');
		s1.write("container");
    </script>
    
     } ?>
	
	<?php
	mysqli_close($objConnect);
	?>
</body>
</html>