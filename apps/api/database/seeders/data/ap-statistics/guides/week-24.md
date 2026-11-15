# Week 24 · Confidence Intervals for a Population Mean or Mean Difference

**Topics:** 4.2 Constructing a Confidence Interval for a Population Mean or Population Mean Difference · 4.3 Justifying a Claim Based on a Confidence Interval for a Population Mean or Population Mean Difference
**Practices:** 3 (Analyze Data), 4 (Interpret Results), 2 (Collect Data: recognising paired designs)
**Framework:** AP Statistics CED (effective fall 2026), Unit 4, Topics 4.2–4.3, learning objectives in our own words
**Spiral:** Week 23 described the sampling distribution of x̄ and introduced the t distributions; weeks 16 and 20 built and used confidence intervals for proportions; week 7 designed matched-pairs experiments. This week puts them together: the first inference procedures for a mean.

## What you need to be able to do

- **4.2** Identify when a one-sample t-interval for μ or a paired t-interval for μ_diff is the right procedure, and define the parameter in context.
- **4.2** Check the Random, 10% and Normal/large sample conditions in context (on the differences, for paired data).
- **4.2** Compute x̄ ± t* · s/√n with df = n − 1, by hand from summary statistics or from raw data.
- **4.2** Interpret the interval and the confidence level, and explain how confidence level and sample size affect the margin of error.
- **4.3** Use an interval to judge a claim about μ or μ_diff, with "plausible" and "convincing evidence" language and the right scope.

## Key terms

| Term | Meaning |
|---|---|
| One-sample t-interval for μ | x̄ ± t* · s/√n, df = n − 1. |
| Paired data | Two measurements linked by individual or matched pair; analysed through the differences. |
| μ_diff | The true mean of the differences in the population (or for the treatment), in a stated order. |
| Paired t-interval for μ_diff | x̄_diff ± t* · s_diff/√n_diff, df = (number of pairs) − 1. |
| t* | The t critical value with the chosen confidence level's central area and n − 1 df. |
| Margin of error | t* · s/√n: half the width of the interval. |
| Plausible value | A value inside the interval. |

## Constructing a t-interval for a mean (4.2)

Every confidence interval has the shape **statistic ± (critical value) · (standard error)**. For a mean:

x̄ ± t* · s/√n, with df = n − 1.

**The four steps** (the same as for proportions):

1. **State.** Name the procedure and define the parameter: "a one-sample t-interval for μ = the true mean … of all …", with the confidence level.
2. **Plan.** Check the conditions, each in context:
   - **Random**: a random sample from the population (or random assignment in an experiment).
   - **10%**: when sampling without replacement, n ≤ 10% of the population.
   - **Normal/large sample**: n ≥ 30, or, for smaller samples, a graph of the data shows no strong skew and no outliers. Say what the graph shows; do not just write "it is normal".
3. **Do.** Find t* (invT on a calculator, or a t table) and compute the interval.
4. **Conclude.** Interpret the interval in context.

**Worked example 1: granola bars.** A bakery quality-control student selects a random sample of 20 granola bars from a batch of 2,000. The sugar contents have x̄ = 11.6 g and s = 1.9 g, and a dotplot shows no strong skew or outliers. Build a 95% interval for the mean sugar content of all bars in the batch.

- **State:** one-sample t-interval for μ = the true mean sugar content (grams) of all 2,000 bars in the batch, 95% confidence.
- **Plan:** Random: a random sample of bars. 10%: 20 ≤ 10% of 2,000 = 200. Normal: n = 20 < 30, but the dotplot shows no strong skew or outliers.
- **Do:** df = 19, t* = 2.093. SE = 1.9/√20 ≈ 0.425. Margin of error = 2.093 · 0.425 ≈ 0.89. Interval: 11.6 ± 0.89, from **10.71 to 12.49 grams**.
- **Conclude:** We are 95% confident that the interval from 10.71 to 12.49 grams captures the true mean sugar content of all bars in the batch.

**What changes the margin of error.** The same data at 99% confidence use t* = 2.861, giving 11.6 ± 1.22, from 10.38 to 12.82 grams: more confidence, wider interval. A random sample of 80 bars with the same x̄ and s (df = 79, t* = 1.990) gives 11.6 ± 0.42, from 11.18 to 12.02 grams: four times the data, about half the margin. A larger s widens the interval; you cannot control s, but you can control n and the confidence level.

| Version | t* | Margin of error | Interval |
|---|---|---|---|
| n = 20, 95% | 2.093 | 0.89 | 10.71 to 12.49 |
| n = 20, 99% | 2.861 | 1.22 | 10.38 to 12.82 |
| n = 80, 95% | 1.990 | 0.42 | 11.18 to 12.02 |

**Interpreting the confidence level.** "95% confident" refers to the method: if we took many random samples of 20 bars and built a 95% t-interval from each, about 95% of the intervals would capture the true mean. It is not a 95% probability that μ lies in this particular interval, and it says nothing about where 95% of individual bars fall.

## Paired data and the paired t-interval (4.2)

Data are **paired** when each observation in one set is linked to exactly one in the other: the same student measured before and after, the same runner in two shoes, twins split between treatments. The pairing comes from the design (week 7's matched pairs), so look for it in how the data were collected, not in the numbers.

With paired data, compute the **difference for each pair** and then do a one-sample t-interval on the differences. The parameter is μ_diff, the true mean difference, and you must state the order of subtraction. All the conditions are checked on the differences, and df = number of pairs − 1.

Why bother? Pairing removes person-to-person variation. Fast typists are fast on both devices; looking at each student's own difference cancels that out and leaves a much smaller standard deviation, so the interval is far narrower than a (wrong) two-sample analysis would give.

**Worked example 2: typing speed.** A computer-science teacher randomly selects 10 students from the school and measures each one's typing speed (words per minute) on a physical keyboard and on a phone, in a random order.

| Student | 1 | 2 | 3 | 4 | 5 | 6 | 7 | 8 | 9 | 10 |
|---|---|---|---|---|---|---|---|---|---|---|
| Keyboard | 62 | 55 | 71 | 48 | 66 | 59 | 74 | 52 | 68 | 60 |
| Phone | 41 | 40 | 50 | 37 | 43 | 45 | 49 | 39 | 47 | 44 |
| Difference | 21 | 15 | 21 | 11 | 23 | 14 | 25 | 13 | 21 | 16 |

- **State:** paired t-interval for μ_diff = the true mean difference (keyboard − phone) in typing speed for all students at the school, 90% confidence.
- **Plan:** Random: a random sample of students (and random order of devices). 10%: 10 students is less than 10% of the school. Normal: n = 10 < 30; the differences (11 to 25) show no strong skew or outliers.
- **Do:** x̄_diff = 18.0, s_diff ≈ 4.76, df = 9, t* = 1.833. Margin = 1.833 · 4.76/√10 ≈ 2.76. Interval: from **15.24 to 20.76 words per minute**.
- **Conclude:** We are 90% confident that the interval from 15.24 to 20.76 words per minute captures the true mean difference (keyboard − phone) in typing speed for all students at the school.

Notice that the keyboard speeds alone have a standard deviation of about 8.4 wpm, but the differences only 4.8: that is the pairing at work.

## Justifying a claim with an interval (4.3)

An interval lists the **plausible values** of the parameter. To judge a claim:

- If the claimed value is **outside** the interval, it is not plausible: there is convincing evidence that the parameter differs from it, in the direction the interval shows.
- If the claimed value is **inside**, it is plausible: there is **no convincing evidence** against it. That is not proof; every other value in the interval is plausible too.
- For μ_diff, the key question is usually whether **0** is inside. An interval entirely above (or below) 0 is convincing evidence of a mean difference in that direction.

**Worked example 3: the label.** The granola wrapper says each bar has 12 grams of sugar. The 95% interval is 10.71 to 12.49 grams. Since 12 is inside, the label's value is plausible, and the sample gives no convincing evidence that the true mean differs from 12 g. A competitor's claim that the bars average 13 g is a different story: 13 is above the whole interval, so there is convincing evidence that the mean is less than 13 g.

**Worked example 4: the typing gap.** A phone maker claims that, with its new keyboard app, students type "within 10 words per minute" of a physical keyboard on average. The 90% interval for μ_diff is 15.24 to 20.76. Every plausible value exceeds 10, so there is convincing evidence that the mean gap is more than 10 words per minute: the claim is not supported. The interval also lies entirely above 0, so there is convincing evidence that students type faster on a keyboard on average.

**Scope.** Both studies used random samples, so the conclusions apply to the populations sampled (the batch; the school's students). When pairs come from an experiment with random assignment (of treatment order, or of treatments within matched pairs) but not a random sample, a difference can be attributed to the treatment, but only for subjects like those in the study.

## Common mistakes

- **Using z* instead of t*.** With s, use t with df = n − 1, even when n ≥ 30.
- **Dividing by √(n − 1) or forgetting √n.** The standard error is s/√n.
- **Treating paired data as two independent samples**, or checking the Normal condition on the original measurements instead of the differences.
- **Forgetting the order of subtraction** in μ_diff, then misreading the sign of the interval.
- **Interpreting the interval as covering individual values**, or the confidence level as a probability about μ.
- **"The interval contains the claim, so the claim is true."** It is only plausible.

## Self-check

1. A random sample of 16 delivery drivers averages x̄ = 38.5 miles per shift with s = 6.4. Find t* and the 95% interval.
2. In question 1, a company says drivers average 35 miles. Judge the claim.
3. Name the procedure: the same 22 patients have blood pressure measured before and after a month of a low-salt diet.
4. A 95% paired interval for μ_diff (after − before) is −3.1 to 1.4. What does it say?
5. What happens to the margin of error if n goes from 25 to 100 with s unchanged?
6. Why must the Normal condition for a paired interval be checked on the differences?

*Answers:* 1. df = 15, t* = 2.131; 38.5 ± 2.131 · 6.4/4 = 38.5 ± 3.41, from 35.09 to 41.91 miles. 2. 35 is below the interval, so there is convincing evidence that the mean is more than 35 miles. 3. A paired t-interval (or test) for μ_diff. 4. 0 is plausible, so there is no convincing evidence of a mean change. 5. It is roughly halved (and t* shrinks slightly). 6. The procedure analyses only the differences, so their distribution is what must be roughly normal (or n_diff ≥ 30).

---

*Original study material for this course, organised around the College Board AP Statistics Course and Exam Description (Unit 4, Topics 4.2–4.3). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). All data are invented. AP® is a trademark of the College Board, which does not endorse this material.*
