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
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
defined('_JEXEC') or die('Restricted Access');
?>
<tr>
    <td class="center">
        <div id="mainpage" style="height:auto;">
            <div id="tmplChooser" style="margin:0 auto;">
                <div id="tmplThumb" style="float:left;width: 245px;">
                    <?php echo $this->loadTemplate('customize'); ?>
                    <div id="tmplCat" style="margin-left:-4px;">
                        <div class="tabs">
                            <!-- Start Template Category List -->
                            <ul class="tabNavigation">
                                <li><a href="#all"  onclick="javascript: $('#upload').css({'display':'none'})" class="tmplCatNav selected" title="<?php echo JText::_('COM_FBPAGEBUILDER_TEMPLATE_ALL_AVAILABLE') ?>"><span><?php echo JText::_('COM_FBPAGEBUILDER_TEMPLATE_ALL') ?></span></a></li>
                                <?php
                                $url = fbpagebuilderHelper::facebookApiKey();
                                $fbApi = fbpagebuilderHelper::facebookApi();
                                $apiId = $fbApi->license;
                                if ($apiId == $url && $url !='') {
                                ?>
                                    <li><a href="#upload"  onclick="javascript: $('#upload').css({'display':'block'})" class="tmplCatNav selected" title="<?php echo JText::_('COM_FBPAGEBUILDER_TEMPLATE_ADD_NEW') ?>"><span><?php echo JText::_('COM_FBPAGEBUILDER_TEMPLATE_ADD_NEW') ?></span></a></li>
                                <?php } ?>

                            </ul>

                            <!-- End Template Category List -->
                            <!-------------------------------------Template All List ---------------------------------------------------->
                            <div id="all" name="all" style="display: block;clear:both;margin-left:5px;">
                                <ul class="tmplNavigation" >
                                    <?php
                                    $url = fbpagebuilderHelper::facebookApiKey();
                                    $fbApi = fbpagebuilderHelper::facebookApi();
                                    $apiId = $fbApi->license;
                                    if ($apiId != $url || $url ==null) {
                                    ?>
                                        <li><div id="tmplCatDesc" class="tmplCatImgThumb"><h2 class="tmplChsrCatDsc">Welcome/About us</h2><p class="tmplChsrCatDsc">Only one template will be available for the free user.  Please buy commercial version to get premium templates.</p></div></li>
                                    <?php
                                    }foreach ($this->items as $i => $item) {
                                        if ($apiId != $url && $item->id == '1' || $url ==''&& $item->id == '1') {
                                            $class = 'selectedThumbWrap';
                                            $classOne = 'selecting selected';
                                             $text= JText::_('COM_FBPAGEBUILDER_TEMPLATE_PREVIEW_TEMPLATE');
                                        } else if ($apiId == $url && $url !='') {
                                            $class = 'selectedThumbWrap';
                                            $classOne = 'selecting selected';
                                             $text= JText::_('COM_FBPAGEBUILDER_TEMPLATE_PREVIEW_TEMPLATE');
                                        } else {
                                            $class = 'selectedThumbWrap';
                                            $classOne = '';
                                            $text= JText::_('COM_FBPAGEBUILDER_TEMPLATE_ENABLE_TEMPLATE');
                                        } ?>
                                        <li>
                                            <div class="<?php echo $class ?>" >
                                                <a href="#template-<?php echo $item->id; ?>" class="<?php echo $classOne ?>" id="<?php echo $item->id; ?>">
                                                    <div class="tmplCatImgThumb">
                                                        <img src="components/com_fbpagebuilder/images/<?php echo $item->thumb_image; ?>" alt="<?php echo $text; ?>" width="165" height="190">
                                                    </div>
                                                </a>
                                                <div class="description" style="display: block; opacity: 0; ">
                                                     <a href="#template-<?php echo $item->id; ?>" class="<?php echo $classOne ?>" id="<?php echo $item->id; ?>">
                                                        <div class="description_content"><?php echo $text; ?></div>
                                                    </a>
                                                </div>
                                            </div>
                                        </li>
<?php } ?>
                                </ul>
                            </div>
                            <!-------------------------------------End Template All List ---------------------------------------------------->
                        </div>
                    </div>
                </div>
<?php echo $this->loadTemplate('preview'); ?>
            </div>
        </div>
    </td>
</tr>
