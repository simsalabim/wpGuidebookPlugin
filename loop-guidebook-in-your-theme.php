<?php

/* Run the loop to output the posts.
 * If you want to overload this in a child theme then include a file
 * called loop-index.php and that will be used instead.
 */

$uri = $_SERVER['REQUEST_URI'];
$admin = current_user_can('manage_options');

if (preg_match('#/?guidebook/?$#', $uri)) {
  require_once(dirname(__FILE__) . '/../../plugins/wpGuidebookPlugin/list_walls.php');
 } elseif (preg_match('#/?guidebook/(\d+)/?$#', $uri, $matches)) {
  require_once(dirname(__FILE__) . '/../../plugins/wpGuidebookPlugin/list.php');
 } elseif (preg_match('#/?guidebook/(\d+)/(\d+)/?$#', $uri, $matches)) {
  require_once(dirname(__FILE__) . '/../../plugins/wpGuidebookPlugin/show.php');
 } elseif (preg_match('#/?guidebook/(\d+)/(\d+)/edit/?$#', $uri, $matches) && $admin) {
  require_once(dirname(__FILE__) . '/../../plugins/wpGuidebookPlugin/show.php');
 } elseif(preg_match('#/?guidebook/new/?$#', $uri) && $admin) {
   require_once(dirname(__FILE__) . '/../../plugins/wpGuidebookPlugin/show.php');
 }else { ?>

    <?php if (have_posts()) :  ?>

        <?php while (have_posts()) : the_post(); ?>
            <?php if ((is_archive()) or (is_search())) { ?>
                <?php the_excerpt(); ?>
            <?php } else { ?>
                <?php the_content("Read more..."); ?>
            <?php } ?>

    <?php endwhile; endif; ?>
<?php } ?>