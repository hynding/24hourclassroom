# Week 31 · Lagrange Error Bound and Radius and Interval of Convergence

**Topics:** 10.12 Lagrange Error Bound · 10.13 Radius and Interval of Convergence of Power Series
**Practices:** 1 (Implementing Mathematical Processes), 2 (Connecting Representations), 3 (Justification), 4 (Communication and Notation)
**Framework:** AP Calculus AB and BC CED, Unit 10, Topics 10.12–10.13, learning objectives in our own words
**Spiral:** Week 30 built Taylor polynomials and bounded their error when the series happened to alternate. The Lagrange error bound removes that restriction: it works for any function whose next derivative you can bound. The second half of the week lets the polynomial run forever. A power series is a function of x, and where it converges is decided by the convergence tests of weeks 27–29: the Ratio Test finds the radius, and the p-series, comparison, nth Term and Alternating Series Tests settle the endpoints.

## What you need to be able to do

- **10.12** State the Lagrange error bound for Pₙ about x = a and identify the derivative, power and factorial it uses.
- **10.12** Choose a valid M by bounding |f⁽ⁿ⁺¹⁾(z)| for every z between a and x.
- **10.12** Use the bound to show an approximation is within a tolerance, or to decide whether a proposed value is possible.
- **10.13** Find the radius of convergence of a power series with the Ratio Test, including series in powers of (x − a) and of x².
- **10.13** Find the interval of convergence by testing each endpoint separately, with a named test.
- **10.13** Explain what term-by-term differentiation or integration does to the radius and the endpoints.

## Key terms

| Term | Meaning |
|---|---|
| Lagrange error bound | The error of Pₙ at x is at most M times (distance from a to x)ⁿ⁺¹ divided by (n + 1)!. |
| M | Any upper bound on the size (absolute value) of the (n + 1)st derivative for every z between the center and x. |
| Power series | ∑ (n = 0 to ∞) cₙ(x − a)ⁿ, a function of x defined where it converges. |
| Radius of convergence R | The series converges when x is closer than R to the center a and diverges when x is farther than R. |
| Interval of convergence | All x where the series converges: the open interval plus whichever endpoints converge. |
| Endpoint | x = a ± R, where the Ratio Test limit equals 1 and gives no information. |

## The Lagrange error bound (10.12)

When Pₙ is the Taylor polynomial of degree n for f about x = a, the error at x satisfies

**|f(x) − Pₙ(x)| ≤ M · |x − a|ⁿ⁺¹ / (n + 1)!,**

where M is any number with |f⁽ⁿ⁺¹⁾(z)| ≤ M for all z between a and x. Read it as "the next term of the polynomial, with the next derivative replaced by its worst case". Three habits make it reliable:

1. **Use the next derivative.** For P₃ you need f⁽⁴⁾, the fourth power and 4!.
2. **Bound on the whole interval.** M is not f⁽ⁿ⁺¹⁾(a). Find where |f⁽ⁿ⁺¹⁾| is largest between a and x. For an increasing derivative that is at the right end; for a decreasing one, at the left end.
3. **Any valid upper bound is fine.** If e^0.5 is awkward, use e^0.5 < 2. A rougher M gives a weaker but still correct bound.

On free-response questions M is often given ("|f⁽⁴⁾(x)| ≤ 12 on the interval"); then the work is substitution and a clear conclusion.

**Worked example (eˣ, where the series does not alternate).** Use P₃(x) = 1 + x + x²/2 + x³/6 to approximate e^0.5, and bound the error.

P₃(0.5) = 1 + 0.5 + 0.125 + 0.0208333 = 1.6458333.

f⁽⁴⁾(z) = e^z is increasing, so on [0, 0.5] its largest value is e^0.5, and e^0.5 < 2 (since e < 4). Take M = 2:

|e^0.5 − P₃(0.5)| ≤ 2(0.5)⁴/4! = 2(0.0625)/24 ≈ 0.0052.

The actual error is about 0.0029, comfortably inside. The alternating series error bound would not apply here: every term of the eˣ series at x = 0.5 is positive.

**Worked example (ln x, where M sits at the left end).** Use P₂(x) = (x − 1) − (x − 1)²/2 to approximate ln 1.2, and bound the error.

P₂(1.2) = 0.2 − 0.02 = 0.18. The third derivative is f‴(z) = 2/z³, which decreases as z grows, so on [1, 1.2] it is largest at z = 1: M = 2. Then

|ln 1.2 − 0.18| ≤ 2(0.2)³/3! = 0.016/6 ≈ 0.00267.

Check: ln 1.2 ≈ 0.18232, so the actual error is 0.00232, below the bound. Using M = f‴(1.2) = 2/1.728 ≈ 1.157 would give 0.00154, which is **smaller than the actual error**: an invalid bound, the result of taking M at the wrong end.

**Worked example (a table and a given bound).** A function f has f(1) = 2, f′(1) = −1, f″(1) = 3, f‴(1) = −4, and |f⁽⁴⁾(x)| ≤ 12 for 1 ≤ x ≤ 1.5.

P₃(x) = 2 − (x − 1) + (3/2)(x − 1)² − (2/3)(x − 1)³, so P₃(1.5) = 2 − 0.5 + 0.375 − 0.0833 = 43/24 ≈ 1.7917.

Lagrange: |f(1.5) − P₃(1.5)| ≤ 12(0.5)⁴/4! = 0.03125. So f(1.5) lies between 1.7604 and 1.8229. **Could f(1.5) be 1.85?** No: 1.85 is outside that interval. Could it be 1.80? Yes, the bound allows it (it does not say it is).

## Power series and where they converge (10.13)

A power series centered at x = a, ∑ (n = 0 to ∞) cₙ(x − a)ⁿ, is a polynomial that never stops. For each x you get a number series, which converges or diverges. There are only three possibilities:

- it converges only at x = a (radius R = 0);
- it converges for every real x (R = ∞);
- there is an R > 0 with convergence for |x − a| < R and divergence for |x − a| > R; at the two endpoints anything can happen.

**Finding the radius.** Apply the Ratio Test to the absolute values of the terms, keeping x in: compute L = lim (n→∞) |aₙ₊₁/aₙ| and solve L < 1.

**Finding the interval.** At x = a ± R the Ratio Test limit is exactly 1, which decides nothing. Substitute each endpoint, simplify the number series, and test it with a named test. State the result for each endpoint separately.

**Worked example (a full interval of convergence).** Find the interval of convergence of ∑ (n = 1 to ∞) (x − 2)ⁿ/(n·3ⁿ).

Ratio: |aₙ₊₁/aₙ| = |x − 2|ⁿ⁺¹/((n + 1)3ⁿ⁺¹) · n·3ⁿ/|x − 2|ⁿ = (|x − 2|/3) · n/(n + 1) → |x − 2|/3.

Converges when |x − 2| < 3: radius 3, open interval −1 < x < 5.

- x = 5: (3)ⁿ/(n·3ⁿ) = 1/n. The harmonic series diverges. Exclude 5.
- x = −1: (−3)ⁿ/(n·3ⁿ) = (−1)ⁿ/n. Alternating, 1/n decreasing to 0: converges by the Alternating Series Test. Include −1.

Interval of convergence: **−1 ≤ x < 5**, written [−1, 5).

**Worked example (three quick radii).**

| Series | Ratio | Result |
|---|---|---|
| ∑ xⁿ/n! | (size of x)/(n + 1) → 0 | Converges for every x: R = ∞ |
| ∑ n! xⁿ | (n + 1)(size of x) → ∞ for x ≠ 0 | Converges only at x = 0: R = 0 |
| ∑ (x − 1)^(2n)/9ⁿ | (x − 1)²/9 (geometric) | (x − 1)² < 9, so −2 < x < 4: R = 3; both endpoints give ∑ 1, divergent: (−2, 4) |

The third shows the trap with even powers: the condition is on (x − 1)², so you take a square root. The radius is 3, not 9.

**Differentiating and integrating.** Inside its interval of convergence a power series can be differentiated or integrated term by term (week 32 uses this constantly). Doing so **keeps the radius** but **can change the endpoints**: differentiating multiplies the terms by n and can lose an endpoint; integrating divides by n + 1 and can gain one.

**Worked example (∑ xⁿ/n and its derivative).** The series ∑ (n = 1 to ∞) xⁿ/n has R = 1. At x = 1 it is the harmonic series (diverges); at x = −1 it is the alternating harmonic series (converges). Interval: [−1, 1).

Its derivative is ∑ (n = 1 to ∞) x^(n−1) = 1 + x + x² + ⋯, still R = 1. At x = −1 the terms are ±1, which do not go to 0, so it diverges there; at x = 1 the terms are all 1. Interval: (−1, 1). Differentiating lost the endpoint −1.

**What a single fact tells you.** If a series centered at 2 converges at x = 5 and diverges at x = −3, then 3 ≤ R ≤ 5. Every x within 3 of the center converges, every x more than 5 away diverges, and between those distances nothing is decided.

## Common mistakes

- **Wrong order in the Lagrange bound.** For Pₙ use f⁽ⁿ⁺¹⁾, |x − a|ⁿ⁺¹ and (n + 1)!.
- **Taking M at the center.** M must cover the whole interval between a and x; check which end makes |f⁽ⁿ⁺¹⁾| largest.
- **Forgetting the factorial**, which makes the bound uselessly large.
- **Stopping at the Ratio Test.** The open interval is not the interval of convergence until both endpoints are tested.
- **Centering at 0 by habit.** ∑ cₙ(x − 3)ⁿ has an interval centered at 3.
- **Square-root slip.** For powers like (x − 1)^(2n), solve (x − 1)² < k and take the square root.
- **Assuming the derivative series has the same interval.** Same radius, but recheck the endpoints.

## Self-check

1. Use the Lagrange error bound, with e^0.2 < 1.25, to bound the error of P₂(x) = 1 + x + x²/2 for eˣ at x = 0.2.
2. Find the interval of convergence of ∑ (n = 1 to ∞) (x + 1)ⁿ/n².
3. Find the interval of convergence of ∑ (n = 1 to ∞) (2x)ⁿ/√n.
4. Find the radius of convergence of ∑ (n = 0 to ∞) (x − 5)ⁿ/n!.
5. A function f has |f‴(x)| ≤ 4 for 2 ≤ x ≤ 2.3. Bound |f(2.3) − P₂(2.3)| for its second-degree Taylor polynomial about x = 2.
6. Integrate ∑ (n = 1 to ∞) xⁿ/n term by term from 0 to x. What is the interval of convergence of the result?

*Answers:* 1. f‴(z) = e^z ≤ e^0.2 < 1.25 on [0, 0.2], so the error is at most 1.25(0.2)³/3! = 0.01/6 ≈ 0.00167. 2. R = 1; at x = 0, ∑ 1/n² converges; at x = −2, ∑ (−1)ⁿ/n² converges absolutely: [−2, 0]. 3. R = 1/2; at x = 1/2, ∑ 1/√n diverges (p = 1/2); at x = −1/2, ∑ (−1)ⁿ/√n converges by the Alternating Series Test: [−1/2, 1/2). 4. ∞ (ratio |x − 5|/(n + 1) → 0). 5. 4(0.3)³/3! = 0.108/6 = 0.018. 6. ∑ (n = 1 to ∞) x^(n+1)/(n(n + 1)); R = 1, and at x = ±1 the terms are bounded by 1/n², so both endpoints converge: [−1, 1].

---

*Original study material for this course, organised around the College Board AP Calculus AB and BC Course and Exam Description (Unit 10, Topics 10.12–10.13). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). AP® is a trademark of the College Board, which does not endorse this material.*
