
<?php

require_once("generator.php");

ob_start(); ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" lang="en" />
<title>mGallery</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
<!--
function imageSet(imgURL){
  document.getElementById('imageFull').src=imgURL;
}
-->
</script>
</head>


<body onload='imageSet("<?php echo $imgDefault?>");'>

<header>
<div id="welcome"><?php echo $content->meta->welcome; ?></div>
<h1><?php echo $content->meta->title; ?></h1>
</header>

<main>
<div id="inmain">

<nav id="gallery">
  <?php genThumbsN(8); ?>
	</nav>

<article>
<?php genHoneyNav() ?>
		<div><img id="imageFull" src="graph/spacer.gif" width="598" height="798" alt="" style="background-color: #CCCCCC" /></div>
<?php genHoneyNav() ?>
</article>

<aside>

      <div id="profile" align="center">PROFILE
        <table width="100%" border="0" cellspacing="3">

					<tr><td><span class="xs">Name:</span></td></tr>
          <tr><td id="name"><?php echo $content->meta->name; ?></td></tr>

					<tr><td><span class="xs">Birth:</span></td></tr>
          <tr><td id="dob"><?php echo $content->meta->birthday; ?></td> </tr>

					<tr><td><span class="xs">Location:</span></td></tr>
          <tr> <td id="location"><?php echo $content->meta->location; ?></td></tr>

					<tr><td><span class="xs">bio:</span></td></tr>
          <tr><td class="sm">
<?php echo $content->meta->bio; ?>
</td>
</tr>
</table>
      </div>
</aside>

<div class="clear"></div>
</div><!--Closes inmain-->
</main>
<footer>
All Rights Reserved &copy; <?php echo $content->meta->name; ?> ||| Website running on <strong><a href="https://github.com/MickMurillo/mGallery">mGallery</a></strong> by <a href="http://www.mickmurillo.com">Mick Murillo</a>
</footer>
</body>
</html>
<?php
$htmlFile = ob_get_contents();
ob_end_clean();
$myfile = fopen("../index.html", "w") or die("Unable to open file!");
fwrite($myfile, $htmlFile);
fclose($myfile);
?>
