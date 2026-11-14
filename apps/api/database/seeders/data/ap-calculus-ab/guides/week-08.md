# Week 08 · The Power Rule, Basic Derivative Rules, and Derivatives of sin x, cos x, eˣ and ln x

**Topics:** 2.5 Applying the Power Rule · 2.6 Derivative Rules: Constant, Sum, Difference, and Constant Multiple · 2.7 Derivatives of cos x, sin x, eˣ, and ln x
**Practices:** 1 (Implementing Mathematical Processes), 2 (Connecting Representations), 4 (Communication and Notation)
**Framework:** AP Calculus AB and BC CED, Unit 2, Topics 2.5–2.7, learning objectives in our own words
**Spiral:** Weeks 6 and 7 found derivatives one limit at a time. This week the limits are done once, in general, and packaged as rules, so a derivative that took a page of algebra now takes a line. The rules are only as trustworthy as the limit work behind them: the sum and constant multiple rules are week 2's limit properties in disguise, and the sine and cosine derivatives rest on the special limit lim (h→0) sin h/h = 1 from week 3. Tangent lines (week 6) and differentiability (week 7) are where you will use the new rules.

## What you need to be able to do

- **2.5** Differentiate xⁿ for any real constant n, after rewriting roots and reciprocals as powers.
- **2.5** Find where a graph has a horizontal tangent by solving f′(x) = 0.
- **2.6** Use the constant, constant multiple, sum and difference rules to differentiate term by term, and simplify a function (expand, divide term by term) before differentiating.
- **2.7** Recall and use d/dx [sin x] = cos x, d/dx [cos x] = −sin x, d/dx [eˣ] = eˣ and d/dx [ln x] = 1/x.
- **2.7** Recognise a difference-quotient limit built on one of these functions and evaluate it with the rules.
- **2.5–2.7** Write tangent lines and interpret derivatives in context using the new rules.

## Key terms

| Term | Meaning |
|---|---|
| Power rule | d/dx [xⁿ] = nxⁿ⁻¹ for any real constant n. |
| Constant rule | d/dx [c] = 0 for any constant c. |
| Constant multiple rule | d/dx [k·f(x)] = k·f′(x). |
| Sum and difference rules | d/dx [f(x) ± g(x)] = f′(x) ± g′(x). |
| Natural exponential | eˣ, with e ≈ 2.71828: the exponential whose slope equals its height. |
| Natural logarithm | ln x, the inverse of eˣ, defined for x > 0. |

## The power rule (2.5)

For any real constant n,

  d/dx [xⁿ] = n·xⁿ⁻¹.

For a positive whole number n the rule comes straight from the definition: expanding (x + h)ⁿ by the binomial theorem gives xⁿ + nxⁿ⁻¹h + (terms with h² or higher), so the difference quotient is nxⁿ⁻¹ plus terms that still contain h, and the limit is nxⁿ⁻¹. It also holds for negative, fractional and irrational exponents, as week 6's results for √x and 1/x confirm: (1/2)x^(−1/2) = 1/(2√x) and −1·x⁻² = −1/x².

The rule needs **a power of x with a constant exponent**, so rewrite first:

| Function | Rewrite | Derivative |
|---|---|---|
| ∛x | x^(1/3) | (1/3)x^(−2/3) |
| 5/x² | 5x⁻² | −10x⁻³ = −10/x³ |
| 1/√x | x^(−1/2) | −(1/2)x^(−3/2) |
| x²√x | x^(5/2) | (5/2)x^(3/2) |

Two traps: you cannot differentiate a denominator by itself (d/dx [4/x²] is not 4/(2x)), and the rule does not apply when the variable is in the exponent (eˣ and 2ˣ are not powers of x).

## The constant, sum, difference and constant multiple rules (2.6)

A constant function has a horizontal graph, so its derivative is 0. That includes constants written with letters: π², e³ and ln 5 all have derivative 0.

Constants multiply through a derivative, and derivatives of sums and differences are sums and differences of derivatives:

  d/dx [k·f(x)] = k·f′(x)  d/dx [f(x) ± g(x)] = f′(x) ± g′(x).

Both follow from week 2's limit properties applied to the difference quotient: for example (k·f(x + h) − k·f(x))/h = k · (f(x + h) − f(x))/h, and the constant factors out of the limit. Together with the power rule they let you differentiate any polynomial term by term, which is why polynomials are differentiable everywhere.

**Worked example (rewrite, then differentiate).** Let f(x) = 6√x − x³ + 4/x for x > 0. Find f′(x) and the tangent line at x = 1.

Rewrite: f(x) = 6x^(1/2) − x³ + 4x⁻¹. Differentiate term by term:

f′(x) = 6 · (1/2)x^(−1/2) − 3x² + 4 · (−1)x⁻² = 3/√x − 3x² − 4/x².

At x = 1: f(1) = 6 − 1 + 4 = 9 and f′(1) = 3 − 3 − 4 = −4, so the tangent line is y = 9 − 4(x − 1), or y = 13 − 4x.

When a function is a product or quotient that simplifies, simplify first; next week's product and quotient rules are not needed. (2x)³ = 8x³ has derivative 24x². (x² + 3x)/√x = x^(3/2) + 3x^(1/2) has derivative (3/2)√x + 3/(2√x).

**Worked example (horizontal tangents).** Where does y = x³ − 12x + 1 have a horizontal tangent line?

A horizontal line has slope 0, so solve dy/dx = 3x² − 12 = 0: x² = 4, so x = −2 and x = 2. The points are (−2, 17) and (2, −15). Between them the slope is negative (at x = 0 it is −12), so the graph rises to (−2, 17), falls to (2, −15), then rises again. Unit 5 turns this observation into a full theory of extrema.

## Derivatives of sin x, cos x, eˣ and ln x (2.7)

| f(x) | f′(x) |
|---|---|
| sin x | cos x |
| cos x | −sin x |
| eˣ | eˣ |
| ln x | 1/x (x > 0) |

**Where the trig derivatives come from.** Expand sin(x + h) = sin x cos h + cos x sin h. The difference quotient for sin x becomes

  sin x · (cos h − 1)/h + cos x · (sin h)/h.

As h → 0, (cos h − 1)/h → 0 and (sin h)/h → 1 (angles in radians), so the limit is cos x. The same method with cos(x + h) = cos x cos h − sin x sin h gives −sin x. These results need radians; in degrees the derivative of sine would carry an extra factor π/180.

A quick sense check for the signs: at x = 0, sin x is rising through 0 with slope cos 0 = 1; at x = π/2, cos x is falling through 0 with slope −sin(π/2) = −1. If your sign disagrees with the graph, the sign is wrong.

**Why eˣ is its own derivative.** For any base b > 0, the difference quotient of bˣ is bˣ · (bʰ − 1)/h, so the slope of bˣ is bˣ times the fixed number lim (h→0) (bʰ − 1)/h, the slope of bˣ at x = 0. The number e is defined as the base for which that slope is exactly 1, so d/dx [eˣ] = eˣ: at every point the slope of the graph equals its height. For 2ˣ the factor is about 0.693, which is why week 7's estimate at x = 1 came out near 2 × 0.693 ≈ 1.386.

**ln x.** Because ln x is the inverse of eˣ, its slope at x is the reciprocal of the slope of eˣ at the matching point, which works out to 1/x. (Unit 3 proves this with the inverse-function derivative.)

**Worked example (a tangent line with ln x).** Find the line tangent to y = ln x at x = e.

The point is (e, ln e) = (e, 1); the slope is 1/e. So y = 1 + (1/e)(x − e) = 1 + x/e − 1 = x/e. Surprisingly, the tangent line passes through the origin.

**Worked example (recognising a limit).** Evaluate lim (h→0) (sin(π/6 + h) − 1/2)/h.

The expression plugged into sine is π/6 + h, and sin(π/6) = 1/2 is the subtracted value. So the limit is f′(π/6) for f(x) = sin x, which is cos(π/6) = √3/2. In the same way, lim (h→0) (eʰ − 1)/h is the derivative of eˣ at 0, which is e⁰ = 1, and lim (x→1) ln x/(x − 1) is the derivative of ln x at 1, which is 1.

## Using the rules in context

**Worked example (a hypothetical harbour).** A model for the depth of water at a harbour entrance is D(t) = 5 + 2 sin t − 0.1t metres, t hours after midnight, 0 ≤ t ≤ 6.

- D′(t) = 2 cos t − 0.1, by the sum, constant multiple and sine rules.
- D′(0) = 1.9: at midnight the depth is increasing at 1.9 metres per hour.
- D′(π) = 2(−1) − 0.1 = −2.1: about 3.14 hours after midnight the depth is decreasing at 2.1 metres per hour.
- The average rate over [0, π] is (D(π) − D(0))/π = (−0.1π)/π = −0.1 metres per hour: the tide term comes back to where it started and only the slow −0.1t trend remains.

On a calculator, D′(t) = 0 where cos t = 0.05, at t ≈ 1.521 and t ≈ 4.762 hours; between those times the depth is falling.

## Common mistakes

- **Forgetting to rewrite.** √x, 1/x³ and 5/∛x must become powers before the power rule applies.
- **Lowering the exponent the wrong way.** From −2/3, subtract 1 to get −5/3, not −1/3.
- **Losing the sign from a negative exponent.** d/dx [4x⁻¹] = −4x⁻².
- **Differentiating a constant like π² as a power.** Its derivative is 0.
- **Using the power rule on eˣ.** d/dx [eˣ] = eˣ, not xeˣ⁻¹.
- **Sign of the cosine derivative.** d/dx [cos x] = −sin x; d/dx [−cos x] = sin x.
- **Applying the power rule to (2x)³ as if it were x³.** Expand first (or wait for the chain rule).

## Self-check

1. Differentiate y = 4x^(3/4) − 2/x⁵ + 7.
2. Find the equation of the tangent line to y = 3eˣ − 2 at x = 0.
3. Find every x in [0, 2π) where y = x + 2 cos x has a horizontal tangent.
4. Evaluate lim (h→0) (cos(π + h) + 1)/h by reading it as a derivative.
5. Simplify and differentiate (x³ − 4x)/x² for x ≠ 0.

*Answers:* 1. 3x^(−1/4) + 10x⁻⁶. 2. Point (0, 1), slope 3: y = 1 + 3x. 3. 1 − 2 sin x = 0 gives sin x = 1/2: x = π/6 and 5π/6. 4. It is the derivative of cos x at π (cos π = −1), which is −sin π = 0. 5. x − 4/x, with derivative 1 + 4/x².

---

*Original study material for this course, organised around the College Board AP Calculus AB and BC Course and Exam Description (Unit 2, Topics 2.5–2.7). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). AP® is a trademark of the College Board, which does not endorse this material.*
