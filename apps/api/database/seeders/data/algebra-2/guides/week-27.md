# Week 27 · Amplitude, Midline, Shift and Period

**Lessons:** 6.13 Amplitude and Midline · 6.14 Transforming Trigonometric Functions · 6.15 Features of Trigonometric Graphs (Part 1) · 6.16 Features of Trigonometric Graphs (Part 2)
**Practices:** MP7 (look for structure), MP4 (model with mathematics), MP6 (attend to precision)
**Built from:** IM Algebra 2, Unit 6, Lessons 13–16, in our own words
**Spiral:** Everything here is Unit 5 applied to a new parent function: k · f(x) and f(x) + k (week 22) become amplitude and midline, f(x − h) (week 21) becomes a horizontal shift, and f(kx) (week 23) changes the period. The graphs of sine and cosine (week 26) are the parents, and the Ferris wheel of week 25 is where the numbers come from.

## What you need to be able to do

- **6.13** Read the amplitude and midline of y = a sin θ + k or y = a cos θ + k from the equation, from a graph and from a situation, and write such an equation for the height of a point on a turning wheel.
- **6.14** Shift a sine or cosine graph horizontally with y = sin(θ − h), find h from a graph, and explain why cosine is a shifted sine.
- **6.15** Match sine and cosine equations to graphs using midline, amplitude and shift, and explain how y = sin(kθ) changes the period to 2π/k.
- **6.16** Write an equation of the form y = a sin(b(θ − h)) + k or y = a cos(b(θ − h)) + k from a graph or a description with any combination of the four features, and read all four from such an equation.

## Key terms

| Term | Meaning |
|---|---|
| Midline | The horizontal line halfway between a wave's maximum and minimum: y = k in y = a sin θ + k; k = (max + min)/2. |
| Amplitude | The distance from the midline to the maximum: |a|; equivalently (max − min)/2. |
| Horizontal shift (phase shift) | How far the wave has moved sideways: y = sin(θ − h) is sin θ moved h to the right. |
| Period | The horizontal length of one full cycle: 2π/b for y = sin(bθ) with b > 0. |
| Frequency (cycles in 2π) | How many full waves fit in an interval of length 2π: b for y = sin(bθ). |

## Amplitude and midline (6.13)

A windmill blade of length 5 m turns about a hub 8 m above the ground. The height of the blade tip, starting level with the hub, is

**h(θ) = 8 + 5 sin θ.**

Compare it with y = sin θ. The 5 stretches the wave vertically: it now swings 5 above and 5 below its centre line. The 8 shifts the whole wave up: its centre line is y = 8, not y = 0. So the tip is highest at 13 m (θ = π/2) and lowest at 3 m (θ = 3π/2).

In general, for **y = a sin θ + k** (or with cos): **midline y = k**, **amplitude |a|**, maximum k + |a|, minimum k − |a|. A negative a flips the wave across its midline (the first move is down instead of up) but the amplitude is still |a|.

**Worked example.** Give the midline, amplitude, maximum and minimum of y = 2 cos θ − 3.

Midline y = −3, amplitude 2, maximum −1, minimum −5. (Graph description: starts at its maximum (0, −1), drops to (π, −5), returns to (2π, −1).)

**Worked example.** A wave has maximum 11 and minimum 5. Find its midline and amplitude.

Midline (11 + 5)/2 = 8; amplitude (11 − 5)/2 = 3. If it starts at its midline going up, y = 3 sin θ + 8; if it starts at its maximum, y = 3 cos θ + 8.

**Worked example.** A Ferris wheel of radius 20 m has its centre 24 m up. Write the height of a rider who starts at the 3 o'clock position, and the height of one who starts at the top.

3 o'clock start (level with the centre, about to rise): h = 24 + 20 sin θ. Top start: h = 24 + 20 cos θ.

**Try it.**
1. Midline, amplitude, maximum and minimum of y = −4 sin θ + 1.
2. Write a sine equation for a wave with midline y = 2 and amplitude 7 that starts at its midline going up.

*Answers:* 1. Midline y = 1, amplitude 4, maximum 5, minimum −3. 2. y = 7 sin θ + 2.

## Horizontal shifts (6.14)

Just as f(x − 3) moves a graph 3 to the right, **y = sin(θ − h) is the sine wave moved h to the right**, and sin(θ + h) moves it h to the left. The sine wave "starts" (crosses its midline going up) at θ = 0; sin(θ − h) starts at θ = h.

The cleanest example: cosine is sine moved π/2 to the left, **cos θ = sin(θ + π/2)**, and sine is cosine moved π/2 to the right, sin θ = cos(θ − π/2). Check one point: sin(0 + π/2) = 1 = cos 0 ✓.

**Worked example.** Graph description: a wave with midline y = 0 and amplitude 1 crosses its midline going up at θ = π/4 and peaks at θ = 3π/4. Write an equation.

It is the sine wave started at π/4: y = sin(θ − π/4). Check the peak: a quarter period after the start, π/4 + π/2 = 3π/4 ✓.

**Worked example.** Write the same wave using cosine.

Cosine starts at a peak, and this wave peaks at 3π/4, so y = cos(θ − 3π/4). Two different-looking equations, one graph: any wave has many correct equations, differing in the shift by multiples of the period or in the choice of sine versus cosine.

**Worked example.** Where does y = cos(θ + π/3) have its first maximum for θ ≥ 0?

Cosine peaks at 0, so cos(θ + π/3) peaks where θ + π/3 = 0, at θ = −π/3, and every 2π after: the first one at or after 0 is θ = −π/3 + 2π = 5π/3.

**Try it.**
1. Describe the graph of y = sin(θ + π/6) compared with y = sin θ.
2. A wave of amplitude 1, midline 0, peaks at θ = π/2 and at θ = 5π/2. Write it two ways.

*Answers:* 1. The sine wave moved π/6 to the left; it crosses the midline going up at θ = −π/6. 2. y = cos(θ − π/2), or y = sin θ (sine peaks at π/2 already).

## Changing the period (6.15)

The input scaling f(kx) from week 23 squeezes a graph horizontally by a factor of k. For sin(2θ), the angle 2θ runs from 0 to 2π while θ runs only from 0 to π: a full wave fits in half the room. **y = sin(bθ) has period 2π/b** and makes b full waves in [0, 2π].

| θ | 0 | π/4 | π/2 | 3π/4 | π | 5π/4 | 3π/2 | 7π/4 | 2π |
|---|---|---|---|---|---|---|---|---|---|
| sin(2θ) | 0 | 1 | 0 | −1 | 0 | 1 | 0 | −1 | 0 |

Two complete waves between 0 and 2π; period π.

**Worked example.** Find the period of y = cos(4θ), y = sin(θ/3) and y = 5 sin(πθ).

2π/4 = π/2 (four waves in [0, 2π]); 2π/(1/3) = 6π (a third of a wave in [0, 2π]); 2π/π = 2.

**Worked example.** Write a sine function with period 10.

2π/b = 10 gives b = 2π/10 = π/5: y = sin(πθ/5), or sin((π/5)θ).

**Worked example.** Match: which of y = 2 sin θ, y = sin(2θ), y = sin θ + 2 has (i) maximum 3, (ii) two peaks in [0, 2π], (iii) maximum 2?

(i) sin θ + 2 (midline 2, amplitude 1). (ii) sin(2θ) (period π). (iii) 2 sin θ (amplitude 2, midline 0).

**Try it.**
1. Period of y = 3 cos(6θ) − 1, and its midline and amplitude.
2. A cosine function completes one wave every 0.5 units. Write it.

*Answers:* 1. Period 2π/6 = π/3, midline y = −1, amplitude 3. 2. b = 2π/0.5 = 4π: y = cos(4πθ).

## All four features at once (6.16)

The general form is

**y = a sin(b(θ − h)) + k** or **y = a cos(b(θ − h)) + k**, with b > 0:

| Feature | From the equation | From the graph |
|---|---|---|
| Midline | y = k | (max + min)/2 |
| Amplitude | |a| | (max − min)/2 |
| Period | 2π/b | distance between consecutive peaks |
| Horizontal shift | h (right if positive) | where a sine-shaped cycle starts going up from the midline, or where a cosine-shaped cycle peaks |

The order matters: the shift h is the amount inside the parentheses *after* factoring out b. In y = sin(2θ − π/2) = sin(2(θ − π/4)), the shift is π/4, not π/2.

**Worked example.** Graph description: a wave with maximum 9 at θ = 1 and minimum 1 at θ = 3, then maximum 9 again at θ = 5. Write an equation.

Midline (9 + 1)/2 = 5, amplitude 4. Peaks at θ = 1 and θ = 5: period 4, so b = 2π/4 = π/2. Cosine peaks at the start of its cycle, so use cosine with shift 1: **y = 4 cos((π/2)(θ − 1)) + 5**. Check θ = 3: cos((π/2)(2)) = cos π = −1, giving 5 − 4 = 1 ✓.

**Worked example.** Read every feature from y = −3 sin(4(θ + π/8)) + 2 and describe the graph.

Midline y = 2, amplitude 3, period 2π/4 = π/2, shift π/8 to the left, reflected (negative a). At θ = −π/8 the wave is on its midline, and because of the reflection it heads *down* first, reaching its minimum −1 a quarter period later at −π/8 + π/8 = 0. So the graph passes through (0, −1), rises to (π/8, 2), peaks at (π/4, 5), and repeats every π/2.

**Worked example.** Rewrite y = 2 sin(3θ − π) + 1 in the factored form and read the shift.

3θ − π = 3(θ − π/3), so y = 2 sin(3(θ − π/3)) + 1: shift π/3 to the right, period 2π/3, amplitude 2, midline y = 1.

**Try it.**
1. Write a sine equation for a wave with midline 10, amplitude 6, period 8, starting at its midline going up at θ = 2.
2. Give the maximum of y = 5 cos(2(θ − 1)) − 7 and the first θ ≥ 0 where it occurs.

*Answers:* 1. b = 2π/8 = π/4: y = 6 sin((π/4)(θ − 2)) + 10. 2. Maximum −2 at θ = 1 (where the cosine's argument is 0).

## Common mistakes

- **Amplitude as max − min.** Amplitude is half of that; the midline is the average, not the minimum.
- **Period 2π·b instead of 2π/b.** A bigger b means more waves in the same room, so a shorter period. sin(4θ) has period π/2.
- **Reading the shift before factoring.** sin(2θ − π/2) is shifted π/4, not π/2.
- **Shift direction.** θ − h moves right; θ + h moves left, just as with f(x − h).
- **Thinking there is one right equation.** A sine and a cosine form, and shifts differing by a period, all describe the same wave; check by evaluating a point.
- **Negative a as "negative amplitude".** Amplitude is |a|; the sign reflects the wave across its midline.

## Where this goes next

Next week: the same four features read from an equation to compare two transformed functions, and used in reverse to model wheels, tides and temperatures whose inputs are time rather than angle, where the period becomes a number of seconds or days and b = 2π/period.

## Self-check

1. Midline, amplitude, period and shift of y = 7 sin(2(θ − π/6)) − 3, and its maximum and minimum.
2. Graph description: a wave with minimum −2 at θ = 0, maximum 6 at θ = π, minimum −2 again at θ = 2π. Write a cosine equation.
3. Explain why y = cos(θ − π/2) and y = sin θ have the same graph.
4. A wave has period 12 and amplitude 2.5. What is b, and what is the midline if the minimum is 4?
5. Write y = sin(πθ/2 − π) in the form a sin(b(θ − h)) + k and state the shift.

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Algebra 2, Unit 6, Lessons 13–16, https://im.kendallhunt.com/HS/teachers/3/6/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
