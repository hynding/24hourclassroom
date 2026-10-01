# Week 26 · Phylogeny and Speciation

**CED topics:** 7.9 Phylogeny · 7.10 Speciation
**Big Ideas:** Evolution (EVO), Information Storage and Transmission (IST)
**Built from:** OpenStax *Biology 2e* §20.1 Organizing Life on Earth; §20.2 Determining Evolutionary Relationships; §18.2 Formation of New Species; §18.3 Reconnection and Speciation Rates
**Spiral:** meiotic errors (5.1) make polyploids; the founder effect and the end of gene flow (7.4) start allopatric speciation; disruptive selection (7.2) starts sympatric speciation; molecular clocks (7.8) date the nodes.

## What you need to be able to do

- **7.9** Describe the types of data that provide evidence for phylogeny; explain how a phylogenetic tree or cladogram represents traits that are derived or lost, and how the tree can be used to infer relatedness and to make predictions.
- **7.10** Describe the conditions under which new species may arise, the rate of speciation and extinction, and explain how prezygotic and postzygotic barriers maintain reproductive isolation.

In plain language: given a tree, you must be able to say which taxa are most closely related and why, which groups are clades and which are not, and what a node and a branch mean. Given a character table or a BLAST output, you must be able to build the tree. And you must be able to explain how one population becomes two, by geography or without it, and name the barrier that keeps them apart.

## Key vocabulary

| Term | Meaning |
|---|---|
| Phylogeny | The evolutionary history of a group; a tree is a hypothesis about it. |
| Node (branch point) | A lineage splitting in two: the most recent common ancestor of everything beyond it. |
| Sister taxa | Two lineages from the same node; each other's closest relatives on the tree. |
| Outgroup | A taxon that branched before the group of interest; defines which traits are ancestral. |
| Shared derived character | A trait that arose in an ancestor and is carried by its descendants only; defines a clade. |
| Clade (monophyletic group) | An ancestor and all of its descendants. |
| Paraphyletic / polyphyletic | An ancestor and some descendants ("reptiles" without birds); members from different ancestors united by a convergent trait ("warm-blooded animals"). |
| Parsimony | Choose the tree needing the fewest evolutionary changes. |
| BLAST | Database search returning the sequences most similar to a query, with percent identity and E-value. |
| E-value | Expected number of equally good matches by chance; smaller is better. |
| Biological species | Populations that interbreed in nature and produce fertile offspring, isolated from others. |
| Allopatric speciation | Divergence after a geographic barrier stops gene flow. |
| Sympatric speciation | Divergence within one area, by niche specialisation plus assortative mating or by polyploidy. |
| Prezygotic barrier | Prevents mating or fertilisation: habitat, temporal, behavioural, mechanical, gametic. |
| Postzygotic barrier | Acts after fertilisation: hybrid inviability, hybrid sterility. |
| Punctuated equilibrium | Rapid change at speciation followed by long stasis. |

## Reading a tree

A **phylogenetic tree** draws the pattern of ancestry and descent. The **root** is the common ancestor of everything shown; each **node** is a lineage splitting; the **tips** are the taxa being compared. Four rules cover almost every exam question:

1. **Relatedness is recency of common ancestry.** To compare two taxa, find the node where their lines meet. The pair whose shared node is nearest the tips is most closely related. In the vertebrate example below, trout and mouse share the bony-skeleton node while trout and shark share only the older jaw node, so the trout is more closely related to the mouse than to the shark, however fish-like both fish look.
2. **Nodes are hinges.** Rotating the two branches at a node changes the drawing, not the relationships. Never judge relatedness by which names sit next to each other along the edge.
3. **Tips are not ancestors.** A **basal taxon** such as the lamprey branched off early, but it has been evolving just as long as the mouse. Ancestors live at nodes.
4. **Branch length means nothing unless there is a scale.** A **cladogram** shows branching order only. A tree drawn to scale (a phylogram) shows the amount of change or time along each branch, and says so.

A **polytomy**, three or more lineages from one node, means the order of splitting is unresolved.

## Building a tree: cladistics

Cladistics groups taxa by **shared derived characters**: traits that arose in a common ancestor and are present in its descendants and nowhere else. Traits inherited from an older ancestor and shared with the **outgroup** are **shared ancestral characters**; they are true of everyone and define no subgroup. The outgroup, chosen because it is known to have branched off earlier, tells you which state is ancestral: whatever the outgroup has.

A **clade** (monophyletic group) is an ancestor plus all its descendants, the only kind of group that reflects phylogeny; you can cut it from the tree with one snip. "Reptiles" excluding birds is **paraphyletic** (the ancestor and some descendants); "fish" excluding tetrapods is another. "Warm-blooded animals" is **polyphyletic**, built on a convergent trait (**homoplasy**) rather than ancestry. Shared absences never define clades: "non-flowering plants" is not a group.

When several trees could fit the data, **maximum parsimony** chooses the one requiring the fewest changes (traits arising or being lost). Molecular data (thousands of aligned bases, comparable across all life, less prone to convergence than shape) have confirmed many anatomical groupings and corrected others, placing whales among the even-toed ungulates and birds among the dinosaurs.

**BLAST** (AP Investigation 3) is the molecular route. Submit a sequence; the database returns the best matches with **percent identity** (matches ÷ positions compared), the alignment length, and an **E-value**, the number of hits this good expected by chance. Rank by lowest E-value and highest identity; cluster the identities into tiers and the tiers are nested clades.

## Worked example 1: a cladogram from a character table

| Trait | Lamprey | Shark | Trout | Frog | Lizard | Mouse |
|---|---|---|---|---|---|---|
| Vertebral column | 1 | 1 | 1 | 1 | 1 | 1 |
| Jaws | 0 | 1 | 1 | 1 | 1 | 1 |
| Bony skeleton | 0 | 0 | 1 | 1 | 1 | 1 |
| Four limbs | 0 | 0 | 0 | 1 | 1 | 1 |
| Amniotic egg | 0 | 0 | 0 | 0 | 1 | 1 |
| Hair | 0 | 0 | 0 | 0 | 0 | 1 |

*Step 1.* The lamprey is the outgroup; everything it lacks is derived. The vertebral column, shared by all, is ancestral for this table and tells us nothing about subgroups.

*Step 2.* Order the derived traits from most to least widely shared: jaws (5 taxa), bony skeleton (4), four limbs (3), amniotic egg (2), hair (1).

*Step 3.* Read the tree off that order: lamprey branches first; then the shark (jaws only); then the trout (jaws and bone); then the frog (plus limbs); lizard and mouse share the amniotic egg and are sister taxa; hair is unique to the mouse. Five nodes for six taxa (n − 1).

*Step 4.* Check parsimony: each trait arises exactly once, six changes in all. A rival tree pairing shark with trout as "fish" would need the bony skeleton to arise twice or be lost in the shark: seven changes, rejected.

## Worked example 2: reading a BLAST table

| Database species | Percent identity | E-value | Alignment length |
|---|---|---|---|
| Komodo dragon | 98 | 0.0 | 600 |
| Green iguana | 93 | 1e-150 | 598 |
| American alligator | 84 | 1e-90 | 590 |
| Chicken | 83 | 1e-85 | 585 |
| Mouse | 76 | 1e-40 | 560 |

The unknown's closest relative in the database is the Komodo dragon (highest identity, lowest E-value, full-length alignment). The identities fall into tiers: lizards (98, 93), alligator and chicken (84, 83), mouse (76). So the unknown sits in a lizard clade; crocodilians and birds form the sister group to lizards; mammals branch earliest. That is the known amniote tree, recovered from one gene. An E-value of 1e-90 does not mean 90% identity or a 90% probability; it means that a match this good would occur by chance about 10⁻⁹⁰ times in a database of this size.

## How one species becomes two

The **biological species concept** defines a species as a group of populations whose members interbreed in nature and produce fertile offspring, and are reproductively isolated from other such groups. Poodles and cocker spaniels are one species; bald eagles and African fish eagles, however alike, are two, because any hybrid would be sterile. **Speciation** is the appearance of reproductive isolation between two populations that were one, and every node on a tree is a speciation event.

**Allopatric speciation** begins with a geographic barrier, a river, a mountain range, an ocean crossing, that stops gene flow. The separated populations now experience different selection and independent drift (often starting from a founder effect), and their gene pools diverge until, if they meet again, they cannot or will not interbreed. The northern and Mexican spotted owls, separated by climate and terrain, are diverging now. On island chains the process repeats: one colonist species spreads to island after island and splits into many, an **adaptive radiation** such as the Hawaiian honeycreepers, whose beaks evolved for nectar, seeds and insects from a single founder.

**Sympatric speciation** happens without a barrier. Two routes. First, ecological: a subgroup starts exploiting a different resource or breeding at a different time, disruptive selection favours the two specialists over intermediates, and assortative mating within each group cuts gene flow. The cichlids of Lake Victoria (hundreds of species in one lake) and the two jaw forms in Nicaragua's Lake Apoyeque, diverging from one founder population in about a century, are the standard cases. Second, **polyploidy**: a meiotic error produces diploid gametes, and the offspring carries extra whole chromosome sets. A 2n = 6 plant that makes 2n gametes gives rise to a 4n = 12 **autopolyploid**; crossed with the original diploids it produces triploids whose odd sets cannot pair in meiosis, so they are sterile, while tetraploids breed among themselves. Reproductive isolation in one generation. An **allopolyploid** is a hybrid between two species whose combined set is doubled so every chromosome has a partner: wheat, cotton and tobacco. More than half of plant species have a polyploid event in their ancestry; it is rare in animals.

## Worked example 3: polyploid arithmetic

Species A (2n = 6) crosses with species B (2n = 10). The hybrid gets 3 + 5 = 8 chromosomes with no homologous pairs: sterile. If the whole set doubles, the plant has 16 chromosomes, every one paired: fertile, and unable to breed with A (16 × 6 mismatch) or B. A new species in two steps. Rule: hybrids with an odd number of sets, or unpaired chromosomes, are sterile; doubling restores pairing.

## Barriers, hybrid zones and rates

Reproductive isolation is maintained by **prezygotic barriers**, which prevent a zygote forming, and **postzygotic barriers**, which act after fertilisation. Prezygotic: **habitat** (two cricket species on sandy versus loamy soil), **temporal** (Rana aurora breeds January to March, Rana boylii March to May), **behavioural** (firefly flash patterns; courtship songs), **mechanical** (damselfly genitalia; flower shapes that fit only certain pollinators), **gametic** (sperm cannot bind the egg surface). Postzygotic: **hybrid inviability** (embryos die) and **hybrid sterility** (the mule). On the exam, classify by asking whether fertilisation occurred.

Where diverging species meet, a **hybrid zone** forms, with three possible fates: **reinforcement** (hybrids are unfit, so selection strengthens prezygotic barriers and the species keep diverging), **fusion** (barriers weaken and the two merge back), or **stability** (fit hybrids keep forming but the species persist).

Speciation can be **gradual**, with many small changes and intermediates in the fossil record, or follow **punctuated equilibrium**, with rapid change at the split and long stasis afterward. Rapid episodes follow environmental change: new islands, climate shifts, mass extinctions that empty niches. Small isolated populations change fastest, because drift and selection act without gene flow to dilute them.

## Common misconceptions

- **"Taxa next to each other on a tree are closest."** Rotate a node and the neighbours change; relatives do not. Read nodes.
- **"A long branch means a long time."** Not on a cladogram. Only a scaled tree shows time or change.
- **"The basal taxon is the ancestor."** Tips are living lineages; ancestors are nodes.
- **"Similar organisms belong together."** Shark and trout are both fish, but the trout shares a bony skeleton with tetrapods. Shared derived traits, not overall similarity, define clades.
- **"Groups can be defined by what they lack."** Shared absences are ancestral states and define nothing.
- **"Speciation always takes millions of years."** Polyploidy does it in one generation; cichlids in a century.
- **"Hybrids that can be produced in the lab mean one species."** Species are defined by what happens in nature and whether offspring are fertile.

## Where this goes next

Week 27 asks what happens to a population when the variation that speciation draws on is gone, and then goes to the root of the tree: how life, and the eukaryotic cell with its endosymbiont, originated. The Unit 7 exam closes the week. Unit 8 uses trees and species counts in community ecology and biodiversity.

**AP labs.** *Investigation 3: Comparing DNA Sequences to Understand Evolutionary Relationships with BLAST* is this week's lab: obtain a sequence, run BLAST, rank the hits by identity and E-value, and place the unknown on a cladogram. The character-table method in worked example 1 is the anatomical version of the same reasoning.

## Self-check

1. Four taxa have traits: W has none of the derived traits; X has trait 1; Y has traits 1 and 2; Z has traits 1, 2 and 3. Describe the cladogram, name the sister taxa, and count the nodes.
2. Explain why "reptiles" (turtles, lizards, crocodiles, excluding birds) is paraphyletic, and what would have to be added to make it a clade.
3. A BLAST search returns identities of 97%, 96%, 81% and 70%. Sketch (in words) the cladogram these tiers imply.
4. Classify each barrier: two orchids pollinated by different bee species; a liger that cannot reproduce; two sea urchins whose gametes will not fuse; two birds with different songs.
5. A plant with 2n = 8 produces unreduced gametes. Give the chromosome number of an autotetraploid, of a cross between the tetraploid and a normal diploid, and state which of the two is fertile and why.

---

*Adapted from* Biology 2e *by OpenStax, Rice University (§20.1 Organizing Life on Earth; §20.2 Determining Evolutionary Relationships; §18.2 Formation of New Species; §18.3 Reconnection and Speciation Rates), licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Accessed 2026-10-01. Adapted from the original: condensed, reorganised around the AP Biology CED, and extended with worked examples on building cladograms, reading BLAST output and polyploid chromosome counts.*
