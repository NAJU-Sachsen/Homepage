
<!-- mod_social_media -->

<?php
$group_id = 'REX_VALUE[1]';
$group_query = 'select facebook, instagram from naju_contact_info where group_id = :id';
$group = rex_sql::factory()->setQuery($group_query, ['id' => $group_id])->getArray()[0];

$include_heading = 'REX_VALUE[2]' == 'true';
?>

<div class="mt-3">
    <?php if ($include_heading) : ?>
    <h3>Social Media</h3>
    <?php endif; ?>
    <?php if ($group['facebook']) : ?>
    <a href="<?= $group['facebook']; ?>" target="_blank" rel="noopener noreferrer" class="link-mute mr-4">
        <picture>
            <source type="image/webp" srcset="/assets/facebook-logo.webp">
            <img src="/assets/facebook-logo.png" alt="Logo of the Facebook social network" class="social-logo">
        </picture>
    </a>
    <?php endif; ?>
    <?php if ($group['instagram']) : ?>
    <a href="https://instagram.com/<?= $group['instagram']; ?>" target="_blank" rel="noopener noreferrer" class="link-mute mr-4">
        <picture>
            <source type="image/webp" srcset="/assets/instagram-logo.webp">
            <img src="/assets/instagram-logo.png" alt="Logo of the Instagram social network" class="social-logo">
        </picture>
    </a>
	<?php endif; ?>
	<?php if ($group['whatsapp']) : ?>
    <a href="<?= $group['whatsapp']; ?>" target="_blank" rel="noopener noreferrer" class="link-mute mr-4">
        <picture>
            <source type="image/webp" srcset="/assets/whatsapp-logo.webp">
            <img src="/assets/whatsapp-logo.png" alt="Logo of the Whatsapp messenger" class="social-logo">
        </picture>
    </a>
	<?php endif; ?>
	<?php if ($group['telegram']) : ?>
    <a href="<?= $group['telegram']; ?>" target="_blank" rel="noopener noreferrer" class="link-mute mr-4">
        <picture>
            <source type="image/webp" srcset="/assets/telegram-logo.webp">
            <img src="/assets/telegram-logo.png" alt="Logo of the Telegram messenger" class="social-logo">
        </picture>
    </a>
    <?php endif; ?>
</div>
