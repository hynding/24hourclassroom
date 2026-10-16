# Unit 6 Summary · Coordinate Geometry

**Lessons covered:** 6.1–6.17 (weeks 22–25): transformations as coordinate rules and functions (6.1–6.3); the distance formula, circles, completing the square, parabolas (6.4–6.8); equations of lines, parallel and perpendicular slopes, intersection points (6.9–6.13); coordinate proof, weighted averages, the centroid, altitudes and perpendicular bisectors (6.14–6.17).

This is the night-before sheet. Every formula below was derived in class; on the exam you may use any of them, but you will be asked to explain where several of them come from.

## The ideas that generate every question

1. **A transformation is a function on coordinates.** Each rule (x, y) → (…, …) is checked for rigidity by testing distances; rules compose by substitution, and the order usually matters.
2. **Distance is the Pythagorean theorem.** d = √((Δx)² + (Δy)²). Fix the distance from a centre and you get a circle; set the distance to a point equal to the distance to a line and you get a parabola.
3. **Completing the square undoes expansion.** x² + bx = (x + b/2)² − (b/2)². It turns x² + y² + Dx + Ey + F = 0 back into centre-radius form, or shows there is no circle at all.
4. **Slope is a property of the line** (similar slope triangles). Translations keep slope, so parallel lines have equal slopes; a 90° rotation sends (1, m) to (−m, 1), so perpendicular slopes multiply to −1.
5. **Meeting points are solutions of systems.** Substitute one equation into the other; a line and a circle give a quadratic with 0, 1 or 2 solutions.
6. **Coordinates prove theorems.** Place the figure well, use letters for generality, compute, conclude. Weighted averages locate points along a segment and prove that the medians meet at (A + B + C)/3.

## Transformation rules (origin-centred)

| Transformation | Rule | Rigid? |
|---|---|---|
| reflect across x-axis | (x, y) → (x, −y) | yes |
| reflect across y-axis | (x, y) → (−x, y) | yes |
| reflect across y = x | (x, y) → (y, x) | yes |
| reflect across x = c | (x, y) → (2c − x, y) | yes |
| rotate 90° counterclockwise | (x, y) → (−y, x) | yes |
| rotate 180° | (x, y) → (−x, −y) | yes |
| rotate 270° counterclockwise | (x, y) → (y, −x) | yes |
| translate by (a, b) | (x, y) → (x + a, y + b) | yes |
| dilate from origin by k | (x, y) → (kx, ky) | only if k = 1 |
| stretch (x, y) → (2x, y) | | no: distances and angles change |

To rotate about another centre: subtract the centre, rotate, add it back. To compose: apply the first rule, substitute into the second.

## Formulas

| Object | Formula |
|---|---|
| distance | √((x₂ − x₁)² + (y₂ − y₁)²) |
| midpoint | ((x₁ + x₂)/2, (y₁ + y₂)/2) |
| point t of the way from A to B | A + t(B − A) = (1 − t)A + tB |
| ratio m : n from A | t = m/(m + n) |
| centroid | ((x₁ + x₂ + x₃)/3, (y₁ + y₂ + y₃)/3) |
| circle, centre (h, k), radius r | (x − h)² + (y − k)² = r² |
| expanded circle | x² + y² + Dx + Ey + F = 0, centre (−D/2, −E/2) |
| parabola, focus (a, b), directrix y = c | √((x − a)² + (y − b)²) = \|y − c\|; square and solve for y |
| parabola in vertex form | y = (x − h)²/(4p) + k: vertex (h, k), focus (h, k + p), directrix y = k − p |
| slope | (y₂ − y₁)/(x₂ − x₁) |
| point-slope | y − k = m(x − h) |
| slope-intercept | y = mx + b |
| parallel | equal slopes (or both vertical) |
| perpendicular | slopes multiply to −1 (or vertical with horizontal) |

## Procedures

- **Circle from expanded form:** divide so x² and y² have coefficient 1; group; complete both squares; move constants right. Right side positive: circle of radius √(right side). Zero: one point. Negative: nothing.
- **Parabola from focus and directrix:** distance to focus = distance to directrix; square both sides; solve for y. Vertex halfway between focus and directrix; opens toward the focus.
- **Line through a point parallel/perpendicular to a given line:** find the given slope (solve for y if needed); keep it or take the opposite reciprocal; use point-slope form.
- **Intersection of two lines:** set the y-expressions equal, solve for x, back-substitute, check in both.
- **Line and circle:** substitute the line into the circle, solve the quadratic; count real roots.
- **Altitude from V:** through V, slope = opposite reciprocal of the opposite side's slope. **Perpendicular bisector of XY:** through the midpoint of XY, same slope rule. **Median from V:** through V and the opposite midpoint.
- **Orthocentre:** intersect two altitudes. **Circumcentre:** intersect two perpendicular bisectors; it is equidistant from the vertices. **Centroid:** average the vertices; it is 2/3 along each median from the vertex.

## Common errors

- Rotating with the wrong rule: 90° counterclockwise is (−y, x); test it on (1, 0) → (0, 1).
- Adding the changes instead of squaring them in the distance formula.
- Reading the radius as the right side of the circle equation instead of its square root.
- Completing the square without subtracting what was added, or without dividing out a leading coefficient first.
- Measuring the distance to a directrix along a slant; it is the vertical gap |y − c|.
- Reciprocal without the sign change (or the reverse) for perpendicular slopes; applying the product rule to a vertical line.
- Calling two equations of the same line "parallel".
- Checking an intersection point in only one equation.
- Weighting the wrong endpoint: one third of the way from A is (2/3)A + (1/3)B.
- Placing a figure with specific numbers and calling the result a proof for all figures.
- Confusing altitude (through a vertex) with perpendicular bisector (through a midpoint).

## Worked examples

**1. Composition.** Reflect across the x-axis then rotate 90° counterclockwise: (x, y) → (x, −y) → (y, x). The result is the reflection across y = x. Reversed order: (x, y) → (−y, x) → (−y, −x), the reflection across y = −x. Order matters.

**2. Circle from expanded form.** x² + y² − 10x + 4y + 13 = 0 → (x − 5)² − 25 + (y + 2)² − 4 + 13 = 0 → (x − 5)² + (y + 2)² = 16. Centre (5, −2), radius 4. The point (8, 2) gives 9 + 16 = 25 > 16: outside.

**3. Parabola.** Focus (2, 3), directrix y = −1. Vertex (2, 1). √((x − 2)² + (y − 3)²) = |y + 1| → (x − 2)² + y² − 6y + 9 = y² + 2y + 1 → (x − 2)² + 8 = 8y → y = (x − 2)²/8 + 1. Check (6, 3): 16/8 + 1 = 3 ✓; it is 4 from the focus and 4 from the directrix.

**4. Lines.** Through (3, −1) perpendicular to 2x + 5y = 10. The given line is y = −2/5 x + 2, slope −2/5; perpendicular slope 5/2; y + 1 = 5/2 (x − 3), or y = 5/2 x − 17/2.

**5. Line and circle.** y = 2x + 5 and x² + y² = 10: x² + 4x² + 20x + 25 = 10 → 5x² + 20x + 15 = 0 → x² + 4x + 3 = 0 → x = −1 or −3. Points (−1, 3) and (−3, −1). Check: 1 + 9 = 10 ✓, 9 + 1 = 10 ✓.

**6. Weighted average.** P on AB with AP : PB = 3 : 2, A = (−4, 1), B = (6, 6). t = 3/5; B − A = (10, 5); P = (−4, 1) + (6, 3) = (2, 4).

**7. Triangle centres.** A = (0, 0), B = (8, 0), C = (2, 6). Centroid (10/3, 2). Altitudes x = 2 and y = x meet at the orthocentre (2, 2). Perpendicular bisectors x = 4 and y − 3 = −1/3 (x − 1) meet at the circumcentre (4, 2), which is √20 from each vertex. All three centres lie on y = 2, with the centroid 2/3 of the way from the orthocentre to the circumcentre.

**8. Coordinate proof.** Rectangle (0, 0), (a, 0), (a, b), (0, b): both diagonals have length √(a² + b²), so the diagonals of every rectangle are congruent. Triangle (0, 0), (2a, 0), (2b, 2c): the midsegment from (b, c) to (a + b, c) is horizontal with length a, parallel to the base and half of it.

## What to review from earlier units

From Unit 1: the definitions of reflection, rotation and translation that the coordinate rules encode, and the perpendicular bisector as the set of points equidistant from two points. From Unit 2: the parallelogram converses used to finish coordinate proofs, and the Perpendicular Bisector Theorem behind the circumcentre. From Unit 3: AA similarity (slope triangles), the midsegment theorem and the Pythagorean theorem (the distance formula). From Unit 5: nothing new is needed, but dilation rules reappear as (x, y) → (kx, ky).

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Geometry, Unit 6, Lessons 1–17, https://im.kendallhunt.com/HS/teachers/2/6/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
