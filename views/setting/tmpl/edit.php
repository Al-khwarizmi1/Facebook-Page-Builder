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

//add css and js
$document = &JFactory::getDocument();
$document->addStyleSheet(JURI::base() . 'components/com_fbpagebuilder/css/fbpage.css');
?>
<!-- Settings Edit form-->
<form action="<?php echo JRoute::_('index.php?option=com_fbpagebuilder&layout=edit&id=' . (int) $this->item->id, false); ?>" method="post" name="adminForm" id="adminform-form">
    <fieldset class="adminform">
        <legend><?php echo JText::_('COM_FBPAGEBUILDER_SETTING_DETAILS'); ?></legend>
        <ul class="adminformlist">
            <li><span><?php echo $this->form->getLabel('setting_title'); ?></span>
                <?php echo $this->form->getInput('setting_title'); ?></li>
            <li><span><?php echo $this->form->getLabel('api_id'); ?></span>
                <?php echo $this->form->getInput('api_id'); ?></li>
            <li><span><?php echo $this->form->getLabel('api_secret'); ?></span>
                <?php echo $this->form->getInput('api_secret'); ?></li>
            <li><span><?php echo $this->form->getLabel('ordering'); ?></span>
                <?php echo $this->form->getInput('ordering'); ?></li>
            <li><span><?php echo $this->form->getLabel('published'); ?></span>
                <?php echo $this->form->getInput('published'); ?></li>
        </ul>
    </fieldset>
    <fieldset class="adminform">
        <legend><?php echo JText::_('COM_FBPAGEBUILDER_SETTING_APP_DESC'); ?></legend>
        <ul class="appdesc">
            <li>To create application tab, you need fill the above form</li>
            <li>Order: It is a number used to order the created applications in your Joomla backend.</li>
            <li>API ID, API Secret: You need to provide these values from your Facebook account.</li>
        </ul>
    </fieldset>

    <fieldset class="adminform">
        <legend><?php echo JText::_('COM_FBPAGEBUILDER_SETTING_APP_CREATION'); ?></legend>
        <ul class="appdesc">
            <li>i) Open the page <a href="https://developers.facebook.com/apps" target="_blank">https://developers.facebook.com/apps</a></li>
            <li>ii) Click on top right "Create New App" button. Note: Your application name should not be already exists in facebook app directly. If any application found with your desired name, then you need to go with alternate/other app name.</li>
            <li>iii) Enter App Name, Select your "Locale", Agree to facebook terms and Click on the button "Continue".</li>
            <li>iv) Pass the security check by entering correct image texts.</li>
            <li>v) Your application will be created and you will be redirected to basic info page of your application. From this page you can find API ID & API Secret to use. You can also fill out other required information on this page and other app pages too.</li>
            <li>vi) Please find "App on Facebook" link at bottom of the page. You will be on the page "Canvas Settings". On this page you need to provide canvas url and tab url on this page. Also, please provide other info too, if need. But, the other info are not mandatory. Once you provide the urls, just "Save changes".</li>
            <li>Find the "Canvas url" and "Tab url" format below. (Both are same)
                [Your Website Path]/index.php?option=com_fbpagebuilder&view=fblogins&page= [App ID]</li>
            <li>Explanation:</li>
            <li>[Your Website Path] ? It should be an exact path of your website location. Examples: www.yourdomian.com, www.subdomain.yourdomain.com, www.yourdomain.com/subdomain, www.yourdomian.com/directoryname</li>
            <li>[App ID] ? This is the created App ID. Please refer the fifth step described above.
            </li>
        </ul>
    </fieldset>
    <input type="hidden" name="task" value="setting.edit" />
    <input type="hidden" name="returnURL" value="<?php echo JRequest::getVar('return'); ?>" />
    <?php
    $session =& JFactory::getSession();
    $session->set( 'returnUrl', JRequest::getVar('return'));
?>
    <?php echo JHtml::_('form.token'); ?>
</form>