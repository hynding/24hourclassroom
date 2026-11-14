# Attribution

Every study guide, unit summary, flashcard deck, quiz, unit exam, the exam-prep
guide and the practice final in this directory is **original writing** for this
course, organised around the College Board *AP Calculus AB and BC Course and
Exam Description* (CED, effective fall 2020, with the clarifications for
2026-27): its eight AB units, topic codes and topic titles organise the
material, and what each topic expects of students is paraphrased in the
course's own words, never copied. Only the AB topics are taught; the BC-only
topics (6.11–6.13, 7.5, 7.9, 8.13 and Units 9–10) are left out. The May 2027
exam format (question counts, timing, calculator rules) and the exam date are
taken from AP Central (the AP Calculus AB exam page, the AP Calculus AB course
overview and the 2026-27 CED clarifications, accessed 2026-11-14). AP® is a
trademark of the College Board, which does not endorse this material.

Nothing here is adapted from a textbook, because no calculus text was found
under a licence this course can build on:

- OpenStax books, *Calculus* included, are now CC BY-NC-SA 4.0 (OpenStax's
  licensing help page) and their terms bar ingestion by language models.
- *Active Calculus* (Boelkins) is CC BY-SA; adapting it would force the
  share-alike licence onto this course, which is CC BY 4.0.
- *CLP Calculus* (UBC) is CC BY-NC-SA 4.0 and *APEX Calculus* is CC BY-NC;
  their non-commercial terms conflict with CC BY 4.0.

(Licences checked on each book's own site, 2026-11-14.)

Nor was text taken from Khan Academy, commercial review books, study sites or
College Board released exam questions and scoring guidelines. Definitions,
theorems and formulas (the limit laws, the Squeeze Theorem, the Intermediate,
Extreme and Mean Value Theorems, the derivative rules, L'Hospital's Rule, the
Fundamental Theorem of Calculus, the disc and washer formulas) are standard
mathematics and were not copied from any reference.

**Data.** Every number in a context (tanks, particles, traffic, temperatures,
populations, rates in and out) was invented for this course and computed to
fit the model it illustrates. None of it is real-world data, and items that
might be mistaken for real data say "hypothetical". The per-week table below
names each invented data set.

**Figures** are described in words or given as tables of values; the app renders
no images or LaTeX, so mathematics is written in plain Unicode.

## Licence

The study guides, unit summaries, flashcards, test items and explanations in this directory are © 2026 24 Hour Classroom and are licensed under the Creative Commons Attribution 4.0 International License (CC BY 4.0, https://creativecommons.org/licenses/by/4.0/). Anyone may copy, adapt and share them, for any purpose, as long as they credit "24 Hour Classroom", link to the licence and say what they changed.

AP® is a trademark of the College Board, which was not involved in producing this course and does not endorse it. The Course and Exam Description belongs to the College Board and is not covered by this licence.

## Sources

| Source | URL | Used for |
|---|---|---|
| AP Calculus AB and BC Course and Exam Description (College Board) | https://apcentral.collegeboard.org/media/pdf/ap-calculus-ab-and-bc-course-and-exam-description.pdf | Unit titles, topic codes and titles, AB unit weightings, the four mathematical practices (course.yaml) |
| AP Calculus AB and BC CED clarifications for 2026-27 (College Board) | https://apcentral.collegeboard.org/media/pdf/ap-calculus-ab-bc-course-and-exam-description-clarifications.pdf | The May 2027 multiple-choice counts and timing; course content unchanged |
| AP Students, AP Calculus AB course page (College Board) | https://apstudents.collegeboard.org/courses/ap-calculus-ab | AB unit weightings, cross-checked against the CED table (course.yaml) |
| AP Central, AP Calculus AB exam page (College Board) | https://apcentral.collegeboard.org/courses/ap-calculus-ab/exam | Exam date (Monday 2027-05-10, session 1), hybrid digital format, timing and calculator policy (exam-prep guide and practice final) |

Items whose `source` field reads `general knowledge` rest on prerequisite
algebra or precalculus rather than on a CED topic; every other item names the
CED topic it assesses (`AP Calculus CED, Topic 2.4`).

## Per-week table

Directory names are abbreviated: `unit-01` = `unit-01-limits-and-continuity`, `unit-02` = `unit-02-differentiation-definition-and-properties`, `unit-03` = `unit-03-composite-implicit-and-inverse-functions`, `unit-04` = `unit-04-contextual-applications-of-differentiation`, `unit-05` = `unit-05-analytical-applications-of-differentiation`, `unit-06` = `unit-06-integration-and-accumulation-of-change`, `unit-07` = `unit-07-differential-equations`, `unit-08` = `unit-08-applications-of-integration`.

| Week | CED topics | Files | Sources and data |
|---|---|---|---|
| 01 | 1.1 Introducing Calculus: Can Change Occur at an Instant? · 1.2 Defining Limits and Using Limit Notation · 1.3 Estimating Limit Values from Graphs · 1.4 Estimating Limit Values from Tables | guides/week-01.md, unit-01/week-01.yaml | Original; hypothetical data and contexts (all invented): drone height h(t) = t³ m; cyclist distance D(t) = 2t² + 3t m. |
| 02 | 1.5 Determining Limits Using Algebraic Properties of Limits · 1.6 Determining Limits Using Algebraic Manipulation · 1.7 Selecting Procedures for Determining Limits | guides/week-02.md, unit-01/week-02.yaml | Original; no data (abstract functions only). |
| 03 | 1.8 Determining Limits Using the Squeeze Theorem · 1.9 Connecting Multiple Representations of Limits · 1.10 Exploring Types of Discontinuities | guides/week-03.md, unit-01/week-03.yaml | Original; no data (abstract functions only). |
| 04 | 1.11 Defining Continuity at a Point · 1.12 Confirming Continuity over an Interval · 1.13 Removing Discontinuities | guides/week-04.md, unit-01/week-04.yaml | Original; no data (abstract functions only). |
| 05 | 1.14 Connecting Infinite Limits and Vertical Asymptotes · 1.15 Connecting Limits at Infinity and Horizontal Asymptotes · 1.16 Working with the Intermediate Value Theorem (IVT) | guides/week-05.md, unit-01/week-05.yaml | Original; hypothetical data and contexts (all invented): greenhouse temperatures 14, 19, 26, 22, 17 °C at t = 0, 3, 5, 8, 12 h; reservoir depth D(t) = (6t² + 5)/(t² + 1) m. |
| U1 | 1.1–1.16 | unit-01/unit-summary.md, unit-01/unit-exam.yaml | Original; hypothetical data and contexts (all invented): lab-culture nutrient concentration 3.1, 4.6, 4.0, 5.2, 2.8 mg/L at t = 0, 2, 5, 9, 12 h; insulated tank H(t) = 20 + 60e^(−0.15t) °C then a + 2.5(t − 10); particle positions s(t) = t² + 1 and t³ − t. |
| 06 | 2.1 Defining Average and Instantaneous Rates of Change at a Point · 2.2 Defining the Derivative of a Function and Using Derivative Notation | guides/week-06.md, unit-02/week-06.yaml | Original; hypothetical data and contexts (all invented): tossed ball h(t) = 2 + 15t − 5t²; robot x(t) = t³ − 6t; shrinking-interval table of average rates (4.62, 4.0602, 4.006); drone altitude A(t) = 20 + t³. |
| 07 | 2.3 Estimating Derivatives of a Function at a Point · 2.4 Connecting Differentiability and Continuity: Determining When Derivatives Do and Do Not Exist | guides/week-07.md, unit-02/week-07.yaml | Original; hypothetical data and contexts (all invented): bakery oven temperature table (t = 0, 2, 5, 6, 9; T = 20, 34, 52, 57, 70 °C); hiker elevation table (t = 0, 1, 1.5, 3, 4; E = 1200, 1450, 1520, 1610, 1580 m) with a piecewise-linear model. |
| 08 | 2.5 Applying the Power Rule · 2.6 Derivative Rules: Constant, Sum, Difference, and Constant Multiple · 2.7 Derivatives of cos x, sin x, eˣ, and ln x | guides/week-08.md, unit-02/week-08.yaml | Original; hypothetical data and contexts (all invented): rainwater tank table (t = 0, 3, 7, 10; R = 12, 18, 30, 33 thousand litres); harbour depth D(t) = 5 + 2 sin t − 0.1t. |
| 09 | 2.8 The Product Rule · 2.9 The Quotient Rule · 2.10 Finding the Derivatives of Tangent, Cotangent, Secant, and/or Cosecant Functions | guides/week-09.md, unit-02/week-09.yaml | Original; hypothetical data and contexts (all invented): bakery loaf on day 4 (N = 120, N′ = −6, P = 15, P′ = 0.5, C = 900, C′ = 30); abstract f/g table. |
| U2 | 2.1–2.10 | unit-02/unit-summary.md, unit-02/unit-exam.yaml | Original; hypothetical data and contexts (all invented): draining tank table (W = 300, 268, 255, 236, 230 L at t = 0, 4, 6, 10, 12); reservoir table (V = 40, 43.2, 46.1, 47.0, 46.5 million L at t = 0, 2, 5, 9, 10), model M(t) = 40 + 3√t − 0.25t, mineral concentration c(t) = 2 + 0.1t mg/L. |
| 10 | 3.1 The Chain Rule | guides/week-10.md, unit-03/week-10.yaml | Original; hypothetical data and contexts (all invented): table of f, f′, g, g′ at x = 1–4; table of f, f′ at x = 0–3 with g(x) = x² − 2x + 2; no real data. |
| 11 | 3.2 Implicit Differentiation · 3.3 Differentiating Inverse Functions · 3.4 Differentiating Inverse Trigonometric Functions | guides/week-11.md, unit-03/week-11.yaml | Original; hypothetical data and contexts (all invented): curves y² = x³ − 2x + 5, x² − 2xy + 3y² = 18; inverse table (f(2) = 5, f′(2) = 4); table for estimating f′ (x = 1, 3, 6, 8); no real data. |
| 12 | 3.5 Selecting Procedures for Calculating Derivatives · 3.6 Calculating Higher-Order Derivatives | guides/week-12.md, unit-03/week-12.yaml | Original; hypothetical data and contexts (all invented): g(x) = ln(x² + 1); f(x) = x³ + x + 2 and inverse; no real data. |
| U3 | 3.1–3.6 | unit-03/unit-summary.md, unit-03/unit-exam.yaml | Original; hypothetical data and contexts (all invented): f/g table; curves y² − 3xy + x² = −1, e^y + xy = e, x² + xy + y² = 7; hypothetical lake temperature W(x) = 4 + 18e^(−0.15x) °C and diver depth d(t) = 10 + 6 sin(0.5t) m. |
| 13 | 4.1 Interpreting the Meaning of the Derivative in Context · 4.2 Straight-Line Motion: Connecting Position, Velocity, and Acceleration | guides/week-13.md, unit-04/week-13.yaml | Original; hypothetical data and contexts (all invented): guide — cooling tea T(t), bakery cost C(x) = 150 + 6x − 0.03x², cyclist velocity table; quiz — draining tank V′(10) = −3.5, air pressure P(h), app downloads N(t), bakery C′(40) = 3.5, sunflower height H(t), cyclist velocity table (t 0/2/5/8, v 3/7/12/10). |
| 14 | 4.3 Rates of Change in Applied Contexts Other Than Motion · 4.4 Introduction to Related Rates | guides/week-14.md, unit-04/week-14.yaml | Original; hypothetical data and contexts (all invented): guide — bacteria 500e^(0.2t), drug concentration 12t/(t² + 4), pond ripple, balloon; quiz — medication 40t·e^(−0.5t), city population 80 + 4t − 0.1t², heated rod T(x), stadium queue 30 + 18t − t², spring-fed pond 200 + 30 ln(t + 1), snow depth 10 + 4√t − t, oil slick, cylinder and cone tanks. |
| 15 | 4.5 Solving Related Rates Problems | guides/week-15.md, unit-04/week-15.yaml | Original; hypothetical data and contexts (all invented): guide — drone at 40 m, conical funnel 12 cm deep, 6 m streetlamp and 1.8 m walker, hot-air balloon seen from 300 m; quiz — two cars at a crossroads, cone tank 8 ft by 6 ft, 5 m plank, 5 m lamp and 1 m child, rocket camera 50 m away, melting snowball, balloon at 50 cm³/s, kite at 30 m, triangular trough, aircraft over radar. |
| 16 | 4.6 Approximating Values of a Function Using Local Linearity and Linearization · 4.7 Using L'Hospital's Rule for Determining Limits of Indeterminate Forms | guides/week-16.md, unit-04/week-16.yaml | Original; hypothetical data and contexts (all invented): guide — tank W(10) = 420, W′(10) = −15; quiz — reservoir R(20) = 150, R′(20) = −4, theatre revenue p(200 − 4p), rain barrel H(4) = 30, spotlight and wall 12 m apart. |
| U4 | 4.1–4.7 | unit-04/unit-summary.md, unit-04/unit-exam.yaml | Original; hypothetical data and contexts (all invented): rain-tank table, conveyor sand pile, lake pollutant C(t), car fuel F(d), bacteria 200·2^(t/3), workshop cost cubic, cylindrical tank, weather balloon 100 m away, cooling pie 20 + 70e^(−0.1t), lake oxygen 9 − 0.4d + 0.005d², reservoir H(t) = 6 + 2.5 sin(0.4t) − 0.08t². |
| 17 | 5.1 Using the Mean Value Theorem · 5.2 Extreme Value Theorem, Global Versus Local Extrema, and Critical Points | guides/week-17.md, unit-05/week-17.yaml | Original; hypothetical data and contexts (all invented): weather-balloon altitude table A(t); rain-barrel volume table W(t); melting ice cube (edge shrinking 0.2 cm/min); delivery-van distance table D(t); toll-booth speeding example. |
| 18 | 5.3 Determining Intervals on Which a Function Is Increasing or Decreasing · 5.4 Using the First Derivative Test to Determine Relative (Local) Extrema · 5.5 Using the Candidates Test to Determine Absolute (Global) Extrema | guides/week-18.md, unit-05/week-18.yaml | Original; hypothetical data and contexts (all invented): bacteria P(t) = t³ − 9t² + 24t + 10; coffee T′(10) = −1.8; particle s(t) = t³ − 6t² + 9t. |
| 19 | 5.6 Determining Concavity of Functions over Their Domains · 5.7 Using the Second Derivative Test to Determine Extrema | guides/week-19.md, unit-05/week-19.yaml | Original; hypothetical data and contexts (all invented): rumor spread N(t) at a school; chair cost C(x) = 0.02x² + 4x + 500. |
| 20 | 5.8 Sketching Graphs of Functions and Their Derivatives · 5.9 Connecting a Function, Its First Derivative, and Its Second Derivative · 5.12 Exploring Behaviors of Implicit Relations | guides/week-20.md, unit-05/week-20.yaml | Original; hypothetical data and contexts (all invented): circular ripple (radius growing 3 cm/s); otherwise abstract. |
| 21 | 5.10 Introduction to Optimization Problems · 5.11 Solving Optimization Problems | guides/week-21.md, unit-05/week-21.yaml | Original; hypothetical data and contexts (all invented): riverside pen with 240 m of fence; open box of volume 32 cm³; theater revenue R(p) = p(400 − 20p); poster with 384 cm² of print; 500 cm³ can; island-to-refinery pipeline ($5k/km underwater, $4k/km on land). |
| U5 | 5.1–5.12 | unit-05/unit-summary.md, unit-05/unit-exam.yaml | Original; hypothetical data and contexts (all invented): test-oven temperature table T(t); 200 m² garden against a wall; train covering 150 km in 1.5 h; medicine C(t) = 5t/(1 + 0.2t³); flood-gauge depth W(t) = 40 + 15t·e^(−0.25t). |
| 22 | 6.1 Exploring Accumulations of Change · 6.2 Approximating Areas with Riemann Sums | guides/week-22.md, unit-06/week-22.yaml | Original; hypothetical data and contexts (all invented): rain-barrel inflow table (4, 7, 9, 6, 5 L/min at t = 0, 2, 5, 9, 10 min); scooter piecewise velocity; cyclist piecewise-linear velocity; tank net flow 6 − 2t; factory power use in kW; museum entry-rate table (120–300 people/h); cocoa reheating temperature table; unequal-width g table. |
| 23 | 6.3 Riemann Sums, Summation Notation, and Definite Integral Notation · 6.4 The Fundamental Theorem of Calculus and Accumulation Functions | guides/week-23.md, unit-06/week-23.yaml | Original; hypothetical data and contexts (all invented): piecewise-linear f through (−2, −2), (0, 2), (2, 2), (4, −2), (6, 0); second piecewise-linear f; spherical balloon. |
| 24 | 6.5 Interpreting the Behavior of Accumulation Functions Involving Area · 6.6 Applying Properties of Definite Integrals · 6.7 The Fundamental Theorem of Calculus and Definite Integrals | guides/week-24.md, unit-06/week-24.yaml | Original; hypothetical data and contexts (all invented): given integral values; cistern W(t) = 40 + ∫R; park visitors (E and L rates, 120 at start); 50 L tank with piecewise-linear net rate; fish population 200 + 30t − t²; riverside fence (120 m); unequal-width trapezoid table. |
| 25 | 6.8 Finding Antiderivatives and Indefinite Integrals: Basic Rules and Notation · 6.9 Integrating Using Substitution | guides/week-25.md, unit-06/week-25.yaml | Original; hypothetical data and contexts (all invented): particle v = 3t² − 12t + 9; otherwise pure integrals. |
| 26 | 6.10 Integrating Functions Using Long Division and Completing the Square · 6.14 Selecting Techniques for Antidifferentiation | guides/week-26.md, unit-06/week-26.yaml | Original; no data (abstract functions only). |
| U6 | 6.1–6.14 | unit-06/unit-summary.md, unit-06/unit-exam.yaml | Original; hypothetical data and contexts (all invented): reservoir inflow table (150–240 m³/h at t = 0, 3, 5, 9, 12 h; 5000 m³ at start); semicircle-and-segments graph of f; retention pond R(t) = 40 + 25 sin(t/2) m³/h vs a 50 m³/h pump, 800 m³ at start; substance A(t) = 20 + ∫(3s² − 4s) ds. |
| 27 | 7.1 Modeling Situations with Differential Equations · 7.2 Verifying Solutions for Differential Equations · 7.3 Sketching Slope Fields | guides/week-27.md, unit-07/week-27.yaml | Original; hypothetical data and contexts (all invented): tea cooling from 85 °C in a 21 °C room; announcement spreading in a 1,200-student school; tank dW/dt = 3 − 0.1W; pond algae area; soup 90 °C in a 20 °C room; IV drip dM/dt = 4 − 0.5M. |
| 28 | 7.4 Reasoning Using Slope Fields · 7.6 Finding General Solutions Using Separation of Variables · 7.7 Finding Particular Solutions Using Initial Conditions and Separation of Variables | guides/week-28.md, unit-07/week-28.yaml | Original; no data (abstract functions only). |
| 29 | 7.8 Exponential Models with Differential Equations | guides/week-29.md, unit-07/week-29.yaml | Original; hypothetical data and contexts (all invented): fish dP/dt = 0.08P from 500; bacteria 300 doubling every 5 h; 200 mg medicine, 6 h half-life; coffee 90→60 °C in 10 min (20 °C room); isotope 10-day half-life, 80 g; soup T = 20 + 70e^(−kt); yeast 400 tripling every 6 h; coffee 85→70 °C in 5 min (22 °C room); drug 120→90 mg in 2 h; pie 190 °C in a 25 °C kitchen, 130 °C after 10 min; oil slick; town growth R(t) = 60e^(0.05t). |
| U7 | 7.1–7.8 | unit-07/unit-summary.md, unit-07/unit-exam.yaml | Original; hypothetical data and contexts (all invented): bacteria 2,000→5,000 in 3 h; melting snowball; salt tank dQ/dt = 50 − 0.02Q; draining tank; coasting boat; tracer 8 h half-life; town relative rate −0.03; juice 4 °C in a 24 °C room; table 40, 50, 62.5, 78.125; reservoir mineral M(0) = 600, dM/dt = −0.15(M − 200). Unit summary self-test: tank leaking ∝ cube root of volume; 20-year half-life; object cooling 100 °C in a 30 °C room. |
| 30 | 8.1 Finding the Average Value of a Function on an Interval · 8.2 Connecting Position, Velocity, and Acceleration of Functions Using Integrals · 8.3 Using Accumulation Functions and Definite Integrals in Applied Contexts | guides/week-30.md, unit-08/week-30.yaml | Original; hypothetical data and contexts (all invented): particle v = t² − 6t + 8; tank filling at 20 + 4t L/min; shop customer arrivals; bacteria dy/dt = 0.3y; sand pile 10 + 3 sin(t/2); bakery flour bin; water-treatment tank (in 30 + 10 sin(πt/6), out 2t + 20); guide — cistern (in 60 L/h, out 10t L/h), bike-share docking station. |
| 31 | 8.4 Finding the Area Between Curves Expressed as Functions of x · 8.5 Finding the Area Between Curves Expressed as Functions of y · 8.6 Finding the Area Between Curves That Intersect at More Than Two Points | guides/week-31.md, unit-08/week-31.yaml | Original; hypothetical data and contexts (all invented): lake fish P′ = 40e^(0.1t); otherwise pure functions. |
| 32 | 8.7 Volumes with Cross Sections: Squares and Rectangles · 8.8 Volumes with Cross Sections: Triangles and Semicircles · 8.9 Volume with Disc Method: Revolving Around the x- or y-Axis · 8.10 Volume with Disc Method: Revolving Around Other Axes · 8.11 Volume with Washer Method: Revolving Around the x- or y-Axis · 8.12 Volume with Washer Method: Revolving Around Other Axes | guides/week-32.md, unit-08/week-32.yaml | Original; hypothetical data and contexts (all invented): oil leak 5e^(−0.2t) gal/h; otherwise pure functions. |
| U8 | 8.1–8.12 | unit-08/unit-summary.md, unit-08/unit-exam.yaml | Original; hypothetical data and contexts (all invented): cyclist velocity table (v = 4, 8, 10, 6, 5 m/s at t = 0, 20, 30, 50, 60 s; starts 100 m east of a signpost); stadium entry and exit rates; tank net-rate sign pattern; sediment filter 0.5t·e^(−0.25t) kg/day; stormwater pond (in 40 + 25 sin(0.4t), out 30 + 2t, 500 m³ at the start). |
| 33 | Units 1–8 | review/exam-prep-guide.md | Original; no new data (its examples reuse the practice final's numbers). |
| 34 | Units 1–8 | review/practice-exam.yaml | Original; hypothetical data and contexts (all invented): water tank W′(5) = −3; oil-spill circle; soup cooling H(t) = 20 + 70e^(−0.04t); population P(0) = 500, P(4) = 800; tank filling R(t) = 20 + 10 sin(t/3); storage basin R(t) = 20 + 15 sin(t/2), D(t) = 4t + 6; cyclist velocity table (1.5, 5.3, 8.4, 7.4, 3.5 m/s at t = 0, 4, 10, 15, 20) and model 1.5 + 7 sin(πt/22); 10-foot board sliding down a wall; decaying substance dy/dt = −0.2y, 50 mg. |
