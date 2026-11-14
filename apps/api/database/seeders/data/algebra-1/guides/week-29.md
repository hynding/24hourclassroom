# Week 29 · Factoring to Solve Quadratic Equations

**Lessons:** 7.6 Rewriting Quadratic Expressions in Factored Form (Part 1) · 7.7 Rewriting Quadratic Expressions in Factored Form (Part 2) · 7.8 Rewriting Quadratic Expressions in Factored Form (Part 3) · 7.9 Solving Quadratic Equations by Using Factored Form · 7.10 Rewriting Quadratic Expressions in Factored Form (Part 4)
**Practices:** MP7 (use the structure of a product to reverse the expansion), MP8 (notice the patterns for differences of squares and perfect squares), MP6 (check every factorisation and every solution)
**Built from:** IM Algebra 1, Unit 7, Lessons 6–10, in our own words
**Spiral:** Expanding products with area diagrams (week 25) is the process you now run backwards. The zero product property (week 28) is the reason factoring solves equations. The product-and-sum idea from standard and factored form (week 25) is extended to every sign pattern, then to a leading coefficient other than 1.

## What you need to be able to do

- **7.6** Factor x² + bx + c when b and c are positive by finding two numbers with product c and sum b.
- **7.7** Do the same when b or c is negative, choosing the signs correctly.
- **7.8** Recognise and factor differences of squares, a² − b² = (a − b)(a + b), and perfect square trinomials, x² ± 2kx + k² = (x ± k)².
- **7.9** Solve a quadratic equation by rearranging it to equal 0, factoring, applying the zero product property and checking.
- **7.10** Factor ax² + bx + c when a ≠ 1 by trying factor pairs, and recognise when an expression does not factor over the integers.

## Key terms

| Term | Meaning |
|---|---|
| Factor (verb) | Rewrite an expression as a product. |
| Difference of squares | a² − b², which factors as (a − b)(a + b). |
| Perfect square trinomial | x² + 2kx + k², which is (x + k)². |
| Leading coefficient | The coefficient of x² in ax² + bx + c. |
| Factors over the integers | Can be written as a product of linear factors with integer coefficients. |

## Factoring x² + bx + c with positive b and c (7.6)

Expanding (x + m)(x + n) gives x² + (m + n)x + mn. So to factor x² + bx + c, look for two numbers whose **product is c** and whose **sum is b**.

x² + 9x + 20: the pairs that multiply to 20 are 1 and 20, 2 and 10, 4 and 5. Only 4 + 5 = 9. So x² + 9x + 20 = (x + 4)(x + 5).

An area diagram shows the same thing. A rectangle with area x² + 7x + 10 and one side x + 2 must have the other side x + 5: the x² piece needs x times x, and the constant needs 2 times 5.

```
        x       5
    +-------+------+
 x  |  x²   |  5x  |
    +-------+------+
 2  |  2x   |  10  |
    +-------+------+
```

**Worked example.** Factor x² + 8x + 15.
Pairs for 15: 1 and 15 (sum 16), 3 and 5 (sum 8). (x + 3)(x + 5).

**Try it.** Factor x² + 10x + 24 and x² + 13x + 12.
*Answers:* (x + 4)(x + 6); (x + 1)(x + 12).

## Choosing the signs (7.7)

The same search works with negatives; the signs of b and c say what to look for.

| c | b | The two numbers |
|---|---|---|
| positive | positive | both positive |
| positive | negative | both negative |
| negative | either | one of each; the one with the larger absolute value takes the sign of b |

- x² − 11x + 24: both negative. (−3)(−8) = 24 and −3 − 8 = −11. (x − 3)(x − 8).
- x² − 3x − 28: one of each, larger one negative. (−7)(4) = −28, −7 + 4 = −3. (x − 7)(x + 4).
- x² + 2x − 35: one of each, larger one positive. 7 · (−5) = −35, 7 − 5 = 2. (x + 7)(x − 5).
- x² − 5x − 6: (−6)(1) = −6, −6 + 1 = −5. (x − 6)(x + 1). Not (x − 2)(x − 3), which expands to x² − 5x **+** 6.

Always check by expanding; a wrong sign shows up in the middle term.

**Worked example.** Factor x² − 2x − 35.
Product −35, sum −2: −7 and 5. (x − 7)(x + 5).

**Try it.** Factor x² − 9x + 14 and x² + 4x − 21.
*Answers:* (x − 2)(x − 7); (x + 7)(x − 3).

## Two special patterns (7.8)

**Difference of squares.** (x − 7)(x + 7) = x² + 7x − 7x − 49 = x² − 49: the middle terms cancel. In reverse, any a² − b² is (a − b)(a + b):

- x² − 36 = (x − 6)(x + 6)
- 4x² − 9 = (2x − 3)(2x + 3)
- 25 − x² = (5 − x)(5 + x)

A **sum** of squares, x² + 25, does not factor: it would need two numbers with product 25 and sum 0, and there are none.

**Perfect square trinomial.** (x + 6)² = x² + 12x + 36. The constant is the square of half the middle coefficient. So x² + 12x + 36 = (x + 6)², x² − 10x + 25 = (x − 5)², and x² + 6x + 36 is not a perfect square (half of 6 is 3, and 3² = 9, not 36).

**Worked example.** Factor x² − 100 and x² − 14x + 49.
(x − 10)(x + 10); (x − 7)².

**Try it.** Factor 9x² − 1 and x² + 16x + 64.
*Answers:* (3x − 1)(3x + 1); (x + 8)².

## Solving equations by factoring (7.9)

1. Rearrange so that one side is **0**.
2. Factor the other side.
3. Set each factor equal to 0 and solve.
4. Check each solution in the original equation.

x² + 3x = 40: x² + 3x − 40 = 0; (x + 8)(x − 5) = 0; x = −8 or x = 5. Check: 64 − 24 = 40 and 25 + 15 = 40.

x² = 5x + 24: x² − 5x − 24 = 0; (x − 8)(x + 3) = 0; x = 8 or x = −3.

x² = 6x: x² − 6x = 0; x(x − 6) = 0; x = 0 or x = 6. Dividing both sides by x would lose the solution 0.

**A rocket.** h(t) = −5t² + 20t + 25. It lands when −5t² + 20t + 25 = 0; dividing by −5, t² − 4t − 5 = (t − 5)(t + 1) = 0, so t = 5 (the −1 is before the launch). It is 40 m high when −5t² + 20t + 25 = 40, that is −5t² + 20t − 15 = 0, t² − 4t + 3 = (t − 1)(t − 3) = 0: at t = 1 going up and t = 3 coming down.

**Worked example.** Solve x² − 2x − 35 = 0.
(x − 7)(x + 5) = 0, so x = 7 or x = −5.

**Try it.** Solve x² + 7x = −12 and x² = 49.
*Answers:* x² + 7x + 12 = (x + 3)(x + 4) = 0, x = −3 or −4; x² − 49 = (x − 7)(x + 7) = 0, x = ±7.

## When the leading coefficient is not 1 (7.10)

(px + m)(qx + n) expands to pqx² + (pn + mq)x + mn. To factor 2x² + 7x + 3, the x² coefficient 2 must come from 2 · 1, and the constant 3 from 1 · 3 or 3 · 1. Try the arrangements:

- (2x + 1)(x + 3) = 2x² + 6x + x + 3 = 2x² + 7x + 3 ✓
- (2x + 3)(x + 1) = 2x² + 2x + 3x + 3 = 2x² + 5x + 3 ✗

So 2x² + 7x + 3 = (2x + 1)(x + 3), and 2x² + 7x + 3 = 0 has solutions x = −1/2 and x = −3.

More examples: 3x² − 10x − 8 = (3x + 2)(x − 4); 2x² + 11x + 12 = (2x + 3)(x + 4), so 2x² + 11x + 12 = 0 gives x = −3/2 or x = −4.

**Not everything factors.** x² − 4x − 3 needs two integers with product −3 and sum −4; the candidates (−1, 3) and (1, −3) give sums 2 and −2. The equation x² − 4x − 3 = 0 still has two solutions, visible on the graph near −0.65 and 4.65, but factoring cannot find them exactly. Weeks 30 and 31 give methods that work for every quadratic equation.

**Worked example.** Factor 5x² + 13x + 6.
5 = 5 · 1; 6 = 1 · 6, 2 · 3, 3 · 2, 6 · 1. (5x + 3)(x + 2) = 5x² + 10x + 3x + 6 ✓.

**Try it.** Factor 2x² − 5x − 3 and solve 2x² − 5x − 3 = 0.
*Answers:* (2x + 1)(x − 3); x = −1/2 or x = 3.

## Common mistakes

- Choosing numbers that add to b but do not multiply to c, or the reverse.
- Getting the middle sign wrong: (x + 2)(x + 3) is x² + 5x + 6, not x² − 5x + 6.
- Calling x² + 25 a difference of squares, or writing x² − 49 as (x − 7)².
- Factoring one side while the other side is not 0.
- Dividing by x and losing the solution x = 0.
- Checking solutions in the factored equation instead of the original.
- Forgetting the factor pairs of a when a ≠ 1.

## Where this goes next

Week 30 introduces completing the square, which turns any x² + bx + c into a perfect square plus a constant and so solves equations that do not factor, and shows where irrational solutions such as 2 ± √7 come from. Week 31 packages the same idea as the quadratic formula.

## Self-check

1. Factor x² + 11x + 28 and x² − 7x + 10.
2. Factor x² + 3x − 18 and x² − x − 42.
3. Factor x² − 81 and x² + 18x + 81.
4. Solve x² + 5x = 14.
5. Factor 3x² + 8x + 4 and solve 3x² + 8x + 4 = 0.

*Answers:* (1) (x + 4)(x + 7); (x − 2)(x − 5). (2) (x + 6)(x − 3); (x − 7)(x + 6). (3) (x − 9)(x + 9); (x + 9)². (4) x² + 5x − 14 = (x + 7)(x − 2) = 0, so x = −7 or x = 2. (5) (3x + 2)(x + 2); x = −2/3 or x = −2.

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Algebra 1, Unit 7, Lessons 6–10, https://im.kendallhunt.com/HS/teachers/1/7/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
