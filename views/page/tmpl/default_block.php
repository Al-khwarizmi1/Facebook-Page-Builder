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

//include css and js
$document = &JFactory::getDocument();
$document->addScript(JURI::base() . 'components/com_fbpagebuilder/js/jquery-pack.js');
$document->addScript(JURI::base() . 'components/com_fbpagebuilder/js/editor.js');
$document->addScript(JURI::base() . 'components/com_fbpagebuilder/js/jquery-1.3.2.min.js');
$document->addScript(JURI::base() . 'components/com_fbpagebuilder/js/crop/jquery.Jcrop.js');
$document->addScript(JURI::base() . 'components/com_fbpagebuilder/js/crop/crop.js');
$document->addScript(JURI::base() . 'components/com_fbpagebuilder/js/swfupload/swfupload.js');
$document->addScript(JURI::base() . 'components/com_fbpagebuilder/js/jquery.swfupload.js');
$document->addScript(JURI::base() . 'components/com_fbpagebuilder/js/jquery.colorbox.js');
$document->addScript(JURI::base() . 'components/com_fbpagebuilder/js/jquery.browser.min.js');
$document->addStyleSheet(JURI::base() . 'components/com_fbpagebuilder/css/fbpage.css');
$document->addStyleSheet(JURI::base() . 'components/com_fbpagebuilder/css/popup/colorbox.css');

//get template details
$template = $this->template;
?>

<div id="mainblock">
    <?php
    $this->imageCount = 1;
    $this->videoCount = 1;
    $this->contentCount = 1;
    $totalBlock = $template->no_block;

    for ($i = 1; $i < $totalBlock + 1; $i++) {
        /*
         * Image Block Starts here.  
         */
        $imgBlock = unserialize($template->img_block);

        if (in_array($i, $imgBlock)) {
    ?>
            <script>
                $(document).ready(function () {
                    $("#image-<?php echo $this->imageCount; ?>").mouseenter(function() {
                        $('#imageupload-<?php echo $this->imageCount; ?>').addClass("imageupload");
                    })
                });
            </script>
            <div style="display:none;">
        <?php echo $this->loadTemplate('image'); ?>
        </div>

    <?php
            $this->imageCount = $this->imageCount + 1;
        }
        /*
         * Image Block End.
         * Video Block Starts here.
         */
        $videoBlock = unserialize($template->video_block);

        if (in_array($i, $videoBlock)) {
    ?>
            <script>
                $(document).ready(function () {
                    $("#video-<?php echo $this->videoCount; ?>").mouseenter(function() {
                        $('#videoupload-<?php echo $this->videoCount; ?>').addClass("videoupload");
                    })
                });
            </script>
            <div style="display:none;">
        <?php echo $this->loadTemplate('video'); ?>
        </div>

    <?php
            $this->videoCount = $this->videoCount + 1;
        }
        /*
         * Video Block End.
         * Content Block Starts here.
         */
        $contentBlock = unserialize($template->content_block);
        if (in_array($i, $contentBlock)) {
    ?>
            <script>
                $(document).ready(function () {
                    $("#content-<?php echo $this->contentCount; ?>").mouseenter(function() {
                        $('#contentupload-<?php echo $this->contentCount; ?>').addClass("contentupload");
                    })
                });
            </script>
    <?php
            echo $this->loadTemplate('content');

            $this->contentCount = $this->contentCount + 1;
        }
        /* Content Block End here.  */
    }
    ?>
</div>

