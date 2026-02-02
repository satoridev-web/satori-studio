# SATORI Studio — Brand Guidelines

**Version:** 1.0  
**Phase:** B — Visual Identity & Branding Assets  
**Status:** Finalised (Locked)

---

## 1. Purpose

This document defines the **final, authoritative brand system** for **SATORI Studio** and its accompanying Suite add-ons.

It exists to:
- Ensure visual consistency across products
- Provide a clear point of differentiation from other ecosystems
- Prevent ad-hoc or subjective branding decisions
- Enable safe, reversible Phase B implementation

This document is **non-functional**. It introduces **no behavioural or runtime changes**.

---

## 2. Branding Philosophy

SATORI branding is:
- **System-first**, not expressive
- **Calm**, not promotional
- **Architectural**, not illustrative
- **Scalable**, not bespoke

Visual identity must never distract from function. Branding should feel *inevitable*, not decorative.

---

## 3. Product Naming & Mark System

All SATORI products use a **two-character typographic mark** inside a square icon.

### Studio Tiers

| Product | Mark | Notes |
|------|----|------|
| SATORI Studio | **SL** | Base editor (Studio Lite) |
| SATORI Studio Pro | **SP** | Capability tier of Studio |

Only these two Studio marks may ever exist.

### Suite Add‑Ons

| Product | Mark |
|------|----|
| SATORI Events | EV |
| SATORI Forms | FO |
| SATORI CRM | CR |
| SATORI Audit | AU |
| SATORI Tools | TL |

---

## 4. Icon Geometry

### Shape

All product icons use a square with **asymmetric corner geometry**:

- **Top-left:** rounded
- **Bottom-right:** rounded
- **Top-right:** square
- **Bottom-left:** square

This asymmetry is a defining SATORI signature and must be applied consistently.

### Corner Radius

- **Radius = 22% of icon edge length**
- Radius must be mathematically identical wherever applied

---

## 5. Border System

### Border Thickness

Borders are mandatory and proportional:

- **~3.5–4% of icon edge length**
- Approx. 2–2.5px at 64×64
- Border is rendered outside the fill
- Border follows the same corner geometry as the icon

### Border Behaviour

- Anchors the icon visually
- No shadows, highlights, or effects

---

## 6. Colour System

### Core Rules

- Flat colours only
- No gradients
- No opacity tricks
- No decorative effects

Colours identify **category**, not personality.

---

### Studio Colours

| Product | Swatch | Fill | Border |
|------|:--:|------|------|
| Studio (SL) | ⬛ | `#7A7A7A` | `#656565` |
| Studio Pro (SP) | ⬛ | `#5F5F5F` | `#4A4A4A` |

Studio Pro uses the same hue as Studio Base with reduced lightness.

---

### Suite Add‑On Colours

| Product | Swatch | Fill | Border |
|------|:--:|------|------|
| Events | 🟧 | `#C47A2C` | `#A96524` |
| Forms | 🟩 | `#4F8F6A` | `#3F7457` |
| CRM | 🟦 | `#4B5D73` | `#3E4D60` |
| Audit | 🟥 | `#9C4A3A` | `#823C2F` |
| Tools | 🟦 | `#3F7F7A` | `#336864` |

All Suite colours are muted and must not be altered.

---

### Letter Colour

- Always **white**
- Hex: `#FFFFFF`
- No shadows, outlines, or effects

---

## 7. Typography

### Primary Typeface

**Inter** (UI-optimised sans-serif)

### Icon Letter Rules

- Weight: Semibold (600)
- Case: Uppercase
- Second letter (Studio tiers only): scaled to **85–90%**
- No tracking adjustment
- Optical centring over geometric centring
- Final assets converted to outlines

---

## 8. Usage Constraints (Phase B)

### Allowed

- Plugin icons
- Admin menu icons
- Builder header logo
- Module icon SVG swaps
- Documentation assets

### Forbidden

- New UI components
- Behavioural changes
- Feature tier badges
- Decorative branding
- Design system propagation

---

## 9. Canonical Rules (Non‑Negotiable)

- No additional Studio tier marks may be introduced
- Geometry, colours, and typography must not be varied per product
- All icons must be visually interchangeable at equal sizes
- Admin menu icons may use optical-size SVG variants for ~20–24px rasterisation, but canonical SVGs remain the immutable source of truth and must not be altered for menu fixes.

---

## 10. Status

This document is **final** for Phase B.

Any changes require explicit review and must occur in a later phase.

---

**End of Document**
