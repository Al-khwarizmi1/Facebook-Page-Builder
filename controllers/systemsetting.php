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

// import Joomla controllerform library
jimport('joomla.application.component.controllerform');

/**
 * FBpagebuilder setting Controller
 */
class fbpagebuilderControllersystemsetting extends JControllerForm {

    //system configuration update.
    function edit() {
        $arrVal = JRequest::getVar('jform');
        $path = JURI::base();
        $data = new stdClass();
        $data->api_id = $arrVal['api_id'];
        $data->api_secret = $arrVal['api_secret'];
        $data->license = $arrVal['license'];
        //db connection
        $db = JFactory::getDBO();
        $query = $db->getQuery(true);
        $query = "UPDATE #__fb_system_settings SET api_id='" . $data->api_id . "', api_secret='" . $data->api_secret . "',license='" . $data->license . "' WHERE id= 1";
        $db->setQuery($query);
        $db->query();
        $url = fbpagebuilderHelper::facebookApiKey();
        $fbApi = fbpagebuilderHelper::facebookApi();
        $apiId = $fbApi->license;
       

        if ($apiId == $url && $url != '') {
            $msg = JText::_('License key Matched');
            JController::setRedirect(JRoute::_('index.php?option=com_fbpagebuilder&view=templates', false), $msg);
        } 
         else if ($apiId != '') {
            JError::raiseWarning('', JText::_('Mismatched license key'));
            JController::setRedirect(JRoute::_('index.php?option=com_fbpagebuilder&view=page&layout=edit&id='.$id, false), $msg);
        } 
        
        else {
            JController::setRedirect(JRoute::_('index.php?option=com_fbpagebuilder&view=templates', false));
        }
    }

    function licenseKey() {
        $path = JURI::base();
        $data = new stdClass();
        $data->license = JRequest::getVar('license');
        //db connection
        $db = JFactory::getDBO();
        $query = $db->getQuery(true);
        $query = "UPDATE #__fb_system_settings SET  WHERE id= 1";
        $db->setQuery($query);
        $db->query();
        $this->setRedirect('index.php?option=com_fbpagebuilder');
    }

}