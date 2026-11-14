# Week 05 · Factors, Zeros and the Shape of a Graph

**Lessons:** 2.5 Connecting Factors and Zeros · 2.6 Different Forms · 2.7 Using Factors and Zeros · 2.8 End Behavior (Part 1)
**Practices:** MP7 (look for structure), MP3 (construct arguments), MP5 (use tools strategically)
**Built from:** IM Algebra 2, Unit 2, Lessons 5–8, in our own words
**Spiral:** Week 4's factored and standard forms are the two languages this week translates between. From Algebra 1: factoring quadratics, the zero product property, and the shape of a parabola.

## What you need to be able to do

- **2.5** Explain why a factor (x − a) of a polynomial produces a zero at x = a and an x-intercept at (a, 0), and go the other way: from a zero to a factor.
- **2.6** Convert between factored form and standard form, and know what each form reveals immediately (zeros versus degree, leading coefficient and constant term).
- **2.7** Sketch the graph of a polynomial from its factored form (intercepts, sign of the function between zeros, vertical intercept) and write a possible equation from a graph or a list of zeros.
- **2.8** Describe the end behaviour of a polynomial with a positive leading coefficient: for even degree both ends go up, for odd degree the left end goes down and the right end goes up, and explain why the leading term controls this.

## Key terms

| Term | Meaning |
|---|---|
| Zero of a polynomial | An input a with p(a) = 0; the graph has an x-intercept at (a, 0). |
| Factor | A polynomial that divides p(x) exactly; (x − a) is a factor exactly when a is a zero. |
| Factored form | p(x) written as a product of factors, such as 2(x − 1)(x + 3)(x − 4). |
| Standard form | Terms in decreasing degree, such as 2x³ − 4x² − 22x + 24. |
| Vertical intercept | The point (0, p(0)); p(0) is the constant term in standard form, or the product of the constants in factored form. |
| End behaviour | What the outputs do as x grows very large positive (x → ∞) or very large negative (x → −∞). |
| Zero product property | If a product is 0, at least one factor is 0. |

## Factors and zeros (2.5)

If p(x) = (x − 2)(x + 5)(x − 7), then p(2) = 0 · 7 · (−5) = 0. Each factor kills the product at one input: x − 2 is zero at x = 2, x + 5 at x = −5, x − 7 at x = 7. So the zeros of p are 2, −5 and 7, and the graph of p crosses the x-axis at (2, 0), (−5, 0) and (7, 0).

The connection works both ways:

- Factor (x − a) ⟹ zero at a.
- Zero at a ⟹ factor (x − a). (This direction is proved by the Remainder Theorem in week 7; for now, take it as the pattern.)

Watch the sign: the factor (x + 5) corresponds to the zero −5, because x + 5 = x − (−5).

A factor like (2x − 3) gives the zero x = 3/2, where 2x − 3 = 0. A factor x by itself gives the zero 0.

**Worked example.** Find the zeros of q(x) = x(3x + 4)(x − 1)² and the x-intercepts of its graph.

x = 0, 3x + 4 = 0 → x = −4/3, and x − 1 = 0 → x = 1. Zeros 0, −4/3, 1; intercepts (0, 0), (−4/3, 0), (1, 0). The squared factor still gives only one zero (it matters for the shape, as week 6 shows).

**Worked example.** Write a polynomial with zeros 3, −2 and 0.

(x − 3)(x + 2)x works, and so does any nonzero multiple of it, such as 5x(x − 3)(x + 2).

**Try it.**
1. Zeros of (x + 6)(2x − 1)(x − 6)?
2. Write a cubic polynomial with zeros 1, 1/2 and −4.

*Answers:* 1. −6, 1/2, 6. 2. (x − 1)(2x − 1)(x + 4), or (x − 1)(x − 1/2)(x + 4).

## Two forms, two kinds of information (2.6)

| | Factored form: 2(x − 1)(x + 3)(x − 4) | Standard form: 2x³ − 4x² − 22x + 24 |
|---|---|---|
| Zeros | read off: 1, −3, 4 | hidden |
| Degree | count the linear factors: 3 | highest exponent: 3 |
| Leading coefficient | multiply the x coefficients and the constant in front: 2 · 1 · 1 · 1 = 2 | coefficient of x³: 2 |
| Vertical intercept | multiply the constants: 2 · (−1) · 3 · (−4) = 24 | constant term: 24 |
| End behaviour | from degree and leading coefficient | from the leading term |

Converting factored → standard is multiplication (week 4). Converting standard → factored is harder in general; for now you factor by recognising a common factor, a quadratic pattern, or a known zero.

**Worked example.** Write f(x) = x³ − 9x in factored form and give its zeros.

x is a common factor: x(x² − 9) = x(x − 3)(x + 3). Zeros 0, 3, −3.

**Worked example.** Expand g(x) = −(x + 2)(x − 5)² to standard form and state its vertical intercept.

(x − 5)² = x² − 10x + 25. (x + 2)(x² − 10x + 25) = x³ − 10x² + 25x + 2x² − 20x + 50 = x³ − 8x² + 5x + 50. With the minus sign: g(x) = −x³ + 8x² − 5x − 50. Vertical intercept (0, −50), which also equals −(2)(−5)² = −50 from the factored form.

**Try it.**
1. Factor h(x) = 2x³ − 8x² + 8x fully.
2. From the factored form (x − 2)(x + 2)(x − 9), give the vertical intercept without expanding.

*Answers:* 1. 2x(x² − 4x + 4) = 2x(x − 2)². 2. (−2)(2)(−9) = 36, so (0, 36).

## Sketching from factored form (2.7)

To sketch p(x) = (x + 2)(x − 1)(x − 3):

1. **Mark the zeros** on the x-axis: −2, 1, 3.
2. **Find the vertical intercept**: p(0) = (2)(−1)(−3) = 6, so (0, 6).
3. **Decide the sign on each interval.** Test a point in each region.

| Interval | Test x | (x + 2) | (x − 1) | (x − 3) | Sign of p |
|---|---|---|---|---|---|
| x < −2 | −3 | − | − | − | negative |
| −2 < x < 1 | 0 | + | − | − | positive |
| 1 < x < 3 | 2 | + | + | − | negative |
| x > 3 | 4 | + | + | + | positive |

4. **Draw a smooth curve** through the intercepts with those signs: up from below on the left, crossing at −2, over a hill through (0, 6), crossing down at 1, dipping, crossing up at 3, and rising on the right.

The sketch does not show exactly how high the hill or how low the dip is; that needs technology. It does show intercepts, sign and general shape, which is often all a question wants.

**Writing an equation from a graph.** If a graph crosses the x-axis at −4, 0 and 2 and passes through (1, −10): start with p(x) = k · x(x + 4)(x − 2) and use the extra point to find k. p(1) = k · 1 · 5 · (−1) = −5k = −10, so k = 2 and p(x) = 2x(x + 4)(x − 2).

**Worked example.** A cubic has zeros −1, 2 and 5 and vertical intercept (0, −20). Find its equation.

p(x) = k(x + 1)(x − 2)(x − 5). p(0) = k(1)(−2)(−5) = 10k = −20, so k = −2. p(x) = −2(x + 1)(x − 2)(x − 5).

**Try it.**
1. For p(x) = (x − 4)(x + 1)(x + 5), state the zeros, the vertical intercept and the sign of p for x between −1 and 4.
2. A polynomial has zeros −3 and 1 only, degree 2, and passes through (2, 15). Find it.

*Answers:* 1. Zeros 4, −1, −5; p(0) = (−4)(1)(5) = −20; between −1 and 4 (test x = 0) p is negative. 2. k(x + 3)(x − 1) with k · 5 · 1 = 15, so k = 3: 3(x + 3)(x − 1).

## End behaviour, part 1 (2.8)

Far from the origin, a polynomial behaves like its **leading term**. Compare p(x) = x³ − 20x² + 5 with x³:

| x | x³ | −20x² | p(x) |
|---|---|---|---|
| 10 | 1,000 | −2,000 | −995 |
| 100 | 1,000,000 | −200,000 | 800,005 |
| 1,000 | 1,000,000,000 | −20,000,000 | 980,000,005 |

At x = 10 the quadratic term still dominates, but by x = 1,000 the cube term is 50 times larger than everything else, and the ratio keeps growing. So for very large |x|, p(x) ≈ x³.

With a **positive leading coefficient**:

- **Even degree** (x², x⁴, …): both ends go up. As x → −∞, p(x) → ∞; as x → ∞, p(x) → ∞. An even power of a negative number is positive.
- **Odd degree** (x, x³, x⁵, …): left end down, right end up. As x → −∞, p(x) → −∞; as x → ∞, p(x) → ∞. An odd power of a negative number is negative.

The middle of the graph can have any number of hills and dips (at most degree − 1 turning points), but the ends are fixed by the leading term. This is why the sketch of (x + 2)(x − 1)(x − 3) (degree 3, leading coefficient 1) had to come up from the bottom left and leave at the top right.

**Worked example.** Describe the end behaviour of f(x) = 3x⁴ − 100x³ + x and of g(x) = (x − 1)(x + 2)(x − 7)(x + 9)(x − 3).

f has leading term 3x⁴: even degree, positive coefficient, so both ends go up. g has five linear factors with leading term x⁵: odd degree, positive coefficient, so as x → −∞, g(x) → −∞ and as x → ∞, g(x) → ∞.

**Try it.**
1. Which of x², x³, x⁴ dominate 2x⁴ + 7x³ − 50x² for large x?
2. State the end behaviour of p(x) = x(x + 1)(x + 2)(x + 3).

*Answers:* 1. 2x⁴. 2. Degree 4, leading coefficient 1: both ends go up.

## Common mistakes

- **Sign of the zero.** (x + 5) gives the zero −5, not 5.
- **Reading the vertical intercept off a factored form by looking at one factor.** Multiply all the constants: for 2(x − 1)(x + 3)(x − 4) it is 2 · (−1) · 3 · (−4) = 24.
- **Forgetting the scale factor k** when writing an equation from a graph. Zeros alone determine the polynomial only up to a multiple.
- **Letting the middle terms decide end behaviour.** −20x² looks huge at x = 10, but x³ wins in the end.
- **Assuming a factor and a zero are the same number.** The factor is (x − a); the zero is a.

## Where this goes next

Week 6 completes end behaviour with negative leading coefficients, explains what repeated factors do to the graph (multiplicity: bounce or flatten), and uses graphs to find where two polynomials intersect. Week 7 shows how to test whether (x − a) is a factor by dividing, and proves the factor–zero connection with the Remainder Theorem.

## Self-check

1. Give the zeros of −3(x − 2)(x + 7)(2x + 1) and its vertical intercept.
2. Factor x³ + 4x² − 21x and sketch its graph, labelling intercepts.
3. Find a cubic with zeros −2, 1 and 3 that passes through (0, 12).
4. Explain, with a numerical example, why the leading term controls end behaviour.
5. State the end behaviour of (x + 4)(x − 4)(x² + 1) and of x(x − 2)(x + 2).

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Algebra 2, Unit 2, Lessons 5–8, https://im.kendallhunt.com/HS/teachers/3/2/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
