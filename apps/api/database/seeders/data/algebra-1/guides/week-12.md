# Week 12 · Two-way Tables and Associations in Categorical Data

**Lessons:** 3.1 Two-way Tables · 3.2 Relative Frequency Tables · 3.3 Associations in Categorical Data
**Practices:** MP2 (reason about proportions, not counts), MP3 (argue from a table whether an association exists), MP6 (say which total a percentage is of)
**Built from:** IM Algebra 1, Unit 3, Lessons 1–3, in our own words
**Spiral:** Unit 1 summarised one variable at a time. Now two categorical variables are recorded for each person, and the question is whether they are related. The habit of asking "percentage of what?" is the same care with units you used when writing equations in unit 2.

## What you need to be able to do

- **3.1** Build and read a two-way (contingency) table of counts for two categorical variables, including row totals, column totals and the grand total.
- **3.2** Convert a two-way table to relative frequencies: of the whole table, of each row, or of each column, and say which one answers a given question.
- **3.3** Decide whether two categorical variables show an association by comparing conditional relative frequencies across groups, and describe the association in words.

## Key terms

| Term | Meaning |
|---|---|
| Two-way table | A table whose rows are the categories of one variable and columns the categories of another; each cell counts the cases in both categories. |
| Marginal totals | The row totals and column totals in the margins of the table. |
| Relative frequency | A count divided by a total, written as a fraction, decimal or percent. |
| Joint relative frequency | A cell count divided by the grand total. |
| Row relative frequency | A cell count divided by its row total: "of the people in this row, what fraction are in this column?" |
| Column relative frequency | A cell count divided by its column total. |
| Conditional relative frequency | A row or column relative frequency: a proportion within one group. |
| Association | The variables are associated if the conditional relative frequencies differ noticeably between groups. |

## Two-way tables (3.1)

A survey of 120 students asked whether they play a sport and whether they play a musical instrument.

| | Instrument | No instrument | Total |
|---|---|---|---|
| Plays a sport | 24 | 46 | 70 |
| No sport | 26 | 24 | 50 |
| Total | 50 | 70 | 120 |

Reading it: 24 students do both; 46 play a sport but no instrument; 70 play a sport in all; 50 play an instrument in all; 120 students were surveyed. The four inner cells add to each margin, and the margins add to the grand total, which is how you check a table.

**Building a table from a description.** "Of 80 customers, 50 ordered coffee. 30 of the coffee drinkers also ordered food, and 10 customers ordered neither." Start with what you know: coffee row total 50, so no-coffee row total 30; coffee-and-food 30, so coffee-no-food 20; neither is 10, so no-coffee-but-food is 30 − 10 = 20. Column totals: food 50, no food 30.

**Try it.** In the sport/instrument table, how many students play neither? How many play an instrument but no sport?
*Answers:* 24; 26.

## Relative frequency tables (3.2)

Counts depend on how many people were asked. To compare groups of different sizes, divide.

**Of the whole table** (joint): divide every cell by 120.

| | Instrument | No instrument | Total |
|---|---|---|---|
| Plays a sport | 0.20 | 0.38 | 0.58 |
| No sport | 0.22 | 0.20 | 0.42 |
| Total | 0.42 | 0.58 | 1.00 |

So 20% of all students do both; 58% play a sport.

**Of each row**: divide each cell by its row total. This answers "among sport players, what fraction play an instrument?"

| | Instrument | No instrument | Total |
|---|---|---|---|
| Plays a sport | 24/70 ≈ 0.34 | 46/70 ≈ 0.66 | 1.00 |
| No sport | 26/50 = 0.52 | 24/50 = 0.48 | 1.00 |

**Of each column**: divide by the column total. "Among instrument players, what fraction play a sport?" 24/50 = 0.48; among non-players, 46/70 ≈ 0.66.

**Which one?** The question tells you. "What percent of students are in both?" → whole table. "What percent of sport players also play an instrument?" → the sport row. "What percent of instrument players also play a sport?" → the instrument column. The number after "of" names the total.

**Try it.** From the table, what percent of non-sport students play an instrument? What percent of all students play neither?
*Answers:* 26/50 = 52%; 24/120 = 20%.

## Is there an association? (3.3)

Two variables are **associated** if knowing one changes what you expect of the other. Compare the conditional relative frequencies across the groups:

- Among sport players, 34% play an instrument.
- Among non-sport players, 52% play an instrument.

Those differ by 18 percentage points, so there is an association: students who do not play a sport are more likely to play an instrument. If the two percentages had been close (say 41% and 43%), we would say there is little or no association.

**Worked example.** 200 commuters were asked how they travel and whether they arrived late this week.

| | Late | On time | Total |
|---|---|---|---|
| Bus | 30 | 70 | 100 |
| Car | 20 | 80 | 100 |

Row relative frequencies: bus late 30%, car late 20%. A 10-point gap: a modest association, bus riders were more often late. Because the groups are the same size you could compare counts, but percentages are the safe comparison when group sizes differ.

**Worked example.** 60 cats and 140 dogs at a shelter; 15 cats and 35 dogs are over 5 years old. Is age associated with species?
Cats: 15/60 = 25% over 5. Dogs: 35/140 = 25% over 5. Identical: no association. Comparing the counts (15 versus 35) would mislead because there are more dogs.

**How big a gap counts?** There is no fixed rule in this course; a gap of a few percentage points in a small survey is probably chance, while a gap of 15 or 20 points is worth reporting. Say what the gap is and how big the groups were.

**Describing an association.** Name both variables, the direction and the evidence: "Students who do not play a sport are more likely to play an instrument (52% versus 34%)." Do not say one causes the other; week 14 returns to that.

## Common mistakes

- Dividing by the wrong total. Always decide whether the question is about everyone, about a row or about a column.
- Comparing counts between groups of different sizes.
- Reading the row percentages when the question is about a column (24/70 versus 24/50 answer different questions).
- Calling any difference an association; tiny gaps in small samples are not evidence.
- Concluding that one variable causes the other from an association.

## Where this goes next

Week 13 moves to two numerical variables: scatter plots, lines fitted to data and residuals. Week 14 measures the strength of a linear relationship with the correlation coefficient and discusses when an association does and does not mean causation, which applies to the categorical tables here as well.

## Self-check

1. A table has cells 12, 18 (row 1) and 20, 10 (row 2). Find the row, column and grand totals.
2. What percent of the whole table is in the row 1, column 1 cell?
3. What percent of row 1 is in column 1? Of column 1 is in row 1?
4. Is there an association between the row variable and the column variable? Use row percentages.
5. A school finds that 40 of 200 freshmen and 60 of 300 seniors bring lunch from home. Is there an association between grade and bringing lunch?

*Answers:* (1) Rows 30 and 30; columns 32 and 28; grand total 60. (2) 12/60 = 20%. (3) 12/30 = 40%; 12/32 = 37.5%. (4) Row 1 is 40% column 1; row 2 is 20/30 ≈ 67% column 1. A 27-point gap: yes, associated. (5) 20% and 20%: no association.

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Algebra 1, Unit 3, Lessons 1–3, https://im.kendallhunt.com/HS/teachers/1/3/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
