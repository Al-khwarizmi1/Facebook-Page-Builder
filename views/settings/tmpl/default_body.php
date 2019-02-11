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

//get User and check user are authorized or not.
$user = JFactory::getUser();

foreach ($this->items as $i => $item) {
    //Autorize for change publish
    $canChange = $user->authorise('core.edit.state', 'com_fbpagebuilder.settings.' . $item->id);?>

    <!-- Configuration Details grid start -->
    <tr class="row<?php echo $i % 2; ?>">
        <td class="center">
        <?php echo JHtml::_('grid.id', $i, $item->id); ?>
    </td>
    <td align="center">
        <?php echo $item->setting_title; ?>
    </td>
    <td align="center">
        <?php echo $item->api_id; ?>
    </td>
    <td align="center">
        <?php echo $item->api_secret; ?>
    </td>    
    <td align="center">
        <?php echo $item->ordering; ?>
    </td>
    <td align="center">
        <?php echo JHtml::_('jgrid.published', $item->published, $i, 'settings.', $canChange, 'cb', '', ''); ?>
    </td>  
</tr>
<!-- Configuration Details grid end -->
<?php } ?>
