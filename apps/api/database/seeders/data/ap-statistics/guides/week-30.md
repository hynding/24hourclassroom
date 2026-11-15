# Week 30 · Linear Regression Models

**Topics:** 5.3 Linear Regression Models
**Practices:** 3 (Analyze Data), 4 (Interpret Results)
**Framework:** AP Statistics CED (effective fall 2026), Unit 5, Topic 5.3, learning objectives in our own words
**Spiral:** Week 29 described a scatterplot and measured linear strength with r. When the form is linear, a line can summarise the pattern and make predictions. This week is about using and interpreting that line: the equation ŷ = a + bx, predicted values, the meaning of the slope and the y-intercept in context, and the danger of extrapolation. Week 31 checks the line with residuals; week 32 explains which line technology chooses and why.

## What you need to be able to do

- **5.3** Write a regression equation with its variables defined in context, and explain the difference between y and ŷ.
- **5.3** Use a regression equation to calculate a predicted response for a given x.
- **5.3** Interpret the slope of a regression line in context, as a predicted change in the response per one-unit increase in x.
- **5.3** Interpret the y-intercept in context, and judge whether it has a sensible meaning.
- **5.3** Recognise extrapolation (predicting outside the range of the observed x-values) and explain why it is unreliable.
- **5.3** Explain why a line that predicts y from x should not be solved backwards to predict x from y.

## Key terms

| Term | Meaning |
|---|---|
| Regression line | A straight line that describes how a response variable y changes, on average, as an explanatory variable x changes. |
| ŷ (y-hat) | The predicted (estimated) value of the response for a given x; y is an actual observed value. |
| Regression equation | ŷ = a + bx, with a the y-intercept and b the slope. |
| Slope b | The predicted change in y for each one-unit increase in x. Units: units of y per unit of x. |
| y-intercept a | The predicted value of y when x = 0. Units: units of y. |
| Interpolation | Predicting for an x inside the range of the data. |
| Extrapolation | Predicting for an x outside the range of the data; unreliable, because the pattern may not continue. |

## The regression equation (5.3)

A **linear regression model** describes the overall pattern of a linear scatterplot with an equation

ŷ = a + bx.

The hat matters. y is a real student's commute time; ŷ is what the model **predicts** for a student with that distance. Real points scatter around the line, so for almost every individual y ≠ ŷ. Writing "y = 4.2 + 2.6x" claims that every student's time sits exactly on the line, and it loses a point on the exam. Always define the variables in context, either in words in the equation or next to it:

predicted commute time = 4.2 + 2.6 (distance), or ŷ = 4.2 + 2.6x where x = distance from home to school in miles and ŷ = predicted commute time in minutes.

Computer output and calculators sometimes write the slope first (ŷ = 2.6x + 4.2) or use b₀ and b₁ for the intercept and slope; the meaning is the same.

**Worked example (predicting and interpreting).** A hypothetical school surveys 40 students who live between 1 and 18 miles away. Their distance from school x (miles) and morning commute time y (minutes) give the regression line ŷ = 4.2 + 2.6x.

- **Prediction.** For a student who lives 10 miles away, ŷ = 4.2 + 2.6(10) = 30.2 minutes. That is the model's predicted commute time for students who live 10 miles away; a particular 10-mile student might take 25 or 36 minutes.
- **Slope.** For each additional mile from school, the **predicted** commute time increases by 2.6 minutes.
- **y-intercept.** For a student who lives 0 miles from school, the predicted commute time is 4.2 minutes. Here this has a reasonable meaning (time to get out of the door and walk in from the car park), but no student in the data lived less than a mile away, so it is itself a mild extrapolation.

The interpretation templates, which earn credit on the AP exam:

- **Slope:** "For each one-unit increase in [x in context], the predicted [y in context] increases (or decreases) by [|b| with units]."
- **y-intercept:** "When [x in context] is 0, the predicted [y in context] is [a with units]."

The words "predicted" (or "on average") are required. The slope is not a promise that each individual changes by 2.6 minutes per mile; it describes the model's predictions.

## Units and meaning

The slope always has units "y per x": minutes per mile, centimetres per day, dollars per inch. Writing the units is the fastest check that you have the slope and intercept the right way round. The y-intercept has the units of y alone.

**Worked example (when the intercept is meaningless).** A hypothetical pizza shop sells sizes from 10 to 18 inches. Regressing price (dollars) on diameter (inches) gives ŷ = −4.10 + 1.45x.

- Slope: for each additional inch of diameter, the predicted price increases by $1.45.
- y-intercept: a pizza with diameter 0 inches has a predicted price of −$4.10. That is impossible, and x = 0 is far outside the 10 to 18 inch range of the data. The intercept here only anchors the line; it has no meaningful interpretation in context. On the exam, say so and give the reason.

## Using a model fitted by technology

**Worked example (a lab growth line).** A biology class measures the height of 8 bean seedlings on different days after sprouting.

| Days after sprouting (x) | 4 | 6 | 8 | 10 | 12 | 14 | 16 | 18 |
|---|---|---|---|---|---|---|---|---|
| Height in cm (y) | 2.9 | 4.6 | 5.2 | 7.4 | 8.1 | 9.9 | 10.6 | 12.8 |

The scatterplot is strong, positive and linear, so a line is reasonable. Technology gives

predicted height = 0.217 + 0.679 (days).

1. **Prediction (interpolation).** Day 9 lies inside the range 4 to 18, so ŷ = 0.217 + 0.679(9) = 6.33 cm is a reasonable prediction.
2. **Slope.** For each additional day after sprouting, the predicted seedling height increases by 0.679 cm.
3. **y-intercept.** On the day of sprouting (day 0), the predicted height is 0.217 cm. That is plausible for a fresh sprout, though day 0 lies just outside the data.
4. **Extrapolation.** For day 60 the line predicts 0.217 + 0.679(60) = 40.96 cm. Bean plants do not grow linearly for two months: they slow, flower, and some fall over. The line was built from days 4 to 18, and nothing in the data tells us what happens at day 60.

Keep enough digits. Rounding the slope to 0.7 changes the day-18 prediction from 12.44 to 12.82 cm. Use the full output values (or at least three significant figures) in calculations.

## Extrapolation

A regression line describes the relationship only over the range of x-values that were observed. Outside that range the true relationship may bend, level off, or stop making sense.

**Worked example (a negative price).** For 30 hypothetical used cars of one model, aged 1 to 10 years, price in thousands of dollars on age in years gives ŷ = 27.5 − 1.9x.

- Slope: for each additional year of age, the predicted price decreases by $1,900 (1.9 thousand dollars).
- For a 6-year-old car: ŷ = 27.5 − 1.9(6) = 16.1, so a predicted price of $16,100.
- For a 20-year-old car: ŷ = 27.5 − 1.9(20) = −10.5, a predicted price of −$10,500. Nobody pays you to take a car. Prices of old cars level off, so the straight line stops working outside the 1 to 10 year range. This is extrapolation.

A prediction can be unreliable without being absurd: the bean line at day 25 gives 17.2 cm, which sounds plausible but is still outside the data. Flag any x outside the observed range.

## A line predicts y from x, not x from y

The regression of y on x is built to predict y. If you want to predict days from height, you should fit a new line with height as the explanatory variable, not solve 0.217 + 0.679x = 7 for x. The two lines agree only when every point lies exactly on a line (r = ±1); the weaker the association, the further apart they are. Choose the explanatory variable to match the question before you fit anything.

## Common mistakes

- **Leaving off the hat.** Write ŷ (or "predicted"), never y = a + bx.
- **Undefined variables.** Say what x and ŷ are, with units.
- **Slope without "predicted".** "Commute time increases by 2.6 minutes per mile" overstates the model. "Predicted commute time increases by 2.6 minutes for each additional mile."
- **Swapping slope and intercept.** In ŷ = 4.2 + 2.6x the slope is the coefficient of x, wherever it is written.
- **Forcing a meaning onto the intercept.** If x = 0 is impossible or far from the data, say the intercept has no practical meaning.
- **Trusting extrapolation.** Check the range of x before predicting.
- **Causal language.** A slope from observational data is a predicted difference, not an effect. "Adding a mile causes 2.6 more minutes" needs an experiment.

## Where this goes next

Week 31 measures how far each point is from the line (a residual, y − ŷ) and uses a residual plot to decide whether a line is an appropriate model at all. Week 32 shows that technology picks the line that makes the squared residuals as small as possible, and connects the slope to r, sₓ and s_y.

## Self-check

1. A regression of weekly allowance (dollars) on age (years) for children aged 8 to 15 gives ŷ = −6.0 + 1.5x. Interpret the slope.
2. Interpret the y-intercept in question 1. Is it meaningful?
3. Predict the allowance of a 12-year-old and of a 30-year-old. Comment.
4. A line for exam score on hours studied is written score = 58 + 4.1 hours. What is wrong with the notation?
5. A line predicts 74 when x = 10 and 86 when x = 14. What is the slope?

*Answers:* 1. For each additional year of age, the predicted weekly allowance increases by $1.50. 2. A child aged 0 has a predicted allowance of −$6.00; not meaningful, because age 0 is far outside the 8 to 15 range and a negative allowance is impossible. 3. 12: −6.0 + 1.5(12) = $12.00. 30: $39.00, but 30 is far outside the data, so this extrapolation is unreliable (adults are not given allowances on this pattern). 4. It should say predicted score (ŷ), not score. 5. (86 − 74)/(14 − 10) = 3 points per unit of x.

---

*Original study material for this course, organised around the College Board AP Statistics Course and Exam Description (Unit 5, Topic 5.3). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). All data are invented. AP® is a trademark of the College Board, which does not endorse this material.*
