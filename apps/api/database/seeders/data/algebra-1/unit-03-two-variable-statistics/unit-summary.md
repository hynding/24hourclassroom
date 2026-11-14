# Unit 3 · Two-variable Statistics · The night-before sheet

**Final-exam weight:** about 8–10% · **Lessons:** 3.1 Two-way Tables · 3.2 Relative Frequency Tables · 3.3 Associations in Categorical Data · 3.4 Linear Models · 3.5 Fitting Lines · 3.6 Residuals · 3.7 The Correlation Coefficient · 3.8 Using the Correlation Coefficient · 3.9 Causal Relationships · 3.10 Fossils and Flags
**Practices:** MP2, MP3, MP4, MP5, MP6 · **Built from:** IM Algebra 1, Unit 3, in our own words

## The ideas that generate every question

1. **Two categorical variables go in a two-way table.** Inner cells count cases in both categories; margins total the rows and columns; the grand total is in the corner. Every row and column must add up.
2. **"Percentage of what?"** A cell divided by the grand total is a joint relative frequency; divided by its row or column total it is a conditional relative frequency. The word after "of" names the divisor.
3. **Association in a table means the conditional percentages differ across groups.** Compare percentages, never raw counts, because groups differ in size. Say how big the gap is and how large the groups were.
4. **Two numerical variables go in a scatter plot, summarised by a line.** The slope is the predicted change in y per unit of x, with units; the intercept is the prediction at x = 0, meaningful only when x = 0 makes sense.
5. **Residual = actual − predicted.** Positive means above the line. The least-squares line minimises the sum of squared residuals and its residuals sum to 0. A residual plot with no pattern says a line is appropriate; a curve says it is not.
6. **r measures how tightly points hug a line, from −1 to 1.** Sign gives direction; distance from 0 gives strength. r is not the slope and does not detect curves.
7. **Correlation is not causation.** Consider a lurking variable, reversed direction or coincidence. Only an experiment with random assignment supports a causal claim.

## Key formulas and procedures

| Task | Procedure |
|---|---|
| Missing cell | subtract the known cells in the row (or column) from its total |
| Joint relative frequency | cell ÷ grand total |
| Row / column relative frequency | cell ÷ row total, or cell ÷ column total |
| Test for association | compute the same conditional percentage in each group; compare the gap |
| Predict with a model | substitute x into y = mx + b |
| Residual | actual y − predicted y |
| Check a residual table | the residuals of the least-squares line add to 0 |
| Judge a linear model | residual plot: random scatter good, curve or fan bad |
| Read r | sign = direction; size of r above 0.7 strong, 0.3–0.7 moderate, below 0.3 weak |
| Effect of a far-off point | removing a point far from the line moves r farther from 0 |
| Causation | lurking variable? reverse direction? coincidence? random-assignment experiment? |
| Extrapolation | flag any prediction outside the range of the data |

## Worked examples

**Two-way table.** 120 students: 24 play a sport and an instrument, 46 sport only, 26 instrument only, 24 neither. Row totals 70 and 50; column totals 50 and 70. Of sport players, 24/70 ≈ 34% play an instrument; of non-players, 26/50 = 52%. An 18-point gap: students who do not play a sport are more likely to play an instrument.

**No association.** 15 of 60 cats and 35 of 140 dogs are over 5: 25% and 25%. The larger dog count means nothing.

**Model in context.** Price of a used car in thousands, y = −1.8x + 24 with x in years: each year is associated with about $1,800 less; a new car is predicted at $24,000; at 5 years, $15,000.

**Residuals.** Study hours and scores (1, 60), (2, 65), (3, 75), (4, 78), (5, 92) with y = 7.7x + 50.9: residuals +1.4, −1.3, +1.0, −3.7, +2.6, which sum to 0. No pattern, so a line fits; r ≈ 0.98.

**Reading r.** Daylight hours against month from June to December: steady fall, tight line, r ≈ −0.95. Shoe size against quiz score: r ≈ 0. Workers against days to finish: downward with spread, r ≈ −0.6.

**Causation.** Ice-cream sales and drownings, r = 0.9: hot weather drives both. Libraries and crime across cities, r = 0.8: population drives both. Breakfast and test scores: could be causal, could be household routine; only random assignment of breakfast would settle it.

**Modelling.** Femur length f to height h for fossils, h = 2.4f + 20 with r = 0.97, data from 60 to 120 cm. A 90 cm femur predicts 236 cm, inside the range and trustworthy; a 200 cm femur predicts 500 cm but is extrapolation and must be flagged.

## Common errors

- Dividing by the grand total when the question is about one row or column, or the reverse.
- Comparing counts across groups of different sizes and calling the larger count an association.
- Calling a 2-point gap in groups of 20 an association.
- Computing predicted − actual, which flips every residual's sign.
- Interpreting the slope without units, or the intercept when x = 0 is meaningless.
- Reading r as the slope, or as the fraction of points on the line.
- Comparing strengths by sign: −0.8 is stronger than 0.6.
- Using r for a curved relationship.
- Concluding cause from a correlation, or thinking a bigger survey proves causation.
- Trusting an extrapolated prediction.

## Quick drills (answers at the end)

1. A table has cells 30 and 20 in row 1, 10 and 40 in row 2. What percent of row 1 is in column 1? Of column 1 is in row 1?
2. Is there an association in that table? Use row percentages.
3. A model is y = 4x + 9. Predict y at x = 6, and find the residual if the actual value is 30.
4. Residuals of a model are −6, −2, +3, +5, +4, +1, −3, −6 as x increases. Is a line appropriate?
5. Rank by strength: r = 0.5, r = −0.75, r = 0.2.
6. Towns with more churches have more bars. Lurking variable?
7. A model fitted for x from 10 to 50 is used at x = 200. What should you say?

*Answers:* (1) 30/50 = 60%; 30/40 = 75%. (2) Row 1 is 60% column 1, row 2 is 10/50 = 20%: a 40-point gap, associated. (3) 33; 30 − 33 = −3. (4) No; the residuals arch (negative, positive, negative), so the data curve. (5) −0.75, 0.5, 0.2. (6) Population. (7) The prediction is an extrapolation far outside the data and is unreliable.

## What to review from earlier units

- Mean, median and quartiles (unit 1) appear in exam review items alongside the two-variable material.
- Slope from two points and the meaning of y = mx + b (unit 2) are exactly the skills used to read a linear model.
- Checking a point against an equation (unit 2) is the same move as computing a predicted value.

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Algebra 1, Unit 3, https://im.kendallhunt.com/HS/teachers/1/3/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
