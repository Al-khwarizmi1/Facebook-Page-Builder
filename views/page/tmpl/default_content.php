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
?>
<script type='text/javascript'>   
   //editor config

     bkLib.onDomLoaded(function() {
        var myNicEditor = new nicEditor();
        myNicEditor.setPanel('editor-<?php echo $this->contentCount ?>');
        myNicEditor.addInstance('duplicate-content-<?php echo $this->contentCount; ?>');
    });

    $(document).ready(function(){

        //get content from template.
        var content = $('#content-<?php echo $this->contentCount; ?>').html();
      
        $('#duplicate-content-<?php echo $this->contentCount ?>').html(content);
        var length = $('#contentupload-<?php echo $this->contentCount; ?>').attr("name");
         $('#str_length_<?php echo $this->contentCount ?>').html('Maximum characters '+length);
       //check browser for popupbox
        if($.browser.name == 'msie')    {
            $('#contentupload-<?php echo $this->contentCount; ?>').colorbox({width:'40%', height:'70%', inline:true, href:'#content-block-<?php echo $this->contentCount ?>'});
        }
        else if($.browser.name == 'chrome')    {
            $('#contentupload-<?php echo $this->contentCount; ?>').colorbox({width:'40%', height:'57%', inline:true, href:'#content-block-<?php echo $this->contentCount ?>'});
        }
         else if($.browser.name == 'Firefox')    {
            $('#contentupload-<?php echo $this->contentCount; ?>').colorbox({width:'40%', height:'65%', inline:true, href:'#content-block-<?php echo $this->contentCount ?>'});
        }
        else{
            $('#contentupload-<?php echo $this->contentCount; ?>').colorbox({width:'40%', height:'70%', inline:true, href:'#content-block-<?php echo $this->contentCount ?>'});
        }

    });
</script>
<!--content Editor-->
<div style='display:none;'>
    <div id='content-block-<?php echo $this->contentCount ?>'>
        <h2 class='dialog_title'><span><?php echo JText::_('COM_FBPAGEBUILDER_PAGE_FB_CONTENT_EDITOR') ?></span></h2>
        <div class='dialogBoxGray' style="height: 10px;">
            <div style="float:left;margin-left:5px;" id="str_length_<?php echo $this->contentCount ?>"></div>
        </div>
        <div id='editor-<?php echo $this->contentCount ?>' class='editor-top'></div>
        <div id='duplicate-content-<?php echo $this->contentCount ?>' class='duplicate-content'></div>
        <div class='contentsave'>
            <a onclick=save('<?php echo $this->contentCount ?>')><?php echo JText::_('COM_FBPAGEBUILDER_PAGE_FB_CONTENT_EDITOR_SAVE') ?></a>
        </div>
    </div>
</div>