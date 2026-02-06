# SATORI Studio branding assets

This directory contains the runtime branding assets derived from the Phase B canonical SVG specification.

Included files:
- satori-logo.svg
- satori-logo-pro.svg
- satori-icon.svg
- satori-icon-pro.svg
- satori-menu-icon.svg

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
- WordPress admin menu icon uses `assets/branding/satori-icon.svg`, which must remain a byte-identical alias of `docs/assets/studio-icons/satori-studio-lite.canonical.svg`.
- `satori-menu-icon.svg` is legacy and not used by active admin menu registration.
- PNG assets are intentionally not used for Studio Lite runtime branding.
