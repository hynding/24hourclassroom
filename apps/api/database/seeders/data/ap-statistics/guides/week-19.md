# Week 19 · Comparing Two Proportions: Sampling Distributions and Confidence Intervals

**Topics:** 3.9 Sampling Distributions for the Difference Between Sample Proportions · 3.10 Constructing a Confidence Interval for the Difference Between Two Population Proportions
**Practices:** 2 (Collect Data), 3 (Analyze Data), 4 (Interpret Results)
**Framework:** AP Statistics CED (effective fall 2026), Unit 3, Topics 3.9–3.10, learning objectives in our own words
**Spiral:** Weeks 15 and 16 built the sampling distribution of one sample proportion p̂ and the one-sample z-interval for p. Weeks 17 and 18 set up and carried out tests for one proportion and named the errors a test can make. This week everything doubles: two populations (or two treatments), two samples, and one parameter that compares them, p₁ − p₂.

## What you need to be able to do

- **3.9** Describe the sampling distribution of p̂₁ − p̂₂: its center p₁ − p₂, its standard deviation √(p₁(1 − p₁)/n₁ + p₂(1 − p₂)/n₂), and when it is approximately normal.
- **3.9** Use that distribution to find the probability that the difference in sample proportions falls in a given range.
- **3.10** Identify when a two-sample z-interval for p₁ − p₂ is the right procedure, and check its conditions in context.
- **3.10** Compute the interval (point estimate ± z* · SE), interpret it, and interpret the confidence level.
- **3.10** Explain how the sample sizes and the confidence level change the margin of error.

## Key terms

| Term | Meaning |
|---|---|
| p₁ − p₂ | The parameter: the difference between two population (or true treatment) proportions. Always state the order of subtraction. |
| p̂₁ − p̂₂ | The statistic: the difference between the two sample proportions; the point estimate of p₁ − p₂. |
| Independent samples | Two samples chosen separately, or two groups formed by random assignment, so that knowing one tells you nothing about the other. |
| SD(p̂₁ − p̂₂) | √(p₁(1 − p₁)/n₁ + p₂(1 − p₂)/n₂), computed from the population proportions. |
| SE(p̂₁ − p̂₂) | √(p̂₁(1 − p̂₁)/n₁ + p̂₂(1 − p̂₂)/n₂), the estimate of that SD from the samples, used in the interval. |
| Two-sample z-interval for p₁ − p₂ | (p̂₁ − p̂₂) ± z* · SE(p̂₁ − p̂₂). |
| Margin of error | z* · SE: the most the point estimate is likely to miss the parameter by, at the stated confidence level. |

## The sampling distribution of p̂₁ − p̂₂ (3.9)

Take a random sample of size n₁ from population 1 and an independent random sample of size n₂ from population 2, compute each sample proportion, and subtract. Repeat this many times and the differences p̂₁ − p̂₂ form a distribution with three features you must be able to name.

- **Center.** The mean of the sampling distribution of p̂₁ − p̂₂ is p₁ − p₂. The statistic is an unbiased estimator of the parameter, just as p̂ was for p in week 15.
- **Spread.** The standard deviation is √(p₁(1 − p₁)/n₁ + p₂(1 − p₂)/n₂). Notice what is inside the square root: the two quantities you squared-and-divided for each sample separately are **added**, then one square root is taken. You do not add the two standard deviations. (The formula is on the AP formula sheet; you only need to use it.) The 10% condition, n₁ ≤ 10% of population 1 and n₂ ≤ 10% of population 2, is what makes this formula accurate when sampling without replacement.
- **Shape.** The distribution is approximately normal when all four expected counts are large: n₁p₁, n₁(1 − p₁), n₂p₂ and n₂(1 − p₂) are each at least 10.

Even when p₁ − p₂ is positive, an individual sample can produce a negative difference, because each p̂ varies from sample to sample. Questions in 3.9 ask how likely that is.

**Worked example 1 (a probability about p̂₁ − p̂₂).** In a hypothetical school district, 55% of all students at North High and 45% of all students at South High usually buy the school lunch. A reporter for the district newsletter takes a random sample of 120 North students and an independent random sample of 100 South students. Each school has more than 1,500 students. What is the probability that the North sample proportion is *smaller* than the South one?

1. Center: p_N − p_S = 0.55 − 0.45 = 0.10.
2. Spread: √(0.55 · 0.45/120 + 0.45 · 0.55/100) = √(0.0020625 + 0.0024750) = √0.0045375 ≈ 0.0674. The 10% condition holds: 120 is less than 10% of North's students and 100 is less than 10% of South's.
3. Shape: 120(0.55) = 66, 120(0.45) = 54, 100(0.45) = 45 and 100(0.55) = 55 are all at least 10, so the distribution is approximately normal.
4. "North smaller than South" means p̂_N − p̂_S < 0. z = (0 − 0.10)/0.0674 ≈ −1.48, and P(Z < −1.48) ≈ 0.069.

About 7% of such pairs of samples would put North behind South, even though North's true proportion is 10 percentage points higher. That is sampling variability, and it is the reason we need inference to compare groups.

## The two-sample z-interval for p₁ − p₂ (3.10)

When the population proportions are unknown (the usual case), we estimate their difference. The interval has the same shape as every confidence interval in this course:

**point estimate ± (critical value) · (standard error of the estimate)**, that is, (p̂₁ − p̂₂) ± z* · √(p̂₁(1 − p̂₁)/n₁ + p̂₂(1 − p̂₂)/n₂).

The critical values are the same as for one proportion: z* = 1.645 for 90%, 1.960 for 95%, 2.576 for 99%.

**When to use it.** The response is categorical (success or failure), and there are two groups to compare: two independent random samples from two populations, or two treatment groups formed by random assignment in an experiment. A paired design or one sample with two questions is something else.

**Conditions, each checked in context.**

- **Random:** two independent random samples, or random assignment of subjects to two treatments.
- **10%:** when sampling without replacement, n₁ ≤ 10% of population 1 and n₂ ≤ 10% of population 2. (Not needed for an experiment with random assignment, where no one is sampled from a population.)
- **Large Counts:** n₁p̂₁, n₁(1 − p̂₁), n₂p̂₂ and n₂(1 − p̂₂) are all at least 10; that is, at least 10 successes and 10 failures in each sample.

**The four-step write-up.** State (procedure, parameter in context with the order of subtraction, confidence level); Plan (conditions); Do (the arithmetic); Conclude (the interpretation in context).

**Worked example 2 (two random samples).** A large hypothetical school district surveys a random sample of 150 of its ninth graders and an independent random sample of 140 of its twelfth graders; each grade has more than 2,000 students. 63 of the ninth graders and 35 of the twelfth graders say they usually sleep at least 8 hours on school nights. Construct and interpret a 95% confidence interval for the difference.

- **State.** A two-sample z-interval for p₉ − p₁₂, where p₉ is the proportion of all ninth graders in the district who usually sleep at least 8 hours on school nights and p₁₂ the same proportion for all twelfth graders; 95% confidence.
- **Plan.** Random: two independent random samples. 10%: 150 < 10% of more than 2,000 ninth graders, 140 < 10% of more than 2,000 twelfth graders. Large Counts: 63, 87, 35 and 105 are all at least 10.
- **Do.** p̂₉ = 63/150 = 0.42 and p̂₁₂ = 35/140 = 0.25, so the point estimate is 0.17. SE = √(0.42 · 0.58/150 + 0.25 · 0.75/140) ≈ 0.0544. Margin of error 1.96 · 0.0544 ≈ 0.107. Interval: 0.17 ± 0.107, from **0.063 to 0.277**.
- **Conclude.** We are 95% confident that the interval from 0.063 to 0.277 captures the true difference (ninth graders minus twelfth graders) in the proportions of all students in the district who usually sleep at least 8 hours on school nights.

Because the interval was built from p₉ − p₁₂ and both ends are positive, the plausible values all say ninth graders sleep 8 hours more often; week 20 turns that observation into a claim. Had you subtracted the other way, the interval would be (−0.277, −0.063): the same information with the signs flipped.

**Worked example 3 (an experiment).** A school's gardening club tests whether soaking bean seeds overnight helps them sprout. It randomly assigns 100 seeds to be soaked and 100 to be planted dry; 80 soaked seeds and 66 dry seeds sprout within ten days. Construct a 90% confidence interval for p_soak − p_dry, the difference in the true sprouting proportions for seeds like these.

- Random: the seeds were randomly assigned to the treatments. The 10% condition does not apply: nothing was sampled from a population. Large Counts: 80, 20, 66 and 34 are all at least 10.
- p̂_soak = 0.80, p̂_dry = 0.66, difference 0.14. SE = √(0.80 · 0.20/100 + 0.66 · 0.34/100) = √0.003844 = 0.062. Margin of error 1.645 · 0.062 ≈ 0.102. Interval: **0.038 to 0.242**.
- We are 90% confident that the interval from 0.038 to 0.242 captures the true difference in sprouting proportions (soaked minus dry) for seeds like these. Because the treatments were randomly assigned, a difference here can be attributed to soaking; because the seeds were not a random sample of all bean seeds, we should be cautious about generalising beyond seeds like these.

**Interpreting the confidence level.** "90% confidence" describes the method: if the club repeated the random assignment many times and built an interval each time, about 90% of those intervals would capture the true difference p_soak − p_dry. It is **not** a 90% probability that this particular interval contains the parameter; once computed, an interval either captures it or does not.

**Worked example 4 (what moves the margin of error).** In worked example 2, suppose the district had sampled 600 ninth graders and 560 twelfth graders (four times as many) and got the same sample proportions. Each term under the square root is divided by 4, so the SE is divided by √4 = 2: SE ≈ 0.0272, margin of error ≈ 0.053, interval 0.17 ± 0.053. Quadrupling the sample sizes halves the margin of error. Raising the confidence level does the opposite: at 99%, z* = 2.576 and the original margin of error grows to 2.576 · 0.0544 ≈ 0.140. More confidence costs width; more data buys precision.

## Common mistakes

- **No order of subtraction.** "The difference in proportions" is not a parameter until you say which minus which. Keep the same order in the point estimate, the interval and the conclusion.
- **Adding the standard deviations.** SD(p̂₁ − p̂₂) adds the two p(1 − p)/n terms under one square root; it is smaller than SD(p̂₁) + SD(p̂₂).
- **Subtracting variances.** Even though we subtract the proportions, the terms under the square root are added: both samples contribute variability.
- **Checking Large Counts with the total only.** All four counts (successes and failures in each sample) must be at least 10.
- **Applying the 10% condition to an experiment.** With random assignment there is no population being sampled; say so instead.
- **Interpreting 95% as a probability about the parameter**, or as "95% of students are in the interval". The interval is about a difference in population proportions.
- **Interpreting the interval for the samples.** We already know p̂₁ − p̂₂ exactly; the interval is about p₁ − p₂.

## Self-check

1. In a hypothetical town, 30% of all adults in the east district and 22% of all adults in the west district have a library card. For random samples of 200 from each district, what are the mean and SD of p̂_E − p̂_W?
2. Is the sampling distribution in question 1 approximately normal? Show the check.
3. 45 of 90 randomly chosen customers at one branch of a bike shop and 30 of 80 at another buy a helmet with a bike. Give the point estimate and the 99% margin of error for p₁ − p₂.
4. A 95% interval for p_A − p_B is (−0.12, 0.04). What is the interval for p_B − p_A?
5. Why is the 10% condition not checked in worked example 3?

*Answers:* 1. Mean 0.08; SD = √(0.30 · 0.70/200 + 0.22 · 0.78/200) ≈ 0.0436. 2. Yes: 60, 140, 44 and 156 are all at least 10. 3. 0.500 − 0.375 = 0.125; SE ≈ 0.0755, margin of error 2.576 · 0.0755 ≈ 0.195. 4. (−0.04, 0.12). 5. The seeds were randomly assigned to treatments, not sampled from a population, so there is no population for the sample to be 10% of.

---

*Original study material for this course, organised around the College Board AP Statistics Course and Exam Description (Unit 3, Topics 3.9–3.10). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). All data are invented. AP® is a trademark of the College Board, which does not endorse this material.*
