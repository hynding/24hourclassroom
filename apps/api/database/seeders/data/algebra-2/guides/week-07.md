# Week 07 · Polynomial Division and the Remainder Theorem

**Lessons:** 2.12 Polynomial Division (Part 1) · 2.13 Polynomial Division (Part 2) · 2.14 What Do You Know About Polynomials? · 2.15 The Remainder Theorem
**Practices:** MP7 (look for structure), MP8 (regularity in repeated reasoning), MP3 (construct arguments)
**Built from:** IM Algebra 2, Unit 2, Lessons 12–15, in our own words
**Spiral:** Multiplying polynomials with a grid (week 4) is run backwards here. The factor–zero connection from week 5 finally gets its proof. Long division of whole numbers from earlier years is the model for long division of polynomials.

## What you need to be able to do

- **2.12** Divide a polynomial by a linear factor (x − a) by reversing the multiplication grid, and use the result to factor a polynomial when one zero is known.
- **2.13** Carry out polynomial long division, including divisions that leave a remainder, and write the result as dividend = divisor × quotient + remainder.
- **2.14** Pull together everything known about a polynomial (degree, zeros and multiplicities, end behaviour, intercepts, factors) to decide whether a claim about it is true, and to find a polynomial from partial information.
- **2.15** State and use the Remainder Theorem: dividing p(x) by (x − a) leaves remainder p(a); therefore (x − a) is a factor exactly when p(a) = 0.

## Key terms

| Term | Meaning |
|---|---|
| Dividend, divisor, quotient, remainder | In p(x) = d(x) · q(x) + r(x): p is the dividend, d the divisor, q the quotient, r the remainder. |
| Division with a grid | Filling a multiplication grid from the known product backwards to find the missing factor. |
| Long division | The column algorithm: divide leading terms, multiply, subtract, bring down, repeat. |
| Remainder Theorem | The remainder on dividing p(x) by (x − a) is the number p(a). |
| Factor Theorem | (x − a) is a factor of p(x) if and only if p(a) = 0. |
| Degree of the remainder | Always less than the degree of the divisor; for a linear divisor the remainder is a constant. |

## Division by reversing the grid (2.12)

In week 4 you multiplied (x − 3)(x² + 5x + 2) with a grid. Division asks the opposite question: p(x) = x³ + 2x² − 13x − 6 has a zero at x = 3 (check: 27 + 18 − 39 − 6 = 0), so (x − 3) is a factor. What is the other factor?

Set up a grid with (x − 3) down the side and the unknown quotient across the top. Fill in what you know and work left to right:

```
         x²     +5x     +2
     +------+-------+------+
  x  |  x³  |  5x²  |  2x  |
 −3  | −3x² | −15x  |  −6  |
     +------+-------+------+
```

- The top-left cell must be x³ (the leading term), and x · (?) = x³ gives x² as the first quotient term. Then −3 · x² = −3x².
- The x² terms must total 2x². We already have −3x², so the next cell needs +5x², and x · (?) = 5x² gives 5x. Then −3 · 5x = −15x.
- The x terms must total −13x. We have −15x, so we need +2x, giving a quotient term of 2. Then −3 · 2 = −6, which matches the constant. No remainder.

So x³ + 2x² − 13x − 6 = (x − 3)(x² + 5x + 2). The quadratic does not factor over the integers (discriminant 25 − 8 = 17), so the other zeros are (−5 ± √17)/2 by the quadratic formula.

**Worked example.** Given that x = −2 is a zero of p(x) = 2x³ + 3x² − 8x − 12, factor p completely.

Divide by (x + 2) with a grid: quotient 2x² − x − 6. Check: (x + 2)(2x² − x − 6) = 2x³ − x² − 6x + 4x² − 2x − 12 = 2x³ + 3x² − 8x − 12. Then 2x² − x − 6 = (2x + 3)(x − 2). So p(x) = (x + 2)(2x + 3)(x − 2), zeros −2, −3/2, 2.

**Try it.**
1. Divide x³ − 7x + 6 by (x − 1) using a grid (note the missing x² term: treat it as 0x²).
2. Factor the result completely.

*Answers:* 1. x² + x − 6. 2. (x − 1)(x + 3)(x − 2).

## Long division (2.13)

Long division handles any divisor and any remainder. Divide 2x³ − 5x² + x + 7 by (x − 2):

```
            2x²  −  x  −  1
        ______________________
 x − 2 ) 2x³ − 5x² +  x + 7
         2x³ − 4x²              ← 2x² · (x − 2)
         ----------
              −x² +  x          ← subtract, bring down
              −x² + 2x          ← −x · (x − 2)
              ---------
                   −x + 7
                   −x + 2       ← −1 · (x − 2)
                   -------
                        5       ← remainder
```

Result: 2x³ − 5x² + x + 7 = (x − 2)(2x² − x − 1) + 5. Equivalently, (2x³ − 5x² + x + 7)/(x − 2) = 2x² − x − 1 + 5/(x − 2).

The steps repeat: divide the leading terms, multiply the divisor by that term, subtract, bring down the next term. Stop when what is left has smaller degree than the divisor. Always write missing powers as 0 terms so the columns line up.

**Worked example.** Divide x⁴ − 3x² + 2x − 4 by (x² + 1).

Write the dividend as x⁴ + 0x³ − 3x² + 2x − 4. x⁴ ÷ x² = x²; subtract x²(x² + 1) = x⁴ + x² to leave −4x² + 2x − 4. Then −4x² ÷ x² = −4; subtract −4(x² + 1) = −4x² − 4 to leave 2x. Degree 1 is less than degree 2, so stop: quotient x² − 4, remainder 2x. Check: (x² + 1)(x² − 4) + 2x = x⁴ − 3x² − 4 + 2x.

**Try it.**
1. Divide x³ + 4x² − 2x − 3 by (x + 1) and write the result as divisor × quotient + remainder.
2. Divide 3x² − 11x + 5 by (x − 3).

*Answers:* 1. (x + 1)(x² + 3x − 5) + 2. 2. Quotient 3x − 2, remainder −1.

## Putting it together (2.14)

A polynomial carries a lot of information, and the week's middle lesson is about using all of it at once. For a claim such as "p(x) = x³ − x² − 14x + 24 has a factor of (x − 4)", you now have three ways to check:

1. Divide by (x − 4) and look for remainder 0.
2. Evaluate p(4) = 64 − 16 − 56 + 24 = 16. Not zero, so (x − 4) is **not** a factor.
3. Graph p and see whether it crosses at 4 (it does not; it crosses at 2, 3 and −4).

Other quick checks:

- A degree-3 polynomial cannot have 4 zeros, so a claim of zeros 1, 2, 3, 4 for a cubic is false.
- If a graph has 3 turning points, the degree is at least 4.
- If p(0) = 24, the constant term is 24, and in factored form the product of the constants is 24.
- Odd degree always has at least one real zero (the ends go opposite ways, so the graph must cross).

**Worked example.** Find a cubic polynomial with integer coefficients that has zeros 2 and −1 and leaves remainder 6 when divided by (x − 1).

Zeros give factors: p(x) = (x − 2)(x + 1)(x − c) for some c, times a constant k. Remainder 6 at x = 1 means p(1) = 6: k(−1)(2)(1 − c) = 6, so k(1 − c) = −3. One choice: k = 1, c = 4, giving p(x) = (x − 2)(x + 1)(x − 4). Another: k = 3, c = 2. There is more than one answer; state the one you choose and check it.

## The Remainder Theorem (2.15)

Divide any polynomial p(x) by (x − a). The remainder has degree less than 1, so it is a constant r:

p(x) = (x − a) · q(x) + r.

Substitute x = a: p(a) = 0 · q(a) + r = r. So **the remainder is p(a)**. That is the Remainder Theorem, and it explains the pattern from week 5:

- If p(a) = 0, the remainder is 0 and p(x) = (x − a) · q(x), so (x − a) is a factor.
- If (x − a) is a factor, then p(a) = (a − a) · q(a) = 0.

In other words, zeros and linear factors are the same information, in both directions (the Factor Theorem).

**Using it as a shortcut.** To find the remainder when x⁵ − 3x² + 1 is divided by (x + 1), do not divide: evaluate p(−1) = −1 − 3 + 1 = −3. The remainder is −3.

**Using it to test factors.** Is (x − 5) a factor of x³ − 4x² − 7x + 10? p(5) = 125 − 100 − 35 + 10 = 0. Yes. Is (x + 1)? p(−1) = −1 − 4 + 7 + 10 = 12. No.

**Using it to find a coefficient.** For what value of k does x³ + kx − 10 have (x − 2) as a factor? p(2) = 8 + 2k − 10 = 0 gives k = 1.

**Worked example.** Find all zeros of p(x) = x³ − 6x² + 11x − 6.

Candidates for integer zeros divide the constant term 6: ±1, ±2, ±3, ±6. p(1) = 1 − 6 + 11 − 6 = 0, so (x − 1) is a factor. Dividing gives x² − 5x + 6 = (x − 2)(x − 3). Zeros 1, 2, 3.

**Try it.**
1. Find the remainder when 2x⁴ − x + 3 is divided by (x − 1).
2. Is (x + 3) a factor of x³ + 2x² − 5x − 6?
3. Find k so that (x + 1) is a factor of x³ − 2x² + kx + 4.

*Answers:* 1. p(1) = 2 − 1 + 3 = 4. 2. p(−3) = −27 + 18 + 15 − 6 = 0, yes. 3. p(−1) = −1 − 2 − k + 4 = 1 − k = 0, so k = 1.

## Common mistakes

- **Forgetting zero terms.** Dividing x³ − 7x + 6 without a 0x² placeholder misaligns the columns.
- **Subtracting only the first term** in long division. Subtract the whole row, changing every sign.
- **Evaluating p(−a) for divisor (x − a).** For divisor (x + 3), evaluate p(−3); for (x − 3), evaluate p(3).
- **Stopping too early or too late.** Stop when the degree of what is left is below the degree of the divisor.
- **Claiming a factor from a graph alone.** A graph suggests a zero; p(a) = 0 confirms it.

## Where this goes next

Division is the engine of week 8: a rational function's end behaviour is found by dividing numerator by denominator and keeping the quotient. The Remainder Theorem also underlies polynomial identities in week 10, where (x − 1) divides xⁿ − 1 for every n.

## Self-check

1. Use a grid to divide x³ − 2x² − 5x + 6 by (x − 1), then factor completely.
2. Use long division to write 3x³ + 2x² − x + 4 as (x + 2) × quotient + remainder.
3. Without dividing, find the remainder when x⁶ − 2x³ + x − 5 is divided by (x − 1), and when it is divided by (x + 1).
4. Explain, using p(x) = (x − a) q(x) + r, why p(a) is the remainder.
5. A quartic has zeros 0, 1, −1 and leaves remainder 12 when divided by (x − 2). Find it, assuming the leading coefficient is an integer and the fourth zero is an integer.

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Algebra 2, Unit 2, Lessons 12–15, https://im.kendallhunt.com/HS/teachers/3/2/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
