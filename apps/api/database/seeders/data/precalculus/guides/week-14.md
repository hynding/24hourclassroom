# Week 14 · Logarithmic Expressions and Inverses of Exponentials

**Topics:** 2.9 Logarithmic Expressions · 2.10 Inverses of Exponential Functions
**Practices:** 1 (procedural and symbolic fluency), 2 (multiple representations), 3 (communication and reasoning)
**Framework:** AP Precalculus CED, Unit 2, Topics 2.9–2.10, learning objectives in our own words
**Spiral:** Week 13's inverse functions (swap inputs and outputs, reflect over y = x, check f(g(x)) = x) are the whole engine of this week. Week 11's exponential functions f(x) = abˣ and exponent rules supply the facts that logarithms reverse. From Algebra 2: negative and fractional exponents, such as 2⁻³ = 1/8 and 8^(2/3) = 4.

## What you need to be able to do

- **2.9** Rewrite a statement about an exponent as a statement about a logarithm and back again: log_b c = a means exactly bᵃ = c.
- **2.9** Evaluate a logarithm without a calculator when its argument is a recognisable power of the base, including negative and fractional answers, and estimate it between two integers when it is not.
- **2.9** Use the common logarithm (base 10, written log x) and the natural logarithm (base e, written ln x), and know what log 1, log_b b and log_b(bᵏ) are for any base.
- **2.9** Read and place values on a logarithmic scale, where equal steps mean multiplying by the base rather than adding.
- **2.10** Explain why y = log_b x is the inverse of y = bˣ, and use that to swap input–output pairs between the two functions in tables, graphs and formulas.
- **2.10** State and compare the domain, range, intercepts and asymptotes of an exponential function and its logarithmic inverse.
- **2.10** Simplify compositions such as log_b(bˣ) and b^(log_b x), and say for which inputs each one equals x.

## Key terms

| Term | Meaning |
|---|---|
| Logarithm | log_b c is the exponent you put on b to get c. log_b c = a ⟺ bᵃ = c. |
| Base | The number b being raised to a power; it must satisfy b > 0 and b ≠ 1. |
| Argument | The number c inside the logarithm; it must be positive for log_b c to be a real number. |
| Common logarithm | Base 10, written log x with no subscript. log 1000 = 3. |
| Natural logarithm | Base e ≈ 2.71828, written ln x. ln e⁴ = 4. |
| Logarithmic scale | A number line where equal distances mean equal multiplicative factors (1, 10, 100, 1000 equally spaced). |
| Inverse function | g is the inverse of f when g(f(x)) = x for every x in the domain of f and f(g(x)) = x for every x in the domain of g. |
| One-to-one | Every output comes from exactly one input; this is what lets a function have an inverse. |

## A logarithm is an exponent (2.9)

Suppose 2ˣ = 32. You know 2⁵ = 32, so x = 5. Now suppose 2ˣ = 20. No whole number works: 2⁴ = 16 is too small and 2⁵ = 32 is too big. The answer exists, somewhere between 4 and 5, and it needs a name. That name is log₂ 20.

**Definition.** For b > 0, b ≠ 1 and c > 0,

log_b c = a  means exactly  bᵃ = c.

Read log₂ 32 as "the exponent on 2 that gives 32", which is 5. Every logarithm statement is an exponential statement in disguise, and the conversion is the single most useful skill this week. Notice where each number goes: the base stays the base, the logarithm is the exponent, and the argument is the result.

| Exponential form | Logarithmic form |
|---|---|
| 3⁴ = 81 | log₃ 81 = 4 |
| 10⁻² = 0.01 | log 0.01 = −2 |
| 9^(1/2) = 3 | log₉ 3 = 1/2 |
| e⁰ = 1 | ln 1 = 0 |
| 5ˣ = 40 | x = log₅ 40 |

Three facts follow straight from the definition and hold for every allowed base:

- log_b 1 = 0, because b⁰ = 1.
- log_b b = 1, because b¹ = b.
- log_b(bᵏ) = k, because the exponent on b that gives bᵏ is k.

Why the restrictions? If b = 1 every power of b is 1, so log₁ 7 would have no answer and log₁ 1 would have every answer. If b were negative, powers like (−2)^(1/2) are not real. And since bᵃ > 0 for every real a when b > 0, there is no exponent that produces 0 or a negative number: log₂ 0 and log₂(−8) are undefined.

**Worked example.** Evaluate log₂₇ 9 without a calculator.

Let a = log₂₇ 9, so 27ᵃ = 9. Write both sides as powers of 3: (3³)ᵃ = 3², so 3^(3a) = 3² and 3a = 2. Therefore log₂₇ 9 = 2/3. Check: 27^(2/3) = (∛27)² = 3² = 9.

**Worked example.** Evaluate log₄(1/64).

4ᵃ = 1/64 = 4⁻³, so the answer is −3. A logarithm is negative exactly when the argument is between 0 and 1 (for a base greater than 1).

**Worked example.** Between which two consecutive integers does log₅ 40 lie?

5² = 25 and 5³ = 125, and 25 < 40 < 125. Because larger exponents give larger powers of 5, the exponent that gives 40 is between 2 and 3. (A calculator gives about 2.29.)

**Try it.**
1. Evaluate log₃(1/9), log₁₆ 4 and log₈ 32.
2. Rewrite 7ᵗ = 50 in logarithmic form and say which two integers t lies between.
3. Rewrite log_x 125 = 3 in exponential form and find x.

*Answers:* 1. −2, 1/2, 5/3 (8^(5/3) = 2⁵ = 32). 2. t = log₇ 50; 7² = 49 < 50 < 343 = 7³, so t is between 2 and 3 (just above 2). 3. x³ = 125, so x = 5.

## Common and natural logarithms (2.9)

Two bases appear so often that they have their own keys on every scientific calculator.

- **Common logarithm:** log x means log₁₀ x. So log 10,000 = 4, log 0.001 = −3 and log √10 = 1/2.
- **Natural logarithm:** ln x means log_e x, where e ≈ 2.71828 is the base you met in week 11 for continuous growth. So ln e = 1, ln e⁻² = −2 and ln 1 = 0.

The common log has a useful size interpretation: if a positive number N lies between 10ᵏ and 10^(k+1), then log N lies between k and k + 1. For example 3,500 is between 10³ and 10⁴, so log 3,500 is between 3 and 4 (it is about 3.544). A whole number with d digits has a common log between d − 1 and d.

When an answer is not a neat power, you leave it exact (log 50, ln 7) or give a decimal from a calculator: log 50 ≈ 1.699 and ln 10 ≈ 2.303.

**Worked example.** Without a calculator, order ln 1, log 0.5, log₂ 8 and ln e^2.5 from smallest to largest.

log 0.5 is negative (argument between 0 and 1). ln 1 = 0. ln e^2.5 = 2.5. log₂ 8 = 3. So log 0.5 < ln 1 < ln e^2.5 < log₂ 8.

**Try it.**
1. Evaluate log 100,000, log 0.1 and ln(1/e³).
2. Between which two integers is log 72,000?

*Answers:* 1. 5, −1, −3. 2. 72,000 is between 10⁴ and 10⁵, so between 4 and 5.

## Logarithmic scales (2.9)

On an ordinary (linear) number line, moving one unit to the right adds 1. On a base-10 logarithmic scale, moving one unit to the right multiplies by 10. The positions on the scale are the logarithms of the values:

| Position on the scale | 0 | 1 | 2 | 3 | 4 |
|---|---|---|---|---|---|
| Value represented | 1 | 10 | 100 | 1,000 | 10,000 |

Log scales are used when the quantities being compared range over many powers of ten, such as the sizes of objects from bacteria to planets, sound intensities, or acidity. A linear scale would squash almost everything into one end; a log scale spreads the values out so that each factor of 10 gets the same room.

The key consequence: **a difference in position is a ratio of values.** If two values sit at positions p and q on a base-10 log scale, the larger is 10^(q − p) times the smaller.

**Worked example.** On a base-10 log scale, a hypothetical sample A sits at position 1.3 and sample B at 3.3. How do their values compare? What value does position 2.5 represent?

The positions differ by 2, so B's value is 10² = 100 times A's value. Position 2.5 represents 10^2.5 = 100 · √10 ≈ 316, which is not halfway between 100 and 1,000 in value even though it is halfway in position.

**Worked example.** A value of 40 is marked on a base-10 log scale. Where is it placed?

At position log 40 ≈ 1.602, a little more than halfway between the marks for 10 and 100 (positions 1 and 2).

**Try it.**
1. On a base-10 log scale, point P is at 0.7 and point Q at 4.7. How many times larger is Q's value?
2. On a base-2 log scale, what values are represented by positions 3 and 7, and how do they compare?

*Answers:* 1. 10⁴ = 10,000 times. 2. 2³ = 8 and 2⁷ = 128; the second is 2⁴ = 16 times the first.

## Logarithms undo exponentials (2.10)

The exponential function f(x) = bˣ (b > 0, b ≠ 1) is always increasing (if b > 1) or always decreasing (if 0 < b < 1). Either way it never repeats an output, so it is one-to-one and has an inverse. By the definition of a logarithm, if y = bˣ then x = log_b y. Swapping the names of the variables, as in week 13, gives the inverse function:

**The inverse of f(x) = bˣ is f⁻¹(x) = log_b x.**

Everything about the pair comes from swapping inputs and outputs:

| | y = 2ˣ | y = log₂ x |
|---|---|---|
| Sample points | (−2, 1/4), (−1, 1/2), (0, 1), (1, 2), (3, 8) | (1/4, −2), (1/2, −1), (1, 0), (2, 1), (8, 3) |
| Domain | all real numbers | x > 0 |
| Range | y > 0 | all real numbers |
| Intercept | vertical intercept (0, 1) | horizontal intercept (1, 0) |
| Asymptote | horizontal, y = 0 | vertical, x = 0 |
| Graph | rises slowly on the left, steeply on the right | rises steeply near x = 0, slowly on the right |

The graph of y = log₂ x is the reflection of the graph of y = 2ˣ across the line y = x. The horizontal asymptote of the exponential becomes the vertical asymptote of the logarithm, because swapping x and y turns "y approaches 0" into "x approaches 0".

The same holds for any base: y = log_b x passes through (1, 0) and (b, 1), mirroring (0, 1) and (1, b) on y = bˣ. The inverse of y = eˣ is y = ln x; the inverse of y = 10ˣ is y = log x. For a base between 0 and 1, such as y = (1/2)ˣ, the exponential decreases, and so does its inverse y = log_(1/2) x.

Because the functions are inverses, each undoes the other:

- log_b(bˣ) = x for **every** real x (bˣ is always positive, so the log is defined).
- b^(log_b x) = x for **x > 0 only** (log_b x is undefined otherwise).

**Worked example.** The table shows values of f(x) = 3ˣ. Make a table for g = f⁻¹ and evaluate g(81) and g(1/9).

| x | −2 | −1 | 0 | 1 | 2 | 4 |
|---|---|---|---|---|---|---|
| f(x) | 1/9 | 1/3 | 1 | 3 | 9 | 81 |

Swap the rows: g(1/9) = −2, g(1/3) = −1, g(1) = 0, g(3) = 1, g(9) = 2, g(81) = 4. Here g(x) = log₃ x, and indeed log₃ 81 = 4 and log₃(1/9) = −2.

**Worked example.** The graph of an exponential function y = bˣ passes through (2, 16). Find b, then give two points on the graph of its inverse and evaluate the inverse at 64.

b² = 16 with b > 0, so b = 4. The inverse is y = log₄ x, which passes through (1, 0) and (16, 2) (swap (0, 1) and (2, 16)). log₄ 64 = 3 because 4³ = 64.

**Worked example.** Simplify 7^(log₇ 12), log₃(3⁻⁵), e^(ln 4) and ln(e^(2x)).

The functions undo each other: 12, −5, 4 and 2x.

**Worked example.** A hypothetical culture is modelled by N(t) = 2ᵗ thousand cells after t hours. Write t as a function of N and interpret t(32).

Solve N = 2ᵗ for t: t = log₂ N. t(32) = log₂ 32 = 5, so the culture reaches 32 thousand cells after 5 hours. The inverse function answers the reverse question: given a size, when is it reached?

**Try it.**
1. State the domain, range and asymptote of y = log₅ x and of its inverse.
2. If h(x) = 10ˣ, evaluate h⁻¹(0.01) and h⁻¹(√10).
3. Simplify 2^(log₂ 9) and log(10^(x+3)).

*Answers:* 1. log₅ x: domain x > 0, range all reals, vertical asymptote x = 0. Its inverse 5ˣ: domain all reals, range y > 0, horizontal asymptote y = 0. 2. −2 and 1/2. 3. 9 and x + 3.

## Calculator notes

Every graphing calculator has a LOG key (base 10) and an LN key (base e). Many also have a logBASE template for other bases; if yours does not, week 15's change-of-base formula, log_b x = ln x / ln b, does the job. On the AP exam's no-calculator section, expect arguments that are exact powers of the base (log₂ 32, log₉ 27, ln e⁵) or questions that only ask for an estimate between integers. To see the reflection, graph y = 2ˣ, y = log₂ x and y = x in a square window; the first two are mirror images in the third.

## Common mistakes

- **Treating log_b c as a division.** log₂ 8 is 3 (the exponent), not 8/2 = 4.
- **Mixing up which number is the exponent.** In log₉ 3 = 1/2 the exponent is 1/2: 9^(1/2) = 3, not 3² = 9.
- **Taking the log of zero or a negative number.** No real exponent makes bᵃ ≤ 0, so these are undefined. The log itself can be negative; the argument cannot.
- **Thinking an inverse is a reciprocal.** The inverse of 2ˣ is log₂ x, not 1/2ˣ = 2⁻ˣ.
- **Reading a log scale as if it were linear.** Halfway between the marks for 100 and 1,000 is about 316, not 550.
- **Forgetting the domain restriction on b^(log_b x) = x.** It only works for x > 0.

## Where this goes next

Week 15 studies y = log_b x as a function in its own right: its graph, concavity and end behaviour, and the product, quotient and power properties that let you rewrite log expressions (and that make a horizontal dilation of a log graph the same as a vertical translation). Week 16 uses logarithms to solve exponential equations such as 5ˣ = 40 exactly and finds inverses of transformed exponential and logarithmic functions algebraically. Week 17 puts logarithmic scales to work in models and semi-log plots.

## Self-check

1. Evaluate log₂(1/32), log₂₅ 5, log 0.0001 and ln e^(−0.5) without a calculator.
2. Rewrite 4ᵏ = 30 in logarithmic form and state which two consecutive integers k lies between.
3. On a base-10 log scale, values X and Y sit at positions 2.2 and 5.2. Compare X and Y, and explain why position 3.7 does not represent the value halfway between 1,000 and 10,000.
4. The graph of y = bˣ passes through (3, 1/8). Find b, then state three points on the graph of the inverse and its domain, range and asymptote.
5. For which x is 10^(log x) = x true, and for which x is log(10ˣ) = x true? Explain the difference.

---

*Original study material for this course, organised around the College Board AP Precalculus Course and Exam Description (Unit 2, Topics 2.9–2.10). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). AP® is a trademark of the College Board, which does not endorse this material.*
