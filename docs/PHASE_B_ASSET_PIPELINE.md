# SATORI Studio — Phase B Asset Pipeline (Canonical + Admin Binding)

## Purpose

This document defines the finalized Phase B icon pipeline so icon rendering is deterministic across fresh installs, hosted WordPress, and self-hosted WordPress.

## Canonical Source of Truth

Do not edit these files for runtime sizing or context-specific display behavior:

- `docs/assets/studio-icons/satori-studio.master.svg`
- `docs/assets/studio-icons/satori-studio-lite.canonical.svg`
- `docs/assets/studio-icons/satori-studio-pro.canonical.svg`

## Runtime Asset Binding

### Front-end and shared plugin icon

- Runtime path: `assets/branding/satori-icon.svg`
- Binding rule: byte-identical alias/copy of `docs/assets/studio-icons/satori-studio-lite.canonical.svg`

### Pro icon

- Runtime path: `assets/branding/satori-icon-pro.svg`
- Binding rule: byte-identical alias/copy of `docs/assets/studio-icons/satori-studio-pro.canonical.svg`

### WordPress admin menu icon

- Runtime path: `assets/branding/admin/satori-admin-menu-icon.svg`
- Registration point: `src/Core/Admin.php` via `add_menu_page(..., $icon_url)`
- Wrapper rule: this file is an admin-only thin framing wrapper that references canonical geometry from `assets/branding/satori-icon.svg`

## Why the Admin Wrapper Exists

WordPress admin menu icons are rendered to a fixed slot and do not honor source SVG `width` / `height` as layout intent. Because of this, canonical SVG geometry can appear optically oversized in admin even when technically correct.

To keep canonical assets immutable while fixing admin rendering consistency:

- We keep canonical SVG paths untouched.
- We use an admin-specific wrapper that adjusts only framing/viewport placement.
- We do not use CSS scaling hacks, runtime mutation, theme-dependent selectors, or user settings.

## Non-Negotiables

- No path geometry edits in canonical SVGs.
- No color changes for canonical branding assets.
- No admin CSS overrides for icon sizing.
- No dependence on local cache state or environment-specific behavior.

## Validation Checklist

- Front-end icon uses canonical SVG directly.
- Admin menu icon uses only `assets/branding/admin/satori-admin-menu-icon.svg`.
- Admin icon appears correctly sized in a fresh plugin activation.
- No legacy admin icon path is referenced by active registration code.
