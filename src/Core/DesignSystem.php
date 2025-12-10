<?php
/* -------------------------------------------------
 * SATORI Studio — Core Design System
 * -------------------------------------------------*/

/**
 * Foundational design system service exposing SATORI tokens.
 *
 * Responsibilities:
 * - Provide read-only access to core design tokens (colors, spacing, typography)
 *   for early consumers while the UI integration is developed.
 * - Offer WordPress filters so host projects can override token values without
 *   modifying core files.
 * - Prepare future linkage between PHP configuration and eventual CSS/JS token
 *   outputs in later phases.
 *
 * Lifecycle & usage notes:
 * - Instantiated lazily via the services container; tokens are simple
 *   associative arrays that can be safely read in filters and other hooks.
 * - This service does not enqueue assets or alter UI output. Future phases will
 *   connect the token definitions to CSS variables and builder controls.
 * - Debug logging is available via the `satori_studio_enable_design_system_debug`
 *   filter. It is disabled by default to avoid noise in production installs.
 *
 * @package Satori_Studio\Core
 */

namespace Satori_Studio\Core;

class DesignSystem {

        /**
         * Cached color palette tokens.
         *
         * @var array<string, string>
         */
        private $color_palette = array();

        /**
         * Cached spacing scale tokens.
         *
         * @var array<string, string>
         */
        private $spacing_scale = array();

        /**
         * Cached typography scale tokens.
         *
         * @var array<string, string>
         */
        private $typography_scale = array();

        /**
         * Constructor.
         */
        public function __construct() {
                $this->color_palette    = $this->prepare_color_palette();
                $this->spacing_scale    = $this->prepare_spacing_scale();
                $this->typography_scale = $this->prepare_typography_scale();

                $this->maybe_log_tokens();
        }

        /**
         * Retrieve the design system color palette.
         *
         * The palette is provided as a simple associative array for now, with
         * WordPress filters available for overrides.
         *
         * @return array<string, string>
         */
        public function get_color_palette() {
                /**
                 * Filter design system color tokens.
                 *
                 * @param array<string, string> $color_palette Color palette tokens keyed by semantic name.
                 */
                return apply_filters( 'satori_studio_design_tokens_colors', $this->color_palette );
        }

        /**
         * Retrieve the spacing scale definitions.
         *
         * @return array<string, string>
         */
        public function get_spacing_scale() {
                /**
                 * Filter design system spacing tokens.
                 *
                 * @param array<string, string> $spacing_scale Spacing tokens keyed by scale step.
                 */
                return apply_filters( 'satori_studio_design_tokens_spacing', $this->spacing_scale );
        }

        /**
         * Retrieve the typography scale definitions.
         *
         * @return array<string, string>
         */
        public function get_typography_scale() {
                /**
                 * Filter design system typography tokens.
                 *
                 * @param array<string, string> $typography_scale Typography tokens keyed by size label.
                 */
                return apply_filters( 'satori_studio_design_tokens_typography', $this->typography_scale );
        }

        /**
         * Define the default color palette tokens.
         *
         * @return array<string, string>
         */
        private function prepare_color_palette() {
                return array(
                        'primary'    => '#1D4ED8',
                        'secondary'  => '#10B981',
                        'accent'     => '#0EA5E9',
                        'neutral-100' => '#F3F4F6',
                        'neutral-200' => '#E5E7EB',
                        'neutral-300' => '#D1D5DB',
                        'neutral-400' => '#9CA3AF',
                        'neutral-500' => '#6B7280',
                        'neutral-600' => '#4B5563',
                        'neutral-700' => '#374151',
                        'neutral-800' => '#1F2937',
                        'neutral-900' => '#111827',
                );
        }

        /**
         * Define the default spacing scale tokens.
         *
         * @return array<string, string>
         */
        private function prepare_spacing_scale() {
                return array(
                        'xs' => '4px',
                        'sm' => '8px',
                        'md' => '12px',
                        'lg' => '16px',
                        'xl' => '24px',
                );
        }

        /**
         * Define the default typography scale tokens.
         *
         * @return array<string, string>
         */
        private function prepare_typography_scale() {
                return array(
                        'small' => '0.875rem',
                        'base'  => '1rem',
                        'large' => '1.25rem',
                );
        }

        /**
         * Optionally log tokens when the debug filter is enabled.
         *
         * This is a temporary bridge for development visibility. It should remain
         * disabled in production environments unless explicitly toggled.
         *
         * @return void
         */
        private function maybe_log_tokens() {
                $enabled = apply_filters( 'satori_studio_enable_design_system_debug', false );

                if ( true !== $enabled ) {
                        return;
                }

                $payload = array(
                        'colors'     => $this->color_palette,
                        'spacing'    => $this->spacing_scale,
                        'typography' => $this->typography_scale,
                );

                if ( function_exists( 'do_action' ) ) {
                        /**
                         * Allow projects to hook into design token debug logging.
                         *
                         * @param array<string, array<string, string>> $payload Full token payload for debugging.
                         */
                        do_action( 'satori_studio_design_system_debug_log', $payload );
                }

                if ( function_exists( 'wp_json_encode' ) ) {
                        error_log( 'SATORI DesignSystem tokens: ' . wp_json_encode( $payload ) );
                        return;
                }

                error_log( 'SATORI DesignSystem tokens: ' . print_r( $payload, true ) );
        }
}
