<div class="news-default-list">
<?php if($news->have_posts()) : while($news->have_posts()) : $news->the_post(); ?>
    <div class="news-default-item">
    <div class="thumb-container">
      <?php if($has_thumbnail) { ?>
        <a href="<?php echo get_permalink(); ?>">
          <?php the_post_thumbnail('news-list-thumbnail', array(
            'alt' => get_the_title(),
            'class' => 'img-responsive horizonal-thumb'
          )); ?>
        </a>
      <?php } ?>
    </div>
    <div class="news-container">
      <h3 class="news-title"><?php echo get_the_title(); ?></h3>
      <?php if($has_excerpt) { ?>
        <p><?php echo get_my_excerpt(29); ?></p>
      <?php } ?>
      <p>
        <a href="<?php echo get_permalink(); ?>" class="mui-btn btn-xem-them">Xem thêm</a>
      </p>
    </div>
  </div>
<?php endwhile;endif; ?>
</div>
