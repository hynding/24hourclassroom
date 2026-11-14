# Week 18 · The Combined and Ideal Gas Laws

**Topics:** 5.3 The Combined and Ideal Gas Laws
**Practices:** 2 (Developing and Using Models), 5 (Using Mathematics and Computational Thinking), 6 (Constructing Explanations)
**Spiral:** Last week's three laws (5.2) and the kelvin scale (1.6) are the raw material for the combined law. The ideal gas law adds the mole (4.4) and molar mass, so the mole–mass conversions from unit 4 come back in every density and molar-mass problem. Significant figures (1.4) matter more than ever because R has four of them.

## What you need to be able to do

- **5.3** Combine Boyle's, Charles's and Gay-Lussac's laws into the combined gas law P₁V₁/T₁ = P₂V₂/T₂ and use it when two of P, V and T change at once; state Avogadro's law and the molar volume of a gas at STP (22.4 L/mol); use the ideal gas law PV = nRT to find any one of P, V, n or T, choosing the value of R that matches the pressure unit; and rearrange it to find the density or the molar mass of a gas.

## Key terms

| Term | Meaning |
|---|---|
| Combined gas law | P₁V₁/T₁ = P₂V₂/T₂ for a fixed amount of gas; any of the three two-variable laws is a special case of it. |
| Avogadro's law | At the same temperature and pressure, equal volumes of gases contain equal numbers of particles: V is proportional to n. |
| Molar volume | The volume of one mole of an ideal gas: 22.4 L at STP (0 °C, 1 atm). |
| Ideal gas law | PV = nRT, linking pressure, volume, amount in moles and kelvin temperature with the gas constant R. |
| Gas constant, R | 0.08206 L·atm/(mol·K) when P is in atm and V in L; 8.314 J/(mol·K) = 8.314 L·kPa/(mol·K) when P is in kPa. |
| Ideal gas | A hypothetical gas that obeys PV = nRT exactly at every pressure and temperature; real gases come close when hot and dilute. |
| Gas density | Mass per litre; from the ideal gas law, d = PM/(RT), where M is the molar mass. |
| Molar mass from gas data | M = mRT/(PV) or M = dRT/P: weigh a known volume of gas at known P and T and solve. |

## One law instead of three (5.3)

Boyle's law says PV is constant; Charles's law says V/T is constant; Gay-Lussac's law says P/T is constant. They are three views of a single fact: for a fixed amount of gas, the quantity PV/T never changes. Writing it for two states gives the **combined gas law**:

P₁V₁/T₁ = P₂V₂/T₂

Cross out whichever variable did not change and you recover last week's law. If T₁ = T₂ they cancel and you have P₁V₁ = P₂V₂. If P is constant you have V₁/T₁ = V₂/T₂. The combined law earns its keep when two things change at once: a weather balloon that rises into colder, thinner air, or a gas sample moved from a warm lab at one pressure to a cold room at another.

**Worked example.** A weather balloon is filled with 5.00 × 10² L of helium at 22 °C and 755 torr. At altitude the pressure is 320 torr and the temperature is −35 °C. What is the balloon's volume there?

1. Temperatures to kelvin: T₁ = 295 K, T₂ = 238 K.
2. Solve for V₂: V₂ = P₁V₁T₂ / (P₂T₁).
3. V₂ = (755 torr × 500 L × 238 K) / (320 torr × 295 K) = (8.985 × 10⁷) / (9.44 × 10⁴) = **952 L**.

The pressure drop more than doubles the volume (755/320 = 2.36×) while the cooling shrinks it a little (238/295 = 0.81×); the net factor is 1.90. Checking the direction of each effect before you compute is the best protection against an inverted ratio.

**Try it.** A 2.00 L sample at 1.00 atm and 300 K is compressed to 0.500 L and warmed to 450 K. Find the pressure.
*Answer:* P₂ = P₁V₁T₂/(V₂T₁) = (1.00 × 2.00 × 450)/(0.500 × 300) = 900/150 = 6.00 atm. Compression alone would quadruple the pressure; heating adds another factor of 1.5.

## Avogadro's law and the molar volume (5.3)

Amedeo Avogadro proposed in 1811 that equal volumes of any gases, at the same temperature and pressure, contain equal numbers of molecules. Kinetic molecular theory explains why: pressure depends on how many particles there are and how fast they move, not on what they are. If particles have no volume and no attractions, one mole of helium takes up the same room as one mole of carbon dioxide.

At STP that volume is **22.4 L per mole**. The number is worth memorising because it converts between litres and moles in one step, which makes gas stoichiometry (next week) as easy as mass stoichiometry:

- 11.2 L of any gas at STP is 0.500 mol.
- 1.00 mol of O₂ at STP has a mass of 32.00 g and a volume of 22.4 L, so its density is 32.00/22.4 = 1.43 g/L.

Avogadro's law also says that V is proportional to n at fixed T and P: double the moles, double the volume. Blowing more air into a balloon makes it bigger for exactly this reason.

**Try it.** What volume does 0.250 mol of nitrogen occupy at STP? What is the mass of 5.60 L of argon (39.95 g/mol) at STP?
*Answers:* 0.250 × 22.4 = 5.60 L. 5.60/22.4 = 0.250 mol; 0.250 × 39.95 = 9.99 g.

## The ideal gas law (5.3)

Put the four proportionalities together (V ∝ 1/P, V ∝ T, V ∝ n) and insert a constant:

PV = nRT

The constant R is fixed by measurement: one mole of an ideal gas at 273.15 K and 1 atm occupies 22.414 L, so R = PV/(nT) = (1 atm × 22.414 L)/(1 mol × 273.15 K) = **0.08206 L·atm/(mol·K)**. In SI units the same constant is **8.314 J/(mol·K)**, which also reads as 8.314 L·kPa/(mol·K) because 1 L·kPa = 1 J. Pick the R that matches the pressure unit in the problem:

| Pressure unit | Volume unit | R |
|---|---|---|
| atm | L | 0.08206 L·atm/(mol·K) |
| kPa | L | 8.314 L·kPa/(mol·K) |
| torr | L | convert torr to atm first (÷ 760), then use 0.08206 |

The ideal gas law differs from the combined gas law in one crucial way: it describes a single state, not a change. When a problem gives three of P, V, n and T for one sample and asks for the fourth, use PV = nRT. When a problem describes a before and an after for the same sample, use the combined law.

**Worked example.** How many moles of oxygen are in a 12.0 L cylinder at 25 °C and 150 atm?

n = PV/(RT) = (150 atm × 12.0 L) / (0.08206 L·atm/(mol·K) × 298 K) = 1,800 / 24.45 = **73.6 mol**.

That is 73.6 × 32.00 = 2,355 g, about 2.4 kg of oxygen in a cylinder you could carry: pressure packs a lot of gas into a small space.

**Worked example.** What pressure, in kPa, does 0.750 mol of helium exert in a 10.0 L flask at 40 °C?

P = nRT/V = (0.750 mol × 8.314 L·kPa/(mol·K) × 313 K) / 10.0 L = 1,951.7 / 10.0 = **195 kPa**.

Using 0.08206 instead would give 1.93 atm, the same pressure in a different unit; the mistake to avoid is using 8.314 and reporting the answer as atm.

**Try it.** What volume does 2.00 mol of CO₂ occupy at 1.50 atm and 50 °C?
*Answer:* V = nRT/P = (2.00 × 0.08206 × 323)/1.50 = 53.01/1.50 = 35.3 L.

## Density and molar mass from the ideal gas law (5.3)

Replace n with m/M (mass over molar mass) and rearrange:

PV = (m/M)RT → M = mRT/(PV)

Since density d = m/V, the same equation reads

d = PM/(RT) or M = dRT/P

These two lines let you identify an unknown gas from a weighing. They also explain everyday facts: a gas is denser when cold or compressed (d rises with P and falls with T), and heavier molecules make denser gases at the same conditions (d rises with M). Hot-air balloons fly because warm air inside is less dense than cool air outside; helium balloons fly because 4.00 g/mol is far less than air's average of about 29 g/mol.

**Worked example.** A 0.500 L flask holds 0.918 g of an unknown gas at 100 °C and 1.00 atm. Find its molar mass and identify the gas.

M = mRT/(PV) = (0.918 g × 0.08206 L·atm/(mol·K) × 373 K) / (1.00 atm × 0.500 L) = 28.10 / 0.500 = **56.2 g/mol**.

Butene, C₄H₈, has a molar mass of 4(12.01) + 8(1.008) = 56.10 g/mol, so the gas is consistent with butene (and this is close to the way molar masses were first measured for volatile compounds).

**Worked example.** What is the density of nitrogen (28.02 g/mol) at 20 °C and 0.950 atm?

d = PM/(RT) = (0.950 × 28.02) / (0.08206 × 293) = 26.62 / 24.04 = **1.11 g/L**.

**Try it.** A gas has a density of 1.96 g/L at STP. What is its molar mass?
*Answer:* M = dRT/P = (1.96 × 0.08206 × 273.15)/1.00 = 43.9 g/mol, or simply 1.96 g/L × 22.4 L/mol = 43.9 g/mol: carbon dioxide (44.01).

## Common mistakes

- Using the ideal gas law for a before-and-after change. If a sample is heated or compressed and you want its new state, the amount of gas has not changed and the combined gas law is the direct route; using PV = nRT twice works but doubles the arithmetic and the chances of a slip.
- Mismatched R. With atm use 0.08206; with kPa use 8.314. With torr, convert to atm first. The unit of the answer must come out of the units of R.
- Celsius in any gas law. The T in PV = nRT is kelvin without exception.
- Dropping the volume conversion: 250 mL is 0.250 L. Both R values use litres.
- Using 22.4 L/mol away from STP. At 25 °C and 1 atm a mole of gas occupies 24.5 L; at any non-STP condition use PV = nRT instead.
- Rounding R or intermediate results too early. Keep four significant figures in R and at least one extra digit in every intermediate step.

## Where this goes next

Next week the ideal gas law meets stoichiometry: the volume of hydrogen produced by a reaction, the mass of oxygen needed to burn a volume of propane, and Dalton's law for mixtures and gases collected over water. In unit 7 the gas constant reappears in energy units (8.314 J/(mol·K)) when heat and temperature changes are linked to kinetic energy. The habit of writing PV = nRT, listing the known values with units, and solving for the one unknown before substituting carries through chemistry and into physics.

## Self-check

1. A gas at 2.00 atm, 4.00 L and 300 K is changed to 1.00 atm and 600 K. What is its volume?
2. How many moles of gas are in 44.8 L at STP?
3. What pressure, in atm, does 0.500 mol of gas exert in a 5.00 L container at 27 °C?
4. What is the density of helium (4.00 g/mol) at 1.00 atm and 25 °C?
5. A gas has a density of 2.86 g/L at 1.00 atm and 25 °C. Find its molar mass.

*Answers:* (1) V₂ = (2.00 × 4.00 × 600)/(1.00 × 300) = 16.0 L. (2) 44.8/22.4 = 2.00 mol. (3) P = (0.500 × 0.08206 × 300)/5.00 = 2.46 atm. (4) d = (1.00 × 4.00)/(0.08206 × 298) = 0.164 g/L. (5) M = (2.86 × 0.08206 × 298)/1.00 = 69.9 g/mol.

---

*Original study material written for this course. Constants and data values are public domain, from U.S. government sources (NIST Chemistry WebBook, NIST CODATA constants, PubChem), rounded for classroom use.*
