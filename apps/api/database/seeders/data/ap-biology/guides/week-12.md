# Week 12 · Cell Communication and Signal Transduction

**CED topics:** 4.1 Cell Communication · 4.2 Introduction to Signal Transduction · 4.3 Signal Transduction Pathways
**Big Ideas:** Information Storage and Transmission (IST), Systems Interactions (SYI)
**Built from:** OpenStax *Biology 2e* §9.1 Signaling Molecules and Cellular Receptors; §9.2 Propagation of the Signal; §9.3 Response to the Signal; §9.4 Signaling in Single-Celled Organisms
**Spiral:** keep Units 1 to 3 in mind. Receptor specificity is protein structure (1.7); which ligands cross a membrane is permeability (2.4); every kinase is an enzyme (3.1) and every phosphate comes from ATP (3.3).

## What you need to be able to do

The College Board phrases the learning objectives for this week as:

- **4.1** Describe the ways that cells can communicate with one another, and explain how cells communicate over short and long distances.
- **4.2** Describe the components of a signal transduction pathway and the role each plays in producing a cellular response.
- **4.3** Describe the role of the environment in eliciting a cellular response; describe the kinds of response a pathway can produce; explain how a change in the structure of any signalling molecule affects the activity of the pathway.

In plain language: given any signal, from a neurotransmitter to a hormone to a bacterial autoinducer, you must be able to say how it reaches its target, where its receptor sits and why, what happens between receptor and response, how a small signal becomes a large response, how the cell turns it off, and what goes wrong when one part of the chain is mutated or blocked.

## Key vocabulary

| Term | Meaning |
|---|---|
| Ligand | A molecule that binds a specific receptor and delivers a signal. Hydrophobic ligands cross the membrane; hydrophilic ones cannot. |
| Receptor | A protein whose binding site fits one ligand. Binding changes its shape, and the shape change is the message. |
| Paracrine | Local signalling by diffusion to nearby cells; the ligand is quickly degraded or taken up. |
| Endocrine | Long-distance signalling by hormones in the bloodstream, diluted to tiny concentrations. Slower, longer lasting. |
| Quorum sensing | Bacteria secrete autoinducers whose concentration tracks population density; above a threshold, group genes switch on. |
| Internal receptor | Cytoplasmic or nuclear receptor for hydrophobic ligands (steroids, thyroid hormone); the complex regulates transcription. |
| Cell-surface receptor | Transmembrane protein with extracellular, transmembrane and intracellular domains. Three classes: ion channel-linked, G protein-coupled, enzyme-linked. |
| G protein | A switch bound to a seven-pass receptor: on with GTP, off when it hydrolyses GTP to GDP. |
| Receptor tyrosine kinase | Enzyme-linked receptor; ligand causes dimerisation, partners phosphorylate each other's tyrosines, relay proteins dock. |
| Kinase / phosphatase | A kinase adds a phosphate from ATP to serine, threonine or tyrosine; a phosphatase removes it. |
| Second messenger | Small non-protein relay molecule or ion: cAMP, Ca²⁺, IP₃, DAG. |
| Amplification | Each catalytic step acts on many molecules of the next, so active molecules multiply down the cascade. |

## Three steps, every time

Every signalling pathway has the same skeleton. **Reception:** a ligand binds a receptor and the receptor changes shape. **Transduction:** that shape change is passed along a chain of proteins and small molecules, usually by phosphorylation and by second messengers. **Response:** something in the cell changes, from an enzyme's activity to the set of genes being transcribed to whether the cell divides or dies.

The first question to ask of any ligand is whether it can cross a phospholipid bilayer. Steroid hormones (estradiol, testosterone, cortisol), thyroid hormone and the gas nitric oxide are small and hydrophobic; they slip through and bind **internal receptors**. The receptor-ligand complex then exposes a DNA-binding region, moves to the nucleus and switches particular genes on or off. Peptide hormones such as insulin, amino-acid derivatives such as epinephrine, and neurotransmitters are polar; they are stopped by the membrane's hydrophobic core and must bind **cell-surface receptors** whose intracellular domains carry the message inward.

## How cells communicate (4.1)

Classify any example by route and distance. **Direct contact** uses gap junctions in animals and plasmodesmata in plants, through which ions and small mediators diffuse from one cytoplasm to the next. **Paracrine** signals, including growth factors and neurotransmitters, diffuse through the extracellular matrix to neighbours and are degraded fast, which keeps the response local; **synaptic** signalling is the special case of a neurotransmitter crossing a cleft only tens of nanometres wide. **Endocrine** signals are hormones that ride the bloodstream; they arrive diluted, so target cells need high-affinity receptors, and the response is slower to start and longer to last. **Autocrine** signalling is a cell acting on itself, used in development, inflammation and the decision to undergo apoptosis.

Single-celled organisms do it too. Haploid yeast cells signal with a peptide mating factor through kinases and GTP-binding proteins, the same parts as an animal pathway. Bacteria perform **quorum sensing**: each cell secretes an autoinducer, the concentration rises with population density, and above a threshold the autoinducer binds transcription factors and switches on genes for behaviours that only pay when the crowd is large enough, such as the light made by *Vibrio fischeri* inside the bobtail squid, biofilm formation, or toxin release. Because autoinducer switches on more autoinducer production, quorum sensing is also a positive feedback loop, a preview of week 13.

## Receptors and the first relay (4.2)

Surface receptors come in three classes. **Ion channel-linked receptors** are gates: ligand binding opens a pore and ions flow down their gradient, which is the fast mechanism at synapses. **G protein-coupled receptors** have seven transmembrane segments and sit beside a G protein; ligand binding lets the G protein drop GDP, pick up GTP, split into active parts and switch on a membrane enzyme or channel. The G protein's own GTPase activity hydrolyses GTP back to GDP and turns the signal off, which is why cholera toxin, which disables that hydrolysis, leaves intestinal cells pumping chloride and water into the gut. **Enzyme-linked receptors**, chiefly receptor tyrosine kinases, pair up when ligand binds; each partner phosphorylates tyrosines on the other, and the phosphotyrosines become docking sites for relay proteins.

The relay itself is a **cascade**: each activated protein activates the next, usually by **phosphorylation**. Kinases transfer a phosphate from ATP to a serine, threonine or tyrosine; the added negative charge changes R-group interactions and so the protein's shape and activity. Phosphatases take the phosphate off again. Steps nearer the receptor are **upstream**; steps nearer the response are **downstream**. A block upstream silences everything below it; adding a downstream molecule directly bypasses any block above.

## Second messengers and responses (4.3)

**cAMP** is made from ATP by adenylyl cyclase, a membrane enzyme switched on by a G protein. It activates protein kinase A, which phosphorylates serine and threonine targets. Phosphodiesterase destroys cAMP. **Ca²⁺** is kept very low in the cytoplasm by ATP-driven pumps that push it out of the cell or into the endoplasmic reticulum; a signal that opens Ca²⁺ channels lets ions flood down the gradient and the cytoplasmic concentration jumps in milliseconds. **IP₃ and DAG** are both produced when phospholipase C splits the membrane lipid PIP₂: DAG stays in the membrane and activates protein kinase C, IP₃ diffuses to the ER and opens its Ca²⁺ channels.

The response depends on the receiving cell. Epinephrine raises cAMP in liver and in heart muscle through the same receptor, but liver cells carry enzymes that break glycogen down and heart cells carry proteins that speed contraction, so one hormone coordinates two tissues. Responses include altered enzyme activity (metabolism), altered gene expression (a transcription factor is freed or activated), protein synthesis, growth and division (growth factor → receptor tyrosine kinase → Ras → MAP kinase cascade), and **apoptosis**, the controlled dismantling ordered when a cell is damaged, loses contact with its matrix, or is a T cell that recognises self.

Turning the signal off matters as much as turning it on: the ligand is degraded or removed, phosphatases strip phosphates, phosphodiesterase breaks cAMP down, pumps clear Ca²⁺. A mutation that disables an off switch produces a pathway stuck on. Ras locked in its GTP state signals division with no growth factor present; such mutations are found in about 30% of human cancers.

## Worked example 1: reading an epinephrine experiment

| Preparation | Treatment | cAMP (relative) | Glucose released (μmol) |
|---|---|---|---|
| Intact cells | none | 1 | 2 |
| Intact cells | epinephrine | 25 | 48 |
| Membrane-free extract | epinephrine | 1 | 3 |
| Membrane-free extract | cAMP added | — | 45 |
| Intact cells + receptor blocker | epinephrine | 1 | 2 |

*Question:* Where does epinephrine act, and what is cAMP's role?

*Reasoning:* Row 2 shows the whole pathway working. Row 3 removes only membranes and loses everything, so the receptor and the cAMP-making enzyme must be in the membrane. Row 4 restores the response by adding cAMP alone to a preparation with no receptor, so cAMP is downstream of reception and sufficient on its own. Row 5 keeps the membranes but blocks the receptor and loses everything, so reception is required. On the exam, treat each row as a test of one step and ask what the row has removed or added.

## Worked example 2: amplification arithmetic

Suppose one receptor activates 100 G proteins, each cyclase makes 100 cAMP, and each protein kinase A phosphorylates 100 enzymes. Active enzymes per receptor = 100 × 100 × 100 = 10⁶. If each enzyme then frees 1,000 glucose molecules, one hormone molecule has released 10⁹ glucose molecules. That is why blood hormone concentrations are measured in nanomoles per litre and why a cascade, not a single step, is worth the cost.

## Worked example 3: predicting the effect of a mutation

| Receptor tyrosine kinase version | Growth factor | Receptor phosphotyrosine | Divisions per 100 cells |
|---|---|---|---|
| Wild type | yes | 40 | 52 |
| Extracellular domain deleted | yes | 1 | 4 |
| Kinase domain dead | yes | 2 | 6 |
| Forced permanent dimer | no | 38 | 49 |

*Reasoning:* The deletion cannot bind ligand, so there is no dimerisation and nothing happens. The kinase-dead receptor may dimerise but cannot phosphorylate its partner, so no docking sites form. The forced dimer has skipped the step ligand normally performs, so it signals with no ligand at all: a gain-of-function mutation. The rule for any pathway question is to locate the lesion, then reason upstream (unaffected) and downstream (changed).

## Common misconceptions

- **"Hormones enter the cell to act."** Only hydrophobic ones do. Peptide hormones never cross the membrane; their receptor's intracellular domain does the entering for them.
- **"The ligand is the signal all the way in."** The ligand stops at the receptor. What travels inward is a shape change, then phosphates and second messengers.
- **"A second messenger is a second hormone."** It is a small intracellular molecule, made or released after reception, never secreted.
- **"Kinases break things down."** They add phosphates. Phosphatases remove them. Neither digests the target.
- **"Switching a signal off is automatic."** It is enzymatic and costs energy; an off-switch mutation is as serious as an on-switch one.

## Where this goes next

Week 13 takes the cascade's logic to the whole body: negative and positive feedback loops, in which a response feeds back on the signal that caused it, and then the cell cycle. Week 14 returns to Ras, growth factors and apoptosis in the regulation of cell division and in cancer.

**AP labs.** No AP investigation is pinned to this week. *Investigation 7: Cell Division: Mitosis and Meiosis* begins in week 14 and asks whether a signal (a fungal lectin) changes the rate at which root-tip cells divide, which is a signal transduction question answered with a chi-square test.

## Self-check

1. For insulin, estradiol and a neurotransmitter, state the signalling category, where the receptor sits and why.
2. Draw the epinephrine pathway from receptor to glucose and label reception, transduction and response.
3. Explain, with numbers, why one hormone molecule can release millions of glucose molecules.
4. A cell has no phosphodiesterase. Predict what happens after a brief pulse of epinephrine and justify it.
5. Name four ways a cell turns a signal off, and for each give a mutation that would break it.

---

*Adapted from* Biology 2e *by OpenStax, Rice University (§9.1 Signaling Molecules and Cellular Receptors; §9.2 Propagation of the Signal; §9.3 Response to the Signal; §9.4 Signaling in Single-Celled Organisms), licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Accessed 2026-10-01. Adapted from the original: condensed, reorganised around the AP Biology CED, and extended with worked examples.*
