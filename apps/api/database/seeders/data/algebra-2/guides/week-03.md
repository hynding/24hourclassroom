# Week 03 · Modelling with Sequences and Adding Up Terms

**Lessons:** 1.9 What's the Equation? · 1.10 Situations and Sequence Types · 1.11 Adding Up
**Practices:** MP4 (model with mathematics), MP1 (make sense of problems), MP8 (regularity in repeated reasoning)
**Built from:** IM Algebra 2, Unit 1, Lessons 9–11, in our own words
**Spiral:** The nth-term formulas from week 2 are used in every section. Week 1's test for arithmetic versus geometric decides which formula applies, and the Tower of Hanoi sequence returns in the section on sums.

## What you need to be able to do

- **1.9** Given any representation of a sequence (a few terms, a table, a graph, a description, a recursive rule), write an equation for the nth term, choosing the domain deliberately, and check it against known terms.
- **1.10** Decide from a real situation whether a sequence model is arithmetic (something is added or removed each step), geometric (something is multiplied by a fixed factor each step) or neither, then write and use the model and judge how long the model stays sensible.
- **1.11** Find the sum of the first n terms of a sequence: by adding term by term with a table or spreadsheet, by pairing terms to get the arithmetic sum formula, and by recognising patterns in the partial sums of a geometric sequence.

## Key terms

| Term | Meaning |
|---|---|
| Equation for a sequence | An explicit formula a(n) = … that produces every term from its index. |
| Model | A sequence chosen to represent a real situation; it is only as good as its assumptions. |
| Partial sum | The sum of the first n terms of a sequence, often written S(n) = a(1) + a(2) + … + a(n). |
| Arithmetic sum formula | S(n) = n · (a(1) + a(n)) / 2: the number of terms times the average of the first and last. |
| Gauss pairing | Writing the sum forwards and backwards so every pair of terms adds to the same total. |
| Domain choice | Whether the first term is a(0) or a(1); it changes the formula but not the sequence. |

## Writing the equation (1.9)

Whatever form a sequence comes in, writing its equation takes the same four moves:

1. **Identify the type.** Constant difference → arithmetic. Constant ratio → geometric.
2. **Pick the domain.** Does the first value belong at n = 0 or n = 1? If the situation has a natural "start", use 0; otherwise use 1.
3. **Fill the formula.** Arithmetic: a(n) = a(1) + (n − 1)d or a(0) + nd. Geometric: a(n) = a(1) · rⁿ⁻¹ or a(0) · rⁿ.
4. **Check it** against at least two known values, including the first.

**Worked example.** A graph shows the points (0, 24), (1, 36), (2, 54), (3, 81). Write an equation.

Ratios: 36/24 = 1.5, 54/36 = 1.5, 81/54 = 1.5. Geometric, r = 1.5, and the first point is at n = 0, so a(n) = 24 · 1.5ⁿ. Check: a(3) = 24 · 3.375 = 81.

**Worked example.** A recursive rule says c(1) = 100, c(n) = c(n − 1) − 12. Write the explicit equation and find c(12).

Arithmetic, d = −12, domain starts at 1: c(n) = 100 − 12(n − 1). c(12) = 100 − 12·11 = −32.

**Worked example.** "A plant is 8 cm tall when bought and grows 2.5 cm every week." Write an equation for its height h(n) after n weeks.

Equal amounts are added each week, so it is arithmetic. The purchase height is the natural start: h(0) = 8, and h(n) = 8 + 2.5n. After 10 weeks, h(10) = 33 cm.

**Try it.**
1. Write an equation for the sequence shown in the table n = 1 → 7, n = 2 → 21, n = 3 → 63.
2. Write an equation for the sequence with recursive rule f(0) = 5, f(n) = f(n − 1) + 0.5.
3. A tank holds 500 litres and loses 8% of its water each day. Write an equation for w(n), the water after n days.

*Answers:* 1. a(n) = 7 · 3ⁿ⁻¹. 2. f(n) = 5 + 0.5n. 3. w(n) = 500 · 0.92ⁿ.

## Which kind of sequence fits a situation (1.10)

The decisive question is **what happens between one term and the next**.

| What changes each step | Type | Example |
|---|---|---|
| The same amount is added or subtracted | Arithmetic | $40 deposited every month; one more row of seats; 3 fewer tickets each day |
| The quantity is multiplied by the same factor | Geometric | 5% interest each year (× 1.05); half-life (× 0.5); 20% fewer each round (× 0.8) |
| Neither: the step itself changes in some other way | Neither | triangular numbers 1, 3, 6, 10; Tower of Hanoi 1, 3, 7, 15; square numbers |

Percentages are the common trap. "Loses 8% each day" is multiplicative (× 0.92), because 8% of a shrinking amount is a shrinking amount. "Loses 8 litres each day" is additive (− 8). The first is geometric, the second arithmetic.

**Worked example.** A new phone costs $900. Model A: it loses $150 of value each year. Model B: it loses 25% of its value each year. Compare the two models after 3 years and after 6 years, and comment on which stays sensible longer.

Model A: v(n) = 900 − 150n, so v(3) = 450 and v(6) = 0. Model B: v(n) = 900 · 0.75ⁿ, so v(3) ≈ 379.69 and v(6) ≈ 160.18. Model A hits zero in year 6 and goes negative after that, which is nonsense for a price; Model B keeps a positive, shrinking value, which matches how resale prices behave. Geometric decay usually models depreciation better; arithmetic decay is fine for a short stretch.

**Worked example.** A gym charges a $50 joining fee and $30 a month. Is the total paid after n months an arithmetic or geometric sequence? Write the model.

Each month adds the same $30, so arithmetic: t(0) = 50 (join, no months yet), t(n) = 50 + 30n. After a year, t(12) = $410.

**Limits of models.** A geometric population model such as p(n) = 200 · 1.3ⁿ predicts 200 · 1.3²⁰ ≈ 38,000 rabbits after 20 months, and 7 million after 40 months. Real populations run out of food and space. Always ask for what range of n the model is believable.

**Try it.**
1. A ticket queue shrinks by 15 people every minute. Arithmetic or geometric?
2. A rumour reaches 3 times as many people each hour. Arithmetic or geometric?
3. A 50-litre tank drains 2 litres per minute. Write the model and say when it stops making sense.

*Answers:* 1. Arithmetic (same number removed). 2. Geometric (× 3). 3. w(n) = 50 − 2n; it stops making sense after n = 25, when the tank is empty.

## Adding up the terms (1.11)

Many questions ask for a **total**, not a term: total seats in the theatre, total paid over a year, total distance a bouncing ball travels. That is a partial sum S(n) = a(1) + a(2) + … + a(n).

**By listing.** A spreadsheet with a running-total column does this for any sequence. For 1, 3, 7, 15, 31 the partial sums are 1, 4, 11, 26, 57.

**Arithmetic sequences: pair them up.** To add 7 + 11 + 15 + … + 43 (ten terms, d = 4), write the sum forwards and backwards:

```
  7 + 11 + 15 + ... + 39 + 43
 43 + 39 + 35 + ... + 11 +  7
 -----------------------------
 50 + 50 + 50 + ... + 50 + 50   (ten 50s = 500, which is twice the sum)
```

So the sum is 500/2 = 250. In general, every pair adds to a(1) + a(n), there are n pairs, and we counted everything twice:

**S(n) = n · (a(1) + a(n)) / 2** — the number of terms times the average of the first and last terms.

**Worked example.** The theatre from last week has 18 seats in row 1 and 4 more in each later row, with 20 rows. How many seats in all?

a(1) = 18, a(20) = 18 + 4·19 = 94. S(20) = 20 · (18 + 94)/2 = 20 · 56 = 1120 seats.

**Worked example.** Find 2 + 5 + 8 + … + 152.

First find how many terms: 2 + 3(n − 1) = 152 → n − 1 = 50 → n = 51. Then S(51) = 51 · (2 + 152)/2 = 51 · 77 = 3927.

**Geometric sequences: look for the pattern.** For 1 + 2 + 4 + 8 + 16 the partial sums are 1, 3, 7, 15, 31: each is one less than the next power of 2, so the sum of the first n powers of 2 (starting at 1) is 2ⁿ − 1. For 3 + 6 + 12 + 24 the sums are 3, 9, 21, 45, which is 3 · (2ⁿ − 1). A general formula for geometric sums comes in Unit 2 (lessons 2.25 and 2.26); for now, listing the terms or spotting a pattern is expected.

**Worked example.** A ball is dropped from 2 m and each bounce rises to 50% of the previous height. How far has it travelled vertically when it hits the floor for the fourth time?

Down 2, then up 1 and down 1, up 0.5 and down 0.5, up 0.25 and down 0.25. Total = 2 + 2(1 + 0.5 + 0.25) = 2 + 2 · 1.75 = 5.5 m.

**Try it.**
1. Find the sum of the first 30 terms of 5, 9, 13, …
2. Find 100 + 95 + 90 + … + 5.
3. Find the sum of the first six terms of 2, 6, 18, …

*Answers:* 1. a(30) = 5 + 29·4 = 121; S = 30 · (5 + 121)/2 = 1890. 2. 20 terms; S = 20 · (100 + 5)/2 = 1050. 3. 2 + 6 + 18 + 54 + 162 + 486 = 728.

## Common mistakes

- **Reading "decreases by 10%" as subtract 10.** Percent change multiplies: × 0.9. Only a fixed amount subtracts.
- **Counting terms wrongly in a sum.** The number of terms in 2, 5, …, 152 is 51, not 50; solve a(n) = last term for n before using the sum formula.
- **Using the sum formula on a geometric sequence.** n · (first + last)/2 is for arithmetic sequences only, because it relies on equal gaps.
- **Starting the exponent at the wrong place.** If the first value sits at n = 0, use rⁿ; if at n = 1, use rⁿ⁻¹. Check with the first value every time.
- **Trusting a model forever.** A model that gives negative prices or a billion rabbits has left its useful range.

## Where this goes next

Unit 2 begins with polynomials, and its last two lessons (2.25, 2.26) prove the closed-form formula for a geometric sum, finishing what started here. Unit 4 turns geometric sequences into exponential functions with real-number inputs and uses logarithms to solve "which term?" questions exactly.

## Self-check

1. A table shows n = 0 → 12, n = 1 → 18, n = 2 → 27. Write the equation.
2. A library adds 240 books every year to a collection of 15,000. Arithmetic or geometric? Write the model and find the size after 8 years.
3. Explain why "the population falls by 6% a year" produces a geometric sequence, not an arithmetic one.
4. Use the pairing method to find 4 + 10 + 16 + … + 118.
5. Find the partial sum of the first five terms of 80, 40, 20, … and explain why the sums approach 160.

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Algebra 2, Unit 1, Lessons 9–11, https://im.kendallhunt.com/HS/teachers/3/1/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
