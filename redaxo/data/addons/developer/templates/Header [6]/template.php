<!-- temp_header -->

<header id="top-bar">
    <a href="/">
        <?php
        $logo = rex_escape(naju_article::getLogoForCurrentLocalGroup());
        $logo_name = pathinfo($logo, PATHINFO_FILENAME);
        $webp_logo = $logo_name . '.webp';
        ?>
        <h1 class="text-hide naju-logo webp-fallback" style="background-image: url('/assets/<?= $webp_logo; ?>');" data-webp-fallback="/assets/<?= $logo; ?>">NAJU Sachsen</h1>
    </a>
</header>
