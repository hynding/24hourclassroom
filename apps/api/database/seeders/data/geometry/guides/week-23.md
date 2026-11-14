# Week 23 · Circles, Completing the Square and Parabolas

**Lessons:** 6.5 Squares and Circles · 6.6 Completing the Square · 6.7 Distances and Parabolas · 6.8 Equations and Graphs
**Practices:** MP2 (reason quantitatively), MP7 (use structure), MP8 (regularity in repeated reasoning)
**Built from:** IM Geometry, Unit 6, Lessons 5–8, in our own words
**Spiral:** the circle equation (week 22) came from the distance formula; this week we rewrite it in expanded form and recover the centre and radius by completing the square. The parabola is defined by distances too, so the distance formula (week 22) and the Pythagorean theorem (week 14) do all the work. The perpendicular bisector (week 1) returns as a way to find points equidistant from two things.

## What you need to be able to do

- Expand (x − h)² + (y − k)² = r² into the form x² + y² + Dx + Ey + F = 0, and recognise that form as a circle.
- Complete the square in one variable and in both variables to find a circle's centre and radius from an expanded equation, including when the leading coefficient is not 1 and when the equation has no points.
- Define a parabola as the set of points equidistant from a point (the focus) and a line (the directrix), and derive its equation from the distance formula.
- Given a focus and a horizontal directrix, write the parabola's equation, find its vertex and axis of symmetry, say which way it opens, and check whether a point lies on it.

## Key terms

| Term | Meaning |
|---|---|
| Standard form of a circle | (x − h)² + (y − k)² = r², centre (h, k), radius r. |
| Expanded (general) form | x² + y² + Dx + Ey + F = 0. Same circle, centre and radius hidden. |
| Completing the square | Rewriting x² + bx as (x + b/2)² − (b/2)², so a quadratic expression becomes a perfect square plus a constant. |
| Parabola | The set of points equidistant from a fixed point, the focus, and a fixed line, the directrix. |
| Vertex of a parabola | The point of the parabola closest to the directrix: midway between the focus and the directrix. |
| Axis of symmetry | The line through the focus perpendicular to the directrix; the parabola is its own reflection across it. |

## 1. Squares and circles: expanding the circle equation

Last week we wrote a circle with centre (3, −2) and radius 5 as (x − 3)² + (y + 2)² = 25. Multiply out:

x² − 6x + 9 + y² + 4y + 4 = 25, so **x² + y² − 6x + 4y − 12 = 0.**

Every circle can be written this way: x² and y² both with coefficient 1, a multiple of x, a multiple of y, and a constant. Going backwards is the job of section 2. Two things to notice:

- The coefficient of x is −2h and the coefficient of y is −2k. So in x² + y² − 6x + 4y − 12 = 0, the centre is (3, −2) straight from the −6 and the +4.
- An equation with an xy term, or with different coefficients on x² and y², is **not** a circle.

**Worked example 1.** Expand (x + 2)² + (y − 5)² = 9.
x² + 4x + 4 + y² − 10y + 25 = 9, so x² + y² + 4x − 10y + 20 = 0.

**Worked example 2.** Which of these are circles? (a) x² + y² − 8x + 1 = 0 (b) x² − y² + 2x = 7 (c) 3x² + 3y² + 6x − 12y = 0 (d) x² + y² + 4xy = 10.
(a) Yes. (b) No: the y² has a minus sign. (c) Yes: divide by 3 to get x² + y² + 2x − 4y = 0. (d) No: an xy term.

**Worked example 3 — testing a point without a graph.** Is (3, 3) on the circle x² + y² − 6x + 4y − 12 = 0? Substitute: 9 + 9 − 18 + 12 − 12 = 0 ✓. Is (1, 1)? 1 + 1 − 6 + 4 − 12 = −12 < 0, so (1, 1) is **inside** (the left side is (distance to centre)² − r²; negative means closer than r).

**Try it 1.1** Expand (x − 1)² + (y + 4)² = 16. *(Answer: x² + y² − 2x + 8y + 1 = 0.)*

**Try it 1.2** Read the centre of x² + y² + 10x − 2y + 1 = 0 directly from the coefficients. *(Answer: (−5, 1).)*

## 2. Completing the square

The expression x² + 8x is "almost" a perfect square: (x + 4)² = x² + 8x + 16. So x² + 8x = (x + 4)² − 16. The rule: **half the coefficient of x, squared, is what you add and subtract.**

| Expression | Half the coefficient | Completed form |
|---|---|---|
| x² + 8x | 4 | (x + 4)² − 16 |
| x² − 6x | −3 | (x − 3)² − 9 |
| y² + 5y | 5/2 | (y + 5/2)² − 25/4 |
| x² − x | −1/2 | (x − 1/2)² − 1/4 |

**Finding a circle's centre and radius.** Group the x terms and the y terms, complete each square, and move the constants to the right.

**Worked example 4.** x² + y² + 8x − 10y + 5 = 0.
(x² + 8x) + (y² − 10y) = −5
(x + 4)² − 16 + (y − 5)² − 25 = −5
(x + 4)² + (y − 5)² = 36. Centre (−4, 5), radius 6.

**Worked example 5 — leading coefficient.** 2x² + 2y² − 12x + 4y − 6 = 0. Divide by 2 first: x² + y² − 6x + 2y − 3 = 0. Then (x − 3)² − 9 + (y + 1)² − 1 = 3, so (x − 3)² + (y + 1)² = 13. Centre (3, −1), radius √13 ≈ 3.61.

**Worked example 6 — when it is not a circle.** x² + y² + 2x + 4y + 10 = 0 becomes (x + 1)² + (y + 2)² = 1 + 4 − 10 = −5. A sum of two squares is never negative, so **no point** satisfies this equation. If the right side were 0, the "circle" would be the single point (−1, −2).

**Worked example 7 — odd coefficients.** x² + y² − 3x + y = 0. (x − 3/2)² − 9/4 + (y + 1/2)² − 1/4 = 0, so (x − 3/2)² + (y + 1/2)² = 10/4 = 5/2. Centre (1.5, −0.5), radius √(5/2) ≈ 1.58. Note that (0, 0) satisfies the original equation, and its distance from the centre is √(2.25 + 0.25) = √2.5 ✓.

**Try it 2.1** Find the centre and radius of x² + y² − 4x + 6y − 12 = 0. *(Answer: (x − 2)² + (y + 3)² = 25; centre (2, −3), radius 5.)*

**Try it 2.2** Does x² + y² + 6x − 2y + 11 = 0 describe a circle? *(Answer: (x + 3)² + (y − 1)² = −1, so no points at all.)*

## 3. Distances and parabolas

A **parabola** is the set of points that are the same distance from a point F (the **focus**) and a line (the **directrix**). Take F = (0, 2) and directrix y = −2. A point (x, y) is on the parabola when

distance to F = distance to the line
√(x² + (y − 2)²) = |y + 2|.

The distance from (x, y) to the horizontal line y = −2 is just the vertical gap, |y − (−2)|. Square both sides:

x² + y² − 4y + 4 = y² + 4y + 4
x² = 8y, so **y = x²/8.**

```
Figure description: the focus F = (0, 2) is a dot above the origin; the
directrix y = −2 is a horizontal line below it. The parabola passes through
the vertex (0, 0), halfway between them, and opens upward. The point (4, 2)
is on it: 4 from F and 4 above the directrix.

        F •  (0, 2)
      \     /
       \_•_/      vertex (0, 0)
  ───────────────  y = −2  (directrix)
```

Check a point: (4, 2) gives 16/8 = 2 ✓, and its distance to F is 4 while its distance to y = −2 is also 4.

**The general case.** Focus (a, b), directrix y = c, with b ≠ c. Setting the distances equal and squaring:

(x − a)² + (y − b)² = (y − c)²
(x − a)² + b² − c² = 2(b − c)y

**y = ((x − a)² + b² − c²) / (2(b − c)).**

You do not need to memorise this; redo the three lines each time. What matters:

- The **vertex** is halfway between focus and directrix: (a, (b + c)/2).
- The parabola **opens toward the focus**: up if the focus is above the directrix (b > c), down if below.
- The **axis of symmetry** is the vertical line x = a.
- The closer the focus is to the directrix, the "narrower" the parabola: the coefficient of (x − a)² is 1/(2(b − c)).

**Worked example 8.** Focus (3, 1), directrix y = −3. Vertex (3, −1). b − c = 4, so y = ((x − 3)² + 1 − 9)/8 = (x − 3)²/8 − 1. Opens up. Check (7, 1): (16)/8 − 1 = 1 ✓; distance to focus 4, to the directrix 4.

**Worked example 9.** Focus (−1, 4), directrix y = 6. Vertex (−1, 5). b − c = −2, so y = ((x + 1)² + 16 − 36)/(−4) = −(x + 1)²/4 + 5. Opens down because the focus is below the directrix.

**Try it 3.1** Derive the equation of the parabola with focus (0, 1) and directrix y = −1. *(Answer: x² = 4y, so y = x²/4.)*

**Try it 3.2** Is (6, 3) on the parabola with focus (0, 3) and directrix y = −3? *(Answer: distance to the focus 6, to the line 6: yes. The equation is y = x²/12 and 36/12 = 3 ✓.)*

## 4. Equations and graphs

Three skills, all using the same ideas.

**From focus and directrix to equation.** Write the distance equation, square, solve for y (Worked examples 8 and 9).

**From equation to focus and directrix.** If y = (x − h)²/(4p) + k, the vertex is (h, k), the focus is p above it at (h, k + p), and the directrix is p below it, y = k − p. (Compare with the general formula: 4p = 2(b − c), and the vertex height k = (b + c)/2.) For y = (x − 2)²/8 + 1: vertex (2, 1), 4p = 8 so p = 2, focus (2, 3), directrix y = −1.

**Sketching.** Plot the vertex and focus, draw the directrix, mark the two points level with the focus (they are 2p to either side of it, at (h ± 2p, k + p)), and draw a smooth U through them opening toward the focus.

**Worked example 10.** y = −(x + 1)²/4 + 5. Vertex (−1, 5); 4p = −4 so p = −1; focus (−1, 4); directrix y = 6; opens down. Points level with the focus: (−1 ± 2, 4) = (−3, 4) and (1, 4). Check (1, 4): −(4)/4 + 5 = 4 ✓.

**Worked example 11 — a parabola through given points.** A parabola with vertex (0, 0) and a horizontal directrix passes through (6, 3). Its equation has the form y = x²/(4p); 3 = 36/(4p) gives p = 3. Focus (0, 3), directrix y = −3. (This is the Try-it 3.2 parabola.)

**Worked example 12 — why satellite dishes are parabolic.** Every point of a parabola is as far from the focus as from the directrix. Signals arriving parallel to the axis bounce off the dish and all meet at the focus; that is where the receiver sits. The geometry is the same equidistance property we just used.

**Try it 4.1** Find the focus and directrix of y = (x − 4)²/2 − 3. *(Answer: vertex (4, −3), 4p = 2, p = 0.5; focus (4, −2.5), directrix y = −3.5.)*

**Try it 4.2** Which opens wider, y = x²/4 or y = x²/16? *(Answer: y = x²/16; its focus is 4 from the vertex instead of 1, so it rises more slowly.)*

## Common mistakes

- **Forgetting to subtract what you added.** x² + 8x = (x + 4)² − 16, not (x + 4)².
- **Halving the wrong thing.** Half the coefficient of x, then square it: for x² − 6x use (−3)² = 9, not 36.
- **Not dividing out a leading coefficient first.** 2x² + 2y² + ... must become x² + y² + ... before completing the square.
- **Reading the radius as the right side.** The right side is r², so (x − 2)² + (y + 3)² = 25 has radius 5.
- **Measuring the distance to the directrix along a slant.** It is the perpendicular (vertical) distance |y − c|.
- **Getting the direction backwards.** A parabola opens toward its focus and away from its directrix.
- **Using the general parabola formula with the vertex instead of the focus.** The formula takes the focus (a, b); the vertex is halfway to the directrix.

## Where this goes next

Week 24 turns to lines: slope from similar triangles, point-slope form, the slope criteria for parallel and perpendicular lines, and finding where lines and circles meet. Week 25 uses all of it in coordinate proofs, and introduces weighted averages for partitioning a segment and locating the centroid of a triangle. Parabolas return in Algebra 2 as quadratic functions; here they are a geometric object defined by distance.

## Self-check

1. Expand (x − 5)² + (y + 1)² = 4.
2. Find the centre and radius of x² + y² + 12x − 2y + 21 = 0.
3. Does x² + y² − 4x + 8y + 25 = 0 describe a circle, a point, or nothing?
4. Write the equation of the parabola with focus (2, 5) and directrix y = 1.
5. For y = (x + 3)²/12 − 2, give the vertex, focus and directrix.

*Answers: (1) x² + y² − 10x + 2y + 22 = 0. (2) (x + 6)² + (y − 1)² = 16; centre (−6, 1), radius 4. (3) (x − 2)² + (y + 4)² = −5: nothing. (4) vertex (2, 3), b − c = 4: y = ((x − 2)² + 25 − 1)/8 = (x − 2)²/8 + 3. (5) vertex (−3, −2); 4p = 12, p = 3; focus (−3, 1); directrix y = −5.*

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Geometry, Unit 6, Lessons 5–8, https://im.kendallhunt.com/HS/teachers/2/6/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
