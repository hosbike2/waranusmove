<?php
ini_set('max_execution_time', 0); // 0 = Unlimited
$sModel = "svm";
$sfield = "cs";

$feature = array("lexical","grammar","lexical_grammar");
#echo $feature[0];

#for($i=0 ; $i<3 ; $i++) {
	#createPyTrainPickle($feature[$i],$sModel,$sfield);
    $filename = $feature[0]."_trainPickle_".$sModel."_".$sfield.".py";
    echo $filename."</br>";
    exec("C:/xampp/htdocs/move_analysis/".$filename.'"');
 #}
?>