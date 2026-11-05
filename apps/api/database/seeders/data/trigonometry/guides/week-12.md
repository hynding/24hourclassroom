# Week 12 · Inverse Reciprocal Functions, Sums of Sinusoids and Damping

**Topics:** 2.11 Sums of Sinusoids and Damped Oscillation · 2.12 Inverse Cotangent, Secant and Cosecant
**Standards:** HSF-TF.B.6 (extension: inverses of the reciprocal functions on restricted domains), HSF-TF.B.5 (extension: combining and damping periodic models)
**Spiral:** Week 9 graphed cotangent, secant and cosecant, and week 11 built sin⁻¹, cos⁻¹ and tan⁻¹ on restricted domains; this week the reciprocal functions get inverses the same way. Weeks 7 and 8 gave amplitude, period and phase shift, and week 10's harmonic motion d = a cos ωt is about to lose energy: multiply by a shrinking factor and the spring slowly comes to rest.

## What you need to be able to do

- **2.12** State the range conventions for cot⁻¹, sec⁻¹ and csc⁻¹, and evaluate them exactly and with a calculator by rewriting in terms of the functions on your calculator.
- **2.12** Evaluate compositions such as sin(sec⁻¹(−3)) with a reference triangle.
- **2.11** Graph a sum of two functions by adding ordinates (y-values), and find the period of a sum of sinusoids.
- **2.11** Recognise y = sin x + cos x as a single sinusoid, √2 sin(x + π/4), from its graph or a table.
- **2.11** Describe damped oscillation y = a e^(−ct) cos ωt: the envelope curves ±a e^(−ct), the shrinking amplitude, and when the oscillation falls below a given size. Explain beats as the sum of two nearby frequencies.

## Key terms

| Term | Meaning |
|---|---|
| cot⁻¹ x (arccot x) | The angle in (0, π) whose cotangent is x; defined for every real x. |
| sec⁻¹ x (arcsec x) | The angle in [0, π], excluding π/2, whose secant is x; defined for |x| ≥ 1. |
| csc⁻¹ x (arccsc x) | The angle in [−π/2, π/2], excluding 0, whose cosecant is x; defined for |x| ≥ 1. |
| Addition of ordinates | Graphing f + g by adding the y-values of f and g at each x. |
| Damped oscillation | An oscillation whose amplitude decreases over time, such as y = a e^(−ct) cos ωt with c > 0. |
| Envelope | The curves y = ±a e^(−ct) that a damped oscillation touches at its peaks and troughs and never crosses. |
| Beats | The slow rise and fall in loudness when two tones of nearly equal frequency sound together; beat frequency |f₁ − f₂|. |

## Inverse cotangent, secant and cosecant (2.12)

Each reciprocal function is restricted, like its partner in week 11, to an interval on which it is one-to-one and takes every value once. This course uses the conventions that match cos⁻¹ and sin⁻¹:

| Function | Inverse | Domain of inverse | Range of inverse | Rewrite for a calculator |
|---|---|---|---|---|
| cot x on (0, π) | cot⁻¹ x | all reals | (0, π) | π/2 − tan⁻¹ x |
| sec x on [0, π], x ≠ π/2 | sec⁻¹ x | x ≤ −1 or x ≥ 1 | [0, π], excluding π/2 | cos⁻¹(1/x) |
| csc x on [−π/2, π/2], x ≠ 0 | csc⁻¹ x | x ≤ −1 or x ≥ 1 | [−π/2, π/2], excluding 0 | sin⁻¹(1/x) |

Why the rewrites work: if sec θ = x then cos θ = 1/x, and the range of sec⁻¹ is the range of cos⁻¹ with π/2 removed (where secant is undefined). Similarly for cosecant and sine. Other books sometimes choose different ranges for sec⁻¹ and csc⁻¹ (and for cot⁻¹, some use (−π/2, π/2]); always check the convention a problem states.

**The cotangent trap.** cot⁻¹ x is **not** tan⁻¹(1/x) for negative x. tan⁻¹ returns a negative angle for a negative input, but cot⁻¹ must answer in (0, π), so for x < 0 the angle is in quadrant II. The formula cot⁻¹ x = π/2 − tan⁻¹ x works for every x, including x = 0, where cot⁻¹ 0 = π/2.

**Worked example 1 (exact values).** Evaluate sec⁻¹(2), sec⁻¹(−√2), csc⁻¹(−2), cot⁻¹(√3) and cot⁻¹(−1).

- sec⁻¹(2) = cos⁻¹(1/2) = π/3.
- sec⁻¹(−√2) = cos⁻¹(−1/√2) = cos⁻¹(−√2/2) = 3π/4.
- csc⁻¹(−2) = sin⁻¹(−1/2) = −π/6.
- cot⁻¹(√3) = π/6, since cot(π/6) = (√3/2)/(1/2) = √3.
- cot⁻¹(−1): the answer is in (0, π), and cot(3π/4) = −1, so 3π/4. (tan⁻¹(1/(−1)) = −π/4 is outside the range.)

**Worked example 2 (calculator values).** Evaluate sec⁻¹(−3) and cot⁻¹(−0.5) to three decimal places.

sec⁻¹(−3) = cos⁻¹(−1/3) ≈ 1.911. For cot⁻¹(−0.5), use π/2 − tan⁻¹(−0.5) ≈ 1.5708 + 0.4636 ≈ 2.034. Check: the angle is in quadrant II, as cot⁻¹ of a negative number must be. The tempting tan⁻¹(1/(−0.5)) = tan⁻¹(−2) ≈ −1.107 is the wrong quadrant; adding π gives 2.034 again.

**Worked example 3 (a triangle).** Find the exact value of sin(sec⁻¹(−3)).

Let θ = sec⁻¹(−3), so cos θ = −1/3 with θ in [0, π]: quadrant II. Take x = −1 and r = 3; then y = √(9 − 1) = √8 = 2√2. So sin θ = 2√2/3, positive, as every sine on the top half of the circle is.

## Adding sinusoids (2.11)

To graph y = f(x) + g(x), add the heights of the two graphs at each x. Points where one function is zero are easy: there, the sum equals the other function.

**Worked example 4 (sin x + cos x).** Tabulate y = sin x + cos x at multiples of π/4 and describe the graph.

| x | 0 | π/4 | π/2 | 3π/4 | π | 5π/4 | 3π/2 | 7π/4 | 2π |
|---|---|---|---|---|---|---|---|---|---|
| sin x | 0 | 0.707 | 1 | 0.707 | 0 | −0.707 | −1 | −0.707 | 0 |
| cos x | 1 | 0.707 | 0 | −0.707 | −1 | −0.707 | 0 | 0.707 | 1 |
| sum | 1 | 1.414 | 1 | 0 | −1 | −1.414 | −1 | 0 | 1 |

The sum is itself a sinusoid with period 2π, maximum √2 ≈ 1.414 at x = π/4, and a rising zero at x = −π/4. It is y = √2 sin(x + π/4): amplitude √2, shifted π/4 left. (Unit 3 proves this with the sum formula; for now the table is the evidence.) In general, a sum of a sine and a cosine with the **same period** is one sinusoid with that period.

**Different periods.** y = sin x + sin 2x is periodic but not a sinusoid: the pattern repeats when both pieces repeat together, after the least common multiple of 2π and π, which is 2π. y = sin 2x + cos 3x has periods π and 2π/3, which first line up at 2π.

**A sinusoid plus a line.** y = x + sin x wiggles around the line y = x, staying between y = x − 1 and y = x + 1. It touches y = x + 1 where sin x = 1 and crosses y = x where sin x = 0. It is not periodic, but its oscillation about the line is.

## Damped oscillation (2.11)

Real springs and pendulums lose energy to friction, so each swing is smaller than the last. Multiply a sinusoid by a decaying factor:

y = a e^(−ct) cos ωt, c > 0.

Because −1 ≤ cos ωt ≤ 1, the graph stays between the **envelopes** y = a e^(−ct) and y = −a e^(−ct), touching the upper one where cos ωt = 1 and the lower one where cos ωt = −1. The zeros are still the zeros of cos ωt, so the spacing of the oscillation is unchanged; only the height shrinks.

**Worked example 5.** For y = e^(−0.2t) cos t, find the envelopes, the value at t = 2π, and when the envelope first falls below 0.1.

Envelopes y = ±e^(−0.2t). At t = 2π, cos(2π) = 1, so y = e^(−0.4π) ≈ 0.285: the graph touches the upper envelope, and the peak height has fallen from 1 to about 0.285 in one cycle. The envelope is below 0.1 when e^(−0.2t) < 0.1, that is −0.2t < ln 0.1, so t > 5 ln 10 ≈ 11.51.

**Worked example 6 (hypothetical spring).** A damped spring has displacement d(t) = 8e^(−0.5t) cos(2πt) cm. Find d(1) and d(2), and explain what they show.

d(1) = 8e^(−0.5) cos 2π ≈ 4.85 and d(2) = 8e^(−1) cos 4π ≈ 2.94. Both are points where cos = 1, on the upper envelope, one period apart, so each is e^(−0.5) ≈ 0.607 of the one before: the amplitude shrinks by about 39% per second while the period stays 1 s.

**Beats.** Two tones of 440 Hz and 444 Hz played together add to a sound whose loudness swells and fades 444 − 440 = 4 times per second. The graph of the sum looks like a fast oscillation inside a slowly varying envelope, much like damping, except that the envelope keeps returning. Piano tuners listen for the beats to disappear.

## Common errors

- **cot⁻¹ of a negative number as tan⁻¹(1/x).** That gives a negative angle; cot⁻¹ answers in (0, π).
- **sec⁻¹ x as 1/cos⁻¹ x.** The rewrite is cos⁻¹(1/x): reciprocal of the input, not of the output.
- **Inputs between −1 and 1 for sec⁻¹ and csc⁻¹.** sec⁻¹(0.5) does not exist, since |sec θ| ≥ 1.
- **Adding periods.** sin x + sin 2x has period 2π, not 3π; take the least common multiple.
- **Treating the envelope as the graph.** A damped wave only touches its envelope at peaks and troughs.
- **Thinking damping changes the period.** In a e^(−ct) cos ωt, the zeros are still spaced π/ω apart.

## Where this goes next

Unit 3 proves that a sin x + b cos x = R sin(x + φ) with R = √(a² + b²), which explains example 4 exactly, and its sum-to-product formulas explain beats. The unit summary and exam that close this unit pull weeks 7 to 12 together: every graph, model and inverse function so far.

## Self-check

1. Evaluate sec⁻¹(−2), csc⁻¹(√2) and cot⁻¹(−√3).
2. To three decimal places, find csc⁻¹(4) and cot⁻¹(−2).
3. Find the exact value of tan(csc⁻¹(−5/3)).
4. What is the period of y = sin(4x) + cos(6x)?
5. For y = 5e^(−0.1t) sin t, give the envelopes and the time after which the envelope stays below 1, to two decimal places.

*Answers:* 1. 2π/3, π/4, 5π/6. 2. sin⁻¹(0.25) ≈ 0.253; π/2 − tan⁻¹(−2) ≈ 2.678. 3. Quadrant IV, y = −3, r = 5, x = 4: −3/4. 4. Periods π/2 and π/3; LCM π. 5. y = ±5e^(−0.1t); 5e^(−0.1t) < 1 when t > 10 ln 5 ≈ 16.09.

---

*Original study material written for this course, organised around the Common Core State Standards for Mathematics (HSF-TF.B.5, HSF-TF.B.6). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/).*
