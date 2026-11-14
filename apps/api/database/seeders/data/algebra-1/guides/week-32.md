# Week 32 · Vertex Form Revisited and Modeling with Quadratics

**Lessons:** 7.21 Sums and Products of Rational and Irrational Numbers · 7.22 Rewriting Quadratic Expressions in Vertex Form · 7.23 Using Quadratic Expressions in Vertex Form to Solve Problems · 7.24 Using Quadratic Equations to Model Situations and Solve Problems
**Practices:** MP3 (argue by contradiction about irrational numbers), MP7 (choose the form of an expression that answers the question), MP4 (model a flight or a business and interpret every number), MP1 (combine several methods in one problem)
**Built from:** IM Algebra 1, Unit 7, Lessons 21–24, in our own words
**Spiral:** Completing the square (week 30) now rewrites functions, not just equations, and reproduces the vertex form of week 27. The discriminant (week 31) classifies the solutions whose rational or irrational nature this week studies. Every modelling question uses the three forms of unit 6 and the solving methods of unit 7 together.

## What you need to be able to do

- **7.21** Say what happens when rational and irrational numbers are added or multiplied, and give the reasons: rational + rational and rational × rational are rational; rational + irrational and non-zero rational × irrational are irrational; irrational with irrational can go either way.
- **7.22** Rewrite any quadratic function in vertex form by completing the square, including when the leading coefficient is not 1, and check by expanding.
- **7.23** Use the vertex to find and interpret a maximum or minimum: best price, least cost, highest point.
- **7.24** Work a full modelling problem, choosing the form or method that answers each question, and find where a line meets a parabola by solving f(x) = g(x).

## Key terms

| Term | Meaning |
|---|---|
| Closed under addition | The sum of any two numbers of the kind is again of that kind (true for rational numbers). |
| Proof by contradiction | Suppose the opposite, reach something impossible, conclude the original claim. |
| Vertex form | a(x − h)² + k; vertex (h, k); k is the maximum (a < 0) or minimum (a > 0). |
| Intersection | A point on two graphs at once; its x-coordinate solves f(x) = g(x). |

## Sums and products of rational and irrational numbers (7.21)

**Rational with rational.** a/b + c/d = (ad + bc)/(bd) and (a/b)(c/d) = ac/(bd): both are fractions of integers with non-zero denominators, so the sum and product of two rational numbers are rational. 2/3 + 1/4 = 11/12; (2/3)(1/4) = 1/6.

**Rational with irrational.** Suppose 5 + √3 were rational. Then √3 = (5 + √3) − 5 would be a difference of two rational numbers, hence rational. But √3 is irrational. So 5 + √3 is irrational. The same argument shows 2√7 is irrational: if it were rational, dividing by 2 would make √7 rational. (The rational factor must be non-zero: 0 · √7 = 0 is rational.)

**Irrational with irrational.** No rule. √2 + (−√2) = 0 and √2 · √8 = √16 = 4 are rational; √2 + √3 and √2 · √3 = √6 are irrational. Check the actual numbers.

**Back to equations.** In 4x² + bx + 9 = 0 the discriminant is b² − 144. b = ±12 gives one solution (the expression is (2x ± 3)²); |b| < 12 gives none; |b| > 12 gives two, rational when b² − 144 is a perfect square (b = 13 gives 25, b = 15 gives 81, b = 20 gives 256) and irrational otherwise (b = 14 gives 52).

**Worked example.** Is (1/2)√8 rational?
No: 1/2 is a non-zero rational and √8 is irrational, so the product is irrational (it equals √2).

**Try it.** Classify π + 1, √9, 2 − √3 and (√5)².
*Answers:* irrational; rational (3); irrational; rational (5).

## Vertex form by completing the square (7.22)

Week 27 read the vertex from a(x − h)² + k. Week 30 completed the square to solve equations. Put them together: completing the square turns any standard form into vertex form.

**Leading coefficient 1.** x² − 6x + 2 = x² − 6x + 9 − 9 + 2 = (x − 3)² − 7. Vertex (3, −7).

**Leading coefficient not 1.** Factor a out of the x² and x terms only; do **not** divide (this is a function, not an equation equal to 0, and dividing would change its values).

2x² + 8x + 1 = 2(x² + 4x) + 1 = 2(x² + 4x + 4 − 4) + 1 = 2(x + 2)² − 8 + 1 = 2(x + 2)² − 7. Vertex (−2, −7). The −4 inside is multiplied by the 2 outside.

−x² + 4x + 1 = −(x² − 4x) + 1 = −(x² − 4x + 4 − 4) + 1 = −(x − 2)² + 4 + 1 = −(x − 2)² + 5. Vertex (2, 5), a maximum.

**Check by expanding.** 2(x + 2)² − 7 = 2x² + 8x + 8 − 7 = 2x² + 8x + 1 ✓. The y-intercept is a quick second check: both forms give 1 at x = 0.

**Or average the zeros.** When the expression factors, the vertex's x-coordinate is the midpoint of the zeros: x² − 8x + 12 = (x − 2)(x − 6), vertex at x = 4, value 16 − 32 + 12 = −4. Completing the square gives (x − 4)² − 4. Same.

**Worked example.** Write f(x) = x² − 8x + 10 in vertex form and find its zeros.
(x − 4)² − 16 + 10 = (x − 4)² − 6; minimum −6 at x = 4; zeros where (x − 4)² = 6, x = 4 ± √6 ≈ 6.45 and 1.55.

**Try it.** Write 3x² − 12x + 5 in vertex form.
*Answer:* 3(x² − 4x) + 5 = 3(x − 2)² − 12 + 5 = 3(x − 2)² − 7.

## Maximum and minimum problems (7.23)

The vertex answers "what is the most?" and "what is the least?"

**Revenue.** R(p) = −4p² + 80p. −4(p² − 20p) = −4(p − 10)² + 400. Best price $10, revenue $400. (Zeros 0 and 20 average to 10 as well.)

**Cost.** C(x) = x² − 12x + 50 = (x − 6)² + 14. Least cost 14, at x = 6.

**Height.** h(t) = −16t² + 64t + 20 = −16(t² − 4t) + 20 = −16(t − 2)² + 64 + 20 = −16(t − 2)² + 84. Peak 84 feet at t = 2 s.

**A function with no context.** f(x) = −2x² + 12x − 7 = −2(x − 3)² + 18 − 7 = −2(x − 3)² + 11. Maximum 11 at x = 3.

**Worked example.** A garden fence of 40 m encloses a rectangle of width w against a wall (three sides fenced): the area is A(w) = w(40 − 2w) = −2w² + 40w. Find the largest area.
−2(w² − 20w) = −2(w − 10)² + 200. Largest area 200 m², at w = 10 (and length 20).

**Try it.** Find the minimum of g(x) = x² + 6x + 1 and where it occurs.
*Answer:* (x + 3)² − 8; minimum −8 at x = −3.

## Putting it all together (7.24)

A model h(t) = −16t² + 64t + 20 answers several questions, each with its own form or method.

| Question | Use |
|---|---|
| Starting height? | h(0) = 20, the constant in standard form. |
| Highest point and when? | Vertex form: 84 feet at t = 2. |
| When does it land? | Zeros: −16t² + 64t + 20 = 0. Divide by −4: 4t² − 16t − 5 = 0; t = (16 ± √336)/8 ≈ 4.29 s. |
| When is it 20 feet up again? | h(t) = 20: −16t² + 64t = 0, t(−16t + 64) = 0, t = 4. |
| Domain? | 0 ≤ t ≤ 4.29. |

**Where a line meets a parabola.** Two graphs intersect where their outputs agree, so set the expressions equal and solve. y = x + 1 and y = x² − 2x − 3: x + 1 = x² − 2x − 3, x² − 3x − 4 = 0, (x − 4)(x + 1) = 0, x = 4 or −1; the points are (4, 5) and (−1, 0).

A ball h(t) = −16t² + 48t + 5 and a drone d(t) = 5 + 8t are level when −16t² + 48t + 5 = 5 + 8t, that is −16t² + 40t = 0, t(−16t + 40) = 0: at t = 0 (both at 5 feet) and t = 2.5 (both at 25 feet). The ball is above the drone between those times.

**Worked example.** Where do y = 2x + 1 and y = x² − 2 meet?
2x + 1 = x² − 2; x² − 2x − 3 = 0; (x − 3)(x + 1) = 0; points (3, 7) and (−1, −1).

**Try it.** A ball's height is h(t) = −16t² + 32t + 48. Find its starting height, maximum height, and landing time.
*Answers:* 48 feet; −16(t − 1)² + 64, so 64 feet at t = 1; −16(t − 3)(t + 1) = 0, so t = 3 s.

## Common mistakes

- Claiming the sum or product of two irrational numbers is always irrational.
- Dividing a function by its leading coefficient when rewriting in vertex form.
- Forgetting to multiply the subtracted constant by a: 2(x² + 4x + 4 − 4) subtracts 8, not 4.
- Reading the maximum from the wrong form, or reporting the input (x = 3) when the output (11) was asked for.
- Setting a parabola equal to 0 when the question asks where it meets a line that is not y = 0.
- Keeping a negative time or a solution outside the domain.

## Where this goes next

The unit 7 exam covers weeks 28 to 32. The final-exam prep guide (week 33) reviews all seven units with a two-week plan, and the practice final (week 34) is a full-length paper in course order.

## Self-check

1. Is 7 − √11 rational or irrational? Give the reason.
2. Write 2x² − 12x + 5 in vertex form.
3. A stall's profit is P(p) = −3p² + 30p − 27. What price gives the greatest profit, and what is it?
4. Find the intersections of y = x − 1 and y = x² − 3x + 2.
5. For h(t) = −16t² + 80t + 36, find the starting height, the maximum height, and the landing time to two decimal places.

*Answers:* (1) Irrational: a rational minus an irrational is irrational. (2) 2(x − 3)² − 13. (3) −3(p − 5)² + 48: price 5, profit 48. (4) x − 1 = x² − 3x + 2 gives x² − 4x + 3 = 0, x = 1 or 3; points (1, 0) and (3, 2). (5) 36; −16(t − 2.5)² + 136, so 136 feet; −16t² + 80t + 36 = 0, divide by −4: 4t² − 20t − 9 = 0, t = (20 ± √(400 + 144))/8 = (20 ± √544)/8 ≈ 5.42 s.

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Algebra 1, Unit 7, Lessons 21–24, https://im.kendallhunt.com/HS/teachers/1/7/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
