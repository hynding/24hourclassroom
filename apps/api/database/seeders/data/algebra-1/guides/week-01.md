# Week 01 · Asking Statistical Questions and Picturing Data

**Lessons:** 1.1 Getting to Know You · 1.2 Data Representations · 1.3 A Gallery of Data · 1.4 The Shape of Distributions
**Practices:** MP2 (reason quantitatively about what a plot shows), MP6 (precise vocabulary for data and shape)
**Built from:** IM Algebra 1, Unit 1, Lessons 1–4, in our own words
**Spiral:** This is where the course begins. The habit it starts, look at the whole picture of a data set before you compute anything, returns every time we compare groups (weeks 3–4), fit lines (unit 3) and judge whether a model is any good (units 5–7).

## What you need to be able to do

- **1.1** Tell a statistical question (one whose answer needs data that varies) from a question with a single fixed answer, and sort data as categorical or numerical.
- **1.2** Read and build a dot plot, a histogram and a box plot from a list of numbers, and say what each one shows and hides.
- **1.3** Match a plot to a description of the data and choose the right display for a question.
- **1.4** Describe the shape of a distribution (symmetric, skewed left or right, bell-shaped, uniform, bimodal) and use shape to say where the data cluster and where they thin out.

## Key terms

| Term | Meaning |
|---|---|
| Statistical question | A question answered by collecting data that varies, e.g. "How long is a typical commute at our school?" |
| Categorical data | Values that are labels or groups (eye colour, favourite subject). You can count them but not average them. |
| Numerical data | Values that are measurements or counts (height, number of siblings). Averages make sense. |
| Distribution | How the values of a numerical variable are spread out: which values occur and how often. |
| Dot plot | One dot per value above a number line. Shows every data point. |
| Histogram | Bars over equal-width intervals (bins); bar height is the count in that bin. Shows shape, hides individual values. |
| Box plot | A box from the first quartile (Q1) to the third quartile (Q3) with a line at the median and whiskers to the minimum and maximum. Shows the five-number summary. |
| Five-number summary | Minimum, Q1, median, Q3, maximum. |
| Symmetric | The left and right halves of the plot are roughly mirror images. |
| Skewed right | A long tail toward larger values; most data sit on the left. |
| Skewed left | A long tail toward smaller values; most data sit on the right. |
| Bell-shaped | Symmetric with a single peak in the middle and tails that thin out on both sides. |
| Uniform | Every value (or bin) occurs about equally often; the plot is flat. |
| Bimodal | Two clear peaks, often a sign that two different groups are mixed together. |

## Statistical questions and kinds of data (1.1)

A question like "How tall is the Eiffel Tower?" has one answer; nothing to analyse. "How tall are the students in our class?" has many answers that differ from person to person, so answering it well means collecting data and summarising the variation. That is a **statistical question**: it anticipates variability and is answered with a distribution, not a single number.

The data you collect come in two kinds. **Categorical** data put each person or thing in a group (which bus route, which sport). You summarise them with counts and percentages and show them in bar graphs. **Numerical** data are measurements or counts on a number scale (minutes of homework, number of pets). You summarise them with a centre and a spread and show them on dot plots, histograms and box plots. A number is not always numerical data: a jersey number or a zip code is a label, so it is categorical.

**Worked example.** A survey asks students (a) how many minutes they slept last night, (b) which lunch period they have, (c) their shoe size, (d) their phone's area code. Classify each.

1. Minutes of sleep: numerical. Averaging makes sense ("students averaged 7.2 hours").
2. Lunch period: categorical. "Period 5" names a group; the average lunch period is meaningless.
3. Shoe size: numerical. It is a measurement on an ordered scale with meaningful differences.
4. Area code: categorical. It is a label that happens to use digits.

**Try it.** Which of these are statistical questions? (1) How many pages are in this textbook? (2) How many pages do students in our grade read per week? (3) What is the capital of Oregon? (4) How far do teachers at our school drive to work?
*Answers:* 2 and 4 are statistical (the answers vary across people). 1 and 3 have a single fixed answer.

## Dot plots, histograms and box plots (1.2, 1.3)

Here are the numbers of books 20 students read over the summer:

```
0 0 1 1 1 2 2 2 2 3 3 3 4 4 5 5 6 8 9 12
```

**Dot plot.** Draw a number line from 0 to 12 and stack a dot above each value for every time it occurs: two dots over 0, three over 1, four over 2, three over 3, two over 4, two over 5, one each over 6, 8, 9 and 12. Every data point is visible, so you can read the exact values, spot gaps (no 7, 10 or 11) and see the cluster from 0 to 5 with a tail stretching to 12.

**Histogram.** Choose equal-width bins, say 0–2, 3–5, 6–8, 9–11, 12–14 (in a histogram a value on a boundary goes in the upper bin by convention; state your rule and stick to it). Count: 0–2 has 9 values, 3–5 has 7, 6–8 has 2, 9–11 has 1, 12–14 has 1. Draw bars with those heights. You lose the individual values but the shape, a tall left side sliding into a long right tail, is instantly visible, which is why histograms are the display of choice for large data sets.

**Box plot.** Order the data (already done), then find the five-number summary:

- Minimum = 0, maximum = 12.
- Median: 20 values, so the median is the mean of the 10th and 11th values, (3 + 3)/2 = **3**.
- Q1 is the median of the lower 10 values (0 0 1 1 1 2 2 2 2 3): the mean of the 5th and 6th, (1 + 2)/2 = **1.5**.
- Q3 is the median of the upper 10 values (3 3 4 4 5 5 6 8 9 12): the mean of the 5th and 6th, (5 + 5)/2 = **5**.

Draw a box from 1.5 to 5 with a line at 3, a whisker from 0 to 1.5 and a whisker from 5 to 12. The long right whisker is the tail again. A box plot shows where the middle half of the data sits (the box, which holds about 50% of the values) and how far the extremes reach, but it hides how many values there are and whether there are gaps.

**Which display when?**

| You want to | Use |
|---|---|
| See every value, with a small data set | Dot plot |
| See the overall shape of a large data set | Histogram |
| Compare the middle 50% and the spread of several groups at once | Box plots stacked on one scale |
| Read the exact median or quartiles | Box plot (dot plot works too if you count) |

**Try it.** Twelve quiz scores: 6, 7, 7, 8, 8, 8, 9, 9, 9, 9, 10, 10. Find the five-number summary.
*Answer:* min 6, Q1 = (7 + 8)/2 = 7.5, median = (8 + 9)/2 = 8.5, Q3 = (9 + 9)/2 = 9, max 10.

## Reading shape (1.4)

Once a plot is drawn, describe it in words before you compute anything. Four things to name:

1. **Shape**: symmetric, skewed left, skewed right, uniform, bell-shaped, bimodal.
2. **Centre**: roughly where the middle of the data is.
3. **Spread**: how far the data stretch, from the minimum to the maximum and how wide the main cluster is.
4. **Unusual features**: gaps, isolated points far from the rest, or a second cluster.

The direction of a skew is the direction of the **tail**, not of the peak. The book data above have most values at 0 to 5 and a tail stretching to 12, so the distribution is **skewed right**. Household incomes, waiting times and prices are often skewed right (a few very large values). Scores on an easy test are often skewed left (most students near the top, a tail of low scores). Heights of adults of one sex are roughly bell-shaped. The last digit of phone numbers is roughly uniform. The heights of a mixed group of fourth graders and adults would be bimodal.

**Worked example.** A histogram of the time 200 customers waited for coffee has a tall bar at 1–2 minutes, slightly shorter bars at 2–3 and 0–1 minutes, and then a run of short bars from 3 minutes out to 9 minutes. Describe the distribution.

The peak is at 1–2 minutes, with most customers waiting under 3 minutes; the bars shrink toward the right but stretch all the way to 9 minutes, so the distribution is skewed right. Centre around 2 minutes; spread from 0 to 9 minutes; the tail says a handful of customers waited a long time.

**Reading a box plot's shape.** If the median line sits near the middle of the box and the whiskers are similar in length, the distribution is roughly symmetric. If the right whisker is much longer than the left and the median sits toward the left end of the box, it is skewed right (and the reverse for skewed left). A box plot cannot show bimodality: two peaks collapse into one box.

**Try it.** For each description, name the likely shape: (a) number of text messages sent per day by teenagers; (b) heights of players on a basketball team; (c) results of rolling a fair die 600 times; (d) ages of people at a playground on a weekday morning (toddlers and parents).
*Answers:* (a) skewed right (a few people send huge numbers); (b) roughly symmetric or bell-shaped, in a narrow range; (c) uniform; (d) bimodal.

## Common mistakes

- Calling a jersey number, zip code or ID number "numerical" because it is written with digits. Ask whether averaging it means anything.
- Naming a skew by where the peak is. Skew is named for the **tail**: a peak on the left with a tail to the right is skewed right.
- Treating the box in a box plot as "most of the data". It is the middle 50%, no more and no less; the whiskers hold the other half.
- Forgetting that the median of an even number of values is the mean of the two middle values, and computing quartiles from the wrong halves. With an even count, split the ordered list exactly in half; with an odd count, leave the median out of both halves.
- Drawing histogram bins of different widths, or letting bins overlap (0–5 and 5–10 both claiming the 5).

## Where this goes next

Week 2 turns the pictures into numbers: mean and median for centre, mean absolute deviation and interquartile range for spread, and spreadsheet formulas that compute them for you. Week 3 asks which centre and which spread to report, and that decision is made from the shape you learned to read this week. Unit 3 adds a second variable and asks whether two measurements are related.

## Self-check

1. Is "How many minutes does it take you to get to school?" a statistical question when asked of one person? When asked of the whole school?
2. From the data 3, 5, 5, 6, 8, 9, 11, find the five-number summary.
3. A dot plot has a single peak at the left end and a long tail to the right. What is its shape, and would the mean or the median sit further right?
4. Which display hides individual values but shows shape well for 1,000 data points?
5. Name one thing a box plot can show that a histogram cannot read off directly, and one thing a histogram shows that a box plot cannot.

*Answers:* (1) Of one person: no, one fixed answer. Of the whole school: yes, answers vary. (2) min 3, Q1 = 5, median 6, Q3 = 9, max 11 (odd count: the median is the 4th value and is left out of both halves). (3) Skewed right; the mean is pulled toward the tail, so the mean sits further right than the median (week 2 explains why). (4) A histogram. (5) A box plot shows the median and quartiles exactly; a histogram shows gaps, peaks and whether the data are bimodal.

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Algebra 1, Unit 1, Lessons 1–4, https://im.kendallhunt.com/HS/teachers/1/1/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
