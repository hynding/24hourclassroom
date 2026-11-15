# Unit 10 · Infinite Sequences and Series · The night-before sheet

**AP exam weight:** 15–20% of the BC exam
**Topics:** 10.1 Defining Convergent and Divergent Infinite Series · 10.2 Working with Geometric Series · 10.3 The nth Term Test for Divergence · 10.4 Integral Test for Convergence · 10.5 Harmonic Series and p-Series · 10.6 Comparison Tests for Convergence · 10.7 Alternating Series Test for Convergence · 10.8 Ratio Test for Convergence · 10.9 Determining Absolute or Conditional Convergence · 10.10 Alternating Series Error Bound · 10.11 Finding Taylor Polynomial Approximations of Functions · 10.12 Lagrange Error Bound · 10.13 Radius and Interval of Convergence of Power Series · 10.14 Finding Taylor or Maclaurin Series for a Function · 10.15 Representing Functions as Power Series
**Practices:** 1 (Implementing Mathematical Processes), 2 (Connecting Representations), 3 (Justification), 4 (Communication and Notation)
**Framework:** AP Calculus AB and BC CED, Unit 10, Topics 10.1–10.15, in our own words (the whole unit is BC only)

## The ideas that generate every question

1. **A series is the limit of its partial sums (10.1).** Sₙ = a₁ + … + aₙ. If Sₙ → S, the series converges to S; otherwise it diverges. A term is a difference of partial sums: aₙ = Sₙ − Sₙ₋₁.
2. **Geometric series are the one family you can sum (10.2).** ∑ arⁿ converges to (first term)/(1 − r) exactly when |r| < 1.
3. **Terms must go to 0 (10.3).** If lim aₙ ≠ 0, the series diverges. If lim aₙ = 0, you know nothing yet.
4. **Positive series are compared with integrals and with each other (10.4–10.6).** The integral test turns a series into an improper integral; p-series and geometric series are the benchmarks for comparison.
5. **Alternating signs help (10.7, 10.9).** Decreasing magnitudes that go to 0 make an alternating series converge, even when the absolute values diverge (conditional convergence).
6. **The ratio test is the workhorse for factorials, exponentials and power series (10.8, 10.13).**
7. **Error bounds say how good a partial sum or polynomial is (10.10, 10.12).** Alternating: the first omitted term. Lagrange: max |f⁽ⁿ⁺¹⁾| · |x − a|ⁿ⁺¹/(n + 1)!.
8. **Taylor polynomials and series match derivatives at a center (10.11, 10.14).** The coefficient of (x − a)ᵏ is f⁽ᵏ⁾(a)/k!.
9. **New series come from old ones (10.15).** Substitute, multiply by a power of x, differentiate or integrate term by term. The radius stays the same; endpoints must be rechecked.

## Every convergence test

| Test | Hypotheses | Conclusion |
|---|---|---|
| nth term (10.3) | any series | lim aₙ ≠ 0 (or does not exist) ⇒ diverges. lim aₙ = 0 ⇒ inconclusive |
| Geometric (10.2) | ∑ (n = 0 to ∞) arⁿ, a ≠ 0 | converges to a/(1 − r) if \|r\| < 1; diverges if \|r\| ≥ 1 |
| Integral (10.4) | aₙ = f(n), f positive, continuous, decreasing for x ≥ N | ∑ aₙ and ∫ from N to ∞ of f(x) dx both converge or both diverge (the integral's value is not the sum) |
| p-series (10.5) | ∑ 1/nᵖ | converges if p > 1; diverges if p ≤ 1 (p = 1 is the harmonic series) |
| Direct comparison (10.6) | 0 ≤ aₙ ≤ bₙ for n ≥ N | ∑ bₙ converges ⇒ ∑ aₙ converges; ∑ aₙ diverges ⇒ ∑ bₙ diverges |
| Limit comparison (10.6) | aₙ > 0, bₙ > 0, lim aₙ/bₙ = L with 0 < L < ∞ | both converge or both diverge |
| Alternating series (10.7) | ∑ (−1)ⁿ bₙ with bₙ > 0, bₙ decreasing (eventually), bₙ → 0 | converges |
| Ratio (10.8) | aₙ ≠ 0, L = lim \|aₙ₊₁/aₙ\| | L < 1 ⇒ converges absolutely; L > 1 (or ∞) ⇒ diverges; L = 1 ⇒ inconclusive |
| Absolute convergence (10.9) | ∑ \|aₙ\| converges | ∑ aₙ converges (absolutely). If ∑ aₙ converges but ∑ \|aₙ\| diverges, it converges conditionally |

**Choosing a test.** Terms that do not go to 0: nth term test. Ratio of powers: geometric. Rational or root expressions: compare (limit comparison with the leading terms) to a p-series. Factorials or kⁿ: ratio test. Something you can integrate, such as 1/(n ln n): integral test. Alternating signs: check absolute convergence first, then the alternating series test.

## Error bounds

- **Alternating series error bound (10.10).** If the alternating series test applies, |S − Sₙ| ≤ bₙ₊₁, the magnitude of the first term left out, and S lies between consecutive partial sums.
- **Lagrange error bound (10.12).** |f(x) − Pₙ(x)| ≤ M · |x − a|ⁿ⁺¹/(n + 1)!, where M is the maximum of |f⁽ⁿ⁺¹⁾| between a and x. Use the maximum, never the value at the center unless it is the maximum.

## Taylor polynomials, power series and intervals

- Pₙ(x) = f(a) + f′(a)(x − a) + f″(a)/2! (x − a)² + … + f⁽ⁿ⁾(a)/n! (x − a)ⁿ. Center a = 0 gives a Maclaurin polynomial.
- **Radius and interval (10.13).** Apply the ratio test to the absolute values: the limit is |x − a|/R. The series converges absolutely for |x − a| < R and diverges for |x − a| > R. Test each endpoint separately with a series test (often p-series or alternating series).
- A power series always converges at its center. R can be 0 (only the center) or ∞ (all x).
- Differentiating or integrating term by term keeps R but can change the endpoints: differentiating can lose an endpoint, integrating can gain one.

## Maclaurin series to know

| Function | Series | Converges for |
|---|---|---|
| 1/(1 − x) | 1 + x + x² + x³ + … = ∑ xⁿ | −1 < x < 1 |
| eˣ | 1 + x + x²/2! + x³/3! + … = ∑ xⁿ/n! | all x |
| sin x | x − x³/3! + x⁵/5! − … = ∑ (−1)ⁿ x^(2n + 1)/(2n + 1)! | all x |
| cos x | 1 − x²/2! + x⁴/4! − … = ∑ (−1)ⁿ x^(2n)/(2n)! | all x |
| ln(1 + x) | x − x²/2 + x³/3 − … = ∑ (n = 1 to ∞) (−1)ⁿ⁺¹ xⁿ/n | −1 < x ≤ 1 |
| arctan x | x − x³/3 + x⁵/5 − … = ∑ (−1)ⁿ x^(2n + 1)/(2n + 1) | −1 ≤ x ≤ 1 |
| 1/(1 + x²) | 1 − x² + x⁴ − … = ∑ (−1)ⁿ x^(2n) | −1 < x < 1 |

Build the rest: replace x by 2x or −x², multiply by x², differentiate 1/(1 − x) to get 1/(1 − x)² = ∑ n xⁿ⁻¹, integrate 1/(1 + x²) to get arctan x.

## Classic question types and how to attack them

**"Find the third-degree Taylor polynomial from this table of derivatives and use it to approximate f(1.2)."** Divide each derivative by k!, write powers of (x − a), substitute.

**"Show that the approximation differs from f(1.2) by less than 0.01."** Lagrange with the given bound on the next derivative; or, if the series alternates with decreasing terms, the first omitted term.

**"Find the interval of convergence."** Ratio test with absolute values, solve |x − a| < R, then check both endpoints by name.

**"Write the first four nonzero terms and the general term of the series for f′ (or ∫ f)."** Differentiate or integrate each term; keep the index straight (a differentiated constant term disappears).

**"Does the series converge absolutely, conditionally, or diverge?"** Absolute values first (comparison, p-series, ratio), then the alternating series test if needed.

## Justification sentences that earn points

- "lim (n→∞) n/(2n + 1) = 1/2 ≠ 0, so the series diverges by the nth term test."
- "The terms 1/√n are positive, decreasing and have limit 0, so the series converges by the alternating series test. ∑ 1/√n is a p-series with p = 1/2 ≤ 1, so it diverges. The series converges conditionally."
- "lim [(3n + 1)/(n³ − 2)] / (1/n²) = 3, which is positive and finite, and ∑ 1/n² converges, so the series converges by the limit comparison test."
- "At x = 5 the series is ∑ 1/n, the harmonic series, which diverges, so x = 5 is not in the interval of convergence."
- "|f(1.2) − P₃(1.2)| ≤ max |f⁽⁴⁾(x)| · (0.2)⁴/4! ≤ 30(0.0016)/24 = 0.002 < 0.01."
- "The series for f(1) is alternating with terms decreasing in magnitude to 0, so the error is at most the first omitted term, 1/120."

## Common mistakes

- Concluding convergence because the terms go to 0.
- Giving the integral's value as the sum of the series.
- Direct comparison pointing the wrong way ("smaller than a divergent series").
- Calling L = 1 in the ratio test a divergence.
- Forgetting the factorials in Taylor coefficients, or using (x + a) for center a.
- Using the last term kept, not the first term omitted, in the alternating series error bound.
- In the Lagrange bound, using the nth derivative instead of the (n + 1)th, or its value at the center instead of its maximum.
- Skipping the endpoints, or assuming they behave like the original series after differentiating.
- Using a geometric sum formula with the wrong first term when the index starts at 1 or 2.

## Self-test

1. Find ∑ (n = 1 to ∞) 4(1/5)ⁿ.
2. Does ∑ n²/(n⁴ + 1) converge? Name the test.
3. Classify ∑ (−1)ⁿ/(n + 1): absolutely, conditionally or divergent.
4. For ∑ (−1)ⁿ⁺¹/n⁴, bound |S − S₃|.
5. Find the interval of convergence of ∑ (x − 1)ⁿ/(n · 2ⁿ).
6. Write the Maclaurin series for x e^(−x²) through four nonzero terms.
7. P₂ for eˣ about 0 approximates e^0.1. Give the Lagrange bound.

**Answers.** 1. (4/5)/(1 − 1/5) = 1. 2. Converges, limit comparison with ∑ 1/n² (limit 1). 3. Conditionally: alternating series test applies; ∑ 1/(n + 1) diverges like the harmonic series. 4. 1/4⁴ = 1/256. 5. −1 ≤ x < 3 (x = 3 gives the harmonic series; x = −1 the alternating harmonic series). 6. x − x³ + x⁵/2 − x⁷/6. 7. e^0.1 (0.1)³/3! ≈ 0.000184.

---

*Original study material for this course, organised around the College Board AP Calculus AB and BC Course and Exam Description (Unit 10, Topics 10.1–10.15). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). AP® is a trademark of the College Board, which does not endorse this material.*
