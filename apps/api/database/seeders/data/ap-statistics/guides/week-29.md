# Week 29 · Scatterplots and Correlation

**Topics:** 5.1 Graphical Representations Between Two Quantitative Variables · 5.2 Correlation
**Practices:** 1 (Formulate Questions), 3 (Analyze Data), 4 (Interpret Results)
**Framework:** AP Statistics CED (effective fall 2026), Unit 5, Topics 5.1–5.2, learning objectives in our own words
**Spiral:** Unit 1 described one quantitative variable by shape, centre, spread and unusual values, and Unit 2 described the association between two categorical variables with a two-way table. This week moves to two quantitative variables measured on the same individuals: the scatterplot is the picture, and the correlation r is the number that measures how tightly the points cluster around a line. Unit 1's z-scores come back, because r is built from them, and Unit 1's lesson about causation (only random assignment earns it) matters more than ever.

## What you need to be able to do

- **5.1** Identify the explanatory and response variables and put them on the correct axes.
- **5.1** Describe a scatterplot by its direction, form, strength and unusual features, in context.
- **5.1** Write a statistical investigative question about the relationship between two quantitative variables.
- **5.2** Interpret the correlation r in context, and estimate r from a scatterplot.
- **5.2** Compute r from data (with technology, or from z-scores for a small data set) and state its properties.
- **5.2** Explain why a strong correlation does not by itself show that one variable causes the other.

## Key terms

| Term | Meaning |
|---|---|
| Bivariate quantitative data | Two quantitative variables measured on each individual (a pair (x, y) per individual). |
| Explanatory variable | The variable that may help explain or predict the other; drawn on the horizontal (x) axis. |
| Response variable | The outcome we want to explain or predict; drawn on the vertical (y) axis. |
| Scatterplot | One dot per individual at (x, y). |
| Direction | Positive (y tends to rise as x rises), negative (y tends to fall), or no clear direction. |
| Form | Linear, curved (nonlinear), or clusters. |
| Strength | How closely the points follow the form: strong, moderate or weak. |
| Unusual features | Outliers (points far from the overall pattern) and distinct clusters. |
| Correlation r | A number from −1 to 1 measuring the direction and strength of a **linear** association. |
| Lurking (confounding) variable | A variable not in the study that is related to both x and y and can create or hide an association. |

## Scatterplots (5.1)

Every regression question starts with an investigative question that names two quantitative variables and a population: "For students at a hypothetical high school, is the number of minutes spent on a phone after 9 p.m. associated with the number of hours slept that night?" The question tells you which variable is explanatory (phone minutes) and which is the response (hours of sleep). If neither variable obviously explains the other, either one may go on the x-axis, but the choice matters later, because the regression line in Week 30 predicts y from x.

A description of a scatterplot has four parts, always in context:

1. **Direction:** positive or negative.
2. **Form:** linear or curved, and whether there are clusters.
3. **Strength:** strong, moderate or weak (r helps once the form is linear).
4. **Unusual features:** any outlier, named by its coordinates, and any gaps or clusters.

"There is a strong, negative, linear association" is half an answer. "There is a strong, negative, linear association between evening phone minutes and hours of sleep, with no obvious outliers" names the variables, which is what earns the point.

**Worked example (describing a scatterplot).** A school counsellor records two variables for 12 hypothetical students: minutes of phone use after 9 p.m. and hours of sleep that night.

| Phone minutes | 15 | 20 | 30 | 45 | 50 | 60 | 75 | 80 | 90 | 105 | 110 | 120 |
|---|---|---|---|---|---|---|---|---|---|---|---|---|
| Hours of sleep | 8.4 | 7.9 | 7.6 | 8.1 | 7.0 | 7.2 | 7.6 | 7.4 | 6.9 | 7.3 | 6.8 | 6.2 |

Phone minutes is the explanatory variable (x-axis) and sleep is the response (y-axis). Plotting the points shows that students with more evening phone time tend to sleep less, the points follow a roughly straight band, and they scatter noticeably around that band. Description: there is a moderately strong, negative, linear association between minutes of evening phone use and hours of sleep for these 12 students. No point stands far from the pattern; the student with 120 minutes and 6.2 hours is the lowest point but sits where the trend predicts. (Technology gives r = −0.811, which agrees with "moderately strong".)

## Correlation (5.2)

The correlation r is the average product of z-scores:

r = (1/(n − 1)) Σ zₓ · z_y, where zₓ = (x − x̄)/sₓ and z_y = (y − ȳ)/s_y.

Why this works: a point that is above average in both variables (both z-scores positive) or below average in both (both negative) adds a positive product. A point above average in one and below in the other adds a negative product. If most points sit in the "both above" and "both below" regions, r is positive.

**Worked example (r from z-scores).** Five hypothetical basketball players record hours of extra practice in a week (x) and free throws made out of 20 at the end of the week (y).

| Player | x (hours) | y (made) | zₓ | z_y | zₓ · z_y |
|---|---|---|---|---|---|
| 1 | 2 | 9 | −1.095 | −1.131 | 1.239 |
| 2 | 3 | 12 | −0.730 | −0.283 | 0.207 |
| 3 | 5 | 11 | 0.000 | −0.566 | 0.000 |
| 4 | 6 | 15 | 0.365 | 0.566 | 0.207 |
| 5 | 9 | 18 | 1.461 | 1.414 | 2.066 |

Here x̄ = 5, sₓ = 2.739, ȳ = 13 and s_y = 3.536. The products add to 3.718, so r = 3.718/(5 − 1) = 0.930. Interpretation: there is a strong, positive, linear association between hours of extra practice and free throws made for these five players. On the exam you will use technology for r, but knowing the formula explains every property below.

**Properties of r** (each follows from the z-score formula):

- r is always between −1 and 1. The sign gives the direction; the closer |r| is to 1, the stronger the linear association. r = ±1 only when every point lies exactly on a line.
- r has no units. Changing units (minutes to hours, °F to °C, dollars to euros) changes no z-score, so r stays the same. Using phone **hours** instead of minutes in the first example still gives r = −0.811.
- Swapping x and y does not change r: the formula is symmetric.
- r measures **linear** association only. A strong curved pattern can have r near 0, and a curved pattern can also have r near ±1. Always look at the scatterplot first.
- r is **not resistant**. Like the mean and the standard deviation, it is pulled by outliers.

**Worked example (a strong curve with r near 0).** A hypothetical driving test records a car's fuel economy at seven steady speeds.

| Speed (mph) | 20 | 30 | 40 | 50 | 60 | 70 | 80 |
|---|---|---|---|---|---|---|---|
| Miles per gallon | 24 | 30 | 33 | 34 | 33 | 30 | 25 |

The points rise and then fall in an almost perfect arch, yet r = 0.058. The right statement is "there is almost no **linear** association, but there is a strong curved association between speed and fuel economy." Saying "speed and fuel economy are unrelated" because r ≈ 0 is wrong.

**Worked example (one outlier).** Add a sixth player to the free-throw data who practised 8 hours but made only 6 of 20 (she was ill on test day). Recomputing gives r = 0.317, down from 0.930. One point in the "above average x, below average y" region contributed a large negative product. Report the correlation with and without the point, and investigate the point rather than deleting it silently.

## Correlation is not causation

A strong correlation in observational data never establishes cause and effect. Three things can produce an association:

- x really does cause changes in y;
- a **lurking variable** drives both (in the phone data, students with heavier homework loads may both use their phones late for group chats and go to bed later);
- coincidence, especially with small samples.

**Worked example (lurking variable).** Across 30 hypothetical towns, the number of public swimming pools correlates strongly with the number of ice-cream shops (r = 0.88). Building pools will not open ice-cream shops: town population drives both counts. To show that one variable **causes** changes in another you need a randomized experiment (Unit 1): randomly assign individuals to levels of x, control other variables, and compare responses. With the phone data, a counsellor could randomly assign volunteer students to "phone in another room after 9 p.m." or "usual habits" and compare mean sleep (a two-sample t procedure from Unit 4).

Scope still follows the Unit 1 rule: random sampling lets you generalise an association to the population; only random assignment supports a causal conclusion.

## Common mistakes

- **Describing without context.** Name both variables in every description and interpretation.
- **Leaving out form.** "Strong and negative" is incomplete; say linear or curved.
- **Using r for a curved pattern.** r describes linear association only. Look at the plot first.
- **Thinking r = 0 means no relationship.** It means no linear relationship.
- **Thinking units change r.** They do not; neither does swapping x and y.
- **Ignoring outliers.** One point can raise or lower r dramatically.
- **Calling correlation causation.** Observational data show association; only a randomized experiment shows cause and effect.
- **Saying "strong correlation" for categorical variables.** Correlation is for two quantitative variables; for two categorical variables use a two-way table and conditional proportions.

## Where this goes next

Week 30 fits a line to a linear scatterplot and uses it to predict, interpreting slope and y-intercept. Week 31 checks that line with residuals and residual plots. Week 32 explains why the least-squares line is the best line, and connects it to r through r² and the slope formula b = r · s_y/sₓ.

## Self-check

1. A study records each student's height and shoe length. Which variable would you put on the x-axis to predict height from shoe length?
2. Describe this: "As hours worked per week at a part-time job increase, GPA tends to decrease, the points scatter widely around a straight band, and one student working 40 hours has a GPA of 3.9."
3. A data set of temperatures in °F and electricity use has r = 0.72. What is r if temperature is converted to °C?
4. r = −0.95 for a curved pattern. Is a line a good model? Explain.
5. Ten points have r = 0.10, but the scatterplot shows a clear U shape. Write a correct sentence.
6. Cities with more police officers have more crimes (r = 0.80). Does hiring officers cause crime?

*Answers:* 1. Shoe length (explanatory) on x, height on y. 2. A weak-to-moderate, negative, linear association between hours worked and GPA, with an outlier at (40 hours, GPA 3.9). 3. Still 0.72: r has no units. 4. Not necessarily: r only measures linear strength; a curved pattern needs a curved model, whatever r is. 5. "There is very little linear association, but a strong curved (U-shaped) association between the two variables." 6. No: population size is a lurking variable that drives both counts, and the data are observational.

---

*Original study material for this course, organised around the College Board AP Statistics Course and Exam Description (Unit 5, Topics 5.1–5.2). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). All data are invented. AP® is a trademark of the College Board, which does not endorse this material.*
