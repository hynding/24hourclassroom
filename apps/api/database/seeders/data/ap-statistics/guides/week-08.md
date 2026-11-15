# Week 08 · Two-Way Tables and Their Summary Statistics

**Topics:** 2.1 Tabular and Graphical Representations for the Distributions of Two Categorical Variables · 2.2 Summary Statistics for Two Categorical Variables
**Practices:** 3 (Analyze Data), 4 (Interpret Results), 1 (Formulate Questions)
**Framework:** AP Statistics CED (effective fall 2026), Unit 2, Topics 2.1–2.2, learning objectives in our own words
**Spiral:** Week 2 summarised one categorical variable with frequency tables, relative frequencies and bar charts. Weeks 6 and 7 separated observational studies from experiments. This week puts two categorical variables side by side, asks whether they are associated, and keeps the Unit 1 rule in view: an association found in an observational study is not evidence of cause and effect.

## What you need to be able to do

- **2.1** Read a two-way table and find joint, marginal and conditional frequencies and relative frequencies.
- **2.1** Build and read side-by-side bar charts, segmented bar charts and mosaic plots, and say which comparison each one makes easy.
- **2.2** Compare conditional distributions (or conditional proportions) to decide whether two categorical variables are associated, and describe the association in context.
- **2.2** Use the difference between two conditional proportions as a summary of how strong an association is.
- **2.2** Explain what the table would look like if there were no association, and state what an association does and does not let you conclude.

## Key terms

| Term | Meaning |
|---|---|
| Two-way table | A table of counts for two categorical variables; one labels the rows, the other the columns. |
| Joint relative frequency | A cell count divided by the grand total: the proportion of all individuals in one row category **and** one column category. |
| Marginal distribution | The row totals (or column totals) divided by the grand total: the distribution of one variable, ignoring the other. |
| Conditional distribution | The distribution of one variable among only the individuals in one category of the other: cell counts divided by that row's (or column's) total. |
| Segmented bar chart | One bar per category of one variable, each bar 100% tall, divided by the conditional distribution of the other variable. |
| Mosaic plot | A segmented bar chart whose bar widths are proportional to the marginal distribution of the bar variable. |
| Association | Knowing one variable's value changes the conditional distribution of the other. |
| Difference of conditional proportions | p̂₁ − p̂₂ for one outcome in two groups; a one-number summary of an association in a 2×2 setting. |

## Two-way tables and their three kinds of proportion (2.1)

A two-way table cross-classifies each individual on two categorical variables. Each cell counts the individuals who fall in one row category and one column category; the margins hold the totals. Every proportion you can compute from the table answers the question "out of whom?", and the denominator says which group:

- **Joint:** out of everyone (the grand total).
- **Marginal:** out of everyone, for one variable only (a row or column total over the grand total).
- **Conditional:** out of one row or one column only.

The single most common error on this topic is choosing the wrong denominator, so say the "out of whom" in words before you divide.

**Worked example 1 (travel to school).** A hypothetical high school asked a random sample of 400 sophomores and seniors how they usually get to school.

| | Bus | Car | Walk or bike | Total |
|---|---|---|---|---|
| Sophomore | 96 | 52 | 32 | 180 |
| Senior | 44 | 128 | 48 | 220 |
| Total | 140 | 180 | 80 | 400 |

- **Joint relative frequency** of "senior and car": 128/400 = 0.32. Of all 400 students, 32% are seniors who come by car.
- **Marginal distribution of travel mode:** 140/400 = 0.35 bus, 180/400 = 0.45 car, 80/400 = 0.20 walk or bike.
- **Conditional distribution of travel mode for sophomores:** 96/180 ≈ 0.533 bus, 52/180 ≈ 0.289 car, 32/180 ≈ 0.178 walk or bike (these add to 1).
- **Conditional distribution for seniors:** 44/220 = 0.200 bus, 128/220 ≈ 0.582 car, 48/220 ≈ 0.218 walk or bike.
- **The reversed conditional:** among bus riders, the proportion who are sophomores is 96/140 ≈ 0.686. That is a different question from "among sophomores, what proportion ride the bus?" (0.533), and it has a different answer.

The conditional distributions are what you compare: 53.3% of sophomores ride the bus but only 20.0% of seniors, while 58.2% of seniors come by car against 28.9% of sophomores. Raw counts would mislead here because the groups have different sizes (180 and 220).

## Graphs for two categorical variables (2.1)

- **Side-by-side bar chart.** Bars for each column category grouped by row category. With counts on the vertical axis it is fair only when the groups are the same size; with conditional percents it is fine.
- **Segmented bar chart.** One bar per group, each scaled to 100%, split into segments by the conditional distribution. It makes comparing conditional distributions easy: if the segments line up across bars, there is little or no association.
- **Mosaic plot.** A segmented bar chart in which each bar's **width** is proportional to the group's share of the total. Segment heights still show conditional proportions, and the area of each tile is proportional to its joint relative frequency, so a mosaic plot shows all three kinds of proportion at once.

For the travel data, a segmented bar chart would have a sophomore bar split 53.3 / 28.9 / 17.8 and a senior bar split 20.0 / 58.2 / 21.8. In a mosaic plot the senior bar would also be wider (0.55 of the width against 0.45).

## Association and summary statistics (2.2)

Two categorical variables are **associated** if the conditional distribution of one variable differs from one category of the other to the next. They show **no association** if every conditional distribution is the same (and therefore equal to the marginal distribution).

In a 2×2 table, a natural summary statistic is the **difference between the two conditional proportions** for the outcome of interest. A difference near 0 suggests little association; the farther from 0, the stronger. On this unit's data you judge "far from 0" informally. Unit 3 (weeks 19 to 22) adds the inference that decides whether a difference is larger than chance variation would produce.

**Worked example 2 (phones and sleep).** A hypothetical survey of 250 students at one school recorded whether each keeps a phone in the bedroom overnight and whether the student usually sleeps at least 8 hours on school nights.

| | 8+ hours | Under 8 hours | Total |
|---|---|---|---|
| Phone in bedroom | 42 | 138 | 180 |
| No phone in bedroom | 34 | 36 | 70 |
| Total | 76 | 174 | 250 |

1. **Conditional proportions.** Phone: 42/180 ≈ 0.233 sleep 8+ hours. No phone: 34/70 ≈ 0.486.
2. **Summary statistic.** 0.486 − 0.233 ≈ 0.252. The proportion sleeping at least 8 hours is about 25 percentage points higher for students without a phone in the bedroom.
3. **Association.** The conditional distributions differ a lot, so in this sample phone location and sleep are associated.
4. **Scope.** This is an observational survey: students chose where their phones sleep. A confounding variable, such as having stricter household rules about bedtime, could lead both to no phone in the bedroom and to more sleep. The data show an association, not that removing the phone causes more sleep. If the 250 students were a random sample of the school, the association could be generalised to the school, not beyond it.

Notice that the marginal proportion sleeping 8+ hours, 76/250 = 0.304, sits between the two conditional proportions. A marginal proportion is always a weighted average of the conditional ones; here it sits closer to 0.233 because most students (180 of 250) keep a phone in the bedroom.

**Worked example 3 (what "no association" looks like).** A hypothetical survey of 200 juniors and seniors at a school finds that 60% of the 200 have a part-time job, and there are 80 juniors and 120 seniors. Fill in the table so that job status and class year are **not** associated.

No association means each class has the same conditional proportion with a job as the whole group, 0.60.

| | Job | No job | Total |
|---|---|---|---|
| Junior | 0.60 × 80 = 48 | 32 | 80 |
| Senior | 0.60 × 120 = 72 | 48 | 120 |
| Total | 120 | 80 | 200 |

Check: 48/80 = 72/120 = 0.60, so the difference of conditional proportions is exactly 0, and the two bars of a segmented bar chart would be identical. Real samples almost never match this perfectly; the question in Unit 3 will be whether a sample's departure from it is too large to be chance. (These "no-association" counts are the expected counts that the chi-square test of week 22 starts from.)

### Writing about association

A strong answer names the variables, compares specific conditional proportions with the denominator made clear, and says which way the association goes. For the travel data:

> "Among sophomores in the sample, 53.3% ride the bus, compared with 20.0% of seniors; seniors are much more likely to come by car (58.2% versus 28.9%). Because the conditional distributions of travel mode differ by class year, travel mode and class year are associated in this sample."

Avoid "the variables are correlated": correlation is a measure for two quantitative variables (week 29). Use "associated".

## Common mistakes

- **Wrong denominator.** "The proportion of seniors who drive" divides by the senior total; "the proportion of drivers who are seniors" divides by the driver total; "the proportion of students who are senior drivers" divides by the grand total.
- **Comparing counts across groups of different sizes.** 180 walkers at a school of 900 is a smaller share (20%) than 90 at a school of 300 (30%).
- **Swapping the conditional.** P(bus given sophomore) ≈ 0.533 is not P(sophomore given bus) ≈ 0.686.
- **Saying "no association" because the groups are the same size.** Equal row totals say nothing about the conditional distributions.
- **Claiming causation from an observational two-way table.** Association is not causation; only random assignment supports a cause-and-effect conclusion.
- **Reading a mosaic plot's width as a conditional proportion.** Width shows the group's share of all individuals; height within a bar shows the conditional proportion.
- **Using "correlation" for categorical variables.** Say "association".

## Where this goes next

Week 9 turns relative frequencies into probabilities, first by simulation and then with the basic rules. Week 10 uses two-way tables to compute conditional probabilities and to check whether two events are independent, which is the probability version of "no association". Week 22 tests for association formally with chi-square.

## Self-check

1. In worked example 1, what proportion of all 400 students walk or bike and are sophomores?
2. In worked example 1, among students who come by car, what proportion are seniors?
3. In a hypothetical survey, 45 of 75 students who play an instrument and 60 of 125 who do not say they enjoy math class. Compute the difference in conditional proportions (instrument minus no instrument).
4. Which display shows both the marginal distribution of one variable and the conditional distributions of the other?
5. A table shows that students who eat breakfast are more likely to be on the honour roll. Give one reason this does not show that breakfast improves grades.
6. If 35% of all 300 people in a sample prefer tea and there is no association between preferred drink and age group, what percent of the 90 people aged 50 or over prefer tea?

*Answers:* 1. 32/400 = 0.08. 2. 128/180 ≈ 0.711. 3. 45/75 = 0.60 and 60/125 = 0.48, so 0.60 − 0.48 = 0.12. 4. A mosaic plot (bar widths show the marginal distribution; segment heights show the conditional distributions). 5. It is an observational study; a confounder such as family routines or income could affect both breakfast and grades. 6. 35%, the same as the marginal percent, because no association means every conditional distribution equals the marginal one.

---

*Original study material for this course, organised around the College Board AP Statistics Course and Exam Description (Unit 2, Topics 2.1–2.2). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). All data are invented. AP® is a trademark of the College Board, which does not endorse this material.*
