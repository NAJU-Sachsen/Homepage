
<!-- mod_blog_teaser -->

<?php

$show_newest = 'REX_VALUE[id=3 ifempty=false]' === 'true';
$newest_count = 'REX_VALUE[id=1 ifempty=2]';
$newest_blog = 'REX_VALUE[id=4 ifempty=all]';
$manual_articles = 'REX_VALUE[id=2]';
$sql = rex_sql::factory();

if ($show_newest) {
    $criteria = $newest_blog == 'all' ? '' : ' AND article_blog = ' . $newest_blog;
    $query = 'SELECT article_title, article_id, article_image, article_intro, blog_page
        FROM naju_blog_article JOIN naju_blog ON article_blog = blog_id
        WHERE article_status = "published" ' . $criteria . '
        ORDER BY article_published
        LIMIT ' . $newest_count;
    $articles = $sql->getArray($query);
} else {
    $manual_articles = rex_var::toArray($manual_articles);
    $article_ids = array();
    foreach ($manual_articles as $article) {
        $article_ids[] = $article['article_id'];
    }
    $article_ids = implode(', ', $article_ids);
    $query = 'SELECT article_title, article_id, article_image, article_intro, blog_page
        FROM naju_blog_article JOIN naju_blog ON article_blog = blog_id
        WHERE article_id IN (' . $article_ids . ') AND article_status = "published"
        ORDER BY article_published';
    $articles = $sql->getArray($query);
}

$content = '';

$content .= '<div class="blog-teaser container-fluid"><div class="row row-cols-1 row-cols-lg-3">';

foreach ($articles as $article) {
    $card = '<div class="col mb-4"><article class="card">';
    if ($article['article_image']) {
        $img = new naju_image($article['article_image']);
        $card .= $img->generatePictureTag(['card-img-top']);
    }
    $card .= '<div class="card-body">';
    $card .= '  <h4 class="card-title">' . naju::escape($article['article_title']) . '</h4>';
    $card .= '  <p class="card-text">' . rex_escape($article['article_intro']) . '</p>';
    $card .= '</div>'; // <div class=card-body>
    $card .= '<footer class="card-footer">';
    $card .= '  <a class="btn btn-primary" href="' . rex_getUrl($article['blog_page'], null, ['blog_article' => $article['article_id']]) . '">Weiterlesen</a>';
    $card .= '</footer>';
    $card .= '</article></div>';

    $content .= $card;
}

$content .= '</div></div>'; // <div class=blog-teaser>
echo $content;
