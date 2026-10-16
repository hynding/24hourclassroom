# Week 10 · Solving Inequalities and Graphing Them in Two Variables

**Lessons:** 2.20 Writing and Solving Inequalities in One Variable · 2.21 Graphing Linear Inequalities in Two Variables (Part 1) · 2.22 Graphing Linear Inequalities in Two Variables (Part 2) · 2.23 Solving Problems with Inequalities in Two Variables
**Practices:** MP2 (interpret a shaded region as a set of situations), MP3 (justify the direction of an inequality symbol), MP6 (dashed versus solid boundaries)
**Built from:** IM Algebra 1, Unit 2, Lessons 20–23, in our own words
**Spiral:** The boundary-and-test method from week 9 becomes the algebraic solving of inequalities. Graphing a boundary line is week 7's graphing; a solution of a two-variable inequality is a point, as in week 6.

## What you need to be able to do

- **2.20** Solve inequalities in one variable algebraically, including the rule that multiplying or dividing by a negative number reverses the symbol, and write and solve inequalities from situations.
- **2.21** Graph a linear inequality in two variables: draw the boundary line, decide solid or dashed, test a point, shade the half-plane of solutions.
- **2.22** Determine the inequality from a graph, handle boundaries in any form (standard, slope-intercept, vertical, horizontal), and explain why a test point decides the shading.
- **2.23** Write a two-variable inequality for a situation with a constraint, graph it, and use the graph to answer questions about which combinations are possible.

## Key terms

| Term | Meaning |
|---|---|
| Reverse the inequality | Swap < with > (or ≤ with ≥) when multiplying or dividing both sides by a negative number. |
| Half-plane | One side of a line; the solution set of a linear inequality in two variables. |
| Boundary line | The graph of the related equation (replace the inequality symbol with =). |
| Solid boundary | Used for ≤ or ≥: points on the line are solutions. |
| Dashed boundary | Used for < or >: points on the line are not solutions. |
| Test point | A point not on the boundary used to decide which side to shade; (0, 0) when the line misses the origin. |
| Constraint | A condition such as a budget or capacity, written as an inequality. |

## Solving inequalities algebraically (2.20)

Solve an inequality exactly like an equation, with one exception.

**The exception.** Multiplying or dividing both sides by a **negative** number reverses the symbol. Why: 2 < 5 is true, but multiplying by −1 gives −2 and −5, and −2 > −5. The order flips because negatives are arranged in reverse on the number line.

**Worked example.** Solve 7 − 2x ≥ 15.
Subtract 7: −2x ≥ 8. Divide by −2 and reverse: **x ≤ −4**. Check with x = −10: 7 + 20 = 27 ≥ 15 ✓. Check the wrong side with x = 0: 7 ≥ 15 ✗.

To avoid the flip entirely, move the variable to the side where it stays positive: 7 − 2x ≥ 15 → 7 ≥ 15 + 2x → −8 ≥ 2x → −4 ≥ x, which is the same as x ≤ −4.

**Worked example.** Solve 3(x − 4) < 5x + 2.
3x − 12 < 5x + 2 → −12 < 2x + 2 → −14 < 2x → **x > −7**.

**From a situation.** A phone has 2,400 MB of data. A video call uses 150 MB per hour and the owner wants to keep at least 600 MB for the rest of the month. How many hours of calls, h, are possible?
150h + 600 ≤ 2,400 → 150h ≤ 1,800 → **h ≤ 12**.

**Try it.** Solve 9 − 4x > 1 and 2x + 5 ≤ 4x − 3.
*Answers:* −4x > −8, so x < 2 (flip). 5 ≤ 2x − 3, 8 ≤ 2x, x ≥ 4.

## Graphing a linear inequality in two variables (2.21)

The solutions of y < 2x + 1 are all the pairs (x, y) that make it true, and there are so many that they fill a whole region: a half-plane.

**Steps.**

1. **Draw the boundary** y = 2x + 1 (intercept 1, slope 2).
2. **Solid or dashed?** The symbol is <, strict, so the points on the line are not solutions: draw it **dashed**. For ≤ or ≥ draw it solid.
3. **Test a point** not on the line. (0, 0): is 0 < 2(0) + 1? 0 < 1 ✓. So the side containing (0, 0), below the line, is the solution side.
4. **Shade** that side.

Every point in the shaded region is a solution: (3, 2) gives 2 < 7 ✓; (−2, 0) gives 0 < −3 ✗, and (−2, 0) is indeed above the line.

**Worked example.** Graph 3x + 2y ≥ 12.
Boundary 3x + 2y = 12 with intercepts (4, 0) and (0, 6); solid because of ≥. Test (0, 0): 0 ≥ 12 ✗, so shade the side **away** from the origin (above and to the right).

When the boundary passes through (0, 0), pick another test point such as (1, 0) or (0, 1).

**Try it.** For y ≥ −x + 3, is the boundary solid or dashed, and is (0, 0) shaded?
*Answer:* Solid; 0 ≥ 3 is false, so (0, 0) is not shaded; shade above the line.

## Reading an inequality from a graph, and special boundaries (2.22)

Going backwards: find the boundary's equation, then decide the symbol.

**Worked example.** A graph shows a solid line through (0, −2) and (2, 2), with shading below and to the right of the line.
Slope = 4/2 = 2, intercept −2: boundary y = 2x − 2. Test a shaded point, say (3, 0): 0 versus 2(3) − 2 = 4. Since 0 < 4 and the line is solid, the inequality is **y ≤ 2x − 2**.

**Vertical and horizontal boundaries.** x > 3 is the half-plane to the right of the dashed vertical line x = 3 (there is no y: every point with x-coordinate above 3 qualifies). y ≤ −1 is everything on or below the solid horizontal line y = −1.

**Why a test point works.** The boundary splits the plane into exactly two sides, and on each side the expression (left side minus right side) keeps one sign. One point settles the whole side.

**Try it.** A dashed line through (0, 4) and (4, 0) is shaded toward the origin. Write the inequality.
*Answer:* Boundary x + y = 4; (0, 0) gives 0 < 4; dashed, so x + y < 4.

## Inequalities in two variables from situations (2.23)

**Worked example.** A bake sale needs at least $120. Cookies sell for $1.50 and brownies for $2. Write and graph an inequality, then answer: can they reach the goal with 40 cookies and 30 brownies?
Let c = cookies, b = brownies: **1.5c + 2b ≥ 120**. Boundary intercepts (80, 0) and (0, 60), solid. (0, 0) gives 0 ≥ 120, false, so shade away from the origin. Test (40, 30): 60 + 60 = 120 ≥ 120 ✓, exactly on the boundary: they reach the goal exactly.

**Context limits.** Only the first quadrant makes sense (c ≥ 0, b ≥ 0), and only whole numbers. The graph shows every combination at a glance: anything on or above the line works.

**Worked example.** A trailer carries at most 1,000 kg. Boxes are 20 kg and crates 50 kg. Which loads are allowed?
**20x + 50y ≤ 1,000**, boundary intercepts (50, 0) and (0, 20), solid, shade toward the origin ((0, 0) satisfies it). Allowed loads: (30, 5)? 600 + 250 = 850 ✓. (20, 15)? 400 + 750 = 1,150 ✗.

**Try it.** A class has 36 minutes for presentations; short talks take 3 minutes and long talks 5. Write the inequality for the numbers of short talks s and long talks l.
*Answer:* 3s + 5l ≤ 36.

## Common mistakes

- Forgetting to reverse the symbol when dividing by a negative.
- Reversing the symbol when subtracting a negative number or dividing by a positive one; only a negative multiplier or divisor flips it.
- Drawing a solid line for a strict inequality, or shading the line's side without testing.
- Testing (0, 0) when the line passes through the origin.
- Shading above the line for "y <" without checking; "below" is right for y < mx + b, but for inequalities in standard form the direction is not obvious until you test.
- Forgetting that in context only non-negative (and often whole-number) solutions count.

## Where this goes next

Week 11 graphs two inequalities together: the solution of a system of inequalities is where the shaded regions overlap, and the corner points of that region matter in modelling problems. Unit 4 uses inequalities to describe the domain and range of a function.

## Self-check

1. Solve 12 − 5x < 2.
2. Solve −3(x + 2) ≥ 9.
3. Is (2, 5) a solution of y > 3x − 2?
4. Describe the graph of 2x − y ≤ 4: boundary, solid or dashed, which side.
5. A gardener has 60 m of fencing for a rectangular plot: write an inequality in the length l and width w.

*Answers:* (1) −5x < −10, x > 2. (2) −3x − 6 ≥ 9, −3x ≥ 15, x ≤ −5. (3) 5 > 4 ✓, yes. (4) Line through (2, 0) and (0, −4), solid; (0, 0) gives 0 ≤ 4 ✓, so shade the origin's side (above the line). (5) 2l + 2w ≤ 60.

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Algebra 1, Unit 2, Lessons 20–23, https://im.kendallhunt.com/HS/teachers/1/2/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
