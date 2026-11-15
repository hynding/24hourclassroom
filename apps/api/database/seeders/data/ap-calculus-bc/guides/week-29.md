# Week 29 · Alternating Series, the Ratio Test and Absolute Convergence

**Topics:** 10.7 Alternating Series Test for Convergence · 10.8 Ratio Test for Convergence · 10.9 Determining Absolute or Conditional Convergence
**Practices:** 1 (Implementing Mathematical Processes), 2 (Connecting Representations), 3 (Justification), 4 (Communication and Notation)
**Framework:** AP Calculus AB and BC CED, Unit 10, Topics 10.7–10.9, learning objectives in our own words
**Spiral:** Week 27 gave the nth term test and geometric series; week 28 gave the integral, p-series and comparison tests, all for series with positive terms. This week handles series whose terms change sign. The alternating series test needs the "decreasing" reasoning of Unit 5 (f′ < 0), the ratio test is a limit at infinity in the style of Unit 1 and week 9, and the idea of absolute convergence reuses every positive-term test from week 28. Next week's alternating series error bound and the power series of weeks 31 and 32 depend on all three topics.

## What you need to be able to do

- **10.7** State the alternating series test's three conditions (the terms alternate in sign, decrease in absolute value and approach 0), verify each one, and conclude convergence.
- **10.8** Apply the ratio test, simplifying ratios with powers and factorials, and draw the right conclusion for L < 1, L > 1 and L = 1.
- **10.9** Define absolute and conditional convergence, explain why absolute convergence implies convergence, and classify a series as absolutely convergent, conditionally convergent or divergent with full justification.

## Key terms

| Term | Meaning |
|---|---|
| Alternating series | A series whose terms alternate in sign, ∑ (−1)ⁿ bₙ or ∑ (−1)ⁿ⁺¹ bₙ with bₙ > 0. |
| Alternating series test | If the terms alternate, bₙ decreases and bₙ → 0, the series converges. |
| Ratio test | With L = lim \|aₙ₊₁/aₙ\|: L < 1 converges absolutely, L > 1 diverges, L = 1 inconclusive. |
| Factorial | n! = 1 · 2 · 3 · … · n, with 0! = 1; (n + 1)! = (n + 1) · n!. |
| Absolutely convergent | ∑ \|aₙ\| converges. |
| Conditionally convergent | ∑ aₙ converges but ∑ \|aₙ\| diverges. |

## The alternating series test (10.7)

Think of the partial sums of 1 − 1/2 + 1/3 − 1/4 + … as steps of a walker on a number line: forward 1, back 1/2, forward 1/3, back 1/4. Each step is shorter than the last and reverses direction, so the walker zigzags inside a shrinking window. If the step lengths shrink to 0, the window closes on a single point, and the series converges.

**Alternating series test.** Suppose bₙ > 0. The series ∑ (−1)ⁿ bₙ (or ∑ (−1)ⁿ⁺¹ bₙ) converges if

1. the terms **alternate in sign**,
2. the terms **decrease in absolute value**, bₙ₊₁ ≤ bₙ (at least from some n on), and
3. **lim (n→∞) bₙ = 0**.

AP readers want all three conditions stated, with a reason for the decrease. Two common reasons: a denominator that increases while the numerator stays fixed, or f′(x) < 0 for the function f(x) with f(n) = bₙ.

**Worked example (verifying the conditions).** Does ∑ (n = 1 to ∞) (−1)ⁿ⁺¹/√n converge?

- The factor (−1)ⁿ⁺¹ makes the terms alternate in sign.
- bₙ = 1/√n decreases, because √n increases.
- lim (n→∞) 1/√n = 0.

All three conditions hold, so the series converges by the alternating series test.

**What the test cannot do.** It never shows divergence. If condition 3 fails, use the nth term test instead: ∑ (−1)ⁿ n/(3n − 1) has |aₙ| → 1/3, so it diverges by the nth term test. If condition 2 fails, the test simply does not apply and another method is needed. And the test says nothing about ∑ bₙ, the series without the signs.

## The ratio test (10.8)

A geometric series has a constant ratio r between consecutive terms and converges exactly when |r| < 1. The ratio test asks whether a series is *eventually like* a geometric series.

**Ratio test.** For a series ∑ aₙ with nonzero terms, let

L = lim (n→∞) |aₙ₊₁/aₙ|.

- If **L < 1**, the series **converges absolutely**.
- If **L > 1** (including L = ∞), the series **diverges**.
- If **L = 1**, the test is **inconclusive**.

The reason: if L < 1, pick a number r with L < r < 1; from some point on, each |aₙ₊₁| ≤ r|aₙ|, so the tail of ∑ |aₙ| is smaller than a convergent geometric series. If L > 1, the terms eventually grow in size and cannot approach 0.

The ratio test is the tool for **factorials and nth powers**. Two algebra facts do most of the work:

- (n + 1)!/n! = n + 1, and (2n + 2)!/(2n)! = (2n + 2)(2n + 1).
- 3ⁿ⁺¹/3ⁿ = 3, and n-dependent powers such as ((n + 1)/n)² approach 1.

**Worked example (ratio test, three outcomes).**

- ∑ (n = 1 to ∞) n²/3ⁿ: |aₙ₊₁/aₙ| = [(n + 1)²/3ⁿ⁺¹] · [3ⁿ/n²] = ((n + 1)/n)² · (1/3) → 1/3 < 1. The series converges absolutely.
- ∑ (n = 1 to ∞) n!/10ⁿ: |aₙ₊₁/aₙ| = [(n + 1)!/n!] · [10ⁿ/10ⁿ⁺¹] = (n + 1)/10 → ∞. The series diverges.
- ∑ (n = 0 to ∞) 2ⁿ/n!: |aₙ₊₁/aₙ| = 2/(n + 1) → 0 < 1. The series converges absolutely.

**Worked example (where the ratio test fails).** For any p-series ∑ 1/nᵖ,

|aₙ₊₁/aₙ| = nᵖ/(n + 1)ᵖ = (n/(n + 1))ᵖ → 1.

That is true for p = 2 (convergent) and p = 1 (divergent) alike, so L = 1 cannot decide anything. Whenever the terms are rational or root expressions in n, expect L = 1 and go back to the week 28 tests.

**Justification language.** Show the simplified ratio, its limit and the comparison with 1: "lim |aₙ₊₁/aₙ| = lim (n + 1)²/(3n²) = 1/3 < 1, so the series converges absolutely by the ratio test." Never write "L = 1, so the series diverges".

## Absolute and conditional convergence (10.9)

A series with mixed signs can converge for two different reasons: because its terms are small enough that even their absolute values add to something finite, or only because positive and negative terms cancel.

- ∑ aₙ is **absolutely convergent** if ∑ |aₙ| converges.
- ∑ aₙ is **conditionally convergent** if ∑ aₙ converges but ∑ |aₙ| diverges.

**Absolute convergence implies convergence.** Since −|aₙ| ≤ aₙ ≤ |aₙ|, we have 0 ≤ aₙ + |aₙ| ≤ 2|aₙ|. If ∑ |aₙ| converges, then ∑ (aₙ + |aₙ|) converges by direct comparison, and ∑ aₙ = ∑ (aₙ + |aₙ|) − ∑ |aₙ| converges as the difference of two convergent series. This is how a series with irregular signs, such as ∑ sin(n)/n², is shown to converge: |sin(n)/n²| ≤ 1/n², so it converges absolutely.

The converse is false. The **alternating harmonic series** ∑ (−1)ⁿ⁺¹/n converges by the alternating series test (its sum turns out to be ln 2), but ∑ 1/n diverges. It is the standard conditionally convergent series.

Conditional convergence is fragile. Riemann showed that the terms of a conditionally convergent series can be rearranged to add to any number you like, or to diverge. An absolutely convergent series has the same sum in every order.

**The classification procedure.**

1. **nth term test.** If the terms do not approach 0, the series is **divergent**. Stop.
2. **Test ∑ |aₙ|** with a positive-term test (p-series, comparison, integral, ratio). If it converges, the series is **absolutely convergent**. Stop.
3. If ∑ |aₙ| diverges, test ∑ aₙ itself, usually with the **alternating series test**. If it converges, the series is **conditionally convergent**.

**Worked example (one of each).**

- ∑ (n = 1 to ∞) (−1)ⁿ/n²: ∑ 1/n² converges (p = 2 > 1). **Absolutely convergent.**
- ∑ (n = 1 to ∞) (−1)ⁿ/(n + 4): the absolute values 1/(n + 4) give lim [1/(n + 4)]/(1/n) = 1 with 0 < 1 < ∞, and ∑ 1/n diverges, so ∑ 1/(n + 4) diverges by limit comparison. But the series alternates, 1/(n + 4) decreases (the denominator increases) and 1/(n + 4) → 0, so it converges by the alternating series test. **Conditionally convergent.**
- ∑ (n = 1 to ∞) (−1)ⁿ n/(n + 1): |aₙ| = n/(n + 1) → 1 ≠ 0. **Divergent** by the nth term test.

### Choosing a test: a decision chart

| Question to ask | If yes |
|---|---|
| Do the terms fail to approach 0? | nth term test: divergent. |
| Is it geometric? | Converges exactly when \|r\| < 1; sum = first term/(1 − r). |
| Is it a p-series, or like one (rational or root terms)? | p-series test, or limit or direct comparison. |
| Are there factorials or nth powers? | Ratio test. |
| Is the term easy to integrate and decreasing? | Integral test. |
| Does it alternate, with ∑ \|aₙ\| divergent? | Alternating series test: conditional convergence. |

## Common mistakes

- **Leaving out "decreasing"** when applying the alternating series test, or asserting it with no reason.
- **Using the alternating series test to claim divergence.** If a condition fails, the test is silent; divergence needs the nth term test or another argument.
- **Reading L = 1 as divergence or convergence.** It is inconclusive.
- **Dropping the absolute value in the ratio test.** The ratio of an alternating series is negative; use its absolute value.
- **Botched factorial algebra.** n!/(n + 1)! = 1/(n + 1), not n/(n + 1).
- **Thinking ∑ |aₙ| divergent means ∑ aₙ divergent.** The alternating harmonic series is the counterexample.
- **Calling a series "conditionally convergent" without testing ∑ |aₙ|.** The classification needs both halves.

## Self-check

1. Show that ∑ (n = 1 to ∞) (−1)ⁿ/(3n + 2) converges, and classify it.
2. Use the ratio test on ∑ (n = 1 to ∞) 4ⁿ/(n · 3ⁿ).
3. Use the ratio test on ∑ (n = 1 to ∞) n/5ⁿ.
4. Classify ∑ (n = 1 to ∞) (−1)ⁿ⁺¹/n^(3/4) and ∑ (n = 1 to ∞) (−1)ⁿ⁺¹/n^(5/4).
5. Why does ∑ (n = 1 to ∞) (−1)ⁿ (n² + 1)/n² diverge, even though it alternates?

*Answers:* 1. Alternates, 1/(3n + 2) decreases and → 0, so it converges; ∑ 1/(3n + 2) diverges (limit comparison with 1/n, L = 1/3), so it is conditionally convergent. 2. |aₙ₊₁/aₙ| = (4/3) · n/(n + 1) → 4/3 > 1: diverges. 3. (n + 1)/(5n) → 1/5 < 1: converges absolutely. 4. p = 3/4 ≤ 1 for the absolute values but the alternating series test holds: conditionally convergent; p = 5/4 > 1: absolutely convergent. 5. |aₙ| → 1 ≠ 0, so it diverges by the nth term test.

---

*Original study material for this course, organised around the College Board AP Calculus AB and BC Course and Exam Description (Unit 10, Topics 10.7–10.9). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). AP® is a trademark of the College Board, which does not endorse this material.*
