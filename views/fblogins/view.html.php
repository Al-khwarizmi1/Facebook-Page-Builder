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
defined('_JEXEC') or die('Restricted access');

// import Joomla view library
jimport('joomla.application.component.view');

/**
 * FBpagebuilder templates View
 */
class fbpagebuilderViewfblogins extends JView {

    /**
     * templates view display method
     * @return void
     */
    function display($tpl = null) {

        // Check for errors.
        if (count($errors = $this->get('Errors'))) {
            JError::raiseError(500, implode('<br />', $errors));
            return false;
        }

        $fbApi = fbpagebuilderHelper::facebookIsloggedcheck();
        $error = JRequest::getInt('showerror');
        if ($error == '1' && $fbApi == '0') {
            echo '<div style="color:red;margin: 5px 0 10px 0px; width: 1003px; float: left;">Please login with facebook. If the Facebook login does not work, please check configuration</div>';
        }
        $this->addToolBar();
        // Display the template
        parent::display($tpl);

        fbpagebuilderHelper::addSubmenu(JRequest::getCmd('view', 'fblogins'));
    }

    protected function addToolBar() {

        $url = fbpagebuilderHelper::facebookApiKey();
        $fbApi = fbpagebuilderHelper::facebookApi();
        $apiId = $fbApi->license;
        JToolBarHelper::title(JText::_('COM_FBPAGEBUILDER_SETTINGS_FACELOGIN_APPLICATIONS'));
        JToolBarHelper::divider();
        $bar = & JToolBar::getInstance('toolbar');
        if ($apiId == '') {
            // Set the toolbar
            $bar->appendButton('Custom', '<a href="http://www.apptha.com/shop/checkout/cart/add?product=30" target="_blank"><span class="icon-32-refresh" title="' . JText::_('Upgrade') . '"></span>' . JText::_('Upgrade') . '</a>', 'Upgrade');
        }
    }

}