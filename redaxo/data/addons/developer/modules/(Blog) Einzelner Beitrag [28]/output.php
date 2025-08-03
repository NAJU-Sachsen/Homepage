
<!-- mod_blog_single -->

<?php

$single_article_template = new rex_template(rex_article::getCurrent()->getTemplateId());
$article = naju_news_manager::fetchArticle('REX_VALUE[1]');

$content = '<article class="blog-article">';

if ($article['article_subtitle']) {
    $subtitle = '<small class="d-block text-muted mt-2">' . rex_escape($article['article_subtitle']) . '</small>';
} else {
    $subtitle = '';
}

$content .= '
    <header>
            <h2 class="page-title">' . rex_escape($article['article_title']) . $subtitle . '</h2>
    </header>';

if ($article['article_intro'] && naju_news_article::featuresRealIntro($article)) {
    $content .= '<p class="article-intro mx-5">' . rex_escape($article['article_intro']) . '</p>';
}

if ($article['article_image']) {
    $img = new naju_image($article['article_image']);
    $content .= '<div class="article-img">';
    $content .= $img->generatePictureTag(['d-block', 'mx-auto', 'w-75', 'mb-3']);
    $content .= '</div>';
}

$content .= '<div id="article-content">' . $article['article_content'] . '</div>';

if ($article['article_link']) {
    $link_text = $article['article_link_text'] ? rex_escape($article['article_link_text']) : 'Weiterlesen';
    $content .= '<footer class="article-footer clearfix">';
    $content .= '   <a class="btn btn-primary float-right mr-2" href="' . rex_getUrl($article['article_link']) . '">' . $link_text . '</a>';
    $content .= '</footer>';
}

$content .= '</article>';
echo $content;
