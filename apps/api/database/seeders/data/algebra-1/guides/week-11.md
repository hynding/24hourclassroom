# Week 11 · Systems of Linear Inequalities

**Lessons:** 2.24 Solutions to Systems of Linear Inequalities in Two Variables · 2.25 Solving Problems with Systems of Linear Inequalities in Two Variables · 2.26 Modeling with Systems of Inequalities in Two Variables
**Practices:** MP1 (make sense of a problem with several constraints), MP4 (model a situation with a system of inequalities), MP6 (describe a region precisely)
**Built from:** IM Algebra 1, Unit 2, Lessons 24–26, in our own words
**Spiral:** Each inequality is graphed exactly as in week 10; a system's solution is where the regions overlap, just as a system of equations' solution (week 8) is where the lines cross. The three-case thinking of week 9 returns: regions can overlap, miss each other, or one can sit inside the other.

## What you need to be able to do

- **2.24** Decide whether a point is a solution of a system of inequalities, graph the system, and identify the overlapping region as the solution set.
- **2.25** Write a system of inequalities from a situation with two or more constraints, graph it, and use the region to find and check possible combinations.
- **2.26** Build a complete model: define variables, write every constraint (including non-negativity), graph the feasible region, read off its corner points, and interpret which combinations are possible or best.

## Key terms

| Term | Meaning |
|---|---|
| System of inequalities | Two or more inequalities that must all be true at once. |
| Solution of a system of inequalities | A point that satisfies every inequality in the system. |
| Solution region (feasible region) | The overlap of all the individual half-planes. |
| Vertex (corner) | A point where two boundary lines of the region meet. |
| Non-negativity constraints | x ≥ 0 and y ≥ 0, added when the quantities cannot be negative. |
| Bounded/unbounded region | A region that is enclosed on all sides, or one that extends without limit. |

## Solutions of a system of inequalities (2.24)

A point is a solution only if it satisfies **every** inequality. For the system y ≤ x + 2 and y > −2x + 1:

- (3, 4): 4 ≤ 5 ✓ and 4 > −5 ✓. Solution.
- (0, 3): 3 ≤ 2 ✗. Not a solution, even though 3 > 1 ✓.
- (1, 3): 3 ≤ 3 ✓ (on the solid boundary) and 3 > −1 ✓. Solution.
- (0, 1): 1 ≤ 2 ✓ but 1 > 1 ✗ (on the dashed boundary). Not a solution.

**Graphing the system.** Graph each inequality on the same axes: boundary, solid or dashed, test, shade. The solution region is where the shadings **overlap**. For the system above, the first line (slope 1, intercept 2, solid) is shaded below; the second (slope −2, intercept 1, dashed) is shaded above; the overlap is the wedge to the right of their crossing point. The crossing point itself: x + 2 = −2x + 1 gives x = −1/3, y = 5/3; it is on the dashed line, so it is not a solution.

Three things can happen: the regions overlap (the usual case), they do not overlap at all (parallel boundaries shaded away from each other: y > x + 3 and y < x − 1 have no common solutions), or one region contains the other (y > x + 3 and y > x − 1: the first region is the solution).

**Try it.** Is (2, −1) a solution of x + y ≥ 0 and 2x − y < 6?
*Answer:* 1 ≥ 0 ✓; 4 + 1 = 5 < 6 ✓. Yes.

## Problems with two or more constraints (2.25)

**Worked example.** A student has at most 10 hours this week for a part-time job and homework, and must do at least 4 hours of homework. The job pays $12 an hour and she wants to earn at least $48.

Let j = job hours, h = homework hours.

- Time: **j + h ≤ 10**
- Homework minimum: **h ≥ 4**
- Earnings: 12j ≥ 48, so **j ≥ 4**

Graph (j horizontal). j + h = 10 has intercepts (10, 0) and (0, 10), solid, shaded toward the origin. h = 4 is a solid horizontal line, shaded above. j = 4 is a solid vertical line, shaded right. The overlap is a triangle with corners (4, 4), (6, 4) and (4, 6). Any point in it works: (5, 5) is 10 hours, 5 hours of homework, $60. (7, 4) is outside: 11 hours.

**Checking a combination.** Substitute into every inequality. A combination that fails one constraint fails the system, however well it satisfies the others.

**Try it.** For the system above, is (4.5, 5) possible? Is (3, 6)?
*Answers:* (4.5, 5): 9.5 ≤ 10 ✓, 5 ≥ 4 ✓, 4.5 ≥ 4 ✓, yes. (3, 6): j ≥ 4 fails, no.

## Modelling with a system (2.26)

The complete method:

1. **Define variables** with units.
2. **Write each constraint** as an inequality, including the ones the situation implies: non-negativity (x ≥ 0, y ≥ 0) and whole-number limits where items are counted.
3. **Graph** every inequality; shade the feasible region.
4. **Find the vertices** by solving pairs of boundary equations (a system of equations from week 8).
5. **Interpret**: which combinations are possible, which use a resource fully (on a boundary), which is best for a goal (usually at a vertex).

**Worked example.** A bakery makes loaves and baguettes. A loaf needs 500 g of flour and 20 minutes of oven time; a baguette needs 250 g of flour and 15 minutes. Today there are 20 kg of flour and 12 hours of oven time. Let L = loaves, B = baguettes.

- Flour: 500L + 250B ≤ 20,000, i.e. **2L + B ≤ 80**
- Oven: 20L + 15B ≤ 720, i.e. **4L + 3B ≤ 144**
- L ≥ 0, B ≥ 0

Boundary intercepts: flour line (40, 0) and (0, 80); oven line (36, 0) and (0, 48). Both shaded toward the origin. Do the lines cross inside the first quadrant? From 2L + B = 80, B = 80 − 2L; substitute into the oven equation: 4L + 3(80 − 2L) = 144, so 240 − 2L = 144 and L = 48, B = −16. The crossing has a negative B, so it lies outside the region, and the feasible region is the triangle with vertices (0, 0), (36, 0) and (0, 48): the oven constraint binds everywhere. Check: at (36, 0) the flour used is 72 ≤ 80 ✓; at (0, 48) it is 48 ≤ 80 ✓. The bakery can never run out of flour before oven time today.

If a loaf earns $4 and a baguette $2.50, profit is 4L + 2.5B. At the vertices: (36, 0) gives $144, (0, 48) gives $120. The best plan is 36 loaves. (Checking vertices is enough for a linear goal: the best value of a linear expression over a polygon always occurs at a corner.)

**Try it.** A garden bed has room for at most 30 plants; tomatoes need 2 litres of water a day, peppers 1 litre, and there are 40 litres a day. Write the system.
*Answer:* t + p ≤ 30, 2t + p ≤ 40, t ≥ 0, p ≥ 0. Vertices: (0, 0), (20, 0), (10, 20), (0, 30).

## Common mistakes

- Declaring a point a solution after checking only one inequality.
- Shading each inequality but forgetting to identify the overlap as the answer.
- Including a point on a dashed boundary as a solution.
- Omitting the non-negativity constraints and getting a region that includes impossible negative amounts.
- Finding a vertex by reading the graph instead of solving the two boundary equations.
- Treating the crossing point of two boundary lines as a vertex when it lies outside the other constraints.

## Where this goes next

Unit 2 ends here; the summary sheet collects equations, systems and inequalities in one place. Unit 3 returns to data with two variables. The idea of a feasible region reappears whenever a function is restricted to a domain (unit 4), and vertices of regions return in later courses as linear programming.

## Self-check

1. Is (1, 2) a solution of y < 3x and x + y ≥ 3?
2. Describe the solution region of y ≥ 1 and x < 2.
3. Write a system: at most 12 items, at least 5 of them books, each book $8 and each pen $2, spend no more than $70.
4. Find the vertex where 2L + B = 80 meets L = 0.
5. Why is a point on a dashed boundary excluded from the solution region?

*Answers:* (1) 2 < 3 ✓, 3 ≥ 3 ✓: yes. (2) The quarter-plane above or on the horizontal line y = 1 (solid) and to the left of the vertical line x = 2 (dashed). (3) b + p ≤ 12, b ≥ 5, 8b + 2p ≤ 70, b ≥ 0, p ≥ 0. (4) (0, 80). (5) The strict inequality is false there, so the point fails that inequality and therefore the system.

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Algebra 1, Unit 2, Lessons 24–26, https://im.kendallhunt.com/HS/teachers/1/2/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
