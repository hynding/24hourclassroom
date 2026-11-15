# Week 23 · Sampling Distributions for Sample Means

**Topics:** 4.1 Sampling Distributions for Sample Means
**Practices:** 3 (Analyze Data), 4 (Interpret Results)
**Framework:** AP Statistics CED (effective fall 2026), Unit 4, Topic 4.1, learning objectives in our own words
**Spiral:** Week 14 met the Central Limit Theorem; weeks 15–22 built every inference procedure for proportions on the sampling distribution of p̂. Unit 4 does the same for a quantitative variable, and it starts here: before we can estimate or test a mean, we need to know how the sample mean x̄ behaves from sample to sample.

## What you need to be able to do

- **4.1** Describe the sampling distribution of x̄ by its centre (μ), its spread (σ/√n) and its shape (normal or approximately normal), and justify each.
- **4.1** Check the 10% condition before using σ/√n, and explain why it matters.
- **4.1** Decide whether a normal model for x̄ is justified: a normal population, or a large sample (n ≥ 30) by the Central Limit Theorem.
- **4.1** Compute and compare probabilities about one observation and about a sample mean.
- **4.1** Explain why using s in place of σ leads to a t distribution with n − 1 degrees of freedom, and how t* compares with z*.

## Key terms

| Term | Meaning |
|---|---|
| Sampling distribution of x̄ | The distribution of x̄ over all possible random samples of size n from one population. |
| Mean of the sampling distribution of x̄ | Equal to μ, so x̄ is an unbiased estimator of μ. |
| SD(x̄) | σ/√n, the standard deviation of the sampling distribution, when observations are independent. |
| 10% condition | When sampling without replacement, n ≤ 10% of the population keeps σ/√n accurate. |
| Central Limit Theorem (CLT) | For large n, the sampling distribution of x̄ is approximately normal whatever the population's shape. |
| Standard error of x̄ | s/√n: the estimate of SD(x̄) used when σ is unknown. |
| t distribution | The distribution of (x̄ − μ)/(s/√n); symmetric, centred at 0, heavier-tailed than normal. |
| Degrees of freedom (df) | For one sample, df = n − 1; it picks which t distribution to use. |

## The sampling distribution of x̄ (4.1)

Imagine taking every possible random sample of 25 students from a school and writing down each sample's mean sleep time. The list of all those means has its own distribution: the **sampling distribution of x̄**. It is the quantitative twin of the sampling distribution of p̂ from Unit 3, and it is described by the same three features.

Keep three distributions apart, because AP questions test exactly this:

1. The **population distribution**: the values of every individual. Its mean is μ and its standard deviation σ.
2. The **distribution of one sample**: the n values you actually collect. It looks roughly like the population (a skewed population gives skewed samples).
3. The **sampling distribution of x̄**: one value per possible sample. This is the one inference is built on.

**Centre.** The mean of the sampling distribution of x̄ equals μ. Some samples overshoot and some undershoot, but there is no systematic error, so x̄ is an **unbiased** estimator of μ (week 15's idea of an estimator, now for a mean).

**Spread.** SD(x̄) = σ/√n. Averages vary less than individuals, because unusually high and unusually low values tend to cancel within a sample. The √n matters: to cut the spread in half you need four times as many observations.

| n | 1 | 4 | 16 | 64 |
|---|---|---|---|---|
| SD(x̄) when σ = 12 | 12 | 6 | 3 | 1.5 |

The formula assumes independent observations. When you sample without replacement, check the **10% condition**: n is no more than 10% of the population.

**Shape.** Two routes to a normal model:

- If the **population is normal**, the sampling distribution of x̄ is exactly normal for any n.
- If the population is not normal, the **Central Limit Theorem** says the sampling distribution of x̄ becomes approximately normal as n grows. The usual rule is n ≥ 30. Strong skew or outliers need more; a population that is already roughly symmetric needs less.

If neither route is available (a skewed population and a small sample), do not use a normal model for x̄.

**Worked example 1: one bag versus four.** A machine fills trail-mix bags; weights are approximately normal with μ = 170 g and σ = 6 g. Compare P(one bag < 167 g) with P(mean of 4 random bags < 167 g).

- One bag: z = (167 − 170)/6 = −0.50, so P ≈ 0.309.
- Four bags: the population is normal, so x̄ is normal (even with n = 4), with mean 170 and SD(x̄) = 6/√4 = 3. z = (167 − 170)/3 = −1.00, so P ≈ 0.159.
- The 10% condition holds easily: 4 bags out of thousands produced.

The mean of four is half as spread out as one bag, so a value 3 g below the target is twice as many standard deviations away and less likely.

**Worked example 2: a skewed population.** Commute times in a city are skewed to the right with μ = 24 minutes and σ = 11 minutes. A planner surveys a random sample of 50 commuters. Find P(x̄ > 27).

1. Centre: the mean of the sampling distribution of x̄ is 24 minutes.
2. Spread: SD(x̄) = 11/√50 ≈ 1.556 minutes (50 commuters is far less than 10% of the city's commuters).
3. Shape: the population is skewed, but n = 50 ≥ 30, so by the CLT x̄ is approximately normal.
4. z = (27 − 24)/1.556 ≈ 1.93, and P(z > 1.93) ≈ 0.027.

Notice what we could **not** do: find P(one commute > 27) with a normal model. A single value comes from the skewed population, and the CLT says nothing about individuals.

**Worked example 3: when the 10% condition fails.** A school club has 400 members, and the officers survey a random sample of 60 about volunteer hours. Since 60 is 15% of 400, the draws are noticeably dependent: once a heavy volunteer is chosen, there are fewer left to choose. The true spread of x̄ is smaller than σ/√60, so the formula overstates it. With such a sample, say that the condition fails and that σ/√n is only a conservative approximation; the fix is a smaller fraction of the population (at most 40 members) or a larger population.

## From σ to s: the t distributions (4.1)

Every calculation above used σ. In practice we almost never know σ (if we knew the population that well, we would probably know μ too). We estimate SD(x̄) with the **standard error**

SE(x̄) = s/√n,

using the sample standard deviation s. Standardising with s gives

t = (x̄ − μ)/(s/√n).

This statistic is **not** standard normal. s itself changes from sample to sample, sometimes coming out too small, which makes t occasionally land farther from 0 than z would. Its distribution, when the population is normal (or n is large), is a **t distribution with n − 1 degrees of freedom**.

Properties of the t distributions:

- Symmetric, single-peaked, centred at 0, like the standard normal.
- **Heavier tails**: more area far from 0.
- One curve for each df. As df increases, s becomes a more reliable estimate of σ, and the t curve approaches the standard normal.

**Worked example 4: critical values.** The value that cuts off the top 2.5% (the critical value for 95% confidence) for several df:

| df | 4 | 9 | 29 | 99 | ∞ (normal) |
|---|---|---|---|---|---|
| t* for 95% | 2.776 | 2.262 | 2.045 | 1.984 | 1.960 |

With df = 9, P(t > 2.262) = 0.025, but under the standard normal P(z > 2.262) ≈ 0.012. Using z* with a small sample makes an interval too narrow and a test too eager to reject. Next week puts t* to work in confidence intervals; the week after, the t statistic becomes a test statistic.

**Worked example 5: standard error from data.** A random sample of 25 bus trips on one route has x̄ = 41 minutes and s = 8 minutes. SE(x̄) = 8/√25 = 1.6 minutes. It estimates how far x̄ typically falls from the true mean travel time μ. The n − 1 = 24 belongs to the degrees of freedom, not the standard error: dividing by √24 is a common slip.

## Means and proportions side by side

| | Sample proportion p̂ (Unit 3) | Sample mean x̄ (Unit 4) |
|---|---|---|
| Centre | p | μ |
| Spread | √(p(1 − p)/n) | σ/√n |
| Independence | 10% condition | 10% condition |
| Normal shape when | np ≥ 10 and n(1 − p) ≥ 10 | normal population, or n ≥ 30 |
| Estimated spread | √(p̂(1 − p̂)/n) | s/√n, with t instead of z |

The logic of every procedure in this unit is the same as in Unit 3; only the statistic, its standard error and the reference distribution change.

## Common mistakes

- **Dividing by σ instead of σ/√n** when the question is about a mean. Ask: one individual, or the mean of n?
- **Saying the CLT makes the data normal.** It makes the sampling distribution of x̄ approximately normal; the sample still looks like the population.
- **Citing the CLT for a small sample from a normal population.** The shape is normal because the population is normal; the CLT is the reason only when n is large.
- **Writing σ/n.** The square root matters.
- **Forgetting the 10% condition** when sampling without replacement from a modest population.
- **Using z* with s.** Once σ is replaced by s, use t with n − 1 degrees of freedom.

## Self-check

1. Test scores have μ = 80 and σ = 15. For random samples of 36 students, give the mean and SD of the sampling distribution of x̄.
2. Using question 1 and a normal model, find P(x̄ < 76).
3. A population is strongly skewed. Can you use a normal model for x̄ with n = 12? With n = 60?
4. By what factor must n change to cut SD(x̄) to one third?
5. A sample of 10 gives s = 4.5. Find SE(x̄) and the df of the t distribution you would use.
6. Which has heavier tails: t with 5 df or t with 50 df?

*Answers:* 1. Mean 80, SD 15/√36 = 2.5. 2. z = (76 − 80)/2.5 = −1.6, P ≈ 0.055 (the CLT applies with n = 36 ≥ 30). 3. Not with n = 12; yes with n = 60, by the Central Limit Theorem. 4. Multiply n by 9. 5. SE = 4.5/√10 ≈ 1.42; df = 9. 6. t with 5 df.

---

*Original study material for this course, organised around the College Board AP Statistics Course and Exam Description (Unit 4, Topic 4.1). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). All data are invented. AP® is a trademark of the College Board, which does not endorse this material.*
