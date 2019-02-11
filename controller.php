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
defined('_JEXEC') or die('Restricted Access');

jimport('joomla.application.component.controller');

/**
 * Component Controller
 *
 * @package	Joomla.Administrator
 * @subpackage	com_contact
 */
class fbpagebuilderController extends JController {

    /**
     * Method to display a view.
     *
     * @param	boolean			If true, the view output will be cached
     * @param	array			An array of safe url parameters and their variable types, for valid values see {@link JFilterInput::clean()}.
     *
     * @return	JController		This object to support chaining.
     * @since	1.5
     */
    function display($cachable = false) {

        // set default view if facebook not logged
        $api = fbpagebuilderHelper::facebookApi();

        $view = JRequest::getVar('view');
        if ($api->api_id == '' && $view != 'systemsetting') {
            $this->setRedirect('index.php?option=com_fbpagebuilder&view=systemsetting&layout=edit&id=1', false);
             JRequest::setVar('showerror', '1','post');
        }
        else {
            $isLogged = fbpagebuilderHelper::facebookIslogged();
            if ($isLogged != '') {
                JRequest::setVar('view', JRequest::getCmd('view', 'templates'));
            }
            else {
                JRequest::setVar('view', JRequest::getCmd('view', 'fblogins'));
                 JRequest::setVar('showerror', '1','post');
               
            }
            // call parent behavior
            parent::display($cachable);
        }
    }

    function installer() {

        $model = $this->getModel('installer');
        if ($model->install()) {
            $this->setMessage(JText::_('COM_FBPAGEBUILDER_TEMPLATE_INSTALL_SUCCESS'));
        } else {
            $this->setMessage(JText::_('COM_FBPAGEBUILDER_TEMPLATE_INSTALL_FAILURE'));
        }
        $this->setRedirect('index.php?option=com_fbpagebuilder&view=templates');
    }

}
