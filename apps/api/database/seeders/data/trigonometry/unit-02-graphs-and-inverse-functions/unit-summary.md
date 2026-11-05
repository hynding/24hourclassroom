# Unit 2 · Graphs and Inverse Functions · The night-before sheet

**Topics:** 2.1 Periodic Functions and the Graphs of Sine and Cosine · 2.2 Amplitude and Period · 2.3 Phase Shift and Vertical Shift · 2.4 Writing Equations of Sinusoids · 2.5 Graphs of Tangent and Cotangent · 2.6 Graphs of Secant and Cosecant · 2.7 Sinusoidal Models · 2.8 Simple Harmonic Motion and Frequency · 2.9 Inverse Sine, Cosine and Tangent · 2.10 Compositions with Inverse Trigonometric Functions · 2.11 Sums of Sinusoids and Damped Oscillation · 2.12 Inverse Cotangent, Secant and Cosecant
**Standards:** HSF-TF.A.2, HSF-TF.A.4, HSF-TF.B.5, HSF-TF.B.6, HSF-TF.B.7
**Weeks:** 7–12. Radians throughout unless a context says otherwise.

## The ideas that generate every question

1. **The graphs come from the unit circle.** sin x is the y-coordinate and cos x the x-coordinate of the point at angle x. One trip round the circle is one period, 2π. Zeros, maxima and minima sit at the quadrantal angles: sin x is 0 at 0, π, 2π and peaks at π/2; cos x peaks at 0 and is 0 at π/2 and 3π/2.
2. **Every sinusoid is a transformed sine or cosine.** In y = a sin(b(x − h)) + k: amplitude |a|, period 2π/|b|, phase shift h (right if positive), midline y = k, range [k − |a|, k + |a|]. A negative a reflects the graph across the midline.
3. **Factor b out before reading the shift.** y = sin(2x − π/3) = sin(2(x − π/6)) shifts right π/6, not π/3.
4. **Five key points per cycle.** Split one period into quarters starting at the shift: midline, max, midline, min, midline for sine; max, midline, min, midline, max for cosine.
5. **Writing an equation needs four numbers.** k = (max + min)/2, |a| = (max − min)/2, b = 2π/period, and the time of a known point: cosine from a maximum, −cosine from a minimum, sine from a rising midline crossing. Many equations are correct; check one by substituting the known point.
6. **Tangent and cotangent have period π; secant and cosecant are guided by cosine and sine.** tan x has asymptotes where cos x = 0; cot x where sin x = 0. sec x = 1/cos x has asymptotes at the zeros of cosine and U-shaped branches touching the cosine graph at its peaks and troughs; csc x does the same with sine.
7. **Models carry units and meaning.** Midline = average level; amplitude = swing above and below it; period = time per cycle; shift = time of a known peak, trough or crossing. In harmonic motion d = a sin ωt or a cos ωt, period 2π/ω and frequency ω/(2π) = 1/P.
8. **"When" questions: one angle from an inverse, the rest from symmetry.** Isolate the trig function, use cos⁻¹ or sin⁻¹ for one angle, find the other in the same cycle, then undo b and h. Test a time between the boundaries to decide "above" or "below".
9. **Inverse functions return one angle in a fixed range.** sin⁻¹: [−π/2, π/2]. cos⁻¹: [0, π]. tan⁻¹: (−π/2, π/2). cot⁻¹: (0, π). sec⁻¹: [0, π] without π/2. csc⁻¹: [−π/2, π/2] without 0.
10. **Function-after-inverse cancels; inverse-after-function cancels only on the range.** sin(sin⁻¹ x) = x on [−1, 1], but sin⁻¹(sin(5π/6)) = π/6. For cos(tan⁻¹ x) and similar, draw a triangle in the right quadrant.
11. **Sums and damping.** Add y-values to graph f + g. A sine plus a cosine of the same period is one sinusoid (sin x + cos x = √2 sin(x + π/4)); different periods repeat at their least common multiple. a e^(−ct) cos ωt oscillates between the envelopes ±a e^(−ct) with unchanged zeros.

## Key formulas and facts

| Want | Use |
|---|---|
| Amplitude, period of a sin(bx) or a cos(bx) | |a|; 2π/|b| |
| Period of tan(bx), cot(bx) | π/|b| |
| Asymptotes of tan(bx) | bx = π/2 + kπ |
| Asymptotes of sec(bx) / csc(bx) | where cos(bx) = 0 / sin(bx) = 0 |
| Midline and amplitude from data | k = (max + min)/2; |a| = (max − min)/2 |
| b from a period P | b = 2π/P (half-period given? double it first) |
| Harmonic motion | d = a sin ωt or a cos ωt; P = 2π/ω; f = ω/(2π) |
| Ranges of sin⁻¹, cos⁻¹, tan⁻¹ | [−π/2, π/2]; [0, π]; (−π/2, π/2) |
| Calculator rewrites | sec⁻¹ x = cos⁻¹(1/x); csc⁻¹ x = sin⁻¹(1/x); cot⁻¹ x = π/2 − tan⁻¹ x |
| tan(sin⁻¹ x), cos(tan⁻¹ x) | x/√(1 − x²); 1/√(1 + x²) |
| cos(sin⁻¹ x), sin(cos⁻¹ x) | √(1 − x²) (both never negative) |
| Damped oscillation | y = a e^(−ct) cos ωt; envelopes ±a e^(−ct); below level L when t > ln(a/L)/c |
| Beats | beat frequency |f₁ − f₂| |

## Classic question types and how to attack them

**"State the features."** Rewrite in the factored form a sin(b(x − h)) + k, then read amplitude, period, shift and midline. For tangent-family graphs, find the asymptotes first.

**"Write an equation for this graph, table or story."** List max, min, period and one key point. Compute k, a, b, then choose the function whose starting point you know. Substitute a second point to check.

**"For how long is it above …?"** Solve the equation for the two boundary times in one cycle, check which interval contains the peak, and subtract.

**"Evaluate the inverse."** Name the range first, then find the one angle in it with the given value. For compositions, evaluate the inner part first unless it is function-after-inverse.

**"Write as an algebraic expression."** Let θ be the inverse value, label a right triangle from its definition (sin θ = x/1, tan θ = x/1), find the third side with Pythagoras, and read off the ratio.

**"Describe the damped graph."** Give the envelopes, the period of the cosine part and where the graph touches each envelope. Solve a e^(−ct) = L with natural logarithms for "when does it fall below".

## Common errors

- Period as 2π·b instead of 2π/b; using 2π for tangent and cotangent.
- Amplitude as max − min, or reported as negative.
- Reading the shift of sin(2x − π/3) as π/3.
- Mistaking a half period (high tide to low tide) for a period.
- Confusing ω with frequency: d = 5 sin(4πt) has frequency 2 Hz, not 4π.
- Inverse answers outside the range: cos⁻¹(−1/2) = 2π/3, never −2π/3 or 4π/3; tan⁻¹(−1) = −π/4, never 3π/4.
- Cancelling sin⁻¹(sin θ) when θ is outside [−π/2, π/2].
- Triangle signs: sin(cos⁻¹(−3/5)) = +4/5 because cos⁻¹ answers on the top half of the circle.
- cot⁻¹ of a negative number computed as tan⁻¹(1/x), giving a negative angle.
- Degree mode on the calculator.

## Calculator or not?

Graph features, exact inverse values, compositions with special values and algebraic expressions are by hand. A calculator (radian mode) is for non-special inverse values, "when" questions in models, and damping times with logarithms. Show the equation you solved, not just the calculator's number.

## Self-test

1. Give the amplitude, period, phase shift and midline of y = 4 sin(3x − π) + 1.
2. A sinusoid has a minimum at (0, −2) and the next maximum at (5, 6). Write an equation.
3. List the asymptotes of y = sec(x/2) on [0, 4π].
4. A hypothetical wheel of radius 15 m, centre 18 m up, turns once every 6 minutes; a rider boards at the bottom. Write h(t) and find when the rider first reaches 25.5 m.
5. Find the period and frequency of d = 2 cos(8πt), t in seconds.
6. Evaluate cos⁻¹(−√2/2), tan⁻¹(−√3) and sin⁻¹(sin(4π/3)).
7. Evaluate sin(tan⁻¹(−3/4)).
8. Write sec(tan⁻¹ x) as an algebraic expression.
9. Evaluate cot⁻¹(−1) and csc⁻¹(2).
10. For y = 4e^(−0.5t) cos(πt), give the envelopes and when the envelope falls below 0.5.

**Answers.**
1. 4 sin(3(x − π/3)) + 1: amplitude 4, period 2π/3, shift right π/3, midline y = 1.
2. k = 2, |a| = 4, period 10 so b = π/5: y = 2 − 4 cos(πx/5).
3. cos(x/2) = 0 at x/2 = π/2, 3π/2: x = π and x = 3π.
4. h(t) = 18 − 15 cos(πt/3). 18 − 15 cos(πt/3) = 25.5 gives cos(πt/3) = −1/2, so πt/3 = 2π/3 and t = 2 minutes.
5. Period 2π/(8π) = 1/4 s; frequency 4 Hz.
6. 3π/4; −π/3; sin(4π/3) = −√3/2, so −π/3.
7. Quadrant IV, x = 4, y = −3, r = 5: −3/5.
8. √(1 + x²).
9. 3π/4; π/6.
10. y = ±4e^(−0.5t); 4e^(−0.5t) < 0.5 when t > 2 ln 8 ≈ 4.16.

---

*Original study material written for this course, organised around the Common Core State Standards for Mathematics (HSF-TF.A.2, HSF-TF.A.4, HSF-TF.B.5, HSF-TF.B.6, HSF-TF.B.7). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/).*
