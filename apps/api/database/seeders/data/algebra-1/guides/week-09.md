# Week 09 · Finishing Systems and Starting Inequalities

**Lessons:** 2.16 Solving Systems by Elimination (Part 3) · 2.17 Systems of Linear Equations and Their Solutions · 2.18 Representing Situations with Inequalities · 2.19 Solutions to Inequalities in One Variable
**Practices:** MP3 (explain why a system has no solution or infinitely many), MP6 (precise use of <, ≤, >, ≥), MP7 (see parallel lines in matching slopes)
**Built from:** IM Algebra 1, Unit 2, Lessons 16–19, in our own words
**Spiral:** Elimination (week 8) is completed; the slope-intercept form of week 7 explains why some systems have no solution; the solutions-as-points idea of week 6 becomes a shaded part of a number line.

## What you need to be able to do

- **2.16** Solve any linear system by elimination, including systems where both equations must be multiplied, and explain each step.
- **2.17** Decide whether a system has one solution, no solution or infinitely many, from the equations or from the graphs, and connect each case to the slopes and intercepts.
- **2.18** Write an inequality that represents a constraint in a situation, choosing the right symbol and interpreting words like "at least", "at most", "more than" and "no more than".
- **2.19** Find and represent the solutions of an inequality in one variable on a number line, by testing values and by relating the inequality to the equation that marks its boundary.

## Key terms

| Term | Meaning |
|---|---|
| Consistent system | A system with at least one solution. |
| Inconsistent system | A system with no solution: the lines are parallel. |
| Dependent system | A system whose equations describe the same line: infinitely many solutions. |
| Inequality | A statement comparing two expressions with <, ≤, > or ≥. |
| Solution set of an inequality | All values that make it true, usually an interval on the number line. |
| Boundary | The value where the two sides are equal; the solution of the related equation. |
| Open/closed circle | On a number line, an open circle excludes the boundary (< or >), a closed circle includes it (≤ or ≥). |

## Elimination, part 3 (2.16)

When neither variable's coefficients share a convenient multiple, scale **both** equations to a common multiple of one variable's coefficients.

**Worked example.** Solve 4x + 6y = 10 and 6x − 9y = 3.
Eliminate x: the least common multiple of 4 and 6 is 12. Multiply the first by 3 (12x + 18y = 30) and the second by 2 (12x − 18y = 6). Add: 24x = 36, **x = 1.5**. Back-substitute: 6 + 6y = 10, 6y = 4, **y = 2/3**. Check in the second: 9 − 6 = 3 ✓.

You could instead eliminate y (LCM of 6 and 9 is 18): first × 3 gives 12x + 18y = 30; second × 2 gives 12x − 18y = 6. Same system, same answer: here both choices coincide.

**Worked example.** Solve 0.5x + 0.2y = 3 and 1.5x − 0.4y = 1.
Clear decimals first: multiply the first by 10 (5x + 2y = 30) and the second by 10 (15x − 4y = 10). Multiply the new first by 2: 10x + 4y = 60. Add: 25x = 70, **x = 2.8**. Then 14 + 2y = 30, **y = 8**.

Fractions clear the same way: multiply through by the least common denominator before eliminating.

**Try it.** Solve 3x + 5y = 19 and 2x + 7y = 21.
*Answer:* first × 2 (6x + 10y = 38), second × 3 (6x + 21y = 63); subtract: 11y = 25, y = 25/11. Then eliminate y to avoid fractions in back-substitution: first × 7 (21x + 35y = 133), second × 5 (10x + 35y = 105); subtract: 11x = 28, x = 28/11. The solution is (28/11, 25/11) ≈ (2.55, 2.27). Not every system has integer solutions; check by substituting: 3(28/11) + 5(25/11) = (84 + 125)/11 = 209/11 = 19 ✓.

## How many solutions? (2.17)

Two lines in a plane either cross once, never meet, or are the same line.

| Graphs | Slopes and intercepts | Number of solutions | What elimination produces |
|---|---|---|---|
| Cross at one point | different slopes | exactly one | a value, e.g. 5x = 10 |
| Parallel, distinct | same slope, different intercepts | none | a false statement, e.g. 0 = 7 |
| Same line | same slope, same intercept | infinitely many | a true statement, e.g. 0 = 0 |

**Worked example.** Classify 2x + 3y = 6 and 4x + 6y = 18.
Slopes: −2/3 and −4/6 = −2/3, the same. Intercepts: y = 2 and y = 3, different. Parallel: **no solution**. Elimination agrees: double the first (4x + 6y = 12), subtract from the second: 0 = 6, false.

**Worked example.** Classify x − 2y = 4 and −3x + 6y = −12.
Multiply the first by −3: −3x + 6y = −12, identical to the second. Same line: **infinitely many solutions**, every (x, y) with x − 2y = 4, such as (4, 0), (6, 1), (0, −2).

**In context.** Two phone plans with the same per-text price but different monthly fees never cost the same (parallel). Two descriptions of the same plan written differently agree for every number of texts (same line).

**Try it.** Does y = 3x − 2 and 6x − 2y = 4 have one, none or infinitely many solutions?
*Answer:* Rewrite the second: −2y = 4 − 6x, y = 3x − 2. The same line: infinitely many.

## Inequalities from situations (2.18)

An inequality says one quantity is bigger (or smaller) than another, possibly including equality.

| Words | Symbol | Example |
|---|---|---|
| more than, greater than, exceeds | > | the elevator holds more than 10 people: p > 10 |
| at least, no less than, minimum | ≥ | you must be at least 16: a ≥ 16 |
| less than, fewer than, under | < | spend less than $50: c < 50 |
| at most, no more than, maximum, up to | ≤ | at most 8 passengers: n ≤ 8 |

**Worked example.** A club has $200 and wants to buy T-shirts at $7.50 each with $45 reserved for printing. Write an inequality for the number of shirts n.
Shirts cost 7.50n; with the reserve, 7.50n + 45 must not exceed 200: **7.50n + 45 ≤ 200**.

**Worked example.** A student needs an average of at least 80 on four tests; the first three were 72, 85 and 79. Write an inequality for the fourth score s.
(72 + 85 + 79 + s)/4 ≥ 80, i.e. **(236 + s)/4 ≥ 80**.

Equality may or may not be allowed. "Must not exceed" allows equality (≤); "must be under" does not (<). Read the words carefully.

**Try it.** Write an inequality: a delivery van can carry no more than 1,200 kg, and each crate is 40 kg.
*Answer:* 40c ≤ 1,200.

## Solving inequalities in one variable (2.19)

The **boundary** is where the inequality becomes an equation. Solve 7.50n + 45 = 200: 7.50n = 155, n = 20.67. The boundary splits the number line into two sides; test a value on each side to see which side satisfies the inequality.

- Test n = 10: 75 + 45 = 120 ≤ 200 ✓. So values below the boundary work.
- Test n = 30: 225 + 45 = 270 ≤ 200 ✗.

Solution: **n ≤ 20.67**, and since shirts come whole, the club can buy at most 20 shirts.

**On a number line.** Draw a circle at the boundary (closed for ≤ or ≥, open for < or >) and shade the side that works. For x > 3: open circle at 3, shade to the right. For x ≤ −1: closed circle at −1, shade to the left.

**Worked example.** Solve 236 + s ≥ 320 (the test-average inequality multiplied by 4). Boundary: s = 84. Test s = 90: 326 ≥ 320 ✓. Solution: **s ≥ 84**: the student needs 84 or more.

Solving algebraically works like an equation, with one warning you will meet next week: multiplying or dividing both sides by a negative number reverses the inequality symbol. This week, keep the boundary-and-test method: it never goes wrong.

**Try it.** Solve 3x − 5 < 10 and draw the solution.
*Answer:* Boundary 3x − 5 = 10 gives x = 5. Test x = 0: −5 < 10 ✓. Solution x < 5: open circle at 5, shaded to the left.

## Common mistakes

- Multiplying only one equation when both need scaling, then adding and finding nothing cancels.
- Declaring "no solution" when elimination gives 0 = 0; that is infinitely many.
- Saying two lines with the same slope must be parallel; if the intercepts also match they are the same line.
- Writing < for "at most"; "at most" allows equality, so ≤.
- Forgetting to test which side of the boundary satisfies the inequality.
- Using a closed circle for a strict inequality.

## Where this goes next

Week 10 solves inequalities algebraically (with the sign-flip rule) and graphs inequalities in two variables as half-planes. Week 11 combines them into systems of inequalities. The one/none/infinitely-many classification returns in unit 7 when you count the solutions of a quadratic equation.

## Self-check

1. Solve 5x + 2y = 4 and 3x + 4y = −6 by elimination.
2. Classify: 3x − y = 5 and −6x + 2y = −10.
3. Classify: y = 2x + 1 and y = 2x − 4.
4. Write an inequality: a lift carries at most 650 kg; each person is estimated at 75 kg.
5. Solve 4x + 9 ≥ 29 and describe its number-line graph.

*Answers:* (1) First × 2: 10x + 4y = 8; subtract the second: 7x = 14, x = 2, y = −3. (2) Second = first × (−2): same line, infinitely many. (3) Same slope, different intercepts: none. (4) 75p ≤ 650 (so p ≤ 8.67, at most 8 people). (5) Boundary x = 5; test x = 10: 49 ≥ 29 ✓; x ≥ 5, closed circle at 5 shaded right.

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Algebra 1, Unit 2, Lessons 16–19, https://im.kendallhunt.com/HS/teachers/1/2/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
