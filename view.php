<?php
// setup
include 'config.php';

// check if we get some $_GET stuff here ;p
if(isset($_GET['view']) && $_GET['view'] != '') {
    // sanitize get input.
    $view = (isset($_GET['view']))? filter_var ( $_GET['view'], FILTER_SANITIZE_STRING) : null;
    // echo "we got takeoff";
    // db checks baby!
    $db = MyDB();
    $results = $db->query('SELECT * FROM images WHERE random_name = "'.$view.'"');
    $final = $results->fetch();
    if($final == false) {
       $found = false; 
    } else {
       $found = true;
       try{
            // update view count and date?
            $counterupdate = $db->prepare('UPDATE images SET views = views + 1, last_view = CURRENT_TIMESTAMP WHERE random_name = :v');
            $counterupdate->bindValue(':v', $view, PDO::PARAM_STR);
            $counterupdate->execute();
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }
    //var_dump($final);
    $db->close;
}

// edit file name function

$pos2 = strpos($_COOKIE['myimages'], $_GET['edit']);
if($pos2 !== false) {
    // rename it
    $db = MyDB();
    $db->exec('UPDATE images SET real_name = "'.$_POST['name'].'" WHERE random_name = "'.filter_var ( $_GET['edit'], FILTER_SANITIZE_STRING).'"');
    $db->close;
}
//var_dump($_POST);
?>
<!DOCTYPE html>
<?php echo "<!--\n\x20\x20   \x20\x20\x20\x20 \x20\x20\x20\x2e_\x5f\x20 .\x5f\x5f\x20 \x20_\x5f_\x5f_\x2e_\x5f\x20  \x20\x20\x20   \x20\x20 \x20 \x20 \x20\x20   \x20\x20  \x20\x20   \x20\n \x20____\x20 __ \x5f\x5f|  | \x7c\x20 |\x5f\x2f\x20\x5f_\x5f_\x5c_\x5f\x7c_\x5f \x20\x5f__  \x20\x5f\x5f\x5f_\x20\x20_\x5f\x5f\x5f   ___\x5f_\x20 \n\x20/    \x5c| \x20|\x20\x20\x5c \x20\x7c \x7c\x20 \x7c\\\x20  _\x5f\\\x7c  \\  \\/\x20\x20/\x20_/\x20_\x5f\x5f\x5c/\x20\x20_ \\ /\x20\x20\x20\x20 \\ \n\x7c \x20 \x7c\x20 \\  |\x20\x20\x2f\x20\x20|\x5f\x7c\x20\x20|_|\x20\x20\x7c\x20\x20|\x20 \x7c\x3e \x20\x20 <\x20 \x5c \x20\\__( \x20\x3c\x5f> \x29\x20\x20Y \x59  \x5c\n\x7c_\x5f_\x7c\x20 \x2f___\x5f/\x7c____/\x5f\x5f__\x2f__|\x20\x20\x7c__/__\x2f\x5c\x5f \x5c /\x5c__\x5f\x20\x20>\x5f_\x5f_/|_\x5f|_|\x20\x20\x2f\n\x20 \x20 \x20\\/    \x20  \x20        \x20\x20\x20\x20 \x20\x20      \x20 \\/ \x5c\x2f\x20\x20\x20\\\x2f  \x20 \x20  \x20    \x5c\x2f\x20\nCr\x65\x61ted by \x6e\x75\x6cl\x66i\x78 @\x20n\x75\x6clf\x69\x78.\x63\x6f\x6d\n-->";?>
<html>
<head>
<title><?php echo $_CONFIG['site_name']; ?> - <?php if($found === true) {echo $final['real_name'];} else {echo "no image";} ?></title>
<meta content="image,images,photo,photos,picture,pictures,share,sharing,media,public,fast,easy,pixlr" name="keywords" />
<meta content="One click sharing of images - no registration required!" name="description" />
<link href="css/pixel.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="holder">

<?php if($found == true) {
$imageurl = $_CONFIG['site_url'].$_CONFIG['upload_dir'].$final['random_name'].'.'.$final['ext'];
?>
<div class="view">
<div>
    <img src="<?php echo $imageurl; ?>" width="100%" />
</div>
</div>
<div class="info">
<div class="iborder">
<div class="inner">
<div id="name">
<h3 class="name" id="name_in"><?php echo $final['real_name']; ?></h3>
</div>
<?php echo $final['time']; ?> / <?php echo $final['views']; ?> views
<p>
<h3 class="name">Link this image:</h3>
<input class="url" onclick="this.select()" readonly="readonly" value="<?php echo $_CONFIG['site_url'].$final['random_name']; ?>" size="23" />
</p>
<div id="fb">
<fb:like show_faces="false" width="200"></fb:like>
</div>
<div class="share" id="share">
<a href="http://www.digg.com/submit?phase=2&amp;url=<?php echo $_CONFIG['site_url'].$final['random_name']; ?>;title=<?php echo $final['real_name']; ?>" target="_new">
<img src="img/digg_32.png" title="Digg this image" />
</a>
<a href="http://del.icio.us/post?url=<?php echo $_CONFIG['site_url'].$final['random_name']; ?>&amp;title=<?php echo $final['real_name']; ?>" target="_new">
<img src="img/delicious_32.png" title="Send to Delicious" />
</a>
<a href="http://reddit.com/submit?url=<?php echo $_CONFIG['site_url'].$final['random_name']; ?>&amp;title=<?php echo $final['real_name']; ?>" target="_new">
<img src="img/reddit_32.png" title="Share on Reddit" />
</a>
<a href="http://twitter.com/home?status=<?php echo $_CONFIG['site_url'].$final['random_name']; ?>" target="_new">
<img src="img/twitter_32.png" title="Tweet about" />
</a>
<a href="http://www.stumbleupon.com/submit?url=<?php echo $_CONFIG['site_url'].$final['random_name']; ?>&amp;title=<?php echo $final['real_name']; ?>" target="_new">
<img src="img/stumbleupon_32.png" title="Stumble this image" />
</a>
</div>
</div>
</div>
<div class="clear">
<?php // check if he has the file on cookie
$pos = strpos($_COOKIE['myimages'], $final['random_name']);
if($pos !== false) {
?>
<div class="tab remove">
<a href="./index.php?delete=<?php echo $final['random_name']; ?>">Delete</a>
</div>
<div class="tab edit">
<a href="javascript:;" id="edit">Edit</a>
</div>
<?php } ?>
<div class="tab uploader">
<a download="<?php echo $final["real_name"]; ?>" href="<?php echo $imageurl; ?>" title="Download Image">Download</a>
</div>
</div>

<?php } else { ?>

<div class="error">
<div style="width: 400px; margin-left: 200px;">
It appears that the image you are looking have been recycled.
I'm however confident that the pixels of the former image soon will be seen in a new one.
</div>
</div>
<?php } ?>

<div class="logo">
<a href="./" title="Upload images to us">
<img id="logo" src="img/logo_small.png" />
</a>
</div>

</div>
<div id="fb-root"></div>
<script type="text/javascript">
  //<![CDATA[
    window.fbAsyncInit = function() {
      FB.init({appId: 'your app id', status: true, cookie: true, xfbml: true})};
      (function() {
        var e = document.createElement('script'); e.async = true;
        e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
        document.getElementById('fb-root').appendChild(e)}());
  //]]>
</script>
<?php if($pos !== false && $found === true) { ?>
<script type="text/javascript">
  //<![CDATA[
    (function(m){var h=document.createElement("input"),j=document.getElementById("name_in"),o=document.getElementById("name"),n=document.getElementById("edit");function i(a){return function(b){a(b||window.event)}}function l(a){return i(function(b){a(b);if(b.stopPropagation){b.stopPropagation()}else{b.cancleBubble=true}})}function k(){document.onclick=null;var a=new XMLHttpRequest();a.open("POST","./view.php?edit="+m,true);a.setRequestHeader("Content-Type","application/x-www-form-urlencoded");a.send("name="+escape(h.value));j.innerHTML=h.value;h.parentNode.removeChild(h);j.style.display="block"}h.type="text";h.value=j.innerHTML;h.onclick=l(function(){});h.onkeydown=i(function(a){if(a.keyCode===13){k()}});j.onclick=n.onclick=l(function(a){j.style.display="none";o.appendChild(h);h.focus();h.select();document.onclick=k})})("<?php echo $final['random_name']; ?>");
  //]]>
</script>
<?php } ?>
</body>
</html>
