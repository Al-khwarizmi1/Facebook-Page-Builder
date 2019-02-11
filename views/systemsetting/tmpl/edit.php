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

//ADD CSS
$document = &JFactory::getDocument();
$document->addScript(JURI::base() . 'components/com_fbpagebuilder/js/jquery-1.3.2.min.js');
$document->addStyleSheet(JURI::base() . 'components/com_fbpagebuilder/css/fbpage.css');
$fbApi = fbpagebuilderHelper::facebookApi();
$fbApiid = $fbApi->api_id;
$fbApisecret = $fbApi->api_secret;
?>
<!-- Settings Edit form-->
<form action="<?php echo JRoute::_('index.php?option=com_fbpagebuilder&task=systemsetting.edit', false) ?>" method="post" name="adminForm" id="adminform-form">
    <?php if($fbApiid==''||$fbApisecret == ''){?>
    
    <?php }?>
    <fieldset class="adminform" style="width:97%;float:left;margin:0 10px 0 10px">
        <legend><?php echo JText::_('COM_FBPAGEBUILDER_SYSTEM_SETTING_DETAILS'); ?></legend>
        <ul class="adminformlist">
            <li style="height:35px"><span><?php echo $this->form->getLabel('api_id'); ?></span>
                <?php echo $this->form->getInput('api_id'); ?> <span class="desc">Please provide the Api ID and App Secret of Facebook for your domain from the following link <a href="https://developers.facebook.com/apps/" target="_blank">See the link</a>.  You will be able to continue only if you provide those.</span></li>
            <li><span><?php echo $this->form->getLabel('api_secret'); ?></span>
                <?php echo $this->form->getInput('api_secret'); ?></li>
        </ul>
    </fieldset>
    <fieldset class="adminform" style="width:97%;float:left;margin:10px 10px 0 10px">
        <legend><?php echo JText::_('COM_FBPAGEBUILDER_LICENSE_SETTING_DETAILS'); ?></legend>
        <ul class="adminformlist">
            <li><span><?php echo $this->form->getLabel('license'); ?></span>
                <?php echo $this->form->getInput('license'); ?> 
                <?php
                $url = fbpagebuilderHelper::facebookApiKey();
                $apiId = $fbApi->license;
                if ($apiId != $url || $url=='') {
                ?>
                    <a href="http://www.apptha.com/shop/checkout/cart/add?product=30" target="_blank" class="buynow"></a>

                    <a href="javascript: submitform()" id="continue" class="freetrail"></a>
                <?php } ?>
            </li>
        </ul>
    </fieldset>
    <input type="hidden" name="task" value="systemsetting.edit" />
    <?php echo JHtml::_('form.token'); 
    $session =& JFactory::getSession();
    $session->set( 'sessUrl', '1');
    ?>
</form>
<script type="text/javascript">
    function changeClass(){
        var license = $('#jform_license').val();
        if(license!=''){
            $('#continue').removeClass("freetrail").addClass("continuefull");
        }else{
            $('#continue').removeClass("continuefull").addClass("freetrail");
        }
    }
    function submitform()
    {
        document.forms["adminform-form"].submit();

    }
</script>
