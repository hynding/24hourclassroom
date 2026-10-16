# Unit 7 Summary · Circles

**Lessons covered:** 7.1–7.14 (weeks 26–29): chords, arcs, central and inscribed angles, tangents, cyclic quadrilaterals (7.1–7.4); circumscribed circles, the angle-bisector locus, the incentre and inscribed circles (7.5–7.7); arc length, sector area, part-to-whole, the arc-to-radius ratio and the radian (7.8–7.11); radian sense, rθ and ½r²θ, modelling (7.12–7.14).

This is the night-before sheet. Every theorem below was proved in class; on the exam you may use any of them, and you will be asked to reproduce two or three of the proofs.

## The ideas that generate every question

1. **Two radii make an isosceles triangle.** Equal base angles, plus the exterior angle theorem, give the Inscribed Angle Theorem; SAS/SSS with radii give the chord theorems.
2. **The centre is equidistant from everything on the circle**, so it lies on the perpendicular bisector of every chord (Perpendicular Bisector Theorem), and three points determine exactly one circle.
3. **Shortest distance is perpendicular.** That is why a tangent is perpendicular to the radius (proof by contradiction) and why "distance to a line" means the perpendicular distance in the angle-bisector locus.
4. **Concurrency comes from "equidistant" twice.** Perpendicular bisectors → circumcentre (equidistant from vertices). Angle bisectors → incentre (equidistant from sides).
5. **A sector is a fraction of the circle.** Arc = fraction × 2πr, area = fraction × πr². Dividing by the fraction recovers the whole.
6. **All circles are similar**, so arc ÷ radius depends only on the angle: that ratio is the radian measure. With θ in radians, arc = rθ and area = ½r²θ = ½ · r · arc.

## Theorems

| Theorem | Statement | Proof idea |
|---|---|---|
| Chords and central angles | Equal chords ⇔ equal central angles (same circle) | SAS / SSS with radii |
| Perpendicular to a chord | The perpendicular from the centre bisects the chord | centre is on the chord's perpendicular bisector |
| Inscribed Angle | Inscribed angle = ½ central angle = ½ arc | isosceles radii + exterior angle; three cases via a diameter |
| Same arc | Inscribed angles on the same arc are equal | both are half the arc |
| Semicircle (Thales) | An angle inscribed in a semicircle is 90° | arc = 180° |
| Tangent ⊥ radius | A tangent is perpendicular to the radius at the point of tangency | otherwise the perpendicular foot is inside and the line crosses twice |
| Two tangents | Tangent segments from an outside point are equal | HL with the shared hypotenuse OP |
| Cyclic quadrilateral | Opposite angles are supplementary | the two intercepted arcs make 360° |
| Circumcentre | Perpendicular bisectors are concurrent, equidistant from vertices | PBT twice, then its converse |
| Angle-bisector locus | On the bisector ⇔ equidistant from the sides | AAS one way, HL the other |
| Incentre | Angle bisectors are concurrent, equidistant from sides | locus twice, then its converse |
| Incircle | The circle at the incentre with radius = distance to a side is tangent to all three sides | tangent ⊥ radius converse |

## Formulas

| Quantity | Degrees | Radians |
|---|---|---|
| arc length | (θ/360) · 2πr | rθ |
| sector area | (θ/360) · πr² | ½r²θ = ½ · r · arc |
| segment area | sector − triangle | sector − ½r² sin θ |
| degrees ↔ radians | × π/180 | × 180/π |

| Figure | Formula |
|---|---|
| chord at distance d from the centre | length 2√(r² − d²) |
| tangent from P with OP = D | length √(D² − r²) |
| angle between the two tangents from P | 180° − central angle T₁OT₂ |
| angle at the incentre | ∠AIB = 90° + ½∠C |
| inradius | r = Area / s, s = semiperimeter; right triangle: (a + b − c)/2 |
| circumradius of a right triangle | half the hypotenuse |
| equilateral triangle, side s | R = s√3/3, r = s√3/6, R = 2r |

Benchmarks: π/6 = 30°, π/4 = 45°, π/3 = 60°, π/2 = 90°, 2π/3 = 120°, 3π/4 = 135°, 5π/6 = 150°, π = 180°, 3π/2 = 270°, 2π = 360°; 1 radian ≈ 57.3°.

## Procedures

- **Chord length / distance:** half-chord, distance and radius form a right triangle.
- **Angle chasing in a circle:** mark every inscribed angle as half its arc, every central angle as its arc; use the semicircle and cyclic-quadrilateral facts; remember radii make isosceles triangles.
- **Tangent problems:** draw the radius to the point of tangency and use the right angle (Pythagorean theorem or trigonometry).
- **Which centre?** Equidistant from *points* → circumcentre (perpendicular bisectors). Equidistant from *lines*, or the largest circle inside → incentre (angle bisectors).
- **Part to whole:** find the fraction (θ/360, or θ/2π), divide the sector's measurement by it, then solve for r.
- **Compare angles from arcs:** divide each arc by its radius.
- **Modelling:** draw the sector or chord, label r and θ (radians), choose rθ, ½r²θ or ½ · r · arc; compare deals by cost per unit area.

## Common errors

- Doubling the wrong angle: inscribed = half the arc; central = the arc.
- Reading an inscribed angle on the wrong arc (the arc inside the angle, away from the vertex).
- Using a slanted segment as "distance to a side".
- Confusing incentre (sides) with circumcentre (vertices); expecting the circumcentre inside an obtuse triangle.
- Forgetting the ½ in triangle areas when computing segments or inradii.
- Dividing by the fraction the wrong way in part-to-whole problems.
- Using rθ with degrees, or treating radians as degrees with a π attached.
- Comparing slices by size instead of cost per area.

## Worked examples

**1. Angle chase.** AB is a diameter, C and D are on the circle on the same side of AB, ∠CAB = 28°. Then ∠ACB = 90°, ∠ABC = 62°, arc BC = 56°, and ∠CDB (same arc BC) = 28°.

**2. Tangents.** From P, 25 from the centre of a circle of radius 7, each tangent is √(625 − 49) = 24. If ∠T₁OT₂ = 110°, then ∠T₁PT₂ = 70°.

**3. Cyclic quadrilateral.** ∠A = (2x + 15)°, ∠C = (3x − 10)°: 5x + 5 = 180, x = 35, ∠A = 85°, ∠C = 95°.

**4. Centres.** Triangle 9-40-41 (right): circumradius 20.5 at the hypotenuse's midpoint; area 180, s = 45, inradius 4.

**5. Sector.** Radius 9, 140°: fraction 7/18; arc 7π ≈ 21.99; area 31.5π ≈ 98.96.

**6. Part to whole.** A 100° sector has area 20π: whole area 72π, r = √72 = 6√2 ≈ 8.49; circumference 12√2 π ≈ 53.31.

**7. Radians.** Radius 8, arc 14: θ = 1.75 rad ≈ 100°; area ½ · 8 · 14 = 56.

**8. Modelling.** Pizza A: radius 16 cm, 8 slices, $3.50 each → 100.5 cm² per slice, 3.5 cents/cm². Pizza B: radius 20 cm, 12 slices, $4.00 each → 104.7 cm², 3.8 cents/cm². A is the better deal.

## What to review from earlier units

From Unit 1: angle sums, linear pairs, the exterior angle theorem (7.2). From Unit 2: the isosceles triangle theorem, the Perpendicular Bisector Theorem, the angle bisector theorem, HL and AAS (7.1–7.7). From Unit 3: similarity and dilations (7.10). From Unit 4: trigonometry for chord and tangent problems. From Unit 5: area scaling by k². From Unit 6: slopes of tangents and circle equations on a grid.

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Geometry, Unit 7, Lessons 1–14, https://im.kendallhunt.com/HS/teachers/2/7/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
