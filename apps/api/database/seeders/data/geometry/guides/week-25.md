# Week 25 · Coordinate Proof, Weighted Averages and Lines in Triangles

**Lessons:** 6.14 Coordinate Proof · 6.15 Weighted Averages · 6.16 Weighted Averages in a Triangle · 6.17 Lines in Triangles
**Practices:** MP2 (reason abstractly and quantitatively), MP3 (construct arguments), MP7 (use structure)
**Built from:** IM Geometry, Unit 6, Lessons 14–17, in our own words
**Spiral:** everything from weeks 22–24 is a tool here: the distance and midpoint formulas (week 22), slopes and the parallel and perpendicular rules (week 24), and systems of equations (week 24). The theorems being proved are old friends: the midsegment of a triangle (week 13), parallelogram diagonals (week 10), the Perpendicular Bisector Theorem (week 8) and the concurrency of perpendicular bisectors (week 9).

## What you need to be able to do

- Place a figure on the coordinate plane so that the algebra is easy, use letters for coordinates when the proof must cover every case, and prove a theorem with distances, slopes and midpoints.
- Find the point that is a given fraction of the way from A to B, or that divides AB in a given ratio, as a weighted average of the endpoints.
- Show that the three medians of a triangle meet at one point, the centroid, two thirds of the way along each median, and compute it as the average of the vertices.
- Write equations for the altitudes and perpendicular bisectors of a triangle with given coordinates, find where they meet (the orthocentre and the circumcentre), and verify that the circumcentre is equidistant from the vertices.

## Key terms

| Term | Meaning |
|---|---|
| Coordinate proof | A proof that places a figure on the plane and reasons with coordinates, distances, slopes and midpoints. |
| General coordinates | Letters instead of numbers, such as (2a, 2b), so the argument works for every figure of that kind. |
| Weighted average of A and B | (1 − t)A + tB, the point a fraction t of the way from A to B. t = 1/2 is the midpoint. |
| Partition in the ratio m : n | The point P on AB with AP : PB = m : n; it is t = m/(m + n) of the way from A to B. |
| Median | A segment from a vertex to the midpoint of the opposite side. |
| Centroid | The common point of the three medians, 2/3 of the way from each vertex to the opposite midpoint; the average of the vertices. |
| Altitude; orthocentre | The perpendicular from a vertex to the opposite side's line; where the three altitudes meet. |
| Circumcentre | Where the three perpendicular bisectors meet; equidistant from the three vertices. |

## 1. Coordinate proof (6.14)

A coordinate proof has three parts: **place** the figure well, **compute** with coordinates, **conclude** with a geometric statement.

**Placing the figure.** Put a vertex at the origin and a side along an axis. A rectangle becomes (0, 0), (a, 0), (a, b), (0, b). An isosceles triangle with apex on the y-axis becomes (−a, 0), (a, 0), (0, b). Using even coordinates such as (2a, 2b) keeps midpoints free of fractions.

**Worked example 1 — the diagonals of a rectangle are congruent.** Rectangle with vertices O = (0, 0), P = (a, 0), Q = (a, b), R = (0, b). Diagonal OQ has length √(a² + b²). Diagonal PR has length √((0 − a)² + (b − 0)²) = √(a² + b²). Equal, for every a and b. (Week 10 proved this with symmetry; coordinates give it in one line.)

**Worked example 2 — the midsegment theorem.** Triangle with vertices A = (0, 0), B = (2a, 0), C = (2b, 2c). Midpoint of AC: M = (b, c). Midpoint of BC: N = (a + b, c). Slope of MN = 0, slope of AB = 0: MN ∥ AB. Length MN = (a + b) − b = a; length AB = 2a. So MN is parallel to the third side and half as long, for every triangle.

**Worked example 3 — a specific figure.** Show that the quadrilateral with vertices (1, 2), (5, 4), (7, 8), (3, 6) is a parallelogram. Slopes of the sides: (4 − 2)/(5 − 1) = 1/2; (8 − 4)/(7 − 5) = 2; (6 − 8)/(3 − 7) = 1/2; (2 − 6)/(1 − 3) = 2. Both pairs of opposite sides are parallel. Alternatively, both diagonals have midpoint (4, 5), so they bisect each other.

**Worked example 4 — the diagonals of a parallelogram bisect each other.** Parallelogram O = (0, 0), A = (2a, 0), C = (2b, 2c), and then B = (2a + 2b, 2c) (so that OA and CB are both horizontal with length 2a). Midpoint of OB: (a + b, c). Midpoint of AC: ((2a + 2b)/2, (0 + 2c)/2) = (a + b, c). The same point, so the diagonals bisect each other.

**Worked example 5 — the midpoints of any quadrilateral form a parallelogram.** Quadrilateral with vertices A, B, C, D. The midpoints of AB and BC are the endpoints of a midsegment of triangle ABC, parallel to AC and half its length; the midpoints of AD and DC give a midsegment of triangle ADC, also parallel to AC and half its length. Two opposite sides of the midpoint quadrilateral are parallel and congruent, so it is a parallelogram (week 10's converse B).

**Try it 1.1** Triangle with vertices (0, 0), (6, 0), (0, 8). Show that the midpoint of the hypotenuse is equidistant from all three vertices. *(Answer: midpoint (3, 4); distances to (0, 0), (6, 0), (0, 8) are all 5.)*

## 2. Weighted averages (6.15)

To get from A = (x₁, y₁) to B = (x₂, y₂), add the vector (x₂ − x₁, y₂ − y₁). To go only a fraction t of the way, add t times that vector:

**P = A + t(B − A) = ((1 − t)x₁ + t x₂, (1 − t)y₁ + t y₂).**

This is a weighted average: weight 1 − t on A, weight t on B. t = 1/2 gives the midpoint (equal weights). t = 1/3 gives the point one third of the way from A: it is closer to A, so A gets the larger weight 2/3.

**Worked example 6.** The point one third of the way from A = (1, 2) to B = (7, 8). B − A = (6, 6); one third of it is (2, 2); P = (3, 4). As a weighted average: (2/3)(1, 2) + (1/3)(7, 8) = (2/3 + 7/3, 4/3 + 8/3) = (3, 4) ✓.

**Worked example 7 — a ratio.** Find P on AB with AP : PB = 3 : 1, where A = (−2, 5) and B = (6, 1). P is 3/(3 + 1) = 3/4 of the way from A. B − A = (8, −4); 3/4 of it is (6, −3); P = (4, 2). Check: AP = √(36 + 9) = √45 = 3√5 and PB = √(4 + 1) = √5: ratio 3 : 1 ✓.

**Worked example 8 — going backwards.** P = (5, 3) lies on the segment from A = (2, 0) to B = (8, 6). What fraction of the way is it? B − A = (6, 6), P − A = (3, 3) = 1/2 of (6, 6): the midpoint, t = 1/2.

**Worked example 9 — beyond the segment.** t = 1.5 from A = (0, 0) toward B = (2, 4) gives (3, 6), on the line AB but past B. t = −1 gives (−2, −4), past A. The formula works for every t; the segment is 0 ≤ t ≤ 1.

**Try it 2.1** Find the point 2/5 of the way from (0, 10) to (10, 0). *(Answer: (4, 6).)*

**Try it 2.2** Find P on AB with AP : PB = 1 : 4 for A = (3, 3), B = (13, −2). *(Answer: t = 1/5; B − A = (10, −5); P = (5, 2).)*

## 3. Weighted averages in a triangle: the centroid (6.16)

A **median** joins a vertex to the midpoint of the opposite side. Take triangle A = (0, 0), B = (6, 0), C = (3, 9).

- Midpoint of BC: M₁ = (4.5, 4.5). The point 2/3 of the way from A to M₁: (3, 3).
- Midpoint of AC: M₂ = (1.5, 4.5). The point 2/3 of the way from B to M₂: (6, 0) + 2/3 · (−4.5, 4.5) = (3, 3).
- Midpoint of AB: M₃ = (3, 0). The point 2/3 of the way from C to M₃: (3, 9) + 2/3 · (0, −9) = (3, 3).

All three medians pass through (3, 3): the **centroid**. And (3, 3) is the average of the three vertices: ((0 + 6 + 3)/3, (0 + 0 + 9)/3).

**Why it always works.** With vertices A, B, C, the midpoint of BC is (B + C)/2, and the point 2/3 of the way from A to it is (1/3)A + (2/3)(B + C)/2 = (A + B + C)/3. The same computation from B or from C gives the same point, because A + B + C is the same sum in any order. So every median passes through (A + B + C)/3, two thirds of the way from its vertex. This is a complete proof, not a check on one triangle.

```
Figure description: triangle ABC with A = (0, 0), B = (6, 0), C = (3, 9).
The three medians meet at G = (3, 3). On the median from C to (3, 0),
CG = 6 and G to the midpoint is 3: the 2 : 1 split.

            C (3, 9)
            |\
            | \
            |  G (3, 3)
            |   \
     A ─────┴──────── B
   (0, 0)  (3, 0)   (6, 0)
```

**Worked example 10.** Centroid of the triangle with vertices (−2, 1), (4, 7), (7, −2): ((−2 + 4 + 7)/3, (1 + 7 − 2)/3) = (3, 2).

**Worked example 11 — the centroid as a balance point.** Why 2 : 1? Each median splits the triangle into two triangles of equal area (same height, bases of equal length), so the triangle balances along every median; the point where it balances in every direction is where they meet. Physically, a cardboard triangle balances on a pin at its centroid.

**Try it 3.1** Find the centroid of the triangle with vertices (1, 1), (7, 1), (4, 10). *(Answer: (4, 4).)*

**Try it 3.2** Triangle A = (0, 0), B = (8, 0), C = (2, 6). Find the midpoint of BC and the point 2/3 of the way from A to it. *(Answer: midpoint (5, 3); point (10/3, 2), which equals (A + B + C)/3.)*

## 4. Lines in triangles: altitudes and perpendicular bisectors (6.17)

Use the triangle A = (0, 0), B = (8, 0), C = (2, 6) throughout.

**Perpendicular bisectors meet at the circumcentre.**
- AB is horizontal with midpoint (4, 0): its perpendicular bisector is x = 4.
- AC has midpoint (1, 3) and slope 3; the perpendicular bisector has slope −1/3: y − 3 = −1/3 (x − 1).
- Meet: at x = 4, y = 3 − 1 = 2. Circumcentre S = (4, 2).
- Check it is on the third bisector: BC has midpoint (5, 3) and slope −1, so the bisector is y − 3 = 1 · (x − 5), y = x − 2; at x = 4, y = 2 ✓.
- Equidistant from the vertices: SA = √(16 + 4) = √20, SB = √(16 + 4) = √20, SC = √(4 + 16) = √20. So the circle (x − 4)² + (y − 2)² = 20 passes through all three vertices.

**Altitudes meet at the orthocentre.**
- From C, perpendicular to AB (horizontal): the vertical line x = 2.
- From A, perpendicular to BC (slope −1): slope 1 through the origin, y = x.
- Meet: H = (2, 2).
- Check the third: from B, perpendicular to AC (slope 3): y = −1/3 (x − 8); at x = 2, y = 2 ✓.

**The three centres line up.** H = (2, 2), the centroid G = (10/3, 2) and S = (4, 2) all lie on y = 2, and G is 2/3 of the way from H to S: 2 + (2/3)(2) = 10/3 ✓. This is true for every triangle (the Euler line); the coordinate check above is a verification for this one, and a proof for all triangles uses general coordinates the same way.

**How to set up any altitude or bisector.**

| Line | Through | Slope |
|---|---|---|
| altitude from vertex V | V | opposite reciprocal of the opposite side's slope |
| perpendicular bisector of side XY | midpoint of XY | opposite reciprocal of XY's slope |
| median from V | V and the midpoint of the opposite side | from those two points |

**Worked example 12.** Triangle P = (0, 0), Q = (10, 0), R = (4, 8). Altitude from R: x = 4. Altitude from P: slope of QR = 8/(4 − 10) = −4/3, so the altitude has slope 3/4: y = 3/4 x. Orthocentre: (4, 3).

**Worked example 13 — a right triangle.** For (0, 0), (6, 0), (0, 8), the legs are two of the altitudes, so the orthocentre is the right-angle vertex (0, 0); the circumcentre is the midpoint of the hypotenuse (3, 4) (Try it 1.1); the centroid is (2, 8/3). Check the 2 : 1 split: from (0, 0) toward (3, 4), 2/3 of the way is (2, 8/3) ✓.

**Try it 4.1** For triangle (0, 0), (4, 0), (0, 6), find the circumcentre. *(Answer: the perpendicular bisectors are x = 2 and y = 3, so (2, 3), the midpoint of the hypotenuse.)*

## Common mistakes

- **Placing a figure so that it is a special case.** A "general" rectangle (0, 0), (4, 0), (4, 3), (0, 3) proves nothing about other rectangles; use (a, 0), (a, b), (0, b).
- **Assuming what you want to prove when placing the figure.** To prove a quadrilateral is a parallelogram you may not label its fourth vertex as if it already were one.
- **Weighting the wrong endpoint.** One third of the way from A is (2/3)A + (1/3)B: the point is near A, so A gets more weight.
- **Ratio versus fraction.** AP : PB = 3 : 1 means t = 3/4, not 3.
- **Computing the centroid as the midpoint of two vertices.** It is the average of all three.
- **Using the side's slope instead of its opposite reciprocal for an altitude.**
- **Forgetting the midpoint for a perpendicular bisector.** An altitude passes through a vertex; a perpendicular bisector passes through a midpoint.

## Where this goes next

Unit 7 is circles. The circumcentre is the centre of the circle through the three vertices, and the incentre (week 27) is the centre of the circle tangent to the three sides, located with angle bisectors rather than perpendicular bisectors. Tangent lines (week 26) are perpendicular to radii, which is the slope rule once more. The weighted average returns whenever a point must divide a segment in a given ratio.

## Self-check

1. Prove with coordinates that the midpoint of the hypotenuse of a right triangle with legs on the axes, vertices (0, 0), (2a, 0), (0, 2b), is equidistant from the three vertices.
2. Find the point 3/4 of the way from (−4, 2) to (4, −6).
3. Find the point P on AB with AP : PB = 2 : 3, A = (0, 0), B = (10, 5).
4. Find the centroid of the triangle with vertices (2, −1), (8, 3), (−1, 7).
5. Triangle (0, 0), (6, 0), (2, 4): find the orthocentre.

*Answers: (1) midpoint (a, b); distance to each vertex is √(a² + b²). (2) (−4, 2) + 3/4 · (8, −8) = (2, −4). (3) t = 2/5; (4, 2). (4) (3, 3). (5) altitude from (2, 4) is x = 2; side from (6, 0) to (2, 4) has slope −1, so the altitude from (0, 0) is y = x; orthocentre (2, 2).*

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Geometry, Unit 6, Lessons 14–17, https://im.kendallhunt.com/HS/teachers/2/6/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
