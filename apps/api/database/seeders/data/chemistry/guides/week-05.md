# Week 05 · Average Atomic Mass and the Unstable Nucleus

**Topics:** 2.3 Average Atomic Mass · 2.4 Nuclear Chemistry: Radioactivity and Half-Life
**Practices:** 4 (analysing data), 5 (using mathematics), 6 (constructing explanations)
**Spiral:** Week 4's isotopes are the whole story here: the periodic table's decimal masses are weighted averages over isotopes, and some isotopes have nuclei that fall apart. Mass conservation from week 4 and significant figures from week 2 run through every calculation.

## What you need to be able to do

- **2.3** Calculate an element's average atomic mass from isotope masses and percent abundances, estimate which isotope is most abundant from the average, and work backwards to an abundance when two isotopes are present.
- **2.4** Describe alpha, beta and gamma radiation (what is emitted, charge, mass, penetrating power) and write balanced nuclear equations for alpha and beta decay.
- **2.4** Explain why some nuclei are unstable, define half-life, and solve half-life problems for mass remaining, fraction remaining, elapsed time or number of half-lives.
- **2.4** Give examples of uses and hazards of radioisotopes (dating, medical imaging and treatment, smoke detectors, radon).

## Key terms

| Term | Meaning |
|---|---|
| Average atomic mass | The abundance-weighted mean of the masses of an element's naturally occurring isotopes, in u; the number on the periodic table. |
| Percent abundance | The fraction of an element's atoms that are a given isotope, measured by mass spectrometry. |
| Radioactivity | The spontaneous emission of particles or energy from an unstable nucleus. |
| Alpha particle (α) | A helium-4 nucleus: 2 protons, 2 neutrons, charge 2+; stopped by paper or skin. |
| Beta particle (β) | A fast electron emitted when a neutron in the nucleus turns into a proton; charge 1−; stopped by a few millimetres of aluminium. |
| Gamma ray (γ) | High-energy electromagnetic radiation with no mass or charge; reduced by thick lead or concrete. |
| Nuclear equation | Shows the parent nucleus, the emitted particle and the daughter nucleus; mass numbers and atomic numbers balance on both sides. |
| Half-life | The time for half of the nuclei in a sample to decay; fixed for each isotope and unaffected by temperature or chemical form. |
| Radioisotope | An isotope with an unstable nucleus. |
| Daughter nucleus | The nucleus left after a decay. |

## Why the periodic table shows decimals (2.3)

Chlorine's atomic mass is 35.45 u, but no chlorine atom has that mass. Natural chlorine is 75.76% chlorine-35 (34.969 u) and 24.24% chlorine-37 (36.966 u). The table reports the **weighted average**: multiply each isotope's mass by its fractional abundance and add.

**Worked example (chlorine).**
0.7576 × 34.969 u = 26.49 u
0.2424 × 36.966 u = 8.961 u
Sum = **35.45 u**.

The average sits closer to 35 than to 37 because chlorine-35 is three times as common. That rule works backwards: if an element's average is close to one isotope's mass, that isotope dominates. Bromine (79.90 u) is roughly half Br-79 and half Br-81; copper (63.55 u) is mostly Cu-63.

**Worked example (copper).** Copper is 69.15% Cu-63 (62.930 u) and 30.85% Cu-65 (64.928 u).
0.6915 × 62.930 = 43.52; 0.3085 × 64.928 = 20.03; total **63.55 u**, matching the table.

**Working backwards.** Boron has two isotopes, B-10 (10.013 u) and B-11 (11.009 u), and an average mass of 10.81 u. Let x be the fraction of B-11. Then 10.013(1 − x) + 11.009x = 10.81. So 10.013 + 0.996x = 10.81; 0.996x = 0.797; **x = 0.800**: boron is 80.0% B-11 and 20.0% B-10.

Abundances come from a **mass spectrometer**, which ionises atoms, accelerates them and bends their paths in a magnetic field; heavier ions bend less. The output is a bar chart of mass against relative abundance.

**Graph description:** a mass spectrum of magnesium. Three vertical bars at mass 24, 25 and 26 u with heights 79.0%, 10.0% and 11.0%. The tallest bar at 24 shows why magnesium's average mass, 24.31 u, is just above 24.

**Try it.** Lithium is 7.59% Li-6 (6.015 u) and 92.41% Li-7 (7.016 u). Find the average atomic mass.
*Answer:* 0.0759 × 6.015 = 0.457; 0.9241 × 7.016 = 6.483; total **6.94 u**.

## Radioactivity: what unstable nuclei do (2.4)

Protons in a nucleus repel one another; the strong nuclear force, acting between all nucleons, holds them together. For light elements a neutron-to-proton ratio near 1:1 is stable; for heavier elements more neutrons are needed, up to about 1.5:1. Beyond 83 protons (bismuth) no nucleus is stable. A nucleus with too many neutrons, too few, or simply too many nucleons is **radioactive**: sooner or later it emits something and becomes a different nucleus.

| Radiation | What it is | Charge | Mass (u) | Stopped by | Effect on nucleus |
|---|---|---|---|---|---|
| Alpha | helium-4 nucleus, ⁴He | 2+ | 4 | paper, skin | A down by 4, Z down by 2 |
| Beta | electron from the nucleus (n → p + e⁻) | 1− | ≈ 0 | a few mm of aluminium | A unchanged, Z up by 1 |
| Gamma | high-energy photon | 0 | 0 | thick lead or concrete | none; often accompanies α or β |

**Writing nuclear equations.** Mass numbers (top) and atomic numbers (bottom) must balance. In plain text we write them as element-A.

- Alpha decay: uranium-238 → thorium-234 + helium-4. Check: 238 = 234 + 4; 92 = 90 + 2.
- Beta decay: carbon-14 → nitrogen-14 + electron (beta particle, mass number 0, charge −1). Check: 14 = 14 + 0; 6 = 7 + (−1).
- Radon-222 → polonium-218 + helium-4 (alpha). Check: 222 = 218 + 4; 86 = 84 + 2.

**Worked example.** Iodine-131 undergoes beta decay. What is the daughter?
Beta decay keeps A at 131 and raises Z from 53 to 54, which is xenon: **xenon-131**.

**Worked example.** Polonium-210 emits an alpha particle. Identify the product.
A: 210 − 4 = 206; Z: 84 − 2 = 82, lead. **Lead-206.**

**Try it.** Complete: thorium-234 → ? + beta particle; americium-241 → ? + alpha particle.
*Answers:* protactinium-234 (Z 91); neptunium-237 (Z 93).

## Half-life (2.4)

Decay is random for any single nucleus but perfectly predictable for a large sample: after one **half-life** half the nuclei have decayed; after two, a quarter remain; after three, an eighth. Each isotope's half-life is fixed and is not changed by heat, pressure or chemical bonding.

| Isotope | Half-life | Use |
|---|---|---|
| Technetium-99m | 6.0 h | medical imaging |
| Iodine-131 | 8.02 d | thyroid treatment |
| Phosphorus-32 | 14.3 d | biochemical tracer |
| Cobalt-60 | 5.27 y | cancer radiotherapy, sterilising equipment |
| Strontium-90 | 28.8 y | fallout hazard (behaves like calcium) |
| Carbon-14 | 5,730 y | dating organic remains |
| Uranium-238 | 4.47 × 10⁹ y | dating rocks |

Remaining amount = original × (1/2)ⁿ, where n = elapsed time ÷ half-life.

**Worked example.** A sample contains 80.0 mg of iodine-131. How much remains after 24.06 days?
n = 24.06 ÷ 8.02 = 3 half-lives. 80.0 → 40.0 → 20.0 → **10.0 mg**.

**Worked example.** A technetium-99m dose is 400 mg when prepared. How long until 25 mg remains?
400 → 200 → 100 → 50 → 25: four half-lives = 4 × 6.0 h = **24 h**.

**Worked example.** A bone fragment has 1/8 of the carbon-14 of living tissue. How old is it?
1/8 = (1/2)³, so three half-lives: 3 × 5,730 = **17,190 years** (about 17,000 years).

**Try it.** After 42.9 days, what fraction of a phosphorus-32 sample remains?
*Answer:* 42.9 ÷ 14.3 = 3 half-lives; (1/2)³ = 1/8 = 12.5%.

## Uses and hazards

Radiation ionises atoms it passes through, which can damage DNA. Alpha emitters are harmless outside the body (skin stops them) but dangerous if inhaled or swallowed, which is why **radon** gas seeping into basements matters. Gamma sources need shielding and distance. The same ionising power is useful: cobalt-60 kills tumour cells and sterilises instruments; iodine-131 concentrates in the thyroid and destroys overactive tissue; technetium-99m's short half-life makes it a safe imaging tracer that is gone in a day; americium-241 in smoke detectors ionises air so a current flows until smoke interrupts it. **Carbon dating** works because living things exchange carbon with the air and stop at death; the C-14 then decays on schedule.

## Common mistakes

- Averaging isotope masses without weighting by abundance ((35 + 37)/2 = 36 is wrong for chlorine).
- Using percent (75.76) instead of fraction (0.7576), giving an answer 100 times too large.
- Forgetting that a beta particle raises the atomic number: the daughter is the *next* element.
- Dividing the sample by the number of half-lives instead of halving repeatedly (three half-lives leaves 1/8, not 1/3).
- Thinking a sample is "gone" after two half-lives; a quarter remains.
- Believing half-life can be sped up by heating; nuclear processes ignore chemistry.

## Where this goes next

Average atomic masses become molar masses in Unit 4 (chlorine's 35.45 u per atom is 35.45 g per mole). Nuclear chemistry returns in Unit 8 with fission and fusion. Week 6 turns to the electrons around the nucleus and the light they emit.

## Self-check

1. Silver is 51.84% Ag-107 (106.905 u) and 48.16% Ag-109 (108.905 u). Compute the average atomic mass. (107.87 u)
2. Gallium's average mass is 69.72 u; its isotopes are Ga-69 and Ga-71. Which is more abundant, and roughly by how much?
3. Write the alpha decay of radium-226 and the beta decay of strontium-90, naming the daughters.
4. Cobalt-60 has a half-life of 5.27 y. What fraction of a source remains after 15.8 y?
5. Why is an alpha emitter more dangerous inside the body than outside it?

---

*Original study material written for this course. Constants and data values are public domain, from U.S. government sources (NIST Chemistry WebBook, NIST CODATA constants, PubChem), rounded for classroom use.*
