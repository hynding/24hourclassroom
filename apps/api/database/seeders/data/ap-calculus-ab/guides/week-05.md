# Week 05 · Infinite Limits, Limits at Infinity and the Intermediate Value Theorem

**Topics:** 1.14 Connecting Infinite Limits and Vertical Asymptotes · 1.15 Connecting Limits at Infinity and Horizontal Asymptotes · 1.16 Working with the Intermediate Value Theorem (IVT)
**Practices:** 2 (Connecting Representations), 3 (Justification), 1 (Implementing Mathematical Processes)
**Framework:** AP Calculus AB and BC CED, Unit 1, Topics 1.14–1.16, learning objectives in our own words
**Spiral:** Week 3 named infinite discontinuities; week 4 defined continuity on an interval. This week describes infinite discontinuities precisely with one-sided infinite limits, studies behaviour at the far ends of the graph, and puts continuity to work in the first big theorem of the course. From precalculus: vertical and horizontal asymptotes of rational functions, end behaviour, and the graphs of eˣ and ln x.

## What you need to be able to do

- **1.14** Interpret lim (x→c) f(x) = ±∞ as unbounded behaviour, connect it to vertical asymptotes, and decide the sign on each side.
- **1.14** Tell a vertical asymptote from a hole by factoring.
- **1.15** Find limits at infinity for rational, radical and exponential expressions, and connect them to horizontal asymptotes.
- **1.15** Compare growth rates at infinity (logarithmic, polynomial, exponential).
- **1.16** State the Intermediate Value Theorem, check its hypotheses, and use it to guarantee that a function takes a value, from a formula or from a table.

## Key terms

| Term | Meaning |
|---|---|
| Infinite limit | lim (x→c) f(x) = ∞ (or −∞): f(x) grows past every bound as x → c; the limit does not exist as a number. |
| Vertical asymptote | The line x = c when at least one one-sided limit at c is ±∞. |
| Limit at infinity | lim (x→∞) f(x) = L: f(x) stays as close to L as we like for all large x. |
| Horizontal asymptote | The line y = L when lim (x→∞) f(x) = L or lim (x→−∞) f(x) = L. |
| Dominant term | The term that grows fastest; it decides the limit at infinity. |
| Intermediate Value Theorem | A continuous function on [a, b] takes every value between f(a) and f(b) somewhere in (a, b). |

## Infinite limits and vertical asymptotes (1.14)

When a quotient's numerator approaches a nonzero number and its denominator approaches 0, the quotient grows without bound. We record this with ∞ or −∞, which describes *how* the limit fails to exist. The sign comes from a quick sign analysis on each side of c.

**Worked example.** Let r(x) = (2x² − 2)/(x² − 4x + 3). Describe its behaviour near each zero of the denominator.

Factor first: r(x) = 2(x − 1)(x + 1)/((x − 1)(x − 3)).

- **x = 1.** The factor x − 1 cancels completely, leaving 2(x + 1)/(x − 3) for x ≠ 1, which approaches 2(2)/(−2) = −2. A **hole** at (1, −2), not an asymptote.
- **x = 3.** The remaining denominator x − 3 approaches 0 and the numerator 2(x + 1) approaches 8.

| | numerator | x − 3 | quotient |
|---|---|---|---|
| x → 3⁻ (e.g. 2.99) | positive | small negative | → −∞ |
| x → 3⁺ (e.g. 3.01) | positive | small positive | → ∞ |

So lim (x→3⁻) r(x) = −∞ and lim (x→3⁺) r(x) = ∞, and x = 3 is a vertical asymptote. Writing "lim (x→3) r(x) = ∞" would be wrong: the two sides disagree. If the denominator factor were squared, (x − 3)², it would be positive on both sides and the two one-sided limits would share a sign.

Other familiar asymptotes: tan x at x = π/2 + nπ, and ln x at x = 0, where lim (x→0⁺) ln x = −∞.

## Limits at infinity and horizontal asymptotes (1.15)

As x → ∞, the term that grows fastest dominates. For rational functions, divide every term by the highest power of x in the denominator; every term like 5/x or 1/x² then approaches 0.

**Worked example.** Find each limit.

1. lim (x→∞) (3x² − 5x)/(6x² + 1). Divide by x²: (3 − 5/x)/(6 + 1/x²) → 3/6 = 1/2. Equal degrees: the ratio of leading coefficients. Horizontal asymptote y = 1/2.
2. lim (x→∞) (7x + 2)/(x² − 4). Divide by x²: (7/x + 2/x²)/(1 − 4/x²) → 0/1 = 0. Denominator degree larger: y = 0.
3. lim (x→∞) (x³ + 1)/(2x² − 7). Divide by x²: (x + 1/x²)/(2 − 7/x²) grows without bound. Numerator degree larger: no horizontal asymptote.

| Degrees | lim (x→±∞) | Horizontal asymptote |
|---|---|---|
| top < bottom | 0 | y = 0 |
| top = bottom | ratio of leading coefficients | y = that ratio |
| top > bottom | ±∞ | none |

**Radicals change the rules at −∞.** Because √(x²) = |x|, a square root of an x² term behaves like −x when x is negative.

**Worked example.** Find the horizontal asymptotes of f(x) = (4x − 1)/√(x² + 3).

- As x → ∞: √(x² + 3) = x√(1 + 3/x²), so f(x) = (4 − 1/x)/√(1 + 3/x²) → 4.
- As x → −∞: √(x² + 3) = |x|√(1 + 3/x²) = −x√(1 + 3/x²), so f(x) = (4 − 1/x)/(−√(1 + 3/x²)) → −4.

Two horizontal asymptotes: y = 4 on the right and y = −4 on the left. A rational function can never do this, but radical and exponential functions can.

**Exponentials and growth rates.** lim (x→−∞) eˣ = 0 and lim (x→∞) eˣ = ∞, so y = 0 is a horizontal asymptote of eˣ on the left only. At infinity, ln x grows more slowly than any positive power of x, and every power of x grows more slowly than eˣ. So lim (x→∞) x³/eˣ = 0, and lim (x→∞) (ln x)/x = 0. Oscillating numerators can be squeezed: −1/x ≤ (cos x)/x ≤ 1/x for x > 0 gives lim (x→∞) (cos x)/x = 0.

## The Intermediate Value Theorem (1.16)

> If f is continuous on the closed interval [a, b] and N is any number between f(a) and f(b), then there is at least one number c in (a, b) with f(c) = N.

A continuous graph cannot get from height f(a) to height f(b) without passing through every height in between. Two hypotheses carry the theorem, and an AP justification must state both: **continuity on [a, b]**, and **N between f(a) and f(b)**, with the values shown. The conclusion says "at least one c"; it never says where c is or how many there are.

**Worked example.** Show that x³ + x − 1 = 0 has a solution between 0 and 1.

Let f(x) = x³ + x − 1. f is a polynomial, so it is continuous on [0, 1]. f(0) = −1 and f(1) = 1, so 0 is between f(0) and f(1). By the Intermediate Value Theorem there is a c in (0, 1) with f(c) = 0.

Without continuity the conclusion can fail: f(x) = 1/(x − 0.5) has f(0) = −2 and f(1) = 2 but is never 0, because of the asymptote at 0.5.

**Worked example (table).** A hypothetical greenhouse's temperature T(t), in °C, is continuous for 0 ≤ t ≤ 12 hours.

| t (hours) | 0 | 3 | 5 | 8 | 12 |
|---|---|---|---|---|---|
| T(t) (°C) | 14 | 19 | 26 | 22 | 17 |

What is the least number of times T(t) = 20 must occur? Check each interval between consecutive table values. 20 is between 19 and 26 (on [3, 5]) and between 22 and 17 (on [8, 12]); it is not between 14 and 19 or between 26 and 22. So T(t) = 20 at least twice, once in (3, 5) and once in (8, 12). It might happen more often; the table cannot rule that out.

Sentence that earns the point: "Because T is continuous on [3, 5] and T(3) = 19 < 20 < 26 = T(5), the Intermediate Value Theorem guarantees a time c in (3, 5) with T(c) = 20."

## Common mistakes

- **One ∞ for two different sides.** Give one-sided limits when the signs differ.
- **Calling every denominator zero an asymptote.** Cancel first; a factor that cancels completely leaves a hole.
- **Ratio of leading coefficients when the degrees differ.** That rule is for equal degrees only.
- **Treating √(x²) as x for negative x.** It is |x|, which flips the sign of the left-hand limit.
- **Thinking a horizontal asymptote cannot be crossed or must be reached.** It describes the ends only.
- **Applying the IVT without continuity, or without showing N between the endpoint values.**
- **Claiming the IVT gives exactly one solution, or the location of c.**

## Where this goes next

That completes Unit 1. Unit 2 uses limits to define the derivative, lim (h→0) (f(x + h) − f(x))/h, exactly the difference-quotient limit from week 1, and the 0/0 techniques of week 2 are what make it computable. The IVT returns alongside the Mean Value Theorem and the Extreme Value Theorem in Unit 5.

## Self-check

1. Find lim (x→−2⁻) (x + 5)/(x + 2) and lim (x→−2⁺) (x + 5)/(x + 2).
2. Does (x² − 9)/(x² − x − 6) have a vertical asymptote at x = 3? At x = −2?
3. Find lim (x→∞) (2 − 9x²)/(3x² + x).
4. Find lim (x→−∞) (6x + 1)/√(4x² − 1).
5. Show that cos x = x has a solution in (0, π/2).
6. g is continuous on [1, 5], g(1) = 4 and g(5) = −2. Must g equal 5 somewhere in (1, 5)? Must it equal 0?

*Answers:* 1. −∞ and ∞ (numerator → 3). 2. (x − 3)(x + 3)/((x − 3)(x + 2)): a hole at 3, an asymptote at −2. 3. −3. 4. −3 (√(4x²) = 2|x| = −2x for x < 0). 5. Let h(x) = cos x − x, continuous; h(0) = 1 > 0 and h(π/2) = −π/2 < 0, so by the IVT h(c) = 0 for some c in (0, π/2). 6. Not necessarily 5 (it is not between −2 and 4); yes 0, by the IVT.

---

*Original study material for this course, organised around the College Board AP Calculus AB and BC Course and Exam Description (Unit 1, Topics 1.14–1.16). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). AP® is a trademark of the College Board, which does not endorse this material.*
