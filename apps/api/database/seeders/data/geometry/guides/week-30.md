# Week 30 · Chance, Sample Spaces and Two-Way Tables

**Lessons:** 8.1 Up to Chance · 8.2 Playing with Probability · 8.3 Sample Spaces · 8.4 Tables of Relative Frequencies
**Practices:** MP2 (reason quantitatively), MP4 (model with mathematics), MP6 (attend to precision)
**Built from:** IM Geometry, Unit 8, Lessons 1–4, in our own words
**Spiral:** probability is new, but its first tool is one you own: a fraction of a whole. A spinner's region is a sector, so its probability is its central angle over 360° (week 28), or its area over the circle's area (week 28); a dartboard's rings compare by area scaling (week 18). Counting outcomes with tables is the same organised listing you used for congruence cases.

## What you need to be able to do

- Use the words outcome, sample space, event and probability correctly; assign probabilities to equally likely outcomes and to spinner regions by size; compare a probability model with the relative frequency observed in an experiment.
- Decide whether a game is fair, and explain the difference between chance and skill in an experiment.
- List a sample space systematically (a list, a table or a tree diagram), count it with the multiplication principle, and find the probability of an event by counting.
- Build a two-way table of counts and convert it to relative frequencies (by the grand total, by row, or by column), and read probabilities from it.

## Key terms

| Term | Meaning |
|---|---|
| Chance experiment | A process whose result is not known in advance: a coin toss, a spin, a draw. |
| Outcome | One possible result of the experiment. |
| Sample space | The set of all possible outcomes. |
| Event | Any collection of outcomes (a subset of the sample space). |
| Probability of an event | A number from 0 (impossible) to 1 (certain) measuring how likely it is. With equally likely outcomes, P = (number of outcomes in the event) ÷ (number in the sample space). |
| Relative frequency | (number of times an event happened) ÷ (number of trials) in an actual experiment. |
| Fair game | Every player has the same probability of winning. |
| Two-way table | A table of counts classified by two variables at once. |
| Relative frequency table | A two-way table divided through by the grand total (or by a row or column total). |

## 1. Up to chance (8.1)

A **chance experiment** has outcomes you cannot predict individually but can describe collectively. Tossing a coin: sample space {H, T}. Rolling a die: {1, 2, 3, 4, 5, 6}. The event "even number" is {2, 4, 6}.

When outcomes are **equally likely**, P(event) = (favourable outcomes) ÷ (all outcomes). P(even) = 3/6 = 1/2. P(at least 5) = 2/6 = 1/3. P(7) = 0. P(less than 7) = 1.

**Spinners with unequal regions.** The outcomes are not equally likely; the probability of a region is its share of the circle: central angle ÷ 360° (or its area ÷ the circle's area, which is the same ratio).

**Worked example 1.** A spinner has three regions with central angles 90°, 120° and 150°. P(first) = 1/4, P(second) = 1/3, P(third) = 5/12. The three add to 1.

**Worked example 2 — multiple-choice guessing.** A question has four options and one correct answer; guessing at random gives P(correct) = 1/4. If a question has five options and two of them are counted correct, a single random pick is right with probability 2/5.

**Worked example 3 — model versus experiment.** A model says a spinner lands on red with probability 0.3. In 50 spins it lands on red 19 times: relative frequency 19/50 = 0.38. That is close to 0.3 for a small number of spins; more spins would usually bring the relative frequency closer to the model, but it almost never equals it exactly. A relative frequency of 0.9 after 50 spins would make you doubt the model.

**Chance or skill?** Picking a card is chance; a free throw is partly skill, so its probability must be estimated from data (the player's record), not from counting outcomes.

**Try it 1.1** A bag holds 3 red, 5 blue and 2 green marbles. One is drawn at random. Find P(blue) and P(not green). *(Answer: 5/10 = 1/2; 8/10 = 4/5.)*

**Try it 1.2** A spinner has a 72° red region. What is P(red)? *(Answer: 72/360 = 1/5.)*

## 2. Playing with probability (8.2)

A game is **fair** when each player is equally likely to win. To decide, list the sample space and count.

**Worked example 4.** Two players each flip a coin. A wins if the coins match, B if they differ. Sample space {HH, HT, TH, TT}: match in 2 of 4, differ in 2 of 4. Fair.

**Worked example 5.** Roll two dice; A wins if the sum is 7, B wins if the sum is 8. Of the 36 equally likely pairs, 6 give a 7 (1+6, 2+5, 3+4, 4+3, 5+2, 6+1) and 5 give an 8. P(A wins) = 6/36, P(B wins) = 5/36; the game is not fair (and often nobody wins).

**Worked example 6 — making it fair.** With a spinner of equal thirds labelled 1, 2, 3, "A wins on 1, B on 2 or 3" is unfair (1/3 vs 2/3). "A wins on an odd number, B on even" is also unfair (2/3 vs 1/3). "Spin twice; A wins if the two spins match" gives 3 matches of 9 pairs: 1/3 vs 2/3, still unfair. Giving A the number 1 and B the number 2, with 3 a re-spin, is fair.

**Worked example 7 — a simulation.** To estimate P(a 4-child family has exactly two girls) without a formula, flip four coins many times and record how often exactly two heads appear. With 200 trials you might get 78, relative frequency 0.39; the exact value is 6/16 = 0.375.

**Try it 2.1** Roll one die; A wins on a multiple of 3, B wins on a 1 or a 2. Fair? *(Answer: 2/6 each, fair; a 4 or 5 is nobody's win.)*

## 3. Sample spaces (8.3)

Three ways to write out a sample space:

- **A list** — fine for small experiments: {HH, HT, TH, TT}.
- **A table** — for two actions: rows for the first die, columns for the second, 36 cells.
- **A tree diagram** — for actions in sequence: each branch point lists the options for the next action; the number of leaves is the size of the sample space.

**The multiplication principle.** If one action has m outcomes and a second has n, the pair has m × n outcomes. Three coins: 2 × 2 × 2 = 8. A coin and a die: 2 × 6 = 12. Two dice: 36.

**Worked example 8.** Toss three coins. P(exactly two heads): the sample space has 8 outcomes; HHT, HTH, THH are the three with exactly two heads: 3/8. P(at least one head) = 1 − P(TTT) = 7/8.

**Worked example 9 — two dice table.**

| | 1 | 2 | 3 | 4 | 5 | 6 |
|---|---|---|---|---|---|---|
| **1** | 2 | 3 | 4 | 5 | 6 | 7 |
| **2** | 3 | 4 | 5 | 6 | 7 | 8 |
| **3** | 4 | 5 | 6 | 7 | 8 | 9 |
| **4** | 5 | 6 | 7 | 8 | 9 | 10 |
| **5** | 6 | 7 | 8 | 9 | 10 | 11 |
| **6** | 7 | 8 | 9 | 10 | 11 | 12 |

P(sum = 7) = 6/36 = 1/6. P(sum ≤ 4) = 6/36 = 1/6 (sums 2, 3, 3, 4, 4, 4). P(doubles) = 6/36. P(sum is 7 or doubles) = 12/36, since no double sums to 7.

**Worked example 10 — a tree.** A lunch is one of 3 mains, 2 sides and 4 drinks: 3 × 2 × 4 = 24 lunches. If the mains are chosen at random and one of them is vegetarian, P(vegetarian main) = 1/3, however many sides and drinks there are: 8 of the 24 leaves.

**Worked example 11 — without replacement.** Draw two cards from {A, B, C, D} without putting the first back. The sample space is the 4 × 3 = 12 ordered pairs. P(A is one of the two) = 6/12 = 1/2 (A first: 3 pairs; A second: 3 pairs).

**Try it 3.1** A password is one letter from {x, y, z} followed by one digit from {1, 2, 3, 4, 5}. How many passwords? P(it starts with x and ends with an even digit)? *(Answer: 15; 2/15.)*

**Try it 3.2** Two dice: find P(the product is odd). *(Answer: both odd: 3 × 3 = 9 of 36, so 1/4.)*

## 4. Tables of relative frequencies (8.4)

A **two-way table** records counts for two variables at once. A survey of 200 students asked whether they walk to school and whether they bring lunch.

| | Brings lunch | Buys lunch | Total |
|---|---|---|---|
| Walks | 48 | 32 | 80 |
| Does not walk | 42 | 78 | 120 |
| Total | 90 | 110 | 200 |

**Relative frequencies by the grand total** (divide every cell by 200):

| | Brings lunch | Buys lunch | Total |
|---|---|---|---|
| Walks | 0.24 | 0.16 | 0.40 |
| Does not walk | 0.21 | 0.39 | 0.60 |
| Total | 0.45 | 0.55 | 1.00 |

If a student is chosen at random: P(walks) = 0.40, P(brings lunch) = 0.45, P(walks and brings lunch) = 0.24, P(walks or brings lunch) = 0.24 + 0.16 + 0.21 = 0.61.

**Row relative frequencies** (divide by the row total) answer "among walkers, …": 48/80 = 0.60 of walkers bring lunch, versus 42/120 = 0.35 of non-walkers. **Column relative frequencies** (divide by the column total) answer "among lunch-bringers, …": 48/90 ≈ 0.53 walk.

```
Figure description: the 200 students as a 10-by-20 grid of dots. The top
8 rows (80 dots) are walkers; within them the first 48 dots are shaded
"brings lunch". Reading the shaded share of the top block (48 of 80) is
a row relative frequency; the shaded share of the whole grid (90 of 200)
is a column total's relative frequency.
```

**Worked example 12.** From the table: P(does not walk and buys lunch) = 78/200 = 0.39. Among those who buy lunch, the fraction who walk is 32/110 ≈ 0.29.

**Worked example 13 — building a table from words.** Of 60 pets at a clinic, 35 are dogs; 20 of the dogs and 10 of the other pets are over 5 years old. Table: dogs over 5: 20, dogs 5 or under: 15; others over 5: 10, others 5 or under: 15. P(over 5) = 30/60 = 0.5; among dogs, 20/35 ≈ 0.57 are over 5.

**Try it 4.1** Using the school table, find P(does not walk or brings lunch). *(Answer: 0.21 + 0.39 + 0.24 = 0.84, or 1 − 0.16.)*

**Try it 4.2** What fraction of lunch-buyers do not walk? *(Answer: 78/110 ≈ 0.71.)*

## Common mistakes

- **Treating unequal outcomes as equally likely.** A spinner with a big and a small region is not 50–50.
- **Counting the event in a different sample space from the total.** For "sum = 7" the 36 ordered pairs are the sample space, not the 11 possible sums.
- **Forgetting order.** (2, 5) and (5, 2) are different outcomes with two dice.
- **Expecting an experiment to match the model exactly.** Relative frequency wobbles; it settles near the model over many trials.
- **Dividing by the wrong total in a two-way table.** Grand total for P(A and B); row total for "among the As".
- **Calling a game fair because both players can win.** Fair means equal probabilities.

## Where this goes next

Week 31 combines events: "A or B", "A and B", complements, the addition rule, and then dependence and conditional probability, where "among the walkers" becomes P(brings lunch | walks). Week 32 reads conditional probabilities straight from two-way tables, tests for independence, and analyses games.

## Self-check

1. A spinner has regions of 45°, 135° and 180°. Give the three probabilities.
2. Roll two dice. Find P(sum = 9) and P(sum ≥ 10).
3. How many outcomes does tossing a coin four times have? Find P(exactly one head).
4. From the school table, find P(walks and buys lunch) and the fraction of walkers who buy lunch.
5. A game: spin a fair spinner with 5 equal regions numbered 1–5; A wins on a prime, B on 1 or 4. Is it fair?

*Answers: (1) 1/8, 3/8, 1/2. (2) 4/36 = 1/9; 6/36 = 1/6. (3) 16; 4/16 = 1/4. (4) 0.16; 32/80 = 0.40. (5) primes 2, 3, 5: A 3/5, B 2/5; not fair.*

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Geometry, Unit 8, Lessons 1–4, https://im.kendallhunt.com/HS/teachers/2/8/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
