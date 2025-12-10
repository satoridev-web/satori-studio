<?php
/* -------------------------------------------------
 * SATORI Studio — Feature Registry
 * -------------------------------------------------*/

namespace Satori_Studio\Core;

class Features {

    /**
     * Registered feature flags.
     *
     * @var array<string, array<string, mixed>>
     */
    private $features = array();

    /**
     * Constructor.
     */
    public function __construct() {
        $this->features = $this->prepare_registry();
    }

    /**
     * Return the full feature registry.
     *
     * @return array<string, array<string, mixed>>
     */
    public function get_all() {
        return $this->features;
    }

    /**
     * Retrieve a feature definition by slug.
     *
     * @param string $slug Feature slug.
     * @return array<string, mixed>|null
     */
    public function get( $slug ) {
        return isset( $this->features[ $slug ] ) ? $this->features[ $slug ] : null;
    }

    /**
     * Determine whether a feature is enabled.
     *
     * @param string $slug Feature slug.
     * @return bool
     */
    public function is_enabled( $slug ) {
        $feature = $this->get( $slug );

        if ( null === $feature ) {
            return false;
        }

        return isset( $feature['enabled'] ) ? (bool) $feature['enabled'] : false;
    }

    /**
     * Build the default feature registry.
     *
     * @return array<string, array<string, mixed>>
     */
    private function prepare_registry() {
        $features = array(
            // Core modules.
            'module-acf-block'     => array(
                'enabled'     => true,
                'type'        => 'module',
                'labels'      => array(
                    'name'  => 'ACF Block',
                    'group' => 'Integrations',
                ),
                'status'      => 'optional',
                'legacy'      => false,
                'description' => 'Render ACF-defined blocks inside the builder.',
            ),
            'module-audio'         => array(
                'enabled'     => true,
                'type'        => 'module',
                'labels'      => array(
                    'name'  => 'Audio',
                    'group' => 'Media',
                ),
                'status'      => 'core',
                'legacy'      => false,
                'description' => 'Audio player module for embeds and files.',
            ),
            'module-box'           => array(
                'enabled'     => true,
                'type'        => 'module',
                'labels'      => array(
                    'name'  => 'Box',
                    'group' => 'Content',
                ),
                'status'      => 'core',
                'legacy'      => false,
                'description' => 'Content box with mixed media/text layouts.',
            ),
            'module-button'        => array(
                'enabled'     => true,
                'type'        => 'module',
                'labels'      => array(
                    'name'  => 'Button',
                    'group' => 'Content',
                ),
                'status'      => 'core',
                'legacy'      => false,
                'description' => 'Standard button with style controls.',
            ),
            'module-button-group'  => array(
                'enabled'     => true,
                'type'        => 'module',
                'labels'      => array(
                    'name'  => 'Button Group',
                    'group' => 'Content',
                ),
                'status'      => 'core',
                'legacy'      => false,
                'description' => 'Grouped buttons for inline layouts.',
            ),
            'module-callout'       => array(
                'enabled'     => true,
                'type'        => 'module',
                'labels'      => array(
                    'name'  => 'Callout',
                    'group' => 'Content',
                ),
                'status'      => 'core',
                'legacy'      => false,
                'description' => 'Media and text callout layout.',
            ),
            'module-cta'           => array(
                'enabled'     => true,
                'type'        => 'module',
                'labels'      => array(
                    'name'  => 'CTA',
                    'group' => 'Content',
                ),
                'status'      => 'core',
                'legacy'      => false,
                'description' => 'Call-to-action banner with copy and button.',
            ),
            'module-heading'       => array(
                'enabled'     => true,
                'type'        => 'module',
                'labels'      => array(
                    'name'  => 'Heading',
                    'group' => 'Content',
                ),
                'status'      => 'core',
                'legacy'      => false,
                'description' => 'Heading and typography module.',
            ),
            'module-html'          => array(
                'enabled'     => true,
                'type'        => 'module',
                'labels'      => array(
                    'name'  => 'HTML',
                    'group' => 'Content',
                ),
                'status'      => 'core',
                'legacy'      => false,
                'description' => 'Raw HTML output block.',
            ),
            'module-icon'          => array(
                'enabled'     => true,
                'type'        => 'module',
                'labels'      => array(
                    'name'  => 'Icon',
                    'group' => 'Media',
                ),
                'status'      => 'core',
                'legacy'      => false,
                'description' => 'Icon display with styling options.',
            ),
            'module-menu'          => array(
                'enabled'     => true,
                'type'        => 'module',
                'labels'      => array(
                    'name'  => 'Menu',
                    'group' => 'Navigation',
                ),
                'status'      => 'optional',
                'legacy'      => false,
                'description' => 'Navigation menu output.',
            ),
            'module-numbers'       => array(
                'enabled'     => true,
                'type'        => 'module',
                'labels'      => array(
                    'name'  => 'Numbers',
                    'group' => 'Content',
                ),
                'status'      => 'optional',
                'legacy'      => false,
                'description' => 'Number counter and stat highlights.',
            ),
            'module-photo'         => array(
                'enabled'     => true,
                'type'        => 'module',
                'labels'      => array(
                    'name'  => 'Photo',
                    'group' => 'Media',
                ),
                'status'      => 'core',
                'legacy'      => false,
                'description' => 'Image display module.',
            ),
            'module-reusable-block' => array(
                'enabled'     => true,
                'type'        => 'module',
                'labels'      => array(
                    'name'  => 'Reusable Block',
                    'group' => 'Integrations',
                ),
                'status'      => 'optional',
                'legacy'      => false,
                'description' => 'Embed WordPress reusable blocks.',
            ),
            'module-rich-text'     => array(
                'enabled'     => true,
                'type'        => 'module',
                'labels'      => array(
                    'name'  => 'Rich Text',
                    'group' => 'Content',
                ),
                'status'      => 'core',
                'legacy'      => false,
                'description' => 'Rich text and WYSIWYG module.',
            ),
            'module-sidebar'       => array(
                'enabled'     => true,
                'type'        => 'module',
                'labels'      => array(
                    'name'  => 'Sidebar',
                    'group' => 'WordPress',
                ),
                'status'      => 'optional',
                'legacy'      => false,
                'description' => 'Output a registered WordPress sidebar.',
            ),
            'module-video'         => array(
                'enabled'     => true,
                'type'        => 'module',
                'labels'      => array(
                    'name'  => 'Video',
                    'group' => 'Media',
                ),
                'status'      => 'core',
                'legacy'      => false,
                'description' => 'Video embed module.',
            ),
            'module-widget'        => array(
                'enabled'     => true,
                'type'        => 'module',
                'labels'      => array(
                    'name'  => 'Widget',
                    'group' => 'WordPress',
                ),
                'status'      => 'legacy',
                'legacy'      => true,
                'description' => 'Embed legacy WordPress widgets.',
            ),

            // Extensions.
            'extension-fl-builder-cache-helper' => array(
                'enabled'     => true,
                'type'        => 'extension',
                'labels'      => array(
                    'name'  => 'Cache Helper',
                    'group' => 'Extensions',
                ),
                'status'      => 'optional',
                'legacy'      => false,
                'description' => 'Cache clearing helper hooks.',
            ),
            'extension-fl-builder-hostinger'    => array(
                'enabled'     => true,
                'type'        => 'extension',
                'labels'      => array(
                    'name'  => 'Hostinger Integration',
                    'group' => 'Extensions',
                ),
                'status'      => 'optional',
                'legacy'      => false,
                'description' => 'Hostinger hosting compatibility hooks.',
            ),
            'extension-fl-builder-multisite'    => array(
                'enabled'     => true,
                'type'        => 'extension',
                'labels'      => array(
                    'name'  => 'Multisite',
                    'group' => 'Extensions',
                ),
                'status'      => 'optional',
                'legacy'      => false,
                'description' => 'Multisite-specific support.',
            ),
            'extension-fl-builder-popup-maker'  => array(
                'enabled'     => true,
                'type'        => 'extension',
                'labels'      => array(
                    'name'  => 'Popup Maker Integration',
                    'group' => 'Extensions',
                ),
                'status'      => 'optional',
                'legacy'      => false,
                'description' => 'Integration bridge for Popup Maker.',
            ),
            'extension-fl-builder-seo-plugins'  => array(
                'enabled'     => true,
                'type'        => 'extension',
                'labels'      => array(
                    'name'  => 'SEO Plugins Integration',
                    'group' => 'Extensions',
                ),
                'status'      => 'optional',
                'legacy'      => false,
                'description' => 'Compatibility helpers for common SEO plugins.',
            ),

            // Legacy/upsell UI toggles.
            'ui-legacy-upgrade-screen'   => array(
                'enabled'     => false,
                'type'        => 'ui',
                'labels'      => array(
                    'name'  => 'Legacy Upgrade Screen',
                    'group' => 'UI',
                ),
                'status'      => 'legacy',
                'legacy'      => true,
                'description' => 'Display the legacy upgrade tab and related CTAs for premium Beaver Builder plans.',
            ),
            'ui-legacy-license-screen'   => array(
                'enabled'     => false,
                'type'        => 'ui',
                'labels'      => array(
                    'name'  => 'Legacy License Screen',
                    'group' => 'UI',
                ),
                'status'      => 'legacy',
                'legacy'      => true,
                'description' => 'Display license management screens intended for Beaver Builder commercial keys.',
            ),
            'ui-legacy-upgrade-promos'   => array(
                'enabled'     => false,
                'type'        => 'ui',
                'labels'      => array(
                    'name'  => 'Legacy Builder Upsells',
                    'group' => 'UI',
                ),
                'status'      => 'legacy',
                'legacy'      => true,
                'description' => 'Show marketing CTAs inside the builder for Beaver Builder premium plans.',
            ),
            'ui-legacy-themer-promos'    => array(
                'enabled'     => false,
                'type'        => 'ui',
                'labels'      => array(
                    'name'  => 'Legacy Themer Promos',
                    'group' => 'UI',
                ),
                'status'      => 'legacy',
                'legacy'      => true,
                'description' => 'Promotional panels for Beaver Themer integrations.',
            ),
            'ui-legacy-assistant-promos' => array(
                'enabled'     => false,
                'type'        => 'ui',
                'labels'      => array(
                    'name'  => 'Assistant Pro Promos',
                    'group' => 'UI',
                ),
                'status'      => 'legacy',
                'legacy'      => true,
                'description' => 'Promo panels for Assistant / Assistant Pro services.',
            ),

            // Core systems.
            'core-loader'                => array(
                'enabled'     => true,
                'type'        => 'core',
                'labels'      => array(
                    'name'  => 'Loader',
                    'group' => 'Core',
                ),
                'status'      => 'core',
                'legacy'      => false,
                'description' => 'Bootstrap for constants and primary includes.',
            ),
            'core-admin-settings'        => array(
                'enabled'     => true,
                'type'        => 'admin',
                'labels'      => array(
                    'name'  => 'Admin Settings',
                    'group' => 'Core',
                ),
                'status'      => 'core',
                'legacy'      => false,
                'description' => 'Settings pages and admin utilities for the builder.',
            ),
            'core-updates'              => array(
                'enabled'     => true,
                'type'        => 'core',
                'labels'      => array(
                    'name'  => 'Updates',
                    'group' => 'Core',
                ),
                'status'      => 'core',
                'legacy'      => false,
                'description' => 'Update checks and updater configuration.',
            ),
            'core-wp-blocks'            => array(
                'enabled'     => true,
                'type'        => 'integration',
                'labels'      => array(
                    'name'  => 'WP Blocks Integration',
                    'group' => 'Integrations',
                ),
                'status'      => 'optional',
                'legacy'      => false,
                'description' => 'Registers block editor compatibility and block variants.',
            ),
            'core-wpml'                 => array(
                'enabled'     => true,
                'type'        => 'integration',
                'labels'      => array(
                    'name'  => 'WPML Integration',
                    'group' => 'Integrations',
                ),
                'status'      => 'optional',
                'legacy'      => false,
                'description' => 'WPML translation compatibility.',
            ),
            'core-seo'                  => array(
                'enabled'     => true,
                'type'        => 'integration',
                'labels'      => array(
                    'name'  => 'SEO Integrations',
                    'group' => 'Integrations',
                ),
                'status'      => 'optional',
                'legacy'      => false,
                'description' => 'SEO plugin compatibility helpers.',
            ),
            'core-wpcli'                => array(
                'enabled'     => true,
                'type'        => 'tooling',
                'labels'      => array(
                    'name'  => 'WP-CLI',
                    'group' => 'Tooling',
                ),
                'status'      => 'optional',
                'legacy'      => false,
                'description' => 'WP-CLI command support for the builder.',
            ),
            'core-usage-tracking'       => array(
                'enabled'     => true,
                'type'        => 'telemetry',
                'labels'      => array(
                    'name'  => 'Usage Tracking',
                    'group' => 'Tooling',
                ),
                'status'      => 'optional',
                'legacy'      => false,
                'description' => 'Usage data collection utilities.',
            ),
            'core-import-export'        => array(
                'enabled'     => true,
                'type'        => 'core',
                'labels'      => array(
                    'name'  => 'Import/Export',
                    'group' => 'Core',
                ),
                'status'      => 'core',
                'legacy'      => false,
                'description' => 'Layout and template import/export handlers.',
            ),
        );

        /**
         * Allow external code to adjust feature flags.
         *
         * @param array<string, array<string, mixed>> $features Feature registry keyed by feature slug.
         */
        $features = apply_filters( 'satori_studio_feature_flags', $features );

        return is_array( $features ) ? $features : array();
    }
}
