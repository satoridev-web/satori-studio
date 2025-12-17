<?php

// Default Settings
$defaults = array(
	'data_source' => 'custom_query',
	'post_type'   => 'post',
	'order_by'    => 'date',
	'order'       => 'DESC',
	'offset'      => 0,
	'users'       => '',
);

$tab_defaults = isset( $tab['defaults'] ) ? $tab['defaults'] : array();
$settings     = (object) array_merge( $defaults, $tab_defaults, (array) $settings );
/**
 * Allow extension of default Values
 * @see fl_builder_loop_settings
 */
$settings = apply_filters( 'fl_builder_loop_settings', $settings );

/**
 * e.g Add custom FLBuilder::render_settings_field()
 * @see fl_builder_loop_settings_before_form
 */
do_action( 'fl_builder_loop_settings_before_form', $settings );

?>
<div id="fl-builder-settings-section-source" class="fl-loop-data-source-select fl-builder-settings-section">
	<table class="fl-form-table">
	<?php
	// Data Source
	$options = array(
		'custom_query' => __( 'Custom Query', 'satori-studio' ),
		'main_query'   => __( 'Main Query', 'satori-studio' ),
	);

	if ( 'loop' === $settings->type ) {
		$options['taxonomy_query'] = __( 'Taxonomy Query', 'satori-studio' );
	}
	FLBuilder::render_settings_field('data_source', array(
		'type'    => 'select',
		'label'   => __( 'Source', 'satori-studio' ),
		'default' => 'custom_query',
		'options' => $options,
		'toggle'  => array(
			'custom_query' => array(
				'fields' => array( 'posts_per_page' ),
			),
		),
	), $settings);

	?>
	</table>
</div>

<div class="fl-custom-query fl-loop-data-source" data-source="acf_repeater">
	<div id="fl-builder-settings-section-general" class="fl-builder-settings-section">
		<div class="fl-builder-settings-section-header">
			<button class="fl-builder-settings-title">
				<svg width="20" height="20">
					<use xlink:href="#fl-builder-forms-down-caret"></use>
				</svg>
				<?php _e( 'ACF Repeater', 'satori-studio' ); ?>
			</button>
		</div>

		<div class="fl-builder-settings-section-content">
			<table class="fl-form-table">
			<?php
				// ACF Repeater Key
				FLBuilder::render_settings_field('acf_repeater_key', array(
					'type'  => 'text',
					'label' => __( 'Key', 'satori-studio' ),
				), $settings);
				?>
			</table>
		</div>
	</div>
</div>

<div class="fl-custom-query fl-loop-data-source" data-source="taxonomy_query">
	<div id="fl-builder-settings-section-general" class="fl-builder-settings-section">
		<div class="fl-builder-settings-section-header">
			<button class="fl-builder-settings-title">
				<svg width="20" height="20">
					<use xlink:href="#fl-builder-forms-down-caret"></use>
				</svg>
				<?php _e( 'Taxonomy', 'satori-studio' ); ?>
			</button>
		</div>

		<div class="fl-builder-settings-section-content">
			<table class="fl-form-table">
			<?php
				$terms_taxonomy = isset( $settings->terms_taxonomy ) ? $settings->terms_taxonomy : 'category';
				// Taxonomy
				FLBuilder::render_settings_field('terms_taxonomy', array(
					'type'    => 'select',
					'label'   => __( 'Taxonomy', 'satori-studio' ),
					'default' => 'category',
					'options' => FLBuilderLoop::get_taxonomy_options(),
				), $settings);

				FLBuilder::render_settings_field('select_terms', array(
					'label'       => __( 'Select Terms to Display', 'satori-studio' ),
					'type'        => 'button-group',
					'fill_space'  => true,
					'allow_empty' => false,
					'default'     => 'all',
					'help'        => __( 'Only hierarchical taxonomies allow for creating child terms.', 'satori-studio' ),
					'options'     => array(
						'all'   => __( 'All Terms', 'satori-studio' ),
						'top'   => __( 'Top Level Terms', 'satori-studio' ),
						'child' => __( 'Child Terms', 'satori-studio' ),
					),
					'toggle'      => array(
						'child' => array(
							'fields' => [ 'term_parent' ],
						),
					),
				), $settings);

				// Parent term
				FLBuilder::render_settings_field('term_parent', array(
					'type'    => 'select',
					'label'   => __( 'Parent Term', 'satori-studio' ),
					'help'    => __( 'Selecting None will show all terms.', 'satori-studio' ),
					'default' => 0,
					'options' => FLBuilderLoop::get_term_options( $terms_taxonomy ),
				), $settings);

				// Order
				FLBuilder::render_settings_field('term_order', array(
					'type'    => 'select',
					'label'   => __( 'Order', 'satori-studio' ),
					'default' => 'ASC',
					'options' => array(
						'ASC'  => __( 'Ascending', 'satori-studio' ),
						'DESC' => __( 'Descending', 'satori-studio' ),
					),
				), $settings);

				FLBuilder::render_settings_field('term_hide_empty', array(
					'type'    => 'select',
					'label'   => __( 'Hide Empty', 'satori-studio' ),
					'default' => '1',
					'help'    => __( 'Hide terms that don\'t have any posts.', 'satori-studio' ),
					'options' => array(
						'1' => __( 'Yes', 'satori-studio' ),
						'0' => __( 'No', 'satori-studio' ),
					),
				), $settings);

				FLBuilder::render_settings_field('term_order_by', array(
					'type'    => 'select',
					'label'   => __( 'Order By', 'satori-studio' ),
					'default' => 'name',
					'options' => array(
						'name'           => __( 'Name', 'satori-studio' ),
						'count'          => __( 'Term Count', 'satori-studio' ),
						'id'             => __( 'ID', 'satori-studio' ),
						'meta_value'     => __( 'Meta Value (Alphabetical)', 'satori-studio' ),
						'meta_value_num' => __( 'Meta Value (Numeric)', 'satori-studio' ),
						'parent'         => __( 'Parent', 'satori-studio' ),
					),
					'toggle'  => array(
						'meta_value'     => array(
							'fields' => array( 'term_order_by_meta_key' ),
						),
						'meta_value_num' => array(
							'fields' => array( 'term_order_by_meta_key' ),
						),
					),
				), $settings);

				FLBuilder::render_settings_field('term_order_by_meta_key', array(
					'type'  => 'text',
					'label' => __( 'Meta Key', 'satori-studio' ),
				), $settings);
				?>
			</table>
		</div>
	</div>
</div>

<div class="fl-custom-query fl-loop-data-source" data-source="custom_query">
	<div id="fl-builder-settings-section-general" class="fl-builder-settings-section">
		<div class="fl-builder-settings-section-header">
			<button class="fl-builder-settings-title">
				<svg width="20" height="20">
					<use href="#fl-builder-forms-down-caret" />
				</svg>
				<?php _e( 'Custom Query', 'satori-studio' ); ?>
			</button>
		</div>

		<div class="fl-builder-settings-section-content">
			<table class="fl-form-table">
			<?php

			// Post type
			FLBuilder::render_settings_field('post_type', array(
				'type'         => 'post-type',
				'label'        => __( 'Post Type', 'satori-studio' ),
				'multi-select' => true,
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
					'author'         => __( 'Author', 'satori-studio' ),
					'comment_count'  => __( 'Comment Count', 'satori-studio' ),
					'date'           => __( 'Date', 'satori-studio' ),
					'modified'       => __( 'Date Last Modified', 'satori-studio' ),
					'ID'             => __( 'ID', 'satori-studio' ),
					'menu_order'     => __( 'Menu Order', 'satori-studio' ),
					'meta_value'     => __( 'Meta Value (Alphabetical)', 'satori-studio' ),
					'meta_value_num' => __( 'Meta Value (Numeric)', 'satori-studio' ),
					'rand'           => __( 'Random', 'satori-studio' ),
					'title'          => __( 'Title', 'satori-studio' ),
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

			// Offset
			FLBuilder::render_settings_field('offset', array(
				'type'        => 'unit',
				'label'       => _x( 'Offset', 'How many posts to skip.', 'satori-studio' ),
				'default'     => '0',
				'placeholder' => '0',
				'sanitize'    => 'absint',
				'slider'      => array(
					'min'  => 0,
					'max'  => 100,
					'step' => 2,
				),
				'help'        => __( 'Skip this many posts that match the specified criteria.', 'satori-studio' ),
			), $settings);

			FLBuilder::render_settings_field('exclude_self', array(
				'type'    => 'select',
				'label'   => __( 'Exclude Current Post', 'satori-studio' ),
				'default' => 'no',
				'help'    => __( 'Exclude the current post from the query.', 'satori-studio' ),
				'options' => array(
					'yes' => __( 'Yes', 'satori-studio' ),
					'no'  => __( 'No', 'satori-studio' ),
				),
			), $settings);
			?>
			</table>
		</div>
	</div>
	<div id="fl-builder-settings-section-filter" class="fl-builder-settings-section">
		<div class="fl-builder-settings-section-header">
			<button class="fl-builder-settings-title">
				<svg width="20" height="20">
					<use href="#fl-builder-forms-down-caret" />
				</svg>
				<?php _e( 'Filter', 'satori-studio' ); ?>
			</button>
		</div>
		<div class="fl-builder-settings-section-content">
		<?php foreach ( FLBuilderLoop::post_types() as $slug => $type ) : ?>
			<table class="fl-form-table fl-custom-query-filter fl-custom-query-<?php echo $slug; ?>-filter"<?php echo ( $slug == $settings->post_type ) ? ' style="display:table;"' : ''; ?>>
			<?php

			// Posts
			FLBuilder::render_settings_field( 'posts_' . $slug, array(
				'type'     => 'suggest',
				'action'   => 'fl_as_posts',
				'data'     => $slug,
				'label'    => $type->label,
				/* translators: %s: type label */
				'help'     => sprintf( __( 'Enter a list of %1$s.', 'satori-studio' ), $type->label ),
				'matching' => true,
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
					'type'     => 'suggest',
					'action'   => 'fl_as_terms',
					'data'     => $tax_slug,
					'label'    => $tax->label,
					/* translators: %s: tax label */
					'help'     => sprintf( __( 'Enter a list of %1$s.', 'satori-studio' ), $tax->label ),
					'matching' => true,
				), $field_settings );
			}
			?>
			</table>
			<?php endforeach; ?>
			<table class="fl-form-table">
			<?php
			// Author
			FLBuilder::render_settings_field('users', array(
				'type'     => 'suggest',
				'action'   => 'fl_as_users',
				'label'    => __( 'Authors', 'satori-studio' ),
				'help'     => __( 'Enter a list of authors usernames.', 'satori-studio' ),
				'matching' => true,
			), $settings);
			?>
			</table>
		</div>
	</div>

	<div id="fl-builder-settings-section-filter" class="fl-builder-settings-section">
		<div class="fl-builder-settings-section-header">
			<button class="fl-builder-settings-title">
				<svg width="20" height="20">
					<use href="#fl-builder-forms-down-caret" />
				</svg>
				<?php _e( 'Custom Field Filter', 'satori-studio' ); ?>
			</button>
		</div>

		<div class="fl-builder-settings-section-content">
			<table class="fl-form-table">
			<?php
				FLBuilder::render_settings_field( 'custom_field_relation', array(
					'type'    => 'select',
					'label'   => __( 'Relation', 'satori-studio' ),
					'default' => 'AND',
					'options' => array(
						'AND' => __( 'AND', 'satori-studio' ),
						'OR'  => __( 'OR', 'satori-studio' ),
					),
				), $settings);
				?>
			</table>
			<table class="fl-form-table">
			<?php
				FLBuilder::render_settings_field( 'custom_field', array(
					'type'         => 'form',
					'help'         => __( 'Custom field key.', 'satori-studio' ),
					'label'        => __( 'Custom Field', 'satori-studio' ),
					'form'         => 'custom_fields_form',
					'default'      => array( 0 => '' ),
					'preview_text' => 'filter_meta_label',
					'multiple'     => true,
				), $settings);
				?>
			</table>
		</div>
	</div>
</div>
<?php
do_action( 'fl_builder_loop_settings_after_form', $settings ); // e.g Add custom FLBuilder::render_settings_field()
