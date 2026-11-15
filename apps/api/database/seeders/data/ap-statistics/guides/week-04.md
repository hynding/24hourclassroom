# Week 04 · Summary Statistics and Boxplots for One Quantitative Variable

**Topics:** 1.7 Summary Statistics for One Quantitative Variable · 1.8 Graphical Representations of Summary Statistics for One Quantitative Variable
**Practices:** 3 (Analyze Data), 4 (Interpret Results)
**Framework:** AP Statistics CED (effective fall 2026), Unit 1, Topics 1.7–1.8, learning objectives in our own words
**Spiral:** Week 3 described the shape, centre, variability and unusual features of a distribution by eye. This week puts numbers on centre and variability (mean, median, standard deviation, IQR), gives a rule for deciding what counts as an outlier, and draws the boxplot, the graph built from those numbers. Week 3's shape vocabulary returns as the deciding factor in choosing which numbers to report.

## What you need to be able to do

- **1.7** Calculate and interpret the mean and the median.
- **1.7** Calculate and interpret the range, the quartiles, the IQR and the standard deviation.
- **1.7** Find and interpret percentiles.
- **1.7** Explain which statistics are resistant, how skewness separates the mean from the median, and choose summaries to match the shape.
- **1.8** Give the five-number summary, apply the 1.5 × IQR rule (and know the two-standard-deviation rule), and draw and read a boxplot.
- **1.8** Say what a boxplot shows and what it hides.

## Key terms

| Term | Meaning |
|---|---|
| Mean (x̄) | The sum of the values divided by n; the balance point. |
| Median | The middle value of the ordered data (average of the two middle values when n is even). |
| Range | Maximum − minimum. |
| Quartiles (Q1, Q3) | The medians of the lower and upper halves of the ordered data. |
| IQR | Q3 − Q1, the spread of the middle half. |
| Standard deviation (s) | √( Σ(x − x̄)² ÷ (n − 1) ): the typical distance of the values from the mean. |
| Percentile | The pth percentile is the value with p% of the data at or below it. |
| Resistant | Barely affected by extreme values (median, IQR). |
| Five-number summary | Minimum, Q1, median, Q3, maximum. |
| Boxplot | A box from Q1 to Q3 with a median line, whiskers to the most extreme non-outliers, outliers plotted separately. |

## Measures of centre and variability (1.7)

### Centre: mean and median

The **mean** x̄ = (sum of the values) ÷ n is the balance point of the distribution. The **median** is the middle of the ordered list: for n odd it is the value in position (n + 1)/2; for n even it is the average of the two middle values. Always put the data in order first.

### Variability: range, IQR, standard deviation

- **Range** = maximum − minimum. Simple, but it depends only on the two extremes.
- **Quartiles.** Split the ordered data at the median. Q1 is the median of the lower half and Q3 the median of the upper half; when n is odd, leave the median itself out of both halves. (This matches the 1-Var Stats output on the usual calculators.) The **IQR** = Q3 − Q1 is the spread of the middle half of the data.
- **Standard deviation.** Find each value's deviation from the mean, square the deviations, add them, divide by n − 1, and take the square root:

  s = √( Σ(x − x̄)² ÷ (n − 1) ).

  Its square s² is the **variance**, in squared units. Dividing by n − 1 rather than n corrects for the fact that deviations from the sample's own mean run a little small.

The interpretation template for a standard deviation is worth memorising: "The [variable] typically varies by about [s] [units] from the mean of [x̄] [units]." A standard deviation is never negative, and it is 0 only when every value is the same.

**Worked example 1: a standard deviation by hand.** A basketball player scored 12, 14, 16, 18 and 20 points in five games.

| Points x | Deviation x − x̄ | Squared deviation |
|---|---|---|
| 12 | −4 | 16 |
| 14 | −2 | 4 |
| 16 | 0 | 0 |
| 18 | 2 | 4 |
| 20 | 4 | 16 |
| Sum 80 | 0 | 40 |

x̄ = 80/5 = 16 points. The deviations add to 0 (they always do). Variance = 40 ÷ (5 − 1) = 10, so s = √10 ≈ 3.16 points: the player's scores typically vary by about 3.2 points from the mean of 16 points. On the exam you will use a calculator, but knowing the steps tells you what the number means.

**Worked example 2: resting heart rates.** A trainer recorded the resting heart rates (bpm) of 12 student athletes: 52, 56, 58, 60, 61, 63, 64, 66, 68, 70, 72, 78.

- Mean: 768/12 = 64 bpm. Standard deviation (calculator): s ≈ 7.30 bpm.
- Median: n = 12 is even, so average the 6th and 7th values: (63 + 64)/2 = 63.5 bpm.
- Quartiles: lower half 52, 56, 58, 60, 61, 63 gives Q1 = (58 + 60)/2 = 59 bpm; upper half 64, 66, 68, 70, 72, 78 gives Q3 = (68 + 70)/2 = 69 bpm. IQR = 10 bpm. Range = 78 − 52 = 26 bpm.

Interpretations: "The athletes' resting heart rates typically vary by about 7.3 bpm from the mean of 64 bpm." "The middle half of the heart rates span 10 bpm, from 59 to 69 bpm." The mean and median are close (64 and 63.5), as you would expect for a roughly symmetric distribution.

### Percentiles

The **pth percentile** is the value with p% of the data at or below it. In the heart-rate data, 8 of the 12 values (52 through 66) are at or below 66 bpm, so 66 bpm is at about the 8/12 ≈ 67th percentile. Q1, the median and Q3 are roughly the 25th, 50th and 75th percentiles. Be careful with "lower is better" variables: a mile time at the 80th percentile is slower than about 80% of the times.

### Resistance and shape

A statistic is **resistant** if one extreme value barely changes it. The median and IQR are resistant, because they depend only on positions in the ordered list. The mean, the standard deviation and the range are not, because every value (or an extreme value) enters their calculation.

**Worked example 3: a café server's tips.** A server at a hypothetical café recorded her tips (in dollars) over nine shifts: 38, 42, 45, 47, 50, 52, 55, 58, 190. The $190 shift was a private party.

| Statistic | All nine shifts | Without the $190 shift |
|---|---|---|
| Mean | $64.11 | $48.38 |
| Median | $50 | $48.50 |
| Standard deviation | $47.62 | $6.70 |

One shift moves the mean by almost $16 and multiplies the standard deviation by 7, but moves the median by $1.50. With the party included, the mean of $64.11 is higher than eight of the nine shifts, so it is a poor description of a typical night; the median of $50 is a good one.

The same pull happens with skewness. In a **skewed right** distribution the long tail drags the mean above the median; in a **skewed left** distribution the mean falls below the median; in a roughly symmetric one they are close. So:

- roughly symmetric, no outliers: report the **mean and standard deviation**;
- strongly skewed or with outliers: report the **median and IQR**.

All of these statistics carry the data's units (dollars, bpm, minutes); only the variance is in squared units.

## The five-number summary, outliers and boxplots (1.8)

The **five-number summary** is minimum, Q1, median, Q3, maximum. It divides the data into four parts with about a quarter of the values in each.

### Outlier rules

The standard rule is the **1.5 × IQR rule**: a value is an outlier if it is

below Q1 − 1.5 × IQR or above Q3 + 1.5 × IQR.

These two cutoffs are called **fences**. A second rule sometimes used calls a value an outlier if it is more than **two standard deviations** from the mean. The two rules can disagree, so always say which one you used. For the tips: IQR = 56.5 − 43.5 = 13, so the upper fence is 56.5 + 1.5(13) = 76, and $190 is an outlier.

### Boxplots

A **boxplot** is drawn from the five-number summary:

1. Draw a scale with units.
2. Draw a box from Q1 to Q3 and a line across it at the median.
3. Check for outliers with the fences.
4. Draw each whisker from the box to the most extreme value that is **not** an outlier.
5. Plot each outlier as its own point.

**Worked example 4: commute times.** A random sample of 40 students reported their one-way commutes. Five-number summary: 4, 12, 18, 28, 65 minutes; the two longest commutes are 47 and 65 minutes.

- IQR = 28 − 12 = 16; 1.5 × 16 = 24.
- Fences: 12 − 24 = −12 and 28 + 24 = 52. The 65-minute commute is an outlier; nothing is below −12.
- Box from 12 to 28 with a line at 18; left whisker to 4; right whisker to 47 (not to 52, which is a cutoff, not a data value); a separate point at 65.

```
         |----[==|=====]----------|          *
  -----+------+------+------+------+------+----
       0     12     24     36     48     60    minutes
```

Reading it: the right whisker (28 to 47) is much longer than the left (4 to 12), the median sits closer to Q1 than to Q3, and there is a high outlier, so the distribution is **skewed right**. About half the students commute between 12 and 28 minutes.

### What boxplots show and hide

Each of the four sections holds about a quarter of the data, so a **longer section means more spread, not more values**. A boxplot shows the median, the quartiles, the IQR, the range and outliers at a glance, and it is excellent for comparing groups side by side (week 5). It hides the mean, the number of values, and any finer shape: a bimodal distribution and a uniform one can have the same boxplot. When shape matters, look at a dotplot, stemplot or histogram as well.

## Common mistakes

- **Finding the median of an unordered list.** Order first.
- **Including the median in both halves** when n is odd, which gives the wrong quartiles.
- **Interpreting s as a maximum distance** ("every value is within 7.3 bpm"). It is a typical distance.
- **Running a whisker to the fence** instead of to the most extreme non-outlier.
- **Reading a long whisker as "more data".** It means more spread.
- **Reporting the mean and standard deviation for strongly skewed data.** Use the median and IQR, and say why (resistance).
- **Statistics without context or units.** "s = 7.3" earns nothing; "heart rates typically vary by about 7.3 bpm from the mean of 64 bpm" earns the point.

## Self-check

1. Find the median and IQR of 3, 5, 6, 8, 9, 11, 14.
2. The standard deviation of the weights of a group of dogs is 4.1 kg and the mean is 22 kg. Interpret the standard deviation.
3. A data set has Q1 = 40 and Q3 = 52. Which of 20, 30, 68 and 72 are outliers by the 1.5 × IQR rule?
4. Incomes in a town are skewed right. Which is larger, the mean or the median? Which should a report use?
5. A boxplot's right whisker ends at 47, but the maximum is 65. What does that tell you?
6. A student's reading speed is at the 30th percentile of her class. Interpret.

*Answers:* 1. Median 8 (the 4th of 7 values); Q1 = 5 (median of 3, 5, 6), Q3 = 11 (median of 9, 11, 14), IQR = 6. 2. The dogs' weights typically vary by about 4.1 kg from the mean of 22 kg. 3. IQR = 12, fences 22 and 70: 20 and 72 are outliers; 30 and 68 are not. 4. The mean; the median, because it is resistant to the few very high incomes. 5. 65 is an outlier, and 47 is the largest value that is not. 6. About 30% of her classmates' reading speeds are at or below hers.

---

*Original study material for this course, organised around the College Board AP Statistics Course and Exam Description (Unit 1, Topics 1.7–1.8). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). All data are invented. AP® is a trademark of the College Board, which does not endorse this material.*
