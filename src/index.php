<?php get_header(); ?>
<?php
	// Retrieve featured posts
	$args = array(
		'post_type' 		=> 'post',
		'posts_per_page' 	=> 2,
		'meta_key'			=> 'homepagefeatured',
		'meta_value'		=> true
		);
	$featured_posts = get_posts( $args );

	// Retrieve posts
	$_PAGE_SIZE = 6;
	$_PAGE = get_query_var('page', 1);
	$_CAT = get_query_var('cat', null);
	$_YEAR = get_query_var('year', null);
	$_MONTH = get_query_var('monthnum', null);

	$args = array(
		'post_type' 		=> 'post',
		'posts_per_page' 	=> $_PAGE_SIZE,
		'offset' 			=> ($_PAGE - 1) * $_PAGE_SIZE
	);

	$query = new WP_Query($args);
	$posts = $query->get_posts();

	$_TOTAL_POSTS = $query->found_posts;
	$_TOTAL_PAGES = ceil($_TOTAL_POSTS / $_PAGE_SIZE);

	if($_PAGE > $_TOTAL_PAGES){
		$_PAGE = 1;

		$args['offset'] = ($_PAGE - 1) * $_PAGE_SIZE;

		$query = new WP_Query($args);
		$posts = $query->get_posts();

		$_TOTAL_POSTS = $query->found_posts;
		$_TOTAL_PAGES = ceil($_TOTAL_POSTS / $_PAGE_SIZE);
	}

?>
	<section class='pageHome'>
		<div class="row small-collapse text-center pageHome-mainBanner">
			<?php
				if ($featured_posts) {
					foreach ($featured_posts as $p) {
						$fields = get_fields($p);
						$blogs = array();

						if($fields['blog']){
							$blogs[$fields['blog']->ID] = $fields['blog'];
						}

						if(array_key_exists('blog_sec', $fields) && $fields['blog_sec'] && count($fields['blog_sec'])){
							foreach($fields['blog_sec'] as $b){
								if(!array_key_exists($b->ID, $blogs)){
									$blogs[$b->ID] = $b;
								}
							}
						}
			?>
			<div class="column small-12 large-6 pageHome-mainBanner-contentLeft">
				<a href="<?php echo get_permalink($p)?>" class="feature-image" style="background-image:url(<?php echo img($p, 'home:featured_card'); ?>);"></a>
				<!--<div class="row small-collapse">-->
					<div class="column small-12 large-8 large-offset-2 card card-wrapper">
						<div class="card-label">
							<?php echo do_shortcode('[card_share]'); ?>
							<a href="<?php echo get_permalink($p)?>" class="content">
								<strong class="header"><?php echo $p->post_title ?></strong>
								<?php if(array_key_exists('subtitle', $fields) && $fields['subtitle']){ ?><span class="subheader"><?php echo $fields['subtitle']; ?></span><?php } ?>
							</a>
							<a href="<?php echo get_permalink($p)?>"><div class="row align-justify footer small-collapse">
								<span class="column small-6 text-left author"><?php echo $fields['author']?></span>
								<span class="column small-6 text-right date"><?php echo get_formatted_date(date('Ymd', strtotime($p->post_date))); ?></span>
							</div></a>
							<?php the_series($p); ?>
							<?php if(count($blogs)){ ?><p class="topics">Topic<?php echo count($blogs) > 1 ? 's' : ''; ?>: <?php foreach($blogs as $b){ ?><a href="<?php echo get_permalink($b->ID)?>" class="blog-link"><?php echo $b->post_title; ?></a><?php echo end($blogs)->ID != $b->ID ? ',' : ''; ?> <?php } ?></p><?php } ?>
						</div>
					</div>
				<!--</div>-->
			</div>
			<?php
					}
				}
			?>
			</div>
		</div>
		<div class="contentBlock">
			<div class="row small-collapse large-uncollapse text-center card">
				<?php
					foreach ($posts as $p) {
						$fields = get_fields($p);
						$blogs = array();

						if($fields['blog']){
							$blogs[$fields['blog']->ID] = $fields['blog'];
						}

						if(array_key_exists('blog_sec', $fields) && $fields['blog_sec'] && count($fields['blog_sec'])){
							foreach($fields['blog_sec'] as $b){
								if(!array_key_exists($b->ID, $blogs)){
									$blogs[$b->ID] = $b;
								}
							}
						}
				?>
				<div class="column small-12 large-4">
					<div class="card-wrapper">
						<a href="<?php echo get_permalink($p)?>"><img src='<?php echo img($p, 'card')?>'></a>
						<div class="card-label">
							<?php echo do_shortcode('[card_share]'); ?>
							<!--<a href="<?php echo get_permalink($fields['blog'])?>" class="card-blog"><?php echo $fields['blog']->post_title?></a>-->
							<a href="<?php echo get_permalink($p)?>" class="content">
								<strong class="header"><?php echo $p->post_title ?></strong>
								<?php if(array_key_exists('subtitle', $fields) && $fields['subtitle']){ ?><span class="subheader"><?php echo $fields['subtitle']; ?></span><?php } ?>
							</a>
							<a href="<?php echo get_permalink($p)?>"><div class="row align-justify footer small-collapse">
								<span class="column small-6 text-left author"><?php echo $fields['author']?></span>
								<span class="column small-6 text-right date"><?php echo get_formatted_date(date('Ymd', strtotime($p->post_date))); ?></span>
							</div></a>
							<?php the_series($p); ?>
							<?php if(count($blogs)){ ?><p class="topics">Topic<?php echo count($blogs) > 1 ? 's' : ''; ?>: <?php foreach($blogs as $b){ ?><a href="<?php echo get_permalink($b->ID)?>" class="blog-link"><?php echo $b->post_title; ?></a><?php echo end($blogs)->ID != $b->ID ? ',' : ''; ?> <?php } ?></p><?php } ?>
						</div>
					</div>
				</div>
				<?php
					}
				?>
			</div>
		</div>

		<?php if ($_TOTAL_PAGES > 1) {
			$pagination_url = SITE_ROOT . '/';
			$form_url = SITE_ROOT . '/';

			if($blog){

				$form_url = get_permalink($blog);
				$form_url = preg_replace('@http[s]*://@', '', $form_url);
				$form_url = explode('/', $form_url);
				$form_url[0] = SITE_ROOT;
				$form_url = implode('/', $form_url);
				$pagination_url = $form_url;

			} elseif(is_front_page()){

				$form_url = SITE_ROOT . '/';
				$pagination_url = SITE_ROOT . '/?page=';

			} elseif(is_category() && $_CAT >= 0) {

				$cat = get_category($_CAT);
				$form_url = SITE_ROOT . '/category/' . $cat->slug;
				$pagination_url = $form_url . '/?page=';

			} elseif (is_archive()){
				if($_YEAR){

					$form_url = SITE_ROOT . '/' . esc_attr($_YEAR);
					$pagination_url =  $form_url . '/?page=';

					if($_MONTH){
						$form_url = SITE_ROOT . '/' . esc_attr($_YEAR) .'/' . esc_attr($_MONTH);
						$pagination_url = $form_url . '/?page=';
					}
				}
			}

			?>
		<div class="text-center paginationControls">
			<?php if ($_PAGE > 1) { ?>
			<a href="<?php echo $pagination_url; ?><?php echo $_PAGE - 1; ?>" class="paginationControls-prev">
				<span class="icon-pagination icon"></span>
			</a>
			<?php } ?>
			<div class="paginationControls-info">
				<form method="GET" data-url="<?php echo $form_url; ?>">
					<input type="text" class="text-center" value="<?php echo $_PAGE; ?>" name="page"/>
					of <span class="totalPages"><?php echo $_TOTAL_PAGES?></span>
				</form>
			</div>
			<?php if ($_PAGE < $_TOTAL_PAGES) { ?>
			<a href="<?php echo $pagination_url; ?><?php echo $_PAGE + 1; ?>" class="paginationControls-next">
				<span class="icon-pagination icon"></span>
			</a>
			<?php } ?>
		</div>
		<?php } ?>
	</section>
<?php wp_footer(); // Crucial footer hook! ?>
<?php get_footer(); ?>
