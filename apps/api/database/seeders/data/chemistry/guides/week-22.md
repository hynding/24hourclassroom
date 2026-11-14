# Week 22 · Colligative Properties

**Topics:** 6.3 Colligative Properties
**Practices:** 2 (Developing and Using Models), 5 (Using Mathematics and Computational Thinking), 6 (Constructing Explanations)
**Spiral:** Vapour pressure and boiling (5.6) are the starting point: a solute lowers the vapour pressure, and everything else follows. Ionic versus molecular compounds (3.1, 3.3) decides how many particles a formula unit releases. The mole (4.4) and molar mass appear in every molality calculation, and mole fraction (5.4) returns in Raoult's law.

## What you need to be able to do

- **6.3** Define a colligative property and explain why it depends on the number of dissolved particles, not their identity; calculate molality; explain vapour-pressure lowering, boiling-point elevation and freezing-point depression with a particle model; calculate ΔT_b = i·K_b·m and ΔT_f = i·K_f·m, including the van 't Hoff factor for ionic solutes; and describe osmosis qualitatively.

## Key terms

| Term | Meaning |
|---|---|
| Colligative property | A property of a solution that depends on the concentration of solute particles but not on what they are: vapour-pressure lowering, boiling-point elevation, freezing-point depression, osmotic pressure. |
| Molality (m) | Moles of solute per kilogram of solvent: m = n_solute / kg_solvent. Unlike molarity it does not change with temperature. |
| Vapour-pressure lowering | A nonvolatile solute reduces the solvent's vapour pressure in proportion to the solute's mole fraction (Raoult's law: P = X_solvent × P°). |
| Boiling-point elevation | ΔT_b = i·K_b·m; for water K_b = 0.512 °C/m. |
| Freezing-point depression | ΔT_f = i·K_f·m; for water K_f = 1.86 °C/m. |
| van 't Hoff factor (i) | The number of particles one formula unit produces in solution: 1 for sugar, 2 for NaCl, 3 for CaCl₂. |
| Nonvolatile | A solute with negligible vapour pressure of its own (salt, sugar), as assumed in these calculations. |
| Osmosis | Net flow of solvent through a semipermeable membrane from the more dilute to the more concentrated solution. |
| Osmotic pressure | The pressure needed to stop osmosis; proportional to the particle concentration. |

## Counting particles, not naming them (6.3)

Dissolve a spoonful of sugar in water and the water boils a little hotter, freezes a little colder and evaporates a little more slowly. Dissolve the same number of moles of urea instead and the changes are identical. Dissolve the same number of moles of table salt and the changes are twice as large, because each NaCl gives two ions. These are **colligative** properties, from the Latin for "bound together": they depend on how many solute particles are present per amount of solvent and on nothing else about them.

The particle model explains all of them at once. Solute particles dilute the solvent at its surface and in its bulk. Fewer solvent molecules at the surface means fewer escape into the vapour, so the vapour pressure falls. A lower vapour pressure must be pushed up to 1 atm by a higher temperature, so the boiling point rises. In the freezing solvent, solute particles get in the way of solvent molecules joining the crystal, so a lower temperature is needed before freezing wins, and the freezing point falls.

### Molality

Because these effects depend on the ratio of solute particles to solvent molecules, the natural concentration unit is per mass of **solvent**, not per volume of solution:

m = moles of solute / kilograms of solvent

A 1.00 m (one molal) sucrose solution is 1.00 mol of sucrose in 1.00 kg of water. Molality does not change when the solution warms or cools (mass is constant, volume is not), which is why it is used for temperature-based properties.

**Worked example.** What is the molality of a solution of 17.1 g of sucrose (C₁₂H₂₂O₁₁, 342.30 g/mol) in 200.0 g of water?

Moles: 17.1 ÷ 342.30 = 0.0500 mol. Kilograms of water: 0.2000 kg. m = 0.0500 / 0.2000 = **0.250 m**.

**Try it.** Molality of 5.85 g of NaCl (58.44 g/mol) in 500.0 g of water?
*Answer:* 0.100 mol / 0.5000 kg = 0.200 m (and 0.400 m in particles, since i = 2).

## Vapour-pressure lowering (6.3)

Raoult's law for a nonvolatile solute: the vapour pressure of the solvent above the solution equals its mole fraction times the pure solvent's vapour pressure:

P_solution = X_solvent × P°_solvent

**Worked example.** 1.00 mol of glucose is dissolved in 9.00 mol of water at 25 °C, where pure water's vapour pressure is 23.8 torr. Find the vapour pressure of the solution.

X_water = 9.00 / (9.00 + 1.00) = 0.900. P = 0.900 × 23.8 = **21.4 torr**, a lowering of 2.4 torr. One-tenth of the surface is now glucose, which does not evaporate, so the escape rate falls by a tenth.

## Boiling-point elevation and freezing-point depression (6.3)

For dilute solutions both changes are proportional to the molality of particles:

ΔT_b = i × K_b × m and ΔT_f = i × K_f × m

The constants belong to the solvent. For water, K_b = 0.512 °C/m and K_f = 1.86 °C/m. The new boiling point is 100.00 + ΔT_b; the new freezing point is 0.00 − ΔT_f. Note that the freezing effect is nearly four times the boiling effect for the same solution.

The **van 't Hoff factor** i counts particles per formula unit:

| Solute | Dissolves as | i (ideal) |
|---|---|---|
| sucrose, glucose, urea, ethylene glycol | intact molecules | 1 |
| NaCl, KBr, KNO₃ | 2 ions | 2 |
| CaCl₂, MgCl₂, Na₂SO₄ | 3 ions | 3 |
| AlCl₃ | 4 ions | 4 |

Real ionic solutions give slightly smaller i than the ideal value, because some ions pair up; at the level of this course use the ideal integers unless told otherwise.

**Worked example.** A solution of 62.1 g of ethylene glycol (C₂H₆O₂, 62.07 g/mol, antifreeze) in 250.0 g of water. Find its boiling and freezing points.

1. Moles: 62.1 ÷ 62.07 = 1.00 mol. Molality: 1.00 / 0.2500 = 4.00 m. i = 1 (a molecule).
2. ΔT_b = 1 × 0.512 × 4.00 = 2.05 °C → boils at **102.05 °C**.
3. ΔT_f = 1 × 1.86 × 4.00 = 7.44 °C → freezes at **−7.44 °C**.

A car's coolant is closer to 50% glycol by volume and freezes near −37 °C; the equations above become approximate at such concentrations but the direction is right.

**Worked example.** 11.1 g of CaCl₂ (110.98 g/mol) is dissolved in 100.0 g of water. Freezing point?

Moles: 11.1 ÷ 110.98 = 0.100 mol; m = 0.100 / 0.1000 = 1.00 m; i = 3. ΔT_f = 3 × 1.86 × 1.00 = 5.58 °C → **−5.58 °C**. The same molality of sugar would give only −1.86 °C, which is why calcium chloride is spread on icy roads.

**Worked example (finding a molar mass).** 2.00 g of an unknown molecular compound dissolved in 50.0 g of water lowers the freezing point by 0.620 °C. Find the molar mass.

m = ΔT_f / (i × K_f) = 0.620 / (1 × 1.86) = 0.3333 m. Moles = 0.3333 × 0.0500 kg = 0.01667 mol. M = 2.00 g / 0.01667 mol = **120 g/mol**.

**Try it.** Boiling point of 0.500 mol of KBr in 1.00 kg of water?
*Answer:* i = 2, m = 0.500; ΔT_b = 2 × 0.512 × 0.500 = 0.512 °C; boils at 100.51 °C.

### Ranking solutions

To rank by boiling point or freezing point, compare i × m. 0.10 m Na₂SO₄ (3 × 0.10 = 0.30) lowers the freezing point more than 0.20 m NaCl (0.40)? No: 0.40 > 0.30, so the NaCl solution freezes lower. Always multiply before comparing.

## Osmosis (6.3)

A semipermeable membrane lets solvent molecules pass but not solute particles. Put pure water on one side and a sugar solution on the other and water flows into the solution: more water molecules hit the membrane from the pure-water side than from the side where sugar occupies part of the surface. The flow continues until the extra height of the solution column pushes back hard enough; that pressure is the **osmotic pressure**, which is proportional to the particle concentration, like the other colligative properties.

Osmosis is why cucumber slices in salt water wilt (water leaves the cells), why salted roads kill roadside plants, and why intravenous fluids must match the particle concentration of blood (about 0.3 m in particles): pure water injected into a vein would make red blood cells swell and burst.

## Common mistakes

- Using molarity (per litre of solution) where molality (per kilogram of solvent) is needed. The two are close for dilute aqueous solutions but not the same, and the formulas are written for molality.
- Forgetting i for ionic solutes, or using i = 2 for CaCl₂ (it is 3).
- Reporting ΔT_f as the freezing point. The freezing point is 0 − ΔT_f.
- Using grams of water instead of kilograms in the molality.
- Comparing solutions by molality alone when their i values differ.
- Thinking a volatile solute (ethanol) obeys the nonvolatile version of Raoult's law; it adds its own vapour pressure.

## Where this goes next

Next week concentrates on one special solute, the hydrogen ion: acids and bases, the pH scale and K_w. Week 24 uses molarity in titrations. The idea that a property can depend only on the number of particles returns in unit 7's gas-phase equilibria and in the osmotic balance of living cells studied in biology.

## Self-check

1. Why is 0.10 m MgCl₂ a better de-icer than 0.10 m NaCl?
2. Molality of 9.00 g of glucose (180.16 g/mol) in 250.0 g of water?
3. Freezing point of a 0.750 m sucrose solution?
4. Boiling point of 0.200 m Na₂SO₄?
5. Vapour pressure at 25 °C of a solution in which the mole fraction of water is 0.950 (P° = 23.8 torr)?

*Answers:* (1) i = 3 versus 2, so 50% more particles and 50% more freezing-point depression. (2) 0.0500 mol / 0.2500 kg = 0.200 m. (3) ΔT_f = 1.86 × 0.750 = 1.40 °C; −1.40 °C. (4) i = 3; ΔT_b = 3 × 0.512 × 0.200 = 0.307 °C; 100.31 °C. (5) 0.950 × 23.8 = 22.6 torr.

---

*Original study material written for this course. Constants and data values are public domain, from U.S. government sources (NIST Chemistry WebBook, NIST CODATA constants, PubChem), rounded for classroom use.*
