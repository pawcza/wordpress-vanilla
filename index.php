<?php get_header(); ?>
<section id="welcoming">
    <div class="left">
        <header id="header" role="banner">
            <a href='<?php echo get_home_url()?>'>
                <img src="<?php echo get_template_directory_uri() . '/assets/img/logo.png '?>">
            </a>
        </header>
        <div class="container">
            <p>Cześć! I'm Aleksandra, a Graphic designer and Illustrator based in Gdynia, Poland. Currently
                studying at Gdansk Academy of Fine Arts.</p>
        </div>
    </div>
    <div class="right">
        <div class="filter-home-wrapper">
            <span>What do i do?</span>
            <ul class="filters">
                <li class="selected" data-name="Everything"><a href="#" data-filter="*">everything</a></li>
                <?php
                $terms = get_terms("category"); // get all categories, but you can use any taxonomy
                $count = count($terms); //How many are they?
                if ( $count > 0 ){  //If there are more than 0 terms
                    foreach ( $terms as $term ) {  //for each term:
                        if ($term->name != 'Article'){
                            echo "<li data-name=' $term->name '><a href='#' data-filter='.".$term->slug."'> $term->name </a></li>\n";
                            //create a list item with the current term slug for sorting, and name for label
                        }
                    }
                }
                ?>
            </ul>
        </div>
        <div class="social-home-wrapper">
            <a class="envelope-icon icon" target="_blank" href="https://www.behance.net/aleksandraa4a3"><img src="<?php echo get_template_directory_uri() . '/assets/img/behance-brands.svg '?>"><span>behance</span></a>
            <a class="instagram-icon icon" target="_blank" href="https://www.instagram.com/akolesniak/"><img src="<?php echo get_template_directory_uri() . '/assets/img/instagram-brands.svg '?>"><span>instagram</span></a>
            <a class="contact-icon icon" href="mailto:hello@aleksandrakolesniak.com"><img src="<?php echo get_template_directory_uri() . '/assets/img/envelope-solid.svg '?>"><span>contact me</span></a>
        </div>
    </div>

<!--    <img class="lapka" src="--><?php //echo get_template_directory_uri(); ?><!--/assets/img/reka.png" alt="">-->

</section>
<section class="entry-section container-fluid">
    <div class="row filter-row no-gutters">
        <ul class="filters">
            <li class="selected" data-name="Everything"><a href="#" data-filter="*">Everything</a></li>
            <?php
            $terms = get_terms("category"); // get all categories, but you can use any taxonomy
            $count = count($terms); //How many are they?
            if ( $count > 0 ){  //If there are more than 0 terms
                foreach ( $terms as $term ) {  //for each term:
                    if ($term->name != 'Article'){
                        echo "<li data-name=' $term->name '><a href='#' data-filter='.".$term->slug."'> $term->name </a></li>\n";
                        //create a list item with the current term slug for sorting, and name for label
                    }
                }
            }
            ?>
        </ul>
    </div>
    <div class="row no-gutters" id="isotope-list">
        <div class="grid-sizer"></div>
        <?php
        if( have_posts() ):

            // Start the loop
            while( have_posts() ): the_post();

                // Load loop content block template
                get_template_part( 'template-parts/post/content', 'loop' );

                // End the loop
            endwhile;
            ?>
            <div class="nav-previous alignleft"><?php next_posts_link( 'Older posts' ); ?></div>
            <div class="nav-next alignright"><?php previous_posts_link( 'Newer posts' ); ?></div>

        <?php
        else:

            _e('No content found', I18N_DOMAIN );

        endif;
        ?>
    </div>
</section>
<?php get_footer(); ?>
