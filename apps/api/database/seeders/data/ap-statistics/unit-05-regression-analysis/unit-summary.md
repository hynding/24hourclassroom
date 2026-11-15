# Unit 5 · Regression Analysis · The night-before sheet

**AP exam weight:** 10–20% of the multiple-choice section
**Topics:** 5.1 Graphical Representations Between Two Quantitative Variables · 5.2 Correlation · 5.3 Linear Regression Models · 5.4 Residuals · 5.5 Least-Squares Regression
**Practices:** 1 (Formulate Questions), 3 (Analyze Data), 4 (Interpret Results)
**Framework:** AP Statistics CED (effective fall 2026), Unit 5, Topics 5.1–5.5, in our own words

## The ideas that generate every question

1. **Start with the plot (5.1).** Two quantitative variables on the same individuals go on a scatterplot, explanatory on x and response on y. Describe direction, form, strength and unusual features, always naming both variables.
2. **r measures linear strength only (5.2).** −1 ≤ r ≤ 1, unitless, the same if x and y are swapped or units change, pulled by outliers, and blind to curves. A strong curve can give r near 0 or near ±1.
3. **Association is not causation (5.2).** Observational data leave lurking variables open; only random assignment supports cause and effect. Random sampling supports generalising to the population.
4. **A line models the average pattern (5.3).** ŷ = a + bx predicts; the slope is the predicted change in y per one-unit increase in x; the intercept is the prediction at x = 0, which may have no meaning. Predictions outside the observed x-values are extrapolation.
5. **Residuals check the line (5.4).** residual = y − ŷ. A residual plot with random scatter supports a linear model; a curve says the form is wrong; a fan says predictions are less precise where the spread is large.
6. **Least squares picks the line, r² and s grade it (5.5).** The LSRL minimises Σ(y − ŷ)², passes through (x̄, ȳ) and has slope b = r · s_y/sₓ. r² is the proportion of variation in y accounted for; s is the typical prediction error. Unusual points can be outliers, high-leverage or influential.

## Key facts and procedures

| Want | Do this |
|---|---|
| Describe a scatterplot | direction, form, strength, unusual features, in context |
| Correlation | r = (1/(n − 1)) Σ zₓ z_y; technology in practice |
| Effect of changing units on r | none |
| Effect of swapping x and y on r | none |
| Predicted value | substitute x into ŷ = a + bx |
| Residual | y − ŷ (actual minus predicted) |
| Actual value from a residual | y = ŷ + residual |
| Slope from summary statistics | b = r · s_y/sₓ |
| Intercept from summary statistics | a = ȳ − b x̄ |
| Point always on the LSRL | (x̄, ȳ) |
| r from output | ±√(R-sq), sign of the slope |
| Is a line appropriate? | residual plot: random scatter, no curve |
| Typical prediction error | s (S in output), units of y |
| Proportion of variation explained | r² (R-sq in output) |
| Output columns to ignore | SE Coef, T, P (inference for slope is not on the course) |
| Effect of removing an outlier near x̄ | slope about the same, \|r\| up, s down |
| Effect of removing an influential high-leverage point | slope (and intercept, r) change a lot |

## Sentences that earn AP points

- **Scatterplot:** "There is a strong, negative, linear association between daily high temperature and hot drinks sold, with no obvious outliers."
- **Correlation:** "r = −0.81 indicates a moderately strong, negative, linear association between evening phone minutes and hours of sleep."
- **Slope:** "For each additional mile from school, the predicted commute time increases by 2.6 minutes."
- **y-intercept:** "When the trunk diameter is 0 cm, the predicted height is −0.18 m; this has no practical meaning because a diameter of 0 is impossible and far outside the data."
- **Residual:** "The actual height of student 7 is 4.22 cm greater than the height predicted by the regression line using his arm span of 179 cm."
- **Residual plot:** "The residual plot shows random scatter around 0 with no curved pattern, so a linear model is appropriate." Or: "The residual plot shows a clear U shape, so the relationship is curved and a linear model is not appropriate."
- **r²:** "About 83.1% of the variation in quiz scores is accounted for by the linear model relating quiz score to practice minutes."
- **s:** "Actual quiz scores typically vary by about 5.1 points from the scores predicted by the line using practice minutes."
- **Extrapolation:** "150 minutes is far outside the 12 to 88 minutes in the data, so this prediction is an extrapolation and is unreliable."
- **Influence:** "The 30-mile ride has high leverage and is influential: removing it changes the slope from 0.291 to 0.572 dollars per mile."
- **Causation:** "Because students chose their own practice time, these data are observational and cannot show that practice causes higher scores; a lurking variable such as motivation could explain the association."

## Classic question types and how to attack them

**"Describe the relationship."** Four features plus context. Name any outlier by its coordinates.

**"Interpret r (or r², s, slope, intercept, a residual)."** Use the template word for word, fill in the context and units, and include "predicted" for slope and intercept.

**"Find the regression line."** From data: technology, then write it with ŷ and named variables. From summary statistics: b = r · s_y/sₓ, then a = ȳ − b x̄. From output: the Coef column.

**"Is a linear model appropriate?"** Look at the residual plot, not r. Random scatter: yes. Curve: no, and say a curved model would fit better (transformations are not on this course).

**"Predict and comment."** Compute ŷ, then check whether x is inside the observed range. Outside means extrapolation.

**"What happens if this point is removed?"** Decide whether it has high leverage (x far from x̄) and whether it follows the pattern. Off-pattern and high leverage: the slope changes a lot. On-pattern and high leverage: little change, r drops slightly. Large residual near x̄: slope about the same, |r| rises, s falls.

**"Can we conclude that x causes y?"** Only with random assignment. Otherwise name a plausible lurking variable and describe an experiment.

## Common mistakes

- Forgetting the hat (y instead of ŷ) or leaving variables undefined.
- Slope interpretations without "predicted"; slope and intercept swapped.
- Residual computed as predicted minus actual.
- Judging linearity by r; reading random scatter in a residual plot as "no relationship".
- Interpreting r² as a percentage of points on the line, or as the percentage of y caused by x.
- Losing the sign when taking √r².
- b = r · sₓ/s_y (upside down).
- Confusing s (spread around the line) with s_y (spread around ȳ).
- Calling every outlier influential, or every high-leverage point influential.
- Using the T and P columns for a test about the slope (not on this course).
- Correlation for categorical variables; causal claims from observational data.

## Calculator or not?

Calculators are allowed on every AP Statistics question. Use technology for r and for the least-squares line from data, but expect the exam to hand you computer output or summary statistics and to ask you to read and interpret, not compute from scratch.

## Self-test

1. r = 0.05 for a clear arch-shaped scatterplot. Describe the relationship correctly.
2. x̄ = 12, sₓ = 3, ȳ = 70, s_y = 9, r = −0.5. Find the LSRL.
3. Output: Constant 18.2, slope 0.64, S = 2.3, R-sq = 49%. Find r and interpret S if y is a test score.
4. A point has a residual of −4.5 kg. Is it above or below the line?
5. A residual plot fans out as x increases. Is a line appropriate?
6. A high-leverage point lies right on the line. Removing it changes the slope from 1.20 to 1.18. Is it influential?

**Answers.** 1. Very little linear association, but a strong curved association. 2. b = −0.5 × 9/3 = −1.5, a = 70 − (−1.5)(12) = 88, so ŷ = 88 − 1.5x. 3. r = +√0.49 = 0.7; actual scores typically vary by about 2.3 points from the scores predicted by the line. 4. Below (overpredicted). 5. The form can still be linear, but predictions are less precise for larger x. 6. No: it has high leverage but follows the pattern, so removing it barely changes the line.

---

*Original study material for this course, organised around the College Board AP Statistics Course and Exam Description (Unit 5, Topics 5.1–5.5). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). All data are invented. AP® is a trademark of the College Board, which does not endorse this material.*
