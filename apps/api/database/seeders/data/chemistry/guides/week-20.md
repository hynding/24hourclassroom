# Week 20 · Phase Changes, Heating Curves and Phase Diagrams

**Topics:** 5.5 Phase Changes and Heating Curves · 5.6 Phase Diagrams and Vapor Pressure
**Practices:** 2 (Developing and Using Models), 4 (Analyzing and Interpreting Data), 5 (Using Mathematics and Computational Thinking)
**Spiral:** The states of matter and the difference between heat and temperature come from week 3 (1.6). Intermolecular forces from week 10 (3.6) decide how much energy a phase change costs and how high a vapour pressure is. The vapour pressure of water you subtracted last week (5.4) is now explained. Molar mass (4.4) converts between J/g and kJ/mol values.

## What you need to be able to do

- **5.5** Name the six phase changes and say which absorb and which release energy; read a heating curve, explaining why the temperature is flat during a phase change and why the sloped segments have different steepness; and calculate the heat for each segment with q = mcΔT, q = m × ΔH_fus and q = m × ΔH_vap, then add them.
- **5.6** Explain vapour pressure with kinetic molecular theory, describe how it changes with temperature and with intermolecular forces, and define boiling as the point where vapour pressure equals external pressure; read a phase diagram, naming the regions, the lines, the triple point and the critical point, and predict the phase or phase change for a given path.

## Key terms

| Term | Meaning |
|---|---|
| Melting / freezing | Solid ⇌ liquid at the melting point; melting absorbs the heat of fusion, freezing releases it. |
| Vaporisation / condensation | Liquid ⇌ gas; vaporisation absorbs the heat of vaporisation, condensation releases it. Evaporation is vaporisation from the surface below the boiling point. |
| Sublimation / deposition | Solid ⇌ gas directly, skipping the liquid. Dry ice sublimes; frost is deposition. |
| Heat of fusion (ΔH_fus) | Energy to melt a given amount at its melting point. Water: 334 J/g = 6.01 kJ/mol. |
| Heat of vaporisation (ΔH_vap) | Energy to vaporise a given amount at its boiling point. Water: 2,260 J/g = 40.7 kJ/mol. |
| Specific heat (c) | Energy to warm 1 g by 1 °C. Ice 2.09 J/(g·°C); liquid water 4.184 J/(g·°C); steam 2.01 J/(g·°C). |
| Heating curve | Temperature against heat added at constant pressure: sloped segments (one phase warming) and flat plateaus (phase change). |
| Vapour pressure | The pressure of a vapour in equilibrium with its liquid (or solid) in a closed container at a given temperature. |
| Boiling point | The temperature at which vapour pressure equals the external pressure; the normal boiling point is at 1 atm. |
| Phase diagram | A map of the stable phase at every pressure and temperature, with lines where two phases coexist. |
| Triple point | The one pressure and temperature at which solid, liquid and gas coexist. Water: 0.01 °C, 0.006 atm. |
| Critical point | The end of the liquid–gas line; above its temperature and pressure the liquid and gas are indistinguishable (a supercritical fluid). Water: 374 °C, 218 atm. |

## Phase changes and energy (5.5)

Every phase change is a tug of war between kinetic energy, which scatters particles, and intermolecular forces, which hold them together. Going from solid to liquid to gas means pulling particles apart against those forces, so each of those changes **absorbs** energy (endothermic). The reverse changes, gas to liquid to solid, let the forces pull particles together and **release** the same energy (exothermic).

| Change | From → to | Energy | Everyday example |
|---|---|---|---|
| Melting | solid → liquid | absorbed | ice in a drink |
| Freezing | liquid → solid | released | ice cubes forming |
| Vaporisation | liquid → gas | absorbed | sweat cooling the skin |
| Condensation | gas → liquid | released | dew; a steam burn |
| Sublimation | solid → gas | absorbed | dry ice "smoke" |
| Deposition | gas → solid | released | frost on a window |

The energy absorbed during a phase change does not raise the temperature. It goes into breaking the arrangement of particles (potential energy), not into making them move faster (kinetic energy). That is why a glass of ice water stays at 0 °C until the last ice melts, and why a steam burn is worse than a hot-water burn: steam at 100 °C releases 2,260 J per gram as it condenses on the skin before it even starts to cool.

Water's heat of vaporisation is nearly seven times its heat of fusion because melting only loosens the hydrogen-bonded network while vaporisation breaks it completely. Substances with weaker intermolecular forces have smaller values: ethanol's ΔH_vap is 841 J/g, less than half of water's.

## Reading and calculating a heating curve (5.5)

Heat ice steadily from −20 °C to steam at 120 °C at 1 atm and plot temperature against heat added. The curve has five segments:

1. **Ice warms** from −20 °C to 0 °C: a slope, with q = m × 2.09 × ΔT.
2. **Ice melts** at 0 °C: a plateau, with q = m × 334 J/g.
3. **Water warms** from 0 °C to 100 °C: a slope, with q = m × 4.184 × ΔT.
4. **Water boils** at 100 °C: a long plateau, with q = m × 2,260 J/g.
5. **Steam warms** from 100 °C to 120 °C: a slope, with q = m × 2.01 × ΔT.

Two features carry the meaning. The **plateaus** are flat because all the energy goes into the phase change; the boiling plateau is about 6.8 times longer than the melting one because ΔH_vap is that much larger. The **slopes** differ because the specific heats differ: liquid water has the largest c, so its segment is the least steep (more heat per degree), while ice and steam warm about twice as fast per joule.

**Worked example.** How much heat is needed to convert 25.0 g of ice at −10.0 °C into steam at 100.0 °C?

1. Warm ice: q₁ = 25.0 g × 2.09 J/(g·°C) × 10.0 °C = 522.5 J.
2. Melt: q₂ = 25.0 g × 334 J/g = 8,350 J.
3. Warm water: q₃ = 25.0 g × 4.184 J/(g·°C) × 100.0 °C = 10,460 J.
4. Boil: q₄ = 25.0 g × 2,260 J/g = 56,500 J.
5. Total: 522.5 + 8,350 + 10,460 + 56,500 = 75,832 J = **75.8 kJ**.

Boiling alone is three-quarters of the total. Any question that asks "which step takes the most energy" for water is answered by ΔH_vap.

**Worked example (cooling).** How much heat is released when 50.0 g of water at 20.0 °C freezes to ice at 0 °C?

q = (50.0 × 4.184 × 20.0) + (50.0 × 334) = 4,184 + 16,700 = 20,884 J, or **20.9 kJ released**. For a cooling process q is negative from the water's point of view: q = −20.9 kJ.

**Try it.** Heat needed to melt 12.0 g of ice at 0 °C and warm the water to 25.0 °C?
*Answer:* 12.0 × 334 = 4,008 J; 12.0 × 4.184 × 25.0 = 1,255 J; total 5,263 J = 5.26 kJ.

## Vapour pressure (5.6)

Seal some water in a flask with air space above it. Molecules at the surface with above-average kinetic energy escape into the vapour; as the vapour builds up, some molecules return. When the rates of escape and return are equal, the vapour's pressure stops changing. That steady value is the **vapour pressure**, a property of the liquid at that temperature.

Two things set it:

- **Temperature.** Warmer liquid, more high-energy molecules, higher vapour pressure. The rise is steep, not linear: water's vapour pressure goes 17.5 torr (20 °C), 55.3 torr (40 °C), 149 torr (60 °C), 355 torr (80 °C), 760 torr (100 °C).
- **Intermolecular forces.** Stronger attractions hold molecules in the liquid, giving a lower vapour pressure at any temperature. At 25 °C diethyl ether (dispersion and weak dipole forces) has a vapour pressure of about 530 torr, ethanol (hydrogen bonding, one O–H) about 59 torr, and water (two O–H bonds per molecule) 23.8 torr.

A liquid **boils** when its vapour pressure equals the pressure pushing on its surface: bubbles of vapour can then form inside the liquid, not just at the top. The **normal boiling point** is the temperature at which the vapour pressure reaches 1 atm (760 torr). Lower the external pressure and the liquid boils cooler: on a mountain at 0.70 atm water boils near 90 °C, which is why cooking takes longer there. Raise it, as a pressure cooker does to about 2 atm, and water stays liquid to about 120 °C.

**Try it.** Ethanol's vapour pressure reaches 760 torr at 78 °C. What is its normal boiling point? Would it boil higher or lower on a mountain?
*Answer:* 78 °C; lower, because less external pressure has to be matched.

## Phase diagrams (5.6)

A phase diagram plots pressure (vertical) against temperature (horizontal) and divides the plane into three regions: solid at low temperature and high pressure, gas at high temperature and low pressure, and liquid between them. The lines separating the regions mark conditions where two phases coexist:

- the **solid–liquid line** (melting), nearly vertical;
- the **liquid–gas line** (vapour pressure curve), ending at the critical point;
- the **solid–gas line** (sublimation), at low pressure.

The three lines meet at the **triple point**, where all three phases coexist. For water it is 0.01 °C and 0.006 atm (611 Pa); for carbon dioxide it is −56.6 °C and 5.11 atm. Because CO₂'s triple point lies above 1 atm, solid CO₂ at ordinary pressure cannot melt; it sublimes at −78.5 °C, which is what makes dry ice "dry". Liquid CO₂ exists only above 5.11 atm, inside a fire extinguisher for example.

Water's diagram has a famous oddity: its solid–liquid line leans slightly to the **left** (melting point falls as pressure rises), because ice is less dense than liquid water. Squeeze ice and it melts; that is also why ice floats. Almost every other substance, CO₂ included, has a line leaning right.

To predict what happens along a path, trace it. Heating at 1 atm across water's diagram crosses the solid–liquid line at 0 °C and the liquid–gas line at 100 °C: the heating curve above. Heating CO₂ at 1 atm crosses only the solid–gas line: sublimation. Compressing water vapour at 50 °C moves straight up until it hits the liquid–gas line (at 92.5 torr) and condenses. Reducing the pressure on liquid water at 25 °C makes it boil when the pressure falls to 23.8 torr, which is how a vacuum pump can boil water at room temperature.

The **critical point** closes off the liquid region. Above 374 °C no pressure can liquefy water; the dense fluid there is neither liquid nor gas. Supercritical CO₂ (above 31 °C and 73 atm) is used to decaffeinate coffee because it dissolves caffeine like a liquid and then simply evaporates away when the pressure is released.

## Common mistakes

- Using q = mcΔT across a phase change. ΔT is zero on a plateau; the heat there is m × ΔH, with no temperature term.
- Mixing units: ΔH_fus of water is 334 J/g or 6.01 kJ/mol. Match the value to the mass unit you have, and convert J to kJ at the end.
- Using 4.184 for ice or steam. Each phase has its own specific heat.
- Saying boiling point "is 100 °C". It is 100 °C only at 1 atm; the boiling point is wherever vapour pressure meets external pressure.
- Confusing evaporation (surface, any temperature) with boiling (throughout, vapour pressure = external pressure).
- Reading the phase diagram with the axes swapped. Pressure is vertical, temperature horizontal.

## Where this goes next

Unit 6 opens with solutions, where vapour pressure returns: a dissolved solute lowers the vapour pressure of a solvent, which raises its boiling point and lowers its freezing point (colligative properties, week 22). Unit 7 builds on q = mcΔT for calorimetry and on the idea that energy changes are tied to bonds and attractions. Unit 8's nuclear chemistry and unit 7's enthalpy both use the sign convention you practised this week: energy absorbed is positive, energy released is negative.

## Self-check

1. Which two phase changes involve a solid and a gas directly, and which of them releases energy?
2. Heat needed to melt 40.0 g of ice at 0 °C?
3. Heat needed to warm 40.0 g of water from 0 °C to 60.0 °C?
4. Why does water boil at about 70 °C at the top of Everest?
5. At 1 atm, why does dry ice sublime instead of melting?

*Answers:* (1) Sublimation and deposition; deposition releases energy. (2) 40.0 × 334 = 13,360 J = 13.4 kJ. (3) 40.0 × 4.184 × 60.0 = 10,042 J = 10.0 kJ. (4) The external pressure is about 0.33 atm, and water's vapour pressure reaches that value near 70 °C. (5) CO₂'s triple point is at 5.11 atm, so below that pressure no liquid phase exists; heating the solid at 1 atm crosses only the solid–gas line.

---

*Original study material written for this course. Constants and data values are public domain, from U.S. government sources (NIST Chemistry WebBook, NIST CODATA constants, PubChem), rounded for classroom use.*
