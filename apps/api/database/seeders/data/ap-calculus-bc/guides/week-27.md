# Week 27 · Infinite Series, Geometric Series and the nth Term Test

**Topics:** 10.1 Defining Convergent and Divergent Infinite Series · 10.2 Working with Geometric Series · 10.3 The nth Term Test for Divergence
**Practices:** 1 (Implementing Mathematical Processes), 2 (Connecting Representations), 3 (Justification), 4 (Communication and Notation)
**Framework:** AP Calculus AB and BC CED, Unit 10, Topics 10.1–10.3, learning objectives in our own words
**Spiral:** Unit 10 starts here and fills the last six weeks of new material. It rests on limits at infinity (Unit 1) and on L'Hospital's Rule (week 9), which you will use constantly to find lim (n→∞) of a term. Improper integrals (week 17) are the continuous twin of an infinite series: both ask whether "adding up forever" gives a finite number, and next week the integral test makes that link exact. Partial fractions (week 16) reappear as the tool that makes a telescoping series collapse.

## What you need to be able to do

- **10.1** Write the partial sums Sₙ of a series and decide convergence from lim (n→∞) Sₙ.
- **10.1** Recover terms from a formula for the partial sums, and find the sum of a telescoping series.
- **10.2** Recognize a geometric series, identify its first term and common ratio, and decide whether it converges (|r| < 1).
- **10.2** Find the sum of a convergent geometric series, including ones that start at n = 1 or n = 2, repeating decimals and contexts such as bouncing balls and repeated doses.
- **10.3** Use the nth term test to show that a series diverges, and explain why the test can never show convergence.

## Key terms

| Term | Meaning |
|---|---|
| Sequence | An ordered list a₁, a₂, a₃, … of numbers. |
| Infinite series | The expression a₁ + a₂ + a₃ + …, written ∑ (n = 1 to ∞) aₙ. |
| nth partial sum | Sₙ = a₁ + a₂ + … + aₙ. |
| Convergent series | One whose partial sums have a finite limit S, called its sum. |
| Divergent series | One whose partial sums have no finite limit. |
| Telescoping series | One whose terms are differences bₙ − bₙ₊₁, so partial sums collapse. |
| Geometric series | ∑ a·rⁿ: each term is r times the one before. |
| Common ratio | The constant r = (next term)/(term) of a geometric series. |
| nth term test | If lim (n→∞) aₙ ≠ 0 (or does not exist), ∑ aₙ diverges. |

## What it means to add infinitely many numbers (10.1)

You cannot literally perform infinitely many additions. Instead, calculus does what it always does with "infinitely": it takes a limit. Add the first n terms to get a finite number, the **nth partial sum**

Sₙ = a₁ + a₂ + … + aₙ,

and ask what happens to Sₙ as n grows. If lim (n→∞) Sₙ = S, a finite number, the series **converges** and its sum is S. If the partial sums grow without bound, go to −∞, or wander without settling down, the series **diverges**.

Two sequences are in play and you must keep them apart. The **terms** aₙ are what you add; the **partial sums** Sₙ are the running totals. "aₙ → 0" says the things you add get small; "∑ aₙ converges" says the running totals level off. The second implies the first (see 10.3), but not the other way round.

Because each partial sum is the previous one plus a new term, Sₙ = Sₙ₋₁ + aₙ, and so

**aₙ = Sₙ − Sₙ₋₁ for n ≥ 2, with a₁ = S₁.**

Also, adding or deleting finitely many terms never changes *whether* a series converges, only the value of the sum. Convergence is decided by the tail.

**Worked example (a series given by its partial sums).** The partial sums of a series are Sₙ = 3n/(n + 2).

- Sum: lim (n→∞) 3n/(n + 2) = 3, so the series converges to 3.
- Fifth term: a₅ = S₅ − S₄ = 15/7 − 12/6 = 15/7 − 2 = 1/7.
- First term: a₁ = S₁ = 3/3 = 1.
- Tail: ∑ (n = 3 to ∞) aₙ = 3 − S₂ = 3 − 6/4 = 3/2.

**Telescoping series.** When each term is a difference of consecutive values of some sequence, almost everything cancels in a partial sum.

**Worked example (telescoping).** Find the sum of ∑ (n = 1 to ∞) 2/(n(n + 1)).

Partial fractions (week 16) give 2/(n(n + 1)) = 2/n − 2/(n + 1). Write out a partial sum:

Sₙ = (2 − 2/2) + (2/2 − 2/3) + (2/3 − 2/4) + … + (2/n − 2/(n + 1)).

Every middle piece cancels with its neighbour, leaving Sₙ = 2 − 2/(n + 1). Check: S₁ = 1, S₂ = 4/3, S₃ = 3/2, which match 1, 1 + 1/3 and 1 + 1/3 + 1/6. As n → ∞, 2/(n + 1) → 0, so the series converges to 2.

Not every telescoping series converges. For ∑ (n = 1 to ∞) ln(n/(n + 1)) = ∑ (ln n − ln(n + 1)), the partial sums are Sₙ = ln 1 − ln(n + 1) = −ln(n + 1), which go to −∞. The series diverges, even though its terms ln(n/(n + 1)) approach ln 1 = 0.

## Geometric series (10.2)

A **geometric series** is one in which each term is a fixed multiple r of the term before:

a + ar + ar² + ar³ + … = ∑ (n = 0 to ∞) a·rⁿ.

Its partial sums have a closed form. If Sₙ = a + ar + … + ar^(n−1), then rSₙ = ar + … + arⁿ, and subtracting gives Sₙ(1 − r) = a − arⁿ, so

Sₙ = a(1 − rⁿ)/(1 − r) for r ≠ 1.

If |r| < 1, rⁿ → 0 and Sₙ → a/(1 − r). If |r| > 1, |rⁿ| → ∞ and the partial sums blow up. If r = 1 the partial sums are na; if r = −1 they alternate between a and 0. So:

**A geometric series with a ≠ 0 converges exactly when |r| < 1, and then its sum is (first term)/(1 − r).**

Say "first term", not "a": then the formula works wherever the series starts.

**Worked example (three sums).**

- ∑ (n = 0 to ∞) 5(−2/3)ⁿ: first term 5, r = −2/3, |r| < 1. Sum = 5/(1 + 2/3) = 5/(5/3) = 3.
- ∑ (n = 2 to ∞) 3/4ⁿ: the first term is the n = 2 term, 3/16, and r = 1/4. Sum = (3/16)/(3/4) = 1/4.
- ∑ (n = 1 to ∞) (5/4)ⁿ: r = 5/4 > 1, so the series diverges.

To find r, divide any term by the one before it. Rewrite awkward forms first: 2 · 3ⁿ/5ⁿ⁺¹ = (2/5)(3/5)ⁿ, so r = 3/5.

**Worked example (a repeating decimal).** 0.272727… = 27/100 + 27/100² + 27/100³ + …, a geometric series with first term 27/100 and r = 1/100. Sum = (27/100)/(99/100) = 27/99 = 3/11.

**Worked example (a bouncing ball).** A ball is dropped from 6 m, and each time it lands it rebounds to 2/3 of the height it fell from. In this idealized model it bounces forever. Find the total vertical distance.

The first fall is 6 m. After that, every rebound height is travelled twice, up and down: 4, 8/3, 16/9, … metres, a geometric list with first term 4 and r = 2/3. Total = 6 + 2 · 4/(1 − 2/3) = 6 + 2 · 12 = 30 m. The doubled sum is the classic trap: the first drop is the only height travelled once.

**Worked example (a ratio that depends on x).** For which x does ∑ (n = 0 to ∞) ((x − 1)/3)ⁿ converge, and to what?

It is geometric with r = (x − 1)/3. Convergence needs |x − 1|/3 < 1, so |x − 1| < 3, that is −2 < x < 4 (endpoints excluded, since |r| = 1 there). The sum is 1/(1 − (x − 1)/3) = 3/(4 − x). So on −2 < x < 4 the function 3/(4 − x) *is* this series, an idea that grows into power series in weeks 31 and 32.

## The nth term test for divergence (10.3)

If ∑ aₙ converges to S, then

aₙ = Sₙ − Sₙ₋₁ → S − S = 0.

So the terms of every convergent series approach 0. Turn that around and you get a test:

**nth term test.** If lim (n→∞) aₙ ≠ 0, or the limit does not exist, then ∑ aₙ diverges.

It is a test for **divergence only**. When lim aₙ = 0 the test says nothing at all. Compare ∑ 1/n² (converges, week 28) with ∑ 1/n (diverges, week 28): both have terms approaching 0. The ln(n/(n + 1)) series above is a third example of terms going to 0 while the sum diverges.

**Worked example (nth term test).**

- ∑ (n = 1 to ∞) n/(2n + 1): lim n/(2n + 1) = 1/2 ≠ 0. The series diverges by the nth term test.
- ∑ (n = 1 to ∞) (1 + 1/n)ⁿ: the terms approach e ≠ 0 (a week 9 L'Hospital limit). Diverges.
- ∑ (n = 1 to ∞) (−1)ⁿ: lim (−1)ⁿ does not exist. Diverges.
- ∑ (n = 1 to ∞) (ln n)/√n: by L'Hospital, lim (ln n)/√n = lim (1/n)/(1/(2√n)) = lim 2/√n = 0. **Inconclusive**; another test is needed.

**Justification language.** Write the limit and name the test: "Because lim (n→∞) n/(2n + 1) = 1/2 ≠ 0, the series diverges by the nth term test." Never write "converges by the nth term test": no such conclusion exists.

The nth term test also explains why a geometric series with |r| ≥ 1 diverges: its terms a·rⁿ do not approach 0.

## Common mistakes

- **Wrong first term in a geometric sum.** ∑ (n = 1 to ∞) (2/3)ⁿ = (2/3)/(1/3) = 2, not 1/(1 − 2/3) = 3. Always plug the starting index into the term.
- **Misreading the ratio.** In 3ⁿ/5ⁿ⁺¹ the ratio is 3/5, not 5/3 and not 3/25. Divide a term by the one before to be sure.
- **Including endpoints.** A geometric series diverges when |r| = 1, so inequalities from |r| < 1 are strict.
- **"Terms go to 0, so it converges."** That is the converse of the nth term test, and it is false.
- **Confusing the limit of the terms with the sum.** lim aₙ = 0 for every convergent series; the sum is lim Sₙ.
- **Forgetting the doubled path in bouncing-ball problems,** or doubling the first drop as well.
- **Subtracting partial sums in the wrong order.** aₙ = Sₙ − Sₙ₋₁, the later sum minus the earlier one.

## Self-check

1. The partial sums of a series are Sₙ = 5 − 5/2ⁿ. Find a₃ and the sum of the series.
2. Find ∑ (n = 1 to ∞) 6(−1/2)ⁿ.
3. Write 0.454545… as a fraction in lowest terms.
4. For which x does ∑ (n = 0 to ∞) (2x)ⁿ converge? What is its sum there?
5. Does ∑ (n = 1 to ∞) (n² + 1)/(5n² − n) converge? Justify.
6. Find the sum of ∑ (n = 1 to ∞) (1/(n + 1) − 1/(n + 2)).

*Answers:* 1. a₃ = S₃ − S₂ = (5 − 5/8) − (5 − 5/4) = 5/8; the sum is lim Sₙ = 5. 2. First term −3, r = −1/2: −3/(3/2) = −2. 3. 45/99 = 5/11. 4. |2x| < 1, so −1/2 < x < 1/2; sum 1/(1 − 2x). 5. No: the terms approach 1/5 ≠ 0, so the series diverges by the nth term test. 6. Sₙ = 1/2 − 1/(n + 2) → 1/2.

---

*Original study material for this course, organised around the College Board AP Calculus AB and BC Course and Exam Description (Unit 10, Topics 10.1–10.3). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). AP® is a trademark of the College Board, which does not endorse this material.*
