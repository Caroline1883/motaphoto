<?php 
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Motaphoto
 * @since Motaphoto 1.0
 */

get_header(); ?>
<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <?php
        while (have_posts()) :
            the_post();
            ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <h1 class="entry-title"><?php the_title(); ?></h1>
                </header>

                <div class="entry-content">
                    <?php the_content(); ?>
                </div>

                <footer class="entry-footer">
                    <?php
                    if (has_category() || has_tag()) {
                        echo '<div class="entry-meta">';
                        if (has_category()) {
                            echo '<span class="cat-links">' . __('Posted in', 'yourtheme') . ': ' . get_the_category_list(', ') . '</span>';
                        }
                        if (has_tag()) {
                            echo '<span class="tags-links">' . __('Tagged', 'yourtheme') . ': ' . get_the_tag_list('', ', ') . '</span>';
                        }
                        echo '</div>';
                    }
                    ?>
                </footer>
            </article>

        <?php endwhile; ?>
    </main>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
