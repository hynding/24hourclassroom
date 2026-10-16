# Week 15 · Complex Solutions and the Discriminant

**Lessons:** 3.17 Completing the Square and Complex Solutions · 3.18 The Quadratic Formula and Complex Solutions · 3.19 Real and Non-Real Solutions
**Practices:** MP7 (look for structure), MP3 (construct arguments), MP8 (regularity in repeated reasoning)
**Built from:** IM Algebra 2, Unit 3, Lessons 17–19, in our own words
**Spiral:** Completing the square (week 14) now continues past (x + 1)² = −4 instead of stopping. Square roots of negative numbers (week 13) supply the ±bi. The quadratic formula is the Algebra 1 formula unchanged; only the arithmetic under the root is new. Conjugates (week 14) explain why non-real solutions come in pairs.

## What you need to be able to do

- **3.17** Solve any quadratic by completing the square, continuing to complex solutions when the completed-square form has a negative right side, and check a complex solution by substitution.
- **3.18** Use the quadratic formula to find real or non-real solutions, simplify √(negative) to i√(positive), and reduce fractions such as (4 ± 2i√3)/2 correctly.
- **3.19** Use the discriminant b² − 4ac to decide, without solving, whether a quadratic has two real solutions, one real solution or two non-real solutions; connect that to the number of x-intercepts of the graph; explain why non-real solutions of a real-coefficient quadratic are conjugates; build a quadratic from a given pair of solutions.

## Key terms

| Term | Meaning |
|---|---|
| Quadratic formula | For ax² + bx + c = 0, x = (−b ± √(b² − 4ac)) / (2a). |
| Discriminant | The quantity b² − 4ac under the root. Its sign decides the kind of solutions. |
| Non-real solution | A solution with nonzero imaginary part, such as 2 + i√3. |
| Conjugate pair | Two numbers a + bi and a − bi; the non-real solutions of a real-coefficient quadratic always form one. |
| Double root | The single solution when the discriminant is 0; the graph touches the x-axis there. |

## Completing the square all the way (3.17)

Last week x² + 2x + 5 = 0 became (x + 1)² = −4 and we stopped. Now we continue: x + 1 = ±√(−4) = ±2i, so x = −1 ± 2i.

The method is the same for every quadratic:

1. Make the leading coefficient 1 (divide through).
2. Move the constant to the right.
3. Add (half the x-coefficient)² to both sides.
4. Undo the square with ±; if the right side is negative, the ± brings in i.

| Equation | Completed square | Solutions |
|---|---|---|
| x² + 4x + 13 = 0 | (x + 2)² = −9 | −2 ± 3i |
| x² − 6x + 25 = 0 | (x − 3)² = −16 | 3 ± 4i |
| x² − 10x + 29 = 0 | (x − 5)² = −4 | 5 ± 2i |
| x² + 8x + 20 = 0 | (x + 4)² = −4 | −4 ± 2i |
| 2x² − 4x + 10 = 0 | x² − 2x + 5 = 0, (x − 1)² = −4 | 1 ± 2i |
| x² − 2x + 3 = 0 | (x − 1)² = −2 | 1 ± i√2 |
| x² + 9 = 0 | x² = −9 | ±3i |

**Checking.** Is x = −2 + 3i really a solution of x² + 4x + 13 = 0? x² = 4 − 12i + 9i² = −5 − 12i; 4x = −8 + 12i; so x² + 4x + 13 = (−5 − 12i) + (−8 + 12i) + 13 = 0. ✓ The imaginary parts cancel exactly, which is a good sign the arithmetic is right.

**Worked example.** Solve x² − 2x + 3 = 0 and write the solutions in the form a + bi.

(x − 1)² = −3 + 1 = −2, so x − 1 = ±i√2 and x = 1 ± i√2. In the form a + bi: 1 + (√2)i and 1 − (√2)i.

**Try it.**
1. Solve x² + 6x + 13 = 0 by completing the square.
2. Solve 3x² + 6x + 15 = 0.
3. Check that x = 3 + 4i satisfies x² − 6x + 25 = 0.

*Answers:* 1. (x + 3)² = −4; x = −3 ± 2i. 2. Divide by 3: x² + 2x + 5 = 0, (x + 1)² = −4, x = −1 ± 2i. 3. x² = 9 + 24i + 16i² = −7 + 24i; −6x = −18 − 24i; −7 + 24i − 18 − 24i + 25 = 0 ✓.

## The quadratic formula with complex solutions (3.18)

x = (−b ± √(b² − 4ac)) / (2a) works exactly as before; when b² − 4ac is negative, write √(−n) as i√n and simplify.

**x² − 4x + 7 = 0.** a = 1, b = −4, c = 7. Discriminant 16 − 28 = −12. x = (4 ± √(−12))/2 = (4 ± 2i√3)/2 = 2 ± i√3.

**2x² + 2x + 5 = 0.** Discriminant 4 − 40 = −36. x = (−2 ± 6i)/4 = −1/2 ± (3/2)i.

**x² + 6x + 10 = 0.** Discriminant 36 − 40 = −4. x = (−6 ± 2i)/2 = −3 ± i.

**3x² − 2x + 1 = 0.** Discriminant 4 − 12 = −8. x = (2 ± 2i√2)/6 = 1/3 ± (√2/3)i.

**x² − x + 1 = 0.** Discriminant 1 − 4 = −3. x = (1 ± i√3)/2.

**Simplifying the fraction.** Divide every term in the numerator by the denominator: (4 ± 2i√3)/2 = 2 ± i√3, not 4 ± i√3 and not 2 ± 2i√3.

**A built-in check: sum and product.** The two solutions of ax² + bx + c = 0 add to −b/a and multiply to c/a. For x² − 4x + 7: (2 + i√3) + (2 − i√3) = 4 = −b/a ✓, and (2 + i√3)(2 − i√3) = 4 + 3 = 7 = c/a ✓.

**Worked example.** Solve 4x² + 4x + 5 = 0.

Discriminant 16 − 80 = −64. x = (−4 ± 8i)/8 = −1/2 ± i. Check the product: (−1/2 + i)(−1/2 − i) = 1/4 + 1 = 5/4 = c/a ✓.

**Try it.**
1. Solve x² + 2x + 6 = 0 with the formula.
2. Solve 2x² − 6x + 5 = 0.
3. Use sum and product to check that −3 ± i are the solutions of x² + 6x + 10 = 0.

*Answers:* 1. Discriminant 4 − 24 = −20; x = (−2 ± 2i√5)/2 = −1 ± i√5. 2. Discriminant 36 − 40 = −4; x = (6 ± 2i)/4 = 3/2 ± (1/2)i. 3. Sum −6 = −b/a ✓; product 9 + 1 = 10 = c/a ✓.

## Real or non-real? The discriminant (3.19)

You can predict the kind of solutions without solving by looking at the sign of b² − 4ac:

| b² − 4ac | Solutions | Graph of y = ax² + bx + c |
|---|---|---|
| positive | two different real solutions | crosses the x-axis twice |
| zero | one real solution (a double root) | touches the x-axis once |
| negative | two non-real solutions, a conjugate pair | never meets the x-axis |

| Equation | Discriminant | Kind |
|---|---|---|
| x² + 5x + 2 = 0 | 25 − 8 = 17 | two real (irrational) |
| x² − 6x + 9 = 0 | 36 − 36 = 0 | one real, x = 3 |
| 4x² − 12x + 9 = 0 | 144 − 144 = 0 | one real, x = 3/2 |
| x² + x + 1 = 0 | 1 − 4 = −3 | two non-real |
| 2x² − 3x + 4 = 0 | 9 − 32 = −23 | two non-real |
| x² − 2x + 5 = 0 | 4 − 20 = −16 | two non-real; the graph has no x-intercepts |

**Why non-real solutions come in conjugate pairs.** The formula gives (−b ± i√(4ac − b²))/(2a): the same real part −b/(2a) and opposite imaginary parts. So if 2 + 5i solves a quadratic with real coefficients, so does 2 − 5i. A real-coefficient quadratic can never have exactly one non-real solution.

**Building a quadratic from its solutions.** If the solutions are 3 ± i, then sum = 6 and product = 9 + 1 = 10, so the equation is x² − 6x + 10 = 0. (Equivalently (x − (3 + i))(x − (3 − i)) = (x − 3)² + 1.) For solutions 1 ± i√2: sum 2, product 1 + 2 = 3, equation x² − 2x + 3 = 0.

**Parameters.** For which k does x² + kx + 9 = 0 have exactly one real solution? k² − 36 = 0, so k = ±6. Two non-real solutions when k² < 36, that is −6 < k < 6; two real solutions when |k| > 6. For which c does x² + 4x + c = 0 have non-real solutions? 16 − 4c < 0, so c > 4.

**Worked example.** Without solving, describe the solutions of 5x² − 2x + 1 = 0 and the graph of y = 5x² − 2x + 1.

Discriminant 4 − 20 = −16 < 0: two non-real conjugate solutions. The parabola opens upward and never meets the x-axis, so it lies entirely above it.

**Try it.**
1. Classify the solutions of x² − 7x + 10 = 0, x² + 2x + 1 = 0 and x² + 2x + 2 = 0.
2. For which values of c does x² − 6x + c = 0 have two real solutions?
3. Write a quadratic equation with solutions 2 ± 3i.

*Answers:* 1. 49 − 40 = 9: two real (5 and 2); 4 − 4 = 0: one real (−1); 4 − 8 = −4: two non-real (−1 ± i). 2. 36 − 4c > 0, so c < 9. 3. Sum 4, product 4 + 9 = 13: x² − 4x + 13 = 0.

## Common mistakes

- **Stopping at "no real solution."** When the question allows complex numbers, continue: (x + 2)² = −9 gives x = −2 ± 3i.
- **Dividing only part of the numerator.** (4 ± 2i√3)/2 is 2 ± i√3; both terms are halved.
- **Writing √(−12) = −2√3.** It is 2i√3; the sign under the root becomes i.
- **Sign errors in the discriminant** when b is negative: (−4)² is +16.
- **Reading a negative discriminant as "no solutions."** There are two solutions; they are just not real, so the graph has no x-intercepts.

## Where this goes next

The unit exam covers weeks 11–15: exponent rules and rational exponents, radical equations and extraneous solutions, complex arithmetic, and quadratics with complex solutions. Unit 4 turns to exponential functions, where rational exponents reappear as fractional inputs and solving means undoing an exponent with a logarithm.

## Self-check

1. Solve x² + 8x + 25 = 0 by completing the square and check one solution.
2. Solve 2x² + 3x + 4 = 0 with the quadratic formula.
3. Classify the solutions of 9x² − 6x + 1 = 0 and of x² + 3x + 5 = 0 without solving.
4. Explain why a quadratic with real coefficients cannot have 4 + i as its only non-real solution.
5. Write a quadratic equation whose solutions are −2 ± i√5.

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Algebra 2, Unit 3, Lessons 17–19, https://im.kendallhunt.com/HS/teachers/3/3/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
