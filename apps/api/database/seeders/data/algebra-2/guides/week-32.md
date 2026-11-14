# Week 32 · Analyzing Experiments

**Lessons:** 7.13 Experimenting · 7.14 Using Normal Distributions for Experiment Analysis · 7.15 Questioning Experimenting · 7.16 Heart Rates
**Practices:** MP3 (construct arguments and critique reasoning), MP4 (model with mathematics), MP5 (use tools strategically)
**Built from:** IM Algebra 2, Unit 7, Lessons 13–16, in our own words
**Spiral:** Random assignment (week 29) is what makes the analysis here valid. The normal model and tail areas from z-scores (week 30) are applied to a new distribution, the differences in means from random regroupings. "Is this result unusual?" (week 30) and the sampling distributions of week 31 are the same idea one more time: compare what happened with what chance alone would produce.

## What you need to be able to do

- **7.13** Compute the difference between the treatment group's mean and the control group's mean, explain why a difference could arise from the random grouping alone, and build a **randomization distribution** by regrouping the data at random many times.
- **7.14** Describe a randomization distribution (roughly normal, centred at 0), find the proportion of regroupings at least as extreme as the observed difference, model it with a normal distribution, and decide whether the treatment likely caused the difference.
- **7.15** Ask the right questions about an experiment's data and design: the observed difference, the spread of the regrouping differences, the proportion more extreme, the sample size, random assignment, a control group, and what was measured.
- **7.16** Run a small experiment from start to finish: collect data, compute group means, build a randomization distribution and draw a conclusion.

## Key terms

| Term | Meaning |
|---|---|
| Treatment group, control group | The subjects who receive the treatment, and those who do not (or get a placebo), chosen by random assignment. |
| Difference in means | (mean of the treatment group) − (mean of the control group); the observed effect. |
| Randomization distribution | The differences in means obtained by shuffling all the subjects' results into two groups of the same sizes at random, many times. It shows what chance alone produces. |
| "At least as extreme" | A regrouping difference as far from 0 as the observed one, in either direction. |
| Significant difference | One that few random regroupings match (less than the cutoff chosen before the experiment, often 5%), so the treatment is the likelier explanation. |
| Placebo, blinding | A fake treatment so the control group has the same experience; keeping subjects (and measurers) unaware of who got which, so expectations do not shape the results. |

## Experimenting (7.13)

Sixteen seedlings are split at random: eight get a new fertilizer, eight do not. Heights after a month, in centimetres:

| Fertilizer | 8 | 11 | 9 | 12 | 10 | 7 | 13 | 10 |
|---|---|---|---|---|---|---|---|---|
| **Control** | 6 | 9 | 5 | 8 | 7 | 6 | 10 | 5 |

Mean of the fertilizer group 80/8 = 10 cm; mean of the control group 56/8 = 7 cm; **difference 3 cm**. Did the fertilizer do that?

Maybe not: with only eight plants per group, the random split could have put the naturally taller seedlings in the fertilizer group. To see how big a difference chance alone makes, pretend the fertilizer did nothing. Then the 16 heights would have been the same whichever group each plant landed in, so **shuffle the 16 heights into two groups of 8 at random, compute the difference in means, and repeat** hundreds of times. The collection of those differences is the **randomization distribution**. If the real difference of 3 cm sits out in its tail, chance is an unlikely explanation and the fertilizer is the likely one.

**Worked example.** Three random regroupings of the 16 heights give differences of 0.75, −1.25 and 0.25. What do they tell you so far?

Chance produces differences of around a point either side of 0; none of the three is anywhere near 3. More regroupings are needed before concluding, but 3 is starting to look unusual.

**Why random assignment is essential.** The whole argument assumes the two groups differed only by chance before the treatment. If the gardener had put the strongest seedlings in the fertilizer group, the shuffling would be comparing the wrong thing. Random assignment, and only random assignment, makes "chance or treatment" the only two explanations.

**Try it.** A class tests whether counting aloud during exercise changes the rise in heart rate. State the treatment, the control, how to assign students, and what difference you would compute.

*Answer:* Treatment: counting aloud; control: silent exercise; assign by shuffled slips or coin flips; difference = (mean heart-rate rise of counters) − (mean rise of silent group).

## Using a normal model (7.14)

Run the regrouping 1,000 times and plot the differences. The plot is roughly bell-shaped and **centred at 0**: shuffling has no preference for either group. Suppose its standard deviation is 1.2 cm.

Two ways to judge the observed difference of 3 cm:

1. **Count.** The proportion of the 1,000 regroupings with a difference at least as extreme as 3 (that is, ≥ 3 or ≤ −3). If only 11 of 1,000 are, that proportion is about 1%.
2. **Normal model.** 3 cm is z = 3/1.2 = 2.5 standard deviations from 0. The area beyond z = 2.5 is 1 − 0.994 = 0.006 in each tail, about 1.2% in both tails together.

Either way the observed difference would happen by chance only about 1% of the time. With a cutoff of 5% chosen in advance, the difference is **significant**: the fertilizer very likely made the plants taller.

**Set the cutoff before you look.** Common cutoffs are 1%, 5% and 10%. Choosing one after seeing the data lets you pick whichever makes the answer you wanted.

**Worked example.** In a bird-feeding experiment the observed difference in mean weight gain is 1.1 g, and 1,000 random regroupings give differences with mean 0 and standard deviation 1.2 g. Is the treatment effect significant at 5%?

z = 1.1/1.2 ≈ 0.92; the area beyond 0.92 is about 0.18 in each tail, roughly 36% of regroupings are at least that extreme. A difference like 1.1 g is ordinary for chance alone; there is **not enough evidence** that the feed made a difference. (Not "the feed does nothing": the experiment was too small to tell.)

**Worked example.** A difference of 4.5 points with regrouping standard deviation 1.5: z = 3; the area beyond 3 is 0.001 per tail. Significant at 1%.

**Try it.** Observed difference 2.0, regrouping standard deviation 1.25, cutoff 5%. Decide.

*Answer:* z = 1.6; area beyond 1.6 is about 0.055 per tail, about 11% both tails. Not significant at 5%; chance remains a plausible explanation.

## Questioning an experiment (7.15)

Reading a report of an experiment, ask for the numbers that let you judge it:

- What was the **observed difference in means**, and which direction?
- What are the **mean and standard deviation of the regrouping differences** (or the proportion of regroupings at least as extreme)?
- How many subjects were in each group? Small groups make large chance differences common.
- Was the assignment **random**? Was there a **control group**? Did the control get a **placebo** so the only difference was the treatment itself?
- Were subjects and measurers **blind** to who got the treatment?
- Was the response measured the same way, at the same time, for both groups?
- Was the cutoff chosen before the data were seen?

**Worked example.** Strawberry plants: 20 in new soil, 20 in old, assigned at random; mean yields 310 g and 280 g, difference 30 g; 500 regroupings give differences with standard deviation 18 g. Judge it.

z = 30/18 ≈ 1.67; area beyond is about 0.048 per tail, about 10% both tails. At a 5% cutoff the result is not quite significant; at 10% it is. Report: "some evidence the new soil raises yield, not conclusive; a larger experiment would settle it."

**Worked example.** A vitamin study gives the treatment group the vitamin and the control group nothing, and the subjects know which group they are in. The treatment group reports feeling more energetic. What is wrong?

No placebo and no blinding: people who know they are taking something often report feeling better regardless. The control should get an identical-looking pill, and nobody should know who has which until the end.

**Try it.** A tutoring program is tested by letting students volunteer for it; the volunteers' scores rise more than the others'. List two questions that undermine the conclusion.

*Answer:* Was assignment random (no: volunteers chose), so do the groups differ in motivation? Was anything else different for the volunteers (extra time, attention)? Without random assignment the regrouping argument does not apply.

## Heart rates (7.16)

Measure your resting heart rate: count beats for 10 seconds and multiply by 6. Then run two experiments on the class, with random assignment each time:

- **Counting:** everyone does the same light exercise; half count aloud, half stay silent. Record each person's rise in heart rate. Compute the difference in mean rise between the groups.
- **Flapping:** half do full jumping jacks, half only move their arms. Record and compare the same way.

For each, shuffle the class's recorded rises into two groups many times (slips of paper work, or technology), build the randomization distribution, and find where the observed difference falls. Typically counting makes no significant difference (its observed difference lands in the middle of the regroupings) while full jumping jacks make a large, significant one (far in the tail). Write the conclusion with its evidence: the difference, the spread of the regroupings, the proportion more extreme, and the cutoff you set.

**Beyond the means.** Compare the two groups' dot plots too. Two groups can have the same mean and very different spreads or shapes, and a difference in means can be driven by one extreme subject.

## Common mistakes

- **Concluding from the difference alone.** A 3 cm difference means nothing until you know how big chance differences are.
- **Centring the randomization distribution at the observed difference.** It is centred at 0: shuffling assumes no treatment effect.
- **Using one tail when "extreme" means either direction.** Count both tails unless the question is one-directional.
- **"Not significant" read as "no effect".** It means the experiment could not tell; a bigger one might.
- **Choosing the cutoff after seeing the result.**
- **Applying the method to an observational study.** Without random assignment, regrouping has no justification.

## Where this goes next

The unit exam covers study design, distributions, the normal model, margins of error and experiment analysis. After it, the exam-prep guide and practice final pull together all seven units.

## Self-check

1. Treatment results 14, 17, 15, 18; control results 12, 13, 11, 14. Find the difference in means and explain what a randomization distribution would show.
2. An observed difference is 2.4 with regrouping standard deviation 0.8. Find z and the approximate two-tailed proportion, and decide at a 5% cutoff.
3. An observed difference is 0.9 with regrouping standard deviation 1.0. Decide at 5% and state the conclusion carefully.
4. List four design questions to ask about a published experiment.
5. Explain why the randomization distribution is centred at 0 and why random assignment is needed for the method to make sense.

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Algebra 2, Unit 7, Lessons 13–16, https://im.kendallhunt.com/HS/teachers/3/7/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
