# Week 01 · Sequences: Patterns, Ratios and Differences

**Lessons:** 1.1 A Towering Sequence · 1.2 Introducing Geometric Sequences · 1.3 Different Types of Sequences · 1.4 Using Technology to Work with Sequences
**Practices:** MP7 (look for structure), MP8 (express regularity in repeated reasoning), MP5 (use tools strategically)
**Built from:** IM Algebra 2, Unit 1, Lessons 1–4, in our own words
**Spiral:** This is the first week, so there is nothing to spiral back to yet. You will lean on Algebra 1 skills: evaluating expressions, recognising linear and exponential growth, and reading a table.

## What you need to be able to do

- **1.1** Describe a list of numbers that comes from a puzzle or process, find a rule that produces the next term from the ones before it, and use that rule to predict terms you have not computed.
- **1.2** Recognise a geometric sequence: each term is the previous term multiplied by the same number, the common ratio. Find the ratio and continue the sequence forwards and backwards.
- **1.3** Tell arithmetic sequences (same difference each step) from geometric sequences (same ratio each step) and from sequences that are neither. Find the common difference or common ratio from any two consecutive terms.
- **1.4** Define a sequence recursively (a starting value plus a rule for getting from one term to the next) and use a spreadsheet, calculator or recursion to generate many terms quickly.

## Key terms

| Term | Meaning |
|---|---|
| Sequence | An ordered list of numbers. Each number is a **term**. |
| Term number (index) | The position of a term in the list; we write the first term as a(1) or a₁ and the nth term as a(n). |
| Recursive definition | A rule that gives the first term and tells how to get each term from the one before it, for example a(1) = 3, a(n) = a(n − 1) + 5 for n ≥ 2. |
| Arithmetic sequence | A sequence in which consecutive terms always differ by the same number, the **common difference** d. |
| Geometric sequence | A sequence in which each term is the previous term times the same number, the **common ratio** r. |
| Common difference | The number you add each step in an arithmetic sequence: d = a(n) − a(n − 1). |
| Common ratio | The number you multiply by each step in a geometric sequence: r = a(n) / a(n − 1). |
| Tower of Hanoi | A puzzle with discs on three pegs; the minimum number of moves for n discs gives the sequence 1, 3, 7, 15, 31, … |

## A sequence from a puzzle (1.1)

The Tower of Hanoi has three pegs and a stack of discs of different sizes on one peg. You move one disc at a time, never placing a larger disc on a smaller one, and the goal is to move the whole stack to another peg. With one disc it takes 1 move. With two discs it takes 3 moves: small disc aside, large disc across, small disc on top. With three discs it takes 7, and with four it takes 15.

The list 1, 3, 7, 15, … is a sequence. There are two good ways to describe it:

- **Recursively.** To move n discs you move the top n − 1 discs out of the way, move the bottom disc, then move the n − 1 discs back on top. So the move count doubles and adds one: a(1) = 1, a(n) = 2·a(n − 1) + 1.
- **With a formula.** Each term is one less than a power of 2: a(n) = 2ⁿ − 1. Check: 2⁴ − 1 = 15.

Recursive rules are easy to find from a process ("what do I do to get the next one?"); explicit formulas are better for jumping straight to the 20th term. For now, concentrate on finding and using rules.

**Worked example.** A sequence starts 2, 5, 11, 23, 47. Find a recursive rule and the next term.

Look at how each term relates to the one before: 5 = 2·2 + 1, 11 = 2·5 + 1, 23 = 2·11 + 1, 47 = 2·23 + 1. So a(1) = 2 and a(n) = 2·a(n − 1) + 1. The next term is 2·47 + 1 = 95.

**Try it.**
1. Find the next two terms of 1, 4, 13, 40, … and give a recursive rule.
2. The Tower of Hanoi with 7 discs takes how many moves?

*Answers:* 1. Each term is three times the previous plus one: 121, 364; a(1) = 1, a(n) = 3·a(n − 1) + 1. 2. 2⁷ − 1 = 127.

## Geometric sequences (1.2)

A sequence is **geometric** when you multiply by the same number every step. The number is the **common ratio** r, and you find it by dividing any term by the term before it.

| Sequence | Ratios | Common ratio |
|---|---|---|
| 3, 6, 12, 24, 48 | 6/3 = 2, 12/6 = 2, 24/12 = 2, 48/24 = 2 | r = 2 |
| 80, 20, 5, 1.25 | 20/80 = 1/4, 5/20 = 1/4, 1.25/5 = 1/4 | r = 1/4 |
| 2, −6, 18, −54 | −6/2 = −3, 18/(−6) = −3, −54/18 = −3 | r = −3 |

Three things to notice:

- A ratio between 0 and 1 makes the terms shrink toward 0 (80, 20, 5, 1.25, 0.3125, …). A ratio greater than 1 makes them grow without bound.
- A negative ratio makes the signs alternate. 2, −6, 18, −54 is still geometric.
- You can run a geometric sequence backwards by dividing by r. The term before 3 in the first sequence is 3/2 = 1.5.

A recursive definition for a geometric sequence always has the shape a(1) = first term, a(n) = r · a(n − 1).

**Worked example.** A ball is dropped from 250 cm and each bounce reaches 60% of the previous height. Write the first four bounce heights and a recursive rule.

The heights are 250 · 0.6 = 150, then 150 · 0.6 = 90, then 90 · 0.6 = 54, then 54 · 0.6 = 32.4 cm. Here the first bounce is a(1) = 150 and a(n) = 0.6 · a(n − 1). (If you prefer to count the drop height as a(0) = 250 that is fine, as long as you say so.)

**Worked example.** The third term of a geometric sequence is 45 and the fourth is 135. Find the first term.

r = 135/45 = 3. Working backwards: a(2) = 45/3 = 15 and a(1) = 15/3 = 5. Check: 5, 15, 45, 135.

**Try it.**
1. Is 1, 4, 9, 16 geometric? Explain using ratios.
2. A geometric sequence has a(1) = 400 and r = 1/2. Find a(5).
3. Find the common ratio of 7, −3.5, 1.75, −0.875.

*Answers:* 1. No: 4/1 = 4 but 9/4 = 2.25, so there is no common ratio. 2. 400, 200, 100, 50, 25, so a(5) = 25. 3. r = −1/2.

## Arithmetic, geometric or neither (1.3)

An **arithmetic sequence** adds the same number each step. The number is the **common difference** d, found by subtracting consecutive terms: d = a(n) − a(n − 1). The sequence 11, 7, 3, −1, −5 is arithmetic with d = −4. A recursive definition looks like a(1) = 11, a(n) = a(n − 1) − 4.

To classify a sequence, test both patterns:

1. Subtract consecutive terms. All the same? Arithmetic.
2. Divide consecutive terms. All the same? Geometric.
3. Neither? Then it is some other kind of sequence (the Tower of Hanoi counts 1, 3, 7, 15 are neither: differences 2, 4, 8 and ratios 3, 2.33, 2.14).

A constant sequence such as 5, 5, 5, 5 is both: d = 0 and r = 1. That is the only way a sequence can be both.

**Worked example.** Classify each sequence and give its d or r.

| Sequence | Differences | Ratios | Verdict |
|---|---|---|---|
| 2, 10, 50, 250 | 8, 40, 200 | 5, 5, 5 | geometric, r = 5 |
| 2, 10, 18, 26 | 8, 8, 8 | 5, 1.8, 1.44 | arithmetic, d = 8 |
| 2, 10, 20, 32 | 8, 10, 12 | 5, 2, 1.6 | neither |

**Worked example.** An arithmetic sequence has a(4) = 29 and a(7) = 47. Find d and a(1).

From term 4 to term 7 is three steps, and the terms rise by 47 − 29 = 18, so d = 18/3 = 6. Going back three steps from a(4): a(1) = 29 − 3·6 = 11. Check: 11, 17, 23, 29, 35, 41, 47.

Keep the vocabulary straight: arithmetic sequences are the sequence version of linear functions (constant rate of change), geometric sequences are the sequence version of exponential functions (constant growth factor). That connection is next week's main idea.

**Try it.**
1. Classify 100, 90, 81, 72.9 and give d or r.
2. Classify 100, 90, 80, 70 and give d or r.
3. An arithmetic sequence has a(2) = 5 and a(5) = −10. Find a(1).

*Answers:* 1. Geometric, r = 0.9. 2. Arithmetic, d = −10. 3. d = (−10 − 5)/3 = −5, so a(1) = 5 − (−5) = 10.

## Using technology to generate terms (1.4)

A recursive rule is perfect for a spreadsheet, because a spreadsheet naturally computes each cell from the cell above it. For the rule a(1) = 1, a(n) = 2·a(n − 1) + 1:

```
   A        B
1  n        a(n)
2  1        1
3  =A2+1    =2*B2+1
4  =A3+1    =2*B3+1
```

Fill the formulas down and the sheet produces as many terms as you want. On a graphing calculator you can do the same by typing the first term, pressing enter, and then typing a rule that uses the previous answer (for example `Ans*2+1`) and pressing enter repeatedly.

Technology is also the fast way to answer questions like "which term is the first one above 10,000?" Generate terms until you pass the target and read off n. For the Tower of Hanoi sequence the first term above 10,000 is a(14) = 16,383.

**Worked example.** A savings account holds $1,200 and earns 0.5% interest each month, and nothing else is deposited. After how many months does the balance first exceed $1,300?

The balances form a geometric sequence: a(0) = 1200, a(n) = 1.005 · a(n − 1). A spreadsheet shows a(16) ≈ 1299.69 and a(17) ≈ 1306.19, so the balance first passes $1,300 in month 17. Without technology you would be multiplying by 1.005 seventeen times; with it, this is a two-cell formula filled down.

**Worked example.** A sequence is defined by b(1) = 8, b(n) = b(n − 1)/2 + 3. Generate the first six terms and describe what happens.

8, 7, 6.5, 6.25, 6.125, 6.0625. The terms decrease and get closer and closer to 6 without reaching it. (Reason: if a term were exactly 6, the next would be 6/2 + 3 = 6 again, so 6 is a fixed point, and each step halves the gap to it.)

**Try it.**
1. Use a recursive rule to produce the first five terms of c(1) = 3, c(n) = 4·c(n − 1) − 5.
2. For the sequence 5, 15, 45, 135, …, which term is the first one larger than 100,000?

*Answers:* 1. 3, 7, 23, 87, 343. 2. Terms are 5·3^(n − 1): a(10) = 5·3⁹ = 98,415 and a(11) = 295,245, so the 11th term.

## Common mistakes

- **Dividing the wrong way round.** The common ratio is a later term divided by the earlier one: for 80, 20, 5 it is 20/80 = 1/4, not 4.
- **Calling a sequence geometric after checking one ratio.** 1, 2, 4, 7 has 2/1 = 2 and 4/2 = 2, but 7/4 is not 2. Check every pair you are given.
- **Confusing the difference d with the ratio r.** Arithmetic means add d; geometric means multiply by r. "Multiply by 1.5" is a ratio; "add 1.5" is a difference.
- **Forgetting the starting value in a recursive definition.** The rule a(n) = 3·a(n − 1) describes infinitely many sequences; a(1) = 2 pins down which one.
- **Off-by-one errors.** If a(1) is the first term, then a(5) is four steps from it, not five.

## Where this goes next

Next week treats sequences as functions whose domain is the positive integers (or the whole numbers), so you can graph them and write explicit formulas: a(n) = a(1) + (n − 1)d for arithmetic sequences and a(n) = a(1) · rⁿ⁻¹ for geometric ones. Week 3 asks which kind of sequence fits a real situation and how to add up the first n terms. In Unit 4, geometric sequences return as exponential functions with any real input.

## Self-check

1. Give the next two terms of 4, 12, 36, 108 and the common ratio.
2. Write a recursive definition for the arithmetic sequence 50, 43, 36, 29, …
3. Is 1, 3, 7, 15, 31 arithmetic, geometric or neither? Justify with differences and ratios.
4. The second term of a geometric sequence is 24 and the fourth term is 6. Find a possible common ratio and the first term.
5. A spreadsheet has 10 in cell B2 and the formula `=B2*0.8+4` in B3, filled down. What is in B5?

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Algebra 2, Unit 1, Lessons 1–4, https://im.kendallhunt.com/HS/teachers/3/1/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
