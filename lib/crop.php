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

if(isset($_REQUEST['delete'])){

    $path = dirname(__FILE__);
    $path = str_replace('lib', '',$path);    
    $imgPath = $path.'images/templates/'.$_REQUEST['imagepath'];
    unlink($imgPath);
    echo $imgPath;
}
else{

$imageName = $_REQUEST['imagename'];

$imagePosition = $_REQUEST['position'];

$width = $_REQUEST['width'];

$url = $_REQUEST['url'];

$height = $_REQUEST['height'];

$left = $_REQUEST['left'];

$top = $_REQUEST['top'];

$pageId = $_REQUEST['page'];

$jpeg_quality = 90;

$templateId = $_REQUEST['tmp'];



$simage = '../images/templates/tmp-' . $templateId . '/customized/page-' . $pageId . '/' . $imageName;

if (file_exists($simage)) {

    $src = imagecreatefromjpeg($simage);

// Create new image with a new width and height.
    $dest = imagecreatetruecolor($width, $height);

// Copy new image to memory after cropping.

    imagecopy($dest, $src, 0, 0, $left, $top, $width, $height);
    $rand = mt_rand();
    $path = '../images/templates/tmp-' . $templateId . '/customized/page-' . $pageId . '/'. $rand . '-image-' . $imagePosition . '.jpg';

// Creating new image cropped image as JPG and save it to $dest
    //header('Content-type: image/jpeg');
    imagejpeg($dest, $path ,$jpeg_quality);
}
$imgPath = 'components/com_fbpagebuilder/images/templates/tmp-' . $templateId . '/customized/page-' . $pageId . '/'. $rand . '-image-' . $imagePosition . '.jpg';

//if (file_exists($simage)) {
//    unlink($simage);
//}
// send response path
echo '<img src="' . $imgPath . '" width="' . $width . '" height="' . $height . '">';
}
	
