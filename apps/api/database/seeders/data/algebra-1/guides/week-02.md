# Week 02 · Measuring Centre and Spread, by Hand and by Spreadsheet

**Lessons:** 1.5 Calculating Measures of Center and Variability · 1.6 Mystery Computations · 1.7 Spreadsheet Computations · 1.8 Spreadsheet Shortcuts
**Practices:** MP5 (use a spreadsheet as a tool), MP6 (compute precisely and label what you computed), MP8 (notice that a formula repeats down a column)
**Built from:** IM Algebra 1, Unit 1, Lessons 5–8, in our own words
**Spiral:** Week 1's median and quartiles are the backbone of the interquartile range; the dot plots you drew last week are where the mean absolute deviation lives.

## What you need to be able to do

- **1.5** Compute the mean, median, mean absolute deviation (MAD) and interquartile range (IQR) of a small data set by hand, and say what each one measures.
- **1.6** Work out what a spreadsheet formula does from its inputs and outputs, and predict the result of a formula such as `=B2*2+1`.
- **1.7** Write spreadsheet formulas that use cell references and the built-in functions SUM, AVERAGE, MEDIAN, MIN, MAX and COUNT.
- **1.8** Fill a formula down a column so that the references shift, and recognise when a reference should be locked with `$`.

## Key terms

| Term | Meaning |
|---|---|
| Mean | The sum of the values divided by how many there are; the balance point of a dot plot. |
| Median | The middle value of the ordered data (or the mean of the two middle values). |
| Measure of centre | A single number that stands for a "typical" value: the mean or the median. |
| Deviation | The distance of a value from the mean, value − mean (positive or negative). |
| Mean absolute deviation (MAD) | The mean of the absolute values of the deviations: the typical distance from the mean. |
| Interquartile range (IQR) | Q3 − Q1, the width of the box in a box plot: the spread of the middle half. |
| Range | Maximum − minimum. |
| Measure of variability | A number that says how spread out the data are: MAD, IQR, range (and, from week 3, standard deviation). |
| Cell reference | The address of a spreadsheet cell, such as `B4` (column B, row 4). |
| Formula | A spreadsheet entry beginning with `=` that computes a value, e.g. `=A2+A3`. |
| Function | A named built-in computation, such as `=AVERAGE(A2:A21)`. |
| Range (spreadsheet) | A block of cells written `A2:A21`, used as a function's input. |
| Fill down | Copying a formula down a column so that row numbers in its references increase by one per row. |
| Absolute reference | A reference such as `$B$1` that does not change when the formula is copied. |

## Mean, median, MAD and IQR by hand (1.5)

Six students' scores on a 10-point quiz: 4, 6, 7, 8, 9, 10.

**Mean.** Add and divide: (4 + 6 + 7 + 8 + 9 + 10)/6 = 44/6 ≈ 7.33. On a dot plot the mean is the balance point: if the dots were equal weights on a seesaw, it would balance at 7.33.

**Median.** Six values, so the median is the mean of the 3rd and 4th: (7 + 8)/2 = 7.5.

**Mean absolute deviation.** Measure how far each value is from the mean, ignore the signs, and average:

| Value | Deviation from 7.33 | Absolute deviation |
|---|---|---|
| 4 | −3.33 | 3.33 |
| 6 | −1.33 | 1.33 |
| 7 | −0.33 | 0.33 |
| 8 | 0.67 | 0.67 |
| 9 | 1.67 | 1.67 |
| 10 | 2.67 | 2.67 |

Sum of absolute deviations = 10.00, so MAD = 10.00/6 ≈ 1.67. A typical score is about 1.7 points from the mean. (The signed deviations always add to zero, which is why we need absolute values.)

**Interquartile range.** Lower half 4, 6, 7 has median Q1 = 6; upper half 8, 9, 10 has median Q3 = 9. IQR = 9 − 6 = 3. The middle half of the scores spans 3 points.

**Range.** 10 − 4 = 6.

Centre tells you where the data sit; variability tells you how tightly they cluster. Two classes can share a mean of 7.3 while one has every score between 7 and 8 (small MAD, small IQR) and the other has scores from 2 to 10 (large MAD, large IQR). Reporting a centre without a spread is half a description.

**Worked example.** Data: 12, 15, 15, 18, 20, 22, 30. Find the mean, median, MAD and IQR.

1. Mean = (12 + 15 + 15 + 18 + 20 + 22 + 30)/7 = 132/7 ≈ 18.86.
2. Median: seven values, the 4th is 18.
3. Absolute deviations from 18.86: 6.86, 3.86, 3.86, 0.86, 1.14, 3.14, 11.14. Sum = 30.86. MAD ≈ 30.86/7 ≈ 4.41.
4. Q1 = median of 12, 15, 15 = 15; Q3 = median of 20, 22, 30 = 22; IQR = 7.

**Try it.** Data: 2, 3, 5, 6, 9. Find the mean, median, MAD and IQR.
*Answers:* mean = 25/5 = 5; median = 5; absolute deviations 3, 2, 0, 1, 4 sum to 10, so MAD = 2; Q1 = (2 + 3)/2 = 2.5, Q3 = (6 + 9)/2 = 7.5, IQR = 5.

## What is the spreadsheet doing? (1.6)

A spreadsheet cell can hold a number, text, or a **formula** that starts with `=`. A formula can refer to other cells by address. When the referenced cells change, the formula's result updates.

Suppose column A holds the numbers 3, 5, 8 in A1 to A3 and column B shows 7, 11, 17 next to them. What is the formula in column B? Test a guess: "double and add one" gives 2·3 + 1 = 7, 2·5 + 1 = 11, 2·8 + 1 = 17. So B1 holds `=2*A1+1`, B2 holds `=2*A2+1`, and so on. Working out a hidden rule from its inputs and outputs is exactly what you do when you look for a pattern in a table, and later when you write a function.

Order of operations in a spreadsheet matches algebra: `=A1+A2*3` multiplies first. Use parentheses when the sum should come first: `=(A1+A2)*3`. Exponents use `^`: `=A1^2` squares the value in A1.

**Try it.** Column A holds 2, 4, 10; column B shows 1, 2, 5. Write the formula in B1.
*Answer:* `=A1/2`.

## Writing formulas and functions (1.7)

The functions you need this year:

| Function | What it returns |
|---|---|
| `=SUM(A2:A11)` | The total of the ten cells A2 through A11 |
| `=AVERAGE(A2:A11)` | The mean |
| `=MEDIAN(A2:A11)` | The median |
| `=MIN(A2:A11)`, `=MAX(A2:A11)` | The smallest and largest values |
| `=COUNT(A2:A11)` | How many of the cells hold numbers |
| `=QUARTILE(A2:A11, 1)`, `=QUARTILE(A2:A11, 3)` | Q1 and Q3 (some programs' quartile method differs slightly from the by-hand one; say which you used) |
| `=ABS(B2)` | The absolute value |

`A2:A11` is a **range**: every cell from A2 down to A11. Functions accept ranges, single cells and numbers mixed: `=AVERAGE(A2:A11, 50)` averages the ten cells and the number 50.

**Worked example.** Twenty temperatures sit in A2:A21. Build the MAD.

1. In C1, type `=AVERAGE(A2:A21)` for the mean.
2. In B2, type `=ABS(A2-$C$1)`: the absolute deviation of the first value. The `$` signs lock C1 (see 1.8).
3. Fill B2 down to B21.
4. In C2, type `=AVERAGE(B2:B21)`. That is the MAD.

Check with a tiny data set first: if A2:A4 hold 1, 2, 6, the mean is 3, the absolute deviations are 2, 1, 3 and the MAD is 2. If your sheet shows 2, the formulas are right.

## Fill down and locked references (1.8)

Copying a formula moves its references with it: `=A2*2` copied one row down becomes `=A3*2`. That is what makes a spreadsheet fast: write one formula, fill it down a column, and every row gets the same rule applied to its own values. Spreadsheets fill by dragging the small handle at the corner of a cell or by selecting a column and using the fill-down command.

Sometimes a reference must **not** move. The mean in C1 in the example above should be subtracted from every value; if B2 holds `=ABS(A2-C1)` and you fill down, B3 becomes `=ABS(A3-C2)`, which is wrong. Writing `$C$1` locks both the column and the row, so every copy still points at C1.

**Worked example.** B1 holds a tax rate, 0.08. Prices are in A2:A6. Write a formula for A2's tax that can be filled down.
Answer: in C2, `=A2*$B$1`. Filling down gives `=A3*$B$1`, `=A4*$B$1`, and so on: the price moves, the rate stays.

Other shortcuts worth knowing: typing 1 and 2 in two cells and dragging the handle continues the pattern 3, 4, 5; double-clicking the handle fills down as far as the neighbouring column has data; `=A2:A21` style ranges can be selected by clicking the first cell and shift-clicking the last.

**Try it.** D2 holds `=A2-$A$1`. What does it become when filled down to D5?
*Answer:* `=A5-$A$1`.

## Common mistakes

- Averaging the signed deviations and getting zero. The MAD uses **absolute** deviations; the signed ones always cancel.
- Confusing IQR with range. IQR is Q3 − Q1 (the middle half); range is max − min (everything).
- Forgetting the `=`: typing `AVERAGE(A2:A11)` stores text, not a computation.
- Writing `=AVERAGE(A2+A11)` when you meant the range `A2:A11`; the plus adds two cells, the colon spans them.
- Leaving a reference unlocked and filling down, so each row compares against a different cell.
- Reporting a mean to ten decimal places. Round to one more decimal place than the data.

## Where this goes next

Week 3 shows that the choice between mean and median, and between MAD/IQR and the standard deviation, depends on the shape you learned to read in week 1 and on whether extreme values are present. The spreadsheet skills return whenever a data set is too big to handle by hand: standard deviation (week 3), residuals and correlation (unit 3) and exponential growth tables (unit 5).

## Self-check

1. Compute the mean and median of 5, 7, 7, 9, 12.
2. For the same data, compute the MAD.
3. For the same data, compute the IQR.
4. Column A holds 1, 3, 4 and column B shows 1, 9, 16. What formula is in B1?
5. E2 holds `=A2/$B$1`. Write what E4 holds after filling down.

*Answers:* (1) mean = 40/5 = 8; median = 7. (2) absolute deviations 3, 1, 1, 1, 4 sum to 10; MAD = 2. (3) Q1 = (5 + 7)/2 = 6, Q3 = (9 + 12)/2 = 10.5, IQR = 4.5. (4) `=A1^2`. (5) `=A4/$B$1`.

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Algebra 1, Unit 1, Lessons 5–8, https://im.kendallhunt.com/HS/teachers/1/1/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
