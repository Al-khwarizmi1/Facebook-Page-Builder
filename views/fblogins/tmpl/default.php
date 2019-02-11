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
// no direct access
defined('_JEXEC') or die;

//add tool tip
JHtml::_('behavior.tooltip');

//add css and js
$document = &JFactory::getDocument();
$document->addStyleSheet(JURI::base() . 'components/com_fbpagebuilder/css/fbpage.css');
?>


<!-- Face book login button-->
<div id="fb-connect" >
   
    <?php echo fbpagebuilderHelper::facebookMenu(); ?>
</div>

<div id="fb-info">
    <!--Introduction for component -->
    <h1>Introduction</h1>
   Thank you for installing Facebook page Builder. Please sign in to the Facebook using the top-right button "Login with facebook".
   . <br /><br />
    Before creating page (tab) using this component, you have to create new <a href="https://developers.facebook.com/apps/" target="_blank">Facebook fanpage</a> in your facebook account.  After Creating page (tab) using the component, by clicking on the publish button you are required to select the facebook page to add the customized page as tab to your existing facebook page. (All existing facebook pages will be available in drop down and you have to select one). <br />
   <br /><br />
   Note: To use this component, you need to create new facebook app and fill the details in the configuration section of the component.
FB page Builder application information page 
   <!--Description for create component-->
    <div id="create-comp">
       FB page Builder comes in two parts :
        This component and a Facebook application <br />        
    </div>
    <!--Description for create application-->
   
    <!--Description for More info-->
    <div id="more-info">
       For any support and help, please feel free to participate in apptha forum and you can contact us by writing to support@apptha.com.
        <br /><br />
    </div>

    <div align="center">
        <br />Developed by <a href="http://www.apptha.com/" target="_blank">Apptha</a>. </div>
    <?php echo JHtml::_('form.token'); ?>
</div>
