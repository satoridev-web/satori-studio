# SATORI Studio Admin Branding

Phase 2E.17A introduces an admin-only Branding tab inside the SATORI Studio settings shell. It centralizes the brand mark (logo) and optional admin accent color used across SATORI Studio admin surfaces.

## Settings

* **Option**: `satori_studio_admin_branding`
  * `mark_attachment_id` (int) — Media Library attachment ID for the brand mark. Defaults to `0` (fallback logo).
  * `admin_accent` (string) — Optional hex color used for admin-only accent styling.
* **Capability**: Filterable via `satori_studio_admin_branding_capability`; defaults to `manage_options` (aligned to the parent settings page).

### Filters

* `satori_studio_admin_branding` — Filter the full branding configuration array.
* `satori_studio_admin_brand_mark_url` — Filter the resolved brand mark URL (after fallback handling).

## UI Behavior

* Branding tab appears alongside existing SATORI tabs inside the persistent Beaver Builder settings shell.
* Logo chooser uses the WP Media Library. Removing the logo resets the stored attachment ID and restores the fallback placeholder asset.
* Accent color uses `wpColorPicker` and is scoped to `body.satori-studio-admin` via `--satori-admin-accent`.
* Branding assets (media modal, color picker, initializer JS) load only on the SATORI Studio settings screen.

## Helpers

Use `\Satori_Studio\Admin\Branding::instance()` to access branding helpers:

* `get_brand_mark_url()` — Canonical brand mark URL with fallback placeholder.
* `get_admin_accent()` — Sanitized hex color (empty string when unset).
* `get_branding()` — Full config array merged with defaults.
