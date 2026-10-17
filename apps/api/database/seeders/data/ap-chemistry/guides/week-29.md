# Week 29 · Buffers: Properties, Henderson–Hasselbalch and Capacity

**Topics:** 8.8 Properties of Buffers · 8.9 Henderson–Hasselbalch Equation · 8.10 Buffer Capacity
**Practices:** 2 (Question and Method), 4 (Model Analysis), 5 (Mathematical Routines), 6 (Argumentation)
**Spiral:** The common-ion effect (7.12) is what a buffer is; Le Châtelier and Q (7.9, 7.10) explain why it works; weak-acid Ka and pKa (8.3, 8.7); the buffer region of a titration curve (8.5); stoichiometry of neutralisation in moles (4.5, 8.4); logarithms (8.1).

## What you need to be able to do

- **8.8** Explain, with equations, how a buffer (comparable amounts of a weak acid and its conjugate base) resists pH change when strong acid or strong base is added; identify which mixtures are buffers; relate the buffer's pH to pKa and the base/acid ratio; explain the role of buffers in blood and in the laboratory.
- **8.9** Use the Henderson–Hasselbalch equation, pH = pKa + log([A⁻]/[HA]), to calculate the pH of a buffer, the ratio needed for a target pH, and the pH after a strong acid or base has been added (stoichiometry first, then the equation); know when the equation applies.
- **8.10** Explain buffer capacity: more concentrated buffers absorb more acid or base; a buffer is most effective when pH ≈ pKa (ratio near 1) and works within about pKa ± 1; recognise when a buffer has been exhausted.

## Key terms

| Term | Meaning |
|---|---|
| Buffer | A solution containing a weak acid and its conjugate base (or weak base and conjugate acid) in comparable amounts. |
| Henderson–Hasselbalch | pH = pKa + log([A⁻]/[HA]); the Ka expression rearranged in logarithms. |
| Buffer capacity | The amount of strong acid or base a buffer can absorb before its pH changes significantly; grows with concentration. |
| Effective range | pKa ± 1, where the base/acid ratio is between 1/10 and 10. |
| Exhausted buffer | All of one component has been consumed; the solution then behaves as a weak-acid (or weak-base) solution or as excess strong reagent. |

## How a buffer works (8.8)

An acetate buffer holds both CH₃COOH and CH₃COO⁻. Each component deals with one kind of intruder:

- Added strong acid is consumed by the base: H⁺(aq) + CH₃COO⁻(aq) → CH₃COOH(aq). Strong acid becomes weak acid.
- Added strong base is consumed by the acid: OH⁻(aq) + CH₃COOH(aq) → CH₃COO⁻(aq) + H₂O(l). Strong base becomes weak base.

Both reactions go essentially to completion (K ≈ 10⁵ and 10⁹). The buffer's pH is set by the ratio [A⁻]/[HA], and a small addition changes that ratio only slightly, so the pH barely moves.

**Worked example (the pH comparison).** 1.0 L of buffer is 0.10 M in acetic acid and 0.10 M in sodium acetate (pH 4.74). 0.010 mol of HCl is added. The acetate consumes it: acetate 0.10 → 0.09 mol, acetic acid 0.10 → 0.11 mol. pH = 4.74 + log(0.09/0.11) = 4.74 − 0.09 = **4.65**. The same 0.010 mol of HCl added to 1.0 L of pure water gives 0.010 M H⁺, **pH 2.00**: a change of 5 units instead of 0.09.

Adding 0.010 mol of NaOH instead: acid 0.10 → 0.09, acetate 0.10 → 0.11, pH = 4.74 + log(0.11/0.09) = **4.83**.

**What counts as a buffer.** A weak acid alone is not a buffer (nothing to absorb added acid); a strong acid with its salt (HCl + NaCl) is not (Cl⁻ cannot accept protons). A weak acid with a strong base in a less-than-equivalent amount is a buffer after the reaction (week 28); so is a weak base with less than one equivalent of strong acid. The pairs: CH₃COOH/CH₃COO⁻, HF/F⁻, H₂CO₃/HCO₃⁻, H₂PO₄⁻/HPO₄²⁻, NH₄⁺/NH₃.

**Blood.** The carbonic acid–bicarbonate buffer (effective pKa 6.1 at body conditions) holds blood at pH 7.40 with an HCO₃⁻/H₂CO₃ ratio of about 20:1; CO₂ from respiration supplies the acid side (CO₂ + H₂O ⇌ H₂CO₃) and the lungs and kidneys adjust it. Phosphate (H₂PO₄⁻/HPO₄²⁻, pKa 7.21) buffers inside cells.

**Try it.** Which of these are buffers: (a) 0.1 M HNO₂ + 0.1 M KNO₂; (b) 0.1 M HNO₃ + 0.1 M KNO₃; (c) 0.1 M NH₃ + 0.05 M HCl after mixing; (d) 0.1 M NH₃ + 0.1 M HCl after mixing?
*Answer:* (a) yes (weak acid + conjugate base); (b) no (strong acid, spectator anion); (c) yes (half the NH₃ becomes NH₄⁺); (d) no (all NH₃ converted: a solution of NH₄Cl).

## The Henderson–Hasselbalch equation (8.9)

Start from Ka = [H⁺][A⁻]/[HA], solve for [H⁺] = Ka[HA]/[A⁻], take −log:

pH = pKa + log([A⁻]/[HA])

or in words, pH = pKa + log(base/acid). Because the acid and base are in the same solution, the ratio of concentrations equals the ratio of moles, so volumes often cancel. For a weak base buffer use pOH = pKb + log([BH⁺]/[B]) or convert to the conjugate acid's pKa.

**Three uses.**

1. **pH of a buffer.** 0.20 M acetic acid and 0.30 M sodium acetate: pH = 4.74 + log(0.30/0.20) = 4.74 + 0.18 = **4.92**.
2. **Designing a buffer.** For pH 5.00 from acetic acid: log(base/acid) = 5.00 − 4.74 = 0.26, ratio = 10⁰·²⁶ = **1.8**. For 0.10 mol acid, use 0.18 mol sodium acetate (0.18 × 82.0 g/mol = 15 g). First choose an acid whose pKa is within 1 of the target: HOCl (7.52) or H₂PO₄⁻ (7.21) for pH 7.4, acetic acid for pH 4–5.5, NH₄⁺/NH₃ (9.25) for pH 9.
3. **pH after adding strong acid or base.** Do the stoichiometry in moles first (the strong reagent reacts completely with one buffer component), then put the new moles into the equation.

**Worked example.** 1.0 L of buffer is 0.25 M HF and 0.40 M NaF (pKa of HF = 3.17). (a) pH? (b) pH after adding 0.050 mol NaOH (no volume change)?
(a) pH = 3.17 + log(0.40/0.25) = 3.17 + 0.20 = **3.37**.
(b) OH⁻ converts 0.050 mol HF to F⁻: HF 0.25 → 0.20 mol, F⁻ 0.40 → 0.45 mol. pH = 3.17 + log(0.45/0.20) = 3.17 + 0.35 = **3.52**. A change of 0.15 units; the same base in water would give pH 12.70.

**When the equation applies.** It is exact only when the approximations behind it hold: both components present at concentrations well above [H⁺] (typically > 10⁻³ M) and in a ratio between about 1/10 and 10. It fails when one component is nearly used up (then it is a plain weak-acid or weak-base ICE problem) and when the strong reagent exceeds the buffer component (then the excess strong reagent sets the pH).

**Try it.** An ammonia buffer must have pH 9.00 (pKa of NH₄⁺ = 9.25). (a) Find the required ratio [NH₃]/[NH₄⁺]. (b) If the solution contains 0.10 mol NH₃, how many moles of NH₄Cl are needed?
*Answer:* (a) log ratio = 9.00 − 9.25 = −0.25; ratio = 0.56. (b) 0.10/0.56 = 0.18 mol NH₄Cl.

## Buffer capacity (8.10)

Buffer capacity is how much strong acid or base a buffer can take before its pH changes by a large amount. Two factors:

**Concentration.** Compare two acetate buffers with the same 1:1 ratio (pH 4.74) when 0.010 mol HCl is added to 1.0 L:
- 1.0 M / 1.0 M: acid 1.01, base 0.99; pH = 4.74 + log(0.99/1.01) = **4.73**.
- 0.010 M / 0.010 M: the 0.010 mol of H⁺ consumes all the acetate; the solution is now 0.020 M acetic acid alone, pH = −log √(1.8 × 10⁻⁵ × 0.020) = **3.22**. The buffer is exhausted.
Same pH to begin with, a hundred-fold difference in what they can absorb. Capacity is proportional to the amount of the component that will react: the base for added acid, the acid for added base.

**Ratio.** A buffer is most effective when [A⁻]/[HA] ≈ 1, that is pH ≈ pKa, because then it has equal reserves for acid and base and the log term changes most slowly. Outside pKa ± 1 (ratio beyond 10:1 or 1:10) one component is too small to be useful. So the acetate system buffers well from pH 3.7 to 5.7, the ammonia system from 8.3 to 10.3.

**Reading capacity from a titration curve.** The buffer region is the flat stretch centred on the half-equivalence point; the flatter and longer it is, the greater the capacity. Capacity is greatest at the half-equivalence point and vanishes at the equivalence point.

**Worked example.** A 0.50 M/0.50 M acetate buffer (1.0 L) receives 0.10 mol HCl, then separately 0.10 mol NaOH. pH values?
After HCl: 4.74 + log(0.40/0.60) = 4.74 − 0.18 = **4.56**. After NaOH: 4.74 + log(0.60/0.40) = **4.92**. Both within 0.2 units; adding 0.60 mol of either would exhaust it.

**Try it.** Rank by capacity toward added acid: (a) 0.10 M HA / 0.10 M A⁻; (b) 0.50 M HA / 0.50 M A⁻; (c) 0.50 M HA / 0.10 M A⁻; (d) 0.10 M HA / 0.50 M A⁻.
*Answer:* Toward acid, what matters is the amount of base: (d) = (b) > (a) = (c). (b) has the greatest overall capacity (large reserves of both); (d) resists acid well but base poorly.

## Common mistakes

- Using initial concentrations after a strong acid or base has been added; do the neutralisation stoichiometry first.
- Inverting the ratio (acid over base) in the Henderson–Hasselbalch equation; check that adding base raises the pH.
- Applying the equation to a solution that is not a buffer (weak acid alone, or after the buffer is exhausted).
- Forgetting that the ratio of moles equals the ratio of concentrations only within one solution; when two solutions are mixed, either use moles or dilute both.
- Treating buffer capacity as a property of pKa alone; it depends on the concentrations.
- Claiming a buffer keeps the pH constant; it keeps the change small.
- Choosing a buffer by its pH rather than by pKa close to the target.

## Where this goes next

The unit exam covers everything from conjugate pairs to buffer capacity. Unit 9 returns to thermodynamics: entropy, Gibbs free energy, ΔG° = −RT ln K (which links Ka and pKa to energy), electrochemistry (where pH enters the Nernst equation) and electrolysis.

## Self-check

1. Write the two reactions by which an H₂PO₄⁻/HPO₄²⁻ buffer absorbs added H⁺ and added OH⁻.
2. pH of a buffer that is 0.15 M in HOCl and 0.45 M in NaOCl (pKa 7.52)?
3. What base/acid ratio makes a phosphate buffer (pKa 7.21) hold pH 7.40?
4. 1.0 L of 0.20 M NH₃/0.20 M NH₄Cl receives 0.050 mol HCl. New pH (pKa 9.25)?
5. Why is a 0.5 M/0.5 M buffer better than a 0.05 M/0.05 M buffer of the same pKa?

*Answers:* (1) H⁺ + HPO₄²⁻ → H₂PO₄⁻; OH⁻ + H₂PO₄⁻ → HPO₄²⁻ + H₂O. (2) 7.52 + log(0.45/0.15) = 7.52 + 0.48 = 8.00. (3) log ratio = 0.19, ratio = 1.5. (4) NH₃ 0.20 → 0.15 mol, NH₄⁺ 0.20 → 0.25 mol; pH = 9.25 + log(0.15/0.25) = 9.25 − 0.22 = 9.03. (5) It contains ten times as many moles of each component, so it can neutralise ten times as much added acid or base before its ratio, and so its pH, changes appreciably.

---

*Original study material written for this course and organised around the College Board AP Chemistry Course and Exam Description (topics 8.8–8.10). Constants and data are public domain, from U.S. government sources (NIST Chemistry WebBook, NIST CODATA constants, PubChem), rounded as the AP equations sheet does. Accessed 2026-10-16.*
