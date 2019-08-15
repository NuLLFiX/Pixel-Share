<?php if(session_id() == "") {session_start();}
$_SESSION['active'] = true;
require_once('config.php'); // open the config file ;p

//var_dump($_POST);
// authentication code!
$valid_passwords = array ("admin" => $_CONFIG['admin_pw']);
$valid_users = array_keys($valid_passwords);

$user = $_SERVER['PHP_AUTH_USER'];
$pass = $_SERVER['PHP_AUTH_PW'];

$validated = (in_array($user, $valid_users)) && ($pass == $valid_passwords[$user]);

//var_dump($_SERVER);

if (!$validated) {
  header('WWW-Authenticate: Basic realm="Pixel Img Host"');
  header('HTTP/1.0 401 Unauthorized');
  die ("Not authorized!");
}
// If arrives here, is a valid user. Script starts from here on!
$_SESSION['admin'] = true;


// Connects to your Database 
$db = MyDB();

// count old files...
$dayz = time() + 2592000; // +30 days
$old_files = $db->prepare("SELECT count(*) FROM images WHERE last_view < $dayz");
$old_files->execute();
$old_files = $old_files->fetchColumn();

//var_dump($old_files); die();

// setup actions
if($_GET['action'] == "delete" && $_GET['id'] != "") {
	// delete file
        $find = $db->query("SELECT ext, random_name FROM images WHERE id='$_GET[id]'");
        $find = $find->fetch();
	$deletequery = $db->query("DELETE FROM images WHERE id='$_GET[id]'");
        //var_dump($find);
	echo ($deletequery == true) ? '<script>alert("The file has been successfully deleted!");</script>': '<script>alert("Something is gone wrong nothing was deleted from database!");</script>';
	if($deletequery == true) { unlink("./".$_CONFIG['upload_dir'].$find['random_name'].".".$find['ext']); }
}

// delete old files action
if($_GET['action'] == "oldremove" && $old_files > 0) {
    //  delete old files that are not viewed.
    $oldquery = $db->query("SELECT id,random_name,ext FROM images WHERE last_view < $dayz");
    while($old = $oldquery->fetch()) 
    {
        //var_dump($old);
        @unlink("./".$_CONFIG['upload_dir'].$old['random_name'].".".$old['ext']);
        $db->exec("DELETE FROM images WHERE id='$old[id]'");
    }
}

 //This checks to see if there is a page number. If not, it will set it to page 1 
 if (!(isset($_REQUEST[pagenum])))  {  $_REQUEST[pagenum] = 1;  } 

 //Here we count the number of results 
 //Edit $data to be your query 
 //$data = $db->query("SELECT * FROM images"); 
 $rows = $db->prepare("SELECT count(*) FROM images");
 $rows->execute();
 $rows = $rows->fetchColumn();

 //This is the number of results displayed per page 
 $page_rows = 10; 

 //This tells us the page number of our last page 
 $last = ceil($rows/$page_rows); 

 //this makes sure the page number isn't below one, or more than our maximum pages 
 if ($_REQUEST[pagenum] < 1)  {  $pagenum = 1;  }  elseif ($_REQUEST[pagenum] > $last) {  $pagenum = $last;  } 

 //This sets the range to display in our query 
 $max = 'limit ' .($_REQUEST[pagenum] - 1) * $page_rows .',' .$page_rows; 
 
 //This is your query again, the same one... the only difference is we add $max into it
 $data_p = $db->query("SELECT * FROM images ORDER BY id DESC $max"); 

 //This is where you display your query results
$output = '<table id="hor-minimalist-b" summary="Admin Page Table">
    <thead>
    	<tr>
        	<th scope="col">View</th>
            <th scope="col">Real Name</th>
            <th scope="col">Short</th>
			<th scope="col">Date</th>
            <th scope="col">Hits</th>
			<th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>';
 while($read = $data_p->fetch()) 
 {
        $thumb = $_CONFIG['upload_dir'].$read['random_name'].".".$read['ext'];
	$output .= '<tr>
        	<td style="width:35px;"><a href="'.$thumb.'" class="preview" onclick="javascript:return false;"><img src="'.$thumb.'" alt="thumbnail" width="32" height="24" /></a></td>
            <td>'.substr($read['real_name'], 0, 25).'</td>
            <td>'.$read['random_name'].'</td>
            <td>'.how_long_ago(strtotime($read['time'])).'</td>
			<td>'.$read['views'].'</td>
            <td><a href="./'.$read['random_name'].'" title="View Image" target="_blank">SHOW</a> | <a href="?action=delete&id='.$read['id'].'" title="Delete File">DEL</a></td>
        </tr>';
 }
	$output .= "</tbody></table><br><p>";
 // This shows the user what page they are on, and the total number of pages
 //echo " --Page $_REQUEST[pagenum] of $last-- <p>";
 
 // First we check if we are on page one. If we are then we don't need a link to the previous page or the first page so we do nothing. If we aren't then we generate links to the first page, and to the previous page.
 if ($_REQUEST[pagenum] == 1)  { }  else  {
 $output .= " <a href='{$_SERVER['PHP_SELF']}?pagenum=1'> <<-First</a> ";
 $output .= " ";
 $previous = $_REQUEST[pagenum]-1;
 $output .= " <a href='{$_SERVER['PHP_SELF']}?pagenum=$previous'> <-Previous</a> ";
 } 

 //just a spacer
 $output .= " -- Page $_REQUEST[pagenum] of $last -- ";

 //This does the same as above, only checking if we are on the last page, and then generating the Next and Last links
 if ($_REQUEST[pagenum] == $last) { } else {
 $next = $_REQUEST[pagenum]+1;
 $output .= " <a href='{$_SERVER['PHP_SELF']}?pagenum=$next'>Next -></a> ";
 $output .= " ";
 $output .= " <a href='{$_SERVER['PHP_SELF']}?pagenum=$last'>Last ->></a> "; }
?>
<!DOCTYPE html>
<?php echo "<!--\n\x20\x20   \x20\x20\x20\x20 \x20\x20\x20\x2e_\x5f\x20 .\x5f\x5f\x20 \x20_\x5f_\x5f_\x2e_\x5f\x20  \x20\x20\x20   \x20\x20 \x20 \x20 \x20\x20   \x20\x20  \x20\x20   \x20\n \x20____\x20 __ \x5f\x5f|  | \x7c\x20 |\x5f\x2f\x20\x5f_\x5f_\x5c_\x5f\x7c_\x5f \x20\x5f__  \x20\x5f\x5f\x5f_\x20\x20_\x5f\x5f\x5f   ___\x5f_\x20 \n\x20/    \x5c| \x20|\x20\x20\x5c \x20\x7c \x7c\x20 \x7c\\\x20  _\x5f\\\x7c  \\  \\/\x20\x20/\x20_/\x20_\x5f\x5f\x5c/\x20\x20_ \\ /\x20\x20\x20\x20 \\ \n\x7c \x20 \x7c\x20 \\  |\x20\x20\x2f\x20\x20|\x5f\x7c\x20\x20|_|\x20\x20\x7c\x20\x20|\x20 \x7c\x3e \x20\x20 <\x20 \x5c \x20\\__( \x20\x3c\x5f> \x29\x20\x20Y \x59  \x5c\n\x7c_\x5f_\x7c\x20 \x2f___\x5f/\x7c____/\x5f\x5f__\x2f__|\x20\x20\x7c__/__\x2f\x5c\x5f \x5c /\x5c__\x5f\x20\x20>\x5f_\x5f_/|_\x5f|_|\x20\x20\x2f\n\x20 \x20 \x20\\/    \x20  \x20        \x20\x20\x20\x20 \x20\x20      \x20 \\/ \x5c\x2f\x20\x20\x20\\\x2f  \x20 \x20  \x20    \x5c\x2f\x20\nCr\x65\x61ted by \x6e\x75\x6cl\x66i\x78 @\x20n\x75\x6clf\x69\x78.\x63\x6f\x6d\n-->";?>
<html>
<head>
<title>Share your images / photos / pictures / image / photo / picture - <?php echo $_CONFIG['site_name']; ?></title>
<meta content="image,images,photo,photos,picture,pictures,share,sharing,media,public,free,twitter,facebook,myspace,netlog,fast,easy" name="keywords" />
<meta content="One click sharing of images - no registration required!" name="description" />
<link href="css/pixel.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="//code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript">
/*
 * Image preview script 
 * powered by jQuery (http://www.jquery.com)
 * 
 * written by Alen Grakalic (http://cssglobe.com)
 * 
 * for more info visit http://cssglobe.com/post/1695/easiest-tooltip-and-image-preview-using-jquery
 *
 */
 
this.imagePreview = function(){	
	/* CONFIG */
		
		xOffset = 10;
		yOffset = 30;
		
		// these 2 variable determine popup's distance from the cursor
		// you might want to adjust to get the right result
		
	/* END CONFIG */
	$("a.preview").hover(function(e){
		this.t = this.title;
		this.title = "";	
		var c = (this.t != "") ? "<br/>" + this.t : "";
		$("body").append("<p id='preview'><img width='300px' src='"+ this.href +"' alt='Image preview' />"+ c +"</p>");								 
		$("#preview")
			.css("top",(e.pageY - xOffset) + "px")
			.css("left",(e.pageX + yOffset) + "px")
			.fadeIn("fast");						
    },
	function(){
		this.title = this.t;	
		$("#preview").remove();
    });	
	$("a.preview").mousemove(function(e){
		$("#preview")
			.css("top",(e.pageY - xOffset) + "px")
			.css("left",(e.pageX + yOffset) + "px");
	});			
};


// starting the script on page load
$(document).ready(function(){
	imagePreview();
});
</script>
</head>
<body>
<div class="header clear">
<a href="index.php">
<img alt="pixel logo" class="logo" src="img/pix.png" />
</a>
</div>
<div class="border">
<div class="content">

<h2>Administration</h2>
<p>You can use the actions to delete or show any image from your sqlite3 database, or mouse over any thumbnail to see an image preview.</p>

<p>Old Counter(<?php echo $old_files ;?>) - <a href="?action=oldremove" title="Delete 30days unvisited images...">Delete Files!</a></p>

<?php echo $output; ?>

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