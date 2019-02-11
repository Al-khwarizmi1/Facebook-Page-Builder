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
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');

//get template details
$template = $this->template;

$pageId = $this->pages + 1;

$this->templateId = $template->id;

$this->fileName = 'image-' . $this->imageCount;

//base path
$this->comPath = JURI::base();

//path for upload php
$this->uploadfilePath = $this->comPath . 'components/com_fbpagebuilder/lib/uploadFile.php?tmp=' . $this->templateId . '&img=' . $this->imageCount . '&page=' . $pageId;

//path for crop php
$this->cropfilePath = $this->comPath . 'components/com_fbpagebuilder/lib/crop.php';

//path for swf file
$this->swfPath = $this->comPath . 'components/com_fbpagebuilder/';

$this->orginalPath = JPATH_COMPONENT_ADMINISTRATOR. '/images/templates/tmp-' . $this->templateId . '/';

$this->orginalImage = $this->orginalPath . $this->fileName . '.jpg';

//image class path
$dPath = JPATH_COMPONENT_ADMINISTRATOR;

$libPath = $dPath . '/lib/image.php';

//get image size using image  class
require_once($libPath);

$image = new SimpleImage();

$image->load($this->orginalImage);

$this->imgWidth = $image->getWidth();

$this->imgHeight = $image->getHeight();
?>
<!-- script for image upload-->
<script type='text/javascript'>
    var imgupWidth= '';
    var imgupHeight = '';
    var jcrop_api, boundx, boundy;
    $(document).ready(function() {
        $('#swfupload-control-<?php echo $this->imageCount; ?>').swfupload({
            upload_url: '<?php echo $this->uploadfilePath; ?>',
            file_post_name: 'uploadfile',
            file_size_limit : '1024',
            file_types : "*.jpg;*.png;*.jpeg;*.gif",
            file_types_description : 'Image files',
            file_upload_limit : 50,
            flash_url : '<?php echo $this->swfPath; ?>js/swfupload/swfupload.swf',
            button_image_url : '<?php echo $this->swfPath; ?>images/wd.png',
            button_width : 114,
            button_height : 29,
            button_placeholder : $('#button')[0],
            debug: false
        })
        .bind('fileQueued', function(event, file){
            $(this).swfupload('startUpload');             
        })
        .bind('uploadStart', function(event, file){
        })
        .bind('uploadProgress', function(event, file, bytesLoaded){
        })
        .bind('uploadSuccess', function(event, file, serverData){           
            $('#crop-<?php echo $this->imageCount; ?>').prepend("<img id='target-<?php echo $this->imageCount; ?>'  src='components/com_fbpagebuilder/images/templates/tmp-<?php echo $this->templateId; ?>/customized/page-<?php echo $pageId ?>/"+serverData+"'>");
            $('#bind-<?php echo $this->imageCount; ?>').attr('title', serverData);
            $('#swfupload-control-<?php echo $this->imageCount; ?>').hide();
            $('#pophead-<?php echo $this->imageCount; ?>').css('display', 'block');
               $('#target-<?php echo $this->imageCount; ?>').Jcrop({
                minSize: [ 20, 20 ],
                maxSize: [ <?php echo $this->imgWidth; ?>, <?php echo $this->imgHeight; ?> ],
                onSelect: function(c){
                    updatePreview(c,<?php echo $this->imageCount; ?>);
                }
            },function(){
                // Use the API to get the real image size
                var bounds = this.getBounds();
                boundx = bounds[0];
                boundy = bounds[1];
                // Store the API in the jcrop_api variable
                jcrop_api = this;
            });
            
           
        })
        .bind('uploadComplete', function(event, file){          
         
        })

    });
                
</script>
<!--upload button-->
<div id='swfupload-control-<?php echo $this->imageCount; ?>' class="swfbutton">
    <input type='button' id='button' />
</div>

<!--pop up delete crop-->
<div id='pophead-<?php echo $this->imageCount;  ?>' class="pophead" style="display:none">
    <div >
        <a class='crop' onclick=resize('<?php echo $this->imageCount; ?>','<?php echo $this->imgWidth; ?>','<?php echo $this->imgHeight; ?>','<?php echo $this->cropfilePath; ?>','<?php echo $this->comPath; ?>','<?php echo $pageId ?>','<?php echo $this->templateId; ?>')></a>
    </div>
    <div >
        <a  class='imgdelete' onclick=deleteimage('<?php echo $this->imageCount; ?>','<?php echo $pageId ?>','<?php echo $this->templateId; ?>','<?php echo $this->cropfilePath; ?>')></a>
    </div>
</div>
<!--crop container-->
<div width="100%">
<div id='crop-<?php echo $this->imageCount; ?>' class="crop-img">    
</div>
<!--Image Editor Description-->
<div class="imginstruction">
    <p>Min image size <?php echo $this->imgWidth.'*'.$this->imgHeight;?></p>
<h2>Image Editor</h2>
<p>After uploading an image, you will find two tabs Crop and Delete.
Crop: This helps you to crop the required portion of the image to fit in the template. You need to select the respective portion first to crop the image.
Delete: You can delete the uploaded image and add new one.</p>
</div>
</div>
<!--bind crop positions in this div-->
<div id='bind-<?php echo $this->imageCount; ?>'>
</div>




