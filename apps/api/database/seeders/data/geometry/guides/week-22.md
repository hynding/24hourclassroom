# Week 22 · Transformations as Functions and the Distance Formula

**Lessons:** 6.1 Rigid Transformations in the Plane · 6.2 Transformations as Functions · 6.3 Types of Transformations · 6.4 Distances and Circles
**Practices:** MP2 (reason abstractly), MP7 (structure), MP8 (regularity)
**Built from:** IM Geometry, Unit 6, Lessons 1–4, in our own words
**Spiral:** the reflections, rotations, translations and dilations of Units 1 and 3 become coordinate rules; the Pythagorean theorem (week 14) becomes the distance formula; the definition of a circle (week 1) becomes an equation.

## What you need to be able to do

- Carry out reflections across the axes and the lines y = x and y = −x, rotations about the origin by 90°, 180° and 270°, translations and dilations from the origin using coordinates, and verify by plotting.
- Write a transformation as a function rule (x, y) → (…, …), compose rules, and decide from a rule whether the transformation is rigid, a dilation, or neither.
- Use the distance formula d = √((x₂ − x₁)² + (y₂ − y₁)²) to find lengths, check congruence and classify triangles.
- Write the equation of a circle from its centre and radius, (x − h)² + (y − k)² = r², and read the centre and radius from an equation; decide whether a point is on, inside or outside a circle.

## Key terms

| Term | Meaning |
|---|---|
| Function rule for a transformation | (x, y) → (f(x, y), g(x, y)): the output point for each input point. |
| Rigid transformation | Preserves all distances; its rule is a reflection, rotation, translation or a composition of these. |
| Dilation from the origin | (x, y) → (kx, ky). |
| Distance formula | d = √((x₂ − x₁)² + (y₂ − y₁)²), the Pythagorean theorem on the horizontal and vertical legs. |
| Circle | All points at distance r from the centre (h, k): (x − h)² + (y − k)² = r². |
| Midpoint | ((x₁ + x₂)/2, (y₁ + y₂)/2). |

## 1. Rigid transformations by coordinates

| Transformation | Rule |
|---|---|
| Reflect across the x-axis | (x, y) → (x, −y) |
| Reflect across the y-axis | (x, y) → (−x, y) |
| Reflect across y = x | (x, y) → (y, x) |
| Reflect across y = −x | (x, y) → (−y, −x) |
| Rotate 90° counterclockwise about O | (x, y) → (−y, x) |
| Rotate 180° about O | (x, y) → (−x, −y) |
| Rotate 270° counterclockwise (90° clockwise) | (x, y) → (y, −x) |
| Translate by (a, b) | (x, y) → (x + a, y + b) |

Check the 90° rule on (1, 0): it goes to (0, 1), a quarter turn counterclockwise ✓. On (3, 1): to (−1, 3); the distance from O is √10 both times, and the two position vectors are perpendicular.

```
Figure description: point P = (3, 1) in the first quadrant. Its 90° counterclockwise
image P′ = (−1, 3) is in the second quadrant, the same distance from the origin.
Its 180° image is (−3, −1); its 270° image is (1, −3).

          y
      P′  |
     (−1,3)      P (3,1)
   -------O-------- x
  (−3,−1)     |
              |  (1,−3)
```

**Worked example 1.** Triangle A(1, 2), B(4, 2), C(4, 6). Reflect across the y-axis: (−1, 2), (−4, 2), (−4, 6). Rotate the original 180°: (−1, −2), (−4, −2), (−4, −6). Translate by (−2, 3): (−1, 5), (2, 5), (2, 9).

**Worked example 2 (reflection across a vertical line).** Reflect (5, 2) across x = 1. The point is 4 to the right of the line; its image is 4 to the left: (−3, 2). Rule for x = c: (x, y) → (2c − x, y). For a horizontal line y = c: (x, y) → (x, 2c − y).

**Worked example 3 (rotation about another point).** Rotate (4, 5) by 90° counterclockwise about (2, 1). Subtract the centre: (2, 4); rotate: (−4, 2); add the centre back: (−2, 3).

**Try it 1.1** Rotate (−2, 7) by 90° counterclockwise about the origin. *(Answer: (−7, −2).)*

**Try it 1.2** Reflect (3, −4) across y = x, then across the x-axis. *(Answer: (−4, 3) then (−4, −3).)*

## 2. Transformations as functions

Every rule (x, y) → (…) is a function from points to points. Composition means applying one rule after another; write the inner rule first.

**Worked example 4.** Rotate 90° counterclockwise, then reflect across the x-axis: (x, y) → (−y, x) → (−y, −x). The result is the reflection across y = −x.

**Worked example 5.** Reflect across the x-axis, then across the y-axis: (x, y) → (x, −y) → (−x, −y), a 180° rotation. Two reflections across perpendicular lines make a half-turn (week 3).

**Worked example 6.** Translate by (3, 0), then rotate 180°: (x, y) → (x + 3, y) → (−x − 3, −y). Rotate first, then translate: (x, y) → (−x, −y) → (−x + 3, −y). Different results: order matters.

**Classifying rules.**

| Rule | Type |
|---|---|
| (x, y) → (x + 2, y − 5) | translation (rigid) |
| (x, y) → (−y, x) | rotation 90° (rigid) |
| (x, y) → (3x, 3y) | dilation, k = 3 (not rigid) |
| (x, y) → (2x, y) | horizontal stretch (neither rigid nor a dilation; angles change) |
| (x, y) → (x, 0) | projection onto the x-axis (not even one-to-one) |
| (x, y) → (x², y) | not a transformation of the kinds studied here |

To test "rigid", check distances: under (x, y) → (2x, y), the points (0, 0) and (1, 1) are √2 apart, but their images (0, 0) and (2, 1) are √5 apart. Not rigid.

**Try it 2.1** Write the rule for "reflect across y = x, then translate by (0, 4)". *(Answer: (x, y) → (y, x + 4).)*

**Try it 2.2** Is (x, y) → (−x, y + 1) rigid? *(Answer: yes: a reflection across the y-axis followed by a translation, a glide reflection.)*

## 3. The distance formula

Between P(x₁, y₁) and Q(x₂, y₂), draw the horizontal and vertical legs: |x₂ − x₁| and |y₂ − y₁|. The hypotenuse is PQ, so

  **PQ = √((x₂ − x₁)² + (y₂ − y₁)²)**.

**Worked example 7.** (1, 2) to (7, 10): √(36 + 64) = 10.

**Worked example 8 (classify a triangle).** A(0, 0), B(6, 0), C(3, 4). AB = 6, AC = 5, BC = 5: isosceles. Check for a right angle: 5² + 5² = 50 ≠ 36, so not right.

**Worked example 9 (is it a rectangle?).** P(1, 1), Q(5, 3), R(4, 5), S(0, 3). PQ = √20, QR = √5, RS = √20, SP = √5: opposite sides equal. Diagonals PR = √25 = 5, QS = √25 = 5: equal diagonals, so a rectangle (a parallelogram with equal diagonals).

**Worked example 10 (perimeter).** Triangle (−2, 1), (3, 1), (3, 13): sides 5, 12, 13; perimeter 30; and 25 + 144 = 169, so it is a right triangle.

**Midpoint.** The midpoint of (x₁, y₁) and (x₂, y₂) is the average of the coordinates. Midpoint of (1, 2) and (7, 10): (4, 6); its distance to each endpoint is 5 ✓.

**Try it 3.1** Distance from (−3, 4) to (2, −8)? *(Answer: √(25 + 144) = 13.)*

**Try it 3.2** Are (0, 0), (4, 3), (8, 6) collinear? *(Answer: yes: 5 + 5 = 10, the distances add up, so the middle point is on the segment.)*

## 4. Circles

A circle is the set of points at distance r from the centre (h, k). By the distance formula, a point (x, y) is on the circle exactly when √((x − h)² + (y − k)²) = r, i.e.

  **(x − h)² + (y − k)² = r²**.

**Worked example 11.** Centre (2, −3), radius 5: (x − 2)² + (y + 3)² = 25. Is (5, 1) on it? (3)² + (4)² = 25 ✓ yes. Is (6, 0)? 16 + 9 = 25 ✓ yes. Is (0, 0)? 4 + 9 = 13 < 25: inside. Is (7, 3)? 25 + 36 = 61 > 25: outside.

**Worked example 12.** Read the circle x² + (y − 4)² = 49: centre (0, 4), radius 7. The circle (x + 1)² + (y − 2)² = 10: centre (−1, 2), radius √10 ≈ 3.16.

**Worked example 13 (circle from centre and a point).** Centre (1, 1) through (4, 5): r = √(9 + 16) = 5, so (x − 1)² + (y − 1)² = 25.

**Worked example 14 (circle from a diameter).** Endpoints (−2, 3) and (6, 9): centre = midpoint (2, 6); r = distance from centre to an endpoint = √(16 + 9) = 5. Equation: (x − 2)² + (y − 6)² = 25.

**Try it 4.1** Write the circle with centre (−4, 0) and radius 3. *(Answer: (x + 4)² + y² = 9.)*

**Try it 4.2** Centre and radius of (x − 5)² + (y + 2)² = 36? *(Answer: (5, −2); 6.)*

## Common mistakes

- **Sign slips in the circle equation.** (x − 2)² means the centre's x-coordinate is +2; (y + 3)² means −3.
- **Forgetting the square root** for the radius: r² = 10 means r = √10.
- **Rotating the wrong way.** (x, y) → (−y, x) is counterclockwise; (y, −x) is clockwise.
- **Composing in the wrong order.** Apply the first rule first; substitute its output into the second.
- **Distance without squaring** or subtracting coordinates in different orders for x and y (the squares make the order irrelevant, but mixing orders before squaring is still fine; just be consistent).

## Where this goes next

Week 23 completes the square to turn x² + y² + Dx + Ey + F = 0 into centre-radius form, defines a parabola by distance to a focus and a directrix, and builds equations from geometric descriptions. Week 24 handles equations of lines, parallel and perpendicular slopes, and intersection points. Week 25 uses coordinates to prove theorems and finds points that divide a segment in a given ratio.

## Self-check

1. Rotate (5, −2) by 270° counterclockwise about the origin.
2. Write the rule for "reflect across the y-axis, then translate by (0, −3)", and apply it to (4, 1).
3. Find the distance between (−1, −1) and (11, 4), and the midpoint.
4. Classify the triangle (0, 0), (2, 6), (8, 4) by side lengths and angles.
5. Give the centre and radius of (x + 3)² + (y − 1)² = 20 and decide whether (1, 3) is on it.

*Answers: (1) (y, −x) = (−2, −5). (2) (x, y) → (−x, y − 3); (−4, −2). (3) 13; (5, 1.5). (4) sides √40, √40, √80: isosceles, and 40 + 40 = 80, so a right isosceles triangle. (5) (−3, 1), √20 ≈ 4.47; (1 + 3)² + (3 − 1)² = 16 + 4 = 20 ✓ on the circle.*

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Geometry, Unit 6, Lessons 1–4, https://im.kendallhunt.com/HS/teachers/2/6/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
