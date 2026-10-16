# Week 32 · Conditional Probability from Tables, Testing Independence, and Games

**Lessons:** 8.9 Using Tables for Conditional Probability · 8.10 Using Probability to Determine Whether Events Are Independent · 8.11 Probabilities in Games
**Practices:** MP1 (make sense of problems), MP3 (construct arguments), MP4 (model with mathematics)
**Built from:** IM Geometry, Unit 8, Lessons 9–11, in our own words
**Spiral:** every tool is from the last two weeks: two-way tables (week 30), the addition rule and conditional probability (week 31). Games bring back sample spaces, fairness and spinners (week 30), and spinners bring back sectors (week 28). This is also the last teaching week: the final-exam prep guide follows.

## What you need to be able to do

- Read any conditional probability from a two-way table by choosing the right row or column as the new sample space, and build a table from a description or from conditional probabilities.
- Test two events for independence three equivalent ways: P(A | B) = P(A), P(B | A) = P(B), or P(A and B) = P(A) · P(B); and judge "approximately independent" from data.
- Analyse a game of chance: list its sample space with a table or tree, find each player's probability of winning, decide fairness, use conditional probability for multi-stage games, and compute average winnings.

## Key terms

| Term | Meaning |
|---|---|
| Conditional probability from a table | P(A \| B) = (cell A and B) ÷ (total of B's row or column). |
| Independence test | A and B are independent exactly when P(A and B) = P(A) · P(B), equivalently P(A \| B) = P(A). |
| Approximately independent | Observed conditional probabilities that are close but not exactly equal; data never gives exact equality. |
| Multi-stage game | A game whose later steps depend on earlier results; analysed with a tree and the multiplication rule. |
| Average (expected) winnings | The sum of (prize × probability) over all outcomes: what you win per play on average over many plays. |

## 1. Using tables for conditional probability (8.9)

A survey of 300 adults: commute type and whether they read on the way.

| | Reads | Does not read | Total |
|---|---|---|---|
| Train | 72 | 48 | 120 |
| Car | 18 | 102 | 120 |
| Bicycle | 6 | 54 | 60 |
| Total | 96 | 204 | 300 |

The condition names the **new sample space**: a row or a column. Then count inside it.

- P(reads | train) = 72/120 = 0.60.
- P(reads | car) = 18/120 = 0.15.
- P(train | reads) = 72/96 = 0.75.
- P(bicycle | does not read) = 54/204 ≈ 0.26.
- P(reads) = 96/300 = 0.32 (no condition: grand total).

**Worked example 1 — "given" hidden in words.** "What fraction of car commuters read?" is P(reads | car). "What fraction of readers commute by car?" is P(car | reads) = 18/96 ≈ 0.19. Same cell, different denominators.

**Worked example 2 — from conditionals to a table.** 200 plants; 60% got fertiliser. Of the fertilised plants, 80% flowered; of the others, 45% flowered. Fertilised: 120, of which 96 flowered and 24 did not. Unfertilised: 80, of which 36 flowered and 44 did not. P(flowered) = 132/200 = 0.66. P(fertilised | flowered) = 96/132 ≈ 0.73.

**Worked example 3 — a tree is the same information.** The plant tree has branches 0.6 / 0.4, then 0.8 / 0.2 and 0.45 / 0.55. Leaf probabilities 0.48, 0.12, 0.18, 0.22 are the table's cells divided by 200. Use whichever is easier; the table is better for "given" questions in the reverse direction.

**Try it 1.1** From the commuting table: P(car | does not read) and P(does not read | bicycle). *(Answer: 102/204 = 0.5; 54/60 = 0.9.)*

**Try it 1.2** Of 150 shoppers, 90 used the app; 63 app users and 24 others bought something. Find P(bought | app) and P(app | bought). *(Answer: 63/90 = 0.7; 63/87 ≈ 0.72.)*

## 2. Using probability to determine whether events are independent (8.10)

Three equivalent tests. A and B are independent when any one (hence all) of these holds:

1. **P(A | B) = P(A)** — knowing B does not change A.
2. **P(B | A) = P(B)** — knowing A does not change B.
3. **P(A and B) = P(A) · P(B)** — the multiplication rule with no conditioning needed.

Test 3 comes from the multiplication rule P(A and B) = P(B) · P(A | B): replacing P(A | B) by P(A) is exactly test 1.

**Worked example 4 — a table.** Commuting: P(reads) = 0.32, P(reads | train) = 0.60. Not equal: reading and commuting by train are dependent (train commuters read far more). Check with test 3: P(train) · P(reads) = 0.4 × 0.32 = 0.128, but P(train and reads) = 72/300 = 0.24. Dependent.

**Worked example 5 — a table that is independent.**

| | Likes tea | Does not | Total |
|---|---|---|---|
| Morning person | 30 | 20 | 50 |
| Night owl | 90 | 60 | 150 |
| Total | 120 | 80 | 200 |

P(tea) = 120/200 = 0.6; P(tea | morning) = 30/50 = 0.6; P(tea | night) = 90/150 = 0.6. Independent: the rows have the same proportions. Test 3: 0.25 × 0.6 = 0.15 = 30/200 ✓.

**Worked example 6 — equally likely outcomes.** Two dice: A = "first die is even", B = "sum is 7". P(A) = 1/2, P(B) = 1/6, P(A and B) = 3/36 = 1/12 = (1/2)(1/6): independent. Now B′ = "sum is 8": P(B′) = 5/36, P(A and B′) = 3/36 ((2,6), (4,4), (6,2)) ≠ (1/2)(5/36). Dependent.

**Worked example 7 — approximately independent.** In a poll of 1,000 people, P(owns a bike) = 0.41 and P(owns a bike | under 30) = 0.43. The difference is small; with survey data you would call the events approximately independent, since sampling alone produces gaps like this. If the conditional were 0.70, that would be real dependence.

**Worked example 8 — using independence to compute.** A machine's two parts fail independently with probabilities 0.02 and 0.05 in a year. P(both fail) = 0.02 × 0.05 = 0.001. P(at least one fails) = 1 − 0.98 × 0.95 = 1 − 0.931 = 0.069. The multiplication is legal only because of independence.

**Try it 2.1** P(A) = 0.3, P(B) = 0.5, P(A and B) = 0.15. Independent? *(Answer: 0.3 × 0.5 = 0.15, yes.)*

**Try it 2.2** In Worked example 2 (plants), are "fertilised" and "flowered" independent? *(Answer: P(flowered) = 0.66 but P(flowered | fertilised) = 0.80: dependent.)*

## 3. Probabilities in games (8.11)

To analyse a game: (1) describe the chance devices; (2) write the sample space (table for two devices, tree for stages); (3) mark each player's winning outcomes; (4) compute probabilities; (5) judge fairness or compute average winnings.

**Worked example 9 — a two-spinner game.** Spinner 1 has equal regions 1, 2, 3; spinner 2 has equal regions 1, 2, 3, 4. Player A wins if the product is odd; B wins if the product is at least 8. Table of 12 products:

| | 1 | 2 | 3 | 4 |
|---|---|---|---|---|
| **1** | 1 | 2 | 3 | 4 |
| **2** | 2 | 4 | 6 | 8 |
| **3** | 3 | 6 | 9 | 12 |

Odd products: 1, 3, 3, 9 → 4/12. Products ≥ 8: 8, 9, 12 → 3/12. Not fair; 9 is a win for both, so a tie-break is needed. Making B win on "at least 6" gives 6, 8, 6, 9, 12 → 5/12; "at least 7" gives 3/12 again; a fair rule is "B wins on an even product of at least 6": 6, 8, 6, 12 → 4/12.

**Worked example 10 — a multi-stage game with a tree.** Draw a card: with probability 1/4 it is a heart. If a heart, roll a die and win on a 5 or 6 (probability 1/3); otherwise flip a coin and win on heads (1/2). P(win) = (1/4)(1/3) + (3/4)(1/2) = 1/12 + 3/8 = 2/24 + 9/24 = 11/24 ≈ 0.46. P(drew a heart | won) = (1/12)/(11/24) = 2/11.

**Worked example 11 — average winnings.** A $2 game: spin a spinner with regions 50% "nothing", 30% "$1", 15% "$5", 5% "$20". Average winnings per play = 0 × 0.5 + 1 × 0.3 + 5 × 0.15 + 20 × 0.05 = 0.3 + 0.75 + 1 = $2.05. Slightly better than the $2 cost on average, so a player expects to gain about 5 cents per play over many plays. Change the $20 prize to $15 and the average drops to $1.80: a losing game.

**Worked example 12 — a spinner that cannot be made fair in one spin.** A spinner has regions of 90°, 120° and 150°. A one-spin game assigns whole regions to players, so each player's probability is a sum of 1/4, 1/3 and 5/12. No sum of some of these equals 1/2 (the closest are 5/12 and 7/12), so no one-spin rule is fair. With two spins it can be done: A wins if both spins land in the 150° region or both in the 90° region, probability (5/12)² + (1/4)² = 25/144 + 9/144 = 34/144; B wins if the two spins land in different regions among the 90° and 150° ones, probability 2 · (1/4)(5/12) = 10/48 = 30/144. Still not equal, which shows why fairness is checked by computing, never assumed.

**Worked example 13 — the game-show door, revisited with a tree.** Prize behind door 1, 2 or 3 (1/3 each); you pick door 1; the host opens an empty door; you switch. You win iff the prize was behind door 2 or 3: 2/3. A tree with three first branches, each followed by the host's forced or chosen reveal, confirms it.

**Try it 3.1** Two fair dice; A wins on a sum of 6, B on a sum of 8, C on doubles. Who is most likely to win? *(Answer: 5/36, 5/36, 6/36; C, though (3,3) and (4,4) are shared with A and B.)*

**Try it 3.2** A game costs $1: roll a die, win $3 on a 6, $1 on a 5, nothing otherwise. Average winnings? *(Answer: 3/6 + 1/6 = $0.67; a losing game.)*

## Common mistakes

- **Using the grand total for a conditional probability.** The denominator is the row or column named by "given".
- **Confusing P(A | B) with P(B | A).** Decide which event is the condition first.
- **Declaring dependence from a tiny difference in survey data.** Real data always wobbles; look for a difference that matters.
- **Multiplying P(A) · P(B) for "and" without checking independence.**
- **Forgetting shared winning outcomes** when two players' rules overlap.
- **Comparing games by the biggest prize.** Compare average winnings against the cost.

## Where this goes next

The exam-prep guide (week 33) reviews all eight units in proportion to their weight on the practice final (week 34): constructions and transformations, congruence, similarity, trigonometry, solids, coordinates, circles and, lightly, probability. Unit 8's contributions to the final are two-way tables, the addition rule, conditional probability and the independence test.

## Self-check

1. From the commuting table: P(train | reads) and P(reads | bicycle).
2. P(A) = 0.4, P(B) = 0.25, P(A and B) = 0.1. Independent?
3. In the tea table, is "night owl" independent of "does not like tea"? Show the test.
4. A game: spin a spinner with equal regions 1–5 twice. A wins if the sum is even, B if the sum is 6 or more. Fair?
5. A $3 game pays $10 with probability 0.2 and $1 with probability 0.5. Average winnings, and is it worth playing?

*Answers: (1) 72/96 = 0.75; 6/60 = 0.1. (2) 0.4 × 0.25 = 0.1, yes. (3) P(no tea) = 0.4, P(no tea | night) = 60/150 = 0.4; independent. (4) Sum even: both odd (3 × 3 = 9) or both even (2 × 2 = 4): 13/25. Sum ≥ 6: 25 − (sums 2 to 5: 1 + 2 + 3 + 4 = 10) = 15/25. Not fair. (5) 2 + 0.5 = $2.50 < $3; not worth it on average.*

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Geometry, Unit 8, Lessons 9–11, https://im.kendallhunt.com/HS/teachers/2/8/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
