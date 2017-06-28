<div class="news-cards">
<?php $i = 0; ?>
<?php if($news->have_posts()) : while($news->have_posts()) : $news->the_post(); ?>
    <div class="news-card has-animation bounce visible delay-<?php echo $i; ?>">
    <div class="thumb-container">
      <?php if($has_thumbnail) { ?>
        <?php the_post_thumbnail('post-card', array(
          'alt' => get_the_title(),
          'class' => 'img-responsive vertical-thumb'
        )); ?>
      <?php } ?>
    </div>
    <div class="news-container">
      <h3 class="news-title"><?php echo get_the_title(); ?></h3>
      <p><?php echo get_my_excerpt(35); ?></p>
      <a class="link"><i class="fa fa-long-arrow-right"></i></a>
    </div>
  </div>
<?php $i += 100; ?>
<?php endwhile;endif; ?>
</div>
