<form role="search" method="get" class="search-form amazica-search all-search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="form-group">
		<label  class="search-label">
			<span class="screen-reader-text"><?php esc_html_e('Search for:','amazica'); ?></span>
			<input type="search" class="blog-search input-search" placeholder="<?php esc_attr_e('Search ','amazica'); ?>" value="<?php the_search_query(); ?>" name="s" title="<?php esc_attr_e('Search for:','amazica'); ?>">
		</label>
		<input type="submit" class="search-submit" value="<?php esc_attr_e('Search ','amazica'); ?>">
	</div>
</form>