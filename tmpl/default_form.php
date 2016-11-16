<?php defined('_JEXEC') or die;

?>
<form action="<?php echo JRoute::_('index.php'); ?>" method="post" class="form-validate">
	<h3><?php echo JText::_('MOD_BPCONTACT_LAYOUT_HEADING_FORM') ?></h3>
	<?php if( $mode!=='single' ): ?>
		<div class="group">
			<?php echo $field_id->renderField() ?>
		</div>
	<?php else: ?>
		<input type="hidden" name="id" value="<?php echo $contact->slug ?>" />
	<?php endif ?>
	<?php
	$fieldsets = $form->getFieldsets();
	foreach($fieldsets AS $fieldset):
	$fields = $form->getFieldset($fieldset->name);
	?>
	<div class="group">
		<?php	
		foreach( $fields AS $field ){
			if( $field->getAttribute('type')!='spacer' AND $field->getAttribute('name')!='contact_email_copy' ) {
				echo $form->renderField($field->getAttribute('name'));
			} elseif( $field->getAttribute('name')=='contact_email_copy' AND $display_form_copy ) {
				echo '<div class="control-group">'.$form->getInput('contact_email_copy').$form->getLabel('contact_email_copy').'</div>';
			}
		} ?>
	</div>
	<?php endforeach ?>
	<div class="form-actions">
		<input name="submit" type="submit" class="btn btn-primary" value="<?php echo JText::_('MOD_BPCONTACT_FORM_SUBMIT') ?>"/>
	</div>
	<input type="hidden" name="option" value="com_contact" />
	<input type="hidden" name="task" value="contact.submit" />
	<input type="hidden" name="return" value="<?php echo JURI::current() ?>" />
	<?php echo JHtml::_('form.token') ?>
</form>