# Week 22 · Chi-Square Tests for Homogeneity and Independence

**Topics:** 3.14 Setting Up a Chi-Square Test for Homogeneity or Independence · 3.15 Carrying Out a Chi-Square Test for Homogeneity or Independence
**Practices:** 1 (Formulate Questions), 2 (Collect Data), 3 (Analyze Data), 4 (Interpret Results)
**Framework:** AP Statistics CED (effective fall 2026), Unit 3, Topics 3.14–3.15, learning objectives in our own words
**Spiral:** Week 8 organised two categorical variables in a two-way table and compared conditional distributions by eye. Week 21 tested whether two proportions differ. A two-way table with more than two rows or columns has many proportions at once; the chi-square tests ask whether the whole pattern of differences is too large to be chance.

## What you need to be able to do

- **3.14** Choose between a chi-square test for homogeneity and a chi-square test for independence from the way the data were collected.
- **3.14** State the hypotheses in words, compute expected counts, and check the Random, 10% and expected-count conditions.
- **3.15** Compute the chi-square statistic, its degrees of freedom and the p-value, and make a decision at a stated α.
- **3.15** Write the conclusion in context and use the largest contributions to describe how the data depart from H₀.

## Key terms

| Term | Meaning |
|---|---|
| Chi-square test for homogeneity | Compares the distribution of one categorical variable across two or more populations or treatments, using independent random samples or random assignment. |
| Chi-square test for independence | Tests for an association between two categorical variables measured on one random sample from one population. |
| Observed count | The count in a cell of the two-way table. |
| Expected count | (row total)(column total)/(table total): the count H₀ predicts for that cell. |
| χ² statistic | Σ (observed − expected)²/expected, summed over every cell. |
| Degrees of freedom | (number of rows − 1)(number of columns − 1). |
| Contribution | One cell's (observed − expected)²/expected; the large ones show where the data depart from H₀. |

## Homogeneity or independence? (3.14)

The arithmetic of the two tests is identical; the design, hypotheses and conclusion differ.

| | Homogeneity | Independence |
|---|---|---|
| Data collection | A separate random sample from each population (or random assignment to treatments) | One random sample, each individual classified on two variables |
| Question | Is the distribution of the variable the same in every population? | Is there an association between the two variables in the population? |
| H₀ | The distribution of [variable] is the same for all [populations] | There is no association between [variable 1] and [variable 2] among all [population] |
| Hₐ | The distributions are not all the same | There is an association |

A quick test: were the row (or column) totals fixed by the researcher before collecting data? Then it is homogeneity. Did they come out of one sample? Then it is independence. Write hypotheses in words; there is no single parameter to name. "Not all the same" is the correct alternative, not "all different".

**Expected counts.** If H₀ is true, every row should have the same distribution as the table's column totals. That gives expected count = (row total)(column total)/(table total).

**Conditions, each in context.**

- **Random:** independent random samples (homogeneity), one random sample (independence), or random assignment (an experiment, analysed as homogeneity).
- **10%:** when sampling without replacement, each sample is at most 10% of its population.
- **Large Counts:** every **expected** count is at least 5. Observed counts may be smaller.

## Carrying out the test (3.15)

**Statistic.** χ² = Σ (O − E)²/E over every cell. It is 0 when every observed count equals its expected count and grows as they disagree. It can never be negative.

**Distribution and p-value.** When H₀ is true and the conditions hold, χ² approximately follows a chi-square distribution with df = (r − 1)(c − 1). Chi-square distributions are skewed right, take only non-negative values, and have mean equal to df. The p-value is the area to the **right** of the observed χ² (the test is always "upper tail", because any kind of disagreement makes χ² large).

**Follow-up.** After rejecting H₀, compare observed and expected in the cells with the largest contributions and say in which direction they differ.

**Worked example 1 (homogeneity, fail to reject).** A hypothetical school district wants to know whether lunch habits differ across grades. It takes independent random samples of 120 ninth graders, 120 eleventh graders and 120 twelfth graders from its large high schools (each grade has more than 2,000 students) and records what each student usually does for lunch. Use α = 0.05.

| Grade | Hot meal | Salad bar | Bring from home | Total |
|---|---|---|---|---|
| 9th | 58 | 22 | 40 | 120 |
| 11th | 44 | 30 | 46 | 120 |
| 12th | 36 | 34 | 50 | 120 |
| Total | 138 | 86 | 136 | 360 |

- **State.** Chi-square test for homogeneity. H₀: the distribution of usual lunch choice is the same for all ninth, eleventh and twelfth graders in the district. Hₐ: the distributions are not all the same.
- **Plan.** Random: three independent random samples. 10%: 120 < 10% of more than 2,000 in each grade. Expected counts: each row has 120 students, so each row's expected counts are 120 · 138/360 = 46.0, 120 · 86/360 ≈ 28.67 and 120 · 136/360 ≈ 45.33, all at least 5.
- **Do.** The contributions are 3.13, 1.55, 0.63 (9th), 0.09, 0.06, 0.01 (11th) and 2.17, 0.99, 0.48 (12th), so χ² ≈ 9.11 with df = (3 − 1)(3 − 1) = 4. p-value = P(χ² ≥ 9.11) ≈ 0.058.
- **Conclude.** Because 0.058 > 0.05, we fail to reject H₀. There is not convincing evidence that the distribution of lunch choice differs among ninth, eleventh and twelfth graders in the district. (The largest contributions, ninth graders buying more hot meals than expected and twelfth graders fewer, are suggestive, but not convincing at α = 0.05.)

**Worked example 2 (independence, reject).** A hypothetical town takes one random sample of 400 adult residents (from more than 15,000) and records each person's age group and main source of local news. Use α = 0.01.

| Age group | Social media | Television | Website or paper | Total |
|---|---|---|---|---|
| Under 30 | 58 | 26 | 36 | 120 |
| 30–54 | 56 | 50 | 54 | 160 |
| 55 and over | 30 | 52 | 38 | 120 |
| Total | 144 | 128 | 128 | 400 |

- **State.** Chi-square test for independence. H₀: there is no association between age group and main news source among all adults in the town. Hₐ: there is an association.
- **Plan.** Random: one random sample. 10%: 400 < 10% of 15,000. Expected counts: for example, under 30 and social media: 120 · 144/400 = 43.2. The smallest expected count is 38.4, so all are at least 5.
- **Do.** χ² ≈ 18.30, df = (3 − 1)(3 − 1) = 4, p-value ≈ 0.001.
- **Conclude.** Because 0.001 < 0.01, we reject H₀. There is convincing evidence of an association between age group and main news source among adults in the town.
- **Follow-up.** The largest contributions are under-30s and social media (observed 58, expected 43.2, contribution 5.07), 55-and-over and television (52 vs 38.4, 4.82), under-30s and television (26 vs 38.4, 4.00) and 55-and-over and social media (30 vs 43.2, 4.03). Younger adults rely on social media more than independence would predict, and older adults rely on television more. Because the data come from a random sample, this association describes the town's adults; it is not evidence that age *causes* the choice.

**Worked example 3 (a 2 × 2 table and the z-test).** The bakery in week 21 compared receipts with and without a pastry at two locations: 95 of 250 and 71 of 230. As a 2 × 2 table, a chi-square test for homogeneity gives χ² ≈ 2.69 with df = 1 and p-value ≈ 0.101. The two-sided two-sample z-test gave z ≈ 1.64 and the same p-value: for a 2 × 2 table, χ² = z² (1.641² ≈ 2.69). With only two groups and a success/failure response, the tests are equivalent; the z-test can also be one-sided and pairs with an interval, while the chi-square test extends to more rows and columns.

## Writing it up

| Step | What earns credit |
|---|---|
| State | Test named (homogeneity or independence), hypotheses in words in context, α |
| Plan | Random, 10% for each sample, every expected count ≥ 5 (show the smallest or the table) |
| Do | χ², df, p-value (the expected counts or the calculator inputs shown) |
| Conclude | p-value compared with α, decision, "convincing evidence" conclusion in context; a follow-up from the largest contributions when H₀ is rejected |

## Common mistakes

- **Running the test on percentages or proportions.** χ² must be computed from counts.
- **Checking observed counts instead of expected counts** for the Large Counts condition.
- **Mixing up the tests.** Several samples → homogeneity; one sample, two variables → independence.
- **Alternative written as "all different".** It is "not all the same" or "there is an association".
- **df = cells − 1 or n − 1.** For a two-way table df = (r − 1)(c − 1).
- **A two-tailed p-value.** The p-value is always the upper tail.
- **Causal language from an observational sample.** An association is not causation.
- **"Accepting" independence** after failing to reject H₀.

## Self-check

1. A researcher samples 80 students from each of four schools and records favourite subject. Which test?
2. Find df for a table with 4 rows and 3 columns.
3. Row total 140, column total 95, table total 320: find the expected count.
4. Why is the chi-square p-value always an upper-tail area?
5. χ² = 4.1 with df = 6. Without a calculator, is this likely to be significant? Why?

*Answers:* 1. A chi-square test for homogeneity (separate samples from four populations). 2. (4 − 1)(3 − 1) = 6. 3. 140 · 95/320 ≈ 41.56. 4. Any disagreement between observed and expected counts makes χ² larger, so only large values count as evidence against H₀. 5. No: the mean of a chi-square distribution is its df, 6, and 4.1 is below that (p ≈ 0.66).

---

*Original study material for this course, organised around the College Board AP Statistics Course and Exam Description (Unit 3, Topics 3.14–3.15). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). All data are invented. AP® is a trademark of the College Board, which does not endorse this material.*
