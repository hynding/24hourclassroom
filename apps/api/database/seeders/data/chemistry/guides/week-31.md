# Week 31 · Nuclear Fission and Fusion

**Topics:** 8.5 Nuclear Fission and Fusion
**Practices:** 2 (Developing and Using Models), 5 (Using Mathematics and Computational Thinking), 7 (Engaging in Argument from Evidence), 8 (Obtaining, Evaluating, and Communicating Information)
**Spiral:** Nuclear notation, isotopes and neutron counts come from week 4 (2.2); radioactive decay, decay equations and half-life were week 6 (2.4), and this week extends them to reactions that split or join nuclei. Comparing nuclear and chemical energy uses ΔH per mole from unit 7 (7.1), and counting atoms in a gram of uranium is the mole (4.4).

## What you need to be able to do

- **8.5** Explain where nuclear energy comes from using mass defect, binding energy and E = mc²; describe the binding-energy-per-nucleon curve in words and use it to explain why fission of heavy nuclei and fusion of light nuclei both release energy; write and balance a fission equation (conserving mass number and atomic number) and identify the neutrons that sustain a chain reaction; explain critical mass; describe the parts of a fission reactor (fuel, moderator, control rods, coolant, containment) and what each does; describe fusion in the Sun and in experimental reactors and explain why it needs such extreme conditions; compare fission and fusion as energy sources, including fuel, waste and safety; and compare the energy per gram of nuclear and chemical reactions.

## Key terms

| Term | Meaning |
| --- | --- |
| Nucleon | A proton or a neutron; the particles in a nucleus. Mass number A counts them. |
| Mass defect | The difference between the mass of a nucleus and the total mass of its separate nucleons. The nucleus is lighter. |
| Binding energy | The energy equivalent of the mass defect: the energy needed to pull a nucleus apart into separate nucleons, or released when they come together. |
| Binding energy per nucleon | Binding energy divided by the number of nucleons; a measure of how tightly bound a nucleus is. Greatest for iron-56. |
| E = mc² | Energy and mass are equivalent; a mass m converted to energy yields E, with c = 2.998 × 10⁸ m/s. In nuclear units, 1 u = 931.5 MeV. |
| Fission | A heavy nucleus splits into two medium nuclei plus neutrons, releasing energy. |
| Fusion | Two light nuclei join to form a heavier one, releasing energy. |
| Chain reaction | A fission that releases neutrons which cause further fissions, each releasing more neutrons. |
| Critical mass | The smallest amount of fissile material in which a chain reaction sustains itself. |
| Moderator | A material (water, graphite) that slows neutrons so uranium-235 captures them more readily. |
| Control rods | Rods of a neutron absorber (boron, cadmium) raised or lowered to set the rate of the chain reaction. |
| Plasma | A gas so hot that its atoms have lost their electrons; the state of matter in which fusion occurs. |

## 1. Where nuclear energy comes from

Weigh a helium-4 nucleus and you get 4.00151 u. Weigh its parts separately, two protons (2 × 1.00728 u) and two neutrons (2 × 1.00866 u), and you get 4.03188 u. The assembled nucleus is lighter by 0.03037 u. That missing mass is the **mass defect**, and it did not vanish: it left as energy when the nucleons bound together. Einstein's relation, E = mc², converts it: 0.03037 u × 931.5 MeV/u = 28.3 MeV of **binding energy**, the energy you would have to supply to tear the nucleus back apart.

Chemical reactions also convert mass to energy, but the amounts are too small to weigh. Burning a mole of methane releases 890 kJ, equivalent to about 10 nanograms of mass. A nuclear reaction converts roughly a million times more mass per atom, because the nuclear force holding nucleons together is roughly a million times stronger than the electrical forces holding electrons in atoms.

**Worked example.** How much energy is released if exactly 1.00 g of matter is converted to energy? E = mc² = 0.00100 kg × (2.998 × 10⁸ m/s)² = 8.99 × 10¹³ J. That is roughly the energy released by burning 3,000 tonnes of coal. No reaction converts all of a sample's mass; fission converts about 0.1 percent, fusion about 0.4 percent.

## 2. The binding-energy curve

Divide each nucleus's binding energy by its number of nucleons and plot the result against mass number. Described in words: the curve starts low for hydrogen, rises steeply through helium, carbon and oxygen, reaches a broad maximum of about 8.8 MeV per nucleon near iron-56 and nickel-62, then slopes gently downward through the heavy elements to about 7.6 MeV per nucleon at uranium-238.

Energy is released whenever nucleons move to a place higher on this curve, that is, into a more tightly bound nucleus. Two routes do that:

- **Fission** of a heavy nucleus (uranium, A ≈ 235) into two medium ones (A ≈ 90 to 140), which sit higher on the curve. About 0.9 MeV per nucleon is released, roughly 200 MeV per fission.
- **Fusion** of very light nuclei (hydrogen isotopes, A = 2 and 3) into helium (A = 4), which sits far higher on the steep part of the curve. About 3.5 MeV per nucleon is released, 17.6 MeV per deuterium–tritium fusion.

Iron cannot release energy either way; it is the ash of the nuclear universe, and the reason iron is so abundant.

## 3. Fission and the chain reaction

Uranium-235 is **fissile**: when it absorbs a slow neutron it becomes a wobbling uranium-236 that splits within a trillionth of a second. One of many possible outcomes:

²³⁵U + ¹n → ¹⁴¹Ba + ⁹²Kr + 3 ¹n

Check the balance as in week 6: mass numbers 235 + 1 = 236 = 141 + 92 + 3; atomic numbers 92 + 0 = 92 = 56 + 36 + 0. The fragments are different every time (barium and krypton, or xenon and strontium, or dozens of other pairs), but on average 2.4 neutrons appear per fission, and each can trigger another fission. One becomes two, two become five, five become twelve: a **chain reaction**.

Whether the chain grows, holds steady or dies depends on how many of those neutrons find another uranium-235 nucleus before escaping from the lump or being absorbed by something else. Below a certain size, too many escape through the surface and the chain fizzles. The **critical mass** is the smallest amount in which, on average, exactly one neutron per fission goes on to cause another. A bomb assembles a supercritical mass in a microsecond; a reactor holds its fuel just at criticality and adjusts continuously.

**Worked example.** Uranium-235 absorbs a neutron and splits into xenon-140, strontium-94 and some neutrons. How many? Mass numbers: 236 = 140 + 94 + x, so x = 2. Atomic numbers check: 54 + 38 = 92.

**Try it.** Complete ²³⁹Pu + ¹n → ¹³⁴Xe + ? + 3 ¹n, where the missing fragment has Z = 40 (zirconium). (Answer: 240 − 134 − 3 = 103, so ¹⁰³Zr; 94 = 54 + 40.)

## 4. Inside a fission reactor

Natural uranium is 99.3 percent uranium-238, which does not fission with slow neutrons, and 0.7 percent uranium-235. Reactor fuel is enriched to 3 to 5 percent uranium-235 and formed into ceramic pellets inside metal rods.

| Part | What it does |
| --- | --- |
| Fuel rods | Enriched uranium dioxide; where fission happens and heat is produced. |
| Moderator | Water or graphite surrounding the rods; slows fast fission neutrons to the speeds uranium-235 captures best. Without it, most neutrons are too fast and the chain dies. |
| Control rods | Boron or cadmium absorb neutrons; lowering them slows the reaction, raising them speeds it. Dropped fully in, they shut the reactor down. |
| Coolant | Water pumped through the core; carries heat away to make steam for turbines, and in most designs doubles as the moderator. |
| Containment | Thick steel and concrete; holds in radiation and fission products if anything fails. |

The fission fragments themselves are intensely radioactive, with half-lives from seconds to tens of thousands of years, and are the chief problem of fission power: spent fuel must be cooled for years and then isolated for millennia. Reactors cannot explode like bombs (the fuel is nowhere near pure enough), but the heat of decaying fragments continues after shutdown and must be removed, which is what failed at Fukushima.

## 5. Fusion: the Sun's reaction and ours

In the Sun's core, at 15 million K and enormous pressure, hydrogen nuclei fuse in several steps to helium, releasing the energy that reaches Earth as sunlight. Net: 4 ¹H → ⁴He + 2 positrons + energy, with about 0.7 percent of the mass converted.

On Earth the easiest fusion to achieve is between the two heavy isotopes of hydrogen:

²H + ³H → ⁴He + ¹n, releasing 17.6 MeV

**Worked example.** Masses: ²H 2.01410 u, ³H 3.01605 u, ⁴He 4.00260 u, neutron 1.00866 u. Reactants total 5.03015 u; products total 5.01126 u; mass defect 0.01889 u. Energy = 0.01889 × 931.5 = **17.6 MeV**.

Nuclei are positively charged and repel one another; to get within range of the nuclear force they must collide at speeds reached only above about 100 million K. At that temperature matter is a **plasma**, and no container can touch it. Experimental reactors (tokamaks) hold the plasma in a doughnut of magnetic fields; others compress a fuel pellet with lasers. Both have produced fusion energy, but not yet more than they consume for long enough to run a power station.

The attraction is obvious: deuterium is in seawater, tritium can be bred from lithium, the product is harmless helium, there is no chain reaction to run away (the plasma simply cools if anything fails), and the only long-lived waste is the reactor's own activated structure. The obstacles are the temperature, the confinement and the engineering of a wall that survives the neutron flux.

## 6. Fission versus fusion, and versus chemistry

| | Fission | Fusion | Chemical (combustion) |
| --- | --- | --- | --- |
| What happens | Heavy nucleus splits | Light nuclei join | Electrons rearrange, bonds change |
| Fuel | Uranium-235, plutonium-239 | Deuterium, tritium | Coal, oil, gas |
| Energy per event | About 200 MeV | 17.6 MeV | A few eV |
| Energy per gram of fuel | About 8 × 10¹⁰ J | About 3 × 10¹¹ J | About 3 × 10⁴ J (coal) |
| Conditions | Critical mass, slow neutrons | 100 million K plasma | A spark |
| Main products | Radioactive fragments, neutrons | Helium, neutrons | CO₂, water |
| Status | Commercial since the 1950s | Experimental | Everywhere |

The energy-per-gram row is the one to remember: fission of a gram of uranium releases about three million times the energy of burning a gram of coal, and fusion of a gram of hydrogen isotopes about four times more again. A fission plant is refuelled with a few tonnes a year; a coal plant of the same output burns a train of coal every day.

**Try it.** A fission releases 200 MeV. Using 1 MeV = 1.602 × 10⁻¹³ J and 2.56 × 10²¹ atoms in a gram of uranium-235, estimate the energy from fissioning a whole gram. (Answer: 200 × 1.602 × 10⁻¹³ J × 2.56 × 10²¹ = 8.2 × 10¹⁰ J.)

## Common mistakes

- **"Mass is destroyed."** Mass is converted to energy; mass plus energy together are conserved. The mass defect is accounted for exactly by E = mc².
- **Fission and fusion both release energy, so "iron releases the most."** Iron is the end point: it releases nothing either way. Energy comes from moving toward iron on the curve.
- **Confusing decay with fission.** Radioactive decay (2.4) is spontaneous and emits a small particle; fission is induced by a neutron and splits the nucleus roughly in half.
- **Control rods and moderator swapped.** The moderator slows neutrons so they are captured; the control rods absorb them so they are not.
- **Thinking a reactor can explode like a bomb.** Reactor fuel is 3 to 5 percent uranium-235; a weapon needs about 90 percent.
- **Writing fusion as "hydrogen atoms combining to form helium molecules."** Nuclei fuse; electrons and molecules are irrelevant at 100 million K.
- **Forgetting to balance both numbers.** Mass number and atomic number must each add up on both sides of a nuclear equation.

## Where this goes next

Week 32 returns to the electrons for the chemistry of carbon, the element whose nuclei were themselves made by fusion in stars. Unit 8's exam asks for one balanced nuclear equation, one energy comparison and an account of a reactor or of fusion. On the final, expect a fission equation to complete, the mass-defect idea in a sentence, and a fission-versus-fusion comparison.

## Self-check

1. Why is a helium-4 nucleus lighter than two protons and two neutrons weighed separately?
2. Which releases more energy per nucleon, fission of uranium or fusion of hydrogen? Why?
3. Complete: ²³⁵U + ¹n → ¹³⁷Te + ? + 2 ¹n (the missing fragment is zirconium, Z = 40).
4. What would happen in a reactor if the moderator were removed?
5. Why does fusion require a temperature of about 100 million K?

**Answers.** 1. The mass defect: binding energy left as the nucleons came together, and E = mc² says that energy has mass. 2. Fusion, about 3.5 MeV per nucleon against about 0.9; light nuclei sit on the steep part of the binding-energy curve, far below helium. 3. 236 − 137 − 2 = 97; ⁹⁷Zr (Z: 52 + 40 = 92). 4. Fission neutrons would stay too fast to be captured efficiently by uranium-235, and the chain reaction would die out. 5. The positively charged nuclei must collide fast enough to overcome their electrical repulsion and reach the range of the nuclear force.

---

*Original study material written for this course. Constants and data values are public domain, from U.S. government sources (NIST Chemistry WebBook, NIST CODATA constants, PubChem), rounded for classroom use.*
