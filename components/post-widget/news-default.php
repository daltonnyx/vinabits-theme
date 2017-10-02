<div class="news-default-list">
<?php if($news->have_posts()) : while($news->have_posts()) : $news->the_post(); ?>
    <div class="news-default-item ">
    <div class="thumb-container">
      <?php if($has_thumbnail) { ?>
        <?php the_post_thumbnail('vinabits-medium', array(
          'alt' => get_the_title(),
          'class' => 'img-responsive horizonal-thumb'
        )); ?>
      <?php } ?>
    </div>
    <div class="news-container">
      <h3 class="news-title"><?php echo get_the_title(); ?></h3>
      <?php if($has_excerpt) { ?>
        <p><?php echo get_my_excerpt(34); ?></p>
      <?php } ?>
      <a href="<?php echo get_permalink() ?>" class="read-more"><?php echo __('Xem thêm', 'vinabits'); ?></a>
    </div>
  </div>
<?php endwhile;endif; ?>
</div>
