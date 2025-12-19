# Phase A – Modules and Features Audit (Lite)

## Module Inventory
| Module (slug / directory) | Display name | Notes |
| --- | --- | --- |
| `acf-block` | ACF Block | Registered but disabled; intended to expose ACF blocks via aliases when available.【F:modules/acf-block/acf-block.php†L10-L24】 |
| `audio` | Audio | Basic module rendering WordPress audio shortcodes; appears in builder with Basic category.【F:modules/audio/audio.php†L16-L25】 |
| `box` | Box | Layout container with grid/flex support; enabled only on WP ≥5.2 and not on ClassicPress; registers custom UI fields and block editor support.【F:modules/box/box.php†L5-L30】 |
| `box` aliases | Flex Columns; 3x2 Grid; 4x2 Grid; Split Header; Photo Grid | Preconfigured Box aliases registered for builder palette with Box category thumbnails.【F:modules/box/box-aliases.php†L4-L58】 |
| `button` | Button | Basic call-to-action button module; shown in builder Basic category.【F:modules/button/button.php†L11-L20】 |
| `button-group` | Button Group | Renders multiple CTA buttons; Basic category.【F:modules/button-group/button-group.php†L11-L20】 |
| `callout` | Callout | Heading/text with optional media and link; Actions category.【F:modules/callout/callout.php†L11-L18】 |
| `cta` | Call to Action | Heading, subheading, and button; Actions category.【F:modules/cta/cta.php†L11-L18】 |
| `heading` | Heading | Title/page heading module in Basic category.【F:modules/heading/heading.php†L12-L21】 |
| `html` | HTML | Raw HTML embed module; Basic category.【F:modules/html/html.php†L11-L20】 |
| `icon` | Icon | Icon with optional title; category shifts between Basic and Media depending on Lite flag; block editor enabled.【F:modules/icon/icon.php†L11-L20】 |
| `menu` | Menu | Renders WordPress menus with Actions category placement.【F:modules/menu/menu.php†L21-L29】 |
| `numbers` | Number Counter | Animated counter module in Info category; includes JS dependency registration.【F:modules/numbers/numbers.php†L11-L22】 |
| `photo` | Photo | Image display module with media library/URL options; Basic category.【F:modules/photo/photo.php†L22-L30】 |
| `reusable-block` | WordPress Pattern | Registered but disabled in favor of generated aliases for patterns; grouped under WordPress Patterns.【F:modules/reusable-block/reusable-block.php†L14-L24】 |
| `rich-text` | Text Editor | WYSIWYG editor module in Basic category.【F:modules/rich-text/rich-text.php†L11-L20】 |
| `sidebar` | Sidebar | Outputs registered WordPress sidebars; category varies by Lite/Pro state.【F:modules/sidebar/sidebar.php†L11-L19】 |
| `video` | Video | Embeds WordPress or external video; Basic category with fitvids helper.【F:modules/video/video.php†L16-L27】 |
| `widget` | Widget | Displays WordPress widgets; grouped/category set to WordPress Widgets.【F:modules/widget/widget.php†L11-L19】 |

## Admin Features
- Settings navigation includes optional legacy Upgrade and License tabs gated by feature flags (`ui-legacy-upgrade-screen`, `ui-legacy-license-screen`).【F:classes/class-fl-builder-admin-settings.php†L293-L407】
- Welcome screen shows upgrade CTA plus Assistant Pro and Beaver Themer promos when legacy flags allow, with upgrade URL UTM parameters targeting Lite installs.【F:includes/admin-settings-welcome.php†L22-L113】
- Dedicated Upgrade settings page markets premium features (templates, saved layouts, additional modules) and links to upgrade URL.【F:includes/admin-settings-upgrade.php†L8-L33】
- Plugin action links add an Upgrade CTA in the plugins list when Lite and legacy promos are enabled.【F:classes/class-fl-builder-admin.php†L249-L276】

## Builder Features
- Pro feature lightbox and upgrade buttons appear in builder UI templates when legacy promos are enabled; otherwise messaging notes unavailability without offering purchase links.【F:includes/ui-js-templates.php†L1-L23】
- Module panel includes a "Pro" section listing disabled premium modules with upgrade CTA overlay; same panel shows promo banner linking to wpbeaverbuilder.com with Learn More button when Lite is detected.【F:includes/ui-js-templates.php†L511-L560】
- Template picker displays premium templates with disabled state and upgrade messaging; Lite-only upgrade view encourages learning more about premium templates.【F:includes/ui-js-templates.php†L640-L817】
- Select field renderer hides premium-labeled options when Lite is true, preventing selection of gated controls in the UI.【F:includes/ui-field-select.php†L135-L180】
- Row settings background types mark Slideshow and Parallax entries as premium, reinforcing Lite gating inside advanced backgrounds UI.【F:includes/row-settings.php†L243-L274】

## Frontend References
- Menu module frontend CSS switches Font Awesome family based on whether Font Awesome Pro is enabled, affecting rendered icons on the site front end.【F:modules/menu/includes/frontend.css.php†L724-L729】

## Pro / Legacy References
- Feature flag registry lists legacy upgrade, license, and upsell toggles describing Beaver Builder premium plan messaging; default state disabled but still present in Lite codebase.【F:src/Core/Features.php†L323-L356】
- Builder upgrade buttons and click handlers open upgrade URL when present in UI (`fl-builder-upgrade-button` bindings).【F:js/fl-builder.js†L1037-L1046】
- Builder configuration injects upgrade URL for Lite builds used across UI prompts.【F:includes/ui-js-config.php†L36-L37】
- Admin upgrade CTAs in welcome and upgrade screens reference Beaver Builder URLs and Assistant Pro/Beaver Themer marketing, reflecting legacy Pro upsell surfaces.【F:includes/admin-settings-welcome.php†L34-L113】【F:includes/admin-settings-upgrade.php†L10-L24】
- Hostinger extension replaces upgrade URLs with Hostinger-specific promo link, showing third-party upsell integration.【F:extensions/fl-builder-hostinger/includes/upgrade-notice.php†L4-L8】

## Recommended Phase A Actions (high-level, no implementation)
- Confirm which modules remain in Lite and mark legacy/disabled modules (ACF Block, WordPress Pattern) for potential removal or explicit hiding in UI.
- Audit builder templates and background options to ensure premium-only items are hidden or rephrased for Lite without upgrade CTAs.
- Disable or remove legacy upgrade/promotional screens and builder UI banners tied to Beaver Builder Pro, Assistant Pro, and Themer unless explicitly required in roadmap.
- Review frontend assets (e.g., Font Awesome Pro toggles) to ensure they do not expose Pro-only dependencies or messaging on Lite installs.
- Consolidate upgrade URL handling to SATORI-specific destinations before any behavior changes in later phases.

## Executed Phase A Actions
- Unregistered `acf-block` and `reusable-block` modules in Lite via the feature registry so they no longer load or surface in the builder palette, while keeping their definitions intact for future ACF/pattern integrations.
