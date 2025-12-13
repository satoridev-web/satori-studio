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

### Typography
- `base_font_family`
- `base_font_size`
- `heading_font_family`

### Spacing
- `base_unit`
- `section_padding_default`

## Admin screen
- Location: SATORI Studio → **Global Settings**
- Group: `satori_studio_global_settings_group`
- Behaviour: stores values via the WordPress Settings API; no runtime overrides are applied in this phase.
- Admin registration: menu and submenu are registered through the core Admin bootstrap to avoid duplicates.
- Beaver Builder settings sidebar surfaces a convenience link back to Global Settings without altering BB Lite defaults.
- Navigation wiring: the Beaver Builder settings splash template (`includes/admin-settings-welcome.php`) is only included by
  the canonical settings controller, while the sidebar link is injected via `fl_builder_admin_settings_nav_after` as a single
  list item pointing to `admin.php?page=satori-studio-global-settings`.
- Submenu registration: Global Settings is registered as a hidden submenu under the SATORI Studio settings slug
  (`fl-builder-settings`) with the menu slug `satori-studio-global-settings`, keeping it accessible via direct URL without
  adding clutter to the main WordPress sidebar.
- Capability: access to Global Settings uses the same capability as the primary SATORI Studio Settings screen
  (`manage_options` by default).
- Rendering notes: `FLBuilderAdminSettings::render()` is the sole entry point for the settings UI and is guarded to run only
  once per request. The canonical templates live under `includes/admin-settings-*.php` and should remain in place for the
  settings controller.

### Access details (Phase 2E)
- Admin page slug: `satori-studio-global-settings`.
- Registration: hidden submenu under the SATORI Studio Settings parent slug `fl-builder-settings`.
- Capability: matches the main SATORI Studio Settings capability (defaults to `manage_options`).
