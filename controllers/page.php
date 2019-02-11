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
defined('_JEXEC') or die('Restricted access');

// import Joomla controllerform library
jimport('joomla.application.component.controllerform');

/**
 * FBpagebuilder Controller
 */
class fbpagebuilderControllerpage extends JControllerForm {
    /*
     * Insert Or update the Customized page and redirected to Facebook.
     */

    public function install() {

        //check logged in
        $isLogged = fbpagebuilderHelper::facebookIslogged();
        if ($isLogged == '') {
            $this->setRedirect('index.php?option=com_fbpagebuilder&view=fblogins');
        } else {
//base url
            $path = JURI::base();
            $data = new stdClass();
            $data->id = null;
            $data->template_id = JRequest::getInt('template-id');
            $this->pid = JRequest::getInt('page');
            $content = stripslashes($_POST['content']);
            $content = str_replace('contenteditable="true"', '', $content);
            $url = fbpagebuilderHelper::facebookApiKey();
            $fbApi = fbpagebuilderHelper::facebookApi();
            $apiId = $fbApi->license;
            if ($apiId == $url) {
                $content = str_replace('Powered by', '', $content);
                $content = str_replace('Apptha.com', '', $content);
            }
            $content = str_replace('components/com_fbpagebuilder', $path . 'components/com_fbpagebuilder', $content);
            $data->content = $content;
            $data->title = JRequest::getVar('title');
            $user = JFactory::getUser();
            $data->user_id = $user->get('id');
            $data->fbuser_id = JRequest::getVar('fb-user');
            $data->published = '1';


            $db = JFactory::getDBO();
            $query = $db->getQuery(true);

            //insert and update the customized content to page table.
            if ($this->pid != '') {
                $query = "UPDATE #__fb_pages SET content='" . urlencode($content) . "' WHERE id= $this->pid";
                $db->setQuery($query);
                $db->query();
                echo "index.php?option=com_fbpagebuilder&view=pages";
            } else {
                $data->fbpage_id = '';
                $db->insertObject('#__fb_pages', $data);
                              
               echo "index.php?option=com_fbpagebuilder&view=page&layout=edit&id=".$db->insertid()."&page=republish";
            }
            exit;
        }
    }
    
  }