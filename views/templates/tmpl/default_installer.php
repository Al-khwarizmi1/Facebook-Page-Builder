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
 <!-------------------------------------Upload new template ---------------------------------------------------->
                            <div id="upload" name="upload" style="display: none;clear:both;margin-left:5px;">
                                <ul class="tmplNavigation" >
                                    <li>
                                        <form action="index.php" method="post" enctype="multipart/form-data"><div ><?php echo JText::_('COM_FBPAGEBUILDER_TEMPLATE_UPLOAD_NEW')?> &nbsp; <input type="file" name="thefile"> <input type="submit" value="upload"></div>
                                            <input type="hidden" name="option" value="com_fbpagebuilder" />
                                            <input type="hidden" name="task" value="installer" />
                                            <!--<input type="hidden" name="controller" value="templates" /> <input type="hidden" name="view" value="templates" />
                                            -->
                                        </form>
                                    </li>

                                </ul>
                            </div>
 <!-------------------------------------End Template All List ---------------------------------------------------->

