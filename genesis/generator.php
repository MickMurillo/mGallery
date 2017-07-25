<?php
libxml_use_internal_errors(true);

// Generates Array with the gallery images.
function genImaged()
{
    $x=1;
    global $content, $imaged;

    foreach ($content->gallery->images->children() as $img) {
        foreach ($img->attributes() as $key => $value) {
            $imaged[$x][$key] = $value;
        }
        $x++;
    }
    return $imaged;
}


// Generates thumbnail nav, $limit tells how many thumbnails.
function genThumbsN()
{
    global $content;
    global $imaged;
    global $limit;


    $images=$content->gallery->images->children()->count();
    if ($limit<=$images) {
        $x=$images;
        $last=$images-$limit;
    } else {
        $x=$images;
        $last=0;
    }

    while ($x > $last) {
        $thumbURL=$content->gallery->path->thumb.$imaged[$x]["thumb-filename"];
        $imgURL=$content->gallery->path->img.$imaged[$x]["img-filename"];
        $alt=$imaged[$x]["alt"];

        genThumb($thumbURL, $imgURL, $alt);

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

// Generates the monetization nav bar (Honey), if <honey>true</honey>
function genHoneyNav()
{
    global $content;
    if ($content->meta->honey==true) {
        ?><nav class="sale">BUY ORIGINAL |  BUY PRINT |  COMISSION NEW ARTWORK | SUPPORT ON PATREON</nav><?php
    }
}

$content = simplexml_load_file("content.xml") or die("Error: Cannot load content.xml");

$imaged = array(); genImaged();

  $limit=$content->gallery['limit'];
  $default=$content->gallery['default-image'];
  $imgDefault=$content->gallery->path->img.$imaged["$default"]["img-filename"];
?>
