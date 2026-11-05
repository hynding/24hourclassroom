# Week 8 · Phase Shifts and Writing Sinusoids

**Topics:** 2.3 Phase Shift and Vertical Shift · 2.4 Writing Equations of Sinusoids
**Standards:** HSF-TF.B.5, HSF-TF.A.2
**Spiral:** Week 7 gave the two transformations that change a sinusoid's size and speed, amplitude |a| and period 2π/|b|, and the five key points of sine and cosine. This week adds the two that move it, sideways and up or down, and then runs the whole process backwards: from a graph or a table to an equation. Week 6's exact values on the unit circle let you check an equation at a single point, which is the fastest way to catch a sign error.

## What you need to be able to do

- **2.3** Read the amplitude, period, phase shift and midline from y = a sin(b(x − h)) + k or y = a cos(b(x − h)) + k.
- **2.3** Rewrite y = a sin(bx − c) + d by factoring out b, and find the phase shift c/b.
- **2.3** Find the range and the five key points of a shifted sinusoid, starting the cycle at x = h.
- **2.4** Write an equation for a sinusoid from its graph, a description or a table of values, as a sine and as a cosine.

## Key terms

| Term | Meaning |
|---|---|
| Sinusoid | Any graph that is a transformed sine curve: y = a sin(b(x − h)) + k. Every transformed cosine is one too. |
| Phase shift | The horizontal translation h: the graph of y = a sin(bx) moved h units right (h > 0) or left (h < 0). |
| Vertical shift | The constant k that moves the graph up or down; the midline becomes y = k. |
| Midline | y = k, halfway between the maximum value k + |a| and the minimum value k − |a|. |
| Standard form | y = a sin(b(x − h)) + k, with b factored out so that h can be read directly. |

## The four numbers in y = a sin(b(x − h)) + k (2.3)

Each number does one job.

| Number | Effect | Reads as |
|---|---|---|
| a | vertical stretch; a < 0 reflects | amplitude |a| |
| b | horizontal stretch | period 2π/|b| |
| h | horizontal shift | phase shift h (right if positive) |
| k | vertical shift | midline y = k |

The maximum value is k + |a| and the minimum value is k − |a|, so the range is [k − |a|, k + |a|].

The sign inside is the usual trap. In y = sin(x − π/3) the graph moves π/3 to the **right**: the input has to be π/3 larger to give the same output. In y = sin(x + π/3) = sin(x − (−π/3)) the shift is π/3 to the left.

**Sketching recipe.** (1) Start the cycle at x = h, not at 0. (2) Step by period ÷ 4. (3) Use sine's pattern (midline, max, midline, min, midline) or cosine's (max, midline, min, midline, max), flipped if a < 0. (4) Heights are k, k + |a| or k − |a|.

**Worked example 1.** Sketch one cycle of y = 2 sin(x − π/3) + 1.

Amplitude 2, period 2π, phase shift π/3 right, midline y = 1, range [−1, 3]. Start at x = π/3 and step by 2π/4 = π/2:

| x | π/3 | 5π/6 | 4π/3 | 11π/6 | 7π/3 |
|---|---|---|---|---|---|
| y | 1 | 3 | 1 | −1 | 1 |

Check x = 5π/6: the inside is π/2, sin(π/2) = 1, so y = 2 + 1 = 3.

## Factor b out first (2.3)

Equations are often written y = a sin(bx − c) + d. The phase shift is **not** c. Factor:

bx − c = b(x − c/b), so the phase shift is c/b.

**Worked example 2.** Find the features and key points of y = 3 cos(2x + π/2) − 1.

Factor: 2x + π/2 = 2(x + π/4), so y = 3 cos(2(x + π/4)) − 1. Amplitude 3, period 2π/2 = π, phase shift π/4 to the left, midline y = −1, range [−4, 2]. Start at x = −π/4, step π/4, cosine pattern:

(−π/4, 2), (0, −1), (π/4, −4), (π/2, −1), (3π/4, 2).

Check x = 0 in the original form: 3 cos(π/2) − 1 = 0 − 1 = −1. It matches.

A quick way to find the start of the cycle without factoring: set the inside equal to 0. For y = sin(3x − π), 3x − π = 0 gives x = π/3, so the phase shift is π/3, not π.

## Writing an equation from a graph (2.4)

Read four things from the graph, in this order:

1. **Midline** k = (max + min)/2.
2. **Amplitude** |a| = (max − min)/2.
3. **Period** from the horizontal distance between two consecutive maxima, or twice the distance from a maximum to the next minimum; then b = 2π/period.
4. **Shift**: for a cosine, h is the x-value of a maximum; for a sine, h is the x-value where the graph crosses the midline going **up**.

Because the graph repeats, there are infinitely many correct equations: any maximum works for h, and a negative a lets you start at a minimum (for cosine) or a midline crossing going down (for sine).

**Worked example 3.** A sinusoid has a maximum at (1, 7) and the next minimum at (4, −1). Write it as a cosine and as a sine.

Midline k = (7 + (−1))/2 = 3. Amplitude (7 − (−1))/2 = 4. Maximum to minimum is half a cycle, 4 − 1 = 3, so the period is 6 and b = 2π/6 = π/3.

Cosine, starting at the maximum x = 1: y = 4 cos((π/3)(x − 1)) + 3.

Sine: the upward midline crossing comes a quarter period (1.5) before the maximum, at x = −0.5: y = 4 sin((π/3)(x + 0.5)) + 3. Check x = 1: (π/3)(1.5) = π/2 and 4 sin(π/2) + 3 = 7.

## Writing an equation from a table (2.4)

**Worked example 4.** Write an equation for the data.

| x | 0 | π/4 | π/2 | 3π/4 | π |
|---|---|---|---|---|---|
| y | −2 | 1 | 4 | 1 | −2 |

The minimum −2 is at x = 0 and the maximum 4 at x = π/2. Midline (4 + (−2))/2 = 1, amplitude 3. Minimum to maximum is half a cycle, π/2, so the period is π and b = 2.

The cycle starts at a minimum, which is a reflected cosine: y = −3 cos(2x) + 1.

As a sine: the upward midline crossing is at x = π/4 (y = 1, heading up to 4), so y = 3 sin(2(x − π/4)) + 1. Check x = 0: 3 sin(−π/2) + 1 = −3 + 1 = −2.

**Worked example 5 (one function, two forms).** Show that y = 3 sin(x + π/2) and y = 3 cos x are the same function.

Sine shifted π/2 to the left starts at its maximum at x = 0, exactly where cosine does, with the same amplitude and period. Checking x = 0, π/2 and π gives 3, 0 and −3 for both. In general cos x = sin(x + π/2), and sin x = cos(x − π/2).

## Common errors

- **Reading c as the phase shift.** In y = sin(4x + π) the shift is π/4 to the left. Factor b out or set the inside to 0.
- **Getting the direction backwards.** x − h moves right; x + h moves left.
- **Starting the cycle at 0.** After a phase shift, the five key points start at x = h.
- **Mixing up amplitude and midline.** From max 9 and min 1, the midline is 5 and the amplitude 4, not 8 and 4.
- **Doubling the wrong distance.** Max to next min is half a period; max to next midline crossing is a quarter.
- **Not checking.** Substitute one key point into your final equation; a wrong sign shows up at once.

## Where this goes next

Week 9 uses this week's sine and cosine graphs as guides for secant and cosecant, and applies the same shifts to tangent. Week 10 builds models from a context: the maximum, minimum, period and starting time of a Ferris wheel or a tide translate directly into a, b, h and k. In Unit 3, week 17 rewrites a sin x + b cos x as a single shifted sine.

## Self-check

1. Give the amplitude, period, phase shift and range of y = −4 sin(2x − π/2) − 3.
2. List the five key points of y = cos(x + π/6) + 2, starting at the left end of a cycle.
3. A sinusoid has a minimum at (0, 2) and the next maximum at (5, 12). Write it as a cosine.
4. Write the sinusoid in question 3 as a sine.
5. Why is the phase shift of y = sin(3x − π) equal to π/3 rather than π?

---

*Original study material written for this course, organised around the Common Core State Standards for Mathematics (HSF-TF.B.5, HSF-TF.A.2); its approach follows the trigonometry lessons of IM 9–12 Math by Illustrative Mathematics (© 2019, CC BY 4.0). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/).*
