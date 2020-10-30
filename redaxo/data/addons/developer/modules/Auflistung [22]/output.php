
<!-- mod_listing -->

<?php

$fancy_effect_classes = ['img-fancy-default', 'img-fancy-green', 'img-fancy-green-alternate'];
$slice_id = 'REX_SLICE_ID';

$full_width = 'col-lg-12';
$wide_list_img_cols = 'REX_VALUE[id=4 ifempty=false]' == 'true';
$reduced_width = $wide_list_img_cols ? 'col-lg-8' : 'col-lg-9';
$offset_width = $wide_list_img_cols ? 'col-log-8 offset-lg-4' : 'col-lg-9 offset-lg-3';
$list_img_col_width = $wide_list_img_cols ? 'col-lg-4' : 'col-lg-3';

$display_style = 'REX_VALUE[id=1 ifempty=grid]';
$img_params = naju_rex_var::toArray('REX_VALUE[id=3]');
$img_width = $img_params['width'];
$img_height = $img_params['height'];

// check whether some value was set in the image effects checkbox and if so, use the fancy class
$img_effects = $img_params['enable_effects'] ?? '';
$img_effects = $img_effects ? ' img-fancy ' : '';
$img_effect_style = $img_params['effect'] ?? 'random';
$img_suppress_rotate = $img_params['no_rotate_img'] ?? '';
$img_suppress_rotate = $img_suppress_rotate ? '' : ' img-fancy-rotate ';

// the tokens will contain a random prefix to minimize the chance of replacing actual
// content that just happens to look like a token
$card_id_token = '%%CARD_ID%%' . rand() . '%%';
$img_token = '%%IMG%%' . rand() . '%%';
$img_src_token = '%%IMG_SRC%%' . rand() . '%%';
$img_alt_token = '%%IMG_ALT%%' . rand() . '%%';
$img_style_token = '%%IMG_STYLE%%' . rand() . '%%';
$img_class_token = '%%IMG_CLASS%%' . rand() . '%%';
$title_token = '%%TITLE%%' . rand() . '%%';
$content_token = '%%CONTENT%%' . rand() . '%%';
$content_width_token = '%%CONTENT_WIDTH%%' . rand() . '%%';
$link_token = '%%LINK%%' . rand() . '%%';
$link_url_token = '%%LINK_URL%%' . rand() . '%%';
$link_label_token = '%%LINK_LABEL%%' . rand() . '%%';

$card_id_template = 'card-%s-%s';

$list_container = '<ul class="list-unstyled">%s</ul>';
$list_template = <<<EOHTML
    <li class="media mb-3 row listing">
        <div class="container-fluid">
            <div class="row" id="$card_id_token">
                $img_token
                <div class="media-body $content_width_token col-md-12 col-sm-12 mt-2 listing-content">
                    <h4 class="media-heading">$title_token</h4>
                    $content_token
                    $link_token
                    <div class="listing listing-end"></div>
                </div>
            </div>
        </div>
    </li>
EOHTML;
$list_image_template = "<div class='$list_img_col_width col-md-12 col-sm-12'>
                            <img src='/media/$img_src_token' alt='$img_alt_token' class='d-block mx-auto $img_class_token' style='$img_style_token'>
                        </div>";
$list_link_template = "<a href='$link_url_token'>$link_label_token</a>";

$card_container = '<div class="container-fluid"><div class="row listing-cards-container">%s</div></div>';
$card_template = <<<EOHTML
    <div class="col-lg-4 col-md-12 col-sm-12 mb-2">
        <div class="card listing-card d-block" id="$card_id_token">
            $img_token
            <div class="card-body">
                <h4 class="card-title">$title_token</h4>
                <p class="card-text">$content_token</p>
            </div>
            $link_token
        </div>
    </div>
EOHTML;
$card_image_template = "<img src='/media/$img_src_token' alt='$img_alt_token' class='card-img-top mx-auto $img_class_token' style='$img_style_token'>";
$card_link_template = "<div class='card-footer'><a href='$link_url_token' class='btn btn-primary'>$link_label_token</a></div>";

$container = '';
$item_template = '';
$image_template = '';
$link_template = '';

$img_styles = '';
if ($img_width) {
    $img_styles .= ' width: ' . rex_escape($img_width) . 'px; ';
}
if ($img_height) {
    $img_styles .= ' height: ' . rex_escape($img_height) . 'px; ';
}

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

$item_counter = 0;
$items = naju_rex_var::toArray('REX_VALUE[id=2]');
$contents = '';

$list_contains_images = false;
foreach ($items as $item) {
    if ($item['REX_MEDIA_1']) {
        $list_contains_images = true;
        break;
    }
}

foreach ($items as $item) {
    $item_counter++;

    $title = rex_escape($item['title']);
    $img_path = $item['REX_MEDIA_1'];
    $content = $item['content'];    // content is rich HTML
    $link = $item['REX_LINK_1'];

    $formatted_item = str_replace($title_token, $title, $item_template);
    $formatted_item = str_replace($card_id_token, sprintf($card_id_template, $slice_id, $item_counter), $formatted_item);
    $formatted_item = str_replace($content_token, $content, $formatted_item);

    // if the current item contains an image, generate the corresponding tag for it
    // otherwise just drop the tag altogether
    if ($list_contains_images) {
        if ($img_path) {
            $img = new naju_image($img_path);
            $formatted_image = str_replace($img_src_token, $img->name(), $image_template);
            $formatted_image = str_replace($img_alt_token, rex_escape($img->altText()), $formatted_image);

            $item_img_effects = '';
            if ($img_effects) {
                $item_img_effects = $img_effects;
                if ($img_effect_style == 'random') {
                    $item_img_effects .= ' ' . rex_escape($fancy_effect_classes[array_rand($fancy_effect_classes)]) . ' ';
                } else {
                    $item_img_effects .= ' ' . rex_escape($img_effect_style) . ' ';
                }

                $item_img_effects .= rex_escape($img_suppress_rotate);
            }
            $formatted_image = str_replace($img_class_token, $item_img_effects, $formatted_image);
            $formatted_image = str_replace($img_style_token, $img_styles, $formatted_image);

            $formatted_item = str_replace($img_token, $formatted_image, $formatted_item);
            $formatted_item = str_replace($content_width_token, $reduced_width, $formatted_item);
        } else {
            $formatted_item = str_replace($img_token, '', $formatted_item);
            $formatted_item = str_replace($content_width_token, $offset_width, $formatted_item);
        }
    } else {
        $formatted_item = str_replace($img_token, '', $formatted_item);
        $formatted_item = str_replace($content_width_token, $full_width, $formatted_item);
    }
    
    // if the current item contains a 'further reading' link, generate the correspoding anchor
    // otherwise just drop the link from the rendered item
    if ($link) {
        $link_text = rex_escape($item['link_text']);
        $link_text = $link_text ? $link_text : 'Weiterlesen';
        $formatted_link = str_replace($link_url_token, rex_getUrl($link), $link_template);
        $formatted_link = str_replace($link_label_token, $link_text , $formatted_link);

        $formatted_item = str_replace($link_token, $formatted_link, $formatted_item);
    } else {
        $formatted_item = str_replace($link_token, '', $formatted_item);
    }

    $contents .= $formatted_item;
}

printf($container, $contents);
