<!DOCTYPE html>
<?php

$link = mysql_connect('127.0.0.1', 'nmsl', 'nmsl');
mysql_set_charset('utf8', $link);

$db_selected = mysql_select_db('mysql_database', $link);

/*$longitude_east = $_GET['east'];
$longitude_west = $_GET['west'];
$latitude_north = $_GET['north'];
$latitude_south = $_GET['south'];*/

$longitude_east = $_GET['longitude_east'];
$longitude_west = $_GET['longitude_west'];
$latitude_north = $_GET['latitude_north'];
$latitude_south = $_GET['latitude_south'];
#$area = $_GET['area']; #longitude
#$area = $area*0.00000900900901; #transfer to meters

$datetime = $_GET['datetime'];
$datetime2 = $_GET['datetime2'];

if(!empty($_GET['datetime']) && !empty($_GET['datetime2'])){
	$query = "SELECT cid, vid, vpath, AsText(p), t_s, t_p, o, theta, r FROM smart_bike 
				WHERE x(p) <= '$longitude_east' 
					AND x(p) >= '$longitude_west' 
					AND y(p) <= '$latitude_north' 
					AND y(p) >= '$latitude_south'
					AND t_s >= '$datetime'
					AND t_s <= '$datetime2'
			 ";
}



$result = mysql_query($query, $link);

if(!$result){
	echo 'SQL search failed: ' . mysql_error();
	exit;
}
?>


<head>
<title>Lookup Results</title>

<meta charset="utf-8">
<meta name="viewport">
<meta http-equiv="Content-Type" content="width=device-width, initial-scale=1" >
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="/bootstrap.min.js"></script>

<style type="text/css">
	#video {
		position: relative;		
		width: 80px;
		height: 60px;
		z-index: 1;
		margin-top: 0%;
		margin-left: 100% ;
	}

	#refresh{
		margin-top:18px;
		width:5%;
		float: right;
	}

	thead{
		text-align: center;
	}

	td{
		text-align: center;
	}

	table{
		text-align:center;
	}
	th{
		text-align: center;
	}

</style>

<!-- Add jQuery basic library -->
<script type="text/javascript" src="jquery-lib.js"></script>
		
<!-- Add required fancyBox files -->
<link rel="stylesheet" href="fancybox/source/jquery.fancybox.css" type="text/css" media="screen" />
<script type="text/javascript" src="fancybox/source/jquery.fancybox.pack.js"></script>

<!-- Optional, Add fancyBox for media, buttons, thumbs -->
<link rel="stylesheet" href="fancybox/source/helpers/jquery.fancybox-buttons.css" type="text/css" media="screen" />
<script type="text/javascript" src="fancybox/source/helpers/jquery.fancybox-buttons.js"></script>
<script type="text/javascript" src="fancybox/source/helpers/jquery.fancybox-media.js"></script>
<link rel="stylesheet" href="fancybox/source/helpers/jquery.fancybox-thumbs.css" type="text/css" media="screen" />
<script type="text/javascript" src="fancybox/source/helpers/jquery.fancybox-thumbs.js"></script>

<!-- Optional, Add mousewheel effect -->
<script type="text/javascript" src="fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>	

</head>

<body>

<div id="refresh">

<img id ="rbtn" src="img/refresh2.jpg" alt="Smiley face" height="42" width="42">
</div>

<div class="container">
  <h2>Lookup Results</h2>
  <table class="table">
    <thead>
      <tr>
        <th>Camera ID</th>
        <th>Video ID</th>
        <th>Video Path</th>
		<th>Longitude / Latitude</th>
		<th>Start Time</th>
		<th>Video Time</th>
		<th>Orientation</th>
		<th>Viewing Angle</th>
		<th>Viewing Range</th>
		<th>Video</th>
      </tr>
    </thead>
<?php
$length_row = mysql_num_rows($result);
$length_column = mysql_num_fields($result);

#$string = $result[3];
#$token = strtok($string,"POINT( ");
#echo "$token<br>";

for($row=0; $row<$length_row; $row++){
	echo "<tr>";
	for($column=0; $column<$length_column; $column++){
#			echo "<td>" . $token . "</td>";
			echo "<td>" . mysql_result($result, $row, $column) . "</td>";
	}
	?>
	
	<td id="video">
	<a class="various" data-fancybox-type="iframe" href=<?php echo mysql_result($result, $row, 2) ?>><video width="80px" height="60px"><source src=<?php echo mysql_result($result, $row, 2) ?> type="video/mp4"></video><!--<img src="img/smart_bike.jpg" />--></a>
	</td>
	</tr>
<?php
}
?>
  </table>




</div>
</html>
<?php
$result = mysql_query('select * from smart_bike');
mysql_free_result($result);
mysql_close($link);
?>

<script type="text/javascript">
$(document).ready(function(){
$(".fancybox").fancybox({
openEffect  : 'none',
closeEffect : 'none',
iframe : {
preload: true
}
});
$(".various").fancybox({
maxWidth    : 800,
maxHeight    : 600,
fitToView    : true,
width        : '70%',
height        : '70%',
autoSize    : true,
closeClick    : false,
openEffect    : 'none',
closeEffect    : 'none'
});
$('.fancybox-media').fancybox({
		openEffect  : 'none',
		closeEffect : 'none',
		helpers : {
		media : {}
		}
});

$('#rbtn').click(function(){
	location.reload(true);
});

});
</script>

</body>
</html>
