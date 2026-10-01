# Week 14 · Regulation of the Cell Cycle and Cancer

**CED topics:** 4.6 Regulation of Cell Cycle (with a synthesis of 4.1 to 4.5)
**Big Ideas:** Information Storage and Transmission (IST), Systems Interactions (SYI)
**Built from:** OpenStax *Biology 2e* §10.3 Control of the Cell Cycle; §10.4 Cancer and the Cell Cycle; AP Investigation 7 and the chi-square test from general knowledge
**Spiral:** keep weeks 12 and 13 in mind. The growth-factor pathway (4.2, 4.3) is what pushes a cell through the G₁ checkpoint; anaphase (4.5) is the irreversible step the M checkpoint guards; a Cdk is an allosterically regulated enzyme (3.1); cell size is the SA:V argument (2.2).

## What you need to be able to do

The College Board phrases the learning objectives for this week as:

- **4.6** Describe the role of checkpoints in regulating the cell cycle, and describe the effects of disruptions to the cell cycle on the cell or the organism.

In plain language: you must be able to say where the cell pauses to check itself, what it checks, which proteins drive it forward and which hold it back, what happens when a driver is stuck on or a brake is missing, and why those failures lead to cancer. You must also be able to take a count of dividing cells, compute a mitotic index, and decide with a chi-square test whether a treatment changed it.

## Key vocabulary

| Term | Meaning |
|---|---|
| Checkpoint | A point where the cell assesses conditions and proceeds or halts. Three: late G₁, G₂/M, and metaphase. |
| G₁ checkpoint (restriction point) | Checks size, reserves, growth signals and DNA integrity. Past it, the cell is committed. |
| G₂ checkpoint | Checks that every chromosome is fully replicated and undamaged before mitosis. |
| M (spindle) checkpoint | Checks that every kinetochore is attached to microtubules from opposite poles before anaphase. |
| Cyclin | Regulatory protein whose level rises and falls on a schedule; four of them (D, E, A, B) peak at different phases. |
| Cyclin-dependent kinase (Cdk) | A kinase present at steady levels, active only when bound to its cyclin; the complex phosphorylates proteins that advance the cycle. |
| p53 | Tumour suppressor that responds to DNA damage in G₁: halt, repair, or apoptosis. Mutated in over half of tumours. |
| p21 | Made on p53's order; binds and inhibits Cdk-cyclin complexes to enforce the halt. |
| Rb | Binds the transcription factor E2F and blocks G₁-to-S genes until phosphorylated by growth signalling. |
| Proto-oncogene / oncogene | A normal positive-regulator gene; its gain-of-function mutant that drives division without the proper signal. |
| Tumour suppressor gene | A negative-regulator gene; its loss removes a brake. |
| Mitotic index | Cells in mitosis ÷ total cells, a measure of how actively a tissue divides. |
| Chi-square (χ²) | Σ (observed − expected)²/expected, compared with a critical value to test a null hypothesis. |

## Checkpoints: where the cell asks permission

Three times per cycle the cell pauses. At the **G₁ checkpoint**, near the end of G₁, it asks whether conditions favour division: is the cell large enough, are nutrients and energy reserves adequate, are growth signals present, and is the genomic DNA undamaged? A cell that fails can wait, repair, or leave the cycle into G₀. A cell that passes is committed, which is why this point is also called the restriction point. At the **G₂ checkpoint** the cell asks whether every chromosome has been completely replicated without damage; a problem halts the cycle for repair. At the **M checkpoint**, during metaphase, the cell asks whether every sister chromatid's kinetochore is firmly attached to microtubules from opposite poles. Anaphase cannot be undone, so the cell waits until the answer is yes; otherwise a daughter could inherit an extra or missing chromosome.

## The engine: cyclins and Cdks

The cycle is driven by **cyclin-dependent kinases**. The kinase protein itself is present at a fairly constant level and does nothing alone. Its partner, a **cyclin**, is made and destroyed on a schedule, so the concentration of each cyclin rises and falls in a predictable pattern through the cycle. When cyclin accumulates, Cdk-cyclin complexes form, the kinase becomes active and phosphorylates the proteins that carry the cell through a checkpoint; when the cyclin is degraded, the kinase falls silent. Cyclin binding is allosteric activation (topic 3.1): the partner reshapes the enzyme so its active site works. Four cyclins, D, E, A and B, peak in G₁, late G₁, S and mitosis respectively; cyclin B's destruction is what lets a cell leave mitosis, so a cyclin B that cannot be degraded arrests the cell in a mitotic state.

External signals feed the engine. A growth factor binds a receptor tyrosine kinase, the Ras-MAP kinase cascade runs (week 12), and the output is expression of cyclins and other proteins that let the cell pass G₁. Human growth hormone, the death of neighbouring cells, and even a falling surface-to-volume ratio as the cell grows are signals to divide; crowding (density-dependent inhibition) and loss of attachment to a surface are signals to stop.

## The brakes: p53, p21 and Rb

Negative regulators hold the cell at G₁ until the conditions are right. **Rb** in its unphosphorylated state binds the transcription factor **E2F** and keeps it from switching on the genes for the G₁-to-S transition; growth signalling leads to Rb phosphorylation, which changes its shape and releases E2F. **p53** is the damage response: when DNA damage is detected in G₁, p53 halts the cycle, recruits repair enzymes, and, if repair fails, triggers apoptosis so the damaged genome is never copied. It enforces the halt through **p21**, which it induces; p21 binds and inhibits Cdk-cyclin complexes, and the more stress, the more p21 and the less likely the cell is to enter S phase.

## When control fails: cancer

Tissue size is a balance between division and apoptosis; a tumour forms when division rises, apoptosis falls, or both. **Proto-oncogenes** are the normal genes for positive regulators: growth-factor receptors, Ras, cyclins, Cdks. A mutation that makes the product overactive or unable to switch off turns the gene into an **oncogene**, a stuck accelerator: Ras that cannot hydrolyse GTP (about 30% of cancers), a Cdk that works without its cyclin, or HER2, a receptor tyrosine kinase overexpressed in about a quarter of breast cancers so that receptors dimerise and signal with no ligand. **Tumour suppressor genes** are the brakes: p53, p21, Rb. A mutation that disables one removes a stop. Mutated p53 is found in more than half of human tumours because one loss removes three defences at once: the halt, the repair signal and the apoptosis.

One mutation is rarely enough. A cell with one stuck accelerator is still restrained by its brakes, and a cell with one lost brake still needs a signal to divide. But a cell that divides when it should not copies its uncorrected errors into its daughters, and each generation can add more; over time, enough controls fail that division becomes uncontrolled and the cells ignore crowding and anchorage. That is why cancer risk rises with age and with exposure to mutagens, and why a cell's own apoptosis is a defence worth having.

## Worked example 1: a chi-square test on Investigation 7 data

Root tips grown in water or in a fungal lectin solution were squashed and 1,000 cells counted for each.

| Treatment | Interphase | Mitosis | Total |
|---|---|---|---|
| Control | 940 | 60 | 1,000 |
| Lectin | 905 | 95 | 1,000 |

*Null hypothesis:* the lectin has no effect, so the treated cells should show the control's proportions: 940 interphase and 60 mitotic expected.

*Calculation:* χ² = Σ (o − e)²/e = (905 − 940)²/940 + (95 − 60)²/60 = 1,225/940 + 1,225/60 = 1.30 + 20.42 = **21.7**.

*Decision:* two categories give 1 degree of freedom; the AP table's critical value at p = 0.05 is 3.84. Since 21.7 > 3.84, reject the null: a difference this large would arise by chance in fewer than 5% of samples. The mitotic index rose from 6.0% to 9.5%, and the test says that rise is not sampling noise. Notice that the small category contributes almost all of the value: a deviation of 35 is a large fraction of 60 and a tiny fraction of 940. And notice what the test does not say: nothing about mechanism. That the lectin acts as a growth-factor-like signal at the G₁ checkpoint is a separate hypothesis for a separate experiment.

## Worked example 2: reading a cyclin time course

| Time (min) | Cyclin B | Cdk activity | Stage |
|---|---|---|---|
| 0 | 10 | 5 | interphase |
| 40 | 80 | 60 | entering mitosis |
| 50 | 90 | 100 | metaphase |
| 60 | 15 | 8 | anaphase to telophase |

*Reasoning:* Cyclin rises first and activity follows, so cyclin is the limiting partner. Both collapse at 60 minutes, and the collapse coincides with exit from mitosis, so degradation of cyclin is the off switch. A blocker of cyclin synthesis that leaves activity at 5 and the extract in interphase shows cyclin is necessary; a non-degradable cyclin that leaves activity at 100 shows degradation is necessary for exit. Describe, then explain, then predict: that order earns points.

## Worked example 3: locating a drug's action from cycle-phase counts

| Culture | G₁ (%) | S (%) | G₂ and M (%) |
|---|---|---|---|
| Untreated | 55 | 30 | 15 |
| Drug A | 92 | 4 | 4 |
| Drug B | 20 | 10 | 70 |

*Reasoning:* Cells pile up just before the step a drug blocks. Drug A empties S and G₂/M and fills G₁, so it blocks the G₁-to-S transition: a growth-factor pathway inhibitor or a Cdk-cyclin D inhibitor would do this. Drug B fills G₂/M, so it blocks exit from mitosis: a microtubule poison such as paclitaxel, which freezes the spindle so the M checkpoint is never satisfied, would do this. Side effects of such drugs fall on the body's most rapidly dividing tissues (gut lining, hair follicles, marrow), because cells in G₀ never reach the blocked step.

## Common misconceptions

- **"Cdk levels rise and fall."** Cdk protein is roughly constant; the cyclins fluctuate, and their fluctuation times the cycle.
- **"A checkpoint is a place where the cell always stops."** It is an assessment; a healthy cell passes without pausing.
- **"An oncogene is a foreign cancer gene."** It is one of the cell's own growth genes with a gain-of-function mutation.
- **"Tumour suppressors cause cancer when overactive."** They cause cancer when lost; proto-oncogenes cause it when overactive.
- **"One mutation causes cancer."** One mutation starts a process that usually needs several more.
- **"A significant chi-square proves the mechanism."** It shows the counts differ from the null's expectation; the biology behind the difference needs a different experiment.
- **"Apoptosis is a failure."** It is a regulated response that removes dangerous cells; losing it is part of how tumours form.

## Where this goes next

Unit 5 begins with meiosis, where the same spindle and the same checkpoints are used twice to halve the chromosome number and shuffle alleles. Unit 6 explains how the growth-factor cascade changes gene expression and what a mutation does to a protein. Unit 7 treats a tumour as a population evolving under selection within a body. The chi-square test returns in Units 5 and 7 for Mendelian ratios and Hardy-Weinberg.

**AP labs.** *Investigation 7: Cell Division: Mitosis and Meiosis*, Part 1: count interphase and mitotic cells in treated and control root tips, compute the mitotic index, and test the difference with chi-square exactly as in worked example 1. Part 2, on meiosis and crossing over, follows in Unit 5.

## Self-check

1. For each checkpoint, name what is assessed and the irreversible step it guards.
2. Explain why Cdk activity oscillates although Cdk concentration does not.
3. Classify Ras, p53, cyclin D, Rb and HER2 as positive or negative regulators, and say for each whether cancer-associated mutations are gain or loss of function.
4. A treated root tip shows 120 mitotic cells of 1,000; the control shows 80 of 1,000. Compute χ² using the control as expected and state the conclusion at p = 0.05.
5. Predict the cycle-phase distribution of cells treated with a drug that stabilises Rb in its unphosphorylated form, and justify it.

---

*Adapted from* Biology 2e *by OpenStax, Rice University (§10.3 Control of the Cell Cycle; §10.4 Cancer and the Cell Cycle), licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Accessed 2026-10-01. Adapted from the original: condensed, reorganised around the AP Biology CED, and extended with worked examples and the chi-square treatment of AP Investigation 7.*
