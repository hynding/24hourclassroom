# Week 30 · Completing the Square

**Lessons:** 7.11 What are Perfect Squares? · 7.12 Completing the Square (Part 1) · 7.13 Completing the Square (Part 2) · 7.14 Completing the Square (Part 3) · 7.15 Quadratic Equations with Irrational Solutions
**Practices:** MP7 (see x² + bx as an incomplete square), MP6 (keep both roots, keep both sides balanced, write exact answers), MP8 (notice that the same steps work for every equation)
**Built from:** IM Algebra 1, Unit 7, Lessons 11–15, in our own words
**Spiral:** The perfect square trinomial (week 29) is the pattern completing the square creates on purpose. Solving by reasoning about squares (week 28) finishes every problem here. The vertex form (week 27) is what completing the square produces when it is applied to a function instead of an equation.

## What you need to be able to do

- **7.11** Recognise a perfect square trinomial, write it as (x + k)², and solve an equation whose one side is a perfect square.
- **7.12** Find the constant that completes a square, and rewrite x² + bx + c as (x + k)² + m.
- **7.13** Solve x² + bx + c = 0 by completing the square, including when b is odd.
- **7.14** Solve ax² + bx + c = 0 with a ≠ 1 by dividing through first.
- **7.15** Write irrational solutions exactly with ± and a square root, approximate them, and check them.

## Key terms

| Term | Meaning |
|---|---|
| Perfect square trinomial | x² + 2kx + k², equal to (x + k)². |
| Completing the square | Adding (b/2)² to x² + bx so that it becomes (x + b/2)². |
| Irrational number | A number that cannot be written as a fraction of integers; √7 and 2 + √7 are irrational. |
| ± | "Plus or minus": a ± √k names the two numbers a + √k and a − √k. |

## Perfect squares (7.11)

(x + k)² = x² + 2kx + k². The middle coefficient is twice k, and the constant is k². So to test whether a trinomial is a perfect square, halve the coefficient of x and square it:

- x² − 14x + 49: half of −14 is −7, (−7)² = 49 ✓. It is (x − 7)².
- x² + 16x + 64: half of 16 is 8, 8² = 64 ✓. (x + 8)².
- x² + 4x + 16: half of 4 is 2, 2² = 4 ≠ 16 ✗.

Why care? An equation whose one side is a perfect square is solved by taking square roots. x² + 10x + 25 = 49 is (x + 5)² = 49, so x + 5 = ±7 and x = 2 or x = −12. No factoring needed, and it works even when the right side is not a perfect square.

**Worked example.** Solve x² − 14x + 49 = 36.
(x − 7)² = 36; x − 7 = ±6; x = 13 or x = 1.

**Try it.** Write x² − 20x + 100 as a square, and solve x² − 20x + 100 = 9.
*Answers:* (x − 10)²; x − 10 = ±3, x = 13 or x = 7.

## Completing the square (7.12)

Most trinomials are not perfect squares, but x² + bx can always be made into one by adding **(b/2)²**.

x² + 8x + ___: half of 8 is 4, 4² = 16. x² + 8x + 16 = (x + 4)².

To rewrite an expression without changing its value, add the constant and subtract it again:

x² + 8x + 3 = x² + 8x + 16 − 16 + 3 = (x + 4)² − 13.
x² − 10x + 7 = x² − 10x + 25 − 25 + 7 = (x − 5)² − 18.

This is exactly the vertex form from week 27: y = x² − 10x + 7 has vertex (5, −18).

In an equation, whatever is added to one side is added to the other: x² + 6x = 7 becomes x² + 6x + 9 = 7 + 9.

**Worked example.** Write x² + 12x − 4 in the form (x + k)² + m.
Half of 12 is 6, 6² = 36: (x + 6)² − 36 − 4 = (x + 6)² − 40.

**Try it.** Complete the square: x² − 4x + ___. Then write x² − 4x + 1 as (x − k)² + m.
*Answers:* 4; (x − 2)² − 3.

## Solving by completing the square (7.13)

1. Move the constant to the right side.
2. Add (b/2)² to both sides.
3. Write the left side as a square.
4. Take both square roots.
5. Solve for x and check.

**x² + 6x − 7 = 0.** x² + 6x = 7. Add 9: (x + 3)² = 16. x + 3 = ±4. x = 1 or x = −7. (Factoring gives (x + 7)(x − 1); same answers.)

**x² − 6x + 5 = 0.** x² − 6x = −5. Add 9: (x − 3)² = 4. x − 3 = ±2. x = 5 or x = 1.

**An odd b.** x² + 3x − 10 = 0. x² + 3x = 10. Half of 3 is 3/2, and (3/2)² = 9/4. Add 9/4: (x + 3/2)² = 10 + 9/4 = 49/4. x + 3/2 = ±7/2. x = 2 or x = −5. Keep the fractions; decimals like 1.5 are fine too as long as 1.5² = 2.25 is used, not 1.5.

**Worked example.** Solve x² + 10x + 16 = 0.
x² + 10x = −16; add 25: (x + 5)² = 9; x + 5 = ±3; x = −2 or x = −8.

**Try it.** Solve x² − 8x + 12 = 0 and x² + 5x + 6 = 0 by completing the square.
*Answers:* (x − 4)² = 4, x = 6 or 2; (x + 5/2)² = 1/4, x = −2 or −3.

## When the leading coefficient is not 1 (7.14)

Divide every term by a first, so the x² coefficient becomes 1.

**2x² + 12x + 10 = 0.** Divide by 2: x² + 6x + 5 = 0. x² + 6x = −5. Add 9: (x + 3)² = 4. x = −1 or x = −5.

**3x² − 6x − 24 = 0.** Divide by 3: x² − 2x − 8 = 0. x² − 2x = 8. Add 1: (x − 1)² = 9. x = 4 or x = −2.

**When a does not divide evenly.** 2x² + 3x − 2 = 0 becomes x² + (3/2)x − 1 = 0. x² + (3/2)x = 1. Half of 3/2 is 3/4, (3/4)² = 9/16. (x + 3/4)² = 1 + 9/16 = 25/16. x + 3/4 = ±5/4. x = 1/2 or x = −2. Fractions are part of the method, not a sign of a mistake.

**Worked example.** Solve 2x² − 8x − 6 = 0.
x² − 4x − 3 = 0; x² − 4x = 3; add 4: (x − 2)² = 7; x = 2 ± √7.

**Try it.** Solve 5x² + 20x + 15 = 0.
*Answer:* x² + 4x + 3 = 0; (x + 2)² = 1; x = −1 or x = −3.

## Irrational solutions (7.15)

That last worked example ended with (x − 2)² = 7. Seven is not a perfect square, so the square roots of 7 are not whole numbers or fractions: √7 ≈ 2.6458, an **irrational** number whose decimal never ends or repeats. The exact solutions are

x = 2 + √7 and x = 2 − √7, written together as **x = 2 ± √7**.

Approximately, 4.65 and −0.65. Give the exact form unless a decimal is asked for; a decimal is a rounded stand-in.

These are also the solutions of x² − 4x − 3 = 0, the equation that would not factor in week 29. Completing the square works where factoring does not.

**Checking.** Substitute x = 2 + √7 into x² − 4x − 3: (2 + √7)² = 4 + 4√7 + 7 = 11 + 4√7; 4(2 + √7) = 8 + 4√7; so 11 + 4√7 − 8 − 4√7 − 3 = 0 ✓. Or check the decimal: 4.65² − 4(4.65) − 3 ≈ 21.62 − 18.6 − 3 ≈ 0.02, close to 0 because 4.65 is rounded.

**Worked example.** Solve x² + 2x − 1 = 0.
x² + 2x = 1; add 1: (x + 1)² = 2; x = −1 ± √2, about 0.41 and −2.41.

**The pool.** A pool 4 m longer than it is wide with area 50 m²: w² + 4w − 50 = 0. No integer pair has product −50 and sum 4. Complete the square: (w + 2)² = 54, w = −2 ± √54. The width is −2 + √54 ≈ 5.35 m, the length about 9.35 m, and 5.35 × 9.35 ≈ 50 ✓.

**Try it.** Solve x² − 10x + 20 = 0 exactly and approximately.
*Answer:* (x − 5)² = 5, x = 5 ± √5, about 7.24 and 2.76.

## Common mistakes

- Adding (b/2)² to one side of an equation only.
- Using b/2 instead of (b/2)² as the constant.
- Dropping the negative square root.
- Dividing only some of the terms by a.
- Writing √54 as 27, or 2 ± √7 as ±√7 + 2 computed as one number.
- Rounding too early and then reporting a "solution" that does not check.

## Where this goes next

Week 31 completes the square on the general equation ax² + bx + c = 0 once and for all; the result is the quadratic formula. It also uses b² − 4ac to predict whether the solutions are rational, irrational, one or none.

## Self-check

1. Is x² + 18x + 81 a perfect square? If so, of what?
2. Write x² + 6x − 2 in the form (x + k)² + m.
3. Solve x² − 2x − 15 = 0 by completing the square.
4. Solve 4x² + 8x − 12 = 0.
5. Solve x² + 4x − 1 = 0 exactly.

*Answers:* (1) Yes, (x + 9)². (2) (x + 3)² − 11. (3) (x − 1)² = 16, x = 5 or x = −3. (4) x² + 2x − 3 = 0, (x + 1)² = 4, x = 1 or x = −3. (5) (x + 2)² = 5, x = −2 ± √5.

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Algebra 1, Unit 7, Lessons 11–15, https://im.kendallhunt.com/HS/teachers/1/7/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
