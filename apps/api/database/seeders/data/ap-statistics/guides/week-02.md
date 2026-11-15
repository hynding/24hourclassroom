# Week 02 · Summarizing and Graphing One Categorical Variable

**Topics:** 1.3 Tabular Representation and Summary Statistics for One Categorical Variable · 1.4 Graphical Representations for One Categorical Variable
**Practices:** 3 (Analyze Data), 4 (Interpret Results), 1 (Formulate Questions)
**Framework:** AP Statistics CED (effective fall 2026), Unit 1, Topics 1.3–1.4, learning objectives in our own words
**Spiral:** Week 1 wrote investigative questions and sorted variables into categorical and quantitative. This week takes the categorical ones and answers summary questions about them: how many individuals fall in each category, what proportion that is, which category is most common, and how to draw it honestly.

## What you need to be able to do

- **1.3** Build a frequency table and a relative frequency table for one categorical variable.
- **1.3** Compute and interpret proportions and percentages, recover counts from relative frequencies, and find a missing relative frequency.
- **1.3** Identify the mode, and explain why means and medians do not apply to categories.
- **1.4** Construct and read bar charts (frequency and relative frequency) and pie charts, and choose between them.
- **1.4** Describe the distribution of a categorical variable in context, with numbers.
- **1.4** Recognise misleading displays: truncated axes, scaled pictures, overlapping categories in a pie chart.

## Key terms

| Term | Meaning |
|---|---|
| Distribution (of a categorical variable) | The categories and how many individuals, or what proportion, fall in each. |
| Frequency | The count of individuals in a category. |
| Relative frequency | Frequency ÷ total number of individuals; a proportion from 0 to 1. |
| Frequency table / relative frequency table | A table of each category with its count / its proportion or percentage. |
| Mode | The most common category. |
| Bar chart | One equal-width bar per category, separated by gaps, with height showing count or proportion. |
| Pie chart | A circle divided into slices whose angles are relative frequency × 360°. |

## Tables and summary statistics (1.3)

A categorical variable sorts individuals into groups, so the natural summary is **how many in each group**. A **frequency table** lists each category with its count; a **relative frequency table** lists each category's proportion of the total:

relative frequency = count in the category ÷ total number of individuals.

Relative frequencies are between 0 and 1, and when every individual is in exactly one category they add to 1 (100%), apart from rounding. Multiply by 100 for a percentage.

Why bother with proportions when you have counts? Because proportions put groups of different sizes on one scale. If 30 of a club's 60 members and 45 of another club's 150 members are seniors, the second club has more seniors (45 versus 30), but a much smaller share of seniors (0.30 versus 0.50). Report both the proportion and the total n, because a proportion alone hides the sample size: 0.25 could be 1 of 4 or 250 of 1,000.

The **mode** is the category with the highest frequency. It is the only notion of "typical" that makes sense for categorical data. A **mean or median of categories is meaningless**: if you code eye colours as 1 = brown, 2 = blue, 3 = green and average the codes, the answer depends entirely on which number you gave which colour.

**Worked example 1: how 160 students get to school.** A random sample of 160 students at a large high school reported how they usually get to school.

| Way to school | Count | Relative frequency | Percent |
|---|---|---|---|
| Bus | 58 | 58/160 = 0.3625 | 36.25% |
| Family car | 44 | 44/160 = 0.2750 | 27.50% |
| Walk | 22 | 22/160 = 0.1375 | 13.75% |
| Bike | 12 | 12/160 = 0.0750 | 7.50% |
| Drive themselves | 24 | 24/160 = 0.1500 | 15.00% |
| Total | 160 | 1.0000 | 100% |

The mode is bus. A summary in context, with numbers: "The most common way to school among the sampled students is the bus (about 36%), followed by a family car (27.5%). Only 7.5% bike." The proportion who arrive some way other than bus or family car is (22 + 12 + 24)/160 = 58/160 = 0.3625.

Notice how this answers a week 1 investigative question, such as "What is the most common way for students at our school to get to school, and what proportion use it?" The data come from a sample; topics 1.10–1.12 discuss when a sample's proportions can be trusted to describe the whole school.

**Worked example 2: working backward.** A hypothetical school cafeteria reports the main item in 250 lunches sold on one day as a relative frequency table, but one value was lost: pizza 0.34, sandwich 0.24, salad bar 0.14, hot entrée 0.22, other ?

- *Missing relative frequency:* the categories do not overlap and cover every lunch, so other = 1 − (0.34 + 0.24 + 0.14 + 0.22) = 1 − 0.94 = 0.06.
- *Counts:* count = relative frequency × total. Pizza 0.34 × 250 = 85; sandwich 60; salad bar 35; hot entrée 55; other 15. Check: 85 + 60 + 35 + 55 + 15 = 250.
- *Mode:* pizza, 34% of the lunches.

Without the total of 250 the counts could not be recovered: proportions alone never tell you n.

## Displays for one categorical variable (1.4)

### Bar charts

A **bar chart** draws one bar per category. Its rules:

- the categories go along one axis, with **gaps** between the bars (the categories are separate groups, not points on a number line);
- every bar has the **same width**: only the height carries information;
- the count or relative frequency axis **starts at 0**;
- unordered categories may be placed in any order (from most to least frequent is often clearest); ordered categories (small, medium, large) keep their natural order.

A **frequency** bar chart and a **relative frequency** bar chart of the same data look identical: every count is divided by the same n, so only the labels on the vertical axis change. Use relative frequencies when you want to compare with another group of a different size (that comparison of two groups is week 8's topic).

### Pie charts

A **pie chart** shows each category as a slice of a circle with angle

slice angle = relative frequency × 360°.

It is appropriate only when the categories are **parts of one whole**: each individual is in exactly one category and the percentages add to 100%. Bar charts are usually better for comparing categories of similar size, because the eye compares lengths on a common baseline more accurately than angles.

**Worked example 3: a bar chart and a pie chart of the lunches.** For the 250 lunches of worked example 2, the bar chart, sorted from most to least frequent, looks like this (each ▇ is 5 lunches):

```
Pizza       ▇▇▇▇▇▇▇▇▇▇▇▇▇▇▇▇▇ 85
Sandwich    ▇▇▇▇▇▇▇▇▇▇▇▇ 60
Hot entrée  ▇▇▇▇▇▇▇▇▇▇▇ 55
Salad bar   ▇▇▇▇▇▇▇ 35
Other       ▇▇▇ 15
```

Every lunch has exactly one main item, so a pie chart is also fine. Its angles:

| Item | Relative frequency | Angle |
|---|---|---|
| Pizza | 0.34 | 0.34 × 360° = 122.4° |
| Sandwich | 0.24 | 86.4° |
| Hot entrée | 0.22 | 79.2° |
| Salad bar | 0.14 | 50.4° |
| Other | 0.06 | 21.6° |
| Total | 1.00 | 360° |

On the pie chart, sandwich (86.4°) and hot entrée (79.2°) are hard to tell apart by eye; on the bar chart the difference of 5 lunches is easy to see. That is the usual reason to prefer bars.

When can you *not* use a pie chart? When individuals can be in more than one category. If a survey asks students to name every sport they play and reports soccer 30%, basketball 28%, track 25%, swimming 15%, other 40% and none 22%, the percentages add to 160%. They are not slices of one whole; a bar chart of "percent of students who play each sport" is the honest display.

### Describing the distribution

Describe a categorical distribution by naming the most and least common categories, comparing categories with numbers, and staying in context: "Pizza was the most common lunch (34% of the 250 sold), more than twice as common as the salad bar (14%)." A description with no numbers, or with no reference to lunches, is not a complete answer.

### Graphs that mislead

**Worked example 4: a truncated axis.** A newsletter shows 52 sign-ups for robotics and 44 for drama on a bar chart whose vertical axis starts at 40. The drawn bars have heights 52 − 40 = 12 and 44 − 40 = 4, so robotics *looks* three times as popular. In fact 52/44 ≈ 1.18: robotics has about 18% more sign-ups. Redrawn from zero, the two bars are nearly the same height. Whenever bar heights are compared, the axis must start at zero.

Two other traps:

- **Scaled pictures (pictographs).** If one category's count is twice another's and its picture is drawn twice as tall *and* twice as wide, its area is 4 times as large, and the eye reads area. Use bars, or repeat same-size icons.
- **Percentages that do not add up.** A pie chart whose slices add to more than 100% has overlapping categories; one that adds to much less is missing a category (such as "none"). Small rounding differences (99% or 101%) are fine.

## Common mistakes

- **Dividing by the wrong total.** A relative frequency divides by the total number of individuals, not by another category's count.
- **Giving a count when asked for the mode.** The mode is a category ("bus"), not its frequency (58).
- **Averaging category codes.** Codes are labels; use counts, proportions and the mode.
- **Drawing a pie chart of overlapping categories.** Check that every individual is in exactly one category.
- **Starting the axis above zero.** It exaggerates differences between bars.
- **Describing without numbers or context.** "Bus is biggest" is not enough; say "36% of the sampled students take the bus".

## Self-check

1. In a survey of 75 students, 27 said their favourite season is summer. What is the relative frequency, as a decimal and a percentage?
2. A relative frequency table shows 0.45, 0.30 and 0.10 for three of four non-overlapping categories. What is the fourth?
3. What is the pie-chart angle of a category with 40 of 160 individuals?
4. Twelve percent of 350 households own a bird. How many households is that?
5. Why is "the average blood type is 2.3" meaningless?
6. A bar chart of two counts, 120 and 100, uses an axis from 90 to 130. Describe the distortion.

*Answers:* 1. 27/75 = 0.36, or 36%. 2. 1 − 0.85 = 0.15. 3. 40/160 = 0.25, and 0.25 × 360° = 90°. 4. 0.12 × 350 = 42 households. 5. Blood type is categorical; the number comes from arbitrary codes. Report counts or proportions and the mode. 6. The drawn heights are 30 and 10, so 120 looks three times as large as 100; the real ratio is 1.2.

---

*Original study material for this course, organised around the College Board AP Statistics Course and Exam Description (Unit 1, Topics 1.3–1.4). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). All data are invented. AP® is a trademark of the College Board, which does not endorse this material.*
