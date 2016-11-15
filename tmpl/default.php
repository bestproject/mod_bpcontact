<?php defined('_JEXEC') or die;

?>
<div class="modbpcontact<?php echo $moduleclass_sfx ?>">
	<div class="row">
		<div class="col-sm-6">
			<form action="<?php echo JRoute::_('index.php'); ?>" method="post" class="form-validate">
				<h3><?php echo JText::_('MOD_BPCONTACT_FORM_HEADING') ?></h3>
				<?php $fieldsets = $form->getFieldsets();
				
				foreach($fieldsets AS $fieldset):
				$fields = $form->getFieldset($fieldset->name); 
				?>
				<div class="group">
					<?php	foreach( $fields AS $field ){
						echo $form->renderField($field->getAttribute('name'));
					} ?>
				</div>
				<?php endforeach ?>
				<div class="form-actions">
					<input name="submit" type="submit" class="btn btn-primary" value="<?php echo JText::_('MOD_BPCONTACT_FORM_SUBMIT') ?>"/>
				</div>
				<input type="hidden" name="option" value="com_contact" />
				<input type="hidden" name="task" value="contact.submit" />
				<input type="hidden" name="return" value="<?php echo JURI::current() ?>" />
				<input type="hidden" name="id" value="<?php echo $contact->slug ?>" />
				<?php echo JHtml::_('form.token') ?>
			</form>
		</div>
		<div class="col-sm-6">
			<h3><?php echo JText::_('MOD_BPCONTACT_INFO_HEADING') ?></h3>
			<?php if( !empty($contact->address) ): ?>
				<h4><?php echo JText::_('MOD_BPCONTACT_INFO_ADDRESS') ?>:</h4>
				<div class="address"><?php echo $contact->address ?></div>
			<?php endif ?>
			
			<?php if( !empty($contact->telephone) ): ?>
				<h4><?php echo JText::_('MOD_BPCONTACT_INFO_PHONE') ?>:</h4>
				<div class="address"><?php echo $contact->telephone ?></div>
			<?php endif ?>
				
			<?php if( !empty($contact->email_to) ): ?>
				<h4><?php echo JText::_('MOD_BPCONTACT_INFO_EMAIL') ?>:</h4>
				<div class="email"><?php echo $contact->email_to ?></div>
			<?php endif ?>
		</div>
	</div>
</div>
