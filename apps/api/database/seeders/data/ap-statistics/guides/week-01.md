# Week 01 · Investigative Questions and Variables

**Topics:** 1.1 Introducing Statistics: What Can We Learn from Data? · 1.2 Variables
**Practices:** 1 (Formulate Questions), 2 (Collect Data), 3 (Analyze Data)
**Framework:** AP Statistics CED (effective fall 2026), Unit 1, Topics 1.1–1.2, learning objectives in our own words
**Spiral:** This is the first week, so it builds on nothing earlier in the course. It sets two habits you will use every week until May: start every investigation with a clear statistical question, and know what kind of variable you are looking at before you choose a graph or a number.

## What you need to be able to do

- **1.1** Explain why variability is the reason statistics is needed.
- **1.1** Tell a statistical investigative question from a survey question and from a question that is not statistical at all.
- **1.1** Write an investigative question that names a population, the variable or variables, and what is being described (a summary, a comparison or an association).
- **1.1** Explain how an investigative question decides what data to collect, from whom, and how to analyse them.
- **1.2** Identify the individuals and variables in a data set or a study description.
- **1.2** Classify a variable as categorical or quantitative, and a quantitative variable as discrete or continuous.

## Key terms

| Term | Meaning |
|---|---|
| Statistics | The study of how to collect, organise, analyse and interpret data so that we can learn from them despite variability. |
| Variability | The fact that values differ from individual to individual (and from sample to sample). |
| Statistical investigative question | A question about a group that anticipates variability and is answered by collecting and analysing data. |
| Survey (data-collection) question | A question asked of each individual to gather one value of a variable. |
| Population | The entire group of individuals an investigative question is about. |
| Sample | The part of the population from which data are actually collected. |
| Individuals (cases) | The objects described by a data set; one row of a data table each. |
| Variable | A characteristic recorded for each individual; one column of a data table. |
| Categorical variable | Places each individual into one of several groups. |
| Quantitative variable | Takes numerical values for which arithmetic, such as averaging, makes sense. |
| Discrete / continuous | A quantitative variable is discrete if its values are countable with gaps between them, continuous if it can take any value in an interval. |

## What statistics is for (1.1)

Suppose you want to know how much sleep students at your school get on a school night. If every student slept exactly 7 hours, you would ask one student and be done. They don't. One student sleeps 5.5 hours, another 9, another 7.25. **Variability** is why statistics exists: when individuals differ, a single observation cannot answer a question about the group, so we need methods for collecting many observations, summarising them and reasoning about what they tell us.

Every investigation in this course follows the same four steps, which are also the course's four practices:

1. **Formulate a question** that can be answered with data (Practice 1).
2. **Collect data** in a way that suits the question (Practice 2).
3. **Analyse the data** with graphs and numerical summaries (Practice 3).
4. **Interpret the results** in the context of the original question (Practice 4).

The steps are not one-way. Collecting data often shows that a question was vague; analysing often raises a new question. But the first step comes first: a fuzzy question produces data that answer nothing.

### Investigative questions and survey questions

Two very different kinds of question appear in every investigation.

- A **statistical investigative question** is about a *group*. It expects the answers to vary, and it is answered by summarising many values. Example: "How many hours do juniors at our school typically sleep on school nights, and how much does that vary?"
- A **survey question** (a data-collection question) is asked of *each individual*. Each person answers with one value. Example: "How many hours did you sleep last night?"

The survey question is the tool; the investigative question is the goal. A third kind of question, "How many students are enrolled at our school this year?", is **not statistical**: it has one fixed answer that you look up, with nothing that varies.

**Worked example 1: sorting questions.** A student interested in sleep wrote six questions. Sort them.

| Question | Kind | Why |
|---|---|---|
| How many hours did you sleep last night? | Survey | One person, one value |
| What time does the first bell ring? | Not statistical | One fixed answer |
| How much sleep do students at our school typically get on a school night? | Investigative (summary) | One group, one variable, anticipates variation |
| Do students who drink caffeine after 4 p.m. sleep less than students who do not? | Investigative (comparison) | Two groups, one variable |
| Did you drink anything with caffeine after 4 p.m. yesterday? | Survey | One person, one value (yes or no) |
| Is there an association between daily screen time and hours of sleep among students at our school? | Investigative (association) | Two quantitative variables on the same students |

Notice that the survey questions in the table are exactly what you would ask to collect the data for the investigative questions.

### What a good investigative question names

A good statistical investigative question names three things:

1. **The population**: whom the question is about ("students at our school this semester", "tomato plants in our greenhouse").
2. **The variable or variables**: what will be measured or recorded on each individual ("hours of sleep on a school night").
3. **What is being described**: one of three kinds.
   - A **summary** (descriptive) question describes one variable in one group: a typical value, a proportion, how much the values vary.
   - A **comparison** question compares one variable across two or more groups.
   - An **association** question asks whether two variables measured on the same individuals are related.

It should also be **answerable**: the data it needs must be possible to collect.

**Worked example 2: refining a vague question.** A student council member asks, "Are phones bad for students?" As written it names no population and no variable ("bad" is not something you can record), and it does not say what would be compared.

- *Name the population:* students at our school.
- *Choose measurable variables:* daily recreational phone use, and hours of sleep on school nights (one of many possible measures of "bad").
- *Decide the kind of question:* a comparison of two groups.

Refined: "Do students at our school who use their phones recreationally for more than 4 hours a day typically get less sleep on school nights than students who use them for 4 hours or less?" Keeping phone use as a number of hours instead would give an association question: "Is there an association between daily recreational phone use and hours of sleep among students at our school?" Both are good; they need slightly different analyses.

### How the question drives the rest

The investigative question is not decoration. It tells you:

- **whom to collect data from**: the population, or a sample from it (topics 1.10–1.12 study how to choose that sample well);
- **what to record**: one value of each named variable per individual;
- **what structure the data need**: a comparison needs individuals from every group, with group membership recorded; an association needs both variables measured *on the same individuals*, so they can be paired;
- **how to analyse**: a summary question calls for one graph and summary, a comparison for side-by-side displays, an association for a display of two variables together.

When you write the conclusion (Practice 4), you answer the investigative question in its own words and about its own population.

## Variables (1.2)

Data are usually stored in a **data table**: each row is one **individual** (a person, a plant, a day, a purchase) and each column is one **variable**. Each cell holds one individual's value of one variable.

A variable is **categorical** if it places each individual into a group (favourite sport, blood type, whether a student has a part-time job). It is **quantitative** if it takes numerical values for which arithmetic makes sense (hours of sleep, commute time in minutes, number of siblings).

The quick test: *would an average of these values mean anything?* The average commute time of a class is meaningful. The average ZIP code is not: ZIP codes, jersey numbers, locker numbers and phone numbers are **numbers used as labels**, so those variables are categorical even though their values are digits.

Quantitative variables come in two kinds.

- **Discrete:** a countable set of values with gaps between them, usually counts (number of siblings, goals in a game, texts sent yesterday).
- **Continuous:** any value in an interval, limited only by how precisely you measure (height, mass, time, hours of sleep).

How a variable is *recorded* matters. Exercise measured in hours is quantitative, but a survey that records only "0–2 hours", "3–5 hours" or "6 or more hours" produces a categorical variable with ordered categories: you can count how many students fall in each range, but you cannot average the ranges.

**Worked example 3: a class data table.** A statistics class recorded these variables (first four rows shown).

| Student | Sleep last night (hours) | Siblings | Favourite sport | Home ZIP code (invented) | Commute (minutes) | Part-time job |
|---|---|---|---|---|---|---|
| Ava | 7.5 | 2 | Soccer | 00211 | 12 | Yes |
| Ben | 6.0 | 0 | Basketball | 00205 | 25 | No |
| Chloe | 8.25 | 1 | None | 00211 | 8 | No |
| Dev | 5.5 | 3 | Track | 00217 | 31 | Yes |

- The **individuals** are the students in the class (the name column identifies them; it is not a variable we analyse).
- **Quantitative:** sleep (continuous), siblings (discrete), commute (continuous; recorded to the nearest minute, but time is continuous).
- **Categorical:** favourite sport, home ZIP code (labels), part-time job (yes or no).

So three of the six variables are categorical and three are quantitative. If the whole class has 28 students, the table holds 28 × 6 = 168 values of the variables.

**Worked example 4: deciding how to record a variable.** A hypothetical gym wants to know how long members' workouts last. It could record each workout's length in minutes, or record only "under 30 minutes", "30–60 minutes" or "over 60 minutes".

- In minutes, workout length is quantitative and continuous. The gym can compute a typical length, describe the spread, and later answer questions such as "How much longer are weekend workouts than weekday ones?"
- In three ranges, the variable is categorical. The gym can report the proportion of workouts in each range, but it has thrown away detail: a 31-minute and a 59-minute workout look the same.

The investigative question should decide. "What proportion of workouts last over an hour?" is answered by either version; "What is the typical workout length, and how much does it vary?" needs minutes. When in doubt, record the quantitative value: you can always group it later, but you cannot ungroup it.

Why does the type matter so much? Because it decides every tool you may use next. Categorical variables get counts, proportions and bar charts (week 2). Quantitative variables get dotplots, histograms, means, medians and standard deviations (weeks 3 and 4).

## Common mistakes

- **Offering a survey question as the investigative question.** "How much do you sleep?" is asked of one person; the investigative question is about the group.
- **Forgetting the population.** "Do teenagers sleep enough?" leaves unclear whose data to collect. Name the group.
- **Using a vague word as a variable.** "Bad", "healthy" and "better" are not recordable. Choose something you can measure.
- **Calling a variable quantitative because its values are numbers.** Ask whether averaging makes sense.
- **Treating an association question as a comparison (or the reverse) when planning data.** An association needs both variables on the same individuals.
- **Mixing up individuals and variables.** Individuals are the rows (what is described); variables are the columns (what is recorded).

## Self-check

1. Is "What is the most common way students at our school get to school?" a survey question, an investigative question, or not statistical?
2. Rewrite "Is the new cafeteria menu popular?" as a statistical investigative question.
3. Classify: (a) the number of pets in a household, (b) a shirt size recorded as S, M, L or XL, (c) the time a phone battery lasts.
4. A coach records players' jersey numbers and computes the mean. What is wrong?
5. An investigative question asks whether hours of practice per week are associated with free-throw percentage among the basketball players in a league. What must be recorded for each player?

*Answers:* 1. Investigative (a summary question about one categorical variable in one population). 2. One version: "What proportion of students at our school who buy lunch rate the new menu as good or excellent?" 3. (a) Quantitative, discrete. (b) Categorical (ordered). (c) Quantitative, continuous. 4. Jersey numbers are labels, so the variable is categorical and a mean is meaningless. 5. Both hours of practice per week and free-throw percentage, for the same player, so the values can be paired.

---

*Original study material for this course, organised around the College Board AP Statistics Course and Exam Description (Unit 1, Topics 1.1–1.2). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). All data are invented. AP® is a trademark of the College Board, which does not endorse this material.*
