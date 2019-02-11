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

//youtube lib path
$comPath = JURI::base();
$youtubePath = $comPath . 'components/com_fbpagebuilder/lib/youtube.php';
?>
<!--Script for get youTube details using youTube path.-->
<script type='text/javascript'>
    $(document).ready(function(){
        if($.browser.name == 'msie')    {
            $('#videoupload-<?php echo $this->videoCount; ?>').colorbox({width:'30%', height:'40%', inline:true, href:'#upvideo-<?php echo $this->videoCount; ?>'});
        }
           else if($.browser.name == 'chrome')    {
             $('#videoupload-<?php echo $this->videoCount; ?>').colorbox({width:'30%', height:'30%', inline:true, href:'#upvideo-<?php echo $this->videoCount; ?>'});
        }
        else    {
            $('#videoupload-<?php echo $this->videoCount; ?>').colorbox({width:'30%', height:'35%', inline:true, href:'#upvideo-<?php echo $this->videoCount; ?>'});
        } });
</script>

<!-- video form start-->
<div style='display:none'>
    <div id="upvideo-<?php echo $this->videoCount; ?>">
        <h2 class="dialog_title"><span><?php echo JText::_('COM_FBPAGEBUILDER_PAGE_FB_VIDEO_EDITOR'); ?></span></h2>
        <div class="dialogBoxGray">
            <?php echo JText::_('COM_FBPAGEBUILDER_PAGE_FB_VIDEO_EDITOR_DESC'); ?>
        </div>
        <form method="post">
            <div class="youtubevideo">
                <?php echo JTEXT::_('COM_FBPAGE_GET_THUMB'); ?> : <input type="text" name="youtube-value" style="width: 180px;" onchange="dynamic_Select('<?php echo $youtubePath ?>', this.value, '<?php echo $this->videoCount; ?>')">
            </div>
            <div class="getvideo"></div>
        </form>
        <!-- video form end-->
    </div>
</div>

