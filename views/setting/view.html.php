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
 * FBpagebuilder contact form View
 */
class fbpagebuilderViewsetting extends JView {

    /**
     * display method of customform view
     * @return void
     */
    public function display($tpl = null) {
        //check logged in
        $isLogged = fbpagebuilderHelper::facebookIslogged();

        if ($isLogged == '') {
            $mainframe = JFactory::getApplication();
            $mainframe->redirect('index.php?option=com_fbpagebuilder&view=fblogins', false);
        } else {
            // get the Data
            $form = $this->get('Form');
            $item = $this->get('Item');
            // Check for errors.
            if (count($errors = $this->get('Errors'))) {
                JError::raiseError(500, implode('<br />', $errors));
                return false;
            }
            // Assign the Data
            $this->form = $form;
            $this->item = $item;

            // Set the toolbar
            $this->addToolBar();

            // Display the template
            parent::display($tpl);
        }
    }

    /**
     * Setting the toolbar
     */
    protected function addToolBar() {
        
        $url = fbpagebuilderHelper::facebookApiKey();
        $fbApi = fbpagebuilderHelper::facebookApi();
        $apiId = $fbApi->license;
        JRequest::setVar('hidemainmenu', true);
        $isNew = ($this->item->id == 0);
        JToolBarHelper::title($isNew ? JText::_('COM_FBPAGEBUILDER_SETTING_NEW') : JText::_('COM_FBPAGEBUILDER_SETTING_EDIT'));
        JToolBarHelper::save('setting.save');
        JToolBarHelper::cancel('setting.cancel', $isNew ? 'JTOOLBAR_CANCEL' : 'JTOOLBAR_CLOSE');
        JToolBarHelper::divider();
        $bar = & JToolBar::getInstance('toolbar');
        if (fbpagebuilderHelper::facebookIslogged() != '') {
            $bar->appendButton('Custom', '<a style="padding:0px;margin-top: 2px;" class="fblogout" href="index.php?option=com_fbpagebuilder&view=fblogins"><span title="' . JText::_('Logout') . '"></span>' . JText::_('Logout') . '</a>', 'Facebook Buttton');
        }
        if ($apiId == '' && $apiId != $url) {
            // Set the toolbar
            $bar->appendButton('Custom', '<a href="http://www.apptha.com/shop/checkout/cart/add?product=30" target="_blank"><span class="icon-32-refresh" title="' . JText::_('Upgrade') . '"></span>' . JText::_('Upgrade') . '</a>', 'Upgrade');
        }
    }

}