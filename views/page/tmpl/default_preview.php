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

//get template content
$template = $this->template;
?>
 <!-- Template preview start-->
<div id="template-changed">
 <?php  if(isset($template->content))    {

 $path = JURI::base();
 $pageContent = str_replace($path,'', urldecode($template->content));
 print_r($pageContent);

     }
     else   { print_r($template->block_html);

     }?>
</div>
<!-- Template preview end-->
