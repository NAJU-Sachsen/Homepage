
<!-- mod_blog_articles -->

<?php
$blog_id = 'REX_VALUE[id=1 ifempty=all]';

if ($blog_id === 'all') {
    $n_articles = naju_kvs::getOrInflate('naju.blogs.all.count', "SELECT COUNT(*) AS count FROM naju_blog_article WHERE article_status = 'published'");
} else {
    $n_articles = naju_kvs::getOrInflate("naju.blogs.$blog_id.count",
        "SELECT COUNT(*) AS count FROM naju_blog_article WHERE article_status = 'published' AND article_blog = :blog", ['blog' => $blog_id]);
}

$sql = rex_sql::factory();
$offset = rex_get('offset', 'string', '0');
$offset = ctype_digit($offset) ? intval($offset) : 0;
$limit = 3;
$projection = 'article_title, article_subtitle, article_link, article_link_text, article_image, article_content, article_published, article_updated';
if ($blog_id === 'all') {
    $query = "SELECT $projection
              FROM naju_blog_article
              WHERE article_status = 'published'
              ORDER BY article_published DESC, article_title ASC
              LIMIT $limit OFFSET $offset";
    $sql->setQuery($query);
} else {
    $query = "SELECT $projection
              FROM naju_blog_article
              WHERE article_status = 'published' AND article_blog = :blog
              ORDER BY article_published DESC, article_title ASC
              LIMIT $limit OFFSET $offset";
    $sql->setQuery($query, ['blog' => $blog_id]);
}

$content = '';
$articles = $sql->getArray();

$content .= '
    <div class="container-fluid">
        <div class="row">    
            <div class="col-12 list-group list-group-flush news-blog">';

foreach ($articles as $article) {
    $content .= '
        <article class="list-group-item news-item">
            <header class="w-100 justify-content-between news-item-header">
                <h3 class="mb-1 news-item-title">';
    $content .= rex_escape($article['article_title']);
    $subtitle = $article['article_subtitle'];
    if ($subtitle) {
        $content .= '<small class="news-item-subtitle">' . rex_escape($subtitle) . '</small>';
    }
    $content .= '</h3>';

    $content .= '<small class="text-muted news-item-meta">';
    $published = $article['article_published'];
    $updated = $article['article_updated'];
    if ($updated) {
        $content .= 'aktualisiert ' . rex_escape(date_create_from_format('Y-m-d', $updated)->format('d.m.Y'));
    } else {
        $content .= 'veröffentlicht ' . rex_escape(date_create_from_format('Y-m-d', $published)->format('d.m.Y'));
    }
    $content .= '</small>
            </header>
            <div class="container-fluid mt-4 mb-1">
                <div class="row align-items-center">';

    $image = $article['article_image'];
    if ($image) {
        $image = new naju_image($image);
        $content .= '<div class="col-sm-12 col-md-4 mb-4 news-image">';
        $content .=     $image->generatePictureTag(['img-fluid', 'rounded']);
        $content .= '</div>';
    }

    $content .= '<div class="col-sm-12 col-lg-8 news-content">';
    $content .= '   <p class="mb-1 news-item-content">';
    $content .= $article['article_content'];
    $content .= '   </p>';
    
    $link = $article['article_link'];
    if ($link) {
        $content .= '<a href="' . rex_getUrl($link) . '">' . rex_escape($article['article_link_text']) . '</a>';
    }

    $content .= '</div>';

    $content .= '</div>
            </div>
        </article>';
}

$content .= '
            </div>
        </div>'; // closes the news list row

// show pagination if necessary
if ($limit < $n_articles) {
    $content .= '
            <div class="row">
                <div class="col-12">';

    $content .= '<nav><ul class="pagination justify-content-center">';
    $prev_page = $offset - $limit;
    if ($prev_page >= 0) {
        $content .= '<li class="page-item"><a class="page-link" href="' . rex_getUrl(null, null, ['offset' => $prev_page]) . '">Zurück</a></li>';
    }
    $next_page = $offset + $limit;
    if ($next_page <= $n_articles) {
        $content .= '<li class="page-item"><a class="page-link" href="' . rex_getUrl(null, null, ['offset' => $next_page]) . '">Weiter</a></li>';
    }
    $content .= '</ul></nav>';

    $content .= '</div>
            </div>'; // closes the pagination row
}



$content .= '</div>';   // closes the final container

echo $content;
