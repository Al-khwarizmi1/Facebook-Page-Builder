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

$chars_str = "";

$chars_array = array();

$comPath = JPATH_COMPONENT_ADMINISTRATOR;

$libPath = $comPath . '/lib/facebook.php';

require_once($libPath);

/**
 * FBpagebuilder component helper.
 */
abstract class fbpagebuilderHelper {

    /**
     * Configure the Linkbar.
     */
    public static function addSubmenu($submenu) {

        JSubMenuHelper::addEntry(JText::_('COM_FBPAGEBUILDER_SUBMENU_TEMPLATES'), 'index.php?option=com_fbpagebuilder&view=templates', $submenu == 'templates');
        JSubMenuHelper::addEntry(JText::_('COM_FBPAGEBUILDER_SUBMENU_PAGES'), 'index.php?option=com_fbpagebuilder&view=pages', $submenu == 'pages');
        JSubMenuHelper::addEntry(JText::_('COM_FBPAGEBUILDER_SUBMENU_APPLICATIONS'), 'index.php?option=com_fbpagebuilder&view=settings', $submenu == 'settings');
        JSubMenuHelper::addEntry(JText::_('COM_FBPAGEBUILDER_SUBMENU_CONFIGURATION'), 'index.php?option=com_fbpagebuilder&view=systemsetting&layout=edit&id=1', $submenu == 'systemsetting');
        $document = JFactory::getDocument();
    }

    public static function facebookMenu() {

        $fbApi = fbpagebuilderHelper::facebookApi();
        $apiId = $fbApi->api_id;
        $apiSecret = $fbApi->api_secret;
        // Create our Application instance (replace this with your appId and secret).
        $facebook = new Facebook(array(
                    'appId' => $apiId,
                    'secret' => $apiSecret,
                ));

        // Get User ID
        $user = $facebook->getUser();

        /* We may or may not have this data based on whether the user is logged in.
         * If we have a $user id here, it means we know the user is logged into
         * Facebook, but we don't know if the access token is valid. An access
         *  token is invalid if the user logged out of Facebook.
         */

        if ($user) {
            try {
                // Proceed knowing you have a logged in user who's authenticated.
                $user_profile = $facebook->api('/me');
            } catch (FacebookApiException $e) {
                error_log($e);
                $user = null;
            }
        }

        // Login or logout url will be needed depending on current user state.
        if ($user) {
            $logoutUrl = $facebook->getLogoutUrl();
        } else {
            $loginUrl = $facebook->getLoginUrl();
        }
        $continueUrl = 'index.php?option=com_fbpagebuilder&view=templates';
        if ($user) {

            echo '<a href="' . $logoutUrl . '" id="fb-logout"><img src="components/com_fbpagebuilder/images/fbconnect_logout.png" width="176" height="31"></a>';
            echo '<a href="' . $continueUrl . '" class="continue"></a>';
        } else {

            echo '<a href="' . $loginUrl . '"id="fb-login" ><img src="components/com_fbpagebuilder/images/fbconnect_login.png" width="176" height="31"></a>';
        }
    }

    public static function facebookIslogged() {

        $fbApi = fbpagebuilderHelper::facebookApi();
        $apiId = $fbApi->api_id;
        $apiSecret = $fbApi->api_secret;

// Create our Application instance (replace this with your appId and secret).
        $facebook = new Facebook(array(
                    'appId' => $apiId,
                    'secret' => $apiSecret,
                ));
        // Get User Facebook ID
        $user = $facebook->getUser();

        return $user;
    }

    public static function facebookIsloggedcheck() {

        $fbApi = fbpagebuilderHelper::facebookApi();
        $apiId = $fbApi->api_id;
        $apiSecret = $fbApi->api_secret;

// Create our Application instance (replace this with your appId and secret).
        $facebook = new Facebook(array(
                    'appId' => $apiId,
                    'secret' => $apiSecret,
                ));
        // Get User Facebook ID
        $user = $facebook->getUser();

        return $user;
    }
    
    public static function facebookLogouturl() {

        $fbApi = fbpagebuilderHelper::facebookApi();
        $apiId = $fbApi->api_id;
        $apiSecret = $fbApi->api_secret;
        // Create our Application instance (replace this with your appId and secret).
        $facebook = new Facebook(array(
                    'appId' => $apiId,
                    'secret' => $apiSecret,
                ));

        // Get User ID
        $user = $facebook->getUser();

        /* We may or may not have this data based on whether the user is logged in.
         * If we have a $user id here, it means we know the user is logged into
         * Facebook, but we don't know if the access token is valid. An access
         *  token is invalid if the user logged out of Facebook.
         */

        if ($user) {
            try {
                // Proceed knowing you have a logged in user who's authenticated.
                $user_profile = $facebook->api('/me');
            } catch (FacebookApiException $e) {
                error_log($e);
                $user = null;
            }
        }
        $user = $facebook->getUser();
        if ($user) {

            $logOuturl = $facebook->getLogoutUrl();
        } else {
            $logOuturl = '#';
        }
        return $logOuturl;
    }

//get facebook api for fblogin purpose.
    public static function facebookApi() {

        $db = JFactory::getDbo();

        $query = $db->getQuery(true);

        $query = "SELECT * FROM #__fb_system_settings";

        $db->setQuery($query);

        $result = $db->loadObject();

        return $result;
    }

    function facebookApiKey() {

        $code = fbpagebuilderHelper::genenrateFbdomain();
        $domainKey = substr($code, 0, 25) . "CONTUS";
        return $domainKey;
    }

    function domainKey($tkey) {

        $message = "EJ-FBPBMP0EFIL9XEV8YZAL7KCIUQ6NI5OREH4TSEB3TSRIF2SI1ROTAIDALG-JW";

        for ($i = 0; $i < strlen($tkey); $i++) {
            $key_array[] = $tkey[$i];
        }
        $enc_message = "";
        $kPos = 0;
        $chars_str = "WJ-GLADIATOR1IS2FIRST3BEST4HERO5IN6QUICK7LAZY8VEX9LIFEMP0";
        for ($i = 0; $i < strlen($chars_str); $i++) {
            $chars_array[] = $chars_str[$i];
        }
        for ($i = 0; $i < strlen($message); $i++) {
            $char = substr($message, $i, 1);

            $offset = fbpagebuilderHelper::getOffset($key_array[$kPos], $char);
            $enc_message .= $chars_array[$offset];
            $kPos++;
            if ($kPos >= count($key_array)) {
                $kPos = 0;
            }
        }

        return $enc_message;
    }

    function getOffset($start, $end) {

        $chars_str = "WJ-GLADIATOR1IS2FIRST3BEST4HERO5IN6QUICK7LAZY8VEX9LIFEMP0";
        for ($i = 0; $i < strlen($chars_str); $i++) {
            $chars_array[] = $chars_str[$i];
        }

        for ($i = count($chars_array) - 1; $i >= 0; $i--) {
            $lookupObj[ord($chars_array[$i])] = $i;
        }

        $sNum = $lookupObj[ord($start)];
        $eNum = $lookupObj[ord($end)];

        $offset = $eNum - $sNum;

        if ($offset < 0) {
            $offset = count($chars_array) + ($offset);
        }

        return $offset;
    }

    function genenrateFbdomain() {
       
        $strDomainName = juri::base();
        preg_match("/^(http:\/\/)?([^\/]+)/i", $strDomainName, $subfolder);
        preg_match("/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i", $subfolder[2], $matches);
        if (isset($matches['domain'])) {
            $customerurl = $matches['domain'];
        } else {
            $customerurl = "";
        }
        $customerurl = str_replace("www.", "", $customerurl);
        $customerurl = str_replace(".", "D", $customerurl);
        $customerurl = strtoupper($customerurl);
        if (isset($matches['domain'])) {
            $response = fbpagebuilderHelper::domainKey($customerurl);
        } else {
            $response = "";
        }
        return $response;
    }

    

}