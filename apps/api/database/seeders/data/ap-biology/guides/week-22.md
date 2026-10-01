# Week 22 · Transformation, Sequencing and Gene Editing; Unit Synthesis

**CED topics:** 6.8 Biotechnology (part 2), with synthesis of 6.1-6.7
**Big Ideas:** Information Storage and Transmission (IST), Evolution (EVO), Systems Interactions (SYI)
**Built from:** OpenStax *Biology 2e* §17.1 Biotechnology; §17.3 Whole-Genome Sequencing; §14.2 DNA Structure and Sequencing; §16.2 Prokaryotic Gene Regulation
**Spiral:** keep the whole unit in mind. Transformation is Griffith's phenomenon done on purpose (week 18); an expression vector is a lesson in promoters, ribosome-binding sites and introns (week 19); the arabinose switch on pGLO is an inducible operon (week 20); a CRISPR knockout is a frameshift you chose (week 21).

## What you need to be able to do

The College Board phrases the learning objective as:

- **6.8** Explain the use of genetic engineering techniques in analysing or manipulating DNA: electrophoresis, PCR and restriction analysis (week 21); bacterial transformation, DNA sequencing and gene editing (this week).

In plain language: you must be able to describe how a gene is cut, pasted into a vector, put into bacteria and selected, and read the four plates of the transformation lab, including the controls and the efficiency arithmetic. You must explain how a dideoxy sequencing reaction yields a sequence and read one; describe what CRISPR-Cas9's two parts do; and justify why a human gene works in a bacterium or a bacterial gene in a plant. Finally, the unit exam will ask you to connect all eight topics: expect one question that runs from replication error to mutant protein to altered phenotype to the tool that detects it.

## Key vocabulary

| Term | Meaning |
|---|---|
| Recombinant DNA | DNA joined from two sources, usually a gene inserted into a vector. |
| Vector | A plasmid or modified virus that carries a gene into a host and is replicated there. |
| Selectable marker | A gene (antibiotic resistance) that lets transformed cells be picked out on a selective plate. |
| Transformation | Uptake of DNA by a cell; in the lab, aided by calcium ions and heat shock. |
| Transformation efficiency | Transformant colonies per microgram of DNA actually spread on the plate. |
| cDNA | DNA copied from mRNA by reverse transcriptase; intron-free. |
| Expression vector | A vector carrying the host's promoter and ribosome-binding site so the insert is transcribed and translated. |
| Dideoxynucleotide (ddNTP) | A nucleotide lacking the 3′-OH; terminates a growing chain. |
| Sanger sequencing | Chain termination with labelled ddNTPs; fragments sorted by size give the sequence. |
| Shotgun / next-generation sequencing | Millions of short random reads assembled by overlap into contigs. |
| CRISPR-Cas9 | A guide RNA plus a nuclease: the RNA finds the target by base pairing, the enzyme cuts it. |
| Knockout | A gene disabled, usually by a frameshifting indel at a CRISPR cut. |
| Transgenic / GMO | An organism carrying a gene from another species. |
| Gene therapy | Delivering a functional gene to a patient's cells, usually in a viral vector. |

## Building and installing a recombinant plasmid

Cut the gene and the **vector** with the same restriction enzyme so their **sticky ends** match; mix; let **DNA ligase** seal the backbones. A useful vector has an **origin of replication** (so the host copies it), a **selectable marker** (so you can find the rare cells that took it) and a **cloning site** (a cluster of unique restriction sites). Many vectors also allow **blue-white screening**: the cloning site sits inside lacZ, so an insert disrupts the enzyme that turns X-gal blue, and recombinant colonies are white.

Bacteria rarely take up DNA unaided. In the lab, cells are chilled in **calcium chloride**, whose Ca²⁺ ions screen the negative charges of the membrane phosphates and the DNA so they stop repelling each other, then given a brief **heat shock** at 42 °C that transiently disrupts the bilayer. Even so, far fewer than one cell in a thousand is transformed, which is why the antibiotic plate is not optional: on **LB + ampicillin**, only cells carrying the plasmid's **bla** gene grow, so every colony is a transformant.

If the gene is eukaryotic, two more problems arise. Bacteria cannot splice, so the insert must be **cDNA**, made from the mature mRNA by **reverse transcriptase**. And bacterial RNA polymerase and ribosomes recognise only bacterial signals, so an **expression vector** supplies a bacterial promoter and a Shine-Dalgarno sequence, in the right orientation. With those, E. coli makes human insulin, because the genetic code is the same in both.

## The four plates of Investigation 8

The pGLO plasmid carries bla (ampicillin resistance), the gene for **green fluorescent protein** and araC, a regulator that switches the GFP promoter on only when the sugar **arabinose** is present.

| Plate | Cells | Result | What it shows |
|---|---|---|---|
| LB | −pGLO | lawn | the cells survived the procedure |
| LB + amp | −pGLO | no growth | untransformed cells cannot grow on ampicillin |
| LB + amp | +pGLO | colonies, no glow | transformed cells; GFP present but not expressed |
| LB + amp + arabinose | +pGLO | colonies glow green under UV | transformed cells; GFP induced |

Lawn versus colonies is the visible difference between "every cell grew" and "a rare subset grew". Glow versus no glow on two plates with the same genotype is gene regulation: arabinose is to araC what allolactose is to the lac repressor. **Transformation efficiency** = colonies ÷ micrograms of DNA on that plate, where the micrograms on the plate are the total DNA added multiplied by the fraction of the cell suspension that was spread.

## Reading DNA

**Sanger sequencing** is replication used as a ruler. A primer is extended by polymerase in the presence of the four normal nucleotides plus a little of each **dideoxynucleotide**, which has H instead of OH at the 3′ carbon. Wherever a ddNTP is incorporated, no further phosphodiester bond can form and the chain stops. Because incorporation is random, every molecule stops somewhere different, and the result is a set of fragments one base apart, each ending in a labelled ddNTP. Sort them by size, read the labels from shortest to longest, and you have the new strand 5′ → 3′.

**Next-generation sequencing** breaks a genome into millions of random fragments, reads them in parallel in short lengths, and lets software assemble the overlaps into **contigs** and chromosomes. A human genome, six billion base pairs across both sets, now takes days. Sequences are used to find disease alleles, tailor drugs, track outbreaks, compare species (the phylogenies of Unit 7) and identify organisms from environmental DNA.

## Editing DNA

**CRISPR-Cas9** came from a bacterial immune system in which stored phage sequences are transcribed into guide RNAs that lead a nuclease to matching phage DNA. Repurposed, it has two parts: a **guide RNA** with about 20 nucleotides complementary to the chosen target, and **Cas9**, which cuts both strands where the guide pairs. The cell's repair of the break does the editing. If the ends are simply rejoined, small insertions or deletions usually result, which frameshift and disable the gene: a **knockout**. If a DNA template with the desired sequence is supplied, the cell can copy it into the break, changing the gene precisely. Specificity lives in RNA that can be synthesised to order, which is why one enzyme can be aimed at any gene.

Applications the exam names: **transgenic organisms** (Bt corn with a bacterial toxin gene, delivered by the Ti plasmid of Agrobacterium; insulin-producing bacteria), **gene therapy** (a working gene in a viral vector), **DNA profiling** (short tandem repeats amplified by PCR and separated on a gel; a mismatch at any site excludes, matches at many sites identify), and testing gene function by deliberately altering a sequence and comparing with the unaltered control.

## Unit 6 in one chain

DNA is **replicated** semiconservatively, 5′ → 3′, from primers, with proofreading and repair (6.1-6.2). A gene is **transcribed** from its template strand; a eukaryote caps, splices and tails the transcript (6.3). Ribosomes **translate** codons with tRNA as the adapter, N to C, until a stop (6.4). At every step **regulation** decides how much is made: operators and CAP in bacteria; chromatin, transcription factors, enhancers, RNAi and protein turnover in eukaryotes (6.5), which is how one genome makes two hundred cell types (6.6). Errors and lesions become **mutations**, the only source of new alleles, classified by their effect on the reading frame and the protein, and moved sideways in bacteria by plasmids and phage (6.7). **Biotechnology** uses each step as a tool: polymerase and primers (PCR), the charged backbone (gels), restriction sites (mapping), plasmids (cloning), the 3′-OH (sequencing) and base pairing (CRISPR) (6.8).

## Worked example 1: diagnosing a failed expression construct

Four constructs carrying human insulin sequence in E. coli gave 0, 0, 4 and 950 μg per litre: genomic DNA with a bacterial promoter; cDNA with a human promoter; cDNA with a bacterial promoter but no ribosome-binding site; cDNA with both.

*Reasoning:* Genomic DNA keeps its introns and bacteria cannot splice. A human promoter is invisible to bacterial RNA polymerase. Without a Shine-Dalgarno sequence the mRNA is made but barely translated. Only the fourth construct satisfies transcription and translation in the host. A fifth construct with a one-base deletion at codon 10 would give zero: a frameshift, not a one-residue change.

## Worked example 2: reading a sequencing ladder

Fragments terminated by labelled ddNTPs, shortest to longest: G, A, T, T, C, A, G.

*Reasoning:* The shortest fragment ended at the first position after the primer, so the new strand reads 5′-GATTCAG-3′. If asked for the template, complement and reverse: 3′-CTAAGTC-5′. Reading longest to shortest, or forgetting to complement when the template is wanted, are the two standard errors.

## Worked example 3: a transformation-efficiency calculation

10 μL of plasmid at 0.01 μg/μL is added; cells are resuspended in 500 μL; 100 μL is plated; 120 colonies grow.

*Reasoning:* DNA added = 0.1 μg. Fraction plated = 100/500 = 0.2, so DNA on the plate = 0.02 μg. Efficiency = 120 ÷ 0.02 = 6,000 transformants per μg. The usual error is to divide by the total DNA added (giving 1,200), which ignores that four fifths of the transformed cells never reached the plate.

## Common misconceptions

- **"Transformed cells are the ones that grow on plain LB."** Everything grows on LB; only the ampicillin plate selects.
- **"The glowing colonies are a different strain from the non-glowing ones."** Same plasmid, same genotype; arabinose switched the gene on.
- **"A ddNTP cannot be incorporated."** It is incorporated normally; it is the *next* nucleotide that cannot be added.
- **"Cas9 finds the gene."** The guide RNA finds the gene; Cas9 cuts where it is led.
- **"Bacteria cannot express human genes."** They can, from cDNA with bacterial control signals, because the code is universal.
- **"A CRISPR knockout changes one amino acid."** The usual repair outcome is a small indel, which frameshifts.

## Where this goes next

Unit 7 begins with the variation this unit produced: mutations in populations, allele frequencies, selection and Hardy-Weinberg as a null hypothesis. Sequencing returns there as the evidence for common ancestry and the raw material of molecular phylogenies. Unit 8 uses gene regulation to explain how organisms respond to their environment.

**AP labs.** *Investigation 8: Biotechnology, Bacterial Transformation* is this week's laboratory, and the four-plate table above is its result sheet. Together with *Investigation 9* (week 21), it is where the exam's biotechnology free-response items come from: expect to interpret plates, calculate efficiency, and propose controls.

## Self-check

1. List the three features a cloning vector needs and the problem each solves.
2. Predict the appearance of each of the four pGLO plates and state what each control rules out.
3. Explain why a ddNTP stops a chain, using the words 3′-OH and phosphodiester.
4. Describe the two components of CRISPR-Cas9 and how a cut becomes a knockout.
5. Trace a single-base deletion in a gene from replication error to phenotype, naming the week-by-week ideas you use.

---

*Adapted from* Biology 2e *by OpenStax, Rice University (§17.1 Biotechnology; §17.3 Whole-Genome Sequencing; §14.2 DNA Structure and Sequencing; §16.2 Prokaryotic Gene Regulation), licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Accessed 2026-10-01. Adapted from the original: condensed, reorganised around the AP Biology CED, and extended with worked examples.*
