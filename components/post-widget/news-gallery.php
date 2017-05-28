<div class="news-gallery">
<?php $i = 0; ?>
<?php if($news->have_posts()) : while($news->have_posts() && $i < 7) : $news->the_post();$i++; ?>
    <div class="news-gallery-item item-<?php echo $i; ?> has-animation delay-<?php echo $i * 100; ?> bounceIn smooth">
    <a href="<?php echo get_permalink(); ?>">
    <div class="thumb-container">
      <?php if($has_thumbnail) { ?>
        <?php the_post_thumbnail('full', array(
          'alt' => get_the_title(),
          'class' => 'img-responsive horizonal-thumb'
        )); ?>
      <?php } ?>
    </div>
    <div class="news-container">
      <h3 class="news-title"><?php echo get_the_title(); ?></h3>
    </div>
    </a>
  </div>
<?php endwhile;endif; ?>
</div>
