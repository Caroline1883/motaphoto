<!-- /**
 * The template for displaying all single photo posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Motaphoto
 * @since Motaphoto 1.0
 */ -->

 <?php get_header(); ?>
 <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
 <!-- Si jamais il n'y a pas de script entry-photo alors entry  -->
 <?php get_template_part( 'template-parts/entry', 'photo' ); ?>
 <?php endwhile; endif; ?>
 <?php get_footer(); ?>