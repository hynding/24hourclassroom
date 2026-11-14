# Week 07 · Congruent Parts and Congruent Triangles

**Lessons:** 2.1 Congruent Parts, Part 1 · 2.2 Congruent Parts, Part 2 · 2.3 Congruent Triangles, Part 1 · 2.4 Congruent Triangles, Part 2
**Practices:** MP3 (construct arguments), MP6 (precision), MP7 (structure)
**Built from:** IM Geometry, Unit 2, Lessons 1–4, in our own words
**Spiral:** congruence was defined in week 5 as "a sequence of rigid transformations carries one figure onto the other"; the point-by-point method (translate, rotate, reflect) is now turned into a written proof. The reflection definition (week 3) and the perpendicular bisector (week 1) supply the key step.

## What you need to be able to do

- Read and write congruence statements so that the order of the letters records the correspondence, and list every pair of corresponding parts.
- Explain why congruent figures have all corresponding parts congruent (because rigid transformations preserve distance and angle).
- Explain why the converse fails for quadrilaterals: four congruent sides, or even four sides and some angles, do not force congruence.
- Prove two triangles congruent by describing a sequence of rigid transformations and justifying each step, especially the final reflection.
- Use the fact that a point equidistant from two points lies on their perpendicular bisector to justify the final reflection.

## Key terms

| Term | Meaning |
|---|---|
| Congruence statement | △ABC ≅ △DEF, read with the letters in corresponding order: A ↔ D, B ↔ E, C ↔ F. |
| Corresponding parts | Sides and angles matched by the correspondence: AB ↔ DE, ∠A ↔ ∠D, etc. |
| CPCTC | "Corresponding parts of congruent triangles are congruent": once a congruence is proved, every pair of corresponding sides and angles is congruent. |
| Included angle | The angle between two named sides; ∠B is included between AB and BC. |
| Included side | The side between two named angles; BC is included between ∠B and ∠C. |
| Rigid-motion proof | A proof of congruence that names the transformations and justifies that each vertex lands where claimed. |
| Equidistant → perpendicular bisector | If XA = XB then X is on the perpendicular bisector of AB. Used to show a line is a mirror. |

## 1. Reading a congruence statement

△PQR ≅ △XYZ says more than "the triangles are the same". It says a specific rigid motion sends P to X, Q to Y and R to Z. So:

| Corresponding vertices | Corresponding sides | Corresponding angles |
|---|---|---|
| P ↔ X | PQ ↔ XY | ∠P ↔ ∠X |
| Q ↔ Y | QR ↔ YZ | ∠Q ↔ ∠Y |
| R ↔ Z | RP ↔ ZX | ∠R ↔ ∠Z |

Because a rigid motion preserves length and angle, every pair in the table is congruent. This is the one-line theorem of lesson 2.1: **if two figures are congruent, all pairs of corresponding parts are congruent.**

**Worked example 1.** Quadrilateral ABCD ≅ quadrilateral WXYZ, with AB = 5, BC = 7, ∠C = 110°, DA = 4. Then WX = 5, XY = 7, ∠Y = 110° and ZW = 4. Nothing is known about CD or ∠A unless it is known about YZ or ∠W.

**Worked example 2 — the same two triangles, different statements.** Triangle with vertices A, B, C is isosceles with AB = AC. The reflection across the line of symmetry carries the triangle onto itself with A → A, B → C, C → B. So △ABC ≅ △ACB is a true congruence statement (of the triangle with itself), and it says ∠B ≅ ∠C. But △ABC ≅ △BCA is false unless the triangle is equilateral, because it would claim AB = BC.

**Try it 1.1** △KLM ≅ △RST with KL = 9, ∠L = 50°, ST = 6. State RS, ∠S and LM. *(Answer: RS = 9, ∠S = 50°, LM = 6.)*

**Try it 1.2** Explain why "△ABC ≅ △DEF" and "△BCA ≅ △EFD" say the same thing. *(Answer: both match A–D, B–E, C–F.)*

## 2. When congruent parts are not enough

The converse of lesson 2.1 asks: if all corresponding parts are congruent, are the figures congruent? For triangles, yes (that is the work of the rest of this unit). For quadrilaterals, **no**, and even partial information fails badly.

- **Four congruent sides.** A square of side 5 and a rhombus of side 5 with a 60° angle have four pairs of congruent sides and are not congruent: rigid motions preserve angles, and 90° ≠ 60°.
- **Three sides and two angles of a quadrilateral** can still leave the figure free to flex.
- **A hinge model**: four rods joined at their ends can be pushed from a rectangle into a slanted parallelogram without changing any side length. Three rods joined into a triangle cannot flex at all. That rigidity of triangles is why they, and not quadrilaterals, have short congruence criteria.

```
Figure description: two quadrilaterals with the same four side lengths 5, 5, 5, 5.
Left: a square (all angles 90°). Right: a rhombus leaning over (angles 60° and 120°).
Same sides, different shapes, not congruent.

   +-----+        /-----/
   |     |       /     /
   |     |      /     /
   +-----+     /-----/
```

**Worked example 3.** Quadrilaterals ABCD and EFGH have AB = EF, BC = FG, CD = GH, DA = HE and ∠A = ∠E. Are they congruent? Not necessarily. Fix ∠A; triangle ABD is then determined (two sides and the included angle), and BD is fixed. But C can be on either side of BD at the required distances from B and D, giving two different quadrilaterals, one convex and one "dented". Four sides and one angle are not enough without more information.

**Try it 2.1** Give two non-congruent quadrilaterals whose corresponding sides are 3, 4, 3, 4. *(Answer: a 3-by-4 rectangle and a parallelogram with sides 3 and 4 and a 70° angle.)*

## 3. Proving triangles congruent with rigid motions

For triangles, the picture is different. The goal of lessons 2.3 and 2.4 is to show that if △ABC and △DEF have **all three pairs of sides congruent and all three pairs of angles congruent**, then a sequence of rigid motions carries one onto the other. The argument is the point-by-point method from week 5, written as a proof with a reason for every step.

**Theorem.** If AB = DE, BC = EF, CA = FD, ∠A = ∠D, ∠B = ∠E and ∠C = ∠F, then △ABC ≅ △DEF.

**Proof.**

1. Translate by the directed segment from A to D. Now A′ = D. (Any translation is a rigid motion.)
2. Rotate about D by the angle from ray DB′ to ray DE. Now B″ is on ray DE, and DB″ = AB (rigid motions preserve length) = DE (given). The only point on ray DE at distance DE from D is E, so B″ = E.
3. Now consider C″. If C″ is on the same side of line DE as F: ∠EDC″ = ∠A (preserved) = ∠D (given), so ray DC″ is the ray DF (two rays from D on the same side of DE making the same angle with DE coincide). Also DC″ = AC = DF, so C″ is the point on ray DF at distance DF from D, namely F. Done in two moves.
4. If C″ is on the opposite side of line DE from F: reflect across line DE. D and E are on the mirror and stay fixed. The reflection sends C″ to the point on the other side making the same angle with DE at D and at the same distance, which by the argument in step 3 is F. Done in three moves.

Either way a sequence of rigid motions sends A → D, B → E, C → F, so △ABC ≅ △DEF. ∎

Notice that the proof did not use all six congruences. It used AB = DE (step 2), ∠A = ∠D and AC = DF (step 3). That observation is next week's SAS theorem.

**Worked example 4 — a different final step.** Instead of angles, suppose you know only DC″ = DF and EC″ = EF (because AC = DF and BC = EF). Then D is equidistant from C″ and F, so D lies on the perpendicular bisector of C″F; and E is equidistant from C″ and F, so E lies on it too. Two points determine a line, so line DE **is** the perpendicular bisector of C″F, and by the definition of reflection, reflecting across DE sends C″ to F. This is the justification you will use in the SSS proof.

**Worked example 5 — writing the proof for specific coordinates.** △ABC: A = (0, 0), B = (4, 0), C = (1, 3). △DEF: D = (2, 2), E = (2, 6), F = (−1, 3). Check sides: AB = 4, DE = 4 ✓; AC = √10, DF = √(9 + 1) = √10 ✓; BC = √(9 + 9) = √18, EF = √(9 + 9) = √18 ✓. Proof: translate by (2, 2): A → D, B → (6, 2), C → (3, 5). Rotate 90° counter-clockwise about D: (6, 2) − D = (4, 0) → (0, 4) → (2, 6) = E ✓; (3, 5) − D = (1, 3) → (−3, 1) → (−1, 3) = F ✓. Two moves; no reflection needed. Therefore △ABC ≅ △DEF.

**Try it 3.1** In the proof above, which given fact guarantees that B″ lands on E and not just somewhere on ray DE? *(Answer: AB = DE, together with the fact that rigid motions preserve length.)*

**Try it 3.2** Why are D and E unaffected by the reflection in step 4? *(Answer: they lie on the mirror line DE, and points on the line of reflection are fixed.)*

## 4. Writing it up

A rigid-motion congruence proof has a fixed skeleton. Learn it as a template:

1. **Translate** so that one vertex lands on its partner. *Reason: translations are rigid motions.*
2. **Rotate** about that vertex so that a second vertex lands on the ray toward its partner, and conclude it lands exactly on the partner. *Reason: the congruent side, plus "the only point on a ray at a given distance".*
3. **Reflect** across the line through the two matched vertices if the third vertex is on the wrong side. *Reason: either the equal angles (ray coincidence) or the equidistant points (perpendicular bisector) show the reflection sends the third vertex to its partner.*
4. **Conclude** with a congruence statement whose letters follow the correspondence.

**Worked example 6 — spotting the gap in a proof.** A student writes: "Translate A to D, rotate so B is on E, and C is now on F because the triangles are congruent." The last clause assumes what is to be proved. The correct reason is one of the two in step 3: equal angles at D, or D and E equidistant from the two candidate positions.

## Common mistakes

- **Letters out of order** in a congruence statement; every claim about corresponding parts then comes out wrong.
- **Concluding congruence of quadrilaterals from side lengths alone.** Only triangles are rigid.
- **Skipping the reason that B lands exactly on E.** "On the ray" is not "on the point"; you need the congruent side.
- **Forgetting that the reflection fixes the two matched vertices.** Say explicitly that they are on the mirror.
- **Using "the triangles are congruent" as a reason inside the proof of their congruence.**

## Where this goes next

Week 8 proves that less information suffices: two sides and the included angle (SAS) or two angles and the included side (ASA) already force congruence, and proves the Perpendicular Bisector Theorem both ways. Week 9 adds SSS and the SSA caveat, then uses the criteria to prove facts about quadrilaterals. Everything in Unit 2 is the proof skeleton of this week with fewer givens.

## Self-check

1. △ABC ≅ △FDE. Which angle corresponds to ∠B, and which side to CA?
2. Give an example showing that two quadrilaterals with all four pairs of corresponding sides congruent need not be congruent, and name the property of rigid motions that proves they are not.
3. In the rigid-motion proof, after translating A to D and rotating so B lands on E, state two different ways to justify that a reflection across DE sends the image of C to F.
4. Two triangles have AB = DE = 6, BC = EF = 8, CA = FD = 10. After the translation and rotation, the image of C is at the two possible distances from D and E. Explain why line DE is the perpendicular bisector of the segment joining the image of C to F.
5. Write the four-step skeleton of a rigid-motion congruence proof from memory.

*Answers: (1) ∠D; CA ↔ EF. (2) a square and a non-square rhombus of the same side; rigid motions preserve angle measure. (3) equal angles at D put the image on ray DF at distance DF; or D and E are each equidistant from the image and F, so DE is the perpendicular bisector. (4) D is equidistant from both candidate points (both at distance 10), E likewise (distance 8); two points equidistant from the ends of a segment lie on its perpendicular bisector, and two points determine the line. (5) translate, rotate, reflect if needed, conclude with a correctly ordered statement.*

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Geometry, Unit 2, Lessons 1–4, https://im.kendallhunt.com/HS/teachers/2/2/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
