# Week 07 · Equivalent Representations of Polynomial and Rational Expressions

**Topics:** 1.11 Equivalent Representations of Polynomial and Rational Expressions
**Practices:** 1 (procedural and symbolic fluency), 2 (multiple representations), 3 (communication and reasoning)
**Framework:** AP Precalculus CED, Unit 1, Topic 1.11, learning objectives in our own words
**Spiral:** Week 4 built polynomials from their zeros; this week runs the process backwards, finding zeros by division. Week 5 said that a rational function whose numerator is one degree higher than its denominator has a slant asymptote; this week finds its equation. Week 6's holes and vertical asymptotes all came from factoring, and the factoring toolkit gets bigger here. From Algebra 2: multiplying polynomials, factoring quadratics, and the difference of squares.

## What you need to be able to do

- **1.11** Rewrite a polynomial in the form that answers the question: standard form for the degree, leading coefficient and vertical intercept; factored form for zeros and sign; and recognise when two forms are equivalent.
- **1.11** Factor polynomials using a common factor, grouping, special products (difference of squares, sum and difference of cubes) and quadratic-type patterns such as x⁴ − 5x² + 4.
- **1.11** Divide one polynomial by another by long division, and by a linear factor x − a with synthetic division, writing the result as dividend = divisor · quotient + remainder.
- **1.11** Use the remainder theorem (the remainder on dividing p(x) by x − a is p(a)) and the factor theorem (x − a is a factor exactly when p(a) = 0).
- **1.11** Rewrite a rational function as quotient + remainder/divisor and use it to find a slant asymptote or the polynomial that describes the end behaviour.
- **1.11** Expand (a + b)ⁿ with Pascal's triangle and the binomial theorem, and find a single coefficient without expanding everything.

## Key terms

| Term | Meaning |
|---|---|
| Equivalent expressions | Expressions that give the same output for every input in their common domain. |
| Division algorithm | For polynomials p and d (d not zero): p(x) = d(x) · q(x) + r(x), where the remainder r is zero or has degree less than d. |
| Synthetic division | A shortcut for dividing by x − a that works with coefficients only. |
| Remainder theorem | The remainder when p(x) is divided by x − a equals p(a). |
| Factor theorem | x − a is a factor of p(x) if and only if p(a) = 0. |
| Slant (oblique) asymptote | A non-horizontal line y = mx + b that the graph approaches as x → ±∞; it occurs when the numerator's degree is exactly one more than the denominator's. |
| Pascal's triangle | Rows of numbers in which each entry is the sum of the two above it; row n gives the coefficients of (a + b)ⁿ. |
| Binomial coefficient | C(n, k) = n!/(k!(n − k)!), the coefficient of aⁿ⁻ᵏbᵏ in (a + b)ⁿ. |

## Which form answers which question

| Form | Example | Shows at a glance |
|---|---|---|
| Standard | x³ + 2x² − 9x − 18 | degree 3, leading coefficient 1, vertical intercept −18, end behaviour |
| Factored | (x + 2)(x − 3)(x + 3) | zeros −2, 3, −3; sign on each interval; multiplicities |
| Quotient + remainder/divisor | for (x² − x − 2)/(x − 4): x + 3 + 10/(x − 4) | slant asymptote y = x + 3; the part that blows up near x = 4 |

All three describe the same function. Being fluent means choosing the form the question needs and moving between them without errors.

## Factoring toolkit

Try these in order.

1. **Common factor.** 3x⁴ − 12x² = 3x²(x² − 4) = 3x²(x − 2)(x + 2).
2. **Grouping** (four terms). x³ + 2x² − 9x − 18 = x²(x + 2) − 9(x + 2) = (x + 2)(x² − 9) = (x + 2)(x − 3)(x + 3).
3. **Special products.**
   - a² − b² = (a − b)(a + b)
   - a³ + b³ = (a + b)(a² − ab + b²)
   - a³ − b³ = (a − b)(a² + ab + b²)
   For example, x³ + 27 = (x + 3)(x² − 3x + 9) and 8x³ − 1 = (2x − 1)(4x² + 2x + 1). The quadratic factors here have negative discriminants, so they give complex zeros, not real ones.
4. **Quadratic type.** x⁴ − 5x² + 4: let u = x², so u² − 5u + 4 = (u − 1)(u − 4). Then (x² − 1)(x² − 4) = (x − 1)(x + 1)(x − 2)(x + 2).
5. **A known zero, then divide.** If none of the above applies, find or test a zero a, divide by x − a, and factor the smaller quotient.

**Try it.**
1. Factor x³ − 64.
2. Factor 2x³ − x² − 18x + 9 by grouping.

*Answers:* 1. (x − 4)(x² + 4x + 16). 2. x²(2x − 1) − 9(2x − 1) = (2x − 1)(x − 3)(x + 3).

## Polynomial long division

Long division of polynomials follows the same rhythm as long division of numbers: divide the leading terms, multiply back, subtract, bring down, repeat. Write every power of x in the dividend, using a 0 coefficient for any missing power.

**Worked example.** Divide x⁴ − 2x³ + 3x − 1 by x² + 1.

Write the dividend as x⁴ − 2x³ + 0x² + 3x − 1.

- x⁴ ÷ x² = x². Multiply: x²(x² + 1) = x⁴ + x². Subtract: −2x³ − x² + 3x.
- −2x³ ÷ x² = −2x. Multiply: −2x³ − 2x. Subtract: −x² + 5x − 1.
- −x² ÷ x² = −1. Multiply: −x² − 1. Subtract: 5x.

The remainder 5x has degree 1, less than the divisor's degree 2, so we stop.

x⁴ − 2x³ + 3x − 1 = (x² + 1)(x² − 2x − 1) + 5x, or (x⁴ − 2x³ + 3x − 1)/(x² + 1) = x² − 2x − 1 + 5x/(x² + 1).

**Check by multiplying:** (x² + 1)(x² − 2x − 1) = x⁴ − 2x³ − x² + x² − 2x − 1 = x⁴ − 2x³ − 2x − 1; adding 5x gives back the dividend.

## Synthetic division by x − a

To divide by x − a, write a on the left and the dividend's coefficients (with zeros for missing powers) in a row. Bring down the first coefficient; then repeatedly multiply by a, write the product under the next coefficient, and add.

**Worked example.** Divide 2x³ − 3x² + 4x − 5 by x − 2.

| a = 2 | 2 | −3 | 4 | −5 |
|---|---|---|---|---|
| multiply | | 4 | 2 | 12 |
| add | 2 | 1 | 6 | 7 |

The bottom row gives the quotient 2x² + x + 6 and the remainder 7:
2x³ − 3x² + 4x − 5 = (x − 2)(2x² + x + 6) + 7.

**Dividing by x + a.** Use −a. To divide by x + 1, put −1 on the left.

**Worked example.** Divide 3x³ − 5x² + 4 by x + 1. Coefficients 3, −5, 0, 4 with −1 on the left: bring down 3; 3 · (−1) = −3, −5 + (−3) = −8; −8 · (−1) = 8, 0 + 8 = 8; 8 · (−1) = −8, 4 + (−8) = −4. Quotient 3x² − 8x + 8, remainder −4.

**Try it.**
1. Divide x³ − 7x + 6 by x − 2.
2. Divide x⁴ − 1 by x + 1.

*Answers:* 1. Coefficients 1, 0, −7, 6: quotient x² + 2x − 3, remainder 0. 2. Coefficients 1, 0, 0, 0, −1 with −1: quotient x³ − x² + x − 1, remainder 0.

## Remainder theorem and factor theorem

Put x = a into p(x) = (x − a)q(x) + r. The first term is 0, so **p(a) = r**. That is the remainder theorem. Two consequences:

- You can evaluate p(a) by synthetic division (useful for large polynomials) or find a remainder by evaluating (useful when you only need the remainder).
- **Factor theorem:** the remainder is 0 exactly when p(a) = 0, so x − a is a factor exactly when a is a zero.

**Worked example.** Find the remainder when p(x) = x⁴ − 3x³ + 2x − 7 is divided by x + 1.

The remainder is p(−1) = 1 + 3 − 2 − 7 = −5.

**Worked example.** Find k so that x + 2 is a factor of x³ + kx² − x − 2, then factor completely.

By the factor theorem p(−2) = 0: −8 + 4k + 2 − 2 = 4k − 8 = 0, so k = 2. Then x³ + 2x² − x − 2 = x²(x + 2) − (x + 2) = (x + 2)(x − 1)(x + 1).

**Worked example.** Given that 1 is a zero of p(x) = x³ − 6x² + 11x − 6, find all zeros.

Synthetic division by x − 1 with coefficients 1, −6, 11, −6 gives 1, −5, 6 and remainder 0. So p(x) = (x − 1)(x² − 5x + 6) = (x − 1)(x − 2)(x − 3). Zeros 1, 2, 3.

## Rational functions as quotient + remainder/divisor

Divide the numerator by the denominator: n(x)/d(x) = q(x) + r(x)/d(x), with the degree of r less than the degree of d. As x → ±∞, r(x)/d(x) → 0, so the graph approaches the graph of y = q(x).

- Degree of n one more than degree of d: q is linear, and y = q(x) is the **slant asymptote**.
- Degree of n equal to degree of d: q is a constant, the horizontal asymptote (the same answer as week 5's ratio of leading coefficients).
- Degree of n two or more above: q is a polynomial of degree 2 or more, describing the end behaviour; there is no line asymptote.

**Worked example.** Find the slant asymptote of f(x) = (2x² + 3x − 1)/(x + 2).

Synthetic division with −2: coefficients 2, 3, −1 give 2, −1 and remainder 1. So f(x) = 2x − 1 + 1/(x + 2). The slant asymptote is y = 2x − 1. For large positive x, 1/(x + 2) is a small positive number, so the graph sits just above the line; for large negative x it sits just below.

**Worked example.** Week 6 left r(x) = (x − 2)(x + 1)/(x − 4) unfinished. Expanded, the numerator is x² − x − 2. Dividing by x − 4 (synthetic with 4: 1, −1, −2 → 1, 3, 10) gives r(x) = x + 3 + 10/(x − 4). Slant asymptote y = x + 3. The remainder term 10/(x − 4) is also what blows up near x = 4: positive and large just to the right, negative and large just to the left, as the sign chart showed.

**Try it.**
1. Write (x² + 5x + 1)/(x + 1) as quotient + remainder/divisor.
2. Find the slant asymptote of (3x³ − x + 2)/(x² + 1).

*Answers:* 1. x + 4 − 3/(x + 1). 2. Long division: 3x + (−4x + 2)/(x² + 1), so y = 3x.

## Pascal's triangle and the binomial theorem

Expanding (a + b)ⁿ by repeated multiplication is slow. The coefficients follow Pascal's triangle:

| n | coefficients |
|---|---|
| 0 | 1 |
| 1 | 1 1 |
| 2 | 1 2 1 |
| 3 | 1 3 3 1 |
| 4 | 1 4 6 4 1 |
| 5 | 1 5 10 10 5 1 |
| 6 | 1 6 15 20 15 6 1 |

Each entry is the sum of the two entries above it. The **binomial theorem** says

(a + b)ⁿ = C(n, 0)aⁿ + C(n, 1)aⁿ⁻¹b + C(n, 2)aⁿ⁻²b² + … + C(n, n)bⁿ,

where C(n, k) = n!/(k!(n − k)!) is entry k of row n (counting from 0). The powers of a fall from n to 0 while the powers of b rise from 0 to n; in every term the exponents add to n.

**Worked example.** Expand (x + 2)⁴.

Row 4: 1, 4, 6, 4, 1. (x + 2)⁴ = x⁴ + 4x³(2) + 6x²(2²) + 4x(2³) + 2⁴ = x⁴ + 8x³ + 24x² + 32x + 16.

**Worked example.** Find the coefficient of x³ in (2x − 1)⁵ without expanding.

The x³ term has a = 2x to the power 3, so b = −1 to the power 2: C(5, 2)(2x)³(−1)² = 10 · 8x³ · 1 = 80x³. The coefficient is 80. Treat the sign as part of b; forgetting it is the most common error.

**Try it.**
1. Expand (x − 1)³.
2. Find the constant term of (x + 3)⁶.

*Answers:* 1. x³ − 3x² + 3x − 1. 2. 3⁶ = 729.

## Calculator notes

A graphing calculator can check equivalence: graph the original expression and your rewritten form; if the graphs coincide (and the tables match), the forms are very likely equivalent. Graphing f(x) = (2x² + 3x − 1)/(x + 2) together with y = 2x − 1 shows the curve hugging the line as you zoom out. Many calculators also have an nCr command for binomial coefficients. On AP non-calculator questions you should divide, factor and expand by hand.

## Common mistakes

- **Leaving out zero placeholders.** Dividing x³ − 7x + 6 with coefficients 1, −7, 6 gives nonsense; the x² coefficient 0 must be written.
- **Using a instead of −a for x + a** in synthetic division, or reading the remainder theorem as p(a) for the divisor x + a (it is p(−a)).
- **Stopping long division too early or too late.** Stop when the remainder's degree is less than the divisor's.
- **Taking the whole quotient-plus-remainder as the asymptote.** The slant asymptote is the quotient only.
- **Sign errors in the cube formulas.** a³ − b³ = (a − b)(a² + ab + b²): the sign in the binomial matches, the middle sign of the trinomial is opposite, and the last is always +.
- **Forgetting the coefficient inside a binomial.** In (2x − 1)⁵ both the 2 and the − sign are raised to powers.

## Where this goes next

Week 8 transforms functions; rewriting a rational function as quotient + remainder/divisor often shows it is a transformation of 1/x, for example (2x + 7)/(x + 3) = 2 + 1/(x + 3). Week 9 chooses and builds models, sometimes by dividing to interpret a rational model's long-run behaviour. In Unit 2 the same idea of rewriting expressions to reveal properties returns with exponent and logarithm rules.

## Self-check

1. Divide x³ + 4x² − 5 by x + 2 and state the quotient and remainder.
2. Use the remainder theorem to find the remainder when x⁵ − 3x + 1 is divided by x − 2.
3. Factor x⁴ − 13x² + 36 completely.
4. Find the slant asymptote of (x² − 4x + 7)/(x − 1) and say whether the graph is above or below it for large positive x.
5. Find the coefficient of x² in (x − 3)⁵.

---

*Original study material for this course, organised around the College Board AP Precalculus Course and Exam Description (Unit 1, Topic 1.11). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). AP® is a trademark of the College Board, which does not endorse this material.*
