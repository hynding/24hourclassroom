# Week 02 · Rates of Change in Linear and Quadratic Functions

**Topics:** 1.3 Rates of Change in Linear and Quadratic Functions
**Practices:** 1 (procedural and symbolic fluency), 2 (multiple representations), 3 (communication and reasoning)
**Framework:** AP Precalculus CED, Unit 1, Topic 1.3, learning objectives in our own words
**Spiral:** Week 1's average rate of change, (f(b) − f(a))/(b − a), and its link to concavity are the tools for the whole week. From Algebra 1 and 2: slope, slope-intercept and point-slope form, standard and vertex form of a quadratic, and completing the square.

## What you need to be able to do

- **1.3** Recognise a linear function as one whose average rate of change is the same over every interval, and use that constant rate (the slope) to write the function and make predictions.
- **1.3** Decide from a table with equally spaced inputs whether the data could be linear (equal first differences) or quadratic (equal second differences).
- **1.3** Explain that for a quadratic function the average rates of change over consecutive equal-length intervals change by a constant amount, so the rate of change is itself a linear function of the input.
- **1.3** Connect the sign of the leading coefficient of a quadratic to whether its rates of change increase (concave up) or decrease (concave down).
- **1.3** Use vertex form f(x) = a(x − h)² + k to locate the vertex, where the rate of change switches sign, and to state where the function increases and decreases.

## Key terms

| Term | Meaning |
|---|---|
| Linear function | f(x) = mx + b; its rate of change is the constant m on every interval. |
| First differences | Changes in output between consecutive entries of a table with equally spaced inputs. |
| Second differences | Changes between consecutive first differences. |
| Quadratic function | f(x) = ax² + bx + c with a ≠ 0. |
| Vertex form | f(x) = a(x − h)² + k; the vertex is (h, k). |
| Vertex | The turning point of a parabola: a minimum if a > 0, a maximum if a < 0. |
| Axis of symmetry | The vertical line x = h through the vertex; outputs are mirror images on either side. |

## Linear functions: a constant rate of change (1.3)

A function is **linear** exactly when its average rate of change is the same number m over *every* interval. Pick any two points (x₁, y₁) and (x₂, y₂) on the graph of f(x) = mx + b:

  (y₂ − y₁)/(x₂ − x₁) = (mx₂ + b − mx₁ − b)/(x₂ − x₁) = m.

So the slope you learned in Algebra 1 is the rate of change: the output changes by m units for every 1 unit of input, no matter where you start. Over an interval of length Δx the output changes by m · Δx.

Because the rate never changes, a linear function is neither concave up nor concave down; its graph is straight.

**Testing a table.** In a table with equally spaced inputs, a linear function has equal first differences. When the inputs are *not* equally spaced, compare average rates of change instead: equal changes in output over unequal steps do *not* mean linear.

**Worked example.** A hypothetical taxi company's fare F (in dollars) for a trip of d miles is shown.

| d (mi) | 2 | 5 | 9 |
|---|---|---|---|
| F (dollars) | 8.00 | 13.25 | 20.25 |

Could F be linear? Find the base fee.

The steps in d are unequal (3 then 4), so compute rates: (13.25 − 8.00)/3 = 1.75 and (20.25 − 13.25)/4 = 1.75 dollars per mile. The rate is constant, so the data are consistent with a linear model of slope 1.75. Using point-slope form, F = 8.00 + 1.75(d − 2) = 1.75d + 4.50. The base fee is F(0) = $4.50.

**Worked example.** A linear function has f(3) = 11 and rate of change −2.5. Find f(10).

The input increases by 7, so the output changes by −2.5 · 7 = −17.5: f(10) = 11 − 17.5 = −6.5.

**Try it.**
1. Is the table x: 0, 1, 3, 4 and y: 5, 7, 9, 11 linear?
2. A linear function passes through (−2, 9) and (4, −3). Write it in slope-intercept form.

*Answers:* 1. No. From x = 1 to 3 the rate is (9 − 7)/2 = 1, but from 0 to 1 it is 2. 2. m = (−3 − 9)/6 = −2, so y = −2x + 5.

## Quadratic functions: a rate of change that changes steadily (1.3)

Look at f(x) = 2x² − x + 3 at equally spaced inputs.

| x | 0 | 1 | 2 | 3 | 4 | 5 |
|---|---|---|---|---|---|---|
| f(x) | 3 | 4 | 9 | 18 | 31 | 48 |
| first difference | | 1 | 5 | 9 | 13 | 17 |
| second difference | | | 4 | 4 | 4 | 4 |

The first differences (which, over intervals of length 1, are the average rates of change) are not constant, so f is not linear. But they go up by the same amount, 4, every time. That is the signature of a quadratic: **over consecutive intervals of equal length, the average rates of change change at a constant rate.** Equivalently, the second differences are constant.

**Why it happens.** For f(x) = ax² + bx + c, the average rate of change over [x, x + h] is

  (f(x + h) − f(x))/h = (2axh + ah² + bh)/h = 2ax + ah + b.

For a fixed step h that is a *linear* function of x with slope 2a. Moving the interval along by h raises the average rate by 2a · h. So:

- With step h = 1, consecutive average rates differ by 2a, and so do the second differences.
- With step h, the first differences (changes in output) differ by 2ah², and the average rates differ by 2ah.

For f(x) = 2x² − x + 3, 2a = 4: matches the table.

**A handy shortcut.** The average rate of change of a quadratic on [p, q] is a(p + q) + b. It equals the rate of change at the midpoint (p + q)/2. For x² − 5x on [1, 7]: 1 · 8 − 5 = 3, the same as the rate of change at x = 4.

### Rates of change and concavity

Week 1 said: increasing rates mean concave up, decreasing rates mean concave down. For a quadratic the rates change by 2a each step, so

- **a > 0:** the rates increase; the parabola is concave up everywhere and has a minimum.
- **a < 0:** the rates decrease; the parabola is concave down everywhere and has a maximum.

A quadratic never changes concavity, so it has no point of inflection.

**Worked example.** A hypothetical model gives the height, in metres, of a ball thrown upward as h(t) = −5t² + 15t + 2, t seconds after release.

| t (s) | 0 | 0.5 | 1 | 1.5 | 2 | 2.5 | 3 |
|---|---|---|---|---|---|---|---|
| h(t) (m) | 2 | 8.25 | 12 | 13.25 | 12 | 8.25 | 2 |

Changes over each half second: 6.25, 3.75, 1.25, −1.25, −3.75, −6.25. Second differences: −2.5 every time, matching 2ah² = 2(−5)(0.25) = −2.5. The average rates (divide each change by 0.5) are 12.5, 7.5, 2.5, −2.5, −7.5, −12.5 m/s: they drop by 5 m/s each half second, which is 2a · h = −10 · 0.5. The ball rises more and more slowly, reaches its peak, then falls faster and faster: concave down throughout.

**Worked example.** The table shows a quadratic. Find its formula.

| x | 0 | 1 | 2 | 3 | 4 |
|---|---|---|---|---|---|
| y | 5 | 8 | 15 | 26 | 41 |

First differences 3, 7, 11, 15; second differences 4. With step 1, 2a = 4, so a = 2. The constant term is y(0) = 5. Then y(1) = 2 + b + 5 = 8 gives b = 1. So y = 2x² + x + 5. Check: y(3) = 18 + 3 + 5 = 26.

**Try it.**
1. For g(x) = 3x² − 2x + 1, by how much do the average rates of change over consecutive intervals of length 1 increase?
2. A table with inputs 0, 2, 4, 6 has outputs 1, 9, 33, 73. Is it quadratic? Find a.

*Answers:* 1. 2a = 6. 2. First differences 8, 24, 40; second differences 16, 16. Quadratic, and 2ah² = 8a = 16, so a = 2.

## Vertex form and where the rate changes sign (1.3)

In **vertex form** f(x) = a(x − h)² + k:

- The vertex is (h, k). It is a minimum when a > 0 and a maximum when a < 0.
- The axis of symmetry is x = h; f(h + d) = f(h − d) for every d.
- The rate of change is negative on one side of h and positive on the other. For a > 0, f decreases on x < h and increases on x > h; for a < 0 it is the reverse.
- The average rate of change on any interval symmetric about h, such as [h − 3, h + 3], is 0.

To convert from standard form, **complete the square**.

**Worked example.** Write f(x) = 2x² − 12x + 7 in vertex form, and describe where f increases and decreases.

Factor the 2 out of the x-terms: 2(x² − 6x) + 7. Half of −6 is −3, and (−3)² = 9: 2(x² − 6x + 9) + 7 − 18 = 2(x − 3)² − 11. The vertex is (3, −11), a minimum because a = 2 > 0. The function decreases on x < 3 and increases on x > 3; its minimum value is −11.

**Worked example.** Using the ball model h(t) = −5t² + 15t + 2, find the maximum height.

The table is symmetric about t = 1.5, so the vertex is at t = 1.5. Completing the square: −5(t² − 3t) + 2 = −5(t − 1.5)² + 11.25 + 2 = −5(t − 1.5)² + 13.25. The maximum height is 13.25 m at t = 1.5 s, where the average rates switch from positive to negative.

**Worked example (a revenue model).** A hypothetical theatre models weekly ticket revenue as R(x) = 600x − 25x² dollars when the ticket price is x dollars. Find the price that maximises revenue and the rate pattern around it.

R(x) = −25(x² − 24x) = −25(x − 12)² + 3600. Revenue is greatest, $3,600, at a price of $12. At prices 10, 12, 14, 16, 18 the revenues are 3500, 3600, 3500, 3200, 2700: changes +100, −100, −300, −500, falling by $200 for each $2 step (2ah² = 2(−25)(4) = −200).

**Try it.**
1. Write x² + 8x + 10 in vertex form.
2. Where is f(x) = −2(x − 1)² + 8 increasing?
3. What is the average rate of change of f(x) = −2(x − 1)² + 8 on [−4, 6]?

*Answers:* 1. (x + 4)² − 6. 2. x < 1. 3. The interval is symmetric about x = 1, so 0.

## Calculator notes

None of this week's skills needs a calculator. With one, use the table feature to list first and second differences quickly, or enter data into lists and look at the differences with a list command (such as ΔList). A graphing calculator's quadratic regression will fit y = ax² + bx + c to data; you will use regression in week 9. On a no-calculator question, find a from the second differences and the step, as above.

## Common mistakes

- **Testing for linearity with unequal steps.** Equal output changes over unequal input steps do not mean a constant rate. Divide by the step.
- **Confusing the second difference with a.** With step 1 the second difference is 2a, not a. With step h it is 2ah².
- **Mixing changes and rates.** A change is Δy; a rate is Δy/Δx. Over half-second intervals, a change of 2.5 m is a rate of 5 m/s.
- **Sign errors in vertex form.** a(x − h)² + k has vertex (h, k), so (x + 4)² − 6 has vertex (−4, −6).
- **Completing the square without balancing.** When you add 9 inside 2(x² − 6x + 9), you have really added 18, so subtract 18.
- **Assuming two equal average rates prove linearity.** A function can have the same average rate on [0, 2] and [2, 4] without being linear.

## Where this goes next

Week 3 extends the pattern: for a polynomial of degree n, the nth differences over equal steps are constant. Cubics and higher-degree polynomials can change concavity, so they have points of inflection, and they can have several relative extrema. In Unit 2 you will meet the third kind of change pattern: exponential functions, whose outputs change by a constant *factor* over equal intervals.

## Self-check

1. Explain why a linear function has the same average rate of change on every interval.
2. The second differences of a table with input step 1 are all −6. What can you say about the function and its concavity?
3. Find a quadratic through the points in the table x: 0, 1, 2, 3 and y: −1, 2, 9, 20.
4. Write 3x² + 18x + 20 in vertex form, and state where the function is decreasing.
5. A ball's height is modelled by a quadratic. Over consecutive one-second intervals, its average rates of change are 14, 4 and −6 m/s. What will the next one be, and why?

---

*Original study material for this course, organised around the College Board AP Precalculus Course and Exam Description (Unit 1, Topic 1.3). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). AP® is a trademark of the College Board, which does not endorse this material.*
