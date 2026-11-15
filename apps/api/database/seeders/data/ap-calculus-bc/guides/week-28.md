# Week 28 · The Integral Test, p-Series and Comparison Tests

**Topics:** 10.4 Integral Test for Convergence · 10.5 Harmonic Series and p-Series · 10.6 Comparison Tests for Convergence
**Practices:** 1 (Implementing Mathematical Processes), 2 (Connecting Representations), 3 (Justification), 4 (Communication and Notation)
**Framework:** AP Calculus AB and BC CED, Unit 10, Topics 10.4–10.6, learning objectives in our own words
**Spiral:** Week 27 defined convergence through partial sums, summed geometric series and gave the nth term test, which can only prove divergence. This week supplies tests that can prove convergence for series with positive terms. The integral test turns a series into an improper integral (week 17), evaluated with substitution (week 14) or partial fractions (week 16). The p-series it produces, together with week 27's geometric series, become the yardsticks for the comparison tests, which rely on the limits at infinity of Unit 1 and the dominant-term reasoning of week 3.

## What you need to be able to do

- **10.4** State and verify the hypotheses of the integral test (positive, continuous, decreasing), use it to decide convergence, and explain why the integral's value is not the series' sum.
- **10.5** Show that the harmonic series diverges, and decide whether a p-series ∑ 1/nᵖ converges (p > 1) or diverges (p ≤ 1), after rewriting if necessary.
- **10.6** Use the direct comparison test with a correct inequality in the useful direction.
- **10.6** Use the limit comparison test, choosing the comparison series by dominant terms and stating that the limit is finite and positive.

## Key terms

| Term | Meaning |
|---|---|
| Integral test | For f positive, continuous and decreasing with f(n) = aₙ, ∑ aₙ and ∫ f(x) dx converge or diverge together. |
| Harmonic series | ∑ (n = 1 to ∞) 1/n, which diverges. |
| p-series | ∑ (n = 1 to ∞) 1/nᵖ, convergent exactly when p > 1. |
| Direct comparison test | If 0 ≤ aₙ ≤ bₙ: ∑ bₙ converges ⇒ ∑ aₙ converges; ∑ aₙ diverges ⇒ ∑ bₙ diverges. |
| Limit comparison test | If aₙ, bₙ > 0 and lim aₙ/bₙ = L with 0 < L < ∞, the two series behave alike. |
| Dominant term | The fastest-growing part of an expression, which sets its behaviour for large n. |

## The integral test (10.4)

Picture the terms of ∑ aₙ as rectangles of width 1: the nth rectangle sits on [n, n + 1] with height aₙ = f(n). If f is decreasing, each rectangle lies **above** the graph of f on its interval, and the rectangle on [n − 1, n] lies **below** it. Comparing areas:

∫ from 1 to ∞ of f(x) dx ≤ ∑ (n = 1 to ∞) aₙ ≤ a₁ + ∫ from 1 to ∞ of f(x) dx.

So the sum is finite exactly when the integral is finite. That is the test.

**Integral test.** Suppose f(n) = aₙ and f is **positive, continuous and decreasing** for x ≥ N. Then ∑ (n = N to ∞) aₙ and ∫ from N to ∞ of f(x) dx either both converge or both diverge.

Three points matter on the AP exam:

1. **State all three hypotheses** and give a reason for "decreasing" (usually f′(x) < 0, or a denominator that grows while the numerator stays fixed).
2. The hypotheses need only hold **eventually**, from some N on, since the first few terms never affect convergence.
3. **The integral is not the sum.** The double inequality above shows only that the sum lies between the integral and the integral plus a₁. For ∑ 1/n², ∫ from 1 to ∞ of dx/x² = 1, so 1 ≤ ∑ 1/n² ≤ 2; the true sum is about 1.645.

**Worked example (a divergent series).** Does ∑ (n = 1 to ∞) n/(n² + 1) converge?

Let f(x) = x/(x² + 1). For x ≥ 1 it is positive and continuous, and f′(x) = (1 − x²)/(x² + 1)² ≤ 0, so it is decreasing. With u = x² + 1,

∫ from 1 to b of x/(x² + 1) dx = (1/2)ln(b² + 1) − (1/2)ln 2 → ∞ as b → ∞.

The integral diverges, so the series diverges by the integral test. (The nth term test was useless here: the terms approach 0.)

**Worked example (a convergent series).** Does ∑ (n = 2 to ∞) 1/(n(ln n)²) converge?

f(x) = 1/(x(ln x)²) is positive and continuous for x ≥ 2, and decreasing because its denominator x(ln x)² increases. With u = ln x, du = dx/x:

∫ from 2 to b of dx/(x(ln x)²) = [−1/ln x] from 2 to b = 1/ln 2 − 1/ln b → 1/ln 2.

The integral converges, so the series converges. Its sum is not 1/ln 2.

**When the test cannot be used.** If f is not eventually decreasing, as with f(x) = (2 + sin x)/x², or if f has no antiderivative you can evaluate, use a comparison test instead.

## The harmonic series and p-series (10.5)

Apply the integral test to f(x) = 1/xᵖ with p > 0 (positive, continuous, decreasing for x ≥ 1). Week 17 showed that ∫ from 1 to ∞ of dx/xᵖ converges exactly when p > 1. Therefore:

**p-series test.** ∑ (n = 1 to ∞) 1/nᵖ converges if p > 1 and diverges if p ≤ 1.

(For p ≤ 0 the terms do not even approach 0, so the nth term test already gives divergence.)

The case p = 1 is the **harmonic series** ∑ 1/n. Its terms approach 0, but ∫ from 1 to b of dx/x = ln b grows without bound, so it diverges. Its partial sums grow like ln n: very slowly (the first million terms add to only about 14.4), but without limit. The harmonic series is the standard counterexample to "terms go to 0, so it converges".

**Worked example (classifying p-series).** Rewrite each term as 1/nᵖ.

| Series | Rewritten | p | Verdict |
|---|---|---|---|
| ∑ √n/n² | 1/n^(3/2) | 3/2 | converges |
| ∑ 1/∛n | 1/n^(1/3) | 1/3 | diverges |
| ∑ 7/n | 7 · 1/n | 1 | diverges |
| ∑ n^(−π) | 1/n^π | π | converges |
| ∑ n/n^(2.5) | 1/n^(1.5) | 1.5 | converges |

A nonzero constant factor never changes convergence, so 7/n behaves like 1/n. Justify with a sentence that names p: "∑ 1/n^(3/2) is a p-series with p = 3/2 > 1, so it converges."

## Comparison tests (10.6)

Comparison tests judge a series with positive terms by a known series: a p-series or a geometric series.

### Direct comparison

**Direct comparison test.** Suppose 0 ≤ aₙ ≤ bₙ for all n ≥ N.
- If ∑ bₙ converges, then ∑ aₙ converges (smaller than convergent).
- If ∑ aₙ diverges, then ∑ bₙ diverges (larger than divergent).

The other two situations, smaller than divergent and larger than convergent, prove **nothing**. Before writing any comparison, ask which way the inequality must go for the conclusion you expect.

**Worked example (smaller than convergent).** For ∑ (n = 1 to ∞) 1/(n² + 5): since n² + 5 > n², 0 < 1/(n² + 5) < 1/n² for all n ≥ 1. ∑ 1/n² converges (p = 2 > 1), so ∑ 1/(n² + 5) converges by direct comparison.

**Worked example (larger than divergent).** For ∑ (n = 3 to ∞) (ln n)/n: for n ≥ 3, ln n > 1 (because 3 > e), so (ln n)/n > 1/n > 0. The harmonic series diverges, so ∑ (ln n)/n diverges by direct comparison.

Geometric series work as yardsticks too: 0 < 2ⁿ/(3ⁿ + 1) < (2/3)ⁿ, and ∑ (2/3)ⁿ converges, so ∑ 2ⁿ/(3ⁿ + 1) converges.

### Limit comparison

Direct comparison fails when the inequality goes the wrong way. For example, 1/(n² − 3) is *larger* than 1/n², so comparing it with 1/n² directly proves nothing, even though the two series clearly behave alike. The limit comparison test captures "behaves alike" exactly.

**Limit comparison test.** Suppose aₙ > 0 and bₙ > 0 for all n ≥ N, and lim (n→∞) aₙ/bₙ = L, where **0 < L < ∞**. Then ∑ aₙ and ∑ bₙ both converge or both diverge.

**Choosing bₙ.** Keep only the dominant term of the numerator and of the denominator, and simplify. That gives the p-series (or geometric series) your series imitates.

**Worked example (limit comparison, convergent).** ∑ (n = 1 to ∞) (2n + 1)/(n³ + 4). Dominant terms give 2n/n³ = 2/n², so take bₙ = 1/n².

lim (n→∞) [(2n + 1)/(n³ + 4)] / [1/n²] = lim (2n³ + n²)/(n³ + 4) = 2.

Both series have positive terms, 0 < 2 < ∞, and ∑ 1/n² converges, so ∑ (2n + 1)/(n³ + 4) converges by the limit comparison test.

**Worked example (limit comparison, divergent).** ∑ (n = 1 to ∞) 1/(2n − 1). Dominant terms give 1/(2n), so take bₙ = 1/n.

lim (n→∞) [1/(2n − 1)] / [1/n] = lim n/(2n − 1) = 1/2, and 0 < 1/2 < ∞.

The harmonic series diverges, so ∑ 1/(2n − 1) diverges.

**What the limit must be.** If L = 0 or L = ∞, the basic test gives no conclusion; that usually means the comparison series was badly chosen. Fix it by matching the dominant terms more carefully.

### Which test?

| The term looks like… | Try |
|---|---|
| A constant times 1/nᵖ | p-series test |
| A rational or root expression in n | Limit comparison with the dominant-term p-series |
| Something easy to integrate (ln n with 1/n, n e^(−n²)) | Integral test |
| A bounded wiggle such as sin n or cos n over a power | Direct comparison |
| Terms that do not approach 0 | nth term test (week 27) |

## Common mistakes

- **Equating the integral with the sum.** The integral test proves convergence; it does not give the sum.
- **Skipping a hypothesis.** "Decreasing" is the one students forget. Give a reason, usually f′ < 0.
- **p > 0 instead of p > 1.** ∑ 1/√n diverges.
- **Comparing in the useless direction.** Smaller than divergent, or larger than convergent, proves nothing.
- **Leaving out 0 < L < ∞.** AP scoring requires the condition on the limit to be stated, not just the number.
- **Inverting the limit comparison quotient** is harmless only when you then compare the right series; write aₙ/bₙ consistently.
- **Using the comparison tests on series with negative terms.** Both need positive terms; series with mixed signs wait for week 29.

## Self-check

1. Use the integral test to decide whether ∑ (n = 1 to ∞) 1/(n + 1)² converges, verifying the hypotheses.
2. Classify ∑ (n = 1 to ∞) n²/n^(3.5) and ∑ (n = 1 to ∞) 4/n^0.9.
3. Use direct comparison to decide whether ∑ (n = 1 to ∞) 1/(3ⁿ + n) converges.
4. Use limit comparison to decide whether ∑ (n = 1 to ∞) (n + 4)/(n² + 1) converges.
5. Explain why the direct comparison 1/(n² − 3) > 1/n² (for n ≥ 2) proves nothing about ∑ (n = 2 to ∞) 1/(n² − 3), and settle the question another way.

*Answers:* 1. f(x) = 1/(x + 1)² is positive, continuous and decreasing for x ≥ 1; ∫ from 1 to ∞ = [−1/(x + 1)] from 1 to ∞ = 1/2, so it converges. 2. 1/n^(1.5): converges; 4/n^0.9: diverges (p = 0.9 ≤ 1). 3. 0 < 1/(3ⁿ + n) < (1/3)ⁿ, a convergent geometric series, so it converges. 4. With bₙ = 1/n, the limit is lim (n² + 4n)/(n² + 1) = 1, so it diverges like the harmonic series. 5. Larger than a convergent series proves nothing; limit comparison with 1/n² gives L = 1, so the series converges.

---

*Original study material for this course, organised around the College Board AP Calculus AB and BC Course and Exam Description (Unit 10, Topics 10.4–10.6). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). AP® is a trademark of the College Board, which does not endorse this material.*
