<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package vertuka
 */

?>

<div class="container-fluid temporary-page pt-5">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div>
			<h1><?php the_title(); ?></h1>
		</div>


		<?php vertuka_post_thumbnail(); ?>

		<div class="content" style="text-align: justify">
			<?php the_content(); ?>
		</div>
	</article>
</div>