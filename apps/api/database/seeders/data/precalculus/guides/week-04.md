# Week 04 · Polynomial Functions and Complex Zeros

**Topics:** 1.5 Polynomial Functions and Complex Zeros
**Practices:** 1 (procedural and symbolic fluency), 2 (multiple representations), 3 (communication and reasoning)
**Framework:** AP Precalculus CED, Unit 1, Topic 1.5, learning objectives in our own words
**Spiral:** Week 3's polynomial vocabulary (degree, leading coefficient, turning points) and week 1's sign-change reasoning about zeros. From Algebra 2: factoring, the zero product property, the quadratic formula, and the complex numbers a + bi with i² = −1.

## What you need to be able to do

- **1.5** Find the real and non-real zeros of a polynomial in factored form, or one that can be factored by grouping, a known pattern or the quadratic formula.
- **1.5** Tell the difference between a real zero (which gives an x-intercept) and a non-real zero (which does not appear on the graph).
- **1.5** State the multiplicity of each zero and use it to predict the graph's behaviour there: odd multiplicity crosses the x-axis, even multiplicity touches and turns back.
- **1.5** Apply the Fundamental Theorem of Algebra: a polynomial of degree n ≥ 1 has exactly n complex zeros, counted with multiplicity.
- **1.5** Use the conjugate-pair property: if a polynomial with real coefficients has a zero a + bi (b ≠ 0), then a − bi is also a zero.
- **1.5** Write a polynomial from its zeros (and one extra point to fix the leading coefficient), including zeros that are non-real.
- **1.5** Solve polynomial inequalities such as p(x) ≥ 0 using the zeros and a sign chart.

## Key terms

| Term | Meaning |
|---|---|
| Zero (root) | An input a with p(a) = 0. It may be real or non-real. |
| x-intercept | A point (a, 0) where the graph meets the x-axis; only real zeros give x-intercepts. |
| Complex number | A number a + bi with a, b real and i² = −1. Real numbers are the complex numbers with b = 0. |
| Non-real zero | A zero a + bi with b ≠ 0. |
| Multiplicity | The number of times a factor (x − a) appears in the complete factorisation. |
| Complex conjugate | The conjugate of a + bi is a − bi. |
| Fundamental Theorem of Algebra | Every polynomial of degree n ≥ 1 has exactly n complex zeros, counted with multiplicity. |
| Sign chart | A number line marked with the zeros, showing whether p is positive or negative on each interval. |

## Zeros, factors and x-intercepts (1.5)

For a polynomial p, the following say the same thing about a **real** number a:

- a is a zero of p: p(a) = 0.
- (x − a) is a factor of p(x).
- (a, 0) is an x-intercept of the graph of p.

The first two statements also make sense for **non-real** zeros, but the third does not: the graph lives in the real plane, so a non-real zero produces no intercept. That is why a graph can show fewer x-intercepts than the degree suggests.

**Worked example.** Find all zeros of p(x) = x³ − 2x² + 4x − 8.

Group: x²(x − 2) + 4(x − 2) = (x − 2)(x² + 4). From x − 2 = 0, x = 2. From x² + 4 = 0, x² = −4, so x = ±√(−4) = ±2i. The zeros are 2, 2i and −2i. Only 2 is real, so the graph has one x-intercept, (2, 0).

**Worked example.** Find all zeros of q(x) = x² − 4x + 13.

The quadratic formula gives x = (4 ± √(16 − 52))/2 = (4 ± √(−36))/2 = (4 ± 6i)/2 = 2 ± 3i. No real zeros, so the parabola never meets the x-axis (it lies entirely above it, since its leading coefficient is positive).

## Multiplicity and the shape at an intercept (1.5)

If (x − a) appears exactly m times in the factorisation of p, the zero a has **multiplicity m**. The multiplicity of a real zero controls what the graph does near (a, 0):

| Multiplicity | Near x = a the graph looks like… | Sign of p |
|---|---|---|
| 1 | a line through the axis: it crosses | changes |
| 2 (or any even number) | a parabola touching the axis: it bounces back | does not change |
| 3 (or odd ≥ 3) | a cubic: it flattens and crosses | changes |

The reason is the sign: (x − a)ᵐ changes sign at a when m is odd and stays non-negative when m is even.

**Worked example.** Describe the graph of p(x) = (x + 2)(x − 1)²(x − 4) at its intercepts, and state its end behaviour.

- x = −2, multiplicity 1: crosses.
- x = 1, multiplicity 2: touches and turns back.
- x = 4, multiplicity 1: crosses.

The degree is 1 + 2 + 1 = 4 and the leading coefficient is 1, so both ends go up. Vertical intercept: p(0) = 2 · 1 · (−4) = −8. Putting it together: down from the upper left, cross at −2, dip below the axis through (0, −8), rise to touch at (1, 0), dip again, cross up at 4 and rise.

**Try it.**
1. State each zero and its multiplicity for f(x) = x³(x + 5)²(2x − 1).
2. At which zeros of f does the graph cross the x-axis?

*Answers:* 1. 0 (multiplicity 3), −5 (multiplicity 2), 1/2 (multiplicity 1). 2. At 0 and 1/2 (odd multiplicity); it bounces at −5.

## The Fundamental Theorem of Algebra (1.5)

**Every polynomial of degree n ≥ 1 has exactly n complex zeros, counted with multiplicity.** Equivalently, it factors completely into n linear factors (x − r) over the complex numbers, times its leading coefficient.

Consequences you will use:

- A degree-n polynomial has **at most n real zeros** and at most n x-intercepts.
- Counting with multiplicity matters: (x − 1)²(x² + 4) has degree 4 and zeros 1, 1, 2i, −2i.
- The number of real zeros and the number of non-real zeros always add to n.

### Conjugate pairs

If a polynomial has **real coefficients** and a + bi (with b ≠ 0) is a zero, then a − bi is also a zero. Non-real zeros arrive in pairs, and each pair multiplies to a quadratic with real coefficients:

  (x − (a + bi))(x − (a − bi)) = (x − a)² + b² = x² − 2ax + (a² + b²).

For 2 ± 3i: x² − 4x + 13. For ±2i: x² + 4.

Because non-real zeros come in pairs, a real-coefficient polynomial has an *even* number of non-real zeros. So:

- A polynomial of **odd degree** with real coefficients has **at least one real zero** (its graph must cross the axis, as its ends go in opposite directions).
- A degree-6 polynomial with exactly 2 real zeros (each of multiplicity 1) has 4 non-real zeros.

**Worked example.** A polynomial p with real coefficients has degree 4, and two of its zeros are 3 and 2i. What can you say about the other zeros?

By conjugate pairs, −2i is also a zero. That accounts for three of the four zeros. The fourth cannot be non-real (it would need its own conjugate, making five), so it is real. It might be 3 again, or some other real number.

**Try it.**
1. A degree-5 polynomial with real coefficients has zeros 1 − i and 4i. List all its zeros as far as you can.
2. Expand (x − (1 + 2i))(x − (1 − 2i)).

*Answers:* 1. 1 − i, 1 + i, 4i, −4i, and one more zero that must be real. 2. (x − 1)² + 4 = x² − 2x + 5.

## Building a polynomial from its zeros (1.5)

Zeros determine the factors; one more piece of information fixes the leading coefficient.

**Worked example.** Find the polynomial of least degree with real coefficients that has zeros 3 and 1 + 2i and leading coefficient 1.

Real coefficients force the conjugate 1 − 2i, so the least degree is 3. The pair gives x² − 2x + 5. So p(x) = (x − 3)(x² − 2x + 5) = x³ − 5x² + 11x − 15.

**Worked example.** A polynomial has a zero of multiplicity 2 at x = −1, a zero of multiplicity 1 at x = 3, no other zeros, and passes through (1, −16). Find it.

p(x) = k(x + 1)²(x − 3). Then p(1) = k · 4 · (−2) = −8k = −16, so k = 2: p(x) = 2(x + 1)²(x − 3).

## Polynomial inequalities and sign charts (1.5)

To solve p(x) > 0, p(x) ≥ 0, p(x) < 0 or p(x) ≤ 0:

1. Move everything to one side and factor completely.
2. Mark the real zeros on a number line; they split it into intervals.
3. Find the sign of p on each interval: test one value, or use multiplicities (the sign flips at odd multiplicity and stays at even multiplicity) together with end behaviour.
4. Read off the intervals that satisfy the inequality. Include the zeros for ≥ or ≤; exclude them for > or <.

**Worked example.** Solve x³ − x² − 6x ≥ 0.

Factor: x(x² − x − 6) = x(x − 3)(x + 2). Zeros −2, 0, 3, each of multiplicity 1.

| Interval | x < −2 | −2 < x < 0 | 0 < x < 3 | x > 3 |
|---|---|---|---|---|
| Test value | −3 | −1 | 1 | 4 |
| Sign of x(x − 3)(x + 2) | (−)(−)(−) = − | (−)(−)(+) = + | (+)(−)(+) = − | (+)(+)(+) = + |

So x³ − x² − 6x ≥ 0 on [−2, 0] ∪ [3, ∞).

**Worked example.** Solve (x − 1)²(x² + 4) > 0.

x² + 4 is always positive, and (x − 1)² is positive except at x = 1, where it is 0. So the product is positive for every x except 1: the solution is all real x with x ≠ 1.

**Try it.**
1. Solve (x + 3)(x − 2)² < 0.
2. Solve 2(x + 1)²(x − 3) ≤ 0.

*Answers:* 1. x < −3 (at x = 2 the expression is 0, not negative). 2. x ≤ 3.

## Calculator notes

A graphing calculator's zero feature finds real zeros only, to several decimal places; it cannot show non-real zeros. If a degree-4 polynomial shows only two x-intercepts, the other two zeros are either non-real or repeated. On the AP exam, non-calculator questions about complex zeros use polynomials you can factor by hand or by the quadratic formula.

## Common mistakes

- **Losing the non-real zeros.** x² + 4 = 0 has solutions ±2i, not "no solution". There are no *real* solutions.
- **Writing ±2 instead of ±2i.** x² = −4 gives x = ±2i.
- **Forgetting the conjugate.** If 1 + 2i is a zero of a real-coefficient polynomial, so is 1 − 2i, and the least degree goes up accordingly.
- **Mixing up crossing and bouncing.** Even multiplicity bounces; odd multiplicity crosses.
- **Including or excluding zeros wrongly** in an inequality. A strict inequality (>, <) excludes zeros; a non-strict one (≥, ≤) includes them.
- **Forgetting the leading coefficient k** when a polynomial must pass through a given point.

## Where this goes next

Week 5 makes the end behaviour of polynomials precise with limit notation and extends it to rational functions. Week 6 adds zeros and vertical asymptotes of rational functions, solved with the same sign-chart method. Week 7 shows how to divide polynomials, so you can find the remaining zeros once one is known. Complex numbers return in Unit 3 in polar form.

## Self-check

1. Find all zeros of x⁴ − 16 and say which give x-intercepts.
2. Explain why a cubic with real coefficients cannot have three non-real zeros.
3. Write a polynomial of least degree with real coefficients that has zeros −2 (multiplicity 2) and 3i.
4. Describe the graph of (x − 2)³(x + 1)² near each of its x-intercepts.
5. Solve x³ − 4x < 0 with a sign chart.

---

*Original study material for this course, organised around the College Board AP Precalculus Course and Exam Description (Unit 1, Topic 1.5). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). AP® is a trademark of the College Board, which does not endorse this material.*
