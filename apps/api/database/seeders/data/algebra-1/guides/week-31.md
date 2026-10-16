# Week 31 · The Quadratic Formula

**Lessons:** 7.16 The Quadratic Formula · 7.17 Applying the Quadratic Formula (Part 1) · 7.18 Applying the Quadratic Formula (Part 2) · 7.19 Deriving the Quadratic Formula · 7.20 Rational and Irrational Solutions
**Practices:** MP6 (track every sign and the 2a), MP3 (find the flaw in a worked solution), MP7 (see the formula as completing the square in general), MP8 (predict the kind of solution from the discriminant)
**Built from:** IM Algebra 1, Unit 7, Lessons 16–20, in our own words
**Spiral:** Completing the square (week 30) is where the formula comes from; irrational solutions (week 30) are what it usually produces. Factoring (week 29) is the quick check when the discriminant is a perfect square. Substituting a value to check a solution (week 5) catches every kind of slip.

## What you need to be able to do

- **7.16** State the quadratic formula, read a, b and c from an equation in standard form, and use it to solve.
- **7.17** Apply the formula to equations that do and do not factor, after rearranging if needed, and decide when another method is quicker.
- **7.18** Recognise the common errors (denominator, sign of −b, b² with negative b, −4ac with negative c) and check solutions by substitution or graphing.
- **7.19** Explain how completing the square on ax² + bx + c = 0 produces the formula.
- **7.20** Use the discriminant b² − 4ac to tell whether solutions are rational, irrational, one or none, and say what rational and irrational mean.

## Key terms

| Term | Meaning |
|---|---|
| Quadratic formula | x = (−b ± √(b² − 4ac))/(2a), the solutions of ax² + bx + c = 0. |
| Discriminant | b² − 4ac, the expression under the root. |
| Rational number | A fraction of integers; its decimal ends or repeats. |
| Irrational number | Not rational; its decimal never ends or repeats (√2, √7, π). |

## The formula (7.16)

For any equation **ax² + bx + c = 0** with a ≠ 0,

**x = (−b ± √(b² − 4ac)) / (2a).**

Three things to get right every time: the equation must be in the form with 0 on one side; a, b and c carry their signs; and the **whole** numerator is divided by 2a.

**2x² − 5x − 3 = 0.** a = 2, b = −5, c = −3.
b² − 4ac = 25 − 4(2)(−3) = 25 + 24 = 49.
x = (5 ± 7)/4: x = 12/4 = 3 or x = −2/4 = −1/2.
Check by factoring: (2x + 1)(x − 3). Same answers.

**Worked example.** Solve 3x² + 5x − 2 = 0.
a = 3, b = 5, c = −2; discriminant 25 + 24 = 49; x = (−5 ± 7)/6 = 1/3 or −2.

**Try it.** Solve x² − 7x + 10 = 0 with the formula.
*Answer:* discriminant 49 − 40 = 9; x = (7 ± 3)/2 = 5 or 2.

## Applying it (7.17)

The formula shines when factoring fails.

**x² + 6x + 4 = 0.** Discriminant 36 − 16 = 20. x = (−6 ± √20)/2 ≈ (−6 ± 4.47)/2: about −0.76 and −5.24. (Since √20 = 2√5, this is also −3 ± √5; either form is exact.)

**x² = 3x + 5.** Rearrange first: x² − 3x − 5 = 0, so a = 1, b = −3, c = −5. Discriminant 9 + 20 = 29. x = (3 ± √29)/2 ≈ 4.19 or −1.19.

**A negative a.** −16t² + 40t + 6 = 0 (a thrown ball landing). Use a = −16, b = 40, c = 6 as they are: discriminant 1,600 + 384 = 1,984, √1,984 ≈ 44.54, t = (−40 ± 44.54)/(−32) ≈ −0.14 or 2.64. The landing is at 2.64 s. Multiplying the equation by −1 first gives the same two times.

**Which method?** A square already isolated: take roots. An obvious factor pair: factor. Otherwise, complete the square or use the formula; the formula always works and is fastest once it is memorised.

**Worked example.** Solve 2x² + 3x − 9 = 0.
Discriminant 9 + 72 = 81; x = (−3 ± 9)/4 = 1.5 or −3.

**Try it.** Solve x² − 2x − 2 = 0 exactly and approximately.
*Answer:* x = (2 ± √12)/2 ≈ 2.73 or −0.73 (exactly 1 ± √3).

## Using it with care (7.18)

The formula has many parts, and most wrong answers come from four slips.

| Slip | Example | Fix |
|---|---|---|
| Dividing by 2 instead of 2a | 2x² − 5x − 3: (5 ± 7)/2 = 6, −1 | Denominator 4: 3, −1/2 |
| Wrong sign of −b | b = −5 written as −5 in the numerator | −b = 5 |
| b² negative | (−5)² written as −25 | Squares are positive: 25 |
| −4ac with negative c | x² − 4x − 5: 16 − 20 | −4(1)(−5) = +20: 16 + 20 = 36 |

A fifth: splitting the root, √(16 + 20) as √16 + √20. Add first, then take the root: √36 = 6.

**Checking.** Substitute into the **original** equation (not the factored one, which may carry the same error). x = 5 in x² − 4x − 5: 25 − 20 − 5 = 0 ✓. A rounded decimal gives a result close to 0, not exactly: h(2.64) = −16(6.97) + 105.6 + 6 ≈ 0.1. Graphing is a quick second check: the x-intercepts should match.

**Worked example.** A student solving x² − 4x − 5 = 0 writes (4 ± √(16 − 20))/2 and says "no solutions". Find the error.
−4ac = −4(1)(−5) = +20. The discriminant is 36 and the solutions are 5 and −1.

**Try it.** Find the error: for 2x² + 3x − 9 = 0 a student gets x = (−3 ± 9)/2 = 3 or −6.
*Answer:* the denominator is 2a = 4, giving 1.5 and −3.

## Where the formula comes from (7.19)

Complete the square on the general equation.

1. ax² + bx + c = 0. Divide by a: x² + (b/a)x + c/a = 0.
2. Move the constant: x² + (b/a)x = −c/a.
3. Half of b/a is b/(2a); add its square, b²/(4a²), to both sides:
   (x + b/(2a))² = b²/(4a²) − c/a = (b² − 4ac)/(4a²).
4. Take roots: x + b/(2a) = ±√(b² − 4ac)/(2a).
5. Solve: x = (−b ± √(b² − 4ac))/(2a).

Every piece of the formula is visible: 2a is the denominator because half of b/a is b/(2a) and because √(4a²) = 2a; b² − 4ac appears when the fractions on the right are combined. Try the same steps on x² + 6x − 7 = 0 and you get (x + 3)² = 16, exactly week 30's method.

## Rational and irrational solutions (7.20)

A **rational** number can be written as a fraction of integers: 3, −1/2, 0.75, 0.333… An **irrational** number cannot: √2, √7, √20, π; their decimals never end or repeat. √49 = 7 is rational; a square root is irrational exactly when the number under it is not a perfect square.

The **discriminant** b² − 4ac decides the solutions before you finish:

| b² − 4ac | Solutions |
|---|---|
| negative | none (no real square root) |
| zero | exactly one (the ± adds and subtracts 0) |
| positive perfect square | two rational solutions |
| positive, not a perfect square | two irrational solutions |

(The rational/irrational rows assume a, b, c are integers.)

- 2x² − 5x − 3 = 0: 49, two rational (3 and −1/2).
- x² − 6x + 7 = 0: 36 − 28 = 8, two irrational, (6 ± √8)/2 = 3 ± √2 ≈ 4.41, 1.59.
- x² + 4x + 4 = 0: 16 − 16 = 0, one solution, x = −2.
- 3x² + 2x + 5 = 0: 4 − 60 = −56, none; the graph of y = 3x² + 2x + 5 stays above the axis.
- x² − 2x − 4 = 0: 4 + 16 = 20, two irrational, 1 ± √5.

**Worked example.** Without solving, describe the solutions of x² − 2x − 3 = 0 and x² + x + 1 = 0.
Discriminants 4 + 12 = 16 (two rational, 3 and −1) and 1 − 4 = −3 (none).

**Try it.** Classify the solutions of 2x² − 7x + 3 = 0 and x² − 5x + 5 = 0.
*Answers:* 49 − 24 = 25, two rational (3 and 1/2); 25 − 20 = 5, two irrational.

## Common mistakes

- Reading a, b, c before the equation is in the form ax² + bx + c = 0.
- Dividing only the root by 2a.
- Treating b² as negative when b is negative, or −4ac as negative when c is negative.
- Splitting √(b² − 4ac) into two roots.
- Expecting a rounded solution to check exactly.
- Calling a solution irrational because it has a square root, when the root is of a perfect square.

## Where this goes next

Week 32 finishes the course: sums and products of rational and irrational numbers, rewriting any quadratic function in vertex form by completing the square, using the vertex to answer maximum and minimum questions, and full modelling problems that combine everything, including where a line meets a parabola. Then the unit 7 exam and the final.

## Self-check

1. Solve 2x² + 7x + 3 = 0 with the formula.
2. Solve x² = 6x − 4 exactly.
3. Find the error: for x² − 2x − 8 = 0 a student writes x = (2 ± √(4 − 32))/2.
4. Compute the discriminant of 4x² − 12x + 9 = 0 and describe the solutions.
5. Is (6 ± √8)/2 rational or irrational? Why?

*Answers:* (1) Discriminant 49 − 24 = 25; x = (−7 ± 5)/4 = −1/2 or −3. (2) x² − 6x + 4 = 0; x = (6 ± √20)/2 ≈ 5.24 or 0.76 (3 ± √5). (3) −4ac = −4(1)(−8) = +32: the discriminant is 36 and x = 4 or −2. (4) 144 − 144 = 0: one solution, x = 3/2. (5) Irrational, because 8 is not a perfect square, so √8 is irrational and adding 6 and halving keeps it irrational.

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Algebra 1, Unit 7, Lessons 16–20, https://im.kendallhunt.com/HS/teachers/1/7/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
