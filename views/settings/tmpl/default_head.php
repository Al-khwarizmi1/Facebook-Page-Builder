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
<!-- Configuration header grid start -->
<tr>
    <th>
        <input type="checkbox" name="checkall-toggle" value="" onclick="checkAll(this)" />
    </th>
    <th>
<?php echo JHtml::_('grid.sort', 'COM_FBPAGEBUILDER_SETTINGS_TITLE', 'a.title', '', ''); ?>
    </th>
    <th>
<?php echo JHtml::_('grid.sort', 'COM_FBPAGEBUILDER_SETTINGS_FBAPP', 'a.api_id', '', ''); ?>
    </th>
    <th>
<?php echo JHtml::_('grid.sort', 'COM_FBPAGEBUILDER_SETTINGS_FBAPPSECRET', 'a.api_secret', '', ''); ?>
    </th>
    <th>
<?php echo JHtml::_('grid.sort', 'COM_FBPAGEBUILDER_SETTINGS_ORDERING', 'a.ordering', '', ''); ?>
    </th>
    <th>
<?php echo JHtml::_('grid.sort', 'COM_FBPAGEBUILDER_SETTINGS_PUBLISHED', 'a.published', '', ''); ?>
    </th>
</tr>
<!-- Configuration header grid end -->