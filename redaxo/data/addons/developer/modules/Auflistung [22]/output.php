
<!-- mod_listing -->

<?php

$full_width = 'col-lg-12';
$reduced_width = 'col-lg-8';

// the tokens will contain a random prefix to minimize the chance of replacing actual
// content that just happens to look like a token
$img_token = '%%IMG%%' . rand() . '%%';
$img_src_token = '%%IMG_SRC%%' . rand() . '%%';
$img_alt_token = '%%IMG_ALT%%' . rand() . '%%';
$title_token = '%%TITLE%%' . rand() . '%%';
$content_token = '%%CONTENT%%' . rand() . '%%';
$content_width_token = '%%CONTENT_WIDTH%%' . rand() . '%%';
$link_token = '%%LINK%%' . rand() . '%%';
$link_url_token = '%%LINK_URL%%' . rand() . '%%';
$link_label_token = '%%LINK_LABEL%%' . rand() . '%%';

$list_container = '<ul class="list-unstyled">%s</ul>';
$list_template = <<<EOHTML
    <div class="container-fluid">
        <li class="media mb-3 row">
            $img_token
            <div class="media-body $content_width_token col-md-12 col-sm-12">
                <h4 class="media-heading">$title_token</h4>
                $content_token
                $link_token
            </div>
        </li>
    </div>
EOHTML;
$list_image_template = "<img src='/media/$img_src_token' alt='$img_alt_token' class='col-lg-4 col-md-12 col-sm-12 mb-2'>";
$list_link_template = "<a href='$link_url_token'>$link_label_token</a>";

$card_container = '<div class="container-fluid"><div class="row">%s</div></div>';
$card_template = <<<EOHTML
    <div class="col-lg-4 col-md-12">
        <div class="card">
            $img_token
            <div class="card-body">
                <h4 class="card-title">$title_token</h4>
                <p class="card-text">$content_token</p>
                $link_token
            </div>
        </div>
    </div>
EOHTML;
$card_image_template = "<img src='/media/$img_src_token' alt='$img_alt_token' class='card-img-top'>";
$card_link_template = "<a href='$link_url_token' class='btn btn-primary'>$link_label_token</a>";

$container = '';
$item_template = '';
$image_template = '';
$link_template = '';
$display_style = 'REX_VALUE[id=1 ifempty=grid]';

if ($display_style === 'media-list') {
    $container = $list_container;
    $item_template = $list_template;
    $image_template = $list_image_template;
    $link_template = $list_link_template;
} else {
    $container = $card_container;
    $item_template = $card_template;
    $image_template = $card_image_template;
    $link_template = $card_link_template;
} 

$items = naju_rex_var::toArray('REX_VALUE[id=2]');
$contents = '';

foreach ($items as $item) {
    $title = rex_escape($item['title']);
    $img_path = $item['REX_MEDIA_1'];
    $content = $item['content'];    // content is rich HTML
    $link = $item['REX_LINK_1'];

    $formatted_item = str_replace($title_token, $title, $item_template);
    $formatted_item = str_replace($content_token, $content, $formatted_item);

    // if the current item contains an image, generate the corresponding tag for it
    // otherwise just drop the tag altogether
    if ($img_path) {
        $img = new naju_image($img_path);
        $formatted_image = str_replace($img_src_token, $img->name(), $image_template);
        $formatted_image = str_replace($img_alt_token, rex_escape($img->altText()), $formatted_image);

        $formatted_item = str_replace($img_token, $formatted_image, $formatted_item);
        $formatted_item = str_replace($content_width_token, $reduced_width, $formatted_item);
    } else {
        $formatted_item = str_replace($img_token, '', $formatted_item);
        $formatted_item = str_replace($content_width_token, $full_width, $formatted_item);
    }
    
    // if the current item contains a 'further reading' link, generate the correspoding anchor
    // otherwise just drop the link from the rendered item
    if ($link) {
        $formatted_link = str_replace($link_url_token, rex_getUrl($link), $link_template);
        $formatted_link = str_replace($link_label_token, rex_escape($item['link_text']), $formatted_link);

        $formatted_item = str_replace($link_token, $formatted_link, $formatted_item);
    } else {
        $formatted_item = str_replace($link_token, '', $formatted_item);
    }

    $contents .= $formatted_item;
}

printf($container, $contents);
