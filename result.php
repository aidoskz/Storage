<?php 


for($i=0; $i<count($_FILES['file']['name']); $i++) {
  //Get the temp file path
  $tmpFilePath = $_FILES['file']['tmp_name'][$i];

  //Make sure we have a filepath
  if ($tmpFilePath != ""){
    //Setup our new file path
    $folder = "upload/".date('Y/m/d/').md5(date('H:i:s'))."/";
						if(!is_dir($folder)) {
						mkdir($folder, 0755, true);
						}
    $newFilePath = $folder . $_FILES['file']['name'][$i];

    //Upload the file into the temp dir
    if(move_uploaded_file($tmpFilePath, $newFilePath)) {

      //Handle other code here

    }
  }
}