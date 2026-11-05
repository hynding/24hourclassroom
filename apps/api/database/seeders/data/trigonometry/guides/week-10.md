# Week 10 · Sinusoidal Models and Harmonic Motion

**Topics:** 2.7 Sinusoidal Models · 2.8 Simple Harmonic Motion and Frequency
**Standards:** HSF-TF.B.5 (model periodic phenomena with specified amplitude, frequency and midline), HSF-TF.B.7 (use inverse functions to solve equations from modelling contexts, with technology)
**Spiral:** Week 7 gave amplitude |a| and period 2π/|b|; week 8 added the midline, the phase shift (factor b out first) and writing an equation from a graph or table. This week those four numbers come from a story instead of a picture. Week 4's angular speed ω reappears as the b in a harmonic-motion equation, and week 3's "the angle whose cosine is" key on the calculator answers "when?" questions.

## What you need to be able to do

- **2.7** Build a sinusoidal model from a description: a maximum and a minimum, the time of one of them, and the period. Choose sine or cosine (or their negatives) so the starting condition is easy to match.
- **2.7** Interpret every parameter of a model in context, with units: midline as the average level, amplitude as the swing above and below it, period as the time for one cycle, shift as the time of a known peak, trough or midline crossing.
- **2.7** Use a model to predict a value, and use a graph, a calculator or an inverse function to find when the quantity is above or below a given level.
- **2.8** Recognise simple harmonic motion, d = a sin ωt or d = a cos ωt, and read off amplitude |a|, period 2π/ω and frequency ω/(2π).
- **2.8** Write a harmonic-motion equation from a starting position, an amplitude and a period or frequency.

## Key terms

| Term | Meaning |
|---|---|
| Sinusoidal model | A function y = a cos(b(t − h)) + k (or the sine version) chosen to match a repeating quantity. |
| Midline | y = k = (max + min)/2, the average level of the quantity. |
| Amplitude | |a| = (max − min)/2, the greatest distance from the midline. Always positive. |
| Period | The time for one full cycle, P = 2π/|b|, so b = 2π/P. |
| Simple harmonic motion | Motion whose displacement from rest is d = a sin ωt or d = a cos ωt. |
| Angular frequency ω | The coefficient of t, in radians per unit of time (the same ω as week 4's angular speed). |
| Frequency f | Cycles per unit of time: f = ω/(2π) = 1/P. One cycle per second is 1 hertz (Hz). |

## Building a model from a story (2.7)

Almost every modelling question gives (or lets you find) four facts: the largest value, the smallest value, how long one cycle takes, and when one particular point of the cycle happens. Turn them into parameters in this order.

1. **Midline:** k = (max + min)/2.
2. **Amplitude:** |a| = (max − min)/2.
3. **b from the period:** b = 2π/P. If you are told the time from a maximum to the next minimum, that is half a period, so double it first.
4. **Shape and shift:** cosine starts at a maximum, −cosine starts at a minimum, sine starts on the midline going up. Pick the one whose starting point you know, and set h to the time of that point.

There is no single correct equation: 30 − 25 cos(πt/4) and 30 + 25 sin(π(t − 2)/4) describe the same wheel. Any equation that matches all four facts earns full credit, so pick the one with the least arithmetic.

**Worked example 1 (Ferris wheel, hypothetical).** A Ferris wheel has diameter 50 m and its centre is 30 m above the ground. It turns at a steady rate, one revolution every 8 minutes, and a rider boards at the lowest point at t = 0. Write the rider's height h(t) in metres after t minutes, and find the height after 3 minutes.

The lowest point is 30 − 25 = 5 m and the highest is 55 m. Midline k = (55 + 5)/2 = 30; amplitude 25; b = 2π/8 = π/4. The ride starts at a minimum, so use −cosine with no shift:

h(t) = 30 − 25 cos(πt/4).

Check: h(0) = 30 − 25 = 5 and h(4) = 30 + 25 = 55, half a turn later. After 3 minutes, h(3) = 30 − 25 cos(3π/4) = 30 + 25(√2/2) ≈ 47.68 m.

**Worked example 2 (tide, hypothetical).** At a harbour, high tide of 4.6 m occurs at 2:00 a.m. and the next low tide of 1.0 m occurs at 8:15 a.m. Model the water depth D(t), t hours after midnight, and predict the depth at 5:00 a.m.

Midline (4.6 + 1.0)/2 = 2.8 m; amplitude (4.6 − 1.0)/2 = 1.8 m. High to low takes 6.25 hours, which is half a period, so P = 12.5 hours and b = 2π/12.5 = 0.16π ≈ 0.503. The known maximum is at t = 2, so use cosine shifted right 2:

D(t) = 2.8 + 1.8 cos(0.16π(t − 2)).

At 5:00, D(5) = 2.8 + 1.8 cos(0.48π) ≈ 2.91 m, just above the midline: three hours after high tide is almost a quarter period (3.125 h), when the water passes its average depth.

**Worked example 3 (daylight, hypothetical).** In a hypothetical northern city the longest day, 15.2 hours of daylight, is day 172 of a 365-day year, and the shortest is 9.0 hours about half a year later. Write a model L(t) for hours of daylight on day t, and estimate day 80.

Midline (15.2 + 9.0)/2 = 12.1; amplitude 3.1; b = 2π/365. Maximum at t = 172:

L(t) = 12.1 + 3.1 cos(2π(t − 172)/365).

L(80) ≈ 12.06 hours: day 80 is about a quarter-year before the longest day, so daylight is close to its average, as you would expect near an equinox.

## Answering "when" and "for how long" (2.7)

To find when a model reaches a level, set it equal to that level and isolate the cosine (or sine). An inverse function gives one angle; the symmetry of one cycle gives the other. Then divide by b and add the shift. A graphing calculator's intersect feature gives the same times and is a good check.

**Worked example 4 (time above a level).** For the wheel in example 1, during the first revolution, when is the rider more than 45 m above the ground, and for how long?

Solve 30 − 25 cos(πt/4) = 45: cos(πt/4) = −0.6. In radian mode, cos⁻¹(−0.6) ≈ 2.214, so one solution is πt/4 ≈ 2.214 and the other in the first cycle is πt/4 ≈ 2π − 2.214 ≈ 4.069. Multiply by 4/π: t ≈ 2.82 and t ≈ 5.18 minutes. The rider is at the top (55 m) at t = 4, between the two times, so the height exceeds 45 m for 2.82 < t < 5.18, about 2.36 minutes of each 8-minute turn.

Always check which side of the boundary you want by testing a time between the solutions; here the maximum at t = 4 confirms it.

## Simple harmonic motion (2.8)

A weight bouncing on a spring, a pendulum swinging through a small arc, a guitar string and a point on a turning wheel's shadow all move back and forth about a rest position with displacement

d = a sin ωt   or   d = a cos ωt.

There is no midline term because d is measured from rest (k = 0). The parameters mean:

- **amplitude |a|**, the farthest distance from rest;
- **period P = 2π/ω**, the time for one back-and-forth cycle;
- **frequency f = ω/(2π) = 1/P**, the number of cycles per unit of time.

Use cosine when the motion starts at an extreme (pulled and released), sine when it starts at rest position moving in the positive direction. Pulled *down* and released, with up positive, means d = −a cos ωt.

**Worked example 5 (spring).** A weight on a spring is pulled 6 cm below its rest position and released at t = 0. It completes one full oscillation every 1.5 seconds. Take up as positive. Write d(t), state the frequency, and find the position at t = 1 s.

Start at an extreme below rest: d = −6 cos ωt with ω = 2π/1.5 = 4π/3. So d(t) = −6 cos(4πt/3). Frequency f = 1/1.5 = 2/3 Hz (two oscillations every three seconds). At t = 1: d(1) = −6 cos(4π/3) = −6(−1/2) = 3, so the weight is 3 cm above rest.

**Worked example 6 (reading an equation).** A tuning-fork prong has displacement d = 0.4 sin(880πt) millimetres, t in seconds. Find the amplitude, period and frequency.

Amplitude 0.4 mm; ω = 880π, so P = 2π/(880π) = 1/440 s and f = 440 Hz (the pitch A above middle C).

## Common errors

- **Amplitude as max − min.** That is the full swing; the amplitude is half of it.
- **Half a period mistaken for a period.** High tide to low tide, top to bottom of a wheel: each is P/2.
- **b = P instead of b = 2π/P.** A 12-hour cycle has b = π/6, not 12.
- **Frequency and period confused.** f = 1/P. A larger ω means a shorter period and a higher frequency.
- **Degree mode.** Every model here is in radians; cos⁻¹(−0.6) is 2.214, not 126.87.
- **Only one "when".** cos⁻¹ returns one angle; the cycle contains another with the same cosine.
- **Wrong sign at the start.** Pulled down and released is −a cos ωt when up is positive.

## Where this goes next

Week 11 builds the inverse functions properly: why cos⁻¹ returns an angle in [0, π], and why that is only one of the answers a model needs. Week 12 adds sinusoids together and lets the amplitude shrink, giving damped harmonic motion, d = a e^(−ct) cos ωt, the realistic spring. Unit 3's equation solving makes the "when" questions exact.

## Self-check

1. A hypothetical buoy rises and falls between 1.4 m and 3.0 m above the sea floor with period 5 s, at its highest at t = 0. Write a model.
2. Give the amplitude, period and frequency of d = 3 cos(6πt), t in seconds.
3. A pendulum starts at rest position moving right (positive), swings 8 cm each way, and has frequency 0.5 Hz. Write d(t).
4. For the tide in example 2, when after 2:00 a.m. does the depth first fall to 2.8 m?
5. Explain why b = π/6 for a quantity that repeats every 12 months.

*Answers:* 1. h(t) = 2.2 + 0.8 cos(2πt/5). 2. Amplitude 3, period 1/3 s, frequency 3 Hz. 3. d = 8 sin(πt). 4. A quarter period after high tide: t = 2 + 3.125 = 5.125, about 5:07 a.m. 5. b = 2π/P = 2π/12 = π/6.

---

*Original study material written for this course, organised around the Common Core State Standards for Mathematics (HSF-TF.B.5, HSF-TF.B.7); its approach follows the trigonometry lessons of IM 9–12 Math by Illustrative Mathematics (© 2019, CC BY 4.0). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/).*
