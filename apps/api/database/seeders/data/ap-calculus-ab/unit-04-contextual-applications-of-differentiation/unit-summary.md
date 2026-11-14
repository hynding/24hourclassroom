# Unit 4 · Contextual Applications of Differentiation · The night-before sheet

**AP exam weight:** 10–15% of the exam
**Topics:** 4.1 Interpreting the Meaning of the Derivative in Context · 4.2 Straight-Line Motion: Connecting Position, Velocity, and Acceleration · 4.3 Rates of Change in Applied Contexts Other Than Motion · 4.4 Introduction to Related Rates · 4.5 Solving Related Rates Problems · 4.6 Approximating Values of a Function Using Local Linearity and Linearization · 4.7 Using L'Hospital's Rule for Determining Limits of Indeterminate Forms
**Practices:** 4 (Communication and Notation), 2 (Connecting Representations), 3 (Justification), 1 (Implementing Mathematical Processes)
**Framework:** AP Calculus AB and BC CED, Unit 4, Topics 4.1–4.7, in our own words

## The ideas that generate every question

1. **A derivative is a rate with units (4.1).** f′(a) is how fast f is changing at the single input a, in output units per input unit. f″ is a rate of a rate, with the input unit twice. An interpretation sentence names the input, the quantity, increasing or decreasing, the size, and the units.
2. **Rates, averages and changes are three different things (4.1, 4.3).** f′(a) is a rate at an instant; (f(b) − f(a))/(b − a) is an average rate over an interval; f(b) − f(a) is a total change with no "per". Most interpretation multiple-choice items test exactly this distinction.
3. **Motion is the derivative chain x → v → a (4.2).** Direction comes from the sign of v; speeding up or slowing down comes from comparing the signs of v and a. Total distance needs the turning points; displacement does not.
4. **Every applied rate reads the same way (4.3).** Population, concentration, cost, temperature along a rod: the input need not be time, and the units follow the input. Where an applied rate changes sign, the quantity peaks or bottoms out.
5. **Related rates differentiate a relationship with respect to time (4.4, 4.5).** Write an equation true at every moment, differentiate with the chain rule so each variable brings its rate, then substitute the values at the instant. Geometry supplies the equation: Pythagoras, similar triangles, area and volume formulas, trigonometric ratios.
6. **Near a point, a function is its tangent line (4.6).** L(x) = f(a) + f′(a)(x − a) estimates f(x) for x near a. Concavity decides the direction of the error.
7. **0/0 and ∞/∞ are questions, not answers (4.7).** L'Hospital's Rule replaces f/g by f′/g′ when, and only when, the form is indeterminate.

## Formulas and facts to know cold

| Want | Use |
|---|---|
| Units of f′ / f″ | output per input / output per input per input |
| Velocity, acceleration | v(t) = x′(t), a(t) = v′(t) = x″(t) |
| Speed | \|v(t)\| |
| Speeding up / slowing down | v and a same sign / opposite signs |
| Change of direction | v changes sign (not just v = 0) |
| Displacement on [a, b] | x(b) − x(a) |
| Total distance on [a, b] | split at each turning time, add \|Δx\| over each piece |
| Marginal cost or revenue | C′(q), R′(q) ≈ the change from one more unit |
| Exponential growth rate | P = P₀e^(kt) gives P′ = kP |
| Circle, square, cube | dA/dt = 2πr·dr/dt; dA/dt = 2s·ds/dt; dV/dt = 3s²·ds/dt |
| Sphere | dV/dt = 4πr²·dr/dt |
| Cone | V = (1/3)πr²h; eliminate r with similar triangles first |
| Cylinder, fixed radius R | dV/dt = πR²·dh/dt |
| Right triangle | x² + y² = s² gives x·dx/dt + y·dy/dt = s·ds/dt |
| Angle of elevation | tan θ = opposite/adjacent; sec²θ·dθ/dt = …; radians |
| Linearisation | L(x) = f(a) + f′(a)(x − a) |
| Over / underestimate | f″ < 0 (concave down): over; f″ > 0 (concave up): under |
| L'Hospital's Rule | 0/0 or ∞/∞: lim f/g = lim f′/g′ |
| Growth ladder as x → ∞ | ln x ≪ xᵖ (p > 0) ≪ eˣ |

## Justification sentences that earn the points

- **Interpretation:** "At time t = 5 minutes, the temperature of the tea is decreasing at a rate of 2.4 degrees Celsius per minute."
- **Second derivative:** "At t = 3 days, the rate at which downloads increase is itself decreasing at 2 thousand downloads per day per day."
- **Speeding up:** "v(3) = −12 and a(3) = −6 have the same sign, so the particle is speeding up at t = 3."
- **Direction:** "v(t) changes from positive to negative at t = 2, so the particle changes direction there."
- **Moving left:** "v(t) < 0 for 1 < t < 5, so the particle moves left on that interval."
- **Farthest right:** "The candidates are the endpoints and t = 2, where v changes from positive to negative; x(2) = 42 is the largest."
- **Over/underestimate:** "H″(t) < 0 on 3 ≤ t ≤ 3.5, so H is concave down there and its graph lies below the tangent line; the approximation is an overestimate."
- **L'Hospital's Rule:** "Since lim (x→3) f(x) = 0 and lim (x→3) g(x) = 0, the limit has the form 0/0, so by L'Hospital's Rule it equals lim f′(x)/g′(x) = f′(3)/g′(3)."
- **Related rates answer:** "When the water is 6 cm deep, the level is falling at 1/(2π) ≈ 0.159 cm per second."

## Classic question types and how to attack them

**"Interpret f′(a) in context."** Five ingredients: when, what, direction, how fast, units. Never "increasing at a rate of −3".

**"Which statement describes the average rate / the total change / the instantaneous rate?"** Look for "over the interval" (average or total) versus "at time t" (instantaneous), and check whether the units contain "per".

**"Is the particle speeding up at t = c?"** Compute v(c) and a(c); compare signs; write the sentence.

**"Find the total distance."** Solve v = 0, keep the sign changes inside the interval, evaluate x at endpoints and turning times, add the absolute changes.

**"How fast is … changing when …?"** Draw at a general moment, letters for changing quantities, equation, eliminate (similar triangles), differentiate, substitute, units and sign.

**"Approximate f(b) using the tangent line at a; over or under?"** L(b) = f(a) + f′(a)(b − a); concavity from f″ on the interval between a and b.

**"Find the limit, justifying your method."** Show both limits are 0 (or both infinite), then differentiate top and bottom separately. Repeat if still indeterminate.

## Common mistakes

- Missing or wrong units; a rate with no "per".
- Reading f′(a) as a total change or as the value of f.
- Deciding speeding up from the sign of a alone.
- Calling every zero of v a change of direction.
- Computing total distance as x(b) − x(a).
- Substituting the instant's values before differentiating in related rates.
- Freezing a cone's radius instead of eliminating it with similar triangles.
- Adding perpendicular speeds instead of differentiating x² + y² = s².
- Forgetting sec²θ when differentiating tan θ; giving an angle rate in non-radian units.
- Reversing the concavity test for over/underestimates, or justifying with f′.
- Applying L'Hospital's Rule to a non-indeterminate form, or using the quotient rule instead.

## Calculator or not?

On the exam, expect a calculator for contexts built on messy models (trigonometric or exponential terms): evaluating f′(a) or f″(a) numerically, solving f′(t) = 0, and evaluating values for a tangent-line estimate. Report three decimal places. Related rates, motion with polynomial position functions, interpretations, linearisation from given values, and L'Hospital's Rule are usually done by hand, and the justification sentences always are.

## Self-test

1. R(t) is a reservoir's volume in megalitres, t in days. Interpret R′(30) = −1.2.
2. x(t) = t³ − 6t² + 9t on 0 ≤ t ≤ 4. When is the particle speeding up?
3. A sphere's radius grows at 0.5 cm/s. How fast is its volume growing when r = 3 cm?
4. A cone, vertex down, has height 6 m and top radius 2 m. Water enters at π m³/min. Find dh/dt when h = 3 m.
5. Estimate √25.5 with a tangent line. Over or under?
6. lim (x→0) (sin 3x)/(e^(2x) − 1)?

**Answers.** 1. At t = 30 days, the volume is decreasing at 1.2 megalitres per day. 2. v = 3(t − 1)(t − 3), a = 6(t − 2): speeding up on 1 < t < 2 and 3 < t < 4. 3. 4π(9)(0.5) = 18π cm³/s. 4. r = h/3, V = πh³/27, dV/dt = (π/9)h²·dh/dt: π = π·dh/dt, so dh/dt = 1 m/min. 5. 5 + (1/10)(0.5) = 5.05; √x is concave down, so an overestimate. 6. 0/0: 3cos 3x/(2e^(2x)) → 3/2.

---

*Original study material for this course, organised around the College Board AP Calculus AB and BC Course and Exam Description (Unit 4, Topics 4.1–4.7). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). AP® is a trademark of the College Board, which does not endorse this material.*
