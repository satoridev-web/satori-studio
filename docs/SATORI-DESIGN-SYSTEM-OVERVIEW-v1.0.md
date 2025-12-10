# SATORI Design System Overview v1.0

## Purpose
- Establish a single source of truth for SATORI design tokens (colors, spacing, typography) inside PHP.
- Provide a stable API that downstream systems can consume without hardcoding values or duplicating configuration.
- Prepare for future phases that will emit CSS variables and JS token maps for the builder UI while keeping this phase read-only.

## DesignSystem service
- **Namespace:** `Satori_Studio\Core\DesignSystem`
- **Access patterns:**
  - Services container ID: `design_system`
  - Plugin accessor: `$plugin->get_design_system()`
  - Global helper: `satori_studio_design_system()`
- **Lifecycle:** Instantiated lazily through the core services container; safe to call from filters/actions as a read-only configuration source.
- **Debugging:** Enable the `satori_studio_enable_design_system_debug` filter to `true` to log current tokens for inspection (defaults to disabled).

## Token structure (initial skeleton)
- **Colors (`get_color_palette()`):**
  - `primary`, `secondary`, `accent`
  - Neutral ramp: `neutral-100` … `neutral-900`
- **Spacing (`get_spacing_scale()`):** `xs`, `sm`, `md`, `lg`, `xl`
- **Typography (`get_typography_scale()`):** `small`, `base`, `large`

## Override hooks
Projects can override token values without editing core files:
- `satori_studio_design_tokens_colors`
- `satori_studio_design_tokens_spacing`
- `satori_studio_design_tokens_typography`

Use these filters to return modified associative arrays that match the expected structures above.

## Future consumption guidance
- The current service is intentionally read-only and does not alter CSS/JS output.
- Future phases will map these tokens to CSS variables, builder control defaults, and JS utilities so the builder UI inherits SATORI styling.
- When extending modules or UI components later, prefer consuming tokens via the DesignSystem service (or its helpers) rather than hardcoding values.
