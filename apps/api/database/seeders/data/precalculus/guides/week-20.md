# Week 20 · Graphs of Sine and Cosine; Sinusoidal Functions

**Topics:** 3.4 Sine and Cosine Function Graphs · 3.5 Sinusoidal Functions
**Practices:** 1 (procedural and symbolic fluency), 2 (multiple representations), 3 (communication and reasoning)
**Framework:** AP Precalculus CED, Unit 3, Topics 3.4–3.5, learning objectives in our own words
**Spiral:** Week 19's unit-circle coordinates become points on graphs this week: every exact value you learned is a point on y = sin θ or y = cos θ. Week 18's ideas of period and repeating behaviour, and week 1's language of increasing, decreasing, concavity and average rate of change, describe those graphs. Week 8's transformations (a·f(b(x − h)) + k) are exactly what turn sin θ into a general sinusoidal function.

## What you need to be able to do

- **3.4** Build the graphs of y = sin θ and y = cos θ by "unwrapping" the unit circle: plot the vertical coordinate (for sine) or horizontal coordinate (for cosine) of the point at angle θ against θ.
- **3.4** State the domain, range, period, zeros, maxima and minima of sine and cosine, and identify the intervals where each is increasing, decreasing, concave up and concave down.
- **3.4** Describe how the rate of change of sin θ or cos θ varies: fastest where the graph crosses its midline, zero at the peaks and troughs.
- **3.5** Recognise a sinusoidal function f(θ) = a sin(b(θ + c)) + d or a cos(b(θ + c)) + d, and find its amplitude |a|, period 2π/|b|, midline y = d, maximum d + |a| and minimum d − |a|.
- **3.5** Explain that the cosine graph is the sine graph shifted left by π/2, so every sinusoid can be written using either function.

## Key terms

| Term | Meaning |
|---|---|
| Sinusoidal function | Any function that can be written f(θ) = a sin(b(θ + c)) + d with a ≠ 0 and b ≠ 0 (or the same with cosine). |
| Midline | The horizontal line y = d halfway between the maximum and minimum values. |
| Amplitude | The vertical distance from the midline to a maximum (or minimum): |a| = (max − min)/2. Always positive. |
| Period | The horizontal length of one cycle: 2π/|b| for a sinusoid. |
| Frequency | The number of cycles per unit of input: |b|/(2π), the reciprocal of the period. |
| Phase shift | A horizontal translation of the graph; f(θ) = a sin(b(θ + c)) + d is the graph of a sin(bθ) + d shifted c units left (right if c < 0). |
| Point of inflection | A point where the concavity changes; for a sinusoid these are the midline crossings. |

## Unwrapping the unit circle (3.4)

Imagine the point P = (cos θ, sin θ) travelling counterclockwise round the unit circle as θ grows from 0. Record its **height** against the angle and you get y = sin θ:

| θ | 0 | π/6 | π/2 | 5π/6 | π | 7π/6 | 3π/2 | 11π/6 | 2π |
|---|---|---|---|---|---|---|---|---|---|
| sin θ | 0 | 0.5 | 1 | 0.5 | 0 | −0.5 | −1 | −0.5 | 0 |

The point starts on the x-axis at height 0, climbs to height 1 at the top (θ = π/2), drops back to 0 at θ = π, reaches −1 at the bottom (θ = 3π/2) and returns to 0 at θ = 2π. Then it all repeats.

Record the point's **horizontal position** instead and you get y = cos θ: it starts at 1 (the point is at (1, 0)), drops to 0 at π/2, reaches −1 at π, returns to 0 at 3π/2 and to 1 at 2π.

Because the circle has no beginning or end, θ can be any real number, negative angles included, and the graphs extend in both directions forever.

## Features of y = sin θ and y = cos θ (3.4)

| Feature | y = sin θ | y = cos θ |
|---|---|---|
| Domain | all real θ | all real θ |
| Range | [−1, 1] | [−1, 1] |
| Period | 2π | 2π |
| Midline, amplitude | y = 0, amplitude 1 | y = 0, amplitude 1 |
| Zeros | θ = kπ (0, ±π, ±2π, …) | θ = π/2 + kπ (±π/2, ±3π/2, …) |
| Maximum 1 at | θ = π/2 + 2kπ | θ = 2kπ |
| Minimum −1 at | θ = 3π/2 + 2kπ | θ = π + 2kπ |
| Symmetry | odd: sin(−θ) = −sin θ (origin) | even: cos(−θ) = cos θ (y-axis) |

Here k stands for any integer.

**Increasing and decreasing.** On [0, 2π], sine increases on [0, π/2] and [3π/2, 2π] and decreases on [π/2, 3π/2]. Cosine decreases on [0, π] and increases on [π, 2π]. On the circle, sine increases whenever the point is moving upward, which happens on the right half of the circle.

**Concavity.** A sinusoid is concave down where it is above its midline (around a peak) and concave up where it is below its midline (around a trough). So sin θ is concave down on (0, π) and concave up on (π, 2π); cos θ is concave down on (−π/2, π/2) and concave up on (π/2, 3π/2). The concavity changes at every midline crossing, so those crossings are points of inflection.

**How fast it changes.** Compare average rates of change of sin θ over equal steps of π/6:

| Interval | [0, π/6] | [π/6, π/3] | [π/3, π/2] |
|---|---|---|---|
| Change in sin θ | 0.5 | 0.366 | 0.134 |
| Average rate of change | 0.955 | 0.699 | 0.256 |

The function is increasing on all three intervals, but each rate is smaller than the one before: sine is increasing and concave down on (0, π/2). The rate is greatest near θ = 0, where the graph crosses its midline, and close to 0 near θ = π/2, where the graph levels off at its peak. This is the general pattern: a sinusoid changes fastest at its midline crossings and slowest at its extremes.

**Worked example.** On which intervals in [0, 2π] is y = cos θ decreasing and concave up?

Cosine decreases on [0, π] and is concave up on (π/2, 3π/2). The overlap is (π/2, π): the graph has just crossed below the midline and is falling more and more slowly towards its minimum at π.

**Try it.**
1. List the zeros of sin θ in [−2π, 2π].
2. On which interval in [0, 2π] is y = sin θ decreasing and concave up?
3. Which is larger, the average rate of change of cos θ over [0, π/3] or over [π/3, 2π/3]? Explain with concavity.

*Answers:* 1. −2π, −π, 0, π, 2π. 2. (π, 3π/2). 3. Over [0, π/3]: (1/2 − 1)/(π/3) ≈ −0.477; over [π/3, 2π/3]: (−1/2 − 1/2)/(π/3) ≈ −0.955. The second is more negative, so cosine falls faster near its midline crossing at π/2; the first rate is the larger number.

## Sinusoidal functions (3.5)

A **sinusoidal function** is a sine or cosine graph that has been stretched, compressed, flipped or slid. In the form

**f(θ) = a sin(b(θ + c)) + d**   (or the same with cos)

each parameter controls one feature:

- **|a| is the amplitude.** The graph reaches up to d + |a| and down to d − |a|. If a < 0 the graph is also reflected across its midline.
- **2π/|b| is the period.** A larger |b| squeezes more cycles into the same interval. Period π means b = ±2; period 6 means |b| = 2π/6 = π/3.
- **y = d is the midline.** It is the average of the maximum and minimum.
- **c is a horizontal shift.** The graph of a sin(bθ) + d moves c units left (or right if c is negative). Week 21 works with this in detail.

When you are given a graph or data instead of a formula, run the formulas backwards:

- midline d = (max + min)/2;
- amplitude |a| = (max − min)/2;
- period = horizontal distance between consecutive maxima (or minima), then |b| = 2π/period.

**Worked example.** State the amplitude, period, midline, maximum and minimum of f(θ) = −4 sin(θ/3) + 2.

a = −4, b = 1/3, d = 2. Amplitude 4; period 2π/(1/3) = 6π; midline y = 2; maximum 2 + 4 = 6; minimum 2 − 4 = −2. Because a < 0 the graph starts at its midline at θ = 0 and goes *down* first.

**Worked example.** Find f(π/3) for f(θ) = 3 cos(2θ) − 1, and describe the graph on [0, π].

f(π/3) = 3 cos(2π/3) − 1 = 3(−1/2) − 1 = −5/2. The period is 2π/2 = π, so [0, π] is exactly one cycle: the graph starts at its maximum 2 at θ = 0, falls through the midline y = −1 at θ = π/4, reaches its minimum −4 at θ = π/2, and climbs back through the midline at 3π/4 to the maximum at π.

**Worked example.** A sinusoid has midline y = 1, maximum 5 at θ = 0 and period π. Write an equation.

Amplitude 5 − 1 = 4. Period π gives b = 2. A maximum at θ = 0 is where cosine starts, so f(θ) = 4 cos(2θ) + 1.

## Cosine is a shifted sine (3.5)

Slide the sine graph π/2 to the left: its peak at π/2 moves to 0, its zero at 0 moves to −π/2. That is the cosine graph. In symbols,

**cos θ = sin(θ + π/2)**, and equivalently **sin θ = cos(θ − π/2)**.

On the unit circle, this says that cosine "is ahead of" sine by a quarter turn. So the choice between sine and cosine is a matter of convenience: use cosine when a maximum is at the start of a cycle, sine when the graph starts on its midline going up, −cos when it starts at a minimum, and −sin when it starts on its midline going down.

**Worked example.** Write f(θ) = 2 cos θ + 3 as a sine function.

cos θ = sin(θ + π/2), so f(θ) = 2 sin(θ + π/2) + 3. The amplitude, period and midline do not change; only the description of the starting point does.

**Try it.**
1. Amplitude, period and midline of y = 7 sin(4θ) − 3?
2. A sinusoid has maximum 9 and minimum −3. Find its midline and amplitude.
3. Write a sine function with amplitude 2, period 4π and midline y = −1 that starts on its midline going up at θ = 0.
4. Which of sin(θ − π/2) and −cos θ are equal for all θ?

*Answers:* 1. 7, π/2, y = −3. 2. y = 3, amplitude 6. 3. y = 2 sin(θ/2) − 1. 4. They are equal: shifting sine right by π/2 puts its minimum at θ = 0, which is −cos θ.

## Calculator notes

Graph sinusoids in radian mode with a window that shows at least one full period, for example θ from 0 to 2π (about 6.28) for the basic functions. Use the calculator's maximum, minimum and zero tools to check features you found by hand. On AP no-calculator questions, features of sinusoids are expected from the parameters, and values at special angles are expected in exact form.

## Common mistakes

- **Taking a as the amplitude when a is negative.** The amplitude of −4 sin θ is 4. The negative sign is a reflection.
- **Period = b.** The period is 2π/|b|. For sin(4θ) it is π/2, not 4 and not 8π.
- **Forgetting d when finding max and min.** For 2 − 5 cos θ the maximum is 2 + 5 = 7, not 5.
- **Using the wrong function to start.** If the graph starts at a maximum at θ = 0, cosine fits without a shift; using sine there needs a phase shift.
- **Thinking the rate of change is constant between peak and trough.** A sinusoid is steepest at its midline and flat at its extremes.
- **Swapping concavity.** Above the midline, a sinusoid is concave down (it is shaped like a hill); below the midline, concave up.

## Where this goes next

Week 21 studies each of a, b, c and d as a transformation, finds sinusoidal models from maximum, minimum and period data in contexts such as tides, daylight and Ferris wheels, and describes sinusoidal regression. Week 22 builds the graph of the tangent function, which behaves very differently: period π and vertical asymptotes. Week 23 solves equations such as 3 cos(2θ) − 1 = 0, using the graphs from this week to count solutions.

## Self-check

1. Give the zeros, maximum points and minimum points of y = cos θ on [0, 4π].
2. On which intervals in [0, 2π] is y = sin θ increasing and concave up?
3. Find the amplitude, period, midline, maximum and minimum of y = 5 − 2 cos(πθ).
4. A sinusoid starts at its minimum −1 at θ = 0, has maximum 7 and period 8. Write an equation.
5. Explain, using the unit circle, why sin θ changes fastest near θ = 0 and slowest near θ = π/2.

---

*Original study material for this course, organised around the College Board AP Precalculus Course and Exam Description (Unit 3, Topics 3.4–3.5). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). AP® is a trademark of the College Board, which does not endorse this material.*
