# Week 08 · Transformations of Functions

**Topics:** 1.12 Transformations of Functions
**Practices:** 1 (procedural and symbolic fluency), 2 (multiple representations), 3 (communication and reasoning)
**Framework:** AP Precalculus CED, Unit 1, Topic 1.12, learning objectives in our own words
**Spiral:** Weeks 3 and 4 described polynomials by their zeros, extrema and symmetry; weeks 5 and 6 did the same for rational functions with asymptotes and holes. This week asks how every one of those features moves when the function is shifted, stretched or reflected. Week 7's rewriting of (2x + 7)/(x + 3) as 2 + 1/(x + 3) turns out to be a transformation in disguise. From Algebra 2: vertex form of a quadratic, y = a(x − h)² + k.

## What you need to be able to do

- **1.12** Describe the effect of each parameter in g(x) = a · f(b(x − h)) + k on the graph of f: vertical and horizontal translations, vertical and horizontal dilations, and reflections over the axes.
- **1.12** Find values of a transformed function from a table or formula for f, and map points of the graph of f to points of the graph of g.
- **1.12** Determine how a transformation changes the domain and range, the zeros, the extrema and the asymptotes of a function.
- **1.12** Identify the transformation that takes one function to another from their formulas, tables or graphs, and write the new function in terms of the old.
- **1.12** Explain why a transformation inside the function (acting on the input) behaves "backwards" compared with one outside (acting on the output).

## Key terms

| Term | Meaning |
|---|---|
| Vertical translation | g(x) = f(x) + k moves the graph up k units (down if k < 0). |
| Horizontal translation | g(x) = f(x − h) moves the graph right h units (left if h < 0). |
| Vertical dilation | g(x) = a · f(x) multiplies every output by a: a stretch if |a| > 1, a compression if 0 < |a| < 1. |
| Horizontal dilation | g(x) = f(bx) divides every input by b: the graph is compressed horizontally by a factor of 1/|b|; stretched if 0 < |b| < 1. |
| Reflection over the x-axis | g(x) = −f(x): every output changes sign. |
| Reflection over the y-axis | g(x) = f(−x): every input changes sign. |
| Parent function | A basic function such as x², x³, 1/x or 1/x² whose transformations form a family. |

## The general form and the point rule

Every transformation in this unit fits

g(x) = a · f(b(x − h)) + k.

The parameters outside f (a and k) act on outputs and behave exactly as they look. The parameters inside f (b and h) act on inputs and behave the opposite way: to undo "subtract h, then multiply by b", the graph must move h to the **right** and shrink by **1/b**.

**Point rule.** If (x₀, y₀) is on the graph of f, then

((x₀/b) + h, a · y₀ + k)

is on the graph of g. Read it as: inputs divide by b then add h; outputs multiply by a then add k.

**Worked example.** (2, −4) is on the graph of f. Where does it go under g(x) = 3f(x + 5) − 1?

Here a = 3, b = 1, h = −5, k = −1. New point: (2 − 5, 3(−4) − 1) = (−3, −13). Check: g(−3) = 3f(−3 + 5) − 1 = 3f(2) − 1 = 3(−4) − 1 = −13.

**Factor out b first.** f(2x − 6) looks like a shift of 6, but 2x − 6 = 2(x − 3), so b = 2 and h = 3: compress horizontally by a factor of 1/2, then shift right 3. A point (4, y₀) on f moves to (4/2 + 3, y₀) = (5, y₀). Check: 2 · 5 − 6 = 4.

**Try it.**
1. (−6, 2) is on f. Find the matching point on g(x) = −f(x/3) + 4.
2. Describe g(x) = f(3x + 9) in terms of f.

*Answers:* 1. Here b = 1/3, so the input is divided by 1/3 (multiplied by 3): (−18, −2 + 4) = (−18, 2). 2. 3x + 9 = 3(x + 3): compress horizontally by a factor of 1/3, then shift left 3.

## Transformations from a table

When f is given by a table, compute g one row at a time, being careful about which inputs the table actually covers.

| x | 0 | 1 | 2 | 3 | 4 |
|---|---|---|---|---|---|
| f(x) | 2 | 5 | 6 | 5 | 2 |

**Worked example.** Build tables for g(x) = f(x − 3) + 1 and h(x) = −f(2x).

For g, the inputs of f are x − 3, so x must be 3, 4, 5, 6, 7 for x − 3 to be in the table:

| x | 3 | 4 | 5 | 6 | 7 |
|---|---|---|---|---|---|
| g(x) | 3 | 6 | 7 | 6 | 3 |

For h, 2x must be 0, 1, 2, 3, 4, so x = 0, 0.5, 1, 1.5, 2:

| x | 0 | 0.5 | 1 | 1.5 | 2 |
|---|---|---|---|---|---|
| h(x) | −2 | −5 | −6 | −5 | −2 |

The maximum of f, (2, 6), became the maximum (5, 7) of g and the minimum (1, −6) of h: a reflection over the x-axis turns maxima into minima.

**Identifying a transformation from two tables.** If g's outputs are f's outputs shifted to new inputs, look for a horizontal translation; if the outputs are a fixed multiple plus a constant, look for a vertical dilation and translation. For example, if f(0), f(1), f(2) = 1, 3, 4 and g(−2), g(−1), g(0) = 3, 7, 9, then each g value is 2 · (f value) + 1 at an input 2 smaller, so g(x) = 2f(x + 2) + 1.

## What happens to the features

| Feature of f | Under g(x) = a · f(b(x − h)) + k |
|---|---|
| Zero at x = c | becomes x = c/b + h, but **only if k = 0** (a vertical shift can create or destroy zeros) |
| Vertical asymptote x = c | becomes x = c/b + h |
| Horizontal asymptote y = L | becomes y = aL + k |
| Hole at (c, L) | becomes (c/b + h, aL + k) |
| Maximum at (c, M) | becomes (c/b + h, aM + k); a minimum instead if a < 0 |
| Domain | each endpoint e becomes e/b + h (reversed order if b < 0) |
| Range | each endpoint r becomes ar + k (reversed order if a < 0) |
| Concave up | stays concave up if a > 0; becomes concave down if a < 0 |

**Worked example (zeros).** f(x) = x³ − 4x has zeros −2, 0, 2.

- f(2x) = 8x³ − 8x has zeros −1, 0, 1 (each divided by 2).
- f(x − 3) has zeros 1, 3, 5 (each plus 3).
- 3f(x) and −f(x) keep the zeros −2, 0, 2: vertical dilations and reflections over the x-axis never move a zero.
- f(x) + 5 does not have zeros at any simple shift of −2, 0, 2; you must solve x³ − 4x + 5 = 0 again.

**Worked example (domain and range).** f has domain [−2, 4] and range [−1, 5]. Find the domain and range of g(x) = −3f(2(x − 1)) + 2.

Domain: the input 2(x − 1) must lie in [−2, 4], so x − 1 is in [−1, 2] and x is in [0, 3]. Range: outputs y in [−1, 5] become −3y + 2. y = −1 gives 5 and y = 5 gives −13, so the range is [−13, 5] (the reflection reversed the order).

**Worked example (rational).** Week 7 showed (2x + 7)/(x + 3) = 2 + 1/(x + 3). That is the parent f(x) = 1/x shifted left 3 and up 2, so its vertical asymptote moves from x = 0 to x = −3 and its horizontal asymptote from y = 0 to y = 2. Without any division, the transformation explains the graph.

**Try it.**
1. f has a vertical asymptote x = 2 and a horizontal asymptote y = 1. Find the asymptotes of g(x) = 4f(x + 5) − 3.
2. f has range [0, ∞). What is the range of g(x) = −2f(x) + 7?

*Answers:* 1. x = 2 − 5 = −3; y = 4(1) − 3 = 1. 2. Outputs y ≥ 0 become −2y + 7 ≤ 7: range (−∞, 7].

## Writing a transformed function

**Worked example.** Start with f(x) = x². Reflect over the x-axis, stretch vertically by 3, then shift right 2 and up 5.

g(x) = −3(x − 2)² + 5. The vertex moves from (0, 0) to (2, 5) and the parabola opens down.

**Worked example.** g is a transformation of f(x) = 1/x with vertical asymptote x = 1, horizontal asymptote y = −2, and g(2) = 1. Find g.

The asymptotes give g(x) = a/(x − 1) − 2. Then g(2) = a/1 − 2 = 1, so a = 3: g(x) = 3/(x − 1) − 2.

**Order matters for outputs.** "Stretch by 2, then shift up 3" gives 2f(x) + 3; "shift up 3, then stretch by 2" gives 2(f(x) + 3) = 2f(x) + 6. When an answer is written as a · f(b(x − h)) + k, the dilations and reflections are done before the translations.

## Symmetry and reflections

- f is **even** when f(−x) = f(x): reflecting over the y-axis leaves the graph unchanged. x⁴ − 3x² is even.
- f is **odd** when f(−x) = −f(x): reflecting over the y-axis has the same effect as reflecting over the x-axis, so the graph is unchanged by a rotation of 180° about the origin. x³ − 4x is odd.
- A horizontal shift usually destroys the symmetry: (x − 1)² is neither even nor odd, although its graph is symmetric about the line x = 1.

## Rates of change under transformations

A vertical dilation by a multiplies every average rate of change by a, and a vertical shift does not change any rate of change at all. A horizontal translation moves the interval: the average rate of change of f(x − h) over [p, q] equals that of f over [p − h, q − h]. This is a quick way to check work: if f increases on [1, 3], then −2f(x + 1) decreases on [0, 2], twice as steeply.

## Calculator notes

Enter f as Y₁ and a transformation as Y₂ = 3Y₁(X + 5) − 1 (calculators accept Y₁ as a function of an expression). Graphing both shows the move directly, and the table feature checks the point rule. Use the calculator to confirm, not to replace, the reasoning: AP questions often give f only as a table or a graph, with no formula to type.

## Common mistakes

- **Shifting the wrong way.** f(x − 3) moves right, f(x + 3) moves left.
- **Not factoring out b.** f(2x − 6) is a shift of 3 after the compression, not a shift of 6.
- **Treating f(2x) as a stretch.** Multiplying the input by 2 compresses the graph horizontally by a factor of 1/2.
- **Moving zeros under a vertical shift.** f(x) + k changes the outputs, so zeros must be found again.
- **Reversing range endpoints incorrectly.** With a negative a, the old maximum becomes the new minimum.
- **Confusing the reflections.** −f(x) flips over the x-axis; f(−x) flips over the y-axis.

## Where this goes next

Week 9 builds models, often by transforming a parent function to fit data (a quadratic in vertex form, or a rational model with a shifted asymptote). In Unit 2 the same rules explain why 2^(x + 3) = 8 · 2ˣ, a horizontal translation that equals a vertical dilation, and in Unit 3 the sinusoid f(θ) = a sin(b(θ + c)) + d is this week's general form with sine as the parent.

## Self-check

1. (3, −2) is on the graph of f. Find the matching point on g(x) = −4f(2x − 2) + 1.
2. f has zeros −4 and 6. Give the zeros of f(x/2), of f(x + 1) and of 5f(x).
3. f has domain [1, 9] and range [−3, 3]. Find the domain and range of g(x) = 2f(x − 4) − 1.
4. Write a transformation of 1/x² with vertical asymptote x = −2, horizontal asymptote y = 3, whose graph lies below y = 3.
5. Explain why f(x − h) moves the graph right when h > 0.

---

*Original study material for this course, organised around the College Board AP Precalculus Course and Exam Description (Unit 1, Topic 1.12). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). AP® is a trademark of the College Board, which does not endorse this material.*
