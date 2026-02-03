# SATORI Studio — Canonical SVG Specification (Phase B)

**Version:** 1.0  
**Status:** Active (Phase B)  
**Applies to:** SATORI Studio (SL / SP canonical marks)  
**Scope:** Documentation-only, non-executable

---

## 1. Purpose

This specification defines the **canonical SVG construction rules** for the SATORI Studio icon marks used in Phase B documentation and reference assets. It documents how the canonical assets are derived from the approved master SVG and the locked glyph geometry used for SL/SP variants.

---

## 2. Canonical Parameters (Locked)

| Parameter | Value |
|---|---|
| Canvas | 256 × 256 |
| ViewBox | `0 0 256 256` |
| Master source | `/docs/assets/studio-icons/satori-studio.master.svg` |
| Frame fill | `#77787B` |
| Panel fill | `#BEBEBE` |
| Glyph fill | `#FFFFFF` |
| Glyph construction | Paths-only, deterministic geometry (SL vs SP) |

---

## 3. Master-Derived Frame + Panel

The frame and panel geometry are copied from the approved master SVG and scaled to the 256 × 256 canvas with the scale baked into the path data. No additional transforms, stroke effects, or re-drawn geometry are introduced in the canonical assets.

---

## 4. Glyph Geometry (SL / SP)

---

The SL/SP letterforms are defined as **path-only shapes** derived from the Inter Semibold (600) letter proportions. Canonical construction uses rectangular segments (bars) so the resulting SVGs are deterministic and self-contained.
Letterforms are custom geometric paths and are not derived from any system or web font. While SATORI UI typography uses Roboto, Studio iconography is intentionally font-independent.

### 4.1 Base Letter Metrics (S)

| Metric | Value |
|---|---|
| Height | 140 |
| Width | 92 |
| Stroke thickness | 18 |

### 4.2 Scaled Letter Metrics (L/P)

| Metric | Formula | Value |
|---|---|---|
| Height | 140 × 0.85 | 119 |
| Width | 92 × 0.85 | 78.2 |
| Stroke thickness | 18 × 0.85 | 15.3 |

### 4.3 Letter Segment Definitions (Local Coordinates)

All coordinates below are relative to the letter’s local origin (top-left of its bounding box).

#### Letter **S**

Rectangular segments (W = 92, H = 140, T = 18):

- Top bar: `(0, 0, 92, 18)`
- Middle bar: `(0, 61, 92, 18)`
- Bottom bar: `(0, 122, 92, 18)`
- Upper-left vertical: `(0, 0, 18, 70)`
- Lower-right vertical: `(74, 70, 18, 70)`

Path data:

```
M 0 0 H 92 V 18 H 0 Z
M 0 61 H 92 V 79 H 0 Z
M 0 122 H 92 V 140 H 0 Z
M 0 0 H 18 V 70 H 0 Z
M 74 70 H 92 V 140 H 74 Z
```

#### Letter **L**

Rectangular segments (W = 78.2, H = 119, T = 15.3):

- Left vertical: `(0, 0, 15.3, 119)`
- Bottom bar: `(0, 103.7, 78.2, 15.3)`

Path data:

```
M 0 0 H 15.3 V 119 H 0 Z
M 0 103.7 H 78.2 V 119 H 0 Z
```

#### Letter **P**

Rectangular segments (W = 78.2, H = 119, T = 15.3):

- Left vertical: `(0, 0, 15.3, 119)`
- Top bar: `(0, 0, 78.2, 15.3)`
- Middle bar: `(0, 51.85, 78.2, 15.3)`
- Upper-right vertical: `(62.9, 0, 15.3, 59.5)`

Path data:

```
M 0 0 H 15.3 V 119 H 0 Z
M 0 0 H 78.2 V 15.3 H 0 Z
M 0 51.85 H 78.2 V 67.15 H 0 Z
M 62.9 0 H 78.2 V 59.5 H 62.9 Z
```

---

## 5. Letter Placement

Letters are horizontally centred within the inner fill (235.52 × 235.52) and aligned to a shared baseline.

| Value | Result |
|---|---|
| Inner left edge | 10.24 |
| Inner top edge | 10.24 |
| Word gap (between letters) | 12 |
| S origin | (36.9, 58.0) |
| L/P origin | (140.9, 79.0) |
| Baseline (bottom of S) | 198.0 |

Placement rules:

- **S** uses its native height (140) and anchors at `(36.9, 58.0)`.
- **L/P** is scaled to 85% and aligns to the same baseline by anchoring at `(140.9, 79.0)`.
- All letter shapes are filled with `#FFFFFF` and have no stroke.

---

## 6. Canonical Asset Paths

The canonical assets generated from this specification live in:

```
/docs/assets/studio-icons/satori-studio-lite.canonical.svg
/docs/assets/studio-icons/satori-studio-pro.canonical.svg
```

Additional reference context for the canonical assets is documented at:

```
/docs/SATORI_STUDIO_CANONICAL_SVG_ASSET_REFERENCE_PHASE_B.md
```

The specification itself is stored at:

```
/docs/SATORI_STUDIO_CANONICAL_SVG_SPEC_PHASE_B.md
```

---

## 7. Validation Checklist

- Canvas is 256 × 256 with `viewBox="0 0 256 256"`.
- Frame and panel paths are copied directly from the master SVG.
- Frame uses `#77787B` and panel uses `#BEBEBE`.
- Frame and panel paths do not use transforms (scale is baked into the path data).
- Letter shapes are path-only and filled with `#FFFFFF`.
- SL and SP assets use the canonical glyph paths and coordinates defined above.

---

**End of Document**
