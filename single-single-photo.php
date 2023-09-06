<!-- /**
 * The template for displaying all single publication
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Motaphoto
 * @since Motaphoto 1.0
 */ -->
 <?php get_header(); ?>
 <?php the_terms( $post->ID, 'single-photo', 'Type : '); ?>
 <?php
// Pour plus tard ACF
?>

 <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
 <?php get_template_part( 'entry' ); ?>
 <?php if ( comments_open() && !post_password_required() ) { comments_template( '', true ); } ?>
 <?php endwhile; endif; ?>
 <footer class="footer">
 <?php get_template_part( 'nav', 'below-single' ); ?>
 </footer>
 <?php get_footer(); ?>

 <?php get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <h1 class="entry-title"><?php the_title(); ?></h1>
                </header>

                <div class="entry-content">
                    <?php
                    if (has_post_thumbnail()) {
                        the_post_thumbnail('large'); // Affiche l'image à la taille "large"
                    }
                    ?>
                    <?php the_content(); ?>
                </div>

                <footer class="entry-footer">
                    <?php
                    // Afficher ici vos taxonomies personnalisées (par exemple, 'taxonomy_name')
                    // echo get_the_term_list($post->ID, 'taxonomy_name', '<p>Les catégories : ', ', ', '</p>');
                    ?>
                </footer>
            </article>

            <?php if (comments_open() || get_comments_number()) : ?>
                <?php comments_template(); ?>
            <?php endif; ?>

        <?php endwhile; endif; ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>