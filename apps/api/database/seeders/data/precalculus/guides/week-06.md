# Week 06 · Zeros, Vertical Asymptotes and Holes of Rational Functions

**Topics:** 1.8 Rational Functions and Zeros · 1.9 Rational Functions and Vertical Asymptotes · 1.10 Rational Functions and Holes
**Practices:** 1 (procedural and symbolic fluency), 2 (multiple representations), 3 (communication and reasoning)
**Framework:** AP Precalculus CED, Unit 1, Topics 1.8–1.10, learning objectives in our own words
**Spiral:** Week 5 described what a rational function does far from the origin (end behaviour and horizontal or slant asymptotes). This week looks at what happens near particular inputs: where the function is zero, where it blows up, and where it has a single missing point. Week 4's sign charts for polynomial inequalities come back almost unchanged. From Algebra 2: factoring quadratics, cancelling common factors, and the domain of a rational expression.

## What you need to be able to do

- **1.8** Find the real zeros of a rational function: the zeros of the numerator that are in the domain, that is, not shared with the denominator.
- **1.8** Solve rational inequalities such as (x + 5)/(x − 2) ≤ 0 by locating the zeros of the numerator and denominator and testing the sign of the function on each interval.
- **1.9** Locate the vertical asymptotes of a rational function: real zeros of the denominator that do not cancel completely with the numerator.
- **1.9** Describe the behaviour of the function on each side of a vertical asymptote with one-sided limit notation, such as lim as x → 2⁺ of f(x) = ∞, and justify it from the signs of the factors or from a table.
- **1.10** Locate a hole in the graph: an input where a common factor cancels and the numerator's multiplicity is at least the denominator's. Find its coordinates by evaluating the simplified function.
- **1.10** Use limit notation to describe a hole: the outputs approach a finite value even though the function is undefined there.

## Key terms

| Term | Meaning |
|---|---|
| Rational function | r(x) = p(x)/q(x) where p and q are polynomials and q is not the zero polynomial. |
| Domain of r | All real x with q(x) ≠ 0. Always find it from the original, unsimplified form. |
| Zero of r | A real input a in the domain with r(a) = 0; it comes from a numerator zero not cancelled by the denominator. |
| Vertical asymptote | A line x = a near which |r(x)| grows without bound; at least one one-sided limit at a is ∞ or −∞. |
| One-sided limit | lim as x → a⁺ means x approaches a from values greater than a; x → a⁻ means from values less than a. |
| Hole (removable discontinuity) | A single point (a, L) missing from the graph: r(a) is undefined, but r(x) → L as x → a. |
| Multiplicity | How many times a linear factor (x − a) appears; it decides between hole and asymptote and how the sign behaves. |
| Sign chart | A number line marked at every zero of the numerator and denominator, showing the sign of r on each interval. |

## Start every problem by factoring

Every question this week begins the same way: factor the numerator and the denominator completely, and write down the domain **before** cancelling anything. Then sort each real zero into one of three kinds.

| A real number a that is… | Becomes… |
|---|---|
| a zero of the numerator only | a zero of r (x-intercept at (a, 0)) |
| a zero of the denominator only | a vertical asymptote x = a |
| a zero of both | a hole if the numerator's multiplicity of (x − a) is at least the denominator's; a vertical asymptote if the denominator's multiplicity is larger |

**Worked example.** Classify every special input of r(x) = (2x² + 2x − 12)/(x² − 4).

Factor: r(x) = 2(x + 3)(x − 2)/((x − 2)(x + 2)). Domain: x ≠ 2 and x ≠ −2.

- x = −3: numerator only, so r has a zero there; the graph crosses at (−3, 0).
- x = 2: both, once each, so a hole. Simplified, r(x) = 2(x + 3)/(x + 2) for x ≠ 2. Its value at 2 is 2 · 5/4 = 5/2, so the hole is at (2, 5/2).
- x = −2: denominator only, so a vertical asymptote x = −2.

Week 5 adds the far-away picture: equal degrees, ratio of leading coefficients 2/1, so the horizontal asymptote is y = 2.

## Zeros of rational functions (1.8)

A fraction is zero exactly when its numerator is zero and its denominator is not. So the zeros of r are the real zeros of p that are still in the domain. A numerator zero that the denominator shares is **not** a zero of r, because r is undefined there.

**Worked example.** Find the zeros of f(x) = (x³ − x)/(x² + x).

f(x) = x(x − 1)(x + 1)/(x(x + 1)). The numerator is zero at 0, 1 and −1, but 0 and −1 are excluded from the domain. The only zero is x = 1. The graph of f is the line y = x − 1 with holes at x = 0 and x = −1, at (0, −1) and (−1, −2).

**Worked example.** A numerator with no real zeros. g(x) = (x² + 4)/(x − 1) has no real zeros, because x² + 4 ≥ 4 for every real x. Its graph never touches the x-axis.

### Rational inequalities with a sign chart

To solve r(x) > 0, r(x) ≥ 0, r(x) < 0 or r(x) ≤ 0:

1. Move everything to one side so the other side is 0, and combine into a single fraction.
2. Factor. Mark every real zero of the numerator and of the denominator on a number line.
3. Test one value in each interval (or use the multiplicity rule: the sign flips at a factor of odd multiplicity and stays the same at even multiplicity).
4. Read off the answer. Numerator zeros are included for ≥ or ≤. Denominator zeros are **never** included, whatever the inequality says.

**Worked example.** Solve (x − 2)(x + 1)/(x − 4) < 0.

Critical values: −1 and 2 (numerator), 4 (denominator).

| Interval | Test x | (x − 2) | (x + 1) | (x − 4) | Sign |
|---|---|---|---|---|---|
| x < −1 | −2 | − | − | − | negative |
| −1 < x < 2 | 0 | − | + | − | positive |
| 2 < x < 4 | 3 | + | + | − | negative |
| x > 4 | 5 | + | + | + | positive |

Solution: x < −1 or 2 < x < 4, which is (−∞, −1) ∪ (2, 4).

**Worked example.** Solve 2x/(x + 1) ≤ 1.

Do not multiply both sides by x + 1: its sign is unknown, and a negative multiplier would flip the inequality. Subtract 1 instead: 2x/(x + 1) − (x + 1)/(x + 1) ≤ 0, so (x − 1)/(x + 1) ≤ 0. Critical values −1 and 1. The fraction is negative between them and zero at x = 1. Solution: −1 < x ≤ 1. The endpoint −1 is open because the expression is undefined there.

**Try it.**
1. Find the zeros of (x² − 9)/(x² − x − 6).
2. Solve (x + 3)/(x − 1) ≥ 0.

*Answers:* 1. (x − 3)(x + 3)/((x − 3)(x + 2)): only x = −3 (x = 3 is a hole). 2. x ≤ −3 or x > 1.

## Vertical asymptotes and one-sided limits (1.9)

Near a denominator zero that does not cancel, the denominator is a tiny number while the numerator stays near a nonzero value. A nonzero number divided by something close to 0 is huge, so the outputs grow without bound. The **sign** of the result on each side tells you whether the graph shoots up or down.

**Worked example.** Describe f(x) = (x + 1)/(x − 2) near x = 2.

Near 2 the numerator is close to 3 (positive).

- From the right (x = 2.01): x − 2 = 0.01 is a small positive number, so f(x) ≈ 3/0.01 = 300, and larger as x gets closer. lim as x → 2⁺ of f(x) = ∞.
- From the left (x = 1.99): x − 2 = −0.01, so f(x) ≈ −300. lim as x → 2⁻ of f(x) = −∞.

A table makes this concrete:

| x | 1.9 | 1.99 | 1.999 | 2.001 | 2.01 | 2.1 |
|---|---|---|---|---|---|---|
| f(x) | −29 | −299 | −2999 | 3001 | 301 | 31 |

**Multiplicity matters.** If (x − a) appears in the denominator an **odd** number of times (after cancelling), the outputs head to opposite infinities on the two sides. If it appears an **even** number of times, both sides go the same way, because (x − a)² is positive on both sides.

**Worked example.** g(x) = 1/(x + 1)². For x near −1 on either side, (x + 1)² is a small positive number, so g(x) → ∞ from both sides: lim as x → −1⁻ of g(x) = ∞ and lim as x → −1⁺ of g(x) = ∞.

**Worked example.** h(x) = (x − 5)/((x − 1)(x + 3)). Find the one-sided limits at x = 1.

At x slightly more than 1: (x − 5) is about −4 (negative), (x − 1) small positive, (x + 3) about 4 (positive). Sign: (−)/((+)(+)) = negative, so lim as x → 1⁺ of h(x) = −∞. From the left, (x − 1) is negative, so the sign is (−)/((−)(+)) = positive: lim as x → 1⁻ of h(x) = ∞.

**A function never crosses its vertical asymptote**, because the function is undefined there. (It can cross a horizontal asymptote; that line only describes the far ends.)

**Try it.**
1. Vertical asymptotes of (x + 4)/(x² − 16)?
2. For k(x) = −2/(x − 3), give lim as x → 3⁻ of k(x).

*Answers:* 1. (x + 4)/((x − 4)(x + 4)): only x = 4 (x = −4 is a hole). 2. Left of 3, x − 3 is negative, so −2/(negative small) is positive and large: ∞.

## Holes (1.10)

When a factor (x − a) cancels completely, the simplified function has a perfectly ordinary value at a, but the original function is still undefined there. The graph is the graph of the simplified function with one point removed: an open circle.

**Finding the hole.** Cancel, then substitute a into the simplified function. The result L is the y-coordinate, and lim as x → a of r(x) = L.

**Worked example.** k(x) = (x² + 2x − 15)/(x − 3) = (x + 5)(x − 3)/(x − 3). For x ≠ 3, k(x) = x + 5. The graph is the line y = x + 5 with a hole at (3, 8). lim as x → 3 of k(x) = 8, but k(3) is undefined.

**When the multiplicities differ.**

- Numerator multiplicity larger. m(x) = (x − 1)²(x + 2)/((x − 1)(x − 4)) simplifies to (x − 1)(x + 2)/(x − 4) for x ≠ 1. The simplified function is 0 at x = 1, so the hole is at (1, 0): the graph appears to touch the x-axis there, but x = 1 is not a zero of m because m(1) is undefined.
- Denominator multiplicity larger. n(x) = (x − 1)/(x − 1)³ simplifies to 1/(x − 1)² for x ≠ 1, and the denominator is still zero at 1. That is a vertical asymptote, not a hole.

**Worked example.** Find all features of f(x) = (x² − 1)/(x² − 2x − 3).

f(x) = (x − 1)(x + 1)/((x − 3)(x + 1)). Domain x ≠ 3, −1. Simplified: (x − 1)/(x − 3).

- Hole at x = −1: (−2)/(−4) = 1/2, so (−1, 1/2).
- Zero at x = 1.
- Vertical asymptote x = 3. Near 3 the numerator is about 2, so lim as x → 3⁺ = ∞ and lim as x → 3⁻ = −∞.
- Vertical intercept f(0) = (−1)/(−3) = 1/3.
- Horizontal asymptote y = 1 (equal degrees, leading coefficients 1 and 1).

**Try it.**
1. Find the hole of (x² − 7x + 10)/(x² − 4).
2. Does (x + 2)/(x + 2)² have a hole or a vertical asymptote at x = −2?

*Answers:* 1. (x − 5)(x − 2)/((x − 2)(x + 2)) → (x − 5)/(x + 2) at 2 is −3/4: hole at (2, −3/4). 2. A vertical asymptote: it simplifies to 1/(x + 2).

## Putting it together: a complete sketch from features

For r(x) = (x − 2)(x + 1)/(x − 4) (no common factors):

- Zeros at −1 and 2; vertical intercept r(0) = (−2)(1)/(−4) = 1/2.
- Vertical asymptote x = 4: lim as x → 4⁻ = −∞ (sign chart shows negative on (2, 4)) and lim as x → 4⁺ = ∞.
- End behaviour (week 5): degree 2 over degree 1, so no horizontal asymptote; for large |x|, r(x) behaves like x²/x = x. As x → ∞, r(x) → ∞; as x → −∞, r(x) → −∞. Week 7 finds the exact slant asymptote by division.

These features, with the sign chart from the inequality example, are enough for a correct sketch.

## Calculator notes

A graphing calculator draws vertical asymptotes badly (sometimes as a near-vertical line joining two branches) and usually does not show holes at all, because the chance of the calculator sampling exactly x = a is tiny. Use the table feature instead: set the table to start just left of a with a small step, such as 0.001, and watch the outputs. "ERROR" or "undefined" at exactly a, with outputs settling toward a number on both sides, signals a hole; outputs growing without bound signal an asymptote. AP non-calculator questions expect you to do all of this by factoring and sign reasoning.

## Common mistakes

- **Cancelling before finding the domain.** The simplified form hides the excluded input; the hole disappears from your answer.
- **Calling every denominator zero an asymptote.** A factor that cancels completely gives a hole.
- **Calling a shared numerator zero a zero of the function.** If the denominator is also zero there, the function is undefined, so it cannot be 0.
- **Including a denominator zero in an inequality solution** because the sign is ≥ or ≤. The expression does not exist there.
- **Multiplying both sides of an inequality by an expression in x.** Its sign changes across the number line; subtract and combine into one fraction instead.
- **Assuming both sides of an asymptote go opposite ways.** With an even power in the denominator they go the same way.

## Where this goes next

Week 7 rewrites rational functions by polynomial division: r(x) = quotient + remainder/divisor. The quotient gives the slant asymptote, and the remainder term is the part that blows up at the vertical asymptote. Week 8 transforms functions, including moving a vertical asymptote and a hole by a horizontal translation. Unit 2 uses one-sided limits again for exponential and logarithmic graphs.

## Self-check

1. List the zeros, vertical asymptotes and holes of (x² + x − 2)/(x² − 3x + 2).
2. For f(x) = (3 − x)/(x + 2)², describe the behaviour on both sides of x = −2 using limit notation.
3. Solve (x² − 1)/(x − 3) ≤ 0 and explain why one endpoint is open.
4. Write a rational function with a zero at 4, a vertical asymptote at x = −1 and a hole at (2, 1).
5. Explain why (x − 1)²/(x − 1) has a hole while (x − 1)/(x − 1)² has a vertical asymptote.

---

*Original study material for this course, organised around the College Board AP Precalculus Course and Exam Description (Unit 1, Topics 1.8–1.10). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). AP® is a trademark of the College Board, which does not endorse this material.*
