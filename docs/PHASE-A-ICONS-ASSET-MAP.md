# Phase A — Icons & Branding Asset Map

Scope authority: PHASE-A-BRANDING-UI-TOUCHPOINT-AUDIT.md (not present in repo; this map lists current touchpoints discovered for placeholder wiring).

## Placeholder asset paths
The following files should be supplied by design and placed under `assets/branding/`:
- `satori-logo.svg`
- `satori-logo-pro.svg`
- `satori-icon.svg`
- `satori-icon-pro.svg`

## Touchpoint inventory
- **WP Admin menu icon (sidebar)** — `src/Core/Admin.php` registers the SATORI Studio top-level menu. The `add_menu_page` icon now points to `assets/branding/admin/satori-admin-menu-icon.svg`, an admin-only thin wrapper that references canonical geometry from `assets/branding/satori-icon.svg` (byte-identical alias of `docs/assets/studio-icons/satori-studio-lite.canonical.svg`).
- **Admin Branding tab fallback logo** — `src/Admin/Branding.php` uses `assets/branding/satori-logo.svg` (Lite) or `assets/branding/satori-logo-pro.svg` (Pro) as the default preview when no custom brand mark is uploaded.
- **Builder panel upgrade CTAs** — `includes/ui-js-templates.php` promo blocks in the modules, column groups, and templates panels display `assets/branding/satori-icon.svg`.
- **Default branding icon helper** — `classes/class-fl-builder-model.php` returns `assets/branding/satori-icon.svg` (Lite) or `assets/branding/satori-icon-pro.svg` (Pro) from `get_branding_icon()` for shared admin/builder surfaces.

Notes:
- No icon artwork is bundled; these paths are stable drop-in targets for final assets.
- No UI layout or styling changes were made; only asset references were updated.
