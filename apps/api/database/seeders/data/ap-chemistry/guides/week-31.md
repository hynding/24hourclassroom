# Week 31 · Free Energy, Equilibrium, Coupled Reactions and Electrochemical Cells

**Topics:** 9.5 Free Energy and Equilibrium · 9.6 Coupled Reactions · 9.7 Galvanic (Voltaic) and Electrolytic Cells
**Practices:** 1 (Models and Representations), 2 (Question and Method), 4 (Model Analysis), 5 (Mathematical Routines), 6 (Argumentation)
**Spiral:** ΔG° = ΔH° − TΔS° (9.3) is the input; Q versus K (7.3, 7.10) becomes ΔG = ΔG° + RT ln Q; Hess's-law addition (6.9) and multiplying K values (7.6) are what coupling means; oxidation numbers and balancing redox equations (4.9) and the activity series (4.8 context) are the chemistry inside every cell; the free energy of dissolution (7.14) was the first use of ΔG° = −RT ln K.

## What you need to be able to do

- **9.5** Relate ΔG° and K through ΔG° = −RT ln K; explain that ΔG° < 0 means K > 1, ΔG° > 0 means K < 1 and ΔG° = 0 means K = 1; use ΔG = ΔG° + RT ln Q to decide the direction of a reaction under non-standard conditions and to explain why every reaction mixture moves toward Q = K; connect the temperature dependence of K to the signs of ΔH° and ΔS°.
- **9.6** Explain how a thermodynamically unfavourable reaction can be driven by coupling it to a favourable one (shared intermediate, so the ΔG° values add), with examples from metabolism (ATP), metallurgy (carbon reduction of ores) and photosynthesis; and recognise that electrical work (electrolysis) and light are external inputs that play the same role.
- **9.7** Describe galvanic (voltaic) and electrolytic cells: anode (oxidation) and cathode (reduction), electron flow through the external circuit, ion flow through the salt bridge or electrolyte, the signs of the electrodes in each cell type, and cell notation; identify which half-reaction occurs at which electrode from standard reduction potentials.

## Key terms

| Term | Meaning |
|---|---|
| ΔG° = −RT ln K | The bridge between thermodynamics and equilibrium; R = 8.314 J/(mol·K), T in kelvin. |
| ΔG = ΔG° + RT ln Q | The free-energy change under the actual conditions; zero at equilibrium. |
| Coupled reactions | Two reactions sharing a species so that the favourable one drives the unfavourable one; the ΔG° values add. |
| Galvanic (voltaic) cell | A device in which a favourable redox reaction produces an electric current. |
| Electrolytic cell | A device in which an external power supply forces an unfavourable redox reaction to occur. |
| Anode / cathode | Oxidation always occurs at the anode and reduction at the cathode, in both kinds of cell. |
| Salt bridge | An ionic conductor completing the circuit by letting ions migrate to balance charge in each half-cell. |
| Standard reduction potential, E° | The voltage of a half-reaction written as a reduction, measured against the standard hydrogen electrode (0.00 V) at 1 M, 1 atm, 25 °C. |

## Free energy and the equilibrium constant (9.5)

The link between the two halves of the course is a single equation:

ΔG° = −RT ln K

- ΔG° < 0 ⇔ K > 1: products favoured at equilibrium.
- ΔG° > 0 ⇔ K < 1: reactants favoured.
- ΔG° = 0 ⇔ K = 1.

Every 5.7 kJ/mol of ΔG° at 298 K is a factor of 10 in K (since RT ln 10 = 5.7 kJ/mol). ΔG° = −33.2 kJ/mol (ammonia synthesis at 298 K) gives K = e^(33,200/(8.314 × 298)) = e^(13.4) = **6.6 × 10⁵**. ΔG° = +4.8 kJ/mol (N₂O₄ → 2 NO₂) gives K = e^(−1.94) = **0.14**.

**Worked example.** For H₂(g) + I₂(g) ⇌ 2 HI(g), K = 50 at 700 K. Find ΔG° at 700 K.
ΔG° = −(8.314)(700) ln 50 = −5,820 × 3.91 = −22,800 J/mol = **−22.8 kJ/mol**.

**Worked example.** Acetic acid has Ka = 1.8 × 10⁻⁵. ΔG° for its ionisation at 298 K = −(8.314)(298) ln(1.8 × 10⁻⁵) = −2,478 × (−10.93) = **+27.1 kJ/mol**: unfavourable under standard conditions (1 M each), which is what "weak" means thermodynamically. The same calculation last term gave +55.6 kJ/mol for dissolving AgCl.

**Non-standard conditions: ΔG = ΔG° + RT ln Q.** ΔG° is fixed for a reaction at a temperature; ΔG depends on what is actually in the flask through Q. When Q = K, ΔG = ΔG° + RT ln K = ΔG° − ΔG° = 0: equilibrium. When Q < K, ln Q < ln K, so ΔG < 0 and the reaction proceeds forward; when Q > K, ΔG > 0 and it proceeds in reverse. This is the thermodynamic statement of the Q-versus-K rule from unit 7. Two consequences the exam likes:

- A reaction with ΔG° > 0 still goes forward a little from pure reactants, because with no products Q = 0 and ln Q → −∞, making ΔG negative until enough product forms for Q to reach K.
- A reaction with ΔG° < 0 can be pushed backwards by piling up products (Q > K).

**Worked example.** For ammonia synthesis at 298 K (ΔG° = −33.2 kJ/mol), a mixture has Q = 1.0 × 10³. Is NH₃ still forming?
ΔG = −33.2 + (8.314 × 10⁻³)(298) ln(10³) = −33.2 + 2.478 × 6.91 = −33.2 + 17.1 = **−16.1 kJ/mol**. Yes, still forward (Q = 10³ is below K = 6.6 × 10⁵).

**Temperature.** Combining the two free-energy equations: ln K = −ΔH°/(RT) + ΔS°/R. For an exothermic reaction (ΔH° < 0) the first term is positive and shrinks as T rises, so K falls; for an endothermic reaction K rises with T. That is Le Châtelier's temperature rule, derived.

**Try it.** (a) For Ca(OH)₂ dissolution ΔG° = +29.4 kJ/mol at 298 K; find Ksp. (b) A reaction has ΔG° = −10.0 kJ/mol at 298 K; find ΔG when Q = 100 and state the direction.
*Answer:* (a) K = e^(−29,400/2,478) = e^(−11.86) = 7.1 × 10⁻⁶ (matches the tabulated 5–6 × 10⁻⁶ within rounding). (b) ΔG = −10.0 + 2.478 ln 100 = −10.0 + 11.4 = +1.4 kJ/mol: reverse (Q = 100 exceeds K = e^(4.04) = 57).

## Coupled reactions (9.6)

An unfavourable reaction can be made to happen by coupling it to a favourable one through a shared intermediate, so that the overall reaction (the sum) has ΔG° < 0. Free energies add like enthalpies in Hess's law, and the K values multiply.

**Metabolism.** Phosphorylating glucose is unfavourable: glucose + Pi → glucose-6-phosphate + H₂O, ΔG° = +13.8 kJ/mol. ATP hydrolysis is favourable: ATP + H₂O → ADP + Pi, ΔG° = −30.5 kJ/mol. The enzyme hexokinase transfers the phosphate directly: glucose + ATP → glucose-6-phosphate + ADP, ΔG° = 13.8 − 30.5 = **−16.7 kJ/mol** (K ≈ 850). Cells "spend" ATP, remade by the favourable oxidation of food, to drive synthesis, transport and movement.

**Metallurgy.** ZnO(s) → Zn(s) + ½ O₂(g) has ΔG° = +318 kJ/mol (metal oxides are stable). C(s) + ½ O₂(g) → CO(g) has ΔG° = −137 kJ/mol at 298 K and becomes much more negative at high temperature (ΔS° > 0: a gas is made from a solid). The sum, ZnO + C → Zn + CO, has ΔG° = +181 kJ/mol at 298 K but turns negative above about 1,200 K: smelting works because the carbon oxidation's entropy gain grows with T. For iron, Fe₂O₃(s) + 3 CO(g) → 2 Fe(s) + 3 CO₂(g) is already favourable at 298 K (ΔG° = −29 kJ/mol, from ΔG°f values −742.2, −137.2, −394.4) and runs in a blast furnace.

**Light and electricity as inputs.** Photosynthesis (6 CO₂ + 6 H₂O → C₆H₁₂O₆ + 6 O₂, ΔG° = +2,870 kJ/mol) is driven by absorbed photons; electrolysis of water (2 H₂O(l) → 2 H₂(g) + O₂(g), ΔG° = +474 kJ) is driven by electrical work. In each case an external source of free energy pays for the unfavourable change; the second law is satisfied because the total (including the sun or the power station) still runs downhill.

**Worked example.** Show that Fe₂O₃(s) + 3 CO(g) → 2 Fe(s) + 3 CO₂(g) is favourable by coupling.
Fe₂O₃ → 2 Fe + 3/2 O₂: ΔG° = +742.2 kJ (reverse of formation). 3 CO + 3/2 O₂ → 3 CO₂: ΔG° = 3(−394.4) − 3(−137.2) = −771.6 kJ. Sum: **−29.4 kJ**. The oxidation of CO pays for the reduction of the oxide.

**Try it.** Creatine phosphate hydrolysis has ΔG° = −43.1 kJ/mol. Could it regenerate ATP from ADP + Pi (ΔG° = +30.5 kJ/mol)? Find ΔG° and K for the coupled reaction at 310 K.
*Answer:* Yes: ΔG° = −43.1 + 30.5 = −12.6 kJ/mol; K = e^(12,600/(8.314 × 310)) = e^(4.89) = 133. Muscle uses this to rebuild ATP in the first seconds of exercise.

## Galvanic and electrolytic cells (9.7)

A redox reaction can be split into two half-reactions in separate containers and connected by a wire; the electrons then flow through the wire and can do work. Example: Zn(s) + Cu²⁺(aq) → Zn²⁺(aq) + Cu(s).

**Galvanic (voltaic) cell: favourable reaction, produces current.**
- **Anode:** oxidation. Zn(s) → Zn²⁺(aq) + 2 e⁻. Electrons leave the anode into the wire, so the anode is the **negative** terminal. The zinc electrode loses mass.
- **Cathode:** reduction. Cu²⁺(aq) + 2 e⁻ → Cu(s). Electrons arrive here from the wire, so the cathode is the **positive** terminal. The copper electrode gains mass.
- **Salt bridge** (e.g. KNO₃ in gel): anions (NO₃⁻) move toward the anode compartment, where Zn²⁺ is accumulating, and cations (K⁺) toward the cathode compartment, where Cu²⁺ is being removed. Without it, charge builds up and the current stops within a moment.
- **Electron flow:** anode → wire → cathode. **Current** in the wire and ion flow in the solutions complete the circuit.
- **Cell notation:** anode on the left, cathode on the right, single bars for phase boundaries, a double bar for the salt bridge: Zn(s) | Zn²⁺(aq) || Cu²⁺(aq) | Cu(s). An inert platinum electrode is written when neither species is a metal: Pt(s) | Fe²⁺(aq), Fe³⁺(aq).

The cell potential (voltage) is E°cell = E°(cathode) − E°(anode), using the standard reduction potentials of the two half-reactions as written as reductions (week 32 does the arithmetic). For Zn/Cu, 0.34 − (−0.76) = **1.10 V**. A positive E°cell means the reaction as written is favourable; the half-reaction with the higher E° is the cathode.

**Electrolytic cell: unfavourable reaction, consumes current.** A power supply pushes electrons into one electrode and pulls them from the other, forcing the reverse of the favourable reaction (or any unfavourable one):
- Anode: still oxidation, but now connected to the **positive** terminal of the supply (the supply pulls electrons out).
- Cathode: still reduction, connected to the **negative** terminal (the supply pushes electrons in).
- No salt bridge is needed when both electrodes sit in one electrolyte (molten NaCl, aqueous CuSO₄).
- The supply must provide at least the magnitude of the cell's own E° in reverse (for Zn/Cu, more than 1.10 V to deposit Zn and dissolve Cu).

Example: molten NaCl. Cathode: Na⁺ + e⁻ → Na(l). Anode: 2 Cl⁻ → Cl₂(g) + 2 e⁻. This is how sodium and chlorine are made. Electroplating is an electrolytic cell with the object to be plated as the cathode and the plating metal as the anode.

**Comparison table.**

| | Galvanic | Electrolytic |
|---|---|---|
| ΔG of the cell reaction | negative (favourable) | positive (forced) |
| Energy | chemical → electrical | electrical → chemical |
| Anode | oxidation; negative | oxidation; positive |
| Cathode | reduction; positive | reduction; negative |
| E°cell | positive | negative (the supply exceeds it) |
| Example | Zn/Cu cell, batteries, fuel cells | electrolysis of NaCl, electroplating, recharging a battery |

A rechargeable battery is both: galvanic when it discharges, electrolytic when it is charged.

**Worked example.** A cell is built from Ni(s) | Ni²⁺(aq) and Ag⁺(aq) | Ag(s) (E°: Ni²⁺/Ni −0.25 V, Ag⁺/Ag +0.80 V). Identify the electrodes, write the half-reactions and the overall reaction, give the cell notation and the direction of ion flow in the salt bridge.
Silver has the higher reduction potential, so Ag⁺ is reduced: cathode Ag⁺ + e⁻ → Ag (×2); anode Ni → Ni²⁺ + 2 e⁻. Overall: Ni(s) + 2 Ag⁺(aq) → Ni²⁺(aq) + 2 Ag(s), E°cell = 0.80 − (−0.25) = **1.05 V**. Notation: Ni(s) | Ni²⁺(aq) || Ag⁺(aq) | Ag(s). Anions move toward the nickel (anode) compartment, cations toward the silver (cathode) compartment. The nickel electrode loses mass; the silver electrode gains.

**Try it.** In the electrolysis of molten MgCl₂, which product forms at which electrode, and which electrode is connected to the negative terminal of the supply?
*Answer:* Cathode (negative terminal): Mg²⁺ + 2 e⁻ → Mg(l). Anode (positive terminal): 2 Cl⁻ → Cl₂(g) + 2 e⁻.

## Common mistakes

- Using R = 0.08206 in ΔG° = −RT ln K; it is 8.314 J/(mol·K), and ΔG° comes out in joules.
- Using log instead of ln, or forgetting that T is in kelvin.
- Thinking ΔG° > 0 means no forward reaction at all; it means K < 1.
- Confusing ΔG (actual conditions, zero at equilibrium) with ΔG° (standard conditions, a constant).
- Adding K values for coupled reactions; K values multiply, ΔG° values add.
- Putting reduction at the anode. Oxidation at the anode, reduction at the cathode, in both cell types ("an ox, red cat").
- Reversing the electrode signs: anode negative in a galvanic cell, positive in an electrolytic cell.
- Saying electrons travel through the salt bridge; ions do.
- Writing cell notation with the cathode on the left.

## Where this goes next

Week 32 quantifies cells: E°cell from a table of reduction potentials, ΔG° = −nFE° (tying voltage to free energy and K), the Nernst equation for non-standard concentrations, and Faraday's law for how much substance an electrolysis deposits. Then the exam-prep weeks pull the whole course together.

## Self-check

1. A reaction has K = 2.5 × 10⁻⁴ at 298 K. Find ΔG°.
2. ΔG° = −15.0 kJ/mol at 298 K. For a mixture with Q = 1.0 × 10⁴, find ΔG and the direction of reaction.
3. Reaction A has ΔG° = +40 kJ and reaction B has ΔG° = −55 kJ; they share an intermediate. What is ΔG° for the coupled process, and what does the sign mean?
4. In a galvanic cell made from Mg | Mg²⁺ and Cu²⁺ | Cu, which electrode is the anode, what is its sign, and which way do the anions in the salt bridge move?
5. In an electrolytic cell, what is the sign of the electrode where reduction occurs?

*Answers:* (1) ΔG° = −(8.314)(298) ln(2.5 × 10⁻⁴) = −2,478 × (−8.29) = +20.5 kJ/mol. (2) ΔG = −15.0 + 2.478 × ln(10⁴) = −15.0 + 22.8 = +7.8 kJ/mol; reverse (Q exceeds K = e^(6.05) = 426). (3) −15 kJ; the coupled process is favourable. (4) Magnesium is the anode (oxidised, lower E°), negative; anions move toward the Mg compartment. (5) Negative (the cathode, fed electrons by the power supply).

---

*Original study material written for this course and organised around the College Board AP Chemistry Course and Exam Description (topics 9.5–9.7). Constants and data are public domain, from U.S. government sources (NIST Chemistry WebBook, NIST CODATA constants, PubChem), rounded as the AP equations sheet does. Accessed 2026-10-16.*
