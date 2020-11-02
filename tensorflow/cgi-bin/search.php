<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</head>
<body>
<?php

include "simplehtmldom_1_9_1/simple_html_dom.php";

$obj = $_POST["obj"];
$prb = $_POST["prb"];
$count = 1;


$conn = mysqli_connect(
	"localhost",
	"cse20172134",
	"cse20172134",
	"db_cse20172134"
) or die("db fail");
$sql = "SELECT * FROM result_table where score >= '".$prb."' and class = '".$obj."';";
$result = mysqli_query($conn,$sql);
if($result === false)
	echo mysqli_error($conn);
else {
	$img = "first";
	while($row = mysqli_fetch_assoc($result)){
       
                $val3 = $row["position"];
                $tmp_loc = explode(', ', $val3);
                $loc = array_map(function($e) {
                        $e = str_replace('[', '', $e);
                        $e = str_replace(']', '', $e);
                        return $e;
                },$tmp_loc);


	       	$src = $row["url"];

		$val1 = $row["class"];

		if($img != $src){
		
			echo "<img id = img_$count width = 500 height = 500 src = '".$src."'>";
       			echo "<canvas id = myCanvas_$count width = '500' height= '500' >";
        		echo "</canvas><br>";
        		echo "<script>";
        		echo "$(window).load(function(){";
        		echo "var c = document.getElementById('myCanvas_$count');";
        		echo "var ctx = c.getContext('2d');";
        		echo "var src = document.getElementById('img_$count');";
        		echo "ctx.drawImage(src,0,0,500,500);";
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
		
		}
		else if($img == $src){
			$count --;
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
	
		
		}	
		$img = $src;
              	$val1 = $row["class"];
              	$val2 = $row["score"];

		
		echo "img_name : ".$src."<br>";
                echo "val1 : ". $val1."<br>";
                echo "val2 : ". $val2."<br>";
                echo "val3 : ". $val3."<br>";
	
		$count ++;	
      	}
		
}	
	//$cnt = mysqli_num_rows($result);	
	//echo $cnt;
	//for($i = 0; $i < $cnt ; $i++){
		

	//}
	/*
	echo "<img id = img_$count width = 500 height = 500 src = '".$src."'>";
	echo "<canvas id = myCanvas_$count width = '500' height= '500' >";
     	echo "</canvas><br>";
	echo "<script>";
 	echo "$(window).load(function(){";
        echo "var c = document.getElementById('myCanvas_$count');";
        echo "var ctx = c.getContext('2d');";
        echo "var src = document.getElementById('img_$count');";
        echo "ctx.drawImage(src,0,0,500,500);";	
	//echo "for(var i=0; i < $cnt ; i++){";
        //echo "ctx.strokeRect(($loc[0]*100),($loc[1]*100),($loc[2]*500),($loc[3]*500));";
	//echo "}";
	echo "})";
	echo "</script>";
	*/
/*
                echo "$(window).load(function(){";
                echo "var c = document.getElementById('myCanvas_$count');";
                echo "var ctx = c.getContext('2d');";
                echo "ctx.strokeRect(($loc[0]*100),($loc[1]*100),($loc[2]*500),($loc[3]*500));";
                echo "})";
*/ 


/*


foreach($html->find('img') as $img){
	$out = null;
	$src = $img->src;

	echo "<img id = img_$count width = 500 height = 500 src = '".$src."'>";// style = 'display' none;'>";
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
		$lec = [];
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
			echo "fillStyle = '#FF0000';";
			echo "ctx.strokeRect(($loc[0]*100),($loc[1]*100),($loc[2]*500),($loc[3]*500));";
			echo "})";
			echo "</script>";
			
			$sql = "INSERT INTO result_table(url,class,score,position) select '".$src."','".$val1."','".$val2."','".$val3."' from dual where not exists (select url,class,score,position from result_table where url = '".$src."' and class = '".$val1."' and score = '".$val2."' and position = '".$val3."' );";
			$result = mysqli_query($conn,$sql);
			if($result === false)
				echo mysqli_error($conn);
			}
		}
	:	$count++;
	}
#echo "class: ".$out[0]."<br>";
#echo "score: ".$out[1]."<br>";
#echo "position: ".$out[2];
}
*/
?>
</body>
</html>
