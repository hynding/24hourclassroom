# Week 31 · Residuals and Residual Plots

**Topics:** 5.4 Residuals
**Practices:** 3 (Analyze Data), 4 (Interpret Results)
**Framework:** AP Statistics CED (effective fall 2026), Unit 5, Topic 5.4, learning objectives in our own words
**Spiral:** Week 29 described scatterplots and r; week 30 used a regression line ŷ = a + bx to predict and interpreted its slope and intercept. Every prediction misses the actual value by some amount. This week names that miss (the residual), interprets it, and plots the residuals to decide whether a straight line is an appropriate model at all. It also recalls Unit 1's habit of describing a distribution's shape, because a residual plot is read for its pattern.

## What you need to be able to do

- **5.4** Calculate a residual as actual minus predicted, y − ŷ, and interpret it in context.
- **5.4** Explain what a positive, negative and zero residual mean for a point's position relative to the line.
- **5.4** Make and read a residual plot (residuals against x, or against ŷ).
- **5.4** Use a residual plot to judge whether a linear model is appropriate: random scatter supports a line; a curved pattern does not.
- **5.4** Recognise a fan-shaped residual plot and explain what it means for the precision of predictions.
- **5.4** Explain why a high |r| alone does not show that a linear model is appropriate.

## Key terms

| Term | Meaning |
|---|---|
| Residual | Actual minus predicted: residual = y − ŷ. The vertical distance from a point to the line. |
| Positive residual | The point lies above the line; the model underpredicted. |
| Negative residual | The point lies below the line; the model overpredicted. |
| Residual plot | A scatterplot of the residuals (vertical axis) against x or against ŷ (horizontal axis), with a reference line at 0. |
| Appropriate linear model | One whose residual plot shows no leftover pattern: residuals scattered randomly above and below 0. |
| Curved residual pattern | A U, arch or wave in the residual plot: the relationship is nonlinear and a line is not appropriate. |
| Fan shape | Residuals that spread out (or narrow) as x increases: the scatter around the line is not constant. |

## Residuals (5.4)

A regression line predicts ŷ for each x. The **residual** for an individual is

residual = actual − predicted = y − ŷ.

Order matters: actual minus predicted, always. A positive residual means the actual value is **above** the line (the line underpredicted); a negative residual means the actual value is **below** the line (the line overpredicted). The units of a residual are the units of y.

The AP interpretation template: "The actual [y in context] for [this individual] is [|residual| with units] [more / less] than predicted by the regression line using [x in context]."

**Worked example (calculating and interpreting residuals).** Eight hypothetical students measure their arm span and height in centimetres. Technology gives predicted height = 16.382 + 0.9072 (arm span).

| Student | Arm span x | Height y | Predicted ŷ | Residual y − ŷ |
|---|---|---|---|---|
| 1 | 152 | 156 | 154.28 | 1.72 |
| 2 | 158 | 157 | 159.72 | −2.72 |
| 3 | 163 | 166 | 164.26 | 1.74 |
| 4 | 167 | 168 | 167.89 | 0.11 |
| 5 | 170 | 169 | 170.61 | −1.61 |
| 6 | 174 | 172 | 174.24 | −2.24 |
| 7 | 179 | 183 | 178.78 | 4.22 |
| 8 | 185 | 183 | 184.22 | −1.22 |

For student 7: ŷ = 16.382 + 0.9072(179) = 178.78, so the residual is 183 − 178.78 = 4.22 cm. Interpretation: the actual height of student 7 is 4.22 cm greater than the height predicted by the regression line using his arm span of 179 cm. For student 2: the actual height is 2.72 cm less than predicted from an arm span of 158 cm.

Two facts about least-squares residuals (week 32 explains why):

- They add to 0 (here 1.72 − 2.72 + 1.74 + 0.11 − 1.61 − 2.24 + 4.22 − 1.22 = 0.00). Positive and negative misses balance.
- So their mean is 0, and the residual plot is centred on the horizontal line at 0.

## Residual plots

A **residual plot** puts x (or ŷ) on the horizontal axis and the residuals on the vertical axis. It removes the linear trend, so whatever is left over is magnified. You are looking for **no pattern**.

| What you see | What it means |
|---|---|
| Random scatter above and below 0, roughly even width | A linear model is appropriate. |
| A curve (U shape, arch, or rise-then-fall) | The relationship is curved; a linear model is not appropriate. |
| A fan (residuals spread out as x grows) | The line may fit the trend, but predictions are less precise for larger x. |
| One residual far from the rest | An outlier in the y direction (week 32 asks whether it is influential). |

**Worked example (a residual plot with no pattern).** In the arm-span data the residuals, read from left to right, are +1.72, −2.72, +1.74, +0.11, −1.61, −2.24, +4.22, −1.22. Plotted against arm span, they bounce above and below 0 with no curve and roughly constant width:

```
residual
  +4 |                          *
  +2 |  *         *
   0 |---------------*------------------
  -2 |       *          *   *         *
     +----------------------------------
      150      160      170      180   arm span
```

There is no leftover pattern, so a linear model relating height to arm span is appropriate.

## High r is not enough

A curved relationship can still have a correlation near ±1, so you cannot use r to decide whether a line is appropriate.

**Worked example (a curve hidden by a strong r).** A science class records the temperature of a cup of coffee as it cools.

| Minutes | 0 | 5 | 10 | 15 | 20 | 25 | 30 | 35 | 40 |
|---|---|---|---|---|---|---|---|---|---|
| Temperature (°C) | 88 | 76 | 66 | 58 | 52 | 47 | 43 | 40 | 38 |

The regression line is predicted temperature = 80.78 − 1.217 (minutes), and r = −0.968, which looks excellent. But the residuals are

| Minutes | 0 | 5 | 10 | 15 | 20 | 25 | 30 | 35 | 40 |
|---|---|---|---|---|---|---|---|---|---|
| Residual | 7.22 | 1.31 | −2.61 | −4.53 | −4.44 | −3.36 | −1.28 | 1.81 | 5.89 |

positive at both ends and negative in the middle: a clear U shape. The coffee cools quickly at first and then more slowly, so the true relationship curves. A linear model is **not** appropriate, despite r = −0.968; the line overpredicts in the middle and underpredicts at both ends, and extending it would predict impossible temperatures (below a 20 °C room by about 50 minutes). The right conclusion on this course is simply "a linear model is not appropriate; a curved model would describe these data better." (Re-expressing data to straighten them is not part of this course.)

## Fan shapes

**Worked example (spreading residuals).** For 50 hypothetical students with part-time jobs, weekly earnings are regressed on hours worked (2 to 30 hours). The residual plot shows points close to 0 for students working a few hours (residuals within about ±$5) but spread out to about ±$45 for students working 25 or more hours, because pay rates and tips vary more over long shifts. The trend is linear (no curve), so the line describes the average relationship well, but predictions for students who work many hours will be much less precise than predictions for students who work few hours. Describe it exactly that way: "the residuals fan out as hours worked increase, so the prediction errors are larger for students who work more hours."

## Common mistakes

- **Predicted minus actual.** A residual is y − ŷ. Getting the order backwards flips every sign and every interpretation.
- **Interpreting a residual without context.** Name the individual, the variable, the size with units, and above or below the prediction.
- **Judging the model by r.** A strong r can hide a curve; use the residual plot.
- **Reading a residual plot like a scatterplot.** A residual plot with points scattered randomly is good news, not "no association".
- **Calling a fan a curve.** A fan says the spread changes; a curve says the form is wrong.
- **Expecting residuals to be zero.** Individuals scatter; the model is good when the residuals show no pattern, not when they vanish.

## Where this goes next

Week 32 explains that the least-squares line makes the sum of the squared residuals as small as possible, measures the typical residual with s, measures the fraction of variation explained with r², reads all of these from computer output, and asks which unusual points change the line.

## Self-check

1. A line predicts a student's quiz score as 78 and the student scored 71. Find and interpret the residual.
2. A residual is +3.5 kg for a dog. Is the dog above or below the line? Did the model overpredict or underpredict?
3. A residual plot shows an arch: negative, then positive, then negative. Is a line appropriate?
4. The correlation for a data set is 0.97. Does that guarantee a linear model is appropriate?
5. Why do least-squares residuals always add up to 0?

*Answers:* 1. 71 − 78 = −7: the student's actual score is 7 points lower than predicted. 2. Above the line; the model underpredicted. 3. No: the arch is a curved pattern, so the relationship is nonlinear. 4. No: curved data can have r near 1; check the residual plot. 5. The least-squares line passes through (x̄, ȳ) and balances the points above and below it (week 32 gives the details).

---

*Original study material for this course, organised around the College Board AP Statistics Course and Exam Description (Unit 5, Topic 5.4). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). All data are invented. AP® is a trademark of the College Board, which does not endorse this material.*
