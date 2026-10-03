# Week 18 · DNA and RNA Structure; DNA Replication

**CED topics:** 6.1 DNA and RNA Structure · 6.2 DNA Replication
**Big Ideas:** Information Storage and Transmission (IST), Evolution (EVO)
**Built from:** OpenStax *Biology 2e* §14.1 Historical Basis of Modern Understanding; §14.2 DNA Structure and Sequencing; §14.3 Basics of DNA Replication; §14.4 DNA Replication in Prokaryotes; §14.5 DNA Replication in Eukaryotes; §14.6 DNA Repair
**Spiral:** keep Unit 1 week 3 in mind. Phosphodiester bonds, 5′ and 3′ ends, antiparallel strands and base pairing are the facts replication is built on; the protein chemistry of histones is Unit 1 week 3 applied to DNA.

## What you need to be able to do

The College Board phrases the two learning objectives for this week as:

- **6.1** Describe the structures involved in passing hereditary information from one generation to the next, and describe the characteristics of DNA that allow it to be used as the hereditary material.
- **6.2** Describe the mechanisms by which genetic information is copied for transmission between generations.

In plain language: you must be able to say *how we know* DNA is the hereditary molecule (arguing from the experiments, not just naming them); describe the helix in numbers; contrast a bacterial genome (circular, nucleoid, plasmids) with a eukaryotic one (linear, nucleus, histones); and walk a replication fork enzyme by enzyme, explaining why one strand is continuous and the other is in pieces. Expect Meselson-Stahl as a data table, not a story.

## Key vocabulary

| Term | Meaning |
|---|---|
| Transformation | Uptake of DNA from the surroundings that heritably changes a cell. Griffith saw it; Avery's group showed the agent was DNA. |
| Chargaff's rules | In double-stranded DNA, A = T and G = C; the A+T : G+C ratio varies by species. |
| Nucleoid | The region of a prokaryotic cell where the circular chromosome sits; no membrane. |
| Plasmid | A small circular DNA molecule that replicates independently of the chromosome. |
| Histone | A small, positively charged protein that DNA winds around; eight make the core of a nucleosome. |
| Nucleosome | About 147 base pairs of DNA wrapped around a histone octamer: the bead on the string. |
| Semiconservative | Each daughter helix keeps one parental strand and gains one new strand. |
| Origin of replication | An A–T-rich sequence where initiator proteins open the helix; one in E. coli, thousands per human chromosome. |
| Helicase | Unwinds the helix by breaking hydrogen bonds, using ATP. |
| Primase | Lays down a short RNA primer that gives DNA polymerase a 3′-OH to start from. |
| DNA polymerase III | The main replicating enzyme in bacteria; adds nucleotides to a 3′-OH, building 5′ → 3′. |
| Okazaki fragment | A short piece of the lagging strand, each begun by its own primer and joined by ligase. |
| Telomerase | An enzyme with its own RNA template that extends chromosome ends; active in germ, stem and cancer cells. |

## How we know DNA is the hereditary material

Four pieces of evidence, each answering a different question:

1. **Griffith (1928)** asked whether a trait could pass between bacteria. Live rough pneumococci were harmless and heat-killed smooth ones were harmless, but the two together killed mice, and live smooth cells were recovered. Something in the dead cells, the *transforming principle*, had changed the live ones.
2. **Avery, MacLeod and McCarty (1944)** asked what that something was. They destroyed one component of the extract at a time; only destroying DNA abolished transformation.
3. **Hershey and Chase (1952)** asked which part of a virus enters the host. Protein was labelled with ³⁵S, DNA with ³²P. After infection and blending, ³²P was inside the cells and new phage carried it; ³⁵S stayed outside. DNA goes in and directs the infection.
4. **Chargaff** found A = T and G = C in every species while the A+T : G+C ratio varied: the clue to base pairing, and evidence that DNA could carry species-specific information.

Watson and Crick, using Franklin's X-ray images and Chargaff's rules, built the model: a right-handed double helix, backbones outside, bases stacked inside, strands antiparallel, A–T by two hydrogen bonds, G–C by three. Memorise the numbers: **0.34 nm per base pair, 3.4 nm per turn, 10 base pairs per turn, 2 nm across**. The diameter is constant because every rung is one purine (two rings) plus one pyrimidine (one ring).

Some viruses use RNA as their genome; retroviruses copy it into DNA with reverse transcriptase. On the exam, "DNA is the hereditary material of all living cells; some viruses use RNA" is the complete sentence.

## Two ways to package a genome

**Prokaryotes** keep one circular chromosome in the nucleoid, compacted by **supercoiling** with the help of enzymes such as DNA gyrase. E. coli's chromosome is about 4.6 million base pairs. Many bacteria also carry **plasmids**: small, independent circles that often carry genes useful under particular conditions, such as antibiotic resistance. Plasmids move between cells (week 21) and are the vectors of recombinant DNA work (week 22).

**Eukaryotes** have several linear chromosomes in a nucleus, and about two metres of DNA to fit into a few micrometres. The answer is **histone coiling**: the helix (2 nm) winds about twice around a histone octamer to make a **nucleosome**, and nucleosomes on linker DNA look like beads on a string; a fifth histone coils the string into a **30-nm fibre**; the fibre loops onto a protein scaffold, and at metaphase the loops pack into a chromosome about 700 nm wide.

Histones bind DNA because they are rich in lysine and arginine, whose R groups are positively charged, while the backbone is a line of negative phosphates. That is Unit 1 chemistry, and it is also the handle regulation uses: acetylating lysine removes the charge, loosens the wrap and exposes genes (topic 6.5). Open chromatin is **euchromatin**; the dense, silent kind at centromeres and telomeres is **heterochromatin**.

## Replication is semiconservative: the Meselson-Stahl table

Three models were possible: *conservative* (the parent helix survives intact), *semiconservative* (each daughter has one old and one new strand) and *dispersive* (old and new DNA interspersed in every strand). Meselson and Stahl grew E. coli in heavy nitrogen (¹⁵N) until all its DNA was heavy, moved it to light (¹⁴N) medium, and after each generation spun the DNA in a caesium chloride density gradient, where a molecule floats at the level matching its buoyant density.

| Generations in ¹⁴N | Heavy | Intermediate | Light |
|---|---|---|---|
| 0 | all | — | — |
| 1 | — | all | — |
| 2 | — | half | half |
| 3 | — | quarter | three quarters |

Generation 1 kills conservative replication: a heavy band should have survived and did not. Generation 2 kills dispersive replication: with every strand a mosaic, all the DNA would sit in one band drifting lighter, but two bands appeared. Only semiconservative replication fits every row. When the exam gives you the table, reason row by row and say which model each row eliminates.

## The fork, enzyme by enzyme

Replication begins at an **origin**, an A–T-rich sequence (two hydrogen bonds per pair separate more easily than three). Initiator proteins open a bubble with a fork on each side, and both forks move away: replication is bidirectional. At each fork:

1. **Helicase** breaks hydrogen bonds and unzips the helix (ATP).
2. **Single-strand binding proteins** keep the separated strands from re-pairing.
3. **Topoisomerase** works ahead of the fork, nicking and resealing a strand to relieve the overtwisting that unwinding creates.
4. **Primase** lays a 5-10 nucleotide RNA **primer**, because DNA polymerase cannot start a strand, only extend a free 3′-OH.
5. **DNA polymerase III** adds deoxynucleoside triphosphates to that 3′-OH, reading the template 3′ → 5′ and building **5′ → 3′**; the two phosphates released pay for each bond. A **sliding clamp** keeps the enzyme on the DNA.
6. Because the templates are antiparallel, only one new strand can grow continuously toward the fork: the **leading strand**. The other template runs the wrong way, so its strand is made in **Okazaki fragments** pointing away from the fork, each with its own primer: the **lagging strand**.
7. **DNA polymerase I** removes each RNA primer and replaces it with DNA.
8. **DNA ligase** seals the last phosphodiester bond between fragments.

Polymerase also **proofreads**: a mismatched base is excised by its 3′ exonuclease activity before synthesis continues, and mismatch repair catches what proofreading misses, using methylation to tell the old strand from the new.

Eukaryotes do the same thing with different parts: polymerases α (priming), δ and ε (elongation), PCNA as the clamp, forks about ten times slower (50-100 nucleotides per second), and **many origins** per chromosome, up to about 100,000 per genome, so that an 8-hour S phase is enough. Linear chromosomes add the **end-replication problem**: the last primer on the lagging strand cannot be replaced with DNA, so each round leaves a shorter 5′ end. **Telomeres** are expendable repeats (TTAGGG in humans) that absorb the loss, and **telomerase**, carrying its own RNA template, extends the 3′ end in cells that must keep dividing: germ cells, stem cells and most cancers.

## Worked example 1: predicting a density-gradient result

*Question:* A culture grown in ¹⁴N is switched to ¹⁵N for exactly two generations. What bands appear?

*Reasoning:* List strands and split every helix. Start: light/light. Generation 1: each old light strand pairs with a new heavy strand, so all DNA is intermediate. Generation 2: each intermediate helix separates; the light strand gets a new heavy partner (intermediate), the heavy strand gets a new heavy partner (heavy). Result: half intermediate, half heavy. The bookkeeping, not the memory of the original experiment, is what the exam tests.

## Worked example 2: a replication-time calculation

*Question:* How long does E. coli take to copy 4.6 × 10⁶ base pairs at 1,000 nucleotides per second?

*Reasoning:* One origin, two forks, so each fork copies half: 2.3 × 10⁶ ÷ 1,000 = 2,300 s ≈ 38 min (the textbook's 42 minutes includes start and finish). The common error is forgetting the second fork and doubling the answer. Now scale to a human chromosome of 2.5 × 10⁸ base pairs at 50 per second with one origin: 2.5 × 10⁶ s, about a month. That single calculation is the argument for multiple origins.

## Worked example 3: reasoning from a loss-of-function mutant

*Question:* A strain whose ligase fails at 42 °C is shifted to 42 °C. What accumulates?

*Reasoning:* Ask what the enzyme does and which strand depends on it. Ligase seals nicks between fragments. The leading strand is one piece; the lagging strand is many. So DNA is still made, but the lagging strand accumulates as unjoined Okazaki fragments.

## Common misconceptions

- **"The lagging strand is made 3′ → 5′."** No polymerase ever does that. Both strands are made 5′ → 3′; the lagging strand's fragments point away from the fork because that is the only direction 5′ → 3′ synthesis can go on that template.
- **"Helicase breaks the backbone."** Helicase breaks hydrogen bonds between bases. Topoisomerase cuts and reseals the backbone, and only to relieve twist.
- **"The primer is DNA."** It is RNA, made by primase, and it is removed afterwards.
- **"Conservative replication was ruled out by generation 2."** Generation 1 did that; generation 2 ruled out dispersive.
- **"Telomerase repairs DNA."** It lengthens chromosome ends; it does not correct errors.

## Where this goes next

Week 19 reads the molecule: RNA polymerase uses the same template logic but needs no primer. Week 20 returns to nucleosomes as the switch that opens and closes genes. Week 21 treats replication errors as the source of all variation and plasmids as vehicles of horizontal transfer. Week 22 uses polymerase, primers and plasmids as tools.

**AP labs.** Unit 6 is the home of *Investigation 8: Biotechnology, Bacterial Transformation* and *Investigation 9: Biotechnology, Restriction Enzyme Analysis of DNA*. Both depend on this week: transformation is Griffith's phenomenon done on purpose with a plasmid, and restriction analysis treats the phosphodiester backbone as something an enzyme can cut at a defined sequence.

## Self-check

1. For each of Griffith, Avery's group and Hershey-Chase, state the question asked and the one result that answered it.
2. A double-stranded DNA is 22% G. Give the percentages of C, A and T, and explain why you cannot do the same for a single-stranded RNA.
3. A culture is grown in ¹⁵N, switched to ¹⁴N for one generation, then back to ¹⁵N for one generation. Predict the bands.
4. List the enzymes that act on the lagging strand but rarely on the leading strand, and say why.
5. Explain why a somatic cell's chromosomes get shorter with each division, and why a germ cell's do not.

---

*Adapted from* Biology 2e *by OpenStax, Rice University (§14.1 Historical Basis of Modern Understanding; §14.2 DNA Structure and Sequencing; §14.3 Basics of DNA Replication; §14.4 DNA Replication in Prokaryotes; §14.5 DNA Replication in Eukaryotes; §14.6 DNA Repair), licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Accessed 2026-10-01. Adapted from the original: condensed, reorganised around the AP Biology CED, and extended with worked examples.*
