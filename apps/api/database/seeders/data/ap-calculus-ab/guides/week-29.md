# Week 29 · Exponential Models with Differential Equations

**Topics:** 7.8 Exponential Models with Differential Equations
**Practices:** 1 (Implementing Mathematical Processes), 2 (Connecting Representations), 4 (Communication and Notation)
**Framework:** AP Calculus AB and BC CED, Unit 7, Topic 7.8, learning objectives in our own words (logistic models, Topic 7.9, are BC only and are not part of this course)
**Spiral:** Week 27 taught you to turn "proportional to" into an equation; week 28 taught separation of variables, including the ln|y| step and the sign of the constant. This week applies both to the single most important differential equation in applications, dy/dt = ky. From Unit 3 you need the chain rule for e^(kt), and from Precalculus the logarithm rules for solving e^(kt) = c.

## What you need to be able to do

- **7.8** Recognise that "the rate of change is proportional to the amount present" means dy/dt = ky, and that its solutions are exactly y = y₀e^(kt).
- **7.8** Derive y = y₀e^(kt) by separation of variables and explain why the constant is the initial value y₀.
- **7.8** Interpret k (the relative growth rate) and y₀ in context; decide growth or decay from the sign of k.
- **7.8** Find k from a doubling time, a half-life or two data points, and use the model to predict a value or the time to reach a value.
- **7.8** Solve dy/dt = k(y − M), the model behind Newton's law of cooling, find the long-run value M, and describe concavity.

## Key terms

| Term | Meaning |
|---|---|
| Exponential growth/decay model | dy/dt = ky; solution y = y₀e^(kt). |
| Growth (decay) constant k | The constant of proportionality; k > 0 growth, k < 0 decay. |
| Relative growth rate | (1/y)(dy/dt), the rate as a fraction of the current amount; equals k. |
| Doubling time | Time for y to double: ln 2 / k (k > 0). |
| Half-life | Time for y to halve: ln 2 / |k|. |
| Newton's law of cooling | dT/dt = −k(T − M), k > 0, where M is the surrounding temperature. |
| Equilibrium value | The value M that a shifted exponential approaches (or leaves) as t grows. |

## Why proportional rates give exponentials

The sentence "y changes at a rate proportional to y" is the differential equation dy/dt = ky. It describes anything that changes in proportion to its own size: a population where each organism reproduces at the same average rate, a radioactive sample where each atom has the same chance of decaying per second, a medicine that the body clears at a fixed fraction per hour.

**Worked example (deriving the solution).** Solve dy/dt = ky with y(0) = y₀.

Separate (for y ≠ 0): dy/y = k dt. Integrate: ln|y| = kt + C. Exponentiate: |y| = e^C · e^(kt), so y = Ae^(kt) where A = ±e^C. The constant solution y = 0 (lost when dividing by y) is A = 0, so A can be any real number. At t = 0, y₀ = Ae⁰ = A. Therefore

**y = y₀e^(kt).**

Two facts come straight from the derivation. The constant in front is the starting value, and k sits in the exponent. Checking is quick: d/dt [y₀e^(kt)] = ky₀e^(kt) = ky.

**Reading the model.** For y₀ > 0:

- k > 0: y increases, and faster and faster (concave up, since d²y/dt² = k · dy/dt = k²y > 0).
- k < 0: y decreases toward 0 but never reaches it; it is also concave up (k²y > 0), so the decrease slows down.
- The **relative growth rate** (1/y)(dy/dt) = k is constant. A constant percentage rate is the hallmark of exponential change, in contrast with a constant absolute rate (linear change).
- k is a **continuous** rate. A model dP/dt = 0.08P does not mean "8% per year": the yearly growth factor is e^0.08 ≈ 1.0833, about 8.33%.

## Finding k: doubling time, half-life and data

**Doubling time.** y₀e^(kT) = 2y₀ gives e^(kT) = 2, so T = ln 2 / k. It does not depend on y₀: every doubling takes the same time.

**Half-life.** For decay written dy/dt = −ky with k > 0, e^(−kT) = 1/2 gives T = ln 2 / k, so k = ln 2 / (half-life). Be careful which form the problem uses: if the minus sign is already in the equation, k is positive.

**Two data points.** If y(0) = y₀ and y(t₁) = y₁, then e^(kt₁) = y₁/y₀ and k = ln(y₁/y₀)/t₁. Always divide by y₀ before taking the logarithm.

**Equal time steps multiply by equal factors.** If y goes from 50 to 200 in 2 hours (a factor of 4), then in the next 2 hours it multiplies by 4 again, to 800. You often do not need k at all.

**Worked example (a growing culture).** A hypothetical bacteria culture starts with 300 bacteria and doubles every 5 hours. Write a model and find when it reaches 2,000 bacteria.

k = ln 2 / 5 ≈ 0.1386 per hour, so N(t) = 300e^((ln 2/5)t), which is the same as 300 · 2^(t/5). Solve 300 · 2^(t/5) = 2000: 2^(t/5) = 20/3, so t/5 = ln(20/3)/ln 2 and t = 5 ln(20/3)/ln 2 ≈ 13.685 hours. At that moment the culture is growing at dN/dt = kN ≈ 0.1386 · 2000 ≈ 277 bacteria per hour.

**Worked example (a medicine leaving the body).** A hypothetical medicine is cleared from the bloodstream at a rate proportional to the amount present, with a half-life of 6 hours. A patient has 200 mg at t = 0. How much remains after 15 hours, and when will 25 mg remain?

A(t) = 200 · (1/2)^(t/6) = 200e^(−(ln 2/6)t). After 15 hours: 200 · (1/2)^2.5 ≈ 35.355 mg. For 25 mg: (1/2)^(t/6) = 1/8 = (1/2)³, so t/6 = 3 and t = 18 hours, three half-lives. (Using the e-form: e^(−kt) = 1/8 gives t = ln 8/k = 6 ln 8/ln 2 = 18.)

## Shifted exponentials: Newton's law of cooling

Many models say a quantity changes at a rate proportional to its **distance from a fixed value M**:

dy/dt = k(y − M).

Substitute u = y − M. Since M is constant, du/dt = dy/dt = ku, so u = u₀e^(kt). Back in terms of y:

**y = M + (y₀ − M)e^(kt).**

With k < 0, the difference y − M shrinks exponentially and y → M. This is Newton's law of cooling, usually written with k > 0 as dT/dt = −k(T − M), solution T = M + (T₀ − M)e^(−kt). The same formula covers warming: a cold drink placed in a warm room has T₀ − M < 0, so the term (T₀ − M)e^(−kt) is negative and shrinks, and T rises toward M.

Separating directly gives the same result and shows where the sign of the constant matters. From dT/(T − M) = −k dt, ln|T − M| = −kt + C. If T starts above M it stays above (T = M is an equilibrium solution it cannot cross), so |T − M| = T − M and the constant e^C = T₀ − M is positive. If T starts below M, |T − M| = M − T and the constant in T = M + (T₀ − M)e^(−kt) comes out negative.

**Worked example (a cooling cup of coffee).** A hypothetical cup of coffee at 90 °C is placed in a room at 20 °C. Ten minutes later it is 60 °C. Assuming Newton's law of cooling, find k, the temperature after 20 minutes, and when the coffee reaches 30 °C.

T = 20 + 70e^(−kt). At t = 10: 60 = 20 + 70e^(−10k), so e^(−10k) = 40/70 = 4/7 and k = ln(7/4)/10 ≈ 0.0560 per minute.

After 20 minutes: T(20) = 20 + 70(e^(−10k))² = 20 + 70 · 16/49 = 20 + 160/7 ≈ 42.857 °C. Notice the difference from room temperature went 70 → 40 → 22.86: it is multiplied by 4/7 every 10 minutes.

For 30 °C: 20 + 70e^(−kt) = 30 gives e^(−kt) = 1/7, so t = ln 7/k = 10 ln 7/ln(7/4) ≈ 34.772 minutes.

Concavity: d²T/dt² = −k · dT/dt = k²(T − 20) > 0 while T > 20. The graph is concave up: the coffee cools quickly at first and then more and more slowly.

**Worked example (words to model).** Decide which model fits each hypothetical situation.

- "The value of a collectable increases at a rate proportional to its current value": dV/dt = kV with k > 0, so V = V₀e^(kt).
- "A tank's salt content decreases at a rate proportional to the amount of salt present": dS/dt = −kS with k > 0.
- "A thermometer reading moves toward the outdoor temperature of 5 °C at a rate proportional to the difference": dR/dt = −k(R − 5) with k > 0, a shifted exponential approaching 5.
- "A tank fills at a constant 4 litres per minute": dV/dt = 4, linear, not exponential. The rate does not depend on V.

## Common mistakes

- **Using the percentage as the growth factor.** dP/dt = 0.08P gives a factor e^0.08 per unit time, not 1.08.
- **Forgetting the logarithm.** Doubling time is ln 2 / k, not 2/k.
- **Dividing by the number of half-lives.** Three half-lives multiply by (1/2)³, not 1/3.
- **Taking ln before dividing.** From 500e^(kt) = 1000, divide first: e^(kt) = 2.
- **Double-counting the minus sign.** In dA/dt = −kA with k > 0, k = ln 2/(half-life) is positive.
- **Applying y = y₀e^(kt) to a shifted equation.** dy/dt = k(y − M) has solution M + (y₀ − M)e^(kt); 5 + 2e^(0.3t) solves dy/dt = 0.3(y − 5), not 0.3y.
- **Saying a decaying quantity reaches 0.** e^(kt) is never 0; an exponential model only approaches 0 (or M).

## Self-check

1. A hypothetical population is 2,000 now and 2,600 three years from now, growing at a rate proportional to its size. Find k and the population six years from now.
2. A hypothetical isotope has a half-life of 12 years. What fraction of a sample remains after 30 years?
3. Solve dy/dt = −0.2(y − 50) with y(0) = 10. Is y increasing or decreasing? What is lim (t→∞) y?
4. Why does the doubling time of y = y₀e^(kt) not depend on y₀?
5. The relative growth rate of a hypothetical quantity is −0.05 per hour. Write its differential equation and say whether it grows or decays.

*Answers:* 1. k = ln(1.3)/3 ≈ 0.0875 per year; six years is two factors of 1.3: 2000 · 1.69 = 3,380. 2. (1/2)^(30/12) = (1/2)^2.5 ≈ 0.177. 3. y = 50 − 40e^(−0.2t); increasing toward 50; the limit is 50. 4. Doubling means e^(kT) = 2, an equation with no y₀ in it. 5. dy/dt = −0.05y; it decays.

---

*Original study material for this course, organised around the College Board AP Calculus AB and BC Course and Exam Description (Unit 7, Topic 7.8). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). AP® is a trademark of the College Board, which does not endorse this material.*
