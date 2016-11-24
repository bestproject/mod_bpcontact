<?php defined('_JEXEC') or die;

?>
<?php if( $display_headers ): ?>
<h3><?php echo JText::_('MOD_BPCONTACT_LAYOUT_HEADING_INFO') ?></h3>
<?php endif ?>

<?php if( !empty($contact->name) AND (bool)$params->get('display_name','1') ): ?>
	<h4><?php echo $contact->name ?></h4>
<?php endif ?>

<?php if( !empty($contact->misc) AND (bool)$params->get('display_misc','1') ): ?>
	<div class="misc"><?php echo $contact->misc ?></div>
<?php endif ?>

<?php if( !empty($contact->position) AND (bool)$params->get('display_position','1') ): ?>
	<div class="position"><?php echo $contact->position ?></div>
<?php endif ?>
	
<address>
	<?php if( !empty($contact->address) AND (bool)$params->get('display_address','1') ): ?>
		<div class="address"><?php echo $contact->address ?></div>
	<?php endif ?>

	<?php if( !empty($contact->suburb) AND (bool)$params->get('display_suburb','1') ): ?>
		<div class="suburb"><?php echo $contact->suburb ?></div>
	<?php endif ?>

	<?php if( !empty($contact->state) AND (bool)$params->get('display_state','1') ): ?>
		<div class="state"><?php echo $contact->state ?></div>
	<?php endif ?>

	<?php if( !empty($contact->post) AND (bool)$params->get('display_post','1') ): ?>
		<div class="post"><?php echo $contact->post ?></div>
	<?php endif ?>

	<?php if( !empty($contact->country) AND (bool)$params->get('display_country','1') ): ?>
		<div class="country"><?php echo $contact->country ?></div>
	<?php endif ?>
</address>

<?php if( !empty($contact->email_to) AND (bool)$params->get('display_email','1') ): ?>
	<div class="email">
		<a href="mailto:<?php echo $contact->email_to ?>"><?php echo $contact->email_to ?></a>
	</div>
<?php endif ?>

<?php if( !empty($contact->telephone) AND (bool)$params->get('display_telephone','1') ): ?>
	<div class="telephone"><span><?php echo JText::_('MOD_BPCONTACT_LAYOUT_TELEPHONE') ?></span><a href="tel:<?php echo $contact->telephone ?>"><?php echo $contact->telephone ?></a></div>
<?php endif ?>

<?php if( !empty($contact->mobile) AND (bool)$params->get('display_mobile','1') ): ?>
	<div class="mobile"><span><?php echo JText::_('MOD_BPCONTACT_LAYOUT_MOBILE') ?></span><a href="tel:<?php echo $contact->mobile ?>"><?php echo $contact->mobile ?></a></div>
<?php endif ?>

<?php if( !empty($contact->fax) AND (bool)$params->get('display_fax','1') ): ?>
	<div class="fax"><span><?php echo JText::_('MOD_BPCONTACT_LAYOUT_FAX') ?></span><a href="fax:<?php echo $contact->fax ?>"><?php echo $contact->fax ?></a></div>
<?php endif ?>
	
<?php if( !empty($contact->webpage) AND (bool)$params->get('display_webpage','1') ): ?>
	<div class="webpage">
		<span><?php echo JText::_('MOD_BPCONTACT_LAYOUT_WEBPAGE') ?></span><a href="<?php echo $contact->webpage ?>"><?php echo str_ireplace(array('http://','https://'), array('',''), $contact->webpage) ?></a>
	</div>
<?php endif ?>

<?php
$linka = trim($contact->params->get('linka'));
$linka_name = trim($contact->params->get('linka_name'));
if( !empty($linka) AND (bool)$params->get('display_links','1') ): ?>
	<div class="link linka">
		<a href="<?php echo $linka ?>">
			<?php echo (!empty($linka_name) ? $linka_name : str_ireplace(array('http://','https://'), array('',''), $linka)) ?>
		</a>
	</div>
<?php endif ?>

<?php
$linkb = trim($contact->params->get('linkb'));
$linkb_name = trim($contact->params->get('linkb_name'));
if( !empty($linkb) AND (bool)$params->get('display_links','1') ): ?>
	<div class="link linkb">
		<a href="<?php echo $linkb ?>">
			<?php echo (!empty($linkb_name) ? $linkb_name : str_ireplace(array('http://','https://'), array('',''), $linkb)) ?>
		</a>
	</div>
<?php endif ?>

<?php
$linkc = trim($contact->params->get('linkc'));
$linkc_name = trim($contact->params->get('linkc_name'));
if( !empty($linkc) AND (bool)$params->get('display_links','1') ): ?>
	<div class="link linkc">
		<a href="<?php echo $linkc ?>">
			<?php echo (!empty($linkc_name) ? $linkc_name : str_ireplace(array('http://','https://'), array('',''), $linkc)) ?>
		</a>
	</div>
<?php endif ?>

<?php
$linkd = trim($contact->params->get('linkd'));
$linkd_name = trim($contact->params->get('linkd_name'));
if( !empty($linkd) AND (bool)$params->get('display_links','1') ): ?>
	<div class="link linkd">
		<a href="<?php echo $linkd ?>">
			<?php echo (!empty($linkd_name) ? $linkd_name : str_ireplace(array('http://','https://'), array('',''), $linkd)) ?>
		</a>
	</div>
<?php endif ?>

<?php
$linke = trim($contact->params->get('linke'));
$linke_name = trim($contact->params->get('linke_name'));
if( !empty($linke) AND (bool)$params->get('display_links','1') ): ?>
	<div class="link linke">
		<a href="<?php echo $linke ?>">
			<?php echo (!empty($linke_name) ? $linke_name : str_ireplace(array('http://','https://'), array('',''), $linke)) ?>
		</a>
	</div>
<?php endif ?>