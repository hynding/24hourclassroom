# Week 02 · Perpendiculars, Angle Bisectors, Parallels and Squares

**Lessons:** 1.5 Construction Techniques 3: Perpendicular Lines and Angle Bisectors · 1.6 Construction Techniques 4: Parallel and Perpendicular Lines · 1.7 Construction Techniques 5: Squares · 1.8 Using Technology for Constructions
**Practices:** MP5 (use tools strategically), MP7 (look for structure), MP6 (precision)
**Built from:** IM Geometry, Unit 1, Lessons 5–8, in our own words
**Spiral:** every construction this week is built out of week 1's perpendicular bisector. If you can explain why PA = PB for a crossing point of two equal circles, you can explain everything here.

## What you need to be able to do

- Construct a line perpendicular to a given line through a given point, whether the point is on the line or off it, and explain why the result is perpendicular.
- Construct the bisector of an angle and justify it using congruent circles (and a rhombus or kite).
- Construct a line parallel to a given line through a given point, and say why "two lines perpendicular to the same line" gives a parallel.
- Construct a square on a given segment and a square inscribed in a given circle.
- Carry out the same constructions in dynamic geometry software, and tell a construction (relationships survive dragging) from a drawing (they do not).

## Key terms

| Term | Meaning |
|---|---|
| Perpendicular (⊥) | Two lines, rays or segments that meet at a right angle (90°). |
| Parallel (∥) | Two lines in the same plane that never meet. |
| Angle bisector | The ray from the vertex of an angle that splits it into two congruent angles. Every point on it is equidistant from the two sides of the angle. |
| Kite | A quadrilateral with two pairs of congruent adjacent sides. One diagonal of a kite bisects the angles at its ends and is the perpendicular bisector of the other diagonal. |
| Square | A quadrilateral with four congruent sides and four right angles. |
| Inscribed | A polygon is inscribed in a circle when all its vertices lie on the circle. |
| Diameter | A chord through the centre; twice the radius. |
| Construction vs. drawing (software) | In a construction every object is defined by others, so dragging a starting point keeps every relationship. In a drawing, objects were placed by eye and fall apart when dragged. |

## 1. Perpendicular to a line through a point

**Case A: the point P is on line ℓ.** Draw any circle centred at P; it meets ℓ at two points X and Y, with PX = PY (radii). P is now the midpoint of XY. Construct the perpendicular bisector of XY (equal circles at X and Y, larger radius, crossing at Z); it passes through the midpoint P and is perpendicular to ℓ. Line PZ is the answer.

**Case B: the point P is not on ℓ.** Draw a circle centred at P big enough to cross ℓ at two points X and Y. Then PX = PY, so P is on the perpendicular bisector of XY. Construct that bisector (equal circles at X and Y crossing at Z, on the far side of ℓ from P, or use P itself as one of the two points). Line PZ is perpendicular to ℓ, and its foot F on ℓ is the midpoint of XY.

```
Figure description, case B: line ℓ horizontal; P above it.
Circle centred at P crosses ℓ at X (left) and Y (right).
F is the midpoint of XY; PF ⊥ ℓ.

              P
             /|\
            / | \
   ---X-----F-----Y---  ℓ
```

**Why it works.** In both cases the finished line is the perpendicular bisector of a segment XY that lies along ℓ. A perpendicular bisector is perpendicular to its segment, so it is perpendicular to ℓ, and it goes through P because P is equidistant from X and Y.

**Worked example 1.** ℓ is a line, P is 5 units above it. A circle centred at P with radius 13 crosses ℓ at X and Y. How far apart are X and Y? Let F be the foot of the perpendicular from P. Triangle PFX has a right angle at F, PX = 13, PF = 5, so FX = √(13² − 5²) = √(169 − 25) = √144 = 12. By symmetry FY = 12, so XY = 24.

**Try it 1.1** In worked example 1, what radius would make the circle just touch ℓ at a single point? *(Answer: 5, the distance from P to ℓ; the circle then touches at F and the construction fails because there is only one crossing point.)*

## 2. Bisecting an angle

Given ∠AVB with vertex V.

1. Draw a circle centred at V. It crosses ray VA at X and ray VB at Y. Now VX = VY.
2. Draw equal circles centred at X and at Y (any radius bigger than half of XY). They cross at Z, inside the angle.
3. Ray VZ bisects ∠AVB.

```
Figure description: vertex V at the left; ray VA goes up-right, ray VB goes down-right.
X on VA and Y on VB with VX = VY. Z inside the angle with XZ = YZ.
Ray VZ splits the angle into two congruent angles.

        A
       /
      X
     / \
    V---Z------
     \ /
      Y
       \
        B
```

**Why it works.** VX = VY (radii of the circle at V) and XZ = YZ (equal radii of the circles at X and Y). So quadrilateral VXZY is a kite, with V and Z the ends of its axis of symmetry. Folding along VZ sends X onto Y, so it sends ray VX onto ray VY and ∠XVZ onto ∠YVZ. The two angles are congruent. In Unit 2 you will write this as "triangles VXZ and VYZ are congruent by SSS, so ∠XVZ ≅ ∠YVZ".

If you choose the same radius in step 2 as in step 1, then VXZY has four equal sides, a rhombus, and ray VZ is the diagonal of the rhombus.

**Worked example 2.** ∠AVB = 70°. After bisecting, what is ∠AVZ? 35°. And if you bisect ∠AVZ again? 17.5°. Repeated bisection halves; you can never get a third of an angle this way, and in fact trisecting a general angle with compass and straightedge is impossible (proved in 1837).

**Try it 2.1** Describe how to construct a 45° angle starting from a line and a point on it. *(Answer: construct a perpendicular at the point (90°), then bisect the right angle.)*

**Try it 2.2** A student draws the circle at V, marks X and Y, then draws a circle at X of radius 3 and a circle at Y of radius 4. Is VZ the bisector? *(Answer: no; XZ ≠ YZ, so the kite argument fails and VZ is tilted toward one side.)*

## 3. Parallel through a point

Given line ℓ and a point P not on it.

**Method 1 (double perpendicular).** Construct the perpendicular m to ℓ through P (section 1, case B). Then construct the perpendicular n to m through P (case A, because P is on m). Line n is parallel to ℓ.

Why: ℓ and n are both perpendicular to m. If two lines are each perpendicular to the same line, they are parallel; if they met at some point Q, then Q, together with the foot on m, would form a triangle with two right angles, which is impossible (you will prove the triangle angle sum is 180° in week 6).

**Method 2 (rhombus).** Choose any point A on ℓ. Draw the circle centred at A through P; it crosses ℓ at B. Draw the circle centred at P with the same radius, and the circle centred at B with the same radius; they cross at C on the same side as P. Then ABCP has AB = BC = CP = PA, a rhombus, and a rhombus is a parallelogram, so PC ∥ ℓ.

```
Figure description, method 2: ℓ horizontal through A and B with AB = AP.
P above A, C above B, with PC ∥ AB. All four sides of ABCP equal the radius.

       P-------C
      /       /
     /       /
 ---A-------B---  ℓ
```

**Worked example 3.** Line ℓ, point P at distance 3 from ℓ. Using method 1, the perpendicular m through P meets ℓ at F with PF = 3. The parallel n through P is everywhere 3 from ℓ. Any point Q on n has its foot Q′ on ℓ with QQ′ = 3. Parallel lines are "the same distance apart everywhere"; that is a consequence of being parallel, not the definition.

**Try it 3.1** Why does method 2 need the circle at P and the circle at B to have the **same** radius as the first circle? *(Answer: so that all four sides equal that radius; four equal sides is what makes ABCP a rhombus, and a rhombus has parallel opposite sides.)*

## 4. Squares

**Square on a segment AB.**

1. Construct the perpendicular to AB at A (case A: extend AB beyond A, draw a circle centred at A through B, it meets the extension at B′; bisect BB′).
2. Draw the circle centred at A with radius AB; it meets the perpendicular at D.
3. Construct the perpendicular to AB at B in the same way, and the circle centred at B with radius AB meets it at C (same side as D).
4. ABCD has AB = BC = CD = DA and right angles at A and B.

Why is it a square and not just "a quadrilateral with two right angles and some equal sides"? AD = AB and BC = AB by circles. AD ∥ BC because both are perpendicular to AB. A quadrilateral with one pair of sides both parallel and congruent is a parallelogram, so DC ∥ AB and DC = AB. All four sides equal AB; the angles at A and B are right, and in a parallelogram the other two are then also right. (Unit 2 proves the parallelogram facts; for now follow the chain.)

**Square inscribed in a circle.** Draw any diameter AC (a line through the centre O). Construct the perpendicular bisector of AC; it is a second diameter BD through O. The four points A, B, C, D in order form a square: the diagonals are congruent (both diameters), bisect each other (at O) and are perpendicular, which forces a square.

```
Figure description: circle centre O. Diameters AC (horizontal) and BD (vertical) are perpendicular.
Square ABCD has vertices on the circle, side length r√2.

          B
       .--+--.
     /    |    \
    A-----O-----C
     \    |    /
       `--+--'
          D
```

**Worked example 4.** A square is inscribed in a circle of radius 6. Find its side. Triangle AOB has OA = OB = 6 and a right angle at O, so AB = √(6² + 6²) = √72 = 6√2 ≈ 8.49. The square's perimeter is 24√2 ≈ 33.9 and its area is (6√2)² = 72, which is also half the square of the diameter: 12² ÷ 2 = 72.

**Try it 4.1** A square is inscribed in a circle of radius r. Show that its area is 2r². *(Answer: side = r√2, area = (r√2)² = 2r².)*

**Try it 4.2** A square has side 10. What is the radius of the circle through its four vertices? *(Answer: the diagonal is 10√2, so the radius is 5√2 ≈ 7.07.)*

## 5. Constructions in dynamic geometry software

Software such as GeoGebra gives you the same two tools (circle through a point, line through two points) plus "intersect". The difference from paper is that you can **drag** the starting points afterwards.

- If you built the midpoint M of AB by the perpendicular bisector construction, dragging A moves M so that it is still the midpoint.
- If you placed a point by eye where the midpoint looked like it should be, dragging A leaves it behind.

So "does it survive dragging?" is the software test for "is it a construction?". The relationships that survive are exactly the ones your justification proved: equal radii, intersections, lines through points.

A few things the software does for you that you should still be able to explain: the "perpendicular line" tool is the two-circle construction of section 1; the "angle bisector" tool is section 2; the "parallel line" tool is section 3. If asked to construct with only circles and lines, do not use the shortcut tools.

**Worked example 5.** In software, a student draws segment AB, then places point C so that triangle ABC looks equilateral, then measures the sides and adjusts C until all three read 5.00. Is this a construction? No. Dragging A changes AB but not BC or CA. A construction would define C as the intersection of the circle centred at A through B and the circle centred at B through A; then dragging A keeps the triangle equilateral.

## Common mistakes

- **Bisecting an angle with circles of different radii at X and Y.** The crossing point is no longer on the axis of the kite.
- **Forgetting that the perpendicular-through-a-point construction needs two crossings on ℓ.** If the circle at P is too small to reach ℓ (point off the line), or you draw only one arc, there is no segment XY to bisect.
- **Saying "parallel because they look parallel".** The justification is "both perpendicular to the same line" or "opposite sides of a rhombus".
- **Building a square with only one perpendicular.** You need right angles at both A and B, or one right angle plus an argument that the figure is a rhombus with a right angle.
- **In software, using measurement to adjust a figure** and calling it a construction.

## Where this goes next

Week 3 ends the construction section with an applied problem (Speedy Delivery: which point is closest, using perpendicular bisectors) and starts rigid transformations. Reflections are defined using the perpendicular bisector: the reflection of P across line m is the point P′ such that m is the perpendicular bisector of PP′. Everything you constructed this week will be the "why" behind a transformation argument.

## Self-check

1. Point P is 8 units from line ℓ. A circle centred at P with radius 10 crosses ℓ at X and Y. Find XY.
2. ∠AVB measures 124°. You bisect it, then bisect one of the halves. What is the smallest angle in the figure?
3. Explain why the double-perpendicular construction produces a line parallel to ℓ.
4. A square is inscribed in a circle of diameter 10. Find its side and its area.
5. In dynamic geometry software, how do you test whether a figure is a true construction?

*Answers: (1) FX = √(100 − 64) = 6, so XY = 12. (2) 124 → 62 → 31°. (3) ℓ and the new line are both perpendicular to the first perpendicular m; two lines perpendicular to the same line cannot meet, so they are parallel. (4) radius 5, side 5√2 ≈ 7.07, area 50. (5) drag a starting point; every relationship you built should survive.*

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Geometry, Unit 1, Lessons 5–8, https://im.kendallhunt.com/HS/teachers/2/1/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
