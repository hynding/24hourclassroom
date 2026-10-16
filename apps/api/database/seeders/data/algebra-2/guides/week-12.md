# Week 12 · Solving Equations with Squares, Cubes and Radicals

**Lessons:** 3.6 Squares and Square Roots · 3.7 Inequivalent Equations · 3.8 Cubes and Cube Roots · 3.9 Solving Radical Equations
**Practices:** MP3 (construct arguments), MP6 (attend to precision), MP1 (make sense of problems)
**Built from:** IM Algebra 2, Unit 3, Lessons 6–9, in our own words
**Spiral:** Extraneous solutions first appeared with rational equations (week 9); squaring both sides produces them for the same underlying reason. Last week's distinction between √a (one value) and x² = a (two solutions) is the heart of this week. Factoring quadratics (week 5) finishes most of the equations.

## What you need to be able to do

- **3.6** Solve equations such as x² = a, (x − 3)² = 16 and √x = 6 by undoing the square or the root, remembering that undoing a square gives two possibilities while a square root symbol gives one.
- **3.7** Explain why squaring both sides of an equation can produce a new equation with more solutions than the original (the two equations are not equivalent), and why that means every candidate must be checked.
- **3.8** Solve equations with cubes and cube roots, and explain why cubing both sides never adds solutions.
- **3.9** Solve radical equations by isolating the radical, raising both sides to the matching power, solving the result and checking each candidate in the original equation; recognise equations with no solution.

## Key terms

| Term | Meaning |
|---|---|
| Radical equation | An equation with the variable inside a root, such as √(2x + 7) = x − 4. |
| Isolating the radical | Rearranging so the root is alone on one side before squaring or cubing. |
| Equivalent equations | Equations with exactly the same solutions. x = 5 and 2x = 10 are equivalent. |
| Inequivalent equations | Equations whose solution sets differ. x = 5 and x² = 25 are not equivalent. |
| Extraneous solution | A solution of the squared equation that fails in the original. |
| Reversible step | A step that can be undone without losing or gaining solutions: adding, multiplying by a nonzero number, cubing. Squaring is not reversible. |

## Undoing squares and square roots (3.6)

**Undoing a square.** If (x − 3)² = 16, then x − 3 is a number whose square is 16, so x − 3 = 4 or x − 3 = −4, giving x = 7 or x = −1. Two solutions, because two numbers square to 16.

**Undoing a square root.** If √x = 6, square both sides: x = 36. One solution, and it checks: √36 = 6. But √x = −6 has **no** solution, because √x is never negative; squaring would give x = 36, which fails the check (√36 = 6 ≠ −6).

| Equation | Solutions | Why |
|---|---|---|
| x² = 81 | 9, −9 | two numbers square to 81 |
| (x + 1)² = 25 | 4, −6 | x + 1 = ±5 |
| 4(x − 1)² = 100 | 6, −4 | (x − 1)² = 25 |
| x² = −9 | none (real) | no real square is negative |
| √x = 6 | 36 | square both sides |
| √x = −6 | none | √x ≥ 0 always |
| √(x − 2) = 3 | 11 | x − 2 = 9 |

**Worked example.** Solve 3(x + 2)² − 12 = 0.

3(x + 2)² = 12, so (x + 2)² = 4, so x + 2 = ±2, giving x = 0 or x = −4. Check x = 0: 3 · 4 − 12 = 0 ✓.

**Try it.**
1. Solve (2x − 1)² = 49.
2. Solve √(x + 4) = 7 and √(x + 4) = −7.

*Answers:* 1. 2x − 1 = ±7, so x = 4 or x = −3. 2. x = 45; no solution.

## Why squaring is dangerous (3.7)

Start with x = 3. Square both sides: x² = 9. The new equation has solutions 3 **and −3**. Squaring kept the old solution but added one, because squaring erases the sign: 3 and −3 become the same number.

So x = 3 and x² = 9 are **not equivalent**. In general:

- If a = b, then a² = b². (Squaring never loses a solution.)
- But a² = b² does not force a = b; it could be a = −b. (Squaring can gain solutions.)

The solutions gained are **extraneous**: they solve the squared equation but not the original. Every time you square both sides you must check the candidates in the original equation.

**Worked example.** Solve √x = x − 2, and explain the result.

Square: x = x² − 4x + 4, so x² − 5x + 4 = 0, so (x − 1)(x − 4) = 0, giving candidates 1 and 4. Check x = 4: √4 = 2 and 4 − 2 = 2 ✓. Check x = 1: √1 = 1 but 1 − 2 = −1 ✗. The candidate 1 is extraneous: it actually solves √x = −(x − 2), the "other sign" equation that squaring cannot tell apart from the original. The solution is x = 4.

Steps that **are** reversible (keep equivalence): adding or subtracting the same thing from both sides, multiplying or dividing by a nonzero number, cubing (next section). Steps that are not: squaring, and multiplying by an expression that can be zero (week 9).

**Try it.**
1. Does x − 1 = 2 have the same solutions as (x − 1)² = 4? Explain.
2. Solve √(x + 5) = x − 1 and identify any extraneous candidate.

*Answers:* 1. No: the first has only x = 3; the second also has x = −1. 2. x + 5 = x² − 2x + 1 → x² − 3x − 4 = (x − 4)(x + 1) = 0; x = 4 works (√9 = 3); x = −1 is extraneous (√4 = 2 ≠ −2).

## Cubes and cube roots (3.8)

Cubing keeps the sign: 2³ = 8 and (−2)³ = −8 are different. So every number has exactly one real cube, and every number has exactly one real cube root. That makes cubing both sides a **reversible** step: a = b exactly when a³ = b³. No extraneous solutions can appear from cubing.

| Equation | Solution | Note |
|---|---|---|
| x³ = −64 | −4 | just one |
| ∛(x + 1) = 3 | 26 | x + 1 = 27 |
| ∛(x − 2) = −2 | −6 | x − 2 = −8; a negative cube root is fine |
| ∛(2x − 1) = 3 | 14 | 2x − 1 = 27 |
| 2x³ + 54 = 0 | −3 | x³ = −27 |

**Worked example.** Compare the solutions of ∛(2x − 1) = 3 and √(2x − 1) = 3.

Cube the first: 2x − 1 = 27, x = 14; check ∛27 = 3 ✓. Square the second: 2x − 1 = 9, x = 5; check √9 = 3 ✓. Both have one solution here, but only the second needed a check in principle: √(2x − 1) = −3 would have produced the same squared equation and the candidate x = 5 would have failed.

**Try it.**
1. Solve ∛(x) = −5.
2. Solve (x + 4)³ = 125.

*Answers:* 1. x = −125. 2. x + 4 = 5, x = 1.

## The general method for radical equations (3.9)

1. **Isolate** the radical on one side.
2. **Raise** both sides to the power that undoes the root (square for √, cube for ∛).
3. **Solve** the resulting polynomial equation.
4. **Check** every candidate in the original equation (essential after squaring; good practice always).

**Worked example.** Solve √(2x + 7) = x − 4.

The radical is already isolated. Square: 2x + 7 = x² − 8x + 16, so x² − 10x + 9 = 0, so (x − 1)(x − 9) = 0, candidates 1 and 9. Check x = 9: √25 = 5 and 9 − 4 = 5 ✓. Check x = 1: √9 = 3 but 1 − 4 = −3 ✗. Solution: x = 9.

**Worked example.** Solve √(x + 3) + 3 = x.

Isolate: √(x + 3) = x − 3. Square: x + 3 = x² − 6x + 9, so x² − 7x + 6 = (x − 1)(x − 6) = 0. Check x = 6: √9 + 3 = 6 ✓. Check x = 1: √4 + 3 = 5 ≠ 1 ✗. Solution: x = 6.

**Worked example.** Solve √x + 2 = 0.

Isolate: √x = −2. A square root is never negative, so there is no solution. (Squaring would give the false candidate x = 4.)

**Worked example.** Solve √(x² + 9) = 5.

Square: x² + 9 = 25, so x² = 16 and x = ±4. Check both: √(16 + 9) = 5 ✓ for either sign. Two solutions, 4 and −4; here squaring created nothing extraneous.

**A graphing check.** Graph y = √(2x + 7) and y = x − 4. They cross once, near x = 9; there is no crossing near x = 1, because at x = 1 the line is below the axis while the root is positive. The picture shows why x = 1 was extraneous.

**Try it.**
1. Solve √(3x − 2) = 4.
2. Solve √(x + 7) = x + 1.
3. Solve ∛(5 − x) = 2.

*Answers:* 1. 3x − 2 = 16, x = 6. 2. x + 7 = x² + 2x + 1 → x² + x − 6 = (x + 3)(x − 2) = 0; x = 2 works (√9 = 3), x = −3 is extraneous (√4 = 2 ≠ −2). 3. 5 − x = 8, x = −3.

## Common mistakes

- **Squaring before isolating.** (√x + 2)² is x + 4√x + 4, not x + 4. Get the radical alone first.
- **Skipping the check** after squaring and reporting an extraneous candidate.
- **Rejecting a negative candidate automatically.** In √(x² + 9) = 5, x = −4 is a genuine solution; check, do not guess.
- **Giving one solution to (x − 3)² = 16.** Undoing a square gives ±.
- **Checking cube-root equations for the wrong reason.** Cubing never adds solutions; a check there only catches arithmetic slips.

## Where this goes next

Next week the equation x² = −1, which this week has no real solution, gets a solution: the number i. The habit of asking "is this step reversible?" returns in Unit 4 when solving exponential equations, and the radical-equation method returns in Unit 5 when inverting functions.

## Self-check

1. Solve 2(x − 5)² = 72.
2. Explain why √x = 4 and x = 16 are equivalent but x = 4 and x² = 16 are not.
3. Solve ∛(3x + 2) = −1.
4. Solve √(x + 11) = x − 1 and identify the extraneous candidate.
5. Explain, with a graph in mind, why √(x − 1) = −3 has no solution.

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Algebra 2, Unit 3, Lessons 6–9, https://im.kendallhunt.com/HS/teachers/3/3/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
