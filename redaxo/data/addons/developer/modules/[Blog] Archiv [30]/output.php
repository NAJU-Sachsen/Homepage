
<!-- mod_blog_archive -->

<?php
$blog = 'REX_VALUE[1]';
$slice = 'REX_SLICE_ID';
$sql = rex_sql::factory();
$query = 'SELECT article_id, article_title, article_subtitle, article_intro, article_content, article_image, article_published
    FROM naju_blog_article WHERE article_status = "archived" ORDER BY article_updated DESC';
$articles = $sql->getArray($query);
$years = array();
foreach ($articles as $article) {
    $published = explode('-', $article['article_published'])[0];
    $years[] = $published;
}
rsort($years);
$years = array_unique($years);

$year_nav = 'blog-archive-years-' . $slice;
$content = '<div class="container-fluid"><div class="row align-items-start">';

// year navigation
$content .= '<div class="col-sm-12 col-md-3 order-sm-1 order-md-2 sticky-top pt-3">';
$content .= '   <nav class="nav flex-column" id="' . $year_nav . '">';
foreach ($years as $year) {
    $content .= '   <a class="nav-link" href="#blog-' . $slice . '-articles-' . $year . '">' . $year . '</a>';
}
$content .= '   </nav>';
$content .= '</div>';

// article list
$initial_year = '9999';
$article_id_base = 'blog-archive-article-';
$current_year = $initial_year;
$content .= '<div class="col-sm-12 col-md-9 order-sm-2 order-md-1 blog-archive-container" data-spy="scroll" data-target="#' . $year_nav . '" data-offset="0">';
foreach ($articles as $article) {
    $published = explode('-', $article['article_published'])[0];
    if ($published < $current_year) {
        if ($current_year !== $initial_year) {
            $content .= '</div>'; // close previously opened article accordion first
        }
        $content .= '<h3 id="blog-' . $slice . '-articles-' . $published . '">' . $published . '</h3>';
        $content .= '<div class="accordion blog-year-archive" id="blog-archive-' . $published . '">';
        $current_year = $published;
    }

    $article_id = $article_id_base . $article['article_id'];

    $content .= '<article class="blog-archive-article-container">';
    $content .= '   <h4>';
    $content .= '       <button type="button" class="article-controller btn btn-mute text-left article-title" data-toggle="collapse" data-target="#' . $article_id . '" aria-controls="' . $article_id . '" aria-expanded="false">';
    $content .=             rex_escape($article['article_title']) . '<small class="text-muted article-subtitle">' . rex_escape($article['article_subtitle']) . '</small>';
    $content .= '       </button>';
    $content .= '   </h4>';
    $content .= '   <div id="' . $article_id . '" class="collapse" data-parent="#blog-archive-' . $published . '">';

    if ($article['article_intro'] && naju_news_article::featuresRealIntro($article)) {
        $content .= '<p class="mx-5">' . rex_escape($article['article_intro']) . '</p>';
    }

    if ($article['article_image']) {
        $img = new naju_image($article['article_image']);
        $content .= '<img src="/media/' . $img->name() . '" class="d-block mx-auto w-75 mb-3" alt="' . rex_escape($img->altText()) . '">';
    }

    $content .=         $article['article_content'];
    $content .= '   </div>';
    $content .= '</article>';
}
$content .= '</div></div>'; // close final article acordion as well as entire article container

$content .= '</div></div>'; // <div class=container>
echo $content;
