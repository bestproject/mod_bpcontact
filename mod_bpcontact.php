<?php

defined('_JEXEC') or die;

// Include the syndicate functions only once
require_once __DIR__ . '/helper.php';

// Get form object from com_contact
/* @var $form JForm */
$form = ModBPContactHelper::getForm($params);

// If this is a single contact mode get only data of a single contact
if( $params->get('mode','single')=='signle' ) {
	$contact = ModBPContactHelper::getContact($params);

// Its a list mode (category,flag or grouped) so get a list of contacts
} else {
	
	$list = ModBPContactHelper::getContactsList($params);
}

// Module classes prefix
$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));

// Render module output
require JModuleHelper::getLayoutPath('mod_bpcontact', $params->get('layout', 'default'));
