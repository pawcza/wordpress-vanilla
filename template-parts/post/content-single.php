<div class="container">
    <div class="row mx-1 mx-md-0">
        <article <?php post_class( 'entry' ); ?> id="post-<?php the_ID(); ?>" role="article">
            <h1 class="entry-title"><?php the_title(); ?></h1>
            <span class="dashicons dashicons-calendar-alt" style="float: left; margin-right: 10px; line-height: 24px;"></span><?php the_date('', '<h5 class="entry-date" style="margin: .3rem 0;">', '</h5>'); ?>

            <?php the_tags(); ?>
            <section class="entry-content">
                <?php
                // Content example for CSS ajustments - Uncomment it if you need

//                get_template_part( 'template-parts/post/content', 'example' );

                the_content();
                ?>
            </section>
            <?php comments_template(); ?>
        </article>
    </div>
</div>

