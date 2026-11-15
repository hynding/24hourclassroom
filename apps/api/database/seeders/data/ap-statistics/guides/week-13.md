# Week 13 · The Normal Distribution

**Topics:** 2.11 The Normal Distribution
**Practices:** 3 (Analyze Data), 4 (Interpret Results)
**Framework:** AP Statistics CED (effective fall 2026), Unit 2, Topic 2.11, learning objectives in our own words
**Spiral:** Unit 1 measured a value's position with percentiles and z-scores and described shape, centre and spread. Week 11 described random variables by their distributions; week 12 met the binomial distribution, whose shape grows closer to a bell as n grows. This week introduces the most important continuous distribution, the normal distribution, which next week becomes the model for sampling distributions and, from Unit 3 on, the engine of inference.

## What you need to be able to do

- **2.11** Describe a normal distribution by its mean μ and standard deviation σ, and explain how each parameter changes the curve.
- **2.11** Use the empirical rule (68–95–99.7) to estimate proportions and percentiles quickly.
- **2.11** Standardise a value with z = (x − μ)/σ and interpret z in context.
- **2.11** Find the proportion of a normal distribution below, above or between given values, with a calculator or a table, and show the work in words and symbols.
- **2.11** Find the value that cuts off a given proportion (a percentile), and work backwards to an unknown mean or standard deviation.
- **2.11** Decide whether a normal model is reasonable for a variable, using shape and the summary statistics.

## Key terms

| Term | Meaning |
|---|---|
| Density curve | A curve on or above the horizontal axis with total area 1; the area over an interval is the proportion of values (or the probability) in that interval. |
| Normal distribution | A symmetric, single-peaked, bell-shaped density curve described completely by its mean μ and standard deviation σ; written N(μ, σ). |
| Inflection points | The points where the normal curve changes from curving down to curving up; they sit at μ − σ and μ + σ. |
| Empirical rule | In a normal distribution about 68% of values fall within 1σ of μ, about 95% within 2σ, and about 99.7% within 3σ. |
| z-score | z = (x − μ)/σ, the number of standard deviations a value lies above (positive) or below (negative) the mean. |
| Standard normal distribution | N(0, 1), the distribution of z-scores from any normal distribution. |
| Percentile | The value with a given proportion of the distribution at or below it. |

## Normal curves and their parameters (2.11)

A **density curve** models the overall pattern of a quantitative variable. The area under the curve between two values is the proportion of the population between those values, and the total area is 1. Because the area above a single point is zero, P(X = 18.5) = 0 for a continuous variable, and P(X < 15) is the same as P(X ≤ 15).

A **normal distribution** is the family of symmetric bell-shaped curves. Its mean μ sits at the centre, at the peak; it is also the median. The standard deviation σ sets the spread: the curve's inflection points are one σ either side of μ. Changing μ slides the curve left or right without changing its shape. Increasing σ makes the curve lower and wider, because the total area must stay 1.

Many variables are approximately normal: heights of plants grown in the same conditions, the fill volumes of a machine, measurement errors, and (as next week shows) the means of large random samples. Many others are not: income, waiting times and minutes of homework are usually skewed right. A normal model is a tool for a distribution that really is close to normal, not a default for every variable.

## The empirical rule (2.11)

In any normal distribution:

- about 68% of values lie within one standard deviation of the mean (μ ± σ),
- about 95% lie within two standard deviations (μ ± 2σ),
- about 99.7% lie within three standard deviations (μ ± 3σ).

**Worked example (empirical rule).** Suppose nightly sleep for students at a hypothetical high school is approximately normal with mean 7.1 hours and standard deviation 1.2 hours.

- About 68% of students sleep between 7.1 − 1.2 = 5.9 and 7.1 + 1.2 = 8.3 hours.
- About 95% sleep between 4.7 and 9.5 hours.
- About 99.7% sleep between 3.5 and 10.7 hours.
- By symmetry, the 5% outside 4.7 to 9.5 hours splits evenly, so about 2.5% of students sleep more than 9.5 hours, and 9.5 hours is about the 97.5th percentile.

The rule is an approximation that applies only to normal distributions. For a value that is not a whole number of standard deviations away, use z-scores and technology.

## Standardising and finding areas (2.11)

To compare a value with its distribution, convert it to a **z-score**:

> z = (x − μ)/σ

A z-score has no units. It says how many standard deviations the value is from the mean, and in which direction. If X is normal, then z follows the standard normal distribution N(0, 1), so a single table (or a calculator's normalcdf) handles every normal distribution.

A complete answer to a normal-distribution question has four parts. Examiners look for all of them.

1. **State the distribution and the question:** "X = hours of sleep, X is N(7.1, 1.2); find P(X < 6)."
2. **Standardise or label the calculator inputs:** z = (6 − 7.1)/1.2 = −0.92, or normalcdf(lower = −1000, upper = 6, μ = 7.1, σ = 1.2).
3. **Find the area:** 0.180 (a table gives 0.1788 for z = −0.92; the small difference is rounding of z).
4. **Answer in context:** "About 18% of students at this school sleep less than 6 hours a night."

A sketch of the curve with the region shaded is the fastest way to catch a wrong tail.

**Worked example (between two values).** What proportion of students sleep between 6.5 and 8 hours?

z for 6.5 is (6.5 − 7.1)/1.2 = −0.50; z for 8 is (8 − 7.1)/1.2 = 0.75. The area between is P(−0.50 < Z < 0.75) = 0.7734 − 0.3085 = 0.465. About 46.5% of the school's students sleep between 6.5 and 8 hours.

**Worked example (comparing values from different distributions).** A student scored 88 on a chemistry test where the class mean was 76 and the SD was 8, and 41 on a history quiz where the mean was 34 and the SD was 4. Which score was better relative to the class?

Chemistry: z = (88 − 76)/8 = 1.50. History: z = (41 − 34)/4 = 1.75. The history score is 1.75 standard deviations above its mean, the chemistry score only 1.5, so the history score was relatively better, even though 88 is the bigger number. When a lower value is better (race times, golf scores), the more negative z-score is the better performance.

## Working backwards: percentiles and unknown parameters (2.11)

Sometimes you know an area and need the value. Find the z-score with that area to its left (invNorm on most calculators, or the body of a table), then undo the standardisation: x = μ + zσ.

**Worked example (a percentile).** How much sleep marks the 90th percentile? The z-score with 0.90 to its left is 1.2816, so x = 7.1 + 1.2816(1.2) = 8.64 hours. About 90% of students sleep 8.64 hours or less; the top 10% sleep more.

Be careful with "top" and "bottom". The cut-off for the top 5% is the 95th percentile (area 0.95 to its left), not the 5th.

**Worked example (an unknown standard deviation).** A hypothetical juice machine fills bottles with mean 350 mL. The manager wants only 2% of bottles to contain less than 340 mL. What standard deviation must the machine achieve, assuming fills are normal?

The z-score with 0.02 to its left is −2.054. Set −2.054 = (340 − 350)/σ and solve: σ = 10/2.054 = 4.87 mL. The machine needs a standard deviation of about 4.9 mL or less.

## Is a normal model reasonable? (2.11)

Before using a normal model on data, check the shape. A histogram or dotplot should be roughly symmetric and single-peaked with no strong outliers. A quick check on summary statistics also helps: if a variable cannot be negative but its mean is less than about two standard deviations above zero, a normal model would put a noticeable proportion of values below zero, so the distribution must be skewed right.

For example, hypothetical nightly homework times have mean 52 minutes and SD 38 minutes, with a minimum of 0. A normal model would predict P(X < 0) = 0.086, about 9% of students doing negative homework. That is impossible, so the distribution is skewed right and a normal model is not appropriate.

## Common mistakes

- Using the wrong tail: finding P(X < 15) when the question asks for the proportion above 15.
- Dividing by the variance instead of the standard deviation when computing z.
- Giving bare calculator syntax ("normalcdf(−1000, 6, 7.1, 1.2)") as the whole answer; label μ, σ and the bounds, or show the z-score, and answer in context.
- Using the empirical rule for values that are not whole numbers of standard deviations from the mean, or for a distribution that is not normal.
- Confusing "top 5%" with the 5th percentile.
- Treating a larger z-score as better when a lower value (a race time) is better.
- Applying a normal model to a variable that is clearly skewed.

## Self-check

1. Heights of hypothetical sunflower plants after six weeks are N(64, 5) cm. Between which two heights do the middle 95% fall? **Answer:** 54 cm and 74 cm.
2. What proportion of those plants are taller than 70 cm? **Answer:** z = 1.2; P(X > 70) = 0.115.
3. Find the 30th percentile of the plant heights. **Answer:** z = −0.524, so x = 64 − 0.524(5) = 61.4 cm.
4. A sprinter runs 12.1 s where the mean is 12.8 s and SD 0.4 s; a swimmer swims 58.0 s where the mean is 60.5 s and SD 1.25 s. Who did relatively better? **Answer:** z = −1.75 for the sprinter and −2.0 for the swimmer; lower times are better, so the swimmer.
5. For the sleep distribution, is it reasonable to say P(X = 7.1) = 0.5? **Answer:** No. For a continuous model the probability of any exact value is 0; P(X ≤ 7.1) = 0.5.

---

*Original study material for this course, organised around the College Board AP Statistics Course and Exam Description (Unit 2, Topic 2.11). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). All data are invented. AP® is a trademark of the College Board, which does not endorse this material.*
