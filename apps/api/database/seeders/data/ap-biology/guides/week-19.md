# Week 19 · Transcription, RNA Processing and Translation

**CED topics:** 6.3 Transcription and RNA Processing · 6.4 Translation
**Big Ideas:** Information Storage and Transmission (IST), Evolution (EVO), Systems Interactions (SYI)
**Built from:** OpenStax *Biology 2e* §15.1 The Genetic Code; §15.2 Prokaryotic Transcription; §15.3 Eukaryotic Transcription; §15.4 RNA Processing in Eukaryotes; §15.5 Ribosomes and Protein Synthesis
**Spiral:** keep week 18 and Unit 1 week 3 in mind. RNA polymerase obeys the same template rules as DNA polymerase; a polypeptide is still a chain of peptide bonds made N to C; and the difference between a cell with a nucleus and one without decides how much of this week applies to each.

## What you need to be able to do

The College Board phrases the two learning objectives for this week as:

- **6.3** Describe the mechanisms by which genetic information flows from DNA to RNA to protein, and explain how the phenotype of an organism is determined by its genotype.
- **6.4** Explain how the phenotype of an organism is determined by its genotype, and describe how the translation of mRNA into a polypeptide occurs.

In plain language: given a stretch of double-stranded DNA and a codon table, you must be able to write the mRNA, find the start codon, read off the polypeptide and predict what a given mutation does to it. You must know what a eukaryote does to its transcript before it leaves the nucleus (cap, tail, splice) and why, and you must be able to describe the ribosome's three stages using the right parts (tRNA, anticodon, A/P/E sites, release factor). Most exam items will hand you sequences or data and ask you to reason.

## Key vocabulary

| Term | Meaning |
|---|---|
| Template strand | The DNA strand RNA polymerase reads, 3′ → 5′; the RNA is complementary to it. |
| Coding strand | The other strand; its sequence matches the mRNA with T for U. |
| Promoter | The sequence upstream of a gene where transcription starts (−10 and −35 boxes in bacteria; TATA box in eukaryotes). |
| Sigma factor | The bacterial RNA polymerase subunit that recognises the promoter. |
| Transcription factors | Eukaryotic proteins that bind the promoter (general) or enhancers (specific) and recruit RNA polymerase II. |
| Pre-mRNA | The primary eukaryotic transcript, before processing. |
| 5′ cap | A 7-methylguanosine added to the 5′ end: protection and the ribosome's landing site. |
| Poly-A tail | About 200 adenines added after the AAUAAA signal: stability and export. |
| Intron / exon | Removed / retained segments of a pre-mRNA. |
| Spliceosome | The snRNA-protein machine that cuts out introns and joins exons. |
| Alternative splicing | Different exon combinations from one gene give different proteins. |
| Codon | Three mRNA bases specifying one amino acid or stop. 64 in all; 61 sense, 3 stop. |
| Anticodon | The three bases on a tRNA that pair antiparallel with a codon. |
| Aminoacyl-tRNA synthetase | The enzyme that attaches the right amino acid to the right tRNA, using ATP. |
| Ribosome | rRNA plus protein, two subunits (70S in bacteria, 80S in eukaryotes), with A, P and E sites. |
| Peptidyl transferase | The rRNA catalytic site that forms each peptide bond. |
| Release factor | A protein that enters the A site at a stop codon and frees the polypeptide. |
| Reading frame | The grouping of bases into triplets, set by the AUG start. |

## Transcription: reading one gene

RNA polymerase binds a **promoter**, unwinds about 17 base pairs, and reads the **template strand** 3′ → 5′ while building RNA 5′ → 3′ from ribonucleoside triphosphates. The product is complementary to the template and therefore identical in sequence to the **coding strand**, with uracil in place of thymine. Two things distinguish it from replication: only one gene and one strand are copied, and **no primer is needed**, since RNA polymerase can start a chain on its own.

In bacteria the polymerase's **sigma factor** finds the promoter by its −10 (TATAAT) and −35 (TTGACA) boxes, is released once elongation begins (about 40 nucleotides per second), and transcription ends when a G-C-rich hairpin forms in the RNA or when the rho protein catches up with the polymerase. Because there is no nucleus, ribosomes load onto the 5′ end of the transcript while its 3′ end is still being made, and one transcript often carries several genes (polycistronic mRNA, the operons of week 20). Bacterial mRNAs are degraded within seconds to minutes.

Eukaryotes have three RNA polymerases: Pol I makes the large rRNAs in the nucleolus, **Pol II** makes every protein-coding pre-mRNA, Pol III makes tRNAs and small RNAs. Pol II cannot find a promoter alone. The TATA-binding protein binds the **TATA box** (TATAAA, about 25-35 bases upstream), other general transcription factors assemble, and only then does the polymerase join to form the pre-initiation complex. Enhancers and silencers tune the rate but are not required; they are the subject of week 20.

## RNA processing: what a eukaryote does before export

A eukaryotic pre-mRNA is not ready to use. Three modifications turn it into mRNA, all in the nucleus:

1. **5′ cap.** A modified guanine is attached to the 5′ end while transcription is still under way. It protects the end from nucleases and is what the small ribosomal subunit binds before scanning to the first AUG.
2. **3′ poly-A tail.** The transcript is cut just after an AAUAAA signal and poly-A polymerase adds about 200 adenines. The tail guards the 3′ end, helps the mRNA leave the nucleus and sets its lifetime; a capped, tailed mRNA lasts hours, and shortening the tail marks it for destruction.
3. **Splicing.** Introns (which begin with GU and end with AG) are cut out by the **spliceosome**, a complex of small nuclear RNAs and proteins, and the exons are joined with single-nucleotide precision. **Alternative splicing** keeps different exon sets in different cells or at different times, always in the original order, so that one gene yields several related proteins. About 70% of human genes do this, which is why the human proteome is far larger than the gene count.

tRNAs and rRNAs are also cut from longer precursors and chemically modified. On the exam, "cap, tail, splice" with a function for each is the complete answer to "describe RNA processing"; the 2025 CED names the cap and the tail explicitly.

## The code

Four bases taken two at a time give 16 combinations, too few for 20 amino acids; three at a time give 64. So a **codon** is three bases, read without overlap from a fixed start. Of the 64, **61 specify amino acids** and **three (UAA, UAG, UGA) mean stop**. **AUG** is both the start codon and methionine. Most amino acids have several codons, usually differing in the third base; this **degeneracy** means many third-position substitutions are silent. The code is nearly universal, which is both evidence of common ancestry and the reason a human gene can be expressed in a bacterium.

To read a codon table: write the mRNA 5′ → 3′, find the first AUG, group in threes, look up first base (row), second base (column), third base (entry), stop at a stop codon, which adds nothing. Insertions or deletions of one or two bases shift the **reading frame** and scramble everything downstream; three bases add or remove one residue and leave the rest alone.

## Translation: the ribosome's three stages

The adapter between codons and amino acids is **tRNA**: a small RNA folded into an L, with an **anticodon** at one end and the amino acid attached at the 3′ end. **Aminoacyl-tRNA synthetases**, one per amino acid, load each tRNA with its amino acid at the cost of ATP; the bond they make is the energy source for the later peptide bond. The code is physically enforced here, not on the ribosome: a tRNA delivers whatever it carries to wherever its anticodon pairs.

The **ribosome** is two subunits of rRNA and protein (30S + 50S = 70S in bacteria; 40S + 60S = 80S in eukaryotes) with three tRNA sites: **A** (incoming aminoacyl-tRNA), **P** (the tRNA holding the chain) and **E** (exit).

- **Initiation.** The small subunit binds the mRNA (at the Shine-Dalgarno sequence in bacteria; at the 5′ cap, then scanning to AUG, in eukaryotes), the initiator tRNA (formyl-methionine in bacteria, methionine in eukaryotes) sits in the P site, and the large subunit joins, using GTP.
- **Elongation.** A charged tRNA whose anticodon matches the A-site codon enters (GTP). **Peptidyl transferase**, an rRNA catalyst, transfers the chain from the P-site tRNA to the amino group of the A-site amino acid. The ribosome moves one codon (GTP), so the tRNAs shift A → P → E and the empty one leaves. E. coli adds an amino acid every 0.05 s.
- **Termination.** At UAA, UAG or UGA no tRNA fits; a **release factor** enters, water is added to the last bond, the polypeptide is freed and the subunits part.

The mRNA is read 5′ → 3′ and the polypeptide grows N → C. Several ribosomes read one mRNA at once (a polyribosome). A **signal sequence** at the N-terminus sends the ribosome to the rough ER so the protein is threaded into the endomembrane system as it is made; chaperones help it fold; modifications (phosphate, sugars, cleavage) follow.

## Worked example 1: from double-stranded DNA to polypeptide

Coding strand 5′-ATG CCT GAA GGC TAG-3′; template 3′-TAC GGA CTT CCG ATC-5′.

*Reasoning:* mRNA matches the coding strand with U: 5′-AUG CCU GAA GGC UAG-3′. AUG = Met, CCU = Pro, GAA = Glu, GGC = Gly, UAG = stop. Polypeptide: Met-Pro-Glu-Gly, four residues. The two classic errors are reading the template's letters as codons (which gives nonsense) and counting the stop as an amino acid.

## Worked example 2: classifying a mutation

Change the sixth coding-strand base T → C: CCU becomes CCC, still proline. **Silent.** Delete the seventh base: the frame after CCU becomes AAG GCU AG…, lysine-alanine-…, and the old stop is gone. **Frameshift.** Change CAG (Gln) to UAG: **nonsense**, a truncated protein. Change GAA (Glu) to GUA (Val): **missense**; whether it matters depends on where in the protein it falls and how different the R group is (compare sickle-cell, Unit 1). Week 21 builds on this classification.

## Worked example 3: reading a cell-free translation data set

Four versions of one eukaryotic mRNA were translated in a eukaryotic extract; relative protein yield: complete 100, no cap 8, no tail 41, unspliced 2.

*Reasoning:* Removing the cap nearly abolishes output because the small subunit cannot find the message; removing the tail roughly halves it because the message is less stable but can still be initiated; leaving the introns in leaves the coding sequence interrupted, so the product is wrong. If the same mRNAs were given to an E. coli extract, all would do poorly, because bacterial ribosomes bind a Shine-Dalgarno sequence and ignore caps. Expression vectors (week 22) add exactly that sequence.

## Common misconceptions

- **"The mRNA is a copy of the template strand."** It is complementary to the template and matches the coding strand.
- **"RNA polymerase needs a primer."** It does not; that is why replication borrows an RNA polymerase (primase) to start DNA.
- **"Introns are junk that is thrown away."** They are removed, but which exons are kept is regulated, and intron sequences carry splicing signals.
- **"The ribosome checks the amino acid."** It checks only codon-anticodon pairing; synthetases are the proofreaders.
- **"A stop codon codes for a stop amino acid."** It codes for nothing; a protein, the release factor, recognises it.
- **"Bigger mutations do more harm."** A one-base deletion can destroy a protein; a three-base deletion often does not.

## Where this goes next

Week 20 asks how cells decide which genes to transcribe and how much: operons in bacteria, chromatin, transcription factors, enhancers, RNA interference and protein turnover in eukaryotes. Week 21 classifies the mutations you met here and treats them as the raw material of evolution. Week 22 puts transcription and translation to work in a bacterium carrying a human gene.

**AP labs.** *Investigation 8: Biotechnology, Bacterial Transformation* depends on this week twice: the transformed plasmid must be transcribed by the host's RNA polymerase from a promoter the bacterium recognises, and its mRNA must be translated by 70S ribosomes, which is why the engineered gene carries bacterial control sequences and no introns.

## Self-check

1. Write the mRNA and polypeptide for template strand 3′-TAC AAA CGA ATT-5′, using a full codon table.
2. List the three processing steps, where each happens, and one consequence of omitting each.
3. Explain, with the numbers 16 and 64, why codons are triplets.
4. Describe what happens in the A, P and E sites during one elongation cycle, and name the two energy sources used.
5. A tRNA is mischarged with the wrong amino acid. Predict what the ribosome does and justify your prediction.

---

*Adapted from* Biology 2e *by OpenStax, Rice University (§15.1 The Genetic Code; §15.2 Prokaryotic Transcription; §15.3 Eukaryotic Transcription; §15.4 RNA Processing in Eukaryotes; §15.5 Ribosomes and Protein Synthesis), licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Accessed 2026-10-01. Adapted from the original: condensed, reorganised around the AP Biology CED, and extended with worked examples.*
