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

// import Joomla controlleradmin library
jimport('joomla.application.component.controlleradmin');

/**
 * FBpagebuilder Controller
 */
class fbpagebuilderControllertemplates extends JControllerAdmin {
    /**
     * Proxy for getModel.
     * @since       1.6
     */
    public function getModel($name = 'template', $prefix = 'fbpagebuilderModel') {
        $model = parent::getModel($name, $prefix, array('ignore_request' => true));
        return $model;
    }
}