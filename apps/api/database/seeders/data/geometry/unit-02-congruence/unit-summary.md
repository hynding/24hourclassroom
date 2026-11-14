# Unit 2 Summary · Congruence

**Lessons covered:** 2.1–2.15 (weeks 7–10): congruent parts and congruent triangles (2.1–2.4), segments, angles, SAS, ASA and the Perpendicular Bisector Theorem (2.5–2.8), SSS, proof practice, SSA and quadrilaterals (2.9–2.12), parallelograms, bisectors and quadrilateral congruence (2.13–2.15).

This is the night-before sheet. Every theorem below was proved in class; on the exam you may cite any of them by name.

## The ideas that generate every question

1. **Congruent means "a rigid motion carries one onto the other."** Therefore all corresponding parts are congruent (CPCTC). The letters of a congruence statement record the correspondence.
2. **Triangles are rigid; quadrilaterals flex.** Three well-chosen measurements determine a triangle. Four sides do not determine a quadrilateral.
3. **Every congruence criterion is the same proof**: translate a vertex, rotate to match a second (the congruent side makes it land exactly), then show the third vertex lands, reflecting across the matched side if necessary. SAS and ASA use the equal angles; SSS uses the Perpendicular Bisector Theorem.
4. **The Perpendicular Bisector Theorem** (on the bisector ⇔ equidistant from the endpoints) and the **angle bisector theorem** (on the bisector ⇔ equidistant from the sides) are the "set of points" descriptions of the two bisectors.
5. **Quadrilateral theorems are two triangle proofs**: draw a diagonal, prove the two triangles congruent, use CPCTC, and (for parallels) the converse of the alternate interior angle theorem.

## The criteria

| Criterion | What must match | Proof idea |
|---|---|---|
| SAS | Two sides and the **included** angle | Equal angle fixes the ray; equal side fixes the point |
| ASA | Two angles and the **included** side | Two rays from the side's ends meet in one point |
| AAS | Two angles and a non-included side | Third angle by the angle sum, then ASA |
| SSS | Three sides | Third vertex is equidistant from both matched vertices; reflect across their line |
| HL | Right triangles: hypotenuse and a leg | The one SSA case that works |
| SSA | Two sides and a non-included angle | **Not a criterion**: two triangles possible when a sin θ < b < a |
| AAA | Three angles | **Not a criterion**: similar, not congruent |

Checklist before citing a criterion: name the triangles in corresponding order; write the three congruences with reasons; check "included"; cite; then CPCTC.

**Standard reasons:** given · definition of midpoint · definition of angle bisector · definition of perpendicular bisector · vertical angles · alternate interior angles (parallel lines) · corresponding angles · reflexive property · all right angles are congruent · radii of the same circle · Perpendicular Bisector Theorem (either direction) · isosceles triangle theorem (either direction) · opposite sides of a parallelogram · CPCTC.

## Theorems proved in this unit

- **Segment and Angle Congruence Theorems**: equal measure ⇒ congruent.
- **Perpendicular Bisector Theorem** and converse (SAS; the converse uses the isosceles base angles).
- **Isosceles triangle theorem** (AB = AC ⇒ ∠B = ∠C, by SAS self-congruence or SSS with the midpoint) and converse (ASA). The median, altitude, angle bisector from the apex and the perpendicular bisector of the base coincide.
- **Angle bisector theorem**: on the bisector ⇒ equidistant from the sides (AAS); converse (HL).
- **Kite**: the axis diagonal bisects its two angles and is the perpendicular bisector of the other diagonal (SSS, then the converse of the Perpendicular Bisector Theorem).
- **Rhombus**: diagonals are perpendicular bisectors of each other and bisect the angles (a kite twice). Side = √((d₁/2)² + (d₂/2)²); area = ½ d₁ d₂.
- **Parallelogram**: opposite sides congruent (ASA); opposite angles congruent; consecutive angles supplementary (co-interior); diagonals bisect each other (ASA).
- **Converses for parallelograms**: both pairs of opposite sides congruent (SSS); one pair parallel and congruent (SAS); diagonals bisect each other (SAS with vertical angles). **Not** a converse: one pair parallel and the *other* pair congruent (isosceles trapezoid).
- **Constructions justified**: perpendicular bisector (converse of the Perpendicular Bisector Theorem at both crossing points); angle bisector (SSS on the kite); equilateral triangle (radii).

## What determines a quadrilateral

| Data | Determined? |
|---|---|
| Four sides | No (square vs rhombus) |
| Four sides + one angle | No (fourth vertex flips across a diagonal) |
| Four sides + one diagonal (convex) | Yes (two SSS triangles) |
| Three sides + two included angles | Yes (a determined zigzag) |
| Parallelogram: two adjacent sides + included angle | Yes |
| Rectangle: two sides | Yes |
| Rhombus: side + angle, or two diagonals | Yes |

## Common errors

- Citing SAS with a non-included angle (that is SSA).
- Using CPCTC before the congruence is proved, or using the conclusion as a reason (circular).
- Forgetting the reflexive property for a shared side or angle.
- Writing the congruence statement with letters out of correspondence, then reading off the wrong parts.
- Using a parallelogram property on a figure not yet shown to be a parallelogram.
- Mixing up the two bisector theorems: perpendicular bisector ⇔ equidistant from two **points**; angle bisector ⇔ equidistant from two **lines**.
- Assuming a parallelogram's diagonals are congruent or perpendicular.
- Measuring "distance to a line" along a slant instead of a perpendicular.

## Worked examples

**1. A full proof with parallels.** Figure: AB ∥ DC, and E is the midpoint of BC; lines AE and DC meet at F (F on the extension of DC). Prove AE = FE.
∠BAE ≅ ∠CFE (alternate interior, AB ∥ DF, transversal AF); BE ≅ CE (midpoint); ∠AEB ≅ ∠FEC (vertical). △AEB ≅ △FEC by AAS. CPCTC: AE ≅ FE.

**2. SSA decision.** Sides 12 and 9 with a 48° angle opposite the 9. sin 48° ≈ 0.743, so 12 sin 48° ≈ 8.92 < 9 < 12: two triangles. With the 48° opposite the 12 instead: 12 ≥ 9, one triangle.

**3. Parallelogram algebra.** EFGH is a parallelogram with ∠E = (2x + 30)°, ∠F = (3x − 20)°. Consecutive angles: 5x + 10 = 180, x = 34; ∠E = ∠G = 98°, ∠F = ∠H = 82°.

**4. Kite angles.** Kite with axis-vertex angles 100° and 50°: the other two angles are each 180 − 50 − 25 = 105°. Check 100 + 105 + 50 + 105 = 360.

**5. Rhombus from diagonals.** Diagonals 18 and 24: half-diagonals 9 and 12, side 15, perimeter 60, area 216.

## What to review from earlier units

From Unit 1: the definitions of reflection, translation and rotation (they are the moves in every criterion proof); the fact that points on a mirror are fixed; vertical angles; alternate interior and co-interior angles of parallel lines and the converse; the triangle angle sum (for AAS and for finding the third angle); the perpendicular bisector construction. From middle school: the Pythagorean theorem for kite and rhombus computations.

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Geometry, Unit 2, Lessons 1–15, https://im.kendallhunt.com/HS/teachers/2/2/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
