# Week 23 · Definite Integrals and Accumulation Functions

**Topics:** 6.3 Riemann Sums, Summation Notation, and Definite Integral Notation · 6.4 The Fundamental Theorem of Calculus and Accumulation Functions
**Practices:** 1 (Implementing Mathematical Processes), 2 (Connecting Representations), 3 (Justification), 4 (Communication and Notation)
**Framework:** AP Calculus AB and BC CED, Unit 6, Topics 6.3–6.4, learning objectives in our own words
**Spiral:** Week 22's Riemann sums become exact here by taking a limit, the same move that turned average rates into derivatives in Unit 2. The first Fundamental Theorem then connects accumulation back to differentiation, so weeks 10–11 (the chain rule) and weeks 17–19 (increasing, decreasing, extrema, concavity) apply directly to functions defined by integrals.

## What you need to be able to do

- **6.3** Read and write sums in sigma notation, and write a left or right Riemann sum with n equal subintervals in that notation.
- **6.3** Define the definite integral as the limit of Riemann sums, and translate in both directions between such a limit and ∫ from a to b of f(x) dx.
- **6.3** Evaluate definite integrals of lines, absolute values and semicircles using geometry, counting area below the axis as negative.
- **6.4** Interpret g(x) = ∫ from a to x of f(t) dt as an accumulation function, and evaluate it from a graph of f.
- **6.4** Apply the first part of the Fundamental Theorem of Calculus, g′(x) = f(x), including with a variable upper limit u(x) (chain rule) and a variable lower limit.

## Key terms

| Term | Meaning |
|---|---|
| Sigma notation | ∑ (k = 1 to n) aₖ means a₁ + a₂ + … + aₙ. |
| Index | The counter k in a sum; it is a placeholder. |
| Definite integral | ∫ from a to b of f(x) dx, the limit of Riemann sums for f on [a, b] as the widths shrink to 0. |
| Integrand | The function f(x) being integrated. |
| Limits of integration | The numbers a (lower) and b (upper). |
| Dummy variable | The variable of integration; renaming it does not change a definite integral's value. |
| Accumulation function | A function defined by g(x) = ∫ from a to x of f(t) dt, whose input is the upper limit. |
| Fundamental Theorem of Calculus (first part) | If f is continuous, then d/dx ∫ from a to x of f(t) dt = f(x). |

## Sigma notation and the definite integral (6.3)

Riemann sums get long quickly, so we compress them. For f on [a, b] with n equal subintervals, Δx = (b − a)/n and the partition points are xₖ = a + kΔx for k = 0, 1, …, n. Then

- right Riemann sum = ∑ (k = 1 to n) f(a + kΔx) Δx
- left Riemann sum = ∑ (k = 0 to n − 1) f(a + kΔx) Δx

As n grows, the rectangles get thinner and, for a continuous function, every kind of Riemann sum approaches the same number. That number is the **definite integral**:

∫ from a to b of f(x) dx = lim (n→∞) ∑ (k = 1 to n) f(a + kΔx) Δx.

The notation remembers where it came from. The ∫ is a stretched S for "sum", f(x) is the height, and dx is the shrinking width.

**Reading a limit of sums as an integral.** Find three things.

1. **Δx**: the factor that looks like (number)/n. It equals (b − a)/n, so it gives the length of the interval.
2. **The sample point**: the expression inside f, of the form a + kΔx. Its starting value (k = 0) is a.
3. **The function**: what is being done to the sample point.

**Worked example.** Write lim (n→∞) ∑ (k = 1 to n) (2/n)(1 + 2k/n)² as a definite integral.

Δx = 2/n, so the interval has length 2. The sample point is xₖ = 1 + 2k/n, which starts at 1 (k = 0) and reaches 3 (k = n). The function squares the sample point. So the limit is ∫ from 1 to 3 of x² dx. Its value, which you will be able to compute next week, is 26/3.

There is a second correct answer: treat the sample point as 2k/n on [0, 2] and the function as (1 + x)², giving ∫ from 0 to 2 of (1 + x)² dx. Both describe the same rectangles. What you must not do is mix them, such as ∫ from 1 to 3 of (1 + x)² dx, which shifts twice.

**Signs.** Where f is negative, the Riemann sum terms are negative, so the integral counts area below the axis as negative. The definite integral is a **signed** area, the net accumulation of week 22.

## Evaluating integrals with geometry (6.3)

Until next week, if the graph is made of familiar shapes, use them.

**Worked example (a quarter circle).** Evaluate ∫ from 0 to 4 of √(16 − x²) dx.

Squaring y = √(16 − x²) gives x² + y² = 16 with y ≥ 0: the top half of a circle of radius 4 centered at the origin. From x = 0 to x = 4 the region is a quarter of the disk, so the integral is (1/4)π(4²) = 4π.

**Worked example (a line that crosses the axis).** Evaluate ∫ from −1 to 3 of (2x − 2) dx.

The line crosses zero at x = 1. On [−1, 1] it forms a triangle below the axis with base 2 and height |2(−1) − 2| = 4: signed area −4. On [1, 3] it forms a triangle above with base 2 and height 4: signed area +4. The integral is 0, even though the total area enclosed is 8.

Absolute values work the same way: ∫ from 0 to 4 of |x − 1| dx is two triangles above the axis, ½ · 1 · 1 + ½ · 3 · 3 = 5.

## Accumulation functions (6.4)

Fix a starting point a and let the right endpoint move. The function

g(x) = ∫ from a to x of f(t) dt

records the signed area accumulated from a up to x. The letter t is used inside so that x can name the moving endpoint. Two facts are immediate:

- g(a) = 0, since no width means no area.
- For x to the left of a, g(x) = −∫ from x to a of f(t) dt: the signed area from x to a, with its sign changed.

**Worked example (an accumulation function from a graph).** The graph of f consists of segments joining (−2, −2), (0, 2), (2, 2), (4, −2) and (6, 0). Let g(x) = ∫ from 0 to x of f(t) dt.

The graph crosses zero at t = −1 and t = 3. Walk right from 0, adding signed areas, and walk left by subtracting.

| x | −2 | −1 | 0 | 2 | 3 | 4 | 6 |
|---|---|---|---|---|---|---|---|
| g(x) | 0 | −1 | 0 | 4 | 5 | 4 | 2 |

For instance, g(−1) = −∫ from −1 to 0 of f(t) dt = −(½ · 1 · 2) = −1, and g(4) = 4 + 1 − 1 = 4.

## The first Fundamental Theorem of Calculus (6.4)

How fast does g change as x moves? If you push the right edge from x to x + h, you add a thin strip of width h and height about f(x). So g(x + h) − g(x) ≈ f(x) · h, and dividing by h and letting h → 0 gives

**If f is continuous, then d/dx ∫ from a to x of f(t) dt = f(x).**

The accumulation function is an antiderivative of the integrand. The lower limit a does not matter for the derivative; it only fixes where the accumulation starts.

This turns every week 17–19 question into a question about the graph of f:

| About g | Read from f |
|---|---|
| g increasing / decreasing | f positive / negative |
| g has a relative maximum | f changes from positive to negative |
| g has a relative minimum | f changes from negative to positive |
| g concave up / down | f increasing / decreasing (g″ = f′) |
| g has a point of inflection | f changes from increasing to decreasing, or the reverse |

In the example above, g′ = f changes from positive to negative at x = 3, so g has a relative maximum there, and from negative to positive at x = −1, so g has a relative minimum there.

**Variable limits.** If the upper limit is a function u(x), combine the theorem with the chain rule:

d/dx ∫ from a to u(x) of f(t) dt = f(u(x)) · u′(x).

If the variable is in the lower limit, switch the limits first, which changes the sign: ∫ from x to b of f(t) dt = −∫ from b to x of f(t) dt.

**Worked example.** Find H′(x) for H(x) = ∫ from 0 to x³ of √(1 + t²) dt.

With u = x³, H′(x) = √(1 + (x³)²) · 3x² = 3x²√(1 + x⁶).

**Worked example.** Find d/dx ∫ from x to 5 of e^(t²) dt. Switching the limits gives −∫ from 5 to x of e^(t²) dt, so the derivative is −e^(x²). Notice that e^(t²) has no elementary antiderivative, so the theorem is the only way to do this.

## Common mistakes

- **Shifting twice when converting a sum.** If the sample point is 1 + 2k/n, either use [1, 3] with f(x) = x², or [0, 2] with f(x) = (1 + x)², not both.
- **Reading Δx as the interval's endpoint.** Δx = 3/n says the interval has length 3, not that it ends at 3.
- **Thinking k = 1 means "left".** Starting at k = 1 with a + kΔx gives right endpoints.
- **Adding area below the axis to an integral.** The definite integral is signed.
- **Confusing g and g′.** g(x) is an accumulated area; g′(x) is a height of f. g(a) = 0, while g′(a) = f(a).
- **Forgetting the chain rule with a limit like x² or sin x.** Multiply by the derivative of the limit.
- **Ignoring the sign of a variable lower limit.** d/dx ∫ from x to b of f(t) dt = −f(x).

## Self-check

1. Write ∑ (k = 1 to n) (4/n)(k/n · 4)² as a right Riemann sum: what are a, b and f?
2. Evaluate ∫ from −3 to 3 of √(9 − x²) dx using geometry.
3. Evaluate ∫ from 0 to 5 of (3 − x) dx using geometry.
4. If g(x) = ∫ from 1 to x of (5 − t²) dt, find g(1), g′(1) and the x > 0 where g has a relative maximum.
5. Find d/dx ∫ from 2 to sin x of (1 + t³) dt.
6. Explain why ∫ from 0 to x of f(t) dt and ∫ from 4 to x of f(t) dt have the same derivative but different values.

*Answers:* 1. a = 0, b = 4, f(x) = x²: the sample point is 4k/n and Δx = 4/n. 2. A semicircle of radius 3: 9π/2. 3. Triangle above on [0, 3] with area 4.5, triangle below on [3, 5] with area 2: 4.5 − 2 = 2.5. 4. g(1) = 0, g′(1) = 4, and g′ = 5 − x² changes from positive to negative at x = √5. 5. (1 + sin³x) cos x. 6. They differ by the constant ∫ from 0 to 4 of f(t) dt, which has derivative 0.

---

*Original study material for this course, organised around the College Board AP Calculus AB and BC Course and Exam Description (Unit 6, Topics 6.3–6.4). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). AP® is a trademark of the College Board, which does not endorse this material.*
