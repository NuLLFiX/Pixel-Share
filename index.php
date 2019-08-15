<?php
// setup
include 'config.php';

if (isset($_FILES['image']['name'])) {
    // handle upload
    // Valildate file with REAL Mime types
    $allowedmimetypes = $_CONFIG['allowed'];
    $filemimetype = Mime($_FILES["image"]["tmp_name"]);
    // generate the random file name for the checks later....
    $pathinfo = pathinfo($_FILES["image"]["name"]);
    $filename = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',5)),0,5);
    $ext = $pathinfo['extension'];
	
if (in_array($filemimetype, $allowedmimetypes))
  {
  if ($_FILES["image"]["error"] > 0)
    {
    $error = '<div class="generror">A error occurred while trying to upload your image. (' . $_FILES["image"]["error"] . ')</div>';
    }
  else
    {
    if (file_exists($_CONFIG['upload_dir'] . $filename . $ext))
      {
      $error = '<div class="generror">A error occurred while trying to upload your image. Please try again! (duplicate file)</div>';
      }
    else
      {
	//now that file is uploaded we ll pass the file info in the database
        $db = MyDB();
        $db->exec("INSERT INTO images (random_name, real_name, format, ext) VALUES ('".$filename."','".$pathinfo['basename']."','".$filemimetype."','".$ext."')");
        $db->close;
        move_uploaded_file($_FILES["image"]["tmp_name"], $_CONFIG['upload_dir'] . $filename . "." . $ext);
        // cookie time!
        if(!isset($_COOKIE['myimages'])){
        // firsttime cookie ;p
        setcookie ("myimages", $filename, time()+60*60*24*30); // set 30 days cookie
        header('Location: ./'.$filename);
        } else {
        $newcookie = $filename."|".$_COOKIE['myimages'];
        setcookie ("myimages", $newcookie, time()+60*60*24*30); // set 30 days cookie
        header('Location: ./'.$filename);
        }
        // end cookies
      }
    }
  }
else
  {
  $error = '<div class="generror">A error occurred while trying to upload your image. (wrong format)</div>';
  }
}
// delete image function and sanitize input.
$delete = (isset($_GET['delete']))? filter_var ( $_GET['delete'], FILTER_SANITIZE_STRING) : null;
$pos = strpos($_COOKIE['myimages'], $delete);
if($pos !== false) {
    // delete it baby
    $db = MyDB();
    $results = $db->query('SELECT * FROM images WHERE random_name = "'.$delete.'"');
    $final = $results->fetch();
    if($final != false) {
       $db->exec('DELETE FROM images WHERE random_name = "'.$delete.'"');
       // delete real file
       $filename = $_CONFIG['upload_dir'].$final['random_name'].'.'.$final['ext'];
       @chmod($filename, 0666);
       @unlink($filename);
       	// cookie time!
	if(isset($_COOKIE['myimages'])) {
	$pieces = explode("|",$_COOKIE['myimages']);
	$key = array_search($final['random_name'], $pieces); // $key = 2;
	unset($pieces[$key]);
	$newcookie = implode("|", $pieces);
	setcookie ("myimages", $newcookie, time()+60*60*24*30); // set 30 days cookie
	}
    } else {}
    $db->close;
    $error = '<div class="gensuccess">Image removal successful.</div>';
} elseif ($delete != '') {
    $error = '<div class="generror">We cannot delete that, or you are not allowed to do it anyways...</div>';
}
?>
<!DOCTYPE html>
<?php echo "<!--\n\x20\x20   \x20\x20\x20\x20 \x20\x20\x20\x2e_\x5f\x20 .\x5f\x5f\x20 \x20_\x5f_\x5f_\x2e_\x5f\x20  \x20\x20\x20   \x20\x20 \x20 \x20 \x20\x20   \x20\x20  \x20\x20   \x20\n \x20____\x20 __ \x5f\x5f|  | \x7c\x20 |\x5f\x2f\x20\x5f_\x5f_\x5c_\x5f\x7c_\x5f \x20\x5f__  \x20\x5f\x5f\x5f_\x20\x20_\x5f\x5f\x5f   ___\x5f_\x20 \n\x20/    \x5c| \x20|\x20\x20\x5c \x20\x7c \x7c\x20 \x7c\\\x20  _\x5f\\\x7c  \\  \\/\x20\x20/\x20_/\x20_\x5f\x5f\x5c/\x20\x20_ \\ /\x20\x20\x20\x20 \\ \n\x7c \x20 \x7c\x20 \\  |\x20\x20\x2f\x20\x20|\x5f\x7c\x20\x20|_|\x20\x20\x7c\x20\x20|\x20 \x7c\x3e \x20\x20 <\x20 \x5c \x20\\__( \x20\x3c\x5f> \x29\x20\x20Y \x59  \x5c\n\x7c_\x5f_\x7c\x20 \x2f___\x5f/\x7c____/\x5f\x5f__\x2f__|\x20\x20\x7c__/__\x2f\x5c\x5f \x5c /\x5c__\x5f\x20\x20>\x5f_\x5f_/|_\x5f|_|\x20\x20\x2f\n\x20 \x20 \x20\\/    \x20  \x20        \x20\x20\x20\x20 \x20\x20      \x20 \\/ \x5c\x2f\x20\x20\x20\\\x2f  \x20 \x20  \x20    \x5c\x2f\x20\nCr\x65\x61ted by \x6e\x75\x6cl\x66i\x78 @\x20n\x75\x6clf\x69\x78.\x63\x6f\x6d\n-->";?>
<html>
<head>
<title>Share your images / photos / pictures / image / photo / picture - <?php echo $_CONFIG['site_name']; ?></title>
<meta content="image,images,photo,photos,picture,pictures,share,sharing,media,public,free,twitter,facebook,myspace,netlog,fast,easy" name="keywords" />
<meta content="One click sharing of images - no registration required!" name="description" />
<link href="css/pixel.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="header clear">
<a href="./">
<img class="logo" src="img/pix.png" title="pixel logo" />
</a>
</div>
    <?php if(isset($error)) {echo $error;}?>
<div class="border">
<div class="uploader">
<h3>Select image to share:</h3>
<div class="file" id="file">
<script type="text/javascript">
  //<![CDATA[
    var upload=(function(){
      function D(e,t){document.getElementById(e).style.display=t}
      return function(){
        D('file','none');D('loader','block');
        document.upload_image.submit()}})();
  //]]>
</script>
<form enctype="multipart/form-data" id="upload_image" method="post" name="upload_image" target="_self">
<input id="image" name="image" onchange="upload();" type="file" />
</form>
</div>
<div class="loader" id="loader">
Uploading please wait ...
<br /><br />
<img src="img/loader.gif" />
</div>
<div class="info">
<p>
<?php echo $_CONFIG['site_name']; ?> is a one-click easy image sharer, perfect if you want to
upload an image to show your friends or link from other sites.
Just choose a file to upload and we give it a place to call home.
</p>
<p>
<strong>Images are removed if they are not viewed in 30 days.</strong>
</p>
</div>
</div>
</div>
<div class="footer">
<a href="faq.php" title="Frequently asked questions">FAQ</a>
|
<a href="contact.php" title="Contact us">Contact</a>
|
<a href="api.php" title="Learn how to use our API to provide easy image sharing for your service">API</a>
|
<a href="admin.php" title="Admin Page">Admin</a>
<br />
<?php echo $_SERVER['SERVER_NAME']; ?> by <a href="//nullfix.com/">nullfix.com</a>
</div>

</body>
</html>