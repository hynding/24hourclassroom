# Unit 7 · Differential Equations · The night-before sheet

**AP exam weight:** 5–10% of the exam score
**Topics:** 7.1 Modeling Situations with Differential Equations · 7.2 Verifying Solutions for Differential Equations · 7.3 Sketching Slope Fields · 7.4 Reasoning Using Slope Fields · 7.6 Finding General Solutions Using Separation of Variables · 7.7 Finding Particular Solutions Using Initial Conditions and Separation of Variables · 7.8 Exponential Models with Differential Equations (7.5 and 7.9 are BC only)
**Practices:** 1 (Implementing Mathematical Processes), 2 (Connecting Representations), 3 (Justification), 4 (Communication and Notation)
**Framework:** AP Calculus AB and BC CED, Unit 7, Topics 7.1–7.8 (AB topics), in our own words

## The ideas that generate every question

1. **A differential equation describes change, not value.** dy/dx = f(x, y) gives the slope of the solution curve through every point. A solution is a function that makes the equation true on an interval.
2. **Words translate to rates (7.1).** "The rate of change of y" is dy/dt; "proportional to" is "a constant times"; "inversely proportional to" is "a constant divided by". The sign carries the direction: "decreases" with k > 0 needs a minus sign.
3. **Verify by substituting (7.2).** Differentiate the candidate, substitute into both sides, simplify. Agreement at one point is not a verification; agreement for every x is.
4. **A slope field is the equation drawn (7.3).** Compute dy/dx at grid points. Look for where slopes are 0 (horizontal segments, possibly equilibrium lines), where they are positive or negative, and whether the slopes depend on x only (parallel columns), y only (parallel rows) or both.
5. **Solution curves follow the field (7.4).** They are tangent to the segments, never cross an equilibrium line, and their concavity comes from d²y/dx², found by differentiating the equation implicitly.
6. **Separable equations are solved by integration (7.6).** dy/dx = g(x)h(y) becomes ∫ dy/h(y) = ∫ g(x) dx, with one constant added at once.
7. **Initial conditions fix the constant, the branch and the domain (7.7).** The particular solution lives on the largest open interval containing the initial x on which it is defined.
8. **Proportional growth is exponential (7.8).** dy/dt = ky has exactly the solutions y = y₀e^(kt); dy/dt = k(y − M) has y = M + (y₀ − M)e^(kt).

## Formulas and procedures to know cold

| Want | Do this |
|---|---|
| Model "rate proportional to y" | dy/dt = ky |
| Model "approaches M at a rate proportional to the difference" | dy/dt = −k(y − M), k > 0 |
| Equilibrium (constant) solution | set dy/dx = 0 for all x; y = c works when f(x, c) = 0 |
| Verify a solution | differentiate, substitute into both sides, simplify to an identity |
| Slope at (a, b) | substitute x = a and y = b into the right side |
| Concavity of a solution | d²y/dx² by implicit differentiation, then replace dy/dx |
| Relative extremum of a solution | dy/dx = 0 and a sign change (or second derivative test) |
| Separate variables | dy/h(y) = g(x) dx; integrate both sides; + C at once |
| Exponentiating ln|y| = F(x) + C | y = Ae^(F(x)), A any real number (A = ±e^C; A = 0 restores y = 0) |
| Square-root branch | match the sign of the initial y-value |
| Domain of a particular solution | largest open interval containing the initial x where y and y′ are defined |
| Exponential solution | dy/dt = ky, y(0) = y₀ → y = y₀e^(kt) |
| k from data | k = ln(y₁/y₀)/t₁ |
| Doubling time / half-life | ln 2 / |k| |
| Newton's law of cooling | T = M + (T₀ − M)e^(−kt); T → M |

## The sentences that earn AP points

- **Separation of variables (the five-point pattern on many FRQs):** separate correctly; antidifferentiate both sides; include the constant of integration; use the initial condition; solve for y. Write all five steps. A response with no constant of integration loses most of the points, and a response that never separates earns none.
- **Absolute values:** "Since y(0) = 190 > 25 and the solution cannot cross the equilibrium T = 25, T − 25 > 0, so |T − 25| = T − 25."
- **Domain:** "The solution is defined on −1 < x < 1, the interval containing the initial value x = 0 on which 1 − x² ≠ 0."
- **Concavity and tangent-line estimates:** "d²y/dx² = 4 > 0 at (0, 1), so the graph of f is concave up there and lies above its tangent line; the approximation 1.1 is an underestimate."
- **Extrema of a solution:** "dy/dx = 0 at x = 3 and dy/dx changes from negative to positive there, so the solution has a relative minimum at x = 3."
- **Interpreting a rate:** "At t = 10, the temperature of the pie is decreasing at 4.746 °C per minute." Always include units and the time.
- **Long-run behaviour:** "As t → ∞, e^(−0.15t) → 0, so M(t) → 200 kg: the treatment brings the mineral down toward 200 kg."

## Classic question types and how to attack them

**"Show that y = … is a solution."** Differentiate and substitute symbolically. For a family, show it works for every C; for an initial condition, also check the point.

**"Sketch (or describe) the slope field at the nine points…"** Make a table of slopes first. Then describe: horizontal where, positive where, steeper where.

**"Sketch the solution through (a, b)" / "find lim (x→∞)".** Follow the segments; look for equilibrium lines the curve approaches.

**"Is the solution concave up at the point? Is the tangent-line approximation an over- or underestimate?"** Find d²y/dx² from the equation, evaluate, and connect the sign to the tangent line.

**"Find the particular solution."** The five steps, then the branch and the domain.

**"A quantity grows (decays) at a rate proportional to its size…"** Write dy/dt = ky, use the data to find k, and answer with units. For temperatures, use the shifted model.

## Common mistakes

- Writing dT/dt = k(T − M) with k > 0 for a cooling object.
- Verifying a solution at a single value of x.
- Using only one coordinate when computing a slope, or missing that a product is 0 when either factor is.
- Letting a sketched solution cross an equilibrium line.
- Treating dy/dx as 1 (or y as a constant) when finding d²y/dx².
- Separating a non-separable equation such as dy/dx = x + y.
- Writing e^(F(x) + C) as e^(F(x)) + C; forcing A > 0; forgetting the lost solution y = c.
- Adding the constant only at the end, or never.
- Choosing the wrong square-root branch; giving a domain with holes instead of one interval.
- Using 1.08 as the growth factor for dy/dt = 0.08y; dropping ln in a doubling time; dividing by the number of half-lives.

## Calculator or not?

Most Unit 7 questions on the AP exam are no-calculator: slope fields, verifying, separation of variables and domains are done by hand. The calculator appears in context questions, for example solving 200 + 400e^(−0.15t) = 300 for t or evaluating a solution at a point; report three decimal places.

## Self-test

1. A hypothetical tank leaks so that the volume decreases at a rate proportional to the cube root of the volume. Write the model.
2. Show that y = 4 + Ce^(x³) solves dy/dx = 3x²(y − 4).
3. For dy/dx = (y + 1)(x − 2), where are the slope-field segments horizontal, and what is the slope at (0, 1)?
4. Is the solution of dy/dx = x − y through (2, 1) increasing? Concave up?
5. Solve dy/dx = y cos x with y(0) = −3.
6. Solve dy/dx = x/y² with y(0) = 2.
7. A hypothetical sample's half-life is 20 years. What fraction remains after 50 years?
8. A hypothetical object at 100 °C cools in a 30 °C room and is at 65 °C after 8 minutes. When is it at 47.5 °C?

**Answers.** 1. dV/dt = −kV^(1/3), k > 0. 2. y′ = 3x²Ce^(x³) and 3x²(y − 4) = 3x²Ce^(x³). 3. Horizontal along y = −1 and x = 2; slope (2)(−2) = −4. 4. dy/dx = 1 > 0, increasing; d²y/dx² = 1 − dy/dx = 0 there, so the test is inconclusive at that point. 5. y = −3e^(sin x). 6. y³/3 = x²/2 + 8/3, y = ∛(3x²/2 + 8), all real x. 7. (1/2)^2.5 ≈ 0.177. 8. The difference halves every 8 minutes (70 → 35 → 17.5), so at t = 16 minutes.

---

*Original study material for this course, organised around the College Board AP Calculus AB and BC Course and Exam Description (Unit 7, Topics 7.1–7.8, AB topics). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). AP® is a trademark of the College Board, which does not endorse this material.*
