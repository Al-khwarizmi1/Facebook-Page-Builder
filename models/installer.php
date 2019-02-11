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

// import Joomla modelform library
jimport('joomla.application.component.modeladmin');
jimport('joomla.application.component.model');
//jimport('joomla.installer.installer');
//jimport('joomla.installer.helper');
jimport('joomla.filesystem.archive');
//jimport('joomla.filesystem.path');

/**
 * FBpagebuilder Model
 */

class fbpagebuilderModelInstaller extends JModel
{
		/**
	 * Method to auto-populate the model state.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 *
	 * @since	1.6
	 */
	
	/**
	 * Install an extension from either folder, url or upload.
	 *
	 * @return	boolean result of install
	 * @since	1.5
	 */
	function install()
	{

		$app = JFactory::getApplication();
        $result = $this->_getPackageFromUpload();
 		return $result;
	}

	/**
	 * Works out an installation package from a HTTP upload
	 *
	 * @return package definition or false on failure
	 */
	protected function _getPackageFromUpload()
	{
		// Get the uploaded file information
		$userfile = JRequest::getVar('thefile', null, 'files', 'array');

		// Make sure that file uploads are enabled in php
		if (!(bool) ini_get('file_uploads')) {
			JError::raiseWarning('', JText::_('COM_INSTALLER_MSG_INSTALL_WARNINSTALLFILE'));
			return false;
		}

		// Make sure that zlib is loaded so that the package can be unpacked
		if (!extension_loaded('zlib')) {
			JError::raiseWarning('', JText::_('COM_INSTALLER_MSG_INSTALL_WARNINSTALLZLIB'));
			return false;
		}

		// If there is no uploaded file, we have a problem...
		if (!is_array($userfile)) {
			JError::raiseWarning('', JText::_('COM_INSTALLER_MSG_INSTALL_NO_FILE_SELECTED'));
			return false;
		}

		// Check if there was a problem uploading the file.
		if ($userfile['error'] || $userfile['size'] < 1) {
			JError::raiseWarning('', JText::_('COM_INSTALLER_MSG_INSTALL_WARNINSTALLUPLOADERROR'));
			return false;
		}

		// Build the appropriate paths
		$config		= JFactory::getConfig();
		
       
		// Move uploaded file
		jimport('joomla.filesystem.file');

        $dir = 'components/com_fbpagebuilder/uploads';
        if(!file_exists($dir)) mkdir($dir);
        chmod($dir,0777);
        $tmp_src	= $userfile['tmp_name'];
        $tmp_dest	= $dir.DS.$userfile['name'];
        $filename   = $userfile['name'];
        $uploaded   = JFile::upload($tmp_src, $tmp_dest);

		// Unpack the downloaded package file
		$package = $this->unpacking($tmp_dest,$filename);

		return $package;
	}

	/**
	 * Unpacking template from zip file
	 *
	 * @return	Package details or false on failure
	 * @since	1.5
	 */
	
    protected  function unpacking($p_filename,$filename)
    {
        // Getting Db connection
        $db = $this->getDbo();
        $query = $db->getQuery(true);
        $archivename = $p_filename;
        $filenamearray = explode(".",$filename);
        //for getting the new name of template folder with related to the database
        $tmpdir = uniqid('install_');
        $query->select('MAX(id) as maxid')
        ->from('#__fb_templates');
        $db->setQuery($query);
        $result = $db->loadResult();
        $tmp_no = $result+1;
        // Clean the paths to use for archive extraction
        $tmp_name = 'tmp-'.$tmp_no;
        $extractdir = JPath::clean(dirname($p_filename).DS.$tmpdir);
        $comp_directory = str_replace("uploads","", dirname($p_filename));
        $comp_directory .= 'images'.DS.'templates';
        $archivename = JPath::clean($archivename);
        // do the unpacking of the archive
        $result_template = "";
        $result_upload = JArchive::extract($archivename, $extractdir);
        if( $result_upload === true && file_exists($extractdir.DS.$filenamearray[0].DS.'install.sql'))
        {
            $result_template = JArchive::extract($archivename, $comp_directory);
            //imporing the new template folder
            rename($comp_directory.DS.$filenamearray[0], $comp_directory.DS.$tmp_name);
            //Reading the sql file in the database
            $file_content = file($comp_directory.DS.$tmp_name.DS.'install.sql');
            foreach($file_content as $sql_line){
                if(trim($sql_line) != ""){
                    $sql_query .= $sql_line;
                }
            }
          
            $db->setQuery( $sql_query );
            if (!$db->query()) {
                throw new Exception($db->getErrorMsg());
                return false;
            }
            else{
                $this->delete_directory($extractdir);
                unlink($comp_directory.DS.$tmp_name.DS.'install.sql');
                return true;
            }
        }
        else
        {
            $this->delete_directory($extractdir);
            return false;
        }
    }
    public function delete_directory($dirname) {
        if (is_dir($dirname))
        $dir_handle = opendir($dirname);
        if (!$dir_handle)
        return false;
        while($file = readdir($dir_handle)) {
            if ($file != "." && $file != "..") {
                if (!is_dir($dirname."/".$file))
                unlink($dirname."/".$file);
                else
                $this->delete_directory($dirname.'/'.$file);
            }
        }
        closedir($dir_handle);
        rmdir($dirname);
        return true;
    }


}
