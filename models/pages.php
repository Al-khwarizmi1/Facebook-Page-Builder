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
defined('_JEXEC') or die('Restricted access');

// import Joomla controllerform library
jimport('joomla.application.component.modellist');

class fbpagebuilderModelpages extends JModelList {
    /**
     * Constructor.
     * @param   array	An optional associative array of configuration settings.
     * @see	JController
     * @since	1.6
     */
    public function __construct($config = array()) {
        if (empty($config['filter_fields'])) {
            $config['filter_fields'] = array(
                'id', 'a.id',
                'template_id', 'a.template_id',
                'content', 'a.content',
                'title', 'a.title',
                'user_id', 'a.user_id',
                'fbuser_id', 'a.fbuser_id',
                'ordering', 'a.ordering',
                'published', 'a.published',
            );
        }
        parent::__construct($config);
    }

    /**
     * Method to auto-populate the model state.
     * Note. Calling getState in this method will result in recursion.
     * @return	void
     * @since	1.6
     */
    protected function populateState($ordering = null, $direction = null) {

        // Adjust the context to support modal layouts.
        if ($layout = JRequest::getVar('layout')) {
            $this->context .= '.' . $layout;
        }

        // Populate Status for search and published.
        $search = $this->getUserStateFromRequest($this->context . '.filter.search', 'filter_search');
        $this->setState('filter.search', $search);

        $published = $this->getUserStateFromRequest($this->context . '.filter.published', 'filter_published', '');
        $this->setState('filter.published', $published);

        $categoryId = $this->getUserStateFromRequest($this->context . '.filter.templte_id', 'filter_templte_id');
        $this->setState('filter.templte_id', $categoryId);

        // List state information.
        parent::populateState('a.id', 'asc');
    }

    /**
     * Method to get a store id based on model configuration state.
     * This is necessary because the model is used by the component and
     * different modules that might need different sets of data or different
     * ordering requirements.
     * @param  string	$id A prefix for the store id.
     * @return string		A store id.
     * @since	1.6
     */
    protected function getStoreId($id = '') {
        // Compile the store id.
        $id .= ':' . $this->getState('filter.search');
        $id .= ':' . $this->getState('filter.published');
        $id .= ':' . $this->getState('filter.templte_id');

        return parent::getStoreId($id);
    }

    /**
     * Build an SQL query to load the list data.
     * @return	JDatabaseQuery
     * @since	1.6
     */
    protected function getListQuery() {
        //Create a new query object.
        $db = $this->getDbo();
        $query = $db->getQuery(true);

        //Select the required fields from the tables.
        $query->select(
                $this->getState(
                        'list.select',
                        'a.*,s.setting_title,t.title'
                )
        );
        $query->from('#__fb_pages AS a');
        $query->leftJoin('#__fb_settings AS s ON s.api_id = a.title');
        $query->leftJoin('#__fb_templates AS t ON t.id = a.template_id');

        // Filter by published state
        $published = $this->getState('filter.published');
        if (is_numeric($published)) {
            $query->where('a.published = ' . (int) $published);
        } else if ($published === '') {
            $query->where('(a.published = 0 OR a.published = 1)');
        }

        //Search word
        $search = $this->getState('filter.search');
        if (!empty($search)) {
            if (stripos($search, 'id:') === 0) {
                $query->where('a.id = ' . (int) substr($search, 3));
            } else {
                $search = $db->Quote('%' . $db->getEscaped($search, true) . '%');
                $query->where('(s.setting_title LIKE ' . $search . ')');
            }
        }
        $query->order('s.setting_title ASC');
        return $query;
    }

}
