# Week 06 · Investigative Questions, Data Collection and Sampling

**Topics:** 1.10 The Investigative Question Revisited and Data Collection · 1.11 Random Sampling · 1.12 Potential Problems with Sampling
**Practices:** 1 (Formulate Questions), 2 (Collect Data), 4 (Interpret Results)
**Framework:** AP Statistics CED (effective fall 2026), Unit 1, Topics 1.10–1.12, learning objectives in our own words
**Spiral:** Week 1 introduced the statistical investigative question and the difference between a population and a sample; weeks 2 to 5 analysed data that someone had already collected. This week goes back to the start of the investigative process and asks how the data should be collected, because the method of collection decides what any analysis is allowed to conclude.

## What you need to be able to do

- **1.10** Match an investigative question to a method of data collection: census, sample survey, observational study or experiment.
- **1.10** Explain what each method allows you to conclude: generalizing to a population, or cause and effect.
- **1.11** Describe how to select a simple random, stratified, cluster or systematic random sample, in enough detail to be carried out.
- **1.11** Explain the benefits of each method and the effect of sample size on sampling variability.
- **1.12** Identify convenience and voluntary response sampling, undercoverage, nonresponse and response bias, and explain the likely direction of each bias in context.

## Key terms

| Term | Meaning |
|---|---|
| Census | Data collected from every individual in the population. |
| Sample survey | Data collected from a subset of the population, to learn about the whole population. |
| Observational study | Individuals are observed and measured; no treatment is imposed. |
| Experiment | Treatments are deliberately imposed on individuals to see how they respond. |
| Sampling frame | The list from which the sample is actually drawn. |
| Simple random sample (SRS) | Every possible group of n individuals has the same chance of being chosen. |
| Stratified random sample | Separate SRSs from groups (strata) of similar individuals, combined. |
| Cluster sample | An SRS of groups (clusters), with every individual in the chosen clusters measured. |
| Systematic random sample | A random start among the first k on a list, then every kth individual. |
| Sampling variability | The chance variation of a statistic from one random sample to another. |
| Bias | A method that systematically pushes results in one direction. |

## The investigative question decides the data collection (1.10)

Week 1's investigative question names a population and a variable. Now look at what it asks, because different questions need different kinds of data.

| The question asks... | Collect data by... | You may conclude... |
|---|---|---|
| about a whole small population | a census | facts about that population (no sampling error) |
| what is typical, or what proportion, in a large population | a sample survey with a random sample | an estimate for the population sampled |
| whether two variables are related, as they occur naturally | an observational study | an association, generalized to the population if the sample was random |
| whether one variable causes a change in another | a randomized experiment | cause and effect, for individuals like those in the experiment |

The decisive word is often a verb. "Do students who play an instrument tend to have higher GPAs?" asks about an association, and an observational study can answer it. "Does learning an instrument raise GPA?" asks about a cause, and only an experiment with random assignment can answer it, because students who choose instruments may differ in many other ways (family income, study habits, free time). When a third variable is linked to both the explanatory variable and the response, its effect is tangled up with the one you care about. Week 7 calls such a variable a confounding variable and shows how experiments deal with it.

Observational studies can be **retrospective** (looking back at records already kept, such as last year's attendance and grades) or **prospective** (following individuals forward, such as recording sleep for a semester). Either way, no treatment is imposed.

**Worked example 1.** A school district wonders about its lunch program. Match each question to a method.

1. "What proportion of the 140 teachers in the district think lunch periods are too short?" A **census**: the population is small and listed, so ask every teacher.
2. "What is the typical amount of food, in grams, thrown away per lunch by the district's 9,000 students?" A **sample survey**: weigh the waste from a random sample of students' trays.
3. "Do students who buy school lunch tend to have better afternoon attendance than students who bring lunch from home?" An **observational study**: students choose how they get lunch; record both variables. It can show an association, not a cause.
4. "Does offering a salad bar cause students to eat more vegetables?" An **experiment**: randomly assign some schools (or lunch periods) to get a salad bar and compare vegetable consumption.

## Random sampling (1.11)

Random selection is the only reliable way to make a sample represent a population: it removes the sampler's preferences and makes chance, which can be measured, the only source of error.

**Simple random sample.** Every possible group of n individuals has the same chance to be the sample. To select one:

1. Label every individual in the population (1 to N) using a complete list.
2. Use a random number generator to produce integers from 1 to N, ignoring repeats, until you have n different labels (or put every name on an identical slip, mix well and draw n without replacement).
3. The individuals with those labels are the sample.

Full credit for a description needs all three: labels, a random mechanism without repeats, and how the labels identify the sample.

**Stratified random sample.** Divide the population into **strata**, groups of individuals that are similar on some characteristic related to the response; take a separate SRS from each stratum; combine. If the strata really differ, a stratified sample guarantees each is represented and gives estimates that vary less than an SRS of the same size.

**Cluster sample.** Divide the population into **clusters**, usually groups that are physically together (homerooms, city blocks, crates of oranges); take an SRS of clusters; measure every individual in each chosen cluster. Its advantage is practical: it is cheaper and faster. It works best when each cluster is a mini-version of the population.

**Systematic random sample.** From an ordered list of N, let k = N/n; pick a random start among the first k, then take every kth individual. Quick and spread across the list, but risky if the list has a pattern that repeats every k positions.

Keep the contrast straight: **stratified** takes *some individuals from every group*; **cluster** takes *every individual from some groups*. Strata should be alike inside; clusters should be varied inside.

**Worked example 2.** A high school of 1,200 students (300 in each grade) wants a sample of 40 for a survey on homework.

- *SRS:* number the students 1 to 1,200 on the enrollment list; generate random integers from 1 to 1,200, skipping repeats, until 40 are chosen.
- *Stratified by grade:* within each grade, number the 300 students 1 to 300 and choose 10 different random numbers; 4 × 10 = 40 students.
- *Cluster:* the school has 40 homerooms of 30. Choose 2 homerooms at random (numbers 1 to 40, no repeat) and survey all 60 students in them. (The cluster method makes exact sample sizes awkward; that is a common trade-off.)
- *Systematic:* k = 1,200/40 = 30. Pick a random number from 1 to 30, say 22, then take students 22, 52, 82, ..., 1,192 on the list.

**Worked example 3 (why stratify?).** In a hypothetical school of 1,200 students, weekly hours worked at part-time jobs average about 2 for freshmen, 5 for sophomores, 9 for juniors and 14 for seniors. Grade is strongly related to the response, so it makes good strata. In a computer simulation of 5,000 samples of 40 students from such a school:

| Method | SD of the 5,000 sample means | Range of sample means |
|---|---|---|
| SRS of 40 | about 0.89 hours | about 4.6 to 10.6 hours |
| 10 from each grade | about 0.54 hours | about 5.5 to 9.4 hours |

Both methods are centered on the true mean (about 7.4 hours), but the stratified estimates cluster much more tightly. An SRS sometimes gets, by chance, too many seniors or too many freshmen; stratifying rules that out.

**Sampling variability and sample size.** Every random sample gives a slightly different statistic. That chance variation shrinks as n grows: a sample of 400 gives a more precise estimate than a sample of 40. Unit 2 measures this precisely with sampling distributions. But sample size controls only chance variation. It does nothing about bias.

## Potential problems with sampling (1.12)

A biased method misses the truth in the same direction again and again. The main sources:

| Problem | What happens | Typical direction |
|---|---|---|
| Convenience sampling | Easy-to-reach individuals are chosen | Toward the views or habits of people who are easy to reach |
| Voluntary response | People choose themselves | Toward strong (often negative) opinions |
| Undercoverage | Part of the population cannot be chosen (incomplete frame) | Toward the groups that are on the list |
| Nonresponse | Chosen individuals cannot be reached or refuse | Toward the views of those who reply |
| Response bias | Answers are systematically untrue: wording, sensitive topics, interviewer effects | Toward the "acceptable" or suggested answer |

Undercoverage and nonresponse are easy to confuse. Undercoverage happens **before** selection (the frame misses people); nonresponse happens **after** selection (chosen people do not answer). Voluntary response is different again: nobody was chosen; people opted in.

A full-credit explanation of bias has three parts: name the problem, say **who** is over- or under-represented and **how they differ** on the variable, and give the **direction** in context.

**Worked example 4.** The council of a hypothetical high school wants the proportion of its students who favour moving the start of the day from 7:30 to 8:30 a.m.

- *Plan 1:* a link on the council's social media page. **Voluntary response.** Students with strong feelings, mostly those desperate for a later start, are most likely to vote, so the proportion in favour is likely an **overestimate**. Students who do not follow the page are also missed.
- *Plan 2:* a random sample of 200 drawn from the list of students who ride the school bus. **Undercoverage**: students who drive or walk cannot be chosen. Drivers are mostly older students with jobs after school, who might oppose a later end to the day, so support could be **overestimated**.
- *Plan 3:* an SRS of 200 from the full enrollment list, asked in person by the principal, "Would you support a later start, even though it means practices and jobs end an hour later?" Random selection fixes the frame, but two new problems appear: **response bias** from the wording (it stresses a cost) and from the interviewer (students may say what they think the principal wants). Both probably push support **down**.

*A better plan:* an SRS (or a sample stratified by grade) from the full enrollment list, an anonymous survey with neutral wording ("Do you support or oppose moving the start of the school day from 7:30 to 8:30 a.m.?"), and follow-up reminders to reduce nonresponse.

## Common mistakes

- **Claiming cause from an observational study.** Association only, unless treatments were randomly assigned.
- **"Large sample, so no bias."** A larger sample reduces sampling variability, never bias.
- **Calling any random-looking choice an SRS.** One student from each homeroom gives every student an equal chance but is not an SRS: two students from the same homeroom can never be chosen together.
- **Mixing up strata and clusters.** Strata: similar inside, sample from all. Clusters: varied inside, sample some, take everyone.
- **Nonresponse versus voluntary response.** Were they chosen at random first? Then a missing answer is nonresponse.
- **Naming a bias without its direction.** Say who is over-represented, how they differ, and whether the estimate is likely too high or too low.
- **Leaving out "ignore repeats".** A random number generator can repeat a label.

## Self-check

1. "Does a four-day school week improve attendance?" Which method of data collection can answer this, and why?
2. A teacher puts the names of 30 students in a hat and draws 5. What makes this a valid SRS?
3. An orchard picks 6 of its 200 rows of apple trees at random and inspects every tree in those rows. Name the method.
4. A phone survey dials randomly generated landline numbers. Which bias is the main concern for a question about smartphone habits of teenagers?
5. Of 1,000 randomly chosen voters sent a survey, 210 return it. Name the problem.
6. Why does stratifying by grade help when estimating hours of part-time work?

*Answers:* 1. A randomized experiment (randomly assign schools, or comparable groups, to the four-day week), because only random assignment supports a cause-and-effect conclusion. 2. Identical slips, thorough mixing, drawing without replacement, so every group of 5 has the same chance. 3. Cluster sampling (rows are clusters). 4. Undercoverage: households without a landline, which are more common among younger families, cannot be reached. 5. Nonresponse (79% did not reply). 6. Hours differ greatly by grade, so each stratum is similar inside, every grade is represented, and estimates vary less than with an SRS.

---

*Original study material for this course, organised around the College Board AP Statistics Course and Exam Description (Unit 1, Topics 1.10–1.12). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). All data are invented. AP® is a trademark of the College Board, which does not endorse this material.*
