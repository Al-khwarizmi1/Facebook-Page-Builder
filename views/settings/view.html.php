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
 * FBpagebuilder settings view
 */
class fbpagebuilderViewsettings extends JView {

    protected $items;
    protected $pagination;
    protected $state;

    /**
     * Customfields view display method
     * @return void
     */
    function display($tpl = null) {

        // Get data from the model
        $items = $this->get('Items');
        $pagination = $this->get('Pagination');
        $this->state = $this->get('State');

        // Check for errors.
        if (count($errors = $this->get('Errors'))) {
            JError::raiseError(500, implode('<br />', $errors));
            return false;
        }
        //check logged in
        $isLogged = fbpagebuilderHelper::facebookIslogged();

        if ($isLogged == '') {
            $mainframe = JFactory::getApplication();
            $mainframe->redirect('index.php?option=com_fbpagebuilder&view=fblogins', false);
        } else {
            // Assign data to the view
            $this->items = $items;
            $this->pagination = $pagination;

            $this->addToolBar();
            // Display the template
            parent::display($tpl);

            //sub menu
            fbpagebuilderHelper::addSubmenu(JRequest::getCmd('view', 'settings'));
        }
    }

    /**
     * Setting the toolbar
     */
    protected function addToolBar() {

        $url = fbpagebuilderHelper::facebookApiKey();
        $fbApi = fbpagebuilderHelper::facebookApi();
        $apiId = $fbApi->license;
        // Assign the Data to view
        $model = $this->getModel();
        $this->template = $model->getFacebookApi();
        $check = count($this->template);
        if ($apiId == $url && $apiId != '' || $check != '1') {
            // Set the toolbar
            JToolBarHelper::addNewX('setting.add');
        }

        JToolBarHelper::title(JText::_('COM_FBPAGEBUILDER_SETTINGS_MANAGE_APPLICATIONS'));
        JToolBarHelper::editListX('setting.edit');
        JToolBarHelper::deleteListX('', 'settings.delete');
        JToolBarHelper::divider();
        JToolBarHelper::custom('settings.publish', 'publish.png', 'publish_f2.png', 'JTOOLBAR_PUBLISH', true);
        JToolBarHelper::custom('settings.unpublish', 'unpublish.png', 'unpublish_f2.png', 'JTOOLBAR_UNPUBLISH', true);
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