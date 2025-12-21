# SATORI Studio — Codex Guardrail: Underscore Template Safety
Version: 1.0.0  
Last Updated: 2025-12-21  
Maintainer: Satori Graphics Pty Ltd  

---

## Purpose

Prevent build-breaking regressions when modifying WordPress/Beaver-style **Underscore.js templates** inside PHP files (e.g. `includes/ui-js-templates.php`).  
These templates compile at runtime via `wp.template()`; a single syntax error can break the Builder UI (panels “disappear” because rendering crashes).

This guardrail is **Phase A / Phase 1 safe**, reversible, and protects core.

---

## Applies To

Any file containing Underscore templates, typically:

- `includes/ui-js-templates.php` (primary)
- Any file with `<script type="text/html">` or `<script type="text/template">` blocks using:
  - `<# ... #>` (WP-style)
  - `<% ... %>` (Underscore-style)

---

## Non‑negotiable Rules

### 1) Never orphan template control blocks
If you remove an opening conditional/loop, you **must** remove its matching close.

**Bad (orphan close):**
```html
<# } #>
</script>
```

**Good:**
```html
</script>
```

### 2) Prefer “empty body” over deleting structure
If you need to remove upsell UI or similar content **inside** a conditional, keep the conditional structure intact and replace the body with a no-op comment.

**Good:**
```html
<# if ( condition ) { #>
  <# /* Lite: upsell removed */ #>
<# } #>
```

### 3) Do not partially delete mixed PHP + template logic
If a template block includes **PHP conditionals** wrapping **Underscore conditionals**, do not remove only one side.
Either keep both intact, or remove both cleanly.

### 4) Preserve panel shells and required templates
When working in builder UI templates, do not remove top-level containers/templates required for rendering panels and navigation.  
Only remove narrowly-scoped fragments (e.g., an upsell banner block), and keep the surrounding structural templates.

---

## Required Verification (before merge)

### A) Builder smoke test (mandatory for builder/template changes)
- Open the Builder locally.
- Ensure panels render.
- Open DevTools Console.
- Confirm **no red errors**, especially no Underscore template compile errors like:
  - `SyntaxError: missing } in compound statement`
  - `template not found`
  - `Cannot read properties of undefined`

### B) Static template sanity check (recommended)
Before pushing/merging, run a simple static check to catch mismatched template delimiters.

**Minimum manual check:**
- Search for `<# } #>` and confirm each has a matching `<# if` / `<# for` / etc.
- Search for `<%` and confirm `%>` counts match.

Optional: add/maintain a small repo script to scan template blocks for delimiter balance.

---

## Out of Scope

This guardrail does **not** introduce new UI patterns, Pro flows, licensing, or redesigns.  
It exists solely to prevent regressions while executing Phase A cleanup work.

---

## Change Log

- 1.0.0 — Initial guardrail added after Phase A builder upsell removal surfaced an Underscore template syntax regression.
