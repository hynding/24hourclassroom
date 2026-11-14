# Week 28 · Reasoning with Slope Fields and Separation of Variables

**Topics:** 7.4 Reasoning Using Slope Fields · 7.6 Finding General Solutions Using Separation of Variables · 7.7 Finding Particular Solutions Using Initial Conditions and Separation of Variables
**Practices:** 1 (Implementing Mathematical Processes), 2 (Connecting Representations), 3 (Justification)
**Framework:** AP Calculus AB and BC CED, Unit 7, Topics 7.4, 7.6 and 7.7, learning objectives in our own words (Topic 7.5, Euler's method, is BC only and is skipped)
**Spiral:** Week 27's slope tables and d²y/dx² from a differential equation; Unit 5's first and second derivative tests, now applied to curves you have not solved for; Unit 6's antiderivatives (power rule, ln|u|, eˣ, arctan) and substitution, which do all the work once the variables are separated; Unit 3's inverse functions, which you use to solve for y at the end.

## What you need to be able to do

- **7.4** Sketch (or describe) the solution curve through a given point by following a slope field, and recognise equilibrium lines that solutions approach but do not cross.
- **7.4** Decide whether a solution is increasing or decreasing, concave up or down, or has a relative extremum at a point, using dy/dx and d²y/dx² straight from the differential equation.
- **7.4** Predict long-run behaviour (lim as x → ∞) of a solution from the slope field.
- **7.6** Recognise a separable equation dy/dx = g(x)h(y), separate the variables, integrate both sides and write the general solution with one constant.
- **7.6** Handle ln|y| correctly: exponentiating gives a constant that can be any real number, and constant solutions lost by dividing must be checked separately.
- **7.7** Use an initial condition to find the constant, choose the correct square-root branch, and state the interval on which the particular solution is defined.

## Key terms

| Term | Meaning |
|---|---|
| Solution curve | The graph of one particular solution; it is tangent to every slope segment it meets. |
| Equilibrium solution | A constant solution y = c; in a slope field, a horizontal line of zero slopes. |
| Separable equation | dy/dx = g(x) · h(y): the rate factors into an x part times a y part. |
| Separation of variables | Rewriting as dy/h(y) = g(x) dx and integrating both sides. |
| General solution | The family produced by separation, with one arbitrary constant. |
| Particular solution | The member satisfying a given initial condition, on an interval containing the initial x. |
| Domain of a solution | The largest open interval containing the initial x on which the solution is differentiable. |

## Reasoning with slope fields (7.4)

A slope field lets you answer questions about a solution **without a formula**. Three tools do almost everything.

**1. Follow the segments.** From the given point, move in small steps in the direction each segment points, in both directions. A solution curve never cuts across the segments.

**2. Watch for equilibrium lines.** Where dy/dx = 0 for every x along a horizontal line y = c, the constant function y = c is a solution. For the equations in this course, other solutions do not cross such a line. If slopes point toward it from both sides, nearby solutions approach it; if they point away, solutions move away.

**3. Use the derivatives the equation gives you.** dy/dx tells you increasing or decreasing; differentiating the equation implicitly gives d²y/dx² for concavity. A relative extremum needs dy/dx = 0; the sign of d²y/dx² there decides maximum or minimum.

**Worked example (a field depending on both variables).** Consider dy/dx = x + y.

*A line solution.* Along a line y = mx + b the slope field gives x + mx + b. For this to equal the constant m for every x we need 1 + m = 0 and b = m, so m = −1, b = −1: the line y = −x − 1 is a solution. Check: its slope is −1, and x + (−x − 1) = −1.

*The solution through the origin.* At (0, 0), dy/dx = 0. Differentiating, d²y/dx² = 1 + dy/dx = 1 + x + y, which is 1 > 0 at the origin. So that solution has a horizontal tangent and is concave up there: a **relative minimum** at (0, 0).

*Above or below the line.* Points above y = −x − 1 have x + y > −1, so their slopes are greater than −1; a solution starting above the line therefore pulls away upward, and one starting below falls away downward. No solution crosses the line, because two solution curves cannot cross for this equation.

**Worked example (approaching an equilibrium).** Consider dy/dx = 2 − y. The slopes depend only on y: 0 along y = 2, positive below, negative above, and steeper the farther you are from 2.

- The solution with y(0) = 7 starts with slope −5, decreases, flattens as it nears 2, and never crosses 2: lim (x→∞) y = 2. Its second derivative is d²y/dx² = −dy/dx = y − 2 > 0, so it is concave up all the way.
- The solution with y(0) = −1 starts with slope 3, increases toward 2 from below, and is concave down (y − 2 < 0).
- Going left (x → −∞), both move away from 2 without bound.

## Separation of variables: the general solution (7.6)

When dy/dx = g(x) · h(y), move every y to the dy side and every x to the dx side:

dy/h(y) = g(x) dx, then ∫ dy/h(y) = ∫ g(x) dx.

The routine, which earns the points on a free-response question:

1. **Separate.** dy and dx must both be multiplied (never left in a denominator alone), with the right variable on each side.
2. **Integrate both sides.** Each side is an ordinary antiderivative from Unit 6.
3. **Add one constant, immediately.** Write + C on one side as soon as you integrate. Constants from both sides merge into one.
4. **Use the initial condition (if any) and solve for y.**

**Worked example (a square-root family).** Solve dy/dx = x/y.

Separate: y dy = x dx. Integrate: y²/2 = x²/2 + C. Multiply by 2 and rename the constant: y² = x² + K. Solving for y needs a choice of sign, y = √(x² + K) or y = −√(x² + K); without an initial condition, both families are part of the general solution.

**Worked example (logarithms and the sign of the constant).** Solve dy/dx = 3x²y.

Separate (for y ≠ 0): dy/y = 3x² dx. Integrate: ln|y| = x³ + C. Exponentiate: |y| = e^(x³ + C) = e^C · e^(x³). Remove the absolute value: y = ±e^C e^(x³).

Now tidy the constant. ±e^C can be any nonzero real number, so call it A. Finally, dividing by y excluded y = 0, but y = 0 does solve the equation (both sides are 0), so allow A = 0 too. **General solution: y = Ae^(x³), A any real number.** Two traps are avoided here: writing e^(x³) + C (the constant multiplies, it does not add), and insisting A > 0 (that loses every negative solution).

**Lost solutions in general.** Whenever you divide by h(y), check each value c with h(c) = 0: the constant function y = c is a solution that separation cannot produce.

**Not every equation separates.** dy/dx = x + y, dy/dx = sin(xy) and dy/dx = x² + y² cannot be factored as g(x)h(y). By contrast, dy/dx = x²y − y = y(x² − 1) does separate once factored.

## Particular solutions and their domains (7.7)

An initial condition picks one member of the family. Substitute it **as soon as you have integrated**, while the constant is still visible, then solve for y. Three decisions follow.

- **The constant.** Use the initial point to find C (or A).
- **The branch.** If solving for y involves a square root, take the sign that matches the initial y-value.
- **The domain.** The particular solution lives on the largest open interval that contains the initial x-value on which it (and its derivative) is defined. Find where the formula breaks down (division by zero, square root of a negative, logarithm of a non-positive number, tangent at an odd multiple of π/2) and keep only the piece containing the initial point.

**Worked example (the branch).** Solve dy/dx = x/y with y(1) = −2.

From above, y² = x² + K. At (1, −2): 4 = 1 + K, so K = 3 and y² = x² + 3. The initial value is negative, so y = −√(x² + 3). Since x² + 3 > 0 always, the domain is all real numbers. Check: y′ = −x/√(x² + 3) and x/y = x/(−√(x² + 3)), equal.

**Worked example (a restricted domain).** Solve dy/dx = 2xy² with y(0) = 1.

Separate: dy/y² = 2x dx. Integrate: −1/y = x² + C. At (0, 1): −1 = C. So −1/y = x² − 1 and y = 1/(1 − x²).

The formula fails at x = ±1. The particular solution is defined on the interval containing x = 0 between those values: **−1 < x < 1.** Although the formula also gives values for |x| > 1, those pieces are not part of this solution. Check: y′ = 2x/(1 − x²)² and 2xy² = 2x/(1 − x²)².

**Worked example (exponentials on both sides).** Solve dy/dx = e^(x − y) with y(0) = ln 2.

Rewrite e^(x − y) = eˣ · e^(−y), then separate: eʸ dy = eˣ dx. Integrate: eʸ = eˣ + C. At (0, ln 2): 2 = 1 + C, so C = 1 and eʸ = eˣ + 1. Take ln: y = ln(eˣ + 1). Since eˣ + 1 > 0 always, the domain is all real numbers.

**What a complete free-response answer shows.** Separation written out, both antiderivatives, the constant of integration, the constant found from the initial condition, and y solved explicitly. On the AP exam a response that never writes a constant of integration loses most of the credit, however good the rest is.

## Common mistakes

- **Adding the constant after exponentiating.** ln|y| = x² + C gives y = Ae^(x²), not e^(x²) + C.
- **Forcing A > 0.** |y| = e^C e^(…) means y = ±e^C e^(…); negative initial values need negative A.
- **Forgetting the constant until the end.** Add it the moment you integrate, and use the initial condition before solving for y.
- **Wrong square-root branch.** Match the sign of the initial y-value.
- **Separating a non-separable equation.** x + y cannot become g(x)h(y); "dy/y = x dx" for dy/dx = x + y is wrong.
- **Giving a domain with holes.** A particular solution is defined on one interval containing the initial point, not "all x except ±2".
- **Letting a solution cross an equilibrium line** when sketching from a slope field.
- **Treating dy/dx as 1 when computing d²y/dx².** Replace dy/dx by the right side of the equation.

## Self-check

1. For dy/dx = y − 3, describe the solutions through (0, 5) and (0, 1) as x → ∞ and as x → −∞.
2. Find the general solution of dy/dx = (y + 2)/x² and say which constant solution separation misses.
3. Solve dy/dx = −x/y with y(0) = 5 and give its domain.
4. Solve dy/dx = y² cos x with y(0) = 1/2 and give its domain.
5. Is dy/dx = eˣ⁺ʸ separable? If so, separate it.

*Answers:* 1. Through (0, 5): increasing without bound as x → ∞, approaching 3 from above as x → −∞. Through (0, 1): decreasing without bound as x → ∞, approaching 3 from below as x → −∞. 2. ln|y + 2| = −1/x + C, so y = −2 + Ae^(−1/x); separation misses y = −2 (restored by A = 0). 3. y² = 25 − x², y = √(25 − x²) on −5 < x < 5. 4. −1/y = sin x + C, C = −2, y = 1/(2 − sin x), all real numbers since 2 − sin x ≥ 1. 5. Yes: eˣ⁺ʸ = eˣeʸ, so e^(−y) dy = eˣ dx.

---

*Original study material for this course, organised around the College Board AP Calculus AB and BC Course and Exam Description (Unit 7, Topics 7.4, 7.6–7.7). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). AP® is a trademark of the College Board, which does not endorse this material.*
