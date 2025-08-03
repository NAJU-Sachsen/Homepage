
<?php

if (rex::getUser()->isAdmin()) {
    $blogs = rex_sql::factory()->getArray('SELECT blog_title, blog_id FROM naju_blog ORDER BY blog_title');
} else {
    $user_id = rex::getUser()->getId();
    $query = 'SELECT blog_title, blog_id FROM naju_blog JOIN naju_group_account ON blog_group = group_id WHERE account_id = :id';
    $blogs = rex_sql::factory()->getArray($query, ['id' => $user_id]);
}

?>

<fieldset style="margin-bottom: 30px;">
    <legend>1. Nach Artikel suchen:</legend>
    <div class="form-inline">
        <div class="form-group">
            <label for="blog-select">Blog auswählen:</label>
            <select class="form-control" id="blog-select">
                <option value="all">alle</option>
                <?php foreach($blogs as $blog) : ?>
                    <option value="<?= rex_escape($blog['blog_id']); ?>"><?= rex_escape($blog['blog_title']); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group" style="margin-left: 15px;">
            <label for="blog-query">Beitrag suchen:</label>
            <input type="search" class="form-control" autocomplete="off" placeholder="Titel" id="blog-query">
        </div>
        <div class="form-group">
            <button type="button" class="btn btn-default" id="blog-search">
                <i class="fa fa-search"></i> Suchen
            </button>
        </div>
    </div>
</fieldset>
<fieldset>
    <legend>2. Artikel aus den Resultaten auswählen:</legend>
    <div class="form">
        <div class="form-group">
            <label for="article-select">Artikel auswählen:</label>
            <select class="form-control" name="REX_INPUT_VALUE[1]" id="article-select">
                <?php
                $selected_article = 'REX_VALUE[1]';

                if ($selected_article) {
                    $query = 'SELECT article_title, article_id, blog_title FROM naju_blog_article JOIN naju_blog ON article_blog = blog_id
                        WHERE article_id = :id';
                    $article = rex_sql::factory()->getArray($query, ['id' => $selected_article])[0];
                    echo '<option value="' . rex_escape($article['article_id']) . '" id="default-article">' . rex_escape($article['article_title']) . '</option>';
                }
                ?>
            </select>
        </div>
    </div>
</fieldset>
<script>
    $(document).on('rex:ready', () => {
        const currentArticle = $('#default-article');
        const articleSelect = $('#article-select');
        const blogSelect = $('#blog-select');
        const blogQuery = $('#blog-query');
        const searchBtn = $('#blog-search');

        searchBtn.click((e) => {
            const blogId = blogSelect.val();
            const query = blogQuery.val();
            
            let params = '';
            if (blogId !== 'all') {
                params += 'blog_id=' + encodeURIComponent(blogId) + '&';
            }

            params += 'query=' + encodeURIComponent(query);

            $.get('', 'rex-api-call=naju_article_search&' + params, (data) => {
                articleSelect.empty();
                articleSelect.append(currentArticle);
                $.each(data.result, (i, opt) => {
                    if (opt.article_id != currentArticle.val()) {
                        articleSelect.append($('<option>', {
                            value: opt.article_id,
                            text: opt.article_title + ' (' + opt.blog_title + ')'
                        }));
                    }
                });
            });

        });
    });
</script>
