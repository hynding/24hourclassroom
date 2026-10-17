# Week 09 · Gases: the Ideal Gas Law, Kinetic Molecular Theory and Real Gases

**Topics:** 3.4 Ideal Gas Law · 3.5 Kinetic Molecular Theory · 3.6 Deviation from Ideal Gas Law
**Practices:** 2 (Question and Method), 3 (Representing Data and Phenomena), 4 (Model Analysis), 5 (Mathematical Routines)
**Spiral:** Week 8's picture of a gas (particles far apart, kinetic energy dominating) is made quantitative; week 8's intermolecular forces explain where the ideal model fails. Unit 1's mole is in every gas calculation, and week 2's molar-mass skill returns as molar mass from gas density.

## What you need to be able to do

- **3.4** Use PV = nRT to relate pressure, volume, temperature and amount for a gas, and the combined form (P₁V₁/T₁ = P₂V₂/T₂) for a fixed sample; use Dalton's law of partial pressures (P_A = X_A × P_total), including gases collected over water.
- **3.5** Explain the behaviour of gases with kinetic molecular theory: particles in constant random motion, elastic collisions, negligible volume and attractions; relate temperature to average kinetic energy and molar mass to average speed; read a Maxwell–Boltzmann distribution.
- **3.6** Explain why real gases deviate from ideal behaviour at high pressure (particle volume) and low temperature (intermolecular attractions), and which gases deviate most.

## Key terms

| Term | Meaning |
|---|---|
| Ideal gas law | PV = nRT, with R = 0.08206 L·atm/(mol·K) or 8.314 J/(mol·K); T in kelvin always. |
| STP | 0 °C (273.15 K) and 1 atm; one mole of ideal gas occupies 22.4 L. |
| Pressure units | 1 atm = 760 torr (mm Hg) = 101.3 kPa. |
| Partial pressure | The pressure one gas in a mixture would exert alone; P_A = X_A × P_total (Dalton's law). |
| Mole fraction (X) | Moles of one component divided by total moles. |
| Kinetic molecular theory (KMT) | The particulate model of an ideal gas: tiny, non-attracting particles in random motion with elastic collisions. |
| Average kinetic energy | Proportional to kelvin temperature only; KE = ½mv², so lighter molecules move faster at the same T. |
| Root-mean-square speed | v_rms = √(3RT/M) with R = 8.314 J/(mol·K) and M in kg/mol. |
| Maxwell–Boltzmann distribution | The spread of molecular speeds at a given temperature; broader and shifted right at higher T or lower M. |
| Real gas | A gas whose particles have volume and attract one another; deviates from PV = nRT at high P and low T. |

## The ideal gas law (3.4)

PV = nRT links the four variables of a gas sample. Use R = 0.08206 L·atm/(mol·K) when pressure is in atm and volume in litres; convert torr or kPa to atm first. Temperature must be in kelvin: K = °C + 273.15.

**Worked example 1.** How many moles of oxygen are in a 5.00 L cylinder at 2.00 atm and 25 °C?

n = PV/RT = (2.00 atm)(5.00 L) ÷ [(0.08206)(298 K)] = 10.0 ÷ 24.45 = 0.409 mol.

**Worked example 2.** What pressure does 0.500 mol of a gas exert in a 10.0 L container at 27 °C?

P = nRT/V = (0.500)(0.08206)(300) ÷ 10.0 = 1.23 atm.

**Molar mass from density.** Since n = m/M, PV = (m/M)RT, so M = mRT/(PV) = dRT/P, where d is the density in g/L.

**Worked example 3.** A gas has a density of 1.25 g/L at STP. What is its molar mass?

M = dRT/P = (1.25)(0.08206)(273.15) ÷ 1.00 = 28.0 g/mol: nitrogen (or CO, same molar mass).

**Changing conditions for a fixed amount of gas.** With n constant, P₁V₁/T₁ = P₂V₂/T₂. Hold whichever variable is unchanged.

**Worked example 4.** A balloon holds 2.00 L at 1.00 atm and 300 K. What is its volume at 0.500 atm and 450 K?

V₂ = V₁ × (P₁/P₂) × (T₂/T₁) = 2.00 × (1.00/0.500) × (450/300) = 2.00 × 2 × 1.5 = 6.00 L. Lower pressure expands it; higher temperature expands it.

**Dalton's law.** In a mixture each gas acts as if it were alone. P_total = P_A + P_B + ..., and P_A = X_A × P_total.

**Worked example 5.** A mixture of 2.0 g of He and 8.0 g of Ar is at 1.50 atm. Find the partial pressure of helium.

n(He) = 2.0 ÷ 4.00 = 0.50 mol; n(Ar) = 8.0 ÷ 39.95 = 0.20 mol. X(He) = 0.50 ÷ 0.70 = 0.714. P(He) = 0.714 × 1.50 = 1.07 atm. Note that helium, the lighter gas, contributes most of the pressure because it has the most moles; mass is irrelevant to pressure once you have moles.

**Gas collected over water.** The gas in the collection tube is mixed with water vapour, so P_gas = P_total − P_water, where P_water is the vapour pressure of water at that temperature (a table value: 23.8 torr at 25 °C).

**Worked example 6.** Hydrogen from magnesium and hydrochloric acid is collected over water at 25 °C. The volume is 0.250 L and the total pressure is 752 torr. Find the moles of H₂ and the mass of magnesium that reacted (Mg + 2HCl → MgCl₂ + H₂).

P(H₂) = 752 − 23.8 = 728.2 torr = 0.958 atm. n = PV/RT = (0.958)(0.250) ÷ [(0.08206)(298)] = 0.2395 ÷ 24.45 = 9.80 × 10⁻³ mol H₂. One mole of Mg per mole of H₂: mass Mg = 9.80 × 10⁻³ × 24.31 = 0.238 g.

**Try it.**
1. What volume does 0.100 mol of an ideal gas occupy at 1.00 atm and 25 °C?
2. A gas sample at 740 torr and 20 °C is heated to 80 °C in a rigid container. What is the new pressure?
3. Air is 21% O₂ by moles. What is the partial pressure of O₂ when the total pressure is 760 torr?

*Answers:* (1) V = nRT/P = (0.100)(0.08206)(298) ÷ 1.00 = 2.45 L. (2) Constant V: P₂ = P₁ × T₂/T₁ = 740 × 353/293 = 892 torr. (3) 0.21 × 760 = 160 torr.

## Kinetic molecular theory (3.5)

KMT is the particulate model behind the ideal gas law. Its assumptions: gas particles are in constant, random, straight-line motion; their volume is negligible compared with the container; they neither attract nor repel one another; collisions (with each other and the walls) are elastic, so kinetic energy is conserved; and the **average kinetic energy is proportional to the kelvin temperature**.

Those assumptions explain the gas laws. Pressure is the force of wall collisions per area: more particles (n up) or a smaller container (V down) means more collisions per second, so P rises. Heating raises the average speed, so collisions are harder and more frequent: P rises at constant V, or V rises at constant P.

**Temperature and speed.** All gases at the same temperature have the same average kinetic energy, KE = ½mv². Because the KE is the same, lighter molecules must move faster: at 298 K, helium's root-mean-square speed is about 1360 m/s and nitrogen's about 515 m/s.

v_rms = √(3RT/M) with R = 8.314 J/(mol·K), T in K and M in **kg/mol**.

**Worked example 7.** Calculate v_rms for N₂ at 298 K and compare with He.

M(N₂) = 0.02802 kg/mol. v_rms = √[(3)(8.314)(298) ÷ 0.02802] = √(265,300) = 515 m/s. For He, M = 0.00400 kg/mol: √[(3)(8.314)(298) ÷ 0.00400] = √(1,858,000) = 1363 m/s. The ratio 1363 ÷ 515 = 2.65 equals √(28.02 ÷ 4.00) = 2.65: speed scales as 1/√M.

**The Maxwell–Boltzmann distribution.** A plot of the number of molecules against speed is a lopsided hump: no molecules at zero speed, a peak at the most probable speed, and a long tail at high speeds. Two rules for reading it:

- Raising the temperature flattens the curve and shifts its peak to the right: the average speed rises and the spread widens. The area under the curve (the number of molecules) stays the same.
- At the same temperature, a heavier gas has a taller, narrower curve peaked at lower speed; a lighter gas is broader and shifted right.

Graph description: three curves on the same axes (number of molecules against speed). The curve for O₂ at 300 K peaks sharply at about 390 m/s. The curve for O₂ at 1000 K is lower and broader with its peak near 720 m/s. The curve for H₂ at 300 K is the broadest of all, peaked near 1570 m/s.

The exam asks you to identify which curve is which and to explain, using KMT, how a change in temperature changes the distribution and the pressure.

**Try it.**
1. Two flasks at the same temperature hold CH₄ and CO₂. Compare the average kinetic energies and the average speeds.
2. By what factor does v_rms change when the kelvin temperature doubles?

*Answers:* (1) Equal average kinetic energies (same T); CH₄ (16 g/mol) molecules move faster than CO₂ (44 g/mol) by a factor of √(44/16) = 1.66. (2) √2 = 1.41; speed scales with √T, not T.

## Real gases (3.6)

Two KMT assumptions are approximations: particles do have volume, and they do attract (week 8). The ideal gas law works best when those two effects are negligible: **low pressure** (particles far apart, their own volume a tiny fraction of V) and **high temperature** (kinetic energy swamps attractions). Deviations appear at:

- **High pressure:** the particles' own volume is no longer negligible, so the measured volume is larger than the ideal law predicts; PV/nRT > 1.
- **Low temperature (or moderate pressure):** attractions between particles pull them toward one another and soften their wall collisions, so the pressure is lower than predicted; PV/nRT < 1. This is also the regime where gases condense.

Which gases deviate most? Those with strong intermolecular forces (polar molecules, large molecules) and large particle volumes: NH₃, H₂O vapour, CO₂, Cl₂. Those closest to ideal: He and H₂ (tiny, nonpolar, weakest dispersion forces), then Ne and N₂.

**Worked example 8.** At 200 atm and 300 K, which gas has PV/nRT closer to 1, He or CO₂? Which is more likely to have PV/nRT below 1 at 10 atm and 250 K?

At 200 atm both deviate because of particle volume, but He deviates less: its atoms are smaller and have negligible attractions. At 10 atm and 250 K, CO₂'s dispersion forces (44 g/mol, 22 electrons) pull its molecules together and reduce the pressure: PV/nRT < 1 for CO₂, while He stays near 1.

Graph description: PV/nRT plotted against pressure for several gases at 300 K. The He line stays almost flat at 1.00, rising slightly above 1 at very high pressures. The N₂ line dips a little below 1 near 100 atm and then rises above 1. The CO₂ line dips well below 1 (to about 0.8 near 100 atm) before climbing steeply above 1 at very high pressures.

**Try it.**
1. Rank He, NH₃ and CH₄ by how closely they follow the ideal gas law at 1 atm and 25 °C.
2. Explain why cooling a real gas at constant volume lowers its pressure by more than PV = nRT predicts.

*Answers:* (1) He (closest), then CH₄ (nonpolar, small), then NH₃ (hydrogen bonding, strong attractions). (2) As the molecules slow, intermolecular attractions become significant relative to kinetic energy; molecules near the walls are pulled back by their neighbours, so they strike the walls with less force than the ideal model assumes.

## Common mistakes

- Using °C in PV = nRT or in a ratio of temperatures; always convert to kelvin.
- Mixing units: torr with R = 0.08206, or litres with mL.
- Using g/mol in v_rms = √(3RT/M); M must be in kg/mol with R = 8.314.
- Assuming that heavier gas molecules have more kinetic energy at the same temperature; they have the same KE and lower speed.
- Subtracting the vapour pressure of water in the wrong unit, or forgetting to subtract it at all when a gas is collected over water.
- Saying real gases deviate at high temperature; it is low temperature (attractions) and high pressure (volume).

## Where this goes next

Week 10 treats solutions, where molarity plays the role that n/V plays for gases. Unit 4 uses PV = nRT in gas stoichiometry (volumes of gas produced or consumed). Unit 5 uses the Maxwell–Boltzmann distribution to explain why reaction rates rise with temperature, and Unit 7 uses partial pressures in equilibrium constants (Kp).

## Self-check

1. A 1.50 L container holds 0.0600 mol of gas at 310 K. Find the pressure in atm and in torr.
2. A gas has a density of 1.96 g/L at 1.00 atm and 273 K. Identify it from its molar mass.
3. A mixture contains 0.30 mol N₂ and 0.10 mol O₂ at a total pressure of 2.0 atm. Find each partial pressure.
4. Using KMT, explain why the pressure of a gas rises when it is heated in a rigid container.
5. State the two conditions under which real gases behave most ideally and explain each.

*Answers:* (1) P = (0.0600)(0.08206)(310) ÷ 1.50 = 1.02 atm = 773 torr. (2) M = dRT/P = (1.96)(0.08206)(273) ÷ 1.00 = 43.9 g/mol: CO₂. (3) X(N₂) = 0.75, P(N₂) = 1.5 atm; X(O₂) = 0.25, P(O₂) = 0.50 atm. (4) Higher temperature means higher average kinetic energy and speed; molecules hit the walls harder and more often, and pressure is force per area from those collisions. (5) Low pressure, so the particles' own volume is negligible compared with the container; high temperature, so kinetic energy overwhelms the intermolecular attractions.

---

*Original study material written for this course and organised around the College Board AP Chemistry Course and Exam Description (topics 3.4–3.6). Constants and data are public domain, from U.S. government sources (NIST Chemistry WebBook, NIST CODATA constants, PubChem), rounded as the AP equations sheet does. Accessed 2026-10-16.*
