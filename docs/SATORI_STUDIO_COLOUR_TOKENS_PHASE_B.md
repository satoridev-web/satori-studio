# SATORI Studio — Colour Tokens

**Version:** 1.0  
**Scope:** Phase B — Branding Assets Only  
**Status:** Locked / Developer Reference

---

## 1. Purpose

> **Canonical** means the single authoritative source of truth that defines correctness; all other representations must conform to it.



This document defines the **canonical colour tokens** for SATORI Studio and Suite product icons.

It exists as a **developer-facing reference** that maps the approved brand colours to stable, predictable identifiers.

### Important Scope Notes
- These tokens are **documentation-only** in Phase B
- They do **not** imply a global design system
- They must **not** be reused for UI components, panels, or controls
- Runtime behaviour is unchanged

---

## 2. Token Naming Conventions

- Tokens use dot-notation for clarity
- Naming reflects **product + role**, not visual intent
- Only icon-related roles are defined
n
Format:
```
{product}.{tier}.{role}
```

Where:
- `product` = studio | suite
- `tier` = base | pro | events | forms | crm | audit | tools
- `role` = fill | border | text

---

## 3. Studio Tokens

### SATORI Studio — Base (SL)

| Token | Swatch | Hex | Description | Usage |
|------|:--:|------|------------|------|
| `studio.base.fill` | ⬛ | `#7A7A7A` | Studio base icon background | Icon fill only |
| `studio.base.border` | ⬛ | `#656565` | Studio base icon border | Icon border only |
| `studio.base.text` | ⬜ | `#FFFFFF` | Icon letter colour | Icon text only |

---

### SATORI Studio — Pro (SP)

| Token | Swatch | Hex | Description | Usage |
|------|:--:|------|------------|------|
| `studio.pro.fill` | ⬛ | `#5F5F5F` | Studio Pro icon background | Icon fill only |
| `studio.pro.border` | ⬛ | `#4A4A4A` | Studio Pro icon border | Icon border only |
| `studio.pro.text` | ⬜ | `#FFFFFF` | Icon letter colour | Icon text only |

---

## 4. Suite Add-On Tokens

### SATORI Events

| Token | Swatch | Hex | Description | Usage |
|------|:--:|------|------------|------|
| `suite.events.fill` | 🟧 | `#C47A2C` | Events icon background | Icon fill only |
| `suite.events.border` | 🟧 | `#A96524` | Events icon border | Icon border only |
| `suite.events.text` | ⬜ | `#FFFFFF` | Icon letter colour | Icon text only |

---

### SATORI Forms

| Token | Swatch | Hex | Description | Usage |
|------|:--:|------|------------|------|
| `suite.forms.fill` | 🟩 | `#4F8F6A` | Forms icon background | Icon fill only |
| `suite.forms.border` | 🟩 | `#3F7457` | Forms icon border | Icon border only |
| `suite.forms.text` | ⬜ | `#FFFFFF` | Icon letter colour | Icon text only |

---

### SATORI CRM

| Token | Swatch | Hex | Description | Usage |
|------|:--:|------|------------|------|
| `suite.crm.fill` | 🟦 | `#4B5D73` | CRM icon background | Icon fill only |
| `suite.crm.border` | 🟦 | `#3E4D60` | CRM icon border | Icon border only |
| `suite.crm.text` | ⬜ | `#FFFFFF` | Icon letter colour | Icon text only |

---

### SATORI Audit

| Token | Swatch | Hex | Description | Usage |
|------|:--:|------|------------|------|
| `suite.audit.fill` | 🟥 | `#9C4A3A` | Audit icon background | Icon fill only |
| `suite.audit.border` | 🟥 | `#823C2F` | Audit icon border | Icon border only |
| `suite.audit.text` | ⬜ | `#FFFFFF` | Icon letter colour | Icon text only |

---

### SATORI Tools

| Token | Swatch | Hex | Description | Usage |
|------|:--:|------|------------|------|
| `suite.tools.fill` | 🟦 | `#3F7F7A` | Tools icon background | Icon fill only |
| `suite.tools.border` | 🟦 | `#336864` | Tools icon border | Icon border only |
| `suite.tools.text` | ⬜ | `#FFFFFF` | Icon letter colour | Icon text only |

---

## 5. Prohibitions & Guardrails

The following are explicitly forbidden:

- Creating new colour tokens in Phase B
- Reusing these colours for UI components
- Introducing aliases or alternate names
- Applying opacity or gradients to token values

Any expansion of this token set must occur in a later phase with explicit review.

---

## 6. Status

This token table is **final and locked** for Phase B.

It may be referenced by:
- SVG assets
- Documentation
- PR review notes

It must not be enforced programmatically until a future design-system phase.

---

**End of Document**

