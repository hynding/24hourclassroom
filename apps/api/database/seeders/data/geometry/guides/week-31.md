# Week 31 · Combining Events, the Addition Rule and Conditional Probability

**Lessons:** 8.5 Combining Events · 8.6 The Addition Rule · 8.7 Related Events · 8.8 Conditional Probability
**Practices:** MP2 (reason quantitatively), MP3 (construct arguments), MP6 (attend to precision)
**Built from:** IM Geometry, Unit 8, Lessons 5–8, in our own words
**Spiral:** two-way tables and sample spaces (week 30) are the raw material of every rule this week. Counting outcomes in a shared cell once, not twice, is the same care you took with overlapping regions when subtracting areas (weeks 20–21, composite solids and segments of circles, week 28). Dependence shows up in week 30's "without replacement" sample spaces.

## What you need to be able to do

- Describe the events "A and B", "A or B" and "not A" with Venn diagrams, lists and two-way tables, and find their probabilities by counting.
- State and use the addition rule P(A or B) = P(A) + P(B) − P(A and B), recognise mutually exclusive events, and use complements.
- Explain, with examples, what it means for two events to be dependent or independent, and decide which a given situation is (with and without replacement; game shows; collected data).
- Define conditional probability P(A | B) = P(A and B) ÷ P(B), read it as "the probability of A given that B happened", compute it from a table, a list or a description, and tell P(A | B) from P(B | A).

## Key terms

| Term | Meaning |
|---|---|
| A and B | The event that both happen: the overlap of the two sets of outcomes. |
| A or B | The event that at least one happens: the union, including the overlap. |
| Not A (complement) | The outcomes not in A; P(not A) = 1 − P(A). |
| Mutually exclusive | Events that cannot both happen: P(A and B) = 0. |
| Addition rule | P(A or B) = P(A) + P(B) − P(A and B). |
| Independent events | Knowing that one happened does not change the probability of the other. |
| Dependent events | Knowing that one happened changes the probability of the other. |
| Conditional probability P(A \| B) | The probability of A given that B has happened: P(A and B) ÷ P(B). |

## 1. Combining events (8.5)

Roll one die. A = "even" = {2, 4, 6}; B = "greater than 3" = {4, 5, 6}.

- A and B = {4, 6}: P = 2/6.
- A or B = {2, 4, 5, 6}: P = 4/6. Note that 4 and 6 are in both sets but counted once.
- Not A = {1, 3, 5}: P = 3/6 = 1 − P(A).

```
Figure description: a Venn diagram with two overlapping circles inside a
rectangle. The left circle A holds 2 (alone) and the overlap holds 4 and
6; the right circle B holds 5 alone; 1 and 3 sit outside both circles.

   ┌───────────────────────────┐
   │   A ( 2  ( 4 6 )  5 ) B   │
   │        1          3       │
   └───────────────────────────┘
```

**Worked example 1 — from a two-way table.** The school survey (week 30): walks / brings lunch, out of 200.

| | Brings | Buys | Total |
|---|---|---|---|
| Walks | 48 | 32 | 80 |
| Does not walk | 42 | 78 | 120 |
| Total | 90 | 110 | 200 |

P(walks and brings) = 48/200. P(walks or brings) = (48 + 32 + 42)/200 = 122/200. P(not walks) = 120/200.

**Worked example 2 — "or" in everyday language.** "Pick a card that is a heart or a face card." Hearts: 13. Face cards: 12. Both: 3 (J, Q, K of hearts). Hearts or face: 13 + 12 − 3 = 22 of 52.

**Worked example 3 — complements save work.** P(at least one six in four rolls) = 1 − P(no six in four rolls) = 1 − (5/6)⁴ ≈ 1 − 0.482 = 0.518. (The four rolls are independent, section 3.)

**Try it 1.1** One die: C = "prime" = {2, 3, 5}, D = "odd" = {1, 3, 5}. Find P(C and D), P(C or D), P(not C). *(Answer: 2/6; 4/6; 3/6.)*

## 2. The addition rule (8.6)

Adding P(A) and P(B) counts the overlap twice, so subtract it once:

**P(A or B) = P(A) + P(B) − P(A and B).**

Check on the die: P(even or > 3) = 3/6 + 3/6 − 2/6 = 4/6 ✓.

**Mutually exclusive events** cannot both happen, so P(A and B) = 0 and the rule becomes P(A or B) = P(A) + P(B). "Sum = 7" and "doubles" with two dice are mutually exclusive: 6/36 + 6/36 = 12/36.

**Worked example 4.** In a class, 60% play a sport, 45% play an instrument, 25% do both. P(sport or instrument) = 0.60 + 0.45 − 0.25 = 0.80. So 20% do neither.

**Worked example 5 — solving for the overlap.** P(A) = 0.5, P(B) = 0.4, P(A or B) = 0.7. Then P(A and B) = 0.5 + 0.4 − 0.7 = 0.2.

**Worked example 6 — spotting an impossible claim.** "P(rain) = 0.6, P(wind) = 0.7, P(rain or wind) = 0.9." Then P(both) = 0.6 + 0.7 − 0.9 = 0.4. Fine. But "P(rain) = 0.6, P(wind) = 0.7, P(rain or wind) = 1.5" is impossible: a probability cannot exceed 1. And "P(rain or wind) = 0.5" is impossible because it is less than P(wind).

**Try it 2.1** P(A) = 0.35, P(B) = 0.5, P(A and B) = 0.1. Find P(A or B) and P(neither). *(Answer: 0.75; 0.25.)*

**Try it 2.2** Two dice: find P(sum is 5 or the first die shows 1). *(Answer: 4/36 + 6/36 − 1/36 = 9/36 = 1/4; the shared outcome is (1, 4).)*

## 3. Related events (8.7)

Draw a crayon from a box with 3 red and 2 blue, note the colour, and draw again.

- **With replacement** (put the first back): the second draw's chances are the same as the first's, P(red) = 3/5 no matter what came first. The two draws are **independent**.
- **Without replacement:** if the first was red, the box now holds 2 red and 2 blue, so P(second red) = 2/4; if the first was blue, 3/4. The second draw depends on the first: **dependent** events.

Independence is about information, not about cause. Two events are independent if learning that one happened leaves the probability of the other unchanged.

**Worked example 7 — a game-show door.** Three doors hide one prize. You pick door 1. The host, who knows where the prize is, opens one of the other doors that is empty, and offers a switch.
- If you stay, you win exactly when your first pick was right: 1/3.
- If you switch, you win exactly when your first pick was wrong: 2/3.
Whether you win is dependent on whether you switch. Now change the rules: the host opens one of the other doors at random, and it happens to be empty. Then staying and switching each win with probability 1/2 (of the 6 equally likely combinations of prize location and random door, 2 are discarded because the host revealed the prize; of the remaining 4, your first pick is right in 2). Here winning is independent of switching. The difference is what the host knows.

**Worked example 8 — names from a hat.** Twelve names, 5 from class A. Two are drawn without replacement. P(second is from A | first was from A) = 4/11; P(second is from A | first was not) = 5/11. Dependent.

**Worked example 9 — data decides.** A player makes 70% of free throws overall. Are "makes the first" and "makes the second" independent? Counting cannot answer this; you need records of pairs of shots. If after a make she hits 70% and after a miss she also hits 70%, the shots are independent; if the rates differ, they are dependent.

**Try it 3.1** A coin is tossed and a die is rolled. Are "heads" and "rolls a 6" independent? *(Answer: yes; the coin has no effect on the die, and P(6) = 1/6 whichever side the coin shows.)*

**Try it 3.2** A deck of 52 cards; draw two without replacement. Are "first is an ace" and "second is an ace" independent? *(Answer: no; P(second ace) is 3/51 after an ace and 4/51 after a non-ace.)*

## 4. Conditional probability (8.8)

**P(A | B)**, read "the probability of A given B", is the probability of A once you know B has happened. The sample space shrinks to the outcomes in B:

**P(A | B) = P(A and B) ÷ P(B) = (outcomes in A and B) ÷ (outcomes in B).**

**Worked example 10 — a die.** P(even | greater than 3) = P(even and > 3)/P(> 3) = (2/6)/(3/6) = 2/3: of the outcomes 4, 5, 6, two are even. Compare P(> 3 | even) = (2/6)/(3/6) = 2/3 as well here, but in general the two orders differ.

**Worked example 11 — from the table.** P(brings lunch | walks) = 48/80 = 0.60. P(walks | brings lunch) = 48/90 ≈ 0.53. These are different questions: "of the walkers, how many bring?" versus "of the bringers, how many walk?". Row and column relative frequencies (week 30) were conditional probabilities all along.

**Worked example 12 — without replacement, as a formula.** Box with 3 red, 2 blue, two draws. P(both red) = P(first red) × P(second red | first red) = (3/5)(2/4) = 6/20 = 0.3. This is the multiplication rule: **P(A and B) = P(B) × P(A | B).**

**Worked example 13 — a tree.** Of a town's drivers, 20% are under 25. Of the under-25s, 30% had an accident last year; of the others, 10% did. P(under 25 and accident) = 0.2 × 0.3 = 0.06. P(accident) = 0.06 + 0.8 × 0.1 = 0.14. P(under 25 | accident) = 0.06/0.14 ≈ 0.43: among drivers who had an accident, 43% were under 25, even though they are only 20% of drivers.

```
Figure description: a tree. First split: under 25 (0.2) / 25 or over
(0.8). From under 25: accident (0.3) / none (0.7). From 25 or over:
accident (0.1) / none (0.9). Leaf probabilities: 0.06, 0.14, 0.08, 0.72.
```

**Worked example 14 — independence in this language.** A and B are independent exactly when P(A | B) = P(A): learning B changes nothing. Coin and die: P(6 | heads) = 1/6 = P(6). Crayons without replacement: P(red second | red first) = 1/2 ≠ 3/5 = P(red second): dependent.

**Try it 4.1** Two dice. Find P(sum = 8 | first die is 3). *(Answer: given a 3 first, the second must be 5: 1/6.)*

**Try it 4.2** From the school table, find P(does not walk | buys lunch). *(Answer: 78/110 ≈ 0.71.)*

## Common mistakes

- **Adding probabilities of overlapping events without subtracting the overlap.** "Heart or face card" is 22/52, not 25/52.
- **Confusing "and" with "or".** "And" is the overlap (smaller); "or" is the union (larger).
- **Assuming independence because events seem unrelated.** Draws without replacement are dependent even if the colours have nothing to do with each other.
- **Assuming dependence means cause.** Dependence is about information.
- **Reversing the condition.** P(A | B) and P(B | A) have different denominators.
- **Dividing by the wrong total.** For P(A | B), divide by P(B) or the count in B, never by the grand total.
- **Calling mutually exclusive events independent.** If A and B cannot both happen and both have positive probability, knowing A happened tells you B did not: they are dependent.

## Where this goes next

Week 32 computes conditional probabilities straight from two-way tables, turns "P(A | B) = P(A)" into a test for independence (and its multiplication form P(A and B) = P(A)P(B)), judges approximate independence from data, and analyses games with trees and tables. The final exam weights Unit 8 lightly, but conditional probability and the addition rule are always on it.

## Self-check

1. One die: E = "at most 2", F = "odd". Find P(E and F), P(E or F), P(not F).
2. P(A) = 0.6, P(B) = 0.3, P(A and B) = 0.2. Find P(A or B).
3. A bag has 4 white and 6 black beads. Two are drawn without replacement. Find P(both white). Are the draws independent?
4. Using the school table, find P(buys lunch | does not walk).
5. 30% of a town's households own a dog; of dog owners 40% also own a cat; of non-owners 20% own a cat. Find P(dog and cat), P(cat), and P(dog | cat).

*Answers: (1) {1}: 1/6; {1, 2, 3, 5}: 4/6; 3/6. (2) 0.7. (3) (4/10)(3/9) = 12/90 = 2/15; no, dependent. (4) 78/120 = 0.65. (5) 0.12; 0.12 + 0.14 = 0.26; 0.12/0.26 ≈ 0.46.*

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Geometry, Unit 8, Lessons 5–8, https://im.kendallhunt.com/HS/teachers/2/8/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
