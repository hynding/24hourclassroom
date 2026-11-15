# Week 07 · Experimental Design

**Topics:** 1.13 Experimental Design
**Practices:** 1 (Formulate Questions), 2 (Collect Data), 4 (Interpret Results)
**Framework:** AP Statistics CED (effective fall 2026), Unit 1, Topic 1.13, learning objectives in our own words
**Spiral:** Week 6 matched investigative questions to methods of data collection and showed that an observational study can reveal an association but not a cause. This week builds the tool that can establish a cause: the randomized experiment. It also completes the picture of what random selection (week 6) and random assignment (this week) each allow you to conclude.

## What you need to be able to do

- **1.13** Identify the experimental units, explanatory and response variables, factors, levels and treatments of an experiment.
- **1.13** Explain confounding and how random assignment deals with it.
- **1.13** Apply the four principles of design: comparison, random assignment, control and replication; use control groups, placebos and blinding where they help.
- **1.13** Describe a completely randomized design, a randomized block design or a matched pairs design, including a random assignment procedure someone else could carry out.
- **1.13** State the scope of inference: cause and effect from random assignment, generalization from random selection.

## Key terms

| Term | Meaning |
|---|---|
| Experimental unit | The smallest thing to which a treatment is assigned; called a subject when it is a person. |
| Factor | An explanatory variable the researcher manipulates. |
| Level | A specific value of a factor. |
| Treatment | A combination of factor levels given to a unit. |
| Confounding variable | A variable related to both the explanatory variable and the response, whose effect cannot be separated from the explanatory variable's. |
| Control group | A group that receives no treatment, an inactive treatment or the standard treatment, for comparison. |
| Placebo | An inactive treatment that looks like the real one. |
| Blinding | Keeping subjects (single-blind) or both subjects and evaluators (double-blind) unaware of who got which treatment. |
| Block | A group of units similar on a variable expected to affect the response. |
| Statistically significant | A difference too large to be plausibly explained by the chance variation of random assignment alone. |

## The language of experiments

In an experiment, the researcher **imposes** treatments. The **factor** is what is manipulated, its **levels** are the values used, and each **treatment** is a combination of levels. The **response variable** is what is measured afterward.

**Worked example 1.** A biology club studies tomato plants. It uses three fertilizers (none, organic, synthetic) and two watering schedules (daily, every other day), with 48 seedlings, and counts the tomatoes on each plant after ten weeks.

- Experimental units: the 48 seedlings.
- Factors: fertilizer (3 levels) and watering schedule (2 levels).
- Treatments: 3 × 2 = 6 combinations, such as "organic fertilizer, watered daily".
- Response: the number of tomatoes per plant.
- Replication: 48 ÷ 6 = 8 seedlings per treatment.

Two factors in one experiment are efficient: the club learns about both factors, and about whether the best fertilizer depends on the watering schedule, from a single study.

## Confounding and the four principles

Suppose a teacher tries a new lab-based unit with her morning class and the usual unit with her afternoon class, and the morning class scores higher. Was it the unit? Or were students more alert in the morning, or was the morning class stronger to begin with? Class period is **confounded** with the method: their effects are inseparable. Observational studies are full of such problems, and badly designed experiments have them too.

A well-designed experiment follows four principles:

1. **Comparison.** Use at least two treatments (one may be a control), so there is something to compare.
2. **Random assignment.** Use chance to assign treatments to units. This makes the groups roughly equivalent on every variable, including ones nobody thought to measure, so it is the main defence against confounding.
3. **Control.** Keep other variables the same for every unit (the same test, the same room, the same timing). This reduces variability in the response.
4. **Replication.** Use enough units in each treatment that the natural differences between units can be told apart from a treatment effect.

**Control groups, placebos and blinding.** People can improve simply because they believe they are being treated: the **placebo effect**. A placebo given to the control group means both groups have the same expectations. **Blinding** keeps knowledge of the treatments from influencing behaviour (subjects) or measurement (evaluators). It matters most when the response is a judgement, such as rating an essay or deciding whether pain improved. In a double-blind experiment, neither the subjects nor those who interact with them and measure the response know who received which treatment.

## Completely randomized designs

In a **completely randomized design**, all units are randomly assigned to treatments in one step. Describe the random assignment so that someone else could carry it out exactly:

1. Label the units (1 to N).
2. Use a random mechanism to choose the units for each treatment: a random number generator ignoring repeats, or well-mixed identical slips drawn without replacement.
3. Say what happens to the chosen units and to the rest.

**Worked example 2.** Does a 20-minute nap after lunch improve afternoon reaction time? Sixty student volunteers are available.

*Design.* Number the volunteers 1 to 60. Use a random number generator to select 30 different integers from 1 to 60, ignoring repeats. Those 30 students nap for 20 minutes in a quiet room after lunch; the other 30 rest quietly in the same kind of room for 20 minutes without sleeping (so both groups get a break, and only sleep differs). At 2 p.m. every student takes the same computer reaction-time test, scored by the computer, and the mean reaction times of the two groups are compared.

*Why each choice.* Random assignment balances sleep habits, caffeine use and fitness between the groups. The quiet-rest group is the comparison and controls for the break itself. The same test at the same time is control. Thirty per group is replication. Computer scoring means the measurement cannot be swayed by knowing the treatment.

A random mechanism that produces unequal groups, such as flipping a coin for each student, is still valid random assignment; if equal sizes are wanted, use the labelled-numbers or slips method.

## Randomized block designs

When a variable is known to affect the response, randomization will balance it only roughly. A **randomized block design** handles it directly: first form **blocks** of similar units, then randomly assign treatments separately within each block, and compare treatments within blocks.

**Worked example 3a.** A teacher compares two study methods (flashcards, practice tests) on a vocabulary quiz, with 40 students: 16 in honors English and 24 in regular English. Honors students are likely to score higher whatever the method. Block by course: within the 16 honors students, randomly assign 8 to each method; within the 24 regular students, randomly assign 12 to each. Comparing methods within each block removes the honors/regular difference from the comparison, so a real difference between the methods is easier to detect.

Remember the slogan: **block what you can, randomize what you cannot.** Blocking reduces variability; it does not replace random assignment.

## Matched pairs designs

A **matched pairs design** is a block design with blocks of size two. Either each subject receives both treatments in a random order, or subjects are paired by similarity and a coin flip decides which member of each pair gets which treatment.

**Worked example 3b.** Is a split keyboard faster than a standard one? Ten students each type the same kind of passage for three minutes on each keyboard. For each student a coin flip decides which keyboard comes first (so practice or fatigue cannot favour one keyboard). Typing speeds, in words per minute:

| Student | 1 | 2 | 3 | 4 | 5 | 6 | 7 | 8 | 9 | 10 |
|---|---|---|---|---|---|---|---|---|---|---|
| Standard | 52 | 61 | 45 | 70 | 58 | 49 | 66 | 55 | 63 | 47 |
| Split | 55 | 64 | 44 | 74 | 62 | 53 | 67 | 59 | 66 | 50 |
| Split − standard | 3 | 3 | −1 | 4 | 4 | 4 | 1 | 4 | 3 | 3 |

The mean difference is 28 ÷ 10 = 2.8 words per minute in favour of the split keyboard, and 9 of the 10 students typed faster on it. Notice the scale of the variation: speeds range from 44 to 74 words per minute across students, but the differences range only from −1 to 4. Comparing each student with themself removes the large student-to-student differences, so a gain of about 3 words per minute stands out. Had 10 students used each keyboard in a completely randomized design, that small gain would have been buried among skill differences of 20 or more words per minute. (Whether 2.8 is statistically significant is a question for Unit 4.)

## Statistical significance: a first look

Random assignment never produces identical groups. Even if a treatment does nothing, one group's mean will be a little higher by chance. So the question after an experiment is: is the observed difference **larger than random assignment alone would plausibly produce?** If so, the difference is called **statistically significant**, and it is evidence that the treatment has a real effect. Simulation (Unit 2) and tests (Units 3 and 4) make "plausibly" precise.

## Scope of inference

The two kinds of randomness answer two different questions.

| | Random assignment | No random assignment |
|---|---|---|
| **Random selection** | Cause and effect; generalize to the population | Association only; generalize to the population |
| **No random selection** | Cause and effect; only for units like those in the study | Association only; only for the sample |

**Worked example 4.** Place each study in the grid.

1. An SRS of 500 adults in a city is surveyed about exercise and stress. *Random selection only:* an association that extends to the city's adults; no cause.
2. Forty volunteers are randomly assigned to two diets. *Random assignment only:* the diet causes the difference, for people like these volunteers.
3. An SRS of 200 students from a district is randomly split between two reading programs. *Both:* the program causes the difference, and the conclusion extends to the district's students.
4. A teacher compares quiz scores of students who chose to sit in the front row with those who sat at the back. *Neither:* an association for these students only.

Experiments on people also have ethical requirements: informed consent, no avoidable harm, confidential data and review of the plan in advance. Some causal questions (does vaping harm teenagers' lungs?) can never be studied by assigning the treatment, and must rely on the accumulated evidence of many observational studies.

## Common mistakes

- **Confusing random selection and random assignment.** Selection decides who is studied (generalization); assignment decides who gets which treatment (cause).
- **Vague random assignment.** "Randomly split the students" earns nothing; label, describe the mechanism, avoid repeats, say who gets what.
- **Treating blocking as randomization.** Units are still randomly assigned within each block.
- **Assigning treatments to intact groups.** Giving each method to a whole class confounds the method with the class.
- **Forgetting the experimental unit.** If whole classrooms are assigned, the classroom is the unit.
- **Calling chance differences proof.** Ask whether the difference is statistically significant; never say an experiment proves.

## Self-check

1. A study uses 2 light colours and 4 temperatures, with 5 plants per combination. How many treatments and how many plants?
2. Why does a medical experiment give the control group a placebo rather than nothing?
3. In a study of whether a podcast improves algebra scores, the teacher blocks by prior algebra grade. Why?
4. A pair of twins is split so that one twin follows each of two training plans, by coin flip. Which design is this?
5. Volunteers randomly assigned to a new study app score significantly higher. Can the result be applied to all students in the state?
6. Explain the difference between single-blind and double-blind.

*Answers:* 1. 2 × 4 = 8 treatments, 40 plants. 2. To balance the placebo effect, so both groups have the same expectation of treatment. 3. Prior grade is related to algebra scores, so blocking removes that variation and makes the podcast's effect easier to see. 4. Matched pairs (the twins are a matched pair). 5. No: random assignment supports a cause for students like the volunteers, but generalizing needs a random sample from the state. 6. Single-blind: one party (subjects or evaluators) does not know the treatments; double-blind: neither knows.

---

*Original study material for this course, organised around the College Board AP Statistics Course and Exam Description (Unit 1, Topic 1.13). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). All data are invented. AP® is a trademark of the College Board, which does not endorse this material.*
