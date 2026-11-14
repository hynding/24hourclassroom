# Week 31 · Area Between Curves

**Topics:** 8.4 Finding the Area Between Curves Expressed as Functions of x · 8.5 Finding the Area Between Curves Expressed as Functions of y · 8.6 Finding the Area Between Curves That Intersect at More Than Two Points
**Practices:** 1 (Implementing Mathematical Processes), 2 (Connecting Representations), 3 (Justification), 4 (Communication and Notation)
**Framework:** AP Calculus AB and BC CED, Unit 8, Topics 8.4–8.6, learning objectives in our own words
**Spiral:** Unit 6 built the definite integral as a limit of Riemann sums of thin rectangles, and showed that ∫ f(x) dx is a *signed* area. This week the rectangles stretch between two curves instead of between a curve and the x-axis. Week 30's average value returns as "average distance between the curves", and the algebra of solving f(x) = g(x) (factoring, the quadratic formula, a calculator's intersect feature) does most of the setting up.

## What you need to be able to do

- **8.4** Find the area between y = f(x) and y = g(x) as ∫ from a to b of (top − bottom) dx, with limits from intersection points or given boundaries.
- **8.5** Find the area between x = f(y) and x = g(y) as ∫ from c to d of (right − left) dy, rewriting curves as functions of y when needed.
- **8.5** Decide whether vertical or horizontal slices give the simpler setup (one integral rather than two).
- **8.6** Find the area when the curves cross inside the interval, by splitting at every intersection or by integrating |f − g| on a calculator.
- **8.4–8.6** Distinguish a net integral from an area, and write the integral before reporting a calculator value.

## Key terms

| Term | Meaning |
|---|---|
| Vertical slice | A thin rectangle of width dx and height (top − bottom) at a fixed x. |
| Horizontal slice | A thin rectangle of thickness dy and length (right − left) at a fixed y. |
| Intersection points | Solutions of f(x) = g(x) (or f(y) = g(y)); they supply the limits and the places to split. |
| Net integral | ∫ (f − g) dx without regard to which is on top; pieces where g is on top count negatively. |
| Area | Always positive: ∫ |f − g| dx, computed by hand by splitting at crossings. |

## Area with vertical slices (8.4)

Picture the region between two curves cut into thin vertical strips. At a given x, the strip runs from the lower curve g(x) up to the upper curve f(x), so its height is f(x) − g(x) and its area is about (f(x) − g(x)) Δx. Adding the strips and letting Δx → 0 gives

Area = ∫ from a to b of (f(x) − g(x)) dx, where f(x) ≥ g(x) on [a, b].

The recipe:

1. **Find the boundaries.** Solve f(x) = g(x) for the intersection x-values, or use the vertical lines given.
2. **Decide which curve is on top.** Test one x between the limits.
3. **Integrate top minus bottom.**

The formula does not care where the x-axis is: if both curves lie below it, the height of a strip is still top minus bottom.

**Worked example.** Find the area of the region enclosed by y = 4 − x² and y = x + 2.

Intersections: 4 − x² = x + 2 gives x² + x − 2 = 0, so (x + 2)(x − 1) = 0 and x = −2 or x = 1. At x = 0 the parabola gives 4 and the line gives 2, so the parabola is on top.

Area = ∫ from −2 to 1 of [(4 − x²) − (x + 2)] dx = ∫ from −2 to 1 of (2 − x − x²) dx = [2x − x²/2 − x³/3] from −2 to 1 = (2 − 1/2 − 1/3) − (−4 − 2 + 8/3) = 7/6 + 10/3 = 9/2.

A useful by-product: dividing the area by the width gives the **average vertical distance** between the curves (week 30's average value). Here it is (9/2)/3 = 3/2.

## Area with horizontal slices (8.5)

Sometimes it is easier to slice sideways. A horizontal strip at height y runs from the left curve x = g(y) to the right curve x = f(y), so

Area = ∫ from c to d of (f(y) − g(y)) dy, where f(y) ≥ g(y) on [c, d].

Everything is in y: the integrand, the limits (the lowest and highest y-values of the region) and the differential dy. Curves given as y = (something in x) must be solved for x first; for example y = √x becomes x = y² with y ≥ 0.

**When to choose dy.** Choose horizontal slices when the left and right boundaries each stay a single curve but the top or bottom boundary would change partway across (vertical slices would then need two integrals), or when the curves are already written as x in terms of y.

**Worked example.** Find the area of the region enclosed by x = y² and x = y + 2.

*With dy.* Intersections: y² = y + 2 gives y² − y − 2 = 0, so y = −1 or y = 2 (points (1, −1) and (4, 2)). At y = 0 the line gives x = 2 and the parabola x = 0, so the line is on the right.

Area = ∫ from −1 to 2 of (y + 2 − y²) dy = [y²/2 + 2y − y³/3] from −1 to 2 = (2 + 4 − 8/3) − (1/2 − 2 + 1/3) = 10/3 + 7/6 = 9/2.

*With dx, for comparison.* The parabola x = y² is y = ±√x. For 0 ≤ x ≤ 1 a vertical strip runs from y = −√x to y = √x; for 1 ≤ x ≤ 4 it runs from the line y = x − 2 up to y = √x. So

Area = ∫ from 0 to 1 of 2√x dx + ∫ from 1 to 4 of (√x − x + 2) dx = 4/3 + 19/6 = 9/2.

Same answer, but twice the work. The bottom boundary changing at x = 1 is the signal to switch to dy.

**Worked example (a halving line).** The region between y = x² and y = 4 has area ∫ from −2 to 2 of (4 − x²) dx = 32/3. Find the horizontal line y = c that cuts it into two regions of equal area.

Slice horizontally: at height y the region runs from x = −√y to x = √y, length 2√y. The part below y = c has area ∫ from 0 to c of 2√y dy = (4/3)c^(3/2). Set this equal to half the total, 16/3: c^(3/2) = 4, so c = 4^(2/3) ≈ 2.520. Vertical slices would have made this much messier, because the top of every strip below y = c is the line y = c only for |x| ≤ √c.

## Curves that cross more than twice (8.6)

If the curves cross inside the interval, the "top" curve changes. The integral of (f − g) then adds positive pieces and negative pieces, giving a **net** value that is smaller than the area, sometimes 0.

By hand:

1. Find **every** intersection in the interval.
2. On each piece between consecutive intersections, test which curve is on top.
3. Integrate top minus bottom on each piece and **add**.

On a calculator, you can skip the bookkeeping: Area = ∫ from a to b of |f(x) − g(x)| dx.

**Worked example.** Find the total area enclosed by y = x³ and y = 4x.

Intersections: x³ − 4x = x(x − 2)(x + 2) = 0, so x = −2, 0, 2. At x = −1: x³ = −1 and 4x = −4, so the cubic is on top on [−2, 0]. At x = 1: 1 versus 4, so the line is on top on [0, 2].

Area = ∫ from −2 to 0 of (x³ − 4x) dx + ∫ from 0 to 2 of (4x − x³) dx = [x⁴/4 − 2x²] from −2 to 0 + [2x² − x⁴/4] from 0 to 2 = (0 − (4 − 8)) + (8 − 4) = 4 + 4 = 8.

Compare ∫ from −2 to 2 of (4x − x³) dx = 0: the two lobes cancel in the net integral, but the region has area 8.

**Worked example (Calculator).** Find the total area of the regions between y = 2 sin x and y = x for 0 ≤ x ≤ 3.

The graphs meet at x = 0 and, using the calculator's intersect feature, at x ≈ 1.895. On (0, 1.895) the sine curve is above the line; on (1.895, 3) the line is above. Write the setup, then the value:

Area = ∫ from 0 to 3 of |2 sin x − x| dx ≈ 2.203.

(The pieces are ≈ 0.842 and ≈ 1.362.) Without the absolute value the calculator returns ≈ −0.520, the net integral, which is not an area. Store the intersection in the calculator rather than retyping a rounded value, so the third decimal place stays correct.

## Choosing your approach

| The region… | Use |
|---|---|
| has one top curve and one bottom curve across its whole width | dx, one integral |
| has one right curve and one left curve across its whole height | dy, one integral |
| has a top or bottom that changes partway | dy, or split the dx integral where it changes |
| has curves that cross inside the interval | split at every crossing, or ∫ |f − g| on a calculator |
| is given by curves of the form x = g(y) | dy |

## Common mistakes

- **Using y-values as x-limits (or the reverse).** For y = x² and y = 2x the intersection points are (0, 0) and (2, 4): a dx integral runs from 0 to 2, a dy integral from 0 to 4.
- **Subtracting in the wrong order.** A negative area means bottom − top or left − right. Test a point.
- **Forgetting to rewrite in y.** In a dy integral every boundary must be x = (expression in y).
- **Missing an intersection.** Solving x³ = 4x by dividing by x loses x = 0. Move everything to one side and factor.
- **Reporting the net integral as the area.** If the curves cross, either split or use the absolute value.
- **Putting the absolute value outside.** |∫ (f − g) dx| still lets the pieces cancel first; the absolute value belongs inside the integral.
- **A calculator answer with no setup.** On the AP exam, the integral (limits, integrand and differential) must appear before the number.

## Self-check

1. Find the area enclosed by y = x² and y = x + 6.
2. Write, but do not evaluate, a dy integral for the area enclosed by x = y² − 4 and x = 0.
3. Find the total area between y = x³ − x and the x-axis for −1 ≤ x ≤ 1.
4. The graphs of f and g cross at x = 1 and x = 3 on [0, 4]. Explain why ∫ from 0 to 4 of (f − g) dx might not be the area between them.
5. The region between y = √x, y = 0 and x = 9: compute its area with dx and with dy.

*Answers:* 1. Intersections x = −2 and 3; ∫ from −2 to 3 of (x + 6 − x²) dx = 125/6. 2. ∫ from −2 to 2 of (0 − (y² − 4)) dy (which equals 32/3). 3. 1/4 + 1/4 = 1/2. 4. Between crossings the top curve changes, so some pieces count negatively in the net integral; split at x = 1 and x = 3 or integrate |f − g|. 5. ∫ from 0 to 9 of √x dx = 18; ∫ from 0 to 3 of (9 − y²) dy = 27 − 9 = 18.

---

*Original study material for this course, organised around the College Board AP Calculus AB and BC Course and Exam Description (Unit 8, Topics 8.4–8.6). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). AP® is a trademark of the College Board, which does not endorse this material.*
