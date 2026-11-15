# Week 05 · Comparing Distributions of a Quantitative Variable

**Topics:** 1.9 Comparisons of the Distributions for One Quantitative Variable
**Practices:** 1 (Formulate Questions), 3 (Analyze Data), 4 (Interpret Results)
**Framework:** AP Statistics CED (effective fall 2026), Unit 1, Topic 1.9, learning objectives in our own words
**Spiral:** Weeks 3 and 4 described one distribution at a time: its shape, center, variability and unusual features, the mean, median, standard deviation and IQR, boxplots and the 1.5 × IQR outlier rule. This week puts two or more distributions side by side and asks the question that most real investigations ask: how do these groups differ?

## What you need to be able to do

- **1.9** Write a statistical investigative question that compares a quantitative variable across groups.
- **1.9** Choose and read a comparative display: back-to-back stemplot, parallel boxplots, stacked dotplots or histograms on a common scale.
- **1.9** Compare shape, center, variability and unusual features, in context, with comparative language and numbers.
- **1.9** Choose summary statistics that suit the shapes (median and IQR when either group is skewed or has outliers) and use the same pair for every group.
- **1.9** Say what a comparison can and cannot support: tendencies, not statements about every individual, and not cause and effect from observed groups.

## Key terms

| Term | Meaning |
|---|---|
| Comparative language | Words that relate the groups: greater than, less than, about the same as, more variable than. |
| Back-to-back stemplot | Two stemplots sharing one column of stems, leaves for one group to the left and the other to the right. |
| Parallel (side-by-side) boxplots | Boxplots for several groups drawn on one common number line. |
| Common scale | The same axis, with the same units and tick marks, for every group being compared. |
| Resistant statistic | A statistic (median, quartiles, IQR) that an extreme value barely moves. |
| Overlap | The part of the number line where values from both groups occur. |

## Asking a comparison question

Every comparison starts with a question. A **statistical investigative question** for this topic names three things: the population or populations, the quantitative variable, and the groups. "How long is your commute?" is a survey question asked of one person. "Do students at North High tend to have shorter commutes to school than students at South High?" is an investigative question: it is about groups, it names the variable (commute time, in minutes), and the words "tend to" admit that commutes vary within each school.

The question also tells you what to compute. "Shorter commutes" is about center; "more predictable commutes" is about variability. If the question asks about typical values, your answer must compare centers; if it asks about consistency, it must compare spreads. Answer the question that was asked, then add the other features.

## The four features, compared

A complete comparison addresses all four features for every group, and actually compares them:

| Feature | What to say | Example language |
|---|---|---|
| Shape | Name each shape; say whether they match | "North's times are skewed right; South's are roughly symmetric." |
| Center | Which is greater, by about how much | "South's median is about 10 minutes greater than North's." |
| Variability | Which is more spread out, with a statistic | "The IQRs are equal (10 minutes)." |
| Unusual features | Outliers, gaps, clusters, with values | "North has a high outlier at 47 minutes." |

Two habits lose points every year. The first is **listing without comparing**: "North: median 18. South: median 28." is two descriptions, not a comparison. Use a comparative word and, ideally, a difference. The second is **leaving out context**: "Group 1 is more variable" should be "Commute times at South vary more than at North".

**Worked example 1 (back-to-back stemplot).** A hypothetical district asked 15 students at each of two high schools how many minutes their commute to school took this morning.

```
          North |   | South
              8 | 0 |
9 8 7 5 5 4 2 1 | 1 | 6 9
      9 6 4 2 1 | 2 | 2 3 5 6 7 8 8
                | 3 | 0 1 3 4 6 8
              7 | 4 |
Key: 2 | 3 means 23 minutes
```

North's ordered values are 8, 11, 12, 14, 15, 15, 17, 18, 19, 21, 22, 24, 26, 29, 47 and South's are 16, 19, 22, 23, 25, 26, 27, 28, 28, 30, 31, 33, 34, 36, 38. With 15 values each, the median is the 8th value and the quartiles are the medians of the 7 values on either side.

| School | Min | Q1 | Median | Q3 | Max | IQR |
|---|---|---|---|---|---|---|
| North | 8 | 14 | 18 | 24 | 47 | 10 |
| South | 16 | 23 | 28 | 33 | 38 | 10 |

Outlier check: North's upper fence is 24 + 1.5(10) = 39, so 47 is an outlier; South's fences are 8 and 48, so it has none.

*Comparison.* North's commute times are skewed to the right with a high outlier at 47 minutes, while South's are roughly symmetric with no outliers. The median commute at South (28 minutes) is about 10 minutes longer than at North (18 minutes). The two schools have the same IQR (10 minutes), so the middle halves are equally spread, although North's overall range (39 minutes) is larger because of its outlier. To answer the question: North students tend to have shorter commutes than South students.

Notice the choice of statistics. Because North is skewed with an outlier, its mean (about 19.9) and standard deviation (about 9.5) are pulled upward; the median and IQR describe both schools fairly.

## Choosing statistics to match the shapes

The rule from week 4 carries over with one addition:

- If **either** group is clearly skewed or has outliers, compare **medians and IQRs** for **both** groups.
- If **both** groups are roughly symmetric with no outliers, means and standard deviations are appropriate (medians and IQRs are still acceptable).
- Never compare one group's mean with another group's median, or an SD with an IQR. Like with like.

A quick clue from a table of statistics: a mean noticeably above the median suggests right skew; a mean noticeably below it suggests left skew. Confirm with a graph whenever you have one.

**Worked example 2 (two five-number summaries).** A school surveyed 40 ninth graders and 40 twelfth graders about how many hours they slept on a school night.

| Grade | Min | Q1 | Median | Q3 | Max |
|---|---|---|---|---|---|
| 9th | 5.5 | 7.0 | 7.75 | 8.5 | 10.0 |
| 12th | 3.5 | 6.0 | 6.5 | 7.25 | 9.0 |

*Outliers.* 9th grade: IQR = 1.5, fences 7.0 − 2.25 = 4.75 and 8.5 + 2.25 = 10.75; no outliers. 12th grade: IQR = 1.25, fences 6.0 − 1.875 = 4.125 and 7.25 + 1.875 = 9.125; the minimum, 3.5 hours, is an outlier.

*Comparison.* The median sleep for ninth graders (7.75 hours) is about 1.25 hours more than for twelfth graders (6.5 hours). In fact the ninth-grade median is above the twelfth-grade third quartile, so more than half of the ninth graders slept more than about three quarters of the twelfth graders. The ninth graders' sleep is a little more variable (IQR 1.5 versus 1.25 hours). Twelfth grade has a low outlier at 3.5 hours. From the summaries alone the shapes look roughly symmetric in the middle, though the twelfth-grade lower whisker is long because of the outlier.

What the boxplots cannot tell you: how many students are in each group (here we were told 40 each), the means, or whether either distribution has two clusters hidden inside a box.

## Displays for comparison

| Display | Best for | Watch out for |
|---|---|---|
| Back-to-back stemplot | Two groups, roughly 10 to 50 values each; keeps every value | Only two groups; read left leaves from the stem outward |
| Parallel boxplots | Several groups, or large groups; centers, IQRs and outliers at a glance | Hides gaps, clusters and sample sizes |
| Stacked dotplots | Small groups; every value visible | Must share one horizontal scale |
| Stacked histograms | Large groups; shape | Use relative frequency when the group sizes differ |

When the groups have different sizes, a frequency histogram of the larger group looks "taller" at every value. Plotting the **percent** of each group in each interval puts them on the same footing.

**Worked example 3 (means and standard deviations).** In a biology class, 12 bean plants grew under LED lights and 12 under fluorescent lights. Heights after 21 days, in centimetres:

LED: 18.2, 19.5, 20.1, 20.8, 21.3, 21.6, 22.0, 22.4, 22.9, 23.5, 24.1, 25.0
Fluorescent: 14.6, 15.9, 16.3, 17.0, 17.4, 17.8, 18.1, 18.5, 18.9, 19.6, 20.2, 21.0

| Light | Mean | SD | Median | IQR |
|---|---|---|---|---|
| LED | 21.78 | 1.97 | 21.80 | 2.75 |
| Fluorescent | 17.94 | 1.85 | 17.95 | 2.60 |

Both groups have means almost equal to their medians and no values beyond the fences (LED fences 16.3 and 27.3; fluorescent 12.75 and 23.15), and dotplots show both roughly symmetric. So means and standard deviations are fine.

*Comparison.* Both distributions of height are roughly symmetric with no outliers. The plants under LED lights were taller on average (mean 21.8 cm) than those under fluorescent lights (17.9 cm), by about 3.9 cm. The variability is about the same (SDs 2.0 and 1.9 cm). The distributions overlap between about 18 and 21 cm: the tallest fluorescent plant (21.0) was taller than the four shortest LED plants.

Could we say the LED lights *caused* the extra growth? Only if the plants were randomly assigned to the lights. That is the subject of week 7. A comparison of groups that were already different, such as athletes and non-athletes or ninth and twelfth graders, describes a difference but cannot explain it.

## From a weak answer to a full-credit one

**Worked example 4.** A question gave the summaries below for the number of text messages sent in one day by a random sample of students at two schools, and asked for a comparison.

| School | n | Median | IQR | Shape | Outliers |
|---|---|---|---|---|---|
| Elm | 50 | 42 | 30 | skewed right | 3 high |
| Oak | 50 | 35 | 18 | skewed right | none |

*Weak answer:* "Elm has median 42 and IQR 30. Oak has median 35 and IQR 18. Both are skewed."

It lists numbers for each school but never compares them, mentions no outliers, and gives no context beyond "both".

*Full-credit answer:* "Both distributions of daily texts are skewed to the right. Students at Elm tend to send more texts than students at Oak: Elm's median (42 texts) is about 7 texts greater than Oak's (35). Elm's numbers of texts are also more variable (IQR 30 versus 18 texts), and Elm has three high outliers while Oak has none."

Every feature appears, each one uses a comparative word, the differences are sized, and the variable is named.

## Common mistakes

- **Listing instead of comparing.** Put the groups in one sentence with "greater than", "less than", "about the same as" or "more variable than".
- **Forgetting context.** Name the variable, its units and the groups.
- **Reading the variable backwards.** A greater race time is slower; a greater golf score is worse.
- **Mixing statistics.** One group's mean against the other's median is not a comparison.
- **"All" instead of "tend to".** Overlapping distributions do not order every individual.
- **Reading sample size from a boxplot.** A longer box is more spread, not more people.
- **Comparing frequency histograms of groups with different sizes.** Use relative frequency.
- **Claiming a cause from observed groups.** Without random assignment, other differences between the groups could explain the result.

## Self-check

1. Write an investigative question that compares the battery life of two phone models.
2. Group A: median 50, IQR 12, symmetric. Group B: median 50, IQR 25, skewed right. Compare them in one or two sentences (use "scores on a quiz" as context).
3. Why should the same summary statistics be used for both groups?
4. Five-number summaries: Team X 10, 14, 18, 22, 26; Team Y 12, 20, 24, 27, 45. Does Team Y have an outlier?
5. A boxplot for one class is twice as wide as another's. What can and can't you conclude?
6. A table shows mean 64 and median 71 for one group. What shape does that suggest?

*Answers:* 1. For example, "Do phones of model P tend to have a longer battery life on a full charge than phones of model Q?" 2. The two groups have the same median quiz score (50), but scores in Group B are about twice as variable (IQR 25 versus 12) and skewed to the right, while Group A's are symmetric. 3. So that the comparison is like with like; a mean and a median measure center differently. 4. IQR = 7, upper fence 27 + 10.5 = 37.5, so 45 is an outlier. 5. Its values are more spread out; nothing about how many students are in it. 6. Skewed to the left (a low tail pulls the mean down).

---

*Original study material for this course, organised around the College Board AP Statistics Course and Exam Description (Unit 1, Topic 1.9). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). All data are invented. AP® is a trademark of the College Board, which does not endorse this material.*
