<?php
// setup
include 'config.php';
$mailparts = explode('@', $_CONFIG['admin_mail']);
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
<a href="index.php">
<img alt="pixel logo" class="logo" src="img/pix.png" />
</a>
</div>
<div class="border">
<div class="content">
<p>
<h3 class="question">What kind of images are not allowed?</h3>
Images depicting porn, gore, racism, anything illegal or
images that are considered to be design elements, we're an image sharing site not a hosting company.
</p>
<p>
<h3 class="question">What formats does <?php echo $_CONFIG['site_name']; ?> support?</h3>
JPEG, PNG, BMP, AI, DNG, PDF, ICO, PSD, PXD, TGA and a ton more obscure formats.
Try uploading your file, it might work!
</p>
<p>
<h3 class="question">What is the max size of an image?</h3>
There is none, however if an image is wider than 1600 pixels or higher than 4000 pixels
we will scale it down to fit that size.
</p>
<p>
<h3 class="question">When are images removed?</h3>
They will be removed if they have not been viewed in the last 30 days.
</p>
<p>
<h3 class="question">How does remove image and rename image work?</h3>
When you upload you file we set a cookie in you browser, marking that browser
as the owner of the image. When you then view an image with that browser
two tabs appear that you can click to either delete the image or change its name.
</p>
<p>
<h3 class="question">Can i use <?php echo $_CONFIG['site_name']; ?> from my service?</h3>
Yes! feel free to use our
<a href="api.php">API</a>
to enchance your service with image sharing.
</p>
<p>
<h3 class="question">What do i do if i find an inappropriate image?</h3>
Send us an email to
<script type="text/javascript">
  //<![CDATA[
    var email = '<?php echo $mailparts[0]; ?>' + '\x40' + '<?php echo $mailparts[1]; ?>';
    document.write('<a href="mailto:'+email+'">'+email+'</a>');
  //]]>
</script>
and we will remove it asap.
</p>
<p>
<h3 class="question">Why does it say 0 views even though i know a lot of people have looked at my image?</h3>
In worst case it can take up to 15 minutes before a view is registered, check back later.
</p>
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