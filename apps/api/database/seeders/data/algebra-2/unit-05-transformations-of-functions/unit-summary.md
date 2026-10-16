# Unit 5 · Transformations of Functions · The night-before sheet

**Exam weight:** about 8–10% of the final · **Lessons:** 5.1 Matching up to Data · 5.2 Moving Functions · 5.3 More Movement · 5.4 Reflecting Functions · 5.5 Some Functions Have Symmetry · 5.6 Symmetry in Equations · 5.7 Expressing Transformations of Functions Algebraically · 5.8 Scaling the Outputs · 5.9 Scaling the Inputs · 5.10 Combining Functions · 5.11 Making a Model for Data
**Practices:** MP2, MP4, MP6, MP7
**Built from:** IM Algebra 2, Unit 5, in our own words

## The ideas that generate every question

1. **Outside the function acts on outputs; inside acts on inputs.** f(x) + k and k · f(x) change y-values (vertical moves and stretches). f(x − h) and f(kx) change x-values (horizontal moves and stretches), and they act "backwards": f(x + 3) is left 3, f(2x) is half as wide.
2. **Track one point.** Every rule is checked by following (a, b): f(x) + k → (a, b + k); f(x − h) → (a + h, b); −f(x) → (a, −b); f(−x) → (−a, b); k · f(x) → (a, kb); f(kx) → (a/k, b).
3. **Features follow the points.** Vertical shifts move horizontal asymptotes and intercepts; horizontal shifts move vertical asymptotes and vertices; vertical scalings keep zeros; horizontal scalings keep the y-intercept.
4. **Symmetry is a reflection that changes nothing.** Even: f(−x) = f(x), mirror in the y-axis. Odd: f(−x) = −f(x), half-turn about the origin. Polynomials with only even powers are even, only odd powers odd, mixed neither. One counterexample disproves; the algebra must hold for all x to prove.
5. **Build equations inside out.** Start with the parent, put horizontal changes inside, then scale and reflect, then shift vertically: −2(x + 1)² + 8 is x² reflected, stretched by 2, left 1, up 8.
6. **Functions combine output by output.** (f + g)(x) = f(x) + g(x), and the same for −, ·. Profit = revenue − cost; a total is a sum.
7. **A data model is a transformed parent function.** Read the pattern (differences, ratios, levelling off), pick the parent, transform to fit the key features, check residuals, state the limits.

## Key formulas and procedures

| Want | Do this |
|---|---|
| Shift up k / down k | f(x) + k / f(x) − k |
| Shift right h / left h | f(x − h) / f(x + h) |
| Reflect across the x-axis | −f(x) |
| Reflect across the y-axis | f(−x) |
| Vertical stretch by k (k > 1) / compression (0 < k < 1) | k · f(x) |
| Horizontal compression by 1/k (k > 1) / stretch (0 < k < 1) | f(kx) |
| Vertex of a(x − h)² + k | (h, k); opens down if a < 0 |
| Asymptote of a · bˣ⁻ʰ + k | y = k |
| Asymptote of log_b(x − h) + k | x = h |
| Start of a√(x − h) + k | (h, k); domain x ≥ h |
| Even test | f(−x) = f(x) |
| Odd test | f(−x) = −f(x); and f(0) = 0 if defined |
| Sum, difference, product | evaluate each at the same x, then combine |
| Shifted exponential from data | subtract the long-run level, find the ratio, add the level back |
| Quadratic from data | constant second differences; use the vertex and one more point |

## Common errors

- Reading f(x + 3) as right 3 (it is left 3) or f(2x) as twice as wide (it is half as wide).
- Moving a horizontal asymptote under a horizontal shift: 2^(x − 1) still has asymptote y = 0.
- Mixing −f(x) (across the x-axis) with f(−x) (across the y-axis).
- Calling a graph "even" because it is symmetric about the x-axis; such a graph is not a function.
- Proving evenness from one point. f(−2) = f(2) alone proves nothing.
- Putting the horizontal shift outside: (x − 2)² − 3(x − 2) is f(x − 2) for f(x) = x² − 3x, not x² − 3(x − 2).
- Thinking k · f(x) moves zeros, or that f(kx) keeps them.
- Subtracting in the wrong order for profit or for (f − g).
- Fitting a · bᵗ to data that levels off at a nonzero value.

## Worked examples

**Track a point.** (3, 5) on f → (5, 6) on f(x − 2) + 1; (3, −5) on −f(x); (−3, 5) on f(−x); (3, 20) on 4f(x); (1, 5) on f(3x).

**Read features.** y = log₂(x − 3): asymptote x = 3, x-intercept (4, 0). y = √(x + 2) − 5: starts at (−2, −5). y = 2^(−x) + 1: decreasing, asymptote y = 1, y-intercept 2.

**Write an equation.** |x| moved right 4, down 2, reflected across the x-axis: y = −|x − 4| − 2. Parabola with vertex (−1, 2) through (0, 5): y = a(x + 1)² + 2 with a + 2 = 5, so a = 3.

**Describe g(x) = −2(x + 1)² + 8.** Reflect x² across the x-axis, stretch by 2, shift left 1 and up 8: vertex (−1, 8), maximum 8, zeros where (x + 1)² = 4, at x = 1 and x = −3, y-intercept 6.

**Classify.** x⁴ − 2x² + 1: even. x³ + x²: neither (f(1) = 2, f(−1) = 0). x³ − 4x: odd.

**Combine.** f(x) = 2x − 3, g(x) = x² + 1: (f + g)(2) = 1 + 5 = 6; (g − f)(x) = x² − 2x + 4; (f · g)(−1) = (−5)(2) = −10. Revenue 80x, cost 500 + 55x: profit 25x − 500, break-even 20.

**Model.** Cooling to 15°: 75, 66, 58.3, 51.8 → subtract 15: 60, 51, 43.3, 36.8, ratio 0.85 → T(t) = 60(0.85)ᵗ + 15; T(4) ≈ 46.3. Ceiling 100 from 20, 60, 80, 90: 100 − 80(0.5)ᵗ. Ball peaking at 36 m at t = 3 s from the ground: h(t) = −4(t − 3)² + 36, lands at t = 6.

## What to review from earlier units

- **Unit 3:** vertex form and completing the square give the (h, k) of a transformed parabola.
- **Unit 4:** exponential and logarithmic parents; their asymptotes are the features that move.
- **Unit 2:** polynomial arithmetic for sums, differences and products of functions; zeros and factors.

## Exam-night checklist

1. Can you state where (a, b) goes under each of the six basic transformations?
2. Can you read vertex, asymptote or starting point straight from an equation such as −3(x + 2)² + 1, 5 · 2ˣ⁻¹ − 4, log₃(x + 2)?
3. Can you write an equation from a description or a graph, in the right order?
4. Can you test a formula for even or odd, and disprove with a counterexample?
5. Can you say which features change under k · f(x) and under f(kx)?
6. Can you add, subtract and multiply functions from formulas and from a table?
7. Can you choose a parent function for data from differences, ratios or levelling off, and fit it?

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Algebra 2, Unit 5, Lessons 1–11, https://im.kendallhunt.com/HS/teachers/3/5/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
