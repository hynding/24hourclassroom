# Week 24 · Equations of Lines, Parallel and Perpendicular Slopes, Intersections

**Lessons:** 6.9 Equations of Lines · 6.10 Parallel Lines in the Plane · 6.11 Perpendicular Lines in the Plane · 6.12 It's All on the Line · 6.13 Intersection Points
**Practices:** MP3 (construct arguments), MP7 (use structure), MP8 (regularity in repeated reasoning)
**Built from:** IM Geometry, Unit 6, Lessons 9–13, in our own words
**Spiral:** slope comes from similar slope triangles (week 13, AA similarity); the perpendicular-slope rule comes from the 90° rotation rule (x, y) → (−y, x) (week 22); meeting points of a line and a circle use the circle equation and completing the square (weeks 22–23). Parallel and perpendicular lines were constructed with a compass in week 2 and defined through transformations in weeks 3 and 6; this week they become equations.

## What you need to be able to do

- Explain why every slope triangle on a line is similar to every other, so a line has one slope, and write the equation of a line in point-slope form y − k = m(x − h) from a point and a slope or from two points.
- Explain why distinct parallel lines have equal slopes (a translation carries one slope triangle onto the other) and why lines with equal slopes are parallel, and use the rule to test and to write parallel lines.
- Explain why perpendicular lines have slopes whose product is −1 (rotate the slope triangle 90°) and use the rule to test and to write perpendicular lines, including the vertical–horizontal case.
- Write the equation of the line through a given point that is parallel or perpendicular to a given line, in whichever form is asked for, and decide what information is enough to pin down a line.
- Find where two lines meet by solving a system, and where a line meets a circle or a parabola by substitution; interpret zero, one or two solutions.

## Key terms

| Term | Meaning |
|---|---|
| Slope | Vertical change over horizontal change between any two points of a line: m = (y₂ − y₁)/(x₂ − x₁). |
| Slope triangle | The right triangle with a segment of the line as hypotenuse and legs parallel to the axes. All slope triangles on one line are similar. |
| Point-slope form | y − k = m(x − h): the line of slope m through (h, k). The point can be any point of the line. |
| Slope-intercept form | y = mx + b: slope m, crosses the y-axis at (0, b). |
| Parallel lines in the plane | Distinct lines with the same slope, or two vertical lines. |
| Perpendicular lines in the plane | Lines whose slopes multiply to −1, or a vertical line and a horizontal line. |
| Intersection point | A point whose coordinates satisfy both equations at once. |

## 1. Why a line has one slope (6.9)

Pick any two points on a line and draw the slope triangle: go across, then up. Pick two other points and draw theirs. The two triangles have a right angle each and a pair of congruent corresponding angles (the hypotenuses lie on the same line, which is a transversal of the two horizontal legs), so they are similar by AA. Similar triangles have proportional legs, so rise/run is the same for both: **the slope is a property of the line, not of the points you chose.**

That is also why point-slope form works. A point (x, y) is on the line through (h, k) with slope m exactly when the slope triangle from (h, k) to (x, y) has rise/run = m, that is (y − k)/(x − h) = m, or

**y − k = m(x − h).**

(Multiplying by x − h adds the point (h, k) itself, which the fraction form left out.)

**Worked example 1.** The line through (2, 5) with slope 3: y − 5 = 3(x − 2). To get slope-intercept form, expand: y = 3x − 6 + 5 = 3x − 1.

**Worked example 2.** The line through A = (−1, 4) and B = (3, −2). Slope m = (−2 − 4)/(3 − (−1)) = −6/4 = −3/2. Point-slope from A: y − 4 = −3/2 (x + 1). Check B: y − 4 = −3/2 · 4 = −6, y = −2 ✓. Point-slope from B gives y + 2 = −3/2 (x − 3); expand both and you get the same y = −3/2 x + 5/2.

**Worked example 3 — reading a line from its equation.** y + 3 = 1/2 (x − 6) has slope 1/2 and passes through (6, −3). Two more points: step right 2, up 1 → (8, −2); step left 6, down 3 → (0, −6), which is the y-intercept.

**Vertical and horizontal lines.** A vertical line has no slope (the run is 0) and the equation x = c. A horizontal line has slope 0 and the equation y = c. Point-slope form cannot write a vertical line.

**Try it 1.1** Write the line through (4, −1) with slope −2 in point-slope and slope-intercept forms. *(Answer: y + 1 = −2(x − 4); y = −2x + 7.)*

**Try it 1.2** Find the slope of the line through (−3, 7) and (5, 1). *(Answer: (1 − 7)/(5 + 3) = −6/8 = −3/4.)*

## 2. Parallel lines have equal slopes (6.10)

Take a line with slope triangle of run 1 and rise m. Translate the line by any vector that is not along the line; the image is a parallel line (a translation takes a line to a parallel line, week 3). The slope triangle translates too, and translations preserve lengths, so the image line has a slope triangle with run 1 and rise m: **the same slope.**

Conversely, if two lines have the same slope, then each is the translation of the other by the vector from a point of one to a point of the other (the slope triangles match), so they are parallel, or they coincide.

Rule: **distinct non-vertical lines are parallel ⇔ equal slopes. Two vertical lines are parallel.**

**Worked example 4.** Is 2x + 3y = 12 parallel to y = −2/3 x + 1? Solve the first for y: 3y = −2x + 12, y = −2/3 x + 4. Same slope −2/3, different intercepts: parallel.

**Worked example 5.** Write the line through (−2, 3) parallel to y = 4x − 7. Slope 4; y − 3 = 4(x + 2), or y = 4x + 11.

**Worked example 6 — same slope, same line.** y = 1/2 x + 1 and 2y − x = 2 have the same slope and the same intercept (the second is y = 1/2 x + 1 rearranged). They are the same line, not parallel lines.

**Try it 2.1** Write the line through (5, 0) parallel to 3x − y = 8. *(Answer: slope 3; y = 3(x − 5) = 3x − 15.)*

## 3. Perpendicular lines: slopes multiply to −1 (6.11)

Take a line through the origin with slope m. Its slope triangle has legs (1, m): go right 1, up m, to the point (1, m). Rotate the line 90° counterclockwise about the origin. The rotation rule from week 22 sends (x, y) → (−y, x), so (1, m) → (−m, 1). The image line passes through the origin and (−m, 1), so its slope is 1/(−m) = **−1/m**. A 90° rotation makes perpendicular lines, so:

**Non-vertical, non-horizontal lines are perpendicular ⇔ their slopes multiply to −1 (each is the opposite reciprocal of the other).** A vertical line is perpendicular to a horizontal line; the product rule does not apply to them because a vertical line has no slope.

```
Figure description: a line through the origin rises to the point (1, m).
Rotating 90° counterclockwise about O sends (1, m) to (−m, 1), so the
perpendicular line falls through (−m, 1): run −m, rise 1, slope −1/m.

        (−m, 1) •          • (1, m)
                 \        /
                  \      /
                   \    /
    ────────────────O────────────────
```

| Slope of ℓ | Slope of a perpendicular |
|---|---|
| 2 | −1/2 |
| −3/4 | 4/3 |
| 1 | −1 |
| 0 (horizontal) | undefined (vertical) |
| −1/5 | 5 |

**Worked example 7.** Are y = 2/3 x − 1 and y = −3/2 x + 8 perpendicular? 2/3 · (−3/2) = −1: yes.

**Worked example 8.** Write the line through (6, −2) perpendicular to y = 3x + 1. Slope −1/3; y + 2 = −1/3 (x − 6), or y = −1/3 x.

**Worked example 9.** Show that triangle with vertices A = (1, 1), B = (4, 7), C = (7, 1) is not right-angled at B. Slope of AB = 6/3 = 2; slope of BC = (1 − 7)/(7 − 4) = −2. Product −4 ≠ −1, so ∠B is not a right angle. (It is isosceles with AB = BC = √45; its symmetry line is x = 4.)

**Try it 3.1** Find the slope of a line perpendicular to the line through (0, 2) and (4, 5). *(Answer: the given line has slope 3/4, so the perpendicular has slope −4/3.)*

**Try it 3.2** Write the line through (−3, 5) perpendicular to x = 2. *(Answer: x = 2 is vertical, so the perpendicular is horizontal: y = 5.)*

## 4. It's all on the line: choosing the information (6.12)

A line is determined by any of: two points; a point and a slope; a slope and the y-intercept; a point and a line it is parallel or perpendicular to. The same line has many equations, so compare lines by slope and one point, not by appearance.

**Worked example 10.** Line ℓ: 4x − 2y = 6. Write (a) the perpendicular to ℓ with y-intercept 5, (b) the parallel to ℓ through (1, −4).
ℓ in slope-intercept form: −2y = −4x + 6, y = 2x − 3, slope 2.
(a) Slope −1/2, intercept 5: y = −1/2 x + 5.
(b) Slope 2 through (1, −4): y + 4 = 2(x − 1), y = 2x − 6.

**Worked example 11 — a chain of perpendiculars.** Start with y = 1/4 x + 2 (slope 1/4). A perpendicular through (4, 3) has slope −4: y − 3 = −4(x − 4). A perpendicular to that one through (0, 0) has slope 1/4 again: y = 1/4 x. So the third line is parallel to the first: **two lines perpendicular to the same line are parallel**, now proved with slopes (week 2 proved it with angles).

**Worked example 12 — same line in disguise?** Are y − 1 = 2(x − 3) and y + 5 = 2(x) the same line? Both have slope 2. The first passes through (3, 1); test it in the second: 1 + 5 = 6 and 2 · 3 = 6 ✓. Same line.

**Try it 4.1** Write the line through (2, 2) perpendicular to the line through (0, 0) and (3, 1). *(Answer: given slope 1/3, perpendicular slope −3: y − 2 = −3(x − 2), y = −3x + 8.)*

## 5. Intersection points (6.13)

Two graphs meet where one point satisfies both equations. Solve the system.

**Two lines.** Substitute one expression for y into the other.
y = 2x − 1 and y = −x + 5: 2x − 1 = −x + 5, 3x = 6, x = 2, y = 3. Meet at (2, 3). Parallel lines (equal slopes, different intercepts) never meet: the equation becomes 0 = (nonzero). The same line twice gives 0 = 0, infinitely many solutions.

**A line and a circle.** Substitute the line into the circle; you get a quadratic in x with 0, 1 or 2 solutions: the line misses, touches (is tangent to) or crosses the circle.

**Worked example 13.** Where does y = x + 1 meet x² + y² = 25?
x² + (x + 1)² = 25 → 2x² + 2x + 1 = 25 → x² + x − 12 = 0 → (x + 4)(x − 3) = 0. x = 3, y = 4, or x = −4, y = −3. Two points: (3, 4) and (−4, −3). Check: 9 + 16 = 25 ✓, 16 + 9 = 25 ✓.

**Worked example 14 — a tangent.** Where does y = 5 meet x² + y² = 25? x² + 25 = 25, x = 0 only: the single point (0, 5). A horizontal line through the top of the circle is tangent to it.

**Worked example 15 — a miss.** y = x + 8 and x² + y² = 25: x² + x² + 16x + 64 = 25 → 2x² + 16x + 39 = 0. The discriminant is 256 − 312 < 0: no real solutions, the line misses the circle.

**A line and a parabola.** Same idea: substitute, solve the quadratic.
y = x²/4 and y = x + 3: x²/4 = x + 3 → x² − 4x − 12 = 0 → (x − 6)(x + 2) = 0. Points (6, 9) and (−2, 1).

**Worked example 16 — a vertical line.** x = 3 meets (x − 1)² + (y + 2)² = 13 where 4 + (y + 2)² = 13, (y + 2)² = 9, y = 1 or y = −5: (3, 1) and (3, −5). Substitute x, not y, when the line is vertical.

**Try it 5.1** Find where y = 3x − 4 meets y = −2x + 6. *(Answer: 5x = 10, x = 2, y = 2: (2, 2).)*

**Try it 5.2** Find where y = 2x meets x² + y² = 20. *(Answer: 5x² = 20, x = ±2: (2, 4) and (−2, −4).)*

## Common mistakes

- **Run over rise.** Slope is rise/run = Δy/Δx. Keep the two points in the same order on top and bottom.
- **Dropping the sign when subtracting a negative.** 3 − (−1) = 4, not 2.
- **Reading the wrong point from point-slope form.** y + 3 = 2(x − 1) passes through (1, −3): the signs inside the brackets flip.
- **Reciprocal without the opposite sign, or opposite sign without the reciprocal.** The perpendicular to slope 2/3 has slope −3/2, not 3/2 and not −2/3.
- **Applying the product rule to a vertical line.** It has no slope; its perpendicular is horizontal, slope 0.
- **Calling two equations of the same line "parallel".** Check a point as well as the slope.
- **Substituting back into only one equation.** An intersection point must satisfy both; check it in the second one.
- **Forgetting ± when solving (y + 2)² = 9.** There are two square roots.

## Where this goes next

Week 25 uses all of this to prove theorems with coordinates: place a figure well, compute slopes and distances, draw the conclusion. It then partitions a segment in a given ratio with weighted averages and shows that a triangle's medians meet at one point, the centroid. Week 26 begins circles, and tangent lines return with the perpendicular rule: a tangent is perpendicular to the radius at the point of tangency.

## Self-check

1. Write the line through (−2, 6) and (4, −3) in point-slope form.
2. Is 6x + 4y = 1 parallel, perpendicular or neither to y = −3/2 x + 9?
3. Write the line through (3, −1) perpendicular to y = 1/5 x − 2.
4. Where do y = 4 − x and x² + y² = 16 meet?
5. A line has slope −2 and passes through (1, 7). Does the point (4, 1) lie on it?

*Answers: (1) slope −9/6 = −3/2; y − 6 = −3/2 (x + 2). (2) 6x + 4y = 1 is y = −3/2 x + 1/4: equal slopes, different intercepts, parallel. (3) slope −5; y + 1 = −5(x − 3), y = −5x + 14. (4) x² + (4 − x)² = 16 → 2x² − 8x = 0 → x = 0 or 4: (0, 4) and (4, 0). (5) y − 7 = −2(x − 1); at x = 4, y = 7 − 6 = 1 ✓, yes.*

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Geometry, Unit 6, Lessons 9–13, https://im.kendallhunt.com/HS/teachers/2/6/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
