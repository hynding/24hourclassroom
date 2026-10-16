# Week 30 · Normal Distributions and Areas

**Lessons:** 7.5 Normal Distributions · 7.6 Areas in Histograms · 7.7 Areas under a Normal Curve · 7.8 Not Always Ideal
**Practices:** MP4 (model with mathematics), MP5 (use tools strategically), MP3 (construct arguments)
**Built from:** IM Algebra 2, Unit 7, Lessons 5–8, in our own words
**Spiral:** The bell shape, mean and standard deviation of last week get an equation and a rule. Proportions as areas use the relative-frequency idea from Algebra 1 histograms. Reading a feature from a curve, as with amplitude and midline in Unit 6, becomes reading mean and standard deviation from a normal curve. Deciding whether a result "fits a model" (weeks 23, 28) becomes deciding whether a result is unusual.

## What you need to be able to do

- **7.5** Recognise an approximately normal distribution, describe it by its mean and standard deviation, locate the mean and the points one standard deviation away on its curve, and use the 68–95–99.7 rule.
- **7.6** Explain why the area of a bar in a relative-frequency histogram is the proportion of data in that interval, find proportions by adding areas, and check whether data are approximately normal by comparing its proportions with 68% and 95%.
- **7.7** Find the proportion of a normal distribution in any interval using symmetry, a z-score and a table (or technology), and find the cutoff value for a given proportion.
- **7.8** Use a simulation or a normal model to decide whether an observed result is unusual, and explain why "unusual" suggests, but does not prove, that a claim is wrong.

## Key terms

| Term | Meaning |
|---|---|
| Normal distribution | The bell-shaped, symmetric distribution described completely by its mean μ and standard deviation σ. |
| Relative frequency | The proportion of the data in a group: count ÷ total. In a relative-frequency histogram the bar areas add to 1. |
| 68–95–99.7 rule | For a normal distribution about 68% of values lie within 1σ of the mean, 95% within 2σ, 99.7% within 3σ. |
| z-score | How many standard deviations a value is above the mean: z = (x − μ)/σ. Negative means below. |
| Area under the curve | Between two values, the proportion of the distribution there; the total area is 1. |
| Unusual result | One that would rarely happen if the claim were true, typically outside 2 standard deviations of what the model expects. |

## Normal distributions (7.5)

Many measurements, heights of adults, lengths of the same part made by one machine, errors in repeated measurements, pile up around a middle value with symmetric, thinning tails. The idealised version is the **normal distribution**. Two numbers fix it: the **mean** μ, where the peak is, and the **standard deviation** σ, which sets the width. The curve changes from bending downward to bending outward exactly at μ − σ and μ + σ, so you can read σ off a well-drawn curve.

**The 68–95–99.7 rule.** For any normal distribution:

| Interval | Share of the data |
|---|---|
| μ − σ to μ + σ | about 68% |
| μ − 2σ to μ + 2σ | about 95% |
| μ − 3σ to μ + 3σ | about 99.7% |

By symmetry, half of each leftover is in each tail: 16% below μ − σ, 2.5% below μ − 2σ, 0.15% below μ − 3σ, and the same above.

**Worked example.** Adult heights in a population are approximately normal with mean 170 cm and standard deviation 8 cm. What share of adults are (a) between 162 and 178 cm, (b) taller than 186 cm, (c) between 154 and 178 cm?

(a) 162 and 178 are μ ± σ: about 68%. (b) 186 is μ + 2σ; above it lies half of the 5% outside μ ± 2σ: 2.5%. (c) From μ − 2σ to μ + σ, add the two halves: from 154 to 170 is 47.5% (half of 95%), from 170 to 178 is 34% (half of 68%): total 81.5%.

**Worked example.** A machine fills bags with a mean of 500 g and standard deviation 4 g, approximately normal. Between what weights do the middle 95% of bags fall?

μ ± 2σ: 492 g to 508 g.

**Try it.**
1. Test scores: mean 72, standard deviation 9, approximately normal. What share is above 90? Below 63?
2. Which is not normal: the heights of 12-year-olds in one school; the incomes of a city's households; the diameters of ball bearings from one machine?

*Answers:* 1. 90 = μ + 2σ, so 2.5% above; 63 = μ − σ, so 16% below. 2. Household incomes: strongly skewed right.

## Areas in histograms (7.6)

A **relative-frequency histogram** uses bars whose heights are proportions rather than counts, so when the bars have width 1 unit their **areas** are the proportions and the areas add to 1. The proportion of data in an interval is the total area of the bars in it. A normal curve is what the histogram tends to as the bins get narrower and the data grow, so the proportion in an interval is the **area under the curve** there.

**Worked example.** Word counts of 200 short stories, in bins of 400 words:

| Words | 1,400–1,800 | 1,800–2,200 | 2,200–2,600 | 2,600–3,000 | 3,000–3,400 | 3,400–3,800 |
|---|---|---|---|---|---|---|
| Relative frequency | 0.03 | 0.13 | 0.33 | 0.34 | 0.14 | 0.03 |

The mean is about 2,600 and the standard deviation about 400. What proportion is within one standard deviation of the mean, 2,200 to 3,000? Within two, 1,800 to 3,400?

0.33 + 0.34 = 0.67; 0.13 + 0.33 + 0.34 + 0.14 = 0.94. Close to 68% and 95%, so a normal model fits.

**Worked example.** Load times of 10,000 page visits: 0.12 of the data below 1.0 s, 0.38 between 1.0 and 1.5 s, 0.30 between 1.5 and 2.0 s, 0.12 between 2.0 and 2.5 s, 0.08 above 2.5 s. Is this approximately normal?

Probably not: the mean is near 1.5 s but the right tail (0.08 beyond 2.5 s, over a wide range) is heavier than the left, a right skew typical of waiting times. The normal model would give the same share in symmetric intervals on each side.

**Try it.** In a relative-frequency histogram the bars for 10–20, 20–30 and 30–40 have heights 0.15, 0.40 and 0.25 (bin width 10, heights already proportions). What share of the data is between 20 and 40? Below 10 or above 40?

*Answers:* 0.65; 1 − (0.15 + 0.40 + 0.25) = 0.20.

## Areas under a normal curve (7.7)

For values that are not whole standard deviations from the mean, convert to a **z-score**, z = (x − μ)/σ, and read the area to the left of z from a table or from technology (a calculator's normalcdf or a spreadsheet's NORM.DIST). A short table used throughout this course:

| z | −2 | −1.5 | −1.25 | −1 | −0.75 | −0.5 | −0.25 | 0 | 0.25 | 0.5 | 0.75 | 1 | 1.25 | 1.5 | 2 | 2.5 | 3 |
|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|
| Area to the left | 0.023 | 0.067 | 0.106 | 0.159 | 0.227 | 0.309 | 0.401 | 0.500 | 0.599 | 0.691 | 0.773 | 0.841 | 0.894 | 0.933 | 0.977 | 0.994 | 0.999 |

Three area rules, all from "total area 1" and symmetry:

- area to the **right** of z = 1 − (area to the left);
- area **between** two values = (area left of the larger) − (area left of the smaller);
- area left of −z = area right of z.

**Worked example.** Heights: mean 170, standard deviation 8. What proportion of adults is shorter than 182 cm? Taller?

z = (182 − 170)/8 = 1.5; area left 0.933, so 93.3% shorter and 6.7% taller.

**Worked example.** What proportion is between 160 and 182 cm?

z = (160 − 170)/8 = −1.25, area left 0.106; z = 1.5, area left 0.933. Between: 0.933 − 0.106 = 0.827, about 83%.

**Worked example (cutoffs).** The tallest 10% of adults need a special seat. What height qualifies?

Area to the left must be 0.90, which is z ≈ 1.28 (between 1.25 and 1.5 in the table; technology gives 1.28). Height = 170 + 1.28 · 8 ≈ 180.2 cm. Useful cutoffs to remember: top/bottom 10% at z = ±1.28, top/bottom 5% at ±1.645, middle 50% between ±0.675.

**Worked example.** Bulbs have mean life 1,200 hours, standard deviation 100. What share burns out before 1,050 hours? What share lasts between 1,100 and 1,400?

z = −1.5: 0.067, about 6.7%. z = −1 to z = 2: 0.977 − 0.159 = 0.818, about 82%.

**Try it.**
1. Scores: mean 72, σ = 9. What share is below 65.25? Above 85.5?
2. Weights: mean 50, σ = 4. Find the weight below which the lightest 25% fall.

*Answers:* 1. z = −0.75: 0.227; z = 1.5: 1 − 0.933 = 0.067. 2. z = −0.675: 50 − 0.675 · 4 = 47.3.

## Not always ideal (7.8)

A model such as "this coin is fair" or "this player makes 60% of free throws" predicts what results are typical. To test a claim, see whether the actual result is **unusual** under the claim.

**Worked example.** A fair coin is flipped 20 times. A simulation of 1,000 such sets gives a mean of 10 heads with standard deviation 2.2, roughly bell-shaped. A friend's coin gave 2 heads in 20 flips. Is that evidence the coin is unfair?

Results within 10 ± 2(2.2), that is 5.6 to 14.4 heads, happen about 95% of the time with a fair coin. Two heads is 3.6 standard deviations below the mean: very unusual if the coin is fair. That is strong evidence against fairness, but not proof; a fair coin could do it, just rarely.

**Worked example.** A player claims to make 60% of free throws. In 100 attempts three teammates make 63, 75 and 35. A simulation of 100 shots at 60% has mean 60 and standard deviation 4.9. Which results fit the claim?

Typical range 60 ± 9.8, about 50 to 70. 63 fits. 75 is about 3 standard deviations above: unusual, the claim of 60% looks too low for that player. 35 is about 5 below: the claim is almost certainly wrong for that player.

**Worked example.** A council of 25 members includes 10 seniors. Eight members are chosen "at random" for interviews and 5 of them are seniors. Unfair? A simulation of 500 random draws of 8 gives 5 or more seniors about 8% of the time.

Eight percent is not rare: a fair draw gives this result about one time in twelve. The data do not provide strong evidence of unfairness, though they do not prove the draw was fair either.

**Why class results beat one trial.** One set of 20 flips tells you little about what is typical; a thousand sets map out the whole distribution. The more simulated trials, the better the picture, and often that picture is close to a normal curve.

**Try it.** A spinner is claimed to land on red 25% of the time. In 80 spins it lands on red 34 times. A simulation of 80 spins at 25% has mean 20 and standard deviation 3.9. Is 34 unusual?

*Answer:* 34 is (34 − 20)/3.9 ≈ 3.6 standard deviations above the mean, far outside the typical range of 12 to 28: strong evidence the spinner favours red.

## Common mistakes

- **Applying the 68–95–99.7 rule to skewed data.** It is for approximately normal data only; check the shape first.
- **Reading the table as "area above".** The table gives the area to the **left** of z; subtract from 1 for the right tail.
- **Forgetting to standardise.** 182 cm is not z = 182; subtract the mean and divide by the standard deviation.
- **Mixing up bar height and bar area** when bins are not 1 unit wide.
- **Treating "unusual" as "impossible".** Rare results happen; an unusual result is evidence against a claim, not a disproof.
- **Judging from one trial.** One result cannot tell you what is typical; a simulation of many trials can.

## Where this goes next

Next week the thing that is approximately normal is the collection of **sample estimates**: means or proportions from many random samples. Two standard deviations of that collection becomes the margin of error, the number that says how far a sample estimate is likely to be from the truth.

## Self-check

1. Resting heart rates: mean 70, standard deviation 10, approximately normal. What share is between 60 and 90? Above 100?
2. A relative-frequency histogram has bars (bin width 5) with heights 0.10, 0.25, 0.30, 0.25, 0.10 for 0–25. What share is at or above 15? Does the shape look normal?
3. Bags: mean 500 g, σ = 4 g. Find the share below 495 g (z = −1.25) and the weight above which the heaviest 5% lie.
4. A die is claimed fair. In 120 rolls, a six comes up 34 times; a simulation of 120 fair rolls gives mean 20 and standard deviation 4.1 sixes. Is 34 unusual? What can you conclude?
5. Explain, in two sentences, why an unusual result is evidence against a claim but not proof.

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Algebra 2, Unit 7, Lessons 5–8, https://im.kendallhunt.com/HS/teachers/3/7/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
