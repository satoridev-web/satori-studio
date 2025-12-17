<?php
/**
 * Button texts
 */
$discard     = apply_filters( 'fl_builder_ui_bar_discard', __( 'Discard', 'satori-studio' ) );
$discard_alt = apply_filters( 'fl_builder_ui_bar_discard_alt', __( 'Discard changes and exit', 'satori-studio' ) );
$draft       = apply_filters( 'fl_builder_ui_bar_draft', __( 'Save Draft', 'satori-studio' ) );
$draft_alt   = apply_filters( 'fl_builder_ui_bar_draft_alt', __( 'Keep changes drafted and exit', 'satori-studio' ) );
$review      = apply_filters( 'fl_builder_ui_bar_review', __( 'Submit for Review', 'satori-studio' ) );
$review_alt  = apply_filters( 'fl_builder_ui_bar_review_alt', __( 'Submit changes for review and exit', 'satori-studio' ) );
$publish     = apply_filters( 'fl_builder_ui_bar_publish', __( 'Publish', 'satori-studio' ) );
$publish_alt = apply_filters( 'fl_builder_ui_bar_publish_alt', __( 'Publish changes and exit', 'satori-studio' ) );
$cancel      = apply_filters( 'fl_builder_ui_bar_cancel', __( 'Cancel', 'satori-studio' ) );
?>
<div class="fl-builder-bar">
	<div class="fl-builder-bar-content">
		<?php FLBuilder::render_ui_bar_title(); ?>
		<?php FLBuilder::render_ui_bar_buttons(); ?>
		<div class="fl-clear"></div>
		<div class="fl-builder-publish-actions-click-away-mask"></div>
		<div class="fl-builder-publish-actions is-hidden">
			<span class="fl-builder-button-group">
				<span class="fl-builder-button fl-builder-button-primary" data-action="discard" title="<?php echo esc_attr( $discard_alt ); ?>"><?php echo esc_attr( $discard ); ?></span>
				<span class="fl-builder-button fl-builder-button-primary" data-action="draft" title="<?php echo esc_attr( $draft_alt ); ?>"><?php echo esc_attr( $draft ); ?></span>
				<# if( 'publish' !== FLBuilderConfig.postStatus && ! FLBuilderConfig.userCanPublish ) { #>
				<span class="fl-builder-button fl-builder-button-primary" data-action="publish" title="<?php echo esc_attr( $review_alt ); ?>"><?php echo esc_attr( $review ); ?></span>
				<# } else { #>
				<span class="fl-builder-button fl-builder-button-primary" data-action="publish" title="<?php echo esc_attr( $publish_alt ); ?>"><?php echo esc_attr( $publish ); ?></span>
				<# } #>
			</span>
			<span class="fl-builder-button" data-action="dismiss"><?php echo esc_attr( $cancel ); ?></span>
		</div>
	</div>
</div>
<div class="fl-builder--preview-actions">
	<span class="title-accessory device-icons">
		<i class="dashicons dashicons-smartphone" data-mode="responsive"></i>
		<i class="dashicons dashicons-tablet" data-mode="medium"></i>
		<i class="dashicons dashicons-laptop" data-mode="large"></i>
		<i class="dashicons dashicons-desktop" data-mode="default"></i>
	</span>
	<button class="fl-builder-button fl-builder-button-primary end-preview-btn"><?php _e( 'Continue Editing', 'satori-studio' ); ?></button>
	<span class="size"></span>
</div>
<div class="fl-builder--revision-actions">
	<select></select>
	<button class="fl-builder-button fl-cancel-revision-preview"><?php _e( 'Cancel', 'satori-studio' ); ?></button>
	<button class="fl-builder-button fl-builder-button-primary fl-apply-revision-preview"><?php _e( 'Apply', 'satori-studio' ); ?></button>
</div>
