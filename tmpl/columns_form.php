<?php defined('_JEXEC') or die;
/* @var $field JFormField */
/* @var $field_id JFormField */
/* @var $form JForm */
?>
<form action="<?php echo JRoute::_('index.php'); ?>" method="post" class="form-validate">
	<?php if( $display_headers ): ?>
	<h3><?php echo JText::_('MOD_BPCONTACT_LAYOUT_HEADING_FORM') ?></h3>
	<?php endif ?>

	<div class="row">
		<div class="col-xs-12 col-sm-6">
			<?php if( $mode!=='single' ): ?>
				<div class="form-group">
					<?php
					$options = array();
					if( !$display_labels ) {
						$form->setFieldAttribute('id', 'hint', $field_id->getAttribute('label'));
						$options['hiddenLabel'] = true;
					}
					echo str_ireplace('<select ', '<select class="form-control"', $field_id->renderField($options)) ?>
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
					$fieldName = $field->getAttribute('name');
					if( $field->getAttribute('type')!='spacer' AND $field->getAttribute('name')!='contact_email_copy' AND $field->getAttribute('name')!='contact_message' ) {
						if( !$display_labels ) {
							$form->setFieldAttribute($fieldName, 'hint', $field->getAttribute('label'));
							$form->setFieldAttribute($fieldName, 'hiddenLabel', true);
						}
						$form->setFieldAttribute($fieldName, 'class', 'form-control');
						echo str_ireplace('control-group', 'form-group', $form->renderField($fieldName));
					} elseif( $field->getAttribute('name')=='contact_email_copy' AND $display_form_copy ) {
						echo '<div class="form-group">'.str_ireplace('">', '">'.$form->getInput('contact_email_copy'), $form->getLabel('contact_email_copy')).'</div>';
					}
				} ?>
			</div>
			<?php endforeach ?>
		</div>
		<div class="col-xs-12 col-sm-6">
			<?php
			$fieldsets = $form->getFieldsets();
			foreach($fieldsets AS $fieldset):
			$fields = $form->getFieldset($fieldset->name);
			?>
			<div class="group">
				<?php
				foreach( $fields AS $field ){
					$fieldName = $field->getAttribute('name');
					if( $field->getAttribute('name')==='contact_message' ) {
						if( !$display_labels ) {
							$form->setFieldAttribute($fieldName, 'hint', $field->getAttribute('label'));
							$form->setFieldAttribute($fieldName, 'hiddenLabel', true);
						}
						$form->setFieldAttribute($fieldName, 'class', 'form-control');
						echo str_ireplace('control-group', 'form-group', $form->renderField($fieldName));
					}
				} ?>
			</div>
			<?php endforeach ?>
		</div>
	</div>

	<div class="form-actions">
		<input name="submit" type="submit" class="btn btn-primary" value="<?php echo JText::_('MOD_BPCONTACT_FORM_SUBMIT') ?>"/>
	</div>

	<input type="hidden" name="option" value="com_contact" />
	<input type="hidden" name="task" value="contact.submit" />
	<input type="hidden" name="return" value="<?php echo JURI::current() ?>" />
	<?php echo JHtml::_('form.token') ?>
</form>