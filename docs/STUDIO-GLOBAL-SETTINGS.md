# SATORI Studio Global Settings (Phase 2E)

The Global Settings panel centralises core color, typography, and spacing configuration for SATORI Studio. During Phase 2E this screen acts as a scaffold and data store only; it does **not** change front-end rendering or builder defaults yet.

## Option storage
- **Option name:** `satori_studio_global_settings`
- **Structure:** associative array with top-level keys `colors`, `typography`, and `spacing`.
- **Seed defaults:** pulled from the Design System tokens where available (palette, spacing scale, typography scale).

### Colors
- `primary`
- `accent`
- `neutral_background`
- `neutral_surface`
- `neutral_border`

Color inputs use the same WordPress color picker behaviour as the Branding tab. Each row offers a **Default** button that restores the design-system seed value and a **Transparent** checkbox. Transparent selections are stored as the literal string `transparent` (sanitised alongside hex values) so templates can test for it directly.

### Typography
- `base_font_family`
- `base_font_size`
- `heading_font_family`

### Spacing
- `base_unit`
- `section_padding_default`

## Admin screen
- Location: SATORI Studio → **Global Settings** tab rendered within the main SATORI Studio Settings shell. There is no
  standalone admin page for Global Settings; all access routes through `admin.php?page=fl-builder-settings`.
- Group: `satori_studio_global_settings_group`
- Behaviour: stores values via the WordPress Settings API; no runtime overrides are applied in this phase.
- Admin registration: the parent settings shell remains the Beaver Builder settings page; Global Settings renders as an
  internal tab without registering its own admin page slug.
- Beaver Builder settings sidebar surfaces a convenience link back to Global Settings without altering BB Lite defaults.
- Navigation wiring: the Beaver Builder settings splash template (`includes/admin-settings-welcome.php`) is only included by
  the canonical settings controller, while the sidebar link is injected via `fl_builder_admin_settings_nav_after` as a single
  list item pointing to `admin.php?page=fl-builder-settings&tab=satori-global-settings`.
- Capability: access to Global Settings uses the same capability as the primary SATORI Studio Settings screen
  (`manage_options` by default).
- Rendering notes: `FLBuilderAdminSettings::render()` is the sole entry point for the settings UI and is guarded to run only
  once per request. The canonical templates live under `includes/admin-settings-*.php` and should remain in place for the
  settings controller.

### Access details (Phase 2E)
- Tab slug: `satori-global-settings`.
- Registration: surfaced via `admin.php?page=fl-builder-settings&tab=satori-global-settings`; no standalone admin page is
  registered.
- Capability: matches the main SATORI Studio Settings capability (defaults to `manage_options`).
