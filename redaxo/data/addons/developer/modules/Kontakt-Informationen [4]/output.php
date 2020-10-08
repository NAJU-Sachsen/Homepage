
<!-- mod_contact_info -->

<?php

$local_group = 'REX_VALUE[1]';
$show_headline = 'REX_VALUE[2]' == 'true';
$show_business_headline = 'REX_VALUE[3]' == 'true';

$contact_info = rex_sql::factory()->setQuery(
        'select office_name, business_hours, street, city, email, phone from naju_contact_info where group_id = :id', ['id' => $local_group]
				)->getArray()[0];

?>

<div class="mt-3">
	<?php if ($show_headline) : ?>
	<h3>Kontakt</h3>
	<?php endif; ?>

	<address>
		<?php if ($contact_info['office_name']) echo rex_escape($contact_info['office_name']) . ':<br>'; ?>
		<?php if ($show_business_headline)
			echo '<span class="font-italic">Öffnungszeiten</span>
				  <p class="address business-hours">' . nl2br(rex_escape($contact_info['business_hours'])) . '</p>'
		?>
	    <?php if ($contact_info['street']) echo rex_escape($contact_info['street']) . '<br>'; ?>
	    <?php if ($contact_info['city']) echo rex_escape($contact_info['city']) . '<br>'; ?>
	    <?php
	        if ($contact_info['email']) {
	            $email = $contact_info['email'];
	            echo '<a href="mailto:' . rex_escape(rex_escape($email, 'url')) . '" class="contact-link">' . rex_escape($email) . '</a><br>';
	        }
	    ?>
	    <?php
	        if ($contact_info['phone']) {
	            $phone = $contact_info['phone'];
	            echo '<a href="tel:' . rex_escape(rex_escape($phone, 'url')) . '" class="contact-link">' . rex_escape($phone) . '</a><br>';
	        }
	    ?>
	</address>
</div>
