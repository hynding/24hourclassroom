# Attribution

Every study guide, unit summary, flashcard deck, quiz, unit exam, the exam-prep
guide and the practice final in this directory is **original writing** for this
course, organised around the College Board *AP Precalculus Course and Exam
Description* (CED): its four units, topic codes and topic titles organise the
material, and what each topic expects of students is paraphrased in the course's
own words, never copied. The May 2027 exam format (question counts, timing,
calculator rules and the four free-response question types) and the exam date
are taken from AP Central (the AP Precalculus exam page and the 2027 AP exam
schedule, accessed 2026-10-27). AP® is a trademark of the College Board, which
does not endorse this material.

Nothing here is adapted from a textbook, because no precalculus text was found
under a licence this course can build on:

- OpenStax *Precalculus 2e* is now CC BY-NC-SA 4.0 and its terms bar ingestion
  by language models.
- *Precalculus: An Investigation of Functions* (Lippman and Rasmussen) is
  CC BY-SA 4.0; adapting it would force the share-alike licence onto this
  course, which is CC BY 4.0.
- Stitz and Zeager's *Precalculus* is CC BY-NC-SA.

Nor was text taken from Khan Academy, commercial review books, study sites or
College Board released exam questions. Definitions, theorems and formulas
(the Fundamental Theorem of Algebra, the logarithm properties, the trigonometric
identities, the binomial theorem, the conic standard forms, matrix arithmetic)
are standard mathematics and were not copied from any reference.

**Data.** Every number in a modelling context (populations, temperatures, tides,
daylight hours, Ferris wheels, sound levels, survey and transition data) was
invented for this course and computed to fit the model it illustrates. None of
it is real-world data, and items that might be mistaken for real data say
"hypothetical". The per-week table below names each invented data set.

**Figures** are described in words or given as tables of values; the app renders
no images or LaTeX, so mathematics is written in plain Unicode.

## Licence

The study guides, unit summaries, flashcards, test items and explanations in this directory are © 2026 24 Hour Classroom and are licensed under the Creative Commons Attribution 4.0 International License (CC BY 4.0, https://creativecommons.org/licenses/by/4.0/). Anyone may copy, adapt and share them, for any purpose, as long as they credit "24 Hour Classroom", link to the licence and say what they changed.

AP® is a trademark of the College Board, which was not involved in producing this course and does not endorse it. The Course and Exam Description belongs to the College Board and is not covered by this licence.

## Sources

| Source | URL | Used for |
|---|---|---|
| AP Precalculus Course at a Glance (College Board) | https://apcentral.collegeboard.org/media/pdf/ap-precalculus-course-at-a-glance.pdf | Unit titles, topic codes and titles, unit weightings, the three mathematical practices (course.yaml) |
| AP Central, AP Precalculus exam page (College Board) | https://apcentral.collegeboard.org/courses/ap-precalculus/exam | May 2027 exam format, timing, calculator policy and free-response question types (exam-prep guide and practice final) |
| 2027 AP Exam Schedule | https://ahs.canyonsdistrict.org/wp-content/uploads/sites/351/2026/08/2027-AP-Exam-Schedule.pdf | Exam date, Tuesday 2027-05-11, session 1 (course.yaml and the exam-prep guide) |

Items whose `source` field reads `general knowledge` rest on prerequisite
algebra rather than on a CED topic; every other item names the CED topic it
assesses (`AP Precalculus CED, Topic 2.13`).

## Per-week table

Directory names are abbreviated: `unit-01` = `unit-01-polynomial-and-rational-functions`, `unit-02` = `unit-02-exponential-and-logarithmic-functions`, `unit-03` = `unit-03-trigonometric-and-polar-functions`, `unit-04` = `unit-04-parameters-vectors-and-matrices`.

| Week | CED topics | Files | Sources and data |
|---|---|---|---|
| 01 | 1.1 Change in Tandem · 1.2 Rates of Change | guides/week-01.md, unit-01/week-01.yaml | Original; hypothetical data: drone altitude table (from h(t) = −t³ + 9t² + 5), overnight temperature table, reservoir water-level table, phone-battery charge, cyclist distance model d(t) = 0.2t² + 3t, oven-heating temperature table (all invented). |
| 02 | 1.3 Rates of Change in Linear and Quadratic Functions | guides/week-02.md, unit-01/week-02.yaml | Original; hypothetical data: taxi fare table (F = 1.75d + 4.50), thrown-ball height model h(t) = −5t² + 15t + 2, theatre ticket revenue model R(x) = 600x − 25x², population values near t = 5 (all invented, computed to fit the stated models). |
| 03 | 1.4 Polynomial Functions and Rates of Change | guides/week-03.md, unit-01/week-03.yaml | Original; hypothetical context: open-box volume V(x) = x(20 − 2x)(12 − 2x) from a 20 cm × 12 cm sheet (invented). |
| 04 | 1.5 Polynomial Functions and Complex Zeros | guides/week-04.md, unit-01/week-04.yaml | Original; no data. |
| 05 | 1.6 Polynomial Functions and End Behavior · 1.7 Rational Functions and End Behavior | guides/week-05.md, unit-01/week-05.yaml | Original; hypothetical models: workshop average cost A(n) = (8n + 1200)/n, mixing tank C(t) = (2 + 0.3t)/(10 + t), medicine dose concentration C(t) = 8t/(t² + 4) (all invented; not real pharmacokinetic data). |
| 06 | 1.8 Rational Functions and Zeros · 1.9 Rational Functions and Vertical Asymptotes · 1.10 Rational Functions and Holes | guides/week-06.md, unit-01/week-06.yaml | Original; no data. |
| 07 | 1.11 Equivalent Representations of Polynomial and Rational Expressions | guides/week-07.md, unit-01/week-07.yaml | Original; no data. |
| 08 | 1.12 Transformations of Functions | guides/week-08.md, unit-01/week-08.yaml | Original; no data (tables of values are abstract functions). |
| 09 | 1.13 Function Model Selection and Assumption Articulation · 1.14 Function Model Construction and Application | guides/week-09.md, unit-01/week-09.yaml | Original; hypothetical data sets (invented, computed to fit the stated models): guide — tossed-ball heights (h = −4.9t² + 19.6t + 1.5), open box from a 16 × 10 cm sheet, print-shop average cost (500 + 2x)/x, bike-share fee, heated water-tank temperatures (regression T̂ = 0.694t + 18.0); quiz — bike-rental demand table (R = 120 − 4p), pool pumps, newsletter subscribers cubic regression, workshop average cost (300 + 1.5x)/x, bakery cost, 20 × 12 cm box, ball model −4.9t² + 14.7t + 2, seedling heights (regression ŷ = 0.985x + 3.06), two-rate water-tank fill, reservoir depth in a dry season (d = 0.025t² − 0.5t + 12). |
| U1 | 1.1–1.14 | unit-01/unit-summary.md, unit-01/unit-exam.yaml | Original; hypothetical data (invented): draining-tank heights (constant second differences), seasonal market attendance with quadratic regression A ≈ −2.524x² + 20.905x − 6.571, 30 × 20 cm box, ball model −4.9t² + 24.5t + 1.2, single-dose medication concentration model C(t) = 20t/(t² + 4). |
| 10 | 2.1 Change in Arithmetic and Geometric Sequences · 2.2 Change in Linear and Exponential Functions | guides/week-10.md, unit-02/week-10.yaml | Original; hypothetical data: lab cell culture (200 cells tripling hourly) and seedling (4 cm + 1.5 cm/day) in the guide; gym branch membership table (P linear +30/yr, Q = 120(1.2)ᵗ) in the quiz stimulus; community-library e-book loans (250 at month 0, 360 at month 2, 610 at month 5) in the long answer. |
| 11 | 2.3 Exponential Functions · 2.4 Exponential Function Manipulation | guides/week-11.md, unit-02/week-11.yaml | Original; hypothetical data: bacteria population 400 · 2^(t/5), savings balance 1000(1.06)ᵗ, radioactive sample 80(1/2)^(t/12) in the guide; bacteria 400 · 2^(t/5), account 2000(1.04)ᵗ, radioactive sample 1200(1/2)^(t/8) and study-app users 3000(1.25)ᵗ in the quiz. |
| 12 | 2.5 Exponential Function Context and Data Modeling · 2.6 Competing Function Model Validation | guides/week-12.md, unit-02/week-12.yaml | Original; hypothetical data: user growth, $24,000 depreciating car, 30-cell culture, 200 g isotope (30-year half-life), $5,000 deposit at 4%, town population (1,800 in year 2, 1,200 in year 5), invasive-plant pond table (50, 61, 74, 91, 111, 135 m²; fits 50(1.22)ᵗ) in the guide; newsletter subscriber table (80, 92, 106, 122, 140, 161; fits 80(1.15)ᵗ), delivery van, medical tracer, forest cover, deposits, and online-video views table (fits 0.80t² + 1.50t + 2.04; regression coefficients and residuals computed with numpy) in the quiz. |
| 13 | 2.7 Composition of Functions · 2.8 Inverse Functions | guides/week-13.md, unit-02/week-13.yaml | Original; hypothetical data: taxi fare F(m) = 3.50 + 2.25m (guide and quiz), phone plan C(g) = 15 + 8g (guide self-check), isotope and account items in the quiz spiral review. |
| 14 | 2.9 Logarithmic Expressions · 2.10 Inverses of Exponential Functions | guides/week-14.md, unit-02/week-14.yaml | Original; hypothetical contexts: cell culture N(t) = 2ᵗ (guide), video views V = 10ᵈ, "brightness index" B = log I, app users U(t) = 10^(t/2) (long answer), 80 mg half-life sample (invented, computed to fit the stated models). |
| 15 | 2.11 Logarithmic Functions · 2.12 Logarithmic Function Manipulation | guides/week-15.md, unit-02/week-15.yaml | Original; hypothetical data: doubling tables fitted exactly by log models (guide and short answer), town population 12,000(1.03)ᵗ, vocabulary-test score S(t) = 20 + 12 log₂(t + 1) (long answer) (invented). |
| 16 | 2.13 Exponential and Logarithmic Equations and Inequalities | guides/week-16.md, unit-02/week-16.yaml | Original; hypothetical contexts: service users 4e^(0.2t), medication level 100(0.8)ᵗ (guide), savings account 2,000(1.04)ᵗ (stimulus set), lake fish 800e^(0.05t) (invented). |
| 17 | 2.14 Logarithmic Function Context and Data Modeling · 2.15 Semi-log Plots | guides/week-17.md, unit-02/week-17.yaml | Original; standard pH and decibel definitions (common knowledge) with invented sample values; hypothetical data: typing speed 12 + 8 ln x, magnitude scale M = log(A/A₀), culture table 50(1.5)ᵗ (guide), mould colony 3 · 2ᵈ (stimulus set), decaying table 200(0.7)ˣ, tank concentration ≈ 80(0.8)ᵗ (long answer), car depreciation $24,000 at 15% (invented, computed to fit the stated models). |
| U2 | 2.1–2.15 | unit-02/unit-summary.md, unit-02/unit-exam.yaml | Original; hypothetical data: streaming-service subscribers 40(1.25)ᵗ with least-squares residuals, investment 500(1.06)ᵗ, deer herd 500(0.92)ᵗ, medicine half-life 8 h, pH and decibel values, trout population ≈ 12(1.3)ᵗ with linear model 9.45 + 6.43t (least-squares fit to the table) (invented, computed to fit the stated models). |
| 18 | 3.1 Periodic Phenomena · 3.2 Sine, Cosine, and Tangent | guides/week-18.md, unit-03/week-18.yaml | Original; hypothetical data: bicycle-pedal height table (guide; values from h(t) = 47 − 17 cos(2πt), rounded to 0.1 cm), garden irrigation-pressure table (quiz stimulus, period 12 min), harbour tide-gauge times (quiz short answer), playground roundabout (quiz long answer), garden path, rolling wheel and ramp (guide examples). |
| 19 | 3.3 Sine and Cosine Function Values | guides/week-19.md, unit-03/week-19.yaml | Original; hypothetical data: ceiling-fan blade tip on a 60 cm circle (quiz long answer). Otherwise no data. |
| 20 | 3.4 Sine and Cosine Function Graphs · 3.5 Sinusoidal Functions | guides/week-20.md, unit-03/week-20.yaml | Original; hypothetical data: lab half-life (80 mg to 20 mg in 12 h), garden sprinkler arc (8 m, 135°, 40 s per turn), paddle-wheel tip h(θ) = 1.5 + 2 sin θ (quiz long answer). |
| 21 | 3.6 Sinusoidal Function Transformations · 3.7 Sinusoidal Function Context and Data Modeling | guides/week-21.md, unit-03/week-21.yaml | Original; hypothetical data: Ferris wheels (guide: 40 m diameter, centre 22 m, 8 min; quiz stimulus: 50 m, centre 28 m, 10 min), harbour tide (high 4.6 m at 2:00, low 0.6 m at 8:12), northern-city daylight (max 15.2 h on day 172, min 9.0 h; quiz model D(t) = 12.1 + 3.1 sin(2π(t − 80)/365)), spring bob (12–30 cm, period 2 s), piecewise estuary tide (5 h rise, 7 h fall), greenhouse temperature (31°C at 2 p.m., 15°C at 2 a.m.), regression output for city monthly temperatures (T = 9.6 sin(0.52m − 1.9) + 17.4), pier depth (low 1.2 m at 4:00, high 5.0 m at 10:15; quiz long answer). All invented and computed to fit the stated models. |
| 22 | 3.8 The Tangent Function · 3.9 Inverse Trigonometric Functions | guides/week-22.md, unit-03/week-22.yaml | Original; hypothetical data: ladder (6 m, top 5.2 m up), cold-storage temperature h(t) = 10 + 4 sin(πt/6), security camera 20 m from a wall x(θ) = 20 tan θ (quiz long answer). |
| 23 | 3.10 Trigonometric Equations and Inequalities | guides/week-23.md, unit-03/week-23.yaml | Original; hypothetical models (invented, computed to fit the stated formulas): Ferris wheel h(t) = 20 − 18 cos(πt/5) (guide); harbour depth d(t) = 6 + 2 sin(πt/6) (quiz stimulus set); water depth d(t) = 5 + 3 sin(πt/6) (guide self-check); lab spring weight, 14 cm high at t = 0, 6 cm low at 1.5 s, period 3 s (short answer); greenhouse temperature T(t) = 22 − 6 cos(πt/12) (long answer). |
| 24 | 3.11 The Secant, Cosecant, and Cotangent Functions · 3.12 Equivalent Representations of Trigonometric Functions | guides/week-24.md, unit-03/week-24.yaml | Original; one hypothetical data point: lab sample of 200 mg with a 6-hour half-life (spiral numeric item). |
| 25 | 3.13 Trigonometry and Polar Coordinates · 3.14 Polar Function Graphs | guides/week-25.md, unit-03/week-25.yaml | Original; no data. |
| 26 | 3.15 Rates of Change in Polar Functions | guides/week-26.md, unit-03/week-26.yaml | Original; hypothetical data: garden sprinkler reach r = 4 + 2 cos θ m (guide) and r = 5 + 3 cos θ m (quiz); polar table g(π/3) = 2.6, g(π/2) = 3.4, g(2π/3) = 3.7 (guide, invented); quiz stimulus table (values of r = 2 − 4 sin θ, presented as a table); short-answer table for h (invented values 1, 2.5, 3, 2, −0.5); daylight model with a 15-hour maximum on day 172 and a 9-hour minimum, period 365 days (spiral item). |
| U3 | 3.1–3.15 | unit-03/unit-summary.md, unit-03/unit-exam.yaml | Original; hypothetical data: buoy height between 1.2 m and 3.8 m, peak at 2 s, period 6 s (summary self-test); monthly city temperature model, 4 °C minimum at t = 1, 28 °C maximum at t = 7, T(t) = 16 − 12 cos(π(t − 1)/6) (exam stimulus set A); water-level regression output y = 4.2 sin(0.52t − 1.1) + 10.3 (exam, invented coefficients); Ferris wheel of diameter 40 m, centre 24 m up, 8-minute revolution (exam long answer). |
| 27 | 4.1 Parametric Functions · 4.2 Parametric Functions Modeling Planar Motion · 4.3 Parametric Functions and Rates of Change | guides/week-27.md, unit-04/week-27.yaml | Original; hypothetical data: thrown-ball model x = 40t, y = 6 + 48t − 16t², delivery-drone position table, robot-vacuum position table, lab cell culture (500 cells, 8%/h), kite, softball and soccer-ball projectile models (all invented, computed to fit the stated formulas). |
| 28 | 4.4 Parametrically Defined Circles and Lines · 4.5 Implicitly Defined Functions | guides/week-28.md, unit-04/week-28.yaml | Original; hypothetical data: Ferris wheel (radius 20 m, centre 22 m, 4 min per turn), robot on a straight segment, metal-plate temperature model T = 100 − x² − 2y², cyclist on a 50 m circular track with a service path (all invented). |
| 29 | 4.6 Conic Sections · 4.7 Parametrization of Implicitly Defined Functions | guides/week-29.md, unit-04/week-29.yaml | Original; hypothetical data: satellite dish 60 cm wide and 9 cm deep, elliptical whispering-gallery floor plan 50 m by 30 m (invented). |
| 30 | 4.8 Vectors · 4.9 Vector-Valued Functions | guides/week-30.md, unit-04/week-30.yaml | Original; hypothetical data: plane in a crosswind (300 km/h north, 40 km/h wind), boat crossing a 120 m river (8 m/s, 3 m/s current), signal-flare model p(t) = ⟨10t, 50 + 30t − 5t²⟩ (invented). |
| 31 | 4.10 Matrices · 4.11 The Inverse and Determinant of a Matrix | guides/week-31.md, unit-04/week-31.yaml | Original; hypothetical data: café coffee sales and prices, school-play ticket sales (30 tickets, $300), bakery flour/sugar recipe matrix and costs (invented). |
| 32 | 4.12 Linear Transformations and Matrices · 4.13 Matrices as Functions · 4.14 Matrices Modeling Contexts | guides/week-32.md, unit-04/week-32.yaml | Original; hypothetical transition models: two coffee shops (80%/70% retention), bike-share stations P and Q (140 bikes), phone plans Basic/Plus, internet providers Northline/Swiftnet (10,000 households) — invented names and rates. |
| U4 | 4.1–4.14 | unit-04/unit-summary.md, unit-04/unit-exam.yaml | Original; hypothetical data: kicked-football model, toy-car position table, robot on an elliptical track, bus/car commuter transition model (600 commuters), gym morning/evening sessions, car rental Airport/Downtown (500 cars), 6-hour half-life substance (all invented). |
| 33 | All units | review/exam-prep-guide.md | Original; exam format, timing, calculator rules and date from AP Central and the 2027 AP exam schedule (sources above). |
| 34 | All units | review/practice-exam.yaml | Original; questions 1–46 follow the May 2027 AP format (AP Central). Hypothetical data: cooling tea (20 + 70(0.6)^(t/10)), Ferris wheel (−20 cos(πt/4) + 25), town population (1,200 in 2020, 1,500 in 2024), daylight model, dock water depth, open-box volume, quadratic through three points, study-room transitions (80/20 and 30/70). |
