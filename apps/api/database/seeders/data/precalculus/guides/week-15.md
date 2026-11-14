# Week 15 · Logarithmic Functions and Their Properties

**Topics:** 2.11 Logarithmic Functions · 2.12 Logarithmic Function Manipulation
**Practices:** 1 (procedural and symbolic fluency), 2 (multiple representations), 3 (communication and reasoning)
**Framework:** AP Precalculus CED, Unit 2, Topics 2.11–2.12, learning objectives in our own words
**Spiral:** Week 14 defined log_b x and showed it is the inverse of bˣ; this week treats it as a function with its own graph and algebra. Week 11's exponent rules (bᵐ · bⁿ = b^(m+n), (bᵐ)ⁿ = b^(mn)) are exactly what the log properties restate. Week 8's transformations (vertical and horizontal shifts and dilations) and weeks 5–6's limit notation for end behaviour and asymptotes come back to describe log graphs.

## What you need to be able to do

- **2.11** Describe the graph of f(x) = a log_b x: domain, range, vertical asymptote, the point (1, 0), whether it increases or decreases, and its concavity.
- **2.11** Use limit notation for the behaviour of a log function near its vertical asymptote and as x → ∞, and explain why a log function grows without bound but more slowly than any linear or exponential function.
- **2.11** Recognise logarithmic behaviour in a table: when inputs are multiplied by a constant factor, outputs change by a constant amount.
- **2.12** Use the product, quotient and power properties to rewrite logarithmic expressions in expanded or condensed form, with attention to the domain.
- **2.12** Use the change-of-base formula to evaluate logs in any base and to see that every log function is a vertical dilation of every other.
- **2.12** Explain why a horizontal dilation of a log graph is the same as a vertical translation (log_b(kx) = log_b k + log_b x), and why a power inside the log is a vertical dilation (log_b(xⁿ) = n log_b x).

## Key terms

| Term | Meaning |
|---|---|
| Logarithmic function | f(x) = a log_b x with a ≠ 0, b > 0, b ≠ 1 (possibly with transformations). |
| Vertical asymptote | A line x = c that the graph approaches as x → c from one side while the outputs grow without bound. For log_b x it is x = 0. |
| Concave down | The rate of change is decreasing; the graph bends downward. y = log_b x with b > 1 is concave down. |
| Product property | log_b(MN) = log_b M + log_b N for M, N > 0. |
| Quotient property | log_b(M/N) = log_b M − log_b N for M, N > 0. |
| Power property | log_b(Mⁿ) = n log_b M for M > 0 and any real n. |
| Change of base | log_b x = (log_a x)/(log_a b), for any allowed base a; usually a = 10 or a = e. |
| Expanded / condensed form | A sum or difference of simple logs versus a single log of a combined argument. |

## The graph of a logarithmic function (2.11)

Start with f(x) = log₂ x. Swapping the coordinates of points on y = 2ˣ gives a table:

| x | 1/8 | 1/4 | 1/2 | 1 | 2 | 4 | 8 | 16 |
|---|---|---|---|---|---|---|---|---|
| log₂ x | −3 | −2 | −1 | 0 | 1 | 2 | 3 | 4 |

From the table and the reflection picture:

- **Domain** x > 0; **range** all real numbers.
- **Horizontal intercept** (1, 0); there is **no vertical intercept**, because 0 is not in the domain.
- **Vertical asymptote** x = 0. As x → 0⁺, log₂ x → −∞: in limit notation, lim (x → 0⁺) log₂ x = −∞. Only the right-hand limit makes sense, because the function is not defined for x < 0.
- **End behaviour:** lim (x → ∞) log₂ x = ∞. The outputs grow without bound, but very slowly: to get an output of 20 you need x = 2²⁰, more than a million.
- **Increasing and concave down** (for any base b > 1). The graph rises everywhere, but each step to the right raises it less than the step before.

For a base between 0 and 1, such as log_(1/2) x, the graph is the reflection of log₂ x across the x-axis (the change-of-base section below shows log_(1/2) x = −log₂ x). It is decreasing and concave up, with lim (x → 0⁺) log_(1/2) x = ∞ and lim (x → ∞) log_(1/2) x = −∞.

A coefficient a in f(x) = a log_b x stretches the graph vertically; if a < 0 it also reflects it across the x-axis. A shift inside the log moves the asymptote: y = log₂(x − 3) has domain x > 3 and asymptote x = 3, and its horizontal intercept is where x − 3 = 1, at (4, 0).

### Why concave down? Rates of change

Look at the table above over equal-length input intervals. From x = 1 to 2 the output rises by 1; from 2 to 3 it rises by log₂ 3 − 1 ≈ 0.585; from 3 to 4 by about 0.415. The average rates of change over consecutive equal intervals are decreasing, which is what concave down means (week 1).

Now look over input intervals that grow by the same **factor**: 1 to 2, 2 to 4, 4 to 8, 8 to 16. Each time the output rises by exactly 1. This is the signature of a logarithmic function, the mirror image of week 10's exponential signature:

| Function type | Inputs change by | Outputs change by |
|---|---|---|
| Linear | equal amounts (add) | equal amounts (add) |
| Exponential | equal amounts (add) | equal factors (multiply) |
| Logarithmic | equal factors (multiply) | equal amounts (add) |

**Worked example.** A table shows x = 3, 6, 12, 24, 48 with outputs 5, 7, 9, 11, 13. Is the relationship linear, exponential or logarithmic? Find a model.

The inputs are multiplied by 2 each time while the outputs go up by 2 each time, so the relationship is logarithmic. Each doubling adds 2, so the model has the form f(x) = 2 log₂ x + c. At x = 3: 5 = 2 log₂ 3 + c, so c = 5 − 2 log₂ 3. One tidy way to write the result is f(x) = 5 + 2 log₂(x/3), which gives 5 at x = 3 and adds 2 for every doubling.

**Worked example.** Compare the growth of g(x) = log x and h(x) = x/100 for large x.

At x = 100: g = 2, h = 1. At x = 1,000: g = 3, h = 10. At x = 10⁶: g = 6, h = 10,000. Both go to ∞, but the linear function wins by a huge margin. Any increasing linear or exponential function eventually exceeds any logarithmic function.

**Try it.**
1. State the domain, asymptote, horizontal intercept and end behaviour (with limits) of y = log₃(x + 2).
2. A table has x = 1, 10, 100, 1,000 and y = 4, 1, −2, −5. Which kind of function fits, and is it increasing or decreasing?

*Answers:* 1. Domain x > −2; vertical asymptote x = −2; intercept where x + 2 = 1, at (−1, 0); lim (x → −2⁺) y = −∞ and lim (x → ∞) y = ∞. 2. Inputs multiply by 10 and outputs drop by 3 each time: logarithmic, decreasing; y = 4 − 3 log x.

## The properties of logarithms (2.12)

Each exponent rule has a logarithm twin. Write M = bᵐ and N = bⁿ, so log_b M = m and log_b N = n.

- **Product:** MN = b^(m+n), so log_b(MN) = m + n = log_b M + log_b N.
- **Quotient:** M/N = b^(m−n), so log_b(M/N) = log_b M − log_b N.
- **Power:** Mᵏ = b^(mk), so log_b(Mᵏ) = k · log_b M.

In words: the log of a product is the sum of the logs, the log of a quotient is the difference, and an exponent inside comes out front as a multiplier.

There is **no** property for log_b(M + N) or log_b M · log_b N. For example log(10 + 10) = log 20 ≈ 1.30, while log 10 + log 10 = 2.

**Worked example.** Expand log₃(9x⁴/y) for x, y > 0.

log₃ 9 + log₃(x⁴) − log₃ y = 2 + 4 log₃ x − log₃ y.

**Worked example.** Condense 2 ln x − ln(x + 1) + ln 5 into a single logarithm (x > 0).

Power first: ln(x²) − ln(x + 1) + ln 5. Then the product and quotient properties: ln(5x²/(x + 1)).

**Worked example.** Given log₂ 3 ≈ 1.585, estimate log₂ 12 and log₂(1/9) without a calculator.

log₂ 12 = log₂(4 · 3) = 2 + log₂ 3 ≈ 3.585. log₂(1/9) = −2 log₂ 3 ≈ −3.170.

**Worked example.** Using log 2 ≈ 0.301 and log 3 ≈ 0.477, estimate log 18 and log 1.5.

log 18 = log 2 + 2 log 3 ≈ 0.301 + 0.954 = 1.255. log 1.5 = log 3 − log 2 ≈ 0.176.

**A domain warning.** The properties need positive arguments. ln(x²) = 2 ln x is true for x > 0, but ln(x²) is defined for every x ≠ 0 while 2 ln x is defined only for x > 0. As functions they are different; the correct identity for all x ≠ 0 is ln(x²) = 2 ln |x|. When you rewrite a log expression, keep track of where both sides are defined.

**Try it.**
1. Expand log₅(25√x / y³) for x, y > 0.
2. Condense 3 log x + log 4 − (1/2) log y.
3. Given ln 2 ≈ 0.693, find ln 16 and ln(e/2).

*Answers:* 1. 2 + (1/2) log₅ x − 3 log₅ y. 2. log(4x³/√y). 3. 4 ln 2 ≈ 2.772; 1 − ln 2 ≈ 0.307.

## Change of base (2.12)

To evaluate log₅ 40 on a calculator with only LOG and LN keys, let y = log₅ 40, so 5ʸ = 40. Take the natural log of both sides and use the power property: y ln 5 = ln 40, so y = ln 40 / ln 5 ≈ 3.689/1.609 ≈ 2.292. In general,

log_b x = (log_a x)/(log_a b) = (ln x)/(ln b) = (log x)/(log b).

This has a structural meaning: log_b x = (1/ln b) · ln x. **Every logarithmic function is a constant multiple of ln x**, so all log graphs are vertical dilations of one another. For example log₂ x = (1/ln 2) ln x ≈ 1.443 ln x, and log x = (1/ln 10) ln x ≈ 0.434 ln x. It also explains log_(1/2) x = −log₂ x, since ln(1/2) = −ln 2.

**Worked example.** Write log₈ x in terms of log₂ x.

log₈ x = log₂ x / log₂ 8 = (1/3) log₂ x. So the graph of y = log₈ x is the graph of y = log₂ x compressed vertically by a factor of 1/3.

## Transformations that are secretly the same (2.12)

The properties give two surprising equivalences between transformations.

**A horizontal dilation is a vertical translation.** By the product property, log_b(kx) = log_b k + log_b x for k > 0. Compressing the graph of log_b x horizontally by a factor of 1/k produces exactly the same graph as shifting it up by log_b k. For instance

log₂(8x) = log₂ 8 + log₂ x = 3 + log₂ x,

so the graph of y = log₂(8x) is the graph of y = log₂ x moved up 3. Similarly log(x/100) = log x − 2 is the graph of log x moved down 2. (Compare week 11: for exponentials, a horizontal translation is a vertical dilation, since b^(x+k) = bᵏ · bˣ. The two facts are reflections of each other.)

**A power inside is a vertical dilation.** log_b(xⁿ) = n log_b x for x > 0, so y = log(x³) is y = log x stretched vertically by 3, on the domain x > 0.

**Worked example.** Describe g(x) = ln(e²x) − 4 as a single vertical translation of ln x.

ln(e²x) = ln e² + ln x = 2 + ln x, so g(x) = ln x − 2: the graph of ln x shifted down 2.

**Worked example.** Find k so that log₃(kx) = log₃ x + 4 for all x > 0.

log₃(kx) = log₃ k + log₃ x, so log₃ k = 4 and k = 3⁴ = 81.

**Try it.**
1. Rewrite y = log(1000x) as a vertical translation of y = log x.
2. Show that y = log₄ x and y = (1/2) log₂ x are the same function.

*Answers:* 1. y = 3 + log x, up 3. 2. log₄ x = log₂ x / log₂ 4 = (1/2) log₂ x.

## Calculator notes

Use LN or LOG with change of base for any other base: log₇ 300 = ln 300 / ln 7 ≈ 2.931. To check a rewritten expression, graph both forms on the same axes, or compare a table of values; if they match everywhere both are defined, the rewrite is right. Watch the domain: a calculator will graph y = ln(x²) on both sides of the y-axis but y = 2 ln x on the right only. On the no-calculator section you will be given any decimal values you need, such as log₂ 3 ≈ 1.585.

## Common mistakes

- **Inventing a sum rule.** log(M + N) is not log M + log N.
- **Distributing a log over a quotient wrongly.** log(M/N) is log M − log N, not log M / log N. The quotient of logs is what change of base produces, which is a different thing.
- **Pulling out a coefficient instead of an exponent.** log(3x) = log 3 + log x, not 3 log x. Only an exponent comes out front: log(x³) = 3 log x.
- **Applying the power property to a whole sum.** log(x + 1)² = 2 log(x + 1), but (log x)² is not 2 log x.
- **Forgetting the domain.** log₂(x − 3) has asymptote x = 3, not x = 0; ln(x²) and 2 ln x have different domains.
- **Calling the log graph concave up** because it rises. It rises at a decreasing rate, so it is concave down (for b > 1).

## Where this goes next

Week 16 uses these properties to solve exponential and logarithmic equations: take a log of both sides to bring an unknown exponent down, or condense a sum of logs into one log and rewrite it in exponential form, checking for extraneous solutions that the domain rules out. Week 17 uses the "multiply inputs, add outputs" signature to recognise logarithmic data, and log properties to turn exponential data into a straight line on a semi-log plot.

## Self-check

1. Describe the graph of y = −2 log₃ x: domain, range, asymptote, intercept, increasing or decreasing, and concavity, with limit statements for both ends of the domain.
2. Expand ln(x³√(y)/e²) and condense log₂ 5 + 3 log₂ x − log₂(x − 1).
3. A table has x = 2, 6, 18, 54 and y = 1, 3, 5, 7. Explain why it suggests a logarithmic model, and write one.
4. Use change of base to write log₂₇ x as a multiple of log₃ x, and describe the graphical relationship.
5. Explain, using a property of logarithms, why the graph of y = log(50x) is a vertical translation of y = log x, and find the size of the translation to the nearest hundredth.

---

*Original study material for this course, organised around the College Board AP Precalculus Course and Exam Description (Unit 2, Topics 2.11–2.12). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). AP® is a trademark of the College Board, which does not endorse this material.*
