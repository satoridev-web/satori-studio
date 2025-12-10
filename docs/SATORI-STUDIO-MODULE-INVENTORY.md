# SATORI Studio Module Inventory

This inventory captures the modules, extensions, and core feature areas currently shipped with the SATORI Studio fork. It is informational only for Phase 1B; all features remain enabled by default.

## Status legend
- **core** — foundational functionality expected to stay enabled.
- **optional** — integrations or specialised features that can be toggled in specific environments.
- **legacy** — older pathways kept for compatibility (still enabled in Phase 1B).
- **unknown** — not yet classified.

## Modules (`/modules`)
| Slug | Description | Status | Notes |
| --- | --- | --- | --- |
| acf-block | Render ACF-defined blocks within the builder. | optional | ACF integration; depends on ACF configuration. |
| audio | Audio player module for embeds/files. | core | |
| box | Content box with image/text layout options. | core | Formerly “content panel” style module. |
| button | Standard button with style controls. | core | |
| button-group | Multiple buttons with grouped layout. | core | |
| callout | Media + text callout layout. | core | |
| cta | Call-to-action module with headline/button. | core | |
| heading | Heading/typography module. | core | |
| html | Raw HTML output module. | core | |
| icon | Icon-only display module. | core | |
| menu | Menu/navigation module. | optional | Depends on WordPress menus. |
| numbers | Number counter/highlight module. | optional | Often used for stats; not required for layouts. |
| photo | Image display module. | core | |
| reusable-block | Embed a WordPress reusable block. | optional | Block editor integration path. |
| rich-text | Rich text/WYSIWYG module. | core | |
| sidebar | Output a registered WordPress sidebar. | optional | Uses classic widget areas. |
| video | Video embed module. | core | |
| widget | Embed a WordPress widget. | legacy | Classic widget bridge retained for compatibility. |

## Extensions (`/extensions`)
| Slug | Description | Status | Notes |
| --- | --- | --- | --- |
| fl-builder-cache-helper | Cache clear helper hooks. | optional | Utility extension. |
| fl-builder-hostinger | Hostinger-specific integration tweaks. | optional | Hostinger hosting compatibility. |
| fl-builder-multisite | Multisite-specific support. | optional | Enables multisite behaviours. |
| fl-builder-popup-maker | Integration bridge for Popup Maker plugin. | optional | Third-party integration. |
| fl-builder-seo-plugins | SEO plugin compatibility helpers. | optional | Integrates with common SEO plugins. |

## Core classes and systems (`/classes`)
| Slug | Type | Description | Status |
| --- | --- | --- | --- |
| class-fl-builder-loader | bootstrap | Defines builder constants and loads core files. | core |
| class-fl-builder | runtime | Central builder runtime and API surface. | core |
| class-fl-builder-model | data | Handles builder data operations and module registration. | core |
| class-fl-builder-admin, class-fl-builder-admin-settings | admin | Admin UI, settings pages, and notices. | core |
| class-fl-builder-import / class-fl-builder-export / class-fl-builder-importer | import/export | Template and layout import/export handling. | core |
| class-fl-builder-revisions | revisions | Revision and history management. | core |
| class-fl-builder-extensions | extension loader | Boots extensions from `/extensions`. | core |
| class-fl-builder-wp-blocks / class-fl-builder-module-blocks | integration | Registers WP block editor support. | optional |
| class-fl-builder-wpml | integration | WPML compatibility helpers. | optional |
| class-fl-builder-seo | integration | SEO plugin compatibility hooks. | optional |
| class-fl-builder-wpcli-command | tooling | WP-CLI commands for the builder. | optional |
| class-fl-builder-usage | telemetry | Usage data collection utilities. | optional |
| class-fl-builder-update | updates | Update check handling. | core |

## Includes and admin features (`/includes`)
| Slug | Type | Description | Status |
| --- | --- | --- | --- |
| admin-settings-*.php | admin | Builder settings screens (modules, license, tools, user access, etc.). | core |
| layout-*.php, module-*.php, row-*.php | runtime | Layout rendering helpers for rows, columns, and modules. | core |
| ui-field-*.php, ui-js-*.php | ui | Shared UI components and templates for builder controls. | core |
| updater/ | updates | Update engine configuration and endpoints. | core |
| compatibility.php | compatibility | WordPress/theme compatibility shims. | core |
| strings.php | translations | Localised strings and helper text. | core |

This inventory will inform future phases; no modules or features are removed or disabled in Phase 1B.
