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
/* Include js and css */
$document = &JFactory::getDocument();
$document->addScript(JURI::base() . 'components/com_fbpagebuilder/js/jquery-1.3.2.min.js');
$document->addScript(JURI::base() . 'components/com_fbpagebuilder/js/tmplchooser.js');
$document->addStyleSheet(JURI::base() . 'components/com_fbpagebuilder/css/fbpage.css');

   // function to cancel the current operation.
                             ?>
<form method="post" name="templateForm" id="templateForm">
    <table>         
        <tbody><?php echo $this->loadTemplate('body'); ?></tbody>
    </table>
    <div>
        <input type="hidden" name="task" value="" />
        <input type="hidden" id="template_id" name="template_id" value="" />
        <input type="hidden" name="boxchecked" value="0" />        
        <input type="hidden" name="filter_order" value="" />
        <?php echo JHtml::_('form.token'); ?>
    </div>
</form>
<?php echo $this->loadTemplate('installer'); ?>

