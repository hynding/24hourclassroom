# Week 10 · Polynomial Identities and Geometric Sums

**Lessons:** 2.23 Polynomial Identities (Part 1) · 2.24 Polynomial Identities (Part 2) · 2.25 Summing Up · 2.26 Using the Sum
**Practices:** MP3 (construct arguments), MP7 (look for structure), MP4 (model with mathematics)
**Built from:** IM Algebra 2, Unit 2, Lessons 23–26, in our own words
**Spiral:** Multiplying polynomials (week 4) is how identities are proved. The Remainder Theorem (week 7) explains why (x − 1) divides xⁿ − 1. The geometric sequences and partial sums of Unit 1 (weeks 1–3) finally get their closed-form sum.

## What you need to be able to do

- **2.23** Tell an identity (true for every value of the variable) from an equation (true for some values), and prove an identity by rewriting one side until it matches the other.
- **2.24** Use identities to reason about numbers: the difference of squares, the sum and difference of cubes, (x − 1)(xⁿ⁻¹ + … + x + 1) = xⁿ − 1, and the identity that generates Pythagorean triples.
- **2.25** Derive the formula for the sum of a finite geometric series, S = a(rⁿ − 1)/(r − 1), from the identity for xⁿ − 1, and use it.
- **2.26** Apply the geometric series formula to repeated deposits, repeated payments and other situations where a fixed amount is added at regular intervals and grows by a constant factor.

## Key terms

| Term | Meaning |
|---|---|
| Identity | An equation that is true for every value of its variables, such as (x + 1)² = x² + 2x + 1. |
| Equation (conditional) | An equation that is true only for particular values, such as x² = 4. |
| Difference of squares | a² − b² = (a − b)(a + b). |
| Sum and difference of cubes | a³ + b³ = (a + b)(a² − ab + b²); a³ − b³ = (a − b)(a² + ab + b²). |
| Geometric series | The sum of the terms of a geometric sequence: a + ar + ar² + … + arⁿ⁻¹. |
| Geometric sum formula | a + ar + … + arⁿ⁻¹ = a(rⁿ − 1)/(r − 1) for r ≠ 1. |
| Pythagorean triple | Three whole numbers a, b, c with a² + b² = c², such as 3, 4, 5. |

## Identities (2.23)

x² = 4 is true for x = 2 and x = −2 and false otherwise: it is a **conditional equation**. (x + 3)² = x² + 6x + 9 is true for **every** x: it is an **identity**. An identity is a statement that two expressions are the same polynomial written differently.

To **prove** an identity, start from one side and rewrite it, step by step, until it is the other side. Usually you expand the more complicated side.

**Worked example.** Prove that (x + y)² − (x − y)² = 4xy.

Left side: (x² + 2xy + y²) − (x² − 2xy + y²) = x² + 2xy + y² − x² + 2xy − y² = 4xy. That is the right side, so the identity holds for all x and y.

To **disprove** a claimed identity, one counterexample is enough. Is (x + 2)³ = x³ + 8 an identity? At x = 1 the left side is 27 and the right side is 9. No.

Identities are more than curiosities: an identity lets you replace one expression with another whenever it is convenient. (x + y)² − (x − y)² = 4xy, for instance, says that the difference of two squares can be computed as a product: 52² − 48² = 4 · 50 · 2 = 400.

**Worked example.** Show that (x² + 1)² − (x² − 1)² = 4x² and use it to compute 101² − 99².

With x² in place of x in the identity above, the left side is 4 · x² · 1 = 4x². For 101² − 99²: take x² = 100, so the answer is 4 · 100 = 400. (Check with the difference of squares: (101 − 99)(101 + 99) = 2 · 200 = 400.)

**Try it.**
1. Is (x − 1)(x + 1) = x² − 1 an identity or a conditional equation?
2. Prove that (a + b)(a − b) + b² = a².
3. Give a counterexample to the claim √(x² + 9) = x + 3.

*Answers:* 1. Identity. 2. a² − b² + b² = a². 3. x = 4: left side 5, right side 7.

## Useful identities and what they tell you about numbers (2.24)

| Identity | Example use |
|---|---|
| a² − b² = (a − b)(a + b) | 2023² − 2022² = (1)(4045) = 4045, no squaring needed |
| a³ − b³ = (a − b)(a² + ab + b²) | x³ − 8 = (x − 2)(x² + 2x + 4) |
| a³ + b³ = (a + b)(a² − ab + b²) | x³ + 27 = (x + 3)(x² − 3x + 9) |
| (x − 1)(xⁿ⁻¹ + xⁿ⁻² + … + x + 1) = xⁿ − 1 | every xⁿ − 1 has the factor (x − 1) |
| (a² − b²)² + (2ab)² = (a² + b²)² | generates Pythagorean triples |

**The xⁿ − 1 identity.** Multiply out (x − 1)(x³ + x² + x + 1): x⁴ + x³ + x² + x − x³ − x² − x − 1 = x⁴ − 1. Every middle term cancels, leaving the first and last. The same cancellation works for any n. The Remainder Theorem agrees: p(x) = xⁿ − 1 has p(1) = 0, so (x − 1) must be a factor.

One consequence: 2¹⁰ − 1 = 1023 is divisible by 2 − 1 = 1 (useless), but 4¹⁰ − 1 = (2²)¹⁰ − 1 = (2¹⁰)² − 1 = (2¹⁰ − 1)(2¹⁰ + 1) = 1023 · 1025, so it is divisible by 1023 and by 1025. Identities let you factor large numbers without computing them.

**Pythagorean triples.** Expand both sides of (a² − b²)² + (2ab)² = (a² + b²)²:

Left: a⁴ − 2a²b² + b⁴ + 4a²b² = a⁴ + 2a²b² + b⁴. Right: a⁴ + 2a²b² + b⁴. Equal, so it is an identity. Choosing whole numbers a > b produces triples:

| a | b | a² − b² | 2ab | a² + b² |
|---|---|---|---|---|
| 2 | 1 | 3 | 4 | 5 |
| 3 | 2 | 5 | 12 | 13 |
| 4 | 1 | 15 | 8 | 17 |
| 5 | 2 | 21 | 20 | 29 |

**Try it.**
1. Factor x³ − 125 and x⁶ − 1 (hint: x⁶ − 1 = (x³)² − 1).
2. Produce the Pythagorean triple from a = 4, b = 3.

*Answers:* 1. (x − 5)(x² + 5x + 25); (x³ − 1)(x³ + 1) = (x − 1)(x² + x + 1)(x + 1)(x² − x + 1). 2. 7, 24, 25.

## Summing a geometric series (2.25)

Divide both sides of the xⁿ − 1 identity by (x − 1), for x ≠ 1:

1 + x + x² + … + xⁿ⁻¹ = (xⁿ − 1)/(x − 1).

The left side is a geometric series with first term 1 and ratio x. For a general first term a, multiply through by a:

**a + ar + ar² + … + arⁿ⁻¹ = a · (rⁿ − 1)/(r − 1)**, valid for r ≠ 1 (when r = 1 every term is a and the sum is na).

Notice that there are **n terms** (exponents 0 to n − 1) and the formula uses rⁿ. For a ratio between −1 and 1 it is often tidier to write a(1 − rⁿ)/(1 − r), which is the same thing with both numerator and denominator negated.

**Worked example.** Find 3 + 6 + 12 + … + 384.

a = 3, r = 2. The last term 384 = 3 · 2⁷ is the 8th term, so n = 8. S = 3(2⁸ − 1)/(2 − 1) = 3 · 255 = 765. (Week 3 found this by listing; now it is one line.)

**Worked example.** Find the sum of the first 10 terms of 80, 40, 20, …

a = 80, r = 1/2, n = 10. S = 80(1 − (1/2)¹⁰)/(1 − 1/2) = 160(1 − 1/1024) = 160 · 1023/1024 ≈ 159.84. The sums approach 160, as week 3 predicted; the formula shows exactly how close: 160 minus 160/2ⁿ.

**Worked example.** Find 1 − 3 + 9 − 27 + 81 − 243.

a = 1, r = −3, n = 6. S = ((−3)⁶ − 1)/(−3 − 1) = (729 − 1)/(−4) = −182. Check by adding: 1 − 3 = −2, + 9 = 7, − 27 = −20, + 81 = 61, − 243 = −182.

**Try it.**
1. Find 5 + 15 + 45 + … + 5 · 3⁹.
2. Find the sum of the first 12 terms of 1, 1.1, 1.21, … to two decimal places.

*Answers:* 1. n = 10: 5(3¹⁰ − 1)/2 = 5 · 59048/2 = 147,620. 2. (1.1¹² − 1)/0.1 = (3.1384 − 1)/0.1 ≈ 21.38.

## Using the sum (2.26)

Week 4's deposit polynomial, 500x⁴ + 500x³ + 500x² + 500x, is a geometric series with a = 500x, r = x and n = 4. The sum formula turns it into a single expression:

500x · (x⁴ − 1)/(x − 1).

For 5% interest (x = 1.05): 525 · (1.21550625 − 1)/0.05 = 525 · 4.310125 ≈ $2,262.82, the same as substituting into the polynomial, but now the number of years can be anything without writing out all the terms.

**Worked example.** $200 is deposited at the end of every month for 3 years into an account paying 0.5% per month. What is the balance just after the last deposit?

The last deposit has grown for 0 months, the one before for 1 month, …, the first for 35 months: 200 + 200(1.005) + … + 200(1.005)³⁵. That is a = 200, r = 1.005, n = 36: S = 200(1.005³⁶ − 1)/0.005 = 200(1.19668 − 1)/0.005 = 200 · 39.336 ≈ $7,867.22. The deposits total $7,200; the rest is interest.

**Worked example.** A loan of $10,000 at 1% per month is repaid with equal monthly payments P for 24 months. What is P?

After 24 months the loan has grown to 10000 · 1.01²⁴ ≈ 12,697.35 and the payments, each growing from when it was made, total P(1.01²⁴ − 1)/0.01 = P · 26.9735. Setting these equal: P = 12,697.35/26.9735 ≈ $470.73 per month.

**Worked example.** A ball dropped from 10 m rebounds to 70% of its height on each bounce. How far has it travelled when it hits the floor for the 8th time?

The drop is 10 m, then each of the 7 bounces goes up and down: 2(7 + 4.9 + … + 10 · 0.7⁷). That sum is 2 · 7(1 − 0.7⁷)/(1 − 0.7) = 2 · 7 · (1 − 0.0823543)/0.3 ≈ 2 · 21.412 ≈ 42.82 m. Total ≈ 52.82 m.

**Try it.**
1. $50 is deposited at the end of each year for 20 years at 4% per year. Balance after the last deposit?
2. Write the sum 1 + 1.02 + 1.02² + … + 1.02²⁹ in closed form and evaluate it.

*Answers:* 1. 50(1.04²⁰ − 1)/0.04 = 50 · 29.778 ≈ $1,488.90. 2. (1.02³⁰ − 1)/0.02 = (1.81136 − 1)/0.02 ≈ 40.57.

## Common mistakes

- **Using n − 1 in the formula.** The sum of n terms uses rⁿ. Count the terms: the last exponent plus one.
- **Treating a conditional equation as an identity.** x² = 4 is not true for every x; (x − 2)(x + 2) = x² − 4 is.
- **Proving an identity by plugging in one number.** One value checks, it does not prove; one counterexample disproves.
- **Forgetting that the formula fails at r = 1.** For r = 1 the sum is simply n times the first term.
- **Mis-counting growth periods in deposit problems.** A deposit made at the end of month 36 has grown for 0 months, not 1.

## Where this goes next

Unit 3 starts next week with exponent rules and radicals, then complex numbers; the identity x² + 1 = (x − i)(x + i) will make every quadratic factor. The geometric series formula returns in Unit 4 (exponential models) and in any later course that studies annuities, compound interest or infinite series.

## Self-check

1. Prove that (x + 1)³ − (x − 1)³ = 6x² + 2.
2. Use an identity to compute 1,000,001² − 999,999² without squaring anything.
3. Factor x⁵ − 1 as (x − 1) times a polynomial, and explain why the Remainder Theorem guarantees the factor.
4. Find 4 + 12 + 36 + … + 4 · 3⁸ with the sum formula.
5. $100 is deposited at the end of every month for 5 years at 0.4% per month. Find the balance after the last deposit, to the nearest dollar.

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Algebra 2, Unit 2, Lessons 23–26, https://im.kendallhunt.com/HS/teachers/3/2/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
