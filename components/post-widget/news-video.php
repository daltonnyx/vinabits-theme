<div class="news-default-list">
<?php $i = 100; ?>
<?php if($news->have_posts()) : while($news->have_posts()) : $news->the_post(); ?>
    <div class="news-default-item has-animation flipInY">
    <a href="<?php echo get_permalink(); ?>">
    <div class="thumb-container">
      <?php if($has_thumbnail) { ?>
        <?php the_post_thumbnail('post-video', array(
          'alt' => get_the_title(),
          'class' => 'img-responsive horizonal-thumb'
        )); ?>
      <?php } ?>
    </div>
    <div class="news-container">
      <h3 class="news-title"><?php echo get_the_title(); ?></h3>
      <div class="entry-meta">
        <i class="fa fa-calendar" aria-hidden="true"></i> Ngày bắt đầu: <?php echo get_the_date('d/m/Y'); ?>
      </div>
    </div>
    </a>
  </div>
<?php $i += 100; ?>
<?php endwhile;endif; ?>
</div>
