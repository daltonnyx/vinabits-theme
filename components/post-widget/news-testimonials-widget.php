<div class="testimonials owl-carousel">
  <?php $dots = '<div class="dots-nav">'; ?>
  <?php if($news->have_posts()) : while($news->have_posts()) : $news->the_post(); ?>
    <div class="testimonial-item">
        
        <div class="author">
          <div class="text">
            <blockquote>
              <?php echo get_the_excerpt(); ?>
            </blockquote>
            <h5>-<?php echo get_the_title(); ?>-</h5>
            
          </div>
        </div>
    </div>
  <?php $dots .=  '<div class="thumb">'.get_the_post_thumbnail(get_the_ID(),'news-testimonial',  array(
                      'alt' => get_the_title(),
                      'class' => 'img-responsive testimonial-thumb'
                  ) ).'</div>'; ?> 
  <?php endwhile;endif; ?>
  <?php $dots .= '</div>';?>
</div>
<?php echo $dots; ?>

    
