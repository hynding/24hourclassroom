# Week 07 · Estimating Derivatives and When Derivatives Exist

**Topics:** 2.3 Estimating Derivatives of a Function at a Point · 2.4 Connecting Differentiability and Continuity: Determining When Derivatives Do and Do Not Exist
**Practices:** 2 (Connecting Representations), 3 (Justification), 1 (Implementing Mathematical Processes)
**Framework:** AP Calculus AB and BC CED, Unit 2, Topics 2.3–2.4, learning objectives in our own words
**Spiral:** Week 6 defined the derivative as the limit of a difference quotient. This week you stop short of the limit on purpose: when all you have is a table, a graph or a calculator, a difference quotient with a small h is the best estimate available. Then you ask when the limit exists at all, which leans on week 2's one-sided limits and week 4's definition of continuity.

## What you need to be able to do

- **2.3** Estimate f′(a) from a table by using the closest data on either side of a, including unevenly spaced inputs, and state the units.
- **2.3** Estimate f′(a) from a graph by finding the slope of the tangent line, not of a secant joining two points on the curve.
- **2.3** Compute forward, backward and symmetric difference quotients, and use a calculator's numerical derivative, knowing what it actually computes.
- **2.4** Explain why differentiability at a point implies continuity there, and use the contrapositive to rule out derivatives at discontinuities.
- **2.4** Identify corners, cusps and vertical tangents as the places where a continuous function can fail to be differentiable, using one-sided difference quotients.
- **2.4** Decide whether a piecewise-defined function is differentiable where its pieces meet, and choose constants that make it so.

## Key terms

| Term | Meaning |
|---|---|
| Forward difference quotient | (f(a + h) − f(a))/h with h > 0: a secant slope to the right of a. |
| Backward difference quotient | (f(a) − f(a − h))/h with h > 0: a secant slope to the left of a. |
| Symmetric difference quotient | (f(a + h) − f(a − h))/(2h): the secant slope across a. |
| Numerical derivative | A calculator's estimate of f′(a), a symmetric difference quotient with a tiny h. |
| Differentiable at a | f′(a) exists: both one-sided limits of the difference quotient exist, are finite and agree. |
| Corner | One-sided difference quotients approach two different finite numbers. |
| Cusp | One-sided difference quotients approach ∞ on one side and −∞ on the other. |
| Vertical tangent | Both one-sided difference quotients approach the same infinity. |

## Estimating derivatives from tables (2.3)

A table gives values only at some inputs, so you cannot take a limit. Instead, use the average rate of change over the **smallest interval in the table that contains the point**:

  f′(a) ≈ (f(b) − f(c))/(b − c), where c and b are the closest inputs with c ≤ a ≤ b.

If a itself is in the table, use the readings just before and just after it (a symmetric choice), unless the question says otherwise. Always divide by the actual gap in the inputs; AP tables are often unevenly spaced on purpose.

**Worked example (a table).** A bakery tests a new oven. Its temperature T(t), in °C, t minutes after it is switched on is recorded below (hypothetical data).

| t (minutes) | 0 | 2 | 5 | 6 | 9 |
|---|---|---|---|---|---|
| T(t) (°C) | 20 | 34 | 52 | 57 | 70 |

Estimate T′(4). The readings at t = 2 and t = 5 bracket 4, so T′(4) ≈ (52 − 34)/(5 − 2) = 6 °C per minute. In context: about 4 minutes after switching on, the oven's temperature is rising at roughly 6 °C per minute.

Now compare the average rates on consecutive intervals: 7, 6, 5 and 13/3 ≈ 4.33 °C per minute. The temperature is increasing, but the rate is decreasing, so T′ appears to be decreasing and the graph of T appears concave down. A good written answer separates the two ideas: the *temperature* is going up; the *rate* is going down.

**From a graph.** To estimate f′(a) from a graph, draw (or read) the tangent line at (a, f(a)) and find its slope from two well-separated points **on the line**. If the problem tells you the tangent line passes through (1, 3) and (3, 7), then the derivative at x = 1 is (7 − 3)/(3 − 1) = 2. Two points on the curve itself give a secant slope, which is only an approximation.

## Difference quotients and the calculator (2.3)

With a formula but no derivative rule, choose a small h and compute one of three quotients:

- forward: (f(a + h) − f(a))/h
- backward: (f(a) − f(a − h))/h
- symmetric: (f(a + h) − f(a − h))/(2h)

**Worked example (symmetric estimates).** Estimate the derivative of f(x) = 2ˣ at x = 1.

| h | forward | backward | symmetric |
|---|---|---|---|
| 0.1 | 1.4355 | 1.3393 | 1.3874 |
| 0.01 | 1.3911 | 1.3815 | 1.3863 |
| 0.001 | 1.3868 | 1.3858 | 1.3863 |

The forward quotients are too large and the backward ones too small, because the graph bends upward. The symmetric quotient averages the two and is already accurate to three decimal places at h = 0.01. The derivative is about **1.386**. (Unit 3 shows the exact value is 2 ln 2.)

A graphing calculator's numerical derivative (nDeriv, or the d/dx template) computes exactly this kind of symmetric quotient with a very small h. That makes it fast and usually accurate, but it is still an estimate, and it can be fooled: for f(x) = |x| at x = 0 the symmetric quotient is (|h| − |−h|)/(2h) = 0 for every h, so the calculator reports 0 even though the derivative does not exist. Always ask whether the function is smooth at the point before trusting the number.

## Differentiability implies continuity (2.4)

If f′(a) exists, then f is continuous at a. The reason is one line of limit algebra:

  f(a + h) − f(a) = h · (f(a + h) − f(a))/h → 0 · f′(a) = 0 as h → 0,

so f(a + h) → f(a). The useful form on exams is the **contrapositive**: if f is not continuous at a (a hole, a jump, an asymptote, or a point where f is undefined), then f is not differentiable at a. No difference quotient is needed.

The converse is false. A continuous function can still fail to be differentiable, in three ways.

**Corners.** The one-sided difference quotients have different finite limits.

**Worked example (a corner).** Let f(x) = |2x − 6|. Is f differentiable at x = 3?

f(3) = 0 and f(3 + h) = |2h|. For h > 0 the quotient is 2h/h = 2; for h < 0 it is −2h/h = −2. The right-hand limit is 2 and the left-hand limit is −2. They differ, so f′(3) does not exist, even though f is continuous at 3 (both one-sided limits of f equal 0 = f(3)).

**Cusps and vertical tangents.** The difference quotient grows without bound.

**Worked example (a vertical tangent).** Is g(x) = ∛x differentiable at x = 0?

g(0) = 0, so the quotient is ∛h/h = 1/∛(h²). As h → 0 from either side, ∛(h²) is a small positive number, so the quotient → ∞. The tangent line at the origin is vertical (the line x = 0), and a vertical line has no slope, so g′(0) does not exist. For x^(2/3) the quotient is 1/∛h, which → ∞ from the right and −∞ from the left: a cusp.

Not every absolute value or root makes trouble. For x|x| the quotient at 0 is |h| → 0, so the derivative exists and equals 0. For |x² − 4| the corners appear only at x = ±2, where x² − 4 changes sign; at x = 0 the graph is the smooth parabola 4 − x².

## Piecewise functions (2.4)

Where two pieces meet at x = c, check two things in order:

1. **Continuity.** The pieces must give the same value at c (and that must be f(c)). If not, stop: f is not differentiable at c.
2. **Matching slopes.** The derivatives of the two pieces must agree at c. If they differ, there is a corner.

**Worked example (matching value and slope).** Find k and m so that f(x) = x² + 1 for x ≤ 3 and f(x) = kx + m for x > 3 is differentiable at x = 3. (The derivative of x² is 2x, from week 6.)

Slopes: the left piece has slope 2(3) = 6 at x = 3 and the right piece has slope k, so k = 6. Values: the left piece gives 9 + 1 = 10, the right piece gives 3k + m = 18 + m, so m = −8. The line y = 6x − 8 is the tangent line to y = x² + 1 at x = 3, which is why the join is smooth.

Matching slopes alone is not enough: the piecewise function x² + 1 (x ≤ 3) and 6x (x > 3) has equal one-sided slopes but jumps from 10 to 18, so it is not even continuous at 3.

## Common mistakes

- **Dividing by the wrong gap.** From t = 2 to t = 5 the denominator is 3; a symmetric quotient divides by 2h.
- **Using a secant on the curve instead of the tangent line** when estimating from a graph.
- **Saying the quantity is decreasing when the rate is decreasing.** Rising temperatures with shrinking rates are still rising.
- **Trusting a calculator at a corner.** nDeriv(|x|, x, 0) returns 0; the derivative does not exist.
- **Assuming continuous means differentiable.** Check the one-sided difference quotients.
- **Checking only slopes for a piecewise function.** Continuity must be checked first.
- **Assuming any absolute value makes a corner.** Look for a sign change inside the absolute value.

## Self-check

1. Using the oven table, estimate T′(7.5) and interpret it.
2. Compute the symmetric difference quotient for f(x) = x³ at x = 1 with h = 0.1. How does it compare with the exact value 3?
3. Where is f(x) = |x − 1| + |x + 2| not differentiable? Give the one-sided slopes at each point.
4. Is f(x) = (x − 4)^(1/3) differentiable at x = 4? Describe the graph there.
5. Find a and b so that f(x) = ax² for x ≤ 1 and f(x) = 4x + b for x > 1 is differentiable at x = 1.

*Answers:* 1. (70 − 57)/(9 − 6) ≈ 4.33 °C per minute: about 7.5 minutes in, the temperature is rising at roughly 4.3 °C per minute. 2. (1.331 − 0.729)/0.2 = 3.01, slightly above 3. 3. At x = 1 (slopes 0 on the left, 2 on the right) and x = −2 (slopes −2 on the left, 0 on the right). 4. No: a vertical tangent at (4, 0); the function is continuous there. 5. Slopes: 2a = 4, so a = 2; values: a = 4 + b, so b = −2.

---

*Original study material for this course, organised around the College Board AP Calculus AB and BC Course and Exam Description (Unit 2, Topics 2.3–2.4). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). AP® is a trademark of the College Board, which does not endorse this material.*
