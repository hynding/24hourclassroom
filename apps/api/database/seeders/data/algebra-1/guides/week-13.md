# Week 13 · Linear Models, Fitting Lines and Residuals

**Lessons:** 3.4 Linear Models · 3.5 Fitting Lines · 3.6 Residuals
**Practices:** MP2 (interpret slope and intercept in context), MP4 (model data with a line and judge the fit), MP5 (use technology to find a line of best fit)
**Built from:** IM Algebra 1, Unit 3, Lessons 4–6, in our own words
**Spiral:** Unit 2 gave you lines through points chosen exactly. Now the points are data, so no line passes through all of them, and the question becomes which line fits best and how far each point misses it. Reading slope and intercept in context is the same skill as interpreting a linear equation from week 5.

## What you need to be able to do

- **3.4** Interpret the slope and vertical intercept of a linear model in the context of the data, and use the model to predict.
- **3.5** Fit a line to a scatter plot by eye and with technology (the least-squares line), and explain what "best fit" means.
- **3.6** Compute residuals, read a residual plot, and use residuals to judge whether a linear model is appropriate.

## Key terms

| Term | Meaning |
|---|---|
| Scatter plot | A graph of paired numerical data, one point per case, with the explanatory variable on the horizontal axis. |
| Linear model | An equation y = mx + b used to describe the overall trend in a scatter plot. |
| Slope (in context) | The predicted change in y for each 1-unit increase in x, with units. |
| Vertical intercept (in context) | The predicted y when x = 0; meaningful only if x = 0 makes sense in the situation. |
| Line of best fit | The line that makes the residuals as small as possible overall; technology finds the least-squares line. |
| Residual | Actual y minus predicted y for one data point. Positive means the point is above the line. |
| Residual plot | A scatter plot of x against the residuals, used to check whether a line is a suitable model. |
| Extrapolation | Predicting outside the range of the data; risky because the pattern may not continue. |

## Linear models in context (3.4)

A used-car website reports a model relating a car's age in years, x, to its price in thousands of dollars, y: y = −1.8x + 24.

- **Slope −1.8:** each additional year of age is associated with a price about $1,800 lower.
- **Intercept 24:** the model predicts a new car (age 0) at about $24,000.
- **Prediction:** at x = 5, y = −9 + 24 = 15, so about $15,000.

The model is a summary of a trend, not a rule each car obeys. A 5-year-old car in excellent condition might sell for $17,000; that is a residual of +2 (thousand dollars), the subject of lesson 3.6.

**Worked example.** A model for a plant's height in cm after d days is h = 0.6d + 4. Interpret both numbers and predict the height on day 20.
Slope 0.6: the plant grows about 0.6 cm per day. Intercept 4: it was about 4 cm tall when measurements began. Day 20: 0.6(20) + 4 = 16 cm.

**Try it.** A model gives the cost of a taxi ride as C = 2.5m + 3, with m miles. What does each number mean, and what does the model predict for a 6-mile ride?
*Answer:* $2.50 per mile; a $3 starting charge; 2.5(6) + 3 = $18.

## Fitting a line (3.5)

When points lie roughly along a line, we draw one that follows the trend with about as many points above as below, staying close to the cloud. Two students will draw slightly different lines by eye; technology removes the guesswork by computing the **least-squares line**, the line that minimises the sum of the squared residuals.

To find it with a calculator or spreadsheet: enter the x-values in one column and the y-values in another, and ask for a linear regression (often labelled LinReg or "add trendline, show equation"). It reports the slope and intercept, and usually a number r (next week).

**Worked example.** Hours studied, x, and quiz score, y, for five students: (1, 60), (2, 65), (3, 75), (4, 78), (5, 92). A spreadsheet gives the line y ≈ 7.7x + 50.9. Interpret: each extra hour of study is associated with about 7.7 more points; a student who studies 0 hours is predicted to score about 51. Predict for 3.5 hours: 7.7(3.5) + 50.9 ≈ 77.9.

**Judging a line by eye.** A good line passes through the middle of the cloud, follows its direction, and does not tilt to chase one unusual point. A line drawn through the two end points, or through the lowest and highest points, is usually a poor choice because those points are the most likely to be unusual.

**Try it.** Points (0, 2), (1, 4), (2, 5), (3, 7), (4, 8). Technology gives y = 1.5x + 2.2. Predict y at x = 2 and compare with the actual value.
*Answer:* Predicted 5.2; actual 5; the point is slightly below the line.

## Residuals (3.6)

A **residual** is actual − predicted. For the study data at x = 1: predicted 7.7(1) + 50.9 = 58.6, actual 60, residual 60 − 58.6 = +1.4. At x = 5: predicted 89.4, actual 92, residual +2.6. At x = 2: predicted 66.3, actual 65, residual −1.3.

| x | Actual y | Predicted y | Residual |
|---|---|---|---|
| 1 | 60 | 58.6 | +1.4 |
| 2 | 65 | 66.3 | −1.3 |
| 3 | 75 | 74.0 | +1.0 |
| 4 | 78 | 81.7 | −3.7 |
| 5 | 92 | 89.4 | +2.6 |

The residuals of the least-squares line always add to 0 (allowing for rounding), which is one way to check your arithmetic.

**Reading a residual plot.** Plot x against residual. If the dots scatter randomly above and below zero with no pattern, a line is a reasonable model. If they form a curve, say negative at the ends and positive in the middle, the data bend and a line is the wrong shape. If they fan out, the line fits worse for larger x. The residual plot magnifies what the scatter plot hides.

**Worked example.** Residuals for a data set are −8, −3, +2, +5, +6, +4, +1, −3, −7 as x increases. Is a line appropriate?
No. The residuals rise and then fall, a clear arch, so the data are curved and a linear model underestimates in the middle and overestimates at the ends.

**Try it.** A model predicts 42 for a point whose actual value is 38. Find the residual and say where the point sits relative to the line.
*Answer:* 38 − 42 = −4; the point is 4 units below the line.

## Common mistakes

- Computing predicted − actual instead of actual − predicted, which flips every sign.
- Interpreting the slope without units, or describing the intercept when x = 0 is outside the data (a car model's "age 0" is fine; a model of height against age 15–18 has a meaningless intercept).
- Drawing a line through the first and last points rather than through the cloud.
- Extrapolating far beyond the data and trusting the number.
- Calling a line a good fit because the points are "close" without looking at the residual plot for a pattern.

## Where this goes next

Week 14 attaches a number, the correlation coefficient r, to how tightly the points follow a line, and then asks the harder question of whether a strong relationship means one variable causes the other. Residuals return in unit 5, where a curved residual plot is the signal to try an exponential model instead.

## Self-check

1. A model is y = 3.2x − 5. Interpret the slope if x is weeks and y is dollars saved.
2. Using that model, predict y when x = 10.
3. The actual value at x = 10 was 30. Find the residual.
4. Residuals of a model are +1, −2, +2, −1, +1, −1 with no pattern. Is a line a reasonable model?
5. Why is a line through the lowest and highest points usually a poor line of fit?

*Answers:* (1) Savings grow by about $3.20 per week. (2) 32 − 5 = 27. (3) 30 − 27 = +3; the point is above the line. (4) Yes; the residuals are small and show no pattern. (5) Extreme points are the most likely to be unusual, so a line through them tilts away from the main cloud of points.

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Algebra 1, Unit 3, Lessons 4–6, https://im.kendallhunt.com/HS/teachers/1/3/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
