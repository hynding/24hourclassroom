# Attribution

Every study guide, unit summary, flashcard deck, quiz, unit exam, the exam-prep
guide and the practice final in this directory is **original writing** for this
course, organised around the College Board *AP Statistics Course and Exam
Description* (CED) as redesigned for the 2026-27 school year: its five units,
55 topic codes and topic titles organise the material, and what each topic
expects of students is paraphrased in the course's own words, never copied.
Content the redesign removes (the geometric distribution, combining random
variables, the chi-square goodness-of-fit test, inference for the slope of a
regression line and transformations to achieve linearity) is left out. The May
2027 exam format (42 four-option multiple-choice questions and four 10-point
free-response questions, fully digital) and the exam date are taken from AP
Central (accessed 2026-11-15). AP® is a trademark of the College Board, which
does not endorse this material.

Nothing here is adapted from a textbook, because no statistics text was found
under a licence this course can build on:

- OpenStax books, *Introductory Statistics* included, are now CC BY-NC-SA 4.0
  (OpenStax's licensing help page) and their terms bar ingestion by language
  models.
- *OpenIntro Statistics* and *Introductory Statistics for the Life and
  Biomedical Sciences* are CC BY-SA; adapting them would force the share-alike
  licence onto this course, which is CC BY 4.0.

Nor was text taken from Khan Academy, commercial review books, study sites or
College Board released exam questions and scoring guidelines. Definitions,
formulas and procedures (the five-number summary, the 1.5 × IQR rule, the
rules of probability, the binomial and Normal distributions, the Central Limit
Theorem, z and t procedures, chi-square tests, least-squares regression) are
standard statistics and were not copied from any reference.

**Data.** Every data set and context was invented for this course, and every
statistic, critical value, p-value and interval was computed from it with
software. None of it is real-world data or comes from a real study, and items
that might be mistaken for real data say "hypothetical". The per-week table
below names each invented data set.

**Figures** are described in words, as tables of values or as text displays
(stemplots, computer regression output); the app renders no images or LaTeX,
so mathematics is written in plain Unicode.

## Licence

The study guides, unit summaries, flashcards, test items and explanations in this directory are © 2026 24 Hour Classroom and are licensed under the Creative Commons Attribution 4.0 International License (CC BY 4.0, https://creativecommons.org/licenses/by/4.0/). Anyone may copy, adapt and share them, for any purpose, as long as they credit "24 Hour Classroom", link to the licence and say what they changed.

AP® is a trademark of the College Board, which was not involved in producing this course and does not endorse it. The Course and Exam Description belongs to the College Board and is not covered by this licence.

## Sources

| Source | URL | Used for |
|---|---|---|
| AP Statistics Course and Exam Description (College Board) | https://apcentral.collegeboard.org/media/pdf/ap-statistics-course-and-exam-description.pdf | Unit titles, topic codes and titles, unit weightings, the four course practices (course.yaml) |
| AP Statistics Course at a Glance (College Board) | https://apcentral.collegeboard.org/courses/ap-statistics/course | Unit order and topic list, cross-checked against the CED |
| AP Central, AP Statistics future revisions (College Board) | https://apcentral.collegeboard.org/courses/ap-statistics | What the redesign adds and removes, effective fall 2026 |
| AP Central, AP Statistics exam page (College Board) | https://apcentral.collegeboard.org/courses/ap-statistics/exam | Exam date (Tuesday 2027-05-11), digital format, question counts and timing (exam-prep guide and practice final) |
| StatsLearn topic list (third party) | https://statslearn.com | Cross-check of a few topic titles (4.3–4.6, 4.8–4.10, 5.2, 5.4) where the fetched CED text was incomplete; no text taken |

Every item's `source` field names the CED topic it assesses (`AP Statistics CED, Topic 2.4`).

## Per-week table

Directory names are abbreviated: `unit-01` = `unit-01-one-variable-data-and-collecting-data`, `unit-02` = `unit-02-probability-random-variables-and-distributions`, `unit-03` = `unit-03-inference-for-categorical-data-proportions`, `unit-04` = `unit-04-inference-for-quantitative-data-means`, `unit-05` = `unit-05-regression-analysis`.

| Week | CED topics | Files | Sources and data |
|---|---|---|---|
| 01 | 1.1, 1.2 | guides/week-01.md, unit-01/week-01.yaml | Original; hypothetical data and contexts (all invented): class data table (sleep, siblings, sport, invented ZIP-style codes, commute, job), a gym's workout lengths, a school nurse's records, an animal shelter's dog records, a cafeteria breakfast study, cross-country runners. |
| 02 | 1.3, 1.4 | guides/week-02.md, unit-01/week-02.yaml | Original; hypothetical data and contexts (all invented): ways to school (160), cafeteria lunches (250), music listening (200), bakery customers (240), club sign-ups on a truncated axis, shelter adoptions, a smoothie-shop pictograph. |
| 03 | 1.5, 1.6 | guides/week-03.md, unit-01/week-03.yaml | Original; hypothetical data and contexts (all invented): soccer goals in 18 games, bean-plant heights, commute times (60), restaurant wait times, reaction times, cafeteria arrival times, pets in 50 households, vocabulary quiz scores. |
| 04 | 1.7, 1.8 | guides/week-04.md, unit-01/week-04.yaml | Original; hypothetical data and contexts (all invented): homework minutes, athletes' resting heart rates, café tips, commute five-number summary, home prices, a fitness-run percentile, pool attendance, trout lengths, park trees. |
| 05 | 1.9 | guides/week-05.md, unit-01/week-05.yaml | Original; hypothetical data and contexts (all invented): commute times at two high schools, sleep by grade, bean plants under two lights, cross-country times at two schools, screen time by grade, used-bike prices, electricity bills, bakery waits, July highs in two invented towns. |
| 06 | 1.10–1.12 | guides/week-06.md, unit-01/week-06.yaml | Original; hypothetical data and contexts (all invented): school-lunch studies, sampling 40 of 1,200 students (simulated SRS vs stratified), a town skate-park survey, a vocabulary app, a gym member list, a car-ban web poll, battery brands, a longer-lunch survey. |
| 07 | 1.13 | guides/week-07.md, unit-01/week-07.yaml | Original; hypothetical data and contexts (all invented): tomato fertilizer × watering experiment, nap and reaction time (60 volunteers), study methods blocked by course level, split-keyboard matched pairs, music and run times, peppermint patch, chewing gum and test anxiety. |
| U1 | 1.1–1.13 | unit-01/unit-summary.md, unit-01/unit-exam.yaml | Original; hypothetical data and contexts (all invented): gaming hours, cafeteria entrées, swim-team heart rates, homework minutes by grade, sunscreen on paired arms, an allergy tablet trial, phone battery life for two models, a breathing exercise before tests. |
| 08 | 2.1, 2.2 | guides/week-08.md, unit-02/week-08.yaml | Original; hypothetical data and contexts (all invented): travel to school by grade (400), phones in the bedroom and sleep (250), smoothie sizes and protein add-ins (200 orders), athletes' warm-ups and injuries (240), library patrons' age and book format (500). |
| 09 | 2.3, 2.4 | guides/week-09.md, unit-02/week-09.yaml | Original; hypothetical data and contexts (all invented): free-throw simulation with random digits, presenter draws, lunch-from-home simulation (200 trials), toll-road passes, learner's permits by class (200), coffee-shop scratch cards. |
| 10 | 2.5–2.7 | guides/week-10.md, unit-02/week-10.yaml | Original; hypothetical data and contexts (all invented): gym plans and attendance (600), spam-filter tree, sports and part-time jobs (400), shoppers paying by phone (250), three smoke detectors, news source by age group (800). |
| 11 | 2.8, 2.9 | guides/week-11.md, unit-02/week-11.yaml | Original; hypothetical data and contexts (all invented): guessing on four-option questions, people per car at drop-off, school raffle (500 tickets), phone repair plan, pizza slices per customer, school-fair dice game. |
| 12 | 2.10 | guides/week-12.md, unit-02/week-12.yaml | Original; hypothetical data and contexts (all invented): seed germination (85%), a 70% free-throw shooter, part-time jobs in a school of 2,000, guessing on a 25-question quiz, a $2 school-fair game, left-handedness, buses on time over 15 days. |
| 13 | 2.11 | guides/week-13.md, unit-02/week-13.yaml | Original; hypothetical data and contexts (all invented): nightly sleep N(7.1, 1.2), a juice machine, phone battery life, egg weights, a cereal filler, sunflower heights, backpack weights. |
| 14 | 2.12 | guides/week-14.md, unit-02/week-14.yaml | Original; hypothetical data and contexts (all invented): district where 40% bike or walk (1,000 simulated samples), pizza delivery times, social-media minutes, cafeteria lunch share, trout lengths, reading scores, commute times. |
| U2 | 2.1–2.12 | unit-02/unit-summary.md, unit-02/unit-exam.yaml | Original; hypothetical data and contexts (all invented): travel-to-school table, screen repairs, trail-mix bag weights, an allergy screening test, phone-insurance payout, driver's licences, vending-machine failures, a $5 raffle, breakfast and alertness, drink-cup fills. |
| 15 | 3.1, 3.2 | guides/week-15.md, unit-03/week-15.yaml | Original; hypothetical data and contexts (all invented): vegetable gardens (simulated estimators), teen part-time jobs, defective batteries, district school lunches, library cards (simulated methods). |
| 16 | 3.3, 3.4 | guides/week-16.md, unit-03/week-16.yaml | Original; hypothetical data and contexts (all invented): teen sleep survey (248 of 400), reading for pleasure, e-bike poll, teen volunteering, night-time phone notifications. |
| 17 | 3.5, 3.6 | guides/week-17.md, unit-03/week-17.yaml | Original; hypothetical data and contexts (all invented): school lunch after a menu change, four-day-week poll, simulated free-throw p-value, part-time jobs, student sleep. |
| 18 | 3.7, 3.8 | guides/week-18.md, unit-03/week-18.yaml | Original; hypothetical data and contexts (all invented): tomato seed germination (with power), seniors' college plans, chronic absence, bus on-time arrivals, bike-share, PE fitness-test pass rates. |
| 19 | 3.9, 3.10 | guides/week-19.md, unit-03/week-19.yaml | Original; hypothetical data and contexts (all invented): school-lunch buying at two schools, sleep by grade, seed-soaking sprouting experiment, a planner-app survey, library cards in two counties, a weekend bus line in two towns. |
| 20 | 3.11 | guides/week-20.md, unit-03/week-20.yaml | Original; hypothetical data and contexts (all invented): homework text-reminder experiment, a park-bond survey in two towns, library reminder experiment, music streaming by age, a hydration plan and headaches, a fitness-centre training session. |
| 21 | 3.12, 3.13 | guides/week-21.md, unit-03/week-21.yaml | Original; hypothetical data and contexts (all invented): practice-quiz experiment, pastry receipts at two bakeries, a vocabulary-app experiment, fungus treatments on plants, solar panels in two counties, carrot-seed germination, CPR courses at two schools. |
| 22 | 3.14, 3.15 | guides/week-22.md, unit-03/week-22.yaml | Original; hypothetical data and contexts (all invented): lunch habits by grade, news source by age group, way to school by grade band, smoothie cup sizes at three locations, counselling use at four schools, orchard pruning methods. |
| U3 | 3.1–3.15 | unit-03/unit-summary.md, unit-03/unit-exam.yaml | Original; hypothetical data and contexts (all invented): district breakfast survey, peer tutoring experiment, streaming plan by device, late pizza deliveries, defective batteries, a sleep-app experiment, a mindfulness experiment, library age group by book format. |
| 23 | 4.1 | guides/week-23.md, unit-04/week-23.yaml | Original; hypothetical data and contexts (all invented): screen time at a school, trail-mix bag weights, commute times, delivery times, plant-height estimator simulation, breakfast skipping, recycling test. |
| 24 | 4.2, 4.3 | guides/week-24.md, unit-04/week-24.yaml | Original; hypothetical data and contexts (all invented): eleventh-grader sleep, granola-bar sugar, typing speed keyboard vs phone (paired), reaction time with music, greenhouse tomato heights, runners' mile times in old vs new shoes. |
| 25 | 4.4, 4.5 | guides/week-25.md, unit-04/week-25.yaml | Original; hypothetical data and contexts (all invented): lunch-line waits, quiz scores with and without an app (paired), cereal fill, sleep before a test (paired), bean seedlings with fertiliser, word recall in silence vs music, speaker battery claim. |
| 26 | 4.6 | guides/week-26.md, unit-04/week-26.yaml | Original; hypothetical data and contexts (all invented): juniors' sleep at two schools, two tomato varieties, clinic wait times, flashcard-app designs, earbud battery life for two brands, coffee temperatures at two cafés, egg weights at two farms. |
| 27 | 4.7, 4.8 | guides/week-27.md, unit-04/week-27.yaml | Original; hypothetical data and contexts (all invented): screen time by grade, basil seedlings under two lights, café orders, pancakes at two diners, fuel efficiency on two fuels, popcorn kernels from two brands, paper-airplane designs. |
| 28 | 4.9, 4.10 | guides/week-28.md, unit-04/week-28.yaml | Original; hypothetical data and contexts (all invented): studying with and without music, pizza delivery times, rural and urban reading time, calculator types, cereal sugar, sprint shoes, grip strength, AA batteries in a toy robot. |
| U4 | 4.1–4.10 | unit-04/unit-summary.md, unit-04/unit-exam.yaml | Original; hypothetical data and contexts (all invented): trail-mix weights, heart rate before and after a breathing exercise, caffeine intake, used-textbook prices, a twins breakfast study, pet owners' spending, volleyball warm-ups and vertical jump, sleep at two school start times. |
| 29 | 5.1, 5.2 | guides/week-29.md, unit-05/week-29.yaml | Original; hypothetical data and contexts (all invented): late-night phone minutes and sleep, practice hours and free throws, speed and fuel economy, café temperature and hot drinks, part-time work and GPA, arm span and height. |
| 30 | 5.3 | guides/week-30.md, unit-05/week-30.yaml | Original; hypothetical data and contexts (all invented): commute distance and time, pizza diameter and price, seedling growth, used-car age and price, weekly miles and 5K time, gym heating cost and temperature. |
| 31 | 5.4 | guides/week-31.md, unit-05/week-31.yaml | Original; hypothetical data and contexts (all invented): arm span and height residuals, a cooling cup of coffee, earnings and hours, cyclist cadence and heart rate, puppy weights, cress seedlings. |
| 32 | 5.5 | guides/week-32.md, unit-05/week-32.yaml | Original; hypothetical data and contexts (all invented): pine-tree diameter and height output, typing speed over weeks, practice minutes and quiz scores, temperature and ice-cream cones, ride distances and fares. |
| U5 | 5.1–5.5 | unit-05/unit-summary.md, unit-05/unit-exam.yaml | Original; hypothetical data and contexts (all invented): apartment size and rent, solar-panel output, engine size and mpg, house size and heating cost, vertical jump and sprint times, pizza delivery distance and time. |
| 33 | Units 1–5 | review/exam-prep-guide.md | Original; no new data (its examples reuse the practice final's contexts). |
| 34 | Units 1–5 | review/practice-exam.yaml | Original; hypothetical data and contexts (all invented): hypothetical café smoothie distribution, phone-in-bedroom by sleep table, orchard blemishes, bus riders, digital-textbook two-proportion interval, grade by study place chi-square, delivery-time t-test, phone minutes and sleep regression, movement-break experiment, bus vs car commutes, garden-club beans, league runners' miles and 5-km times. |
