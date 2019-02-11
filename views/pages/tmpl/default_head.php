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
defined('_JEXEC') or die('Restricted Access');

?>
<!--pages header grid start-->
<tr>
    <th>
        <input type="checkbox" name="checkall-toggle" value="" onclick="checkAll(this)" />
    </th>
    <th>
        <?php echo JHtml::_('grid.sort', 'COM_FBPAGEBUILDER_PAGES_TITLE', 'a.title', $this->listDirn, $this->listOrder); ?>
    </th>
    <th>
        <?php echo JHtml::_('grid.sort', 'COM_FBPAGEBUILDER_PAGES_TEMPLATENAME', 'a.template_id', $this->listDirn, $this->listOrder); ?>
    </th>
    <th >
        <?php echo JHtml::_('grid.sort', 'COM_FBPAGEBUILDER_PAGES_PAGEID', 'a.fbpage_id', $this->listDirn, $this->listOrder); ?>
    </th>
    <th >
        <?php echo JHtml::_('grid.sort', 'COM_FBPAGEBUILDER_PAGES_PUBLISHED', 'a.published', $this->listDirn, $this->listOrder); ?>
    </th>   
</tr>
<!--pages header grid end-->