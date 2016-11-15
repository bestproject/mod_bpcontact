<?php

defined('_JEXEC') or die;

// Load Contact model
JLoader::register('ContactModelContact', JPATH_SITE.'/components/com_contact/models/contact.php');

/**
 * Helper for mod_bpcontact
 */
class ModBPContactHelper {

	/**
	 * Retrieve contact form from com_contact.
	 *
	 * @return  JForm
	 */
	public static function &getForm() {
		JForm::addFormPath(JPATH_SITE.'/components/com_contact/models/forms');
		$form = JForm::getInstance('com_contact.contact', 'contact', array('control' => 'jform'));

		return $form;
	}


	/**
	 * Returns a list of contacts.
	 *
	 * @param	\Joomla\Registry\Registry	$params	Module parameters object.
	 *
	 * @return	Array
	 */
	public static function &getContactsList(&$params) {

		// Get Database object and create new query
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);

		$query->select('a.*');
		$query->from('#__contact_details AS a');

		// Only published contacts
		$query->where('a.state=1');

		// If this is a category list mode
		if( $params->get('list_mode','all')=='category' ) {

			// Limit to a category
			$query->where('a.catid='.(int)$params->get('category_id'));

			// Join over categories list
			$query->leftJoin('#__categories AS b ON b.id=a.catid');
			$query->select('b.title AS `category_title`, b.alias as `category_alias`, CONCAT(b.id,":",b.alias) AS `slug`');
			$query->where('b.state=1');

			// Ordering by ordering field
			if( $params->get('order','ordering') ) {
				$query->order('b.ordering ASC, a.ordering ASC');

			// Ordering by title (default)
			} else {
				$query->order('b.title ASC, a.title ASC');
			}

		// This is a grouped list mode
		} elseif( $params->get('list_mode','all')=='grouped' ) {

			// Join over categories
			$query->leftJoin('#__categories AS b ON b.id=a.catid');
			$query->select('b.title AS `category_title`, b.alias as `category_alias`, CONCAT(b.id,":",b.alias) AS `slug`');
			$query->where('b.state=1');
			
			// Order by ordering field
			if( $params->get('order','ordering') ) {
				$query->order('b.ordering ASC, a.ordering ASC');

			// Order by title (default)
			} else {
				$query->order('b.title ASC, a.title ASC');
			}

		// This a a flat list
		} else {
			
			// Order by ordering field
			if( $params->get('order','ordering') ) {
				$query->order('a.ordering ASC');

			// Order by title (default)
			} else {
				$query->order('a.title ASC');
			}
		}

		// Load contacts list from database
		$db->setQuery($query);
		$list = $db->loadObjectList();

		return $list;
	}

	/**
	 * Get object containing the data of a single contact.
	 *
	 * @param	\Joomla\Registry\Registry	$params	Module parameters object.
	 *
	 * @return JTable
	 */
	public static function &getContact(&$params) {
		$model = JModelForm::getInstance('Contact', 'ContactModel');
		$contact = $model->getItem($params->get('contact_id'));
		
		return $contact;
	}

}
