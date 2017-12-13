<div class="news-carousel owl-carousel">
<?php $i = 0; ?>
<?php if($news->have_posts()) : while($news->have_posts()) : $news->the_post(); ?>
    <div class="news-default-item">

    <div class="thumb-container">
      <?php if($has_thumbnail) { ?>
        <?php the_post_thumbnail('news-carousel', array(
          'alt' => get_the_title(),
          'class' => 'img-responsive horizonal-thumb'
        )); ?>
      <?php } ?>
    </div>
    <div class="news-container">
      <h3 class="news-title"><?php echo get_the_title(); ?></h3>
      
    </div>

  </div>
<?php $i += 100; ?>
<?php endwhile;endif; ?>
</div>
