# Week 30 · Alternating Series Error Bound and Taylor Polynomial Approximations

**Topics:** 10.10 Alternating Series Error Bound · 10.11 Finding Taylor Polynomial Approximations of Functions
**Practices:** 1 (Implementing Mathematical Processes), 2 (Connecting Representations), 3 (Justification), 4 (Communication and Notation)
**Framework:** AP Calculus AB and BC CED, Unit 10, Topics 10.10–10.11, learning objectives in our own words
**Spiral:** Week 29 gave you the Alternating Series Test: alternating signs, sizes decreasing, sizes going to 0. This week asks the next question: if a series converges by that test, how close is a partial sum to the sum? Then the unit turns from numbers to functions. A Taylor polynomial is the local linearization of week 9 with more terms, built from the higher-order derivatives of Unit 3, and its coefficients are exactly the ones that make an infinite series of powers of x (weeks 31 and 32) work.

## What you need to be able to do

- **10.10** Check the hypotheses of the Alternating Series Test before using the alternating series error bound.
- **10.10** Bound the error |S − Sₙ| by the size of the first omitted term, aₙ₊₁.
- **10.10** Decide whether a partial sum overestimates or underestimates the sum, from the sign of the first omitted term.
- **10.10** Find how many terms guarantee a required accuracy.
- **10.11** Build the Taylor polynomial Pₙ(x) of a function about x = a from its derivatives (formula, table or pattern).
- **10.11** Use a Taylor polynomial to approximate a function value, and read derivative values back from the coefficients.

## Key terms

| Term | Meaning |
|---|---|
| Partial sum Sₙ | The sum of the terms up to and including the nth one. |
| Error (remainder) | S − Sₙ, the part of the sum the partial sum leaves out. |
| First omitted term | The first term not included in Sₙ; its size bounds the error of an alternating series. |
| Taylor polynomial Pₙ(x) about x = a | f(a) + f′(a)(x − a) + f″(a)/2! (x − a)² + ⋯ + f⁽ⁿ⁾(a)/n! (x − a)ⁿ. |
| Maclaurin polynomial | A Taylor polynomial centered at a = 0. |
| Center | The point a where the polynomial matches f and its first n derivatives. |
| Degree | The highest power that may appear; some coefficients can be 0 (P₄ for sin x has no x⁴ term). |

## The alternating series error bound (10.10)

Suppose ∑ (−1)ⁿ aₙ, or ∑ (−1)^(n+1) aₙ, meets the Alternating Series Test: aₙ > 0, the aₙ decrease, and aₙ → 0. Picture the partial sums on a number line. Each new term steps in the opposite direction by a smaller amount, so the partial sums leapfrog back and forth across the sum S, closing in. The sum always sits between two consecutive partial sums. That gives two facts:

1. **Size:** |S − Sₙ| ≤ aₙ₊₁. The error is no bigger than the first term you left out.
2. **Direction:** S − Sₙ has the same sign as the first omitted term. If the next term would have been added, Sₙ is too small; if it would have been subtracted, Sₙ is too big.

The bound is only as good as its hypotheses. If the signs do not alternate (all terms positive) or the sizes do not shrink to 0, you cannot use it. On a free-response question, say why the series qualifies ("the series is alternating, with terms decreasing in absolute value to 0") before quoting the bound.

**Worked example (bounding an error and its direction).** Let S = ∑ (n = 1 to ∞) (−1)^(n+1)/n³.

- The terms alternate, 1/n³ decreases and 1/n³ → 0, so the Alternating Series Test applies.
- S₄ = 1 − 1/8 + 1/27 − 1/64 = 1549/1728 ≈ 0.89641.
- The first omitted term is +1/5³ = +1/125, so |S − S₄| ≤ 1/125 = 0.008.
- That term is positive, so S − S₄ > 0: S₄ is an **underestimate**. S lies between 0.89641 and 0.89641 + 0.008 = 0.90441. (The true value is about 0.90154.)

**Worked example (how many terms).** How many terms of ∑ (n = 1 to ∞) (−1)^(n+1)/n² guarantee an error below 0.0005?

With N terms, the error is at most the size of term N + 1: 1/(N + 1)². Solve

1/(N + 1)² < 0.0005, so (N + 1)² > 2000.

Since 44² = 1936 and 45² = 2025, we need N + 1 ≥ 45, so **N = 44 terms**. Check: 1/45² ≈ 0.000494 < 0.0005, while 1/44² ≈ 0.000517 is not. A common slip is to require the last *included* term to be small; that over-counts by one.

**Bounding an error from a function series.** The same idea applies when a Taylor series of a function alternates at a particular x. The series for sin x is x − x³/3! + x⁵/5! − ⋯. At x = 0.2 it alternates and its terms shrink to 0, so the error of P₃(0.2) = 0.2 − 0.2³/6 ≈ 0.198667 is at most the first omitted term, 0.2⁵/120 ≈ 2.67 × 10⁻⁶, and the approximation is low because that term is positive. You will meet this pattern constantly on the AP exam: the free-response question gives (or asks for) a series, says it alternates at some x, and asks you to show an approximation is within some tolerance.

## Taylor polynomials (10.11)

The tangent line P₁(x) = f(a) + f′(a)(x − a) matches f's value and slope at a. A better approximation should also match the concavity, then the rate at which concavity changes, and so on. The polynomial of degree n that matches f and its first n derivatives at x = a is

**Pₙ(x) = f(a) + f′(a)(x − a) + f″(a)/2! (x − a)² + f‴(a)/3! (x − a)³ + ⋯ + f⁽ⁿ⁾(a)/n! (x − a)ⁿ.**

Why the factorials? Differentiate cₖ(x − a)ᵏ k times and you get k! · cₖ; for that to equal f⁽ᵏ⁾(a), you need cₖ = f⁽ᵏ⁾(a)/k!. Run backwards, this says **f⁽ᵏ⁾(a) = k! × (coefficient of (x − a)ᵏ)**, which is how you read derivatives off a polynomial or series.

Polynomials to know cold (all centered at 0):

| f(x) | Maclaurin polynomial |
|---|---|
| eˣ | 1 + x + x²/2! + x³/3! + ⋯ + xⁿ/n! |
| sin x | x − x³/3! + x⁵/5! − ⋯ (odd powers only) |
| cos x | 1 − x²/2! + x⁴/4! − ⋯ (even powers only) |
| 1/(1 − x) | 1 + x + x² + ⋯ + xⁿ |

You can substitute into these: P₄ for cos(2x) is 1 − (2x)²/2 + (2x)⁴/24 = 1 − 2x² + (2/3)x⁴. (Week 32 makes this a general technique.)

**Worked example (from a formula: ln x about x = 1).** f(x) = ln x, f′(x) = 1/x, f″(x) = −1/x², f‴(x) = 2/x³. At x = 1: 0, 1, −1, 2. Divide by 0!, 1!, 2!, 3!:

P₃(x) = (x − 1) − (x − 1)²/2 + (x − 1)³/3.

Every power is of (x − 1), because the center is 1. Writing x − x²/2 + x³/3 would center the polynomial at 0, where ln x is not even defined.

**Worked example (estimating a root: √x about x = 4).** f(x) = √x, f′(x) = 1/(2√x), f″(x) = −1/(4x^(3/2)). At x = 4: f = 2, f′ = 1/4, f″ = −1/32. So

P₂(x) = 2 + (x − 4)/4 − (x − 4)²/64,

and P₂(4.2) = 2 + 0.05 − 0.04/64 = 2 + 0.05 − 0.000625 = 2.049375. The true √4.2 ≈ 2.049390, so the quadratic term, tiny as it is, improves the tangent-line estimate of 2.05 by a factor of about 40.

**Worked example (from a table).** A function f has

| x | f(x) | f′(x) | f″(x) | f‴(x) |
|---|---|---|---|---|
| 1 | −2 | 5 | −6 | 18 |

Then P₃(x) = −2 + 5(x − 1) − (6/2)(x − 1)² + (18/6)(x − 1)³ = −2 + 5(x − 1) − 3(x − 1)² + 3(x − 1)³, and

P₃(0.9) = −2 + 5(−0.1) − 3(0.01) + 3(−0.001) = −2 − 0.5 − 0.03 − 0.003 = −2.533.

Watch the signs: x − 1 = −0.1 is negative, so its odd powers are negative.

**Worked example (both topics together: cos(0.5)).** P₄(x) = 1 − x²/2 + x⁴/24 gives

P₄(0.5) = 1 − 0.125 + 0.0625/24 ≈ 1 − 0.125 + 0.0026042 = 0.8776042.

The cosine series alternates at x = 0.5 with terms decreasing to 0, so the error is at most the first omitted term, 0.5⁶/6! = 0.015625/720 ≈ 0.0000217. That term is subtracted, so P₄(0.5) is an **overestimate**. (Indeed cos 0.5 ≈ 0.8775826.)

**Where the approximation is good.** A Taylor polynomial is built entirely from information at one point, so it is excellent near the center and can be poor far away. The error behaves roughly like (x − a)ⁿ⁺¹: moving from 0.1 to 1 away from the center multiplies it by about 10ⁿ⁺¹. Next week, the Lagrange error bound turns this into a precise inequality for any function, alternating or not.

## Common mistakes

- **Bounding by the last included term.** The bound is the first omitted term, aₙ₊₁, not aₙ.
- **Skipping the hypotheses.** No alternating signs, or sizes not decreasing to 0, means no alternating series error bound.
- **Guessing the direction.** Overestimate or underestimate comes from the sign of the first omitted term, nothing else.
- **Dropping factorials.** The coefficient of (x − a)ᵏ is f⁽ᵏ⁾(a)/k!; forgetting k! is the most common Taylor polynomial error.
- **Wrong center.** About x = a, write powers of (x − a), and evaluate the derivatives at a, not at 0.
- **Reading derivatives from coefficients without the factorial.** f⁽ᵏ⁾(a) = k! · cₖ, so a coefficient of 4 on x³ means f‴(0) = 24.
- **Sign errors with x < a.** (x − a) is negative to the left of the center; odd powers keep the sign.

## Self-check

1. Bound the error when S₅ approximates ∑ (n = 1 to ∞) (−1)^(n+1)/(2n + 1), and say whether S₅ is too large or too small.
2. How many terms of ∑ (n = 1 to ∞) (−1)^(n+1)/n⁴ are needed for an error below 0.0001?
3. Find the Maclaurin polynomial P₃ for f(x) = e^(−2x).
4. Find P₂ for f(x) = 1/x about x = 2 and use it to approximate 1/2.1.
5. The Maclaurin polynomial P₄ of g is 3 + 2x − 5x² + x⁴. Find g″(0) and g⁽⁴⁾(0).
6. Approximate e^(−0.1) with P₃ for eˣ about 0, and bound the error with the alternating series error bound.

*Answers:* 1. The series meets the Alternating Series Test; the first omitted term is −1/13, so |S − S₅| ≤ 1/13 and S₅ is too large. 2. Need 1/(N + 1)⁴ < 0.0001, so N + 1 > 10: N + 1 = 11, N = 10 terms. 3. 1 − 2x + 2x² − (4/3)x³. 4. f(2) = 1/2, f′(2) = −1/4, f″(2) = 2/8 = 1/4, so P₂(x) = 1/2 − (x − 2)/4 + (x − 2)²/8 and P₂(2.1) = 0.5 − 0.025 + 0.00125 = 0.47625 (true value 0.476190…). 5. g″(0) = 2!(−5) = −10; g⁽⁴⁾(0) = 4!(1) = 24. 6. 1 − 0.1 + 0.005 − 0.000167 ≈ 0.904833; the series alternates at x = −0.1, so the error is at most 0.1⁴/24 ≈ 0.0000042.

---

*Original study material for this course, organised around the College Board AP Calculus AB and BC Course and Exam Description (Unit 10, Topics 10.10–10.11). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). AP® is a trademark of the College Board, which does not endorse this material.*
