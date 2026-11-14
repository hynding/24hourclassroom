# Unit 2 · Differentiation: Definition and Fundamental Properties · The night-before sheet

**AP exam weight:** 10–15% of the exam
**Topics:** 2.1 Defining Average and Instantaneous Rates of Change at a Point · 2.2 Defining the Derivative of a Function and Using Derivative Notation · 2.3 Estimating Derivatives of a Function at a Point · 2.4 Connecting Differentiability and Continuity · 2.5 Applying the Power Rule · 2.6 Derivative Rules: Constant, Sum, Difference, and Constant Multiple · 2.7 Derivatives of cos x, sin x, eˣ, and ln x · 2.8 The Product Rule · 2.9 The Quotient Rule · 2.10 Derivatives of Tangent, Cotangent, Secant, and Cosecant
**Practices:** 1 (Implementing Mathematical Processes), 2 (Connecting Representations), 3 (Justification), 4 (Communication and Notation)
**Framework:** AP Calculus AB and BC CED, Unit 2, Topics 2.1–2.10, in our own words

## The ideas that generate every question

1. **An average rate needs two points; an instantaneous rate needs a limit (2.1).** The average rate of change on [a, b] is (f(b) − f(a))/(b − a), a secant slope with units of output per input. Shrink the interval around one input and the average rates approach the instantaneous rate, the slope of the tangent line.
2. **The derivative is the limit of a difference quotient (2.2).** f′(a) = lim (h→0) (f(a + h) − f(a))/h = lim (x→a) (f(x) − f(a))/(x − a). Every such limit begins as 0/0; algebra (expand, combine fractions, multiply by a conjugate) removes the factor h. A given limit can be read backwards as a derivative: name f and a, check that the subtracted constant is f(a), and evaluate f′(a).
3. **Without a formula, estimate (2.3).** From a table, use the closest data on either side; from a graph, the slope of the tangent line; from a formula, a symmetric difference quotient or the calculator's numerical derivative. Always divide by the actual change in input.
4. **Differentiable implies continuous, not the reverse (2.4).** A discontinuity rules out a derivative. A continuous function can still fail to be differentiable at a corner, a cusp or a vertical tangent. For a piecewise function, check continuity first, then compare one-sided derivatives.
5. **Rules replace limits (2.5–2.10).** The power, constant, sum, difference and constant multiple rules, the six trig derivatives, eˣ and ln x, and the product and quotient rules let you differentiate any combination of basic functions except compositions (Unit 3).

## Key formulas

| Want | Use |
|---|---|
| Average rate on [a, b] | (f(b) − f(a))/(b − a) |
| Derivative at a (h-form) | lim (h→0) (f(a + h) − f(a))/h |
| Derivative at a (x-form) | lim (x→a) (f(x) − f(a))/(x − a) |
| Symmetric estimate | (f(a + h) − f(a − h))/(2h) |
| Tangent line at x = a | y = f(a) + f′(a)(x − a) |
| Power rule | d/dx [xⁿ] = nxⁿ⁻¹, any real constant n |
| Constant, multiple, sum | d/dx [c] = 0; d/dx [kf] = kf′; d/dx [f ± g] = f′ ± g′ |
| sin, cos | d/dx [sin x] = cos x; d/dx [cos x] = −sin x |
| eˣ, ln x | d/dx [eˣ] = eˣ; d/dx [ln x] = 1/x (x > 0) |
| Product rule | (fg)′ = f′g + fg′ |
| Quotient rule | (f/g)′ = (f′g − fg′)/g² |
| tan, cot | d/dx [tan x] = sec² x; d/dx [cot x] = −csc² x |
| sec, csc | d/dx [sec x] = sec x tan x; d/dx [csc x] = −csc x cot x |

Useful limits recognised as derivatives: lim (h→0) (eʰ − 1)/h = 1 (eˣ at 0), lim (h→0) sin h/h = 1 (sin x at 0), lim (x→1) ln x/(x − 1) = 1 (ln x at 1).

## Sentences that earn the points

- **Interpreting a derivative:** "At t = 5 minutes, the volume of water is decreasing at 6.5 litres per minute." Name the time, the quantity, increasing or decreasing, and the rate with units.
- **Interpreting an average rate:** "Over the first 12 minutes, the volume decreased at an average rate of about 5.83 litres per minute."
- **Estimating from a table:** show the quotient, for example "W′(5) ≈ (255 − 268)/(6 − 4) = −6.5", not just the number.
- **Not differentiable at a corner:** "f is continuous at x = 2, but lim (h→0⁻) of the difference quotient is 3 and lim (h→0⁺) is 4; the one-sided derivatives differ, so f′(2) does not exist."
- **Not differentiable at a discontinuity:** "f is not continuous at x = 1, so f is not differentiable at x = 1."
- **Differentiable piecewise function:** "Both pieces give 3 at x = 1, so g is continuous; both one-sided derivatives equal 2, so g′(1) = 2 exists." Both halves are required.
- **Product or quotient in context:** write the rule with the function names first (R′ = N′P + NP′), then substitute, then interpret.

## Classic question types and how to attack them

**"Which limit equals f′(3)?"** Look for f(3 + h) − f(3) over h, or f(x) − f(3) over x − 3. Reject a wrong subtracted constant or a wrong denominator.

**"Evaluate lim (h→0) ((2 + h)⁵ − 32)/h."** Recognise f′(2) for x⁵, then use the power rule: 5 · 2⁴ = 80.

**"Use the definition to find f′(x)."** Write the full difference quotient, simplify until h cancels, then take the limit. Using a rule earns nothing here.

**"Estimate f′(4) from the table."** Bracket 4 with the nearest inputs; divide by their actual distance; include units.

**"Where is f not differentiable?"** List discontinuities, then corners (absolute values whose insides change sign, piecewise joins with different slopes), cusps and vertical tangents (fractional powers with even numerators or odd roots at their zero).

**"Find a and b so that f is differentiable."** Two equations: values match and slopes match.

**"Use the table to find (fg)′(2) or (f/g)′(1)."** Write the rule, substitute four numbers, square the denominator.

## Common mistakes

- Dividing a function value instead of a change: f(2)/2 is not an average rate.
- Subtracting the input instead of f(a) in a difference quotient.
- Using the formula f′(x) in a tangent line instead of the number f′(a).
- Calling a continuous function differentiable without checking one-sided slopes; trusting nDeriv at a corner.
- Checking only matching slopes for a piecewise function (continuity first).
- Forgetting to rewrite roots and reciprocals before the power rule; lowering a negative exponent the wrong way.
- Differentiating π² or e³ as if it were a power of x.
- Applying the power rule to eˣ.
- d/dx [cos x] = sin x (sign error); mixing up the derivatives of tan x and sec x.
- (fg)′ = f′g′ and (f/g)′ = f′/g′; reversing the quotient-rule numerator; not squaring the denominator.
- Applying the power rule to (2x)³ or (x² + 1)² as if the inside were x: expand first, or wait for the chain rule in Unit 3.

## Calculator or not?

Most of this unit is done by hand: definitions, rules, tangent lines and differentiability arguments are no-calculator skills. Use a calculator for a numerical derivative of a function you cannot yet differentiate (such as xˣ or 2ˣ), for messy decimal values, and for solving an equation like M′(t) = 0.699 in a context. Report three decimal places, and remember the numerical derivative can report a number where no derivative exists.

## Self-test

1. Find the average rate of change of f(x) = √x on [4, 9].
2. Use the definition to find f′(x) for f(x) = 3x² + 2.
3. Evaluate lim (x→π) (cos x + 1)/(x − π).
4. Is f(x) = |x² − 9| differentiable at x = 3? At x = 0?
5. Differentiate y = 5x⁴ − 6/x + 2√x − e².
6. Differentiate y = x² cos x and y = sin x/(1 + x).
7. Find the tangent line to y = tan x + sec x at x = 0.
8. f(1) = 2, f′(1) = −3, g(1) = 4, g′(1) = 1. Find (fg)′(1) and (f/g)′(1).

**Answers.** 1. (3 − 2)/5 = 1/5. 2. The quotient simplifies to 6x + 3h, so f′(x) = 6x. 3. It is the derivative of cos x at π, which is −sin π = 0. 4. Not at x = 3 (a corner, one-sided slopes −6 and 6); yes at x = 0. 5. 20x³ + 6/x² + 1/√x. 6. 2x cos x − x² sin x; ((1 + x) cos x − sin x)/(1 + x)². 7. y(0) = 1, slope sec² 0 + sec 0 tan 0 = 1: y = 1 + x. 8. (fg)′(1) = (−3)(4) + (2)(1) = −10; (f/g)′(1) = ((−3)(4) − (2)(1))/16 = −14/16 = −7/8.

---

*Original study material for this course, organised around the College Board AP Calculus AB and BC Course and Exam Description (Unit 2, Topics 2.1–2.10). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). AP® is a trademark of the College Board, which does not endorse this material.*
