# Week 03 · The Squeeze Theorem, Multiple Representations and Discontinuities

**Topics:** 1.8 Determining Limits Using the Squeeze Theorem · 1.9 Connecting Multiple Representations of Limits · 1.10 Exploring Types of Discontinuities
**Practices:** 3 (Justification), 2 (Connecting Representations), 1 (Implementing Mathematical Processes)
**Framework:** AP Calculus AB and BC CED, Unit 1, Topics 1.8–1.10, learning objectives in our own words
**Spiral:** Week 1 read limits from graphs and tables; week 2 computed them with limit properties and algebra. This week adds a theorem for limits that algebra cannot reach, insists that graph, table and formula tell the same story, and uses one-sided limits to sort the ways a function can break.

## What you need to be able to do

- **1.8** State the squeeze theorem, check its two hypotheses, and use it to find limits such as lim (x→0) x² cos(1/x).
- **1.8** Build bounding functions from −1 ≤ sin u ≤ 1 and −1 ≤ cos u ≤ 1.
- **1.9** Move between a formula, a table and a graph for the same limit, and use one representation to check another.
- **1.10** Classify a discontinuity as removable, jump or infinite using one-sided limits and the function value.

## Key terms

| Term | Meaning |
|---|---|
| Squeeze theorem | If g(x) ≤ f(x) ≤ h(x) near c (except possibly at c) and g and h both approach L as x → c, then f approaches L too. |
| Bounding functions | The functions g and h that trap f from below and above. |
| Removable discontinuity | lim (x→c) f(x) exists, but f(c) is undefined or different from the limit. |
| Jump discontinuity | The one-sided limits at c are both finite but unequal. |
| Infinite discontinuity | At least one one-sided limit at c is ∞ or −∞ (a vertical asymptote). |
| Hole | The graph of a removable discontinuity: a missing point (often with an isolated dot elsewhere). |

## The squeeze theorem (1.8)

Some limits resist every algebraic trick. The classic case is a shrinking factor times an oscillating one, such as x² cos(1/x): cos(1/x) swings between −1 and 1 infinitely often near 0, so neither factoring nor substitution helps. The **squeeze theorem** handles these.

> If g(x) ≤ f(x) ≤ h(x) for all x near c (except possibly at c), and lim (x→c) g(x) = lim (x→c) h(x) = L, then lim (x→c) f(x) = L.

Think of f as a person walking between two friends who are both heading to the same door: f has no choice but to arrive there too. Both hypotheses matter. If the bounds head to different numbers, f could end up anywhere between them, or nowhere.

**Worked example.** Find lim (x→0) x² cos(1/x).

1. Start from what is always true: −1 ≤ cos(1/x) ≤ 1 for every x ≠ 0.
2. Multiply through by x², which is positive for x ≠ 0, so the inequality keeps its direction: −x² ≤ x² cos(1/x) ≤ x².
3. Take the limits of the bounds: lim (x→0) (−x²) = 0 and lim (x→0) x² = 0.
4. Conclude: since x² cos(1/x) is between −x² and x² near 0 and both bounds approach 0, the squeeze theorem gives lim (x→0) x² cos(1/x) = 0.

A justification on the AP exam should contain all four pieces: the inequality, why it holds, both outer limits, and the name of the theorem.

For x sin(1/x) the factor x can be negative, which would flip an inequality, so bound with |x| instead: −|x| ≤ x sin(1/x) ≤ |x|, and both bounds approach 0. By contrast, sin(1/x) by itself has only the bounds −1 and 1, whose limits differ, so the squeeze theorem gives nothing, and in fact the limit does not exist.

**Worked example.** For all real x, 4x − 9 ≤ f(x) ≤ x² − 2x. Find lim (x→3) f(x).

The bounds are different functions, and that is fine. Both are polynomials, so their limits come from substitution: 4(3) − 9 = 3 and 3² − 2(3) = 3. The outer limits agree, so by the squeeze theorem lim (x→3) f(x) = 3. (The two bounds touch at x = 3, since x² − 2x − (4x − 9) = (x − 3)² ≥ 0.)

**Where the sine limit comes from.** Comparing areas inside the unit circle (a triangle, a sector and a larger triangle) gives cos x ≤ (sin x)/x ≤ 1 for x near 0, x ≠ 0. Both bounds approach 1, so lim (x→0) (sin x)/x = 1. Week 2 used that fact; this is its proof.

## Connecting representations (1.9)

A limit can be shown by a formula, a table or a graph, and on the AP exam you are expected to move between them. Each has strengths:

| Representation | Strength | Weakness |
|---|---|---|
| Formula | Gives exact values through algebra | Can hide behaviour until rewritten |
| Table | Quick numerical evidence from both sides | Finitely many inputs; can miss behaviour |
| Graph | Shows holes, jumps and asymptotes at a glance | Pixels round off; calculators draw over holes |

**Worked example.** Let f(x) = (x² − 4)/(x − 2) + 1. Show lim (x→2) f(x) three ways.

- **Formula:** for x ≠ 2, (x − 2)(x + 2)/(x − 2) + 1 = x + 3, so the limit is 2 + 3 = 5.
- **Table:**

| x | 1.9 | 1.99 | 1.999 | 2.001 | 2.01 | 2.1 |
|---|---|---|---|---|---|---|
| f(x) | 4.9 | 4.99 | 4.999 | 5.001 | 5.01 | 5.1 |

  Both sides approach 5.
- **Graph:** the line y = x + 3 with a hole at (2, 5), because f(2) is undefined.

All three agree. If they did not, you would trust the algebra, and look for an arithmetic slip, a table with inputs that are too far from 2, or a calculator window that drew over a hole. Reverse questions are common too: given a table and a description of a graph, choose the formula that could produce them. Check each candidate's value near the input, whether it is defined at the input, and whether it is bounded there.

## Types of discontinuity (1.10)

A function is broken at x = c when its graph cannot be drawn through c without lifting the pencil. One-sided limits sort the breaks into three types.

| Type | Limit facts | Graph |
|---|---|---|
| Removable | lim (x→c) f(x) exists; f(c) is undefined or ≠ the limit | a hole, possibly with a stray dot |
| Jump | lim (x→c⁻) f(x) and lim (x→c⁺) f(x) are finite and unequal | the graph leaps to a new height |
| Infinite | lim (x→c⁻) f(x) or lim (x→c⁺) f(x) is ±∞ | a vertical asymptote |

"Removable" means that one value can repair it: define f(c) to be the limit and the hole is filled (week 4 does exactly this). No single value repairs a jump or an asymptote.

For rational functions the factors tell you the type at a glance. Factor numerator and denominator. A factor that cancels completely leaves a **hole**; a factor that remains in the denominator gives a **vertical asymptote**. For k(x) = (x² − 9)/(x² − 5x + 6) = (x − 3)(x + 3)/((x − 2)(x − 3)), x = 3 is removable (the limit is (3 + 3)/(3 − 2) = 6) and x = 2 is infinite.

**Worked example.** Let g(x) = (x² − 2x − 3)/(x − 3) for x < 3, g(3) = 1, g(x) = 7 − x for 3 < x < 6, and g(x) = 4/(x − 7) for x ≥ 6, x ≠ 7. Classify every discontinuity.

- **x = 3.** Left: the quotient factors to (x − 3)(x + 1)/(x − 3) = x + 1, which approaches 4. Right: 7 − x approaches 4. The limit is 4, but g(3) = 1. **Removable.**
- **x = 6.** Left: 7 − 6 = 1. Right: 4/(6 − 7) = −4. Finite and unequal. **Jump.**
- **x = 7.** Just left of 7 the denominator is a small negative number, so g(x) → −∞; just right, g(x) → ∞. **Infinite.**

Everywhere else each piece is a polynomial or a rational function with a nonzero denominator, so there are no other breaks.

## Common mistakes

- **Skipping a hypothesis of the squeeze theorem.** State the inequality and both outer limits, and check the outer limits are equal.
- **Multiplying an inequality by a quantity that can be negative.** Use x² or |x| as the shrinking factor, or treat the sides separately.
- **Thinking any oscillating factor kills the limit.** A factor approaching 0 can squeeze the oscillation away.
- **Calling a hole a jump.** A jump needs two different one-sided limits.
- **Calling every undefined point removable.** Removable needs the limit to exist; at a vertical asymptote it does not.
- **Trusting a calculator graph near a hole.** Use the formula or a table.

## Where this goes next

Week 4 defines continuity at a point with three conditions, extends it to intervals, and removes removable discontinuities by choosing values or constants. Week 5 studies infinite discontinuities and asymptotes in depth and introduces the Intermediate Value Theorem.

## Self-check

1. Use the squeeze theorem to find lim (x→0) x⁴ sin(3/x). State every step.
2. If 2 − |x| ≤ f(x) ≤ 2 + x² near 0, find lim (x→0) f(x).
3. Why can't the squeeze theorem find lim (x→0) cos(1/x)?
4. A table of h near x = −1 shows values 6.9, 6.99, 7.01, 7.1, and h(−1) = 2. Classify the discontinuity.
5. Classify the discontinuities of (x² − x)/(x² − 1).
6. f(x) = x + 1 for x < 2 and f(x) = x² for x ≥ 2. Classify the discontinuity at 2.

*Answers:* 1. −x⁴ ≤ x⁴ sin(3/x) ≤ x⁴; both bounds → 0, so the limit is 0. 2. 2. 3. Its only bounds are −1 and 1, which have different limits. 4. Removable: the limit appears to be 7, but h(−1) = 2. 5. x(x − 1)/((x − 1)(x + 1)): removable at x = 1 (limit 1/2), infinite at x = −1. 6. Left 3, right 4: jump.

---

*Original study material for this course, organised around the College Board AP Calculus AB and BC Course and Exam Description (Unit 1, Topics 1.8–1.10). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). AP® is a trademark of the College Board, which does not endorse this material.*
