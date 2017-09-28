<div class="news-big-show owl-carousel">
<?php if($news->have_posts()) : while($news->have_posts()) : $news->the_post(); ?>
    <div class="big-show-item">
    <div class="thumb-container">
      <?php if($has_thumbnail) { ?>
        <?php the_post_thumbnail('vinabits-news-default', array(
          'alt' => get_the_title(),
          'class' => 'img-responsive horizonal-thumb'
        )); ?>
      <?php } ?>
    </div>
    <div class="news-container">
      <h3 class="news-title"><?php echo get_the_title(); ?></h3>
      <?php if($has_excerpt) { ?>
        <div class="news-except"><?php echo get_my_excerpt(115); ?></div>
      <?php } ?>
      <?php if($has_readmore) { ?>
        <a href="<?php echo get_permalink(); ?>" class="readmore">- <?php echo __('Xem thêm','vinabits'); ?> -</a>
      <?php } ?>
    </div>
  </div>
<?php endwhile;endif; ?>
</div>
