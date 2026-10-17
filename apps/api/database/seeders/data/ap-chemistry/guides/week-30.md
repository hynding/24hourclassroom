# Week 30 · Entropy, Free Energy and Thermodynamic Favourability

**Topics:** 9.1 Introduction to Entropy · 9.2 Absolute Entropy and Entropy Change · 9.3 Gibbs Free Energy and Thermodynamic Favorability · 9.4 Thermodynamic and Kinetic Control
**Practices:** 1 (Models and Representations), 4 (Model Analysis), 5 (Mathematical Routines), 6 (Argumentation)
**Spiral:** Enthalpy of reaction and enthalpies of formation (6.6, 6.8) supply ΔH°; phase changes (6.5) and the kinetic molecular model (3.5) make entropy concrete; the temperature dependence of K (7.9, 7.10) and the free energy of dissolution (7.14) were previews of ΔG° = ΔH° − TΔS°; activation energy and rate (5.6, 5.10) are what "kinetic control" means.

## What you need to be able to do

- **9.1** Describe entropy as a measure of the dispersal of matter and energy (the number of ways a system's particles and energy can be arranged), and predict the sign of ΔS for a process from the states of matter, the number of gas molecules, dissolving, temperature change and molecular complexity.
- **9.2** Use standard molar entropies S° to calculate ΔS° = Σ n S°(products) − Σ n S°(reactants), remembering that elements have non-zero S° (unlike ΔH°f), and interpret the result.
- **9.3** Calculate ΔG° = ΔH° − TΔS° (watching units), or from ΔG°f values, and decide whether a process is thermodynamically favourable (ΔG° < 0); classify reactions by the signs of ΔH° and ΔS° (favourable at all temperatures, at low or high temperatures only, or never) and find the crossover temperature T = ΔH°/ΔS°; recognise that ΔG° for a phase change is zero at its normal transition temperature.
- **9.4** Distinguish a thermodynamically favourable reaction from one that actually occurs at an observable rate: a large activation energy can make a favourable reaction imperceptibly slow (kinetic control), and ΔG° says nothing about rate.

## Key terms

| Term | Meaning |
|---|---|
| Entropy, S | A state function measuring how dispersed the matter and energy of a system are; more accessible arrangements, higher S. Units J/(mol·K). |
| Standard molar entropy, S° | The absolute entropy of one mole of a substance at 298 K and 1 bar; zero only for a perfect crystal at 0 K. |
| ΔS°(universe) | ΔS(system) + ΔS(surroundings) > 0 for every spontaneous process; ΔS(surr) = −ΔH(sys)/T. |
| Gibbs free energy, G | G = H − TS; at constant T and P, ΔG = ΔH − TΔS < 0 for a thermodynamically favourable process. |
| Thermodynamically favourable | ΔG° < 0 (K > 1): products are favoured at equilibrium under standard conditions. The CED uses "favourable" rather than "spontaneous". |
| Kinetic control | A favourable reaction that does not proceed at a useful rate because its activation energy is too high. |

## Entropy and its sign (9.1)

Entropy counts the ways energy and particles can be distributed. A gas has far more positions available than a liquid, a liquid more than a solid; a warmer sample has more ways to share its energy among translational, rotational and vibrational motions; a mixture has more arrangements than separated pure substances. The second law says the entropy of the universe increases in every process that actually happens.

Predict the sign of ΔS(system) by these rules, in rough order of importance:

1. **Gas moles.** An increase in the number of moles of gas is the dominant effect: ΔS > 0 for CaCO₃(s) → CaO(s) + CO₂(g) and for 2 H₂O₂(l) → 2 H₂O(l) + O₂(g); ΔS < 0 for N₂(g) + 3 H₂(g) → 2 NH₃(g) (4 mol gas → 2 mol).
2. **Phase.** s < l < g. Melting, vaporising and subliming raise S; freezing and condensing lower it.
3. **Dissolving.** A solid or liquid dissolving usually raises S (the ions or molecules spread out), unless the solute ions order water strongly (week 26). A gas dissolving lowers S.
4. **Temperature.** Heating raises S; cooling lowers it.
5. **Number and complexity of particles.** More particles, or larger molecules with more atoms and bonds (more vibrational modes), have higher S: S°(C₃H₈) > S°(C₂H₆) > S°(CH₄). For an equal number of gas moles, the side with more particles or more complex molecules has the higher entropy; any change in gas moles overrules this rule.

**Worked example.** Predict the sign of ΔS for (a) H₂O(l) → H₂O(g); (b) 2 SO₂(g) + O₂(g) → 2 SO₃(g); (c) NaCl(s) → Na⁺(aq) + Cl⁻(aq); (d) 2 NO(g) → N₂(g) + O₂(g); (e) cooling liquid water from 50 °C to 20 °C.
(a) positive (liquid to gas); (b) negative (3 mol gas → 2); (c) positive (ordered solid to dispersed ions); (d) small, because the gas-mole count is unchanged (2 → 2); the tabulated value is −24.8 J/K, since NO, with two different atoms, has slightly more entropy than the average of N₂ and O₂; (e) negative.

**Entropy of the surroundings.** An exothermic reaction dumps heat into the surroundings and raises their entropy by ΔS(surr) = −ΔH(sys)/T. This is why exothermic reactions are usually favourable even when ΔS(system) is negative: the entropy of the universe still rises. The free-energy equation below is just ΔS(universe) multiplied by −T.

**Try it.** Order by increasing S°: H₂O(g), H₂O(l), H₂O(s), and separately CO₂(g), CO(g), C(s, graphite).
*Answer:* H₂O(s) < H₂O(l) < H₂O(g); C(s) < CO(g) < CO₂(g) (the triatomic gas has more vibrational and rotational modes than the diatomic).

## Calculating ΔS° (9.2)

The third law sets a true zero: a perfect crystal at 0 K has S = 0. So every substance has an absolute standard molar entropy S° (tabulated at 298 K), and unlike ΔH°f, **elements have non-zero S°** (H₂(g) 130.7, N₂(g) 191.6, O₂(g) 205.2, C(graphite) 5.7 J/(mol·K)). The reaction entropy is

ΔS° = Σ n S°(products) − Σ n S°(reactants)

**Worked example.** N₂(g) + 3 H₂(g) → 2 NH₃(g). S°: N₂ 191.6, H₂ 130.7, NH₃ 192.8 J/(mol·K).
ΔS° = 2(192.8) − [191.6 + 3(130.7)] = 385.6 − 583.7 = **−198.1 J/(mol·K)**. Negative, as the 4 → 2 gas-mole rule predicted; the magnitude (about −100 J/K per mole of gas lost) is typical.

**Worked example.** 2 H₂O₂(l) → 2 H₂O(l) + O₂(g). S°: H₂O₂(l) 109.6, H₂O(l) 69.9, O₂(g) 205.2.
ΔS° = [2(69.9) + 205.2] − 2(109.6) = 345.0 − 219.2 = **+125.8 J/(mol·K)**: one mole of gas is created.

Watch the units: S° is in J/(mol·K) while ΔH° is in kJ/mol. Convert before combining them.

**Phase changes.** At the normal transition temperature the two phases are in equilibrium, so ΔG = 0 and ΔS = ΔH/T. Melting ice: 6,010 J/mol ÷ 273 K = **22.0 J/(mol·K)**; boiling water: 40,700 ÷ 373 = **109 J/(mol·K)**. Vaporisation always has the larger ΔS because a gas is so much more dispersed than a liquid.

**Try it.** Compute ΔS° for 2 SO₂(g) + O₂(g) → 2 SO₃(g). S°: SO₂ 248.2, O₂ 205.2, SO₃ 256.8 J/(mol·K).
*Answer:* 2(256.8) − [2(248.2) + 205.2] = 513.6 − 701.6 = −188.0 J/(mol·K).

## Gibbs free energy (9.3)

Combining the system's enthalpy and entropy with the entropy of the surroundings gives one criterion at constant temperature and pressure:

ΔG° = ΔH° − TΔS°

ΔG° < 0: thermodynamically favourable (K > 1); ΔG° > 0: unfavourable as written (K < 1; the reverse is favourable); ΔG° = 0: at equilibrium under standard conditions (K = 1). The relation to K is next week.

**Worked example.** Ammonia synthesis at 298 K: ΔH° = −92.2 kJ/mol, ΔS° = −198.1 J/(mol·K).
ΔG° = −92.2 kJ − (298 K)(−0.1981 kJ/K) = −92.2 + 59.0 = **−33.2 kJ/mol**: favourable at 25 °C. At 700 K: −92.2 + 138.7 = **+46.5 kJ/mol**: unfavourable. The crossover where ΔG° = 0 is T = ΔH°/ΔS° = 92,200/198.1 = **465 K**. (Industry runs hotter anyway for the rate, and compensates with pressure: week 25.)

**The four sign cases:**

| ΔH° | ΔS° | ΔG° | Example |
|---|---|---|---|
| − | + | negative at all T: always favourable | 2 H₂O₂ → 2 H₂O + O₂; combustion of most fuels |
| + | − | positive at all T: never favourable (reverse always is) | 3 O₂ → 2 O₃; N₂ + 2 O₂ → 2 NO₂ |
| − | − | favourable at low T (below ΔH°/ΔS°) | N₂ + 3 H₂ → 2 NH₃; freezing; 2 SO₂ + O₂ → 2 SO₃ |
| + | + | favourable at high T (above ΔH°/ΔS°) | CaCO₃ → CaO + CO₂ (above 1,110 K); melting; N₂O₄ → 2 NO₂ (above 325 K) |

**From free energies of formation.** Like ΔH°f, ΔG°f is zero for an element in its standard state, and ΔG° = Σ n ΔG°f(products) − Σ n ΔG°f(reactants). For CH₄(g) + 2 O₂(g) → CO₂(g) + 2 H₂O(l) with ΔG°f CH₄ −50.5, CO₂ −394.4, H₂O(l) −237.1 kJ/mol: ΔG° = [−394.4 + 2(−237.1)] − (−50.5) = **−818.1 kJ/mol**.

**ΔG° versus ΔG.** ΔG° is for standard conditions (1 M, 1 atm). Under other conditions ΔG = ΔG° + RT ln Q, which is zero at equilibrium (Q = K). A reaction with ΔG° > 0 can still proceed forward a little until Q = K, which is why "unfavourable" does not mean "nothing happens". Week 31 develops this.

**Try it.** For N₂O₄(g) → 2 NO₂(g), ΔH° = +57.2 kJ/mol and ΔS° = +175.8 J/(mol·K). Is it favourable at 298 K? Above what temperature does it become favourable?
*Answer:* ΔG° = 57.2 − 298(0.1758) = 57.2 − 52.4 = +4.8 kJ/mol, not favourable (K ≈ 0.14, which is why a flask at room temperature is mostly N₂O₄ with some brown NO₂). T = 57,200/175.8 = 325 K.

## Thermodynamic and kinetic control (9.4)

ΔG° tells you where the reaction wants to go, not how fast it gets there. Rate is a matter of activation energy (unit 5).

- Diamond → graphite has ΔG° = −2.9 kJ/mol: favourable, yet diamonds last because the activation energy for rearranging the covalent network is enormous. "Kinetically stable" but "thermodynamically unstable".
- Combustion of glucose, octane or hydrogen has ΔG° in the hundreds or thousands of kJ negative, yet the fuels sit in air indefinitely until a spark supplies the activation energy.
- H₂O₂ decomposition (ΔG° = −233 kJ/mol) is slow in a brown bottle and fast with a trace of MnO₂ or catalase: the catalyst changes the rate, never ΔG°.
- Living cells run thermodynamically unfavourable reactions by coupling them to favourable ones (ATP hydrolysis), which week 31 treats under coupled reactions.

A process is under **thermodynamic control** when the product mixture reflects ΔG° (the system reaches equilibrium) and under **kinetic control** when the products are whatever forms fastest, because equilibrium is not reached in the time available. The exam asks you to say which factor explains an observation: "the reaction is thermodynamically favourable (ΔG° < 0) but has a large activation energy, so it is kinetically slow".

**Try it.** A student notes that the reaction 2 H₂(g) + O₂(g) → 2 H₂O(l) has ΔG° = −474 kJ, yet a mixture of the gases shows no change for years. Explain, and state what a spark does.
*Answer:* Favourable thermodynamically, but the activation energy (breaking H–H and O=O bonds) is large, so at room temperature almost no collisions succeed: kinetic control. A spark gives some molecules enough energy to react; the heat released then supplies the activation energy for the rest (an explosion). The spark does not change ΔG°.

## Common mistakes

- Giving an element ΔS° = 0; only ΔH°f and ΔG°f are zero for elements.
- Mixing units: ΔH° in kJ with ΔS° in J. Convert ΔS° to kJ/K first.
- Forgetting T must be in kelvin.
- Reading a negative ΔG° as "fast" or a positive one as "impossible".
- Deciding the sign of ΔS from molecule count when the gas-mole count has changed; gas moles win.
- Using 298 K when the question gives another temperature, or assuming ΔH° and ΔS° change with temperature (on the exam they are treated as constant).
- Confusing the crossover temperature T = ΔH°/ΔS° with the normal transition temperature of a phase change (they are the same idea only for phase changes, where ΔG = 0 at equilibrium).

## Where this goes next

Week 31 connects ΔG° to K (ΔG° = −RT ln K), to non-standard conditions (ΔG = ΔG° + RT ln Q), to coupled reactions, and then to electrochemistry: galvanic cells turn a favourable redox reaction into a voltage. Week 32 links that voltage to ΔG° (ΔG° = −nFE°), to the Nernst equation and to electrolysis.

## Self-check

1. Predict the sign of ΔS for (a) 2 Na(s) + Cl₂(g) → 2 NaCl(s); (b) CO₂(s) → CO₂(g); (c) 2 NH₃(g) → N₂(g) + 3 H₂(g).
2. Compute ΔS° for 2 NO(g) + O₂(g) → 2 NO₂(g). S°: NO 210.8, O₂ 205.2, NO₂ 240.1 J/(mol·K).
3. For the reaction in question 2, ΔH° = −114.1 kJ/mol. Find ΔG° at 298 K and the temperature above which it is no longer favourable.
4. Which sign combination of ΔH° and ΔS° makes a reaction favourable at every temperature?
5. Why does a mixture of methane and oxygen not react at room temperature although ΔG° for the combustion is −818 kJ/mol?

*Answers:* (1) (a) negative (gas consumed); (b) positive; (c) positive (2 → 4 mol gas). (2) 2(240.1) − [2(210.8) + 205.2] = 480.2 − 626.8 = −146.6 J/(mol·K). (3) ΔG° = −114.1 − 298(−0.1466) = −114.1 + 43.7 = −70.4 kJ/mol; T = 114,100/146.6 = 778 K. (4) ΔH° negative and ΔS° positive. (5) The activation energy (breaking C–H and O=O bonds) is too large for room-temperature collisions; the reaction is thermodynamically favourable but kinetically slow until a flame supplies the energy.

---

*Original study material written for this course and organised around the College Board AP Chemistry Course and Exam Description (topics 9.1–9.4). Constants and data are public domain, from U.S. government sources (NIST Chemistry WebBook, NIST CODATA constants, PubChem), rounded as the AP equations sheet does. Accessed 2026-10-16.*
