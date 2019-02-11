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

//get facebook application details
$fbApplication = $this->FacebookApi;
?>
<!-- Form submit when customize button clicked-->

<!-- Template Preview Image And Customize Button -->
<div id="tmplPreview">
    <div class="displaySelectedThumb" style="display: none; ">
        <?php foreach ($this->items as $i => $item) {?>
            <div id="template-<?php echo $item->id; ?>" class="tmpPre">
                <img src="components/com_fbpagebuilder/images/<?php echo $item->preview_image; ?>" alt="<?php echo JText::_('COM_FBPAGEBUILDER_TEMPLATE_PREVIEW_SELECTED') ?>"  width="450" height="501">
                <div style="width:200px;display: block;  float: left;  position: absolute;margin: -506px 0 0 572px;text-align: left;">                    
                      <h2 class="appha2"><?php echo JText::_('COM_FBPAGEBUILDER_PAGE_FB_PAGE_TITLE'); ?></h2>
            <select name='app-title' id='app-title-<?php echo $item->id; ?>'>
                <option value=''> <?php echo JText::_('COM_FBPAGEBUILDER_PAGE_FB_SELECT_OPT_TITLE'); ?> </option>
                <?php foreach ($fbApplication as $fbApp) {
                ?>
                    <option value='<?php echo $fbApp->api_id; ?>'><?php echo $fbApp->setting_title; ?></option><?php } ?>
            </select><span id='sel-error-<?php echo $item->id; ?>' style="color:red;display:block;"></span>
                  <?php
                $url = JURI::getInstance()->toString();
                $returnPath = base64_encode($url); ?>
                <a class="createnewpage" href="<?php echo JRoute::_('index.php?option=com_fbpagebuilder&view=setting&layout=edit&return=' . $returnPath, false) ?>"></a>
                </div>
               
                <div id="customizeBtn" style="display: none; ">
                          <?php $isLogged = fbpagebuilderHelper::facebookIslogged(); ?>
                <a <?php if ($isLogged != '') { ?>href="javascript:templateEdit('<?php echo $item->id; ?>');"<?php } else { ?> href="javascript:templateEdit('<?php echo $item->id; ?>');" <?php } ?>class='Customize' title='<?php echo JText::_('COM_FBPAGEBUILDER_TEMPLATE_CUSTOMIZE_SELECTED') ?>'>
                    <img src='components/com_fbpagebuilder/images/btn-gocustomize.png' alt='<?php echo JText::_('COM_FBPAGEBUILDER_TEMPLATE_OPEN') ?>'>
                </a>
            </div>
        </div>
       
  
        <?php } ?>
    </div>
      <input type='hidden' id='apptitle' name='apptitle' value=''>  
</div>
       <script type="text/javascript">
     //bind content for dumb to db


    function templateEdit(id)
    {  
        if($('#app-title-'+id).val()!=''){
            var title = $('#app-title-'+id).val();
            $('#apptitle').val(title);
            document.templateForm.action = 'index.php?option=com_fbpagebuilder&view=page&layout=edit&template_id='+id;
            document.templateForm.submit();
        }else{           
            $('#sel-error-'+id).html('<?php echo JText::_('COM_FBPAGEBUILDER_PAGE_FB_SELECT_TITLE') ?>');
        }
           }
</script>