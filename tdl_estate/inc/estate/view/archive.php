<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package freshvegetable
 */
get_header();?>
<div class="archive-estate clearfix" data-url_root="<?php echo get_site_url();?>">
	<div class="col-xs-12 col-sm-12 col-md-9 content-area">
		<div class="clearfix">
			<?php wpressthim_pagination_number();?>
		</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-3 widget-area wpthim-sidebar-blog">
		<?php 
			if(is_active_sidebar('tdl-estate-sidebar')){
				dynamic_sidebar("tdl-estate-sidebar");
			}   
		?>
	</div>
</div>
<?php get_footer();?>