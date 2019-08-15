<?php
// setup
include 'config.php';
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
<h3 class="question">Basics</h3>
<p>
Using our API is really easy. Just post an image to our store-page:
<pre style='color:#000020;background:#f6f8ff;'><span style='color:#0057a6; '>&lt;</span><span style='color:#333385; '>form</span> <span style='color:#474796; '>action</span><span style='color:#308080; '>=</span><span style='color:#1060b6; '>"</span><span style='color:#1060b6; '><?php echo $_CONFIG['site_url']; ?>store.php</span><span style='color:#1060b6; '>"</span> <span style='color:#474796; '>method</span><span style='color:#308080; '>=</span><span style='color:#1060b6; '>"</span><span style='color:#1060b6; '>post</span><span style='color:#1060b6; '>"</span>&#x000A;      <span style='color:#474796; '>enctype</span><span style='color:#308080; '>=</span><span style='color:#1060b6; '>"</span><span style='color:#1060b6; '>multipart/form-data</span><span style='color:#1060b6; '>"</span><span style='color:#0057a6; '>></span>&#x000A;   <span style='color:#0057a6; '>&lt;</span><span style='color:#333385; '>input</span> <span style='color:#474796; '>name</span><span style='color:#308080; '>=</span><span style='color:#1060b6; '>"</span><span style='color:#1060b6; '>image</span><span style='color:#1060b6; '>"</span> <span style='color:#474796; '>type</span><span style='color:#308080; '>=</span><span style='color:#1060b6; '>"</span><span style='color:#1060b6; '>file</span><span style='color:#1060b6; '>"</span> <span style='color:#0057a6; '>/></span>&#x000A;   <span style='color:#0057a6; '>&lt;</span><span style='color:#333385; '>input</span> <span style='color:#474796; '>type</span><span style='color:#308080; '>=</span><span style='color:#1060b6; '>"</span><span style='color:#1060b6; '>submit</span><span style='color:#1060b6; '>"</span> <span style='color:#0057a6; '>/></span>&#x000A;<span style='color:#0057a6; '>&lt;/</span><span style='color:#333385; '>form</span><span style='color:#0057a6; '>></span></pre>
</p>
<p>
Try it out:
<div class="example">
<form action="<?php echo $_CONFIG['site_url']; ?>store.php" enctype="multipart/form-data" method="post">
<input name="image" type="file">
<input type="submit" />
</input>
</form>
</div>
</p>
<h3 class="question">What you get back</h3>
<p>
The response back is a simple json string. That contains a success field and a payload field.
Incase of an error the success field is set to false and payload is the error message.
<pre style='color:#000020;background:#f6f8ff;'><span style='color:#406080; '>{</span> <span style='color:#1060b6; '>"success"</span><span style='color:#406080; '>:</span> <span style='color:#0f4d75; '>true</span><span style='color:#308080; '>,</span> <span style='color:#1060b6; '>"payload"</span><span style='color:#406080; '>:</span> <span style='color:#406080; '>{</span>&#x000A;  <span style='color:#1060b6; '>"uid"</span><span style='color:#406080; '>:</span> <span style='color:#1060b6; '>"AA01"</span><span style='color:#308080; '>,</span>&#x000A;  <span style='color:#1060b6; '>"uri"</span><span style='color:#406080; '>:</span> <span style='color:#1060b6; '>"<?php echo $_CONFIG['site_url']; ?>storage/AA01.png"</span><span style='color:#308080; '>,</span>&#x000A;  <span style='color:#1060b6; '>"link"</span><span style='color:#406080; '>:</span> <span style='color:#1060b6; '>"<?php echo $_CONFIG['site_url']; ?>AA01"</span><span style='color:#308080; '>,</span>&#x000A;  <span style='color:#1060b6; '>"name"</span><span style='color:#406080; '>:</span> <span style='color:#1060b6; '>"image.png"</span><span style='color:#308080; '>,</span>&#x000A;  <span style='color:#1060b6; '>"format"</span><span style='color:#406080; '>:</span> <span style='color:#1060b6; '>"image/png"</span><span style='color:#308080; '></span>&#x000A;<span style='color:#406080;'>}</span></pre>
</p>
<!--<h3 class="question">Base64 encoded image</h3>
<p>
We also accept images that are encoded using base64 string encoding.
If you use this option you also have to supply the name of the image with
the name parameter.
<pre style='color:#000020;background:#f6f8ff;'><span style='color:#0057a6; '>&lt;</span><span style='color:#333385; '>form</span> <span style='color:#474796; '>action</span><span style='color:#308080; '>=</span><span style='color:#1060b6; '>"</span><span style='color:#1060b6; '><?php echo $_CONFIG['site_url']; ?>store.php</span><span style='color:#1060b6; '>"</span> <span style='color:#474796; '>method</span><span style='color:#308080; '>=</span><span style='color:#1060b6; '>"</span><span style='color:#1060b6; '>post</span><span style='color:#1060b6; '>"</span> &#x000A;      <span style='color:#474796; '>enctype</span><span style='color:#308080; '>=</span><span style='color:#1060b6; '>"</span><span style='color:#1060b6; '>multipart/form-data</span><span style='color:#1060b6; '>"</span><span style='color:#0057a6; '>></span>&#x000A;   <span style='color:#0057a6; '>&lt;</span><span style='color:#333385; '>input</span> <span style='color:#474796; '>name</span><span style='color:#308080; '>=</span><span style='color:#1060b6; '>"</span><span style='color:#1060b6; '>name</span><span style='color:#1060b6; '>"</span> <span style='color:#474796; '>value</span><span style='color:#308080; '>=</span><span style='color:#1060b6; '>"</span><span style='color:#1060b6; '>logo.png</span><span style='color:#1060b6; '>"</span> <span style='color:#474796; '>type</span><span style='color:#308080; '>=</span><span style='color:#1060b6; '>"</span><span style='color:#1060b6; '>hidden</span><span style='color:#1060b6; '>"</span> <span style='color:#0057a6; '>/></span>&#x000A;   <span style='color:#0057a6; '>&lt;</span><span style='color:#333385; '>input</span> <span style='color:#474796; '>name</span><span style='color:#308080; '>=</span><span style='color:#1060b6; '>"</span><span style='color:#1060b6; '>image</span><span style='color:#1060b6; '>"</span> &#x000A;          <span style='color:#474796; '>value</span><span style='color:#308080; '>=</span><span style='color:#1060b6; '>"</span><span style='color:#1060b6; '>data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAA...</span><span style='color:#1060b6; '>"</span> &#x000A;          <span style='color:#474796; '>type</span><span style='color:#308080; '>=</span><span style='color:#1060b6; '>"</span><span style='color:#1060b6; '>hidden</span><span style='color:#1060b6; '>"</span> <span style='color:#0057a6; '>/></span>&#x000A;   <span style='color:#0057a6; '>&lt;</span><span style='color:#333385; '>input</span> <span style='color:#474796; '>type</span><span style='color:#308080; '>=</span><span style='color:#1060b6; '>"</span><span style='color:#1060b6; '>submit</span><span style='color:#1060b6; '>"</span> <span style='color:#0057a6; '>/></span>&#x000A;<span style='color:#0057a6; '>&lt;/</span><span style='color:#333385; '>form</span><span style='color:#0057a6; '>></span></pre>
</p>
<p>
Try it out:
<div class="example">
<form action="<?php echo $_CONFIG['site_url']; ?>store.php" enctype="multipart/form-data" method="post">
<input name="name" type="hidden" value="logo.png" />
<input name="image" type="hidden" value="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAH8AAAAeCAIAAACKd1a7AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAABxFJREFUeNrsWltME2kUnum00xttLZe6gAhyCYawi1HA4iUQiGSNiTEK8WF1oy9mfdEYEx+NTz6sURP3UR82ERVXQhSNEolGZAvhErsiCipkAcVLKpcVSu8z+7V/dqxISzuDrEqPhsyc+f8zf75zznfOaUvzPE/FRIKMTfXbxnon3k/wlE+vTTAYTG/ejEy8/ztOvay4oJqmZGH2ymPwiRaH29bafWlguMPlHeU5H8CkaS5OafohuypzWalCrqV4mqKpGPrzKiALmvJw9kbLb32DzUpWTdMMRTGIcs4zTclVWakVXq+XZRme42mGjqE//x5o7/6j+1kTy2pcLg9FefwqmdvtcCdrk3narVTJ5QxD03R4KzH0oxeaso0/a+ms9XE+p8P5X+GkeZnXOcllFK0z6IwyJiJLMfTFSNOfv4+OD6nUeo7z+DgOtAMfTE3+k51Snp6Wz/E+GRUR/PJznSPCzc8FSXK5XCbzl+mSkpIIj9Lc3CzsChbpFkJJqDMvDONbrHWWv+pVatrlcUPh83idTqfb5UxNWFdq/kmnicdxIrT3UexPTk7qdDqWZaM6krhd82Xh070Oh6Otra2rq8vn85lMptLS0szMzHlxj9fnbO28VNPwq4OzOew6inLLKC/Dx+k1Obn5xQV5Py4zrVSx6sgNfoS+2+3m/HkUnYjbNV8WZuy1WCzHjx8fGxv7kCjnzpWXlx85cgROku4DjdpUWfLL6JiNphhWoWPl2oSE74yGZIM+UaNV6nRKVkmJRP+rp+OmpqNHj36qv3v37suXL8+cOSPRAXJGtTKrLNHwvdPp4HkOjab/v4xWsgqNVq3X61hldOlLm81m4aa+vt5oNKpUqhmsXVtbS7h1+/bt4ZXBDC7dQigJtiyc2Waz7dy5E7RD9Pn5+dnZ2f39/T09PUSzbdu2gwcPKpXKORvBMGK32/EK0ufgkAzD4LSswv9PhNmIYh8v+JSXZ1WGYnDpFuaUK1euCNAfPny4qqqKXNfV1Z08eRIXN2/e3LNnT3x8vEKhEI2+VqvVqDVkgpXiRSIRpSGcDDhIToRXhmJw6RbmFKvVSi4KCwsF6CG4hoZY7u7uxhQq8aMtUA0R6VQpo74VGR0dJRc5OTkzHgkarEEj9OV8sBhd1d2xY4fE90m3EEpAKa9fv8bF8+fPZzwSNEuWLOED8lWif+DAAfAyUhjXIA0R/UNUFoKr65zVeNWqVY8fP8YFOn2UYqGSg/ehIa/Lzc2dL9L4H9AndZLwMoDAbdTvE2thzmqMrALopPCeOHHi1q1bM3qeiooKjUbDRPDh1xeKPqmTkuqMWAtzVuOlS5ceOnQIoxa57QmI8DQ9PX3Xrl14Nfz9BaGPHhltgBSCDrXy81mY9czw6+bNmwHuqVOnpqamZjDY/v379Xq9Wq0Wka+fT2iXyxVMxEJ2QzOrftaoXGALofQop/DK+Ph4a2vrgwcPcIsyu379egQ+hixAj79hKgdyS0Qlw1tEJxONDgwnDiZicgJoZtXPeugFthDGMrCA3hMQ0trjkSIgoQ6A9W/fvh0eHl69enWoQQxrhPlWwBrun5iYgO/hV5HME4qIIyfohbcQxjKgQV0liJPmEhpZQEJFLvx07do15AfcQ9YToIMjGttbWlpSUlKysrKENYC+pqZm7969wegLeyPJpG/z2xXig0hWIvUtFgsu1q5di1gGXkNDQxgdjEYj4AMtj4yMvHv3bsWKFRkZGRjWnj59mpmZCeNIrM7OTpPJBA4kEzvxFkrOo0ePoNywYQNaLFhAGxYXF0cchmvBx9jCHDt2jFqUQjJjYGDg/PnzQKS3tzctLQ1AX758GRSk1WqBL2aF69evY4x49eoVoIRLrl69il1PnjxBxrS3twPis2fPDg4OJiYm4ik8d+PGDdz29fUVFhai6WpoaIB34QPUfGINGYNUs9vteXl5i/ebRYAIsADE1q1bgS8wKi4utlqtZWVliH08BUAAPSkpyel0YooGoGAnJMfp06f37dt3//59zBOIdIQwgEY9R2YA3zVr1gBWeK6jo6OxsXHLli0kvR4+fAhr6AjgaRhENlCL+Xtd5D4CH8SCvmj58uUI/IsXLxYUFMAHeATIQPTAa+PGjVCiJqempqKPwkSNwQKEgyxBI3vv3r3KysqioiJsuX37NmL8xYsX8BAXELgH9RxK7AKtbdq0CcxjMBgwt4Po/PyzaH/LBnSAhc1mQ31GsHd1dYHHd+/enZCQACgRqnfu3Kmurk5OTiZFW+igELnYC2qCh2ABJZdU+OnpaawBscA4eAZMhVsQFKoCFpBmCQUD6YKswlv8c99i/iWh0KoDsgsXLmBYQ2kFTNCDoME5ZrM5ql4+8t6frKRjv+OkAl/EIyRRNsmnQGQGIp3rZ/21RAz9D5EoZWoVJ/8KMABvfkaY8i3iYQAAAABJRU5ErkJggg%3D%3D" />
<input type="submit" />
</form>
</div>
</p>
<h3 class="question">Metadata</h3>
<p>
Metadata works by adding a JSON string to the meta parameter, the only piece of meta
data that is used right now is referrer data, if you supply referrer data you will get
recognition and a link of you choice displayed on the viewpage.
<pre style='color:#000020;background:#f6f8ff;'><span style='color:#406080; '>{</span> &#x000A;   <span style='color:#1060b6; '>"referrer"</span><span style='color:#406080; '>:</span> <span style='color:#406080; '>{</span> &#x000A;      <span style='color:#1060b6; '>"name"</span><span style='color:#406080; '>:</span> <span style='color:#1060b6; '>"Example service"</span><span style='color:#308080; '>,</span> &#x000A;      <span style='color:#1060b6; '>"url"</span><span style='color:#406080; '>:</span> <span style='color:#1060b6; '>"http://example.com/"</span> &#x000A;   <span style='color:#406080; '>}</span> &#x000A;<span style='color:#406080; '>}</span></pre>
</p>
<p>
Example:
<div class="example">
<img alt="Immio referrer" src="img/api_referrer.png" />
</div>
</p> -->
<h3 class="question">Icon</h3>
<p>
If you want an icon for you application use this:
<div class="example">
<img src="img/pix_icon.png" title="pix icon" />
</div>
</p>
<h3 class="question">Limitations</h3>
<p>
We limit the number of uploads to 50 per day and per IP address.
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
<?php echo $_SERVER['SERVER_NAME']; ?> by <a href="http://nullfix.com/">nullfix.com</a>
</div>

</body>
</html>