# Week 04 · Rotations and Symmetry

**Lessons:** 1.13 Incorporating Rotations · 1.14 Defining Rotations · 1.15 Symmetry · 1.16 More Symmetry
**Practices:** MP6 (precision), MP7 (structure), MP3 (arguments)
**Built from:** IM Geometry, Unit 1, Lessons 13–16, in our own words
**Spiral:** rotations are built with circles (week 1) and copied angles; symmetry arguments reuse the reflection definition (week 3) and the perpendicular bisector. Rhombuses and kites (weeks 1–2) return as the figures whose symmetry we analyse.

## What you need to be able to do

- Define a rotation by its centre, angle and direction; construct the image of a point and of a polygon under a rotation.
- Recognise that a 180° rotation sends P to the point P′ with the centre as the midpoint of PP′, and use that to reason about parallelograms.
- Decide which rigid transformation (reflection, translation, rotation) takes one figure onto another, and justify it.
- Define reflection symmetry and rotation symmetry; find all lines of symmetry and all angles of rotation symmetry of triangles, quadrilaterals, regular polygons and circles.
- Use a figure's symmetry to deduce facts about its sides, angles and diagonals.

## Key terms

| Term | Meaning |
|---|---|
| Rotation about O by θ | The transformation that fixes O and sends every other point P to the point P′ with OP′ = OP and ∠POP′ = θ, turning counter-clockwise for a positive angle (clockwise if stated). |
| Centre of rotation | The fixed point O. |
| Angle of rotation | The measure θ; the same for every point of the figure. |
| Clockwise / counter-clockwise | The direction of turning. Counter-clockwise is the default positive direction. |
| Reflection symmetry (line symmetry) | A figure has it if there is a line m such that reflecting across m carries the figure onto itself. The line is a **line of symmetry**. |
| Rotation symmetry | A figure has it if some rotation of less than 360° about some point carries the figure onto itself. |
| Order of rotation symmetry | The number of positions in a full turn in which the figure matches itself, including the starting position. A regular n-gon has order n and smallest angle 360°/n. |
| Point symmetry | Rotation symmetry of 180°. |
| Regular polygon | All sides congruent and all angles congruent. It has n lines of symmetry and rotation symmetry of order n. |

## 1. Defining a rotation

A rotation needs three pieces of information: a **centre** O, an **angle** θ, and a **direction**. The image of P is the point P′ on the circle centred at O through P such that ∠POP′ = θ measured in the given direction.

```
Figure description: centre O. P to the right of O at distance 4.
Rotation by 90° counter-clockwise sends P to P′ directly above O, also at distance 4.
Rotation by 180° sends P to P″ directly left of O at distance 4.

          P′
          |
    P″----O----P
```

**Construction of P′ for a given angle.** 1. Draw the circle centred at O through P. 2. Copy the angle θ at O with one side along ray OP (copying an angle uses two circles and the compass: the same kite idea as bisecting). 3. The other side of the copied angle meets the circle at P′.

**Rotation by 180°.** P′ is on the circle through P and on the ray opposite OP, so P, O, P′ are collinear and O is the midpoint of PP′. This case needs no angle copying: draw line PO, and the circle centred at O through P meets it again at P′. A 180° rotation is the same whether you turn clockwise or counter-clockwise.

**Properties.**

- A rotation is rigid: it preserves distances and angles, and it preserves orientation (clockwise stays clockwise).
- The only fixed point is the centre (unless the angle is a multiple of 360°).
- Every point moves along a circle centred at O; points farther from O travel farther, but all turn through the same angle.
- A rotation by θ followed by a rotation by φ about the same centre is a rotation by θ + φ.
- Rotation by θ is undone by rotation by −θ (or by 360° − θ in the same direction).

**Worked example 1.** Rotate A = (3, 1) by 90° counter-clockwise about the origin. On a grid, a 90° counter-clockwise turn sends (x, y) to (−y, x), so A′ = (−1, 3). Check: OA = √10 and OA′ = √10 ✓; the segments OA and OA′ have "slopes" 1/3 and −3, which multiply to −1, so the angle is 90° ✓.

**Worked example 2.** Rotate B = (5, −2) by 180° about C = (1, 1). C must be the midpoint of BB′: B′ = (2·1 − 5, 2·1 − (−2)) = (−3, 4). Check the midpoint: ((5 + (−3))/2, (−2 + 4)/2) = (1, 1) ✓.

**Try it 1.1** Rotate (2, 6) by 90° clockwise about the origin. *(Answer: clockwise sends (x, y) to (y, −x): (6, −2).)*

**Try it 1.2** Rotate (4, 4) by 180° about the origin, then by 180° again. *(Answer: (−4, −4), then back to (4, 4); two half-turns make a full turn.)*

## 2. Which transformation was it?

Given a figure and its image, decide:

- Does orientation flip? If yes, a reflection (or a reflection combined with something; week 5). The mirror is the perpendicular bisector of any segment PP′.
- Does every vertex move the same distance in the same direction? Then a translation by that arrow.
- Otherwise, if orientation is kept and the figure has turned, a rotation. The centre is where the perpendicular bisectors of PP′ and QQ′ meet, because the centre is equidistant from P and P′ and from Q and Q′.

**Worked example 3.** Triangle with vertices (1, 1), (4, 1), (1, 3) is sent to (−1, 1), (−1, 4), (−3, 1). Orientation: original goes counter-clockwise (right, then up); image (−1, 1) → (−1, 4) → (−3, 1) also goes counter-clockwise. Not a translation: (1, 1) moved by (−2, 0) but (4, 1) moved by (−5, 3). So a rotation. The vertex (1, 1) → (−1, 1): perpendicular bisector is x = 0. The vertex (4, 1) → (−1, 4): midpoint (1.5, 2.5), the segment has direction (−5, 3), so the bisector has direction (3, 5): the line through (1.5, 2.5) with slope 5/3. At x = 0: y = 2.5 − 1.5 × 5/3 = 0. Centre (0, 0). Angle: (1, 1) to (−1, 1) is a 90° counter-clockwise turn about the origin ((x, y) → (−y, x) gives (−1, 1) ✓). So: rotation by 90° counter-clockwise about the origin.

**Try it 2.1** Segment from (0, 0) to (2, 0) is sent to the segment from (0, 0) to (0, −2). Name a rotation that does it. *(Answer: 90° clockwise about the origin, or equivalently 270° counter-clockwise.)*

## 3. Reflection symmetry

A figure has **reflection symmetry** if some reflection carries the figure onto itself. The mirror is a line of symmetry: fold along it and the two halves match.

| Figure | Lines of symmetry |
|---|---|
| Scalene triangle | 0 |
| Isosceles triangle (not equilateral) | 1: through the apex and the midpoint of the base |
| Equilateral triangle | 3: each through a vertex and the midpoint of the opposite side |
| Parallelogram (not a rhombus or rectangle) | 0 |
| Rectangle (not a square) | 2: through the midpoints of opposite sides |
| Rhombus (not a square) | 2: the diagonals |
| Square | 4: two diagonals and two midpoint lines |
| Kite (not a rhombus) | 1: the diagonal through the vertices where the equal sides meet |
| Isosceles trapezoid | 1: through the midpoints of the two parallel sides |
| Regular n-gon | n |
| Circle | infinitely many: every line through the centre |

**Why a rectangle's diagonal is not a line of symmetry.** Reflecting across a diagonal AC of rectangle ABCD (with AB = 6, BC = 4) sends B to a point B′ with AB′ = 6 and CB′ = 4, which is not D (AD = 4, CD = 6). The figure does not land on itself. A rhombus's diagonal works precisely because all four sides are equal.

**Worked example 4 — what symmetry tells you.** Isosceles triangle ABC with AB = AC and line of symmetry through A and the midpoint M of BC. Reflecting across AM swaps B and C and fixes A and M. So ∠B ↔ ∠C, giving ∠B = ∠C (base angles are congruent); ∠BAM ↔ ∠CAM, so AM bisects the apex angle; and ∠AMB ↔ ∠AMC, two congruent angles making a straight angle, so each is 90°: AM ⊥ BC. One reflection, three theorems.

**Try it 3.1** How many lines of symmetry does a regular octagon have, and how do they run? *(Answer: 8; four through opposite vertices and four through midpoints of opposite sides.)*

## 4. Rotation symmetry

A figure has **rotation symmetry** if some rotation by an angle strictly between 0° and 360° carries it onto itself. The centre is usually the "middle" of the figure (the intersection of the diagonals, or the centre of the circumscribed circle).

| Figure | Smallest angle | Order |
|---|---|---|
| Equilateral triangle | 120° | 3 |
| Square | 90° | 4 |
| Rectangle, rhombus, parallelogram | 180° | 2 |
| Regular n-gon | 360°/n | n |
| Isosceles trapezoid, kite, isosceles triangle | none | 1 |
| Circle | any angle | infinite |

**Parallelograms and 180°.** Parallelogram ABCD with diagonals meeting at M. The 180° rotation about M sends A to C and B to D (M is the midpoint of both diagonals, which you can take as the defining property or prove in Unit 2). So the rotation sends side AB to side CD and side BC to side DA. Consequences: AB = CD and BC = DA (opposite sides congruent); ∠A = ∠C and ∠B = ∠D (opposite angles congruent). The parallelogram has point symmetry but, in general, no line symmetry.

**Worked example 5.** Regular hexagon with centre O. Which rotations about O map it onto itself? Multiples of 360°/6 = 60°: 60°, 120°, 180°, 240°, 300° (and 360°, the identity). Order 6. Lines of symmetry: 6 (three through opposite vertices, three through midpoints of opposite sides).

**Worked example 6.** A figure has rotation symmetry of order 5 and no line of symmetry. What is the smallest angle of rotation symmetry? 360° ÷ 5 = 72°. (A pinwheel with five identical curved arms is an example: rotations work, reflections do not because the arms curve one way.)

**Try it 4.1** A rhombus is rotated 90° about the intersection of its diagonals. Does it land on itself? *(Answer: only if it is a square. A non-square rhombus has one diagonal longer than the other, and a 90° turn would swap them.)*

**Try it 4.2** Name a figure with exactly one line of symmetry and no rotation symmetry. *(Answer: an isosceles triangle, a kite or an isosceles trapezoid.)*

## Common mistakes

- **Forgetting the direction of a rotation.** "Rotate 90° about O" is ambiguous; say counter-clockwise or clockwise. Only 180° is direction-free.
- **Rotating about the wrong centre.** The centre is fixed; if a vertex of the figure is the centre, that vertex does not move.
- **Counting a rectangle's diagonals as lines of symmetry.** They are not, unless it is a square.
- **Saying a parallelogram has no symmetry.** It has 180° rotation symmetry about the intersection of its diagonals.
- **Counting order of rotation symmetry without the identity.** A square has order 4 (90°, 180°, 270°, 360°), not 3.

## Where this goes next

Week 5 puts the three rigid transformations to work: a sequence of transformations carries one figure exactly onto another, which is the transformation definition of congruence. You will practise point-by-point descriptions ("translate by A→A′, then rotate about A′ so that B lands on B′, then reflect across A′B′ if necessary"), the pattern behind every congruence proof in Unit 2. Week 6 uses rotations by 180° to prove that alternate interior angles are congruent and that the angles of a triangle sum to 180°.

## Self-check

1. Rotate (−2, 5) by 90° counter-clockwise about the origin, and by 180° about the origin.
2. A rotation about C = (3, −1) by 180° sends P to (7, 4). Find P.
3. List the lines of symmetry of a rhombus and explain why the line through the midpoints of two opposite sides is not one (unless it is a square).
4. What is the order of rotation symmetry of a regular decagon, and what is its smallest angle?
5. Parallelogram ABCD has diagonals meeting at M. Describe the rotation that proves AB = CD.

*Answers: (1) (−5, −2) and (2, −5). (2) C is the midpoint of PP′, so P = (2·3 − 7, 2·(−1) − 4) = (−1, −6). (3) the two diagonals; the midpoint line is perpendicular to two sides only in a rectangle, so in a non-square rhombus reflecting across it sends a vertex to a point off the figure. (4) order 10, smallest angle 36°. (5) rotation by 180° about M: A → C and B → D, so segment AB → segment CD and the rotation preserves length.*

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Geometry, Unit 1, Lessons 13–16, https://im.kendallhunt.com/HS/teachers/2/1/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
