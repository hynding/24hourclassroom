# Unit 1 Summary · Constructions and Rigid Transformations

**Lessons covered:** 1.1–1.22 (weeks 1–6): compass-and-straightedge constructions (1.1–1.9), rigid transformations and symmetry (1.10–1.18), evidence, angles and proof (1.19–1.21), and designs (1.22).

This is the night-before sheet. If you can explain every line of it without looking, you are ready for the unit exam.

## The ideas that generate every question

1. **A circle is the set of points at a fixed distance from its centre.** Every construction argument is "both are radii of the circle centred at X, so they are equal." A compass copies distance; a straightedge draws the line through two points; nothing measures.
2. **The perpendicular bisector of AB is the set of points equidistant from A and B.** It is constructed with two equal circles centred at A and B. It gives you midpoints, right angles, closest-point borders, mirror lines and centres of rotation.
3. **A rigid transformation preserves every distance**, and therefore every angle, every line, every area and the order of points. There are three basic ones, each with a precise definition:
   - Reflection across m: m is the perpendicular bisector of PP′ (points on m are fixed; orientation reverses).
   - Translation by directed segment AB: PP′ is parallel and congruent to AB in the same direction (no fixed points; orientation kept).
   - Rotation about O by θ: OP′ = OP and ∠POP′ = θ in the stated direction (only O fixed; orientation kept). At 180°, O is the midpoint of PP′.
4. **Two figures are congruent if a sequence of rigid transformations carries one onto the other.** The point-by-point method (translate a vertex, rotate to match a second, reflect across the matched side if the third is on the wrong side) is how you find the sequence.
5. **A figure's symmetries prove things about it.** One reflection proves the base angles of an isosceles triangle are equal and the axis is perpendicular to the base; one 180° rotation proves a parallelogram's opposite sides and angles are equal.
6. **Proof is a chain of justified statements; measuring is evidence.** Justifications: definitions, properties of rigid transformations, theorems already proved, and facts about angle measure.
7. **Parallel lines and a transversal**: alternate interior angles are congruent (proved by a 180° rotation about the midpoint of the transversal segment); hence corresponding angles are congruent and co-interior angles are supplementary. The converse proves lines parallel.
8. **The angles of a triangle sum to 180°**, proved with an auxiliary line through a vertex parallel to the opposite side. Everything about polygon angles follows.

## Constructions to be able to perform and justify

| Construction | Steps | Justification |
|---|---|---|
| Copy segment AB from P | Circle centred at P with radius AB; Q on it | PQ = AB, radius |
| Perpendicular bisector of AB | Equal circles at A and B (radius > AB/2), join crossings | Crossings are equidistant from A and B |
| Equilateral triangle on AB | Circles at A and B with radius AB; join a crossing C | AC = AB and BC = AB, radii |
| Regular hexagon in a circle | Step the radius around the circle | Six equilateral triangles around the centre |
| Perpendicular through P on ℓ | Circle at P meets ℓ at X, Y; perpendicular bisector of XY | P is the midpoint of XY |
| Perpendicular through P off ℓ | Circle at P meets ℓ at X, Y; perpendicular bisector of XY | P is equidistant from X and Y |
| Angle bisector | Circle at vertex gives X, Y; equal circles at X, Y cross at Z; ray VZ | VXZY is a kite with axis VZ |
| Parallel through P | Perpendicular to ℓ through P, then perpendicular to that through P (or a rhombus) | Two lines ⊥ the same line are parallel |
| Square on AB | Perpendiculars at A and B; mark AB on each | Rhombus with a right angle |
| Square in a circle | A diameter and its perpendicular bisector | Congruent perpendicular diagonals bisecting each other |
| Reflection of P across m | Circle at P meets m at X, Y; equal circles at X, Y; other crossing | m is the perpendicular bisector of PP′ |
| Translation of P by AB | Parallel to AB through P; mark AB along it | ABP′P is a parallelogram |
| Rotation of P about O by θ | Circle at O through P; copy angle θ at O | OP′ = OP, ∠POP′ = θ |

## Coordinate rules worth memorising

| Transformation | Rule |
|---|---|
| Reflect across x-axis / y-axis | (x, y) → (x, −y) / (−x, y) |
| Reflect across x = a / y = b | (x, y) → (2a − x, y) / (x, 2b − y) |
| Reflect across y = x | (x, y) → (y, x) |
| Translate by (h, k) | (x, y) → (x + h, y + k) |
| Rotate 90° counter-clockwise about origin | (x, y) → (−y, x) |
| Rotate 90° clockwise about origin | (x, y) → (y, −x) |
| Rotate 180° about origin / about (a, b) | (x, y) → (−x, −y) / (2a − x, 2b − y) |
| Rotate about a non-origin centre | Subtract the centre, rotate, add it back |

Finding a mirror from P and P′: the perpendicular bisector of PP′. Finding a centre of rotation: the intersection of the perpendicular bisectors of PP′ and QQ′. Finding a translation: the arrow P′ − P.

## Symmetry table

| Figure | Lines of symmetry | Rotation symmetry |
|---|---|---|
| Scalene triangle | 0 | none |
| Isosceles triangle | 1 | none |
| Equilateral triangle | 3 | 120°, order 3 |
| Parallelogram | 0 | 180°, order 2 |
| Rectangle | 2 (midpoint lines) | 180° |
| Rhombus | 2 (diagonals) | 180° |
| Square | 4 | 90°, order 4 |
| Kite | 1 (one diagonal) | none |
| Isosceles trapezoid | 1 | none |
| Regular n-gon | n | 360°/n, order n |
| Circle | infinitely many | every angle |

## Angle facts and theorems

- **Linear pair**: adjacent angles whose outer sides form a line; sum 180°. **Supplementary**: sum 180°. **Complementary**: sum 90°.
- **Vertical angles are congruent.** Proof by linear pairs (both are 180° minus the same angle) or by a 180° rotation about the crossing.
- **Parallel lines, transversal**: alternate interior ≅, alternate exterior ≅, corresponding ≅, co-interior supplementary. Converse of each proves parallel.
- **Triangle angle sum 180°.** **Exterior angle** = sum of the two remote interior angles. Acute angles of a right triangle are complementary. Equilateral triangle angles are 60°.
- **Polygon angle sum** (n − 2) × 180°; regular n-gon interior angle (n − 2) × 180°/n; exterior angle 360°/n.
- **Tiling by one regular polygon**: only triangles, squares and hexagons (interior angle must divide 360°).

## Common errors

- Using different radii for the two circles of a perpendicular bisector or angle bisector.
- Using a radius at most half the segment, so the circles do not meet.
- Describing a rotation without a direction, or a translation without a direction, or a reflection without its line.
- Writing a congruence statement with vertices out of correspondence.
- Forgetting the final reflection in the point-by-point method when the triangles have opposite orientation.
- Counting a rectangle's diagonals as lines of symmetry; forgetting a parallelogram's 180° symmetry.
- Applying "alternate interior angles are congruent" without stating that the lines are parallel.
- Taking an exterior angle to equal the adjacent interior angle instead of its supplement.
- Treating measurements as proof.

## Worked examples

**1. A full point-by-point match.** △ABC with A = (0, 0), B = (2, 0), C = (0, 1); △DEF with D = (5, 5), E = (5, 3), F = (4, 5). Translate by (5, 5): A → D, B → (7, 5), C → (5, 6). Rotate about D so (7, 5), which is 2 to the right of D, lands on E, 2 below D: 90° clockwise. C's image: (5, 6) − D = (0, 1) → (1, 0) → (6, 5). Target F = (4, 5) is the mirror image across the vertical line x = 5 (line DE). Reflect across x = 5: (6, 5) → (4, 5) ✓. Sequence: translate (5, 5), rotate 90° clockwise about D, reflect across line DE. Hence △ABC ≅ △DEF.

**2. Eight angles from one.** ℓ ∥ m, transversal, one interior angle is 54°. The angle sharing a side with it is 126°; its vertical partner is 54°; at the other crossing, the alternate interior angle is 54°, the corresponding angle is 54°, and the remaining angles are 126°. Every angle is 54° or 126°.

**3. Triangle with an exterior angle.** ∠A = (x + 15)°, ∠B = (2x)°, exterior angle at C = (4x − 5)°. Exterior = remote interiors: 4x − 5 = x + 15 + 2x, so x = 20. ∠A = 35°, ∠B = 40°, exterior at C = 75°, so ∠C = 105°. Check: 35 + 40 + 105 = 180 ✓.

**4. Why the construction, not the picture.** Asked to show a quadrilateral built from two equal circles is a rhombus: "AC and AD are radii of the circle at A, so AC = AD = AB; BC and BD are radii of the circle at B, so BC = BD = AB. Four sides equal AB." Four sentences, no ruler.

## What to review from earlier units

This is the first unit, so the only prerequisites are middle-school ideas: the Pythagorean theorem on a coordinate grid (distance between points), the coordinate plane, and basic angle vocabulary. Make sure you can compute √(Δx² + Δy²) quickly, since the exam uses it to check rigid transformations and closest-point regions.

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Geometry, Unit 1, Lessons 1–22, https://im.kendallhunt.com/HS/teachers/2/1/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
