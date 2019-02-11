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
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.modeladmin');

class fbpagebuilderModelpage extends JModelAdmin {

    /**
     * Returns a reference to the a Table object, always creating it.
     *
     * @param       type    The table type to instantiate
     * @param       string  A prefix for the table class name. Optional.
     * @param       array   Configuration array for model. Optional.
     * @return      JTable  A database object
     * @since       1.6
     */
    public function getTable($type = 'page', $prefix = 'fbpagebuilderTable', $config = array()) {
        return JTable::getInstance($type, $prefix, $config);
    }

    /**
     * Method to get the record form.
     *
     * @param       array  $data Data for the form.
     * @param       boolean $loadData True if the form is to load its own data (default case), false if not.
     * @return      mixed   A JForm object on success, false on failure
     * @since       1.6
     */
    public function getForm($data = array(), $loadData = true) {

        // Get the form.
        $form = $this->loadForm('com_fbpagebuilder.page', 'page', array('control' => 'jform', 'load_data' => $loadData));
        if (empty($form)) {
            return false;
        }
        return $form;
    }

    /**
     * Method to get the data that should be injected in the form.
     *
     * @return      mixed   The data for the form.
     * @since       1.6
     */
    protected function loadFormData() {

        // Check the session for previously entered form data.
        $data = JFactory::getApplication()->getUserState('com_fbpagebuilder.edit.page.data', array());
        if (empty($data)) {
            $data = $this->getItem();
        }

        return $data;
    }

    /**
     * Method to get the templates.
     *
     * @return      mixed   The data for the form.
     * @since       1.6
     */
    public function getTemplate() {

        $tmplId = JRequest::getVar('template_id');
        $id = JRequest::getInt('id');

        // Create a new query object.
        $db = $this->getDbo();
        $query = $db->getQuery(true);

        if ($id == '') {
            // Select the required fields from the table.
            $query->select(
                    $this->getState(
                            'list.select',
                            'a.*'
                    )
            );
            $query->from('#__fb_templates AS a');

            if (is_numeric($tmplId)) {
                $query->where('a.id = ' . (int) $tmplId);
            }

            $db->setQuery($query);

            $result = $db->loadObject();
        } else {

            $db = JFactory::getDbo();

            $query = $db->getQuery(true);

            $query->select('t.id,t.no_block,t.img_block,t.video_block,t.content_block,p.content')
                    ->from('#__fb_pages AS p')
                    ->leftJoin('#__fb_templates AS t ON t.id = p.template_id')
                    ->where('p.id = ' . (int) $id);

            $db->setQuery($query);

            $result = $db->loadObject();
        }
        return $result;
    }

    /**
     * Method to get the Facebook Api.
     *
     * @return      mixed   The data for the form.
     * @since       1.6
     */
    public function getFacebookApi() {

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
        $query->from('#__fb_settings AS a');
        $query->where('a.published = 1');
        $db->setQuery($query);

        $result = $db->loadObjectList();

        return $result;
    }
/**
     * Method to get the pages.
     *
     * @return      mixed   The data for the form.
     * @since       1.6
     */
    public function getPagecount() {

        // Create a new query object.
        $db = $this->getDbo();
        $query = $db->getQuery(true);

        // Select the required fields from the table.
        $query->select('MAX(a.id)');
        $query->from('#__fb_pages AS a');

        $db->setQuery($query);

        $result = $db->loadResult();

        return $result;
    }
}