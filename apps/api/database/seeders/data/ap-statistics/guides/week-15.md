# Week 15 · Estimators and the Sampling Distribution of p̂

**Topics:** 3.1 Estimators · 3.2 Sampling Distributions for Sample Proportions
**Practices:** 3 (Analyze Data), 4 (Interpret Results), 2 (Collect Data)
**Framework:** AP Statistics CED (effective fall 2026), Unit 3, Topics 3.1–3.2, learning objectives in our own words
**Spiral:** Week 6 showed how a sampling method can be biased, week 12 described the binomial count, week 13 found normal probabilities, and week 14 introduced sampling distributions and the Central Limit Theorem for sample means. This week opens Unit 3 by asking what makes a statistic a good estimate of a parameter, then describes exactly how the sample proportion p̂ varies from sample to sample. Every confidence interval and test for a proportion in the rest of the unit is built on that description.

## What you need to be able to do

- **3.1** Distinguish a parameter (a fixed number describing a population) from a statistic (a number computed from a sample) and from an estimator (the rule that turns a sample into a statistic).
- **3.1** Decide from a simulated or theoretical sampling distribution whether an estimator is biased, and compare the variability of two estimators.
- **3.1** Explain that a larger random sample reduces variability but does nothing to remove bias that comes from the sampling method.
- **3.2** State the mean and standard deviation of the sampling distribution of p̂, and check the 10% condition that justifies the standard deviation formula.
- **3.2** Check the Large Counts condition (np ≥ 10 and n(1 − p) ≥ 10) before using a normal model for p̂, and describe the shape when it fails.
- **3.2** Use the normal model to find the probability that p̂ falls in a given range, and use that probability to judge whether a sample result is surprising.

## Key terms

| Term | Meaning |
|---|---|
| Parameter | A number that describes a whole population, such as p, the proportion of all students in a district who eat the school lunch. Usually unknown. |
| Statistic | A number computed from a sample, such as p̂, the proportion in one sample. It changes from sample to sample. |
| Estimator | A rule (a statistic used as a method) for estimating a parameter. p̂ is the estimator of p. |
| Point estimate | The single value an estimator gives for one particular sample. |
| Sampling distribution | The distribution of the values a statistic takes in all possible samples of the same size from the same population. |
| Unbiased estimator | An estimator whose sampling distribution has a mean equal to the parameter it estimates. |
| Variability of an estimator | How spread out its sampling distribution is, measured by its standard deviation. |
| 10% condition | When sampling without replacement, n ≤ 10% of the population size, so the observations are close enough to independent for the SD formula to hold. |
| Large Counts condition | np ≥ 10 and n(1 − p) ≥ 10, so the sampling distribution of p̂ is approximately normal. |

## Estimators: bias and variability (3.1)

A **parameter** is fixed but usually unknown; we estimate it with a **statistic**. Because a different random sample gives a different value, a statistic is a random variable, and its behaviour over many samples is its **sampling distribution**. When we call a statistic an **estimator**, we mean the method: "take an SRS of 200 households and report the sample proportion".

Two properties make an estimator good.

- **Low bias (accuracy).** An estimator is **unbiased** when the mean of its sampling distribution equals the parameter. Over many samples it is right on average; it does not systematically overestimate or underestimate.
- **Low variability (precision).** Its sampling distribution has a small standard deviation, so individual estimates land close to their mean.

The two are separate. An estimator can be unbiased but wildly variable (a random sample of 5), or very consistent but consistently wrong (a large sample taken from the wrong place). The picture to keep in mind is a target: bias is where the shots are centred; variability is how tightly they cluster.

Two facts carry the whole unit. First, the sample proportion p̂ from a **random** sample is an unbiased estimator of p. Second, the variability of p̂ shrinks as the sample size grows. What a bigger sample cannot do is repair a biased method: if the sampling frame leaves people out, or people choose whether to respond, every sample is tilted the same way, and a larger one just gives a more precise wrong answer.

**Worked example (comparing estimators).** A hypothetical town has 12,000 households, and 25% of them have a vegetable garden. A class simulated 1,000 samples for each of three methods of estimating that proportion. The results:

| Method | Mean of the 1,000 estimates | SD of the 1,000 estimates |
|---|---|---|
| M1: SRS of 50 households | 0.251 | 0.061 |
| M2: SRS of 200 households | 0.249 | 0.031 |
| M3: the 200 households nearest the garden centre | 0.410 | 0.034 |

1. **Bias.** M1 and M2 are centred at about 0.25, the parameter, so both appear unbiased. M3 is centred at 0.41, far above 0.25: households near a garden centre are more likely to garden, so the method is biased upward.
2. **Variability.** M2's SD (0.031) is about half of M1's (0.061). Its sample is four times as large, and the theoretical values agree: √(0.25 · 0.75 / 50) ≈ 0.061 and √(0.25 · 0.75 / 200) ≈ 0.031.
3. **Choice.** M2: unbiased and the least variable of the unbiased methods. M3 has almost the same SD as M2, which shows that low variability is no protection against bias.

## The sampling distribution of p̂ (3.2)

Suppose a population has proportion p of "successes" and we take a random sample of size n. Let X be the number of successes in the sample; then p̂ = X/n. When the population is large compared with the sample, X is approximately binomial (week 12), and dividing by n gives the facts below.

- **Centre.** The mean of the sampling distribution of p̂ is p. This is what "p̂ is unbiased" means.
- **Variability.** SD(p̂) = √(p(1 − p)/n). This formula requires the observations to be independent: the 10% condition when sampling without replacement (n ≤ 0.10 · N).
- **Shape.** When the Large Counts condition holds, np ≥ 10 and n(1 − p) ≥ 10, the sampling distribution of p̂ is approximately normal. When it fails, the distribution is skewed: right-skewed when p is near 0, left-skewed when p is near 1.

Notice that both conditions use p, the population proportion, because here we are describing what samples from a known population do. Later in the unit, when p is unknown, the interval version of Large Counts uses p̂ instead, and the test version uses the hypothesised value p₀.

Because n is under a square root, the SD shrinks slowly: to **halve** SD(p̂) you need **four times** the sample size. The population size N does not appear in the formula at all, as long as the 10% condition holds: a sample of 1,000 is as precise in a city of 500,000 as in a country of 300 million.

**Worked example (describing the sampling distribution).** In a hypothetical county, 28% of all 20,000 teenagers have a part-time job. A researcher takes an SRS of 250 of them. Describe the sampling distribution of p̂ and find the probability that the sample proportion is 0.33 or more.

1. **Centre:** the mean of the sampling distribution of p̂ is p = 0.28.
2. **Variability:** 250 ≤ 10% of 20,000 = 2,000, so the 10% condition holds and SD(p̂) = √(0.28 · 0.72 / 250) ≈ 0.0284.
3. **Shape:** np = 250(0.28) = 70 and n(1 − p) = 250(0.72) = 180 are both at least 10, so the shape is approximately normal.
4. **Probability:** z = (0.33 − 0.28)/0.0284 ≈ 1.76, and P(Z ≥ 1.76) ≈ 0.039. A calculator with normalcdf(lower 0.33, upper 1000, mean 0.28, SD 0.0284) gives the same 0.039.
5. **Meaning:** only about 3.9% of random samples of 250 would give 33% or more with jobs if the county proportion is 28%. A sample proportion that high would be surprising, and might make us doubt the 28% figure.

**Worked example (sample size and precision).** In the county above, how large must the SRS be for SD(p̂) to be half of 0.0284? Halving the SD means multiplying n by 4: n = 1,000. Check: √(0.28 · 0.72 / 1000) ≈ 0.0142. The 10% condition still holds (1,000 ≤ 2,000).

**Worked example (when Large Counts fails).** A hypothetical supplier's batteries are 3% defective. An inspector takes a random sample of 120 batteries from a large shipment. Here np = 120(0.03) = 3.6, which is less than 10, so the normal model is not appropriate. The sampling distribution of p̂ is strongly skewed right: p̂ can't go below 0, and most samples contain 0 to 6 defectives. The binomial distribution gives exact answers instead: P(p̂ = 0) = P(X = 0) = 0.97¹²⁰ ≈ 0.026, and P(X ≤ 2) ≈ 0.298. A normal model would put noticeable probability on negative values of p̂, which is impossible.

## Reading a sampling distribution question

Three distributions appear in this unit, and many lost points come from mixing them up.

| Distribution | What it describes | Example (part-time jobs) |
|---|---|---|
| Population distribution | The responses of every individual in the population | 28% "yes", 72% "no" among all 20,000 teens |
| Distribution of sample data | The responses of the individuals in one sample | 79 "yes", 171 "no" in one sample of 250, so p̂ = 0.316 |
| Sampling distribution of p̂ | The values of p̂ across all possible samples of 250 | Approximately normal, mean 0.28, SD 0.0284 |

The population and the sample data are categorical ("yes" or "no"), so they have no shape in the usual sense; only the sampling distribution of p̂ is approximately normal. Saying "the population is normal" in a proportion question is always wrong.

## Common mistakes

- **Using the population size in the SD.** SD(p̂) = √(p(1 − p)/n) uses the sample size n. N appears only in the 10% check.
- **Mixing up the conditions.** The 10% condition justifies the SD formula; the Large Counts condition justifies the normal shape. Neither does the other's job, and "n ≥ 30" is a rule for sample means, not proportions.
- **Thinking a big sample cures bias.** A voluntary-response poll with 5,000 replies is still biased; a larger sample only reduces sampling variability.
- **Calling an estimate unbiased because it was close.** Bias is a property of the method (the centre of the sampling distribution), not of one estimate.
- **Forgetting the square root.** p(1 − p)/n is the variance of p̂; its SD is the square root.
- **Doubling n to halve the SD.** It takes four times the sample size.

## Self-check

1. A survey of 400 students reports that 37% walk to school. Which number is the parameter, which is the statistic, and what is the estimator?
2. Estimator A has mean 0.50 and SD 0.08 over many samples; estimator B has mean 0.46 and SD 0.02, for a parameter of 0.50. Which is biased, and which is more variable?
3. p = 0.15 and n = 400 from a population of 30,000. Find the mean and SD of the sampling distribution of p̂, and check both conditions.
4. With p = 0.15, what sample size would make the normal model just acceptable?
5. In question 3, find P(p̂ ≤ 0.12).
6. Why doesn't the population size N appear in SD(p̂)?

*Answers:* 1. 37% is a statistic (p̂ = 0.37); the parameter is p, the proportion of all students who walk; the estimator is "the sample proportion from a random sample of 400". 2. B is biased (centred at 0.46, not 0.50); A is more variable (SD 0.08). 3. Mean 0.15; 400 ≤ 3,000, so SD = √(0.15 · 0.85 / 400) ≈ 0.0179; np = 60 and n(1 − p) = 340, so approximately normal. 4. n(0.15) ≥ 10 needs n ≥ 66.7, so n = 67. 5. z = (0.12 − 0.15)/0.0179 ≈ −1.68, probability ≈ 0.046. 6. When the sample is a small fraction of the population (the 10% condition), drawing without replacement barely changes the chances, so the spread depends only on p and n.

---

*Original study material for this course, organised around the College Board AP Statistics Course and Exam Description (Unit 3, Topics 3.1–3.2). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). All data are invented. AP® is a trademark of the College Board, which does not endorse this material.*
