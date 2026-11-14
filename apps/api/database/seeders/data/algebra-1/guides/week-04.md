# Week 04 · Outliers, Comparing Data Sets and Writing Up an Analysis

**Lessons:** 1.13 More Standard Deviation · 1.14 Outliers · 1.15 Comparing Data Sets · 1.16 Analyzing Data
**Practices:** MP3 (justify a comparison with evidence), MP4 (model a real question with data), MP6 (apply the outlier rule exactly)
**Built from:** IM Algebra 1, Unit 1, Lessons 13–16, in our own words
**Spiral:** The quartiles from week 1 feed the outlier rule; the choice of summary from week 3 decides how two data sets get compared; the spreadsheet of week 2 does the arithmetic for any data set bigger than a dozen values.

## What you need to be able to do

- **1.13** Use the standard deviation with the mean to compare data sets, and explain how changing the data (adding a constant, adding an extreme value, doubling every value) changes the SD.
- **1.14** Apply the 1.5 × IQR rule to decide which values are outliers, and decide what to do about an outlier.
- **1.15** Compare two or more distributions using shape, centre, spread and outliers, choosing matching statistics.
- **1.16** Plan and carry out a small statistical investigation: pose a statistical question, collect or choose data, display it, summarise it and write a conclusion that answers the question.

## Key terms

| Term | Meaning |
|---|---|
| Outlier | A value more than 1.5 × IQR below Q1 or above Q3. |
| Lower fence | Q1 − 1.5 × IQR. Anything below it is an outlier. |
| Upper fence | Q3 + 1.5 × IQR. Anything above it is an outlier. |
| Modified box plot | A box plot whose whiskers stop at the last non-outlier values, with outliers drawn as separate dots. |
| Shift | Adding the same number to every value: the centre moves, the spread does not. |
| Scale | Multiplying every value by the same number: both the centre and the spread multiply. |
| Statistical investigation | Question, data, display, summary, conclusion. |

## What moves the standard deviation (1.13)

Start with 10, 12, 14, 16, 18: mean 14, deviations −4, −2, 0, 2, 4, squares 16, 4, 0, 4, 16, variance 40/5 = 8, SD = √8 ≈ 2.83.

**Add 5 to every value** (15, 17, 19, 21, 23): the mean becomes 19, but every deviation is unchanged, so the SD is still 2.83. Shifting the whole data set moves the centre and leaves every measure of spread alone (range, IQR, MAD and SD).

**Double every value** (20, 24, 28, 32, 36): the mean doubles to 28, every deviation doubles, every squared deviation quadruples, and the SD doubles to about 5.66. Scaling by a factor k multiplies the centre and every spread by k.

**Add one extreme value**, 40: the mean rises to 110/6 ≈ 18.33 and the SD jumps to about 9.96. One value did what the other five together could not.

**Make the values more spread out without changing the mean**: 6, 10, 14, 18, 22 still has mean 14 but SD = √(64 + 16 + 0 + 16 + 64)/5 = √32 ≈ 5.66. Same centre, double the spread.

Use these facts to compare data sets quickly: a class whose scores all went up by 3 points after a retake has the same SD as before; a data set measured in centimetres has an SD 100 times the SD of the same data in metres.

**Try it.** A data set has mean 50 and SD 6. Every value is tripled. New mean and SD?
*Answer:* mean 150, SD 18.

## Outliers: the 1.5 × IQR rule (1.14)

"Extreme" became a precise word this week. Compute Q1, Q3 and the IQR, then the two **fences**:

- lower fence = Q1 − 1.5 × IQR
- upper fence = Q3 + 1.5 × IQR

Any value below the lower fence or above the upper fence is an **outlier**.

**Worked example.** Ages of 11 people at a chess club: 14, 15, 15, 16, 16, 17, 17, 18, 19, 21, 44.
Median is the 6th value, 17. Lower half 14, 15, 15, 16, 16 gives Q1 = 15; upper half 17, 18, 19, 21, 44 gives Q3 = 19. IQR = 4. Fences: 15 − 6 = 9 and 19 + 6 = 25. The 44-year-old is an outlier (44 > 25); nobody is below 9.

A **modified box plot** draws the box from 15 to 19 with the median at 17, the left whisker to 14, the right whisker only to 21 (the largest value inside the fence), and a separate dot at 44. Modified box plots are what most technology draws by default, so expect dots beyond the whiskers.

**What to do with an outlier.** First find out why it is there.

- A recording error (a height of 1,650 cm) should be corrected or removed, and you say so.
- A genuine but unusual value (the club's adult coach) stays in the data; report the median and IQR, which it will not distort, and mention it in the write-up.
- Never delete a value just because it is inconvenient.

**Try it.** Data: 3, 8, 9, 10, 10, 11, 12, 13, 30. Find the fences and any outliers.
*Answer:* median 10 (5th value); Q1 = median of 3, 8, 9, 10 = 8.5; Q3 = median of 11, 12, 13, 30 = 12.5; IQR = 4; fences 8.5 − 6 = 2.5 and 12.5 + 6 = 18.5. The 30 is an outlier; the 3 is not (it is above 2.5).

## Comparing data sets (1.15)

A full comparison has four parts, in this order, each with evidence:

1. **Shape**: name the shape of each distribution and whether either has outliers.
2. **Centre**: compare the medians, or the means if both distributions are roughly symmetric without outliers. Say which group is higher and by how much.
3. **Spread**: compare the matching measure (IQRs or SDs). Say which group is more consistent.
4. **Conclusion in context**: answer the actual question, using the numbers, and note any caveats (small sample, an outlier that might be an error).

**Worked example.** Two delivery services recorded delivery times in minutes for 15 orders each.

| | Shape | Median | IQR | Outliers |
|---|---|---|---|---|
| Swift | skewed right | 24 | 6 | one at 61 |
| Steady | symmetric | 28 | 4 | none |

Comparison: Swift's typical delivery (median 24 min) is 4 minutes faster than Steady's (28 min). Steady is more consistent: its IQR of 4 is narrower than Swift's 6, and Swift had one delivery of 61 minutes, far beyond its upper fence. A customer who wants the shortest usual wait picks Swift; one who cannot risk a very late delivery picks Steady. (Because Swift is skewed with an outlier, medians and IQRs are the right statistics to compare; Swift's mean would be inflated by the 61.)

## Carrying out an investigation (1.16)

1. **Pose a statistical question.** "Do students who eat breakfast report more hours of sleep than those who skip it?" is answerable with data that vary; "Should everyone eat breakfast?" is not.
2. **Decide what to measure and from whom.** Two groups (breakfast, no breakfast); numerical variable (hours of sleep last night). Note the limits: a convenience sample of your friends does not represent the school.
3. **Display.** Box plots of both groups on one scale, plus a dot plot of each if the groups are small, to check shape and spot outliers.
4. **Summarise.** The matching centre and spread for each group, chosen from the shape.
5. **Conclude.** Answer the question with the numbers, acknowledge any outlier or small sample, and say what a next step would be (a larger or random sample, a different variable).

The write-up should let a reader who never saw the data understand what was asked, what was collected, what the plots showed and what the numbers say.

## Common mistakes

- Using 1.5 × IQR as the fence itself rather than adding it to Q3 and subtracting it from Q1.
- Declaring the maximum an outlier because it "looks far away" without checking the fence.
- Thinking that shifting all values changes the spread; it changes only the centre.
- Comparing a median from one group with a mean from the other, or reporting centres without spreads.
- Writing a conclusion that is not about the original question.

## Where this goes next

Unit 1 ends here; the unit summary gathers every formula and rule. Unit 2 turns to equations, but the statistics come back in unit 3, where a second variable is added and we ask whether two measurements are related, and in unit 5, where exponential growth is tested against data.

## Self-check

1. A data set has Q1 = 20 and Q3 = 32. Find the fences.
2. Is 51 an outlier for that data set? Is 2?
3. A data set has mean 40 and SD 5. Every value has 10 subtracted. New mean and SD?
4. Two groups have medians 50 and 50 and IQRs 3 and 15. Which statement is true: the groups have the same typical value, the same spread, both, or neither?
5. Name the five stages of a statistical investigation.

*Answers:* (1) IQR = 12, so fences are 20 − 18 = 2 and 32 + 18 = 50. (2) 51 is an outlier (above 50); 2 is not (it equals the fence, and only values beyond the fence count). (3) Mean 30, SD 5. (4) Same typical value, very different spread. (5) Question, data, display, summary, conclusion.

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Algebra 1, Unit 1, Lessons 13–16, https://im.kendallhunt.com/HS/teachers/1/1/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
