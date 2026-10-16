# Unit 3 Summary · Similarity

**Lessons covered:** 3.1–3.16 (weeks 11–14): scale drawings and dilations (3.1–3.4), side splitting and the definition of similarity (3.5–3.8), the similarity criteria and the side-splitter theorem (3.9–3.12), the Pythagorean theorem, unknown values and the bank shot (3.13–3.16).

This is the night-before sheet. Every theorem below was proved in class; on the exam you may cite any of them by name.

## The ideas that generate every question

1. **A dilation multiplies every length by k, preserves every angle, and sends every line to a parallel line (or itself).** Areas go by k². The centre is the only fixed point.
2. **Similar means "rigid motions plus a dilation carry one onto the other."** Congruent is the k = 1 case. Corresponding angles equal; corresponding lengths in ratio k; ratios within a figure unchanged.
3. **Every similarity criterion is "dilate, then cite a congruence criterion."** AA → ASA, SAS∼ → SAS, SSS∼ → SSS. SSA∼ does not exist; AAA adds nothing to AA.
4. **A parallel line inside a triangle makes a similar triangle.** DE ∥ BC gives AD/AB = AE/AC = DE/BC and AD/DB = AE/EC; the converse holds too. DE/BC is never AD/DB.
5. **The altitude to the hypotenuse makes three similar right triangles**, which give h² = pq, a² = qc, b² = pc, and adding the last two is the Pythagorean theorem.

## Scale drawings and dilations

| Fact | Detail |
|---|---|
| Scale 1 : n | real = drawing × n; area real = drawing area × n² |
| Dilation D(O, k) | P′ on ray OP with OP′ = k · OP |
| Coordinates, centre origin | multiply both coordinates by k |
| Coordinates, centre C | P′ = C + k(P − C) |
| Finding k | OP′/OP, or any image length over its original |
| Finding the centre | intersect lines PP′ and QQ′ |
| Line through O | maps to itself |
| Line not through O | maps to a parallel line |
| Angles | preserved |
| Not rigid | unless k = 1 |

## Similarity

- **Definition:** A ∼ B when a sequence of rigid motions and dilations carries A onto B.
- **Showing it:** name the dilation (centre, k), check the image's sides or angles against the target, cite SSS/SAS/ASA, conclude with a rigid motion.
- **Reading a statement:** △ABC ∼ △DEF pairs A ↔ D, B ↔ E, C ↔ F; write proportions from matching positions.
- **Scale factor from areas:** k = √(area ratio). Perimeters scale by k.
- **Always similar:** circles, squares, equilateral triangles, regular n-gons (same n), isosceles right triangles, 30-60-90 triangles. **Not:** rectangles, rhombuses, isosceles triangles, right triangles.

## The criteria

| Criterion | Needs | Proof |
|---|---|---|
| AA | two angle pairs | dilate so one side matches, then ASA |
| SAS∼ | two side ratios equal, included angles equal | dilate, then SAS |
| SSS∼ | three side ratios equal | dilate, then SSS |
| SSA∼ | — | not a criterion |

Sources of equal angles: shared vertex, vertical angles, parallel-line angles, right angles, complements of the same angle.

## Side splitting

- **Theorem:** D on AB, E on AC, DE ∥ BC ⇒ △ADE ∼ △ABC (AA: shared ∠A, corresponding angles), so AD/AB = AE/AC = DE/BC and AD/DB = AE/EC.
- **Converse:** AD/DB = AE/EC ⇒ DE ∥ BC (SAS∼ gives equal corresponding angles, then the parallel-lines converse).
- **Midsegment:** joins midpoints; parallel to the third side, half as long. Three midsegments cut a triangle into four congruent quarter-size copies.
- **Three parallels** cut any two transversals proportionally.

## Right triangles

- **Altitude to the hypotenuse** (pieces p, q; legs a next to q, b next to p; hypotenuse c): h² = pq, a² = qc, b² = pc, h = ab/c.
- **Pythagorean theorem:** a² + b² = c², proved by adding the leg relations (or by the four-triangles rearrangement in a square of side a + b).
- **Converse:** a² + b² = c² ⇒ right angle opposite c (build the right triangle; SSS). a² + b² < c²: obtuse. a² + b² > c²: acute.
- **45-45-90:** legs x, hypotenuse x√2. **30-60-90:** short leg x, long leg x√3, hypotenuse 2x.
- **Equilateral, side s:** height (s/2)√3, area (√3/4)s².
- **Unknown values:** angle sum, Pythagoras, special triangles, drop an altitude, scale a similar triangle.

## Indirect measurement and the bank shot

- **Shadows:** parallel rays ⇒ AA ⇒ height/shadow is constant.
- **Mirror:** incidence = reflection ⇒ AA ⇒ height/distance-to-mirror is constant.
- **River width:** right angles at both banks plus vertical angles at the sighting point.
- **Bank shot:** reflect the target across the cushion; the straight line to the image crosses the cushion at the bounce point; with heights a and b and horizontal gap d, the bounce is d · a/(a + b) from the first foot; the path length equals the straight distance to the image.

## Common errors

- Area scaled by k instead of k² (and forgetting the square root when going back).
- Multiplying coordinates by k when the centre is not the origin.
- DE/BC = AD/DB (wrong); it is AD/AB.
- Mismatched correspondence in a bow-tie: OA ↔ OD and OB ↔ OC when AB ∥ CD.
- Citing SSA∼ or "AAA" or "they look similar".
- Using h² = pq with the legs instead of the hypotenuse pieces.
- √3 on the short leg of a 30-60-90 triangle.
- Pythagoras in a triangle not known to be right.

## Worked examples

**1. Dilation with a non-origin centre.** Centre (2, −1), k = 3, P = (5, 1). Arrow (3, 2) × 3 = (9, 6); P′ = (11, 5).

**2. Bow-tie.** AB ∥ CD, AD and BC meet at O, OA = 8, OB = 6, OD = 12. OB/OC = OA/OD gives 6/OC = 8/12, OC = 9; CD/AB = 12/8 = 1.5.

**3. Side splitter.** AD = 5, DB = 15, AE = 4: EC = 12, and DE/BC = 5/20 = 1/4.

**4. Altitude figure.** Pieces 2 and 18: h = 6, c = 20, legs √40 = 2√10 and √360 = 6√10; check 40 + 360 = 400.

**5. SAS∼ check.** △ABC: AB = 9, AC = 12, ∠A = 48°; △DEF: DE = 6, DF = 8, ∠D = 48°. 9/6 = 12/8 = 1.5 with included angles equal: similar, k = 2/3 from ABC to DEF.

**6. Bank shot.** P = (0, 5), Q = (14, 2), cushion y = 0: bounce 14 × 5/7 = 10 from P's foot, B = (10, 0); path length √(14² + 7²) = 7√5 ≈ 15.65.

**7. Areas.** Similar pentagons with perimeters 20 and 35: k = 1.75, area ratio 3.0625; if the small one has area 16, the large one has 49.

## What to review from earlier units

From Unit 1: reflections (bank shot), the angle facts for parallel lines (side splitter, bow-tie), the triangle angle sum (AA), midpoints and perpendicular bisectors (dilating by 1/2). From Unit 2: SSS, SAS, ASA (every similarity proof ends with one), the Perpendicular Bisector Theorem (why every point of a mirror is equidistant from a point and its image), and CPCTC-style reading of correspondences.

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Geometry, Unit 3, Lessons 1–16, https://im.kendallhunt.com/HS/teachers/2/3/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
