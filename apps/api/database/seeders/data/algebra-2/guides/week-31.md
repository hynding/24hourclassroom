# Week 31 · Sampling Variability and Margin of Error

**Lessons:** 7.9 Variability in Samples · 7.10 Estimating Proportions from Samples · 7.11 Reducing Margin of Error · 7.12 Estimating a Population Mean
**Practices:** MP4 (model with mathematics), MP8 (express regularity in repeated reasoning), MP6 (attend to precision)
**Built from:** IM Algebra 2, Unit 7, Lessons 9–12, in our own words
**Spiral:** Random selection (week 29) is what makes a sample's error a matter of chance rather than bias. The normal distribution and the "within two standard deviations" idea (week 30) are applied to a new kind of data: the estimates from many samples. Mean and standard deviation (week 29) are computed, this time, for a list of sample statistics.

## What you need to be able to do

- **7.9** Compute a sample mean and a sample proportion, explain why different random samples give different values, and describe the distribution of estimates from many samples (roughly normal, centred near the population value).
- **7.10** Estimate a population proportion from samples and attach a **margin of error** equal to two standard deviations of the sample proportions, reporting and interpreting the interval estimate ± margin.
- **7.11** Explain how and why the margin of error shrinks as the sample size grows, and roughly how much larger a sample must be to halve it.
- **7.12** Estimate a population mean the same way: many samples, the mean of the sample means, twice their standard deviation as the margin of error.

## Key terms

| Term | Meaning |
|---|---|
| Sample statistic | A number computed from a sample: a sample mean or a sample proportion. It estimates the population's mean or proportion. |
| Sample proportion | (number in the sample with the property) ÷ (sample size), written p̂. |
| Sampling variability | The way a statistic changes from one random sample to the next, purely by chance. |
| Distribution of sample statistics | The values of the statistic from many random samples, shown as a dot plot or histogram; usually roughly normal and centred near the population value. |
| Margin of error | The largest difference you expect between an estimate and the true population value; taken as **2 × (standard deviation of the sample statistics)**. |
| Interval estimate | estimate ± margin of error: the range in which the population value is likely to lie. |

## Variability in samples (7.9)

A jar holds 36 coins. Different students each draw a random sample of 5 and compute the mean minting year and the proportion minted in Denver. No two samples agree exactly: one sample happens to catch two old coins, another none. Each sample statistic is a reasonable estimate, but each is off by some amount, and that amount is **random**, not systematic, because the samples were random.

Put all the class's sample means on a dot plot and a shape appears: a mound centred near the population mean, with most values close to it and a few further away. The same happens for sample proportions. This mound is the **distribution of sample statistics**, and for samples of reasonable size it is close to normal.

That is the key fact. If the sample statistics are approximately normal with standard deviation s, then about 95% of them lie within 2s of their centre, which is close to the population value. Turn it around: a single sample's estimate is, 95% of the time, within 2s of the truth. **The margin of error is 2s.**

**Worked example.** Thirty random samples of 20 coins give sample proportions of Denver coins with mean 0.55 and standard deviation 0.04. Report the estimate.

Margin of error 2 · 0.04 = 0.08. The proportion of Denver coins in the jar is likely between 0.55 − 0.08 = 0.47 and 0.63. Write it as 0.55 ± 0.08.

**Try it.** Twenty random samples give sample means with mean 42.3 and standard deviation 1.1. Give the margin of error and the interval estimate.

*Answer:* 2.2; 40.1 to 44.5, or 42.3 ± 2.2.

## Estimating a proportion (7.10)

A biologist has 40 fruit flies, 9 of which carry a mutation: sample proportion 9/40 = 0.225. To put a margin of error on that, simulate drawing many samples of 40 from a population in which 22.5% carry the mutation (paper slips in a bag, or a random number generator), record each sample's proportion, and find the standard deviation of those proportions. If it is 0.065, the margin of error is 0.13 and the population proportion is likely in 0.225 ± 0.13, that is 0.10 to 0.36.

**Worked example.** Ten random samples of 50 students each were asked whether they have a part-time job. The sample proportions:

| 0.42 | 0.47 | 0.44 | 0.50 | 0.46 | 0.39 | 0.45 | 0.48 | 0.43 | 0.46 |
|---|---|---|---|---|---|---|---|---|---|

Mean 0.45, standard deviation 0.03 (technology). Margin of error 0.06. Estimate: 0.45 ± 0.06, so between 39% and 51% of students are likely to have a part-time job.

**What the interval means.** "Likely" is shorthand for: the method produces an interval that captures the true proportion about 95% of the time. One interval in twenty misses. The interval is not a guarantee, and the true value is not "more likely in the middle" in any simple sense.

**From a dot plot.** If you have the dot plot of sample proportions but not the standard deviation, find the range that holds the middle 95% of the dots; half its width is the margin of error.

**Try it.** 25 samples of 30 give proportions with mean 0.62 and standard deviation 0.045. Report the estimate and say what 0.62 − 0.09 and 0.62 + 0.09 represent.

*Answer:* 0.62 ± 0.09; the population proportion is likely between 0.53 and 0.71.

## Reducing the margin of error (7.11)

Elena asks 10 people whether they have found a job and gets a margin of error of 0.28; Clare asks 40 and gets 0.138. Bigger samples give smaller margins, because extremes in a big sample average out: a sample of 10 can easily be 3 people off its expected count (30 percentage points), a sample of 40 rarely is (3 people is 7.5 points).

In a simulation with samples of size 5, 10 and 15, the standard deviation of the sample proportions falls each time the size rises. The pattern, which you can check in the Elena/Clare numbers (0.28 ÷ 0.138 ≈ 2), is that **multiplying the sample size by 4 roughly halves the margin of error**. (The standard deviation of sample statistics shrinks like 1/√n.) So halving a margin costs four times the work, and cutting it to a third costs nine times.

**What a bigger sample cannot fix.** The margin of error measures only the random part of the error. If the sampling method is biased (a mall survey, an online poll), the estimate is systematically off, and a huge biased sample is just confidently wrong. Random selection first; sample size second.

**Worked example.** A poll of 1,000 voters finds 40% support for a measure, with a margin of error of 0.03. (a) Give the interval. (b) What margin would a poll of 250 have? Of 4,000?

(a) 0.37 to 0.43. (b) A quarter of the sample doubles the margin, about 0.06; four times the sample halves it, about 0.015.

**Try it.** A margin of error of 0.10 comes from samples of 50. Roughly what sample size gives 0.05?

*Answer:* About 200 (four times as many).

## Estimating a population mean (7.12)

Everything above works for means. Roll a die 5 times and record the mean; do it many times. Single rolls are uniform from 1 to 6 with mean 3.5, but the **means of 5 rolls** pile up near 3.5 in a mound that is roughly normal and much narrower than the single rolls. Averaging tames variability.

To estimate a population mean: take many random samples, find each sample's mean, then report **(mean of the sample means) ± 2 × (standard deviation of the sample means)**.

**Worked example.** Ten random samples of 20 tomatoes from a farm have sample mean weights (in grams) 26.1, 24.8, 25.6, 25.2, 24.5, 26.4, 25.0, 25.9, 24.9, 25.6. Estimate the mean weight of the farm's tomatoes.

Mean of the sample means 254/10 = 25.4 g; their standard deviation (technology) about 0.59; margin of error about 1.2. The mean weight is likely between 24.2 g and 26.6 g: 25.4 ± 1.2.

**Worked example.** A factory needs its tennis balls to have mean diameter between 6.54 and 6.86 cm. Samples give a mean of sample means of 6.62 cm with margin of error 0.04. Is the factory meeting the requirement?

The mean diameter is likely between 6.58 and 6.66 cm, entirely inside the required range, so yes, as far as the sampling can tell.

**Try it.** Eight random samples give sample means 14.2, 15.1, 14.8, 15.6, 14.9, 15.0, 14.6, 15.2 with standard deviation 0.41. Report the estimate.

*Answer:* Mean of the means 119.4/8 ≈ 14.93; margin 0.82; about 14.1 to 15.7, or 14.9 ± 0.8.

## Common mistakes

- **Using one standard deviation.** The margin of error is two standard deviations of the sample statistics, to cover about 95%.
- **Using the standard deviation of the data** instead of the standard deviation of the sample statistics. The latter is much smaller.
- **Reading ± as a guarantee.** The interval misses the truth about 5% of the time.
- **Doubling the sample to halve the margin.** It takes four times the sample.
- **Expecting a large sample to cure bias.** It only shrinks random error.
- **Reporting a bare estimate.** "0.45" says less than "0.45 ± 0.06".

## Where this goes next

Next week the same tools judge **experiments**: the difference between a treatment group's mean and a control group's mean is compared with the differences that random regrouping alone would produce, and a normal model of those differences says whether the treatment made a real difference.

## Self-check

1. Explain why ten random samples of 30 students give ten different proportions of left-handers, and what the dot plot of those proportions would look like.
2. Sample proportions from 40 samples have mean 0.28 and standard deviation 0.05. Give the estimate with its margin of error and interpret it.
3. A survey of 100 gives a margin of error of 0.10. Roughly what sample size gives 0.05? What size gives 0.025?
4. Sample means from 12 samples: mean 8.6, standard deviation 0.35. Report the estimate of the population mean.
5. A website polls its visitors (2 million responses) and reports a margin of error of 0.001. Why is that number misleading?

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Algebra 2, Unit 7, Lessons 9–12, https://im.kendallhunt.com/HS/teachers/3/7/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
