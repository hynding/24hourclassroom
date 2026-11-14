# Week 21 · Optimization

**Topics:** 5.10 Introduction to Optimization Problems · 5.11 Solving Optimization Problems
**Practices:** 1 (Implementing Mathematical Processes), 2 (Connecting Representations), 3 (Justification), 4 (Communication and Notation)
**Framework:** AP Calculus AB and BC CED, Unit 5, Topics 5.10–5.11, learning objectives in our own words
**Spiral:** Optimization is the payoff of the whole unit. It uses the Extreme Value Theorem (week 17), the First Derivative Test and the Candidates Test (week 18), and the Second Derivative Test and concavity (week 19), applied to a function you build yourself from a description. Building that function draws on the modelling habits of Unit 4 (related rates and rates in context, weeks 13–15): name the quantities, find the equations that connect them, keep track of units.

## What you need to be able to do

- **5.10** Read an optimization problem and identify the quantity to optimize (the objective), the fixed condition (the constraint) and the variable to use.
- **5.10** Write the objective as a function of one variable and state its domain in context.
- **5.11** Find the critical points of the objective and determine which gives the absolute maximum or minimum on the domain.
- **5.11** Justify the absolute extremum with the Candidates Test, the single-critical-point argument, or a concavity argument.
- **5.11** Answer the question actually asked, in context and with units.

## Key terms

| Term | Meaning |
|---|---|
| Objective function | The quantity to be maximized or minimized, written as a function of one variable. |
| Constraint | An equation that fixes a relationship between the variables (a fixed length, area or volume). |
| Contextual domain | The inputs that make physical sense: lengths nonnegative, constraint satisfiable. |
| Single-critical-point argument | On an interval, a continuous function with one critical point, a relative max there, has its absolute max there (likewise for min). |

## Setting up the problem (5.10)

Most of the difficulty in optimization is before any calculus happens. Work in this order.

1. **Draw a picture** and label every quantity with a letter.
2. **Write the objective**: the formula for the quantity you want to make largest or smallest. It may involve two variables at first.
3. **Write the constraint** and solve it for one variable.
4. **Substitute** to get the objective as a function of a single variable.
5. **State the domain**: which values of the variable make sense?

**Worked example 1 (hypothetical).** A farmer has 240 m of fence to make a rectangular pen against a straight river, with no fence along the river. Let x be the length of each side perpendicular to the river and y the length of the side parallel to it.

- Objective: area A = xy.
- Constraint: 2x + y = 240, so y = 240 − 2x.
- One variable: A(x) = x(240 − 2x) = 240x − 2x².
- Domain: x ≥ 0 and y = 240 − 2x ≥ 0, so 0 ≤ x ≤ 120.

The domain is not decoration. It tells you which critical points count, and on a closed domain it supplies the endpoints for the Candidates Test.

**Distances: minimize the square.** When the objective is a distance √(…), minimize the expression under the root instead. Distance is never negative, and for nonnegative numbers a larger distance always has a larger square, so both are smallest at the same input, and the square is much easier to differentiate.

**Worked example 2.** Which point on y = √x is closest to (3, 0)? A point on the curve is (x, √x), so the squared distance is D²(x) = (x − 3)² + (√x)² = x² − 5x + 9, for x ≥ 0. Its derivative 2x − 5 is 0 at x = 5/2, and the second derivative is 2 > 0, so D² (and hence D) has its absolute minimum there. The closest point is (5/2, √(5/2)), at distance √(11/4) = √11/2 ≈ 1.66.

## Solving and justifying (5.11)

Once the objective f is a function of one variable on a domain, find its critical points and then **prove** which one is the optimum. The AP exam awards a separate point for this justification. There are three standard arguments.

**1. The Candidates Test (closed domain).** If f is continuous on [a, b], evaluate it at every critical point in (a, b) and at a and b. The largest value is the absolute maximum.

For the pen: A′(x) = 240 − 4x = 0 at x = 60. A(0) = 0, A(60) = 60 · 120 = 7,200, A(120) = 0. The maximum area is 7,200 m², with the two perpendicular sides 60 m and the parallel side 120 m. (Notice the answer is not a square: the free river side changes the shape.)

**2. The single-critical-point argument (any interval).** If f is continuous on the domain and has exactly one critical point c, and f′ changes from positive to negative at c, then f(c) is the absolute maximum: f rises all the way up to c and falls all the way after it. Change the signs for a minimum. This works on open intervals such as x > 0, where there are no endpoints to check.

**3. Concavity on the whole domain.** If f″ < 0 everywhere on the domain, the graph is concave down throughout, so a critical point must be the absolute maximum. If f″ > 0 throughout, a critical point is the absolute minimum. Warning: f″(c) < 0 at the single point c only proves a **relative** maximum; for an absolute one, pair it with "the only critical point" or check f″ on the whole domain.

**Worked example 3.** An open-top box has a square base of side x cm and volume 32 cm³. Find the dimensions that use the least material.

- Height h = 32/x². Material: base x² plus four sides of area xh: S(x) = x² + 4x(32/x²) = x² + 128/x, for x > 0.
- S′(x) = 2x − 128/x² = (2x³ − 128)/x², which is 0 when x³ = 64, so x = 4.
- S″(x) = 2 + 256/x³ > 0 for every x > 0, so S is concave up on its whole domain and x = 4 gives the absolute minimum.
- The box is 4 cm by 4 cm by 2 cm, and uses S(4) = 16 + 32 = 48 cm² of material.

**Worked example 4.** A rectangle has its base on the x-axis and its upper corners on y = 12 − x². With corners at (±x, 0) and (±x, 12 − x²), its area is A(x) = 2x(12 − x²) = 24x − 2x³, for 0 ≤ x ≤ √12.

A′(x) = 24 − 6x² = 0 at x = 2 (x = −2 is outside the domain). Candidates: A(0) = 0, A(2) = 4 · 8 = 32, A(√12) = 0. The largest rectangle is 4 units wide and 8 units tall, with area 32.

**Worked example 5 (hypothetical).** A poster must hold 384 cm² of print, with 3 cm margins at top and bottom and 2 cm at each side. With print width w, the print height is 384/w, and the poster's area is

T(w) = (w + 4)(384/w + 6) = 408 + 6w + 1536/w, for w > 0.

T′(w) = 6 − 1536/w² = 0 at w² = 256, w = 16. T′ is negative for 0 < w < 16 and positive for w > 16, and 16 is the only critical point, so it gives the absolute minimum. The print is 16 cm by 24 cm, and the poster is 20 cm by 30 cm, using 600 cm² of paper.

**Worked example 6 (hypothetical, a classic shape).** An island is 3 km offshore from point P on a straight coast; a refinery is on the coast 8 km from P. Pipe costs $5,000 per km underwater and $4,000 per km on land. If the pipe comes ashore x km from P,

C(x) = 5√(x² + 9) + 4(8 − x) thousand dollars, for 0 ≤ x ≤ 8.

C′(x) = 5x/√(x² + 9) − 4. Setting it to 0: 5x = 4√(x² + 9), so 25x² = 16x² + 144, x² = 16, x = 4. Candidates: C(0) = 15 + 32 = 47, C(4) = 25 + 16 = 41, and C(8) = 5√73. Since √73 > 8.2 (because 8.2² = 67.24), C(8) > 41. The cheapest plan brings the pipe ashore 4 km from P, for $41,000. A calculator gives C(8) ≈ 42.72, confirming the comparison.

**Calculator problems.** If the critical-point equation cannot be solved by hand, a calculator question will expect you to solve it numerically (or to graph f′ and find its zero) and report three decimal places. For a 500 cm³ can, S(r) = 2πr² + 1000/r; S′(r) = 0 gives r = (250/π)^(1/3) ≈ 4.301 cm. The justification is still required.

## Answering the question

Reread the question before writing the answer. "Find the maximum area" wants 7,200 m², not x = 60. "Find the dimensions" wants every side length. Include units, and, if the problem asks you to interpret, say what the number means in the situation. Derivative values have units too: for the pen, A′(30) = 120 m² per meter, so near x = 30 each extra meter of the perpendicular sides adds about 120 m² of area.

## Common mistakes

- **Optimizing the constraint instead of the objective.** The fence length is fixed; the area is what changes.
- **Leaving two variables in the objective.** Substitute from the constraint before differentiating.
- **A domain that is too wide (or missing).** It can admit nonsense critical points or lose endpoint candidates.
- **Stopping at f′(c) = 0.** Every answer needs a justification that it is an absolute extremum.
- **Using f″(c) < 0 alone to claim an absolute maximum.** That proves a relative maximum; add "only critical point" or concavity on the whole domain.
- **Counting the wrong pieces.** An open box has no lid; a fence against a wall has three sides.
- **Answering with the input when the optimal value is asked, or forgetting units.**

## Self-check

1. A rectangle has perimeter 36 m. Find the dimensions of greatest area, and justify.
2. Find the point on the line y = 2x + 1 closest to the origin. (Hint: minimize D².)
3. A box with an open top is made from a 12 cm by 12 cm sheet by cutting squares of side x from the corners. Write V(x) with its domain and find the x that maximizes the volume.
4. A hypothetical bakery's profit is P(n) = −0.5n² + 40n − 300 dollars for n cakes, 0 ≤ n ≤ 60. How many cakes maximize profit, and what is the maximum profit?
5. Why is the answer to the pen problem not a square, although the answer to question 1 is?

*Answers:* 1. A = x(18 − x), A′ = 18 − 2x = 0 at x = 9; A″ = −2 < 0 everywhere (or A(0) = A(18) = 0): a 9 m by 9 m square, 81 m². 2. D² = x² + (2x + 1)² = 5x² + 4x + 1; derivative 10x + 4 = 0 at x = −2/5: the point (−2/5, 1/5). 3. V = x(12 − 2x)², 0 ≤ x ≤ 6; V′ = (12 − 2x)(12 − 6x) = 0 at x = 2 (x = 6 is an endpoint with V = 0); V(2) = 128 cm³ beats V(0) = V(6) = 0. 4. P′ = −n + 40 = 0 at n = 40; P(40) = −800 + 1600 − 300 = $500, larger than P(0) = −300 and P(60) = 300. 5. The river side needs no fence, so the constraint is 2x + y = 240, not 2x + 2y = 240; the symmetry that makes the square optimal is gone.

---

*Original study material for this course, organised around the College Board AP Calculus AB and BC Course and Exam Description (Unit 5, Topics 5.10–5.11). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). AP® is a trademark of the College Board, which does not endorse this material.*
