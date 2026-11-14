# Week 08 · Rational Functions and Their Graphs

**Lessons:** 2.16 Minimizing Surface Area · 2.17 Graphs of Rational Functions (Part 1) · 2.18 Graphs of Rational Functions (Part 2) · 2.19 End Behavior of Rational Functions
**Practices:** MP4 (model with mathematics), MP7 (look for structure), MP5 (use tools strategically)
**Built from:** IM Algebra 2, Unit 2, Lessons 16–19, in our own words
**Spiral:** Polynomial division from week 7 becomes the tool for end behaviour. Zeros of the numerator (week 5) give intercepts; zeros of the denominator give asymptotes. The surface-area model echoes the box model from week 4.

## What you need to be able to do

- **2.16** Build a rational function from a situation (the surface area of a can with a fixed volume, an average cost), evaluate it, and use a graph to find the input that minimises it.
- **2.17** Explain why a rational function has a vertical asymptote where its denominator is zero (and numerator is not), find vertical asymptotes and x-intercepts from the factored form, and describe how the graph behaves on either side of an asymptote.
- **2.18** Find horizontal asymptotes by comparing degrees of numerator and denominator, and describe the end behaviour of a rational function in words and with arrow notation.
- **2.19** Rewrite a rational function as quotient + remainder/divisor using division, read the end behaviour from the quotient (constant, linear or higher polynomial), and sketch graphs with slant asymptotes.

## Key terms

| Term | Meaning |
|---|---|
| Rational function | A function of the form p(x)/q(x) where p and q are polynomials and q is not the zero polynomial. |
| Vertical asymptote | A vertical line x = a that the graph approaches but never touches, where the denominator is 0 and the numerator is not. |
| Horizontal asymptote | A horizontal line y = c that the graph approaches as x → ∞ or x → −∞. |
| Slant (oblique) asymptote | A line y = mx + b that the graph approaches at the ends, when the numerator's degree is one more than the denominator's. |
| Hole | A single missing point, where a factor cancels from numerator and denominator. |
| Domain of a rational function | All real numbers except the zeros of the denominator. |

## A rational function from a can (2.16)

A cylindrical can must hold 500 cm³. Its surface area (two circular ends plus the curved side) is S = 2πr² + 2πrh. The volume condition πr²h = 500 gives h = 500/(πr²), so

S(r) = 2πr² + 2πr · 500/(πr²) = 2πr² + 1000/r.

This is a **rational function**: a polynomial divided by a polynomial (write it as (2πr³ + 1000)/r). It is not a polynomial because of the 1/r.

A table shows what happens:

| r (cm) | 2 | 3 | 4 | 4.3 | 5 | 6 | 8 |
|---|---|---|---|---|---|---|---|
| S(r) (cm²) | 525.1 | 389.9 | 350.5 | 348.7 | 357.1 | 392.9 | 527.1 |

Small r makes the can tall and thin (the 1000/r term is huge); large r makes it wide and flat (the 2πr² term is huge). The minimum, about 348.7 cm² at r ≈ 4.3 cm, is found by graphing. As r → 0 the area blows up; as r → ∞ it also blows up, but like 2πr².

**Worked example.** A company's cost to make x items is C(x) = 2000 + 15x dollars. Write the average cost per item, A(x), and describe what happens as x grows.

A(x) = C(x)/x = (2000 + 15x)/x = 2000/x + 15. For large x the 2000/x term fades and the average cost approaches $15 per item: the graph has a horizontal asymptote at y = 15. At x = 100 the average is $35; at x = 1000 it is $17.

**Try it.**
1. For the can, find S(1) and explain in words why it is so large.
2. A box with a square base of side x must have volume 2000 cm³. Write its height as a function of x.

*Answers:* 1. S(1) = 2π + 1000 ≈ 1006.3; a 1 cm radius forces a height of about 159 cm, so the curved side is enormous. 2. h = 2000/x².

## Vertical asymptotes and intercepts (2.17)

Consider f(x) = (x + 2)/(x − 3).

- **Domain:** x ≠ 3, because the denominator is 0 there.
- **x-intercept:** where the numerator is 0 and the denominator is not: x = −2.
- **Vertical intercept:** f(0) = 2/(−3) = −2/3.
- **Near x = 3:** at x = 2.9, f = 4.9/(−0.1) = −49; at x = 2.99, f = −499. At x = 3.1, f = 5.1/0.1 = 51; at 3.01, f = 501. The outputs shoot off to −∞ on the left of 3 and +∞ on the right. The line x = 3 is a **vertical asymptote**.

A denominator zero makes the function divide a nonzero number by something tiny, so outputs become huge. The side (up or down) depends on the signs, so test a point on each side.

**Repeated factors.** For g(x) = 1/(x − 3)², both sides go to +∞, because the square is always positive. An asymptote from an even power has the same direction on both sides; from an odd power, opposite directions.

**Holes.** For h(x) = (x² − 9)/(x − 3) = (x − 3)(x + 3)/(x − 3), the factor cancels and h(x) = x + 3 for every x ≠ 3. The graph is the line y = x + 3 with a single point missing at (3, 6): a hole, not an asymptote. A zero of the denominator gives an asymptote only if it is not also a zero of the numerator (after cancelling).

**Worked example.** Find the domain, intercepts and vertical asymptotes of r(x) = (x − 1)(x + 4) / (x(x − 5)).

Domain: x ≠ 0, 5. x-intercepts: 1 and −4. No vertical intercept (0 is not in the domain). Vertical asymptotes x = 0 and x = 5. Near x = 5 from the right (5.1): (4.1)(9.1)/(5.1 · 0.1) ≈ 73 > 0, so up on the right; from the left (4.9): (3.9)(8.9)/(4.9 · (−0.1)) ≈ −71, down on the left.

**Try it.**
1. Vertical asymptotes and x-intercepts of (2x − 6)/((x + 1)(x − 4))?
2. Does (x + 2)/(x² − 4) have an asymptote or a hole at x = −2?

*Answers:* 1. Asymptotes x = −1, x = 4; intercept x = 3. 2. (x + 2)/((x − 2)(x + 2)) = 1/(x − 2) for x ≠ −2: a hole at x = −2 (and an asymptote at x = 2).

## Horizontal asymptotes (2.18)

What does f(x) = (x + 2)/(x − 3) do for large x? At x = 100, f = 102/97 ≈ 1.05; at x = 1000, f ≈ 1.005; at x = −1000, f ≈ 0.995. The outputs approach 1. Reason: for large |x| the numerator is about x and the denominator about x, so the ratio is about 1. The line y = 1 is a **horizontal asymptote**.

Compare the degrees of the numerator (n) and denominator (d), using only the leading terms:

| Case | Example | Leading-term ratio | Horizontal asymptote |
|---|---|---|---|
| n < d | (3x + 1)/(x² − 4) | 3x/x² = 3/x → 0 | y = 0 |
| n = d | (2x² − 5)/(x² + x) | 2x²/x² = 2 | y = 2 (ratio of leading coefficients) |
| n > d | (x³ + 1)/(x − 2) | x³/x = x² | none; the graph follows a polynomial (next section) |

A graph can cross a horizontal asymptote in the middle; the asymptote describes only the far ends.

**Worked example.** Describe the end behaviour of g(x) = (5x² − 3x)/(2x² + 7) in arrow notation.

Degrees equal, leading coefficients 5 and 2: as x → ∞, g(x) → 5/2, and as x → −∞, g(x) → 5/2. Horizontal asymptote y = 2.5.

**Worked example.** Describe the end behaviour of k(x) = 4/(x + 1) and sketch it.

Degree 0 over degree 1: as x → ±∞, k(x) → 0. Vertical asymptote x = −1 (up on the right, down on the left since 4 is positive). Vertical intercept (0, 4). No x-intercept, because the numerator is never 0. The graph is two curved branches hugging the two asymptotes.

**Try it.**
1. Horizontal asymptote of (6x − 1)/(3x + 8)?
2. Horizontal asymptote of (x + 1)/(x³ − 1)?
3. Does (x² + 1)/(x − 1) have a horizontal asymptote?

*Answers:* 1. y = 2. 2. y = 0. 3. No; the numerator's degree is larger.

## End behaviour by division (2.19)

When the numerator's degree is at least the denominator's, divide:

f(x) = (x² + 1)/(x − 1). Long division gives quotient x + 1 and remainder 2, so

f(x) = x + 1 + 2/(x − 1).

For large |x| the fraction 2/(x − 1) shrinks to 0, so f(x) ≈ x + 1: the graph approaches the **slant asymptote** y = x + 1. It also has a vertical asymptote at x = 1 and a vertical intercept at (0, −1); the numerator x² + 1 is never zero, so there is no x-intercept.

The pattern: **end behaviour of a rational function = the quotient from dividing**.

- Quotient a constant → horizontal asymptote at that constant (the n = d case above: (2x² − 5)/(x² + x) = 2 + (−2x − 5)/(x² + x)).
- Quotient linear → slant asymptote.
- Quotient quadratic or higher → the graph follows that polynomial at the ends.

**Worked example.** Find the end behaviour of m(x) = (2x² + 3x − 5)/(x + 3).

Divide: 2x² + 3x − 5 = (x + 3)(2x − 3) + 4. So m(x) = 2x − 3 + 4/(x + 3), and the slant asymptote is y = 2x − 3. Check at x = 100: m(100) = 20295/103 ≈ 197.04, while 2(100) − 3 = 197.

**Worked example.** Find the end behaviour of n(x) = (x³ − 8)/x.

Divide: n(x) = x² − 8/x. For large |x| the graph follows the parabola y = x². Vertical asymptote x = 0; x-intercept at 2 (where x³ = 8).

**Try it.**
1. Rewrite (3x² − x + 2)/x as quotient + remainder/divisor and give the end behaviour.
2. Rewrite (x² − 4x + 7)/(x − 2) and give the slant asymptote.

*Answers:* 1. 3x − 1 + 2/x; the graph approaches the line y = 3x − 1. 2. x − 2 + 3/(x − 2); slant asymptote y = x − 2.

## Common mistakes

- **Calling every denominator zero an asymptote.** Cancel common factors first; a cancelled factor gives a hole.
- **Reading the horizontal asymptote from constants** instead of leading terms. (x + 2)/(x − 3) approaches 1, not −2/3.
- **Assuming the graph never crosses a horizontal asymptote.** It may cross in the middle; the asymptote governs only the ends.
- **Forgetting the domain** when writing intercepts: a rational function has no vertical intercept if 0 is not in its domain.
- **Dropping the remainder** when dividing. The remainder term is what makes the graph curve away from the asymptote near the vertical asymptote.

## Where this goes next

Week 9 solves equations involving rational expressions, where the domain restrictions found here explain extraneous solutions. The surface-area and average-cost models return in the unit exam. In Unit 4 you will see that exponential functions have horizontal asymptotes too, for a different reason.

## Self-check

1. A can must hold 1000 cm³. Write S(r) and find S(5) to one decimal place.
2. For f(x) = (x − 2)(x + 1)/((x + 3)(x − 4)), give the domain, intercepts, vertical asymptotes and horizontal asymptote.
3. Explain the difference between a hole and a vertical asymptote using (x² − 1)/(x − 1) and 1/(x − 1).
4. Rewrite (x² + 5x + 1)/(x + 2) by division and state its slant asymptote.
5. Describe, in arrow notation, the end behaviour of (7x³ − x)/(x³ + 10).

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Algebra 2, Unit 2, Lessons 16–19, https://im.kendallhunt.com/HS/teachers/3/2/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
