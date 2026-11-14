# Week 14 · Conjugates, Working Backwards and Solving Quadratics

**Lessons:** 3.14 More Arithmetic with Complex Numbers · 3.15 Working Backwards · 3.16 Solving Quadratics
**Practices:** MP7 (look for structure), MP1 (make sense of problems and persevere), MP6 (attend to precision)
**Built from:** IM Algebra 2, Unit 3, Lessons 14–16, in our own words
**Spiral:** Last week's multiplication rule (distribute, then i² = −1) is used constantly. Completing the square and factoring return from Algebra 1, and "undoing a square gives ±" (week 12) is exactly the step that produces two solutions. The remainder theorem and factored forms from Unit 2 appear in the review items.

## What you need to be able to do

- **3.14** Work fluently with products, powers and conjugates of complex numbers; know that z times its conjugate is a² + b²; use the conjugate to rewrite a quotient of complex numbers in the form a + bi.
- **3.15** Reverse the operations: find a complex number from information about its sum or product with another, find the two square roots of a complex number by solving a² − b² = p, 2ab = q, and check by multiplying.
- **3.16** Solve quadratic equations with real solutions by factoring, by undoing a square, and by completing the square; recognise when the completed-square form has a negative on the right, which is the case that needs complex numbers.

## Key terms

| Term | Meaning |
|---|---|
| Conjugate | The conjugate of a + bi is a − bi: same real part, opposite imaginary part. The conjugate of −2 + 5i is −2 − 5i. |
| Conjugate product | (a + bi)(a − bi) = a² + b², a nonnegative real number. |
| Square root of a complex number | A number whose square is the given number; every nonzero complex number has exactly two, and they are opposites. |
| Completing the square | Rewriting x² + bx + c as (x + b/2)² + (c − b²/4) so the equation can be solved by undoing the square. |
| Vertex form | y = a(x − h)² + k; the vertex is (h, k). |

## Conjugates, powers and quotients (3.14)

**Powers.** Build them up a step at a time, reducing i² each time.

- (1 + i)² = 2i, so (1 + i)⁴ = (2i)² = 4i² = −4.
- (2 + i)² = 3 + 4i, so (2 + i)³ = (3 + 4i)(2 + i) = 6 + 3i + 8i + 4i² = 2 + 11i.
- (2 + 3i)² = 4 + 12i + 9i² = −5 + 12i, and (2 − 3i)² = −5 − 12i. Their difference is 24i; their sum is −10.

**Conjugates.** The conjugate of z = a + bi is a − bi. Two facts make conjugates useful:

- z + (conjugate of z) = 2a, a real number.
- z · (conjugate of z) = a² − (bi)² = a² + b², a nonnegative real number. For 4 − 3i: 16 + 9 = 25. For 5 − 12i: 25 + 144 = 169.

**Quotients.** To write (4 + 2i)/(1 + i) in the form a + bi, multiply the top and bottom by the conjugate of the bottom, which turns the denominator into a real number:

(4 + 2i)/(1 + i) = (4 + 2i)(1 − i) / ((1 + i)(1 − i)) = (4 − 4i + 2i − 2i²)/(1 + 1) = (6 − 2i)/2 = 3 − i.

Check: (1 + i)(3 − i) = 3 − i + 3i − i² = 4 + 2i. ✓

Another: (3 + 2i)/(1 − i) = (3 + 2i)(1 + i)/2 = (3 + 3i + 2i + 2i²)/2 = (1 + 5i)/2 = 1/2 + (5/2)i.

A special case worth remembering: 1/i = −i, because i · (−i) = −i² = 1.

**Worked example.** Write (5 + 5i)/(1 + 2i) in the form a + bi.

Multiply by (1 − 2i)/(1 − 2i): numerator (5 + 5i)(1 − 2i) = 5 − 10i + 5i − 10i² = 15 − 5i; denominator 1 + 4 = 5. Result 3 − i. Check: (1 + 2i)(3 − i) = 3 − i + 6i − 2i² = 5 + 5i. ✓

**Try it.**
1. Write the conjugate of 7 + 2i and compute the conjugate product.
2. Compute (1 − i)⁴.
3. Write (5 + i)/(2 − i) in the form a + bi.

*Answers:* 1. 7 − 2i; 49 + 4 = 53. 2. (1 − i)² = −2i, so (1 − i)⁴ = (−2i)² = −4. 3. (5 + i)(2 + i)/5 = (10 + 5i + 2i + i²)/5 = (9 + 7i)/5 = 9/5 + (7/5)i.

## Working backwards (3.15)

Instead of computing a product, you are told the product and asked for a factor.

**Find z so that (2 + i)z = 5.** Divide: z = 5/(2 + i) = 5(2 − i)/5 = 2 − i. Check: (2 + i)(2 − i) = 4 + 1 = 5. ✓

**Find z so that z + (3 − i) = 7 + 2i.** Subtract: z = 4 + 3i.

**Find two complex numbers whose sum is 6 and whose product is 13.** A conjugate pair a ± bi has sum 2a and product a² + b², so a = 3 and 9 + b² = 13, b = 2. The numbers are 3 + 2i and 3 − 2i.

**Square roots of a complex number.** To find a + bi with (a + bi)² = 8 + 6i, expand: (a² − b²) + 2ab·i = 8 + 6i. Match parts:

- real parts: a² − b² = 8
- imaginary parts: 2ab = 6, so ab = 3

Try small whole-number pairs with product 3: (3, 1) gives 9 − 1 = 8 ✓. So 3 + i is a square root, and so is its opposite −3 − i (check: (−3 − i)² = 9 + 6i + i² = 8 + 6i ✓). Every nonzero complex number has exactly two square roots, opposites of each other, just as 9 has 3 and −3.

| Number | Square roots | Check |
|---|---|---|
| −16 | ±4i | (4i)² = 16i² = −16 |
| 2i | ±(1 + i) | (1 + i)² = 2i |
| −2i | ±(1 − i) | (1 − i)² = 1 − 2i + i² = −2i |
| 8 + 6i | ±(3 + i) | a² − b² = 8, ab = 3 |
| 21 − 20i | ±(5 − 2i) | 25 − 4 = 21, 2(5)(−2) = −20 |

**Worked example.** Find all k such that (3 + ki)(3 − ki) = 25.

The product is 9 + k², so k² = 16 and k = ±4.

**Try it.**
1. Find z with (1 + 2i)z = −3 + 4i.
2. Find both square roots of −5 + 12i.
3. Find two complex numbers with sum 4 and product 29.

*Answers:* 1. z = (−3 + 4i)(1 − 2i)/5 = (−3 + 6i + 4i − 8i²)/5 = (5 + 10i)/5 = 1 + 2i; check (1 + 2i)² = 1 + 4i − 4 = −3 + 4i ✓. 2. a² − b² = −5, ab = 6: (2, 3) gives 4 − 9 = −5 ✓, so ±(2 + 3i). 3. a = 2, 4 + b² = 29, b = 5: 2 ± 5i.

## Solving quadratics (3.16)

Three tools, all from Algebra 1, now sharpened:

**Factoring.** x² + 6x + 5 = (x + 1)(x + 5) = 0, so x = −1 or x = −5. Divide out a common factor first: 2x² + 4x − 6 = 0 becomes x² + 2x − 3 = (x + 3)(x − 1) = 0, so x = −3 or 1.

**Undoing a square.** x² − 4x = 12 does not factor nicely at first glance, but x² − 4x + 4 = 16 gives (x − 2)² = 16, so x − 2 = ±4 and x = 6 or x = −2. (It does factor: (x − 6)(x + 2).)

**Completing the square.** When the solutions are not rational, this is the reliable route. For x² − 8x + 3 = 0: half of −8 is −4, and (−4)² = 16, so

x² − 8x + 16 = −3 + 16, that is (x − 4)² = 13, so x = 4 ± √13 (about 7.61 and 0.39).

For x² + 10x + 7 = 0: (x + 5)² = −7 + 25 = 18, so x = −5 ± √18 = −5 ± 3√2.

**Vertex form from completing the square.** x² − 6x + 2 = (x − 3)² − 7. The graph of y = x² − 6x + 2 has vertex (3, −7), so its minimum value is −7, and it crosses the x-axis where (x − 3)² = 7, at x = 3 ± √7.

**Where complex numbers enter.** Complete the square on x² + 2x + 5 = 0: (x + 1)² = −4. Last week this was "no real solution." Now it has two: x + 1 = ±2i, so x = −1 ± 2i. Check x = −1 + 2i: x² = 1 − 4i + 4i² = −3 − 4i; 2x = −2 + 4i; so x² + 2x + 5 = −3 − 4i − 2 + 4i + 5 = 0. ✓ Next week does this systematically.

**Worked example.** Solve 3x² + 12x = 15.

Divide by 3: x² + 4x = 5, so x² + 4x − 5 = (x + 5)(x − 1) = 0, giving x = −5 or x = 1. By completing the square instead: (x + 2)² = 9, x + 2 = ±3, same answers.

**Try it.**
1. Solve x² − 2x − 15 = 0 by factoring.
2. Solve x² + 6x − 1 = 0 by completing the square.
3. Write y = x² + 8x + 3 in vertex form and give the vertex.

*Answers:* 1. (x − 5)(x + 3) = 0; x = 5 or −3. 2. (x + 3)² = 10; x = −3 ± √10. 3. (x + 4)² − 13; vertex (−4, −13).

## Common mistakes

- **Dividing by a complex number directly.** Always multiply numerator and denominator by the conjugate of the denominator first.
- **Taking the conjugate of the wrong part.** Only the imaginary part changes sign: the conjugate of −2 + 5i is −2 − 5i, not 2 − 5i.
- **Forgetting the second square root.** If 3 + i is a square root of 8 + 6i, so is −3 − i.
- **Adding (b/2)² to only one side** when completing the square. Whatever is added on the left must be added on the right.
- **Completing the square without a leading coefficient of 1.** Divide through first.

## Where this goes next

Next week completes the square and uses the quadratic formula on equations whose solutions are complex, then reads the discriminant b² − 4ac to predict whether a quadratic has two real, one real, or two non-real solutions. The unit exam follows.

## Self-check

1. Compute (2 − i)³.
2. Write (7 + i)/(3 + i) in the form a + bi and check by multiplying.
3. Find both square roots of 5 − 12i.
4. Find two complex numbers whose sum is 10 and whose product is 34.
5. Solve x² − 10x + 18 = 0 by completing the square.

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Algebra 2, Unit 3, Lessons 14–16, https://im.kendallhunt.com/HS/teachers/3/3/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
