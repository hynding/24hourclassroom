# Week 21 · Mutations; PCR, Gels and Restriction Analysis

**CED topics:** 6.7 Mutations · 6.8 Biotechnology (part 1)
**Big Ideas:** Information Storage and Transmission (IST), Evolution (EVO), Systems Interactions (SYI)
**Built from:** OpenStax *Biology 2e* §14.6 DNA Repair; §13.2 Chromosomal Basis of Inherited Disorders; §22.2 Structure of Prokaryotes: Bacteria and Archaea; §17.1 Biotechnology; §17.2 Mapping Genomes
**Spiral:** keep weeks 18-20 and Unit 5 in mind. A mutation is a replication or repair failure (week 18) read through the codon table (week 19) or through a regulatory element (week 20); nondisjunction is meiosis (5.1) going wrong; PCR is replication in a tube and a gel is Unit 1's phosphate backbone put to work.

## What you need to be able to do

The College Board phrases the two learning objectives for this week as:

- **6.7** Describe the various types of mutation, and explain how changes in genotype may result in changes in phenotype; explain how alterations in DNA sequence contribute to variation that can be subject to natural selection.
- **6.8** Explain the use of genetic engineering techniques in analysing or manipulating DNA (this week: electrophoresis, PCR and restriction analysis; next week: transformation and sequencing).

In plain language: given a sequence and a codon table, you must classify a mutation (silent, missense, nonsense, frameshift, in-frame indel, regulatory, chromosomal) and predict its effect on the protein and the phenotype. You must be able to argue that mutation is random with respect to need and is the only source of new alleles, and describe how bacteria and viruses move genes sideways. Then you must read a gel against a ladder, count restriction sites from fragment numbers, estimate sizes on a semi-log plot and calculate what PCR produces.

## Key vocabulary

| Term | Meaning |
|---|---|
| Point mutation | One base pair substituted; a transition swaps like for like (A↔G, C↔T), a transversion swaps purine for pyrimidine. |
| Silent | Substitution to a synonymous codon; same amino acid. |
| Missense | Substitution to a different amino acid; conservative if the R group is similar, non-conservative if not. |
| Nonsense | Substitution that creates a stop codon; truncated protein. |
| Frameshift | Insertion or deletion not divisible by three; every downstream codon regroups. |
| Nondisjunction | Chromosomes fail to separate in meiosis; gametes gain or lose a chromosome (aneuploidy). |
| Chromosomal rearrangement | Deletion, duplication, inversion or translocation of a segment. |
| Mutagen | An agent that raises the mutation rate: UV, X-rays, reactive chemicals. |
| Horizontal gene transfer | Movement of genes between existing cells: transformation, transduction, conjugation. |
| Conjugation | Plasmid transfer from one bacterium to another through a pilus. |
| PCR | Cycles of denaturation, primer annealing and extension that double a target each round. |
| Primer | A short single-stranded DNA that pairs with the target and gives polymerase a 3′-OH. |
| Gel electrophoresis | Sorting DNA fragments by size as they move toward the positive electrode. |
| Restriction enzyme | A bacterial enzyme that cuts at a specific palindromic sequence, leaving sticky or blunt ends. |
| RFLP | A sequence difference that creates or destroys a restriction site, visible as a different band pattern. |

## Mutation: what can go wrong and what it does

A **mutation** is a heritable change in DNA sequence. Most arise spontaneously, as replication errors that escape proofreading and mismatch repair or as chemical decay of bases; some are **induced** by mutagens. UV light, for example, bonds adjacent thymines into a **thymine dimer** that stalls polymerase; **nucleotide excision repair** cuts the lesion out and refills the gap, and people who lack it (xeroderma pigmentosum) develop skin cancers from the mutations that accumulate instead.

What a mutation does depends on where it falls and what it changes:

- **Substitutions** in coding sequence can be **silent** (synonymous codon, often a third-position change), **missense** (one amino acid for another; harmless if conservative, damaging if a charged residue lands in a hydrophobic core or an active site) or **nonsense** (a new stop codon).
- **Insertions and deletions** that are not multiples of three cause a **frameshift**: the ribosome regroups every codon after the lesion, so the downstream sequence is scrambled and usually ends at a premature stop. The earlier in the gene, the worse. Indels of three bases add or remove one residue and leave the rest intact.
- **Regulatory mutations** in promoters, enhancers or splice sites leave the protein's sequence unchanged but alter how much is made, when, where, or how the mRNA is spliced. Much of the variation between individuals is of this kind.
- **Chromosomal mutations** change structure (deletion, duplication, inversion, translocation) or number. **Nondisjunction** in meiosis I sends both homologues to one cell, so all four gametes are abnormal; in meiosis II only two are. A gamete with an extra chromosome gives a trisomic zygote, and the extra dose of every gene on it disrupts development. Whole extra sets (**polyploidy**) are common and often vigorous in plants, lethal or sterile in animals.

Whether a mutation is harmful, neutral or beneficial is decided by the environment. A random change to a working sequence is more likely to break it than improve it, and many changes land in non-coding DNA or are silent; but the occasional variant that fits current conditions better is what selection spreads. **Germline** mutations enter the next generation and the population's gene pool; **somatic** mutations stay in one body, where they are the route to most cancers.

## Mutation is random; selection is not

The replica-plating experiment settles a question students often get backwards. Colonies grown without any antibiotic are stamped onto a plate containing it. A few grow; when the original, never-exposed colonies in the same positions are tested, they are already resistant. The resistance mutations existed before the drug appeared. Antibiotics do not cause resistance; they select for it. Mutation supplies variation blindly, selection chooses. Unit 7 is built on that sentence.

Bacteria evolve quickly because they are numerous, short-lived and haploid (a new allele is expressed at once), and because they also move genes sideways. **Transformation** takes up DNA from the surroundings (Griffith's phenomenon). **Transduction** is a phage carrying a piece of one host's DNA into the next. **Conjugation** passes a plasmid through a **pilus** from donor to recipient, which is how plasmids carrying several resistance genes spread through a hospital and across species. Viruses add their own variation: RNA polymerases that do not proofread, and **reassortment** of segments when two related viruses infect one cell, as in new influenza strains.

## Tools, part 1: copying, sorting and cutting DNA

**PCR** is replication in a tube with the enzymes replaced by temperature. Denaturation at about 95 °C separates the strands (heat does helicase's job). Annealing at 50-65 °C lets two **primers**, one for each strand and flanking the target, pair with their sites (synthetic primers do primase's job and define exactly what is copied). Extension at 72 °C lets **Taq polymerase**, from a hot-spring bacterium whose fold survives 95 °C, copy from each primer. Each cycle doubles the target: 2ⁿ copies after n cycles, a million after twenty. Starting from RNA, reverse transcriptase makes cDNA first (RT-PCR), which is how expression is measured.

**Gel electrophoresis** sorts fragments by size. DNA's phosphate backbone gives every fragment the same charge per unit length, so in an electric field all move toward the positive electrode and the gel's pores slow the long ones. Bands farther from the well are smaller. A **ladder** of known sizes in one lane calibrates the gel; over the useful range, distance is proportional to the logarithm of size, so a **semi-log plot** of the ladder is a straight line from which unknowns can be read.

**Restriction enzymes** are bacterial defences against phage: each cuts at a specific 4-8 base **palindrome** (EcoRI at GAATTC), and the bacterium protects its own sites by methylating them. Staggered cuts leave **sticky ends** whose overhangs pair with any fragment cut by the same enzyme, so a human fragment and a plasmid can be joined by **DNA ligase**, the basis of recombinant DNA (week 22). Counting rules: a linear molecule with n sites gives n + 1 fragments; a circle with n sites gives n; fragment sizes must sum to the whole. A sequence difference that creates or destroys a site is an **RFLP**: the same enzyme gives different patterns in different people, which is how a sickle-cell allele (whose mutation destroys an MstII site) or a DNA profile can be read from a gel.

## Worked example 1: classifying mutations

Coding strand 5′-ATG AAA GGC TGG TAA-3′ encodes Met-Lys-Gly-Trp-stop.

*Reasoning:* AAA → AAG is still lysine: **silent**. GGC → GAC is glycine → aspartate: **missense**, and non-conservative (nonpolar to charged). TGG → TGA is tryptophan → stop: **nonsense**. Inserting one T after GGC regroups the rest: **frameshift**. Deleting six bases removes two residues and keeps the frame: **in-frame deletion**. Always compare codon by codon with the table rather than guessing from the size of the change.

## Worked example 2: reading a gel

A 10,000-bp linear DNA is cut with EcoRI; the ladder runs 10,000 bp at 10 mm, 5,000 at 21, 2,000 at 35, 1,000 at 45, 500 at 56. The EcoRI lane shows bands at 18, 28 and 45 mm.

*Reasoning:* The 45-mm band matches the 1,000-bp standard. The 28-mm band lies between 5,000 (21 mm) and 2,000 (35 mm); on a semi-log plot it reads about 3,000. The 18-mm band lies between 10,000 and 5,000, about 6,000. Check: 6,000 + 3,000 + 1,000 = 10,000. Three fragments from a linear molecule means **two** EcoRI sites; the same sequence as a circular plasmid would give two fragments. Every gel question is a size-estimate plus an arithmetic check.

## Worked example 3: a PCR calculation

*Question:* One target molecule, 10 cycles, then 20, then 30.

*Reasoning:* 2¹⁰ = 1,024; 2²⁰ ≈ 1.05 million; 2³⁰ ≈ 1.07 billion. The number of cycles, not the starting amount, sets the yield, which is why PCR can begin from a single hair root. It also means a single contaminating molecule is amplified just as faithfully, so negative controls (no template) are run with every reaction.

## Common misconceptions

- **"Bigger mutations do more damage."** A one-base deletion can destroy a protein; a three-base deletion often removes one residue harmlessly.
- **"Antibiotics cause resistance mutations."** They select pre-existing mutants. The replica-plating experiment is the evidence.
- **"A mutation outside the coding sequence has no effect."** Promoter, enhancer and splice-site mutations change how much, when and what is made.
- **"Larger fragments run farther."** Smaller fragments run farther; the well is at the negative end.
- **"Restriction enzymes cut randomly."** Each cuts one exact sequence, so the pattern is reproducible.
- **"PCR copies the whole genome."** It copies only what lies between the two primers.

## Where this goes next

Week 22 finishes the toolkit: putting a recombinant plasmid into bacteria (transformation with selection), reading sequence (Sanger and next-generation methods) and editing genes (CRISPR). Unit 7 takes the first half of this week, mutation as the source of heritable variation, and builds natural selection and Hardy-Weinberg on it.

**AP labs.** *Investigation 9: Biotechnology, Restriction Enzyme Analysis of DNA* is this week in the laboratory: lambda DNA cut with three enzymes, run beside a ladder, fragment sizes read from a semi-log plot and used to map the sites. The sickle-cell RFLP in the quiz is the same reasoning applied to a human allele.

## Self-check

1. For the mRNA 5′-AUG CCA GAA UGG UAA-3′, write one silent, one missense, one nonsense and one frameshift mutation and state the product of each.
2. Explain, with the replica-plating experiment, why resistance precedes exposure.
3. Name the three routes of horizontal transfer and the one requirement that distinguishes each.
4. A circular plasmid gives four bands when cut with one enzyme. How many sites? How many bands if the same DNA were linear?
5. State what each PCR temperature step does and which cellular enzyme or molecule it replaces.

---

*Adapted from* Biology 2e *by OpenStax, Rice University (§14.6 DNA Repair; §13.2 Chromosomal Basis of Inherited Disorders; §22.2 Structure of Prokaryotes: Bacteria and Archaea; §17.1 Biotechnology; §17.2 Mapping Genomes), licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Accessed 2026-10-01. Adapted from the original: condensed, reorganised around the AP Biology CED, and extended with worked examples.*
