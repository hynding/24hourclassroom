# Unit 1 · One-variable Statistics · The night-before sheet

**Final-exam weight:** about 10–12% · **Lessons:** 1.1 Getting to Know You · 1.2 Data Representations · 1.3 A Gallery of Data · 1.4 The Shape of Distributions · 1.5 Calculating Measures of Center and Variability · 1.6 Mystery Computations · 1.7 Spreadsheet Computations · 1.8 Spreadsheet Shortcuts · 1.9 Technological Graphing · 1.10 The Effect of Extremes · 1.11 Comparing and Contrasting Data Distributions · 1.12 Standard Deviation · 1.13 More Standard Deviation · 1.14 Outliers · 1.15 Comparing Data Sets · 1.16 Analyzing Data
**Practices:** MP2, MP3, MP5, MP6 · **Built from:** IM Algebra 1, Unit 1, in our own words

## The ideas that generate every question

1. **A statistical question is answered by a distribution.** The answer varies from case to case, so you collect data and describe the whole pattern, not one number. Categorical data are labels (summarise with counts); numerical data are measurements or counts (summarise with centre and spread).
2. **Plot first, compute second.** Dot plots show every value, histograms show shape for large data sets, box plots show the five-number summary and compare groups. The shape you see, symmetric, skewed, uniform, bimodal, decides which statistics to report.
3. **Centre and spread travel together.** Mean or median says what is typical; MAD, IQR or standard deviation says how much the values vary. Report one of each.
4. **Resistance.** The median and IQR depend on positions, so extreme values barely move them. The mean, MAD and SD depend on every value's size, so one extreme value can drag them a long way. Skewed right means mean > median.
5. **Outliers have a rule.** Below Q1 − 1.5 × IQR or above Q3 + 1.5 × IQR. Investigate the cause; remove only errors.
6. **Compare like with like.** Shape, then matching centres, then matching spreads, then a conclusion in context.

## Key formulas and procedures

| Statistic | How to compute | What it measures | Resistant? |
|---|---|---|---|
| Mean | sum ÷ count | balance point, typical value | no |
| Median | middle of the ordered list (mean of the two middles if the count is even) | middle position, typical value | yes |
| Q1, Q3 | medians of the lower and upper halves (leave the overall median out when the count is odd) | the edges of the middle 50% | yes |
| Range | max − min | total spread | no |
| IQR | Q3 − Q1 | spread of the middle half | yes |
| MAD | mean of the distances from the mean | typical distance from the mean | no |
| Variance | mean of the squared deviations | spread, in squared units | no |
| Standard deviation | square root of the variance | typical distance from the mean | no |
| Fences | Q1 − 1.5 × IQR and Q3 + 1.5 × IQR | outlier boundaries | — |

**Choosing the summary.** Roughly symmetric, no outliers: mean and SD. Skewed or outliers present: median and IQR.

**Shifting and scaling.** Add a constant c to every value: centre moves by c, every spread stays. Multiply every value by k: centre and every spread multiply by k.

**Spreadsheet.** Formulas start with `=`; `A2:A21` is a range; `=AVERAGE( )`, `=MEDIAN( )`, `=MIN( )`, `=MAX( )`, `=SUM( )`, `=COUNT( )`, `=ABS( )`; `^` for exponents; fill down shifts relative references; `$C$1` locks a reference.

## Worked example: the whole unit on one data set

Hours of weekly exercise for 11 students: 0, 1, 2, 2, 3, 3, 4, 4, 5, 6, 15.

- **Shape.** Most values 0 to 6, one far value at 15: skewed right.
- **Five-number summary.** Min 0; median = 6th value = 3; Q1 = median of 0, 1, 2, 2, 3 = 2; Q3 = median of 4, 4, 5, 6, 15 = 5; max 15.
- **Fences.** IQR = 3; 1.5 × 3 = 4.5; fences −2.5 and 9.5. The 15 is an outlier.
- **Mean.** 45/11 ≈ 4.09, pulled above the median by the 15.
- **SD.** Deviations from 4.09 squared: 16.7, 9.5, 4.4, 4.4, 1.2, 1.2, 0.0, 0.0, 0.8, 3.6, 119.0; sum ≈ 160.9; variance ≈ 14.6; SD ≈ 3.82.
- **Summary to report.** Median 3 hours, IQR 3 hours, one outlier at 15. The mean of 4.1 and SD of 3.8 overstate typical exercise because of the single very active student.
- **Comparison.** If a second class has median 3, IQR 6 and no outliers, the two classes are typically alike but the second varies far more.

## Common errors

- Splitting the halves wrongly when finding quartiles (including the median in both halves of an odd-count list).
- Naming the skew by the peak instead of the tail.
- Reporting a variance as a standard deviation (forgetting the square root).
- Saying the median "changed a lot" after one extreme value was added.
- Using 1.5 × IQR as the fence itself instead of adding it to Q3 and subtracting it from Q1.
- Comparing a mean with a median, or reporting centres without spreads.
- Deleting a genuine outlier because it is inconvenient.
- Writing `=AVERAGE(A2+A21)` for a range, or filling down a formula whose fixed cell is not locked.

## Quick drills (answers at the end)

1. Five-number summary of 4, 7, 7, 9, 12, 14, 20, 21.
2. Mean and MAD of 2, 4, 6, 8.
3. SD of 1, 2, 3, 4, 5 (divide by n).
4. Q1 = 15, Q3 = 27: fences and whether 46 is an outlier.
5. Mean 60, SD 4; every value doubled then 3 added: new mean and SD.
6. Which summary for a histogram with a long right tail?

*Answers:* (1) 4, 7, 10.5, 17, 21. (2) mean 5; distances 3, 1, 1, 3; MAD 2. (3) mean 3; squares 4, 1, 0, 1, 4; variance 2; SD ≈ 1.41. (4) IQR 12; fences −3 and 45; 46 is an outlier. (5) mean 123, SD 8. (6) median and IQR.

## What to review from earlier units

This is the first unit, so there is nothing earlier, but two habits from it carry forward into everything else: describe before you calculate, and never report a number without saying what it measures. In unit 3 you will add a second variable and ask whether two measurements are related, and the mean and standard deviation you computed here are the ingredients of the correlation coefficient there.

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Algebra 1, Unit 1, https://im.kendallhunt.com/HS/teachers/1/1/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
