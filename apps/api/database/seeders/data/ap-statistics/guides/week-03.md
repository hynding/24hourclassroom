# Week 03 · Graphing and Describing One Quantitative Variable

**Topics:** 1.5 Graphical Representations for One Quantitative Variable · 1.6 Descriptions for One Quantitative Variable Distributions
**Practices:** 3 (Analyze Data), 4 (Interpret Results)
**Framework:** AP Statistics CED (effective fall 2026), Unit 1, Topics 1.5–1.6, learning objectives in our own words
**Spiral:** Week 1 sorted variables into categorical and quantitative; week 2 summarised and graphed categorical ones with proportions and bar charts. This week turns to quantitative variables: the graphs that place values on a number line, and the four features (shape, centre, variability, unusual features) that every description of a distribution needs.

## What you need to be able to do

- **1.5** Construct and read dotplots, stemplots (including split stems and a key) and histograms (frequency and relative frequency).
- **1.5** Choose a suitable display, and explain what each display shows and hides.
- **1.6** Describe the shape of a distribution: symmetric, skewed right or left, uniform; unimodal or bimodal.
- **1.6** Describe the centre and variability of a distribution from a graph.
- **1.6** Identify unusual features: possible outliers, gaps and clusters.
- **1.6** Write a complete description in context, with numbers and units.

## Key terms

| Term | Meaning |
|---|---|
| Distribution (of a quantitative variable) | The values the variable takes and how often it takes them. |
| Dotplot | A number line with one dot per individual stacked above its value. |
| Stemplot | Values split into stems (leading digits) and leaves (final digit), with a key. |
| Histogram | Touching bars over equal-width intervals (bins) of the number line; heights are counts or proportions. |
| Shape | Symmetric, skewed right, skewed left or uniform; unimodal, bimodal or multimodal. |
| Skewed right / left | A long tail toward large / small values. |
| Gap / cluster | An empty stretch of the number line / a group of values set apart by gaps. |
| Outlier | A value far outside the overall pattern (week 4 gives a rule). |

## Displays for one quantitative variable (1.5)

A quantitative variable lives on a number line, so its graphs do too. Three displays matter.

### Dotplots

One dot per individual, stacked above its value. Dotplots are quick and keep every value, so they suit small data sets.

**Worked example 1: goals per game.** A hypothetical high school soccer team scored these numbers of goals in its 18 games: 0, 0, 1, 1, 1, 1, 2, 2, 2, 2, 2, 3, 3, 3, 4, 4, 5, 7.

```
            •
         •  •
         •  •  •
      •  •  •  •  •
      •  •  •  •  •  •     •
  ----+--+--+--+--+--+--+--+--
      0  1  2  3  4  5  6  7
         Goals per game
```

You can read every value: the most common score was 2 goals (5 games), and one game had 7. With 18 values, the median is the average of the 9th and 10th, both 2, so the median is 2 goals.

### Stemplots

Split each value into a **stem** (all but the last digit) and a **leaf** (the last digit). List the stems once, in order, and write the leaves in order beside them. A **key** is required: it tells the reader what 10 | 3 means.

**Worked example 2: bean plant heights.** A biology class measured 20 bean plants (in cm) three weeks after planting: 8.4, 8.9, 9.2, 9.5, 9.7, 10.1, 10.3, 10.3, 10.6, 10.8, 11.0, 11.2, 11.4, 11.4, 11.7, 11.9, 12.3, 12.5, 12.8, 14.2.

```
 8 | 4 9
 9 | 2 5 7
10 | 1 3 3 6 8
11 | 0 2 4 4 7 9
12 | 3 5 8
13 |
14 | 2
Key: 10 | 3 = 10.3 cm
```

Turned on its side, a stemplot is a histogram that still shows every value. Keep empty stems (13 here): they show the gap. When a few stems carry too many leaves, use **split stems**: write each stem twice, with leaves 0–4 on the first line and 5–9 on the second.

### Histograms

For a larger data set, divide the number line into **bins** of equal width and draw a bar over each bin whose height is the count (frequency histogram) or the proportion (relative frequency histogram). The bars **touch**, because the bins are adjacent intervals of one number line; that is the visible difference from a bar chart. A bin written "10 to under 20" holds values from 10 up to but not including 20, so a value of exactly 20 goes in the next bin.

**Worked example 3: commute times.** A random sample of 60 students at a large high school reported their one-way commute time in minutes. Grouped into 10-minute bins:

| Commute (minutes) | Count | Relative frequency |
|---|---|---|
| 0 to under 10 | 8 | 0.133 |
| 10 to under 20 | 24 | 0.400 |
| 20 to under 30 | 14 | 0.233 |
| 30 to under 40 | 7 | 0.117 |
| 40 to under 50 | 4 | 0.067 |
| 50 to under 60 | 2 | 0.033 |
| 60 to under 70 | 1 | 0.017 |
| Total | 60 | 1.000 |

Drawn as a histogram, the bars rise to 24 in the 10 to under 20 bin and then step down: 14, 7, 4, 2, 1. The relative frequency histogram has exactly the same shape, with 0.400 in place of 24. From the table: 32 of 60 students (53%) commute less than 20 minutes, and 7 of 60 (about 12%) commute 40 minutes or more.

What a histogram costs you: the individual values are gone. You cannot say what the longest commute was, only that it was between 60 and 70 minutes, and you can locate the median only to a bin. Counting up, 8 values lie below 10 and 8 + 24 = 32 below 20, so the 30th and 31st values, and therefore the median, lie in 10 to under 20 minutes.

**Bin width matters.** With 30-minute bins (0 to under 30, 30 to under 60, 60 to under 90) the same data give bars of 46, 13 and 1: the skew is still there but the peak's position is lost. With 2-minute bins the picture is jagged with many empty bins. Try a couple of reasonable widths before you describe a shape.

### Choosing a display

| Display | Best for | Keeps individual values? |
|---|---|---|
| Dotplot | Small data sets, especially whole numbers | Yes |
| Stemplot | Small to moderate data sets (up to about 50) | Yes |
| Histogram | Larger data sets | No |

Bar charts and pie charts are for categorical variables only (week 2).

## Describing a distribution (1.6)

A complete description of a quantitative distribution has **four features**, always **in context** (name the variable and the units):

1. **Shape.**
   - *Roughly symmetric:* the two sides are near mirror images.
   - *Skewed right:* a long tail toward large values (incomes, commute times, wait times).
   - *Skewed left:* a long tail toward small values (scores on an easy test).
   - *Uniform:* roughly flat, no clear peak.
   - *Unimodal / bimodal:* one peak / two peaks. Two peaks often mean two groups mixed together, such as cafeteria arrival times for two lunch periods.
   Skew is named for the **tail**, not the peak.
2. **Centre.** A typical value. This week, estimate the middle value (median) from the graph; week 4 computes the mean and median precisely.
3. **Variability.** How spread out the values are. This week, give the range (maximum − minimum) or the interval where most values lie; week 4 adds the IQR and standard deviation.
4. **Unusual features.** Possible **outliers** (values far from the overall pattern), **gaps** (empty stretches) and **clusters**. Call an outlier "possible" until week 4's rule confirms it.

Use "roughly symmetric", not "normal": the Normal distribution is a specific model that comes in week 13.

**Worked example 4: two full descriptions.**

*Commute times (worked example 3).* "The distribution of commute times for these 60 students is skewed right and unimodal, with its peak in the 10 to under 20 minute bin. The median commute is between 10 and 20 minutes. Commutes range from under 10 minutes to between 60 and 70 minutes; most students (53 of 60) commute less than 40 minutes. There are no gaps; the one commute of 60–70 minutes may be an outlier, but the histogram cannot show how far it is from the rest."

*Bean plant heights (worked example 2).* Count to the middle: the 10th and 11th heights are 10.8 and 11.0, so the median is 10.9 cm. "Apart from one tall plant, the heights of the 20 bean plants are roughly symmetric and unimodal, centred at about 10.9 cm. They range from 8.4 to 14.2 cm (a range of 5.8 cm), and all but one are between 8.4 and 12.8 cm. The 14.2 cm plant is a possible outlier, separated from the rest by a gap from 12.8 to 14.2 cm."

*Goals per game (worked example 1)* in one sentence: "The team's goals per game are skewed right with a peak at 2 goals, a median of 2 goals and a range of 7 goals; most games had 0 to 4 goals, and the 7-goal game, after a gap at 6, is a possible outlier."

Notice that every sentence says what was measured and gives numbers with units. "Skewed right, centre 15, range 60" earns little on the AP exam; "commute times are skewed right with a typical commute of about 15 minutes" earns the point.

Why do these features matter beyond description? Because they decide later choices. Strong skewness or outliers will make the median and IQR better summaries than the mean and standard deviation (week 4), and they matter again when you check conditions for inference about means in Unit 4.

## Common mistakes

- **Naming skew by the peak.** The peak on the left with a tail on the right is skewed **right**.
- **Leaving out the key on a stemplot**, or reading 3 | 1 as 31 when the key says 0.31.
- **Drawing gaps between histogram bars** (or touching bars on a bar chart).
- **Reading exact values off a histogram.** You know only bins.
- **Describing without context.** Name the variable and units in every feature.
- **Calling every unusual value an outlier with certainty.** From a graph, say "possible outlier".
- **Using "normal" to describe data.** Say "roughly symmetric and unimodal".

## Self-check

1. Which display would you choose for 300 students' heights, and why?
2. A stemplot has key 5 | 2 = 52 kg. What does the line 6 | 0 3 3 8 represent?
3. A histogram has a tall bar on the right and a long, low tail to the left. Name the shape.
4. In a histogram with bins 0 to under 5, 5 to under 10, ..., which bin holds the value 10?
5. Wait times at a clinic have a median of 18 minutes, range 5 to 95 minutes, and most waits under 40 minutes. Write one sentence describing variability and one unusual feature you might expect.
6. Why might a histogram of the heights of all players on a combined boys' and girls' volleyball roster be bimodal?

*Answers:* 1. A histogram: there are too many values for a dotplot or stemplot. 2. Four values: 60, 63, 63 and 68 kg. 3. Skewed left. 4. 10 to under 15. 5. "Wait times vary from 5 to 95 minutes, though most patients wait less than 40 minutes"; the 95-minute wait is likely a possible outlier with a gap before it. 6. Two groups with different typical heights are mixed in one data set, so there may be a peak for each group.

---

*Original study material for this course, organised around the College Board AP Statistics Course and Exam Description (Unit 1, Topics 1.5–1.6). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). All data are invented. AP® is a trademark of the College Board, which does not endorse this material.*
