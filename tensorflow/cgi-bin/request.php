<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js">
</script>

</head>
<body>
<?php

include "simplehtmldom_1_9_1/simple_html_dom.php";

//error_reporting(E_ALL);
//ini_set("display_errors", 1);

$url = $_POST["url"];
$html = file_get_html($url);
$count = 1;

$conn = mysqli_connect(
	"localhost",
	"cse20172134",
	"cse20172134",
	"db_cse20172134"
) or die("db fail");

foreach($html->find('img') as $img){
	$out = null;
	$src = $img->src;
	
	$src = "http:".$src;
	exec("python request.py $src", $out, $status);
	if($status == 0){

	echo "<img id = img_$count width = 500 height = 500 src = '".$src."'>";
        echo "<canvas id = myCanvas_$count width = '500' height= '500' >";
        echo "</canvas><br>";
        echo "<script>";
        echo "$(window).load(function(){";
        echo "var c = document.getElementById('myCanvas_$count');";
        echo "var ctx = c.getContext('2d');";
        echo "var img = document.getElementById('img_$count');";
        echo "ctx.drawImage(img,0,0,500,500);";
        echo "})";
        echo "</script>";
	
		$length = count($out);	
		for($i =0; $i < $length; $i++){
			if(!empty($out[0])){
			$arr = explode("|", $out[$i]);
			$val1 = $arr[0];
			$val2 = $arr[1];
			$val3 = $arr[2];
			$tmp_loc = explode(', ', $val3);
			$loc = array_map(function($e) {
					$e = str_replace('[', '', $e);
					$e = str_replace(']', '', $e);
					return $e;
				},$tmp_loc);
			echo "img_name : ".$src."<br>";
			echo "val1 : ". $val1."<br>";
			echo "val2 : ". $val2."<br>";
			echo "val3 : ". $val3."<br>";
			
			echo "<script>";
			echo "$(window).load(function(){";
			echo "var c = document.getElementById('myCanvas_$count');";
      			echo "var ctx = c.getContext('2d');";
			echo "ctx.strokeStyle = '#FF0000';";
			echo "ctx.lineWidth= 5;";
			echo "ctx.strokeRect(  ($loc[1] * 500 )   ,   ($loc[0]*500)  ,  (($loc[3]-$loc[1]) *500)  ,    (($loc[2]-$loc[0])*500)    );";

			
			echo "ctx.textBaseline = 'top';";
			echo "ctx.font = '20px Verdana';";
			echo "ctx.fillStyle = 'black';";
			echo "ctx.fillText( '$val1' , ($loc[1]*500), (($loc[0]*500) + 5) );";
			echo "ctx.fill();";
			echo "})";
			echo "</script>";
		

	
			$sql = "INSERT INTO result_table(url,class,score,position) select '".$src."','".$val1."','".$val2."','".$val3."' from dual where not exists (select url,class,score,position from result_table where url = '".$src."' and class = '".$val1."' and score = '".$val2."' and position = '".$val3."' );";
			$result = mysqli_query($conn,$sql);
			if($result === false)
				echo mysqli_error($conn);
			}
		}
		$count++;
	}
#echo "class: ".$out[0]."<br>";
#echo "score: ".$out[1]."<br>";
#echo "position: ".$out[2];
}

?>
</body>
</html>
