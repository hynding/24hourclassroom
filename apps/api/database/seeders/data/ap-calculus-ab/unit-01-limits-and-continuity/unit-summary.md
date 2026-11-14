# Unit 1 · Limits and Continuity · The night-before sheet

**AP exam weight:** 10–15% of the exam
**Topics:** 1.1 Introducing Calculus: Can Change Occur at an Instant? · 1.2 Defining Limits and Using Limit Notation · 1.3 Estimating Limit Values from Graphs · 1.4 Estimating Limit Values from Tables · 1.5 Determining Limits Using Algebraic Properties of Limits · 1.6 Determining Limits Using Algebraic Manipulation · 1.7 Selecting Procedures for Determining Limits · 1.8 Determining Limits Using the Squeeze Theorem · 1.9 Connecting Multiple Representations of Limits · 1.10 Exploring Types of Discontinuities · 1.11 Defining Continuity at a Point · 1.12 Confirming Continuity over an Interval · 1.13 Removing Discontinuities · 1.14 Connecting Infinite Limits and Vertical Asymptotes · 1.15 Connecting Limits at Infinity and Horizontal Asymptotes · 1.16 Working with the Intermediate Value Theorem (IVT)
**Practices:** 1 (Implementing Mathematical Processes), 2 (Connecting Representations), 3 (Justification), 4 (Communication and Notation)
**Framework:** AP Calculus AB and BC CED, Unit 1, Topics 1.1–1.16, in our own words

## The ideas that generate every question

1. **An instantaneous rate is a limit of average rates (1.1).** Average rates over [a, a + h] approach the rate at a as h → 0. That limit, lim (h→0) (f(a + h) − f(a))/h, becomes the derivative in Unit 2.
2. **A limit describes where f is heading, not where it is (1.2).** lim (x→c) f(x) = L ignores f(c). It exists exactly when both one-sided limits exist and agree.
3. **Graphs and tables estimate limits (1.3, 1.4, 1.9).** On a graph, open circles show limits and solid dots show values. In a table, use inputs closing in from both sides and read the closest ones. Formula, table and graph must agree; the algebra is exact.
4. **Algebra finds limits exactly (1.5–1.7).** Limit properties allow substitution for well-behaved functions. A 0/0 form means rewrite (factor, rationalise, combine fractions, use lim (x→0) (sin x)/x = 1). A nonzero number over 0 means unbounded.
5. **The squeeze theorem traps what algebra cannot reach (1.8).** Shrinking factor times bounded oscillation → 0.
6. **Discontinuities come in three kinds (1.10).** Removable (limit exists, value missing or wrong), jump (finite unequal one-sided limits), infinite (a one-sided limit is ±∞).
7. **Continuity is one equation (1.11–1.13).** lim (x→c) f(x) = f(c). Standard functions are continuous on their domains; piecewise functions need checking at break points; removable discontinuities are fixed by one value; constants are chosen by matching one-sided limits.
8. **Asymptotes are limits (1.14, 1.15).** Vertical: an infinite one-sided limit. Horizontal: a finite limit at ±∞.
9. **Continuity on a closed interval buys a theorem (1.16).** The IVT guarantees every intermediate value is attained.

## Key facts and procedures

| Want | Do this |
|---|---|
| Limit at c from a graph | trace both sides toward x = c; the open circle or common height is the limit |
| Does lim (x→c) f(x) exist? | compute both one-sided limits; equal and finite → yes |
| Limit by substitution | polynomials, and rational/root/trig/exp/log functions in their domains |
| 0/0 with polynomials | factor and cancel |
| 0/0 with a square root | multiply by the conjugate |
| 0/0 with fractions inside | common denominator |
| Trig near 0 | lim (sin x)/x = 1, lim (1 − cos x)/x = 0 (radians); match the angle: sin(kx)/x → k |
| Nonzero/0 | unbounded; sign chart on each side for ±∞ |
| Squeeze | g ≤ f ≤ h near c and lim g = lim h = L ⟹ lim f = L |
| Continuity at c | f(c) defined, lim exists, lim = f(c) |
| Continuity on [a, b] | continuous on (a, b), right-continuous at a, left-continuous at b |
| Remove a discontinuity | define f(c) = lim (x→c) f(x) (removable only) |
| Constant for continuity | left-hand limit = right-hand limit = f(c) at each break point |
| Vertical asymptote vs hole | factor; a factor left in the denominator → asymptote; fully cancelled → hole |
| Rational limit at ±∞ | degree top < bottom: 0; equal: ratio of leading coefficients; top > bottom: ±∞ |
| √(x²) at −∞ | equals |x| = −x |
| Growth at ∞ | ln x ≪ xⁿ ≪ eˣ |
| IVT | f continuous on [a, b], N between f(a) and f(b) ⟹ f(c) = N for some c in (a, b) |

## Sentences that earn AP points

- **Limit does not exist (jump):** "lim (x→2⁻) f(x) = 3 and lim (x→2⁺) f(x) = 1/6; since the one-sided limits are not equal, lim (x→2) f(x) does not exist."
- **Continuity:** "f(4) = 11 and lim (x→4⁻) f(x) = lim (x→4⁺) f(x) = 11, so lim (x→4) f(x) = f(4) and f is continuous at x = 4."
- **Not continuous:** "lim (x→1) h(x) = 2 but h(1) = 3, so lim (x→1) h(x) ≠ h(1) and h is not continuous at x = 1."
- **Squeeze:** "Since −x² ≤ x² cos(1/x) ≤ x² for x ≠ 0 and lim (x→0) (−x²) = lim (x→0) x² = 0, the squeeze theorem gives lim (x→0) x² cos(1/x) = 0."
- **Infinite limit:** "As x → 3⁻ the numerator approaches 8 and the denominator approaches 0 through negative values, so lim (x→3⁻) r(x) = −∞."
- **IVT:** "Because T is continuous on [3, 5] and T(3) = 19 < 20 < 26 = T(5), the Intermediate Value Theorem guarantees a value c in (3, 5) with T(c) = 20."
- **IVT does not apply:** "g is not continuous on [0, 3] (it is undefined at x = 1), so the IVT cannot be used on that interval."

## Classic question types and how to attack them

**"Find the limit from the graph."** Separate value from limit: open circles are limits, dots are values. Check both sides; at an endpoint use the inside side only.

**"Estimate the limit from the table."** Use the inputs closest to c on both sides. Different left and right trends mean no limit.

**"Evaluate the limit."** Substitute first; then follow the 0/0 or nonzero/0 branch. Keep "lim" on every line until you substitute.

**"Find k so that f is continuous."** Each break point gives one equation: left limit = right limit = value. Simplify any 0/0 piece first.

**"Classify the discontinuity."** Compute both one-sided limits and the value; match to removable, jump or infinite.

**"Find all asymptotes."** Factor; cancel; leftover denominator zeros give vertical asymptotes (find each side's sign); compare degrees for horizontal asymptotes, treating √(x²) as |x|.

**"Show that f(c) = N for some c."** State continuity on [a, b] with a reason, compute f(a) and f(b), show N between them, conclude with the IVT. For a table, check each consecutive interval to count guaranteed solutions.

## Common mistakes

- Using f(c) as the limit, or thinking a hole means no limit.
- Averaging unequal one-sided limits.
- Reading 0/0 as 0 or as "does not exist".
- Cancelling terms instead of factors; writing √(x + 9) = √x + 3.
- sin(5x)/x → 1 (it is 5); trig limits in degrees.
- Squeeze theorem with bounds whose limits differ, or without stating the inequality.
- Calling a hole a jump; calling every denominator zero an asymptote.
- One "= ∞" when the two sides have opposite signs.
- Ratio of leading coefficients when the degrees differ; forgetting √(x²) = |x|.
- Applying the IVT without continuity, or claiming it gives exactly one c or its location.

## Calculator or not?

Most of this unit is no-calculator: limits by algebra, continuity arguments, asymptotes and IVT justifications. Expect a calculator for tables of values near c and for evaluating exponential models in context; confirm any hole with the formula, since calculator graphs hide them.

## Self-test

1. lim (x→−4) (x² + 2x − 8)/(x + 4)
2. lim (x→0) (√(x + 25) − 5)/x
3. lim (x→0) sin(7x)/(2x)
4. lim (x→0) x² sin(5/x)
5. Find k so that f(x) = kx − 2 for x < 3 and f(x) = x + k for x ≥ 3 is continuous.
6. Classify the discontinuities of (x² + x − 2)/(x² − 1).
7. Find the horizontal asymptotes of (3x + 2)/√(4x² + 1).
8. f is continuous on [2, 5], f(2) = 7, f(5) = −1. Must f equal 0 on (2, 5)? Must it equal 8?

**Answers.** 1. (x + 4)(x − 2)/(x + 4) → −6. 2. 1/(√(x + 25) + 5) → 1/10. 3. 7/2. 4. 0, squeezed between −x² and x². 5. 3k − 2 = 3 + k, so k = 5/2. 6. (x + 2)(x − 1)/((x − 1)(x + 1)): removable at x = 1 (limit 3/2), infinite at x = −1. 7. y = 3/2 (x → ∞) and y = −3/2 (x → −∞). 8. Yes, by the IVT (0 is between −1 and 7); no guarantee for 8.

---

*Original study material for this course, organised around the College Board AP Calculus AB and BC Course and Exam Description (Unit 1, Topics 1.1–1.16). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). AP® is a trademark of the College Board, which does not endorse this material.*
