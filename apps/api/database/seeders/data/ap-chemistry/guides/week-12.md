# Week 12 · The Photoelectric Effect and the Beer–Lambert Law

**Topics:** 3.12 Photoelectric Effect · 3.13 Beer–Lambert Law
**Practices:** 2 (Question and Method), 3 (Representing Data and Phenomena), 4 (Model Analysis), 5 (Mathematical Routines)
**Spiral:** Week 11's E = hν is the whole photoelectric effect; week 3's photoelectron spectroscopy is the same physics applied to atoms. Week 10's molarity becomes the x-axis of a calibration curve, and week 10's dilutions are how an over-absorbing sample is brought into range. Week 11's "which colour is absorbed" decides the wavelength a spectrophotometer should use.

## What you need to be able to do

- **3.12** Explain the photoelectric effect as evidence that light is made of photons of energy E = hν: a metal emits electrons only when the photon energy exceeds a threshold, the electron's kinetic energy grows with frequency (not intensity), and intensity changes only the number of electrons emitted.
- **3.12** Calculate the maximum kinetic energy of an emitted electron, the threshold frequency or wavelength, or the work function from any two of them.
- **3.13** Use the Beer–Lambert law, A = εbc, to relate absorbance to concentration, path length and molar absorptivity; interpret absorbance as −log(I/I₀) and relate it to percent transmittance.
- **3.13** Explain how a spectrophotometer measures concentration: choice of wavelength at the absorption maximum, a calibration curve of absorbance against known concentrations, and reading an unknown from it; recognise the limits of the linear range.

## Key terms

| Term | Meaning |
|---|---|
| Photoelectric effect | Emission of electrons from a metal surface struck by light of sufficiently high frequency. |
| Photon | A quantum of light carrying energy E = hν; one photon is absorbed by one electron. |
| Work function, φ | The minimum energy needed to remove an electron from the metal's surface; characteristic of the metal. |
| Threshold frequency, ν₀ | The lowest frequency that ejects electrons: hν₀ = φ. Below it nothing happens, however bright the light. |
| Kinetic energy of the photoelectron | KE = hν − φ; grows linearly with frequency, independent of intensity. |
| Intensity | The number of photons per second; sets how many electrons leave per second, not how fast. |
| Absorbance, A | A = log(I₀/I) = −log(I/I₀), where I₀ is the light intensity entering the sample and I the intensity leaving; unitless. |
| Transmittance, T | T = I/I₀; %T = 100 T. A = −log T, so 50 %T is A = 0.301 and 10 %T is A = 1.00. |
| Beer–Lambert law | A = εbc: absorbance is proportional to molar absorptivity ε (M⁻¹cm⁻¹), path length b (cm) and concentration c (M). |
| Calibration curve | A plot of A against c for standards of known concentration; its slope is εb, and an unknown's c is read from its A. |

## The photoelectric effect (3.12)

Shine light on a clean metal surface and, under the right conditions, electrons fly off. Around 1900 the details made no sense in a wave picture of light. A wave delivers energy continuously, so a dim light should still eject electrons after a delay, and a brighter light should eject faster electrons. Neither happens:

1. Below a certain **threshold frequency** ν₀ (characteristic of the metal) no electrons are ejected, however intense the light or however long it shines.
2. Above the threshold, electrons appear instantly, even in dim light.
3. Raising the **frequency** raises the maximum **kinetic energy** of the ejected electrons; raising the **intensity** raises the **number** of electrons per second but not their energy.

Einstein's explanation (1905) is that light arrives in packets, **photons**, each carrying E = hν, and that one photon gives all of its energy to one electron. The electron must spend the **work function** φ to escape the surface; whatever is left over is its kinetic energy:

KE_max = hν − φ,  with φ = hν₀

If hν < φ the photon cannot free the electron and nothing happens: the energy of two weak photons does not add up, because each is absorbed separately. Brighter light at the same frequency means more photons, so more electrons, each with the same energy. The photoelectric effect is therefore direct evidence for photons, and the slope of a graph of KE_max against ν is Planck's constant.

**Worked example 1.** Sodium has a work function of about 3.65 × 10⁻¹⁹ J. (a) Threshold wavelength: λ₀ = hc/φ = (6.626 × 10⁻³⁴)(2.998 × 10⁸) ÷ 3.65 × 10⁻¹⁹ = 5.44 × 10⁻⁷ m = 544 nm (green). Any visible light bluer than green ejects electrons; red light does not. (b) With 400 nm light: E_photon = hc/λ = 1.986 × 10⁻²⁵ ÷ 4.00 × 10⁻⁷ = 4.97 × 10⁻¹⁹ J, so KE_max = 4.97 × 10⁻¹⁹ − 3.65 × 10⁻¹⁹ = 1.32 × 10⁻¹⁹ J. (c) Doubling the intensity of the 400 nm lamp doubles the number of electrons per second; KE_max stays 1.32 × 10⁻¹⁹ J.

**Worked example 2.** Zinc has a work function of about 6.9 × 10⁻¹⁹ J, giving λ₀ = 1.986 × 10⁻²⁵ ÷ 6.9 × 10⁻¹⁹ = 288 nm, in the ultraviolet. This is the classic demonstration: a charged zinc plate on an electroscope discharges when an ultraviolet lamp shines on it but not under the brightest visible lamp, because visible photons (at most about 5 × 10⁻¹⁹ J) cannot pay the work function.

**Connecting to photoelectron spectroscopy.** PES (week 3) is the photoelectric effect applied to individual atoms with X-ray or far-UV photons: binding energy = hν − KE of the ejected electron. The same bookkeeping, now used to measure the energy of each subshell.

**Try it.** A metal has a threshold frequency of 1.0 × 10¹⁵ Hz. Find its work function and the maximum kinetic energy of electrons ejected by 250 nm light. *(φ = hν₀ = 6.6 × 10⁻¹⁹ J. 250 nm photon: 7.9 × 10⁻¹⁹ J; KE_max = 1.3 × 10⁻¹⁹ J.)*

## The Beer–Lambert law (3.13)

A coloured solution looks coloured because it absorbs part of the visible spectrum: copper(II) sulfate is blue because Cu²⁺(aq) absorbs orange and red light. A **spectrophotometer** passes light of one chosen wavelength through a sample in a transparent cell (a **cuvette**) of known path length and compares the intensity leaving, I, with the intensity entering, I₀.

The **transmittance** T = I/I₀ falls as the solution gets more concentrated, but not linearly: each thin layer of solution absorbs the same *fraction* of what reaches it, so I falls exponentially with concentration and with path length. Taking a logarithm straightens that out. The **absorbance**

A = −log(I/I₀) = log(I₀/I)

is **proportional** to concentration and path length:

A = εbc

where b is the path length in cm (usually 1.00 cm), c is the molarity, and ε is the **molar absorptivity**, a constant for the substance at the chosen wavelength (units M⁻¹cm⁻¹). A large ε means a strongly absorbing substance that can be measured at very low concentration.

**Choosing the wavelength.** Measure at the wavelength where the substance absorbs most strongly (its λ_max): the absorbance per unit concentration is largest there, so small differences in concentration give the largest change in A, and the measurement is least sensitive to small drifts in wavelength. For a blue solution that is in the orange-red (about 600–650 nm); for a red–orange solution such as [Fe(SCN)]²⁺ it is in the blue (about 450 nm).

**The calibration curve.** Rather than trusting a literature ε, you prepare a series of **standards** of known concentration (by dilution of a stock, week 10), measure the absorbance of each, and plot A against c. The points fall on a straight line through the origin with slope εb. An unknown's absorbance is then converted to concentration by reading the line (or by c = A ÷ slope). If the unknown's absorbance is above the highest standard, or above about 1.5 where the law tends to fail, dilute it by a known factor, measure, and multiply back.

**Worked example 3: a calibration.** Standards of Cu²⁺ at 0.020, 0.040, 0.060, 0.080 and 0.100 M give absorbances of 0.12, 0.24, 0.36, 0.48 and 0.60 at 635 nm in a 1.00 cm cell. The slope is 0.60 ÷ 0.100 = 6.0 M⁻¹, so ε = slope ÷ b = 6.0 M⁻¹cm⁻¹. An unknown with A = 0.45 has c = 0.45 ÷ 6.0 = 0.075 M. If that unknown had been prepared by diluting 10.0 mL of a stock to 50.0 mL, the stock is 0.075 × (50.0 ÷ 10.0) = 0.375 M.

**Worked example 4: molar absorptivity.** A 2.5 × 10⁻⁴ M solution of a dye has A = 0.75 in a 1.00 cm cell. ε = A ÷ (bc) = 0.75 ÷ (1.00 × 2.5 × 10⁻⁴) = 3.0 × 10³ M⁻¹cm⁻¹. The dye absorbs about 500 times more strongly than Cu²⁺ per mole, so it can be analysed at concentrations 500 times lower.

**Worked example 5: path length and transmittance.** The same solution measured in a 2.00 cm cell has twice the absorbance (A = 1.50) because the light passes through twice as many absorbing molecules. Its transmittance is T = 10⁻¹·⁵⁰ = 0.032, or 3.2 %T; in the 1.00 cm cell T = 10⁻⁰·⁷⁵ = 0.18, or 18 %T. Note that doubling the absorbance does not halve the transmittance.

**What the law can and cannot do.** Beer's law is linear only for dilute solutions (roughly A below about 1–1.5) and only when the absorbing species is the only thing absorbing at that wavelength. A second coloured species, a scratched or fingerprinted cuvette, or air bubbles all add absorbance that has nothing to do with concentration; a **blank** (the solvent alone in the same cuvette) is measured first and its absorbance subtracted. A colourless solution cannot be measured in the visible; a colourless analyte can sometimes be converted to a coloured complex first (Fe³⁺ with SCN⁻, for example).

**Try it.** A solution has 25 %T in a 1.00 cm cell at the wavelength of maximum absorbance. What is its absorbance, and what absorbance would the same solution show in a 0.500 cm cell? *(A = −log 0.25 = 0.602; in the half-length cell A = 0.301.)*

## Common mistakes

- Saying brighter light ejects faster electrons; intensity changes the number of electrons, frequency changes their energy.
- Adding the energy of two low-frequency photons to reach the work function; absorption is one photon per electron.
- Using KE = hν − φ with a wavelength in place of a frequency, or forgetting that the threshold is where KE = 0.
- Treating absorbance as a percentage, or transmittance as linear in concentration; A = −log T, and A is what is proportional to c.
- Measuring at a wavelength the solution transmits (its own colour) instead of the colour it absorbs.
- Reading a concentration from a calibration curve beyond its highest standard, or trusting an absorbance above about 1.5; dilute and remeasure.
- Forgetting to multiply back by the dilution factor after diluting an unknown.

## Where this goes next

Unit 3 ends here; the unit exam covers weeks 8–12. Unit 4 opens with chemical reactions: net ionic equations, stoichiometry in solution (molarity again) and titration, where a spectrophotometer or an indicator signals the end point. Unit 5 uses Beer's law to follow the concentration of a coloured reactant against time, which is how most AP kinetics data are collected. Unit 7 uses it to find equilibrium concentrations of coloured complexes.

## Self-check

1. Light of 300 nm strikes a metal whose work function is 4.0 × 10⁻¹⁹ J. Find the maximum kinetic energy of the ejected electrons and the threshold wavelength.
2. The 300 nm lamp in question 1 is replaced by a 600 nm lamp of four times the intensity. What is observed?
3. A solution of a green dye is to be analysed by spectrophotometry. Should the wavelength be set to 520 nm (green) or 650 nm (red)? Explain.
4. Standards give a calibration line A = 12.0 × c (A per molar, 1.00 cm cell). An unknown reads A = 0.36. Find its concentration, and the concentration of the original sample if the unknown was a 1 : 5 dilution of it.
5. A solution reads 40 %T. Give its absorbance, and the %T expected if its concentration is doubled.

*Answers:* (1) E_photon = 6.62 × 10⁻¹⁹ J; KE_max = 2.6 × 10⁻¹⁹ J; λ₀ = hc/φ = 497 nm. (2) Nothing: a 600 nm photon carries 3.3 × 10⁻¹⁹ J, below φ, and intensity cannot make up the deficit. (3) 650 nm; the dye transmits green, so it absorbs elsewhere, and red is where a green solution absorbs strongly, giving the greatest sensitivity. (4) c = 0.36 ÷ 12.0 = 0.030 M; original = 0.150 M. (5) A = −log 0.40 = 0.398; doubling c doubles A to 0.796, so T = 10⁻⁰·⁷⁹⁶ = 0.16, or 16 %T.

---

*Original study material written for this course and organised around the College Board AP Chemistry Course and Exam Description (topics 3.12–3.13). Constants and data are public domain, from U.S. government sources (NIST Chemistry WebBook, NIST CODATA constants, PubChem), rounded as the AP equations sheet does; h, c and N_A from NIST CODATA; work functions are approximate values rounded for teaching. Accessed 2026-10-16.*
