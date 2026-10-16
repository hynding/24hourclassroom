# Week 04 · Introducing Polynomials

**Lessons:** 2.1 Let's Make a Box · 2.2 Funding the Future · 2.3 Introducing Polynomials · 2.4 Combining Polynomials
**Practices:** MP4 (model with mathematics), MP7 (look for structure), MP6 (attend to precision)
**Built from:** IM Algebra 2, Unit 2, Lessons 1–4, in our own words
**Spiral:** Unit 1's habit of checking a formula at a known value carries over. The algebra you need is from Algebra 1: distributing, combining like terms, and multiplying two binomials.

## What you need to be able to do

- **2.1** Build a cubic expression from a physical situation (folding a box from a rectangular sheet), evaluate it, and read maximum values and sensible domains from a table or graph.
- **2.2** See how a sum of deposits at compound interest becomes a polynomial in the growth factor, and evaluate it for a given rate.
- **2.3** Use the vocabulary of polynomials: term, coefficient, degree, leading term and coefficient, constant term, standard form; decide whether an expression is a polynomial.
- **2.4** Add, subtract and multiply polynomials, and explain why the result is always another polynomial (closure); predict the degree of a sum or product.

## Key terms

| Term | Meaning |
|---|---|
| Polynomial | A sum of terms, each a number times a whole-number power of a variable, such as 4x³ − 2x + 7. |
| Term | One piece of the sum: 4x³, −2x and 7 are the terms of 4x³ − 2x + 7. |
| Coefficient | The number multiplying the power of x in a term; the coefficient of x³ above is 4. |
| Degree (of a term) | The exponent on the variable: 4x³ has degree 3, the constant 7 has degree 0. |
| Degree (of a polynomial) | The highest degree among its terms. |
| Leading term and leading coefficient | The term of highest degree and its coefficient: 4x³ and 4. |
| Standard form | Terms written from highest degree to lowest: 4x³ + 0x² − 2x + 7, usually with zero terms omitted. |
| Constant term | The term with no variable; it is the value of the polynomial at x = 0. |
| Closure | A set is closed under an operation if combining two members always gives another member. Polynomials are closed under +, − and ×. |

## A box from a sheet of card (2.1)

Take a rectangular sheet 20 cm by 30 cm, cut a square of side x from each corner, and fold up the sides. The box has height x, length 30 − 2x and width 20 − 2x, so its volume is

V(x) = x(30 − 2x)(20 − 2x).

Only some x values make sense: x must be positive, and the width 20 − 2x must be positive, so 0 < x < 10. A table shows what happens:

| x (cm) | 1 | 2 | 3 | 4 | 5 | 6 | 8 |
|---|---|---|---|---|---|---|---|
| V(x) (cm³) | 504 | 832 | 1008 | 1056 | 1000 | 864 | 448 |

The volume rises, peaks near x = 4, and falls back to 0 at x = 10. A graph shows the maximum is a little under x = 4 (about x ≈ 3.92, V ≈ 1056.3), which you would find with technology.

Multiplying out: V(x) = x(600 − 60x − 40x + 4x²) = 4x³ − 100x² + 600x. This is a **cubic polynomial**. Both forms are useful: the factored form tells you where V is 0 (x = 0, 10, 15), the expanded form tells you the degree and leading term.

**Worked example.** A 16 cm by 16 cm square sheet has squares of side x cut from the corners. Write V(x), state the sensible domain, and find V(3).

V(x) = x(16 − 2x)² with 0 < x < 8. V(3) = 3 · 10² = 300 cm³.

**Try it.**
1. For the 20 by 30 sheet, explain why x = 12 is not allowed.
2. Expand V(x) = x(16 − 2x)² into standard form.

*Answers:* 1. The width 20 − 2·12 = −4 would be negative. 2. x(256 − 64x + 4x²) = 4x³ − 64x² + 256x.

## Deposits as a polynomial (2.2)

Suppose you deposit $500 at the start of each year for four years into an account that multiplies its balance by a factor x each year (x = 1.05 for 5% interest). At the end of the fourth year:

- the first $500 has grown through four years: 500x⁴,
- the second through three years: 500x³,
- the third: 500x², and the fourth: 500x.

Total: A(x) = 500x⁴ + 500x³ + 500x² + 500x. This is a polynomial in x, and its value for a given rate is found by substitution: A(1.05) = 500(1.2155 + 1.1576 + 1.1025 + 1.05) ≈ $2,262.82.

The reason to write it as a polynomial rather than a number is that you can ask new questions: what rate gives $2,400? (About x = 1.075, found by graphing.) How does the picture change with different deposits? Each deposit becomes a coefficient.

**Worked example.** Deposits of $200, then $300, then $400 are made at the start of three successive years. Write the balance at the end of year 3 as a polynomial in the growth factor x, and evaluate it for 4% interest.

B(x) = 200x³ + 300x² + 400x. B(1.04) = 200(1.124864) + 300(1.0816) + 400(1.04) = 224.97 + 324.48 + 416 = $965.45.

## Polynomial vocabulary (2.3)

A polynomial in x is a sum of terms of the form (number) · xᵏ with k a whole number. So 3x⁵ − x² + 8, 7, and x are polynomials; 1/x, √x, 2ˣ and x⁻² are not, because their exponents are not whole numbers or the variable is in the wrong place.

Describe 2x − 5x⁴ + 3 + x²:

- Standard form: −5x⁴ + x² + 2x + 3.
- Degree 4; leading term −5x⁴; leading coefficient −5; constant term 3.
- Coefficients: −5 (x⁴), 0 (x³), 1 (x²), 2 (x), 3 (constant).

Degree names: degree 0 constant, 1 linear, 2 quadratic, 3 cubic, 4 quartic, 5 quintic.

The **value at 0** is always the constant term, and the **leading term** decides what the polynomial does for very large |x| (next week). Keeping track of zero coefficients matters when you line up terms for addition or division.

**Worked example.** Give the degree, leading coefficient and constant term of (x + 2)(x − 3)(2x + 1) without multiplying everything out.

The leading term is x · x · 2x = 2x³, so degree 3 and leading coefficient 2. The constant term is 2 · (−3) · 1 = −6.

**Try it.**
1. Which are polynomials: 4x³ − x/2, 3/x + 1, x² + √5, 5ˣ?
2. Write 9 − x³ + 4x in standard form and give its leading coefficient.

*Answers:* 1. 4x³ − x/2 and x² + √5 are (dividing by 2 or multiplying by √5 is fine; the exponents are whole numbers). 3/x + 1 and 5ˣ are not. 2. −x³ + 4x + 9; leading coefficient −1.

## Combining polynomials (2.4)

**Adding and subtracting.** Line up like terms. Remember that subtracting a polynomial subtracts every term.

(3x³ − 2x + 5) − (x³ + 4x² − 2x − 1) = 3x³ − x³ − 4x² − 2x + 2x + 5 + 1 = 2x³ − 4x² + 6.

Notice the x terms cancelled: the degree of a sum can be lower than the degrees of the pieces, but never higher.

**Multiplying.** Every term of the first times every term of the second. A grid keeps it organised. For (x² − 3x + 2)(2x + 5):

| × | x² | −3x | 2 |
|---|---|---|---|
| 2x | 2x³ | −6x² | 4x |
| 5 | 5x² | −15x | 10 |

Collect: 2x³ + (−6 + 5)x² + (4 − 15)x + 10 = 2x³ − x² − 11x + 10. The degree of a product is the sum of the degrees (2 + 1 = 3), and the leading coefficient is the product of the leading coefficients (1 · 2 = 2).

**Closure.** Adding, subtracting or multiplying polynomials only ever produces whole-number exponents and number coefficients, so the result is a polynomial. Division is different: (x² + 1)/(x − 2) is not a polynomial, which is why rational functions get their own lessons later in the unit.

**Worked example.** A rectangular garden has length x + 6 and width x − 2, and a path of width 1 runs around the outside. Write a polynomial for the area of the path.

Outer rectangle: (x + 8)(x) = x² + 8x. Garden: (x + 6)(x − 2) = x² + 4x − 12. Path = outer − garden = (x² + 8x) − (x² + 4x − 12) = 4x + 12.

**Worked example.** Expand (x − 4)² (x + 1).

(x − 4)² = x² − 8x + 16. Then (x² − 8x + 16)(x + 1) = x³ + x² − 8x² − 8x + 16x + 16 = x³ − 7x² + 8x + 16.

**Try it.**
1. Add (5x² − 3x + 1) + (−5x² + 7x − 9).
2. Multiply (x + 3)(x² − 3x + 9).
3. Without expanding, give the degree of (x³ + 1)(2x² − x)(x − 5).

*Answers:* 1. 4x − 8. 2. x³ + 27 (the middle terms cancel). 3. 3 + 2 + 1 = 6.

## Common mistakes

- **Subtracting only the first term.** (A) − (B) changes the sign of every term of B.
- **Adding exponents when adding terms.** x² + x² = 2x², not x⁴. Exponents add only when you multiply powers.
- **Missing cross terms.** (x − 4)² is x² − 8x + 16, not x² + 16.
- **Calling 1/x a polynomial.** Negative or fractional exponents, or variables in exponents, disqualify an expression.
- **Ignoring the domain of a model.** The box volume formula gives V(12) = 12 · 6 · (−4) = −288, a number with no meaning. Always state the sensible domain.

## Where this goes next

Next week connects factored form to the graph: each factor (x − a) gives an x-intercept at a. Then end behaviour, multiplicity, division and the Remainder Theorem complete the polynomial story before rational functions arrive in week 8. The box volume and the deposit polynomial will be revisited as examples of what the new tools reveal.

## Self-check

1. A 24 cm by 18 cm sheet has corner squares of side x removed. Write V(x) in factored and standard form and state the domain.
2. Write the end-of-year-5 balance for five yearly deposits of $100 as a polynomial in the growth factor x, and evaluate it for 3% interest.
3. Give the degree, leading coefficient and constant term of 6 − 2x⁵ + x³.
4. Compute (2x² + x − 3)(x² − 4) and state the degree of the result before you multiply.
5. Explain why polynomials are closed under multiplication but not under division.

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Algebra 2, Unit 2, Lessons 1–4, https://im.kendallhunt.com/HS/teachers/3/2/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
