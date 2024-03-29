<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package getwid_base
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php getwid_base_post_thumbnail(); ?>

    <header class="entry-header">
        <?php
        the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );

        if ( 'post' === get_post_type() ) :
            ?>
            <div class="entry-meta">
                <?php
                getwid_base_posted_on();
                getwid_base_posted_by();
                getwid_base_posted_in();
                getwid_base_comments_link();
                getwid_base_edit_link();
                ?>
            </div><!-- .entry-meta -->
        <?php endif; ?>

        <?php
        if( ! has_post_thumbnail() && is_sticky() ):
        ?>
            <span class="sticky"><span class="lnr lnr-pushpin"></span></span>
        <?php
        endif;
        ?>
    </header><!-- .entry-header -->

    <div class="entry-content">
        <?php
        the_content( sprintf(
            wp_kses(
            /* translators: %s: Name of current post. Only visible to screen readers */
                __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'getwid-base' ),
                array(
                    'span' => array(
                        'class' => array(),
                    ),
                )
            ),
            get_the_title()
        ) );

        wp_link_pages( array(
            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'getwid-base' ),
            'after'  => '</div>',
        ) );
        ?>
    </div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->
