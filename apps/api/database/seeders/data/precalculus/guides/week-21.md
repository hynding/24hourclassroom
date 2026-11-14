# Week 21 · Sinusoidal Transformations and Models

**Topics:** 3.6 Sinusoidal Function Transformations · 3.7 Sinusoidal Function Context and Data Modeling
**Practices:** 1 (procedural and symbolic fluency), 2 (multiple representations), 3 (communication and reasoning)
**Framework:** AP Precalculus CED, Unit 3, Topics 3.6–3.7, learning objectives in our own words
**Spiral:** Week 20 named the amplitude, period and midline of f(θ) = a sin(b(θ + c)) + d. This week treats each parameter as one of week 8's transformations (vertical and horizontal dilations and translations) and then uses the form to model periodic data. The modelling habits are the same as in weeks 9, 12 and 17: choose a function type that matches the data's behaviour, find parameters from key features, check against the data, interpret parameters with units, and state limitations.

## What you need to be able to do

- **3.6** Describe the effect of each parameter in g(θ) = a sin(b(θ + c)) + d (or with cos) on the graph of sin θ: a is a vertical dilation (with a reflection if a < 0), d is a vertical translation, b is a horizontal dilation by a factor of 1/|b| (with a reflection if b < 0), and c is a horizontal translation of c units to the left.
- **3.6** Rewrite a sinusoid such as sin(bθ + k) as sin(b(θ + k/b)) to read its horizontal shift correctly.
- **3.7** Build a sinusoidal model from a description or data: midline from the average of maximum and minimum, amplitude from half their difference, period from the time between repeated features, and a horizontal shift from where a maximum, minimum or rising midline crossing occurs.
- **3.7** Interpret the parameters of a model in context, with units, and use the model to estimate values, including with a calculator.
- **3.7** Describe what sinusoidal regression does, and recognise when a piecewise sinusoidal model fits data better than a single sinusoid.

## Key terms

| Term | Meaning |
|---|---|
| Vertical dilation | Multiplying the output by a: heights from the midline are scaled by |a|. |
| Vertical translation | Adding d to the output: the whole graph, including the midline, moves up d. |
| Horizontal dilation | Replacing θ with bθ: the graph is scaled horizontally by 1/|b|, so the period becomes 2π/|b|. |
| Horizontal translation (phase shift) | Replacing θ with θ + c: the graph moves c units left (right if c < 0). |
| Sinusoidal regression | A calculator procedure that finds a, b, c and d for the sinusoid that best fits a set of data points. |
| Piecewise sinusoidal model | A model built from different sinusoidal pieces on different intervals, for example when a quantity rises and falls over unequal times. |

## The four parameters as transformations (3.6)

Start with y = sin θ and change one thing at a time.

| Change | Example | Effect on the graph |
|---|---|---|
| a | y = 3 sin θ | Vertical dilation by 3: range [−3, 3], amplitude 3. |
| a < 0 | y = −3 sin θ | Same, plus a reflection across the midline: it starts going down. |
| d | y = sin θ + 2 | Up 2: midline y = 2, range [1, 3]. |
| b | y = sin(2θ) | Horizontal dilation by 1/2: period π, twice as many cycles. |
| b | y = sin(θ/4) | Horizontal dilation by 4: period 8π. |
| c | y = sin(θ − π/3) | Right π/3: the rising midline crossing moves from 0 to π/3. |

Amplitude and midline do not interact with period and shift: the vertical parameters a and d act on outputs, the horizontal parameters b and c act on inputs.

**Reading the shift needs care.** In a sin(b(θ + c)) + d the shift is c to the left, because the "starting point" where b(θ + c) = 0 is θ = −c. If the inside is written bθ + k instead, factor out b first:

sin(3θ + π) = sin(3(θ + π/3)), a shift of π/3 to the left, not π.

The same rule explains why order matters. To get from sin θ to sin(2(θ − π/4)), compress by 1/2 and shift right π/4. To get the same graph by shifting first, you would shift right π/2 and then compress, because compressing also pulls the shifted points towards the y-axis. Writing the function in factored form avoids the trap.

**Worked example.** Describe how the graph of f(θ) = 3 sin(2(θ − π/4)) + 1 is obtained from y = sin θ, and find its first maximum to the right of θ = π/4.

Vertical dilation by 3 and translation up 1 (midline y = 1, range [−2, 4]); horizontal dilation by 1/2 (period π) and translation π/4 to the right. Sine reaches its maximum when its input is π/2: 2(θ − π/4) = π/2 gives θ = π/2. The point is (π/2, 4).

**Worked example.** Find the horizontal shift and period of y = 5 cos(4θ − π) − 2.

Factor: 4θ − π = 4(θ − π/4). Period 2π/4 = π/2, shift π/4 to the right. Amplitude 5 and midline y = −2.

**Worked example.** Show that sin(2(θ − π)) has the same graph as sin(2θ).

The period of sin(2θ) is π, so a shift of π is a whole period, which leaves the graph unchanged. Algebraically, sin(2θ − 2π) = sin(2θ) because sine has period 2π.

**Try it.**
1. Describe the graph of y = −2 cos(θ/3) + 4 as transformations of y = cos θ.
2. What are the shift and period of y = sin(πθ/6 + π/2)?
3. Write a function whose graph is y = sin θ dilated vertically by 3, then translated down 4.

*Answers:* 1. Vertical dilation by 2 with a reflection across the midline, up 4 (range [2, 6]); horizontal dilation by 3 (period 6π). 2. πθ/6 + π/2 = (π/6)(θ + 3): shift 3 left, period 2π/(π/6) = 12. 3. y = 3 sin θ − 4.

## Building a model from features (3.7)

Most modelling questions give you a maximum, a minimum and some timing. The recipe:

1. **Midline:** d = (max + min)/2.
2. **Amplitude:** |a| = (max − min)/2.
3. **Period:** the time between consecutive maxima (or minima), or twice the time from a maximum to the next minimum. Then b = 2π/period.
4. **Starting function and shift:** pick cos if you know when a maximum occurs, −cos for a minimum, and sin for a rising midline crossing. The shift is the time of that feature.

**Worked example (a Ferris wheel).** A hypothetical Ferris wheel has diameter 40 m, its centre is 22 m above the ground, and it turns once every 8 minutes. A rider boards at the lowest point at t = 0. Write the rider's height h(t), in metres, t minutes after boarding.

Midline 22 m, amplitude 20 m, so the heights run from 2 m to 42 m. Period 8 min gives b = 2π/8 = π/4. The rider starts at a minimum, so use −cos with no shift:

h(t) = 22 − 20 cos(πt/4).

Check: h(0) = 2, h(4) = 22 + 20 = 42 (top, half a turn later), h(2) = 22 (level with the centre). At t = 4/3 minutes the wheel has turned π/3, and h(4/3) = 22 − 20 · (1/2) = 12 m.

**Worked example (a tide).** At a hypothetical harbour, high water of 4.6 m occurs at 2:00 a.m. and the next low water, 0.6 m, at 8:12 a.m. Model the depth H(t), in metres, t hours after midnight.

Midline (4.6 + 0.6)/2 = 2.6 m; amplitude 2.0 m. High to low took 6.2 hours, half a period, so the period is 12.4 hours and b = 2π/12.4 ≈ 0.507. A maximum at t = 2 suits cosine shifted right 2:

H(t) = 2.6 + 2 cos((2π/12.4)(t − 2)).

Interpretation: 2.6 m is the average depth over a cycle; 2.0 m is how far the water rises above and falls below that level; 12.4 hours is the time from one high water to the next.

**Worked example (daylight).** In a hypothetical northern city the number of hours of daylight has a maximum of 15.2 hours on day 172 of the year and a minimum of 9.0 hours about half a year later. Model it with a period of 365 days.

Midline 12.1 h; amplitude 3.1 h; b = 2π/365. A maximum at day 172: D(t) = 12.1 + 3.1 cos((2π/365)(t − 172)). An equivalent sine form shifts the rising midline crossing a quarter period, about 91 days, earlier: D(t) ≈ 12.1 + 3.1 sin((2π/365)(t − 81)).

**Try it.**
1. A hypothetical spring holds a weight that bobs between 12 cm and 30 cm above a table, reaching 30 cm first at t = 0.5 s and 30 cm again at t = 2.5 s. Write a model for the height.
2. In the tide model, find the first time after 2:00 a.m. that the depth is at its midline, and say whether it is rising or falling.

*Answers:* 1. y = 21 + 9 cos(π(t − 0.5)) (period 2 s, b = π). 2. A quarter period after the high: 2 + 3.1 = 5.1 hours, at about 5:06 a.m., falling.

## Regression and the limits of a model (3.7)

When you have many data points rather than a clean max and min, a graphing calculator's **sinusoidal regression** finds the sinusoid of best fit. It reports a model in the form y = a sin(bx + c) + d. To interpret it:

- d is the midline: the average of the quantity over a cycle;
- |a| is the amplitude: the typical swing above and below that average;
- 2π/|b| is the period, which should match what you know about the context (24 hours, 365 days, 12.4 hours…);
- −c/b is the horizontal shift of the rising midline crossing.

A calculator typically needs a full cycle of data (preferably more) and may need a guess of the period to give a sensible result. Check the residuals as in week 12: if they show a pattern, the model is missing something.

**Piecewise sinusoidal models.** A single sinusoid always spends equal time rising and falling. Real periodic data sometimes does not: a hypothetical tide might take 5 hours to rise and 7 hours to fall, or a greenhouse might warm quickly after sunrise and cool slowly overnight. Then a better model uses one sinusoidal piece for the rise and another for the fall, each with its own half-period, matched at the maximum and minimum so the graph has no jumps.

**Worked example.** A hypothetical tide rises from 1 m at t = 0 to 5 m at t = 5 hours, then falls to 1 m at t = 12. Build a piecewise model.

Both pieces have midline 3 and amplitude 2. Rising piece: a minimum at 0 and a maximum at 5 is half a period, so the period is 10 and b = π/5: H(t) = 3 − 2 cos(πt/5) for 0 ≤ t ≤ 5. Falling piece: from a maximum at 5 to a minimum at 12 is half a period of 14, b = π/7: H(t) = 3 + 2 cos(π(t − 5)/7) for 5 ≤ t ≤ 12. Both pieces equal 5 at t = 5, so the model is continuous.

**Limitations to mention.** Models assume the pattern repeats exactly. Real tides vary with the Moon's phase, daylight depends on latitude, and a Ferris wheel stops to load passengers. A model is a description over a stated domain, not a law.

## Calculator notes

For a model given with decimals, evaluate in radian mode, for example D(120) for the daylight model. For regression, enter the times and values as lists and choose the sinusoidal option; write the result with the parameters rounded sensibly and say what each means. AP expects you to set up simple models by hand from max, min and timing information.

## Common mistakes

- **Reading the shift from bθ + k as k.** Factor first: sin(4θ − π) = sin(4(θ − π/4)) shifts π/4 right.
- **Using the period as b.** A period of 8 minutes gives b = 2π/8 = π/4, not 8.
- **Taking the maximum as the amplitude.** The amplitude is half the distance from max to min, measured from the midline.
- **Treating max to min as a full period.** It is half a period.
- **Ignoring units.** A Ferris-wheel b has units of radians per minute; the midline is a height in metres.
- **Forcing a single sinusoid on lopsided data.** If rising and falling take different times, a single sinusoid cannot match both.

## Where this goes next

Week 22 studies the tangent function, whose graph has asymptotes and period π, and defines the inverse trigonometric functions that undo sine, cosine and tangent on restricted domains. Week 23 uses those inverses to answer modelling questions such as "for how long each revolution is the rider above 32 m?", by solving equations like 22 − 20 cos(πt/4) = 32.

## Self-check

1. Describe the graph of y = 4 sin(3(θ + π/6)) − 2 as transformations of y = sin θ, and state its range.
2. Find the shift and period of y = cos(2θ + π/2).
3. A hypothetical buoy rises and falls between 0.4 m and 2.2 m above the sea floor's marker, peaking every 6 seconds, first at t = 1. Write a model.
4. A sinusoidal regression on hypothetical monthly temperatures gives T(m) = 11.8 sin(0.524m − 2.15) + 14.3. Interpret 11.8, 14.3 and the period.
5. Explain why a quantity that takes 9 hours to rise and 3 hours to fall is better modelled piecewise.

---

*Original study material for this course, organised around the College Board AP Precalculus Course and Exam Description (Unit 3, Topics 3.6–3.7). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). AP® is a trademark of the College Board, which does not endorse this material.*
