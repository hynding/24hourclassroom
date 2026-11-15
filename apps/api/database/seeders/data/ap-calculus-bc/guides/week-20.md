# Week 20 · Euler's Method and Logistic Models

**Topics:** 7.5 Approximating Solutions Using Euler's Method · 7.9 Logistic Models with Differential Equations
**Practices:** 1 (Implementing Mathematical Processes), 2 (Connecting Representations), 3 (Justification), 4 (Communication and Notation)
**Framework:** AP Calculus AB and BC CED, Unit 7, Topics 7.5 and 7.9, learning objectives in our own words
**Spiral:** Weeks 18–19 built differential equations from words, sketched and read slope fields, separated variables and solved dy/dt = ky. This week adds the two BC-only pieces of Unit 7. Euler's method is the tangent-line approximation of week 9 (local linearization) applied over and over, walking along a slope field. The logistic equation is the exponential model of week 19 with a brake on it, and solving it by separation uses the partial fractions of week 16.

## What you need to be able to do

- **7.5** Approximate a value of a particular solution with Euler's method, given a differential equation, an initial condition and a step size, showing each step.
- **7.5** Decide whether an Euler approximation is an overestimate or an underestimate from the concavity of the solution (the sign of d²y/dx²), and explain why a smaller step usually helps.
- **7.9** Recognise a logistic differential equation, dP/dt = kP(1 − P/M) or dP/dt = cP(M − P), and read off its carrying capacity.
- **7.9** Find lim (t→∞) P(t) for a logistic solution from its initial value, and the value of P at which P grows fastest (P = M/2).
- **7.9** Use d²P/dt² to discuss concavity and the inflection point of a logistic solution, and interpret all of it in context.

## Key terms

| Term | Meaning |
|---|---|
| Euler's method | A step-by-step approximation: from a known point, follow the tangent segment for one step, then recompute the slope. |
| Step size (Δx or h) | The horizontal length of each Euler step. |
| Euler update | yₙ₊₁ = yₙ + h · (dy/dx at (xₙ, yₙ)), with xₙ₊₁ = xₙ + h. |
| Logistic differential equation | dP/dt = kP(1 − P/M) with k > 0, M > 0: growth proportional to both the population and the room left. |
| Carrying capacity M | The equilibrium the population approaches for any positive starting value. |
| Equilibrium solution | A constant solution; for the logistic equation, P = 0 and P = M. |
| Inflection value | P = M/2, where dP/dt is greatest; a solution with 0 < P(0) < M/2 has its inflection point there. |

## Euler's method (7.5)

A differential equation dy/dx = F(x, y) gives the slope of the solution at every point, but not the solution itself. When you cannot (or do not want to) solve it, you can still walk along it. Start at the known point (x₀, y₀). The slope there is F(x₀, y₀), so the tangent line predicts that after a step of h the solution is near

**y₁ = y₀ + h · F(x₀, y₀),  x₁ = x₀ + h.**

Now pretend (x₁, y₁) is on the curve, compute the new slope F(x₁, y₁), and step again. Each step is one local linearization, exactly the week 9 move y ≈ y(a) + y′(a)(x − a), but the slope is refreshed at every stop. On a slope field you are following the little segments one at a time.

A table keeps the work honest. Use one row per step and the columns x, y, slope, change (h · slope).

**Worked example 1.** Let y = f(x) solve dy/dx = x + y with f(0) = 1. Use Euler's method with two steps of size 0.5 to approximate f(1).

| x | y | slope x + y | change 0.5 · slope |
|---|---|---|---|
| 0 | 1 | 1 | 0.5 |
| 0.5 | 1.5 | 2 | 1 |
| 1 | 2.5 | | |

So f(1) ≈ 2.5.

This equation can be solved exactly (the solution is f(x) = 2eˣ − x − 1, which you can check by substitution, as in week 18), so f(1) = 2e − 2 ≈ 3.437. The approximation is too small. With four steps of size 0.25 the estimate becomes about 2.883: closer, still too small.

**Over or under?** Differentiate the differential equation implicitly to find the concavity of the solution:

d²y/dx² = d/dx [x + y] = 1 + dy/dx = 1 + x + y.

At every point Euler used, 1 + x + y > 0, so the solution is concave up there. A concave-up curve lies **above** its tangent lines, so each tangent step lands below the curve: Euler **underestimates**. The rule is the same one you used for tangent-line approximations:

| Solution near the steps | Tangent segments lie | Euler gives |
|---|---|---|
| Concave up (y″ > 0) | below the curve | an underestimate |
| Concave down (y″ < 0) | above the curve | an overestimate |

Remember that y in the second derivative depends on x: d/dx [y] = dy/dx, and then you substitute the differential equation for dy/dx.

**Worked example 2 (a context).** A hypothetical cup of tea is at 90 °C at t = 0 in a 20 °C room, and its temperature satisfies dT/dt = −0.1(T − 20), with t in minutes. Use Euler's method with three steps of Δt = 2 to approximate T(6).

| t | T | dT/dt = −0.1(T − 20) | change 2 · dT/dt |
|---|---|---|---|
| 0 | 90 | −7 | −14 |
| 2 | 76 | −5.6 | −11.2 |
| 4 | 64.8 | −4.48 | −8.96 |
| 6 | 55.84 | | |

So T(6) ≈ 55.84 °C. Here d²T/dt² = −0.1 · dT/dt = 0.01(T − 20) > 0 while the tea is warmer than the room, so the temperature curve is concave up and the estimate is too low. (The exact solution from week 19, T = 20 + 70e^(−0.1t), gives about 58.42 °C.)

**Accuracy.** Euler's error comes from the curve bending away from each tangent segment. Smaller steps bend away less, so halving h usually roughly halves the error, at the cost of twice as many steps. If the solution is a straight line, Euler is exact.

## Logistic models (7.9)

The exponential model dP/dt = kP says the growth rate is proportional to the population, forever. Real populations run out of food, space or customers. The logistic model multiplies by a factor that shrinks to zero as P approaches a ceiling M:

**dP/dt = kP(1 − P/M),  k > 0, M > 0.**

When P is small, 1 − P/M is close to 1 and growth is nearly exponential. As P approaches M the factor approaches 0 and growth stalls. You will also see the same equation multiplied out: dP/dt = cP(M − P) (here k = cM), or as a quadratic like dP/dt = 0.6P − 0.002P². Factor out the coefficient of P² to find M: 0.6P − 0.002P² = 0.002P(300 − P), so M = 300.

**Reading the equation without solving it.** The right side is a downward-opening parabola in P with zeros at P = 0 and P = M.

- **Equilibria:** P = 0 and P = M make dP/dt = 0.
- **Direction:** if 0 < P < M, dP/dt > 0, so P increases; if P > M, dP/dt < 0, so P decreases.
- **Limit:** for any P(0) > 0, lim (t→∞) P(t) = M. (If P(0) = 0, P stays 0.)
- **Fastest growth:** the parabola kP(1 − P/M) is greatest at its vertex, halfway between the zeros: P = M/2.

**Concavity.** Differentiate dP/dt = kP − (k/M)P² with respect to t, using the chain rule because P depends on t:

d²P/dt² = (k − (2k/M)P) · dP/dt = k(1 − 2P/M) · dP/dt.

For 0 < P < M, dP/dt > 0, so the sign of d²P/dt² is the sign of 1 − 2P/M: positive (concave up) for P < M/2 and negative (concave down) for P > M/2. A solution that starts below M/2 is S-shaped, with its inflection point exactly where P = M/2. A solution that starts above M decreases and is concave up as it settles onto M (there both factors are negative, so their product is positive).

**Worked example 3.** A hypothetical deer population in a reserve satisfies dP/dt = 0.4P(1 − P/800), with t in years and P(0) = 100.

- Carrying capacity M = 800, so lim (t→∞) P(t) = 800 deer.
- Growing fastest when P = 400 deer; the rate then is 0.4 · 400 · (1/2) = 80 deer per year.
- At t = 0 the rate is 0.4 · 100 · (7/8) = 35 deer per year, and the graph is concave up there (100 < 400).
- The population increases for all t > 0 and never exceeds 800, because P = 800 is an equilibrium solution and solutions of this equation do not cross.

**Worked example 4 (starting above the capacity).** A hypothetical fish farm pond is overstocked: dF/dt = 0.002F(500 − F), F(0) = 600. Here M = 500 and F(0) > M, so dF/dt = 0.002 · 600 · (−100) = −120 fish per day at t = 0. The population decreases toward 500, lim (t→∞) F(t) = 500, and the graph is concave up throughout, never reaching the "fastest growth" value 250.

**The explicit solution (good to know, not required on the exam).** Separate the variables (week 18) and use partial fractions (week 16):

1/(P(1 − P/M)) = M/(P(M − P)) = 1/P + 1/(M − P).

Integrating, ln|P| − ln|M − P| = kt + C, which solves to

**P(t) = M / (1 + A e^(−kt)),  where A = (M − P(0))/P(0).**

**Worked example 5.** For the deer, A = (800 − 100)/100 = 7, so P(t) = 800/(1 + 7e^(−0.4t)). When does the herd grow fastest? When P = 400: 1 + 7e^(−0.4t) = 2, so e^(−0.4t) = 1/7 and t = (ln 7)/0.4 ≈ 4.865 years. As t → ∞, e^(−0.4t) → 0 and P → 800, agreeing with the reading above.

On free-response questions the questions are almost always about the reading: the limit, the value of P at the fastest growth, the concavity, an Euler step or a tangent line. You can answer every one of those from the differential equation alone.

## Common mistakes

- **Using the slope at the new point for the step that gets you there.** Each step uses the slope at the point you are leaving.
- **Forgetting to update y in the slope.** For dy/dx = x + y, the second slope uses the new y, not the initial one.
- **Doing one big step.** "Two steps of size 0.5" means two separate slope calculations.
- **Treating y as a constant in d²y/dx².** d/dx [y] = dy/dx; substitute the differential equation for it.
- **Saying P grows fastest at the carrying capacity.** At P = M the growth rate is zero; the fastest growth is at M/2.
- **Reading M from the wrong factor.** In dP/dt = 0.003P(600 − P), M = 600, not 0.003 · 600; in dP/dt = 0.5P − 0.01P², factor to 0.01P(50 − P), so M = 50.
- **Assuming the limit depends on P(0).** For any positive start the limit is M; P(0) only decides whether P approaches M from below or above.

## Self-check

1. Use Euler's method with two steps of size 0.1 to approximate y(0.2) if dy/dx = 3y and y(0) = 2.
2. For dy/dx = y − x², y(0) = 1, find d²y/dx² in terms of x and y, and decide whether Euler's method from x = 0 with a small step overestimates or underestimates near x = 0.
3. A hypothetical rumour spreads in a school of 1200 students so that dN/dt = 0.9N(1 − N/1200). What is lim (t→∞) N(t) if N(0) = 10?
4. For dP/dt = 0.8P − 0.004P², find the carrying capacity and the population at which the growth rate is greatest.
5. A logistic solution has M = 300 and P(0) = 450. Is P increasing or decreasing, and is its graph concave up or concave down?

*Answers:* 1. Slope 6, y(0.1) ≈ 2.6; slope 7.8, y(0.2) ≈ 3.38. 2. y″ = y′ − 2x = y − x² − 2x; at (0, 1), y″ = 1 > 0, so the solution is concave up there and Euler underestimates. 3. 1200 students. 4. 0.004P(200 − P): M = 200, greatest growth rate at P = 100. 5. Decreasing (P > M makes dP/dt < 0) and concave up, approaching 300 from above.

---

*Original study material for this course, organised around the College Board AP Calculus AB and BC Course and Exam Description (Unit 7, Topics 7.5 and 7.9). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). AP® is a trademark of the College Board, which does not endorse this material.*
