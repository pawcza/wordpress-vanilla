<?php
    $categories =       get_the_category();
    $categoryString =   '';
    $image_full =       wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
    $width =            $image_full[1];
    $height =           $image_full[2];
    $multiplier =       $width / 610;
    $title =            get_the_title();
    $image_610 =        fly_get_attachment_image_src(get_post_thumbnail_id(), array(610, $height / $multiplier), false);
    $gallery =          get_post_gallery_images($post->ID);
    $classList =        'lazy article-image';
    foreach($categories as $category){
        $categoryString .= $category->slug . ' ';
    }

    if (!empty($gallery)) {
        echo "<div class='article-gallery swiper-container' id=" . $post->ID . ">";
        echo "<div class='swiper-wrapper'>";
        foreach($gallery as $item) {
            echo "<div class='swiper-slide' style='background-image: url(" . $item . ")'></div>";
        }
        echo "</div>";
        echo "<div class='swiper-pagination'></div>";
        echo "<div class='swiper-button-next'></div>";
        echo "<div class='swiper-button-prev'></div>";
        echo "</div>";
        $classList = 'lazy article-image gallery-trigger';
    }
?>
    <div class="<?php echo $categoryString; ?>article-container col-6 col-lg-3 col-md-4">
        <article <?php post_class( array('entry') ); ?> id="post-<?php the_ID(); ?>" role="article">
            <div class="image-container">
                <?php echo fly_get_attachment_image( get_post_thumbnail_id(), array( $width / 10, $height / 10 ), false, array('class' => $classList, 'data-gallery-trigger' => $post->ID, 'data-src' => $image_610['src'], 'data-sheight' => $image_610['height'], 'data-swidth' => $image_610['width'], 'data-original' => $image_full[0], 'data-height' => $height, 'data-width' => $width, 'data-caption' => $title  )); ?>
            </div>
        </article>
    </div>
