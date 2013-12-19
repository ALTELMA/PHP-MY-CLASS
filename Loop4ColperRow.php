<?php
$arr = array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17);
$col = ceil(count($arr) / 4);

$first = 1;

for($i = 0;$i <= $col;$i++){
	$last = $i * 4;
	if($i != 0){
		echo '<div style=\'display:blocks;margin:5px 0;border:solid 1px #CCC;\'>';
		for($j = $first;$j < $last;$j++){
			if(isset($arr[$j])){
				echo $arr[$j].'<br>';
			}
		}
		echo '</div>';
	}

	$first = $i * 4;
}
?>
