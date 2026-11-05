# Week 30 · Parametric Equations

**Topics:** 5.9 Parametric Equations and Eliminating the Parameter
**Standards:** HSF-TF.C.8 (extension), HSN-VM.A.1, HSF-BF.A.1 (modelling with functions)
**Spiral:** Week 6's Pythagorean identity sin²t + cos²t = 1 is the main tool for removing the parameter from circle and ellipse equations. Week 4's angular speed tells you how fast a point goes round a circle, and week 23's vectors describe a straight-line motion as a starting point plus a multiple of a direction. Weeks 26 and 27 already described curves by a second variable (θ in polar form); this week the extra variable is usually time.

## What you need to be able to do

- **5.9** Plot a curve given by x = f(t), y = g(t) from a table of values, and mark its orientation with arrows.
- **5.9** Find the starting point, ending point and any special point (highest, lowest, crossing an axis) of a curve on a restricted interval of t.
- **5.9** Eliminate the parameter algebraically (solve for t and substitute) or with an identity (sin²t + cos²t = 1, sec²t − tan²t = 1), and state any restriction on x or y that the parametric form imposes.
- **5.9** Write parametric equations for a line segment, a circle or an ellipse with a given centre, a given direction of travel, and the graph of a function y = f(x).
- **5.9** Explain why two different parametrisations can trace the same set of points, or only part of it.

## Key terms

| Term | Meaning |
|---|---|
| Parameter | A third variable, often t for time, that both x and y depend on. |
| Parametric equations | A pair x = f(t), y = g(t) together with an interval for t. |
| Plane curve | The set of points (f(t), g(t)) as t runs over its interval. |
| Orientation | The direction in which the point moves as t increases, shown by arrows on the curve. |
| Initial and terminal points | The points at the smallest and largest values of t, when the interval is closed. |
| Eliminating the parameter | Combining the two equations into one equation in x and y that the points satisfy. |

## Plotting from a table (5.9)

A parametric curve carries more information than its graph: it says **where** the point is **when**. To plot one, choose values of t, compute x and y for each, plot the points in order and join them, adding arrows in the direction of increasing t.

**Worked example 1.** Plot x = 2t − 1, y = t² − 3 for −2 ≤ t ≤ 2, and describe the curve.

| t | −2 | −1 | 0 | 1 | 2 |
|---|---|---|---|---|---|
| x | −5 | −3 | −1 | 1 | 3 |
| y | 1 | −2 | −3 | −2 | 1 |

The point starts at (−5, 1), falls to the lowest point (−1, −3) at t = 0, and rises to (3, 1). Because x = 2t − 1 always increases, the curve is traced from left to right. It looks like a parabola opening upward; eliminating t will confirm it.

To eliminate the parameter, solve the simpler equation for t: t = (x + 1)/2. Substitute: y = ((x + 1)/2)² − 3 = (x + 1)²/4 − 3. The restriction −2 ≤ t ≤ 2 becomes −5 ≤ x ≤ 3, so the curve is only an arc of that parabola.

## Hidden restrictions (5.9)

The rectangular equation can describe more points than the parametric curve. Always ask which values x and y can actually take.

**Worked example 2.** Eliminate the parameter from x = √t, y = t + 2, t ≥ 0.

From x = √t, t = x², so y = x² + 2. But x = √t is never negative, so the curve is only the **right half** of the parabola, x ≥ 0, starting at (0, 2) and moving up and to the right.

Similarly x = t², y = t⁴ gives y = x², but only for x ≥ 0, while x = t, y = t² gives the whole parabola. Same equation, different curves.

## Eliminating with an identity (5.9)

When x and y involve sine and cosine of the same angle, isolate them and use sin²t + cos²t = 1.

**Worked example 3.** Describe x = 3 cos t, y = 2 sin t for 0 ≤ t ≤ 2π.

cos t = x/3 and sin t = y/2, so (x/3)² + (y/2)² = 1, that is x²/9 + y²/4 = 1: an ellipse centred at the origin with horizontal semi-axis 3 and vertical semi-axis 2. At t = 0 the point is (3, 0); at t = π/2 it is (0, 2). It moves counterclockwise and goes round exactly once.

Centres and radii come straight from the form:

- x = h + r cos t, y = k + r sin t is the circle (x − h)² + (y − k)² = r², counterclockwise from (h + r, k).
- x = h + a cos t, y = k + b sin t is the ellipse (x − h)²/a² + (y − k)²/b² = 1.
- Swapping to x = r cos t, y = −r sin t (or x = r sin t, y = r cos t) reverses the direction to **clockwise**.
- x = r cos(ωt), y = r sin(ωt) goes round once every 2π/ω units of time (week 4's angular speed ω).

With other functions, find the identity that links them. For x = sec t, y = tan t, use sec²t − tan²t = 1 to get x² − y² = 1, a hyperbola. For x = sin t, y = cos 2t, use cos 2t = 1 − 2sin²t (week 16) to get y = 1 − 2x², restricted to −1 ≤ x ≤ 1; as t increases the point slides back and forth along that arc rather than travelling round a loop.

## Writing parametric equations (5.9)

**The graph of a function.** For y = f(x), let x = t and y = f(t). For y = x³ − x: x = t, y = t³ − t, traced left to right.

**A line segment.** Start at P(x₁, y₁), go to Q(x₂, y₂) and let t run from 0 to 1:

x = x₁ + (x₂ − x₁)t, y = y₁ + (y₂ − y₁)t, 0 ≤ t ≤ 1.

This is week 23's idea in coordinates: start point plus t times the displacement vector ⟨x₂ − x₁, y₂ − y₁⟩.

**Worked example 4.** Parametrise the segment from (1, −2) to (7, 1), and find where the point is when it has gone a third of the way.

The displacement is ⟨6, 3⟩, so x = 1 + 6t, y = −2 + 3t, 0 ≤ t ≤ 1. At t = 1/3, the point is (3, −1). Check: t = 1 gives (7, 1). To travel the segment in 4 seconds instead, replace t by t/4: x = 1 + 1.5t, y = −2 + 0.75t, 0 ≤ t ≤ 4.

**Worked example 5.** A hypothetical carousel horse moves on a circle of radius 5 m centred at (0, 0), starting at (5, 0) and going counterclockwise once every 20 seconds. Write its position as a function of time t in seconds, and find where it is at t = 5 and t = 12.

ω = 2π/20 = π/10 radians per second, so x = 5 cos(πt/10), y = 5 sin(πt/10). At t = 5: (5 cos(π/2), 5 sin(π/2)) = (0, 5). At t = 12: angle 6π/5, so (5 cos(6π/5), 5 sin(6π/5)) ≈ (−4.05, −2.94).

**Try it.**
1. Eliminate the parameter: x = t + 1, y = 3 − 2t.
2. Describe x = −2 + 4 cos t, y = 1 + 4 sin t for 0 ≤ t ≤ π.
3. Parametrise the segment from (−3, 4) to (5, 0).

*Answers:* 1. t = x − 1, so y = 3 − 2(x − 1) = 5 − 2x, a whole line. 2. The upper half of the circle with centre (−2, 1) and radius 4, from (2, 1) counterclockwise to (−6, 1). 3. x = −3 + 8t, y = 4 − 4t, 0 ≤ t ≤ 1.

## Common errors

- **Dropping the restriction.** x = √t, x = t² and x = cos t all limit x; the rectangular equation alone does not.
- **Forgetting orientation.** The graph of x²/9 + y²/4 = 1 is the same for counterclockwise and clockwise motion; the parametric equations are not.
- **Squaring wrongly.** From cos t = x/3 the square is x²/9, not x²/3.
- **Assuming the curve is traced once.** x = cos 2t, y = sin 2t on [0, 2π] goes round the circle twice.
- **Mixing the segment formula.** The direction is Q − P, not P − Q; check that t = 0 gives the start and t = 1 the end.
- **Reading x as time.** In x = 2t − 1, y = t² − 3 the lowest point happens at t = 0, which is x = −1, not x = 0.

## Where this goes next

Week 31 uses parametric equations for projectiles: horizontal motion at constant speed, vertical motion pulled down by gravity, both as functions of time. Eliminating t there shows that the path is a parabola. Week 31 also writes conics in polar form, and week 32 uses x cos θ − y sin θ and x sin θ + y cos θ to rotate curves and points.

## Self-check

1. Plot x = t², y = t − 1 for −2 ≤ t ≤ 2, give the initial and terminal points, and eliminate the parameter.
2. Eliminate the parameter from x = 4 + cos t, y = −3 + 2 sin t and name the curve.
3. Write parametric equations for the circle of radius 6 centred at (2, −5), traced clockwise starting at (8, −5).
4. Explain why x = sin t, y = sin²t is not the whole parabola y = x².
5. A point moves from (0, 10) to (12, 1) at constant speed in 3 seconds. Write its position at time t and find it at t = 2.

---

*Original study material written for this course, organised around the Common Core State Standards for Mathematics (HSF-TF.C.8, HSN-VM.A.1, HSF-BF.A.1). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/).*
