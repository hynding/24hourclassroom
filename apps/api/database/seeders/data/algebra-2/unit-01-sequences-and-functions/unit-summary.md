# Unit 1 · Sequences and Functions · The night-before sheet

**Exam weight:** about 8–10% of the final · **Lessons:** 1.1 A Towering Sequence · 1.2 Introducing Geometric Sequences · 1.3 Different Types of Sequences · 1.4 Using Technology to Work with Sequences · 1.5 Sequences are Functions · 1.6 Representing Sequences · 1.7 Representing More Sequences · 1.8 The nth Term · 1.9 What's the Equation? · 1.10 Situations and Sequence Types · 1.11 Adding Up
**Practices:** MP2, MP4, MP7, MP8
**Built from:** IM Algebra 2, Unit 1, in our own words

## The ideas that generate every question

1. **A sequence is a function on the whole numbers.** Input a position n, output a term a(n). The graph is separate dots. The domain starts at 1 or at 0, and you must say which, because the formula depends on it.
2. **Two special kinds.** Arithmetic: add the same d each step (points on a line). Geometric: multiply by the same r each step (points on an exponential curve). Test both with differences and ratios; a constant sequence is both; most sequences are neither.
3. **Two ways to define a sequence.** Recursive: a starting value plus a rule from a(n − 1) to a(n); natural for processes and spreadsheets. Explicit: a(n) directly from n; natural for distant terms and for solving a(n) = value.
4. **Counting steps gives the explicit formulas.** From a(1) to a(n) is n − 1 steps: a(n) = a(1) + (n − 1)d or a(1) · rⁿ⁻¹. From a(0) it is n steps: a(0) + nd or a(0) · rⁿ.
5. **Situations tell you the type.** "Adds 36 a year" is arithmetic. "Grows 4% a year" is geometric (× 1.04). Percent change always multiplies. Every model has a range of n beyond which it is nonsense.
6. **Totals are partial sums.** Arithmetic: pair first with last, S(n) = n(a(1) + a(n))/2. Geometric: list terms or spot the pattern (1 + 2 + … + 2ⁿ⁻¹ = 2ⁿ − 1); the general formula arrives in Unit 2.

## Key formulas and procedures

| Want | Do this |
|---|---|
| Common difference | d = a(n) − a(n − 1); from two terms k steps apart, d = (change in value)/k |
| Common ratio | r = a(n)/a(n − 1); two steps apart, r² = later/earlier, and the signs of the terms decide ± |
| Recursive definition | a(1) = first term; a(n) = a(n − 1) + d or a(n) = r · a(n − 1) |
| nth term, domain from 1 | a(n) = a(1) + (n − 1)d or a(n) = a(1) · rⁿ⁻¹ |
| nth term, domain from 0 | a(n) = a(0) + nd or a(n) = a(0) · rⁿ |
| Which term equals a value | Set the explicit formula equal to the value and solve for n (for geometric, write the value as a(1) times a power of r) |
| First term past a target | Generate terms with a spreadsheet or calculator (Ans rule) until you pass it |
| Sum of n arithmetic terms | Find a(n) first, then S(n) = n(a(1) + a(n))/2 |
| Number of terms in a sum | Solve a(n) = last term for n before summing |
| Sum of geometric terms | Add them up, or use the pattern first term × (rⁿ − 1)/(r − 1) when r = 2 (sums are a(1)(2ⁿ − 1)) |

## The classification test, every time

| Check | 3, 6, 12, 24 | 3, 6, 9, 12 | 3, 6, 10, 15 |
|---|---|---|---|
| Differences | 3, 6, 12 | 3, 3, 3 | 3, 4, 5 |
| Ratios | 2, 2, 2 | 2, 1.5, 1.33 | 2, 1.67, 1.5 |
| Verdict | geometric, r = 2 | arithmetic, d = 3 | neither |

Check *every* consecutive pair you are given. Two equal differences prove nothing.

## Common errors

- **Ratio upside down.** r is later term ÷ earlier term. For 80, 20, 5, r = 1/4.
- **Exponent n instead of n − 1** when the first term is a(1). Test the formula at the first index.
- **Simplified constant mistaken for the first term.** In 6n + 5 the first term is 11; 5 is a(0).
- **Percent change treated as addition.** "Loses 8% a day" is × 0.92, not − 8.
- **Sum formula applied to a geometric sequence.** The pairing trick needs equal gaps.
- **Wrong term count in a sum.** 2, 5, …, 152 has 51 terms, not 50.
- **Connecting the dots** on a sequence graph.
- **Trusting a model beyond its range**: negative prices, millions of rabbits.

## Worked examples

**1. From two terms to everything.** A geometric sequence has a(3) = 20 and a(5) = 5, all terms positive. r² = 5/20 = 1/4, so r = 1/2. a(1) = 20 ÷ (1/2)² = 80. Explicit: a(n) = 80 · (1/2)ⁿ⁻¹. Recursive: a(1) = 80, a(n) = a(n − 1)/2. a(8) = 80/128 = 0.625.

**2. Which term?** For 4, 11, 18, 25, …, which term is 361? a(n) = 4 + 7(n − 1) = 361 → 7(n − 1) = 357 → n = 52. Sum of those 52 terms: S = 52 · (4 + 361)/2 = 52 · 182.5 = 9490.

**3. Model and judge.** A $12,000 machine loses 18% of its value a year: v(n) = 12000 · 0.82ⁿ. After 5 years v(5) = 12000 · 0.3707 ≈ $4,448. If instead it lost $1,800 a year: v(n) = 12000 − 1800n, which reaches 0 at n = 6.67 and is meaningless after that. The geometric model never hits zero and fits resale values better.

**4. Tower of Hanoi.** Moves for n discs: a(1) = 1, a(n) = 2·a(n − 1) + 1, equivalently a(n) = 2ⁿ − 1. The partial sums of 1 + 2 + 4 + … are the same numbers, which is why 2ⁿ − 1 keeps turning up.

## What to review from earlier units

This is the first unit, so the only prerequisites are Algebra 1: evaluating expressions with exponents (2⁹ = 512, 0.75³ = 0.421875), solving linear equations such as 4 + 7(n − 1) = 361, slope as rise over run, and the difference between linear growth (constant rate) and exponential growth (constant factor). If any of those feel shaky, redo the Try-it sets in the week 2 guide.

## Exam-night checklist

- Can you classify a sequence and justify it with both differences and ratios?
- Can you write both a recursive and an explicit definition from a table, a graph, or a description, and check it at the first term?
- Do you know what changes when the domain starts at 0?
- Can you solve a(n) = value for n in both kinds of sequence?
- Can you explain the pairing argument for the arithmetic sum formula and count the terms correctly?
- Can you say when a model stops making sense, and why percent change is multiplicative?

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Algebra 2, Unit 1, Lessons 1–11, https://im.kendallhunt.com/HS/teachers/3/1/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
