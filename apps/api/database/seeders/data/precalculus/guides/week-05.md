# Week 05 · End Behavior of Polynomial and Rational Functions

**Topics:** 1.6 Polynomial Functions and End Behavior · 1.7 Rational Functions and End Behavior
**Practices:** 1 (procedural and symbolic fluency), 2 (multiple representations), 3 (communication and reasoning)
**Framework:** AP Precalculus CED, Unit 1, Topics 1.6–1.7, learning objectives in our own words
**Spiral:** Week 3's degree and leading coefficient, and its rule that odd-degree polynomials have no global extrema, are made precise here. Week 4's factored forms and sign charts help with rational functions. From Algebra 2: simplifying rational expressions and dividing by a monomial.

## What you need to be able to do

- **1.6** Describe the end behaviour of a polynomial (what its outputs do as x → ∞ and as x → −∞) from its degree and the sign of its leading coefficient.
- **1.6** Write end behaviour in limit notation, such as lim as x → ∞ of p(x) = −∞, and read it back in words.
- **1.6** Explain, with a numerical or algebraic argument, why the leading term controls a polynomial's end behaviour.
- **1.7** Describe the end behaviour of a rational function r(x) = p(x)/q(x) by comparing the leading terms of the numerator and denominator.
- **1.7** Identify a horizontal asymptote (when the degree of the numerator is at most the degree of the denominator) and write it with limit notation, such as lim as x → ∞ of r(x) = 3.
- **1.7** Recognise when a rational function has a slant (oblique) asymptote (numerator degree exactly one more than denominator degree) and find it in simple cases.
- **1.7** Interpret a horizontal asymptote in context, as the long-run value of a quantity.

## Key terms

| Term | Meaning |
|---|---|
| End behaviour | What f(x) does as x → ∞ (far right) and x → −∞ (far left). |
| lim as x → ∞ of f(x) = L | As x increases without bound, f(x) gets as close to L as we like. |
| lim as x → ∞ of f(x) = ∞ | As x increases without bound, f(x) increases without bound. |
| Leading term | The term of highest degree, aₙxⁿ; for large |x| it outweighs the others. |
| Rational function | r(x) = p(x)/q(x) with p and q polynomials and q not the zero polynomial. |
| Horizontal asymptote | A line y = L with lim as x → ∞ or x → −∞ of r(x) equal to L. |
| Slant (oblique) asymptote | A non-horizontal line y = mx + b that r(x) approaches as x → ±∞. |

## End behaviour of polynomials (1.6)

### Limit notation

Limit notation is a compact way to describe what outputs do as inputs head somewhere.

- "lim as x → ∞ of f(x) = ∞" means: as x grows without bound, f(x) grows without bound.
- "lim as x → −∞ of f(x) = −∞" means: as x decreases without bound, f(x) decreases without bound.
- "lim as x → ∞ of f(x) = 3" means: as x grows without bound, f(x) gets arbitrarily close to 3.

The symbol ∞ is not a number; it records "without bound". Writing lim = ∞ says the limit does not settle at a finite value, and in which direction the outputs run off.

### The leading term decides

For p(x) = aₙxⁿ + (lower-degree terms), factor out the leading term:

  p(x) = aₙxⁿ · (1 + (aₙ₋₁/aₙ)(1/x) + … + (a₀/aₙ)(1/xⁿ)).

Every fraction in the bracket has a power of x in its denominator, so it shrinks to 0 as |x| grows. The bracket approaches 1, and p(x) behaves like aₙxⁿ. Numerically, for p(x) = x³ − 40x² + 7:

| x | 10 | 100 | 1,000 | 10,000 |
|---|---|---|---|---|
| p(x) | −2,993 | 600,007 | 960,000,007 | 9.996 × 10¹¹ |
| p(x)/x³ | −2.99 | 0.60 | 0.96 | 0.996 |

At x = 10 the −40x² term wins, but the ratio to x³ heads to 1.

### The four cases

| Degree | Leading coefficient | lim as x → −∞ | lim as x → ∞ | Picture |
|---|---|---|---|---|
| even | positive | ∞ | ∞ | both ends up |
| even | negative | −∞ | −∞ | both ends down |
| odd | positive | −∞ | ∞ | down left, up right |
| odd | negative | ∞ | −∞ | up left, down right |

The reason is sign arithmetic: for large negative x, an even power is positive and an odd power is negative; then the leading coefficient's sign is multiplied in.

**Worked example.** Describe the end behaviour of p(x) = −3x⁵ + 2x² + 9 with limits.

Leading term −3x⁵: odd degree, negative coefficient. lim as x → −∞ of p(x) = ∞ and lim as x → ∞ of p(x) = −∞.

**Worked example.** Find the end behaviour of q(x) = (2 − x)(x + 1)²(3x − 1) without expanding.

The leading term is (−x)(x²)(3x) = −3x⁴. Even degree, negative coefficient: lim as x → ±∞ of q(x) = −∞. Both ends go down, so q has a global maximum but no global minimum.

**Try it.**
1. Write the end behaviour of f(x) = 4x⁶ − x⁷ in limit notation.
2. A polynomial satisfies lim as x → −∞ of p(x) = −∞ and lim as x → ∞ of p(x) = ∞. What can you say about its degree and leading coefficient?

*Answers:* 1. Leading term −x⁷: lim as x → −∞ of f(x) = ∞, lim as x → ∞ of f(x) = −∞. 2. Odd degree, positive leading coefficient.

## End behaviour of rational functions (1.7)

For r(x) = p(x)/q(x), far from the origin the numerator behaves like its leading term and so does the denominator. So **r behaves like the ratio of the leading terms**:

  r(x) ≈ (aₙxⁿ)/(bₘxᵐ) = (aₙ/bₘ) · xⁿ⁻ᵐ for large |x|.

Compare the degrees n (numerator) and m (denominator):

| Degrees | Ratio of leading terms | End behaviour |
|---|---|---|
| n < m | (aₙ/bₘ)/x^(m − n) → 0 | horizontal asymptote y = 0 |
| n = m | aₙ/bₘ, a constant | horizontal asymptote y = aₙ/bₘ |
| n = m + 1 | (aₙ/bₘ)x, a line through the origin | slant asymptote with slope aₙ/bₘ |
| n > m + 1 | (aₙ/bₘ)xⁿ⁻ᵐ | no line; r behaves like that polynomial power |

**Worked example.** Find lim as x → ∞ of r(x) = (6x² − x)/(2x² + 5).

Equal degrees: the ratio of leading terms is 6x²/(2x²) = 3. So lim as x → ∞ of r(x) = 3, and also lim as x → −∞ of r(x) = 3. The horizontal asymptote is y = 3. Check: r(100) = 59,900/20,005 ≈ 2.994.

**Worked example.** Find lim as x → ∞ of s(x) = (6x − 1)/(2x³ + x).

The ratio of leading terms is 6x/(2x³) = 3/x², which → 0. So lim as x → ±∞ of s(x) = 0, and the horizontal asymptote is y = 0.

**Worked example.** Describe the end behaviour of t(x) = (−4x³ + x)/(2x + 7).

The ratio of leading terms is −4x³/(2x) = −2x². So t behaves like −2x² far out: lim as x → ±∞ of t(x) = −∞. There is no horizontal asymptote.

### A horizontal asymptote can be crossed

An asymptote describes behaviour far away; near the origin the graph may cross it. For r(x) = (x² + x)/(x² + 1), the horizontal asymptote is y = 1, but r(x) = 1 when x² + x = x² + 1, that is at x = 1. The graph crosses y = 1 at (1, 1) and then approaches it from above as x → ∞ (because r(x) − 1 = (x − 1)/(x² + 1) > 0 for x > 1). (Vertical asymptotes are different: the graph never touches one. That is week 6.)

### Slant asymptotes

When the numerator's degree is exactly one more than the denominator's, r(x) approaches a slanted line. In simple cases you can find it by splitting the fraction:

- (2x² + 3x − 1)/x = 2x + 3 − 1/x. As |x| grows, 1/x → 0, so r(x) approaches the line y = 2x + 3.
- (x² + 1)/x = x + 1/x, so the slant asymptote is y = x.
- (x² − 4x + 5)/(x − 2): notice x² − 4x + 5 = (x − 2)² + 1, so the function is (x − 2) + 1/(x − 2). Slant asymptote y = x − 2.

For x > 2 the leftover 1/(x − 2) is positive, so the graph lies just above the line on the right; on the far left it lies just below. In general you find the slant asymptote by polynomial division, which week 7 develops. The *slope* is always the ratio of the leading coefficients.

**Try it.**
1. Find the horizontal asymptote of (5 − 3x²)/(6x² + x).
2. Does (x³ + 1)/x have a slant asymptote?
3. Find the slant asymptote of (3x² − x + 4)/x.

*Answers:* 1. Ratio −3x²/(6x²) = −1/2, so y = −1/2. 2. No: the degree difference is 2, so it behaves like x², with no asymptote line. 3. 3x − 1 + 4/x, so y = 3x − 1.

## Asymptotes in context (1.7)

Horizontal asymptotes often describe a **long-run value**.

**Worked example (average cost).** A hypothetical workshop has fixed costs of $1,200 per batch and spends $8 on materials per item. The average cost per item for n items is A(n) = (8n + 1200)/n dollars.

- Ratio of leading terms: 8n/n = 8, so lim as n → ∞ of A(n) = 8.
- Since A(n) = 8 + 1200/n and 1200/n > 0, the average cost stays above $8 but gets as close as you like: spreading the fixed cost over more items makes it negligible.
- A(100) = 20 and A(200) = 14: the average rate of change on [100, 200] is −6/100 = −$0.06 per item for each extra item made.
- For an average cost of at most $10: 8n + 1200 ≤ 10n, so n ≥ 600.

**Worked example (a mixing tank).** A hypothetical tank starts with 10 L of water holding 2 g of dissolved salt. Brine containing 0.3 g of salt per litre flows in at 1 L per minute and nothing flows out. After t minutes the concentration is C(t) = (2 + 0.3t)/(10 + t) grams per litre. As t → ∞ the ratio of leading terms is 0.3t/t = 0.3, so the concentration approaches 0.3 g/L, the concentration of the incoming brine, which makes physical sense.

**Worked example (a dose model).** A hypothetical model for the concentration of a medicine in the blood is C(t) = 8t/(t² + 4) mg/L, t hours after a dose. The numerator has lower degree, so lim as t → ∞ of C(t) = 0: in the long run the medicine is cleared. C(2) = 16/8 = 2 is the highest value (from a graph), so the concentration rises to 2 mg/L at t = 2 h and then falls toward 0.

## Calculator notes

A table with very large inputs (x = 100, 1,000, 10,000, …) is a quick check of end behaviour, as is zooming out on a graph. Be careful: at moderate x the lower-degree terms can still dominate, as the x³ − 40x² table showed. On no-calculator questions, compare leading terms; never rely on just one or two moderately large inputs.

## Common mistakes

- **Using the wrong term.** End behaviour comes from the highest-degree term, wherever it appears in the expression: in 4x⁶ − x⁷ the leading term is −x⁷.
- **Forgetting the sign of x when x → −∞.** (−x)⁵ is negative; (−x)⁴ is positive.
- **Taking the ratio of coefficients when the degrees differ.** For (6x − 1)/(2x³ + x) the limit is 0, not 3.
- **Thinking a graph can never cross a horizontal asymptote.** It can, as long as it approaches the line far out.
- **Calling every degree-difference case "slant".** A slant asymptote needs the numerator degree to be exactly one more than the denominator degree.
- **Writing ∞ as if it were a number,** such as "r(∞) = 3". Use limit notation.

## Where this goes next

Week 6 looks at what happens near the zeros of the denominator: vertical asymptotes, holes, and one-sided limits like lim as x → 2⁺ of r(x). Week 7 develops polynomial long division and synthetic division, which give slant asymptotes for any rational function with numerator degree one more than the denominator. In Unit 2, exponential and logarithmic functions have their own end behaviour, described with the same limit notation.

## Self-check

1. Write the end behaviour of −2x⁴ + 50x³ − 1 in limit notation, and explain why the 50x³ term does not matter in the long run.
2. Give an example of a polynomial with lim as x → −∞ of p(x) = ∞ and lim as x → ∞ of p(x) = −∞.
3. Find the horizontal asymptote, if any, of (4x³ − 1)/(x³ + 2x) and of (x + 9)/(x² − 3).
4. Find the slant asymptote of (x² + 5x + 2)/x, and say whether the graph is above or below it for large positive x.
5. A hypothetical model for the fraction of a skill learned after n practice sessions is L(n) = n/(n + 4). Find lim as n → ∞ of L(n) and interpret it.

---

*Original study material for this course, organised around the College Board AP Precalculus Course and Exam Description (Unit 1, Topics 1.6–1.7). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). AP® is a trademark of the College Board, which does not endorse this material.*
