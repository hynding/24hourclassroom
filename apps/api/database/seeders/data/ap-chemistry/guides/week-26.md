# Week 26 · Common Ions, pH and the Thermodynamics of Dissolving

**Topics:** 7.12 Common-Ion Effect · 7.13 pH and Solubility · 7.14 Free Energy of Dissolution
**Practices:** 2 (Question and Method), 4 (Model Analysis), 5 (Mathematical Routines), 6 (Argumentation)
**Spiral:** Ksp and the Q/Ksp criterion (7.11); Le Châtelier's principle and its Q-versus-K reason (7.9, 7.10); the small-x approximation (7.7); ionic bonding, lattice energy and the energetics of dissolving (2.1, 3.9, 3.10); enthalpy of solution and calorimetry (6.4, 6.6); acids, bases and pH (8.1–8.3 are coming, but the pH scale from unit 1's introduction and Kw are enough here).

## What you need to be able to do

- **7.12** Explain and calculate the common-ion effect: a sparingly soluble salt is less soluble in a solution that already contains one of its ions, because Q would exceed Ksp at the pure-water solubility; use Ksp with the fixed common-ion concentration to find the reduced solubility.
- **7.13** Predict and explain the effect of pH on solubility: salts whose anion is a weak base (OH⁻, CO₃²⁻, PO₄³⁻, F⁻, S²⁻, CH₃COO⁻) dissolve more in acid because H⁺ removes the anion and shifts the equilibrium toward dissolving; salts of strong-acid anions (Cl⁻, NO₃⁻, SO₄²⁻ to a first approximation) are not affected. Calculate solubility at a fixed pH for hydroxides.
- **7.14** Relate the free energy of dissolution to Ksp through ΔG° = −RT ln K, and explain the sign of ΔG° through ΔH° (lattice energy against hydration energy) and ΔS° (disorder of the ions against the ordering of water around them).

## Key terms

| Term | Meaning |
|---|---|
| Common ion | An ion present in solution from another source that also belongs to the dissolving salt (Cl⁻ from NaCl when AgCl dissolves). |
| Common-ion effect | The decrease in solubility of a salt in the presence of one of its ions, a Le Châtelier shift toward the solid. |
| Selective precipitation | Adding an ion that precipitates one metal ion before another, exploiting different Ksp values. |
| Basic anion | The conjugate base of a weak acid (CO₃²⁻, OH⁻, F⁻, PO₄³⁻); it reacts with H⁺. |
| Free energy of dissolution | ΔG° for the dissolving reaction; ΔG° = −RT ln Ksp, positive for sparingly soluble salts. |
| Hydration energy | The energy released when gas-phase ions are surrounded by water molecules; opposes the lattice energy that must be overcome. |

## The common-ion effect (7.12)

Dissolve AgCl in pure water and [Ag⁺] = [Cl⁻] = s = 1.3 × 10⁻⁵ M. Dissolve it instead in 0.10 M NaCl: the solution already holds 0.10 M Cl⁻, so

AgCl(s) ⇌ Ag⁺(aq) + Cl⁻(aq), Ksp = [Ag⁺][Cl⁻] = (s)(0.10 + s) ≈ (s)(0.10) = 1.8 × 10⁻¹⁰

so s = 1.8 × 10⁻⁹ M, about 7,000 times less than in pure water. Le Châtelier's version: Cl⁻ is a product, so adding it shifts the equilibrium toward the solid. The Q version: if the salt tried to dissolve to its pure-water solubility, Q = (1.3 × 10⁻⁵)(0.10) = 1.3 × 10⁻⁶ ≫ Ksp, so it cannot; far less dissolves.

The small-x approximation in these problems is almost always justified, because the common-ion concentration is typically thousands of times larger than s. Always check with the 5% rule anyway.

**Worked example.** Find the molar solubility of PbI₂ (Ksp = 9.8 × 10⁻⁹) in 0.050 M KI.
PbI₂(s) ⇌ Pb²⁺ + 2 I⁻. [Pb²⁺] = s; [I⁻] = 0.050 + 2s ≈ 0.050. Ksp = s(0.050)² = 2.5 × 10⁻³ s, so s = 9.8 × 10⁻⁹/2.5 × 10⁻³ = **3.9 × 10⁻⁶ M**. In pure water it was 1.35 × 10⁻³ M; the common ion cut the solubility by a factor of about 340. Note that the common ion's concentration is squared here because I⁻ has coefficient 2; the 2s is dropped but the 2 on the exponent is not.

**Which ion is "common" matters.** Dissolving PbI₂ in 0.050 M Pb(NO₃)₂ instead: Ksp = (0.050)(2s)² = 0.20s², s = √(9.8 × 10⁻⁹/0.20) = 2.2 × 10⁻⁴ M. The iodide ion, squared in Ksp, suppresses solubility more strongly than the lead ion at the same concentration.

**Selective precipitation.** A solution is 0.010 M in both Cl⁻ and I⁻, and AgNO₃ is added drop by drop. AgI (Ksp = 8.5 × 10⁻¹⁷) begins to precipitate when [Ag⁺] = 8.5 × 10⁻¹⁷/0.010 = 8.5 × 10⁻¹⁵ M; AgCl (Ksp = 1.8 × 10⁻¹⁰) when [Ag⁺] = 1.8 × 10⁻⁸ M. The iodide precipitates first, and by the time AgCl starts, [I⁻] has fallen to 8.5 × 10⁻¹⁷/1.8 × 10⁻⁸ = 4.7 × 10⁻⁹ M: essentially all the iodide is out of solution before any chloride precipitates. Water treatment, qualitative analysis and ore refining all use this.

**Try it.** Calculate the molar solubility of CaF₂ (Ksp = 3.5 × 10⁻¹¹) in 0.10 M NaF, and compare with pure water (2.1 × 10⁻⁴ M).
*Answer:* Ksp = s(0.10)² → s = 3.5 × 10⁻¹¹/0.010 = 3.5 × 10⁻⁹ M, about 60,000 times smaller.

## pH and solubility (7.13)

Many anions of sparingly soluble salts are weak bases: they react with H⁺.

Mg(OH)₂(s) ⇌ Mg²⁺(aq) + 2 OH⁻(aq)
OH⁻(aq) + H⁺(aq) → H₂O(l)

In acid, the second reaction removes OH⁻ as fast as it appears, Q stays below Ksp, and the solid keeps dissolving: milk of magnesia neutralises stomach acid by dissolving. In base (added OH⁻), the common-ion effect suppresses dissolving. The same logic applies to:

- Carbonates: CaCO₃(s) + 2 H⁺(aq) → Ca²⁺(aq) + CO₂(g) + H₂O(l). Limestone and marble dissolve in acid rain; seashells fizz in vinegar; the ocean's falling pH lowers the carbonate available to shell-building organisms.
- Phosphates: Ca₃(PO₄)₂ and the apatite of tooth enamel dissolve faster at the lower pH produced by bacteria in plaque (fluoride converts enamel to the less soluble fluorapatite).
- Fluorides, sulfides, acetates: F⁻, S²⁻ and CH₃COO⁻ are all conjugate bases of weak acids, so their salts dissolve more in acid.

Salts whose anion is the conjugate base of a strong acid (chlorides, bromides, iodides, nitrates; sulfates to a good approximation because HSO₄⁻ is a fairly strong acid) are essentially unaffected by pH: Cl⁻ has no tendency to pick up H⁺, so adding acid changes nothing in the Ksp expression.

**Calculating solubility at a fixed pH (hydroxides).** A buffered solution holds [OH⁻] constant, so the hydroxide concentration is a common ion set by the pH.

**Worked example.** Ksp for Mg(OH)₂ is 5.6 × 10⁻¹². Find its molar solubility in a solution buffered at pH 13.00, and compare with pure water (1.1 × 10⁻⁴ M).
pOH = 1.00, [OH⁻] = 0.10 M (fixed by the buffer). Ksp = [Mg²⁺](0.10)² → [Mg²⁺] = s = 5.6 × 10⁻¹²/0.010 = **5.6 × 10⁻¹⁰ M**: a factor of 200,000 less soluble. (Notice the exponent: ordinary 1:2 algebra, with [OH⁻] fixed rather than equal to 2s.)

**Worked example.** At what pH does Fe(OH)₃ (Ksp = 2.8 × 10⁻³⁹) begin to precipitate from 0.010 M Fe³⁺?
Precipitation begins when Q = Ksp: [OH⁻]³ = 2.8 × 10⁻³⁹/0.010 = 2.8 × 10⁻³⁷, [OH⁻] = 6.5 × 10⁻¹³ M, pOH = 12.19, **pH = 1.81**. Iron(III) hydroxide precipitates even from quite acidic solutions, which is why rusty water stains appear so easily and why Fe³⁺ can be separated from most other metal ions by raising the pH only slightly.

Explaining in words is what the exam most often wants: "Adding acid lowers [OH⁻] (or [CO₃²⁻]) by reaction with H⁺, so Q falls below Ksp, and more solid dissolves until Q = Ksp again."

**Try it.** Which of these salts become more soluble as the pH is lowered: BaSO₄, BaCO₃, AgCl, AgF, Ca₃(PO₄)₂? Explain.
*Answer:* BaCO₃ (CO₃²⁻ is basic), AgF (F⁻ is the conjugate base of the weak acid HF) and Ca₃(PO₄)₂ (PO₄³⁻ is strongly basic). BaSO₄ and AgCl are not: SO₄²⁻ and Cl⁻ come from strong acids and do not consume H⁺ appreciably.

## The free energy of dissolution (7.14)

Dissolving is a reaction, so it has ΔG°, ΔH° and ΔS°, and ΔG° is linked to the equilibrium constant (unit 9 develops the relation fully):

ΔG° = −RT ln K

For a sparingly soluble salt K = Ksp is tiny, so ln Ksp is a large negative number and ΔG° is large and positive: dissolving is unfavourable under standard conditions (1 M ions), which is the thermodynamic way of saying the salt is insoluble. For a soluble salt such as NaCl, K is large and ΔG° is negative.

**Worked example.** Calculate ΔG° at 298 K for AgCl(s) ⇌ Ag⁺(aq) + Cl⁻(aq), Ksp = 1.8 × 10⁻¹⁰.
ΔG° = −(8.314 J/(mol·K))(298 K) ln(1.8 × 10⁻¹⁰) = −(2,478 J/mol)(−22.44) = +55,600 J/mol = **+55.6 kJ/mol**.

**Why is dissolving sometimes favourable and sometimes not?** ΔG° = ΔH° − TΔS°, and both terms are a contest of two effects:

| Term | Opposing contributions | Net result |
|---|---|---|
| ΔH° (enthalpy of solution) | Breaking the lattice costs the lattice energy (endothermic); hydrating the separated ions releases hydration energy (exothermic). | Small, positive or negative; NaCl +3.9 kJ/mol, KNO₃ +35 kJ/mol, NaOH −44 kJ/mol, CaCl₂ −82 kJ/mol. |
| ΔS° (entropy of solution) | Ions leaving an ordered lattice for solution gain entropy; water molecules ordered around each ion lose entropy (large for small, highly charged ions). | Usually positive for salts of singly charged, large ions (KNO₃, NaCl); can be negative for small or highly charged ions (Mg²⁺, Al³⁺, F⁻, OH⁻). |

Consequences:

- An endothermic dissolution (KNO₃, NH₄NO₃, the cold pack) happens anyway because ΔS° is large and positive and TΔS° outweighs ΔH° at room temperature: ΔG° = 35 − 298(0.117) = −0.1 kJ/mol for KNO₃, just favourable. Its solubility rises sharply with temperature, because a higher T makes the −TΔS° term more negative (and Le Châtelier: heat is a reactant).
- An exothermic dissolution with a positive ΔS° (NaOH, CaCl₂, the hot pack) is favourable at every temperature.
- Sparingly soluble salts typically have a strongly positive ΔH° (huge lattice energies for small, highly charged ions, as in CaF₂, Al(OH)₃, CaCO₃) and often a negative ΔS° (highly charged ions order the water strongly), so ΔG° is positive and Ksp is tiny.
- Temperature dependence follows the sign of ΔH° of dissolution: most solids dissolve more at higher temperature (endothermic), but a few (Ce₂(SO₄)₃, many gases) dissolve less.

**Worked example.** The dissolution of a salt has ΔH° = +25.0 kJ/mol and ΔS° = +50.0 J/(mol·K). (a) Is it favourable at 298 K? (b) At what temperature does ΔG° = 0? (c) Does solubility increase or decrease with temperature?
(a) ΔG° = 25.0 − 298(0.0500) = 25.0 − 14.9 = **+10.1 kJ/mol**: not favourable under standard conditions (a sparingly soluble salt; K = e^(−10,100/(8.314 × 298)) = e^(−4.08) = 0.017). (b) T = ΔH°/ΔS° = 25,000/50.0 = **500 K**. (c) Endothermic, so solubility **increases** with temperature.

**Try it.** Compute ΔG° at 298 K for the dissolution of CaCO₃ (Ksp = 3.4 × 10⁻⁹), and state what the sign means.
*Answer:* ΔG° = −(8.314)(298) ln(3.4 × 10⁻⁹) = −2,478 × (−19.5) = +48.3 kJ/mol; dissolving to 1 M ions is strongly unfavourable, so CaCO₃ is sparingly soluble.

## Common mistakes

- Adding the common ion to s when the approximation is obviously fine (0.10 + s ≈ 0.10), or, worse, dropping the exponent along with the s (write s(0.050)², not s(0.050)).
- Setting [OH⁻] = 2s in a buffered solution; the buffer fixes [OH⁻], and only the metal ion equals s.
- Claiming AgCl or BaSO₄ dissolves in acid; only salts with basic anions do.
- Confusing "solubility" (moles dissolved) with "Ksp" (constant): the common ion changes the first and not the second.
- Forgetting that ΔG° = −RT ln K uses R = 8.314 J/(mol·K) and T in kelvin, and that a positive ΔG° corresponds to K < 1.
- Saying an endothermic dissolution cannot occur; it occurs when TΔS° wins.
- Mixing units in ΔG° = ΔH° − TΔS° (ΔH° in kJ, ΔS° in J).

## Where this goes next

Unit 8 treats every weak acid and base with the same ICE tables and the same small-x approximation; a buffer is precisely the common-ion effect applied to a weak acid, and titration curves are solubility-style Q/K reasoning with H⁺ as the ion. Unit 9 derives ΔG° = ΔH° − TΔS° and ΔG° = −RT ln K properly and connects them to electrochemistry.

## Self-check

1. Is the molar solubility of BaSO₄ greater in pure water or in 0.10 M Na₂SO₄? By what factor (Ksp = 1.1 × 10⁻¹⁰)?
2. Explain why Mg(OH)₂ dissolves in HCl but AgCl does not.
3. Find the solubility of Zn(OH)₂ (Ksp = 3.0 × 10⁻¹⁷) at pH 9.00.
4. What is ΔG° at 298 K for a dissolution with Ksp = 1.0 × 10⁻⁵?
5. A salt dissolves endothermically with a positive ΔS°. How does its solubility change on heating, and why?

*Answers:* (1) Pure water: s = √(1.1 × 10⁻¹⁰) = 1.0 × 10⁻⁵ M. In 0.10 M SO₄²⁻: s = 1.1 × 10⁻¹⁰/0.10 = 1.1 × 10⁻⁹ M, about 10,000 times smaller. (2) OH⁻ reacts with H⁺ to form water, removing a product of the dissolving equilibrium and driving it forward; Cl⁻ is the conjugate base of a strong acid and does not react with H⁺, so nothing changes. (3) pOH = 5.00, [OH⁻] = 1.0 × 10⁻⁵ M; s = 3.0 × 10⁻¹⁷/(1.0 × 10⁻⁵)² = 3.0 × 10⁻⁷ M. (4) ΔG° = −(8.314)(298) ln(1.0 × 10⁻⁵) = −2,478 × (−11.51) = +28.5 kJ/mol. (5) It increases: ΔG° = ΔH° − TΔS° becomes more negative as T rises when ΔS° > 0, so K (Ksp) increases; equivalently heat is a reactant and heating shifts the equilibrium toward dissolving.

---

*Original study material written for this course and organised around the College Board AP Chemistry Course and Exam Description (topics 7.12–7.14). Constants and data are public domain, from U.S. government sources (NIST Chemistry WebBook, NIST CODATA constants, PubChem), rounded as the AP equations sheet does. Accessed 2026-10-16.*
