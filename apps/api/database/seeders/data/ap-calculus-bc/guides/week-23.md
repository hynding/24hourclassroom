# Week 23 · Arc Length and Distance Along a Curve

**Topics:** 8.13 The Arc Length of a Smooth, Planar Curve and Distance Traveled
**Practices:** 1 (Implementing Mathematical Processes), 2 (Connecting Representations), 3 (Justification), 4 (Communication and Notation)
**Framework:** AP Calculus AB and BC CED, Unit 8, Topic 8.13, learning objectives in our own words
**Spiral:** Weeks 21–22 used definite integrals to add up thin slices: rectangles for area between curves, discs, washers and cross sections for volume. This week the slices are tiny straight segments laid along a curve, and adding their lengths gives the curve's length. The setup leans on the derivative rules of Units 2 and 3 (you square a derivative), on rewriting a curve as x = g(y) as in week 21's horizontal slices, and, because most arc length integrals have no elementary antiderivative, on the graphing calculator. Parametric curves and the distance a particle travels along them come in Unit 9 (week 24); here the curves are graphs y = f(x) or x = g(y).

## What you need to be able to do

- **8.13** Set up the arc length of y = f(x) from x = a to x = b as ∫ from a to b of √(1 + (f′(x))²) dx, for f with a continuous derivative.
- **8.13** Set up the arc length of x = g(y) from y = c to y = d as ∫ from c to d of √(1 + (g′(y))²) dy, with limits in y.
- **8.13** Evaluate an arc length integral exactly when 1 + (f′)² simplifies (often to a perfect square), and with a calculator otherwise.
- **8.13** Interpret arc length as the distance traveled by something moving along the curve, and compare it with straight-line distance and with sums of chords.

## Key terms

| Term | Meaning |
|---|---|
| Arc length | The length of a curve between two of its points, measured along the curve. |
| Smooth curve | A curve given by a function with a continuous derivative on the interval (no corners, cusps or vertical tangents). |
| Arc length element | ds = √(1 + (dy/dx)²) dx, the length of a tiny piece of curve. |
| Chord | The straight segment joining two points of the curve; a sum of chords approximates arc length from below. |
| Distance traveled along a curve | For an object that traces the curve once, the arc length. |

## Where the formula comes from

Split [a, b] into small pieces of width Δx. Over one piece the curve rises about Δy, and the straight segment joining its ends has length √(Δx² + Δy²) by the Pythagorean theorem. Factor out Δx:

√(Δx² + Δy²) = √(1 + (Δy/Δx)²) · Δx.

By the Mean Value Theorem (week 10), Δy/Δx equals f′(c) for some c in the piece. So the sum of chord lengths is a Riemann sum for √(1 + (f′(x))²), and as Δx → 0 it becomes

**L = ∫ from a to b of √(1 + (f′(x))²) dx.**

Two consequences are worth keeping:

- The integrand is at least 1, so L ≥ b − a: a curve is never shorter than its horizontal extent. In fact L is at least the straight-line distance between the endpoints, and the sum of any chords is at most L.
- Only f′ appears. Shifting the graph up or down, or reflecting it across the x-axis, does not change its length; stretching it vertically does.

**Worked example 1 (a sanity check).** For the line y = 2x + 1 from x = 0 to x = 3, f′(x) = 2 and

L = ∫₀³ √(1 + 4) dx = 3√5 ≈ 6.708.

The endpoints are (0, 1) and (3, 7), at distance √(3² + 6²) = √45 = 3√5. The formula agrees with the distance formula, as it must.

## Exact arc lengths (8.13)

Square roots rarely have tidy antiderivatives, so exam questions that ask for an exact length are built so that 1 + (f′)² simplifies. Two patterns appear again and again.

**Pattern 1: 1 + (f′)² is linear.** Then the square root is a power you can integrate.

**Worked example 2.** Find the length of y = (2/3)x^(3/2) from x = 0 to x = 3.

f′(x) = x^(1/2), so 1 + (f′)² = 1 + x and

L = ∫₀³ √(1 + x) dx = (2/3)(1 + x)^(3/2) from 0 to 3 = (2/3)(8 − 1) = 14/3 ≈ 4.667.

**Pattern 2: 1 + (f′)² is a perfect square.** This happens when f′ = A − B with 4AB = 1, because then 1 + (A − B)² = (A + B)².

**Worked example 3.** Find the length of y = x³/6 + 1/(2x) from x = 1 to x = 2.

f′(x) = x²/2 − 1/(2x²). Squaring, (f′)² = x⁴/4 − 1/2 + 1/(4x⁴), so

1 + (f′)² = x⁴/4 + 1/2 + 1/(4x⁴) = (x²/2 + 1/(2x²))².

The square root is x²/2 + 1/(2x²) (positive), and

L = ∫₁² (x²/2 + 1/(2x²)) dx = [x³/6 − 1/(2x)] from 1 to 2 = (4/3 − 1/4) − (1/6 − 1/2) = 17/12 ≈ 1.417.

Always check the sign before dropping the square root: √(u²) = |u|.

## Curves written as x = g(y) (8.13)

If it is easier to describe the curve with x as a function of y, swap the roles of the variables:

**L = ∫ from c to d of √(1 + (g′(y))²) dy,**

where c and d are the **y-values** at the ends. This is the same idea as week 21's horizontal slices: the variable of integration is y, so the limits must be y-values.

**Worked example 4.** Find the length of x = y²/4 − (1/2) ln y from y = 1 to y = e.

g′(y) = y/2 − 1/(2y), and (y/2)(1/(2y)) = 1/4, so Pattern 2 applies: 1 + (g′)² = (y/2 + 1/(2y))². Then

L = ∫ from 1 to e of (y/2 + 1/(2y)) dy = [y²/4 + (1/2) ln y] from 1 to e = (e²/4 + 1/2) − 1/4 = (e² + 1)/4 ≈ 2.097.

**When to switch.** Rewriting in y also rescues curves that are not smooth as functions of x. The graph of y = x^(2/3) from x = 0 to x = 8 has f′(x) = (2/3)x^(−1/3), which is undefined at x = 0 (a vertical tangent), so the x-integral is improper. As a function of y the same piece of curve is x = y^(3/2) for 0 ≤ y ≤ 4, with g′(y) = (3/2)y^(1/2), continuous on [0, 4].

**Worked example 5.** L = ∫₀⁴ √(1 + (9/4)y) dy. Substitute u = 1 + (9/4)y, du = (9/4) dy, so u runs from 1 to 10:

L = (4/9) ∫ from 1 to 10 of u^(1/2) du = (4/9)(2/3)(10^(3/2) − 1) = (8/27)(10√10 − 1) ≈ 9.073.

## Calculator arc lengths and distance traveled (8.13)

Most curves give integrals with no elementary antiderivative: even y = x³ gives ∫ √(1 + 9x⁴) dx, and y = sin x gives ∫ √(1 + cos²x) dx. On the AP exam such questions are calculator-active: you write the integral (that is the setup point) and let the calculator evaluate it, reporting three decimal places.

**Worked example 6.** (Calculator.) Find the length of one arch of y = sin x, from x = 0 to x = π.

f′(x) = cos x, so L = ∫ from 0 to π of √(1 + cos²x) dx ≈ 3.820.

Compare: the straight-line distance between (0, 0) and (π, 0) is π ≈ 3.142, and the arch is longer, as it must be. Do not confuse the length with the area under the arch, which is 2.

**Distance traveled.** If something moves along a curve from one end to the other without doubling back, the distance it travels is the arc length, whatever its speed. Arc length measures the path; speed only decides how long the trip takes.

**Worked example 7.** (Calculator.) The profile of a hypothetical ski run is y = 40 − 0.1x² for 0 ≤ x ≤ 20, with x and y in meters. How far does a skier travel going from the top (x = 0) to the bottom (x = 20)?

y′ = −0.2x, so the distance is ∫₀²⁰ √(1 + 0.04x²) dx ≈ 46.468 meters. The horizontal distance is 20 m and the drop is 40 m; the straight-line distance √(20² + 40²) ≈ 44.721 m is a little less than the length of the run. If the skier averages 5 meters per second along the slope, the run takes about 46.468/5 ≈ 9.294 seconds.

**Approximating with chords.** If a table of points on a curve is given instead of a formula, add the lengths of the segments joining consecutive points. Each chord is shorter than the arc it spans, so a sum of chords underestimates the arc length, and more points give a better estimate.

## Common mistakes

- **Forgetting to square the derivative.** The integrand is √(1 + (f′)²), not √(1 + f′).
- **Putting f instead of f′ under the root.** √(1 + (f(x))²) measures nothing useful.
- **Dropping the square root.** ∫ (1 + (f′)²) dx is not a length; for y = x³ on [0, 1] it gives 2.8 instead of 1.548.
- **x-limits on a y-integral.** For x = g(y), integrate from the bottom y-value to the top y-value.
- **Confusing length with area.** The length of y = sin x on [0, π] is about 3.820; the area under it is 2.
- **Ignoring corners and vertical tangents.** If f′ is undefined inside or at an end of the interval, split the curve or rewrite it as x = g(y).
- **Taking √(u²) = u without checking the sign of u.**

## Self-check

1. Find the length of y = 4 − 3x from x = 1 to x = 5 two ways.
2. Set up, but do not evaluate, the length of y = eˣ from x = 0 to x = ln 2.
3. Find the exact length of y = (1/3)(x² + 2)^(3/2) from x = 0 to x = 1.
4. (Calculator.) Find the length of y = x³ from x = 0 to x = 1.
5. A curve is x = g(y) = y³ for 0 ≤ y ≤ 2. Set up its length as an integral in y, and give the x-values at its ends.

*Answers:* 1. ∫₁⁵ √(1 + 9) dx = 4√10 ≈ 12.649; the endpoints (1, 1) and (5, −11) are √(16 + 144) = √160 = 4√10 apart. 2. ∫ from 0 to ln 2 of √(1 + e^(2x)) dx. 3. f′(x) = x√(x² + 2), so 1 + (f′)² = x⁴ + 2x² + 1 = (x² + 1)²; L = ∫₀¹ (x² + 1) dx = 1/3 + 1 = 4/3. 4. ∫₀¹ √(1 + 9x⁴) dx ≈ 1.548. 5. ∫₀² √(1 + 9y⁴) dy; the ends are at x = 0 and x = 8.

---

*Original study material for this course, organised around the College Board AP Calculus AB and BC Course and Exam Description (Unit 8, Topic 8.13). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). AP® is a trademark of the College Board, which does not endorse this material.*
