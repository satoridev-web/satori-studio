# SATORI Module & Feature Audit — Phase 1C

Purpose: first-pass inventory of SATORI Studio modules and admin features to identify legacy/upsell surfaces for soft-pruning. No modules were removed.

## Classification legend
- **Core** — required for base page builder functionality.
- **Optional** — useful integrations or helpers that are non-essential.
- **Legacy** — older pathways retained for compatibility.
- **Upsell** — marketing/promotional UI for Beaver Builder-era products.

## Modules (`/modules`)
| Slug / Name | Type | Path / UI location | Status | Recommendation | Notes |
| --- | --- | --- | --- | --- | --- |
| acf-block | Content/Integration module | modules/acf-block/acf-block.php | Optional | Keep for now | Depends on ACF for data sources. |
| audio | Media module | modules/audio/audio.php | Core | Keep | |
| box | Layout/content module | modules/box/box.php | Core | Keep | Includes aliases in modules/box/box-aliases.php. |
| button | Content module | modules/button/button.php | Core | Keep | |
| button-group | Content module | modules/button-group/button-group.php | Core | Keep | |
| callout | Content module | modules/callout/callout.php | Core | Keep | |
| cta | Content module | modules/cta/cta.php | Core | Keep | |
| heading | Content module | modules/heading/heading.php | Core | Keep | |
| html | Content module | modules/html/html.php | Core | Keep | |
| icon | Media module | modules/icon/icon.php | Core | Keep | |
| menu | Navigation module | modules/menu/menu.php | Optional | Keep for now | Depends on WordPress menus. |
| numbers | Content module | modules/numbers/numbers.php | Optional | Keep for now | Stat/counter usage only. |
| photo | Media module | modules/photo/photo.php | Core | Keep | |
| reusable-block | Integration module | modules/reusable-block/reusable-block.php | Optional | Keep for now | Embeds WP reusable blocks. |
| rich-text | Content module | modules/rich-text/rich-text.php | Core | Keep | |
| sidebar | WordPress module | modules/sidebar/sidebar.php | Optional | Keep for now | Requires classic widget areas. |
| video | Media module | modules/video/video.php | Core | Keep | |
| widget | WordPress bridge module | modules/widget/widget.php | Legacy | Keep for now | Legacy widget compatibility path. |

## Extensions and integrations (`/extensions`)
| Slug / Name | Type | Path / UI location | Status | Recommendation | Notes |
| --- | --- | --- | --- | --- | --- |
| fl-builder-cache-helper | Extension | extensions/fl-builder-cache-helper/ | Optional | Keep for now | Cache clear hooks. |
| fl-builder-hostinger | Hosting integration | extensions/fl-builder-hostinger/ | Optional | Keep for now | Hostinger compatibility. |
| fl-builder-multisite | Multisite support | extensions/fl-builder-multisite/ | Optional | Keep for now | Enables multisite behaviours. |
| fl-builder-popup-maker | Integration | extensions/fl-builder-popup-maker/ | Optional | Keep for now | Depends on Popup Maker plugin. |
| fl-builder-seo-plugins | Integration | extensions/fl-builder-seo-plugins/ | Optional | Keep for now | SEO plugin helpers. |

## Admin screens and feature surfaces
| Slug / Name | Type | Path / UI location | Status | Recommendation | Notes |
| --- | --- | --- | --- | --- | --- |
| Welcome screen | Admin onboarding | includes/admin-settings-welcome.php | Core | Keep (promos gated) | Upgrade/Themer/Assistant promos now behind feature flags. |
| License screen | Admin settings | includes/admin-settings-license.php | Legacy | Hide in UI (flag default off) | Intended for Beaver Builder commercial keys. |
| Upgrade screen | Admin settings | includes/admin-settings-upgrade.php | Upsell | Hide in UI (flag default off) | Marketing-only content. Guarded with flagged notice. |
| Modules / Blocks / Post Types / User Access / Icons / Tools / Advanced / Import-Export | Admin settings tabs | includes/admin-settings-*.php | Core | Keep | Standard builder configuration. |
| Plugin row Upgrade link | Admin list CTA | classes/class-fl-builder-admin.php | Upsell | Hide in UI (flag default off) | Removed when `ui-legacy-upgrade-promos` is disabled. |
| Builder menu Upgrade button | Builder UI CTA | classes/class-fl-builder.php | Upsell | Hide in UI (flag default off) | Removed when `ui-legacy-upgrade-promos` is disabled. |
| Templates panel upgrade overlays | Builder UI CTA | includes/ui-js-templates.php | Upsell | Hide in UI (flag default off) | CTA/promo templates now suppressed when flags are off. |
| Themer promo panel | Promo | includes/admin-settings-welcome.php | Upsell | Hide in UI (flag default off) | Requires Themer; gated by `ui-legacy-themer-promos`. |
| Assistant Pro promo panel | Promo | includes/admin-settings-welcome.php | Upsell | Hide in UI (flag default off) | Gated by `ui-legacy-assistant-promos`. |

## Notable coupling / risk areas
- **ACF Block module** depends on ACF; disabling without communication could surprise sites relying on dynamic content.
- **Widget/Sidebar modules** rely on classic widget areas; consider future deprecation plans but leave enabled for compatibility.
- **Multisite / WP-CLI / SEO extensions** are optional yet harmless; avoid removal until environments are validated.
- **Legacy upsell screens** are hidden via feature flags to avoid fatal errors while keeping URLs harmless.

## References
- Feature registry: `src/Core/Features.php` (`ui-legacy-*` flags added in Phase 1C).
- Helper usage: `satori_studio_feature_enabled()` in `satori-studio.php`.
- Architecture overview: `docs/SATORI-STUDIO-CORE-ARCHITECTURE.md` (updated with registry locations).
