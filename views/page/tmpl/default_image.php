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

//include js and css
$document = &JFactory::getDocument();
$document->addStyleSheet(JURI::base() . 'components/com_fbpagebuilder/css/crop/jquery.Jcrop.css');
?>
<!-- Pop up box for upload and crop image -->
<script type='text/javascript'>
    $(document).ready(function(){
        if($.browser.name == 'msie')    {
            $('#imageupload-<?php echo $this->imageCount; ?>').colorbox({width:'70%', height:'100%',inline:true, href:'#up-<?php echo $this->imageCount; ?>'});
        }else if($.browser.name == 'chrome')    {
             $('#imageupload-<?php echo $this->imageCount; ?>').colorbox({width:'70%', height:'90%',inline:true, href:'#up-<?php echo $this->imageCount; ?>'});
        }
        else  {
            $('#imageupload-<?php echo $this->imageCount; ?>').colorbox({width:'70%', height:'100%',inline:true, href:'#up-<?php echo $this->imageCount; ?>'});
        }
        
    });
</script>

<!--image block starts-->
<div style='display:none'>
    <div id='up-<?php echo $this->imageCount; ?>'>
        <h2 class="dialog_title"><span><?php echo JText::_('COM_FBPAGEBUILDER_PAGE_FB_IMAGE_EDITOR'); ?></span></h2>
        <div class="dialogBoxGray">
            <?php echo JText::_('COM_FBPAGEBUILDER_PAGE_FB_IMAGE_EDITOR_DESC'); ?>
        </div>
        <?php echo $this->loadTemplate('upload'); ?>
    </div>
</div>
<!--image block end-->