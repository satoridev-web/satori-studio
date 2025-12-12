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
- Navigation wiring: the Beaver Builder settings splash template is only included by the canonical settings controller; SATORI
  Studio must not ship duplicate `admin-settings-*` templates. The sidebar link is injected via
  `fl_builder_admin_settings_nav_after` as a single list item pointing to `admin.php?page=satori-studio-global-settings`.

## Maintenance notes
- Admin settings templates (`admin-settings-*`) are owned by the upstream Beaver Builder Lite controller and must **not** be
  added to the SATORI Studio fork. The SATORI Studio Settings screen delegates entirely to the canonical controller to avoid
  duplicate rendering and function redeclarations.
