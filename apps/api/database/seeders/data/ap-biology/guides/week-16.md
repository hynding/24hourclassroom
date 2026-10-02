# Week 16 · Mendelian Genetics

**CED topics:** 5.3 Mendelian Genetics
**Big Ideas:** Information Storage and Transmission (IST), Evolution (EVO)
**Built from:** OpenStax *Biology 2e* §12.1 Mendel's Experiments and the Laws of Probability; §12.2 Characteristics and Traits; §12.3 Laws of Inheritance
**Spiral:** keep week 15 in mind. Segregation is anaphase I and independent assortment is metaphase I; Mendel described the output of meiosis without ever seeing a chromosome.

## What you need to be able to do

The College Board phrases the learning objective for this week as:

- **5.3** Explain the inheritance of genes and traits as described by Mendel's laws, including the use of the rules of probability, Punnett squares and pedigree analysis to predict and analyse the outcomes of crosses; and apply the chi-square test to evaluate whether observed results fit a predicted ratio.

In plain language: given any cross you must be able to write the gametes, predict the ratio, calculate the probability of a particular offspring, read a family tree, and then test real counts against the prediction with the chi-square equation on the formula sheet.

## Key vocabulary

| Term | Meaning |
|---|---|
| Gene / allele | A stretch of DNA affecting a trait / one version of that gene at the same locus on homologous chromosomes. |
| Genotype / phenotype | The pair of alleles carried (YY, Yy, yy) / the trait observed. |
| Homozygous / heterozygous | Both alleles the same / two different alleles. |
| Dominant / recessive | The allele seen in a heterozygote / the allele masked there, seen only when homozygous. |
| True-breeding | A line whose self-fertilised offspring all resemble the parent: homozygous. |
| P, F1, F2 | Parents, first filial generation, second filial generation. |
| Monohybrid / dihybrid cross | A cross tracking one gene / two genes. |
| Test cross | A cross to a homozygous recessive to reveal an unknown dominant-phenotype genotype. |
| Law of segregation | The two alleles of a gene separate into different gametes (anaphase I). |
| Law of independent assortment | Alleles of different genes are sorted into gametes independently (metaphase I). |
| Product rule / sum rule | Multiply for "and" (independent events together) / add for "or" (mutually exclusive routes). |
| Pedigree | A family diagram: squares male, circles female, shaded affected. |
| Carrier | A heterozygote for a recessive allele; unaffected but able to pass the allele on. |
| Chi-square (χ²) | Σ (o − e)²/e, used to decide whether observed counts fit an expected ratio. |
| Null hypothesis | The claim that any difference between observed and expected is due to chance. |

## Mendel's method

Mendel chose the garden pea because it self-fertilises inside a closed flower, so lines breed true and a cross can be controlled by cutting away the anthers; because it grows in one season and by the thousand; and because the seven traits he picked came in two clean forms (violet or white, round or wrinkled, tall or dwarf) rather than a continuous range. He crossed true-breeding parents (P), grew the hybrids (F1), let the hybrids self-fertilise, and counted the F2.

The F1 were uniform: every plant showed one parental trait. The F2 brought the other trait back, in about a quarter of the plants. Flower colour gave 705 violet : 224 white (3.15 : 1); seed colour 6,022 yellow : 2,001 green (3.01 : 1); every trait landed close to 3 : 1 because he counted thousands. The disappearing-and-returning trait killed the **blending** hypothesis, under which white would have been diluted forever. Hereditary factors are **particles** that pass through a hybrid unchanged.

Mendel's inferences: each plant carries two factors per trait; a heterozygote shows the **dominant** one; the factors **segregate** so that each gamete carries one; and the factors for different traits assort **independently**. We now say gene, allele and chromosome, and we can point at the meiotic events: segregation is anaphase I, independent assortment is metaphase I.

## Crosses and ratios

**Monohybrid.** Yy × Yy. Gametes Y and y from each parent, four equally likely boxes: 1 YY : 2 Yy : 1 yy by genotype, 3 yellow : 1 green by phenotype. The two ratios differ because YY and Yy look alike.

**Test cross.** You cannot tell YY from Yy by looking. Cross the unknown with yy: a YY parent gives all yellow offspring, a Yy parent gives about 1 yellow : 1 green. A single green offspring proves the parent carried y; a long run with none is strong evidence of YY, never proof.

**Dihybrid.** YyRr × YyRr. Each parent makes four gamete types, YR, Yr, yR and yr, in equal numbers (independent assortment). Sixteen boxes give **9 yellow round : 3 yellow wrinkled : 3 green round : 1 green wrinkled.** The 9 : 3 : 3 : 1 is simply two 3 : 1 ratios multiplied: P(yellow) × P(round) = 3/4 × 3/4 = 9/16, and so on. That is the product rule at work, and it is also why a departure from 9 : 3 : 3 : 1 is the first clue to linkage (week 17).

**Dihybrid test cross.** YyRr × yyrr gives 1 : 1 : 1 : 1, because the recessive parent contributes nothing visible and the four classes simply report the heterozygote's gametes.

## The rules of probability

Use the **product rule** when independent things must *all* happen: the probability that two Aa parents have an aa child and then another aa child is 1/4 × 1/4 = 1/16. Use the **sum rule** when there are several mutually exclusive *ways* to get what you want: the probability that an AaBb × AaBb offspring shows exactly one dominant trait is (3/4 × 1/4) + (1/4 × 3/4) = 6/16.

For three or more genes, skip the Punnett square. Treat each gene as its own cross and multiply down the branches (the **forked-line method**). AaBbCc × AaBbCc: P(aabbcc) = (1/4)³ = 1/64; P(dominant at all three) = (3/4)³ = 27/64; P(A_ B_ cc) = 3/4 × 3/4 × 1/4 = 9/64.

Every birth is an independent trial. Three unaffected children do not make the fourth "due"; it is still 1/4.

## Reading a pedigree

Squares are males, circles females, shaded symbols affected, a horizontal line joins mates, a vertical line drops to children, generations are numbered I, II, III. Decide the mode by elimination:

- **Two unaffected parents with an affected child** means the trait is recessive and both parents are carriers.
- **An affected child whose parents are both affected... but one child unaffected** means the trait is dominant and the parents are heterozygous.
- **Dominant** traits appear in every generation; every affected person has an affected parent. **Recessive** traits skip generations.
- An affected **daughter with an unaffected father** rules out X-linked recessive (she would need a recessive X from him). More on sex linkage next week.

Once the mode is set, work backwards from affected individuals (aa means both parents carried a), then forwards with a Punnett square for the probability of the next child.

## The chi-square test

The formula sheet gives **χ² = Σ (o − e)² / e** and a table of critical values.

| Degrees of freedom | 1 | 2 | 3 | 4 | 5 |
|---|---|---|---|---|---|
| Critical χ² at p = 0.05 | 3.84 | 5.99 | 7.81 | 9.49 | 11.07 |
| Critical χ² at p = 0.01 | 6.63 | 9.21 | 11.34 | 13.28 | 15.09 |

The recipe: state the null hypothesis (the observed counts differ from the predicted ratio only by chance); convert the ratio into **expected counts** (ratio fraction × total, never percentages); compute χ²; find **df = number of classes − 1**; compare with the critical value. If χ² exceeds it, reject the null: the cross does not fit the ratio, so look for linkage, lethality, epistasis or a scoring error. If it does not, **fail to reject**: the data are consistent with the ratio. A chi-square test never proves a hypothesis.

## Worked example 1: a dihybrid probability without a square

*What fraction of the offspring of AaBbCc × AaBbCc will show the dominant phenotype for A and B and the recessive phenotype for C?*

Each gene is an Aa × Aa cross: P(dominant phenotype) = 3/4, P(recessive) = 1/4. Multiply: 3/4 × 3/4 × 1/4 = 9/64 ≈ 0.14. If the question had asked for "dominant for A and B but recessive for *either* C *or* D" in a tetrahybrid, you would add the two routes and subtract their overlap. Read the connective words: *and* multiplies, *or* adds.

## Worked example 2: chi-square on cross data

A student self-crosses YyRr plants and scores 320 F2 seeds: 176 yellow round, 64 yellow wrinkled, 58 green round, 22 green wrinkled.

1. Null hypothesis: independent assortment and complete dominance, so 9 : 3 : 3 : 1.
2. Expected: 320 × 9/16 = 180, 320 × 3/16 = 60, 60, 320 × 1/16 = 20.
3. χ² = (176 − 180)²/180 + (64 − 60)²/60 + (58 − 60)²/60 + (22 − 20)²/20 = 0.089 + 0.267 + 0.067 + 0.200 = **0.62**.
4. df = 4 − 1 = 3; critical value 7.81.
5. 0.62 < 7.81, so fail to reject. The data are consistent with two unlinked genes.

Now imagine the same cross gave 230 : 10 : 10 : 70. Expected values are unchanged, but χ² = (50²/180) + (50²/60) + (50²/60) + (50²/20) = 13.9 + 41.7 + 41.7 + 125 = 222, far above 7.81. Reject: the parental combinations are far too common, the signature of linkage.

## Worked example 3: a pedigree

Generation I: an unaffected man and an unaffected woman have four children; one daughter (II-1) is affected. Their unaffected son (II-3) marries an unaffected woman from outside the family; their son (III-1) is affected.

*Mode:* unaffected parents with an affected child, so recessive. II-1 is an affected female with an unaffected father, so not X-linked. Autosomal recessive.

*Genotypes:* I-1 and I-2 are both Aa (they produced aa). II-3 must be Aa (his son is aa), and his wife II-5 must also be Aa, even though she is from outside the family.

*Probability the next child of II-3 and II-5 is affected:* Aa × Aa, so 1/4. The affected first child does not change it.

## Common misconceptions

- **"Dominant means common."** Dominance is about masking in a heterozygote, not frequency. Many dominant alleles are rare.
- **"A 3:1 ratio means three of every four offspring."** It is a probability. A family of four shows exactly 3 : 1 only about 42% of the time.
- **"Previous children change the odds."** Each fertilisation is independent.
- **"The expected values come from the data."** They come from the hypothesis: ratio × total.
- **"Use percentages in chi-square."** Use counts; sample size is what makes a deviation significant.
- **"A small χ² proves the hypothesis."** It fails to reject it. Larger samples can still reject.
- **"The 9 : 3 : 3 : 1 ratio applies to any two genes."** Only to unlinked genes with complete dominance; linked genes and epistasis change it.

## Where this goes next

Week 17 breaks every one of Mendel's simplifications: alleles that are not fully dominant, genes with more than two alleles, genes on the X chromosome, genes that travel together on one chromosome, genes that mask other genes, and genes whose expression depends on the environment. The chi-square test returns in Unit 7, where the null hypothesis is Hardy-Weinberg equilibrium.

**AP labs.** *Investigation 7: Cell Division* uses chi-square to compare mitotic counts between treated and control root tips, and the *Sordaria* part of the same lab produces the crossover data that week 17's mapping builds on. Chi-square is also the test in *Investigation 2: Mathematical Modeling, Hardy-Weinberg*. Practise the calculation until the arithmetic is automatic.

## Self-check

1. Write the gametes of an AaBb plant and the F2 phenotype ratio of a self-cross. Explain which meiotic event makes the four gamete types equal.
2. Two carriers of a recessive condition have three children. Calculate the probability that none is affected and the probability that at least one is.
3. A test cross gives 48 dominant : 52 recessive. Calculate χ² against 1 : 1, give df and the critical value, and state the conclusion.
4. In a pedigree an affected son has two unaffected parents and an affected sister whose father is unaffected. State the mode of inheritance and the evidence.
5. Explain why 10 offspring in a 4 : 6 ratio would not reject a 1 : 1 hypothesis but 1,000 offspring in a 400 : 600 ratio would.

---

*Adapted from* Biology 2e *by OpenStax, Rice University (§12.1 Mendel's Experiments and the Laws of Probability; §12.2 Characteristics and Traits; §12.3 Laws of Inheritance), licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Accessed 2026-10-01. Adapted from the original: condensed, reorganised around the AP Biology CED, and extended with worked examples including the chi-square test and pedigree analysis.*
