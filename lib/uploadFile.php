<?php
/*
 ***********************************************************/
/**
 * @name          : Facebook Page Builder.
 * @version	      : 1.2
 * @package       : apptha
 * @since         : Joomla 1.6
 * @subpackage    : Facebook Page Builder.
 * @author        : Apptha - http://www.apptha.com
 * @copyright     : Copyright (C) 2011 Powered by Apptha
 * @license       : GNU/GPL http://www.gnu.org/copyleft/gpl.html
 * @abstract      : Customize facebook fanpage design and controll it from this component.
 * @Creation Date : July 20 2011
 * @Modified Date : November 8 2011
 * */

/*
 ***********************************************************/
require_once('image.php');
define("IMAGETYPE_GIF", 1);
define("IMAGETYPE_JPEG", 2);
define("IMAGETYPE_PNG", 3);

$image = new SimpleImage();

$templateId = $_REQUEST['tmp'];

$imgId = $_REQUEST['img'];

$pageId = $_REQUEST['page'];

$uploadDir = '../images/templates/tmp-' . $templateId . '/customized/page-' . $pageId . '/';
//if dir not available. make directory
$rand = mt_rand();
$image_info = getimagesize($_FILES["uploadfile"]["tmp_name"]);
$image_type = $image_info[2];
if (is_dir($uploadDir)) {
    if ($image_type == IMAGETYPE_JPEG) {
        $file = $uploadDir . basename($rand . '-orgimage-' . $imgId . '.jpg');
    } elseif ($image_type == IMAGETYPE_GIF) {
        $file = $uploadDir . basename($rand . '-orgimage-' . $imgId . '.gif');
    } elseif ($image_type == IMAGETYPE_PNG) {
        $file = $uploadDir . basename($rand . '-orgimage-' . $imgId . '.png');
    }
} else {
    mkdir($uploadDir, 0777, true);
    if ($image_type == IMAGETYPE_JPEG) {
        $file = $uploadDir . basename($rand . '-orgimage-' . $imgId . '.jpg');
    } elseif ($image_type == IMAGETYPE_GIF) {
        $file = $uploadDir . basename($rand . '-orgimage-' . $imgId . '.gif');
    } elseif ($image_type == IMAGETYPE_PNG) {
        $file = $uploadDir . basename($rand . '-orgimage-' . $imgId . '.png');
    }
}

if ($image_type == IMAGETYPE_JPEG) {
    $image_source = imagecreatefromjpeg($_FILES["uploadfile"]["tmp_name"]);
    imagejpeg($image_source, $file, 100);
} elseif ($image_type == IMAGETYPE_GIF) {
    $image_source = imagecreatefromgif($_FILES["uploadfile"]["tmp_name"]);
    imagejpeg($image_source, $file, 100);
} elseif ($image_type == IMAGETYPE_PNG) {
    $image_source = imagecreatefrompng($_FILES["uploadfile"]["tmp_name"]);
    imagejpeg($image_source, $file, 100);
}
//response
if ($image_type == IMAGETYPE_JPEG) {
    echo $rand . '-orgimage-' . $imgId . '.jpg';
} elseif ($image_type == IMAGETYPE_GIF) {
    echo $rand . '-orgimage-' . $imgId . '.gif';
} elseif ($image_type == IMAGETYPE_PNG) {
    echo $rand . '-orgimage-' . $imgId . '.png';
}
?>