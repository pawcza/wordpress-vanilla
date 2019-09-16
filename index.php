<?php get_header(); ?>
<section id="welcoming">
    <div class="container">
        <div class="left">
            <header id="header" role="banner">
                <a href='<?php echo get_home_url()?>'>
                    <img src="<?php echo get_template_directory_uri() . '/assets/img/ak-logo.svg '?>">
                </a>
            </header>
            <div class="container">
                <p>Cześć! I'm Aleksandra, </br>a Graphic designer and Illustrator from Poland.</p>
            </div>
        </div>
        <div class="right">
            <div class="filter-home-wrapper">
                <span>What do i do?</span>
                <ul class="filters">
                    <?php
                    $i = 0;
                    $terms = get_terms("category"); // get all categories, but you can use any taxonomy
                    $count = count($terms); //How many are they?
                    if ( $count > 0 ){  //If there are more than 0 terms
                        foreach ( $terms as $term ) {  //for each term:
                            if ($term->name != 'Article'){
                                if ($i == 0) {
                                    echo "<li class='selected' data-name=' $term->name '><a href='#' data-filter='.".$term->slug."'> $term->name </a></li>\n";
                                } else {
                                    echo "<li data-name=' $term->name '><a href='#' data-filter='.".$term->slug."'> $term->name </a></li>\n";
                                }
                                //create a list item with the current term slug for sorting, and name for label
                            }
                            $i++;
                        }
                    }
                    ?>
                </ul>
            </div>
            <div class="social-home-wrapper">
                <a class="envelope-icon icon" target="_blank" href="https://www.behance.net/aleksandraa4a3"><img src="<?php echo get_template_directory_uri() . '/assets/img/behance-brands.svg '?>"></a>
                <a class="instagram-icon icon" target="_blank" href="https://www.instagram.com/olakolesniak/"><img src="<?php echo get_template_directory_uri() . '/assets/img/instagram-brands.svg '?>"></a>
                <a class="contact-icon icon" href="mailto:hello@aleksandrakolesniak.com"><img src="<?php echo get_template_directory_uri() . '/assets/img/envelope-solid.svg '?>"></a>
            </div>
        </div>
    </div>
<!--    <img class="lapka" src="--><?php //echo get_template_directory_uri(); ?><!--/assets/img/reka.png" alt="">-->

</section>
<section class="entry-section container">
    <div class="row filter-row no-gutters">
        <ul class="filters">
            <?php
            $terms = get_terms("category"); // get all categories, but you can use any taxonomy
            $count = count($terms); //How many are they?
            if ( $count > 0 ){  //If there are more than 0 terms
                foreach ( $terms as $key => $term ) {  //for each term:
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
