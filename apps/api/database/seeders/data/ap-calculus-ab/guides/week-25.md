# Week 25 · Antiderivatives and Integration by Substitution

**Topics:** 6.8 Finding Antiderivatives and Indefinite Integrals: Basic Rules and Notation · 6.9 Integrating Using Substitution
**Practices:** 1 (Implementing Mathematical Processes), 2 (Connecting Representations), 3 (Justification), 4 (Communication and Notation)
**Framework:** AP Calculus AB and BC CED, Unit 6, Topics 6.8–6.9, learning objectives in our own words
**Spiral:** Week 24's second Fundamental Theorem turned every definite integral into a search for an antiderivative. This week builds the toolkit for that search. Each rule is a derivative rule from weeks 8–12 read backwards; substitution is the chain rule (week 10) read backwards. Initial conditions preview the particular solutions of Unit 7.

## What you need to be able to do

- **6.8** Use indefinite integral notation ∫ f(x) dx = F(x) + C and explain the constant of integration.
- **6.8** Find antiderivatives of powers (after rewriting roots and quotients), 1/x, eˣ and aˣ, sine, cosine and the other trigonometric derivative patterns, and the inverse trigonometric patterns.
- **6.8** Use an initial condition to find a particular antiderivative.
- **6.9** Recognise a composite integrand with its inner derivative present, choose u, adjust constant factors, and integrate.
- **6.9** Use substitution in a definite integral by changing the limits to u-values, and use back-substitution when an x is left over.

## Key terms

| Term | Meaning |
|---|---|
| Antiderivative | A function F with F′ = f on an interval. |
| Indefinite integral | ∫ f(x) dx, the family F(x) + C of all antiderivatives of f. |
| Constant of integration | The C in F(x) + C; any constant has derivative 0. |
| Initial condition | A known value such as f(1) = 3 that fixes C. |
| Particular antiderivative | The single antiderivative that meets an initial condition. |
| u-substitution | Renaming an inner function u = g(x), with du = g′(x) dx, to simplify an integral. |
| Back-substitution | Solving u = g(x) for x to replace a leftover x. |

## Antiderivatives and the indefinite integral (6.8)

An **antiderivative** of f is any F with F′ = f. If F is one, then so is F + 5 or F − π, because constants differentiate to zero. On an interval, those are the only ones: two antiderivatives of the same function differ by a constant (this follows from the Mean Value Theorem). So we write

∫ f(x) dx = F(x) + C,

and call it the **indefinite integral**. It is a family of functions. The definite integral ∫ from a to b is a number; the two are linked by the Fundamental Theorem.

**The basic rules.** Read each derivative rule backwards.

| Derivative fact | Antiderivative rule |
|---|---|
| d/dx xⁿ⁺¹ = (n + 1)xⁿ | ∫ xⁿ dx = xⁿ⁺¹/(n + 1) + C, n ≠ −1 |
| d/dx ln |x| = 1/x | ∫ (1/x) dx = ln |x| + C |
| d/dx eˣ = eˣ | ∫ eˣ dx = eˣ + C |
| d/dx aˣ = aˣ ln a | ∫ aˣ dx = aˣ/ln a + C |
| d/dx sin x = cos x | ∫ cos x dx = sin x + C |
| d/dx cos x = −sin x | ∫ sin x dx = −cos x + C |
| d/dx tan x = sec²x | ∫ sec²x dx = tan x + C |
| d/dx sec x = sec x tan x | ∫ sec x tan x dx = sec x + C |
| d/dx cot x = −csc²x | ∫ csc²x dx = −cot x + C |
| d/dx csc x = −csc x cot x | ∫ csc x cot x dx = −csc x + C |
| d/dx arcsin x = 1/√(1 − x²) | ∫ 1/√(1 − x²) dx = arcsin x + C |
| d/dx arctan x = 1/(1 + x²) | ∫ 1/(1 + x²) dx = arctan x + C |

Sums, differences and constant multiples work term by term. Products and quotients do **not**: there is no product rule for antiderivatives at this level.

**Rewrite first.** Roots become fractional powers, and a quotient with a single-term denominator splits:

∫ (x² + 1)/√x dx = ∫ (x^(3/2) + x^(−1/2)) dx = (2/5)x^(5/2) + 2x^(1/2) + C.

**Worked example.** Find ∫ (4x³ − 6/x² + 2) dx.

Rewrite −6/x² as −6x⁻². Then ∫ 4x³ dx = x⁴, ∫ −6x⁻² dx = −6 · x⁻¹/(−1) = 6x⁻¹, and ∫ 2 dx = 2x. Result: x⁴ + 6/x + 2x + C. Check by differentiating: 4x³ − 6x⁻² + 2. Always check; it takes ten seconds.

**Worked example (an initial condition).** Find f if f′(x) = 6x² − 4 and f(1) = 3.

f(x) = 2x³ − 4x + C. Then f(1) = 2 − 4 + C = 3, so C = 5 and f(x) = 2x³ − 4x + 5. In particular f(2) = 16 − 8 + 5 = 13. (Equivalently, f(2) = f(1) + ∫ from 1 to 2 of f′(x) dx = 3 + 10 = 13, the net change form from week 24.)

**Different-looking answers can both be right.** Both sin²x and −cos²x are antiderivatives of 2 sin x cos x, because they differ by sin²x + cos²x = 1. If your answer disagrees with a classmate's, differentiate both before arguing.

## Substitution (6.9)

The chain rule says d/dx F(g(x)) = F′(g(x)) · g′(x). Read backwards:

∫ f(g(x)) g′(x) dx = F(g(x)) + C, where F′ = f.

To use it, name the inner function u = g(x). Then du = g′(x) dx, and the integral becomes ∫ f(u) du, which should be a basic rule.

**Choosing u.** Look for a function inside another (inside a power, a root, an exponential or a trig function, or a whole denominator) whose derivative also appears, at least up to a constant factor.

**Constants can be fixed; variables cannot.** If du = 2x dx and the integrand has only x dx, write x dx = (1/2) du. But if the integrand has no x at all, as in ∫ (x² + 4)² dx, then u = x² + 4 cannot work: expand instead.

**Worked example.** Find ∫ x(x² + 1)³ dx.

u = x² + 1, du = 2x dx, so x dx = du/2. The integral is (1/2) ∫ u³ du = u⁴/8 + C = (x² + 1)⁴/8 + C. Check: d/dx gives 4(x² + 1)³ · 2x/8 = x(x² + 1)³.

**Linear insides** are the most common case and are worth doing mentally: ∫ cos(5x) dx = (1/5) sin(5x) + C, and ∫ e^(3x − 1) dx = (1/3)e^(3x − 1) + C. Divide by the coefficient of x; never multiply.

**Worked example (a logarithm).** Find ∫ eˣ/(1 + eˣ) dx.

u = 1 + eˣ, du = eˣ dx. The integral is ∫ du/u = ln |u| + C = ln(1 + eˣ) + C. The same idea gives ∫ tan x dx = ∫ sin x/cos x dx = −ln |cos x| + C, with u = cos x and du = −sin x dx. Whenever the numerator is (a multiple of) the derivative of the denominator, expect a logarithm.

## Substitution in definite integrals (6.9)

With a definite integral you have two choices: find the antiderivative in x and use the original limits, or **change the limits** to u-values and finish in u. The second is usually faster and avoids back-substituting.

**Worked example.** Evaluate ∫ from 0 to 2 of x(x² + 1)³ dx.

u = x² + 1: when x = 0, u = 1; when x = 2, u = 5. The integral becomes (1/2) ∫ from 1 to 5 of u³ du = (1/8)(5⁴ − 1⁴) = 624/8 = 78.

Do not mix the methods: an integral in u with the old x-limits 0 and 2 would give (1/8)(16 − 0) = 2, which is wrong.

Limits may come out in decreasing order. For ∫ from 0 to π/2 of sin x cos²x dx with u = cos x, the limits are 1 and 0 and du = −sin x dx, so the integral is −∫ from 1 to 0 of u² du = ∫ from 0 to 1 of u² du = 1/3. Keep the order the substitution gives you and let the minus sign do its work.

**Worked example (back-substitution).** Evaluate ∫ from 0 to 4 of x/√(2x + 1) dx.

Take u = 2x + 1, so du = 2 dx and dx = du/2. An x is left in the numerator, so solve: x = (u − 1)/2. Limits: x = 0 gives u = 1; x = 4 gives u = 9. The integral is

∫ from 1 to 9 of ((u − 1)/2) · u^(−1/2) · (1/2) du = (1/4) ∫ from 1 to 9 of (u^(1/2) − u^(−1/2)) du.

Antiderivative: (1/4)[(2/3)u^(3/2) − 2u^(1/2)]. At 9: (2/3)(27) − 2(3) = 12. At 1: 2/3 − 2 = −4/3. Result: (1/4)(12 + 4/3) = (1/4)(40/3) = 10/3.

## Where this goes next

Week 26 extends the toolkit with polynomial long division and completing the square, then asks you to choose among all the techniques without being told which one applies. Unit 7 uses antiderivatives with initial conditions constantly: solving a separable differential equation means integrating both sides and then using a given point to find C, exactly as in the f′(x) = 6x² − 4, f(1) = 3 example. Unit 8 turns definite integrals into average values, positions, areas and volumes; every one of those questions ends with an antiderivative evaluated from a to b, so speed and accuracy with this week's rules pay off for the rest of the year. Keep checking each antiderivative by differentiating it: on the exam a ten-second check catches most sign and constant errors.

## Common mistakes

- **Leaving off + C** on an indefinite integral. It is part of the answer.
- **Using the power rule on 1/x.** n = −1 gives division by zero; the answer is ln |x|.
- **Getting the sine and cosine signs backwards.** ∫ sin x dx = −cos x + C.
- **Multiplying by the inner coefficient instead of dividing.** ∫ cos(5x) dx is (1/5) sin(5x) + C.
- **Keeping x-limits after substituting.** Change them or return to x first, never half of each.
- **Forcing a substitution when du is missing a variable factor.** Expand or rewrite instead.
- **Splitting an integral over a product.** ∫ x cos x dx is not (x²/2) sin x + C.

## Self-check

1. Find ∫ (5x⁴ − 3√x + 1/x) dx.
2. Find ∫ (2 sin x + sec²x) dx.
3. Find g if g′(x) = 4eˣ and g(0) = 7.
4. Find ∫ 3x²(x³ − 2)⁵ dx.
5. Find ∫ cos x/(2 + sin x) dx.
6. Evaluate ∫ from 1 to 2 of (2x − 1)³ dx using substitution with new limits.

*Answers:* 1. x⁵ − 2x^(3/2) + ln |x| + C. 2. −2 cos x + tan x + C. 3. g(x) = 4eˣ + 3. 4. u = x³ − 2: (x³ − 2)⁶/6 + C. 5. u = 2 + sin x: ln(2 + sin x) + C (no absolute value needed, since 2 + sin x > 0). 6. u = 2x − 1 from 1 to 3, dx = du/2: (1/2) · u⁴/4 from 1 to 3 = (81 − 1)/8 = 10.

---

*Original study material for this course, organised around the College Board AP Calculus AB and BC Course and Exam Description (Unit 6, Topics 6.8–6.9). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). AP® is a trademark of the College Board, which does not endorse this material.*
