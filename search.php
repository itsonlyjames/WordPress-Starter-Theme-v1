<?php get_header(); ?>

	<?php  if (have_posts()) : ?>
		<p>Your search for "<?php $search_query = get_search_query(); echo $search_query; ?>" found
			<?php
				global $wp_query;
				$total_results = $wp_query->found_posts; echo $total_results;
				if($total_results == 1) {
					echo " result";
				} else {
					echo " results";
				}
			?></p>
		<?php $counter = 0; while (have_posts()) : the_post(); ?>
			<?php $counter++; ?><?php if ($counter%2===0){ $class = "even"; }else{ $class = "odd"; } ?>
			<?php //echo $class; ?>
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
			<?php the_excerpt(); ?>
		<?php endwhile; ?>
	<?php else : ?>
		<p>Your search for "<?php $search_query = get_search_query(); echo $search_query; ?>" found no results. Please try again.</p>
	<?php endif; ?>

<?php get_footer(); ?>

