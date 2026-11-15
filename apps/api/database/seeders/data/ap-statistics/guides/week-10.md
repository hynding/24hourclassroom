# Week 10 · Mutually Exclusive Events, Conditional Probability and Independence

**Topics:** 2.5 Mutually Exclusive Events · 2.6 Conditional Probability · 2.7 Independent Events and Unions of Events
**Practices:** 3 (Analyze Data), 4 (Interpret Results)
**Framework:** AP Statistics CED (effective fall 2026), Unit 2, Topics 2.5–2.7, learning objectives in our own words
**Spiral:** Week 8 computed conditional relative frequencies from two-way tables and judged association. Week 9 defined probability, sample spaces and the complement rule. This week turns those relative frequencies into the rules for "or", "and" and "given", and shows that independence is the probability version of "no association".

## What you need to be able to do

- **2.5** Decide whether two events are mutually exclusive, and use P(A or B) = P(A) + P(B) for mutually exclusive events.
- **2.6** Compute a conditional probability P(A | B) from a two-way table, from a tree diagram or from the formula P(A and B)/P(B), and tell it apart from P(B | A).
- **2.6** Use the multiplication rule P(A and B) = P(A) · P(B | A), including for draws without replacement.
- **2.7** Check whether two events are independent by comparing P(A | B) with P(A), and use P(A and B) = P(A) · P(B) only when they are.
- **2.7** Use the general addition rule P(A or B) = P(A) + P(B) − P(A and B), and explain why mutually exclusive events with positive probabilities cannot be independent.

## Key terms

| Term | Meaning |
|---|---|
| Mutually exclusive (disjoint) | A and B cannot happen together: P(A and B) = 0. |
| Union, A or B | A happens, B happens, or both happen. |
| Intersection, A and B | Both A and B happen. |
| Conditional probability P(A \| B) | The probability that A happens, given that B is known to have happened: P(A and B)/P(B). |
| Multiplication rule | P(A and B) = P(A) · P(B \| A). |
| Independent events | Knowing whether one happened does not change the probability of the other: P(A \| B) = P(A). |
| General addition rule | P(A or B) = P(A) + P(B) − P(A and B). |
| Tree diagram | Branches for the first stage, then conditional branches for the second; multiply along a path, add across paths. |

## Mutually exclusive events (2.5)

Two events are **mutually exclusive** if they share no outcomes, so they cannot both happen on one repetition. For mutually exclusive events only,

> P(A or B) = P(A) + P(B).

**Worked example 1 (first class of the day).** At a hypothetical school, a randomly chosen student's first class is mathematics with probability 0.28 and English with probability 0.25. Each student has exactly one first class, so the events are mutually exclusive, and P(math or English) = 0.28 + 0.25 = 0.53. P(neither) = 1 − 0.53 = 0.47.

By contrast, "takes mathematics this year" and "takes English this year" are **not** mutually exclusive: most students do both, so adding the probabilities would count them twice.

## Conditional probability (2.6)

A conditional probability restricts attention to the individuals or outcomes in the given event. In a two-way table, that means using one row or one column as the denominator, exactly as in week 8. As a formula,

> P(A | B) = P(A and B) / P(B), provided P(B) > 0.

Rearranging gives the **multiplication rule**, P(A and B) = P(B) · P(A | B) = P(A) · P(B | A).

**Worked example 2 (gym memberships).** A hypothetical gym classified 600 members by plan and by whether they attend at least three times a week.

| | Attends 3+ a week | Attends less | Total |
|---|---|---|---|
| Monthly plan | 72 | 288 | 360 |
| Annual plan | 96 | 144 | 240 |
| Total | 168 | 432 | 600 |

Choose a member at random. Let A = annual plan and F = attends 3+ times a week.

- P(F) = 168/600 = 0.28.
- P(F | A) = 96/240 = 0.40: among annual members, 40% attend frequently.
- P(A | F) = 96/168 ≈ 0.571: among frequent attenders, about 57% are annual members. Same cell, different denominator, different answer. Confusing P(F | A) with P(A | F) is the most common conditional-probability error.
- Formula check: P(F and A) = 96/600 = 0.16 and P(A) = 240/600 = 0.40, so P(F | A) = 0.16/0.40 = 0.40.

### Tree diagrams and reversing a conditional

When the information comes as stages ("first this, then, given that, this"), draw a tree. Multiply along each path to get "and" probabilities; add the paths that lead to the event you want.

**Worked example 3 (spam filter).** At a hypothetical school, 30% of the emails sent to student accounts are spam. The filter flags 92% of spam emails and 4% of legitimate emails.

```
Spam 0.30 ──── flagged 0.92 → 0.30 × 0.92 = 0.276
          └─── not flagged 0.08 → 0.024
Legit 0.70 ─── flagged 0.04 → 0.70 × 0.04 = 0.028
          └─── not flagged 0.96 → 0.672
```

- P(flagged) = 0.276 + 0.028 = 0.304.
- P(spam | flagged) = P(spam and flagged)/P(flagged) = 0.276/0.304 ≈ 0.908.

So about 91% of flagged emails are spam, which is not the same as the 92% of spam that gets flagged. The tree gives P(flagged | spam); the question asked for the reverse, and the formula for conditional probability turns one into the other.

**Without replacement.** Drawing two names from 10 (4 boys, 6 girls) without replacement, P(both girls) = (6/10)(5/9) = 1/3 ≈ 0.333. The second factor is conditional: once a girl is drawn, 5 girls remain among 9 names.

## Independence and unions (2.7)

Events A and B are **independent** if knowing that one occurred does not change the probability of the other:

> P(A | B) = P(A) (equivalently P(B | A) = P(B), or P(A and B) = P(A) · P(B)).

To check independence from data, compare a conditional probability with the unconditional one. In the gym table, P(F | A) = 0.40 but P(F) = 0.28, so plan type and frequent attendance are **not** independent. (In week 8 language: they are associated.)

The **general addition rule** works for any two events:

> P(A or B) = P(A) + P(B) − P(A and B).

Subtracting P(A and B) removes the double count. For the gym, P(A or F) = 0.40 + 0.28 − 0.16 = 0.52. If A and B are mutually exclusive, P(A and B) = 0 and the rule reduces to the 2.5 version.

**Worked example 4 (two traffic lights).** On a hypothetical drive to school, the first light is green with probability 0.55 and the second with probability 0.40, and the lights operate independently.

- P(both green) = 0.55 × 0.40 = 0.22 (independent, so multiply).
- P(at least one green) = 0.55 + 0.40 − 0.22 = 0.73 by the general addition rule.
- Check with the complement: P(neither green) = 0.45 × 0.60 = 0.27, and 1 − 0.27 = 0.73.

If the lights were timed together (not independent), the 0.55 × 0.40 product would be wrong; you would need P(second green | first green).

### Mutually exclusive is not independent

These ideas are easy to mix up, but they are nearly opposites. If A and B are mutually exclusive and both have positive probability, then knowing A happened tells you B **did not** happen: P(B | A) = 0, which is not P(B). So mutually exclusive events with positive probabilities are always **dependent**. Independent events with positive probabilities can happen together, so they are never mutually exclusive.

| Question | Mutually exclusive | Independent |
|---|---|---|
| Can both happen at once? | No | Yes |
| P(A and B) | 0 | P(A) · P(B) |
| P(A or B) | P(A) + P(B) | P(A) + P(B) − P(A)P(B) |
| P(B \| A) | 0 | P(B) |

## Common mistakes

- **Adding probabilities of events that overlap.** Use the general addition rule unless the events are mutually exclusive.
- **Multiplying probabilities of events that are not independent.** Use P(A) · P(B | A) in general.
- **Swapping the conditional.** P(flagged | spam) = 0.92 is not P(spam | flagged) ≈ 0.908; P(F | A) = 0.40 is not P(A | F) ≈ 0.571.
- **Calling mutually exclusive events independent.** Disjoint events with positive probabilities are dependent.
- **Checking independence with counts.** Compare proportions: P(A | B) against P(A).
- **Forgetting that a second draw without replacement changes the probabilities.**

## Where this goes next

Week 11 attaches numbers to outcomes (random variables) and finds a probability distribution's mean and standard deviation. Week 12's binomial distribution needs independent trials and the multiplication rule from this week. Week 22's chi-square test for independence asks whether data give convincing evidence against independence in a population.

## Self-check

1. P(A) = 0.35, P(B) = 0.25 and A and B are mutually exclusive. Find P(A or B) and P(A and B).
2. P(A) = 0.6, P(B) = 0.5 and P(A and B) = 0.3. Are A and B independent? Find P(A or B).
3. Using the gym table, find P(monthly plan | attends less than 3 times a week).
4. Two independent machines each work on a given day with probability 0.9. Find P(at least one works).
5. Can two events with P(A) = 0.4 and P(B) = 0.3 be both mutually exclusive and independent? Explain.
6. In worked example 3, find P(legitimate | not flagged).

*Answers:* 1. 0.60; 0. 2. Yes: 0.6 × 0.5 = 0.3 = P(A and B). P(A or B) = 0.6 + 0.5 − 0.3 = 0.8. 3. 288/432 ≈ 0.667. 4. 1 − 0.1 × 0.1 = 0.99. 5. No. Mutually exclusive needs P(A and B) = 0; independent needs P(A and B) = 0.12. 6. P(not flagged) = 0.024 + 0.672 = 0.696, so 0.672/0.696 ≈ 0.966.

---

*Original study material for this course, organised around the College Board AP Statistics Course and Exam Description (Unit 2, Topics 2.5–2.7). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). All data are invented. AP® is a trademark of the College Board, which does not endorse this material.*
