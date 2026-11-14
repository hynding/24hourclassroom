# Week 13 · A New Kind of Number: Introducing i

**Lessons:** 3.10 A New Kind of Number · 3.11 Introducing the Number i · 3.12 Arithmetic with Complex Numbers · 3.13 Multiplying Complex Numbers
**Practices:** MP7 (look for structure), MP3 (construct arguments), MP8 (regularity in repeated reasoning)
**Built from:** IM Algebra 2, Unit 3, Lessons 10–13, in our own words
**Spiral:** Week 11 established that √a is one nonnegative number and that no real number squares to a negative. Week 12 left x² = −9 with no solution. Multiplying complex numbers is the same distributive routine as multiplying binomials (week 4), with one extra rule: i² = −1.

## What you need to be able to do

- **3.10** Describe how the number system has been extended before (negatives, fractions, irrationals) so that equations such as x + 5 = 2, 3x = 2 and x² = 2 gained solutions, and explain why x² = −1 calls for one more extension.
- **3.11** Define i by i² = −1, write square roots of negative numbers using i (√(−9) = 3i), simplify powers of i, and plot complex numbers a + bi in the complex plane.
- **3.12** Add, subtract and scale complex numbers by combining real parts with real parts and imaginary parts with imaginary parts, and interpret the result in the complex plane.
- **3.13** Multiply complex numbers by distributing and replacing i² with −1, and verify that a complex number is a solution of a quadratic equation.

## Key terms

| Term | Meaning |
|---|---|
| i | A number defined by i² = −1. It is not a real number. |
| Imaginary number | A real multiple of i, such as 3i, −½i or i√2. Its square is a negative real number. |
| Complex number | A number of the form a + bi with a and b real. 3 + 4i, −2i and 7 are all complex. |
| Real part, imaginary part | In a + bi, the real part is a and the imaginary part is b (the coefficient of i, a real number). For 7 − 3i they are 7 and −3. |
| Complex plane | A coordinate plane whose horizontal axis is the real axis and whose vertical axis is the imaginary axis; a + bi is plotted at (a, b). |
| Powers of i | i¹ = i, i² = −1, i³ = −i, i⁴ = 1, then the cycle repeats every four. |

## Why invent a new number? (3.10)

Every time an equation had no solution in the numbers we had, mathematicians extended the number system and kept every old rule working:

| Equation | Fails in | Fixed by inventing |
|---|---|---|
| x + 5 = 2 | whole numbers | negative numbers (x = −3) |
| 3x = 2 | integers | fractions (x = 2/3) |
| x² = 2 | fractions | irrational numbers (x = ±√2) |
| x² = −1 | real numbers | ? |

The real numbers fill the whole number line, and every real number has a nonnegative square. So x² = −1 cannot be solved by any point on the line. The fix is to step *off* the line: we introduce a number i with the single defining property **i² = −1**, and insist that all the usual rules of arithmetic still hold. Everything else about complex numbers follows from that one decision.

**Worked example.** Which of these equations has a real solution: x² = 16, x² = 0, x² = −16?

x² = 16 has two (±4), x² = 0 has one (0), and x² = −16 has none, because a real square is never negative. With i, the last one gains the solutions ±4i, since (4i)² = 16i² = −16.

**Try it.**
1. For each equation, say which number system is the smallest that contains a solution: x + 8 = 3, 5x = 1, x² = 7, x² + 4 = 0.

*Answers:* 1. Integers (x = −5); rational numbers (x = 1/5); real numbers (x = ±√7); complex numbers (x = ±2i).

## The number i and the complex plane (3.11)

**Square roots of negatives.** Since (3i)² = 9i² = −9, we write √(−9) = 3i. In general √(−a) = i√a for a > 0: √(−49) = 7i, √(−2) = i√2, √(−12) = i√12 = 2i√3.

**Powers of i.** Multiplying by i again and again cycles through four values:

i¹ = i, i² = −1, i³ = i² · i = −i, i⁴ = (i²)² = 1, i⁵ = i, i⁶ = −1, …

To find a high power, divide the exponent by 4 and keep the remainder: i³⁸ has remainder 2 (38 = 9 · 4 + 2), so i³⁸ = i² = −1. i⁴⁵ has remainder 1, so i⁴⁵ = i. i¹⁰⁰ has remainder 0, so i¹⁰⁰ = 1. i²³ has remainder 3, so i²³ = −i.

**Complex numbers.** A number of the form a + bi, with a and b real, is a **complex number**. The real numbers are the complex numbers with b = 0; the imaginary numbers are those with a = 0. So 5 = 5 + 0i and −2i = 0 − 2i are both complex. Note that the imaginary *part* of 7 − 3i is the real number −3, not −3i.

**The complex plane.** Plot a + bi at the point (a, b): real part across, imaginary part up. So 3 + 4i sits 3 right and 4 up; 2 − 5i sits 2 right and 5 down; −4 is on the real axis 4 to the left; 3i is on the imaginary axis 3 up.

**Worked example.** Simplify √(−50) and write it in the form bi.

√(−50) = i√50 = i · √(25 · 2) = 5i√2, usually written 5√2 i or (5√2)i.

**Try it.**
1. Simplify i¹⁷, i³⁰ and i⁶⁴.
2. Write √(−81) and √(−18) using i.
3. Give the coordinates of the points for −1 + 2i, 6, and −3i.

*Answers:* 1. i (remainder 1), −1 (remainder 2), 1 (remainder 0). 2. 9i; 3i√2. 3. (−1, 2); (6, 0); (0, −3).

## Adding, subtracting and scaling (3.12)

Treat i like a variable when adding: combine the real parts, combine the imaginary parts.

- (3 + 4i) + (2 − 7i) = 5 − 3i
- (5 − 2i) − (−3 + 6i) = 5 − 2i + 3 − 6i = 8 − 8i
- 3(2 + i) − 2(1 − 4i) = 6 + 3i − 2 + 8i = 4 + 11i
- (1 + i) + (1 − i) = 2, a real number: imaginary parts can cancel.

In the complex plane, adding w to z shifts the point z by the real part of w horizontally and the imaginary part vertically, exactly as adding vectors. Multiplying by a positive real number k scales the point away from the origin by a factor of k; multiplying by −1 reflects it through the origin.

**Multiplying by i.** i · (a + bi) = ai + bi² = −b + ai. The point (a, b) moves to (−b, a): a quarter turn counterclockwise about the origin. Doing it twice gives i² · z = −z, a half turn, which is one way to see why i² = −1 makes sense geometrically. For example i(4 − 3i) = 4i − 3i² = 3 + 4i.

**Worked example.** Let z = 3 + 2i and w = 1 − 4i. Find z + w, z − w and 2z + 3w.

z + w = 4 − 2i. z − w = 3 + 2i − 1 + 4i = 2 + 6i. 2z + 3w = 6 + 4i + 3 − 12i = 9 − 8i.

**Try it.**
1. (7 − 3i) − (2 + 5i)
2. −2(3 + i) + 4(1 − i)
3. Where does multiplying 2 + 5i by i send it?

*Answers:* 1. 5 − 8i. 2. −6 − 2i + 4 − 4i = −2 − 6i. 3. i(2 + 5i) = 2i + 5i² = −5 + 2i, the point (−5, 2).

## Multiplying complex numbers (3.13)

Multiply the way you multiply two binomials, then replace every i² with −1 and collect.

**(2 + 3i)(4 − i)** = 8 − 2i + 12i − 3i² = 8 + 10i − 3(−1) = **11 + 10i**.

**(1 + 2i)(3 + 4i)** = 3 + 4i + 6i + 8i² = 3 + 10i − 8 = **−5 + 10i**.

**(3 − i)²** = 9 − 6i + i² = **8 − 6i**.

**(2 − 5i)²** = 4 − 20i + 25i² = **−21 − 20i**.

**(1 + i)²** = 1 + 2i + i² = **2i**. So 1 + i is a square root of 2i.

**(3i)(−5i)** = −15i² = **15**. Two imaginary numbers can multiply to a real number.

**A product that is always real.** (a + bi)(a − bi) = a² − (bi)² = a² − b²i² = a² + b². For example (3 + 4i)(3 − 4i) = 9 + 16 = 25, and (2 + 3i)(2 − 3i) = 4 + 9 = 13. Next week this pair, called conjugates, is the key to division.

**Checking a solution.** Is x = 2i a solution of x² + 4 = 0? (2i)² + 4 = 4i² + 4 = −4 + 4 = 0. Yes. Is x = 1 + i a solution of x² − 2x + 2 = 0? (1 + i)² = 2i, and −2(1 + i) = −2 − 2i, so 2i − 2 − 2i + 2 = 0. Yes.

**Worked example.** Compute (1 + i)³.

(1 + i)³ = (1 + i)²(1 + i) = 2i(1 + i) = 2i + 2i² = −2 + 2i.

**Worked example.** Show that x = −3i is a solution of x² = −9.

(−3i)² = 9i² = −9. So both 3i and −3i are solutions, just as x² = 9 has two real solutions.

**Try it.**
1. (4 + i)(4 − i)
2. (2 + i)²
3. (−2 + 3i)(1 + i)
4. Verify that 1 − i also satisfies x² − 2x + 2 = 0.

*Answers:* 1. 16 + 1 = 17. 2. 4 + 4i + i² = 3 + 4i. 3. −2 − 2i + 3i + 3i² = −5 + i. 4. (1 − i)² = −2i; −2(1 − i) = −2 + 2i; −2i − 2 + 2i + 2 = 0.

## Common mistakes

- **Forgetting that i² = −1.** Leaving i² in an answer, or treating it as 1, is the most common slip. 8 − 3i² is 11, not 5.
- **Reporting the imaginary part with the i attached.** The imaginary part of 7 − 3i is −3.
- **Writing √(−9) = −3.** It is 3i; the negative sign under the root becomes i, not a minus sign.
- **Mishandling powers of i.** i³ = −i, not −1; use the cycle of four.
- **Splitting a square root wrongly.** √(−4) · √(−9) = (2i)(3i) = 6i² = −6, not √36 = 6. Convert to i before multiplying.

## Where this goes next

Next week introduces the conjugate a − bi and uses it to divide complex numbers, then works backwards from a product to its factors. Week 15 finishes the unit: completing the square and the quadratic formula now produce complex solutions, and the discriminant tells you whether a quadratic's solutions are real or not.

## Self-check

1. Explain why x² = −25 has no real solution and give both of its complex solutions.
2. Simplify i⁵⁴ and i¹⁰¹.
3. Compute (5 − 2i) − 3(1 + 2i).
4. Compute (3 + 2i)(3 − 2i) and (3 + 2i)².
5. Verify that x = 2 + i is a solution of x² − 4x + 5 = 0.

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Algebra 2, Unit 3, Lessons 10–13, https://im.kendallhunt.com/HS/teachers/3/3/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
