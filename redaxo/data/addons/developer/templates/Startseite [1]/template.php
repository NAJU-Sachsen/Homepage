<!doctype html>

<?php
$ua = strtolower($_SERVER['HTTP_USER_AGENT']);
$is_ios = str_contains($ua, 'iphone') || str_contains($ua, 'ipad');
?>

<html lang="de" <?= $is_ios ? 'ontouchmove' : ''; ?>>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= rex_escape($this->getValue('name')); ?> | NAJU Sachsen</title>
    <link rel="preload" href="/fonts/SourceSansPro-Regular.ttf" as="font" type="font/ttf" crossorigin="anonymous">
    <link rel="preload" href="/fonts/Amaranth-Regular.ttf" as="font" type="font/ttf" crossorigin="anonymous">
    <link rel="icon" href="/assets/favicon.ico">
    <link rel="stylesheet" href="/css/kernel.css" type="text/css">

    REX_TEMPLATE[key=template-head-meta]

</head>
<body class="container-fluid">
<div id="complete-wrapper">
  <div id="top-bar-wrapper" class="row">

    REX_TEMPLATE[key=template-header]

  </div>
  <div id="nav-content-wrapper" class="row">

    <div id="content-wrapper" class="col-lg-12 col-md-12 col-sm-12">
      <!-- Main content -->

      <main class="clearfix">

        REX_ARTICLE[ctype=1]

        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-8 offset-lg-2">
              <div id="content">
                <article>
                  <header>
                    <h2 class="h1 page-title">REX_ARTICLE[ctype=3]</h2>
                  </header>
                  REX_ARTICLE[ctype=2]
                </article>
              </div>
            </div>
          </div>
        </div>

      </main>

    </div>

  </div>

  REX_TEMPLATE[key=template-footer-copyright]

  REX_TEMPLATE[key=template-footer-navigation]

</div>

</body>
</html>

<?php naju_stats::logVisitor(); ?>
