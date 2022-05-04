<?php
ini_set('max_execution_time', 0); // 0 = Unlimited
include("config.inc.php");
include("createpytrainpickle.php");
  
  $namefield  = $_REQUEST['field'];
  $sfield = $_REQUEST['shortfield'];
  $model  = $_REQUEST['model'];

  if($model == "Support vector machine"){
    $sModel = "svm";
  }elseif($model == "Dicision tree"){
    $sModel = "tree";
  }elseif($model == "Naive bayes"){
    $sModel = "GaussianNB";
  }elseif($model == "Ramdom forest"){
    $sModel = "RandomForestClassifier";
  }

  #echo $namefield;
  #echo $sfield;
  #echo $model;

  $sql = "SELECT id, field_id, field_name, sfield  FROM fields WHERE field_name='$namefield'";
  $result = mysqli_query($conn, $sql);
  $check = mysqli_num_rows($result);
  if (mysqli_num_rows($result) > 0) {
      // output data of each row
      while($row = mysqli_fetch_assoc($result)) {
        $id = $row["id"];
        $field_id = $row["field_id"];
        $field_name = $row["field_name"];
      }
  } else {
      echo "0 results";
  }
  
  #echo $check;


  if($check == 1){ #กรณีที่มี field นั้นอยู่แล้ว

    $sql2 = "SELECT MAX(id)  FROM models";
    $result = mysqli_query($conn, $sql2);

    if (mysqli_num_rows($result) > 0) {
      // output data of each row
      while($row = mysqli_fetch_assoc($result)) {
      $max_model_id = $row["MAX(id)"];
      }
    } else {
      echo "0 results";
    } 
    $model_id = $max_model_id+1;
    $insert_model_id = "m"."$model_id";

    $sql3 = "INSERT INTO models (model_id, model_name, field_id) VALUES ('$insert_model_id','$model','$field_id')";
    if (mysqli_multi_query($conn, $sql3)) {
      #echo "New records created successfully";
    } else {
      echo "Error: " . $sql3 . "<br>" . mysqli_error($conn);
    }

  } else { #กรณีที่ไม่มี field นั้น

    $sql4 = "SELECT MAX(id)  FROM fields";
    $result = mysqli_query($conn, $sql4);

    if (mysqli_num_rows($result) > 0) {
      // output data of each row
      while($row = mysqli_fetch_assoc($result)) {
      $max_field_id = $row["MAX(id)"];
      }
    } else {
      echo "0 results";
    }

    $sql5 = "SELECT MAX(id)  FROM models";
    $result = mysqli_query($conn, $sql5);

    if (mysqli_num_rows($result) > 0) {
      // output data of each row
      while($row = mysqli_fetch_assoc($result)) {
      $max_model_id = $row["MAX(id)"];
      }
    } else {
      echo "0 results";
    }
    $model_id = $max_model_id+1;
    $field_id = $max_field_id+1;
    $insert_model_id = "m"."$model_id";
    $insert_field_id = "f"."$field_id";

    $sql6 = "INSERT INTO models (model_id, model_name, field_id) VALUES ('$insert_model_id','$model','$insert_field_id')";
    if (mysqli_multi_query($conn, $sql6)) {
      echo "New records created successfully";
    } else {
      echo "Error: " . $sql6 . "<br>" . mysqli_error($conn);
    }

    $sql7 = "INSERT INTO fields (field_id, field_name, sfield) VALUES ('$insert_field_id','$namefield','$sfield')";
    if (mysqli_multi_query($conn, $sql7)) {
      echo "New records created successfully";
    } else {
      echo "Error: " . $sql7 . "<br>" . mysqli_error($conn);
    }
  }

?>


            <?php

              $feature[] = array("lexical","grammar","lexical_grammar");
              for($i=0 ; $i<3 ; $i++) {
                createPyTrainPickle($feature[$i],$sModel,$sfield);
                $filename = $feature[$i]."_trainPickle_".$sModel."_".$sfield.".py";
                echo $filename;
                #exec("C:/xampp/htdocs/waranusmove/".$filename.'"');
              }
              #echo '<h2 class="'.'text-center text-uppercase text-secondary mb-0">Success</h2>';
              #echo "<meta http-equiv=\"refresh\" content=\"3; URL =index.php\">";
              
            ?>
          