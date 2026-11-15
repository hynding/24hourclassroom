# Week 32 · Finding Taylor and Maclaurin Series and Representing Functions as Power Series

**Topics:** 10.14 Finding Taylor or Maclaurin Series for a Function · 10.15 Representing Functions as Power Series
**Practices:** 1 (Implementing Mathematical Processes), 2 (Connecting Representations), 3 (Justification), 4 (Communication and Notation)
**Framework:** AP Calculus AB and BC CED, Unit 10, Topics 10.14–10.15, learning objectives in our own words
**Spiral:** Week 30 built Taylor polynomials one derivative at a time; week 31 showed that a power series is a function with an interval of convergence. This week lets the polynomial run forever and, more importantly, shows how to get series without computing derivatives at all: substitute into a series you already know, multiply by a power of x, or differentiate and integrate term by term. The error bounds of weeks 30 and 31 then tell you how good a truncated series is, and the Second Derivative Test of week 11 can be read straight from the coefficients.

## What you need to be able to do

- **10.14** Write the Taylor series of a function about x = a from its derivatives, including its general term.
- **10.14** Recall the Maclaurin series for eˣ, sin x, cos x and 1/(1 − x), and build new series from them by substitution and multiplication by powers of x.
- **10.14** Use a series to find derivative values, evaluate limits and identify the sum of a numerical series.
- **10.15** Represent a function as a geometric series about any center, and state where the representation holds.
- **10.15** Differentiate and integrate power series term by term to represent new functions (1/(1 − x)², ln(1 + x), arctan x), with intervals of convergence.
- **10.15** Use an integrated series to approximate a definite integral and bound the error.

## Key terms

| Term | Meaning |
|---|---|
| Taylor series about x = a | ∑ (n = 0 to ∞) f⁽ⁿ⁾(a)/n! · (x − a)ⁿ. |
| Maclaurin series | The Taylor series about a = 0. |
| General term | The formula for the nth term, such as (−1)ⁿ x^(2n+1)/(2n + 1)!. |
| Substitution | Replacing x in a known series by an expression such as −x, 2x or x². |
| Term-by-term differentiation or integration | Differentiating or integrating each term of a power series inside its interval of convergence. |
| Power series representation | An equation f(x) = ∑ cₙ(x − a)ⁿ together with the interval on which it holds. |

## Taylor series and the standard series (10.14)

The Taylor series of f about x = a is the Taylor polynomial with no last term:

**f(a) + f′(a)(x − a) + f″(a)/2! (x − a)² + ⋯ + f⁽ⁿ⁾(a)/n! (x − a)ⁿ + ⋯**

For the functions on the AP exam, the series equals the function on its interval of convergence. These are the series to know by heart, with their intervals:

| Function | Series | Converges for |
|---|---|---|
| eˣ | ∑ xⁿ/n! = 1 + x + x²/2! + x³/3! + ⋯ | all real x |
| sin x | ∑ (−1)ⁿ x^(2n+1)/(2n + 1)! = x − x³/3! + x⁵/5! − ⋯ | all real x |
| cos x | ∑ (−1)ⁿ x^(2n)/(2n)! = 1 − x²/2! + x⁴/4! − ⋯ | all real x |
| 1/(1 − x) | ∑ xⁿ = 1 + x + x² + x³ + ⋯ | −1 < x < 1 |
| ln(1 + x) | ∑ (n = 1 to ∞) (−1)^(n+1) xⁿ/n = x − x²/2 + x³/3 − ⋯ | −1 < x ≤ 1 |
| arctan x | ∑ (−1)ⁿ x^(2n+1)/(2n + 1) = x − x³/3 + x⁵/5 − ⋯ | −1 ≤ x ≤ 1 |

(Sums start at n = 0 unless shown.) The last two are not separate facts to memorize: they come from the geometric series in section 10.15.

**Building new series.** Computing twenty derivatives is slow and error-prone. Instead:

- **Substitute.** Replace x by 2x, −x, x² and so on. The coefficients' factorials stay put; only the powers and constants change.
- **Multiply** by a power of x (or a constant). Every power shifts by the same amount.
- **Add** two known series term by term.

**Worked example (substitute, then multiply).** Find the Maclaurin series for x²e^(−x).

Substitute −x into eˣ: e^(−x) = ∑ (−x)ⁿ/n! = ∑ (−1)ⁿ xⁿ/n! = 1 − x + x²/2 − x³/6 + ⋯.
Multiply by x²: x²e^(−x) = ∑ (n = 0 to ∞) (−1)ⁿ x^(n+2)/n! = x² − x³ + x⁴/2 − x⁵/6 + ⋯, for all real x.

**Worked example (substitute a power).** Find the first three nonzero terms of the series for sin(x²).

x² − (x²)³/3! + (x²)⁵/5! = x² − x⁶/6 + x¹⁰/120. Note what did not change: the factorials 3! and 5!.

**Reading derivatives.** Because the coefficient of (x − a)ᵏ is f⁽ᵏ⁾(a)/k!, a series built by substitution hands you high-order derivatives for free.

**Worked example (a sixth derivative without differentiating).** Let f(x) = e^(x²) = ∑ x^(2n)/n! = 1 + x² + x⁴/2! + x⁶/3! + ⋯. The x⁶ coefficient is 1/3! = 1/6, so

f⁽⁶⁾(0) = 6! · (1/6) = 720/6 = 120.

Every odd-order derivative at 0 is 0, because no odd powers appear. Differentiating e^(x²) six times by hand would take a page.

**Limits.** Replacing a function by its series often turns a 0/0 limit into simple algebra.

**Worked example (a limit).** lim (x→0) (sin x − x)/x³. Since sin x − x = −x³/6 + x⁵/120 − ⋯, the quotient is −1/6 + x²/120 − ⋯, so the limit is **−1/6**. (L'Hospital's Rule needs three rounds to get the same answer.)

**Recognizing a sum.** A numerical series that matches a standard series at a particular x can be summed exactly: ∑ 2ⁿ/n! = e², and ∑ (−1)ⁿ (π/4)^(2n+1)/(2n + 1)! = sin(π/4) = √2/2. Look at the powers (all, even or odd), the factorials and the signs to identify the function, then read off x.

## Representing functions as power series (10.15)

**Geometric series in disguise.** Any expression that can be written as A/(1 − r) is a geometric series ∑ A rⁿ, valid for |r| < 1.

- 1/(1 + x²) = 1/(1 − (−x²)) = 1 − x² + x⁴ − x⁶ + ⋯, for −1 < x < 1.
- x/(1 + 4x) = x · 1/(1 − (−4x)) = ∑ (−4)ⁿ x^(n+1), for −1/4 < x < 1/4.
- 1/(3 − x) = (1/3) · 1/(1 − x/3) = ∑ xⁿ/3ⁿ⁺¹, for −3 < x < 3.

**About a center other than 0.** To expand 1/x about x = 2, write it in terms of x − 2:

1/x = 1/(2 + (x − 2)) = (1/2) · 1/(1 + (x − 2)/2) = ∑ (n = 0 to ∞) (−1)ⁿ (x − 2)ⁿ/2ⁿ⁺¹,

valid for |x − 2| < 2, that is 0 < x < 4. At both ends the terms have size 1/2, so neither endpoint is included.

**Differentiating and integrating.** Inside its interval of convergence a power series may be differentiated or integrated term by term; the radius stays the same and the endpoints must be rechecked (week 31).

**Worked example (arctan by integration).** Integrate 1/(1 + t²) = 1 − t² + t⁴ − ⋯ from 0 to x:

arctan x = x − x³/3 + x⁵/5 − x⁷/7 + ⋯ = ∑ (n = 0 to ∞) (−1)ⁿ x^(2n+1)/(2n + 1).

No constant is needed because arctan 0 = 0. The radius is 1, and now both endpoints converge by the Alternating Series Test, so the interval is −1 ≤ x ≤ 1. (At x = 1 this gives π/4 = 1 − 1/3 + 1/5 − ⋯.) The same move applied to 1/(1 + t) produces ln(1 + x).

**Worked example (differentiation and a sum).** Differentiate 1/(1 − x) = ∑ xⁿ:

1/(1 − x)² = ∑ (n = 1 to ∞) n x^(n−1) = 1 + 2x + 3x² + 4x³ + ⋯, for −1 < x < 1.

At x = 1/2: ∑ n (1/2)^(n−1) = 1/(1/2)² = 4. Multiplying by 1/2 gives the sum of ∑ n/2ⁿ = 1/2 + 2/4 + 3/8 + ⋯ = **2**. Both endpoints of the derivative series diverge, because the terms ±n do not go to 0.

**Worked example (an integral no antiderivative can do).** e^(−x²) has no elementary antiderivative, but its series does:

e^(−x²) = 1 − x² + x⁴/2! − x⁶/3! + x⁸/4! − ⋯, so

∫ from 0 to 1 of e^(−x²) dx = 1 − 1/3 + 1/(5·2) − 1/(7·6) + 1/(9·24) − ⋯ = 1 − 1/3 + 1/10 − 1/42 + 1/216 − ⋯.

The first four terms give 0.742857. The series alternates and its terms decrease to 0, so by the alternating series error bound the error is at most the next term, 1/216 ≈ 0.0046, and the estimate is low because that term is positive. (The integral is about 0.7468.)

**Free-response pattern.** A typical question gives a series (or a function to expand), asks for the first few terms and the general term, the interval of convergence with endpoint justification, a related series by differentiating or integrating, and an error bound for an approximation. Each piece is a skill from weeks 30–32; practice writing each one in full sentences.

## Common mistakes

- **Changing the factorials when substituting.** sin(x²) keeps 3! and 5!; only the powers change.
- **Dropping the alternating sign.** 1/(1 + u) is 1 − u + u² − ⋯, because 1 + u = 1 − (−u).
- **Wrong interval after substitution.** For 1/(1 + 4x) the condition is |4x| < 1, so |x| < 1/4.
- **Coefficient versus derivative.** f⁽ᵏ⁾(0) is k! times the coefficient of xᵏ, not the coefficient.
- **Forgetting the constant of integration** when the function is not 0 at the center: integrate from the center, or find C from a known value.
- **Assuming the same endpoints** after differentiating or integrating: recheck both.
- **Mixing up which series a sum comes from.** Odd powers over odd factorials with alternating signs is sin; even over even is cos; all powers over n! is eˣ.

## Self-check

1. Write the first three nonzero terms of the Maclaurin series for cos(x³).
2. Starting from 1/(1 + x) = ∑ (−1)ⁿ xⁿ, find a series for 1/(1 + x)².
3. Let h(x) = x sin x. Find h⁽⁴⁾(0) from its Maclaurin series.
4. Use series to evaluate lim (x→0) (eˣ − 1 − x)/x².
5. Find the sums: ∑ (n = 0 to ∞) (−1)ⁿ/(2n + 1) and ∑ (n = 0 to ∞) 3ⁿ/n!.
6. Write a power series for 1/(5 − x) about x = 0 and state where it is valid.

*Answers:* 1. 1 − x⁶/2 + x¹²/24. 2. Differentiate: −1/(1 + x)² = ∑ (n = 1 to ∞) (−1)ⁿ n x^(n−1), so 1/(1 + x)² = 1 − 2x + 3x² − 4x³ + ⋯ = ∑ (n = 1 to ∞) (−1)^(n+1) n x^(n−1), for −1 < x < 1. 3. h(x) = x² − x⁴/6 + ⋯, so h⁽⁴⁾(0) = 4!(−1/6) = −4. 4. eˣ − 1 − x = x²/2 + x³/6 + ⋯, so the limit is 1/2. 5. arctan 1 = π/4; e³. 6. (1/5) · 1/(1 − x/5) = ∑ xⁿ/5ⁿ⁺¹, valid for −5 < x < 5.

---

*Original study material for this course, organised around the College Board AP Calculus AB and BC Course and Exam Description (Unit 10, Topics 10.14–10.15). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). AP® is a trademark of the College Board, which does not endorse this material.*
