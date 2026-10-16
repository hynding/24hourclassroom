# Week 18 · What Is a Logarithm?

**Lessons:** 4.9 What is a Logarithm? · 4.10 Interpreting and Writing Logarithmic Equations · 4.11 Evaluating Logarithmic Expressions
**Practices:** MP6 (attend to precision), MP7 (look for structure), MP2 (reason abstractly and quantitatively)
**Built from:** IM Algebra 2, Unit 4, Lessons 9–11, in our own words
**Spiral:** Last week's bracketing of 10ˣ = 50 between 1 and 2 is exactly the estimate of log(50). The exact values come from the rational and negative exponents of Unit 3: log₄ 2 = 1/2 because 4^(1/2) = 2, and log₃(1/9) = −2 because 3⁻² = 1/9.

## What you need to be able to do

- **4.9** Explain what the base-10 logarithm of a number means (the exponent you raise 10 to in order to get the number), read it from a table of powers of 10, and estimate it between integers.
- **4.10** Translate freely between exponential form bˣ = y and logarithmic form log_b(y) = x, with any base, and interpret a logarithmic equation in words.
- **4.11** Evaluate logarithms exactly when the answer is an integer or a simple fraction, including negative values, use technology for the rest, and explain why log of 0 or of a negative number is undefined.

## Key terms

| Term | Meaning |
|---|---|
| Logarithm base b | log_b(y) is the exponent x such that bˣ = y. "log base 2 of 8 is 3" because 2³ = 8. |
| Common logarithm | log(y) with no base written means base 10. log(1000) = 3. |
| Exponential form / logarithmic form | 2⁵ = 32 and log₂(32) = 5 say the same thing. |
| Argument | The input y in log_b(y); it must be positive. |
| Base | The number b, positive and not 1. |

## The question a logarithm answers (4.9)

Last week, 10ˣ = 50 could only be bracketed: 10¹ < 50 < 10². The exact exponent exists; we give it a name. **log(50)** is the number x with 10ˣ = 50, about 1.699.

A table of powers of 10 is the fastest way to see what log does:

| y | 0.001 | 0.01 | 0.1 | 1 | 10 | 100 | 1000 | 10,000 |
|---|---|---|---|---|---|---|---|---|
| log(y) | −3 | −2 | −1 | 0 | 1 | 2 | 3 | 4 |

Read it in either direction: log(1000) = 3 because 10³ = 1000; log(0.01) = −2 because 10⁻² = 0.01; log(1) = 0 because 10⁰ = 1. Numbers between the columns have logs between the integers:

- log(50) is between 1 and 2 (≈ 1.699).
- log(300) is between 2 and 3 (≈ 2.477).
- log(7) is between 0 and 1 (≈ 0.845).
- log(0.5) is between −1 and 0 (≈ −0.301).
- log(2000) is between 3 and 4 (≈ 3.301).

**Worked example.** Without a calculator, order log(45), log(2000), log(0.3) and log(1) from smallest to largest.

log(0.3) is negative (0.3 < 1); log(1) = 0; log(45) is between 1 and 2; log(2000) is between 3 and 4. Order: log(0.3) < log(1) < log(45) < log(2000).

**Try it.**
1. Give log(100,000) and log(0.0001) exactly.
2. Between which integers is log(650)?

*Answers:* 1. 5; −4. 2. 100 < 650 < 1000, so 2 < log(650) < 3 (≈ 2.81).

## Reading and writing logarithmic equations (4.10)

Every exponential equation has a logarithmic twin, and vice versa:

| Exponential form | Logarithmic form | In words |
|---|---|---|
| 10³ = 1000 | log(1000) = 3 | 10 to the 3 is 1000 |
| 5³ = 125 | log₅(125) = 3 | 5 to the 3 is 125 |
| 2⁻⁴ = 1/16 | log₂(1/16) = −4 | 2 to the −4 is 1/16 |
| 4^(1/2) = 2 | log₄(2) = 1/2 | 4 to the 1/2 is 2 |
| 10ˣ = 300 | log(300) = x | the exponent on 10 that gives 300 |
| 2ˣ = 40 | log₂(40) = x | the exponent on 2 that gives 40 |

The pattern: **log_b(y) = x means bˣ = y.** The base stays the base; the answer of the log is the exponent. Bases can be any positive number other than 1; base 2 and base 10 are the most common in this unit, and base e arrives next week.

**Worked example.** Rewrite log₃(81) = 4 in exponential form and log₉(27) = 3/2 in exponential form.

3⁴ = 81. 9^(3/2) = 27 (since √9 = 3 and 3³ = 27).

**Worked example.** A population satisfies 2ᵗ = 40 after t hours. Write t with a logarithm and estimate it.

t = log₂(40). Since 2⁵ = 32 < 40 < 64 = 2⁶, t is between 5 and 6 (about 5.32).

**Try it.**
1. Write 7² = 49 and 8^(1/3) = 2 in logarithmic form.
2. Write log(0.001) = −3 and log₆(36) = 2 in exponential form.

*Answers:* 1. log₇(49) = 2; log₈(2) = 1/3. 2. 10⁻³ = 0.001; 6² = 36.

## Evaluating logarithms (4.11)

**Exact values.** Ask "the base to what power gives the argument?" and use everything you know about exponents.

| Expression | Think | Value |
|---|---|---|
| log₂(8) | 2 to what is 8? | 3 |
| log₂(32) | 2⁵ = 32 | 5 |
| log₃(81) | 3⁴ = 81 | 4 |
| log₅(125) | 5³ = 125 | 3 |
| log(10,000) | 10⁴ | 4 |
| log(0.001) | 10⁻³ | −3 |
| log₃(1/81) | 3⁻⁴ = 1/81 | −4 |
| log₂(0.125) | 2⁻³ = 1/8 | −3 |
| log₂(0.25) | 2⁻² | −2 |
| log₄(2) | 4^(1/2) = 2 | 1/2 |
| log₈(2) | 8^(1/3) = 2 | 1/3 |
| log₉(27) | 9^(3/2) = 27 | 3/2 |
| log₁₆(8) | 16^(3/4) = 8 | 3/4 |
| log₂(√2) | 2^(1/2) | 1/2 |
| log_b(1) | b⁰ = 1 | 0 for every base |
| log_b(b) | b¹ = b | 1 for every base |

**With technology.** When no exact exponent exists, a calculator gives a decimal: log(50) ≈ 1.699, log(2000) ≈ 3.301, log(45) ≈ 1.653, log₂(12) ≈ 3.585, log₃(40) ≈ 3.358. Always sanity-check against a bracket: log₂(12) must lie between log₂(8) = 3 and log₂(16) = 4.

**What is undefined.** log(0) and log(−100) have no value: 10ˣ is positive for every real x, so no exponent produces 0 or a negative number. The argument of a logarithm must be positive. On the other hand, a *negative answer* is fine: log(0.5) ≈ −0.301, because 0.5 is between 0 and 1 and a power of 10 below 1 needs a negative exponent.

**Worked example.** Evaluate log₂(1/√2).

1/√2 = 2^(−1/2), so log₂(1/√2) = −1/2.

**Worked example.** Explain why log₅(10) is between 1 and 2 and closer to 1.

5¹ = 5 < 10 < 25 = 5². Since 10 is 2 · 5 and √(5 · 25) ≈ 11.2 is the geometric midpoint, 10 sits below the midpoint, so the log is below 1.5 (it is about 1.43).

**Try it.**
1. Evaluate log₅(1/25), log₂₅(5), log(0.1) and log₇(7).
2. Which of these is undefined: log(0.001), log(0), log(−1), log(1)?
3. Use a calculator for log(7) and check it against a bracket.

*Answers:* 1. −2; 1/2; −1; 1. 2. log(0) and log(−1). 3. ≈ 0.845, between log(1) = 0 and log(10) = 1.

## Common mistakes

- **Reading log_b(y) as b divided by y or y divided by b.** It is an exponent.
- **Swapping base and argument.** log₄(2) = 1/2, but log₂(4) = 2.
- **Thinking log of a small number is undefined.** log(0.001) = −3 is perfectly fine; only 0 and negatives are off limits.
- **Writing log(1000) = 1000 or 100.** It is 3.
- **Mixing up log₈(2) with 8/2.** 8^(1/3) = 2, so it is 1/3.

## Where this goes next

Next week introduces the number e and the natural logarithm ln, then uses logarithms of any base to solve exponential equations exactly (4.14): the answer to 2ᵗ = 40 becomes t = log₂(40) ≈ 5.32 with no bracketing needed.

## Self-check

1. Explain in a sentence what log(400) means and bracket it between two integers.
2. Write 3⁵ = 243 and log₂(1/8) = −3 in the other form.
3. Evaluate log₆(216), log₂(1/64), log₂₇(3) and log₄(32).
4. Explain why log(−3) is undefined but log(0.003) is not.
5. Order log₂(10), log₃(10) and log₁₀(10) without a calculator.

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Algebra 2, Unit 4, Lessons 9–11, https://im.kendallhunt.com/HS/teachers/3/4/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
