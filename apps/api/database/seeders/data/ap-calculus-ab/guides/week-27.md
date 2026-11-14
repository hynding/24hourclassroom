# Week 27 · Modeling with Differential Equations, Verifying Solutions and Slope Fields

**Topics:** 7.1 Modeling Situations with Differential Equations · 7.2 Verifying Solutions for Differential Equations · 7.3 Sketching Slope Fields
**Practices:** 2 (Connecting Representations), 1 (Implementing Mathematical Processes), 4 (Communication and Notation)
**Framework:** AP Calculus AB and BC CED, Unit 7, Topics 7.1–7.3, learning objectives in our own words
**Spiral:** Unit 4 taught you to read a derivative as a rate in context with units; Unit 3 gave you the chain rule and implicit differentiation, which you need to check a proposed solution and to find d²y/dx² from a differential equation; Unit 6 gave you antiderivatives, so you already know that dy/dx = f(x) is solved by y = ∫ f(x) dx + C. This week the rate is allowed to depend on y as well as x.

## What you need to be able to do

- **7.1** Translate a verbal description of a rate ("proportional to", "inversely proportional to", "at a rate equal to the difference between…") into a differential equation, with the correct sign.
- **7.1** Interpret each term of a differential equation in context, find where the rate is zero (an equilibrium value) and say whether the quantity is increasing or decreasing at a given state.
- **7.2** Verify that a given function, or a whole family of functions with a constant C, is a solution of a differential equation by differentiating and substituting.
- **7.2** Use an initial condition to pick out a particular solution from a family.
- **7.3** Compute the slope at any grid point, organise the slopes in a table, and describe the slope field in words: where segments are horizontal, where they are positive or negative, and where they are steep.
- **7.3** Recognise from a slope field (or table of slopes) whether dy/dx depends on x only, on y only, or on both, and match a slope field to its equation.

## Key terms

| Term | Meaning |
|---|---|
| Differential equation | An equation relating an unknown function to its derivatives, such as dy/dx = x − y. |
| Solution | A function that makes the equation true for every x in an interval. |
| General solution | A family of solutions containing an arbitrary constant, such as y = Ce^(−x) + x − 1. |
| Particular solution | The member of the family fixed by an initial condition, such as y(0) = 4. |
| Initial condition | A known point (x₀, y₀) on the solution curve. |
| Equilibrium solution | A constant solution y = c, found where the rate is 0 for every x. |
| Slope field | A grid of short segments whose slopes are the values of dy/dx at the grid points. |
| Isocline | A curve along which every segment of the slope field has the same slope. |

## Modeling with differential equations (7.1)

A differential equation records **how a quantity changes**, rather than what it equals. The language of rates has a fixed translation:

| Words | Symbols |
|---|---|
| "the rate of change of y" | dy/dt |
| "is proportional to y" | = ky |
| "is proportional to the square root of y" | = k√y |
| "is inversely proportional to y" | = k/y |
| "decreases at a rate proportional to y" | dy/dt = −ky with k > 0 |
| "proportional to the difference between y and 21" | = k(y − 21) |

Put the direction of change into the sign. If the problem says *k is a positive constant* and the quantity *decreases*, the minus sign must appear in the equation.

**Worked example (a cooling cup of tea).** A hypothetical cup of tea at 85 °C cools in a room kept at 21 °C. Its temperature T changes at a rate proportional to the difference between its temperature and the room's. Write a differential equation and decide what happens while the tea is hotter than the room.

The difference is T − 21, so dT/dt = −k(T − 21) with k > 0. While T > 21, T − 21 is positive and −k(T − 21) is negative, so T decreases. As T approaches 21 the difference shrinks and the cooling slows. The constant function T = 21 makes the rate zero: it is the equilibrium solution. (If the tea were iced and colder than the room, T − 21 < 0 and the same equation says T increases toward 21.)

**Worked example (a spreading announcement).** In a hypothetical school of 1,200 students, an announcement spreads by word of mouth, and the number N of students who have heard it grows at a rate proportional to the number who have **not** heard it. The number who have not heard is 1200 − N, so dN/dt = k(1200 − N) with k > 0. When N = 900, the rate is 300k students per hour; when N = 1,100, it is only 100k. The rate falls as fewer students are left to tell.

**Reading a model.** For the hypothetical tank equation dW/dt = 3 − 0.1W (W in litres, t in minutes), 3 is a constant inflow of 3 litres per minute and 0.1W is an outflow proportional to the amount present. At W = 20 the rate is 3 − 2 = 1 litre per minute (filling); at W = 40 it is 3 − 4 = −1 (emptying). The rate is 0 at W = 30, the equilibrium.

## Verifying solutions (7.2)

A **solution** is a function. To check a candidate:

1. Differentiate it (as many times as the equation needs).
2. Substitute the function and its derivatives into **both** sides.
3. Simplify. It is a solution only if the two sides agree for every x in an interval.

Checking a single value of x is not a verification: two different expressions can agree at one point by accident.

**Worked example (a whole family).** Show that y = Ce^(−x) + x − 1 is a solution of dy/dx = x − y for every constant C, then find the particular solution with y(0) = 4.

Left side: dy/dx = −Ce^(−x) + 1. Right side: x − y = x − (Ce^(−x) + x − 1) = 1 − Ce^(−x). They are identical for every x and every C. With y(0) = 4: 4 = C · 1 + 0 − 1, so C = 5 and y = 5e^(−x) + x − 1.

**Worked example (a second-order equation, and a function that fails).** Is y = sin(2x) a solution of y″ + 4y = 0? Is y = sin x?

For y = sin(2x): y′ = 2cos(2x) and y″ = −4sin(2x), so y″ + 4y = −4sin(2x) + 4sin(2x) = 0. Yes.

For y = sin x: y″ = −sin x, so y″ + 4y = −sin x + 4sin x = 3sin x, which is not 0 for every x (it is 3 at x = π/2). No.

**Unknown constants in the function.** To find which exponentials y = e^(kx) solve y″ − y′ − 6y = 0, substitute: k²e^(kx) − ke^(kx) − 6e^(kx) = e^(kx)(k² − k − 6). Since e^(kx) is never zero, k² − k − 6 = (k − 3)(k + 2) = 0, so k = 3 or k = −2.

**Constant solutions.** y = c has derivative 0, so it solves dy/dx = f(x, y) exactly when f(x, c) = 0 for all x. y = 5 solves dy/dx = (y − 5)(x + 1); y = 0 does not.

## Slope fields (7.3)

A differential equation dy/dx = f(x, y) tells you the slope of the solution curve through **any** point. A slope field draws a short segment with that slope at each point of a grid. Because this course shows no pictures, we record a slope field as a **table of slopes** and describe its pattern in words; on the AP exam you will be asked to draw the segments, and the table is exactly what you compute first.

**Worked example (a slope table and a hidden line solution).** Build the slopes for dy/dx = x − y at the grid points with x and y in {−1, 0, 1, 2}.

| | x = −1 | x = 0 | x = 1 | x = 2 |
|---|---|---|---|---|
| y = 2 | −3 | −2 | −1 | 0 |
| y = 1 | −2 | −1 | 0 | 1 |
| y = 0 | −1 | 0 | 1 | 2 |
| y = −1 | 0 | 1 | 2 | 3 |

What the table shows, in words:

- The slope is 0 along the diagonal y = x (the entries (−1, −1), (0, 0), (1, 1), (2, 2)): horizontal segments there.
- Above that line (y > x) slopes are negative; below it they are positive.
- Moving right along a row, the slope rises by 1 for each step in x; moving up a column it falls by 1 for each step in y.
- Along the line y = x − 1 every slope equals x − (x − 1) = 1, which is the slope of that line itself. So the straight line y = x − 1 is a solution curve. (It is the member C = 0 of the family y = Ce^(−x) + x − 1 from the worked example above.)

The lines y = x (slope 0) and y = x − 1 (slope 1) are **isoclines**: setting dy/dx = m and solving for y gives a curve where every segment has slope m.

**Worked example (matching patterns).** Decide what each description says about the equation.

- *Every column of segments is parallel* (the slope at (2, −3) equals the slope at (2, 5)). The slope depends only on x: dy/dx = f(x), such as dy/dx = cos x. Solutions are vertical shifts of one another.
- *Every row is parallel*, horizontal along y = 2 and y = −2, negative between them. The slope depends only on y, with zeros at ±2 and negative values for −2 < y < 2: dy/dx = y² − 4 fits. Solutions are horizontal shifts of one another.
- *Horizontal along the y-axis and undefined along the x-axis.* The slope is 0 when x = 0 and undefined when y = 0: dy/dx = x/y fits.

To test a candidate against a table, check the zeros first, then one nonzero entry; one mismatch is enough to rule a candidate out.

**Second derivative from the equation.** You can find concavity without solving. Differentiate dy/dx implicitly, then substitute dy/dx back. For dy/dx = x(y − 2): d²y/dx² = (y − 2) + x · dy/dx = (y − 2) + x²(y − 2) = (y − 2)(1 + x²). So every solution above y = 2 is concave up and every solution below it is concave down. Next week you will use exactly this to reason about solution curves.

## Common mistakes

- **Wrong sign in a decay model.** "Decreases at a rate proportional to…" with k > 0 needs a minus sign; dT/dt = k(T − 21) with k > 0 would make hot tea hotter.
- **Using the starting value as the reference value.** A cooling model depends on T − (room temperature), not T − (initial temperature).
- **Confusing the rate with the amount.** dW/dt = 1 is a rate in litres per minute, not 1 litre.
- **Verifying at one point.** Substitute symbolically and simplify; a single matching value proves nothing.
- **Forgetting the chain rule when verifying.** y = 2 + 3e^(x²/2) has derivative 3x e^(x²/2), and that factor x is what matches the equation.
- **Using only one coordinate for a slope.** For dy/dx = x(y − 2), the slope at (3, 2) is 0, not 3.
- **Missing a factor's zeros.** A product is zero when *either* factor is zero: dy/dx = x(y − 2) is horizontal along the whole y-axis and the whole line y = 2.
- **Treating y as a constant when finding d²y/dx².** y is a function of x, so its derivative contributes a dy/dx term.

## Self-check

1. A hypothetical sample of a substance loses mass at a rate proportional to the cube of its mass. Write a differential equation with k > 0.
2. Show that y = 3x² + C/x solves x · dy/dx + y = 9x² for every C. Which C gives y(1) = 1?
3. For dy/dx = (x + 1)(y − 3), list the slopes at (−1, 0), (0, 0), (1, 0), (0, 3) and (1, 4). Where are the segments horizontal?
4. Is y = e^(2x) a solution of y″ − 4y = 0? Is y = e^(4x)?
5. A slope table has every row parallel and slope 0 along y = 1, with positive slopes above. Give one equation that fits.

*Answers:* 1. dm/dt = −km³. 2. y′ = 6x − C/x², so x · y′ + y = 6x² − C/x + 3x² + C/x = 9x²; y(1) = 3 + C = 1 gives C = −2. 3. 0, −3, −6, 0, 2; horizontal along x = −1 and along y = 3. 4. Yes: 4e^(2x) − 4e^(2x) = 0. No: 16e^(4x) − 4e^(4x) = 12e^(4x) ≠ 0. 5. dy/dx = y − 1 (any positive multiple of y − 1 also fits).

---

*Original study material for this course, organised around the College Board AP Calculus AB and BC Course and Exam Description (Unit 7, Topics 7.1–7.3). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). AP® is a trademark of the College Board, which does not endorse this material.*
