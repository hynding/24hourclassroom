# Week 22 · Symmetry, Writing Transformations and Scaling Outputs

**Lessons:** 5.5 Some Functions Have Symmetry · 5.6 Symmetry in Equations · 5.7 Expressing Transformations of Functions Algebraically · 5.8 Scaling the Outputs
**Practices:** MP7 (look for structure), MP3 (construct arguments), MP6 (attend to precision)
**Built from:** IM Algebra 2, Unit 5, Lessons 5–8, in our own words
**Spiral:** Last week's reflection f(−x) is the test for symmetry: a function whose graph is unchanged by that reflection is even. Writing transformations algebraically reuses vertex form (week 14) and the shifted exponentials of Unit 4. Scaling outputs touches polynomials (Unit 2): multiplying by a constant keeps every zero.

## What you need to be able to do

- **5.5** Recognise symmetry in a graph: symmetric about the y-axis (even) or about the origin (odd), and use it to find values and complete graphs.
- **5.6** Test a function algebraically: f(−x) = f(x) means even, f(−x) = −f(x) means odd, otherwise neither; connect each case to the graph's symmetry.
- **5.7** Write the equation of a transformed function from a verbal description or a graph, for any parent function (quadratic, cubic, absolute value, square root, exponential, logarithmic), combining shifts and reflections.
- **5.8** Describe and write vertical scalings k · f(x): stretch for |k| > 1, compress for 0 < |k| < 1, reflect if k < 0; track points and explain which features change and which do not.

## Key terms

| Term | Meaning |
|---|---|
| Even function | f(−x) = f(x) for every x; the graph is symmetric about the y-axis. |
| Odd function | f(−x) = −f(x) for every x; the graph is symmetric about the origin (a half-turn leaves it unchanged). |
| Vertical scaling | y = k · f(x): every output multiplied by k; (a, b) → (a, kb). |
| Stretch / compress | |k| > 1 stretches the graph away from the x-axis; 0 < |k| < 1 compresses it toward the x-axis. |
| Parent function | The basic function the transformation starts from. |

## Symmetry in graphs (5.5)

Some graphs are their own mirror images.

- **Symmetric about the y-axis.** Fold the graph along the y-axis and the halves match. The point (2, 5) is on the graph exactly when (−2, 5) is. Examples: y = x², y = |x|, y = x⁴ − 3x².
- **Symmetric about the origin.** Rotate the graph a half-turn about (0, 0) and it lands on itself. The point (2, 5) is on the graph exactly when (−2, −5) is. Examples: y = x³, y = x, y = 1/x, y = x³ − x.
- **Neither.** y = 2ˣ, y = (x − 1)², y = x² + x, y = √x.

Symmetry halves the work: if an even function has f(2) = 4, then f(−2) = 4; if an odd function has f(2) = 6, then f(−2) = −6. An odd function defined at 0 must have f(0) = 0, because f(−0) = −f(0) forces f(0) = −f(0).

**Worked example.** The graph of an even function passes through (3, −2) and (1, 4). Name two more points.

(−3, −2) and (−1, 4).

**Try it.**
1. The graph of an odd function passes through (4, 1) and (−2, 7). Name two more points.
2. Can the graph of an even function pass through (0, 3)? Can an odd function's graph?

*Answers:* 1. (−4, −1) and (2, −7). 2. Yes for even (y = x² + 3); no for odd, since f(0) must be 0.

## Symmetry in equations (5.6)

To test a formula, compute f(−x) and simplify:

| f(x) | f(−x) | Conclusion |
|---|---|---|
| x⁴ − 3x² | (−x)⁴ − 3(−x)² = x⁴ − 3x² = f(x) | even |
| x³ − x | −x³ + x = −(x³ − x) = −f(x) | odd |
| x³ + 2x | −x³ − 2x = −f(x) | odd |
| x² − 5 | x² − 5 = f(x) | even |
| 1/x | −1/x = −f(x) | odd |
| x² + x | x² − x: not f(x), not −f(x) | neither |
| (x + 1)² | (−x + 1)² = (x − 1)²: neither | neither |
| 2ˣ | 2⁻ˣ = (1/2)ˣ: neither | neither |

A quick disproof: for (x + 1)², f(1) = 4 and f(−1) = 0, which is neither 4 nor −4, so it is neither even nor odd. Polynomials with only even powers (including constants) are even; those with only odd powers are odd; a mix is neither.

**Worked example.** f(x) = x⁴ − 3x² has f(2) = 16 − 12 = 4. Find f(−2) without recomputing.

f is even, so f(−2) = 4.

**Try it.**
1. Classify g(x) = 5x³ − x, h(x) = |x| + 1 and k(x) = x² − x.
2. If p is odd and p(3) = −7, find p(−3).

*Answers:* 1. odd; even; neither (k(1) = 0, k(−1) = 2). 2. 7.

## Writing transformations algebraically (5.7)

Given a description or a graph, build the equation from the parent function, inside out: horizontal shift inside with x, reflection and vertical shift outside.

| Description | Equation | Check |
|---|---|---|
| x³, left 1, down 4 | (x + 1)³ − 4 | through (−1, −4) |
| x², reflected across x-axis, right 2, up 3 | −(x − 2)² + 3 | vertex (2, 3), opens down, y-intercept −1 |
| 2ˣ, right 2, up 1 | 2^(x − 2) + 1 | asymptote y = 1, through (2, 2) |
| √x, reflected across x-axis, up 4 | −√x + 4 | starts (0, 4), x-intercept 16 |
| √x, reflected across y-axis, up 2 | √(−x) + 2 | domain x ≤ 0, starts (0, 2) |
| \|x\|, left 3, reflected across x-axis | −\|x + 3\| | vertex (−3, 0), opens down |
| log₂(x), right 4 | log₂(x − 4) | asymptote x = 4, through (5, 0) |

**From a graph.** Find the parent shape, locate the key point (vertex, corner, starting point, asymptote) and read off h and k; then check a second point to decide whether a reflection is present. A parabola with vertex (2, 3) passing through (0, −1) must be −(x − 2)² + 3 because its arms point down.

**Worked example.** g(x) = −(x − 2)² + 3. Find g(0) and the x-intercepts.

g(0) = −4 + 3 = −1. Zeros: (x − 2)² = 3, x = 2 ± √3.

**Try it.**
1. Write the equation for y = x³ reflected across the x-axis and shifted up 2.
2. A square-root graph starts at (3, −1) and rises to the right. Write its equation.

*Answers:* 1. −x³ + 2. 2. √(x − 3) − 1.

## Scaling the outputs (5.8)

**y = k · f(x)** multiplies every output by k: (a, b) → (a, kb).

- k = 3: vertical stretch by 3. (2, 5) → (2, 15). y = 3x² is narrower than y = x².
- k = 1/2: vertical compression. (4, 10) → (4, 5).
- k = −2: reflect across the x-axis and stretch by 2. (1, 3) → (1, −6).
- k = 4 on √x: y = 4√x; (4, 2) → (4, 8).

**What stays, what changes.** Zeros stay (k · 0 = 0), so 2f and f cross the x-axis at the same places. The y-intercept scales by k. Maximum and minimum values scale by k. Horizontal asymptotes scale too: 3 · 2ˣ still has asymptote y = 0, but 3(2ˣ + 1) has asymptote y = 3.

**A connection.** 2 · 2ˣ = 2ˣ⁺¹: for exponential functions, a vertical stretch by the base is the same as a shift left 1. That is special to exponentials; for x², the stretch 2x² is not a shift of x².

**Worked example.** f has a maximum value of 6 at x = 1 and zeros at x = −2 and x = 4. Describe −0.5f(x).

Reflect and compress: a minimum value of −3 at x = 1, and the same zeros −2 and 4.

**Try it.**
1. The point (−3, 8) is on f. Where is it on 0.25f(x)? On −3f(x)?
2. Write y = |x| stretched vertically by 2 and shifted down 5, and give its vertex and x-intercepts.

*Answers:* 1. (−3, 2); (−3, −24). 2. y = 2|x| − 5; vertex (0, −5); zeros where 2|x| = 5, x = ±2.5.

## Common mistakes

- **Calling a graph symmetric about the x-axis "even".** Even means symmetric about the y-axis; a graph symmetric about the x-axis is not a function at all.
- **Deciding even or odd from one point.** f(−2) = f(2) for one value does not prove evenness; the algebra must hold for every x. One failing point does disprove it.
- **Mixing the order inside and outside.** Horizontal shifts go with x inside the parent function; reflections across the x-axis and vertical shifts go outside.
- **Thinking k · f(x) moves the zeros.** It does not: k · 0 = 0.
- **Confusing a vertical stretch with a horizontal one.** 3f(x) triples heights; next week's f(3x) changes widths.

## Where this goes next

Next week scales the inputs (f(kx)), combines functions by adding and subtracting them, and builds a model for real data by choosing a parent function and transforming it to fit. The unit exam follows.

## Self-check

1. Classify x⁵ − 3x, x⁶ + 2, and x³ + 1 as even, odd or neither, showing f(−x).
2. An even function has f(−4) = 9. What else do you know? What if the function were odd instead?
3. Write the equation for y = √x reflected across the x-axis, shifted right 1 and up 3.
4. The point (2, −6) is on f. Find its image on 1.5f(x) and on −f(x) + 1.
5. Explain why doubling every output of a polynomial leaves its zeros unchanged but changes its y-intercept.

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Algebra 2, Unit 5, Lessons 5–8, https://im.kendallhunt.com/HS/teachers/3/5/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
