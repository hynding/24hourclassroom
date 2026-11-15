# Attribution

AP Calculus BC **builds on this site's AP Calculus AB course**
(`../ap-calculus-ab/`): its weeks 1–15, 18–19 and 21–22 put AB's own study
guides, flashcard decks and quizzes into the BC course at BC's faster pace,
and its Units 1–8 reuse AB's unit exams and summaries. Those materials are
described, with their sources and data, in AB's ATTRIBUTION.md; nothing of
AB's is copied here.

Everything in this directory (the BC weeks' study guides, flashcards and
quizzes for topics 6.11–6.13, 7.5, 7.9, 8.13 and Units 9–10, the Unit 9 and
10 summaries and exams, the exam-prep guide and the practice final) is
**original writing** for this course, organised around the College Board
*AP Calculus AB and BC Course and Exam Description* (CED, effective fall
2020, with the clarifications for 2026-27): its ten units, topic codes and
topic titles organise the material, and what each topic expects of students
is paraphrased in the course's own words, never copied. The May 2027 exam
format (question counts, timing, calculator rules), the exam date and the BC
unit weightings are taken from AP Central (the AP Calculus BC exam and course
pages and the 2026-27 CED clarifications, accessed 2026-11-14). AP® is a
trademark of the College Board, which does not endorse this material.

No textbook is adapted, for the reasons AB's ATTRIBUTION.md gives (OpenStax
*Calculus* is CC BY-NC-SA with a no-AI clause; *Active Calculus* is CC BY-SA;
*CLP* and *APEX* are non-commercial). Nor was text taken from Khan Academy,
commercial review books, study sites or College Board released exam questions
and scoring guidelines. Definitions, theorems and formulas (integration by
parts, the convergence tests, Taylor's theorem and the Lagrange and
alternating series error bounds, the arc length, parametric, polar and vector
formulas) are standard mathematics and were not copied from any reference.

**Data.** Every number in a context was invented for this course and computed
to fit the model it illustrates. None of it is real-world data, and items
that might be mistaken for real data say "hypothetical". The per-week table
below names each invented data set.

**Figures** are described in words or given as tables of values; the app
renders no images or LaTeX, so mathematics is written in plain Unicode.

## Licence

The study guides, unit summaries, flashcards, test items and explanations in this directory are © 2026 24 Hour Classroom and are licensed under the Creative Commons Attribution 4.0 International License (CC BY 4.0, https://creativecommons.org/licenses/by/4.0/). Anyone may copy, adapt and share them, for any purpose, as long as they credit "24 Hour Classroom", link to the licence and say what they changed.

AP® is a trademark of the College Board, which was not involved in producing this course and does not endorse it. The Course and Exam Description belongs to the College Board and is not covered by this licence.

## Sources

| Source | URL | Used for |
|---|---|---|
| AP Calculus AB and BC Course and Exam Description (College Board) | https://apcentral.collegeboard.org/media/pdf/ap-calculus-ab-and-bc-course-and-exam-description.pdf | Unit titles, topic codes and titles, the four mathematical practices (course.yaml) |
| AP Calculus AB and BC CED clarifications for 2026-27 (College Board) | https://apcentral.collegeboard.org/media/pdf/ap-calculus-ab-bc-course-and-exam-description-clarifications.pdf | The May 2027 multiple-choice counts and timing (29 + 13, from 30 + 15) |
| AP Central, AP Calculus BC course page (College Board) | https://apcentral.collegeboard.org/courses/ap-calculus-bc/course | BC unit weightings (course.yaml, exam-prep guide) |
| AP Central, AP Calculus BC exam page (College Board) | https://apcentral.collegeboard.org/courses/ap-calculus-bc/exam | Exam date (Monday 2027-05-10, session 1), hybrid digital format, timing and calculator policy (exam-prep guide and practice final) |

Items whose `source` field reads `general knowledge` rest on prerequisite
algebra or precalculus rather than on a CED topic; every other item names the
CED topic it assesses.

## Per-week table

| Week | CED topics | Files | Sources and data |
|---|---|---|---|
| 1–15, 18–19, 21–22 | AB topics, Units 1–8 | reuse week files (unit-01 … unit-08) | Reused from AP Calculus AB as they are: its weeks' guides, decks and quizzes (see ../ap-calculus-ab/ATTRIBUTION.md for their data). Units 1–8 also reuse AB's unit exams and summaries. |
| 16 | 6.11 Integrating Using Integration by Parts · 6.12 Integrating Using Linear Partial Fractions | guides/week-16.md, unit-06/week-16.yaml | Original; no data (pure mathematics with original functions and integrals). |
| 17 | 6.13 Evaluating Improper Integrals | guides/week-17.md, unit-06/week-17.yaml | Original; no data (pure mathematics with original integrals). |
| 20 | 7.5 Approximating Solutions Using Euler's Method · 7.9 Logistic Models with Differential Equations | guides/week-20.md, unit-07/week-20.yaml | Original; hypothetical data and contexts (all invented): tea cooling dT/dt = −0.1(T − 20) from 90 °C; reserve deer dP/dt = 0.4P(1 − P/800) from 100; overstocked fish-farm pond dF/dt = 0.002F(500 − F) from 600; rumour in a 1,200-student school; beetles (capacity 1,200); bacteria colony 0.01P(250 − P); overstocked trout lake 0.0005N(600 − N) from 900; P = 1000/(1 + 9e^(−0.5t)); yeast doubling every 5 h from 300; app subscribers 0.25S(1 − S/400) from 80 thousand; lake fish 0.2F(1 − F/2000) from 400. |
| 23 | 8.13 The Arc Length of a Smooth, Planar Curve and Distance Traveled | guides/week-23.md, unit-08/week-23.yaml | Original; hypothetical data and contexts (all invented): ski-run profile y = 40 − 0.1x² (0 ≤ x ≤ 20 m), skier at 5 m/s; bead on a wire y = √x; grassy-hill profile y = 8 − x²/8, hiker at 0.8 m/s. |
| 24 | 9.1 Defining and Differentiating Parametric Equations · 9.2 Second Derivatives of Parametric Equations · 9.3 Finding Arc Lengths of Curves Given by Parametric Equations | guides/week-24.md, unit-09/week-24.yaml | Original; hypothetical beetle population dP/dt = 0.4P(1 − P/800), P(0) = 100; otherwise abstract parametric curves. |
| 25 | 9.4 Defining and Differentiating Vector-Valued Functions · 9.5 Integrating Vector-Valued Functions · 9.6 Solving Motion Problems Using Parametric and Vector-Valued Functions | guides/week-25.md, unit-09/week-25.yaml | Original; abstract planar particle motions and a logistic equation with carrying capacity 500; no data. |
| 26 | 9.7 Defining Polar Coordinates and Differentiating in Polar Form · 9.8 Find the Area of a Polar Region or the Area Bounded by a Single Polar Curve · 9.9 Finding the Area of the Region Bounded by Two Polar Curves | guides/week-26.md, unit-09/week-26.yaml | Original; no data (abstract polar curves only). |
| U9 | 9.1–9.9 | unit-09/unit-summary.md, unit-09/unit-exam.yaml | Original; hypothetical warehouse delivery robot (dx/dt = 4cos(t²/3), dy/dt = 1 + ln(1 + t), from (2, −1)); otherwise abstract curves and particles. |
| 27 | 10.1 Defining Convergent and Divergent Infinite Series · 10.2 Working with Geometric Series · 10.3 The nth Term Test for Divergence | guides/week-27.md, unit-10/week-27.yaml | Original; hypothetical data and contexts (all invented): partial sums Sₙ = 6n/(2n + 1); idealized bouncing balls (6 m, rebound 2/3; 10 ft, rebound 3/5); a patient on a daily 100 mg dose with 60% remaining each day. |
| 28 | 10.4 Integral Test for Convergence · 10.5 Harmonic Series and p-Series · 10.6 Comparison Tests for Convergence | guides/week-28.md, unit-10/week-28.yaml | Original; hypothetical island bird population dP/dt = 0.4P(1 − P/500), P(0) = 100; otherwise pure mathematics. |
| 29 | 10.7 Alternating Series Test for Convergence · 10.8 Ratio Test for Convergence · 10.9 Determining Absolute or Conditional Convergence | guides/week-29.md, unit-10/week-29.yaml | Original; no data (pure mathematics). |
| 30 | 10.10 Alternating Series Error Bound · 10.11 Finding Taylor Polynomial Approximations of Functions | guides/week-30.md, unit-10/week-30.yaml | Original; no data (abstract series and tables of derivatives). |
| 31 | 10.12 Lagrange Error Bound · 10.13 Radius and Interval of Convergence of Power Series | guides/week-31.md, unit-10/week-31.yaml | Original; no data (abstract tables of derivatives and series). |
| 32 | 10.14 Finding Taylor or Maclaurin Series for a Function · 10.15 Representing Functions as Power Series | guides/week-32.md, unit-10/week-32.yaml | Original; no data (abstract series and functions). |
| U10 | 10.1–10.15 | unit-10/unit-summary.md, unit-10/unit-exam.yaml | Original; hypothetical cooling soup H(t) given by derivatives at t = 0 (82.4, −5.6, 0.84, −0.096; \|H⁽⁴⁾\| ≤ 0.018); otherwise abstract tables and series. |
| 33 | Units 1–10 | review/exam-prep-guide.md | Original; no data. |
| 34 | Units 1–10 | review/practice-exam.yaml | Original; hypothetical data and contexts (all invented): grain silo loaded at G(t) = 90t·e^(−0.25t), unloaded at 90 t/h, 400 t at the start; tea cooling T(t) = 22 + 68e^(−0.06t); tank inflow table r(t) = 12, 15, 11, 8, 10 at t = 0, 2, 5, 9, 10; radioactive sample dM/dt = −0.035M, 80 g; fish dP/dt = 0.4P(1 − P/600) from 100; hares dP/dt = (P/4)(1 − P/1500) from 300; soap bubble losing 8 cm² of surface per minute. |
