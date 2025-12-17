<?php

// Default Settings
$defaults     = array(
	'post_type'      => 'post',
	'posts_per_page' => 5,
	'order_by'       => 'date',
	'order'          => 'DESC',
);
$tab_defaults = isset( $tab['defaults'] ) ? $tab['defaults'] : array();
$settings     = (object) array_merge( $defaults, $tab_defaults, (array) $settings );

?>

<div id="fl-builder-settings-section-post" class="fl-builder-settings-section">
	<div class="fl-builder-settings-section-header">
		<button class="fl-builder-settings-title">
			<svg width="20" height="20">
				<use href="#fl-builder-forms-down-caret" />
			</svg>
			<?php _e( 'Post', 'satori-studio' ); ?>
		</button>
	</div>

	<div class="fl-builder-settings-section-content">
		<table class="fl-form-table">
			<tbody>
				<?php
				// Post type
				FLBuilder::render_settings_field('post_type', array(
					'type'         => 'post-type',
					'label'        => __( 'Post Type', 'satori-studio' ),
					'row_class'    => 'fl-custom-query',
					'multi-select' => true,
				), $settings);

				// Number of Posts
				FLBuilder::render_settings_field('posts_per_page', array(
					'type'   => 'unit',
					'label'  => __( 'Posts Per Page', 'satori-studio' ),
					'slider' => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					),
				), $settings);

				// Order
				FLBuilder::render_settings_field('order', array(
					'type'    => 'select',
					'label'   => __( 'Order', 'satori-studio' ),
					'options' => array(
						'DESC' => __( 'Descending', 'satori-studio' ),
						'ASC'  => __( 'Ascending', 'satori-studio' ),
					),
				), $settings);

				// Order by
				FLBuilder::render_settings_field('order_by', array(
					'type'    => 'select',
					'label'   => __( 'Order By', 'satori-studio' ),
					'options' => array(
						'none'           => __( 'None', 'satori-studio' ),
						'ID'             => __( 'ID', 'satori-studio' ),
						'author'         => __( 'Author', 'satori-studio' ),
						'title'          => __( 'Title', 'satori-studio' ),
						'name'           => __( 'Name', 'satori-studio' ),
						'date'           => __( 'Date', 'satori-studio' ),
						'modified'       => __( 'Last Modified', 'satori-studio' ),
						'comment_count'  => __( 'Comment Count', 'satori-studio' ),
						'menu_order'     => __( 'Menu Order', 'satori-studio' ),
						'meta_value'     => __( 'Meta Value (Alphabetical)', 'fl-builder' ),
						'meta_value_num' => __( 'Meta Value (Numeric)', 'fl-builder' ),
						'rand'           => __( 'Random', 'satori-studio' ),
						'post__in'       => __( 'Selection Order', 'satori-studio' ),
					),
					'toggle'  => array(
						'meta_value'     => array(
							'fields' => array( 'order_by_meta_key' ),
						),
						'meta_value_num' => array(
							'fields' => array( 'order_by_meta_key' ),
						),
					),
				), $settings);

				// Meta Key
				FLBuilder::render_settings_field('order_by_meta_key', array(
					'type'  => 'text',
					'label' => __( 'Meta Key', 'satori-studio' ),
				), $settings);

				foreach ( FLBuilderLoop::post_types() as $slug => $type ) {
					// Posts
					FLBuilder::render_settings_field( 'posts_' . $slug, array(
						'type'      => 'suggest',
						'action'    => 'fl_as_posts',
						'data'      => $slug,
						/* translators: %s: type label */
						'label'     => sprintf( __( 'Filter by %1$s', 'satori-studio' ), $type->label ),
						/* translators: %s: type label */
						'help'      => sprintf( __( 'Enter a list of %1$s.', 'satori-studio' ), $type->label ),
						'matching'  => true,
						'row_class' => "fl-custom-query-filter fl-custom-query-{$slug}-filter",
					), $settings );

					// Taxonomies
					$taxonomies = FLBuilderLoop::taxonomies( $slug );

					$field_settings = new stdClass();
					foreach ( $settings as $k => $setting ) {
						if ( false !== strpos( $k, 'tax_' . $slug ) ) {
							$field_settings->$k = $setting;
						}
					}

					foreach ( $taxonomies as $tax_slug => $tax ) {
						$field_key = 'tax_' . $slug . '_' . $tax_slug;

						if ( isset( $settings->$field_key ) ) {
							$field_settings->$field_key = $settings->$field_key;
						}

						FLBuilder::render_settings_field( $field_key, array(
							'type'      => 'suggest',
							'action'    => 'fl_as_terms',
							'data'      => $tax_slug,
							/* translators: %s: tax label */
							'label'     => sprintf( __( 'Filter by %1$s', 'satori-studio' ), $tax->label ),
							/* translators: %s: tax label */
							'help'      => sprintf( __( 'Enter a list of %1$s.', 'satori-studio' ), $tax->label ),
							'matching'  => true,
							'row_class' => "fl-custom-query-filter fl-custom-query-{$slug}-filter",
						), $field_settings );
					}
				}
				?>
			</tbody>
		</table>
	</div>
</div>
