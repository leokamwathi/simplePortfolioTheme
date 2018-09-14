<?php
/**
 *
 * This is generating the content of the portfolio in the frontend when a category is clicked, or the next page is clicked or the last page is clicked
 *
 * @package perfectPortfolio
 * @since perfectPortfolio 1.1.1
 **/

?>

<?php

if( $category == 0 ) {
  $category = '';
  $args = array(
    'post_type'       => 'portfolio',
    'posts_per_page'  =>'8',
    'paged' => $page,
  );
}
else{
  $args = array(
    'post_type'       => 'portfolio',
    'posts_per_page'  =>'8',
    'tax_query' => array(
      array(
      'taxonomy' => 'portfolio_categories',
      'field' => 'term_id',
      'terms' => $category
       )
     ),
     'paged' => $page
  );
}
$loop = new WP_Query($args); $current = 1;
?>
  <div class="posts-container">
  <div class="row">
<?php
 if ( $loop->have_posts() ) : while ( $loop->have_posts() ) : $loop->the_post();


  ?>
  <div class="col-lg-3 column-4-container">

   <div class="column-4 portfolio-container-single">

     <div class="upper-photo background-image" style="background-image:url(<?php echo esc_attr( get_the_post_thumbnail_url() ); ?>)">
	     <div class="inner-icon" style="display:none;">
	       <div class="background-image eyes" style="background-image:url( <?php echo esc_attr( get_template_directory_uri().'/img/eye-close-up.png' ); ?>);">

	       </div>
	       <h4><?php echo esc_html( get_the_title() ); ?></h4>
	       <input type="hidden" class="portfolio_href" value="<?php echo esc_attr( get_the_permalink() ); ?>">
	       <p><i>press to see more</i></p>
	     </div>
     </div>
     <div class="job-title">

     </div>

   </div>

 </div><!-- .col-lg-3 -->
 <?php

 $current++;

 endwhile;
 endif;

 set_query_var( 'max',intval( $loop->found_posts/8 )+1 );
 set_query_var( 'page',$page );
 set_query_var( 'category',$category );

 get_template_part( 'inc/templates/ajax-templates/pagination' );

 wp_reset_postdata();
