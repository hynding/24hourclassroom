# Week 25 · Significance Tests for a Population Mean or Mean Difference

**Topics:** 4.4 Setting Up a Test for a Population Mean or Population Mean Difference · 4.5 Carrying Out a Test for a Population Mean or Population Mean Difference
**Practices:** 1 (Formulate Questions: turning a claim into hypotheses), 3 (Analyze Data), 4 (Interpret Results)
**Framework:** AP Statistics CED (effective fall 2026), Unit 4, Topics 4.4–4.5, learning objectives in our own words
**Spiral:** Weeks 17–18 set up and carried out tests for a proportion and named the two kinds of error; week 23 gave the t distributions; week 24 built t-intervals for μ and μ_diff. This week runs the same test logic with a mean: hypotheses, conditions, a t statistic, a p-value and a conclusion in context.

## What you need to be able to do

- **4.4** Choose between a one-sample t-test for μ and a paired t-test for μ_diff, and define the parameter in context.
- **4.4** Write H₀ and Hₐ about the parameter, choosing a one- or two-sided alternative from the question.
- **4.4** Check the Random, 10% and Normal/large sample conditions in context.
- **4.5** Compute t = (x̄ − μ₀)/(s/√n) with df = n − 1, and find the p-value for the alternative.
- **4.5** Interpret the p-value, decide at α, and state the conclusion with "convincing evidence" language and the right scope.
- **4.5** Connect a two-sided test with a confidence interval, and describe Type I and Type II errors and power for a mean.

## Key terms

| Term | Meaning |
|---|---|
| μ₀ | The null value: the claimed or baseline mean in H₀. |
| One-sample t-test | Tests H₀: μ = μ₀ with t = (x̄ − μ₀)/(s/√n), df = n − 1. |
| Paired t-test | Tests H₀: μ_diff = 0 with t = x̄_diff/(s_diff/√n_diff), df = pairs − 1. |
| One-sided alternative | Hₐ: μ > μ₀ or μ < μ₀; the p-value is one tail area. |
| Two-sided alternative | Hₐ: μ ≠ μ₀; the p-value is twice the tail area beyond \|t\|. |
| p-value | Assuming H₀ is true, the probability of a statistic at least as extreme as the one observed. |
| Significance level α | The cut-off for "convincing", and the probability of a Type I error. |
| Power | The probability of rejecting H₀ when a specific alternative is true. |

## Setting up a test for a mean (4.4)

**Which procedure?** Ask how the data were produced.

- One group of measurements compared with a fixed number (a label, a claim, last year's mean): **one-sample t-test for μ**.
- Two measurements linked within each individual or matched pair (before/after, left/right, twins): **paired t-test for μ_diff**. Compute differences first; everything else is a one-sample test on them, with μ₀ = 0.
- Two separate, unlinked groups: a two-sample procedure, which arrives in week 26–28. Do not use it for paired data.

**Hypotheses.** Always about the parameter, defined in context: "μ = the true mean wait time (minutes) in the lunch line on all school days this year." The null names the "no change" or claimed value; the alternative comes from the research question, decided before looking at the data.

| Question | Hₐ |
|---|---|
| "Is the wait longer than claimed?" | μ > 6 |
| "Is the battery life shorter than advertised?" | μ < 12 |
| "Is the mean fill different from 500 mL?" | μ ≠ 500 |
| "Does the exercise lower heart rate?" (before − after) | μ_diff > 0 |

The order of subtraction in μ_diff decides the sign: if you define the difference as after − before, a drop gives μ_diff < 0.

**Conditions** are the same three as for the interval: **Random** (random sample, or random assignment), **10%** (when sampling without replacement), and **Normal/large sample** (n ≥ 30, or a graph of the data, the differences for paired data, shows no strong skew or outliers). In an experiment that randomly assigns treatments to volunteers, there is no sampling, so the 10% condition does not apply; say so.

## Carrying out the test (4.5)

The test statistic counts standard errors between the sample result and the null value:

t = (x̄ − μ₀)/(s/√n), df = n − 1.

The p-value is the area under the t curve with n − 1 df in the direction of Hₐ (both tails for ≠). Then compare with α: reject H₀ if p-value < α, fail to reject otherwise, and state the conclusion about the parameter in context.

**Worked example 1: the speaker battery (one-sided).** A company advertises that its portable speaker plays 12 hours on a full charge. A consumer club suspects less. It tests a random sample of 15 speakers from a large shipment: x̄ = 11.4 hours, s = 1.1 hours, and a dotplot shows no strong skew or outliers. Use α = 0.05.

- **State:** H₀: μ = 12, Hₐ: μ < 12, where μ = the true mean battery life (hours) of all speakers in the shipment. One-sample t-test for μ.
- **Plan:** Random: a random sample of speakers. 10%: 15 is far less than 10% of a large shipment. Normal: n = 15 < 30, but the dotplot shows no strong skew or outliers.
- **Do:** t = (11.4 − 12)/(1.1/√15) = −0.6/0.284 ≈ −2.11, df = 14. p-value = P(t < −2.11) ≈ 0.027.
- **Conclude:** Because p-value ≈ 0.027 < α = 0.05, we reject H₀. There is convincing evidence that the true mean battery life of the speakers in the shipment is less than 12 hours.

**Interpreting that p-value:** assuming the true mean battery life is 12 hours, there is about a 0.027 probability of getting a sample mean of 11.4 hours or less in a random sample of 15 speakers by chance alone. It is **not** the probability that the advertisement is true.

**Worked example 2: the water bottles (two-sided, with an interval).** A filling machine is set to 500 mL. An inspector selects a random sample of 40 bottles from a day's run of 20,000: x̄ = 498.7 mL, s = 3.6 mL. Is the mean fill off target, in either direction? α = 0.05.

- **State:** H₀: μ = 500, Hₐ: μ ≠ 500, μ = the true mean fill (mL) of all bottles in the day's run. One-sample t-test.
- **Plan:** Random sample; 40 ≤ 10% of 20,000; n = 40 ≥ 30, so the Normal/large sample condition holds.
- **Do:** t = (498.7 − 500)/(3.6/√40) ≈ −2.28, df = 39. p-value = 2 · P(t < −2.28) ≈ 0.028.
- **Conclude:** Because 0.028 < 0.05, we reject H₀. There is convincing evidence that the true mean fill differs from 500 mL.

The matching 95% t-interval is 498.7 ± 2.023 · 3.6/√40, from **497.55 to 499.85 mL**. 500 lies outside it, which agrees with the test, and the interval adds what the test cannot: the machine is underfilling by between about 0.15 and 2.45 mL on average. That is the general rule: **a two-sided test at α rejects H₀: μ = μ₀ exactly when μ₀ falls outside the (1 − α) confidence interval**. A small but significant difference may still be unimportant in practice; the interval shows its size.

**Worked example 3: heart rate (paired).** A health class randomly selects 12 students from the school. Each records resting heart rate (beats per minute), does 10 minutes of slow breathing, and records it again. Does the exercise lower heart rate on average? α = 0.05.

| Student | 1 | 2 | 3 | 4 | 5 | 6 | 7 | 8 | 9 | 10 | 11 | 12 |
|---|---|---|---|---|---|---|---|---|---|---|---|---|
| Before | 78 | 85 | 72 | 90 | 68 | 81 | 76 | 88 | 74 | 83 | 70 | 79 |
| After | 74 | 80 | 73 | 84 | 65 | 79 | 71 | 85 | 72 | 77 | 69 | 75 |
| Before − after | 4 | 5 | −1 | 6 | 3 | 2 | 5 | 3 | 2 | 6 | 1 | 4 |

- **State:** H₀: μ_diff = 0, Hₐ: μ_diff > 0, where μ_diff = the true mean difference (before − after) in resting heart rate for all students at the school. Paired t-test.
- **Plan:** Random: a random sample of students. 10%: 12 is less than 10% of the school. Normal: n = 12 < 30; the differences (−1 to 6) show no strong skew or outliers.
- **Do:** x̄_diff ≈ 3.33, s_diff ≈ 2.10. t = 3.33/(2.10/√12) ≈ 5.49, df = 11. p-value = P(t > 5.49) ≈ 0.0001.
- **Conclude:** Because the p-value is far below 0.05, we reject H₀. There is convincing evidence that the true mean resting heart rate of the school's students is lower after the breathing exercise than before.

**Scope.** This was a random sample, so the conclusion applies to the school's students. But no treatment was randomly assigned and there was no control group: heart rate might drop just from sitting still for 10 minutes. We cannot say the breathing exercise caused the drop. A better design would randomly assign students to slow breathing or quiet sitting, or randomly order the two within each student.

## Errors and power for a mean (4.5)

The two errors from week 18 carry over unchanged.

- **Type I error:** rejecting a true H₀. For the speakers: concluding the mean battery life is below 12 hours when it really is 12. Its probability is α.
- **Type II error:** failing to reject a false H₀. For the speakers: not finding convincing evidence of a shortfall when the mean really is below 12.

**Power**, the probability of correctly rejecting a false H₀, rises with a larger sample, a larger α, a true mean farther from μ₀, and less variable data. Lowering α to guard against Type I errors makes Type II errors more likely, so choose α by asking which error is worse in context.

## Common mistakes

- **Writing hypotheses with x̄**, or using the sample value as μ₀.
- **Choosing the alternative after seeing the data.** The question sets the direction.
- **Doubling a one-sided p-value**, or forgetting to double a two-sided one.
- **Running a two-sample test on paired data**, or checking Normal on the raw measurements instead of the differences.
- **"Accepting H₀" or "proving Hₐ".** Say "reject" or "fail to reject", then "convincing evidence" or "not convincing evidence".
- **Claiming cause without random assignment**, or generalising beyond the population that was randomly sampled.

## Self-check

1. A juice label says 250 mL. A random sample of 12 cartons gives x̄ = 252.3, s = 4.1, no strong skew. Test whether the mean is more than 250 at α = 0.05.
2. Which procedure: each of 25 drivers' reaction time is measured sober and after a sleepless night?
3. A two-sided t-test at α = 0.05 rejects H₀: μ = 80. Will 80 be inside the 95% t-interval?
4. A test gives p-value = 0.21. Write the conclusion for Hₐ: μ < 30, with μ = mean minutes of exercise per day for a town's adults.
5. Describe a Type II error for question 1.
6. Give two ways to increase the power of the test in question 1.

*Answers:* 1. t = (252.3 − 250)/(4.1/√12) ≈ 1.94, df = 11, p-value ≈ 0.039 < 0.05: reject H₀; convincing evidence that the true mean volume is more than 250 mL. 2. A paired t-test (or interval) for μ_diff. 3. No; it will be outside. 4. Because 0.21 > α, we fail to reject H₀; there is not convincing evidence that the true mean daily exercise of the town's adults is less than 30 minutes. 5. Failing to find convincing evidence that the mean exceeds 250 mL when it really does. 6. Sample more cartons; use a larger α (or the true mean being farther from 250).

---

*Original study material for this course, organised around the College Board AP Statistics Course and Exam Description (Unit 4, Topics 4.4–4.5). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). All data are invented. AP® is a trademark of the College Board, which does not endorse this material.*
