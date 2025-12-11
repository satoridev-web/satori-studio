
# SATORI Studio Standards v1.0

This document defines the foundational engineering, design, and distribution standards for the SATORI Studio ecosystem, including Studio Core, Studio Pro, Studio Modules, Suite Add‑Ons, and the future SATORI Studio Theme.

---

## 1. Coding Standards

### 1.1 PHP Standards
- Namespaces: `Satori\Studio\{Component}`
- `declare(strict_types=1);` required at top of all PHP files.
- 4‑space indentation, no tabs.
- PSR‑4 autoloading applied across all repos.
- Avoid global state; use dependency injection where appropriate.
- SATORI comment blocks required (see Section 2).
- Rendering only occurs inside `frontend.php` files.
- Config arrays used for module definitions (consistent with BB‑Lite architecture).
- All output escaped using WordPress standard escaping (`esc_html`, `esc_attr`, etc.).

### 1.2 JavaScript Standards
- ES6 modules (`import` / `export`).
- Use `window.SatoriStudio` as the global namespace when needed.
- Avoid jQuery unless interacting with legacy BB‑Lite internals.
- Prefer vanilla JS for DOM manipulation.
- Use event delegation for builder UI interactions.
- Modules must not block the main thread—async where possible.

### 1.3 SCSS Standards
- Use SATORI design tokens defined in:
  - `_tokens.scss` (colors, spacing, typography, radii, shadows)
  - `_mixins.scss` (breakpoints, utilities, animations)
- Use SCSS partials for modules:
  - `/assets/scss/modules/{module-name}.scss`
- 8‑point spacing scale.
- Variables over hardcoded values.
- Output minified CSS in production builds.
- Admin screens expose design tokens via CSS custom properties on `body.satori-studio-admin` (colors, spacing, typography available through `--satori-*` variables).

### 1.4 Global Settings (Phase 2E)
- Global Settings admin page stores color, typography, and spacing configuration in the `satori_studio_global_settings` option.
- Stored values are scaffold-only in this phase and do not override SCSS tokens or builder defaults yet.

### 1.5 Admin Navigation
- SATORI Studio remains a top-level admin hub; the legacy Settings → SATORI Studio submenu is removed at runtime for clarity.

---

## 2. Commenting Standard

All SATORI Studio code must use the SATORI boxed block header:

```
/* -------------------------------------------------
 * SATORI Studio — Description of component or logic
 * -------------------------------------------------*/
```

Additional inline comments should follow WordPress/WPCS conventions.

---

## 3. UI/UX Standards for Builder Interface

### 3.1 Panels and Controls
- All modules must use consistent control UI (text fields, toggles, selects, Repeater fields).
- SATORI color palette appears first in all color pickers.
- Typography defined using Studio Global Styles.
- Layout controls (margin/padding) standardized across modules.

### 3.2 Responsive Controls
- All modules support:
  - Desktop
  - Tablet
  - Mobile
- Pro: Custom breakpoints (optional)

### 3.3 Icons and Aesthetic
- All module icons must be SVG.
- Icon style: outline‑based SATORI icon set (Feather‑like).
- Builder UI colors follow SATORI palette:
  - Primary: SATORI Blue
  - Accent: SATORI Teal
  - Neutral greys: tokens defined in `_tokens.scss`.

### 3.4 Builder Shell Tokenization (Phase 2C)
- Builder toolbar chrome, side panel shell, section headings, and core actions inherit SATORI CSS variables exposed on `body.satori-studio-admin`.
- Styling adjustments are limited to color, typography alignment, and subtle radius updates; layout and Beaver Builder Lite internals remain unchanged.
- Deeper control/field alignment will follow in later phases.

### 3.5 Builder Controls Tokenization (Phase 2D)
- Builder-side controls (inputs, selects, textareas, toggles, helper text) now consume SATORI tokens within `body.satori-studio-admin` using `_builder-controls.scss`.
- Aligns field chrome, focus, hover, and simple error visuals to the SATORI color, typography, and radius tokens without altering control behaviour or layout.
- Simple inline helper/description text inherits the base font family and small typography token for legibility inside the builder.
- Later phases will extend token coverage to module-specific styling and Pro-only surfaces; Beaver Builder Lite core assets remain unchanged.

---

## 4. Module Architecture Standard

Each module must adhere to the following structure:

```
/modules/{module-name}/
    module.php          (class + registration)
    config.php          (settings array)
    frontend.php        (render template)
    frontend.scss       (module-specific SCSS)
    frontend.js         (module JS)
    icon.svg            (SVG icon)
```

### Every module must support:
- ACF dynamic data
- Conditional display
- Responsive visibility
- Animations
- Global Styles overrides
- Accessibility requirements (ARIA, alt attributes, keyboard nav)

---

## 5. Naming Conventions

### 5.1 Repository and Package Names
- `satori-studio-core`
- `satori-studio-pro`
- `satori-studio-modules`
- `satori-studio-suite-events`
- `satori-studio-suite-forms`
- `satori-studio-suite-crm`
- etc.

### 5.2 Module Classes
`Satori_Studio_{ModuleName}_Module`

### 5.3 File Naming
- `studio-{feature}-{slug}.php`
- SCSS: `{module-name}.scss`
- JS: `{module-name}.js`

---

## 6. Distribution & Licensing Standards

### 6.1 GPL Licensing
- All SATORI Studio code must remain GPL‑compatible.
- SATORI may charge for:
  - updates
  - support
  - Pro features
  - marketplace items
  - cloud template library access

### 6.2 Licensing API
A unified licensing API must:
- Validate licenses via JWT  
- Enable auto‑updates  
- Allow tiered product access  
- Provide usage analytics (optional)

### 6.3 Cloud Template Library
- Templates synced from WordPressed.com.au
- Studio Pro customers gain access to premium templates
- Templates defined with metadata:
  - Name
  - Category
  - Tags
  - Thumbnail
  - Dependencies

---

## 7. Integration Standards (SATORI Suite)

Every Suite add‑on must:
- Provide module definitions for use inside Studio
- Use shared SATORI utilities
- Register dynamic data sources
- Follow naming + module structure standards
- Integrate with Global Styles when applicable

Examples:
- Events Grid uses global card styles
- Forms renderer uses Studio typography + spacing tokens

---

## 8. Versioning & Release Management

- SemVer required (MAJOR.MINOR.PATCH).
- GitHub PR workflow enforced.
- Changelogs must follow SATORI CHANGELOG format.
- Releases tagged and packaged via CI.

---

# End of Standards Document
