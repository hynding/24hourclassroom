# Unit 7 · Statistical Inferences · The night-before sheet

**Exam weight:** about 10–12% of the final · **Lessons:** 7.1 Being Skeptical · 7.2 Study Types · 7.3 Randomness in Groups · 7.4 Describing Distributions · 7.5 Normal Distributions · 7.6 Areas in Histograms · 7.7 Areas under a Normal Curve · 7.8 Not Always Ideal · 7.9 Variability in Samples · 7.10 Estimating Proportions from Samples · 7.11 Reducing Margin of Error · 7.12 Estimating a Population Mean · 7.13 Experimenting · 7.14 Using Normal Distributions for Experiment Analysis · 7.15 Questioning Experimenting · 7.16 Heart Rates
**Practices:** MP3, MP4, MP5, MP6
**Built from:** IM Algebra 2, Unit 7, in our own words

## The ideas that generate every question

1. **How the data were collected decides what they can show.** A survey or observational study shows association; only a randomized experiment supports causation, because random assignment makes the groups alike except for the treatment. Random *selection* makes a sample representative; random *assignment* makes groups comparable. Volunteer, convenience and judgment samples are biased, and no sample size fixes bias.
2. **Describe a distribution by shape, centre and spread.** Shape: symmetric, bell-shaped, skewed right or left (named for the tail), uniform, bimodal. Centre: mean (pulled by skew and outliers) or median (resistant). Spread: standard deviation, a typical distance from the mean.
3. **The normal distribution is fixed by μ and σ.** About 68% within 1σ, 95% within 2σ, 99.7% within 3σ. For anything else, z = (x − μ)/σ and the area to the left of z from a table or technology; right tail = 1 − left; between = difference of lefts; cutoff = μ + zσ.
4. **Area is proportion.** In a relative-frequency histogram the bar areas are the proportions and add to 1; under a normal curve the area in an interval is the proportion there.
5. **Unusual means more than about 2 standard deviations from what the model expects.** An unusual result is evidence against the claim, not proof; one trial cannot tell what is typical, a simulation of many can.
6. **Sample statistics vary by chance, roughly normally, around the population value.** Margin of error = 2 × (standard deviation of the sample statistics); report estimate ± margin and read it as "likely", meaning about 95% of such intervals capture the truth. Four times the sample halves the margin.
7. **An experiment's difference in means is judged against random regrouping.** Shuffle all the results into two groups many times; the differences centre at 0 and are roughly normal. z = (observed difference)/(regrouping standard deviation); if the proportion of regroupings at least as extreme (both tails) is below a cutoff chosen beforehand, the difference is significant and the treatment is the likely cause. "Not significant" means not enough evidence, never "no effect".

## Key formulas and procedures

| Want | Do this |
|---|---|
| Classify a study | Asked questions: survey. Observed existing groups: observational. Assigned treatment: experiment. |
| Mean, median | Sum ÷ count; middle value (average of the two middle values for an even count) |
| Standard deviation | √(average of squared deviations from the mean); sample version divides by n − 1 |
| Share within 1σ, 2σ, 3σ | 68%, 95%, 99.7%; each tail beyond 1σ is 16%, beyond 2σ is 2.5% |
| z-score | (x − μ)/σ |
| Area right of z | 1 − (area left of z) |
| Area between a and b | (area left of z_b) − (area left of z_a) |
| Cutoff for a proportion | find z with that area to the left; x = μ + zσ (top 10%: 1.28; top 5%: 1.645; middle 50%: ±0.675) |
| Proportion from a histogram | add the bar areas in the interval |
| Unusual result | beyond mean ± 2 × (standard deviation of the simulation) |
| Sample proportion | successes ÷ sample size |
| Margin of error | 2 × (standard deviation of the sample proportions or sample means) |
| Interval estimate | estimate − margin to estimate + margin |
| Halve the margin | about 4 × the sample size |
| Difference in means | treatment mean − control mean |
| Significance | z = difference ÷ (regrouping standard deviation); both-tail area below cutoff → significant |

## Common errors

- Calling any two-group comparison an experiment; experiments assign the groups.
- "Random" used for haphazard choices; random means every member has an equal, known chance.
- Mean reported for skewed data; median reported with no mention of the skew.
- The 68–95–99.7 rule applied to a skewed distribution.
- Table areas read as right tails; values not converted to z.
- Margin of error taken as one standard deviation, or as the standard deviation of the data rather than of the sample statistics.
- Doubling the sample to halve the margin (it takes four times).
- Interval estimate read as a guarantee.
- Randomization distribution centred at the observed difference (it is centred at 0).
- One tail used when "at least as extreme" means both; "not significant" read as "no effect"; cutoff chosen after the fact.

## Worked examples

**Study types.** Random sample of 500 voters asked their choice: survey. Hospital records comparing smokers and non-smokers: observational, association only. Sixty seedlings randomly split, half get extra light: experiment, can support cause.

**Describe.** 4, 6, 6, 7, 12: mean 7, median 6, population standard deviation √7.2 ≈ 2.68, skewed right. Change the largest of 20, 22, 23, 25, 25, 26, 29 to 59: mean 24.3 → 28.6, median stays 25.

**Normal.** Heights mean 170, σ 8: between 154 and 178 is 47.5% + 34% = 81.5%; shorter than 182 (z = 1.5) is 93.3%; between 160 and 182 is 0.933 − 0.106 = 0.827; tallest 10% start at 170 + 1.28 · 8 ≈ 180.2.

**Histogram.** Bars 0.33 + 0.34 within 1σ and 0.94 within 2σ: consistent with a normal model.

**Unusual.** Coin claimed fair, 20 flips, simulation mean 10, σ 2.2: 2 heads is 3.6σ below, strong evidence against fairness. Fair draw gives 5 seniors of 8 about 8% of the time: not unusual.

**Margin of error.** Sample proportions mean 0.45, σ 0.03: 0.45 ± 0.06, so 0.39 to 0.51. Sample means mean 25.4, σ 0.59: 25.4 ± 1.2. Poll of 1,000 with margin 0.03: a poll of 250 would have about 0.06, of 4,000 about 0.015.

**Experiment.** Fertilizer: means 10 and 7, difference 3; regrouping σ 1.2; z = 2.5; both tails about 1.2%; significant at 5%. Bird feed: difference 1.1, σ 1.2, z ≈ 0.92, about 36%; not significant. Strawberries: 30 g, σ 18, z ≈ 1.67, about 9.5%; not at 5%, yes at 10%.

## What to review from earlier units

- **Unit 6:** reading features from a curve (there amplitude and midline; here mean and standard deviation) and judging a model against data.
- **Unit 5:** the normal curve with mean μ and standard deviation σ is the standard curve shifted by μ and stretched by σ; z-scores undo that transformation.
- **Unit 4:** exponential growth is one of the shapes data can take that is *not* normal; the 68–95–99.7 rule does not apply to it.
- **Algebra 1:** dot plots, histograms, mean, median and standard deviation.

## Exam-night checklist

1. Can you classify a study in one sentence and say what it can and cannot show?
2. Can you spot a biased sample and a misleading graph, and name a confounding variable?
3. Can you compute mean, median and standard deviation of six numbers by hand, and name the shape?
4. Can you apply 68–95–99.7 to intervals like μ − 2σ to μ + σ?
5. Can you go from a value to z to an area, and from a proportion to z to a cutoff?
6. Can you decide whether a simulated result is unusual and say what that does and does not prove?
7. Can you turn a list of sample proportions or means into estimate ± margin and interpret it?
8. Can you say what happens to the margin when the sample is 4 times larger, and why a biased sample is not rescued?
9. Can you compute an experiment's difference in means, its z against the regrouping standard deviation, the two-tailed proportion, and state the decision carefully?
10. Can you list the design questions: random assignment, control, placebo, blinding, same measurement, cutoff set beforehand?

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Algebra 2, Unit 7, Lessons 1–16, https://im.kendallhunt.com/HS/teachers/3/7/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
