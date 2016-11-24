<?php

defined('_JEXEC') or die;

// Include the syndicate functions only once
require_once __DIR__ . '/helper.php';

// Get form object from com_contact
/* @var $form JForm */
$form = ModBPContactHelper::getForm($params);

// If this is a single contact mode get only data of a single contact
if( $params->get('mode','single')=='single' ) {
	$contact = ModBPContactHelper::getContact($params);

// Its a list mode (category,flag or grouped) so get a list of contacts
} else {
	
	$contacts = ModBPContactHelper::getContactsList($params);
}

// Module classes prefix
$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));
$display_headers = (bool)$params->get('display_headers','1');

// Form params
$mode = $params->get('mode','single');
$display_form = (bool)$params->get('display_form','1');
$display_form_copy = $params->get('display_form_copy','1') AND (($display_form AND $mode==='single') OR in_array($mode, array('category','grouped','flat')));
$field_id = ModBPContactHelper::getContactsListField($form, $mode, isset($contacts)? $contacts : array($contact));
$display_labels = (bool)$params->get('display_labels','1');

// Contact informations params
// @TODO

// Render module output
require JModuleHelper::getLayoutPath('mod_bpcontact', $params->get('layout', 'default'));
