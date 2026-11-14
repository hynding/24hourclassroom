# Week 20 · Connecting f, f′ and f″, Sketching Graphs and Implicit Relations

**Topics:** 5.8 Sketching Graphs of Functions and Their Derivatives · 5.9 Connecting a Function, Its First Derivative, and Its Second Derivative · 5.12 Exploring Behaviors of Implicit Relations
**Practices:** 2 (Connecting Representations), 3 (Justification), 1 (Implementing Mathematical Processes), 4 (Communication and Notation)
**Framework:** AP Calculus AB and BC CED, Unit 5, Topics 5.8, 5.9 and 5.12, learning objectives in our own words
**Spiral:** This week assembles weeks 17–19 into one picture. Week 18 gave you the sign of f′ (direction and relative extrema), week 19 the sign of f″ (concavity and inflection). Topic 5.12 brings back week 11's implicit differentiation and asks the same questions of curves that are not graphs of functions. Limits at infinity (week 5) and L'Hospital's rule (week 16) supply end behavior.

## What you need to be able to do

- **5.9** Given the graph of f′ (or f″), describe f: where it increases and decreases, its relative extrema, its concavity and inflection points, and values of f″ from slopes of the f′ graph.
- **5.9** Decide which of several graphs or tables could be f, f′ or f″, using sign and direction.
- **5.8** Sketch the graph of a function from its formula, or from sign information about f′ and f″, showing extrema, inflection points and end behavior.
- **5.12** For a curve defined implicitly, find points with horizontal or vertical tangent lines.
- **5.12** Find d²y/dx² implicitly and use it to decide concavity or to classify a point with a horizontal tangent.

## Key terms

| Term | Meaning |
|---|---|
| Graph of f′ | The graph whose height at x is the slope of f at x. |
| Slope of the f′ graph | f″(x): the rate at which the slope of f is changing. |
| Implicit relation | An equation in x and y, such as x² − xy + y² = 3, that need not define y as a single function of x. |
| Horizontal tangent (implicit) | A point on the curve where dy/dx = 0: numerator zero, denominator not. |
| Vertical tangent (implicit) | A point on the curve where the denominator of dy/dx is 0 and the numerator is not. |

## Reading f from the graph of f′ (5.9)

This is one of the most frequent AP setups. The key is to remember what the height of the f′ graph means (the slope of f) and what the slope of the f′ graph means (f″).

| On the graph of f′ | For f |
|---|---|
| Above the axis | increasing |
| Below the axis | decreasing |
| Crosses the axis from + to − | relative maximum |
| Crosses the axis from − to + | relative minimum |
| Touches the axis without crossing | critical point, no extremum |
| Rising | concave up (f″ > 0) |
| Falling | concave down (f″ < 0) |
| A peak or valley | point of inflection |
| Slope of a segment | value of f″ there |

**Worked example 1.** A function f is continuous on [−3, 4], and the graph of f′ consists of segments joining (−3, −2), (−1, 2), (2, −1) and (4, 1).

First find where f′ = 0. On the first segment f′ rises 4 units over 2, slope 2, from −2: zero at x = −2. On the second it falls 3 over 3, slope −1, from 2 at x = −1: zero at x = 1. On the third it rises 2 over 2, slope 1, from −1 at x = 2: zero at x = 3.

| Interval | (−3, −2) | (−2, −1) | (−1, 1) | (1, 2) | (2, 3) | (3, 4) |
|---|---|---|---|---|---|---|
| Sign of f′ | − | + | + | − | − | + |
| f′ rising or falling | rising | rising | falling | falling | rising | rising |
| f | dec, up | inc, up | inc, down | dec, down | dec, up | inc, up |

- Relative minima at x = −2 and x = 3 (f′ changes − to +); relative maximum at x = 1 (+ to −). Justify each with the sign change of f′.
- Points of inflection at x = −1 and x = 2, because f′ changes from increasing to decreasing (at −1) and from decreasing to increasing (at 2). Equivalently, f″ changes sign there.
- f″(0) = −1, the slope of the middle segment. f″(−1) does not exist (a corner on the f′ graph), which is fine for an inflection point.

Do not read the f′ graph as if it were f. Its highest point (−1, 2) is where f is climbing fastest, not a maximum of f.

**From tables.** A table of f values with equal steps shows direction through the signs of the changes and concavity through whether the changes grow or shrink. 10, 6, 3, 1 is decreasing (changes negative) and concave up (changes −4, −3, −2 increasing). A table of f′ and f″ at a few points supports pointwise conclusions only: f′(3) = 0 with f″(3) > 0 gives a relative minimum at 3, but f″(2) = 0 alone does not give an inflection point, because you cannot see a sign change.

**From the graph of f″.** One step further removed: f″ above the axis means f is concave up and f′ is increasing. A sign change of f″ is an inflection point of f and a relative extremum of f′.

## Sketching from derivatives (5.8)

A complete sketch shows where the function rises and falls, how it bends, and what happens at the edges. A checklist:

1. Domain, intercepts, symmetry (even or odd).
2. Vertical asymptotes and end behavior (limits as x → ±∞).
3. f′: critical points and a sign chart → increasing, decreasing, relative extrema.
4. f″: candidates and a sign chart → concavity, inflection points.
5. Plot the special points and join them with the right shape on each interval.

**Worked example 2.** Sketch f(x) = x e^(−x²/2).

- Domain all reals; f(0) = 0; f(−x) = −f(x), so f is odd (symmetric about the origin).
- End behavior: lim (x→∞) x/e^(x²/2) has the form ∞/∞; L'Hospital's rule gives lim 1/(x e^(x²/2)) = 0. By symmetry the limit at −∞ is 0 too. The x-axis is a horizontal asymptote.
- f′(x) = e^(−x²/2) + x(−x)e^(−x²/2) = (1 − x²)e^(−x²/2). Sign of 1 − x²: −, +, − on x < −1, −1 < x < 1, x > 1. Relative minimum at (−1, −e^(−1/2)) ≈ (−1, −0.607); relative maximum at (1, 0.607).
- f″(x) = −2x e^(−x²/2) − x(1 − x²)e^(−x²/2) = (x³ − 3x)e^(−x²/2) = x(x² − 3)e^(−x²/2). Sign: −, +, −, + on the intervals split at −√3, 0, √3. Inflection points at x = −√3 ≈ −1.73, 0 and √3.

The picture: from 0 at the far left the graph dips (concave down, then concave up after −√3) to its minimum at x = −1, climbs through the origin (steepest there, an inflection point) to the maximum at x = 1, then falls back toward 0, changing to concave up at x = √3 as it flattens onto the asymptote. Because the maximum is the only relative maximum and f < 0 for x < 0, the value 0.607 is the absolute maximum.

**Matching a cubic and its derivative.** If a cubic has a relative maximum at x = −1 and a relative minimum at x = 3, its derivative is a quadratic with zeros at −1 and 3, positive outside them and negative between: an upward parabola with vertex at x = 1, where the cubic's inflection point is.

## Implicit relations (5.12)

A curve such as x² − xy + y² = 3 (a tilted ellipse) is not the graph of one function, but each point on it still has a tangent line with slope dy/dx, found by implicit differentiation (week 11). Now use that slope to describe the curve.

- **Horizontal tangent:** dy/dx = 0. Set the numerator of dy/dx to 0, solve together with the equation of the curve, and check that the denominator is not 0 there.
- **Vertical tangent:** set the denominator to 0, solve with the curve's equation, and check that the numerator is not 0.
- If both are 0 at a point, the formula is 0/0 and tells you nothing; investigate another way.

**Worked example 3.** For x² − xy + y² = 3, differentiating gives 2x − (y + x y′) + 2y y′ = 0, so

dy/dx = (y − 2x)/(2y − x).

Horizontal tangents: y = 2x. Substituting, x² − 2x² + 4x² = 3x² = 3, so x = ±1, giving (1, 2) and (−1, −2). The denominator there is 3 and −3, not 0. Vertical tangents: x = 2y. Substituting, 4y² − 2y² + y² = 3y² = 3, so y = ±1, giving (2, 1) and (−2, −1). These are the highest, lowest, rightmost and leftmost points of the ellipse.

A quick vertical-tangent example: for x = y² − 4y, differentiating with respect to x gives 1 = (2y − 4) dy/dx, so dy/dx = 1/(2y − 4). It is undefined at y = 2, the point (−4, 2), the vertex of this sideways parabola.

**Second derivatives implicitly.** Differentiate dy/dx with respect to x (quotient rule, treating y as a function of x), then substitute the formula for dy/dx.

**Worked example 4.** For x² + y² = 25, dy/dx = −x/y. Then

d²y/dx² = −(y · 1 − x · dy/dx)/y² = −(y + x²/y)/y² = −(y² + x²)/y³ = −25/y³,

using the original equation in the last step. At (3, 4), d²y/dx² = −25/64 < 0, so the circle is concave down there; in fact it is concave down at every point with y > 0 and concave up at every point with y < 0.

A horizontal tangent on an implicit curve can be classified like a critical point: if dy/dx = 0 and d²y/dx² < 0 at that point, the curve has a local maximum height there. At (0, 5) on the circle, dy/dx = 0 and d²y/dx² = −25/125 = −1/5 < 0: the top of the circle.

## Common mistakes

- **Treating the graph of f′ as the graph of f.** Peaks of f′ are inflection points of f; zeros of f′ are the extrema.
- **Calling a point an inflection point from a single table entry f″(c) = 0.** You need evidence of a sign change.
- **Forgetting the corners of a piecewise-linear f′.** f″ does not exist there, yet they are often inflection points.
- **Finding a horizontal-tangent condition without the curve.** "y = 2x" is not an answer; substitute into the equation to find actual points.
- **Skipping the check that the other part of dy/dx is nonzero.** A 0/0 point is not a horizontal or vertical tangent by this test.
- **Differentiating −x/y as −1/y.** y is a function of x, so the quotient rule (or product rule) is required.
- **Leaving d²y/dx² in terms of y′.** Substitute dy/dx to get an expression in x and y.

## Self-check

1. The graph of f′ is a parabola opening downward with x-intercepts at 0 and 4. Describe f: increasing interval, relative extrema, concavity and inflection point.
2. A table has f(0) = 2, f(1) = 5, f(2) = 7, f(3) = 8. What signs of f′ and f″ are consistent with it?
3. Find the points on y² − x² = 4 where the tangent line is horizontal. Does the curve have any vertical tangents?
4. For xy = 4, show that d²y/dx² = 8/x³, and decide where the curve is concave up.
5. A function has f′ > 0 and f″ < 0 on (0, ∞), and lim (x→∞) f(x) = 3. Sketch a possible graph in words.

*Answers:* 1. f′ > 0 on (0, 4): increasing there; relative minimum at 0, relative maximum at 4; f′ rises then falls with peak at x = 2, so f is concave up for x < 2, concave down for x > 2, inflection at x = 2. 2. f′ > 0 (rising), f″ < 0 (changes 3, 2, 1 shrinking). 3. 2y y′ − 2x = 0 gives y′ = x/y = 0 at x = 0: points (0, 2) and (0, −2). Vertical needs y = 0, but then −x² = 4 has no solution: no vertical tangents. 4. y′ = −y/x = −4/x², so y″ = 8/x³; concave up for x > 0. 5. A curve rising more and more slowly toward the horizontal asymptote y = 3 from below.

---

*Original study material for this course, organised around the College Board AP Calculus AB and BC Course and Exam Description (Unit 5, Topics 5.8, 5.9 and 5.12). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). AP® is a trademark of the College Board, which does not endorse this material.*
