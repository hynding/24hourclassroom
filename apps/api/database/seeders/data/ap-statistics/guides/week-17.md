# Week 17 · Setting Up a Test for a Proportion and p-Values

**Topics:** 3.5 Setting Up a Test for a Population Proportion · 3.6 p-Values
**Practices:** 1 (Formulate Questions), 3 (Analyze Data), 4 (Interpret Results)
**Framework:** AP Statistics CED (effective fall 2026), Unit 3, Topics 3.5–3.6, learning objectives in our own words
**Spiral:** Week 15 described where p̂ lands when p is known; week 16 used an interval to judge claims about p. A significance test asks the same kind of question more directly: if a claimed value of p were true, how surprising would our sample be? Week 9's simulations and week 12's binomial probabilities already answered "how surprising?" by counting; this week turns that idea into a formal procedure.

## What you need to be able to do

- **3.5** Turn a question into a null and an alternative hypothesis about a population proportion, defining p in context and choosing a one-sided or two-sided alternative from the question.
- **3.5** Name the procedure (a one-sample z-test for a population proportion) and check the Random, 10% and Large Counts conditions, using p₀ for Large Counts.
- **3.6** Compute the test statistic z = (p̂ − p₀)/√(p₀(1 − p₀)/n) and the p-value for a one-sided or two-sided alternative.
- **3.6** Interpret a p-value in context, and estimate one from a simulation.
- **3.6** Explain what a small or a large p-value does and does not tell you.

## Key terms

| Term | Meaning |
|---|---|
| Null hypothesis H₀ | The claim of "no change" or "no difference" that the test assumes true: H₀: p = p₀. |
| Alternative hypothesis Hₐ | The claim we look for evidence of: p > p₀, p < p₀ or p ≠ p₀. |
| p₀ | The hypothesised (null) value of the population proportion. |
| One-sided alternative | Hₐ: p > p₀ or Hₐ: p < p₀, used when the question names a direction. |
| Two-sided alternative | Hₐ: p ≠ p₀, used when the question asks whether p differs in either direction. |
| Test statistic | standardised distance of the statistic from the null value: z = (p̂ − p₀)/√(p₀(1 − p₀)/n). |
| p-value | Assuming H₀ is true, the probability of a statistic at least as extreme as the one observed, in the direction(s) of Hₐ. |
| Significance level α | A cut-off chosen in advance (often 0.05); next week it turns a p-value into a decision. |

## Writing hypotheses (3.5)

A significance test starts from a question. "Has the proportion of students who bike to school gone up since the racks were installed?" "Is this spinner fair?" "Do fewer seeds sprout than the packet says?" Each one becomes two competing claims about the **population parameter**:

- **H₀** always contains the equals sign and a specific value: p = p₀.
- **Hₐ** carries the research question's direction: > if it asks about an increase, < for a decrease, ≠ if either direction matters or the question says "differs" or "changed".

Hypotheses are always about **parameters**, never statistics: we already know p̂, so there is nothing to test about it. And always define p in context: "p = the proportion of all students at the school who bike to school".

**Worked example (three sets of hypotheses).**

1. Last year 22% of a school's students biked to school. After new bike racks are installed, the principal wants to know whether the proportion has increased. H₀: p = 0.22, Hₐ: p > 0.22, where p = the proportion of all students at the school who now bike to school.
2. A game spinner is supposed to land on red half the time. A player wonders whether it is unfair. H₀: p = 0.5, Hₐ: p ≠ 0.5, where p = the long-run proportion of spins that land on red.
3. A seed packet says 85% of its seeds sprout. A gardener suspects the rate is lower. H₀: p = 0.85, Hₐ: p < 0.85, where p = the proportion of all seeds of this kind that sprout.

Choose the alternative **before** looking at the data. Picking a direction because the sample happened to fall that way halves the p-value dishonestly.

## Conditions and the test statistic (3.5)

The conditions mirror the interval's, with one change.

- **Random:** a random sample or a randomized experiment.
- **10%:** when sampling without replacement, n ≤ 10% of the population.
- **Large Counts:** np₀ ≥ 10 and n(1 − p₀) ≥ 10. A test **assumes H₀ is true**, so it uses the null value p₀, not p̂.

Under those conditions and assuming H₀, the sampling distribution of p̂ is approximately normal with mean p₀ and SD √(p₀(1 − p₀)/n). The test statistic measures how many standard deviations p̂ is from p₀:

> z = (p̂ − p₀) / √(p₀(1 − p₀)/n)

Every test statistic in this course has this shape: (statistic − null value) / (standard deviation of the statistic).

**Worked example (setting up a cafeteria test).** Last year 40% of the students at a hypothetical high school of 2,900 bought the school lunch. After a menu change, the cafeteria manager wants to know whether the proportion has increased. A simple random sample of 250 students finds that 117 buy the lunch.

1. **Procedure and hypotheses.** One-sample z-test for p. H₀: p = 0.40, Hₐ: p > 0.40, where p = the proportion of all students at the school who buy the school lunch after the menu change.
2. **Conditions.** Random: a simple random sample. 10%: 250 ≤ 10% of 2,900 = 290. Large Counts: 250(0.40) = 100 and 250(0.60) = 150 are both at least 10.
3. **Test statistic.** p̂ = 117/250 = 0.468. SD under H₀ = √(0.40 · 0.60 / 250) ≈ 0.0310. z = (0.468 − 0.40)/0.0310 ≈ 2.19.

The sample proportion is about 2.19 standard deviations above what H₀ predicts.

## p-values (3.6)

The **p-value** answers: if H₀ were true, how often would random sampling alone produce a result at least as extreme as ours? Extreme means "in the direction of Hₐ":

| Alternative | p-value |
|---|---|
| Hₐ: p > p₀ | P(Z ≥ z) |
| Hₐ: p < p₀ | P(Z ≤ z) |
| Hₐ: p ≠ p₀ | 2 · P(Z ≥ \|z\|) |

**Worked example (the cafeteria p-value).** For z ≈ 2.19 with Hₐ: p > 0.40, the p-value is P(Z ≥ 2.19) ≈ 0.014. (1-PropZTest with p₀ = 0.40, x = 117, n = 250 and "> p₀" gives z ≈ 2.19, p ≈ 0.0141.)

**Interpretation:** Assuming H₀ is true (p = 0.40), there is a 0.014 probability of getting a sample proportion of 0.468 or greater by chance alone in a random sample of 250 students.

That sentence has three required parts: the assumption that H₀ is true (with its value), the probability, and "a result at least as extreme as the one observed" in context and in the right direction.

**What a p-value means.** A small p-value says the observed result would be rare if H₀ were true, so the data are evidence against H₀ and for Hₐ. A large p-value says such a result is quite ordinary under H₀, so the data give no convincing evidence against it. A p-value is **not** the probability that H₀ is true, and it is not the probability that the result happened "by chance". It is calculated assuming H₀ is true, so it cannot also measure whether H₀ is true. A large p-value never proves H₀; it only says the data are consistent with it.

How small is small? A cut-off α, the **significance level**, is set before collecting data; 0.05 is common. Next week turns the comparison of the p-value with α into a decision and a conclusion.

**Worked example (a two-sided p-value).** A hypothetical district's board says it will move to a four-day school week only if the community is not evenly split. In a simple random sample of 180 of the district's many parents, 79 prefer the four-day week. Is the proportion different from 0.50?

1. H₀: p = 0.50, Hₐ: p ≠ 0.50, where p = the proportion of all parents in the district who prefer a four-day week.
2. Conditions: random sample; 180 is less than 10% of the district's parents; 180(0.5) = 90 and 90 are at least 10.
3. p̂ = 79/180 ≈ 0.439. z = (0.439 − 0.50)/√(0.25/180) ≈ −1.64.
4. Two-sided p-value = 2 · P(Z ≤ −1.64) ≈ 0.101.
5. Interpretation: assuming p = 0.50, there is a 0.101 probability of getting a sample proportion at least as far from 0.50 as 0.439 (in either direction) by chance alone. A result like ours is not unusual if parents are evenly split.

Had the board asked only whether *fewer* than half prefer the four-day week, the one-sided p-value would be 0.051, half as large. That is why the direction must come from the question, not the data.

## p-values from simulation

When the conditions fail, or as a check, a p-value can be estimated by simulation, exactly as in week 9. Simulate many samples **assuming H₀ is true**, and find the fraction of simulated statistics at least as extreme as the observed one.

**Worked example (simulated p-value).** A basketball player who made 70% of her free throws last season makes 34 of 40 (p̂ = 0.85) this preseason. Has she improved? H₀: p = 0.70, Hₐ: p > 0.70. A coach simulates 200 sets of 40 shots with a 70% success rate. The table shows how many shots were made in each simulated set.

| Shots made (of 40) | 22 or fewer | 23–24 | 25–26 | 27–28 | 29–30 | 31–32 | 33 | 34 or more |
|---|---|---|---|---|---|---|---|---|
| Simulated sets | 6 | 17 | 45 | 55 | 42 | 22 | 6 | 7 |

Making 34 or more of 40 is the same as p̂ ≥ 0.85, and 7 of the 200 simulated sets did that. Estimated p-value = 7/200 = 0.035. Assuming her true rate is still 70%, about 3.5% of sets of 40 shots would give 85% or better by chance alone. (The exact binomial value is P(X ≥ 34) ≈ 0.024, and Large Counts holds only barely: 40(0.30) = 12. A simulation of 200 sets is rough; more sets would bring the estimate closer to 0.024.)

## Common mistakes

- **Hypotheses about statistics.** "H₀: p̂ = 0.40" is wrong; write H₀: p = 0.40.
- **Using p̂ in the test's standard deviation or Large Counts check.** A test uses p₀ in both.
- **Choosing the direction after seeing the data.** The question decides one-sided or two-sided.
- **Forgetting to double for a two-sided test.**
- **"The p-value is the probability H₀ is true."** It is a probability about the data, computed assuming H₀.
- **"A large p-value proves H₀."** It means the data are consistent with H₀, nothing more.
- **Leaving out "assuming H₀ is true" in the interpretation.**

## Self-check

1. A website claims 30% of its visitors buy something. A manager thinks the real rate is lower. Write the hypotheses.
2. For question 1, a random sample of 200 visits has 48 purchases. Check Large Counts and find z.
3. Find the p-value for question 2 and interpret it.
4. z = 2.40 for a two-sided test. What is the p-value?
5. In a simulation of 500 samples assuming H₀, 12 gave a result at least as extreme as the observed one. Estimate the p-value.
6. A student writes, "The p-value is 0.30, so there is a 30% chance the null hypothesis is true." Correct the statement.

*Answers:* 1. H₀: p = 0.30, Hₐ: p < 0.30, where p = the proportion of all visits that end in a purchase. 2. 200(0.30) = 60 and 200(0.70) = 140 are at least 10; p̂ = 0.24, z = (0.24 − 0.30)/√(0.3 · 0.7 / 200) ≈ −1.85. 3. P(Z ≤ −1.85) ≈ 0.032: assuming 30% of all visits end in a purchase, there is about a 0.032 probability of a sample proportion of 0.24 or lower by chance alone. 4. 2 · P(Z ≥ 2.40) ≈ 0.016. 5. 12/500 = 0.024. 6. Assuming H₀ is true, there is a 0.30 probability of a result at least as extreme as the one observed by chance alone; the p-value says nothing about the probability that H₀ is true.

---

*Original study material for this course, organised around the College Board AP Statistics Course and Exam Description (Unit 3, Topics 3.5–3.6). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). All data are invented. AP® is a trademark of the College Board, which does not endorse this material.*
