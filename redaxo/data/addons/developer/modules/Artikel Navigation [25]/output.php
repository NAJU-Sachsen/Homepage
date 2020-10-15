
<!-- mod_article_nav -->

<?php

$content = '<div class="row row-cols-1 row-cols-md-3">';
$articles = rex_category::getCurrent()->getArticles(true);

foreach ($articles as $article) {
    if ($article->getId() == rex_article::getCurrentId()) {
        continue;
    }
    $content .= '<div class="col mb-4-md mb-3"><div class="card card-dense"><div class="card-body">';
    $content .= '<h4 class="card-title">' . rex_escape($article->getName()) . '</h4>';
    $content .= '<a href="' . rex_getUrl($article->getId()) . '" class="article-link">Weiterlesen</a>';
    $content .= '</div></div></div>';
}

$content .= '</div>';

echo $content;
