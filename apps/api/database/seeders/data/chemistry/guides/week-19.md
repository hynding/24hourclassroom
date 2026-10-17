# Week 19 · Gas Stoichiometry and Dalton's Law of Partial Pressures

**Topics:** 5.4 Gas Stoichiometry and Dalton's Law of Partial Pressures
**Practices:** 3 (Planning and Carrying Out Investigations), 5 (Using Mathematics and Computational Thinking), 6 (Constructing Explanations)
**Spiral:** This week is unit 4 stoichiometry (4.6, 4.7) with litres of gas replacing grams, so the mole-ratio method from weeks 14 and 15 must be fluent. The ideal gas law and molar volume (5.3) convert gas volumes to moles. Balancing equations (4.1) and limiting reactants (4.7) appear again, and the mole fraction introduced for Dalton's law is a first look at the composition ideas of unit 6.

## What you need to be able to do

- **5.4** Use a balanced equation to relate volumes of gases at the same temperature and pressure (volume ratios equal mole ratios); convert between the mass of a solid or liquid reactant and the volume of a gaseous product at STP or at any conditions through PV = nRT; state Dalton's law of partial pressures and use it with mole fractions; and correct the pressure of a gas collected over water for the vapour pressure of water.

## Key terms

| Term | Meaning |
|---|---|
| Gas stoichiometry | Stoichiometry in which at least one quantity is a gas volume; litres are converted to moles with 22.4 L/mol at STP or with PV = nRT otherwise. |
| Law of combining volumes | At the same T and P, gases react in volume ratios that are small whole numbers, equal to the coefficients in the balanced equation (Gay-Lussac, 1808). |
| Partial pressure | The pressure one gas in a mixture would exert if it alone occupied the container at the same temperature. |
| Dalton's law | The total pressure of a gas mixture is the sum of the partial pressures: P_total = P₁ + P₂ + P₃ + … |
| Mole fraction (X) | The moles of one component divided by the total moles; P₁ = X₁ × P_total. |
| Collecting over water | Trapping a gas by bubbling it into an inverted, water-filled container; the trapped gas is mixed with water vapour. |
| Vapour pressure of water | The partial pressure of water vapour above liquid water, which depends only on temperature (23.8 torr at 25 °C, 17.5 torr at 20 °C). |

## Volumes react in whole-number ratios (5.4)

In 1808 Joseph Gay-Lussac measured that two volumes of hydrogen combine with one volume of oxygen to make two volumes of water vapour, all at the same temperature and pressure. Avogadro's law explains the pattern: equal volumes hold equal numbers of molecules, so volume ratios are mole ratios, and mole ratios are the coefficients of the balanced equation:

2 H₂(g) + O₂(g) → 2 H₂O(g)
2 L + 1 L → 2 L

This gives a shortcut whenever every quantity in a problem is a gas at the same conditions: skip the moles entirely and use the coefficients as a litre ratio.

**Worked example.** What volume of oxygen is needed to burn 15.0 L of propane completely, and what volume of carbon dioxide forms, all measured at the same temperature and pressure?

C₃H₈(g) + 5 O₂(g) → 3 CO₂(g) + 4 H₂O(g)

Oxygen: 15.0 L C₃H₈ × (5 L O₂ / 1 L C₃H₈) = **75.0 L O₂**.
Carbon dioxide: 15.0 L × (3/1) = **45.0 L CO₂**.

The shortcut fails the moment a solid or liquid enters, or the gases are at different conditions, because the coefficients then relate moles, not litres. Then you go through moles.

**Try it.** How many litres of ammonia form from 6.0 L of nitrogen reacting with excess hydrogen at the same conditions? (N₂ + 3 H₂ → 2 NH₃)
*Answer:* 6.0 L × (2/1) = 12 L NH₃.

## Mass to gas volume: through the mole (5.4)

The general route is the unit 4 map with one extra conversion at the gas end:

grams of A → moles of A → (mole ratio) → moles of B → litres of B

For the last step use 22.4 L/mol if the gas is at STP, or V = nRT/P at any other conditions.

**Worked example.** Zinc reacts with hydrochloric acid. What volume of hydrogen, at STP, is produced from 3.27 g of zinc?

Zn(s) + 2 HCl(aq) → ZnCl₂(aq) + H₂(g)

1. Moles of Zn: 3.27 g ÷ 65.38 g/mol = 0.0500 mol.
2. Mole ratio: 1 mol H₂ per 1 mol Zn, so 0.0500 mol H₂.
3. Volume at STP: 0.0500 mol × 22.4 L/mol = **1.12 L**.

**Worked example.** The same reaction is run in a lab at 22 °C and 0.980 atm. What volume of hydrogen is collected?

Steps 1 and 2 are unchanged: 0.0500 mol H₂.
V = nRT/P = (0.0500 mol × 0.08206 L·atm/(mol·K) × 295 K)/0.980 atm = 1.210/0.980 = **1.23 L**.

Warmer than STP and slightly below 1 atm, so the volume is larger than the STP value: a sensible check.

**Worked example (gas to mass).** What mass of sodium azide, NaN₃, must decompose to fill a 65.0 L air bag with nitrogen at 1.10 atm and 300 K?

2 NaN₃(s) → 2 Na(s) + 3 N₂(g)

1. Moles of N₂: n = PV/(RT) = (1.10 × 65.0)/(0.08206 × 300) = 71.5/24.62 = 2.904 mol.
2. Mole ratio: 2 mol NaN₃ per 3 mol N₂: 2.904 × (2/3) = 1.936 mol NaN₃.
3. Mass: 1.936 mol × 65.02 g/mol = **126 g** of NaN₃.

**Try it.** What volume of CO₂ at STP forms when 10.0 g of calcium carbonate decomposes? (CaCO₃ → CaO + CO₂; M of CaCO₃ = 100.09 g/mol)
*Answer:* 10.0/100.09 = 0.0999 mol CaCO₃ → 0.0999 mol CO₂ → 0.0999 × 22.4 = 2.24 L.

### Limiting reactant with gases

Nothing changes: convert every reactant to moles, divide each by its coefficient, and the smallest quotient marks the limiting reactant. If both reactants are gases at the same conditions, you may compare litres divided by coefficients instead.

**Worked example.** 10.0 L of H₂ and 10.0 L of O₂ at the same conditions react to form water vapour. Which is limiting, and what volume of water vapour forms?

H₂: 10.0/2 = 5.0; O₂: 10.0/1 = 10.0. Hydrogen is limiting. Water: 10.0 L H₂ × (2/2) = **10.0 L H₂O(g)**, leaving 5.0 L of O₂ unreacted.

## Dalton's law of partial pressures (5.4)

In a mixture of gases that do not react, each gas behaves as if the others were not there (KMT: no attractions, negligible volume). John Dalton (1801) stated the consequence: the total pressure is the sum of the pressures each gas would exert alone, its **partial pressure**.

P_total = P_A + P_B + P_C + …

Because each partial pressure comes from PV = nRT with the same V and T, partial pressure is proportional to moles. The fraction of the total pressure contributed by gas A equals its **mole fraction**:

X_A = n_A / n_total and P_A = X_A × P_total

Air at 1.00 atm is about 78% N₂, 21% O₂ and 1% Ar by moles, so the partial pressure of oxygen is 0.21 atm, which is the number that matters to your lungs. At the summit of Everest the total pressure is about 0.33 atm, so the oxygen partial pressure is only 0.069 atm, a third of sea level, even though the air is still 21% oxygen.

**Worked example.** A 10.0 L tank at 25 °C holds 2.00 mol of He and 0.500 mol of O₂. Find each partial pressure and the total pressure.

P_He = nRT/V = (2.00 × 0.08206 × 298)/10.0 = 4.89 atm.
P_O₂ = (0.500 × 0.08206 × 298)/10.0 = 1.22 atm.
P_total = 4.89 + 1.22 = **6.11 atm**.
Check with mole fractions: X_O₂ = 0.500/2.500 = 0.200, and 0.200 × 6.11 = 1.22 atm.

**Try it.** A mixture at 760 torr is 40.0% CO₂ by moles. What is the partial pressure of CO₂?
*Answer:* 0.400 × 760 = 304 torr.

## Collecting a gas over water (5.4)

The classic school method for catching hydrogen or oxygen is to bubble it into an upturned bottle full of water. The gas that gathers at the top is not pure: water evaporates into it until the water vapour reaches its **vapour pressure**, a value that depends only on the temperature. Dalton's law then says

P_total = P_gas + P_water

The total pressure inside the bottle equals the atmospheric pressure (once the water levels inside and outside are matched), so

P_gas = P_atm − P_water

Selected vapour pressures of water, from NIST data rounded for classroom use:

| Temperature (°C) | Vapour pressure (torr) |
|---|---|
| 15 | 12.8 |
| 20 | 17.5 |
| 22 | 19.8 |
| 25 | 23.8 |
| 30 | 31.8 |

**Worked example.** 250 mL of oxygen is collected over water at 25 °C when the barometer reads 752 torr. How many moles of O₂ were collected?

1. Correct the pressure: P_O₂ = 752 − 23.8 = 728 torr = 728/760 = 0.958 atm.
2. n = PV/(RT) = (0.958 atm × 0.250 L)/(0.08206 × 298 K) = 0.2395/24.45 = **9.79 × 10⁻³ mol**.

Skipping the correction would overstate the moles by about 3%, which is bigger than the precision of a typical measurement, so the correction is not optional.

**Try it.** Hydrogen is collected over water at 20 °C at a total pressure of 745 torr. What is the partial pressure of the hydrogen, in atm?
*Answer:* 745 − 17.5 = 727.5 torr; 727.5/760 = 0.957 atm.

## Common mistakes

- Using litre ratios when one substance is a solid or liquid. The coefficients are mole ratios; litres equal moles only for gases at the same T and P.
- Using 22.4 L/mol at any conditions other than STP. At room temperature a mole of gas is about 24.5 L.
- Forgetting to subtract the vapour pressure of water for a gas collected over water, or subtracting it in the wrong unit (torr from atm).
- Adding mole fractions that do not sum to 1, or computing a mole fraction with grams instead of moles.
- Treating partial pressure as a property of the gas alone. It depends on the moles of that gas, the volume and the temperature, not on what the other gases are.

## Where this goes next

Next week the vapour pressure of water becomes the centre of attention: why it rises with temperature, why boiling happens when it equals the outside pressure, and how heating curves and phase diagrams map the changes between solid, liquid and gas. Unit 6 uses mole fraction again in colligative properties, and unit 7 uses gas-volume stoichiometry in calorimetry and in equilibrium problems. The over-water correction is the kind of real-lab detail that returns in every gas-collection experiment you do.

## Self-check

1. What volume of O₂ reacts with 8.0 L of CO to form CO₂, all at the same conditions? (2 CO + O₂ → 2 CO₂)
2. What volume of H₂ at STP forms from 0.150 mol of Mg reacting with excess acid? (Mg + 2 HCl → MgCl₂ + H₂)
3. A mixture holds 1.0 mol N₂ and 3.0 mol H₂ at a total pressure of 8.0 atm. Partial pressure of H₂?
4. Oxygen is collected over water at 30 °C and 770 torr total. Partial pressure of O₂?
5. 4.0 L of N₂ and 9.0 L of H₂ react at the same conditions. Which is limiting, and what volume of NH₃ forms?

*Answers:* (1) 4.0 L. (2) 0.150 × 22.4 = 3.36 L. (3) X = 3.0/4.0 = 0.75; 0.75 × 8.0 = 6.0 atm. (4) 770 − 31.8 = 738 torr. (5) N₂: 4.0/1 = 4.0; H₂: 9.0/3 = 3.0, so H₂ is limiting; 9.0 × (2/3) = 6.0 L NH₃.

---

*Original study material written for this course. Constants and data values are public domain, from U.S. government sources (NIST Chemistry WebBook, NIST CODATA constants, PubChem), rounded for classroom use.*
