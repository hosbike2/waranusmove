    <?php
    	$targetDir = 'textUpload/';
    	if (!empty($_FILES)) {
    	$targetFile = $targetDir.$_FILES['file']['name'];
    	move_uploaded_file($_FILES['file']['tmp_name'],$targetFile);
    }
    ?>