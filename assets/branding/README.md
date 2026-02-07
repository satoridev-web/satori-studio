# SATORI Studio branding assets

This directory contains the runtime branding assets derived from the Phase B canonical SVG specification.

Included files:
- satori-logo.svg
- satori-logo-pro.svg
- satori-icon.svg
- satori-icon-pro.svg
- admin/satori-admin-menu-icon.svg

Runtime source-of-truth notes:
- Canonical source files live in `docs/assets/studio-icons/`.
- `satori-icon.svg` is a verbatim runtime copy of `docs/assets/studio-icons/satori-studio-lite.canonical.svg`.
- `satori-icon-pro.svg` is a verbatim runtime copy of `docs/assets/studio-icons/satori-studio-pro.canonical.svg`.
- `satori-icon.svg` and `satori-icon-pro.svg` must never be edited directly.
- Any future icon change starts in canonical files under `docs/assets/studio-icons/`, then copies forward into runtime assets.
- Canonical and runtime icon SVGs must remain free of tool-export metadata comments (for example, Illustrator generator headers).

Menu icon notes:
- Studio Lite and Pro branding are SVG-only for runtime usage.
- `satori-logo.svg` and `satori-logo-pro.svg` mirror the canonical Lite/Pro marks for admin branding placeholders.
- WordPress admin menu icon uses `assets/branding/admin/satori-admin-menu-icon.svg`.
- The admin icon is a thin framing wrapper that references canonical geometry from `assets/branding/satori-icon.svg`; only viewport framing changes for WordPress admin menu optics.
- No CSS scaling or runtime icon mutation is used for admin menu sizing.
