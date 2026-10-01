# Week 20 · Regulation of Gene Expression and Cell Specialization

**CED topics:** 6.5 Regulation of Gene Expression · 6.6 Gene Expression and Cell Specialization
**Big Ideas:** Information Storage and Transmission (IST), Systems Interactions (SYI), Energetics (ENE)
**Built from:** OpenStax *Biology 2e* §16.1 Regulation of Gene Expression; §16.2 Prokaryotic Gene Regulation; §16.3 Eukaryotic Epigenetic Gene Regulation; §16.4 Eukaryotic Transcription Gene Regulation; §16.5 Eukaryotic Post-transcriptional Gene Regulation; §16.6 Eukaryotic Translational and Post-translational Gene Regulation; §16.7 Cancer and Gene Regulation
**Spiral:** keep weeks 18-19 and Unit 4 in mind. Nucleosomes and histone charge (week 18) are the epigenetic switch; cap, tail and splicing (week 19) are points of control; the trp operon is negative feedback (4.4), and every signalling pathway (4.2-4.3) ends at a transcription factor.

## What you need to be able to do

The College Board phrases the two learning objectives for this week as:

- **6.5** Describe the types of interactions that regulate gene expression, and explain how the location of regulatory sequences relates to their function.
- **6.6** Explain how the binding of transcription factors to promoter regions affects gene expression and the phenotype of the organism, and explain the connection between the regulation of gene expression and observed differences between individuals in a population and between cell types.

In plain language: given a table of expression under different conditions or in different mutants, you must be able to say which switch is doing what. For bacteria that means the lac and trp operons with their repressors, inducers, corepressors and the CAP-cAMP boost. For eukaryotes it means five levels of control and the mechanism at each: chromatin marks, transcription factors on promoters and enhancers, splicing and RNA interference, translation initiation, and protein turnover. Then you must connect all of it to the fact that every cell in a body has the same genome and yet a neuron is not a liver cell.

## Key vocabulary

| Term | Meaning |
|---|---|
| Operon | A promoter, an operator and a set of genes transcribed together on one mRNA. |
| Operator | The DNA sequence a repressor binds to block RNA polymerase. |
| Repressor | A protein that binds DNA and turns transcription off. |
| Inducer | A small molecule (allolactose) that inactivates a repressor and switches an operon on. |
| Corepressor | A small molecule (tryptophan) that activates a repressor and switches an operon off. |
| CAP and cAMP | The catabolite activator protein, active when cAMP is high (glucose low), helps RNA polymerase bind: positive control. |
| Epigenetic | A heritable change in expression without a change in sequence: histone marks, DNA methylation. |
| Histone acetylation | Acetyl groups on histone lysines neutralise their charge, loosen the nucleosome and open the gene. |
| DNA methylation | Methyl groups on cytosines in CpG islands silence a promoter; copied at replication. |
| Transcription factor | A protein that binds DNA to raise (activator) or lower (repressor) transcription. |
| Enhancer | A distant DNA element that binds activators and loops to the promoter. |
| Cis / trans | Cis elements are sequences on the same DNA (promoter, enhancer); trans factors are diffusible proteins. |
| RNA interference | Small RNAs (miRNA, siRNA) in RISC that degrade or block a complementary mRNA. |
| Ubiquitin / proteasome | The tag and the machine that destroy a protein on schedule. |
| Differential gene expression | The same genome, different subsets read; the basis of cell specialisation. |
| Master regulator | A transcription factor that switches on a whole cell-type programme (MyoD for muscle). |

## Why regulate at all

Two reasons, and the exam likes both. **Economy**: transcription and translation cost ATP and amino acids, so a bacterium makes lactose enzymes only when lactose is the best food available. **Specialisation**: a multicellular organism has one genome and two hundred cell types; what differs between them is which genes are read, when and how much. A failure of regulation is also what cancer is.

Bacteria regulate almost entirely at transcription, because with no nucleus and mRNAs that last seconds, stopping transcription stops the protein almost at once. Eukaryotes, with transcription in the nucleus and translation outside it, have five places to intervene.

## Operons: the bacterial model

An **operon** is a promoter, an operator and several genes transcribed as one polycistronic mRNA.

**The lac operon is inducible.** Its genes let E. coli import and split lactose. Normally the **lac repressor** sits on the **operator** and blocks the polymerase. When lactose is present, its derivative **allolactose** binds the repressor, changes its shape, and the repressor leaves: negative control is lifted. But the cell prefers glucose, which enters glycolysis without extra enzymes. When glucose is scarce, **cAMP** rises and binds **CAP**; CAP-cAMP binds beside the promoter and helps the polymerase attach: positive control. Full expression needs both the repressor off and CAP on.

| Glucose | Lactose | Repressor | CAP-cAMP | Transcription |
|---|---|---|---|---|
| present | absent | bound | inactive | none |
| present | present | released | inactive | low |
| absent | absent | bound | active | none |
| absent | present | released | active | high |

**The trp operon is repressible.** Its genes make tryptophan. The **trp repressor** is inactive alone; when tryptophan is abundant it binds as a **corepressor**, the active repressor sits on the operator, and synthesis stops. That is negative feedback at the level of the gene: the product shuts off the pathway that makes it. The rule of thumb: inducible operons serve catabolic pathways (switch on when the substrate appears), repressible operons serve anabolic pathways (switch off when the product accumulates).

## Eukaryotes: five levels of control

**1. Epigenetic (chromatin).** A promoter inside a tight nucleosome cannot be bound. **Histone acetylation** removes the positive charge from lysines, loosening the histone's grip on the negative backbone and opening the gene; deacetylases close it. **DNA methylation** of cytosines in CpG islands silences a promoter and is copied when DNA replicates, so the silence is inherited by daughter cells. Remodelling complexes slide nucleosomes aside. These marks change expression without changing sequence, respond to diet and environment, and are reversible, which is why HDAC inhibitors and demethylating drugs can reactivate silenced tumour suppressors.

**2. Transcriptional.** **General transcription factors** bind the TATA box and are needed by every Pol II gene. **Specific transcription factors** bind **enhancers**, which can lie thousands of bases away in either direction; DNA-bending proteins loop the DNA so activators on the enhancer touch mediator proteins and the pre-initiation complex at the promoter. Repressors bind silencers or block activators. Tissue specificity comes from the combination: the enhancer (cis) is in every cell, but the activator (trans) is made only in some.

**3. Post-transcriptional.** Alternative splicing chooses exons; the 5′ cap and poly-A tail set stability; RNA-binding proteins on the untranslated regions decide where an mRNA goes and how long it lasts. **RNA interference**: miRNAs about 22 nucleotides long, cut from hairpins by Dicer and loaded into **RISC**, pair with complementary mRNAs and either cleave them or stall their translation, lowering protein without touching the gene.

**4. Translational.** Phosphorylating the initiation factor eIF-2 stops it binding GTP, so initiation fails and protein synthesis drops across the board: a fast brake under stress.

**5. Post-translational.** Phosphate, acetyl, methyl and sugar groups switch finished proteins on and off in seconds. A chain of **ubiquitin** marks a protein for the **proteasome**; controlling lifetime controls amount, as with cyclins.

The exam's favourite move is to give you three measurements, transcription rate, mRNA level and protein level, and ask where the control acts. Unchanged transcription with falling mRNA is RNA interference or instability; unchanged mRNA with rising protein is slower degradation.

## From regulation to cell type

Every nucleated cell carries the whole genome: a nucleus from a differentiated tadpole intestinal cell, placed in an enucleated egg, directed development of a frog, and mammalian cloning and reprogramming to stem cells confirm it. Specialisation is **differential gene expression**. **Housekeeping genes** (glycolytic enzymes, ribosomal proteins) are read everywhere at similar levels; **cell-specific genes** (globin, insulin, myosin) are read hundreds of times more in one cell type than in others. Development is a cascade: a signal induces a transcription factor, whose targets include the next transcription factors, and each step narrows the cell's options. **Master regulators** sit at the top; expressing MyoD alone converts a fibroblast into a muscle cell, because the fibroblast had every muscle gene already.

Signals connect the outside to this machinery. Steroid hormones diffuse in and bind receptors that are themselves transcription factors; peptide hormones bind surface receptors and set off kinase cascades that end by phosphorylating transcription factors. Environment acts the same way, which is topic 5.5 restated: temperature controls the pigment enzyme in a Himalayan rabbit, lactose controls the lac operon, maternal diet can change methylation and coat colour in genetically identical mice.

## Worked example 1: diagnosing operon mutants

| Strain | Glc+ Lac− | Glc+ Lac+ | Glc− Lac− | Glc− Lac+ |
|---|---|---|---|---|
| Wild type | 1 | 8 | 1 | 100 |
| X | 8 | 8 | 100 | 100 |
| Y | 1 | 7 | 1 | 9 |

*Reasoning:* Ask which input each strain still obeys. X ignores lactose but obeys glucose: its repressor-operator switch is broken (constitutive), CAP still works. Y obeys lactose but never gets the glucose-absent boost: its CAP-cAMP control is missing. A double mutant would sit at the unaided basal rate, about 8, in every column.

## Worked example 2: locating a control point

Cells expressing a miRNA against gene Z show transcription unchanged, mRNA at 15%, protein at 10%.

*Reasoning:* The gene is being read normally, so the promoter and chromatin are fine. The loss appears at the mRNA, so the control is post-transcriptional: RISC degrades the message, and the small extra drop in protein shows some translational block as well. A proteasome inhibitor, by contrast, would raise protein while leaving mRNA alone.

## Worked example 3: an epigenetics data set

Genetically identical mice whose mothers ate a methyl-rich diet show 58% methylation of a regulatory element versus 22%, a third of the mRNA, and 81% brown coats versus 39%.

*Reasoning:* Same genotype, different phenotype, so the difference is in expression. Methyl donors feed cytosine methylation; methylated DNA is bound less by transcription factors and packed tighter; less transcript, less protein, different coat. It is a correlation with a mechanism, not a proof: a causal test would alter methylation directly. To ask whether the mark is inherited, breed the brown offspring on a normal diet and score their pups.

## Common misconceptions

- **"Lactose turns the lac operon on."** It lifts the repressor; high expression also needs CAP-cAMP, which needs low glucose.
- **"Tryptophan is an inducer."** It is a corepressor: it activates the repressor.
- **"Methylation of histones and of DNA do the same thing."** DNA methylation silences; histone methylation can go either way depending on the residue. Acetylation of histones reliably opens.
- **"Enhancers must be next to the gene."** They act at thousands of bases through looping and can sit downstream or in introns.
- **"miRNAs act on DNA."** They act on mRNA, in the cytoplasm, after transcription.
- **"Differentiated cells have lost genes."** They have silenced them; nuclear transfer proves the genome is intact.

## Where this goes next

Week 21 asks what happens when a regulatory sequence, not a coding sequence, mutates, and treats expression changes as a source of phenotypic variation. Week 22 uses regulation as a tool: the arabinose-inducible promoter that switches on GFP in a transformed bacterium is an operon you will have engineered.

**AP labs.** *Investigation 8: Biotechnology, Bacterial Transformation* uses the pGLO plasmid, in which the gene for green fluorescent protein sits downstream of the araC regulatory system: colonies glow only on plates containing arabinose, which is an inducible operon doing exactly what the lac operon does with lactose.

## Self-check

1. Fill in the four-state lac table from memory, naming the state of the repressor and of CAP in each row.
2. Explain the trp operon as negative feedback, naming the corepressor.
3. List the five eukaryotic levels of control with one mechanism each.
4. A gene's enhancer is deleted and expression is lost in skin but not in gut. Explain.
5. Describe one piece of evidence that differentiated cells keep the whole genome.

---

*Adapted from* Biology 2e *by OpenStax, Rice University (§16.1 Regulation of Gene Expression; §16.2 Prokaryotic Gene Regulation; §16.3 Eukaryotic Epigenetic Gene Regulation; §16.4 Eukaryotic Transcription Gene Regulation; §16.5 Eukaryotic Post-transcriptional Gene Regulation; §16.6 Eukaryotic Translational and Post-translational Gene Regulation; §16.7 Cancer and Gene Regulation), licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Accessed 2026-10-01. Adapted from the original: condensed, reorganised around the AP Biology CED, and extended with worked examples.*
