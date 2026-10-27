# Week 11 · Exponential Functions and Their Manipulation

**Topics:** 2.3 Exponential Functions · 2.4 Exponential Function Manipulation
**Practices:** 1 (procedural and symbolic fluency), 2 (multiple representations), 3 (communication and reasoning)
**Framework:** AP Precalculus CED, Unit 2, Topics 2.3–2.4, learning objectives in our own words
**Spiral:** Week 10 showed that exponential functions multiply by a constant factor over equal input intervals; this week studies their graphs and rewrites them. Week 5's limit notation describes the ends of the graph, week 8's transformations explain shifts and stretches of 2ˣ, and week 1's concavity vocabulary describes the curve's bend. From Algebra 2: the exponent rules and rational exponents.

## What you need to be able to do

- **2.3** State the domain, range, horizontal asymptote and vertical intercept of f(x) = abˣ (and of abˣ + k), and decide from a and b whether the function is increasing or decreasing and concave up or concave down.
- **2.3** Describe end behaviour with limit notation, for example lim as x→−∞ of 3 · 2ˣ = 0.
- **2.3** Explain why an exponential function has no relative extrema and no points of inflection.
- **2.4** Use the product, quotient and power rules for exponents, together with negative and rational exponents, to rewrite exponential expressions.
- **2.4** Show that a horizontal translation of an exponential function is the same as a vertical dilation: b^(x + k) = bᵏ · bˣ.
- **2.4** Rewrite an exponential function with a different base or a different time unit, for example 4ˣ = 2^(2x), 500 · 2^(t/3) as an annual factor, or an annual factor as a monthly one.
- **2.4** Recognise the number e ≈ 2.718 as a base, and rewrite e^(kx) as (eᵏ)ˣ.

## Key terms

| Term | Meaning |
|---|---|
| Exponential function | f(x) = abˣ with a ≠ 0, b > 0 and b ≠ 1. a is the initial value f(0); b is the base or growth factor. |
| Exponential growth | a > 0 and b > 1: outputs increase and grow faster and faster. |
| Exponential decay | a > 0 and 0 < b < 1: outputs decrease toward 0. |
| Horizontal asymptote | A line y = k that the graph approaches at one end; y = 0 for abˣ, y = k for abˣ + k. |
| Concave up / down | The rate of change is increasing / decreasing; the graph bends upward / downward. |
| Rational exponent | b^(m/n) = (ⁿ√b)ᵐ, for example 8^(2/3) = 4. |
| The number e | The irrational constant 2.71828…, the value that (1 + 1/n)ⁿ approaches as n grows; used as a base in continuous models. |

## The graph of f(x) = abˣ (2.3)

Start with a = 1. For b = 2:

| x | −3 | −2 | −1 | 0 | 1 | 2 | 3 |
|---|---|---|---|---|---|---|---|
| 2ˣ | 1/8 | 1/4 | 1/2 | 1 | 2 | 4 | 8 |
| (1/2)ˣ | 8 | 4 | 2 | 1 | 1/2 | 1/4 | 1/8 |

Every power of a positive number is positive, so neither graph touches the x-axis. Both pass through (0, 1). The graph of (1/2)ˣ is the mirror image of 2ˣ across the y-axis, because (1/2)ˣ = 2^(−x).

**Properties of f(x) = abˣ (a ≠ 0, b > 0, b ≠ 1):**

- **Domain:** all real numbers.
- **Range:** (0, ∞) if a > 0; (−∞, 0) if a < 0.
- **Vertical intercept:** (0, a).
- **Horizontal asymptote:** y = 0.
- **Increasing or decreasing:** always one or the other, never both. Increasing when a > 0 and b > 1, or a < 0 and 0 < b < 1. Decreasing in the other two cases.
- **Concavity:** concave up everywhere if a > 0, concave down everywhere if a < 0. (For 2ˣ the increases 1/8, 1/4, 1/2, 1, 2, 4 keep growing, so the rate of change increases: concave up.)
- **No relative extrema and no inflection points**, because the function never changes from increasing to decreasing and its concavity never changes.

**End behaviour in limit notation.** For a > 0 and b > 1:

lim as x→∞ of abˣ = ∞  and  lim as x→−∞ of abˣ = 0.

For a > 0 and 0 < b < 1 the ends swap: the limit as x→∞ is 0 and the limit as x→−∞ is ∞. A negative a flips the signs of the infinite limits.

**Adding a constant.** g(x) = abˣ + k is the same graph shifted up k. Its asymptote is y = k, its range is (k, ∞) for a > 0 or (−∞, k) for a < 0, and its vertical intercept is (0, a + k).

**Worked example.** Describe f(x) = −3 · 2ˣ + 6.

Asymptote y = 6. a = −3 < 0, so the outputs lie below the asymptote: range (−∞, 6). Since a < 0 and b = 2 > 1, f is decreasing and concave down. f(0) = −3 + 6 = 3. End behaviour: lim as x→−∞ of f(x) = 6 (because 2ˣ → 0), and lim as x→∞ of f(x) = −∞. The graph crosses the x-axis where 2ˣ = 2, at x = 1.

**Try it.**
1. State the range and the asymptote of g(x) = 5(0.4)ˣ − 2.
2. Is h(x) = −(1/3)ˣ increasing or decreasing? Concave up or down?
3. Write lim as x→∞ and lim as x→−∞ of 7(0.9)ˣ.

*Answers:* 1. Range (−2, ∞), asymptote y = −2. 2. a < 0 with 0 < b < 1: increasing, concave down. 3. 0 and ∞.

## Exponent rules as tools (2.4)

| Rule | Example |
|---|---|
| bᵐ · bⁿ = b^(m + n) | 2³ · 2ˣ = 2^(x + 3) |
| bᵐ / bⁿ = b^(m − n) | 5ˣ / 5² = 5^(x − 2) |
| (bᵐ)ⁿ = b^(mn) | (3²)ˣ = 3^(2x) = 9ˣ |
| b⁰ = 1 | 7⁰ = 1 |
| b^(−n) = 1/bⁿ | 2^(−x) = (1/2)ˣ |
| b^(1/n) = ⁿ√b | 27^(1/3) = 3 |
| b^(m/n) = (ⁿ√b)ᵐ | 16^(3/4) = 2³ = 8 |

## Horizontal translation = vertical dilation (2.4)

The product rule read backwards says

b^(x + k) = bᵏ · bˣ.

So shifting the graph of bˣ left by k units gives exactly the same graph as stretching it vertically by the factor bᵏ. For example, 2^(x + 3) = 8 · 2ˣ: shifting 2ˣ three units left is the same as multiplying every output by 8. Likewise 2^(x − 4) = (1/16) · 2ˣ.

This is special to exponential functions. For a parabola, (x + 3)² is not a constant multiple of x².

**Worked example.** Write g(x) = 5 · 3^(x − 2) in the form abˣ.

3^(x − 2) = 3^(−2) · 3ˣ = (1/9) · 3ˣ, so g(x) = (5/9) · 3ˣ. The initial value is 5/9 and the base is still 3.

## Changing the base (2.4)

The power rule lets you trade a horizontal dilation for a different base:

- 4ˣ = (2²)ˣ = 2^(2x). Compressing 2ˣ horizontally by a factor of 1/2 gives 4ˣ.
- 8^(x/3) = (2³)^(x/3) = 2ˣ.
- (1/3)ˣ = 3^(−x), a reflection of 3ˣ across the y-axis.

**Worked example.** Rewrite 9^(x/2) · 3^(x + 1) as a single power of 3 and in the form abˣ.

9^(x/2) = (3²)^(x/2) = 3ˣ. Then 3ˣ · 3^(x + 1) = 3^(2x + 1) = 3 · 3^(2x) = 3 · 9ˣ.

## Changing the time unit (2.4)

Many models are written with the input divided or multiplied by a constant, because it makes the meaning visible.

**Worked example (hypothetical).** A hypothetical bacteria population is P(t) = 400 · 2^(t/5), with t in hours. Interpret the 5, and find the hourly growth factor.

When t increases by 5, the exponent t/5 increases by 1, so the population doubles every 5 hours. Rewrite with the power rule: 2^(t/5) = (2^(1/5))ᵗ ≈ 1.1487ᵗ. So P(t) ≈ 400(1.1487)ᵗ: the population grows by about 14.9% per hour. Both forms describe the same function.

**Worked example (hypothetical).** A savings balance in a hypothetical account is B(t) = 1000(1.06)ᵗ after t years. Write B in terms of months.

After t years, 12t months have passed, so we want a monthly factor m that, applied 12 times, gives the annual factor: m¹² = 1.06. Then m = 1.06^(1/12) ≈ 1.00487, and B(t) = 1000(1.06^(1/12))^(12t) ≈ 1000(1.00487)^(12t). The balance grows by about 0.487% per month. Notice that 6%/12 = 0.5% is *not* the monthly rate: growth compounds.

Going the other way, a quantity that grows 1% per month, Q(t) = Q₀(1.01)^(12t) with t in years, grows by the annual factor 1.01¹² ≈ 1.1268, about 12.7% per year, not 12%.

**Try it.**
1. Write 3^(x + 2) as abˣ.
2. Write 25^(x/2) with base 5.
3. A hypothetical radioactive sample has mass M(t) = 80(1/2)^(t/12) grams after t days. What is its half-life, and what is its daily decay factor?

*Answers:* 1. 9 · 3ˣ. 2. 5ˣ. 3. 12 days; (1/2)^(1/12) ≈ 0.944, so it loses about 5.6% per day.

## The number e (2.4)

Compute (1 + 1/n)ⁿ for larger and larger n: n = 1 gives 2, n = 10 gives about 2.5937, n = 1000 gives about 2.7169, and the values settle on 2.71828…, the number **e**. It appears whenever growth is compounded continuously (week 12). As a base it behaves like any other: eˣ is increasing and concave up, with asymptote y = 0, and it lies between 2ˣ and 3ˣ.

Any exponent rule works with e. In particular e^(kx) = (eᵏ)ˣ, so e^(0.3t) ≈ (1.3499)ᵗ: a function written with base e is an ordinary exponential function whose growth factor is eᵏ. When k < 0, eᵏ < 1 and the function decays: e^(−0.5x) ≈ (0.6065)ˣ.

## Calculator notes

On the AP no-calculator section you should be able to simplify powers like 8^(2/3), 2^(x+3) or 9^(x/2) exactly. A calculator is needed for decimal growth factors such as 2^(1/5) or 1.06^(1/12) and for values of e^(kx); type the exponent in parentheses. To check that two forms are equivalent, graph both or compare a table of values: they should agree at every input.

## Common mistakes

- **Confusing the growth rate with the growth factor.** Growing 6% per year means multiplying by 1.06, not by 0.06 or 6.
- **Dividing the annual rate by 12.** The monthly factor for 1.06 per year is 1.06^(1/12) ≈ 1.00487, not 1.005.
- **Writing 2^(x+3) as 2ˣ + 8 or 2ˣ + 2³.** The rule is a product: 2^(x+3) = 2³ · 2ˣ = 8 · 2ˣ.
- **Multiplying bases.** 2ˣ · 3ˣ = 6ˣ is fine (same exponent), but 2ˣ · 2ˣ = 4ˣ = 2^(2x), not 4^(2x).
- **Forgetting the shift moves the asymptote.** abˣ + k has asymptote y = k, not y = 0.
- **Thinking an exponential graph eventually touches its asymptote.** bˣ is never 0.

## Where this goes next

Week 12 uses these rewrites constantly: half-lives and doubling times are the t/5 and t/12 forms, and compound and continuous interest use (1 + r/n)^(nt) and e^(rt). Weeks 14–16 introduce logarithms, which undo exponentials and let you solve 2^(t/5) = 3 for t.

## Self-check

1. State the domain, range, asymptote, monotonicity and concavity of f(x) = −2(0.5)ˣ + 4.
2. Write lim as x→∞ and lim as x→−∞ for f in question 1.
3. Show that 5^(x + 2) is a vertical dilation of 5ˣ and give the factor.
4. Rewrite 27^(x/3) · 9^(−x) as a single power of 3.
5. A hypothetical population triples every 4 years: P(t) = 50 · 3^(t/4). Find its annual growth factor, to four decimal places, and its annual percent growth.

---

*Original study material for this course, organised around the College Board AP Precalculus Course and Exam Description (Unit 2, Topics 2.3–2.4). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). AP® is a trademark of the College Board, which does not endorse this material.*
