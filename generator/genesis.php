<?php
libxml_use_internal_errors(true);

function genImg($title, $img_url, $caption){
	echo "<figure><img='$img_url' alt='$title' title='$title' /><figcaption>$caption</figcaption></figure>";
}
function genThumb($alt,$img_url){
echo "<img src=''$img_url' style='background-color: #CCCCCC' />";

}



$content = simplexml_load_file("content.xml") or die("Error: Cannot load content.xml");
var_dump($content);
?>
<!DOCTYPE html>
<html>
<meta lang="en" charset="UTF-8" />
<head><title>mGallery Genesis</title></head>
<body>
	<hr>
<?php /*
foreach ($artwork->content->art as $art){
	$img_url=$artwork->content[@path].'/'.$art->file;
	$title=$art->title;
	$caption=$art->caption;
	echo_img($title, $img_url, $caption);
}*/

echo $content->meta['0']->welcome;
echo $content->meta['0']->title;
echo $content->meta['0']->name;
echo $content->meta['0']->birthday;
echo $content->meta['0']->location;
echo $content->meta['0']->bio;
/*
foreach ($content->gallery[0]->images[0]->image[0]->attributes() as $key => $value) {
 echo $key, "=", $value;
}
*/
echo $content->gallery->path->thumb;
echo $content->gallery->path->img;
$x=0;
foreach ($content->gallery->images->children() as $img) {
	foreach ($img->attributes() as $key => $value) {
	 echo $key, "=", $value;
	 $imaged[$x][$key] = $value;
	 //echo $img['alt'];
	}
	$x=++$x;
}
?><hr><?php
 echo $imaged[3]["alt"];
?>

</body>
</html>
