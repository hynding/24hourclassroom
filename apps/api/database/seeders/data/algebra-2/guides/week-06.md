# Week 06 · End Behaviour, Multiplicity and Intersections

**Lessons:** 2.9 End Behavior (Part 2) · 2.10 Multiplicity · 2.11 Finding Intersections
**Practices:** MP7 (look for structure), MP5 (use tools strategically), MP3 (construct arguments)
**Built from:** IM Algebra 2, Unit 2, Lessons 9–11, in our own words
**Spiral:** Week 5's sign tables, factored-form sketches and leading-term reasoning are extended. From Algebra 1: solving f(x) = g(x) by graphing, and the quadratic formula.

## What you need to be able to do

- **2.9** Describe the end behaviour of any polynomial, including those with a negative leading coefficient, from its degree and leading coefficient, and identify degree and sign of the leading coefficient from a graph's ends.
- **2.10** Explain what a repeated factor (x − a)ⁿ does at the zero a: the graph crosses when n is odd, touches and turns back when n is even, and flattens more as n grows. Write equations for graphs that bounce or flatten.
- **2.11** Find where the graphs of two functions intersect by setting the expressions equal, rearranging to a polynomial equal to 0, and solving by factoring or with technology; interpret the intersections in context.

## Key terms

| Term | Meaning |
|---|---|
| Leading coefficient | The coefficient of the highest-degree term; its sign decides whether the right end goes up or down. |
| Multiplicity | The number of times a factor (x − a) appears in the factored form; the exponent on that factor. |
| Simple zero | A zero of multiplicity 1; the graph crosses straight through the axis there. |
| Double zero | Multiplicity 2; the graph touches the axis and turns back without crossing. |
| Triple zero | Multiplicity 3; the graph crosses but flattens out at the intercept. |
| Intersection | A point where two graphs meet: an x with f(x) = g(x). |
| Turning point | A hill top or dip bottom; a degree-n polynomial has at most n − 1. |

## End behaviour with any leading coefficient (2.9)

Last week: with a positive leading coefficient, even degree goes up on both ends and odd degree goes down-left, up-right. A **negative** leading coefficient flips both ends, because every output is multiplied by a negative number.

| Degree | Leading coefficient > 0 | Leading coefficient < 0 |
|---|---|---|
| Even | left up, right up (↑ ↑) | left down, right down (↓ ↓) |
| Odd | left down, right up (↓ ↑) | left up, right down (↑ ↓) |

The right end is the easy one: it goes up when the leading coefficient is positive and down when it is negative, whatever the degree. Then the left end matches the right end for even degree and opposes it for odd degree.

**Reading a graph.** If both ends of a graph go down, the degree is even and the leading coefficient negative. If the left end goes up and the right end goes down, the degree is odd and the leading coefficient negative. The number of turning points gives a lower bound on the degree: three turning points means degree at least 4.

**Worked example.** Describe the end behaviour of p(x) = −2x⁵ + 40x⁴ − 1 and of q(x) = 7 − x² − x⁶.

p: leading term −2x⁵, odd degree, negative coefficient: as x → −∞, p(x) → ∞; as x → ∞, p(x) → −∞. q: leading term −x⁶, even degree, negative coefficient: both ends go down.

**Worked example.** A polynomial in factored form is r(x) = −(x + 3)(x − 1)(x − 2)(x − 5). Find its end behaviour and vertical intercept.

Four linear factors and a minus sign: leading term −x⁴, so both ends go down. r(0) = −(3)(−1)(−2)(5) = −30.

**Try it.**
1. End behaviour of −x³ + 100x?
2. A graph rises on the left, falls on the right and has 4 turning points. What can you say about its degree and leading coefficient?

*Answers:* 1. Left up, right down. 2. Odd degree, at least 5; negative leading coefficient.

## Multiplicity (2.10)

Compare three polynomials that all have a zero at x = 2:

- f(x) = (x − 2)(x + 1): simple zero at 2. Near x = 2 the factor (x + 1) is about 3, so f(x) ≈ 3(x − 2), a line through (2, 0). The graph **crosses**.
- g(x) = (x − 2)²(x + 1): double zero at 2. Near x = 2, g(x) ≈ 3(x − 2)², a parabola with vertex at (2, 0). The graph **touches and turns back** (it bounces) without changing sign.
- h(x) = (x − 2)³(x + 1): triple zero at 2. Near x = 2, h(x) ≈ 3(x − 2)³, a flattened S through (2, 0). The graph **crosses but flattens** at the intercept.

The rule: **odd multiplicity crosses, even multiplicity bounces**, and the higher the multiplicity the flatter the graph at that zero. The sign table has to respect this: the sign does not change at a zero of even multiplicity.

**Worked example.** Sketch p(x) = (x + 1)²(x − 3).

Zeros −1 (double) and 3 (simple). Leading term x³, so left down and right up. p(0) = (1)(−3) = −3. Sign: for x < −1 (test −2): (+)(−) negative; between −1 and 3 (test 0): (+)(−) negative, no sign change at the double zero; for x > 3: positive. The graph comes up from the bottom left, touches the axis at −1, dips to pass through (0, −3), then crosses up at 3.

**Worked example.** Write an equation for a graph that bounces off the x-axis at −4, crosses at 1, and passes through (0, 8).

p(x) = k(x + 4)²(x − 1). p(0) = k · 16 · (−1) = −16k = 8, so k = −1/2: p(x) = −(1/2)(x + 4)²(x − 1). Check the ends: degree 3, negative coefficient, so left up and right down, which fits a graph that comes down to bounce at −4 and later crosses downward at 1.

**Counting zeros with multiplicity.** A degree-n polynomial has at most n zeros, counting multiplicity. (x − 2)²(x + 1) has degree 3 and zeros 2, 2, −1. The number of distinct x-intercepts can be smaller.

**Try it.**
1. For (x − 5)³(x + 2)²x, list each zero with its multiplicity and say whether the graph crosses or bounces.
2. Write a quartic with a double zero at 0 and simple zeros at 3 and −3, leading coefficient 2.

*Answers:* 1. 5 (multiplicity 3, crosses and flattens), −2 (multiplicity 2, bounces), 0 (multiplicity 1, crosses). 2. 2x²(x − 3)(x + 3).

## Finding intersections (2.11)

Two graphs intersect where their outputs agree. To find the intersections of f and g, solve f(x) = g(x):

1. Set the expressions equal.
2. Move everything to one side so the equation reads (polynomial) = 0.
3. Solve: factor if you can, use the quadratic formula for a quadratic, or graph and read off the zeros with technology.
4. Find the y-values by substituting back into either function, and interpret.

**Worked example.** Where do f(x) = x³ − 4x and g(x) = 3x² − 12 intersect?

x³ − 4x = 3x² − 12 → x³ − 3x² − 4x + 12 = 0. Factor by grouping: x²(x − 3) − 4(x − 3) = (x − 3)(x² − 4) = (x − 3)(x − 2)(x + 2). So x = 3, 2, −2. The points: f(3) = 15, f(2) = 0, f(−2) = 0, giving (3, 15), (2, 0), (−2, 0). The cubic and the parabola meet three times.

**Worked example.** A company's revenue from x thousand units is R(x) = 60x − x² (thousand dollars) and its cost is C(x) = 8x + 240. Where does it break even?

60x − x² = 8x + 240 → x² − 52x + 240 = 0 → (x − 6)(x − 46) = 0. Break-even at 6 thousand and 46 thousand units; between them revenue exceeds cost.

**Worked example.** Solve x³ + 2 = x + 4 with technology.

x³ − x − 2 = 0 has no rational zeros (test ±1, ±2: none work). Graphing shows one real crossing near x ≈ 1.52. Report the approximate solution and say how you found it; exact solutions of such cubics are beyond this course.

**Why "= 0" matters.** Rewriting as (polynomial) = 0 turns an intersection problem into a zeros problem, so everything from weeks 5 and 6 applies: the zeros of f − g are the x-coordinates of the intersections of f and g.

**Try it.**
1. Find the intersections of y = x² and y = 2x + 8.
2. Find the x-coordinates where x³ = 9x.
3. Explain why the graphs of f(x) = x⁴ + 1 and g(x) = −x² never intersect.

*Answers:* 1. x² − 2x − 8 = (x − 4)(x + 2) = 0: (4, 16) and (−2, 4). 2. x³ − 9x = x(x − 3)(x + 3) = 0: x = 0, 3, −3. 3. x⁴ + 1 = −x² would need x⁴ + x² + 1 = 0, but the left side is always at least 1.

## Common mistakes

- **Reading the left end from the leading coefficient alone.** The sign of the leading coefficient fixes the right end; the degree decides whether the left end matches.
- **Changing sign at a double zero** in a sign table. Even multiplicity: no sign change.
- **Dividing both sides by x** when solving x³ = 9x. That loses the solution x = 0. Move everything to one side and factor instead.
- **Solving f(x) = g(x) and reporting only x.** An intersection is a point; give both coordinates when asked.
- **Trusting a factor test too early.** If no rational zero exists, say so and use technology for an approximation.

## Where this goes next

Week 7 introduces polynomial division, the tool that finds the remaining factors once one zero is known, and the Remainder Theorem, which explains why p(a) = 0 exactly when (x − a) is a factor. Multiplicity returns in the unit exam and when rational functions have repeated factors in their denominators (week 8).

## Self-check

1. Describe the end behaviour of −4x⁶ + x³ and of −x⁷ + x.
2. For p(x) = −(x − 1)²(x + 2)³, give the multiplicity of each zero, the behaviour of the graph at each, and the end behaviour.
3. Write an equation for a quartic that touches the x-axis at 2 and at −1 and has vertical intercept (0, −8).
4. Find the intersections of y = x³ − x and y = 3x.
5. Explain why the zeros of f − g give the intersections of f and g.

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Algebra 2, Unit 2, Lessons 9–11, https://im.kendallhunt.com/HS/teachers/3/2/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
