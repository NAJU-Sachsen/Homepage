
<!-- mod_contact_info -->

<?php

$local_group = REX_VALUE[1];
$show_headline = REX_VALUE[2] == 'true';

$contact_info = rex_sql::factory()->setQuery(
        'select office_name, street, city, email, phone from naju_contact_info where group_id = :id', ['id' => $local_group])
    ->getArray()[0];

?>

<?php if ($show_headline) : ?>
<h3>Kontakt</h3>
<?php endif; ?>

<address>
    <?php if ($contact_info['office_name']) echo htmlspecialchars($contact_info['office_name']) . ':<br>'; ?>
    <?php if ($contact_info['street']) echo htmlspecialchars($contact_info['street']) . '<br>'; ?>
    <?php if ($contact_info['city']) echo htmlspecialchars($contact_info['city']) . '<br>'; ?>
    <?php
        if ($contact_info['email']) {
            $email = $contact_info['email'];
            echo '<a href="mailto:' . htmlspecialchars(urlencode($email)) . '" class="contact-link">' . htmlspecialchars($email) . '</a><br>';
        }
    ?>
    <?php
        if ($contact_info['phone']) {
            $phone = $contact_info['phone'];
            echo '<a href="mailto:' . htmlspecialchars(urlencode($phone)) . '" class="contact-link">' . htmlspecialchars($phone) . '</a><br>';
        }
    ?>
</address>
