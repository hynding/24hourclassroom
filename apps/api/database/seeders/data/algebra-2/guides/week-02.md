# Week 02 · Sequences as Functions and the nth Term

**Lessons:** 1.5 Sequences are Functions · 1.6 Representing Sequences · 1.7 Representing More Sequences · 1.8 The nth Term
**Practices:** MP2 (reason abstractly and quantitatively), MP7 (look for structure), MP8 (regularity in repeated reasoning)
**Built from:** IM Algebra 2, Unit 1, Lessons 5–8, in our own words
**Spiral:** Week 1's recursive definitions, common differences and common ratios are the raw material here. Everything you learned about linear functions (slope, y-intercept) and exponential functions (growth factor) in Algebra 1 comes back as well.

## What you need to be able to do

- **1.5** Treat a sequence as a function whose inputs are term numbers (1, 2, 3, … or 0, 1, 2, …) and whose outputs are the terms. State its domain, evaluate it with function notation, and graph it as separate points.
- **1.6** Move between a table, a graph, a recursive definition and a description for an arithmetic sequence, and recognise that its graph is a set of points on a line.
- **1.7** Do the same for a geometric sequence, whose graph is a set of points on an exponential curve, and read the ratio and first term from any representation.
- **1.8** Write an explicit formula for the nth term of an arithmetic sequence, a(n) = a(1) + (n − 1)d, and of a geometric sequence, a(n) = a(1) · rⁿ⁻¹, and use it to find any term directly or to find which term has a given value.

## Key terms

| Term | Meaning |
|---|---|
| Domain of a sequence | The set of term numbers, usually the positive integers {1, 2, 3, …}, sometimes the whole numbers {0, 1, 2, …} when a(0) is a natural starting value. |
| Function notation for sequences | a(n) is the output (term) for the input n (term number). a(4) = 29 means the fourth term is 29. |
| Discrete graph | A graph made of separate points, one per term, not connected by a line. |
| Explicit formula (nth-term formula) | A formula that gives a(n) directly from n, without needing earlier terms. |
| Recursive definition | A starting term and a rule a(n) in terms of a(n − 1). |
| a(n) = a(1) + (n − 1)d | The nth term of an arithmetic sequence with first term a(1) and common difference d. |
| a(n) = a(1) · rⁿ⁻¹ | The nth term of a geometric sequence with first term a(1) and common ratio r. |

## A sequence is a function (1.5)

Last week a sequence was a list. This week it is a **function**: the input is the position n, the output is the term. The sequence 11, 17, 23, 29 is the function a with a(1) = 11, a(2) = 17, a(3) = 23, a(4) = 29.

Because inputs are whole numbers only, the domain is {1, 2, 3, …} (or {0, 1, 2, …} if you start counting at 0). That makes two things true:

- There is no a(2.5). The graph is a set of **separate points**, never a connected line or curve.
- Function language applies: "a(6)" means "the sixth term", and "solve a(n) = 59" means "which term equals 59?"

Choosing the domain is up to you, but you must say what you chose. If a sequence models "number of bacteria after n hours", a(0) is the starting population, so a domain starting at 0 is natural. If it models "the nth row of a theatre", start at 1. Formulas change with the choice: the same sequence 5, 10, 20, 40 is 5 · 2ⁿ⁻¹ with domain starting at 1 and 5 · 2ⁿ with domain starting at 0.

**Worked example.** Let f be the sequence defined by f(1) = 3, f(n) = f(n − 1) + 4. State f(5), write the domain and describe the graph.

f(2) = 7, f(3) = 11, f(4) = 15, f(5) = 19. Domain: positive integers. The graph is the points (1, 3), (2, 7), (3, 11), (4, 15), (5, 19), … which lie on a line of slope 4 but are plotted as dots only.

**Try it.**
1. For the sequence g(0) = 100, g(n) = 0.5 · g(n − 1), state the domain and find g(3).
2. Why is it wrong to connect the dots when graphing a sequence?

*Answers:* 1. Whole numbers {0, 1, 2, …}; g(3) = 12.5. 2. The function has no output for inputs between whole numbers, so a line between dots would show values that do not exist.

## Representing arithmetic sequences (1.6)

An arithmetic sequence can be shown four ways, and each shows the common difference in its own way.

| Representation | 11, 17, 23, 29, … | Where d shows up |
|---|---|---|
| Table | n: 1, 2, 3, 4 → a(n): 11, 17, 23, 29 | outputs rise by 6 each row |
| Graph | points (1, 11), (2, 17), (3, 23), (4, 29) | points lie on a line of slope 6 |
| Recursive | a(1) = 11, a(n) = a(n − 1) + 6 | the "+ 6" |
| Explicit | a(n) = 11 + 6(n − 1) = 6n + 5 | the coefficient of n |

Reading from a graph: pick two points, compute rise over run. If the graph shows (2, 17) and (5, 35), then d = (35 − 17)/(5 − 2) = 6. Then walk back to find a(1): 17 − 6 = 11.

**Worked example.** The graph of an arithmetic sequence contains (1, 40) and (4, 25). Write recursive and explicit definitions.

d = (25 − 40)/(4 − 1) = −5. Recursive: a(1) = 40, a(n) = a(n − 1) − 5. Explicit: a(n) = 40 − 5(n − 1) = 45 − 5n. Check: a(4) = 45 − 20 = 25.

Notice that simplifying 40 − 5(n − 1) to 45 − 5n is like writing a line in slope-intercept form. The "45" is not a term of the sequence (it would be a(0)), which is why the a(1) + (n − 1)d form is the safer one to start from.

**Try it.**
1. The points (3, 14) and (7, 30) lie on the graph of an arithmetic sequence. Find d and a(1).
2. Write an explicit formula for 2, 9, 16, 23, …

*Answers:* 1. d = 16/4 = 4; a(1) = 14 − 2·4 = 6. 2. a(n) = 2 + 7(n − 1), or 7n − 5.

## Representing geometric sequences (1.7)

The same four views work for a geometric sequence, with multiplication in place of addition.

| Representation | 4, 12, 36, 108, … | Where r shows up |
|---|---|---|
| Table | n: 1, 2, 3, 4 → a(n): 4, 12, 36, 108 | outputs triple each row |
| Graph | points (1, 4), (2, 12), (3, 36), (4, 108) | points lie on an exponential curve, rising faster and faster |
| Recursive | a(1) = 4, a(n) = 3 · a(n − 1) | the "× 3" |
| Explicit | a(n) = 4 · 3ⁿ⁻¹ | the base of the power |

The graph of a geometric sequence with r > 1 curves upward; with 0 < r < 1 it drops quickly at first and then flattens toward the horizontal axis; with r < 0 the points hop above and below the axis. You can tell a geometric graph from an arithmetic one at a glance: arithmetic points are evenly spaced vertically, geometric points are not.

**Worked example.** A table gives n = 2 → 50 and n = 4 → 2. The sequence is geometric with a positive ratio. Find r and a(1), and write the explicit formula.

Two steps take 50 to 2, so r² = 2/50 = 1/25, giving r = 1/5 (positive). Then a(1) = 50 / (1/5) = 250. Explicit: a(n) = 250 · (1/5)ⁿ⁻¹. Check: a(4) = 250 · (1/125) = 2.

**Try it.**
1. The graph of a geometric sequence passes through (1, 2) and (3, 18), and all terms are positive. Find r and the explicit formula.
2. A geometric sequence has a(0) = 640 and r = 1/2. Write the explicit formula with a domain starting at 0, and find a(5).

*Answers:* 1. r² = 9, r = 3, a(n) = 2 · 3ⁿ⁻¹. 2. a(n) = 640 · (1/2)ⁿ; a(5) = 640/32 = 20.

## The nth term (1.8)

The explicit formulas come from counting steps. To get from a(1) to a(n) you take n − 1 steps.

- Arithmetic: each step adds d, so a(n) = a(1) + (n − 1)d.
- Geometric: each step multiplies by r, so a(n) = a(1) · rⁿ⁻¹.

If your domain starts at 0, the number of steps from a(0) to a(n) is n, and the formulas become a(n) = a(0) + nd and a(n) = a(0) · rⁿ.

Use the explicit formula to jump to any term, and use it in reverse to find which term has a given value.

**Worked example.** For the arithmetic sequence 7, 11, 15, 19, …, find a(50) and find which term equals 403.

d = 4, so a(n) = 7 + 4(n − 1). a(50) = 7 + 4·49 = 203. For 403: 7 + 4(n − 1) = 403, so 4(n − 1) = 396, n − 1 = 99, n = 100. The 100th term is 403.

**Worked example.** For the geometric sequence 6, 12, 24, …, find a(10), and find the first term greater than 10,000.

a(n) = 6 · 2ⁿ⁻¹. a(10) = 6 · 2⁹ = 6 · 512 = 3072. Then a(11) = 6144 and a(12) = 12,288, so the 12th term is the first above 10,000. (Next semester logarithms will let you solve 6 · 2ⁿ⁻¹ > 10,000 directly; for now, compute terms.)

**Worked example.** Which is bigger for large n: the arithmetic sequence a(n) = 1000 + 50(n − 1) or the geometric sequence b(n) = 2 · 1.5ⁿ⁻¹?

At n = 1: 1000 vs 2. At n = 10: 1450 vs 2 · 1.5⁹ ≈ 76.9. At n = 20: 1950 vs 2 · 1.5¹⁹ ≈ 4,434. The geometric sequence starts tiny but overtakes somewhere between n = 15 (1700 vs 584) and n = 20, and from then on it wins by more every step. Repeated multiplication by a number bigger than 1 always beats repeated addition eventually.

**Try it.**
1. Find a(30) for the arithmetic sequence with a(1) = −12 and d = 2.5.
2. Find a(7) for the geometric sequence with a(1) = 1 and r = −2.
3. Which term of 5, 8, 11, 14, … is 92?

*Answers:* 1. −12 + 29·2.5 = 60.5. 2. 1 · (−2)⁶ = 64. 3. 5 + 3(n − 1) = 92 → n − 1 = 29 → n = 30.

## Common mistakes

- **Using n instead of n − 1.** a(n) = a(1) · rⁿ gives a(1) = a(1) · r, which is wrong unless r = 1. With domain starting at 1, the exponent is n − 1.
- **Mixing up the starting index.** If a table starts at n = 0, the formula uses n, not n − 1. Always check the formula against the first row of the table.
- **Treating the simplified form as the first term.** In a(n) = 6n + 5, the first term is 11, not 5. The constant 5 is what you would get at n = 0.
- **Connecting the dots.** The graph of a sequence is points only.
- **Forgetting that r² has two square roots.** If two steps multiply by 9, r could be 3 or −3; use the signs of the terms to decide.

## Where this goes next

Next week you decide which kind of sequence fits a situation (constant payments, percentage growth, or neither) and learn to add up the first n terms of a sequence. Later, Unit 4 extends geometric sequences to exponential functions defined for every real input, and Unit 2 adds up geometric series in closed form.

## Self-check

1. A sequence has a(1) = 9 and a(n) = a(n − 1) − 3. Write its explicit formula and find a(25).
2. The graph of a geometric sequence passes through (1, 5) and (2, 15). Write recursive and explicit definitions.
3. Explain why the graph of a sequence should never be drawn as a solid line.
4. For the sequence b(n) = 3 · 4ⁿ⁻¹, find b(5), and state which term equals 3072.
5. An arithmetic sequence has a(5) = 18 and a(9) = 34. Find a(1) and a(n).

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Algebra 2, Unit 1, Lessons 5–8, https://im.kendallhunt.com/HS/teachers/3/1/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
