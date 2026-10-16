# Week 03 · Closest Points, Rigid Motions, Reflections and Translations

**Lessons:** 1.9 Speedy Delivery · 1.10 Rigid Transformations · 1.11 Defining Reflections · 1.12 Defining Translations
**Practices:** MP4 (model with mathematics), MP6 (precision), MP7 (structure)
**Built from:** IM Geometry, Unit 1, Lessons 9–12, in our own words
**Spiral:** the perpendicular bisector (week 1) is the star again: it divides the plane into "closer to A" and "closer to B", and it is the definition of a reflection. Parallel lines and rhombuses (week 2) are what translations produce.

## What you need to be able to do

- Use perpendicular bisectors to split a region into the set of points closest to each of several given points, and read off which point a location is closest to.
- Define a rigid transformation and name the three basic kinds; state what every rigid transformation preserves.
- Define a reflection precisely in terms of a perpendicular bisector; construct the image of a point and a polygon across a line; identify the fixed points.
- Define a translation precisely in terms of a directed line segment; construct the image of a point by building a parallelogram; explain why a translation has no fixed points (unless it is the identity).
- Write transformation notation: P → P′, A′B′C′ is the image of ABC.

## Key terms

| Term | Meaning |
|---|---|
| Transformation | A rule that assigns to every point of the plane exactly one image point. |
| Rigid transformation (rigid motion) | A transformation that preserves distances: the distance between any two image points equals the distance between the original points. As a consequence it also preserves angle measures, collinearity and betweenness. |
| Image, pre-image | The result of a transformation (P′) and the point you started with (P). |
| Reflection across line m | The transformation that fixes every point of m and sends every other point P to the point P′ such that m is the perpendicular bisector of PP′. |
| Line of reflection | The line m; also called the mirror line. |
| Translation by directed segment AB | The transformation that sends every point P to the point P′ such that PP′ is parallel to AB, has the same length as AB, and points the same way. Equivalently, ABP′P is a parallelogram (or P, P′, A, B are collinear with PP′ = AB in the same direction). |
| Directed line segment (vector) | A segment with a chosen direction, drawn with an arrowhead: from A to B. |
| Fixed point | A point whose image is itself. |
| Identity | The transformation that sends every point to itself. |
| Closest-point region | The set of locations closer to one given point than to any other given point. Its boundaries are pieces of perpendicular bisectors. |

## 1. Who delivers here? Perpendicular bisectors as borders

Three pizza shops are at A, B and C. Every house should be served by the nearest shop. Where are the borders?

The perpendicular bisector of AB is the set of points equidistant from A and B. On A's side of it every point is closer to A; on B's side, closer to B. Draw all three bisectors (AB, BC, CA). Each shop's territory is the region bounded by the bisectors between it and the other two. The three bisectors meet at a single point, the one location equidistant from all three shops (you will meet it again as the circumcentre in Unit 7).

```
Figure description: A at lower left, B at lower right, C at top centre.
Three perpendicular bisectors meet at one point O inside the triangle.
Region near A is bounded by the bisectors of AB and AC, and so on.

            C
           / \
      \   /   \   /
       \ /  O  \ /
        X-------X
       / \     / \
      A   \   /   B
```

**Worked example 1.** A = (0, 0), B = (8, 0), C = (0, 6), in km. A house is at H = (3, 2). Which shop is closest? Compute distances: HA = √(9 + 4) = √13 ≈ 3.61; HB = √(25 + 4) = √29 ≈ 5.39; HC = √(9 + 16) = √25 = 5. So A, and H is on A's side of both bisectors. Check with the bisector of AB, which is the vertical line x = 4: H has x = 3 < 4, so it is on A's side. The bisector of AC is y = 3: H has y = 2 < 3, A's side again.

**Worked example 2.** Where is the point equidistant from A, B and C in example 1? It lies on x = 4 and on y = 3, so it is (4, 3). Check: distance to A is √(16 + 9) = 5, to B is √(16 + 9) = 5, to C is √(16 + 9) = 5. It is the midpoint of BC, which happens because the angle at A is a right angle (another Unit 7 fact).

**Try it 1.1** With the same shops, which is closest to (6, 5)? *(Answer: distances √61 ≈ 7.81, √29 ≈ 5.39, √37 ≈ 6.08 to A, B, C; shop B.)*

## 2. Rigid transformations

A **transformation** moves every point of the plane to an image point. A **rigid transformation** is one that does not stretch, shrink or distort: for any two points P and Q, the distance P′Q′ equals the distance PQ. Because distances are preserved, so is everything built from distances: angle measures, the straightness of lines, the parallelism of lines, areas, and the order of points along a line.

The three basic rigid transformations are **reflections** (flip across a line), **translations** (slide by a directed segment) and **rotations** (turn about a point by an angle; week 4). A sequence of rigid transformations is also rigid.

Notation: the image of P is P′ ("P prime"). The image of triangle ABC is triangle A′B′C′, with A → A′ and so on. Order matters: writing A′B′C′ tells you which vertex came from which.

**What is not rigid?** A dilation (enlargement) preserves angles but doubles distances; a horizontal stretch changes angles and distances. If any distance changes, the transformation is not rigid.

**Worked example 3.** Triangle ABC has AB = 5, BC = 7, CA = 9, and ∠B = 95°. A rigid transformation sends it to A′B′C′. State A′C′ and ∠B′. A′C′ = CA = 9 and ∠B′ = 95°, because rigid transformations preserve lengths and angles. You do not need to know which transformation it was.

**Try it 2.1** A transformation sends every point (x, y) to (2x, y). Is it rigid? *(Answer: no; the points (0, 0) and (1, 0) are 1 apart but their images (0, 0) and (2, 0) are 2 apart.)*

## 3. Reflections

**Definition.** The reflection across line m sends each point P on m to itself, and each point P not on m to the point P′ such that **m is the perpendicular bisector of segment PP′**.

That one sentence tells you how to construct P′: draw the perpendicular from P to m (week 2), find the foot F, and extend the same distance beyond F to P′, so PF = FP′ and PP′ ⊥ m. With a compass: draw a circle centred at P crossing m at X and Y; equal circles centred at X and Y with that radius cross at P and at P′.

```
Figure description: mirror line m vertical. P to the left at distance 3 from m.
F on m is the foot. P′ to the right at distance 3, with PP′ ⊥ m and PF = FP′.

     P ------- F ------- P′
                |
                m
```

**Properties.**

- Every point of m is a fixed point; no other point is fixed.
- Reflecting twice across the same line brings every point back: a reflection is its own inverse.
- A reflection preserves distances and angle measures, but it reverses **orientation**: if A, B, C read clockwise, then A′, B′, C′ read counter-clockwise.
- If P is on m, its image is P; if a segment crosses m, its image crosses m at the same point.

**Worked example 4 — reflecting a triangle.** m is the vertical line x = 2. A = (0, 1), B = (1, 4), C = (−1, 3). Reflecting across x = 2 keeps y and sends x to 4 − x (because the midpoint of x and 4 − x is 2). So A′ = (4, 1), B′ = (3, 4), C′ = (5, 3). Check with A: the midpoint of AA′ is (2, 1), on m, and AA′ is horizontal, perpendicular to the vertical m. ✓

**Worked example 5 — finding the mirror line.** P = (1, 5) reflects to P′ = (7, 5). The mirror is the perpendicular bisector of PP′: the midpoint is (4, 5) and PP′ is horizontal, so m is the vertical line x = 4.

**Try it 3.1** Reflect Q = (3, −2) across the x-axis, then across the y-axis. *(Answer: (3, 2), then (−3, 2).)*

**Try it 3.2** A point P is 4 cm from line m. How far is P from its reflection P′? *(Answer: 8 cm; PF = FP′ = 4.)*

## 4. Translations

**Definition.** The translation by the directed line segment from A to B sends every point P to the point P′ such that segment PP′ is parallel to AB, PP′ = AB, and P′ is on the same side of P as B is of A. In other words, the arrows PP′ and AB are the "same arrow", just drawn from a different starting point.

Construction: to find P′, build the parallelogram ABP′P: construct the line through P parallel to AB (week 2), then mark P′ on it with PP′ = AB on the correct side using the compass. If P happens to lie on line AB, just copy the length AB along the line in the direction from A to B.

```
Figure description: arrow from A to B pointing right and slightly up.
P below the arrow. P′ is placed so that ABP′P is a parallelogram:
PP′ ∥ AB and PP′ = AB.

      A ------> B
      P ------> P′
```

**Properties.**

- A translation has no fixed points (unless A = B, the identity).
- Every point moves the same distance in the same direction: all segments PP′ are parallel and congruent.
- A translation preserves orientation (clockwise stays clockwise) and sends every line to a parallel line (or to itself, if the line is parallel to AB).
- The translation by B→A undoes the translation by A→B.

**Worked example 6.** Translate triangle DEF, D = (1, 1), E = (4, 1), F = (2, 3), by the directed segment from A = (0, 0) to B = (3, −2). Every point moves 3 right and 2 down: D′ = (4, −1), E′ = (7, −1), F′ = (5, 1). Check that D′E′ = DE = 3 ✓ and that DD′, EE′, FF′ are all the arrow (3, −2) ✓.

**Worked example 7 — identifying a translation.** A translation sends (2, 7) to (−1, 9). What does it send (5, 5) to? The arrow is (−3, +2), so (5, 5) → (2, 7). Notice (2, 7) was the first pre-image; the same arrow applied again sends it on to (−1, 9).

**Try it 4.1** A translation by the arrow from A = (1, 2) to B = (4, 6) is applied to P = (10, 10). Find P′ and the length PP′. *(Answer: P′ = (13, 14); PP′ = AB = √(9 + 16) = 5.)*

**Try it 4.2** Explain why a translation cannot have a fixed point unless it is the identity. *(Answer: a fixed point P would need PP′ = 0, but PP′ = AB > 0.)*

## Common mistakes

- **Drawing a reflection "across" a line at some slant.** PP′ must be perpendicular to m, and F must be the midpoint. Both conditions, every time.
- **Reflecting by sliding the figure over the line.** The figure flips; a vertex closest to m stays closest to m.
- **Translating by the arrow's length only.** Direction is part of the definition. "Translate by 5 units" is not a translation until a direction is given.
- **Mixing up which bisector is which** in a closest-point problem. The border between A's and B's region is the bisector of AB, not a line through A or B.
- **Writing A′B′C′ in the wrong order.** The image vertex labels must correspond: A′ is the image of A.

## Where this goes next

Week 4 defines rotations (centre, angle, direction) and uses all three transformations to describe the symmetry of a figure: a figure has reflection symmetry if some reflection carries it onto itself, and rotation symmetry if some rotation (less than a full turn) does. Week 5 uses sequences of rigid transformations to show two figures are congruent, and week 6 proves the angle facts (vertical angles, parallel lines, the 180° triangle) with transformations as the engine.

## Self-check

1. Points A = (0, 0) and B = (6, 0). Which region is the point (2, 9) in, and what line is the border?
2. Define a rigid transformation in one sentence, then name three things it preserves besides distance.
3. Reflect T = (−2, 5) across the line y = 1.
4. A translation sends (0, 0) to (4, −3). Where does it send (−4, 3)? How far does every point move?
5. A reflection sends P to P′. Describe where the mirror line is, using the language of this week.

*Answers: (1) closer to A, since 2 < 3; the border is the perpendicular bisector x = 3. (2) a transformation that preserves the distance between every pair of points; it also preserves angle measure, collinearity and area (or parallelism, betweenness). (3) (−2, −3): the distance from y = 1 is 4, so go 4 below. (4) (0, 0); every point moves √(16 + 9) = 5. (5) the mirror is the perpendicular bisector of PP′: through the midpoint of PP′, at right angles to it.*

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Geometry, Unit 1, Lessons 9–12, https://im.kendallhunt.com/HS/teachers/2/1/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
