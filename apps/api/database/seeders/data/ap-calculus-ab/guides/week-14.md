# Week 14 · Rates of Change in Applied Contexts and Introduction to Related Rates

**Topics:** 4.3 Rates of Change in Applied Contexts Other Than Motion · 4.4 Introduction to Related Rates
**Practices:** 2 (Connecting Representations), 4 (Communication and Notation), 1 (Implementing Mathematical Processes)
**Framework:** AP Calculus AB and BC CED, Unit 4, Topics 4.3–4.4, learning objectives in our own words
**Spiral:** Week 13 taught you to read a derivative as a rate with units, and to use the signs of v and a in motion. This week the same reading works for populations, medicines, prices and temperatures. Related rates lean on two Unit 3 tools: the chain rule (week 10), which supplies every dx/dt, and implicit differentiation (week 11), which differentiates an equation term by term.

## What you need to be able to do

- **4.3** Interpret a derivative as a rate of change in any applied context, with units, including contexts where the input is not time.
- **4.3** Use the sign of a rate, and where it changes, to say when an applied quantity is increasing, decreasing, largest or smallest.
- **4.3** Distinguish a rate from the quantity itself and from an average rate in biology, medicine, economics and physical science.
- **4.4** Recognise when several quantities that change with time are linked by an equation.
- **4.4** Differentiate such an equation with respect to t, using the chain rule so that each variable brings its own rate (dx/dt, dr/dt, …).
- **4.4** Substitute the values at the given instant only after differentiating, and solve for the unknown rate with units.

## Key terms

| Term | Meaning |
|---|---|
| Applied rate | A derivative that measures how fast one real quantity changes per unit of another. |
| Marginal cost / revenue | C′(q) or R′(q): approximately the change in cost or revenue from one more unit. |
| Proportional growth | P′(t) = kP(t): the rate is a fixed multiple of the amount (exponential models). |
| Related rates | Rates of change of quantities that are linked by an equation, all changing with time. |
| Implicit differentiation with respect to t | Differentiating every term of an equation with respect to t, attaching d(variable)/dt to each. |
| Given instant | The single moment at which values are known; values are substituted only at the end. |

## Rates in applied contexts (4.3)

Nothing about the derivative is special to motion. Whenever a quantity y depends on an input x, dy/dx tells you how fast y changes per unit of x at a particular x. The interpretation sentence is the same as week 13's: when (or where), what, increasing or decreasing, how fast, units.

The **input need not be time.** If T(x) is the temperature at a point x centimetres along a heated rod, then T′(15) = −2 means that near 15 cm, the temperature falls about 2 °C for each additional centimetre along the rod. No clock is involved: the units are °C per centimetre. A common error is to slip "per minute" into such a sentence out of habit.

**Worked example (a bacteria culture).** A hypothetical culture holds P(t) = 500e^(0.2t) cells, t hours after it is started.

P′(t) = 500 · 0.2 · e^(0.2t) = 100e^(0.2t) cells per hour (chain rule). Then

- P′(0) = 100: at the start, the culture grows at 100 cells per hour.
- P′(5) = 100e ≈ 271.8: *at t = 5 hours, the number of cells is increasing at about 271.8 cells per hour.*
- P(5) = 500e ≈ 1359.1 cells. Notice P′(5) = 0.2 · P(5): for every exponential model P₀e^(kt), the rate of growth is k times the current amount. That is what "grows at 20% per hour, continuously" means.

**Worked example (a drug concentration).** In a hypothetical model, the concentration of a drug in the blood is C(t) = 12t/(t² + 4) milligrams per litre, t hours after an injection.

Quotient rule:

C′(t) = [(t² + 4)(12) − 12t(2t)]/(t² + 4)² = 12(4 − t²)/(t² + 4)².

- C′(1) = 12 · 3/25 = 1.44. *At t = 1 hour, the concentration is increasing at 1.44 mg/L per hour.* (The concentration itself is C(1) = 12/5 = 2.4 mg/L. Do not confuse the two.)
- C′(t) = 0 when t = 2 (t = −2 is outside the context). For 0 < t < 2, 4 − t² > 0 so C′ > 0; for t > 2, C′ < 0. The concentration rises, peaks at t = 2 hours with C(2) = 24/8 = 3 mg/L, then falls.
- C′(3) = 12(−5)/169 ≈ −0.355: at t = 3 hours the concentration is decreasing at about 0.355 mg/L per hour.

The units of C′ look odd ("milligrams per litre per hour") but follow the rule exactly: units of C over units of t.

**Economics.** If R(q) is revenue in dollars from selling q items, R′(q) is the marginal revenue in dollars per item; R′(100) estimates the extra revenue from item 101. Marginal cost works the same way.

**Where a rate changes sign.** If an applied rate changes from positive to negative at some input, the quantity has a peak there (largest concentration, longest queue, deepest snow). Changing from negative to positive gives a low point. Unit 5 builds this into the First Derivative Test; for now, read it straight from the sign of the rate.

## Introduction to related rates (4.4)

In many situations, several quantities change together and an equation ties them. When a circular ripple spreads, both its radius r and area A grow, and A = πr² at every moment. Differentiating that equation **with respect to time** links the rates:

dA/dt = 2πr · dr/dt.

The factor dr/dt is the chain rule at work: A depends on r, and r depends on t. This is exactly implicit differentiation from week 11, with t in place of x. Every variable that changes brings its own rate along: d/dt [x²] = 2x · dx/dt, d/dt [xy] = x · dy/dt + y · dx/dt, d/dt [sin θ] = cos θ · dθ/dt.

**The order of operations matters.** The numbers you are given (r = 10, say) are true only at one instant. If you substitute r = 10 into A = πr² before differentiating, you get A = 100π, a constant, whose derivative is 0, and the problem collapses. So:

1. Name the variables and write down the known rate(s) and the wanted rate, with signs (a draining volume has dV/dt < 0).
2. Write an equation relating the variables that holds at **every** moment.
3. Differentiate both sides with respect to t.
4. Only now substitute the values at the instant, and solve for the unknown rate. State units.

**Worked example (a spreading ripple).** A stone dropped in a still pond makes a circular ripple whose radius grows at 3 cm per second. How fast is the area inside the ripple growing when the radius is 10 cm?

- Known: dr/dt = 3 cm/s. Wanted: dA/dt when r = 10.
- Equation: A = πr².
- Differentiate: dA/dt = 2πr · dr/dt.
- Substitute: dA/dt = 2π(10)(3) = 60π ≈ 188.5 cm² per second.

Note that dA/dt depends on r: the same 3 cm/s of radius adds more area when the circle is bigger, because the edge is longer.

**Worked example (inflating a balloon).** Air is pumped into a spherical balloon at 100 cm³ per second. How fast is the radius increasing when the radius is 5 cm?

- Known: dV/dt = 100 cm³/s. Wanted: dr/dt when r = 5.
- Equation: V = (4/3)πr³.
- Differentiate: dV/dt = 4πr² · dr/dt.
- Substitute: 100 = 4π(25) · dr/dt, so dr/dt = 100/(100π) = 1/π ≈ 0.318 cm per second.

The radius grows more slowly as the balloon gets bigger, because each cubic centimetre is spread over a larger surface (4πr² is the surface area).

**Two-variable relations.** Sometimes the equation links two coordinates. If a point moves on the circle x² + y² = 25 and dx/dt = 3 when the point is at (3, 4), then 2x · dx/dt + 2y · dy/dt = 0 gives dy/dt = −(x/y) · dx/dt = −(3/4)(3) = −9/4. The negative sign means y is decreasing at that moment, which fits: moving right along the upper half of the circle carries the point downward.

**Products of changing quantities.** For a cone V = (1/3)πr²h with both r and h changing, use the product rule: dV/dt = (1/3)π(2rh · dr/dt + r² · dh/dt). If one dimension is fixed (a cylinder of fixed radius R), it is a constant: V = πR²h gives dV/dt = πR² · dh/dt. Next week shows how a similar-triangles relation such as r = h/2 removes one variable before you differentiate.

## Common mistakes

- **Putting time units on a non-time rate.** If the input is centimetres, the rate is per centimetre.
- **Confusing the rate with the amount.** C′(1) = 1.44 mg/L per hour is not the concentration.
- **Substituting before differentiating.** Values given "at the instant" go in at step 4, never earlier.
- **Dropping the chain-rule factor.** d/dt [r³] = 3r² · dr/dt, not 3r².
- **Ignoring signs.** A quantity that is decreasing has a negative rate; put the negative sign into the equation.
- **Forgetting the product rule** when two changing quantities are multiplied.
- **Missing units** on the final rate, or using the units of the quantity instead of its rate.

## Self-check

1. A hypothetical company's profit is P(q) dollars when it sells q items. Interpret P′(200) = 4.5 with units.
2. For C(t) = 12t/(t² + 4) mg/L, is the concentration increasing or decreasing at t = 4 hours? How fast?
3. A cube's edge grows at 0.2 cm/s. How fast is its volume growing when the edge is 5 cm?
4. Explain why the cylinder relation dV/dt = πR² · dh/dt has no h in it.
5. The area of a circle is decreasing at 8π cm² per minute. How fast is the radius changing when r = 2 cm?

*Answers:* 1. When 200 items have been sold, profit is increasing at $4.50 per item, so the 201st item adds about $4.50. 2. C′(4) = 12(4 − 16)/400 = −0.36: decreasing at 0.36 mg/L per hour. 3. dV/dt = 3s² · ds/dt = 3(25)(0.2) = 15 cm³ per second. 4. R is constant, so V is a constant times h, and its derivative is that constant times dh/dt. 5. −8π = 2π(2) · dr/dt, so dr/dt = −2 cm per minute: the radius is shrinking at 2 cm per minute.

---

*Original study material for this course, organised around the College Board AP Calculus AB and BC Course and Exam Description (Unit 4, Topics 4.3–4.4). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). AP® is a trademark of the College Board, which does not endorse this material.*
