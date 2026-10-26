<?php
/**
 * Fallback template.
 *
 * @package Brandstory_Landing
 */

get_header();
?>
<section class="section">
        <div class="container">
                <?php
                if ( have_posts() ) {
                        while ( have_posts() ) {
                                the_post();
                                the_title( '<h1>', '</h1>' );
                                the_content();
                        }
                }
                ?>
        </div>
</section>
<?php
get_footer();