# Week 16 · Local Linearity and L'Hospital's Rule

**Topics:** 4.6 Approximating Values of a Function Using Local Linearity and Linearization · 4.7 Using L'Hospital's Rule for Determining Limits of Indeterminate Forms
**Practices:** 1 (Implementing Mathematical Processes), 3 (Justification), 2 (Connecting Representations)
**Framework:** AP Calculus AB and BC CED, Unit 4, Topics 4.6–4.7, learning objectives in our own words
**Spiral:** Tangent lines came from week 6 and the derivative rules from weeks 8 to 12; concavity language goes back to Precalculus and returns in full in Unit 5. L'Hospital's Rule finishes a story begun in weeks 2 to 5, where 0/0 and ∞/∞ forms were handled by factoring, conjugates, the Squeeze Theorem and dividing by the highest power. It now handles quotients involving eˣ, ln x and trigonometric functions that algebra cannot.

## What you need to be able to do

- **4.6** Write the local linear approximation L(x) = f(a) + f′(a)(x − a) from a formula, a table or a context.
- **4.6** Use L(x) to estimate a value of f near a, with units in context.
- **4.6** Decide whether a tangent-line estimate is an overestimate or an underestimate from the sign of f″ (concavity), and justify it in words.
- **4.7** Recognise the indeterminate forms 0/0 and ∞/∞ and check them before using L'Hospital's Rule.
- **4.7** Apply L'Hospital's Rule by differentiating numerator and denominator separately, repeating when the form is still indeterminate.
- **4.7** Use given values of f, g, f′ and g′ to evaluate a limit with the rule.

## Key terms

| Term | Meaning |
|---|---|
| Local linearity | Near a point where f is differentiable, its graph is nearly straight. |
| Local linear approximation (linearisation) | L(x) = f(a) + f′(a)(x − a), the tangent line used to estimate f(x) near a. |
| Overestimate / underestimate | The approximation is greater / less than the true value. |
| Concave up / down | f″ > 0 (graph above its tangent lines) / f″ < 0 (graph below its tangent lines). |
| Indeterminate form | 0/0 or ∞/∞: the limit could be any number, or infinite, and must be worked out. |
| L'Hospital's Rule | For 0/0 or ∞/∞, lim f(x)/g(x) = lim f′(x)/g′(x), when the second limit exists or is infinite. |

## Local linearity and linearisation (4.6)

If you zoom in far enough on the graph of a differentiable function at a point, it looks like a straight line: its tangent line. That makes the tangent line an excellent stand-in for the function **near the point of tangency**. Through (a, f(a)) with slope f′(a), it is

L(x) = f(a) + f′(a)(x − a).

To estimate f(b) for b close to a: f(b) ≈ f(a) + f′(a)(b − a). In words, start from the known value and add the rate times the step. This is the same "rate × change in input ≈ change in output" reasoning as the marginal-cost idea of week 13, now made precise.

**Worked example (estimating a square root).** Estimate √4.1 without a calculator.

Choose a = 4, where √x is easy. f(4) = 2 and f′(x) = 1/(2√x), so f′(4) = 1/4. Then

L(x) = 2 + (1/4)(x − 4), so √4.1 ≈ 2 + (1/4)(0.1) = 2.025.

The true value is 2.02485…, so the estimate is a little too big. Why? f″(x) = −(1/4)x^(−3/2) < 0, so √x is concave down, and a concave-down graph bends below its tangent lines. The tangent line sits above the curve: an **overestimate**.

### Over or under: the concavity test

- **f″ > 0 near a (concave up):** the graph lies above its tangent line, so L(x) **underestimates** f(x).
- **f″ < 0 near a (concave down):** the graph lies below its tangent line, so L(x) **overestimates** f(x).

On the AP exam, the justification must mention f″ (or concavity) on an interval containing both a and the estimated input, and the position of the graph relative to the tangent. "Underestimate because f is increasing" earns nothing: being increasing or decreasing does not decide.

**Worked example (a water tank in context).** The volume of water in a hypothetical tank is W(t) litres, t minutes after a drain is opened. W(10) = 420, W′(10) = −15 litres per minute, and W″(t) > 0 for 8 ≤ t ≤ 12.

- Tangent line: L(t) = 420 − 15(t − 10).
- Estimate at t = 10.4: W(10.4) ≈ 420 − 15(0.4) = 414 litres.
- W″ > 0 on an interval containing 10 and 10.4, so W is concave up there and its graph lies above the tangent line. The estimate 414 litres is an **underestimate**: the tank holds a little more than that.
- The approximation is only trustworthy near t = 10. Using it at t = 30 would predict 120 litres, but by then the drain's rate has changed so much that the line says nothing reliable.

**From a table.** With f and f′ given only at some inputs, use the listed input closest to the target. If f(3) = 7, f′(3) = 2, f(5) = 10, f′(5) = −1, then f(5.2) ≈ 10 + (−1)(0.2) = 9.8, using the data at 5 rather than at 3.

**Familiar linearisations near 0:** eˣ ≈ 1 + x, sin x ≈ x, ln(1 + x) ≈ x, (1 + x)ⁿ ≈ 1 + nx. Each is the tangent line at 0 and works for small |x|.

## L'Hospital's Rule (4.7)

Substituting into lim (x→0) (e^(2x) − 1)/sin(3x) gives 0/0. That is not an answer: numerator and denominator are racing to zero, and the limit depends on how fast each one goes. Their speeds are their derivatives, which is the idea behind the rule.

**L'Hospital's Rule.** Suppose f and g are differentiable near a (except perhaps at a) and g′(x) ≠ 0 near a. If

- lim (x→a) f(x) = 0 and lim (x→a) g(x) = 0, or
- lim (x→a) f(x) = ±∞ and lim (x→a) g(x) = ±∞,

then lim (x→a) f(x)/g(x) = lim (x→a) f′(x)/g′(x), provided the limit on the right exists (or is ±∞). The same holds for one-sided limits and for x → ±∞.

Three habits make it work:

1. **Check the form first** and write the check down. If substitution gives 3/0 or 0/5, the rule does not apply (and gives wrong answers if forced).
2. **Differentiate top and bottom separately.** Not the quotient rule.
3. **Re-check after each application.** If the new quotient is still 0/0 or ∞/∞, apply the rule again; otherwise substitute.

**Worked example (0/0).** Find lim (x→0) (e^(2x) − 1)/sin(3x).

As x → 0, e^(2x) − 1 → 0 and sin(3x) → 0: the form is 0/0. By L'Hospital's Rule,

lim (x→0) 2e^(2x)/(3cos(3x)) = 2 · 1/(3 · 1) = 2/3.

**Worked example (∞/∞).** Find lim (x→∞) (ln x)/√x.

Both ln x and √x → ∞: the form is ∞/∞. By L'Hospital's Rule,

lim (x→∞) (1/x)/(1/(2√x)) = lim (x→∞) 2√x/x = lim (x→∞) 2/√x = 0.

So ln x grows more slowly than √x. Repeating the idea shows the growth ladder you will use all year: logarithms ≪ powers ≪ exponentials as x → ∞. For example, lim (x→∞) x³/eˣ needs three applications and ends with 6/eˣ → 0.

**Worked example (from given values).** Functions f and g have continuous derivatives, with f(1) = 0, g(1) = 0, f′(1) = 5 and g′(1) = 2. Find lim (x→1) f(x)/g(x).

Since f and g are differentiable they are continuous, so f(x) → 0 and g(x) → 0: the form is 0/0. By L'Hospital's Rule, the limit is lim f′(x)/g′(x) = f′(1)/g′(1) = 5/2, because f′ and g′ are continuous at 1 and g′(1) ≠ 0.

AP free-response questions often give a table like this and ask for the limit "with justification": the points come from stating that both limits are 0 before naming the rule.

**Repeated use.** lim (x→0) (1 − cos x)/x² is 0/0. One application gives sin x/(2x), still 0/0. A second gives cos x/2 → 1/2. Stop as soon as substitution works.

**When not to use it.** Forms such as 0 · ∞ (for example x·e^(−x) as x → ∞) must first be rewritten as a quotient (x/eˣ). And rational functions are often quicker by algebra: factoring, cancelling, or dividing by the highest power still work.

## Common mistakes

- **Forgetting to justify the over/under claim with concavity.** Name f″'s sign on the interval.
- **Reversing the concavity test.** Concave up gives an underestimate.
- **Using the wrong slope**, such as f′(x) instead of the number f′(a), or a slope from a table entry far from the target.
- **Reporting the change instead of the value:** f(a) + f′(a)Δx, not f′(a)Δx alone.
- **Applying L'Hospital's Rule without an indeterminate form.**
- **Using the quotient rule** instead of differentiating numerator and denominator separately.
- **Calling 0/0 "does not exist".** It means "work needed".

## Self-check

1. Use a tangent line to estimate e^0.05. Is it an overestimate or an underestimate?
2. g(5) = 12, g′(5) = −3 and g″ < 0 near 5. Estimate g(4.8) and say whether it is too big or too small.
3. Find lim (x→0) (sin 4x)/(e^x − 1).
4. Find lim (x→∞) (5x + ln x)/(2x).
5. Why can't L'Hospital's Rule be used on lim (x→0) (x + 1)/sin x?

*Answers:* 1. eˣ ≈ 1 + x gives 1.05; eˣ is concave up, so 1.05 is an underestimate. 2. g(4.8) ≈ 12 + (−3)(−0.2) = 12.6; concave down, so 12.6 is an overestimate. 3. 0/0: 4cos 4x/eˣ → 4. 4. ∞/∞: (5 + 1/x)/2 → 5/2. 5. The form is 1/0, not indeterminate; the one-sided limits are ±∞.

---

*Original study material for this course, organised around the College Board AP Calculus AB and BC Course and Exam Description (Unit 4, Topics 4.6–4.7). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). AP® is a trademark of the College Board, which does not endorse this material.*
