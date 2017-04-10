<div class="testimonials owl-carousel">
  <?php if($news->have_posts()) : while($news->have_posts()) : $news->the_post(); ?>
    <div class="testimonial-item">
      <blockquote>
        <?php echo get_the_excerpt(); ?>
      </blockquote>
      <div class="author">
        <div class="thumb">
          <?php the_post_thumbnail('testimonial-avatar',  array(
            'alt' => get_the_title(),
            'class' => 'img-responsive testimonial-thumb'
            ) ); ?>
        </div>
        <div class="text">
          <h5><?php echo get_the_title(); ?></h5>
          <span class="job-title"><?php echo get_post_meta(get_the_ID(), 'testimonials-widget-title', true); ?></span>
        </div>
      </div>
    </div>
  <?php endwhile;endif; ?>
</div>
