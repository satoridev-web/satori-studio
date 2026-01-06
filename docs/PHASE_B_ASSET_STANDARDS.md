# SATORI Studio — Phase B Asset Standards

Version: 1.0  
Status: Active (Phase B)  
Applies to: SATORI Studio (Core, Pro, Suite Add-ons)  
Phase: B — Branding & Visual Identity

---

## 1. Purpose

This document defines the **authoritative asset sizing, format, and usage standards** for **Phase B (Branding & Visual Identity)** of SATORI Studio.

It exists to:
- Provide a stable reference for all branding-related asset work
- Prevent inconsistent or unsafe asset swaps
- Ensure Phase B changes remain **purely visual and non-behavioural**
- Act as a long-lived reference for future audits or refreshes

This document is **non-executable** and introduces **no implementation decisions**.

---

## 2. Phase B Constraints (Non-Negotiable)

Phase B is strictly visual.

The following are **not permitted**:
- Behaviour changes (PHP, JS, runtime logic)
- Underscore.js template logic changes
- Layout changes or spacing adjustments
- Introduction of design tokens or new colour systems
- White-label or user-configurable branding

All asset swaps must:
- Preserve file paths where referenced
- Be reversible
- Avoid layout impact

---

## 3. Primary Brand Assets

### 3.1 Plugin Icon (WordPress Plugin List)

| Attribute | Standard |
|---------|----------|
| Primary format | SVG |
| Fallback | PNG |
| Canvas size | 256 × 256 px |
| Aspect ratio | 1:1 |
| Background | Transparent |
| Safe padding | ≥24 px |
| Minimum clarity | Must render cleanly at 48 px |

Notes:
- Avoid thin strokes or small internal details
- No shadows, filters, or effects
- WordPress will auto-generate smaller sizes

---

### 3.2 Admin Menu Icon

| Attribute | Standard |
|---------|----------|
| Format | SVG |
| ViewBox | `0 0 20 20` or `0 0 24 24` |
| Rendered size | ~16 px |
| Stroke weight | ≥1.5 px at 24 px |
| Colour | `currentColor` only |
| Background | None |

Rules:
- Must work in light and dark admin themes
- No gradients, opacity tricks, or embedded styles

---

## 4. Builder Interface Assets

### 4.1 Builder Header Logo (Primary)

| Attribute | Standard |
|---------|----------|
| Format | SVG |
| Max height | 24 px |
| Max width | 160 px |
| Alignment | Left-aligned |
| Background | Transparent |

Rules:
- Must fit existing header container
- No layout or spacing changes allowed
- Horizontal lockup preferred

---

### 4.2 Builder Header Icon (Compact / Fallback)

| Attribute | Standard |
|---------|----------|
| Format | SVG |
| Size | 20 × 20 px |
| Usage | Collapsed headers, compact UI |
| Style | Icon-only mark |

---

## 5. Module & Feature Icons

### 5.1 Module Icon Standard

| Attribute | Standard |
|---------|----------|
| Format | SVG |
| Canvas | 24 × 24 px |
| ViewBox | `0 0 24 24` |
| Style | Outline / mono |
| Background | None |

Rules:
- No baked-in brand colours
- Stroke and visual weight must be consistent across all icons
- Must align visually with existing icon system

---

### 5.2 Inline / Embedded SVGs

Constraints:
- Colours must be CSS-controlled
- No animation
- No external references
- IDs must not collide

---

## 6. Images & Illustrations

### 6.1 UI Images (Product UI)

| Attribute | Standard |
|---------|----------|
| Preferred format | SVG |
| Raster fallback | PNG |
| Resolution | 1× and 2× where applicable |
| Transparency | Preferred |
| Text in image | Avoid |

Use cases:
- Empty states
- Informational headers
- Non-interactive visuals

---

### 6.2 Documentation Images

| Attribute | Standard |
|---------|----------|
| Branding | Must reflect SATORI Studio |
| Resolution | ≥144 dpi |
| Naming | kebab-case |
| Location | `/docs/assets/` (or equivalent) |

---

## 7. Colour Usage Rules (Phase B Only)

| Rule | Allowed |
|----|---------|
| New colour tokens | ❌ No |
| New colour roles | ❌ No |
| Existing variables | ✅ Yes |
| New hard-coded colours | ❌ No |

Phase B may only **consume existing colour hooks** already present in the system.

---

## 8. Expected Asset Inventory

Phase B assumes the existence (or creation) of the following assets:

- Primary horizontal logo
- Icon-only logo
- Plugin icon
- Admin menu icon
- Builder header logo
- Builder compact icon
- Module icon set (or mapping plan)
- Documentation visuals

---

## 9. Stability & Safety Rules

All branding assets must:
- Preserve existing file paths where referenced
- Introduce no JS, `<style>`, or external dependencies
- Avoid dimension changes that affect layout
- Remain visually legible across themes
- Be reversible without side effects

---

## 10. Definition of Done (Phase B-1)

Phase B-1 is complete when:
- Asset categories are fully enumerated
- Sizing and format standards are documented
- No implementation or swap decisions are made
- Subsequent Phase B work can reference this document safely

---

## 11. Related Phase B Documents

- Phase B Branding Touchpoint Audit
- Phase B Asset → File Path Mapping (next)
- Phase B Asset Swap PRs

---

End of Document