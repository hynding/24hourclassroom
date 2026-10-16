# Week 28 · Comparing Transformations and Modeling with Trigonometry

**Lessons:** 6.17 Comparing Transformations · 6.18 Modeling Circular Motion · 6.19 Beyond Circles
**Practices:** MP4 (model with mathematics), MP2 (reason abstractly and quantitatively), MP1 (make sense of problems)
**Built from:** IM Algebra 2, Unit 6, Lessons 17–19, in our own words
**Spiral:** Writing one function in terms of another, g(x) = 2f(x − 1) + 3, is the Unit 5 skill of week 22. The four features of last week supply every parameter of a model. Choosing a parent function for data and checking a model against it (week 23) is repeated here with a periodic parent. The circle coordinates of weeks 24–25 explain why a time-based model has b = 2π/period.

## What you need to be able to do

- **6.17** Describe the transformation taking one function to another from their equations, write g in terms of f, explain when the order of transformations matters, and compare two trigonometric functions by amplitude, midline, period and shift.
- **6.18** Model the height of a point on a turning wheel as a function of **time**, converting the turning rate into b = 2π/period, choosing sine or cosine and the sign from the starting position, and using the model to answer "when" questions.
- **6.19** Fit a sine or cosine model to periodic data that is not about circles (daylight, tides, the Moon, temperature), read the four features from the data, make predictions and state what the model cannot do.

## Key terms

| Term | Meaning |
|---|---|
| Transformation of f | A rule such as g(x) = a · f(b(x − h)) + k; the same rule acts the same way on every kind of parent function. |
| Period in time | The time for one full cycle, T; then b = 2π/T and the model is a sin(2π(t − h)/T) + k. |
| Angular speed | The angle turned per unit time: 2π/T radians per second for a wheel that turns once every T seconds. |
| Periodic data | Measurements that repeat on a fixed cycle: hours of daylight over a year, tide height over a day, the Moon's visible fraction over a month. |
| Residual | Data value minus model value; small residuals of both signs mean a good fit. |

## Comparing transformations (6.17)

The transformation rules do not care what the parent function is. Take f(x) and form g(x) = 2f(x − 1) + 3: whether f is √x, x², 2ˣ or sin x, the graph of g is the graph of f stretched vertically by 2, moved right 1 and up 3. The point (a, f(a)) lands at (a + 1, 2f(a) + 3).

**Worked example.** Write g in terms of f and describe the transformation: f(θ) = cos θ, g(θ) = 3 cos(θ + π/2) − 1.

g(θ) = 3f(θ + π/2) − 1: stretch vertically by 3, move left π/2, move down 1. Since cos(θ + π/2) = −sin θ, g is also −3 sin θ − 1, so the same graph is "sine reflected, stretched by 3, moved down 1".

**Order matters.** Stretching then shifting is not the same as shifting then stretching. Start with sin θ: move up 2 then multiply outputs by 3 gives 3(sin θ + 2) = 3 sin θ + 6, midline 6; multiply by 3 then move up 2 gives 3 sin θ + 2, midline 2. In an equation written as a sin(b(θ − h)) + k, the stretch is applied before the vertical shift. Horizontal order matters in the same way: sin(2(θ − 1)) (shift then compress) is not sin(2θ − 1) (compress then shift).

**Comparing two trigonometric functions.** Put each in the general form and compare feature by feature.

**Worked example.** Compare f(θ) = 2 sin(θ − π/4) + 1 and g(θ) = 2 sin(3θ − 3π/4) + 1.

Both have amplitude 2 and midline 1. g(θ) = 2 sin(3(θ − π/4)) + 1, so both have shift π/4; but f has period 2π and g has period 2π/3. g is f compressed horizontally toward the line θ = π/4 by a factor of 3, three waves where f has one.

**Worked example.** Which of y = 4 cos(2θ) and y = 2 cos(4θ) has the larger maximum, and which has more peaks in [0, 2π]?

4 cos(2θ) has maximum 4 (amplitude 4) and period π, two peaks in [0, 2π]. 2 cos(4θ) has maximum 2 and period π/2, four peaks. The first wins on height, the second on peaks.

**Try it.**
1. f(x) = x², g(x) = −f(x + 2) + 5. Describe the transformation and give the vertex of g.
2. Write h(θ) = 5 sin(2θ + π) − 2 in terms of f(θ) = sin θ, in the form a f(b(θ − h)) + k.

*Answers:* 1. Reflect across the x-axis, move left 2, up 5; vertex (−2, 5). 2. h(θ) = 5f(2(θ + π/2)) − 2.

## Modeling circular motion in time (6.18)

A real wheel is described by time, not angle. If it turns once every T seconds at a steady rate, the angle after t seconds is **θ = (2π/T)·t**. Substituting that into last week's height functions gives a function of t with **period T** and **b = 2π/T**.

**Worked example.** A Ferris wheel of radius 25 m, centre 30 m up, turns once every 60 s. A rider boards at the bottom at t = 0. Write h(t), find the height at t = 10 s, and find the first time the rider is 42.5 m up.

Bottom start means −cos (week 27): h(t) = 30 − 25 cos(2πt/60) = **30 − 25 cos(πt/30)**. Midline 30, amplitude 25, period 60, so the rider is at the top (55 m) at t = 30 and back at the bottom at t = 60.

At t = 10: cos(π/3) = 1/2, so h = 30 − 12.5 = 17.5 m.

42.5 m: 30 − 25 cos(πt/30) = 42.5 gives cos(πt/30) = −1/2, so πt/30 = 2π/3 and t = 20 s (and again at t = 40 s on the way down).

**Choosing sine or cosine and the sign.** Decide what the point is doing at t = 0:

| Starts at | Use |
|---|---|
| the top | k + a cos(bt) |
| the bottom | k − a cos(bt) |
| the right (level with centre), going up | k + a sin(bt) |
| the left (level with centre), going down | k − a sin(bt) |

Anywhere else needs a shift: a point that reaches the top at t = t₀ is k + a cos(b(t − t₀)).

**Worked example.** A bicycle wheel of radius 35 cm turns 2 times per second. A reflector on the rim starts at the front, level with the axle, moving upward (the bike is on a stand). Write the reflector's height above the axle, and above the ground if the axle is 35 cm up.

Period 0.5 s, so b = 2π/0.5 = 4π. Starting level and rising: height above axle = 35 sin(4πt); above the ground, 35 + 35 sin(4πt). At t = 1/8 s, 4π/8 = π/2, so the reflector is at the top, 70 cm up.

**Worked example.** A windmill blade tip is 11 m up at its highest and 1 m at its lowest and turns once every 8 s; it is at the top at t = 3. Write h(t).

Midline 6, amplitude 5, b = 2π/8 = π/4, top at t = 3: h(t) = 6 + 5 cos((π/4)(t − 3)).

**Try it.**
1. A carousel horse rises and falls 20 cm either side of its average height of 1.2 m, completing a cycle every 4 s, and is at its average height going up at t = 0. Write h(t) in metres.
2. For the 60-second Ferris wheel above, at what times in the first turn is the rider higher than 30 m?

*Answers:* 1. h(t) = 1.2 + 0.2 sin(πt/2). 2. Above the midline for the middle half of the turn: 15 < t < 45.

## Beyond circles (6.19)

Anything that repeats on a steady cycle can be modelled with a sine or cosine, even when nothing is going round. The recipe is the same: **midline = (max + min)/2, amplitude = (max − min)/2, period = time between repeats, shift = when a peak (cosine) or an upward midline crossing (sine) happens.**

**Worked example: daylight.** A city's longest day, 21 June (day 172), has 15.0 hours of daylight and its shortest, 21 December (day 355), has 9.0. Model daylight D as a function of the day number t and predict day 80 (21 March).

Midline 12, amplitude 3, period 365 days, peak at t = 172: **D(t) = 12 + 3 cos(2π(t − 172)/365)**. At t = 80: 2π(−92)/365 ≈ −1.584, cos(−1.584) ≈ −0.013, so D ≈ 12 − 0.04 ≈ 11.96 hours, just under 12 as expected a day before the equinox.

**Worked example: tides.** High tide of 5.2 m at 2:00 and the following low tide of 1.0 m at 8:12 (6.2 hours later). Model the water height.

Midline 3.1, amplitude 2.1, half a period is 6.2 h so the period is 12.4 h, peak at t = 2 (hours after midnight): **h(t) = 3.1 + 2.1 cos(2π(t − 2)/12.4)**. The next high tide is at 2 + 12.4 = 14.4, that is 2:24 pm.

**Worked example: the Moon.** The fraction of the Moon's face that is lit goes from 1 (full) to 0 (new) and back every 29.5 days. With a full moon on day 0: f(t) = 0.5 + 0.5 cos(2πt/29.5). Half lit at t = 29.5/4 ≈ 7.4 days (first quarter).

**Judging the model.** Compute residuals at a few data points. Real daylight data has small residuals (the cycle is very regular); real tides and temperatures have larger ones (weather, geography), and the model cannot predict them. A model built from one cycle also cannot see long-term trends. Say so when you report a prediction.

**Try it.**
1. Monthly average temperature peaks at 26°C in July (month 7) and bottoms at 2°C in January (month 1). Write T(m) with a 12-month period.
2. Using the daylight model, how many hours of daylight does day 264 (21 September) get?

*Answers:* 1. Midline 14, amplitude 12: T(m) = 14 + 12 cos(2π(m − 7)/12). 2. 2π(92)/365 ≈ 1.584, cos ≈ −0.013, D ≈ 11.96 hours.

## Common mistakes

- **Using the turning rate as b.** b = 2π/period. Once per 60 s gives b = π/30, not 60 or 1/60.
- **Mixing up time and angle.** In h(t) = 30 − 25 cos(πt/30), t is seconds; the angle is πt/30.
- **Wrong starting shape.** Boarding at the bottom is −cos, not +sin. Check h(0).
- **Period from peak to trough.** That is half a period: double it.
- **Treating a prediction as exact.** A trigonometric model of weather or tides is an approximation; report it as "about".
- **Ignoring order.** 3(sin θ + 2) is not 3 sin θ + 2.

## Where this goes next

The unit exam covers everything from the circle equation to time-based models. After it, Unit 7 turns to statistics: normal distributions, sampling and experiments, where the bell-shaped curve, like the sine wave, is a shape whose equation you read features from.

## Self-check

1. Write g(θ) = −2 cos(θ − π/3) + 4 in terms of f(θ) = cos θ and describe each step in order.
2. Compare y = 3 sin(θ) − 1 and y = 3 sin(2θ) − 1: what is the same, what is different, and how many maximums does each have in [0, 2π]?
3. A Ferris wheel of radius 12 m, centre 14 m up, turns once every 90 s; a rider boards at the bottom. Write h(t) and find the height at t = 15.
4. For the same wheel, find the first time the rider is 20 m up.
5. A pendulum's horizontal displacement from centre reaches 8 cm to the right, swings to 8 cm on the left, and completes a swing every 2 s, starting at the far right. Write d(t), and say what a trigonometric model misses about a real pendulum that slows down.

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Algebra 2, Unit 6, Lessons 17–19, https://im.kendallhunt.com/HS/teachers/3/6/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
