<?php
libxml_use_internal_errors(true);

// Generates Array with the gallery images.
function genImaged()
{
    $x=1;
    global $content, $imaged;

    foreach ($content->gallery->images->children() as $img) {

      // echo "X VALUE:", $x, "<br />";//test
        foreach ($img->attributes() as $key => $value) {


            // echo $key, "=", $value, "<br />";//test
            $imaged[$x][$key] = $value;

            // if ($imaged[$x][$key] =="201707230149.jpg ") {
            //     echo "current imaged Key: ", key($imaged),"<br />";
            // }
        }


        // echo "<hr />";//test
        $x++;
    }
    return $imaged;
}


// Generates $imagedP with only images intended to be published.
function genThumbsN($limit)
{
    global $content;
    global $imaged;
    global $imagedP;
    // echo "Total Images Counted: ",  $content->gallery->images->children()->count(), " Limit: ", $limit, "<br />";

    // asort($imaged);// Sorts $imaged (DESC)

    $images=$content->gallery->images->children()->count();
    if ($limit<=$images) {
        $x=$images;
        $last=$images-$limit;
    } else {
        $x=$images;
        $last=0;
    }
    //  echo "X VALUE:", $x, "<br />";
    while ($x > $last) {
        // $imagedP[$x]=$imaged[$x];
        // echo $imaged[$x]["thumb-filename"], "<br />";
        // echo $content->gallery->path->thumb;
        $thumbURL=$content->gallery->path->thumb.$imaged[$x]["thumb-filename"];
        $imgURL=$content->gallery->path->img.$imaged[$x]["img-filename"];
        $alt=$imaged[$x]["alt"];
        //  echo "Hello World! <br />";
        // echo $thumbURL;
        genThumb($thumbURL, $imgURL,$alt);

        // genThumb();
        $x--;
    }
}




// Echoes main image.
function genImg($title, $imgURL, $caption)
{
    echo "<figure><img='$imgURL' alt='$title' title='$title' /><figcaption>$caption</figcaption></figure>";
}

// Echoes thumnail of image gallery.
function genThumb($thumbURL, $imgURL, $alt)
{
    echo "<img src='$thumbURL' alt='$alt' style='background-color: #CCCCCC'  onclick='imageSet(\"$imgURL\");' />";
}

function genHoneyNav()
{
  global $content;
    if ($content->meta->honey==TRUE) {
        ?><nav class="sale">BUY ORIGINAL |  BUY PRINT |  COMISSION NEW ARTWORK | SUPPORT ON PATREON</nav><?php
    }
}

// Echoes all thumbs of image gallery
// function genThumbs()
// {
//     $thumbURL=$content->gallery->path->thumb+$imaged[$x][thumb-filename];
//     genThumb($thumbURL, $alt);
// }



$content = simplexml_load_file("content.xml") or die("Error: Cannot load content.xml");
// var_dump($content);
$imaged = array();
$imagedP = array();


?>
<!DOCTYPE html>
<html>
<meta lang="en" charset="UTF-8" />
<head><title>mGallery Genesis</title></head>
<body>
	<hr>
<?php


// echo $content->meta->welcome;
// echo $content->meta->title;
// echo $content->meta->name;
// echo $content->meta->birthday;
// echo $content->meta->location;
// echo $content->meta->bio;
//
// echo $content->gallery->path->thumb;
// echo $content->gallery->path->img;
//
// echo $imaged[3]["thumb-filename"];

?><hr><?php

genImaged();
genThumbsN(8);
$imgDefault=$content->gallery->path->img.$imaged[3]["img-filename"];

// echo $imgDefault;
?><hr /><?php


?>

</body>
</html>
