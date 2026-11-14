# Week 06 · Rates of Change and the Definition of the Derivative

**Topics:** 2.1 Defining Average and Instantaneous Rates of Change at a Point · 2.2 Defining the Derivative of a Function and Using Derivative Notation
**Practices:** 1 (Implementing Mathematical Processes), 2 (Connecting Representations), 4 (Communication and Notation)
**Framework:** AP Calculus AB and BC CED, Unit 2, Topics 2.1–2.2, learning objectives in our own words
**Spiral:** Unit 1 built the limit. This week the limit does its first big job: it turns an average rate of change, which needs two points, into an instantaneous rate, which needs only one. The algebraic tools from weeks 2 and 3 (factoring, cancelling a common factor, multiplying by a conjugate, combining fractions) are exactly the tools you need to evaluate a difference-quotient limit. From Precalculus: average rate of change, secant lines, and point-slope form.

## What you need to be able to do

- **2.1** Compute an average rate of change (f(b) − f(a))/(b − a) from a formula, a table or a graph, and read it as the slope of a secant line, with units.
- **2.1** Explain an instantaneous rate of change as the limit of average rates over shrinking intervals, and estimate it from a table of such average rates.
- **2.2** Write the derivative at a point in both limit forms, f′(a) = lim (h→0) (f(a + h) − f(a))/h and f′(a) = lim (x→a) (f(x) − f(a))/(x − a), and evaluate them for simple functions.
- **2.2** Find the derivative function f′(x) from the definition for polynomials, simple rational functions and square roots.
- **2.2** Recognise a given limit as a derivative: name the function f and the point a, and evaluate it.
- **2.2** Use derivative notation correctly (f′(x), y′, dy/dx, d/dx [f(x)]) and write the equation of a tangent line y = f(a) + f′(a)(x − a).

## Key terms

| Term | Meaning |
|---|---|
| Average rate of change | (f(b) − f(a))/(b − a): the change in output per unit change in input over [a, b]. |
| Secant line | The line through two points of a graph; its slope is an average rate of change. |
| Instantaneous rate of change | The limit of average rates of change over intervals that shrink to one point. |
| Tangent line | The line through (a, f(a)) whose slope is the instantaneous rate of change at a. |
| Difference quotient | (f(x + h) − f(x))/h, the average rate of change on an interval of width h. |
| Derivative at a point | f′(a), the limit of the difference quotient at a, when that limit exists. |
| Derivative function | f′(x): the function that assigns to each x the derivative at x. |
| Differentiable at a | f′(a) exists (as a finite number). |

## Average and instantaneous rates of change (2.1)

An **average rate of change** compares two points. Over [a, b] it is

  (f(b) − f(a))/(b − a),

the slope of the secant line joining (a, f(a)) and (b, f(b)). Its units are output units per input unit: metres per second, litres per minute, dollars per item. An average rate says nothing about what happens between the endpoints. If f(0) = f(4), the average rate on [0, 4] is 0 even if f rose and fell in between.

Calculus asks a sharper question: how fast is f changing **at** one input? You cannot compute "change over no time" directly, because (f(a) − f(a))/(a − a) is 0/0. Instead, compute average rates over smaller and smaller intervals that contain a and see what they approach. That limit, if it exists, is the **instantaneous rate of change** at a. Geometrically, the secant lines pivot toward a limiting line, the **tangent line**.

**Worked example (shrinking intervals).** A hypothetical drone climbs so that its altitude, in metres, t seconds into a test is A(t) = 20 + t³ for 0 ≤ t ≤ 3. Estimate how fast it is climbing at t = 2.

Average rates on intervals to the right of 2 and to the left of 2:

| Interval | Average rate (m/s) | Interval | Average rate (m/s) |
|---|---|---|---|
| [2, 2.1] | 12.61 | [1.9, 2] | 11.41 |
| [2, 2.01] | 12.0601 | [1.99, 2] | 11.9401 |
| [2, 2.001] | 12.006001 | [1.999, 2] | 11.994001 |

For example, on [2, 2.1]: A(2.1) = 20 + 9.261 = 29.261 and A(2) = 28, so the rate is 1.261/0.1 = 12.61. Both columns close in on 12, so the drone is climbing at about 12 metres per second at t = 2. In fact the right-hand average rate is ((2 + h)³ − 8)/h = 12 + 6h + h², which tends to exactly 12 as h → 0.

Notice two things. Each average rate on the right is a little too big and each on the left a little too small, because the graph is bending upward; and the limit is a single number that both sides agree on. If the two sides approached different numbers, there would be no instantaneous rate at that point (week 7 studies exactly when that happens).

## The derivative and its notation (2.2)

The **derivative of f at a** is the limit of the difference quotient:

  f′(a) = lim (h→0) (f(a + h) − f(a))/h, provided the limit exists.

Writing x = a + h gives the equivalent **x-form**:

  f′(a) = lim (x→a) (f(x) − f(a))/(x − a).

Both measure the same thing: the instantaneous rate of change of f at a, which is the slope of the tangent line at (a, f(a)). Leaving the input as a variable gives the **derivative function**

  f′(x) = lim (h→0) (f(x + h) − f(x))/h.

Notation. If y = f(x), the derivative can be written f′(x), y′, dy/dx or d/dx [f(x)]. The value at a point is f′(3), or dy/dx evaluated at x = 3. Leibniz's dy/dx is a reminder of where the derivative comes from: it is the limit of Δy/Δx, the average rate over an interval, as Δx → 0. Δy/Δx alone is still an average rate.

Every difference-quotient limit starts as 0/0. The work is algebra that removes the factor h (or x − a) from the denominator so that the limit can be evaluated by substitution, the same strategy as week 2's removable-discontinuity limits.

**Worked example (a polynomial).** Find f′(x) for f(x) = x² − 3x, then f′(2).

f(x + h) = x² + 2xh + h² − 3x − 3h, so

f(x + h) − f(x) = 2xh + h² − 3h = h(2x + h − 3).

For h ≠ 0 the difference quotient is 2x + h − 3, and as h → 0 it tends to **f′(x) = 2x − 3**. So f′(2) = 1: at x = 2 the graph rises one unit for each unit to the right.

**Worked example (a square root).** Find f′(x) for f(x) = √x, x > 0.

The quotient is (√(x + h) − √x)/h. Multiply top and bottom by the conjugate √(x + h) + √x:

(√(x + h) − √x)(√(x + h) + √x) = (x + h) − x = h,

so for h ≠ 0 the quotient becomes 1/(√(x + h) + √x). As h → 0 this tends to 1/(√x + √x) = **1/(2√x)**. At x = 4 the slope is 1/4; at x = 0 the formula breaks down, a hint (taken up in week 7) that √x has a vertical tangent there.

**Recognising a limit as a derivative.** Exam questions often hand you a limit and ask for its value. Read it as a derivative: the expression plugged into the function tells you f and a, and the subtracted constant must be f(a).

**Worked example (recognition).** Evaluate lim (h→0) ((2 + h)⁴ − 16)/h.

Here (2 + h) is plugged into x⁴, and 16 = 2⁴, so this is f′(2) for f(x) = x⁴. Without any rules yet, expand: (2 + h)⁴ = 16 + 32h + 24h² + 8h³ + h⁴, so the quotient is 32 + 24h + 8h² + h³ for h ≠ 0, and the limit is **32**. (Next week's power rule gives 4 · 2³ = 32 in one line.) The same limit in x-form would be lim (x→2) (x⁴ − 16)/(x − 2).

Two checks protect you. First, the constant must equal f(a): lim (h→0) ((2 + h)⁴ − 2)/h is **not** a derivative, and its numerator tends to 14, so the limit does not exist. Second, the denominator must be exactly the change in input, h or x − a.

## Tangent lines (2.2)

Once you know f(a) and f′(a), the tangent line at x = a is

  y = f(a) + f′(a)(x − a).

You need two numbers, the height and the slope. A common slip is to put the formula f′(x) where the number f′(a) belongs; the result is not a line.

**Worked example (a tangent line).** Find the line tangent to y = 1/x at x = 2.

From the definition: (1/(2 + h) − 1/2)/h = ((2 − (2 + h))/(2(2 + h)))/h = −1/(2(2 + h)) for h ≠ 0, which tends to −1/4. So f′(2) = −1/4. With f(2) = 1/2, the tangent line is

y = 1/2 − (1/4)(x − 2), which simplifies to y = 1 − x/4.

Near x = 2 the line and the curve are almost indistinguishable: at x = 2.1 the line gives 0.475 and the curve gives 1/2.1 ≈ 0.476. That closeness is the idea behind local linearity, which returns in Unit 4.

**Interpreting a derivative in context.** A derivative is a rate, so its interpretation must name the input value, whether the quantity is increasing or decreasing, and the rate with units. "h′(2) = −5" for a ball's height in metres means "at t = 2 seconds the ball's height is decreasing at 5 metres per second". It does not mean the ball is 5 metres lower than something.

## Common mistakes

- **Dividing the output, not the change.** The average rate on [0, 2] is (f(2) − f(0))/2, not f(2)/2.
- **Subtracting the wrong constant.** In f′(3) for f(x) = x², the numerator is (3 + h)² − 9, not (3 + h)² − 3.
- **Dropping the cross term.** (x + h)² = x² + 2xh + h²; forgetting 2xh loses the derivative entirely.
- **Letting h → 0 too early.** Substituting h = 0 before cancelling gives 0/0. Cancel the common factor h first.
- **Confusing f(a) with f′(a).** A function can be 0 where its slope is 5, and 5 where its slope is 0.
- **Using f′(x) in a tangent line.** The slope of a line is a number; evaluate f′ at the point.
- **Reading Δy/Δx as a derivative.** Without the limit it is an average rate over an interval.

## Self-check

1. A hypothetical tank holds V(t) = 200 − 3t² litres of water t minutes after a valve opens. Find the average rate of change of V on [1, 3], with units.
2. Use the definition to find f′(x) for f(x) = 4x − x², and write the tangent line at x = 1.
3. Which function and which point does lim (x→9) (√x − 3)/(x − 9) describe? Evaluate it.
4. Explain in one sentence why (f(a + h) − f(a))/h is not itself the derivative.
5. Use the definition and a common denominator to find g′(x) for g(x) = 3/x.

*Answers:* 1. V(1) = 197 and V(3) = 173, so (173 − 197)/2 = −12 litres per minute. 2. f′(x) = 4 − 2x; f(1) = 3 and f′(1) = 2, so y = 3 + 2(x − 1). 3. f(x) = √x at a = 9; the value is 1/6. 4. It is an average rate over an interval of width h; the derivative is its limit as h → 0. 5. g′(x) = −3/x².

---

*Original study material for this course, organised around the College Board AP Calculus AB and BC Course and Exam Description (Unit 2, Topics 2.1–2.2). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). AP® is a trademark of the College Board, which does not endorse this material.*
