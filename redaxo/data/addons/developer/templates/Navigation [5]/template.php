<!-- temp_navigation -->

<?php
$rex_art = rex_article::getCurrent();
$naju_art = naju_article::getCurrent();
$active_groups = array_map(fn($cat) => $cat->getId(), $rex_art->getParentTree());

$group_id = $naju_art->getLocalGroupId();

$content = '<nav id="main-nav" class="col-lg-2 col-md-12">';
$content .= '	<ul class="nav nav-primary flex-column">';

if ($group_id == '-1') {
	// no local group set -- use the default navigation
	foreach (rex_category::getRootCategories(true) as $cat) {
		$is_active = in_array($cat->getId(), $active_groups) ? 'active' : '';

		$content .= '<li class="nav-item">';
		$content .= '	<a href="' . $cat->getUrl() . '" class="nav-link' . $is_active . '">';
		$content .= rex_escape($cat->getValue('catname'));
		$content .= '	</a>';

		$content .= naju_navigation::inflate_subnav($cat, $active_groups);
		$content .= '</li>';
	}
} else {
	// active local group found -- use group-specific navigation

	$overview_sql = <<<EOSQL
		SELECT id
		FROM rex_article
		WHERE startarticle IS TRUE
			AND catname = 'Ortsgruppen'
		LIMIT 1;
	EOSQL;
	$local_group_sql = <<<EOSQL
		SELECT group_name, group_link
		FROM naju_local_group
		WHERE group_id = :id
		LIMIT 1;
	EOSQL;
	$groups_overview_id = naju_kvs::getOrInflate('group_overview_id', $overview_sql);
	$local_group = rex_sql::factory()->setQuery($local_group_sql, ['id' => $group_id])->getRow();

	$overview_group = rex_article::get($groups_overview_id);

	$content .= '<li class="nav-item">';
	$content .= '	<a href="' . $overview_group->getUrl() . '" class="nav-link">';
	$content .= '		← ' . rex_escape($local_group['naju_local_group.group_name']);
	$content .= '	</a>';
	$content .= '</li>';
	$content .= '<hr>';

	$group_cat = rex_category::get($local_group['naju_local_group.group_link']);
	$content .= naju_navigation::inflate_subnav($group_cat, $active_groups, depth: 0);
}

$content .= '	</ul>';
$content .= '</nav>';

echo $content;
?>
