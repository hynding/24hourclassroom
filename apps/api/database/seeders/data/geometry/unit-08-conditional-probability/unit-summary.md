# Unit 8 Summary · Conditional Probability

**Lessons covered:** 8.1–8.11 (weeks 30–32): chance experiments, sample spaces, fair games, two-way tables (8.1–8.4); combining events and the addition rule (8.5–8.6); dependent and independent events, conditional probability (8.7–8.8); conditional probability from tables, the independence tests, games (8.9–8.11).

This is the night-before sheet. Probability has few formulas and many ways to misread a question; the examples below are chosen to show the readings.

## The ideas that generate every question

1. **A probability is a share of a sample space.** With equally likely outcomes, count favourable over total; with a spinner, central angle over 360° (area over area); with data, relative frequency.
2. **Organise the sample space before counting.** Lists, tables (two devices) and trees (stages). The multiplication principle gives the size: m × n.
3. **"Or" adds and subtracts the overlap; "and" is the overlap.** P(A or B) = P(A) + P(B) − P(A and B). Complements turn "at least one" into "none".
4. **Conditioning shrinks the sample space.** P(A | B) = P(A and B)/P(B): in a table, divide the shared cell by the total of the row or column named after "given".
5. **Independence means conditioning changes nothing.** P(A | B) = P(A), equivalently P(A and B) = P(A)P(B). Draws without replacement are dependent; with replacement, independent. Data gives only approximate independence.
6. **Games are sample spaces with prizes.** Fair means equal winning probabilities; average winnings = Σ prize × probability, compared with the cost.

## Formulas

| Rule | Statement |
|---|---|
| equally likely outcomes | P(E) = (outcomes in E)/(outcomes in the sample space) |
| spinner region | P = central angle/360° = sector area/circle area |
| complement | P(not A) = 1 − P(A) |
| addition rule | P(A or B) = P(A) + P(B) − P(A and B) |
| mutually exclusive | P(A and B) = 0, so P(A or B) = P(A) + P(B) |
| conditional probability | P(A \| B) = P(A and B)/P(B) |
| multiplication rule | P(A and B) = P(B) · P(A \| B) |
| independence (three forms) | P(A \| B) = P(A); P(B \| A) = P(B); P(A and B) = P(A) · P(B) |
| independent "and" | P(A and B) = P(A) · P(B) |
| independent "at least one" | 1 − P(none) = 1 − (1 − p₁)(1 − p₂)… |
| average winnings | Σ (prize × probability) |

## Reading a two-way table

| | B | not B | Total |
|---|---|---|---|
| A | a | b | a + b |
| not A | c | d | c + d |
| Total | a + c | b + d | n |

- P(A and B) = a/n. P(A or B) = (a + b + c)/n = 1 − d/n.
- P(B | A) = a/(a + b) (row). P(A | B) = a/(a + c) (column).
- Independent exactly when a/(a + b) = (a + c)/n, equivalently when every row has the same proportions.
- Building a table from "x% of the As have B": fill the A row first, then the rest by subtraction; check totals.

## Procedures

- **Fair or not:** list the sample space, count each player's wins, compare; note any shared outcomes.
- **Multi-stage game:** tree; multiply along branches; add the winning leaves; reverse a condition by dividing a leaf by the sum of the relevant leaves.
- **Dependence by data:** compare P(A | B) with P(A | not B) or with P(A); call a small gap "approximately independent".
- **"At least one" of independent events:** complement of "none".

## Common errors

- Treating unequal spinner regions, or the 11 sums of two dice, as equally likely.
- Dropping order: (2, 5) and (5, 2) are different outcomes.
- Adding P(A) + P(B) without subtracting the overlap; confusing "and" with "or".
- Using the grand total for a conditional probability; reversing P(A | B) and P(B | A).
- Multiplying P(A)P(B) for "and" without independence.
- Calling mutually exclusive events independent (they are dependent when both are possible).
- Judging a game by its biggest prize instead of its average winnings.
- Expecting experimental relative frequency to equal the model exactly.

## Worked examples

**1. Two dice.** P(sum 9) = 4/36. P(sum 9 | first is 4) = 1/6. P(sum 9 or doubles) = 4/36 + 6/36 − 0 = 10/36. "First even" and "sum 7": 3/36 = (1/2)(1/6), independent.

**2. Table.** 400 patients: under 65 with shot 120, without 180; 65+ with shot 70, without 30. P(shot | 65+) = 0.70; P(65+ | shot) = 70/190 ≈ 0.37; P(shot or 65+) = 220/400 = 0.55; P(shot) = 0.475 ≠ 0.70, so dependent.

**3. Addition rule.** P(A) = 0.55, P(B) = 0.4, P(A or B) = 0.8: overlap 0.15.

**4. Without replacement.** 3 white, 5 black; P(both white) = (3/8)(2/7) = 6/56.

**5. Tree and reverse.** 20% of drivers under 25; accidents 30% (under 25) and 10% (others). P(accident) = 0.06 + 0.08 = 0.14; P(under 25 | accident) = 0.06/0.14 ≈ 0.43.

**6. Screening.** 5% diseased; test positive 90% (diseased), 8% (healthy). Per 1,000: 45 true positives, 76 false positives; P(diseased | positive) = 45/121 ≈ 0.37.

**7. Game.** $2 to play; pays $1 (0.4), $5 (0.1). Average $0.90: the player loses $1.10 per play on average. Break-even top prize with the $1 prize kept: x · 0.1 + 0.4 = 2, x = $16.

**8. Door problem.** Host knowingly reveals an empty door: switching wins 2/3. Host reveals at random (and it happens to be empty): 1/2.

## What to review from earlier units

From Unit 7: sectors and radians, which give spinner probabilities (central angle over 360° or over 2π). From Unit 5: area scaling, for dartboard rings. From Unit 6: circle equations when a region is described on a grid. Nothing else from geometry is needed; the final weights this unit lightly but always includes a two-way table and a conditional probability.

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Geometry, Unit 8, Lessons 1–11, https://im.kendallhunt.com/HS/teachers/2/8/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
