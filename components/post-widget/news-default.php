<div class="news-default-list">
<?php $i = 100; ?>
<?php if($news->have_posts()) : while($news->have_posts()) : $news->the_post(); ?>
    <div class="news-default-item has-animation flipInY delay-<?php echo $i ?>">
    <a href="<?php echo get_permalink(); ?>">
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
        <p><?php echo get_my_excerpt(15); ?></p>
      <?php } ?>
    </div>
    </a>
  </div>
<?php $i += 100; ?>
<?php endwhile;endif; ?>
</div>
