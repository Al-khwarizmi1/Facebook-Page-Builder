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

jimport('joomla.application.component.controller');
//facebook lib

/**
 * Component Controller
 *
 * @package		Joomla.Administrator
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
        // set default view if not set

        JRequest::setVar('view', JRequest::getCmd('view', 'fblogins'));
// call parent behavior
        parent::display($cachable);
    }
   
  
}
