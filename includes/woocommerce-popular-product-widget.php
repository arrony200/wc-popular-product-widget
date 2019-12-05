<?php 
function woocommerce_popular_product_widget_register(){
	register_widget('woocommerce_popular_product_widget');
}
add_action('widgets_init','woocommerce_popular_product_widget_register');

class woocommerce_popular_product_widget extends WP_Widget{

	public function __construct(){
		parent:: __construct('woocommerce_popular_product_widget', 'Popular Product Widget',array(
          'description'=> 'Shown your most viwes product'
			));
	}


	public	function form($instance){

		if(isset($instance['title'])){
			$title = $instance['title'];
		}else{
			$title = 'Popular Product';
		}  

		if(isset($instance['post_per_page'])){
			$post_per_page = $instance['post_per_page'];
		}else{
			$post_per_page = 5;
		}  
 
 		if(isset($instance['displayviews'])){
 	  		$displayviews = $instance['displayviews'];
 	    }else{
 	   		$displayviews = 0;
 	    }
 	    if(isset($instance['cmtcount'])){
 	  	    $cmtcount = $instance['cmtcount'];
 	    }else{
 	        $cmtcount = 0;
 	    } 
		if(isset($instance['dauthor'])){
			$dauthor = $instance['dauthor'];
		}else{
			$dauthor = 0;
		}  
 	  
		?>
       <p>
       	<label for="<?php echo $this->get_field_id('title') ?>"><?php esc_html_e('Widget Title:','woocommerce-popular-product-widget');?></label>
       	<input type="text" id="<?php echo $this->get_field_id('title') ?>" name="<?php echo $this->get_field_name('title') ?>"
       	value="<?php echo esc_attr ($title); ?>" class="widefat">
       </p>

		<p>
       	<label for="<?php echo $this->get_field_id('post_per_page') ?>"><?php esc_html_e('Posts Per Page:','woocommerce-popular-product-widget');?></label>
       	<input type="text" id="<?php echo $this->get_field_id('post_per_page') ?>" name="<?php echo $this->get_field_name('post_per_page') ?>"
       	value="<?php echo esc_attr ($post_per_page); ?>" class="widefat">
       </p>

       <p>
       <input type="checkbox" id="<?php echo $this->get_field_id('displayviews') ?>" name="<?php echo $this->get_field_name('displayviews') ?>"
       	value="1" <?php checked($displayviews,1); ?> class="widefat">
       	<label for="<?php echo $this->get_field_id('displayviews') ?>"><?php esc_html_e('Display Views Count:','woocommerce-popular-product-widget');?></label>
       	</p>

       <p>
       	<input type="checkbox" id="<?php echo $this->get_field_id('cmtcount') ?>" name="<?php echo $this->get_field_name('cmtcount') ?>"
       	value="1" <?php checked($cmtcount,1); ?> class="widefat">
       	<label for="<?php echo $this->get_field_id('cmtcount') ?>"><?php esc_html_e('Display Review Count :','woocommerce-popular-product-widget');?></label>
       	</p>

	<?php
	}


    public function update($new_instance, $old_instance){

      $instance = array();
      $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
      $instance['post_per_page'] = (!empty($new_instance['post_per_page'])) ? strip_tags($new_instance['post_per_page']) : '';
      $instance['displayviews'] = (!empty($new_instance['displayviews'])) ? strip_tags($new_instance['displayviews']) : '';
      $instance['cmtcount'] = (!empty($new_instance['cmtcount'])) ? strip_tags($new_instance['cmtcount']) : '';
	  return $instance;
	  
	}


	public	function widget($args,$instance){

		global $product;

		$review_count = $product->get_review_count();

		$title=$instance['title'];
		$post_per_page=$instance['post_per_page'];
		$displayviews=$instance['displayviews'];
		$cmtcount=$instance['cmtcount'];

		$tp_posts = new WP_Query( array(
			"posts_per_page" => $post_per_page,
			"post_type" => "product",
			"meta_key" => "views",
			"orderby" => "meta_value_num",
			"order" => "DESC",
			"ignore_sticky_posts" => true,
		) );

		echo $args['before_widget'];
		echo $args['before_title'];
		echo $title;
		echo $args['after_title'];
		if ( $tp_posts->have_posts() ) {
			while ( $tp_posts->have_posts() ) {
				$tp_posts->the_post();
				?>
				<?php $count = get_post_meta(get_the_id(),'views', true); ?>
				<div class="propular-product-widget">
					<a class="propular-product-img" href="<?php the_permalink(); ?>"><?php the_post_thumbnail('full');?></a>
					<a class="propular-product-title" href="<?php the_permalink(); ?>"><?php the_title();?></a>
					<br>
					<?php echo $product->get_price_html(); ?>
				<br>
				<?php
				if($displayviews == 1){
					echo $count. ' views ';
				}
				?>
				<br>
				<?php
				if($cmtcount == 1){
					echo esc_html( $review_count. ' Review' );
				}
				?>
				</div>
			<?php
			}
		} else {
			echo 'Click or visit a product of your website to show it as popular product';
		}
		echo $args['after_widget'];
	}


}