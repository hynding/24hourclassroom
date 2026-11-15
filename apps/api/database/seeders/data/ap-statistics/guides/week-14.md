# Week 14 · Sampling Distributions and the Central Limit Theorem

**Topics:** 2.12 Sampling Distributions and the Central Limit Theorem
**Practices:** 3 (Analyze Data), 4 (Interpret Results), 2 (Collect Data)
**Framework:** AP Statistics CED (effective fall 2026), Unit 2, Topic 2.12, learning objectives in our own words
**Spiral:** Unit 1 drew random samples and warned that different samples give different results. Week 9 used simulation to estimate probabilities; week 12 counted successes with the binomial distribution; week 13 computed areas under normal curves. This week ties them together: a statistic computed from a random sample is itself a random variable, its distribution can be simulated or described by formulas, and very often it is approximately normal. Unit 3 (proportions) and Unit 4 (means) build every interval and test on this week's ideas.

## What you need to be able to do

- **2.12** Tell a parameter from a statistic, and a population distribution, the distribution of one sample's data and a sampling distribution apart.
- **2.12** Describe a sampling distribution (simulated or theoretical) by shape, centre and variability, and explain what it means for a statistic to be unbiased.
- **2.12** State the mean and standard deviation of the sampling distribution of a sample proportion p̂ and of a sample mean x̄, checking the 10% condition.
- **2.12** Decide when the sampling distribution of p̂ is approximately normal (Large Counts: np ≥ 10 and n(1 − p) ≥ 10) and when that of x̄ is (a normal population, or the Central Limit Theorem with n ≥ 30).
- **2.12** Use a normal sampling distribution to find the probability that a statistic falls in a given range, and explain how sample size affects variability.

## Key terms

| Term | Meaning |
|---|---|
| Parameter | A number describing a population: p, μ, σ. Usually unknown. |
| Statistic | A number computed from a sample: p̂, x̄, s. It varies from sample to sample. |
| Sampling variability | The fact that different random samples of the same size give different values of a statistic. |
| Sampling distribution | The distribution of a statistic over all possible random samples of the same size from the same population. |
| Unbiased estimator | A statistic whose sampling distribution is centred at the parameter it estimates. |
| Standard deviation of a statistic | The typical distance between the statistic and its mean, across many samples; for p̂ it is written SD(p̂). |
| Central Limit Theorem (CLT) | For random samples of a large enough size n from any population with a finite standard deviation, the sampling distribution of x̄ is approximately normal. |

## Three distributions, one picture (2.12)

Students lose most points here by mixing up three different distributions.

1. **The population distribution:** the values of the variable for every individual in the population. It has the parameters (μ and σ, or p).
2. **The distribution of the sample data:** the values for the n individuals in one sample. It looks roughly like the population (a skewed population gives a skewed sample), and it has the statistics x̄ and s, or p̂.
3. **The sampling distribution:** the values of a statistic (x̄ or p̂) from many, many samples of size n. This is the one that becomes less variable, and more normal, as n grows.

**Worked example (simulating a sampling distribution).** In a hypothetical school district of 9,000 students, 40% of students bike or walk to school, so p = 0.40 (a parameter). A computer takes 1,000 random samples of 50 students and records p̂, the proportion who bike or walk, for each one. A summary of the 1,000 values of p̂:

| Mean of the p̂ values | SD of the p̂ values | Smallest | Largest | Shape |
|---|---|---|---|---|
| 0.401 | 0.068 | 0.22 | 0.62 | single-peaked, roughly symmetric |

The p̂ values centre very close to 0.40, the parameter: p̂ is an **unbiased estimator** of p. A single sample can still miss by a lot (some samples gave 0.22 or 0.62), which is sampling variability. If the samples had 200 students each, the values would still centre at 0.40 but cluster much more tightly. Bias is about the centre; variability is about the spread. Larger random samples reduce variability; they do not fix bias from a poor sampling method.

## The sampling distribution of a sample proportion (2.12)

For random samples of size n from a population with proportion p:

- **Centre:** the mean of the sampling distribution of p̂ is p.
- **Variability:** SD(p̂) = √(p(1 − p)/n), valid when n ≤ 10% of the population (10% condition).
- **Shape:** approximately normal when np ≥ 10 and n(1 − p) ≥ 10 (Large Counts condition).

The formula comes from week 12: the count of successes X is binomial with SD √(np(1 − p)), and p̂ = X/n, so dividing by n gives √(p(1 − p)/n).

**Worked example (a probability about p̂).** For the district above (p = 0.40) and a random sample of n = 50, what is the probability that at least half of the sample bikes or walks?

- 10% condition: 50 ≤ 0.10(9,000) = 900, so SD(p̂) = √(0.40 · 0.60/50) = 0.0693.
- Large Counts: np = 50(0.40) = 20 ≥ 10 and n(1 − p) = 30 ≥ 10, so the sampling distribution of p̂ is approximately normal.
- z = (0.50 − 0.40)/0.0693 = 1.44, so P(p̂ ≥ 0.50) ≈ 0.074.

About 7% of random samples of 50 students would have half or more biking or walking, even though only 40% of the district does. With n = 200, SD(p̂) = 0.0346, z = 2.89 and the probability falls to about 0.002. A sample four times as large halves the standard deviation, because n sits under a square root.

## The sampling distribution of a sample mean (2.12)

For random samples of size n from a population with mean μ and standard deviation σ:

- **Centre:** the mean of the sampling distribution of x̄ is μ, so x̄ is an unbiased estimator of μ.
- **Variability:** SD(x̄) = σ/√n, valid when n ≤ 10% of the population.
- **Shape:** if the population is normal, the sampling distribution of x̄ is normal for every n. If the population is not normal, the **Central Limit Theorem** says the sampling distribution of x̄ becomes approximately normal as n grows; n ≥ 30 is the usual guide. The more skewed the population, the larger n needs to be.

**Worked example (a normal population).** Battery life for a hypothetical phone model is N(18.5, 2.4) hours. For a random sample of 9 phones, find the probability that the sample mean battery life is less than 17.5 hours.

The population is normal, so x̄ is normal even with n = 9, with mean 18.5 and SD(x̄) = 2.4/√9 = 0.8 hours (9 phones is far below 10% of all phones made). z = (17.5 − 18.5)/0.8 = −1.25, so P(x̄ < 17.5) ≈ 0.106. For comparison, a single phone lasts less than 17.5 hours with probability 0.338: an average of 9 phones is much less variable than one phone.

**Worked example (the CLT with a skewed population).** Delivery times for a hypothetical pizza shop are strongly skewed right, with mean 32 minutes and standard deviation 9 minutes. A manager looks at a random sample of 40 deliveries from the thousands made this year. What is the probability that the sample mean delivery time is more than 35 minutes?

- 10% condition: 40 deliveries is less than 10% of all deliveries, so SD(x̄) = 9/√40 = 1.42 minutes.
- Shape: the population is skewed, but n = 40 ≥ 30, so by the CLT the sampling distribution of x̄ is approximately normal, with mean 32.
- z = (35 − 32)/1.42 = 2.11, so P(x̄ > 35) ≈ 0.018.

A mean above 35 minutes would happen in fewer than 2% of samples if the shop's true mean is still 32. That kind of reasoning is exactly what a significance test formalises in Unit 3. Note what you **cannot** do: find the probability that one delivery takes more than 35 minutes with a normal model, because individual times are skewed. The CLT is about x̄, not about individual values.

## Sample size and variability (2.12)

Because SD(p̂) and SD(x̄) both have √n in the denominator:

- doubling n divides the SD by √2 ≈ 1.41, not by 2;
- quadrupling n halves the SD;
- to reach a target SD, solve for n. For delivery times (σ = 9), an SD(x̄) of 1 minute needs √n = 9, so n = 81.

The size of the population does not appear in the formulas, as long as the sample is less than 10% of it: a random sample of 1,000 is about as precise in a city of 100,000 as in a country of 300 million.

## Common mistakes

- Using σ instead of σ/√n (or √(p(1 − p)) instead of √(p(1 − p)/n)) when the question is about a sample mean or proportion.
- Saying the CLT makes the population, or the sample data, normal. It describes the sampling distribution of x̄ only.
- Applying the CLT to a small sample from a skewed population, or to a single individual's value.
- Forgetting to check Large Counts before using a normal model for p̂ (np = 4 is too small).
- Thinking a larger sample removes bias. It only reduces variability; a voluntary-response sample of 5,000 is still biased.
- Believing that doubling n halves the standard deviation.
- Writing hypotheses or statements about statistics when they should be about parameters ("p̂ = 0.40" when p = 0.40 is meant).

## Self-check

1. In "a random sample of 120 students at a hypothetical school found that 38% have a library card", which number is the statistic? **Answer:** 0.38 is p̂, a statistic; the proportion of all students at the school is the parameter p.
2. p = 0.62 and n = 80 (school of 1,400). Find the mean and SD of p̂, and check the conditions. **Answer:** Mean 0.62, SD √(0.62 · 0.38/80) = 0.054; 80 ≤ 140 and np = 49.6, n(1 − p) = 30.4 are both at least 10, so approximately normal.
3. For question 2, find P(p̂ < 0.55). **Answer:** z = −1.29, probability 0.099.
4. A population has σ = 12. What sample size makes SD(x̄) = 2? **Answer:** 12/√n = 2, so n = 36.
5. A population is strongly skewed. Is the sampling distribution of x̄ approximately normal for n = 5? For n = 60? **Answer:** Not for n = 5 (it is still skewed); yes for n = 60, by the CLT.
6. True or false: the sampling distribution of x̄ for n = 9 from the N(18.5, 2.4) battery population is exactly normal. **Answer:** True, because the population is normal.

---

*Original study material for this course, organised around the College Board AP Statistics Course and Exam Description (Unit 2, Topic 2.12). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). All data are invented. AP® is a trademark of the College Board, which does not endorse this material.*
