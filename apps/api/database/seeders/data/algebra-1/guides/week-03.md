# Week 03 · Extremes, Choosing a Summary and Standard Deviation

**Lessons:** 1.9 Technological Graphing · 1.10 The Effect of Extremes · 1.11 Comparing and Contrasting Data Distributions · 1.12 Standard Deviation
**Practices:** MP3 (argue from a plot which summary is appropriate), MP5 (graph with technology), MP6 (precision in computing and reporting a standard deviation)
**Built from:** IM Algebra 1, Unit 1, Lessons 9–12, in our own words
**Spiral:** Shape (week 1) now decides which centre and which spread to report; the deviations from week 2's MAD become the squared deviations inside the standard deviation.

## What you need to be able to do

- **1.9** Use a graphing tool or spreadsheet to produce a dot plot, histogram or box plot from a column of data, and adjust histogram bin widths to see the shape clearly.
- **1.10** Predict and explain how adding, removing or changing an extreme value affects the mean, the median, the MAD and the IQR.
- **1.11** Choose the mean and standard deviation (or MAD) for roughly symmetric data and the median and IQR for skewed data or data with extreme values, and justify the choice from the shape.
- **1.12** Compute the standard deviation of a small data set by hand and interpret it as a typical distance from the mean.

## Key terms

| Term | Meaning |
|---|---|
| Extreme value | A value far from the rest of the data; next week's outlier rule makes "far" precise. |
| Resistant | A statistic is resistant if a few extreme values barely change it. The median and IQR are resistant; the mean, MAD and standard deviation are not. |
| Variance | The mean of the squared deviations from the mean. |
| Standard deviation (SD) | The square root of the variance: a typical distance from the mean, in the same units as the data. |
| Bin width | The width of each interval in a histogram; changing it changes how smooth or jagged the shape looks. |
| Appropriate summary | The pair (centre, spread) that matches the shape: mean and SD for symmetric data, median and IQR for skewed data. |

## Graphing with technology (1.9)

Spreadsheets and graphing calculators draw a plot from a column of numbers in a few clicks: select the column, choose the chart type (histogram, box plot, dot plot where available), and read off the result. Two things are still your job.

**Pick the bin width deliberately.** A histogram of 500 heights with bins 1 cm wide looks like a jagged comb; with bins 50 cm wide it is a single bar. Try a few widths until the shape, one hump, two humps or a tail, is clear and stable. A good first guess is about 8 to 12 bins across the range of the data.

**Read the axes.** Technology picks axis scales for you, and two histograms with different vertical scales can look alike while describing different sample sizes. Always check the scale before comparing two plots.

**Try it.** A data set runs from 12 to 88. Suggest a sensible bin width for a first histogram.
*Answer:* The range is 76; ten bins gives a width of about 7.6, so use 8 (bins 8–16, 16–24, …, 88–96) or 10 (10–20, …, 80–90).

## The effect of extremes (1.10)

Take the data 10, 12, 13, 15, 20 (mean 14, median 13). Replace the 20 with 70:

| | Original | With 70 instead of 20 |
|---|---|---|
| Mean | 70/5 = 14 | 120/5 = 24 |
| Median | 13 | 13 |
| MAD | (4 + 2 + 1 + 1 + 6)/5 = 2.8 | (14 + 12 + 11 + 9 + 46)/5 = 18.4 |
| IQR | Q3 − Q1 = 17.5 − 11 = 6.5 | Q3 − Q1 = 42.5 − 11 = 31.5 |

The mean jumped from 14 to 24, the MAD from 2.8 to 18.4. The median did not move at all: it only cares that 70 is "above the middle", not how far above. The IQR did move here because with only five values one extreme value lands in the upper half and becomes part of Q3's computation; with a larger data set the IQR, like the median, barely reacts to a single extreme value. Statistics that barely react are called **resistant**.

Rules of thumb:

- Adding a value far **above** the mean pulls the mean up (and far below pulls it down); the median shifts at most to a neighbouring value.
- Extreme values on **either** side increase the MAD and the standard deviation, because distances are always positive.
- In a skewed distribution the mean is pulled toward the tail: skewed right means mean > median, skewed left means mean < median.

**Worked example.** Salaries at a small company, in thousands: 38, 41, 44, 46, 49, 52, 310 (the owner). Which centre describes a typical employee?
Mean = 580/7 ≈ 82.9; median = 46. Six of seven people earn 38 to 52, so 46 is typical and 82.9 is not: the owner's salary dragged the mean up. Report the median.

**Try it.** The data 5, 6, 6, 7, 8 have mean 6.4 and median 6. A sixth value, 30, is added. Give the new mean and median.
*Answer:* mean = 62/6 ≈ 10.33; median = (6 + 7)/2 = 6.5.

## Choosing the right summary (1.11)

| Shape of the distribution | Centre to report | Spread to report | Why |
|---|---|---|---|
| Roughly symmetric, no extreme values | Mean | Standard deviation (or MAD) | The mean is the balance point and every value counts |
| Skewed, or has extreme values | Median | IQR | These are resistant, so a few unusual values do not distort the summary |

The box plot, dot plot or histogram is drawn first; the summary is chosen second. Writing "the mean is 82.9" for the salaries above is not wrong arithmetic, but it is the wrong summary for the question "what does a typical employee earn?".

When comparing two groups, compare like with like: both medians and both IQRs, or both means and both SDs, and say what the difference means in context ("the median wait at café A is 2 minutes shorter, and its IQR is half as wide, so waits are both shorter and more predictable").

## Standard deviation (1.12)

The standard deviation is the most used measure of spread. It is built like the MAD, but deviations are **squared** instead of made positive, averaged, and then the square root undoes the squaring.

**Steps**, for the data 2, 4, 4, 4, 5, 5, 7, 9:

1. Mean: 40/8 = 5.
2. Deviations: −3, −1, −1, −1, 0, 0, 2, 4.
3. Squared deviations: 9, 1, 1, 1, 0, 0, 4, 16.
4. Variance = mean of the squares = 32/8 = 4.
5. Standard deviation = √4 = 2.

A typical value is about 2 units from the mean of 5. (Technology sometimes divides by n − 1 instead of n, giving the "sample" standard deviation, √(32/7) ≈ 2.14. This course divides by n unless a question says otherwise; know which button you pressed.)

**Interpreting.** Like the MAD, a larger SD means the values are more spread out around the mean. Two classes with means 75 and SDs 3 and 12: in the first, nearly everyone scored close to 75; in the second, scores in the 60s and high 80s are routine. The SD is always zero or positive, and zero only when every value is the same.

**Worked example.** Find the standard deviation of 1, 3, 5, 7, 9.
Mean = 5. Deviations −4, −2, 0, 2, 4; squares 16, 4, 0, 4, 16; variance = 40/5 = 8; SD = √8 ≈ 2.83.

**Try it.** Find the standard deviation of 6, 8, 10, 12.
*Answer:* mean 9; deviations −3, −1, 1, 3; squares 9, 1, 1, 9; variance 20/4 = 5; SD = √5 ≈ 2.24.

### SD versus MAD

Both measure typical distance from the mean, and for most data sets they are close (for 2, 4, 4, 4, 5, 5, 7, 9 the MAD is 12/8 = 1.5 and the SD is 2). Squaring makes the SD react more strongly to extreme values than the MAD does, which is one reason to switch to the median and IQR when extremes are present.

## Common mistakes

- Forgetting the square root at the end and reporting the variance as the standard deviation.
- Squaring the deviations but then averaging the original deviations.
- Saying "the median changed a lot" after adding one extreme value; it shifts by at most one position in the ordered list.
- Choosing the mean for skewed data because "the mean is more accurate". The mean is not more accurate; it answers a different question and is distorted by the tail.
- Comparing the mean of one group with the median of another.

## Where this goes next

Week 4 gives a precise rule for which values count as outliers (1.5 × IQR beyond the quartiles) and uses this week's summaries to compare whole data sets and write up a small investigation. The standard deviation returns in unit 3 as part of the correlation coefficient.

## Self-check

1. The data 8, 9, 10, 11, 12 have mean 10 and median 10. If 12 is replaced by 40, which of the mean and median changes, and to what?
2. A histogram is strongly skewed right. Which centre and spread should you report?
3. Compute the standard deviation of 3, 5, 8, 8.
4. Which is larger for the data 1, 1, 1, 1, 21: the MAD or the SD? Why?
5. Why might a histogram of the same data look bimodal with narrow bins and single-peaked with wide bins?

*Answers:* (1) Mean becomes 78/5 = 15.6; median stays 10. (2) Median and IQR. (3) Mean 6; deviations −3, −1, 2, 2; squares 9, 1, 4, 4; variance 18/4 = 4.5; SD ≈ 2.12. (4) Mean 5; distances 4, 4, 4, 4, 16 give MAD = 32/5 = 6.4; squares 16, 16, 16, 16, 256 give variance 320/5 = 64, SD = 8. The SD is larger because squaring magnifies the one big deviation. (5) Narrow bins show random dips between values as separate peaks; wider bins smooth them into one hump. Try several widths before deciding the shape.

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Algebra 1, Unit 1, Lessons 9–12, https://im.kendallhunt.com/HS/teachers/1/1/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
