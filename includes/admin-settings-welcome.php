<?php

if ( ! function_exists( 'fl_welcome_utm' ) ) :
function fl_welcome_utm( $campaign ) {
return array(
'utm_medium'   => true === FL_BUILDER_LITE ? 'bb-lite' : 'bb-pro',
'utm_source'   => 'welcome-settings-page',
'utm_campaign' => $campaign,
);
}
endif;
$blog_post_url   = FLBuilderModel::get_store_url( 'beaver-builder-2-9', fl_welcome_utm( 'settings-welcome-blog-post' ) );
$change_logs_url = FLBuilderModel::get_store_url( 'change-logs', fl_welcome_utm( 'settings-welcome-change-logs' ) );
$support_url     = FLBuilderModel::get_store_url( 'beaver-builder-support', fl_welcome_utm( 'settings-welcome-support' ) );
$faqs_url        = FLBuilderModel::get_store_url( 'frequently-asked-questions', fl_welcome_utm( 'settings-welcome-faqs' ) );
$forums_url      = FLBuilderModel::get_store_url( 'go/forum', fl_welcome_utm( 'settings-welcome-forums' ) );
$docs_url        = FLBuilderModel::get_store_url( 'go/docs', fl_welcome_utm( 'settings-welcome-docs' ) );
$fb_url          = 'https://www.facebook.com/groups/beaverbuilders/';
$release_ver     = '2.9';
$release_name    = '&#8220;Coyote&#8221;';
?>
<div id="fl-welcome-form" class="fl-settings-form">

	<h2 class="fl-settings-form-header"><?php _e( 'Welcome to SATORI Studio!', 'satori-studio' ); ?></h2>

	<div class="fl-settings-form-content fl-welcome-page-content">

                <p class="welcome-intro"><?php _e( 'Thank you for choosing SATORI Studio and welcome to the colony! Find some helpful information below. Also, to the left are the SATORI Studio settings options.', 'satori-studio' ); ?></p>

		<div class="fl-welcome-col-wrap">

			<h2><?php _e( 'Getting Started', 'satori-studio' ); ?></h2>

			<div class="fl-welcome-col">

				<h3><?php _e( 'Getting Started - Building Your First Page', 'satori-studio' ); ?></h3>

				<p><a href="<?php echo admin_url(); ?>post-new.php?post_type=page" class="fl-welcome-big-link"><?php _e( 'Pages &rarr; Add New', 'satori-studio' ); ?></a></p>

				<p><?php _e( 'Ready to start building? Add a new page and jump into SATORI Studio by clicking the Launch SATORI Studio button shown on the image.', 'satori-studio' ); ?></p>
			</div>

			<div class="fl-welcome-col">
				<img role="presentation" class="fl-welcome-img" src="<?php echo FLBuilder::plugin_url(); ?>img/welcome-add_new.jpg" alt="" />
			</div>

		</div>

		<div class="fl-welcome-col-wrap">

			<h2><?php _e( "What's New", 'satori-studio' ); ?></h2>
			<h3><?php printf( __( "What's New in SATORI Studio", 'satori-studio' ) . ' %1$s %2$s', $release_ver, $release_name ); ?></h3>

			<div class="fl-welcome-col">
				<?php /* translators: 1: version: 2: codename*/ ?>
				<p><?php printf( __( 'We\'re thrilled to announce SATORI Studio %1$s %2$s. SATORI Studio %1$s brings a number of workflow enhancements.', 'satori-studio' ), $release_ver, $release_name ); ?></p>
				<ul>
					<li class="dashicons-before dashicons-plus-alt"><?php _e( 'With the brand new color and gradient pickers the color possibilities are endless! ', 'satori-studio' ); ?></li>
					<li class="dashicons-before dashicons-plus-alt"><?php _e( 'A brand new multi-layer background field has been added to rows, columns and the box module.', 'satori-studio' ); ?></li>
					<li class="dashicons-before dashicons-plus-alt"><?php _e( 'A limited selection of modules can now be used in the Block Editor.', 'satori-studio' ); ?></li>
					<li class="dashicons-before dashicons-plus-alt"><?php _e( 'The companion Themer Release, 1.5, brings a new visual loop builder, the Loop Module!', 'satori-studio' ); ?></li>
				</ul>
				<?php /* translators: 1: blog post url: 2: changelog url */ ?>
				<p><?php printf( __( 'There\'s a whole lot more, too! Read about everything else on our <a href="%1$s" target="_blank">update post</a> or <a href="%2$s" target="_blank">change logs</a>.', 'satori-studio' ), $blog_post_url, $change_logs_url ); ?></p>
			</div>

			<div class="fl-welcome-col">
				<a href="https://youtube.com/watch?v=VqubHDyFPG8" target="_blank"><img class="fl-welcome-img" src="<?php echo FLBuilder::plugin_url(); ?>img/welcome-video_thumb--2.9.png" alt="" /></a>
			</div>

		</div>

                <div class="fl-welcome-col-wrap divider">

                        <h2><?php _e( 'Help &amp; Share', 'satori-studio' ); ?></h2>

			<div class="fl-welcome-col">

                                <h3><?php _e( 'Join the Community', 'satori-studio' ); ?></h3>

                                <p><?php _e( 'Community spaces for SATORI Studio are being finalised. Until public channels are available, please use Satori Graphics support contacts or project-specific communication paths.', 'satori-studio' ); ?></p>

                                <ul>
                                        <li class="dashicons-before dashicons-yes-alt"><?php printf( '<a href="%1$s" target="_blank">%2$s</a>', esc_url( 'https://satori.com.au/satori-studio/community' ), __( 'Community hub (coming soon)', 'satori-studio' ) ); ?></li>
                                        <li class="dashicons-before dashicons-yes-alt"><?php printf( '<a href="%1$s" target="_blank">%2$s</a>', esc_url( 'https://satori.com.au/support' ), __( 'Support portal for Satori Graphics clients', 'satori-studio' ) ); ?></li>
                                        <li class="dashicons-before dashicons-yes-alt"><?php printf( '<a href="%1$s" target="_blank">%2$s</a>', esc_url( 'https://satori.com.au/satori-studio/updates' ), __( 'Roadmap and release notes (coming soon)', 'satori-studio' ) ); ?></li>
                                </ul>

                                <p><?php _e( 'Share a project, ask a question, or just say hi! For news about new features and updates, check the SATORI Studio page on the Satori Graphics website.', 'satori-studio' ); ?></p>

                        </div>

			<div class="fl-welcome-col">

				<h3><?php _e( 'Need Some Help?', 'satori-studio' ); ?></h3>

				<p><?php _e( 'We take pride in offering outstanding support.', 'satori-studio' ); ?></p>

				<p><?php _e( 'The fastest way to find an answer to a question is to see if someone\'s already answered it!', 'satori-studio' ); ?></p>

				<?php /* translators: 1: docs url: 2: facebook url */ ?>
				<p><?php printf( __( 'For that, check our <a href="%1$s" target="_blank">Knowledge Base</a> or try searching <a href="%2$s" target="_blank">the SATORI Studio builders Facebook group</a> or our <a href="%3$s" target="_blank">Forums</a>.', 'satori-studio' ), $docs_url, $fb_url, $forums_url ); ?></p>

                                <?php /* translators: %s: support url */ ?>
                                <p><?php printf( __( 'If you can\'t find an answer, feel free to <a href="%s" target="_blank">send us a message with your question.</a>', 'satori-studio' ), $support_url ); ?></p>
			</div>

		</div>

	</div>
</div>
