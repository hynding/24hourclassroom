# Week 26 · Graphing from Standard and Factored Form

**Lessons:** 6.10 Graphs of Functions in Standard and Factored Forms · 6.11 Graphing from the Factored Form · 6.12 Graphing the Standard Form (Part 1) · 6.13 Graphing the Standard Form (Part 2)
**Practices:** MP7 (read what each form of an expression reveals), MP8 (generalise what a, b and c do from many examples), MP5 (use graphing technology to test a conjecture)
**Built from:** IM Algebra 1, Unit 6, Lessons 10–13, in our own words
**Spiral:** Standard and factored form (week 25) are the two expressions whose graphs this week reads. Features of graphs, intercepts, maximum and minimum, increasing and decreasing (week 16) get their quadratic versions. Equations and their graphs (week 6) remind you that a point is on the graph exactly when it satisfies the equation. Exponential graphs (week 21) are the comparison case: a parabola crosses the x-axis, an exponential graph never does.

## What you need to be able to do

- **6.10** Read the x-intercepts of a quadratic function's graph from its factored form and the y-intercept from its standard form, and match a function in either form to a description of its graph.
- **6.11** Locate the axis of symmetry halfway between the x-intercepts, find the vertex on it, and sketch a parabola from the factored form.
- **6.12** Describe how changing a and c in y = ax² + bx + c changes the graph.
- **6.13** Describe how changing b changes the graph, and find the vertex of y = x² + bx from its zeros.

## Key terms

| Term | Meaning |
|---|---|
| x-intercepts | Points where the graph meets the x-axis; the zeros of the function. |
| y-intercept | The point where the graph meets the y-axis; the output at x = 0. |
| Axis of symmetry | The vertical line through the vertex; the two halves of the parabola mirror across it. |
| Vertex | The highest or lowest point of a parabola, on the axis of symmetry. |
| Opens upward or downward | The direction of the parabola's arms, set by the sign of a. |

## What each form shows (6.10)

Take f(x) = (x − 2)(x + 4), which expands to x² + 2x − 8. The two expressions describe one function and one graph, but each makes a different feature obvious.

**Factored form shows the x-intercepts.** A product is 0 only when one of its factors is 0. x − 2 = 0 at x = 2 and x + 4 = 0 at x = −4, so the graph crosses the x-axis at (2, 0) and (−4, 0). Notice the signs: the factor (x + 4) gives the intercept −4.

**Standard form shows the y-intercept.** At x = 0, the x² and x terms are both 0, leaving the constant: f(0) = −8. The graph crosses the y-axis at (0, −8).

**The sign of the leading coefficient shows the direction.** In y = −(x − 1)(x − 5), the negative in front flips the parabola to open downward; its intercepts are 1 and 5, its y-intercept is −(−1)(−5) = −5.

**Worked example.** g(x) = x² − 6x + 5. Find both intercepts.
y-intercept: 5. Factor: (−1)(−5) = 5 and −1 + (−5) = −6, so g(x) = (x − 1)(x − 5) and the x-intercepts are 1 and 5.

**Try it.** State the intercepts of y = (x + 3)(x − 1).
*Answer:* x-intercepts −3 and 1; y-intercept (3)(−1) = −3.

## Sketching from factored form (6.11)

A parabola is symmetric about the vertical line through its vertex, and that line passes halfway between the x-intercepts. So:

1. Read the x-intercepts from the factors.
2. Average them: that is the **axis of symmetry** and the x-coordinate of the vertex.
3. Substitute to get the vertex's y-coordinate.
4. Plot the y-intercept and its mirror image across the axis.
5. Join the points with a smooth U.

For f(x) = (x − 2)(x + 4): intercepts 2 and −4; axis x = (2 + (−4))/2 = −1; f(−1) = (−3)(3) = −9, so the vertex is (−1, −9); the y-intercept (0, −8) mirrors to (−2, −8).

```
  y
  |            *             *
  |             *           *
 -+--*----------+----------*----- x
  |   -4   (0,-8)*       *2
  |         (-2,-8)*   *
  |              (-1,-9)
```

**Worked example.** Find the vertex of p(x) = (x + 1)(x − 7).
Intercepts −1 and 7; axis x = 3; p(3) = (4)(−4) = −16. Vertex (3, −16), a minimum since the parabola opens upward.

**Try it.** Find the axis of symmetry and vertex of y = (x − 3)(x − 11).
*Answer:* x = 7; y = (4)(−4) = −16; vertex (7, −16).

## The effects of a and c (6.12)

Start from y = x², the basic parabola with vertex at the origin, and change one number at a time.

**Changing a** (the coefficient of x²):
- a > 0 opens upward, a < 0 opens downward. y = −x² is y = x² flipped.
- |a| > 1 makes the parabola **narrower**: y = 2x² reaches 8 at x = 2 instead of 4.
- 0 < |a| < 1 makes it **wider**: y = (1/2)x² reaches only 2 at x = 2.
- The vertex stays at the origin.

**Changing c** (the constant):
- Adds c to every output, so the graph slides **up** by c (or down if c is negative). Shape unchanged.
- c is the y-intercept. y = x² + 3 has vertex (0, 3); y = 2x² − 8 has vertex (0, −8) and x-intercepts where 2x² = 8, that is x = ±2.

**Worked example.** Describe y = −x² + 3 relative to y = x².
Flipped to open downward and raised 3: vertex (0, 3), a maximum; x-intercepts ±√3.

**Try it.** Which of y = 3x², y = (1/3)x² and y = −3x² is widest, and which open upward?
*Answers:* (1/3)x² is widest; 3x² and (1/3)x² open upward.

## The effect of b (6.13)

The b term is the one that moves the vertex off the y-axis. For y = x² + bx there is no constant, so x² + bx = x(x + b) has zeros 0 and −b, and the vertex sits halfway, at x = −b/2.

| Function | Zeros | Vertex |
|---|---|---|
| y = x² + 6x | 0, −6 | (−3, −9) |
| y = x² − 10x | 0, 10 | (5, −25) |
| y = x² + 4x | 0, −4 | (−2, −4) |
| y = x² − 4x | 0, 4 | (2, −4) |

Two things to notice. With a > 0, a positive b pushes the vertex **left** and a negative b pushes it **right**; x² + 4x and x² − 4x are mirror images across the y-axis. And b changes neither the y-intercept (still c) nor the direction (still set by a).

When c is not 0 the same idea works whenever the expression factors: x² + 2x − 8 = (x − 2)(x + 4), zeros 2 and −4, vertex (−1, −9).

**Worked example.** Find the x-intercepts and vertex of y = −x² − 4x.
−x² − 4x = −x(x + 4): intercepts 0 and −4; axis x = −2; y = −4 + 8 = 4. Vertex (−2, 4), a maximum.

**Try it.** Find the vertex of y = x² + 12x.
*Answer:* zeros 0 and −12; vertex (−6, 36 − 72) = (−6, −36).

## Reading a model's graph

h(t) = −16t² + 32t + 48 gives a ball's height. Factor out −16: −16(t² − 2t − 3) = −16(t − 3)(t + 1). Zeros at t = 3 (the landing) and t = −1 (before the throw, meaningless here). Axis t = 1; h(1) = 64, the maximum height. Starting height h(0) = 48. The flight is the part of the parabola from (0, 48) up to (1, 64) and down to (3, 0).

## Common mistakes

- Reading the intercept of (x + 4) as 4 instead of −4.
- Averaging the numbers in the factors instead of the intercepts themselves.
- Taking the y-intercept from the factored form without multiplying the constants.
- Believing c moves the graph sideways; it moves it up or down.
- Forgetting that a negative a flips the parabola, so the vertex becomes a maximum.
- Calling a parabola "increasing" because it goes up on the right; state the interval.

## Where this goes next

Week 27 introduces the vertex form a(x − h)² + k, which shows the vertex directly, and uses graphs to answer questions about real situations. Unit 7 solves equations like h(t) = 0 exactly, including those whose factors are not obvious.

## Self-check

1. State the x-intercepts and y-intercept of y = (x − 4)(x + 1), and the vertex.
2. Describe the graph of y = −3x² + 2 relative to y = x².
3. Find the vertex of y = x² − 8x.
4. Which form of 2x² + 8x − 10 = 2(x − 1)(x + 5) shows the y-intercept, and what is it?
5. A ball's height is h(t) = −16(t − 2)(t + 1). When does it land, and what is its maximum height?

*Answers:* (1) 4 and −1; (0, −4); axis x = 1.5, vertex (1.5, (−2.5)(2.5)) = (1.5, −6.25). (2) Opens downward, narrower, shifted up 2; vertex (0, 2). (3) Zeros 0 and 8; vertex (4, −16). (4) The standard form; −10. (5) At t = 2 seconds; axis t = 0.5, h(0.5) = −16(−1.5)(1.5) = 36 feet.

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Algebra 1, Unit 6, Lessons 10–13, https://im.kendallhunt.com/HS/teachers/1/6/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
