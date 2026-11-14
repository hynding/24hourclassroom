# Week 04 · Continuity at a Point, on an Interval, and Removing Discontinuities

**Topics:** 1.11 Defining Continuity at a Point · 1.12 Confirming Continuity over an Interval · 1.13 Removing Discontinuities
**Practices:** 3 (Justification), 1 (Implementing Mathematical Processes), 4 (Communication and Notation)
**Framework:** AP Calculus AB and BC CED, Unit 1, Topics 1.11–1.13, learning objectives in our own words
**Spiral:** Week 3 named the three kinds of discontinuity using one-sided limits. This week turns that around: continuity is the absence of a discontinuity, defined by one equation. It relies on every limit technique from weeks 1–3, and on precalculus domain rules (no zero denominators, no even roots of negatives, no logarithms of non-positive numbers).

## What you need to be able to do

- **1.11** State the three conditions for continuity at x = c and use them to justify that a function is, or is not, continuous at a point.
- **1.12** Explain continuity on open and closed intervals, including one-sided continuity at endpoints.
- **1.12** Use the fact that polynomial, rational, root, trigonometric, exponential and logarithmic functions are continuous on their domains to find where a function is continuous.
- **1.13** Remove a removable discontinuity by defining or redefining a single value.
- **1.13** Choose constants in a piecewise function so that it is continuous at its break points.

## Key terms

| Term | Meaning |
|---|---|
| Continuous at c | lim (x→c) f(x) = f(c): the value exists, the limit exists, and they are equal. |
| Right-continuous at a | lim (x→a⁺) f(x) = f(a). |
| Left-continuous at b | lim (x→b⁻) f(x) = f(b). |
| Continuous on (a, b) | Continuous at every point of the open interval. |
| Continuous on [a, b] | Continuous on (a, b), right-continuous at a and left-continuous at b. |
| Continuous on its domain | Continuous at every input where it is defined (endpoints one-sided). |
| Break point | An input where a piecewise function changes formula. |

## Continuity at a point (1.11)

Informally, f is continuous at c if you can draw its graph through x = c without lifting your pencil. Formally, three things must all happen:

1. **f(c) is defined.** There is a point on the graph at x = c.
2. **lim (x→c) f(x) exists.** The graph heads to one height from both sides.
3. **lim (x→c) f(x) = f(c).** The point is exactly where the graph heads.

Each kind of discontinuity breaks a different condition. A hole with no point fails condition 1; a jump or an asymptote fails condition 2; a misplaced point fails condition 3.

**Worked example.** Let h(x) = (x² − 1)/(x − 1) for x < 1, h(1) = 3, h(x) = 3x − 1 for 1 < x ≤ 4, and h(x) = √(x + 5) + 8 for x > 4. Is h continuous at x = 1? At x = 4?

*At x = 1.*
- h(1) = 3, so condition 1 holds.
- lim (x→1⁻) h(x): substitution gives 0/0, so factor: (x − 1)(x + 1)/(x − 1) = x + 1 → 2. lim (x→1⁺) h(x) = 3(1) − 1 = 2. The limit exists and equals 2: condition 2 holds.
- 2 ≠ 3, so condition 3 fails. **h is not continuous at 1** (a removable discontinuity).

*At x = 4.*
- h(4) = 3(4) − 1 = 11.
- lim (x→4⁻) h(x) = 11 and lim (x→4⁺) h(x) = √9 + 8 = 11, so lim (x→4) h(x) = 11.
- lim (x→4) h(x) = 11 = h(4). **h is continuous at 4.**

**Writing a justification.** The AP exam rewards a sentence that names the value, the limit and their equality: "h(4) = 11 and lim (x→4⁻) h(x) = lim (x→4⁺) h(x) = 11, so lim (x→4) h(x) = h(4) and h is continuous at x = 4." A bare "yes, the pieces meet" does not earn the point.

## Continuity on an interval (1.12)

A function is **continuous on an open interval** if it is continuous at every point inside it. For a **closed interval** [a, b], the endpoints only need one-sided continuity, since inputs outside the interval do not count: f must be right-continuous at a and left-continuous at b. That is why √x is continuous on [0, ∞): lim (x→0⁺) √x = 0 = √0, and there is no left side to worry about.

Checking continuity point by point would be endless, so we lean on families of functions that are **continuous on their domains**:

- polynomials (everywhere);
- rational functions (everywhere except zeros of the denominator);
- roots (where the radicand is allowed: non-negative for even roots);
- sin x and cos x (everywhere); tan x (except x = π/2 + nπ);
- exponentials bˣ (everywhere) and logarithms (positive inputs).

Combinations keep continuity. Sums, differences and products of continuous functions are continuous; a quotient is continuous wherever the denominator is not 0; and a composition f(g(x)) is continuous at c when g is continuous at c and f is continuous at g(c). So the job "where is this continuous?" usually becomes "what is the domain?".

**Worked example.** Where is f(x) = √(x − 2)/(x − 5) continuous?

The numerator needs x − 2 ≥ 0, so x ≥ 2. The denominator needs x ≠ 5. f is a quotient of continuous functions, so it is continuous on its domain, [2, 5) ∪ (5, ∞). At x = 2 the continuity is one-sided: lim (x→2⁺) f(x) = 0/(−3) = 0 = f(2).

**Piecewise functions.** Each piece is usually continuous on its own interval, so only the **break points** need checking (plus any input where a piece is itself undefined). That is exactly what the worked example with h did.

## Removing discontinuities (1.13)

A removable discontinuity has a limit, so one new value repairs it.

**Worked example.** Let g(x) = (x² − 16)/(x − 4) for x ≠ 4. Define g(4) so that g is continuous everywhere.

For x ≠ 4, g(x) = (x − 4)(x + 4)/(x − 4) = x + 4, so lim (x→4) g(x) = 8. Defining g(4) = 8 makes lim (x→4) g(x) = g(4). The extended function is just the line y = x + 4, with the hole filled.

Jumps and infinite discontinuities cannot be removed this way: the limit does not exist, so there is nothing for f(c) to equal.

**Choosing constants.** Many questions give a piecewise function with an unknown constant and ask for the value that makes it continuous. At a break point c, continuity needs

left-hand limit = right-hand limit = f(c).

Each break point gives one equation.

**Worked example.** Let f(x) = kx + 1 for x < 2 and f(x) = x² + k for x ≥ 2. Find k so that f is continuous everywhere.

- Each piece is a polynomial, so only x = 2 needs checking.
- lim (x→2⁻) f(x) = 2k + 1. lim (x→2⁺) f(x) = 4 + k = f(2).
- Set them equal: 2k + 1 = 4 + k, so k = 3.
- Check: both sides equal 7, and f(2) = 7. f is continuous at 2, hence everywhere.

With two unknowns and two break points, write one equation per break point and solve the system, starting with the equation that has only one unknown. If a piece contains a 0/0 expression, simplify it first so that its one-sided limit is a clean expression.

## Common mistakes

- **Checking only one condition.** A defined value, or an existing limit, is not continuity by itself.
- **Forgetting both one-sided limits at a break point.** Compute each with its own piece.
- **Treating closed-interval endpoints as two-sided.** At an endpoint only the inside one-sided limit matters.
- **Calling a function discontinuous where it is undefined but outside the interval in question.** 1/(x − 5) is continuous on [0, 3].
- **Solving for a constant before substituting the break point.** Substitute x = c first, then solve.
- **Trying to remove a jump.** If the one-sided limits differ, no value of f(c) works.

## Where this goes next

Week 5 finishes the unit: infinite limits and vertical asymptotes, limits at infinity and horizontal asymptotes, and the Intermediate Value Theorem, whose first hypothesis is continuity on a closed interval. In Unit 2, continuity becomes a necessary condition for differentiability.

## Self-check

1. Show that f(x) = x² − 3 for x ≤ 2 and f(x) = 3x − 5 for x > 2 is continuous at x = 2, using all three conditions.
2. Where is ln(x + 1)/(x − 2) continuous?
3. Define g(−3) so that g(x) = (x² + 2x − 3)/(x + 3) is continuous at x = −3.
4. Find c so that f(x) = cx² for x < 1 and f(x) = 4x − c for x ≥ 1 is continuous.
5. Is f(x) = |x|/x continuous on [1, 5]? On [−1, 1]?
6. Find a and b so that f(x) = ax + 1 for x < 0, f(x) = b for x = 0, and f(x) = x² + 2 for x > 0 is continuous at 0.

*Answers:* 1. f(2) = 1; left limit 4 − 3 = 1; right limit 6 − 5 = 1; the limit equals the value. 2. (−1, 2) ∪ (2, ∞). 3. g(x) = x − 1 for x ≠ −3, so g(−3) = −4. 4. c = 4 − c, c = 2. 5. Yes on [1, 5] (it equals 1 there); no on [−1, 1] (undefined at 0, with a jump). 6. The left limit is 1 and the right limit is 2 whatever a is, so no values of a and b work: the jump cannot be removed.

---

*Original study material for this course, organised around the College Board AP Calculus AB and BC Course and Exam Description (Unit 1, Topics 1.11–1.13). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). AP® is a trademark of the College Board, which does not endorse this material.*
