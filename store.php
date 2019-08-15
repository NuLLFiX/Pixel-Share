<?php
// api upload proccess
// setup
include 'config.php';

if (isset($_FILES['image']['name'])) {
    // handle upload
    // Valildate file with REAL Mime types
    $allowedmimetypes = $_CONFIG['allowed'];
    $filemimetype = @Mime($_FILES["image"]["tmp_name"]);
    // generate the random file name for the checks later....
    $pathinfo = pathinfo($_FILES["image"]["name"]);
    $filename = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',5)),0,5);
    $ext = $pathinfo['extension'];
	
if (in_array($filemimetype, $allowedmimetypes))
  {
  if ($_FILES["image"]["error"] > 0)
    {
    $error = 'A error occurred while trying to upload your image. (' . $_FILES["image"]["error"] . ')';
    }
  else
    {
    if (file_exists($_CONFIG['upload_dir'] . $filename . $ext))
      {
      $error = 'A error occurred while trying to upload your image. Please try again! (duplicate file)';
      }
    elseif ($_COOKIE['myuploads'] > 50) {
      $error = 'Maximum submission times reached please try again tomorrow!';
    }
    else
      {
        if(!isset($error)){
	//now that file is uploaded we ll pass the file info in the database
        $db = MyDB();
        $db->exec("INSERT INTO images (random_name, real_name, format, ext) VALUES ('".$filename."','".$pathinfo['basename']."','".$filemimetype."','".$ext."')");
        $db->close;
        move_uploaded_file($_FILES["image"]["tmp_name"], $_CONFIG['upload_dir'] . $filename . "." . $ext);
        }
        // cookie counter time!
        if(!isset($_COOKIE['myuploads'])){
        // firsttime cookie ;p
        setcookie ("myuploads", 1, time() + 86400); // set 1 day
        } else {
        $newcookie = $_COOKIE['myuploads'] + 1;
        setcookie ("myuploads", $newcookie, time() + 86400); // set 1 day cookie
        }
        // end cookies
      }
    }
  }
else
  {
  $error = 'An error occurred while trying to upload your image. (wrong format)';
  }
} else {
    echo 'You cannot use that page like so... check <a href="'.$_CONFIG['site_url'].'api.php">web api</a>';
}

// send json API reply
if(isset($error)) {
    $big_test = array(
        'success' => false,
        'payload' => $error
        );
    //echo json_encode($big_test);
    echo str_replace('\/','/',json_encode($big_test));
}
if($_FILES["image"]["error"] === 0 && !isset($error)){
    $big_test = array(
        'success' => true,
        'payload' => array(
        'uid' => $filename,
        'uri' => $_CONFIG['site_url'] . $_CONFIG['upload_dir'] . $filename .'.'. $ext,
        'link' => $_CONFIG['site_url'] . $filename,
        'name' => $pathinfo['basename'],
        'format' => $filemimetype
        )
    );
    //echo json_encode($big_test);
    echo str_replace('\/','/',json_encode($big_test));
}
?>
