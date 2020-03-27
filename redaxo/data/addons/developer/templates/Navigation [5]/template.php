<!-- Navigation -->

<?php

define('SUBNAV_DEPTH_LIMIT', 3);

function print_subnav($cat, $active_ids, $depth = 1)
{
    // for the currently active category we will display all sub-categories as well
    // if any of these categories is active, it will be styled accordingly

    $is_active = in_array($cat->getId(), $active_ids) ? 'active' : '';

    if ($is_active) {
        $sub_cats = $cat->getChildren(true);
        if ($sub_cats) {
            $depth += 1;
            echo '<ul class="nav sub-nav flex-column">';
            foreach ($sub_cats as $sub_cat) {
                $is_subcat_active = in_array($sub_cat->getId(), $active_ids) ? 'active' : '';
                $subcat_name = htmlspecialchars($sub_cat->getValue('catname'));

                echo '<li class="nav-item">';
                echo "<a href='{$sub_cat->getUrl()}' class='nav-link $is_subcat_active'>$subcat_name</a>";

                if ($depth < SUBNAV_DEPTH_LIMIT) {
                    print_subnav($sub_cat, $active_ids, $depth);
                }
                
                echo '</li>';
            }
            echo '</ul>';
        }
    }
}

?>

<nav id="main-nav" class="col-md-2 col-sm-12">
    <ul class="nav nav-primary flex-column">
        <?php foreach(rex_category::getRootCategories(true) as $cat) :
            
            // we will collect the ID of the currently active category as well as the ID's of
            // all of its parent categories to style the corresponding menu-links accordingly
            
            $active_ids = array();

            $active_ids_collector = rex_category::getCurrent();
            $active_ids[] = $active_ids_collector->getId();
            while ($active_ids_collector = $active_ids_collector->getParent()) {
                $active_ids[] = $active_ids_collector->getId();
            }

            $is_active = in_array($cat->getId(), $active_ids) ? 'active' : '';
        ?>
            <li class="nav-item">
                <a href="<?= $cat->getUrl(); ?>" class="nav-link <?= $is_active; ?>">
                    <?= htmlspecialchars($cat->getValue('catname')) ?>
                </a>
                <?php print_subnav($cat, $active_ids); ?>
            </li>
        <?php endforeach; ?>
    </ul>
</nav>