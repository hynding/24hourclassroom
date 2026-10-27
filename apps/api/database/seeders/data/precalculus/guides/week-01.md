# Week 01 · Change in Tandem and Rates of Change

**Topics:** 1.1 Change in Tandem · 1.2 Rates of Change
**Practices:** 2 (multiple representations), 3 (communication and reasoning), 1 (procedural and symbolic fluency)
**Framework:** AP Precalculus CED, Unit 1, Topics 1.1–1.2, learning objectives in our own words
**Spiral:** This is where the course begins. From Algebra 1 and Algebra 2: function notation, reading graphs and tables, slope as rise over run, and the slope formula (y₂ − y₁)/(x₂ − x₁). Everything this week is about describing *how* the outputs of a function change as the inputs change, and that language is used in every unit that follows.

## What you need to be able to do

- **1.1** Treat a function as a rule that pairs each input with exactly one output, and read input–output pairs from a formula, a table, a graph or a verbal description.
- **1.1** Describe how the outputs change as the inputs increase: say where a function is increasing, where it is decreasing, and where it is constant, using intervals of the input.
- **1.1** Describe the shape of a graph using concavity: concave up when the graph bends upward (its rate of change is increasing), concave down when it bends downward (its rate of change is decreasing).
- **1.1** Identify the zeros of a function (inputs where the output is 0) and, from a table, locate a zero between two inputs where the output changes sign.
- **1.2** Compute the average rate of change of a function over an interval, interpret it with units, and connect it to the slope of a secant line.
- **1.2** Estimate the rate of change at a single input using average rates of change over smaller and smaller intervals around that input.
- **1.2** Compare rates of change: use a positive or negative rate to say whether outputs rise or fall, and use the size of the rate to say how fast.

## Key terms

| Term | Meaning |
|---|---|
| Function | A rule that assigns each input exactly one output. Written y = f(x): x is the input, f(x) the output. |
| Domain / range | The set of allowed inputs / the set of outputs the function actually produces. |
| Increasing on an interval | For any a < b in the interval, f(a) < f(b): as inputs go up, outputs go up. |
| Decreasing on an interval | For any a < b in the interval, f(a) > f(b): as inputs go up, outputs go down. |
| Concave up | The graph bends upward like part of a cup; the rate of change is increasing. |
| Concave down | The graph bends downward like part of a cap; the rate of change is decreasing. |
| Zero of f | An input a with f(a) = 0; on the graph, an x-intercept (a, 0). |
| Average rate of change | (f(b) − f(a))/(b − a): the change in output per unit change in input over [a, b]. |
| Secant line | The line through (a, f(a)) and (b, f(b)); its slope is the average rate of change on [a, b]. |
| Rate of change at a point | The value the average rates of change approach as the interval around that point shrinks. |

## Functions as change in tandem (1.1)

A function links two quantities that change together. When the input changes, the output changes "in tandem" with it. A ride-share fare depends on the distance driven, the height of a drone depends on how long it has been flying, the area of a square depends on its side length. In each case one quantity is the input and the other the output, and the function is the rule connecting them.

You will meet functions in four forms, and AP questions move between them freely:

- **Formula:** A(s) = s², the area of a square of side s.
- **Table:** selected input–output pairs, often from measurements.
- **Graph:** the set of points (x, f(x)), read with the input on the horizontal axis.
- **Words:** "the fare is a $3 base charge plus $1.50 per mile."

The key question this week is not "what is the output?" but "**how does the output change** as the input increases?"

### Increasing and decreasing

A function is **increasing** on an interval if larger inputs in that interval always give larger outputs, and **decreasing** if larger inputs give smaller outputs. Intervals are always stated in terms of the *input*: "f is increasing on 0 < t < 6", not "f is increasing from 5 to 113".

Where a function switches from increasing to decreasing it has a **relative (local) maximum**; where it switches from decreasing to increasing, a **relative minimum**. Week 3 develops these for polynomials.

### Concavity: how the change is changing

Two functions can both be increasing and still behave very differently. One might rise slowly at first and then faster and faster (like a snowball rolling downhill); the other might rise quickly at first and then level off (like a phone charging toward 100%).

- **Concave up:** the rate of change is increasing. Increasing functions speed up; decreasing functions slow their fall. The graph bends upward.
- **Concave down:** the rate of change is decreasing. Increasing functions slow down; decreasing functions fall faster. The graph bends downward.

A point where the graph changes concavity is called a **point of inflection**. At an inflection point the rate of change stops increasing and starts decreasing, or the reverse.

Concavity is independent of increasing/decreasing. All four combinations happen:

| | Concave up | Concave down |
|---|---|---|
| Increasing | rising faster and faster | rising, but more and more slowly |
| Decreasing | falling, but more and more slowly | falling faster and faster |

**Worked example.** A hypothetical model gives a drone's altitude h(t), in metres, t minutes after launch.

| t (min) | 0 | 1 | 2 | 3 | 4 | 5 | 6 | 7 | 8 |
|---|---|---|---|---|---|---|---|---|---|
| h(t) (m) | 5 | 13 | 33 | 59 | 85 | 105 | 113 | 103 | 69 |

Describe how altitude changes with time.

Work out the change over each one-minute interval:

| Interval | [0,1] | [1,2] | [2,3] | [3,4] | [4,5] | [5,6] | [6,7] | [7,8] |
|---|---|---|---|---|---|---|---|---|
| Change in h (m) | 8 | 20 | 26 | 26 | 20 | 8 | −10 | −34 |

The changes are positive up to t = 6 and negative afterwards, so (on the evidence of the table) h is increasing on 0 < t < 6 and decreasing on 6 < t < 8, with a relative maximum of 113 m near t = 6. The changes grow from 8 to 26 over the first three minutes, so h is concave up there; after about t = 3 they shrink (26, 20, 8, −10, −34), so h is concave down. The drone climbs faster and faster, then climbs more slowly, then descends faster and faster. A point of inflection occurs near t = 3.

Notice what a table can and cannot tell you: it gives evidence about behaviour between the listed inputs but does not prove it. A formula or a careful graph is needed for certainty.

### Zeros

A **zero** of f is an input where f(x) = 0. On a graph, zeros are x-intercepts. In a table, if f is continuous (no breaks) and the output changes sign between two inputs, there must be a zero between them.

**Worked example.** A hypothetical overnight temperature T(x), in °C, x hours after midnight:

| x (h) | 0 | 1 | 2 | 3 | 4 | 5 |
|---|---|---|---|---|---|---|
| T(x) (°C) | 3 | 1 | −1 | −2 | −1 | 2 |

Between x = 1 and x = 2 the temperature goes from positive to negative, and between x = 4 and x = 5 from negative to positive. Assuming temperature changes continuously, T has a zero in each of the intervals (1, 2) and (4, 5): the temperature was exactly 0 °C at least twice.

**Try it.**
1. A function g is increasing and concave down on an interval. Describe its graph in words.
2. Changes in a function over consecutive equal intervals are −12, −7, −3, −1. Is the function increasing or decreasing? Concave up or down?
3. f(2) = 5 and f(3) = −4 and f is continuous. What can you conclude?

*Answers:* 1. Rising, but more and more slowly; it bends downward. 2. Decreasing (all changes negative); the changes are increasing (−12 to −1), so concave up. 3. f has at least one zero between x = 2 and x = 3.

## Average rate of change (1.2)

The **average rate of change** of f over the interval [a, b] is

  (f(b) − f(a))/(b − a),

the change in output divided by the change in input. Its units are *output units per input unit*. Geometrically, it is the slope of the **secant line** joining (a, f(a)) and (b, f(b)).

The sign tells you direction: a positive average rate means the output is higher at the end of the interval than at the start, a negative one means it is lower. It does *not* tell you what happened in between: a function can go up and down inside [a, b] and still have a small average rate of change.

**Worked example.** Using the drone table, find the average rate of change of h on [0, 4], on [4, 8] and on [2, 7]. Interpret each.

- [0, 4]: (85 − 5)/(4 − 0) = 80/4 = 20 m/min. On average the drone gained 20 metres of altitude per minute over the first four minutes.
- [4, 8]: (69 − 85)/(8 − 4) = −16/4 = −4 m/min. On average it lost 4 metres per minute over the next four, even though it was climbing for part of that time.
- [2, 7]: (103 − 33)/(7 − 2) = 70/5 = 14 m/min.

**Worked example.** For f(x) = x² − 4x, find the average rate of change on [1, 5].

f(1) = 1 − 4 = −3 and f(5) = 25 − 20 = 5. Average rate = (5 − (−3))/(5 − 1) = 8/4 = 2. The secant line through (1, −3) and (5, 5) has slope 2.

### Average rates and concavity

Concavity can be read directly from average rates of change over consecutive intervals of the same length:

- If the average rates are **increasing**, the function is concave up there.
- If the average rates are **decreasing**, the function is concave down there.

This is exactly what we did with the drone table. Week 2 makes it precise for linear and quadratic functions.

## Rate of change at a point (1.2)

The average rate of change describes a whole interval. Often we want to know how fast something is changing at one instant: how fast was the drone climbing at exactly t = 2? We cannot divide by an interval of length 0, so we **estimate** with intervals that get shorter and shorter around the point, and look at what the average rates approach.

Graphically, as the second point slides toward the first, the secant lines approach the line that just touches the curve at that point (the tangent line). The rate of change at the point is the slope the secant slopes are approaching.

**Worked example.** Estimate the rate of change of f(x) = x² at x = 3.

| Interval | Average rate of change |
|---|---|
| [3, 4] | (16 − 9)/1 = 7 |
| [3, 3.1] | (9.61 − 9)/0.1 = 6.1 |
| [3, 3.01] | (9.0601 − 9)/0.01 = 6.01 |
| [2.9, 3] | (9 − 8.41)/0.1 = 5.9 |
| [2.99, 3] | (9 − 8.9401)/0.01 = 5.99 |

From the right the averages decrease toward 6, from the left they increase toward 6. The rate of change of f at x = 3 is 6. (Calculus proves it is exactly 6.) A **symmetric** interval often gives a better estimate: on [2.9, 3.1] the average rate is (9.61 − 8.41)/0.2 = 6 exactly.

**Worked example.** Using only the drone table, estimate how fast the drone was climbing at t = 2.

The closest data are at t = 1, 2 and 3. Averages: [1, 2] gives 20 m/min and [2, 3] gives 26 m/min. The symmetric interval [1, 3] gives (59 − 13)/2 = 23 m/min. A good estimate is about 23 m/min. Because the table is concave up here, the left-hand average underestimates and the right-hand average overestimates.

### Comparing rates

"Faster" refers to the *size* of the rate. A rate of −30 m/min is a faster change than +20 m/min, just in the downward direction. When AP questions ask whether a quantity is changing "faster" at one time than another, compare absolute values and state the direction separately.

**Try it.**
1. Find the average rate of change of g(x) = 2x³ on [−1, 2].
2. A hypothetical tank holds 400 L at t = 0 min and 250 L at t = 30 min. Find and interpret the average rate of change.
3. Estimate the rate of change of k(x) = √x at x = 4 using [4, 4.01].

*Answers:* 1. g(−1) = −2, g(2) = 16, so 18/3 = 6. 2. (250 − 400)/30 = −5 L/min: on average the tank lost 5 litres per minute. 3. (√4.01 − 2)/0.01 ≈ 0.2498, so about 0.25.

## Calculator notes

On the AP exam, Part A of the multiple choice is no-calculator. Everything this week can be done by hand from a table or formula. With a graphing calculator you can: build a table of f(x) with a small step (such as 0.01) to estimate rates at a point; graph a function and read off where it rises and falls; and use a "zero" or "root" feature to find zeros to several decimal places. When you use the calculator, still write the expression you computed, such as (f(3.01) − f(3))/0.01, so a reader can follow your reasoning.

## Common mistakes

- **Stating intervals in outputs.** "Increasing from 5 to 113" uses outputs; the answer should be an interval of inputs, such as 0 < t < 6.
- **Flipping the subtraction.** (f(b) − f(a))/(b − a) must subtract in the same order on top and bottom. (f(b) − f(a))/(a − b) gives the wrong sign.
- **Confusing increasing with concave up.** A function can be decreasing and concave up: it is falling, but less and less steeply.
- **Treating an average as the whole story.** A zero average rate of change over [a, b] means f(a) = f(b), not that f was constant.
- **Forgetting units.** A rate of change has units of output per input: metres per minute, dollars per mile.
- **Using an interval that is too wide to estimate a rate at a point.** Shorter intervals, or a symmetric one, give better estimates.

## Where this goes next

Week 2 looks at the two simplest rate-of-change patterns: linear functions (constant rate of change) and quadratic functions (rates of change that themselves change at a constant rate). Week 3 uses the language of increasing, decreasing and concavity to describe polynomial graphs, including relative extrema and points of inflection. The idea of a rate of change at a point is the doorway to calculus.

## Self-check

1. Give an everyday example of two quantities that change in tandem, and say which is the input.
2. Sketch, or describe in words, a function that is decreasing and concave down on 0 < x < 5.
3. A table shows f(0) = 2, f(2) = 7, f(4) = 10, f(6) = 11. Find the average rate of change on each interval of length 2 and decide whether f appears concave up or concave down.
4. Explain why the average rate of change of a function on [a, b] can be 0 even though the function is not constant.
5. Estimate the rate of change of f(x) = x³ at x = 1 using intervals of width 0.1 on each side, and explain why the two estimates bracket the true value.

---

*Original study material for this course, organised around the College Board AP Precalculus Course and Exam Description (Unit 1, Topics 1.1–1.2). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). AP® is a trademark of the College Board, which does not endorse this material.*
