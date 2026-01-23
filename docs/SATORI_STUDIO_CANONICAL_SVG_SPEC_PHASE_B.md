# SATORI Studio — Canonical SVG Specification (Phase B)

**Version:** 1.0  
**Status:** Active (Phase B)  
**Applies to:** SATORI Studio (SL / SP canonical marks)  
**Scope:** Documentation-only, non-executable

---

## 1. Purpose

This specification defines the **canonical SVG construction rules** for the SATORI Studio icon marks used in Phase B documentation and reference assets. It encodes the locked geometry, colours, and typography parameters required for deterministic asset generation.

---

## 2. Canonical Parameters (Locked)

| Parameter | Value |
|---|---|
| Canvas | 256 × 256 |
| ViewBox | `0 0 256 256` |
| Corner model | Asymmetric (top-left, bottom-right rounded) |
| Corner radius | 22% of edge length (56.32 px) |
| Border width | 4% of edge length (10.24 px) |
| Font | Inter, Semibold (600), paths-only |
| Letter scale | S = 100%, L/P = 85% |
| Background | `#7A7A7A` |
| Border | `#000000` |
| Text | `#FFFFFF` |

---

## 3. Derived Geometry Values

| Value | Formula | Result |
|---|---|---|
| Edge length | — | 256 |
| Corner radius | 256 × 0.22 | 56.32 |
| Border width | 256 × 0.04 | 10.24 |
| Inner edge length | 256 − (2 × 10.24) | 235.52 |
| Inner radius | 56.32 − 10.24 | 46.08 |

---

## 4. Canonical Shape Construction

### 4.1 Outer Border Path

The border uses the asymmetric corner model (top-left and bottom-right rounded). The outer border path is:

```
M 0 56.32
A 56.32 56.32 0 0 1 56.32 0
H 256
V 199.68
A 56.32 56.32 0 0 1 199.68 256
H 0
V 56.32
Z
```

Fill: `#000000`

### 4.2 Inner Fill Path

Inset the border width on all sides and reduce the corner radius accordingly. The inner fill path is:

```
M 10.24 56.32
A 46.08 46.08 0 0 1 56.32 10.24
H 245.76
V 199.68
A 46.08 46.08 0 0 1 199.68 245.76
H 10.24
V 56.32
Z
```

Fill: `#7A7A7A`

---

## 5. Canonical Letter Geometry

The SL/SP letterforms are defined as **path-only shapes** derived from the Inter Semibold (600) letter proportions. Canonical construction uses rectangular segments (bars) so the resulting SVGs are deterministic and self-contained.

### 5.1 Base Letter Metrics (S)

| Metric | Value |
|---|---|
| Height | 140 |
| Width | 92 |
| Stroke thickness | 18 |

### 5.2 Scaled Letter Metrics (L/P)

| Metric | Formula | Value |
|---|---|---|
| Height | 140 × 0.85 | 119 |
| Width | 92 × 0.85 | 78.2 |
| Stroke thickness | 18 × 0.85 | 15.3 |

### 5.3 Letter Segment Definitions (Local Coordinates)

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

## 6. Letter Placement

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

## 7. Canonical Asset Paths

The canonical assets generated from this specification live in:

```
/docs/assets/studio-icons/satori-studio-sl.canonical.svg
/docs/assets/studio-icons/satori-studio-sp.canonical.svg
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

## 8. Validation Checklist

- Canvas is 256 × 256 with `viewBox="0 0 256 256"`.
- Asymmetric corners are applied (top-left and bottom-right only).
- Border width is 10.24 px and uses `#000000`.
- Inner fill uses `#7A7A7A`.
- Letter shapes are path-only and filled with `#FFFFFF`.
- SL and SP assets use the canonical paths and coordinates defined above.

---

**End of Document**
