<!doctype html>

<?php
$ua = strtolower($_SERVER['HTTP_USER_AGENT']);
$is_ios = str_contains($ua, 'iphone') || str_contains($ua, 'ipad');
?>

<html lang="de" <?= $is_ios ? 'ontouchmove' : ''; ?>>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?= rex_escape($this->getValue('name')); ?> | NAJU <?= rex_escape(naju_article::determineCurrentLocalGroup()); ?></title>
  <link rel="preload" href="/fonts/SourceSansPro-Regular.ttf" as="font" type="font/ttf" crossorigin="anonymous">
  <link rel="preload" href="/fonts/Amaranth-Regular.ttf" as="font" type="font/ttf" crossorigin="anonymous">
  <link rel="icon" href="/assets/favicon.ico">
  <link rel="stylesheet" href="/css/kernel.css">

  <?= 'REX_TEMPLATE[key=template-head-meta]' ?>

</head>
<body class="container-fluid">

<div id="complete-wrapper">
  <div id="top-bar-wrapper" class="row">

    <?= 'REX_TEMPLATE[key=template-header]'; ?>

  </div>
  <div id="nav-content-wrapper" class="row justify-content-center">

    <?= 'REX_TEMPLATE[key=template-nav]'; ?>

    <div id="content-wrapper" class="col-lg-8 col-md-12">
      <!-- Main content -->
      <main id="content" class="clearfix">
        <?php if ($this->getValue('art_custom_title') !== '|true|') : ?>
        <header>
          <h2 class="page-title"><?= rex_escape($this->getValue('name')); ?></h2>
        </header>
        <?php endif; ?>
        REX_ARTICLE[ctype=1]
      </main>
    </div>

    <!-- Side bar -->
    <?php if($this->getValue('art_has_sidebar') == '|true|') : ?>
    <aside id="at-a-glance" class="col-lg-2 border border-right-0 rounded-left">
      <h2>Auf einen Blick</h2>
      <?php
        define('SIDEBAR_CTYPE', 2);

        $article_id = rex_article::getCurrent()->getId();
        $slices = rex_article_slice::getSlicesForArticle($article_id);

        foreach ($slices as $slice) {
          // only print slices for the sidebar (ctype=2)
          if ($slice->getCtype() != SIDEBAR_CTYPE) {
            continue;
          }

          // wrap the slice in a section and print its contents
          echo '<section class="glance-section">';
          echo $slice->getSlice();
          echo '</section>';
        }
      ?>
    </aside>
    <?php endif; ?>

  </div>

  REX_TEMPLATE[key=template-footer-copyright]

  REX_TEMPLATE[key=template-footer-navigation]

</div>

<script src="/js/jquery-3.5.1.js"></script>
<script src="/js/popper.js"></script>
<script src="/js/bootstrap.js"></script>
<script src="/js/site.js"></script>
<script src="/js/compat.js"></script>

</body>
</html>

<?php naju_stats::logVisitor(); ?>
