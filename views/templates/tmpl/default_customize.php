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
<div id="details">
    <div class="displaySelectedThumb">
        <!--Start Display Thumb after a template selected-->
        <?php foreach ($this->items as $i => $item) { ?>
        <div id="template-<?php echo $item->id; ?>" class="tmpthumb">
                <div class="selectedThumbWrap">
                    <div class="slctTmpl" style="background: url('components/com_fbpagebuilder/images/<?php echo $item->thumb_image; ?>') 5px 5px no-repeat;">
                        <img src="components/com_fbpagebuilder/images/selected.png" alt="<?php echo JText::_('COM_FBPAGEBUILDER_TEMPLATE_CLICK_CHANGE')?>" width="180" height="208">
                    </div>
                    <div class="selectedDesc" style="opacity: 0; display: block; ">
                        <div class="description_content">
                            <?php echo JText::_('COM_FBPAGEBUILDER_TEMPLATE_CLICK_CUSTOMIZE')?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clr"></div>
        <?php } ?>
        <div id="expTmplChooser">
            <a href="#" class="changetmpl"><?php echo JText::_('COM_FBPAGEBUILDER_TEMPLATE_CHOOSE_DIFFERENT')?></a>
        </div>
    </div>
    <div class="clr"></div>
</div>
<!----------------------Choose Different Templates --------------------------------------->
