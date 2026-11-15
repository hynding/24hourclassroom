# Week 17 · Improper Integrals

**Topics:** 6.13 Evaluating Improper Integrals
**Practices:** 1 (Implementing Mathematical Processes), 2 (Connecting Representations), 3 (Justification), 4 (Communication and Notation)
**Framework:** AP Calculus AB and BC CED, Unit 6, Topic 6.13, learning objectives in our own words
**Spiral:** The Fundamental Theorem (week 14) evaluates ∫ from a to b of f(x) dx only when the interval is finite and f is continuous on it. This week drops both conditions and replaces the missing piece with a limit, so you need limits at infinity and infinite limits from Unit 1, L'Hospital's Rule from Unit 4, and every antiderivative technique so far: substitution (week 14), long division (week 15), and last week's integration by parts and partial fractions. Improper integrals come back in Unit 10, where the integral test compares a series with one.

## What you need to be able to do

- **6.13** Recognise an improper integral: an infinite limit of integration, or an integrand that is unbounded at an endpoint or at a point inside the interval.
- **6.13** Write an improper integral as a limit of definite integrals, using correct notation (lim (b→∞), lim (t→a⁺), and so on).
- **6.13** Evaluate that limit, or show that it is infinite or does not exist, and state whether the integral converges or diverges.
- **6.13** Split an integral at an interior discontinuity, or a doubly infinite integral at a convenient point, and treat each piece separately.
- **6.13** Combine improper integrals with substitution, integration by parts and partial fractions, using L'Hospital's Rule for the limits that result.

## Key terms

| Term | Meaning |
|---|---|
| Improper integral | An integral with an infinite limit of integration or an integrand that is unbounded on the interval. |
| Converges | The defining limit exists and is a finite number, which is the value of the integral. |
| Diverges | The defining limit is infinite or does not exist; the integral has no value. |
| p-integral | ∫ from 1 to ∞ of 1/x^p dx or ∫ from 0 to 1 of 1/x^p dx, the benchmark improper integrals. |
| Interior discontinuity | A point c strictly between a and b where the integrand is unbounded; the integral must be split there. |
| Doubly infinite integral | ∫ from −∞ to ∞, split into two improper integrals that must each converge. |

## Infinite intervals

There is no number ∞ to plug into an antiderivative, so define the integral as a limit:

- ∫ from a to ∞ of f(x) dx = lim (b→∞) ∫ from a to b of f(x) dx
- ∫ from −∞ to b of f(x) dx = lim (a→−∞) ∫ from a to b of f(x) dx

The routine is always the same: integrate to a finite bound, simplify, then take the limit. On the AP exam the limit notation is part of the answer; writing F(∞) earns nothing.

**Worked example (a convergent and a divergent integral).** Compare ∫ from 1 to ∞ of 1/x² dx with ∫ from 1 to ∞ of 1/x dx.

For 1/x²: ∫ from 1 to b of x^(−2) dx = [−1/x] from 1 to b = 1 − 1/b. As b → ∞, 1/b → 0, so the integral converges to 1.

For 1/x: ∫ from 1 to b of 1/x dx = ln b − ln 1 = ln b. As b → ∞, ln b → ∞, so the integral diverges.

Both integrands tend to 0, and their graphs look alike. The difference is speed: 1/x² falls fast enough that the area to the right of x = 1 is finite, while 1/x does not. **An integrand tending to 0 is necessary for convergence on [a, ∞), never sufficient.**

**The p-integrals.** For p ≠ 1, ∫ from 1 to b of x^(−p) dx = (b^(1−p) − 1)/(1 − p). If p > 1 the exponent 1 − p is negative, b^(1−p) → 0 and the value is 1/(p − 1). If p < 1 the power grows without bound. With p = 1 you get ln b. So

**∫ from 1 to ∞ of 1/x^p dx converges exactly when p > 1, to 1/(p − 1).**

**Worked example (parts plus L'Hospital).** Evaluate ∫ from 0 to ∞ of x e^(−2x) dx.

Integrate by parts with u = x, dv = e^(−2x) dx, so du = dx and v = −(1/2)e^(−2x):

∫ from 0 to b of x e^(−2x) dx = [−(x/2)e^(−2x)] from 0 to b + (1/2) ∫ from 0 to b of e^(−2x) dx
= −(b/2)e^(−2b) − (1/4)e^(−2b) + 1/4.

Now the limit. The term (b/2)e^(−2b) = b/(2e^(2b)) has the form ∞/∞; L'Hospital's Rule gives 1/(4e^(2b)) → 0. The term (1/4)e^(−2b) → 0 directly. So the integral converges to **1/4**.

Exponentials beat powers: any polynomial times e^(−kx) with k > 0 tends to 0 as x → ∞, and L'Hospital's Rule is how you justify it in writing.

## Unbounded integrands

The other kind of improper integral has a finite interval but an integrand that blows up. If f is continuous on (a, b] and unbounded as x → a⁺,

∫ from a to b of f(x) dx = lim (t→a⁺) ∫ from t to b of f(x) dx,

and similarly with t → b⁻ when the trouble is at the upper limit. Always approach the bad point from inside the interval.

**The p-integrals near 0.** ∫ from 0 to 1 of 1/x^p dx converges exactly when p < 1, to 1/(1 − p). The condition is the reverse of the infinite-interval case: near 0, a smaller power blows up more slowly. So 1/√x (p = 1/2) gives a finite area near 0 and 1/x² does not.

**Worked example (trouble at the upper limit).** Evaluate ∫ from 0 to 4 of 1/√(4 − x) dx.

The integrand → ∞ as x → 4⁻. With u = 4 − x, an antiderivative is −2√(4 − x). So

lim (t→4⁻) [−2√(4 − x)] from 0 to t = lim (t→4⁻) (−2√(4 − t) + 2√4) = 0 + 4 = 4.

The integral converges to 4.

**Worked example (an interior discontinuity).** Evaluate ∫ from 0 to 3 of 1/(x − 1)² dx.

A careless calculation gives [−1/(x − 1)] from 0 to 3 = −1/2 − 1 = −3/2, which is impossible: the integrand is positive, so the integral cannot be negative. The integrand is unbounded at x = 1, inside the interval, so split there:

∫ from 0 to 1 of 1/(x − 1)² dx = lim (t→1⁻) [−1/(x − 1)] from 0 to t = lim (t→1⁻) (−1/(t − 1) − 1) = ∞.

That piece diverges, so the whole integral diverges; there is no need to check the other piece. **Before applying the Fundamental Theorem, scan the interval for zeros of denominators, logarithms at 0, and tan x or sec x at odd multiples of π/2.**

## Doubly infinite integrals and splitting

For ∫ from −∞ to ∞ of f(x) dx, choose any point c (0 is usual) and write

∫ from −∞ to c of f(x) dx + ∫ from c to ∞ of f(x) dx,

with **two independent limits**. The integral converges only if both pieces converge.

**Worked example (a doubly infinite integral).** Evaluate ∫ from −∞ to ∞ of x/(x² + 1)² dx.

With u = x² + 1, an antiderivative is −1/(2(x² + 1)).

- ∫ from 0 to ∞: lim (b→∞) (−1/(2(b² + 1)) + 1/2) = 1/2.
- ∫ from −∞ to 0: lim (a→−∞) (−1/2 + 1/(2(a² + 1))) = −1/2.

Both converge, so the integral converges to 1/2 + (−1/2) = 0.

Here the odd symmetry gave 0, but only because each half converged. For ∫ from −∞ to ∞ of x dx, the symmetric shortcut lim (b→∞) ∫ from −b to b of x dx = 0 is wrong: ∫ from 0 to ∞ of x dx diverges, so the whole integral diverges.

## Improper integrals with partial fractions

Partial fractions produce a difference of logarithms, and each logarithm alone grows without bound. Combine them into one logarithm **before** taking the limit.

**Worked example (combine, then take the limit).** Evaluate ∫ from 3 to ∞ of 2/(x² − 1) dx.

Last week's method gives 2/(x² − 1) = 1/(x − 1) − 1/(x + 1), so an antiderivative is ln|x − 1| − ln|x + 1| = ln|(x − 1)/(x + 1)|. Then

lim (b→∞) [ln((x − 1)/(x + 1))] from 3 to b = lim (b→∞) ln((b − 1)/(b + 1)) − ln(2/4) = ln 1 + ln 2 = ln 2.

Splitting the integral into ∫ from 3 to ∞ of 1/(x − 1) dx minus ∫ from 3 to ∞ of 1/(x + 1) dx would give ∞ − ∞, which has no value. An improper integral can be split into a sum or difference only when every piece converges.

## A note on comparison

If 0 ≤ f(x) ≤ g(x) on [a, ∞) and ∫ g converges, the smaller area ∫ f must be finite too; if ∫ f diverges, so must ∫ g. For example, 0 ≤ e^(−x²) ≤ e^(−x) for x ≥ 1, so ∫ from 1 to ∞ of e^(−x²) dx is finite even though e^(−x²) has no elementary antiderivative. This is useful for intuition and for checking an answer. AP Topic 6.13 asks you to evaluate improper integrals, not to run comparison tests; the comparison idea returns formally in Unit 10, for series.

## Common mistakes

- **Plugging in ∞.** Write the limit: lim (b→∞) ∫ from a to b. Expressions such as "−1/∞ = 0" are not acceptable notation.
- **Missing an interior discontinuity.** Applying F(b) − F(a) across a vertical asymptote gives a wrong (often negative) answer for a divergent integral.
- **Thinking f → 0 means convergence.** ∫ from 1 to ∞ of 1/x dx diverges.
- **Mixing up the two p-tests.** On [1, ∞) you need p > 1; on (0, 1] you need p < 1.
- **Using one symmetric limit for ∫ from −∞ to ∞.** The two halves need separate limits and must both converge.
- **Splitting into divergent pieces.** Combine logarithms (or other terms) first, then take the limit.
- **Leaving an indeterminate form unresolved.** b e^(−b) and t ln t need L'Hospital's Rule (or a stated growth-rate fact), not a guess.
- **Approaching from the wrong side.** Trouble at the lower limit a means t → a⁺; at the upper limit b, t → b⁻.

## Self-check

1. Evaluate ∫ from 2 to ∞ of 1/x³ dx.
2. Evaluate ∫ from 0 to 9 of 1/√x dx.
3. Evaluate ∫ from 1 to ∞ of (ln x)/x² dx.
4. Does ∫ from 0 to 2 of 1/∛(x − 1) dx converge? If so, find its value.
5. Does ∫ from 2 to ∞ of 1/(x ln x) dx converge?
6. Evaluate ∫ from −∞ to ∞ of e^(−|x|) dx.

*Answers:* 1. lim (b→∞) [−1/(2x²)] from 2 to b = 1/8. 2. lim (t→0⁺) [2√x] from t to 9 = 6. 3. Parts with u = ln x, v = −1/x: [−(ln x)/x − 1/x] from 1 to b = −(ln b)/b − 1/b + 1; (ln b)/b → 0 by L'Hospital's Rule, so the value is 1. 4. Split at x = 1. An antiderivative is (3/2)(x − 1)^(2/3); the left piece is 0 − 3/2 = −3/2 and the right piece is 3/2 − 0 = 3/2. Both converge, so the integral converges to 0. 5. With u = ln x, ∫ from 2 to b = ln(ln b) − ln(ln 2) → ∞, so it diverges. 6. By symmetry, each half is ∫ from 0 to ∞ of e^(−x) dx = 1 (each half converges), so the value is 2.

---

*Original study material for this course, organised around the College Board AP Calculus AB and BC Course and Exam Description (Unit 6, Topic 6.13). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). AP® is a trademark of the College Board, which does not endorse this material.*
