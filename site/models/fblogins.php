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
// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.model');

class fbpagebuilderModelfblogins extends JModel {

    public function getPage() {

        $comPath = JPATH_COMPONENT_SITE;

        $libPath = $comPath . '/lib/facebook.php';

        require_once($libPath);

        $page_id = null;

// Get User ID
        $fbApi = fbpagebuilderHelper::facebookApi();
        $apiId = $fbApi->api_id;
        $apiSecret = $fbApi->api_secret;
        // Create our Application instance (replace this with your appId and secret).
        $facebook = new Facebook(array(
                    'appId' => $apiId,
                    'secret' => $apiSecret,
                ));

        $signed_request = $_REQUEST["signed_request"];
        list($encoded_sig, $payload) = explode('.', $signed_request, 2);
        $data = json_decode(base64_decode(strtr($payload, '-_', '+/')), true);


        $fbpageId = $data['page']['id'];
        $db = JFactory::getDBO();
        $query = $db->getQuery(true);

        //update the fanpage_id to page table.
        $query = "UPDATE #__fb_pages SET fbpage_id='" . $fbpageId . "' WHERE fbpage_id=''";
        $db->setQuery($query);
        $db->query();

        $pageId = JRequest::getVar('page');

        // Create a new query object.
        $db = $this->getDbo();
        $query = $db->getQuery(true);

        // Select the required fields from the table.

        $query->select(
                $this->getState(
                        'list.select',
                        'a.*'
                )
        );
        $query->from('#__fb_pages AS a');
        $query->where("a.published = 1");

        if ($pageId) {
            $query->where("a.title = $pageId");
        }
        if ($fbpageId) {
            $query->where("a.fbpage_id = $fbpageId");
        }
        $query->order('a.id DESC');
        $db->setQuery($query);

        $result = $db->loadObject();
        return $result;
    }

}