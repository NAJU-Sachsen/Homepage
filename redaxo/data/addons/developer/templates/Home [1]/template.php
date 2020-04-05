<!doctype html>

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars($this->getValue('name')); ?> | NAJU Sachsen</title>
    <link rel="icon" href="/assets/favicon.ico">
    <link rel="stylesheet" href="/css/kernel.css">

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
      
      <main>

        REX_ARTICLE[ctype=1]        

        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-8 offset-lg-2">
              <section id="content">
                <article>
                  <header>
                    <h1 class="page-title">NAJU Sachsen</h1>
                  </header>
                  REX_ARTICLE[ctype=2]
                </article>
              </section>
            </div>
          </div>
        </div>

      </main>

    </div>

  </div>

  REX_TEMPLATE[key=template-footer-copyright]

  REX_TEMPLATE[key=template-footer-navigation]

</div>

<script src="/js/jquery-3.3.1.js"></script>
<script src="/js/popper.js"></script>
<script src="/js/bootstrap.js"></script>

</body>
</html>

<?php naju_stats::logVisitor(); ?>
