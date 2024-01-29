<!-- mod_home_navigation -->

<div id="quick-nav-wrapper" class="container-fluid mb-3">
    <div class="row">
        <nav id="quick-nav" class="col-lg-8 offset-lg-2 col-md-12">
            <ul class="nav-primary">

                <?php foreach (explode(',', 'REX_LINKLIST[id=1]') as $article_id) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= rex_getUrl($article_id); ?>">
                            <?= rex_article::get($article_id)->getName(); ?>
                        </a>
                    </li>
                <?php endforeach; ?>

            </ul>
        </nav>
    </div>
</div>
