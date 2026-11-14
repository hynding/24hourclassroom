# Week 26 · Chords, Inscribed Angles, Tangents and Cyclic Quadrilaterals

**Lessons:** 7.1 Lines, Angles, and Curves · 7.2 Inscribed Angles · 7.3 Tangent Lines · 7.4 Quadrilaterals in Circles
**Practices:** MP3 (construct arguments), MP6 (attend to precision), MP7 (use structure)
**Built from:** IM Geometry, Unit 7, Lessons 1–4, in our own words
**Spiral:** every proof this week leans on two old results: the isosceles triangle theorem (week 10; any two radii make an isosceles triangle) and the exterior angle theorem (week 6). The Perpendicular Bisector Theorem (week 8) explains why the centre sits on the perpendicular bisector of every chord. The tangent–radius right angle is the slope rule of week 24 when the circle is on a grid, and the Pythagorean theorem (week 14) computes tangent lengths.

## What you need to be able to do

- Use the vocabulary of circles (chord, diameter, arc, central angle, inscribed angle, intercepted arc, arc measure) and prove that congruent central angles cut congruent chords and that the perpendicular from the centre bisects a chord.
- State and prove the Inscribed Angle Theorem (an inscribed angle is half the central angle on the same arc) and use its corollaries: inscribed angles on the same arc are congruent, and an angle inscribed in a semicircle is a right angle.
- Prove that a tangent line is perpendicular to the radius at the point of tangency, construct the tangents from an outside point, and compute tangent lengths.
- Prove that the opposite angles of a quadrilateral inscribed in a circle are supplementary, use the result to find angles, and decide which quadrilaterals can be inscribed in a circle.

## Key terms

| Term | Meaning |
|---|---|
| Chord | A segment whose endpoints are on the circle. A diameter is a chord through the centre. |
| Arc | A connected part of the circle. Two points cut the circle into a minor arc (less than half) and a major arc. |
| Central angle | An angle whose vertex is the centre; its sides cut off an arc. |
| Arc measure | The measure of its central angle, in degrees. A semicircle measures 180°. |
| Inscribed angle | An angle whose vertex is on the circle and whose sides are chords. |
| Intercepted arc | The arc inside an inscribed (or central) angle, between its sides. |
| Tangent line | A line that meets the circle at exactly one point, the point of tangency. |
| Cyclic (inscribed) quadrilateral | A quadrilateral whose four vertices lie on one circle. |

## 1. Lines, angles and curves (7.1)

Draw any two radii OA and OB. Triangle OAB is **isosceles** (OA = OB), so its base angles are equal: this one observation drives the whole week.

**Theorem (chords and central angles).** In one circle, two chords are congruent exactly when their central angles are congruent.
*Proof.* If ∠AOB ≅ ∠COD, then △AOB ≅ △COD by SAS (radii, included angle, radii), so AB ≅ CD. Conversely, if AB ≅ CD then △AOB ≅ △COD by SSS, so the central angles match. ∎

**Theorem (perpendicular to a chord).** The perpendicular from the centre to a chord bisects the chord; equivalently, the centre lies on the perpendicular bisector of every chord.
*Proof.* O is equidistant from A and B (both distances are the radius), so by the converse of the Perpendicular Bisector Theorem, O is on the perpendicular bisector of AB. The perpendicular from O to AB is that bisector. ∎

```
Figure description: circle with centre O; chord AB of length 16; the
perpendicular from O meets AB at its midpoint M, so AM = MB = 8. If the
radius is 10, triangle OMA is right-angled at M with OA = 10 and AM = 8,
so OM = 6.

            O
           /|\
      10  / | \  10
         /  |6 \
        A───M───B
          8   8
```

**Worked example 1.** A chord of length 16 is drawn in a circle of radius 10. How far is it from the centre? The perpendicular bisects the chord, giving a right triangle with hypotenuse 10 and leg 8: distance √(100 − 64) = 6.

**Worked example 2 — the reverse.** A chord is 5 units from the centre of a circle of radius 13. Half the chord is √(169 − 25) = 12, so the chord has length 24.

**Worked example 3 — a central angle.** In a circle of radius 6, chord PQ has central angle 60°. Triangle OPQ is isosceles with apex 60°, so its base angles are 60° too: it is equilateral and PQ = 6. Arc PQ measures 60°.

**Try it 1.1** A circle has radius 17 and a chord of length 30. Find the chord's distance from the centre. *(Answer: √(289 − 225) = 8.)*

**Try it 1.2** Two chords of a circle are 7 and 9 units long. Which has the larger central angle? *(Answer: the longer chord, 9: a larger apex angle in an isosceles triangle with the same legs opens a longer base.)*

## 2. Inscribed angles (7.2)

An **inscribed angle** has its vertex on the circle. The arc between its sides is the **intercepted arc**.

**Inscribed Angle Theorem.** An inscribed angle measures half the central angle that intercepts the same arc; equivalently, half the arc.

*Proof, case 1 (one side is a diameter).* Let ∠BAC be inscribed with AC a diameter through the centre O. Triangle OAB is isosceles (OA = OB), so ∠OBA = ∠OAB; call it x. The central angle ∠BOC is an exterior angle of triangle OAB, so it equals the sum of the two remote interior angles: ∠BOC = x + x = 2x = 2∠BAC. ∎

*Case 2 (the centre is inside the angle).* Draw the diameter from A. It splits ∠BAC into two angles, each of which is half its central angle by case 1; add them.
*Case 3 (the centre is outside the angle).* Draw the diameter from A; now ∠BAC is the difference of two case-1 angles, and the central angle is the difference of their central angles. ∎

```
Figure description: circle with centre O. A, B, C on the circle, AC a
diameter. Inscribed angle BAC = x at A. Radii OA and OB are equal, so
angle OBA = x too, and the central angle BOC, exterior to triangle OAB,
equals 2x.

          B
         /|\
        / | \
       /  |  \
      A───O───C
```

**Corollaries.**
1. **Same arc, same angle:** two inscribed angles that intercept the same arc are congruent (both are half of it).
2. **Angle in a semicircle:** an angle inscribed in a semicircle is a right angle, because its intercepted arc is 180°. (Thales.) Conversely, if ∠ABC = 90° and A, B, C lie on a circle, then AC is a diameter.

**Worked example 4.** Arc PQ measures 110°. An inscribed angle on PQ measures 55°; the central angle measures 110°.

**Worked example 5.** Inscribed angle ∠XYZ = 38°. Any other inscribed angle on arc XZ (from the same side) is 38°, and the central angle ∠XOZ is 76°.

**Worked example 6.** AB is a diameter and C is any other point on the circle, with ∠CAB = 31°. Then ∠ACB = 90° (semicircle), so ∠CBA = 59°.

**Worked example 7 — finding an arc from a chord and radius.** In a circle of radius 10, chord AB = 10√2. Triangle OAB has sides 10, 10, 10√2, which satisfy 10² + 10² = (10√2)², so ∠AOB = 90° and the minor arc AB measures 90°. An inscribed angle on the major arc side measures 45°.

**Try it 2.1** The central angle on arc DE is 140°. What is an inscribed angle on arc DE? *(Answer: 70°.)*

**Try it 2.2** Points A, B, C are on a circle with ∠BAC = 25° and ∠ABC = 65°. Is AC a diameter? Is BC? *(Answer: ∠ACB = 90°, so AB, the side opposite the right angle, is the diameter; neither AC nor BC.)*

## 3. Tangent lines (7.3)

A **tangent** touches the circle at exactly one point, the point of tangency T.

**Theorem.** A tangent is perpendicular to the radius drawn to the point of tangency.
*Proof (by contradiction).* Suppose the tangent at T is not perpendicular to OT. Drop the perpendicular from O to the tangent line, meeting it at F ≠ T. In right triangle OFT the hypotenuse OT is the longest side, so OF < OT = r: F is **inside** the circle. A line through an interior point crosses the circle twice, contradicting "exactly one point". So the perpendicular foot must be T itself. ∎

**Converse.** A line through a point T of the circle that is perpendicular to OT is tangent (every other point of the line is farther than r from O, since OT is the shortest segment from O to the line).

**Constructing the tangents from an outside point P.** Draw the circle with diameter OP (centre at the midpoint of OP). It meets the given circle at two points T₁ and T₂. Each angle ∠OT₁P is inscribed in a semicircle of the new circle, so it is a right angle: PT₁ ⊥ OT₁, and PT₁ is tangent by the converse.

**Two tangents from a point are congruent.** PT₁ = PT₂, because triangles OT₁P and OT₂P are right triangles sharing hypotenuse OP with legs OT₁ = OT₂ = r (HL congruence, week 9).

**Worked example 8.** A circle has radius 5 and P is 13 units from the centre. Each tangent segment from P has length √(13² − 5²) = 12.

**Worked example 9 — an angle between tangents.** From P, the two tangents touch the circle at T₁ and T₂, and the central angle ∠T₁OT₂ = 120°. Quadrilateral OT₁PT₂ has two right angles, so ∠T₁PT₂ = 360° − 90° − 90° − 120° = 60°.

**Worked example 10 — on the grid.** The circle x² + y² = 25 passes through (3, 4). The radius to (3, 4) has slope 4/3, so the tangent there has slope −3/4: y − 4 = −3/4 (x − 3), or 3x + 4y = 25.

**Try it 3.1** A tangent segment from P has length 24 and the radius is 7. How far is P from the centre? *(Answer: √(576 + 49) = 25.)*

## 4. Quadrilaterals in circles (7.4)

**Theorem.** If a quadrilateral is inscribed in a circle, each pair of opposite angles is supplementary.
*Proof.* Let ABCD be inscribed. ∠A intercepts arc BCD and ∠C intercepts arc DAB; those two arcs together make the whole circle, 360°. By the Inscribed Angle Theorem, ∠A + ∠C = ½(arc BCD + arc DAB) = ½ · 360° = 180°. The same argument gives ∠B + ∠D = 180°. ∎

**Converse (used, proof not required).** If the opposite angles of a quadrilateral are supplementary, its vertices lie on a circle.

| Quadrilateral | Always cyclic? | Why |
|---|---|---|
| rectangle, square | yes | all angles 90°; the centre is where the diagonals cross |
| isosceles trapezoid | yes | base angles equal, co-interior angles supplementary, so opposite angles are supplementary |
| parallelogram (not a rectangle) | no | opposite angles are equal, so supplementary only if 90° |
| rhombus (not a square) | no | same reason |
| kite | only if its two "non-symmetric" angles are right angles | they are the pair of equal opposite angles |

**Worked example 11.** Cyclic quadrilateral PQRS has ∠P = 72° and ∠Q = 115°. Then ∠R = 108° and ∠S = 65°.

**Worked example 12.** In cyclic quadrilateral ABCD, ∠A = (3x + 10)° and ∠C = (2x + 20)°. Then 5x + 30 = 180, x = 30, ∠A = 100°, ∠C = 80°.

**Worked example 13 — deciding.** A quadrilateral has angles 80°, 100°, 95°, 85° in order. Opposite pairs: 80 + 95 = 175 and 100 + 85 = 185. Not supplementary, so it cannot be inscribed in a circle.

**Try it 4.1** Cyclic quadrilateral WXYZ has ∠W = 2∠Y. Find both. *(Answer: 3∠Y = 180°, ∠Y = 60°, ∠W = 120°.)*

## Common mistakes

- **Halving the wrong thing.** The inscribed angle is half the *arc* (or central angle); the central angle is twice the inscribed angle, never the other way round.
- **Reading an inscribed angle on the wrong arc.** The intercepted arc is the one *inside* the angle, away from the vertex.
- **Assuming any radius is perpendicular to any chord.** Only the radius through the chord's midpoint is.
- **Treating a tangent as a chord.** A tangent touches once and lies outside the circle otherwise; the right angle is with the radius at the touch point.
- **Using the Pythagorean theorem with the wrong hypotenuse.** For a tangent from P, OP is the hypotenuse: PT² = OP² − r².
- **"All quadrilaterals are cyclic."** Only those with supplementary opposite angles. A tilted parallelogram is the standard counterexample.
- **Adding adjacent angles instead of opposite ones.** In a cyclic quadrilateral it is ∠A + ∠C = 180°, not ∠A + ∠B.

## Where this goes next

Week 27 fits circles to triangles: every triangle has a circumscribed circle (perpendicular bisectors meet at its centre) and an inscribed circle (angle bisectors meet at its centre, and the radius is the perpendicular distance to a side). The tangent–radius right angle is what makes the inscribed circle touch each side. Weeks 28 and 29 measure arcs and sectors, and the central angle you met this week becomes the radian.

## Self-check

1. A chord of length 24 lies in a circle of radius 13. How far is the chord from the centre?
2. An inscribed angle intercepts an arc of 96°. What is the angle? What is the central angle on the same arc?
3. AB is a diameter, C is on the circle, and ∠ABC = 37°. Find ∠BAC.
4. From a point 17 units from the centre of a circle of radius 8, how long is each tangent segment?
5. A cyclic quadrilateral has ∠A = 3∠C. Find ∠A and ∠C.

*Answers: (1) half-chord 12, distance √(169 − 144) = 5. (2) 48°; 96°. (3) ∠ACB = 90°, so ∠BAC = 53°. (4) √(289 − 64) = 15. (5) 4∠C = 180°, ∠C = 45°, ∠A = 135°.*

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Geometry, Unit 7, Lessons 1–4, https://im.kendallhunt.com/HS/teachers/2/7/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
