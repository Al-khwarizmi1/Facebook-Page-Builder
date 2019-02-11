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
// No direct access
defined('_JEXEC') or die('Restricted access');


//include tooltip
JHtml::_('behavior.tooltip');

//get template details
$template = $this->template;

//get facebook application details
$fbApplication = $this->FacebookApi;

$this->id = JRequest::getInt('id');

$apptitle = JRequest::getVar('apptitle');
?>
<style>
    div#element-box div.m{
        border:none;
        padding: 0px !important;
    }
</style>
<!-- Description for template customization Start-->
<div class='editdesc' style="margin-top:10px;">
    <p>Your template comprises of images, videos and contents. This custom field enables you to upload and edit the images, videos and contents. The below mentioned settings serves the purpose. When you roll the mouse over the template, the option to edit these contents will be highlighted.</p>
    <h4>Image Settings:</h4>
    <p>By clicking the Edit Your Image link, the image editor enables to upload your chosen image to the template. You can crop the image to any size that fits your requirement.</p>
    <h4>Content Settings:</h4>
    <p>By clicking the Edit Your Content link, you can post the required contents to be displayed in your template. The content editor enables you to edit the content formats such as changing the Font Style, Font Formats, Font Size, Background color, Text color, and adding hyperlink etc.</p>
    <h4>Video Settings:</h4>
    <p>By clicking the “Edit Your Video link, you can upload the YouTube videos by simply pasting the required YouTube video link in the video editor. The videos will be resized to fit in the template by the video editor.</p>
    <!-- Description for template customization End-->
    <?php echo $this->loadTemplate('block'); ?></div>
<!-- Edit form start-->
<form action="<?php echo JRoute::_('index.php?option=com_fbpagebuilder&layout=edit&id=' . (int) $this->item->id, false); ?>" method="post" name="adminForm" id="fbpagebuilder-form">
    <div style="width:500px;float:left;margin-left:20px;"><?php echo $this->loadTemplate('preview'); ?></div>
</form>
<!-- Edit form end-->
    <?php if($this->id==''){?>
<div class='rightcolumn'>
    <div class='apptitle'>
        <form action='<?php echo JRoute::_('index.php?option=com_fbpagebuilder&task=page.install', false) ?>' method='post' name='installform' id='installform'>
          
            <input type='hidden' name='fb-user' value='<?php echo fbpagebuilderHelper::facebookIsloggedcheck(); ?>'>
            <input type='hidden' name='template-id' value='<?php echo $template->id; ?>'>
            <input type='hidden' id='content' name='content' value=''>
            <input type='hidden' id='apptitle' name='title' value=''>
        </form>
    </div>
    
                <div class='installpage' id='install' onclick="installcheck()">
                </div>
            </div>
            <!--Installation pop up div start-->
            <div style='display:none'>
                <div id='install-fbpage'>
                    <h2 class="dialog_title"><span><?php echo JText::_('COM_FBPAGEBUILDER_PAGE_FB_INSTALL'); ?></span></h2>
                    <div class="dialogBoxGray">
            <?php echo JText::_('COM_FBPAGEBUILDER_PAGE_FB_INSTALL_DESC'); ?>
            </div>
            <a id='install-page' onclick="installpage('<?php echo fbpagebuilderHelper::facebookIsloggedcheck(); ?>','<?php echo $template->id; ?>','<?php echo $this->id; ?>','<?php echo 'index.php?option=com_fbpagebuilder&task=page.install'; ?>','<?php echo $apptitle; ?>')" ><img src="components/com_fbpagebuilder/images/installfb.png" widt="207" height="38"></a>
        </div>
    </div>
    <!--Installation pop up div end-->
    <?php }else{?>
    <form action='<?php echo JRoute::_('index.php?option=com_fbpagebuilder&task=page.install', false) ?>' method='post' name='installform' id='installform'>
            <input type='hidden' name='fb-user' value='<?php echo fbpagebuilderHelper::facebookIsloggedcheck(); ?>'>
            <input type='hidden' name='template-id' value='<?php echo $template->id; ?>'>
            <input type='hidden' id='content' name='content' value=''>
            <input type='hidden' id='apptitle' name='title' value='<?php echo $apptitle; ?>'>
        </form>
     <div id='save'onclick="installeditpage('<?php echo fbpagebuilderHelper::facebookIsloggedcheck(); ?>','<?php echo $template->id; ?>','<?php echo $this->id; ?>','<?php echo 'index.php?option=com_fbpagebuilder&task=page.install'; ?>')"></div>
    <?php }?>
    <div>
        <input type="hidden" name="task" value="page.edit" />
    <?php echo JHtml::_('form.token'); ?>
</div>
    
     