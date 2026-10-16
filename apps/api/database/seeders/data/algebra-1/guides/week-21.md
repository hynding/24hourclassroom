# Week 21 · Interpreting Exponential Functions and Their Graphs

**Lessons:** 5.9 Interpreting Exponential Functions · 5.10 Looking at Rates of Change · 5.11 Modeling Exponential Behavior · 5.12 Reasoning about Exponential Graphs (Part 1) · 5.13 Reasoning about Exponential Graphs (Part 2)
**Practices:** MP2 (say what each parameter means), MP4 (choose and fit an exponential model to data), MP3 (argue which graph belongs to which equation)
**Built from:** IM Algebra 1, Unit 5, Lessons 9–13, in our own words
**Spiral:** Average rate of change (week 16) is the lens for seeing how exponential growth speeds up. Fitting a model to data continues the modelling habits of unit 3: choose a form, fit it, check it against the points. Graph features (week 16) reappear for exponential curves.

## What you need to be able to do

- **5.9** Interpret the parameters a and b of f(x) = a · bˣ in context, including the units of x, and interpret statements such as f(4) = 1,250.
- **5.10** Compute average rates of change of an exponential function over equal intervals, explain why they grow (or shrink) by the same factor, and contrast with linear functions.
- **5.11** Build an exponential model from data: estimate the factor from consecutive values, choose a starting value, write the equation, and check it.
- **5.12** Match equations to graphs using the vertical intercept and the factor; sketch a · bˣ from a and b.
- **5.13** Compare graphs with different a or b, and find a and b from a graph that shows two points.

## Key terms

| Term | Meaning |
|---|---|
| Parameter | A number in a function's rule that sets the particular function: a and b in a · bˣ. |
| Unit of the input | What one step of x means: a day, a year, a bounce; the factor is "per that unit". |
| Average rate of change | (f(x₂) − f(x₁))/(x₂ − x₁) over an interval. |
| Equal intervals | Intervals of the same width, such as 0 to 2 and 2 to 4. |
| Exponential model | An equation a · bˣ chosen to describe data whose ratios are roughly constant. |

## Interpreting parameters (5.9)

P(t) = 4,000 · 1.03ᵗ, with t in years since 2015, models a town's population.

- **4,000:** the population in 2015 (t = 0).
- **1.03:** each year the population is 103% of the year before: 3% growth per year.
- **P(4) = 4,000 · 1.03⁴ ≈ 4,502:** about 4,500 people in 2019.
- **The unit matters.** If t were in decades, 1.03 would mean 3% growth per decade, a much slower town.

V(n) = 800 · 0.6ⁿ, with n the number of washes, models the brightness of a shirt's colour on a scale where new is 800.
- **800:** brightness when new. **0.6:** each wash leaves 60% of the brightness, a 40% loss per wash.
- **V(3) = 172.8:** after three washes the colour is about 173 on the scale.

**Worked example.** A(w) = 50 · 1.5ʷ gives an app's weekly downloads w weeks after launch. Interpret 50 and 1.5 and find A(3).
50 downloads in launch week; downloads grow 50% a week; A(3) = 50 · 3.375 ≈ 169.

**Try it.** In H(d) = 12 · 0.9ᵈ for the height of a plant's water level in cm after d days, what do 12 and 0.9 mean, and what is H(2)?
*Answers:* 12 cm at the start; the level keeps 90% each day (loses 10%); 9.72 cm.

## Rates of change (5.10)

For f(x) = 2ˣ:

| Interval | Change in f | Average rate of change |
|---|---|---|
| 0 to 1 | 2 − 1 = 1 | 1 |
| 1 to 2 | 4 − 2 = 2 | 2 |
| 2 to 3 | 8 − 4 = 4 | 4 |
| 3 to 4 | 16 − 8 = 8 | 8 |

Each rate is double the previous one: for exponential growth, the average rate of change over equal intervals is itself multiplied by the factor each time. A linear function's rate is the same over every interval. That is the signature of each kind of growth: constant rate means linear; rate that is multiplied by a constant means exponential.

For decay, f(x) = 100 · 0.5ˣ: changes −50, −25, −12.5, −6.25 over successive unit intervals. The rates are negative and shrink toward 0, each half the previous.

**Worked example.** For P(t) = 4,000 · 1.03ᵗ, find the average rate of change from t = 0 to 10 and from t = 10 to 20.
P(10) ≈ 5,376, P(20) ≈ 7,224. Rates: (5,376 − 4,000)/10 ≈ 138 per year; (7,224 − 5,376)/10 ≈ 185 per year. The second is about 1.34 times the first, and 1.03¹⁰ ≈ 1.34.

**Try it.** For g(x) = 3ˣ, find the average rate of change from 1 to 2 and from 2 to 3.
*Answers:* 6 and 18; the second is 3 times the first.

## Modelling exponential behaviour (5.11)

Data: a bacteria count every hour: 120, 178, 262, 395, 590. Ratios: 1.48, 1.47, 1.51, 1.49. Roughly constant, so an exponential model is reasonable with b ≈ 1.5 and a = 120: N(h) = 120 · 1.5ʰ. Check: N(4) = 120 · 5.0625 = 607.5 against the actual 590, close enough for a model.

Steps:
1. Check ratios of consecutive values (for equally spaced inputs). If they are about constant, the model is exponential; if differences are about constant, use a line.
2. Take the factor as a typical ratio (or the ratio across the whole span, rooted: (590/120)^(1/4) ≈ 1.49).
3. Use the first value as a (or a value chosen so the curve fits the middle of the data).
4. Write the equation and compare predictions with every data point.
5. Use the model only within and slightly beyond the data.

**Worked example.** A cup of coffee's excess temperature over the room: 60, 48, 38, 31, 25 degrees at 0, 5, 10, 15, 20 minutes. Ratios ≈ 0.80 per 5 minutes. Model with t in 5-minute steps: E(t) = 60 · 0.8ᵗ, or per minute, E(m) = 60 · 0.8^(m/5). Prediction at 30 minutes: 60 · 0.8⁶ ≈ 15.7 degrees.

**Try it.** A rumour reaches 8, 25, 70, 210 people on successive days. Is an exponential model reasonable? Estimate the factor.
*Answer:* Ratios 3.1, 2.8, 3.0: yes, factor about 3; R(d) = 8 · 3ᵈ.

## Reasoning about graphs (5.12, 5.13)

Four graphs, four equations: y = 2ˣ, y = 3ˣ, y = 5 · 2ˣ, y = 5 · 0.5ˣ. Match them without plotting:

- Only y = 5 · 0.5ˣ falls from left to right.
- The two with a = 1 pass through (0, 1); y = 5 · 2ˣ passes through (0, 5).
- Between 2ˣ and 3ˣ, the one with the larger base is higher for x > 0 (and lower for x < 0; they cross at (0, 1)).

Given two points on a graph, find a and b: (0, 6) and (2, 54) give a = 6, b² = 9, b = 3. If neither point has x = 0: (1, 10) and (3, 250) give b² = 25, b = 5, and a = 10/5 = 2.

**Effect of a:** multiplies every output; the graph is stretched vertically and the intercept moves. **Effect of b:** sets the steepness of growth (b > 1) or speed of decay (b < 1). Two growth graphs with the same a start together and the larger b wins immediately. Two decay graphs with the same a: the smaller b falls faster.

**Worked example.** Which is larger at x = 10: y = 100 · 1.1ˣ or y = 10 · 1.5ˣ? At x = 10: 100 · 2.594 ≈ 259 and 10 · 57.67 ≈ 577. The second, despite starting at a tenth of the first. Where do they cross? Try x = 6: 177 versus 114; x = 7: 195 versus 171; x = 8: 214 versus 256. Between 7 and 8.

**Try it.** A graph passes through (0, 80) and (1, 60). Another passes through (0, 80) and (1, 40). Which falls faster, and what are the equations?
*Answers:* The second (factor 0.5 versus 0.75); 80 · 0.75ˣ and 80 · 0.5ˣ.

## Common mistakes

- Interpreting b = 1.03 as "grows by 1.03" or "by 103%"; it is 3% per unit of x.
- Forgetting the unit of x when stating the growth rate.
- Expecting the average rate of change to be constant for an exponential function.
- Fitting an exponential model to data whose ratios are not roughly constant.
- Matching graphs by a single point without checking direction and intercept.
- Taking the ratio of points two steps apart as the factor without a square root.

## Where this goes next

Week 22 handles percent change systematically: writing factors from percentages, compound interest, different compounding intervals and the same function expressed in different ways. Week 23 asks which of two functions changes faster and uses exponential models for populations.

## Self-check

1. In M(t) = 1,500 · 0.92ᵗ (t in months), what do 1,500 and 0.92 mean?
2. For f(x) = 4ˣ, find the average rates of change from 0 to 1 and from 1 to 2. What is their ratio?
3. Data 50, 76, 112, 170 at x = 0, 1, 2, 3. Estimate an exponential model.
4. A graph passes through (0, 3) and (2, 48). Find the equation.
5. Which is higher at x = 5: 2 · 3ˣ or 20 · 1.5ˣ?

*Answers:* (1) 1,500 at the start; keeps 92% each month (loses 8%). (2) 3 and 12; ratio 4. (3) Ratios ≈ 1.5; f(x) = 50 · 1.5ˣ. (4) b² = 16, b = 4; y = 3 · 4ˣ. (5) 2 · 243 = 486 versus 20 · 7.59 ≈ 152: the first.

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Algebra 1, Unit 5, Lessons 9–13, https://im.kendallhunt.com/HS/teachers/1/5/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
