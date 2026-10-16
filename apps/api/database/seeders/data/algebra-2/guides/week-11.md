# Week 11 · Exponents, Roots and Rational Exponents

**Lessons:** 3.1 Properties of Exponents · 3.2 Square Roots and Cube Roots · 3.3 Exponents That Are Unit Fractions · 3.4 Positive Rational Exponents · 3.5 Negative Rational Exponents
**Practices:** MP7 (look for structure), MP8 (regularity in repeated reasoning), MP6 (attend to precision)
**Built from:** IM Algebra 2, Unit 3, Lessons 1–5, in our own words
**Spiral:** The exponent rules you used for polynomials (week 4) and geometric sequences (Unit 1) are now extended to fractional and negative exponents. Solving x² = 9 by factoring (week 5) is contrasted with evaluating √9.

## What you need to be able to do

- **3.1** State and use the exponent rules (product, quotient, power, zero and negative exponents) and explain why each one must be true if the rules are to stay consistent.
- **3.2** Explain what √a and ∛a mean, why √a is never negative, why the equation x² = a has two solutions when a > 0 while √a is one number, and why cube roots of negative numbers exist.
- **3.3** Explain why a^(1/2) must equal √a and a^(1/3) must equal ∛a if the exponent rules are to hold, and evaluate expressions with unit-fraction exponents.
- **3.4** Evaluate and rewrite expressions with positive rational exponents: a^(m/n) = (ⁿ√a)ᵐ = ⁿ√(aᵐ).
- **3.5** Evaluate and rewrite expressions with negative rational exponents: a^(−m/n) = 1/a^(m/n).

## Key terms

| Term | Meaning |
|---|---|
| Base and exponent | In 2⁵, the base is 2 and the exponent is 5: multiply five 2s. |
| Square root √a | The nonnegative number whose square is a (for a ≥ 0). √49 = 7. |
| Cube root ∛a | The number whose cube is a; defined for every real a. ∛(−125) = −5. |
| nth root ⁿ√a | The number whose nth power is a; for even n it is the nonnegative one. |
| Unit-fraction exponent | a^(1/n) = ⁿ√a. |
| Rational exponent | a^(m/n) = (ⁿ√a)ᵐ = ⁿ√(aᵐ). |
| Negative exponent | a^(−k) = 1/aᵏ. |

## The exponent rules and why they must hold (3.1)

For whole-number exponents, 2³ · 2⁴ means (2·2·2)(2·2·2·2) = 2⁷: the exponents add. From that one idea follow the rules:

| Rule | Why | Example |
|---|---|---|
| aᵐ · aⁿ = aᵐ⁺ⁿ | counting factors | x⁵ · x⁻² = x³ |
| aᵐ / aⁿ = aᵐ⁻ⁿ | cancelling factors | 2¹⁰/2⁷ = 2³ = 8 |
| (aᵐ)ⁿ = aᵐⁿ | n groups of m factors | (2³)⁴ = 2¹² = 4096 |
| (ab)ⁿ = aⁿbⁿ | regrouping | (3x)² = 9x² |
| a⁰ = 1 | aⁿ/aⁿ = aⁿ⁻ⁿ must equal 1 | 5⁰ = 1 |
| a⁻ⁿ = 1/aⁿ | a⁰/aⁿ = a⁻ⁿ and also = 1/aⁿ | 5⁻² = 1/25 |

The last two rows show the key move of this unit: **we define the new cases so that the old rules keep working.** Nobody can "multiply 5 by itself zero times", but if the quotient rule is to hold then 5⁰ has to be 1. The same reasoning will define fractional exponents.

**Worked example.** Simplify (x³y)² · x⁻⁴ / y.

(x³y)² = x⁶y². Times x⁻⁴: x²y². Divided by y: x²y.

**Worked example.** Write 1/(4x⁻³) without negative exponents.

x⁻³ in the denominator becomes x³ in the numerator: x³/4.

**Try it.**
1. Simplify 3⁵ · 3⁻⁷.
2. Simplify (2a²b⁻¹)³.

*Answers:* 1. 3⁻² = 1/9. 2. 8a⁶b⁻³ = 8a⁶/b³.

## Square roots and cube roots (3.2)

Two different questions get confused:

- **Solve x² = 49.** Both 7 and −7 square to 49, so there are two solutions: x = ±7.
- **Evaluate √49.** The symbol √ means the *nonnegative* square root, so √49 = 7, one number.

So the solutions of x² = a (for a > 0) are x = √a and x = −√a, and √a itself is never negative. √(−4) is not a real number, because no real number squares to a negative (that changes in week 13).

Cube roots behave differently: every real number has exactly one real cube root. ∛8 = 2 and ∛(−8) = −2, because (−2)³ = −8. The equation x³ = −125 has the single solution x = −5.

| Expression | Value | Why |
|---|---|---|
| √81 | 9 | 9² = 81 and 9 ≥ 0 |
| −√81 | −9 | the negative of the square root |
| √(−81) | not real | no real square is negative |
| ∛(−27) | −3 | (−3)³ = −27 |
| solutions of x² = 81 | 9 and −9 | both square to 81 |
| solutions of x³ = −27 | −3 only | cubing keeps the sign |

**Worked example.** Estimate √50 and ∛50 without a calculator.

7² = 49 and 8² = 64, so √50 is a little more than 7 (about 7.07). 3³ = 27 and 4³ = 64, so ∛50 is between 3 and 4, closer to 4 (about 3.68).

**Try it.**
1. Solve x² = 144 and evaluate √144.
2. Evaluate ∛(−1000) and solve x³ = 1000.

*Answers:* 1. x = ±12; √144 = 12. 2. −10; x = 10.

## Unit-fraction exponents (3.3)

What should 9^(1/2) mean? If the power rule is to keep working, then (9^(1/2))² = 9^(1/2 · 2) = 9¹ = 9. So 9^(1/2) is a number whose square is 9. We choose the nonnegative one: 9^(1/2) = √9 = 3.

In the same way (8^(1/3))³ = 8, so 8^(1/3) = ∛8 = 2. In general:

**a^(1/n) = ⁿ√a.**

| Expression | Value |
|---|---|
| 16^(1/2) | 4 |
| 64^(1/3) | 4 |
| 64^(1/2) | 8 |
| 32^(1/5) | 2 |
| 81^(1/4) | 3 |
| (−27)^(1/3) | −3 |

**Worked example.** Evaluate 0.25^(1/2) and 1000^(1/3).

0.25^(1/2) = √0.25 = 0.5 (since 0.5² = 0.25). 1000^(1/3) = ∛1000 = 10.

**Try it.**
1. Evaluate 49^(1/2), 125^(1/3) and 16^(1/4).
2. Explain why 10^(1/2) is between 3 and 4.

*Answers:* 1. 7, 5, 2. 2. 3² = 9 < 10 < 16 = 4², so its square root is between 3 and 4 (about 3.16).

## Positive rational exponents (3.4)

Combine the power rule with unit fractions: 8^(2/3) = (8^(1/3))² = 2² = 4. Equally, 8^(2/3) = (8²)^(1/3) = 64^(1/3) = 4. Both orders give the same answer; taking the root first keeps the numbers small.

**a^(m/n) = (ⁿ√a)ᵐ = ⁿ√(aᵐ).**

| Expression | Root first | Value |
|---|---|---|
| 27^(4/3) | (∛27)⁴ = 3⁴ | 81 |
| 16^(3/4) | (⁴√16)³ = 2³ | 8 |
| 125^(2/3) | (∛125)² = 5² | 25 |
| 32^(3/5) | (⁵√32)³ = 2³ | 8 |
| 64^(2/3) | (∛64)² = 4² | 16 |
| 4^(3/2) | (√4)³ = 2³ | 8 |

Going the other way, a radical becomes a rational exponent: √(x⁵) = x^(5/2), ∛(y²) = y^(2/3), ⁵√(x²) = x^(2/5). The index of the root is the denominator; the power is the numerator.

**Worked example.** Write (√x)³ · ∛x as a single power of x.

x^(3/2) · x^(1/3) = x^(3/2 + 1/3) = x^(11/6).

**Try it.**
1. Evaluate 9^(3/2) and 1000^(2/3).
2. Write ⁴√(a³) with a rational exponent and (b^(2/5))⁵ as a power of b.

*Answers:* 1. 27, 100. 2. a^(3/4); b².

## Negative rational exponents (3.5)

A negative exponent means reciprocal: a^(−k) = 1/aᵏ. With a fraction in the exponent, do the reciprocal and the root/power in whichever order is easiest:

8^(−2/3) = 1/8^(2/3) = 1/4.

| Expression | Steps | Value |
|---|---|---|
| 16^(−3/4) | 1/16^(3/4) = 1/8 | 1/8 |
| 64^(−1/2) | 1/√64 | 1/8 |
| 81^(−3/4) | 1/(⁴√81)³ = 1/27 | 1/27 ≈ 0.037 |
| 4^(−1/2) | 1/√4 | 1/2 (not −2) |
| (1/9)^(−1/2) | 9^(1/2) | 3 |
| 0.001^(−1/3) | 1/0.1 | 10 |

The last two rows show a handy fact: a negative exponent on a fraction flips the fraction. (1/9)^(−1/2) = 9^(1/2) = 3.

**Worked example.** Simplify x^(−1/2) · x² and write it with a positive exponent.

x^(−1/2 + 2) = x^(3/2), already positive. If the result had been x^(−3/2) you would write 1/x^(3/2).

**Worked example.** A function is f(x) = 64ˣ. Find f(1/2), f(2/3) and f(−1/2).

f(1/2) = √64 = 8. f(2/3) = (∛64)² = 16. f(−1/2) = 1/√64 = 1/8.

**Try it.**
1. Evaluate 25^(−1/2), 27^(−2/3) and (1/16)^(−3/4).
2. Write 1/⁵√(x³) with a rational exponent.

*Answers:* 1. 1/5, 1/9, 8. 2. x^(−3/5).

## Common mistakes

- **Reading a negative exponent as a negative answer.** 4^(−1/2) = 1/2, not −2. The sign in the exponent means reciprocal.
- **Writing √49 = ±7.** The symbol is the nonnegative root; the equation x² = 49 has two solutions.
- **Taking the root of a negative number with an even index.** √(−16) is not real; ∛(−64) = −4 is fine.
- **Mixing up numerator and denominator** in a^(m/n): the root index is the denominator.
- **Adding exponents when multiplying different bases.** 2³ · 3² is 8 · 9 = 72, not 6⁵.

## Where this goes next

Next week uses these ideas to solve equations with squares, cubes and radicals, and to see which solving steps can introduce extraneous solutions. Week 13 fixes the gap at √(−1) by introducing the number i. Unit 4 relies on rational exponents to make sense of exponential functions at fractional inputs, such as 2^(1/12) in a growth model.

## Self-check

1. Simplify (a⁴b⁻²)³ · a⁻¹⁰ and write it without negative exponents.
2. Explain the difference between "solve x² = 36" and "evaluate √36".
3. Explain why 32^(1/5) must equal 2 if the exponent rules hold.
4. Evaluate 16^(5/4), 27^(−2/3) and (1/4)^(−3/2).
5. Write √x · ∛x / x as a single power of x.

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Algebra 2, Unit 3, Lessons 1–5, https://im.kendallhunt.com/HS/teachers/3/3/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
