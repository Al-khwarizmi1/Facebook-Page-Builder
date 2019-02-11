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
$session =& JFactory::getSession();
$matches = array();
$subfolder =array();
$customerurl = "";
$returnUrl = $session->get( 'returnUrl');
if(isset($returnUrl)){
$returnUrl = base64_decode($returnUrl);
preg_match("/^(http:\/\/)?([^\/]+)/i", $returnUrl, $subfolder);
preg_match("/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i", $subfolder[2], $matches);
$customerurl = $matches['domain'];
}
if($customerurl!=''){
    $rUrl = $returnUrl;
}else{
    $rUrl = '#';
}

//add css js
$document = &JFactory::getDocument();
$document->addStyleSheet(JURI::base() . 'components/com_fbpagebuilder/css/fbpage.css');
//ordering and direction
$listOrder = $this->escape($this->state->get('list.ordering'));
$listDirn = $this->escape($this->state->get('list.direction'));
$saveOrder = $listOrder == 'a.ordering';
?>
<form action="<?php echo JRoute::_('index.php?option=com_fbpagebuilder&view=settings', false); ?>" method="post" name="adminForm" id="adminForm">
    <!--Search tool bar start-->
    <fieldset id="filter-bar">
        <div class="filter-search fltlft">
            <label class="filter-search-lbl" for="filter_search"><?php echo JText::_('JSEARCH_FILTER_LABEL'); ?></label>
            <input type="text" name="filter_search" id="filter_search" value="<?php echo $this->escape($this->state->get('filter.search')); ?>" title="<?php echo JText::_('COM_FBPAGEBUILDER_SETTINGS_SEARCH_IN_NAME'); ?>" />
            <button type="submit"><?php echo JText::_('JSEARCH_FILTER_SUBMIT'); ?></button>
            <button type="button" onclick="document.id('filter_search').value='';this.form.submit();"><?php echo JText::_('JSEARCH_FILTER_CLEAR'); ?></button>
        </div>
        <div class="settingdesc">
<?php
$url = fbpagebuilderHelper::facebookApiKey();
$fbApi = fbpagebuilderHelper::facebookApi();
$apiId = $fbApi->license;
if ($apiId != $url || $url == '') {
?>
            <span style="color:red">Only with the Commercial version, you will be able to create multiple page title for your Facebook Fan page.</span>
<?php } ?>
        </div>
        <?php if($customerurl!=''){?>
        <div id="temp_continue">
        <a href="<?php echo $rUrl;?>"></a>
        </div>
        <?php }?>
        <div class="filter-select fltrt">
            <select name="filter_published" class="inputbox" onchange="this.form.submit()">
                <option value=""><?php echo JText::_('JOPTION_SELECT_PUBLISHED'); ?></option>
<?php echo JHtml::_('select.options', JHtml::_('jgrid.publishedOptions'), 'value', 'text', $this->state->get('filter.published'), true); ?>
            </select>
        </div>
    </fieldset>
    <!--Search tool bar start-->
    <div class="clr"> </div>
    <table class="adminlist">
        <!--load templates from this folder location-->
        <thead><?php echo $this->loadTemplate('head'); ?></thead>
        <tfoot><?php echo $this->loadTemplate('foot'); ?></tfoot>
        <tbody><?php echo $this->loadTemplate('body'); ?></tbody>
    </table>    
    <div>
        <input type="hidden" name="task" value="" />
        <input type="hidden" name="boxchecked" value="0" />
        <input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" />
        <input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>" />
<?php echo JHtml::_('form.token'); ?>
    </div>
</form>