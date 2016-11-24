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

		$query->select('a.*, CONCAT(a.id,":",a.alias) AS `slug`');
		$query->from('#__contact_details AS a');

		// Only published contacts
		$query->where('a.published=1');

		// If this is a category list mode
		if( $params->get('mode','flat')=='category' ) {

			// Limit to a category
			$query->where('a.catid='.(int)$params->get('category_id'));

			// Join over categories list
			$query->leftJoin('#__categories AS b ON b.id=a.catid');
			$query->select('b.title AS `category_title`, b.alias as `category_alias`, CONCAT(b.id,":",b.alias) AS `category_slug`');
			$query->where('b.published=1');

			// Ordering by ordering field
			if( $params->get('order','ordering') ) {
				$query->order('b.lft ASC, a.ordering ASC');

			// Ordering by title (default)
			} else {
				$query->order('b.title ASC, a.title ASC');
			}

		// This is a grouped list mode
		} elseif( $params->get('mode','flat')=='grouped' ) {

			// Join over categories
			$query->leftJoin('#__categories AS b ON b.id=a.catid');
			$query->select('b.title AS `category_title`, b.alias as `category_alias`, CONCAT(b.id,":",b.alias) AS `category_slug`');
			$query->where('b.published=1');
			
			// Order by ordering field
			if( $params->get('order','ordering') ) {
				$query->order('b.lft ASC, a.ordering ASC');

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

	/**
	 * Return a JFormField object that can be used in rendering inside module layout.
	 *
	 * @param	\JForm	$form		A contact form instance.
	 * @param	String	$mode		Mode of the module.
	 * @param	Array	$contacts	A list of contacts for the field.
	 * 
	 * @return	\JFormFieldList
	 */
	public static function getContactsListField($form, $mode, $contacts){

		// If this is a simple contacts list field
		if( $mode === 'category' OR $mode==='flat' ) {
			$xml = '<field name="id" type="list" hint="Testing" label="MOD_BPCONTACT_LAYOUT_SELECT_CONTACT_LABEL" description="MOD_BPCONTACT_LAYOUT_SELECT_CONTACT_DESC">';
			foreach( $contacts AS $contact ) {
				$xml.= '<option value="'.$contact->slug.'">'.$contact->name.'</option>';
			}
			$xml.= '</field>';

			// Create a JField instance from provided XML
			require_once JPATH_SITE.'/libraries/joomla/form/fields/list.php';
			$field = new JFormFieldList($form);
			$field->setup(new SimpleXMLElement($xml),'','contact2');

		} elseif( $mode==='grouped' ) {

			// Prepare a JForm field XML for grouped contacts list
			$xml = '<field name="id" type="groupedlist" hint="Testing" label="MOD_BPCONTACT_LAYOUT_SELECT_CONTACT_LABEL" description="MOD_BPCONTACT_LAYOUT_SELECT_CONTACT_DESC">';
			$contacts_count = count($contacts);
			foreach( $contacts AS $idx=>$contact ) {
				// This is a group starting so prepare its XML
				if( $idx===0 OR ($idx>0 AND $contact->category_title!==$contacts[$idx-1]->category_title) ) {
					if( $idx>0 ) {
						$xml.='</group>';
					}
					$xml.= '<group label="'.$contact->category_title.'">';
				}

				// Add category entry
				$xml.= '<option value="'.$contact->slug.'">'.$contact->name.'</option>';

				// This is the last list element so close the group
				if( $idx+1 === $contacts_count ) {
					$xml.= '</group>';
				}
			}
			$xml.= '</field>';

			// Create a JField instance from provided XML
			require_once JPATH_SITE.'/libraries/joomla/form/fields/groupedlist.php';
			$field = new JFormFieldGroupedList($form);
			$field->setup(new SimpleXMLElement($xml),'','contact2');

		// No need to prepare contacts field
		} else {

			$field = null;

		}

		return $field;
	}

}
