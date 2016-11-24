<?php defined('_JEXEC') or die;

$has_form = (bool)$params->get('display_form','1');
$has_informations = ((bool)$params->get('display_info','1') AND $params->get('mode','single')==='single' AND $params->get('contact_id')>0);
?>
<div class="modbpcontact<?php echo $moduleclass_sfx ?>">
	<div class="row">
		<?php if( $has_informations ): ?>
		<div class="<?php echo ($has_form ? 'col-xs-12 col-sm-6':'col-xs-12') ?>">
			<?php include JModuleHelper::getLayoutPath('mod_bpcontact', $params->get('layout', 'default').'_informations'); ?>
		</div>
		<?php endif ?>
		<?php if( $has_form ): ?>
		<div class="<?php echo ($has_informations ? 'col-xs-12 col-sm-6':'col-xs-12') ?>">
			<?php include JModuleHelper::getLayoutPath('mod_bpcontact', $params->get('layout', 'default').'_form'); ?>
		</div>
		<?php endif ?>
	</div>
</div>
