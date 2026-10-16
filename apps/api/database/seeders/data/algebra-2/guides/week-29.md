# Week 29 · Study Design and Describing Distributions

**Lessons:** 7.1 Being Skeptical · 7.2 Study Types · 7.3 Randomness in Groups · 7.4 Describing Distributions
**Practices:** MP3 (construct arguments and critique reasoning), MP6 (attend to precision), MP2 (reason quantitatively)
**Built from:** IM Algebra 2, Unit 7, Lessons 1–4, in our own words
**Spiral:** Mean, median, standard deviation, dot plots and histograms come from Algebra 1's statistics units; this week revives them and asks what they can and cannot tell you. Judging whether a model fits data (weeks 23 and 28) becomes judging whether a *study* can support its claim. Reading a graph's axes carefully (every unit) is what catches a misleading picture.

## What you need to be able to do

- **7.1** Spot how a graph or headline can mislead (a cut-off axis, a short time window, a tiny sample, a leading question), and list the questions to ask before trusting a claim made from data.
- **7.2** Tell a statistical question from a non-statistical one, classify a study as a survey, an observational study or an experiment, choose the right type for a question, and explain why only a randomized experiment can support a claim of cause.
- **7.3** Explain what random *selection* does for a sample and what random *assignment* does for an experiment, and why volunteer, convenience and judgment samples go wrong.
- **7.4** Describe a distribution's shape (symmetric, skewed left or right, bell-shaped, uniform, bimodal), choose and compute a measure of centre (mean or median) and of spread (standard deviation), and say how shape and outliers affect each.

## Key terms

| Term | Meaning |
|---|---|
| Statistical question | One whose answer needs data that vary: "How long do students in this school sleep?" not "How long did I sleep last night?" |
| Population, sample | The whole group you want to know about; the part of it you actually measure. |
| Survey | Asking a sample of people questions and recording their answers. |
| Observational study | Measuring what happens without changing anything: compare people who already do and do not do something. |
| Experiment | Deciding who gets a **treatment** (and who gets the control), then measuring the response. |
| Random selection | Choosing the sample so that every member of the population has an equal chance; makes the sample representative. |
| Random assignment | Splitting the subjects into groups by chance; makes the groups alike except for the treatment. |
| Association vs causation | Two things change together (association) versus one makes the other change (causation). |
| Confounding variable | A third factor tied to both the treatment and the response that could explain an association. |
| Shape words | Symmetric, skewed left (tail to the left), skewed right (tail to the right), bell-shaped, uniform (flat), bimodal (two peaks). |
| Mean, median | Average; middle value. Equal for symmetric data; the mean is pulled toward a skew or an outlier. |
| Standard deviation | A typical distance of the data from the mean; larger means more spread. |

## Being skeptical (7.1)

A graph of a city's unemployment that shows only the last three months can make a tiny wobble look like a crisis; the same data over ten years shows a steady fall. A bar chart whose vertical axis starts at 48% instead of 0% makes 50% look like twice 49%. A headline that says "Most people prefer brand A" may rest on a poll of twelve friends of the brand's owner.

Before trusting a claim, ask:

1. **Who was measured?** The population the claim is about, or some convenient group?
2. **How were they chosen?** At random, or by volunteering, or by whoever was nearby?
3. **How many?** Twelve people cannot tell you about a country.
4. **What exactly was asked or measured?** "Do you support wasting money on the new stadium?" is a leading question.
5. **Does the data answer the question?** A rise in ice-cream sales and in sunburn does not mean one causes the other.
6. **What was left out?** Axis ranges, time windows, the groups that were not shown.

**Worked example.** A poster says "9 out of 10 dentists recommend our toothpaste." What would you want to know?

How many dentists were asked (9 of 10, or 900 of 1,000?), how they were chosen (paid consultants?), what the question was (recommend *this* brand, or recommend *brushing*?), and whether the other brands were offered as choices.

**Try it.** A line graph of a company's sales starts its vertical axis at $4.0 million and ends at $4.2 million. Sales went from 4.05 to 4.15. Why does the graph mislead, and what would an honest graph look like?

*Answer:* The 2.5% rise fills the whole height of the graph and looks like a doubling; an axis starting at 0 would show a nearly flat line.

## Study types (7.2)

A **statistical question** is one you answer by collecting data that vary from person to person or item to item. "What is the capital of France?" is not; "How far do students at this school travel to get here?" is.

| Type | What you do | What it can support |
|---|---|---|
| Survey | Ask a sample of the population questions | Estimates about the population (a proportion, a mean) if the sample was random |
| Observational study | Observe and measure existing groups without changing anything | An **association** between two variables |
| Experiment | Randomly assign subjects to treatment and control groups, apply the treatment, measure | **Causation**: the treatment made the difference, if assignment was random |

Why an observational study cannot prove cause: people who choose to do the thing being studied may differ in other ways. Those who drink more coffee may also sleep less, work longer, be older; any of these (a **confounding variable**) could be the real reason for whatever is measured. Random assignment in an experiment breaks every such link, because the coin, not the person, decides who gets the treatment.

**Worked example.** A study finds that teenagers who eat breakfast have higher grades on average. Classify the study and say what it shows.

Observational: nobody was assigned to eat or skip breakfast. It shows an association. Families that make time for breakfast may also make time for homework; that is a confounder. To test cause, randomly assign volunteers to a breakfast group and a no-breakfast group for a term and compare grades.

**Worked example.** Choose a study type for each question. (a) What proportion of the town's households recycle? (b) Does a new fertilizer make tomato plants produce more fruit? (c) Do people who walk to work report less stress than people who drive?

(a) Survey a random sample of households. (b) Experiment: randomly assign plants to fertilizer or no fertilizer. (c) Observational study (you cannot make people change how they commute); or, with volunteers willing to switch, an experiment.

**Designing a simple experiment.** State the treatment and the response variable, get subjects, assign them to groups **at random**, apply the treatment to one group (the other is the control), measure the response the same way in both, compare the groups.

**Try it.** "Does listening to music while studying improve test scores?" Outline an experiment.

*Answer:* Subjects: a class of volunteers. Treatment: studying with music; control: studying in silence. Assign by random draw. Everyone studies the same material for the same time and takes the same test. Compare the two groups' mean scores.

## Randomness in groups (7.3)

**Random selection** (for surveys and observational studies). Asking the first 100 people at a shopping mall, or the people who answer an online poll, gives a sample that differs from the population in ways you cannot measure: the mall sample is heavy on shoppers, the online poll on people who feel strongly. A random sample, where every member of the population has the same chance, can still be off by chance, but not systematically, and next week's lessons measure how far off by chance it is likely to be.

**Judgment samples are biased.** Asked to pick five "typical" rectangles from a sheet of many sizes, people choose big ones; their mean area comes out well above the true mean. Random choice does not have this tilt.

**Random assignment** (for experiments). If an experimenter puts the volunteers who arrived first in the treatment group, the early arrivers may be more eager, more rested or more organised than the rest, and those traits, not the treatment, may explain a difference. Flipping a coin for each volunteer makes the two groups alike in every trait on average, so the treatment is the only systematic difference.

**Worked example.** A school wants to know how its 1,200 students feel about a later start time. Four plans: (a) ask the 30 students in the first-period band class; (b) post a poll on the school's social media; (c) number the students 1 to 1,200 and use a random number generator to choose 100; (d) ask every student who comes to the office one morning. Which is best, and what is wrong with the others?

(c). Band students may be unusual (early rehearsals); social-media respondents are self-selected; office visitors are whoever is late or in trouble that day.

**Try it.** Thirty volunteers will test whether a memory app helps. The researcher lets the volunteers choose a group. What could go wrong, and what should she do instead?

*Answer:* People who think they need help, or who like apps, may pick the app group, so the groups differ before the treatment starts. Assign by random draw (shuffle 30 slips, 15 marked "app").

## Describing distributions (7.4)

A dot plot or histogram shows a distribution's **shape**:

- **Symmetric:** the left and right halves mirror each other. **Bell-shaped** is symmetric with one peak in the middle and thin tails; next week's normal distribution.
- **Skewed right:** a long tail of high values (house prices, incomes). **Skewed left:** a long tail of low values (scores on an easy test).
- **Uniform:** roughly flat (the last digit of phone numbers). **Bimodal:** two peaks (heights of a mixed group of adults and young children).

**Centre:** the mean (sum ÷ count) and the median (middle value). For symmetric data they agree. A skew or an outlier pulls the mean toward the tail and leaves the median almost alone, so the median is the better "typical value" for skewed data and the mean for symmetric data.

**Spread:** the standard deviation measures a typical distance from the mean. Compute it as the square root of the average squared deviation. Tightly clustered data has a small standard deviation; an outlier makes it jump.

**Worked example.** Data: 4, 6, 6, 7, 12. Find the mean, median and standard deviation, and describe the shape.

Mean = 35/5 = 7. Median = 6 (the third of five). Deviations from 7: −3, −1, −1, 0, 5; squares 9, 1, 1, 0, 25, total 36; average 36/5 = 7.2; standard deviation √7.2 ≈ 2.68. (Many calculators also offer the *sample* standard deviation, which divides by n − 1 = 4 and gives 3; say which you are using.) The single high value 12 makes the data skewed right and pulls the mean above the median.

**Worked example.** Two classes take the same test. Class A: scores clustered between 70 and 85, one peak at 78. Class B: scores spread from 40 to 100 with peaks near 55 and 90. Describe each.

A is approximately symmetric and bell-shaped with a small standard deviation; its mean and median are both about 78. B is bimodal with a large standard deviation; its mean, around 72, describes almost nobody.

**Worked example.** The data 20, 22, 23, 25, 25, 26, 29 has mean 24.3 and median 25. The highest value is changed from 29 to 59. What happens?

The mean rises to (170 − 29 + 59)/7 ≈ 28.6, now above every value but one; the median stays 25. The standard deviation grows a lot. The shape is now skewed right with an outlier.

**Try it.**
1. Describe the likely shape of the distribution of the number of siblings of students in a school.
2. Data: 10, 12, 12, 14, 17. Find the mean and the (population) standard deviation.

*Answers:* 1. Skewed right: many 0s, 1s and 2s, a thin tail of large families. 2. Mean 13; deviations −3, −1, −1, 1, 4; squares 9, 1, 1, 1, 16 = 28; 28/5 = 5.6; sd ≈ 2.37.

## Common mistakes

- **Calling an observational study an experiment** because it has two groups. Experiments *assign* the groups.
- **Reading association as causation.** "People who X have more Y" never proves that X causes Y.
- **"Random" meaning "haphazard".** Picking whoever is nearby is not random; a random method gives every member a known, equal chance.
- **Confusing random selection with random assignment.** Selection builds a representative sample; assignment builds comparable groups.
- **Using the mean for skewed data** without noting that the tail pulls it.
- **Skew direction.** The skew is named for the side with the long tail, not the side with the peak.

## Where this goes next

Next week the bell shape gets an equation of its own, the normal distribution, and its mean and standard deviation let you find what proportion of the data lies in any interval. The questions of this week, who was chosen and how, return in week 31 as the margin of error.

## Self-check

1. A headline reads "Study: people who drink green tea live longer." What study type is this probably, and what else could explain the result?
2. Classify: (a) a random sample of 500 voters is asked whom they support; (b) 60 volunteer plants are randomly split and half get extra light; (c) hospital records are used to compare smokers' and non-smokers' blood pressure.
3. Explain the difference in purpose between random selection and random assignment, with an example of each.
4. Data: 3, 5, 5, 6, 8, 21. Find the mean and median, say which better describes a typical value, and name the shape.
5. Sketch (in words) a bimodal distribution and a uniform distribution, and give a real situation that produces each.

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Algebra 2, Unit 7, Lessons 1–4, https://im.kendallhunt.com/HS/teachers/3/7/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
