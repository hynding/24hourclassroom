# Week 24 · A Different Kind of Change: Quadratic Patterns

**Lessons:** 6.1 A Different Kind of Change · 6.2 How Does it Change? · 6.3 Building Quadratic Functions from Geometric Patterns · 6.4 Comparing Quadratic and Exponential Functions
**Practices:** MP7 (find structure in a growing pattern), MP8 (turn repeated reasoning into an expression with n²), MP3 (argue which function eventually grows faster)
**Built from:** IM Algebra 1, Unit 6, Lessons 1–4, in our own words
**Spiral:** Unit 5 sorted patterns by constant difference (linear) or constant ratio (exponential). This week a third pattern appears, where the differences themselves change by a constant amount. The comparison lesson reuses the tables and average rates of change of weeks 21 and 23.

## What you need to be able to do

- **6.1** Recognise a pattern in which the change is neither constant nor a constant multiple, and describe it in words and tables.
- **6.2** Identify quadratic change through second differences, and distinguish linear, exponential and quadratic tables.
- **6.3** Write an expression for the number of squares (or dots, or tiles) in step n of a geometric pattern, using n², and check it against the figures.
- **6.4** Compare a quadratic function with an exponential one over a range of inputs and explain why the exponential function eventually exceeds the quadratic.

## Key terms

| Term | Meaning |
|---|---|
| Quadratic expression | An expression whose highest power of the variable is 2, such as n² + 3n or 2x² − 5. |
| Quadratic function | A function defined by a quadratic expression, such as f(n) = n² + 1. |
| First differences | The changes between consecutive outputs in a table with equally spaced inputs. |
| Second differences | The changes between consecutive first differences; constant for a quadratic function. |
| Step n of a pattern | The nth figure; the expression gives how many pieces it has. |

## A different kind of change (6.1)

A square patio of side n metres uses n² tiles. Steps 1, 2, 3, 4, 5 use 1, 4, 9, 16, 25 tiles. The increases are 3, 5, 7, 9: not constant, so not linear. The ratios are 4, 2.25, 1.78, 1.56: not constant, so not exponential. But the increases themselves go up by 2 each time. That is the signature of quadratic change.

Another: a ball dropped from a cliff falls 5t² metres in t seconds. After 1, 2, 3, 4 seconds: 5, 20, 45, 80 metres. Increases 15, 25, 35: each 10 more than the last.

**Worked example.** A table shows 2, 5, 10, 17, 26 for x = 0, 1, 2, 3, 4. Describe the change.
First differences 3, 5, 7, 9; second differences 2, 2, 2. Quadratic. (It is x² + 1.)

**Try it.** For the outputs 0, 3, 8, 15, 24 at x = 0 to 4, find the first and second differences.
*Answers:* 3, 5, 7, 9; then 2, 2, 2.

## How does it change? (6.2)

For equally spaced inputs:

| Pattern | Test | Example |
|---|---|---|
| Linear | first differences constant | 4, 7, 10, 13 (differences 3, 3, 3) |
| Exponential | ratios constant | 4, 8, 16, 32 (ratios 2, 2, 2) |
| Quadratic | second differences constant (and non-zero) | 4, 7, 12, 19 (differences 3, 5, 7; second differences 2, 2) |

A quadratic function's graph is a curve that bends one way throughout, a parabola; for f(x) = x² it is a U that is symmetric about the y-axis. We study the graph properly in weeks 26 and 27; this week the table is the tool.

**Worked example.** Classify 3, 6, 12, 24, 48 and 3, 6, 11, 18, 27.
First: ratios 2 each time, exponential. Second: differences 3, 5, 7, 9, second differences 2, quadratic.

**Worked example.** Classify 10, 16, 24, 34, 46.
Differences 6, 8, 10, 12; second differences 2: quadratic.

**Try it.** Classify 1, 3, 9, 27 and 1, 3, 7, 13, 21.
*Answers:* Exponential (×3); quadratic (differences 2, 4, 6, 8).

## Building quadratic functions from patterns (6.3)

A pattern of squares: step 1 is a single square with one extra square on top; step 2 is a 2 × 2 block with two extra on top; step n is an n × n block with n extra. Number of squares: n² + n. Check: step 1, 2; step 2, 6; step 3, 12.

Strategies:

- **See the structure.** A square block gives n². A row or column of extras gives + n or + a constant. Two blocks give 2n².
- **Use the table.** If the second differences are 2, the expression contains n² (exactly 1 · n²); if they are 4, it contains 2n²; in general the coefficient of n² is half the second difference. Then subtract the n² part from the outputs and fit what remains with a linear rule.

**Worked example.** A pattern has 3, 8, 15, 24 squares at steps 1, 2, 3, 4. Find the expression.
Differences 5, 7, 9; second differences 2, so the n² coefficient is 1. Subtract n²: 3 − 1 = 2, 8 − 4 = 4, 15 − 9 = 6, 24 − 16 = 8: that is 2n. Expression: n² + 2n. Structure: an n × n block with two extra columns of n. Check step 4: 16 + 8 = 24.

**Worked example.** Dots arranged as an n × (n + 1) rectangle: n(n + 1) = n² + n. Step 5: 30.

**Worked example.** A square frame of side n (hollow, one tile thick) has 4n − 4 tiles: linear, not quadratic, because only the border grows. A solid square with a 1-tile border on each side has (n + 2)² tiles.

**Try it.** Steps 1, 2, 3 of a pattern have 5, 12, 21 tiles. Find the expression and the step-10 count.
*Answers:* Differences 7, 9; second difference 2, so n² + 4n (check 1 + 4 = 5, 4 + 8 = 12, 9 + 12 = 21); step 10: 140.

## Quadratic versus exponential (6.4)

Compare f(n) = n² and g(n) = 2ⁿ:

| n | 1 | 2 | 3 | 4 | 5 | 6 | 7 | 10 |
|---|---|---|---|---|---|---|---|---|
| n² | 1 | 4 | 9 | 16 | 25 | 36 | 49 | 100 |
| 2ⁿ | 2 | 4 | 8 | 16 | 32 | 64 | 128 | 1,024 |

They are equal at n = 2 and n = 4; between them n² is ahead; from n = 5 on, 2ⁿ is ahead and the gap explodes. The reason: each step adds 2n + 1 to n², an amount that grows linearly, but doubles 2ⁿ, an amount that grows exponentially. However large the quadratic's coefficient, an exponential function with factor greater than 1 wins in the end.

**Worked example.** h(n) = 50n² against k(n) = 1.5ⁿ. At n = 10: 5,000 against about 57.7. At n = 30: 45,000 against about 191,751. Somewhere between, k overtakes h and stays ahead. (Check n = 25: 31,250 against 25,251; n = 26: 33,800 against 37,877. Between 25 and 26.)

**Rates of change.** From 0 to 5, n² changes by 25 (rate 5); 2ⁿ changes by 31 (rate 6.2). From 5 to 10, n² changes by 75 (rate 15); 2ⁿ changes by 992 (rate 198.4). The exponential rate multiplies; the quadratic rate only adds.

**Try it.** Compare 3n² and 3ⁿ at n = 2, 3, 4, 5. Where does the exponential function take over?
*Answers:* 12 vs 9; 27 vs 27; 48 vs 81; 75 vs 243. Equal at n = 3, exponential ahead from n = 4.

## Common mistakes

- Calling a table linear because the first few differences are "close".
- Testing for quadratic with ratios, or for exponential with second differences.
- Writing n² + n when the extra pieces are a constant (n² + 2), or the reverse: check against the figures.
- Taking the second difference itself as the coefficient of n²; it is half the second difference.
- Concluding that the quadratic function wins because it is ahead for small inputs.

## Where this goes next

Week 25 builds quadratic functions for real situations, especially objects thrown or dropped, and introduces equivalent quadratic expressions. Weeks 26 and 27 study the graph, the parabola, and the standard, factored and vertex forms. Unit 7 solves quadratic equations.

## Self-check

1. Classify 5, 8, 13, 20, 29 and 5, 10, 20, 40, 80.
2. Find the first and second differences of n² + 3n for n = 1 to 5.
3. A pattern has 4, 7, 12, 19 tiles at steps 1 to 4. Expression?
4. A pattern has 2, 8, 18, 32 tiles. Expression?
5. At which whole number n does 2ⁿ first exceed n² permanently?

*Answers:* (1) Quadratic (second differences 2); exponential (×2). (2) 4, 10, 18, 28, 40; first differences 6, 8, 10, 12; second differences 2. (3) n² + 3 (differences 3, 5, 7). (4) 2n² (second differences 4). (5) n = 5 (equal at 4, ahead from 5).

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Algebra 1, Unit 6, Lessons 1–4, https://im.kendallhunt.com/HS/teachers/1/6/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
