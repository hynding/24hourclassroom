# Week 09 · Building and Choosing Function Models

**Topics:** 1.13 Function Model Selection and Assumption Articulation · 1.14 Function Model Construction and Application
**Practices:** 2 (multiple representations), 3 (communication and reasoning), 1 (procedural and symbolic fluency)
**Framework:** AP Precalculus CED, Unit 1, Topics 1.13–1.14, learning objectives in our own words
**Spiral:** This week uses all of Unit 1. Weeks 1–3 supply the evidence for choosing a model (constant rates of change for linear, constant second differences for quadratic, concavity and inflection for cubic). Weeks 5 and 6 explain when a rational model fits (a quantity levelling off toward an asymptote, or blowing up near a value). Week 8's transformations let you adjust a parent function to fit a situation. From Algebra 2: solving systems of equations and using a calculator to fit a line.

## What you need to be able to do

- **1.13** Choose a function type (linear, quadratic, cubic or higher polynomial, rational, or piecewise) for a situation, using the characteristics of the data or the context: rates of change, number of extrema, symmetry, concavity, asymptotic behaviour.
- **1.13** State the assumptions a model makes and the limitations they create, and restrict the domain and range to values that make sense in context.
- **1.14** Construct a model from given information: from two or three data points by solving a system, from zeros and one point, from a verbal description, or by describing the output of a regression on a graphing calculator.
- **1.14** Use residuals (actual minus predicted) to judge how well a model fits and whether a different type would fit better.
- **1.14** Use a model to answer questions in context, including predictions and rates of change, always with units, and judge whether an answer is reasonable.

## Key terms

| Term | Meaning |
|---|---|
| Mathematical model | A function that describes how one quantity depends on another in a real situation. |
| Regression | A method (usually on a calculator) that finds the function of a chosen type that best fits a set of data points. |
| Residual | Actual value minus predicted value, y − ŷ. Positive means the model underestimates; negative means it overestimates. |
| Residual plot | A graph of residuals against the input. A good model gives residuals scattered randomly around 0 with no pattern. |
| Correlation coefficient r | For a linear fit, a number between −1 and 1 measuring how close the points are to a line. It does not prove that a line is the right model type. |
| Contextual domain | The inputs that make sense in the situation, which may be much smaller than the function's algebraic domain. |
| Interpolation / extrapolation | Predicting inside the range of the data / outside it. Extrapolation is less reliable. |
| Piecewise function | A function defined by different formulas on different parts of its domain. |

## Choosing a model: what to look for (1.13)

| Model | Data clue (equally spaced inputs) | Context clue |
|---|---|---|
| Linear | first differences constant | a constant rate: so much per hour, per item, per dollar |
| Quadratic | second differences constant; one maximum or minimum; symmetry about a vertical line | area from a length; height of a thrown object; revenue = price × demand when demand is linear in price |
| Cubic | third differences constant; a point of inflection; up to two turning points | volume from a length; a quantity that rises, levels off, then rises again |
| Polynomial of degree n | nth differences constant; up to n − 1 turning points | several changes of direction over a fixed interval |
| Rational | outputs level off toward a horizontal asymptote, or grow without bound near an input | average cost per item; time to finish a job shared among n workers; concentration that approaches a limit |
| Piecewise | different patterns on different intervals | a rule that changes at a threshold: a fee after 30 minutes, a pump that switches speed |

Real data are never perfect, so "constant" differences will only be approximately constant. Use the context as well as the numbers.

**Worked example.** For each hypothetical situation, choose a model type and justify it.

1. A phone plan charges a fixed $20 per month plus $0.10 per text. Linear: the cost rises by the same $0.10 for every extra text.
2. A rectangular pen uses 60 m of fencing on three sides, against a wall. Its area is A = x(60 − 2x) for side length x. Quadratic: area is a product of two linear expressions in x, with a single maximum.
3. The average cost per poster at a print shop is the $500 setup fee plus $2 per poster, divided by the number of posters: C(x) = (500 + 2x)/x. Rational: as the number of posters grows, the average cost levels off toward $2 per poster (horizontal asymptote y = 2) and the setup fee is spread thinner.

**Worked example (data).** Decide which model fits these hypothetical heights of a tossed ball.

| t (s) | 0 | 1 | 2 | 3 | 4 |
|---|---|---|---|---|---|
| h (m) | 1.5 | 16.2 | 21.1 | 16.2 | 1.5 |

First differences: 14.7, 4.9, −4.9, −14.7. Second differences: −9.8, −9.8, −9.8. Constant second differences, one maximum, symmetry about t = 2: a quadratic. A quadratic regression gives h(t) = −4.9t² + 19.6t + 1.5, which fits the table exactly because the data were generated from that model.

## Assumptions, limitations and domain (1.13)

Every model makes assumptions. State them in the language of the context.

- The ball model assumes no air resistance and that the ball is thrown straight up. It is valid only from release until the ball hits the ground: the contextual domain is about 0 ≤ t ≤ 4.08 (where h = 0), not all real t.
- The poster model assumes the price per poster stays $2 however many are printed (no bulk discount). Its contextual domain is whole numbers x ≥ 1, even though the formula works for any x ≠ 0.
- A linear model for a growing seedling assumes constant growth; it will badly overestimate the height after a few months.

**Worked example.** An open box is made from a 16 cm by 10 cm sheet by cutting squares of side x cm from each corner and folding up the sides. Its volume is V(x) = x(16 − 2x)(10 − 2x). State the contextual domain.

Each side must be positive: x > 0, 16 − 2x > 0 and 10 − 2x > 0. The last condition is the strictest, so 0 < x < 5. The cubic also has a zero at x = 8, but a cut of 8 cm is impossible on a 10 cm side. Within the domain, V(1) = 112, V(2) = 144 and V(3) = 120 cubic centimetres; a calculator shows the maximum is 144 cm³ at x = 2.

## Building a model (1.14)

**From points, by a system.** A quadratic y = ax² + bx + c through three points gives three linear equations.

**Worked example.** Find the quadratic through (0, 2), (1, 5) and (3, 5).

From (0, 2): c = 2. From (1, 5): a + b + 2 = 5, so a + b = 3. From (3, 5): 9a + 3b + 2 = 5, so 9a + 3b = 3, that is 3a + b = 1. Subtracting: 2a = −2, so a = −1 and b = 4. The model is y = −x² + 4x + 2. (Symmetry check: the equal outputs at x = 1 and x = 3 put the vertex at x = 2.)

**From zeros and one point.** A cubic with zeros 0, 4 and 9 that passes through (5, 40): y = k · x(x − 4)(x − 9). At x = 5, k · 5 · 1 · (−4) = −20k = 40, so k = −2.

**From a description, by transformation.** "A hypothetical bike-share charges $2 to unlock, which covers the first 30 minutes, then $0.15 per minute." That is piecewise:

C(t) = 2 for 0 < t ≤ 30, and C(t) = 2 + 0.15(t − 30) for t > 30.

A 50-minute ride costs 2 + 0.15 · 20 = $5.00. The second piece is a linear function shifted right 30 and up 2.

**By regression.** With real data, enter the inputs and outputs as two lists, choose the regression type (LinReg, QuadReg, CubicReg) and read the coefficients. On the AP exam you will be told the result or asked what a regression would show; you do not need the keystrokes.

**Worked example (linear regression and residuals).** Hypothetical temperatures of water in a tank as it is heated:

| t (min) | 0 | 5 | 10 | 15 | 20 |
|---|---|---|---|---|---|
| T (°C) | 18.0 | 21.4 | 25.1 | 28.3 | 31.9 |

A linear regression gives T̂ = 0.694t + 18.0 with r ≈ 0.9998.

- **Slope in context:** the model predicts the temperature rises about 0.694 °C per minute.
- **Intercept in context:** the predicted starting temperature is 18.0 °C.
- **Residual at t = 10:** predicted 0.694 · 10 + 18.0 = 24.94; residual 25.1 − 24.94 = 0.16 °C, so the model underestimates there.
- All five residuals (0, −0.07, 0.16, −0.11, 0.02) are small and alternate in sign with no pattern, so a linear model is appropriate.
- **Prediction:** at t = 12, T̂ ≈ 26.3 °C (interpolation, reliable). At t = 120 the model gives about 101 °C, which is above water's boiling point at sea level: an extrapolation the context rules out.

**Reading a residual pattern.** If the residuals of a linear fit are positive at both ends and negative in the middle (a U shape), the data curve upward and a quadratic is likely better. A residual pattern means the model type is wrong, even when r is close to 1.

## Using a model (1.14)

Answer in context: give a number, its units, and what it means.

**Worked example.** For the ball model h(t) = −4.9t² + 19.6t + 1.5:

- Maximum height: the vertex is at t = −19.6/(2 · (−4.9)) = 2 s, and h(2) = 21.1 m.
- Average rate of change over [0, 1]: (16.2 − 1.5)/1 = 14.7 m/s, so the ball rose on average 14.7 metres per second during the first second.
- When is the ball 10 m high? Solve −4.9t² + 19.6t + 1.5 = 10; a calculator gives t ≈ 0.49 s (on the way up) and t ≈ 3.51 s (on the way down), symmetric about t = 2.

**Try it.**
1. Hypothetical sales data have first differences 12, 12.2, 11.9, 12.1. What model type fits, and why?
2. A model predicts 54 for an actual value of 50. What is the residual, and does the model overestimate or underestimate?
3. The average cost per item is C(x) = (300 + 1.5x)/x dollars for x items. What does lim as x → ∞ of C(x) = 1.5 mean in context?

*Answers:* 1. Linear: nearly constant first differences. 2. 50 − 54 = −4; it overestimates. 3. As the number of items grows very large, the average cost per item approaches $1.50, the per-item cost, because the $300 fixed cost is spread over more items.

## Calculator notes

Use a graphing calculator to run regressions, graph a model over a scatter plot, compute residuals (most calculators store them in a list called RESID), solve h(t) = 10 by intersecting two graphs, and find a maximum. Report decimals to three places unless told otherwise, and keep full precision in intermediate steps. On the non-calculator part of the AP exam, modelling questions give you the model or ask you to build one from a few exact points.

## Common mistakes

- **Choosing a model from r alone.** A curved data set can have r near 1 for a line; look at the residual pattern and the context.
- **Residual sign backwards.** Residual = actual − predicted.
- **Answers without units or context.** "0.694" is not an interpretation; "about 0.694 °C per minute" is.
- **Ignoring the contextual domain.** Negative lengths, fractional people and times after an object lands are outside the model's domain.
- **Trusting extrapolation.** A model fitted to five minutes of data cannot be expected to describe two hours.
- **Forgetting the switch in a piecewise model.** A 50-minute ride is not 0.15 · 50; the first 30 minutes are covered by the unlock fee.

## Where this goes next

Unit 2 adds exponential and logarithmic models to the menu and compares them with linear and quadratic ones using the same tools: rates of change, residuals and context (topics 2.5, 2.6 and 2.14). The Unit 1 exam's free-response questions include one modelling context like those here.

## Self-check

1. Give one context best modelled by a quadratic and one by a rational function, and say why.
2. Find the quadratic through (0, 6), (2, 2) and (4, 6).
3. A linear model has residuals −2.1, 0.3, 1.8, 1.9, 0.2, −2.2. What do they suggest?
4. State two assumptions behind modelling the height of a thrown ball with a quadratic.
5. A hypothetical gym charges $30 per month for up to 8 classes and $5 for each extra class. Write a piecewise model for the monthly cost and evaluate it for 12 classes.

---

*Original study material for this course, organised around the College Board AP Precalculus Course and Exam Description (Unit 1, Topics 1.13–1.14). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). AP® is a trademark of the College Board, which does not endorse this material.*
