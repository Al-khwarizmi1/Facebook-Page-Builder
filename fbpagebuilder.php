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

// require helper file
JLoader::register('fbpagebuilderHelper', dirname(__FILE__) . DS . 'helpers' . DS . 'fbpagebuilder.php');

// import joomla controller library
jimport('joomla.application.component.controller');

// Get an instance of the controller prefixed by fbpagebuilder
$controller = JController::getInstance('fbpagebuilder');

// Perform the Request task
$controller->execute(JRequest::getCmd('task'));

// Redirect if set by the controller
$controller->redirect();
