
# SATORI Studio Repository Scaffold v1.0

This document describes the recommended repository layout for the SATORI Studio ecosystem.

It assumes:

- **One primary free plugin repo**: `satori-studio` (core engine + base modules).
- **One commercial add-on repo**: `satori-studio-pro`.
- **Separate repos for each Suite integration** (Events, Forms, CRM, Audit, Tools).
- **One theme repo** optimised for SATORI Studio: `satori-studio-theme`.

All code follows the SATORI Studio Standards v1.0.

---

## 1. Repository List

1. `satori-studio`  
   – Free core builder + essential modules.

2. `satori-studio-pro`  
   – Commercial add-on with advanced modules and features.

3. `satori-studio-suite-events`  
   – Events CPT + SATORI Studio Events modules.

4. `satori-studio-suite-forms`  
   – Forms engine + SATORI Studio form modules.

5. `satori-studio-suite-crm`  
   – CRM entities + SATORI Studio CRM modules.

6. `satori-studio-suite-audit`  
   – Audit engine + Studio admin-only audit modules.

7. `satori-studio-suite-tools`  
   – Cross-site utilities + Studio design/system helpers.

8. `satori-studio-theme`  
   – Theme optimised for SATORI Studio.

---

## 2. Shared Top-Level Structure (All Plugin Repos)

Each plugin repository follows this basic structure:

```text
.
├── .github/
│   └── workflows/
│       ├── phpcs.yml
│       └── tests.yml              # optional, e.g. phpunit/integration
├── .gitignore
├── .phpcs.xml.dist
├── composer.json
├── CHANGELOG.md
├── LICENSE
├── README.md
├── docs/
│   ├── ROADMAP.md                 # per-project
│   └── STANDARDS.md               # can reference SATORI Studio Standards
├── assets/
│   ├── css/
│   ├── js/
│   └── scss/
└── src/
    └── (namespaced PHP classes)
```

Notes:

- `src/` is PSR-4 mapped in `composer.json`.
- `assets/` contains SCSS sources; compiled CSS goes to `assets/css/` or `build/` depending on tooling.
- `docs/` holds project-specific specs and internal notes.

---

## 3. `satori-studio` (Free Core + Base Modules)

This is the main free plugin users install. It contains:

- SATORI Studio engine (forked from BB Lite).
- Builder UI.
- Layout storage.
- Essential modules (heading, text, button, image box, etc.).

```text
satori-studio/
├── .github/
├── .gitignore
├── .phpcs.xml.dist
├── composer.json
├── CHANGELOG.md
├── LICENSE
├── README.md
├── docs/
│   ├── SATORI-STUDIO-ROADMAP-v1.0.md
│   └── SATORI-STUDIO-STANDARDS-v1.0.md
├── assets/
│   ├── css/
│   ├── js/
│   └── scss/
│       ├── _tokens.scss           # design tokens (colors, spacing, typography)
│       ├── _mixins.scss
│       ├── builder-ui.scss        # main builder interface styles
│       └── modules.scss           # imports module partials
├── modules/
│   ├── heading/
│   │   ├── module.php             # class Satori_Studio_Heading_Module
│   │   ├── config.php             # settings arrays
│   │   ├── frontend.php           # render template
│   │   ├── frontend.scss
│   │   ├── frontend.js
│   │   └── icon.svg
│   ├── text-editor/
│   ├── button/
│   ├── image/
│   ├── column-layout/
│   └── (other base modules)
├── templates/
│   └── frontend/                  # any shared frontend templates as needed
├── languages/
│   └── satori-studio.pot
├── src/
│   ├── Core/
│   │   ├── Plugin.php             # main bootstrap class
│   │   ├── Autoloader.php
│   │   ├── Admin.php
│   │   ├── Frontend.php
│   │   ├── Assets.php
│   │   └── I18n.php
│   ├── Builder/
│   │   ├── Editor.php             # editor iframe logic
│   │   ├── Layout.php             # layout storage and manipulation
│   │   ├── Renderer.php           # front-end renderer
│   │   └── Modules.php            # module registration & discovery
│   ├── Api/
│   │   └── Rest.php               # REST endpoints (optional)
│   └── Support/
│       └── Helpers.php
└── satori-studio.php              # main plugin file
```

---

## 4. `satori-studio-pro` (Commercial Add-on)

Contains:

- Advanced modules (sliders, hotspots, mega menus, advanced heroes, etc.).
- Pro-only global features (animations panel, extra global styles, custom breakpoints).
- Licensing integration.

```text
satori-studio-pro/
├── .github/
├── .gitignore
├── .phpcs.xml.dist
├── composer.json
├── CHANGELOG.md
├── LICENSE
├── README.md
├── docs/
│   └── PRO-FEATURES.md
├── assets/
│   └── scss/
│       └── modules/
│           ├── advanced-slider.scss
│           ├── hotspots.scss
│           └── mega-menu.scss
├── modules/
│   ├── advanced-slider/
│   ├── hotspots/
│   ├── mega-menu/
│   └── (other Pro modules)
├── src/
│   ├── Plugin.php                 # bootstrap + dependency checks
│   ├── Licensing/
│   │   ├── Client.php
│   │   └── Validator.php
│   ├── Features/
│   │   ├── GlobalStyles.php       # Pro-only extensions
│   │   └── Animations.php
│   └── Integration/
│       └── Studio.php             # hooks into SATORI Studio
└── satori-studio-pro.php
```

---

## 5. Suite Add-On Repositories

Each Suite addon follows the same overall pattern: it owns its data model (CPTs/meta/entities) and its Studio modules.

### 5.1 `satori-studio-suite-events`

```text
satori-studio-suite-events/
├── .github/
├── .gitignore
├── .phpcs.xml.dist
├── composer.json
├── CHANGELOG.md
├── LICENSE
├── README.md
├── docs/
│   └── EVENTS-SPEC.md
├── assets/
│   └── scss/
│       ├── events-admin.scss
│       └── events-frontend.scss
├── templates/
│   ├── single-event.php
│   └── archive-event.php
├── modules/
│   ├── events-grid/
│   ├── events-list/
│   ├── event-card/
│   ├── event-countdown/
│   └── event-submission-form/
├── src/
│   ├── Plugin.php
│   ├── PostTypes/
│   │   └── Event.php
│   ├── Taxonomies/
│   │   └── EventCategory.php
│   ├── Admin/
│   │   └── Settings.php
│   ├── Frontend/
│   │   ├── Query.php             # query helpers for modules/templates
│   │   └── TemplateLoader.php
│   └── Integration/
│       └── Studio.php            # registers modules with SATORI Studio
└── satori-studio-suite-events.php
```

### 5.2 `satori-studio-suite-forms`

```text
satori-studio-suite-forms/
├── .github/
├── .gitignore
├── .phpcs.xml.dist
├── composer.json
├── CHANGELOG.md
├── LICENSE
├── README.md
├── docs/
│   └── FORMS-SPEC.md
├── assets/
│   └── scss/
│       ├── forms-admin.scss
│       └── forms-frontend.scss
├── templates/
│   └── form-layouts/
├── modules/
│   ├── form/
│   ├── multi-step-form/
│   ├── inline-form/
│   └── popup-form/
├── src/
│   ├── Plugin.php
│   ├── Forms/
│   │   ├── Manager.php           # CRUD for form definitions
│   │   └── Renderer.php
│   ├── Admin/
│   │   └── Settings.php
│   └── Integration/
│       └── Studio.php
└── satori-studio-suite-forms.php
```

### 5.3 Other Suite Add-Ons

`crm`, `audit`, and `tools` follow the same pattern:

- `src/` with domain-specific folders (e.g., `Crm/`, `Audit/`, `Tools/`).
- `modules/` for Studio-rendered components.
- `templates/` if they provide theme-level fallbacks.
- `Integration/Studio.php` to hook into SATORI Studio.

---

## 6. `satori-studio-theme` (Theme Repository)

A theme optimised for SATORI Studio.

```text
satori-studio-theme/
├── .github/
├── .gitignore
├── CHANGELOG.md
├── LICENSE
├── README.md
├── docs/
│   └── THEME-GUIDE.md
├── assets/
│   ├── css/
│   └── scss/
│       ├── _tokens.scss          # shares design tokens with Studio
│       ├── _mixins.scss
│       └── theme.scss
├── inc/
│   ├── Setup.php                 # theme supports, image sizes, etc.
│   ├── Assets.php
│   └── Studio.php                # hooks to enhance SATORI Studio integration
├── template-parts/
│   ├── header/
│   └── footer/
├── block-templates/              # if using block theme approach
├── functions.php
├── style.css
└── index.php
```

---

## 7. Notes on Best Practices

- Each repo is **independently versioned** using SemVer.
- `satori-studio` is the only required dependency; all others are optional.
- `satori-studio-pro` and Suite addons check for `satori-studio` before booting.
- All repos share:
  - PHPCS rules
  - SATORI Studio Standards
  - Similar CI workflows

This scaffold is intended as an internal engineering reference and can be updated as the ecosystem grows.
