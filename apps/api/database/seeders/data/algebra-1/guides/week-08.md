# Week 08 · Systems of Linear Equations: Graphing, Substitution and Elimination

**Lessons:** 2.12 Writing and Graphing Systems of Linear Equations · 2.13 Solving Systems by Substitution · 2.14 Solving Systems by Elimination (Part 1) · 2.15 Solving Systems by Elimination (Part 2)
**Practices:** MP1 (choose a strategy and persevere), MP3 (explain why adding equations is legitimate), MP7 (look for a variable that is easy to isolate or cancel)
**Built from:** IM Algebra 1, Unit 2, Lessons 12–15, in our own words
**Spiral:** A system is two of week 5's equations that must hold at the same time. Substitution starts with week 6's "solve for a variable". Graphing a system is week 7's graphing done twice.

## What you need to be able to do

- **2.12** Write a system of two linear equations from a situation with two unknowns and two conditions, graph both equations, and explain why the intersection point is the solution.
- **2.13** Solve a system by substitution: isolate one variable in one equation, substitute into the other, solve, back-substitute, check.
- **2.14** Solve a system by elimination when a pair of terms already cancels under addition or subtraction, and explain why adding two true equations gives a true equation.
- **2.15** Solve a system by elimination when one equation must first be multiplied by a constant so that a pair of terms cancels.

## Key terms

| Term | Meaning |
|---|---|
| System of equations | Two or more equations that must be true at the same time. |
| Solution of a system | A pair (x, y) that satisfies every equation in the system. |
| Intersection | The point where the graphs of the equations cross: the solution of the system. |
| Substitution | Replace a variable in one equation with an expression for it taken from the other. |
| Elimination | Add or subtract the equations (possibly after multiplying one or both by a constant) so that one variable cancels. |
| Back-substitute | Put the value you found into either original equation to find the other variable. |

## Writing and graphing systems (2.12)

Two unknowns need two conditions. A box office sold 300 tickets for $2,100; adult tickets were $9 and child tickets $5. Let a and c be the numbers sold.

- Condition on count: **a + c = 300**
- Condition on money: **9a + 5c = 2,100**

Each equation on its own has infinitely many solutions (a whole line of them); the system asks for the pair that satisfies both. Graph both lines (a on the horizontal axis). The first has intercepts (300, 0) and (0, 300); the second has intercepts (233.3, 0) and (0, 420). They cross at **(150, 150)**: 150 + 150 = 300 ✓ and 1,350 + 750 = 2,100 ✓.

Why the intersection: a point on the first line is a solution of the first equation; a point on the second line is a solution of the second; the point on both lines is a solution of both. Graphing is a great way to see a system and a poor way to get an exact answer when the crossing is at a point like (2.4, 7.15), which is why the next two lessons are algebraic.

**Try it.** Write a system: two numbers add to 50 and their difference is 14.
*Answer:* x + y = 50, x − y = 14 (solution (32, 18)).

## Substitution (2.13)

Use substitution when one equation already has a variable alone, or almost alone.

**Worked example.** Solve y = 2x − 1 and 3x + 2y = 19.
The first equation gives y in terms of x. Replace y in the second: 3x + 2(2x − 1) = 19 → 3x + 4x − 2 = 19 → 7x = 21 → **x = 3**. Back-substitute: y = 2(3) − 1 = **5**. Check in the second equation: 9 + 10 = 19 ✓. Solution (3, 5).

**Worked example.** Solve a + c = 300 and 9a + 5c = 2,100.
Isolate c in the first: c = 300 − a. Substitute: 9a + 5(300 − a) = 2,100 → 9a + 1,500 − 5a = 2,100 → 4a = 600 → **a = 150**, so c = 150.

Steps: (1) isolate a variable in the easier equation; (2) substitute the expression, with parentheses, into the other equation; (3) solve the one-variable equation; (4) back-substitute; (5) check in **both** original equations.

**Try it.** Solve x = 4y + 1 and 2x − 3y = 12.
*Answer:* 2(4y + 1) − 3y = 12 → 8y + 2 − 3y = 12 → 5y = 10 → y = 2, x = 9. Check: 18 − 6 = 12 ✓.

## Elimination, part 1 (2.14)

If two equations are both true, their sum is true: adding equal things to equal things keeps equality. If the coefficients of one variable are opposites, adding makes that variable vanish.

**Worked example.** Solve 3x + 2y = 16 and 5x − 2y = 8.
Add the equations: 8x + 0y = 24, so **x = 3**. Back-substitute into the first: 9 + 2y = 16, **y = 3.5**. Check in the second: 15 − 7 = 8 ✓.

If the coefficients are the same rather than opposite, **subtract** instead (or multiply one equation by −1 and add).

**Worked example.** Solve 4x + y = 14 and 4x − 3y = −2.
Subtract the second from the first: (4x − 4x) + (y − (−3y)) = 14 − (−2) → 4y = 16 → **y = 4**. Then 4x + 4 = 14, **x = 2.5**. Check: 10 − 12 = −2 ✓.

Careful with signs when subtracting: subtracting −3y adds 3y, and subtracting −2 adds 2. Many students prefer to multiply the second equation by −1 and then add, which turns every subtraction into an addition.

**Try it.** Solve x + y = 11 and x − y = 3.
*Answer:* Adding gives 2x = 14, x = 7, y = 4.

## Elimination, part 2 (2.15)

When no pair of coefficients cancels, multiply one equation (or both) by a constant to create a pair of opposites. Multiplying both sides of an equation by the same non-zero number produces an equivalent equation (week 6), so nothing is lost.

**Worked example.** Solve 2x + 3y = 12 and 5x − y = 13.
Multiply the second equation by 3: 15x − 3y = 39. Add to the first: 17x = 51, **x = 3**. Then 5(3) − y = 13, **y = 2**. Check in the first: 6 + 6 = 12 ✓.

**Worked example.** Solve 3x + 4y = 10 and 5x + 6y = 16.
Target the y terms: multiply the first by 3 (9x + 12y = 30) and the second by 2 (10x + 12y = 32). Subtract the first from the second: x = 2. Then 6 + 4y = 10, **y = 1**. Check: 10 + 6 = 16 ✓.

**Choosing a method.**

| Situation | Method |
|---|---|
| A variable is already isolated (y = …) | Substitution |
| A pair of coefficients are opposites or equal | Elimination by adding or subtracting |
| Coefficients are unrelated integers | Elimination after multiplying |
| You want a picture or an estimate | Graphing |

All three methods give the same answer; pick the one with the least arithmetic.

## Common mistakes

- Forgetting the parentheses when substituting: 3x + 2·2x − 1 instead of 3x + 2(2x − 1).
- Multiplying only one side of an equation before eliminating.
- Sign slips when subtracting equations; multiply by −1 and add instead.
- Finding x and stopping: a solution is a pair.
- Checking the answer in the equation you used for back-substitution only. Check both.
- Reading an intersection off a graph as (2, 7) when the exact answer is (2.1, 6.8).

## Where this goes next

Week 9 completes elimination with cases that need both equations scaled (2.16), then asks how many solutions a system can have (2.17): one, none (parallel lines) or infinitely many (the same line). Week 9 also begins inequalities. Systems return in units 4–7 whenever two functions are set equal to find where they meet.

## Self-check

1. Write a system for: a pen and a notebook cost $6 together; three pens and two notebooks cost $14.
2. Solve by substitution: y = x + 4 and 2x + y = 13.
3. Solve by elimination: 2x + 5y = 1 and −2x + 3y = 15.
4. Solve: 3x + 2y = 7 and 2x + 3y = 8.
5. Why does adding two equations of a system produce an equation that the solution also satisfies?

*Answers:* (1) p + n = 6, 3p + 2n = 14 (solution p = 2, n = 4). (2) 2x + x + 4 = 13, x = 3, y = 7. (3) Adding: 8y = 16, y = 2, x = −4.5. (4) Multiply the first by 2 and the second by 3: 6x + 4y = 14 and 6x + 9y = 24; subtract: 5y = 10, y = 2, x = 1. (5) At the solution both equations are true statements about equal quantities, and adding equal quantities to equal quantities keeps them equal.

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Algebra 1, Unit 2, Lessons 12–15, https://im.kendallhunt.com/HS/teachers/1/2/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
