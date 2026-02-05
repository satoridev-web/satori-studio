# CODEX PLAN — Phase B1.5
## SATORI Studio SVG Canonical → Runtime Derivation

---

## PURPOSE

This Codex plan formalises and documents the SVG asset pipeline used by
SATORI Studio.

It explicitly defines the relationship between:

- Master SVG assets
- Canonical SVG variants (Lite / Pro)
- Runtime plugin SVG assets

This phase is **documentation-only**.

NO SVG geometry, colour, scale, or rendering behaviour is changed in this phase.

---

## BACKGROUND

Historically, SATORI Studio SVG icons were:

- authored in Illustrator
- exported and cleaned
- copied into the plugin runtime location

While this workflow existed in practice, it was **never formally documented**.
As a result:

- canonical SVGs and runtime SVGs diverged
- fixes to canonical assets did not propagate
- LocalWP and WordPress continued to display legacy icons

Phase B1.5 resolves this by documenting the SVG derivation pipeline explicitly.

---

## ASSET ROLES (AUTHORITATIVE)

### 1. MASTER SVG

**Role:** Single source of truth for Studio icon geometry

**File:**
```

docs/assets/studio-icons/satori-studio.master.svg

```

Characteristics:
- Illustrator-authored
- SVG hygiene cleaned
- Correct geometry, border, background, and glyphs
- Never modified by automation
- All other SVGs derive from this file

---

### 2. CANONICAL SVGs

**Role:** Frozen, auditable references for product variants

**Files:**
```

docs/assets/studio-icons/
├─ satori-studio-lite.canonical.svg
└─ satori-studio-pro.canonical.svg

```

Characteristics:
- Derived from the master SVG
- No runtime responsibility
- Used for:
  - documentation
  - visual comparison
  - regression checking
  - audits

Canonical SVGs do NOT automatically affect the plugin UI.

---

### 3. RUNTIME PLUGIN SVG

**Role:** SVG actually loaded by WordPress and the admin menu

**File:**
```

assets/branding/satori-icon.svg

```

Characteristics:
- Must be derived from the master SVG
- May be optimised or minified
- Is the ONLY SVG used by the plugin at runtime

---

## DERIVATION RULE (LOCKED)

```

satori-studio.master.svg
↓
canonical SVGs (Lite / Pro)
↓
runtime plugin SVG (satori-icon.svg)

```

Important rule:

> Updating canonical SVGs alone does NOT update the runtime plugin icon.
> Runtime assets must be deliberately regenerated and committed.

---

## SCOPE OF THIS CODEX RUN

IN SCOPE:
- Document the SVG derivation pipeline
- Clarify asset roles and responsibilities
- Prevent future ambiguity or drift

OUT OF SCOPE:
- SVG geometry changes
- Colour changes
- Scale changes
- Plugin runtime asset updates
- Any visual or rendering modifications

---

## FILES TO UPDATE (DOCUMENTATION ONLY)

- SVG / branding documentation
- Any references implying canonical SVGs are runtime assets

NO plugin files are modified in this phase.

---

## ACCEPTANCE CRITERIA

This plan is complete when:

- SVG asset roles are clearly documented
- Canonical vs runtime responsibilities are unambiguous
- Future Codex runs can regenerate runtime SVGs safely
- LocalWP behaviour matches documented expectations

---

## NEXT PHASE (NOT PART OF THIS PLAN)

Phase B1.6 — Runtime SVG Regeneration

- Derive `assets/branding/satori-icon.svg` from master SVG
- Replace legacy runtime icon
- Validate in LocalWP
- Isolated PR

---

## COMPLIANCE

This plan complies with:

- SATORI Automated Development Workflow v1.1
- SATORI Studio Standards
- Codex documentation-first methodology

---

## END OF CODEX PLAN — PHASE B1.5
