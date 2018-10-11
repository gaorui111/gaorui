<?php
header('content-type:text/html; charset=utf8');
function qianwen($n){
    for($i=1;$i<=$n;$i++){
        for($j=1;$j<=$i;$j++){
            echo $i.'*'.$j.'='.$i*$j."";
        }
        echo '<br>';
    }
}
echo qianwen(9);//数值为乘法最大值 因为我写的是9，所以最多到9*9=81
?>