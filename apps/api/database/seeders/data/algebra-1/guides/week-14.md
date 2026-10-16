# Week 14 · Correlation, Causation and Modelling with Data

**Lessons:** 3.7 The Correlation Coefficient · 3.8 Using the Correlation Coefficient · 3.9 Causal Relationships · 3.10 Fossils and Flags
**Practices:** MP2 (connect the sign and size of r to the picture), MP3 (argue whether a causal claim is justified), MP4 (carry out a full modelling cycle on real data)
**Built from:** IM Algebra 1, Unit 3, Lessons 7–10, in our own words
**Spiral:** Week 13 fitted lines and measured each point's miss with a residual. This week one number, r, summarises how tightly the whole cloud hugs a line. The causation discussion applies equally to the two-way tables of week 12: an association, however strong, is not a cause.

## What you need to be able to do

- **3.7** Describe the strength and direction of a linear relationship from a scatter plot and match it to a value of the correlation coefficient r between −1 and 1.
- **3.8** Use technology to compute r, interpret it alongside the line of best fit, and explain what r does and does not measure.
- **3.9** Distinguish correlation from causation, suggest alternative explanations (a lurking variable, coincidence, reversed direction), and say what kind of evidence would support a causal claim.
- **3.10** Carry out a modelling task: fit a line, judge it with residuals and r, predict, and report the limits of the prediction.

## Key terms

| Term | Meaning |
|---|---|
| Correlation coefficient r | A number from −1 to 1 measuring the strength and direction of a *linear* relationship between two numerical variables. |
| Positive correlation | Larger x tends to go with larger y; r > 0 and the line slopes up. |
| Negative correlation | Larger x tends to go with smaller y; r < 0 and the line slopes down. |
| Strong / weak correlation | r near ±1 means points lie close to a line; r near 0 means a line explains little. |
| Causal relationship | A change in one variable actually produces a change in the other. |
| Lurking (confounding) variable | A third variable that influences both and creates a correlation between them. |
| Experiment | A study in which the researcher assigns the explanatory variable at random, the standard way to establish causation. |

## The correlation coefficient (3.7)

Scatter plots range from a tight line to a shapeless cloud. The correlation coefficient r puts a number on that:

| r | Picture |
|---|---|
| 1 | Every point exactly on a line that slopes up. |
| 0.9 | Points close to an upward line. |
| 0.5 | An upward trend you can see, but the points spread widely. |
| 0 | No linear trend at all. |
| −0.5 | A visible downward trend with wide spread. |
| −0.9 | Points close to a downward line. |
| −1 | Every point exactly on a line that slopes down. |

The **sign** of r matches the sign of the slope of the line of best fit. The **size** of r, ignoring sign, is the strength: 0.9 and −0.9 are equally strong. Roughly, |r| above 0.7 is strong, 0.3 to 0.7 moderate, below 0.3 weak, though these cut-offs are conventions, not laws.

**Worked example.** Match: (a) hours of daylight against month number from June to December; (b) a student's shoe size against their quiz score; (c) number of workers on a job against days to finish. Pick from r = −0.95, 0.02, −0.6.
(a) Daylight falls steadily, very close to a line: −0.95. (b) No reason for any relation: 0.02. (c) More workers, fewer days, but with much variation: −0.6.

**What r is not.** It is not the slope. A steep line with scattered points can have r = 0.4; a shallow line with points exactly on it has r = 1. It also does not measure curved relationships: points on a perfect U-shape can have r near 0.

**Try it.** Two scatter plots both slope upward. In plot A the points almost touch the line; in plot B they spread far from it. Which has r closer to 1?
*Answer:* Plot A. Both have positive r, but A is stronger.

## Using r with technology (3.8)

The same regression command that gives the line also gives r. Workflow:

1. Plot the data and look: is it roughly linear? If it clearly curves, r is the wrong summary.
2. Compute the line and r.
3. Check the residual plot for pattern.
4. Report the slope in context, the strength from r, and any caution.

**Worked example.** For the study-hours data of week 13, technology reports y = 7.7x + 50.9 and r ≈ 0.98. Interpretation: a strong positive linear relationship; students who studied more scored higher, and the line describes the pattern very well.

**Worked example.** A data set gives r = −0.35 for minutes of screen time against hours slept. Interpretation: a weak-to-moderate negative relationship; more screen time tends to go with less sleep, but with much variation, so the line predicts poorly for individuals.

**Changing r by changing the data.** Removing a point far from the line raises |r|; adding one lowers it. A single unusual point can swing r a great deal in a small data set, which is why you look at the plot and not just the number.

**Try it.** r = 0.15 for a data set of 12 points. Should you use the line of best fit to make predictions?
*Answer:* Not with confidence. The relationship is weak, so predictions from the line will often be far off.

## Correlation is not causation (3.9)

Ice-cream sales and drownings rise and fall together across the year, with r close to 0.9. Ice cream does not cause drowning. Hot weather increases both: a **lurking variable**. The rule: a strong correlation shows the variables move together; it does not show that changing one would change the other.

When you see a correlation, consider:

- **A lurking variable.** Something else drives both (weather, age, wealth, time of year).
- **Reverse direction.** Perhaps y causes x. Do fire engines cause damage, or do bigger fires attract more engines?
- **Coincidence.** With enough variables available, some unrelated pairs will line up by chance.
- **Real causation.** Possible, but it needs the right evidence.

**The evidence that supports causation** is an experiment: assign the explanatory variable at random (some plants get fertiliser, some do not, decided by coin flip) so that lurking variables average out, then compare. Observational data, where people chose their own x, can suggest a cause but cannot settle it.

**Worked example.** "Cities with more libraries have more crime (r = 0.8). Should we close libraries?" No: the lurking variable is population. Big cities have more of everything. Per-person rates would remove the effect.

**Worked example.** "Students who eat breakfast score higher on tests." Possible causes: breakfast helps concentration (causal); students from more organised households both eat breakfast and study more (lurking); or more attentive students choose to eat breakfast (a different lurking variable). Only an experiment that assigns breakfast at random could separate these.

**Try it.** A study finds a strong negative correlation between the number of smoke alarms in a home and the chance of dying in a fire. Is it reasonable to think the alarms are the cause? What else should you ask?
*Answer:* Plausible, because there is a mechanism (early warning). But ask whether homes with alarms also differ in other ways, such as newer wiring or wealthier owners; a trial that installs alarms at random would be convincing.

## Modelling with real data (3.10)

The last lesson of the unit puts everything together on real measurements, such as predicting a dinosaur's height from the length of a leg bone, or the length of a flag from its width. The cycle:

1. **Plot** and describe the shape.
2. **Fit** a line with technology; record the slope, intercept and r.
3. **Check** residuals for a pattern.
4. **Interpret** the slope in units, and the intercept if it makes sense.
5. **Predict** for a new case inside the range of the data; flag any extrapolation.
6. **Report** the result and its limits: how strong, what the model cannot say.

**Worked example.** Femur length f (cm) against height h (cm) for six fossils gives h = 2.4f + 20 with r = 0.97. A new femur measures 90 cm. Prediction: 2.4(90) + 20 = 236 cm. Because r is high and 90 cm is within the data (60 to 120 cm), the prediction is reasonable, though a residual of 10 cm on past points means the true height could easily be 225 to 245 cm.

**Try it.** Flags have width w and length l; a model gives l = 1.6w + 2 with r = 0.99 for widths 50 to 150 cm. Predict the length of a flag 80 cm wide.
*Answer:* 1.6(80) + 2 = 130 cm, a confident prediction given the very high r and in-range width.

## Common mistakes

- Treating r as the slope, or saying r = 0.9 means "90% of the points are on the line".
- Comparing strengths by sign: −0.8 is stronger than 0.6.
- Using r for a curved relationship, where it understates a real pattern.
- Concluding cause from a correlation without ruling out lurking variables.
- Forgetting that an experiment, not a larger survey, is what supports causation.

## Where this goes next

Unit 4 shifts from data to functions: notation, graphs, domain and range. The habit of asking whether a line describes a pattern returns in unit 5, when exponential models compete with linear ones, and in unit 6 when quadratic data appear.

## Self-check

1. Order by strength: r = 0.4, r = −0.85, r = 0.1.
2. A scatter plot slopes down with points fairly close to a line. Estimate r.
3. Can a line with a steep slope have a small r? Explain.
4. Countries with more televisions per person have longer life expectancy. Name a lurking variable.
5. What kind of study would show that a new fertiliser causes taller plants?

*Answers:* (1) −0.85 (strongest), 0.4, 0.1. (2) About −0.8. (3) Yes; r measures how close points are to a line, not how steep it is. (4) National wealth, which buys both televisions and health care. (5) An experiment that assigns fertiliser to randomly chosen plants and compares them with the rest.

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Algebra 1, Unit 3, Lessons 7–10, https://im.kendallhunt.com/HS/teachers/1/3/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
