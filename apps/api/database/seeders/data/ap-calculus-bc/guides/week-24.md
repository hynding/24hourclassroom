# Week 24 · Parametric Equations: Slopes, Concavity and Arc Length

**Topics:** 9.1 Defining and Differentiating Parametric Equations · 9.2 Second Derivatives of Parametric Equations · 9.3 Finding Arc Lengths of Curves Given by Parametric Equations
**Practices:** 1 (Implementing Mathematical Processes), 2 (Connecting Representations), 3 (Justification), 4 (Communication and Notation)
**Framework:** AP Calculus AB and BC CED, Unit 9, Topics 9.1–9.3, learning objectives in our own words
**Spiral:** The chain rule and implicit differentiation (Unit 3) are the engine behind every slope this week. Concavity tests come from Unit 5, and the arc length integral extends week 23's arc length of y = f(x). The integration techniques of week 16 (substitution, parts) are what make a length integral come out exactly.

## What you need to be able to do

- **9.1** Read a parametric curve x = x(t), y = y(t): plot points, describe its orientation, and eliminate the parameter when that helps.
- **9.1** Find dy/dx = (dy/dt)/(dx/dt), write tangent lines, and locate horizontal and vertical tangents, handling the case where both derivatives are zero.
- **9.2** Find d²y/dx² = [d/dt (dy/dx)]/(dx/dt) and use its sign to decide concavity.
- **9.3** Set up and evaluate the length ∫ from a to b of √((dx/dt)² + (dy/dt)²) dt, exactly when the integrand simplifies and with a calculator otherwise.

## Key terms

| Term | Meaning |
|---|---|
| Parameter | The independent variable t; each t gives one point (x(t), y(t)). |
| Parametric curve | The set of points traced as t runs over an interval. |
| Orientation | The direction the point moves as t increases. |
| Eliminating the parameter | Solving for t (or using an identity) to get one equation in x and y. |
| Horizontal tangent | dy/dt = 0 with dx/dt ≠ 0. |
| Vertical tangent | dx/dt = 0 with dy/dt ≠ 0. |
| Smooth curve | x′ and y′ are continuous and never both zero on the interval. |
| Arc length | The distance measured along the curve. |

## Parametric curves and their slopes (9.1)

A parametric curve hands you x and y separately, each as a function of a third variable t. Think of t as time and (x(t), y(t)) as the position of a moving point: the curve is the path, and the orientation is the direction of travel. Sometimes the parameter can be removed. For x = t + 1, y = t², solving the first equation gives t = x − 1 and so y = (x − 1)², a parabola. For x = 4 cos t, y = 3 sin t the identity cos²t + sin²t = 1 gives (x/4)² + (y/3)² = 1, an ellipse traced counterclockwise from (4, 0). Eliminating the parameter tells you the shape, but it throws away the timing and the direction, which is why calculus on these curves is done directly in t.

**The slope.** If y can be thought of as a function of x near a point, the chain rule says dy/dt = (dy/dx)(dx/dt). Divide:

**dy/dx = (dy/dt)/(dx/dt), wherever dx/dt ≠ 0.**

You never need to eliminate the parameter to find a slope.

**Horizontal and vertical tangents.** The slope is zero when the numerator is zero and the denominator is not: dy/dt = 0, dx/dt ≠ 0 gives a horizontal tangent. The slope is undefined when only the denominator is zero: dx/dt = 0, dy/dt ≠ 0 gives a vertical tangent. When both are zero the formula gives 0/0 and tells you nothing on its own. Simplify dy/dx as a function of t and take a limit, or look at the shape; the curve may have a cusp, or a perfectly ordinary tangent.

**Direction of motion.** The sign of dx/dt tells you whether the point moves right (positive) or left (negative) as t increases, and dy/dt does the same for up and down. That is the same reading you did for a particle on a line in Unit 4, done once for each coordinate.

**Worked example 1.** Let C be x = t² − 2t, y = t³ − 12t.

- dx/dt = 2t − 2 and dy/dt = 3t² − 12, so dy/dx = (3t² − 12)/(2t − 2).
- **Tangent line at t = 3.** The point is (9 − 6, 27 − 36) = (3, −9). The slope is 15/4. Tangent line: y + 9 = (15/4)(x − 3).
- **Horizontal tangents.** 3t² − 12 = 0 at t = ±2. There dx/dt = 2 and −6, not zero. Points: t = 2 gives (0, −16) and t = −2 gives (8, 16).
- **Vertical tangent.** 2t − 2 = 0 at t = 1, where dy/dt = −9 ≠ 0. Point (−1, −11).

**Worked example 2 (both derivatives zero).** For x = t³ − 3t, y = t² − 2t, at t = 1 both dx/dt = 3t² − 3 and dy/dt = 2t − 2 are zero. Factor: dy/dx = 2(t − 1)/(3(t − 1)(t + 1)) = 2/(3(t + 1)) for t ≠ ±1. As t → 1 the slope tends to 1/3, so the tangent at t = 1 is neither horizontal nor vertical. At t = −1 only dx/dt is zero (dy/dt = −4), so there is a vertical tangent at (2, 3).

**Tangent lines from a table.** If x(2) = 4, y(2) = 1, x′(2) = −3 and y′(2) = 5, the slope at t = 2 is 5/(−3) = −5/3 and the tangent line is y − 1 = −(5/3)(x − 4). To approximate y where x = 3.7, substitute: 1 + (−5/3)(−0.3) = 1.5. This is the local linearity of Unit 4, applied to a curve given in t.

## Second derivatives and concavity (9.2)

The slope dy/dx is itself a function of t. To find how fast the slope changes with respect to x, apply the same chain rule idea again:

**d²y/dx² = [d/dt (dy/dx)] / (dx/dt).**

Two steps: differentiate the slope with respect to t, then divide by dx/dt. The sign of the result gives concavity: positive means concave up, negative means concave down. The quantity (d²y/dt²)/(d²x/dt²) is **not** the second derivative; it has no meaning for the shape of the curve.

**Worked example 3 (continuing C).** At t = 3,

d/dt [(3t² − 12)/(2t − 2)] = [6t(2t − 2) − 2(3t² − 12)]/(2t − 2)² = (6t² − 12t + 24)/(2t − 2)² = 42/16 = 21/8.

Divide by dx/dt = 4: d²y/dx² = 21/32 > 0, so C is concave up at t = 3. (The tempting wrong answer 6t/2 = 9 divides second derivatives.)

**Worked example 4 (an ellipse).** For x = 4 cos t, y = 3 sin t:

- dy/dx = (3 cos t)/(−4 sin t) = −(3/4)cot t.
- d/dt (−(3/4)cot t) = (3/4)csc²t.
- Divide by dx/dt = −4 sin t: d²y/dx² = −(3/16)csc³t.

For 0 < t < π, sin t > 0, so d²y/dx² < 0: the upper half of the ellipse is concave down, as the picture says. At t = π/4 the value is −(3/16)(2√2) = −3√2/8.

**Worked example 5 (where concave up).** For x = eᵗ, y = t²: dy/dx = 2t e^(−t); its t-derivative is 2e^(−t)(1 − t); dividing by eᵗ gives d²y/dx² = 2e^(−2t)(1 − t). The exponential is always positive, so the curve is concave up exactly when t < 1 and concave down when t > 1.

## Arc length of a parametric curve (9.3)

Over a short time dt the point moves dx ≈ x′(t) dt across and dy ≈ y′(t) dt up. By Pythagoras the bit of curve it covers has length √((x′ dt)² + (y′ dt)²) = √(x′² + y′²) dt. Adding these pieces gives

**L = ∫ from a to b of √((dx/dt)² + (dy/dt)²) dt,**

for a smooth curve traced exactly once as t runs from a to b. If the curve is traced twice (x = cos 2t, y = sin 2t on 0 ≤ t ≤ 2π goes round the unit circle twice), the integral counts it twice. With x = t and y = f(t) the formula becomes √(1 + f′(t)²), the week 23 formula, so parametric length is the general case.

Most length integrals have no elementary antiderivative and are calculator questions on the AP exam. A no-calculator length question is built so that x′² + y′² is a perfect square, or a product that a substitution handles.

**Worked example 6.** Find the length of x = 3t², y = 2t³ for 0 ≤ t ≤ 1.

(6t)² + (6t²)² = 36t² + 36t⁴ = 36t²(1 + t²), so the integrand is 6t√(1 + t²) (t ≥ 0). Let u = 1 + t², du = 2t dt, so 6t dt = 3 du:

L = ∫ from 1 to 2 of 3√u du = 2u^(3/2) from 1 to 2 = 4√2 − 2 ≈ 3.657.

Compare with the straight-line distance between the endpoints (0, 0) and (3, 2), √13 ≈ 3.606: the curve is a little longer, as it must be.

**Worked example 7 (a perfect square).** For x = t²/2, y = (1/3)(2t + 1)^(3/2), dx/dt = t and dy/dt = √(2t + 1). Then (dx/dt)² + (dy/dt)² = t² + 2t + 1 = (t + 1)², so the integrand is t + 1. From t = 0 to t = 4 the length is ∫ from 0 to 4 of (t + 1) dt = 8 + 4 = 12.

**With a calculator.** For x = ln(t + 1), y = t² on 0 ≤ t ≤ 2, enter ∫ from 0 to 2 of √(1/(t + 1)² + 4t²) dt; the calculator gives about 4.335. On the exam, write the integral before the number: the setup earns a point by itself.

## Common mistakes

- **Inverting the slope.** dy/dx is (dy/dt)/(dx/dt), the vertical change over the horizontal change.
- **Mixing up horizontal and vertical.** Horizontal tangent: dy/dt = 0. Vertical tangent: dx/dt = 0. Check that the other derivative is not also zero.
- **Dividing second derivatives.** d²y/dx² is d/dt (dy/dx) divided by dx/dt, never (d²y/dt²)/(d²x/dt²).
- **Stopping one step short.** After differentiating dy/dx with respect to t, you must still divide by dx/dt.
- **Adding instead of using Pythagoras.** The length integrand is √(x′² + y′²), not x′ + y′, and not √(x² + y²).
- **Losing the chain rule inside x′ or y′.** The derivative of cos(2t) is −2 sin(2t).
- **Mixing variables in the length integral.** Limits in t go with an integrand in t; if you rewrite the curve as y = f(x), the limits must become x-values.
- **Counting a retraced curve twice.** Use an interval on which the curve is traced exactly once.

## Self-check

1. For x = t² + 1, y = 2t³ − 3t², find every point where the tangent line is horizontal.
2. Write the line tangent to x = √t, y = t − 4 at t = 4.
3. For x = 2t, y = t³, find d²y/dx² in terms of t and say where the curve is concave down.
4. Find the length of x = 2 cos t, y = 2 sin t for 0 ≤ t ≤ π/2 and check it with geometry.
5. Set up (do not evaluate) the length of x = t², y = sin t for 0 ≤ t ≤ π.
6. Why does the formula dy/dx = (dy/dt)/(dx/dt) fail to decide the tangent at a point where dx/dt = dy/dt = 0?

*Answers:* 1. dy/dt = 6t² − 6t = 0 at t = 0 and t = 1, but dx/dt = 2t is zero at t = 0, so only t = 1 qualifies: (2, −1). (At t = 0, dy/dx = (6t − 6)/2 → −3.) 2. dx/dt = 1/(2√t) = 1/4 and dy/dt = 1 at t = 4, so the slope is 4; the point is (2, 0): y = 4(x − 2). 3. dy/dx = 3t²/2; d/dt = 3t; divide by 2: d²y/dx² = 3t/2, concave down for t < 0. 4. The integrand is √(4 sin²t + 4 cos²t) = 2, so L = 2 · π/2 = π, a quarter of a circle of radius 2 (circumference 4π). 5. ∫ from 0 to π of √(4t² + cos²t) dt. 6. It gives 0/0; the slope must come from simplifying dy/dx and taking a limit, or from the shape of the curve.

---

*Original study material for this course, organised around the College Board AP Calculus AB and BC Course and Exam Description (Unit 9, Topics 9.1–9.3). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). AP® is a trademark of the College Board, which does not endorse this material.*
