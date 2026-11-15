# Week 32 · Least-Squares Regression

**Topics:** 5.5 Least-Squares Regression
**Practices:** 3 (Analyze Data), 4 (Interpret Results)
**Framework:** AP Statistics CED (effective fall 2026), Unit 5, Topic 5.5, learning objectives in our own words
**Spiral:** Week 29 measured linear strength with r, week 30 interpreted a line's slope and intercept, and week 31 judged a line by its residuals. This week answers the question left open: which line does technology fit, and why that one? It connects the line to the summary statistics of Unit 1 (x̄, ȳ, sₓ, s_y), measures how good the fit is with r² and s, reads standard computer output, and asks which unusual points pull the line around. It is the last new content of the course.

## What you need to be able to do

- **5.5** State the least-squares criterion: the line minimises the sum of the squared residuals.
- **5.5** Calculate the slope and intercept from summary statistics: b = r · s_y/sₓ and a = ȳ − b x̄, and use the fact that the line passes through (x̄, ȳ).
- **5.5** Interpret the coefficient of determination r² and the standard deviation of the residuals s in context.
- **5.5** Read the regression equation, s and r² from computer output, and recover r (with its sign).
- **5.5** Identify outliers, high-leverage points and influential points, and describe how each affects the slope, intercept, r and s.

## Key terms

| Term | Meaning |
|---|---|
| Least-squares regression line (LSRL) | The line that makes Σ(y − ŷ)², the sum of the squared residuals, as small as possible. |
| Slope formula | b = r · s_y/sₓ. |
| Intercept formula | a = ȳ − b x̄, so the line passes through (x̄, ȳ). |
| r² (coefficient of determination) | The proportion of the variation in y that is accounted for by the linear model with x. |
| s (standard deviation of the residuals) | The typical size of a prediction error: roughly how far actual y-values are from the line, in units of y. |
| Outlier (regression) | A point with a large residual: far from the line in the y direction. |
| High-leverage point | A point whose x-value is far from x̄: far from the others horizontally. |
| Influential point | A point whose removal noticeably changes the slope, intercept or correlation. |

## The least-squares criterion (5.5)

Many lines pass near the points. The least-squares line is the one with the smallest **sum of squared residuals**. Squaring makes every miss count positively and punishes big misses heavily.

**Worked example (comparing lines).** For the five basketball players of week 29 (practice hours x: 2, 3, 5, 6, 9; free throws made y: 9, 12, 11, 15, 18), compare two lines.

| Line | Residuals | Sum of residuals | Sum of squared residuals |
|---|---|---|---|
| ŷ = 7 + 1.2x (least squares) | −0.4, 1.4, −2.0, 0.8, 0.2 | 0 | 6.80 |
| ŷ = 6 + 1.4x | 0.2, 1.8, −2.0, 0.6, −0.6 | 0 | 8.00 |

Both lines have residuals that add to 0 (both pass through (x̄, ȳ) = (5, 13)), so "residuals add to 0" does not pick out the best line. The sum of squares does: 6.80 is the smallest possible value for these data, so ŷ = 7 + 1.2x is the least-squares line.

## Slope and intercept from summary statistics

The least-squares slope and intercept are

b = r · s_y/sₓ and a = ȳ − b x̄.

Two consequences:

- The line always passes through (x̄, ȳ). Substitute x = x̄: ŷ = (ȳ − b x̄) + b x̄ = ȳ.
- The slope has the same sign as r. Moving one standard deviation in x moves the prediction r standard deviations in y. Because |r| ≤ 1, predictions are pulled toward the mean of y ("regression to the mean").

**Worked example (from summary statistics).** For a random sample of 50 hypothetical students, hours of sleep the night before (x) and reaction time on a computer test in milliseconds (y) give x̄ = 7.1 h, sₓ = 1.2 h, ȳ = 285 ms, s_y = 32 ms and r = −0.62.

1. b = −0.62 × 32/1.2 = −16.53 ms per hour.
2. a = 285 − (−16.53)(7.1) = 285 + 117.39 = 402.39 ms.
3. Line: predicted reaction time = 402.39 − 16.53 (hours of sleep).
4. Check: at 8 hours, ŷ = 402.39 − 132.27 = 270.12 ms. A student who slept 0.75 SD above the mean (8 h) is predicted to be 0.62 × 0.75 = 0.465 SD faster than average: 285 − 0.465 × 32 = 270.12 ms.

## How good is the fit? r² and s

**r²** compares the line's errors with the errors you would make by predicting ȳ for everyone. If r² = 0.83, the line removes 83% of the squared variation around ȳ. Template:

"About [r² as a %] of the variation in [y in context] is accounted for by the linear model relating [y] to [x]."

**s** is the standard deviation of the residuals, s = √(Σ(y − ŷ)²/(n − 2)). Template:

"The actual [y in context] typically varies by about [s with units] from the value predicted by the least-squares line using [x in context]."

r² is a proportion with no units; s has the units of y. A good model has a large r² and a small s relative to the size of y, plus a patternless residual plot (week 31).

## Computer output

Software prints a table like the one below. On this course you read the **Coef** column, **S** and **R-sq**. The SE Coef, T and P columns are used for inference about the slope, which is not part of the redesigned course, so ignore them.

**Worked example (reading output).** A hypothetical forestry club measures 20 young pine trees: trunk diameter in cm (x, from about 2 to 14 cm) and height in metres (y).

| Predictor | Coef | SE Coef | T | P |
|---|---|---|---|---|
| Constant | −0.1763 | 0.3128 | −0.56 | 0.580 |
| Diameter | 0.4744 | 0.0328 | 14.45 | 0.000 |

S = 0.4931 · R-sq = 92.1% · R-sq(adj) = 91.6%

- **Equation:** predicted height = −0.1763 + 0.4744 (diameter). The Constant row is the intercept; the row named after x is the slope.
- **Slope:** for each additional centimetre of trunk diameter, the predicted height increases by 0.4744 m.
- **Intercept:** a tree with diameter 0 cm has predicted height −0.18 m: impossible and outside the data, so no practical meaning.
- **r²:** about 92.1% of the variation in tree height is accounted for by the linear model relating height to trunk diameter.
- **s:** actual heights typically vary by about 0.49 m from the heights predicted from trunk diameter.
- **r:** r = +√0.921 = 0.960. Take the sign from the slope; a square root alone would lose it.

R-sq(adj) is a refinement used with several predictors; with one predictor, report R-sq.

## Outliers, leverage and influence

Unusual points come in different kinds, and the kinds have different effects.

- An **outlier** has a large residual. It tends to lower |r| and raise s.
- A **high-leverage** point has an x-value far from the others. It has the power to swing the line, because the line pivots about (x̄, ȳ).
- A point is **influential** if removing it noticeably changes the slope, the intercept or r. High-leverage points that do not follow the pattern are usually influential.

**Worked example (three kinds of unusual point).** A new typing student records her speed (words per minute) after each of weeks 1 to 8: 31, 40, 44, 56, 61, 66, 79, 82. The least-squares line is ŷ = 24.0 + 7.417x, with r = 0.994 and s = 2.22 wpm. Now add one more point in each of three ways.

| Added point | Slope b | Intercept a | r | What kind of point |
|---|---|---|---|---|
| none | 7.417 | 24.0 | 0.994 | — |
| (16 weeks, 149 wpm) | 7.822 | 22.36 | 0.998 | High leverage, follows the pattern: little change, r rises slightly |
| (16 weeks, 60 wpm) | 2.120 | 45.42 | 0.553 | High leverage and off the pattern: influential, the slope collapses |
| (4.5 weeks, 110 wpm) | 7.417 | 29.85 | 0.694 | Outlier at x̄: slope unchanged, line shifts up, r drops and s rises to 18.87 |

The middle-of-the-data outlier leaves the slope exactly where it was, because its x-value equals x̄ = 4.5; it lifts the line and inflates s instead. The 16-week point at 60 wpm (perhaps she stopped practising for two months) drags the right end of the line down and is strongly influential. The 16-week point at 149 wpm has high leverage but sits near the line, so it barely moves anything.

On the exam: name the point, say which kind it is, and say what happens to the slope, intercept, r or s when it is removed, with a reason. Never delete a point just because it is unusual; investigate it, and report the analysis with and without it if it is influential.

## Common mistakes

- **Saying the LSRL "goes through the most points".** It minimises the sum of squared vertical distances; it may pass through no data point at all.
- **Swapping sₓ and s_y in the slope formula.** b = r · s_y/sₓ: the response's SD is on top.
- **Interpreting r² as "the percentage of points on the line"** or "the percentage of y caused by x". It is the proportion of variation in y accounted for by the linear model.
- **Forgetting the sign when taking √r².** Use the sign of the slope.
- **Confusing s with s_y.** s is the spread of the residuals around the line; s_y is the spread of y around ȳ.
- **Treating every outlier as influential.** Influence depends on leverage and on whether the point follows the pattern.
- **Using the T and P columns.** Inference for the slope is not on this course.

## Where this goes next

Unit 5 is complete, and so is the course content. Weeks 33 and 34 review the whole year with the exam-prep guide and a full practice final in the May 2027 format.

## Self-check

1. Summary statistics: x̄ = 20, sₓ = 4, ȳ = 50, s_y = 10, r = 0.8. Find the least-squares line.
2. For that line, predict y for x = 24, and explain the answer in SD terms.
3. Output shows R-sq = 64.0% and a negative slope. What is r?
4. A line for predicting commute time has s = 6.2 minutes. Interpret s.
5. Removing one point changes the slope from 1.9 to 0.4. What kind of point is it, and where is it likely to be?
6. Why do the SE Coef, T and P columns not matter on this course?

*Answers:* 1. b = 0.8 × 10/4 = 2, a = 50 − 2(20) = 10, so ŷ = 10 + 2x. 2. ŷ = 58: x is 1 SD above x̄, so the prediction is r = 0.8 SD above ȳ (50 + 8). 3. r = −0.8. 4. Actual commute times typically vary by about 6.2 minutes from the times predicted by the line. 5. An influential point, most likely a high-leverage point (x far from x̄) that does not follow the pattern. 6. They are for inference about the slope, which the redesigned course does not include.

---

*Original study material for this course, organised around the College Board AP Statistics Course and Exam Description (Unit 5, Topic 5.5). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). All data are invented. AP® is a trademark of the College Board, which does not endorse this material.*
