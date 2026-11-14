# Week 28 · Acid–Base Reactions, Titrations, Structure and pKa

**Topics:** 8.4 Acid–Base Reactions and Buffers · 8.5 Acid–Base Titrations · 8.6 Molecular Structure of Acids and Bases · 8.7 pH and pKa
**Practices:** 1 (Models and Representations), 2 (Question and Method), 3 (Representing Data and Phenomena), 4 (Model Analysis), 5 (Mathematical Routines), 6 (Argumentation)
**Spiral:** Weak-acid and weak-base ICE tables and Ka × Kb = Kw (8.3); strong-acid pH (8.2); limiting reactants and stoichiometry in solution (4.5, 4.6) for every titration point; bond polarity and bond strength (2.2, 2.3) and electronegativity (1.6) for acid strength; Le Châtelier (7.9) for why a buffer resists change; logarithms from pH (8.1).

## What you need to be able to do

- **8.4** Write net ionic equations for acid–base reactions (strong–strong, strong–weak, weak–weak); predict whether a salt solution is acidic, basic or neutral and calculate its pH; recognise that mixing a weak acid with a strong base (or a weak base with a strong acid) in a less-than-equivalent amount produces a buffer.
- **8.5** Analyse a titration: find the equivalence point by stoichiometry; sketch and interpret titration curves for strong–strong, weak acid–strong base and weak base–strong acid; calculate the pH at the start, before, at and after equivalence; read pKa from the half-equivalence point; choose an indicator; interpret polyprotic curves.
- **8.6** Explain acid strength from structure: for binary acids, bond strength and polarity (HI > HBr > HCl > HF; H₂S > H₂O); for oxyacids, the number of oxygen atoms and the electronegativity of the central atom (HClO₄ > HClO₃ > HClO₂ > HClO); carboxylic acids (resonance-stabilised anion); bases need a lone pair (amines, anions).
- **8.7** Use pKa = −log Ka: when pH < pKa the protonated form dominates, when pH > pKa the deprotonated form dominates, and at pH = pKa they are equal; each pH unit away is a factor of 10 in the ratio.

## Key terms

| Term | Meaning |
|---|---|
| Neutralisation | Acid + base → salt + water; net ionic H⁺ + OH⁻ → H₂O for strong–strong. |
| Hydrolysis (of a salt) | The reaction of a salt's ion with water that makes the solution acidic (NH₄⁺) or basic (F⁻). |
| Equivalence point | The point in a titration where moles of added titrant exactly equal moles of analyte by the stoichiometry. |
| End point | Where the indicator changes colour; chosen to coincide with the equivalence point. |
| Half-equivalence point | Half the titrant needed for equivalence has been added; [HA] = [A⁻] and pH = pKa. |
| Buffer | A solution of a weak acid and its conjugate base (or weak base and conjugate acid) in comparable amounts; resists pH change. |
| pKa | −log Ka; the pH at which an acid is half-ionised. Lower pKa, stronger acid. |
| Indicator | A weak acid whose two forms are differently coloured; changes colour over about pKa ± 1. |

## Acid–base reactions and the pH of salts (8.4)

**Strong acid + strong base.** H⁺(aq) + OH⁻(aq) → H₂O(l); the spectator ions make a neutral salt (NaCl). The reaction goes to completion (K = 1/Kw = 10¹⁴).

**Strong acid + weak base.** H⁺(aq) + NH₃(aq) → NH₄⁺(aq), K = 1/Ka(NH₄⁺) = 1.8 × 10⁹: complete. The product NH₄⁺ is a weak acid, so NH₄Cl solutions are acidic.

**Weak acid + strong base.** CH₃COOH(aq) + OH⁻(aq) → CH₃COO⁻(aq) + H₂O(l), K = Ka/Kw = 1.8 × 10⁹: complete. The product acetate is a weak base, so sodium acetate solutions are basic.

**Weak acid + weak base.** CH₃COOH + NH₃ ⇌ CH₃COO⁻ + NH₄⁺, K = Ka(CH₃COOH)/Ka(NH₄⁺) = 1.8 × 10⁻⁵/5.6 × 10⁻¹⁰ = 3.2 × 10⁴: still well to the right, but the result is an equilibrium rather than a completed reaction.

**The rule for salts.** Look at each ion. Cations of strong bases (Na⁺, K⁺, Ca²⁺) and anions of strong acids (Cl⁻, NO₃⁻, Br⁻, ClO₄⁻) are spectators: no effect on pH. Conjugate acids of weak bases (NH₄⁺, CH₃NH₃⁺) make the solution acidic; conjugate bases of weak acids (F⁻, CH₃COO⁻, CN⁻, CO₃²⁻, NO₂⁻) make it basic. Small, highly charged metal ions (Al³⁺, Fe³⁺) are acidic too, because the water molecules bound to them lose protons.

**Worked example.** Find the pH of 0.10 M NH₄Cl (Kb of NH₃ = 1.8 × 10⁻⁵).
Ka(NH₄⁺) = Kw/Kb = 5.6 × 10⁻¹⁰. NH₄⁺ ⇌ H⁺ + NH₃: x² ≈ 5.6 × 10⁻¹⁰ × 0.10 = 5.6 × 10⁻¹¹, x = 7.5 × 10⁻⁶ M, **pH = 5.13** (Cl⁻ is a spectator).

**Worked example.** Find the pH of 0.20 M NaF (Ka of HF = 6.8 × 10⁻⁴).
Kb(F⁻) = 1.5 × 10⁻¹¹. F⁻ + H₂O ⇌ HF + OH⁻: x² ≈ 1.5 × 10⁻¹¹ × 0.20 = 2.9 × 10⁻¹², x = 1.7 × 10⁻⁶ M, pOH = 5.77, **pH = 8.23**.

**Partial neutralisation makes a buffer.** Add 0.050 mol NaOH to 0.100 mol acetic acid: the base converts half the acid to acetate, leaving 0.050 mol CH₃COOH and 0.050 mol CH₃COO⁻ together: a buffer (week 29 does the arithmetic). Any weak acid partly neutralised by a strong base, or weak base partly neutralised by a strong acid, is a buffer. Fully neutralised is a salt solution; over-neutralised is excess strong base.

**Try it.** Predict acidic, basic or neutral, with the responsible ion: KNO₃, NaCN, NH₄Br, Ca(CH₃COO)₂, Fe(NO₃)₃.
*Answer:* KNO₃ neutral (both spectators); NaCN basic (CN⁻); NH₄Br acidic (NH₄⁺); calcium acetate basic (CH₃COO⁻); iron(III) nitrate acidic (hydrated Fe³⁺).

## Titrations (8.5)

A titration adds a solution of known concentration (the titrant) to a measured volume of analyte until the equivalence point, recognised by an indicator or a pH meter. The stoichiometry gives the unknown:

**Worked example.** 25.00 mL of H₂SO₄ requires 31.20 mL of 0.1000 M NaOH to reach equivalence. H₂SO₄ + 2 NaOH → Na₂SO₄ + 2 H₂O. Moles NaOH = 3.120 × 10⁻³; moles H₂SO₄ = half = 1.560 × 10⁻³; [H₂SO₄] = 1.560 × 10⁻³/0.02500 = **0.06240 M**.

**The four curve shapes** (titrant on the x-axis, pH on the y-axis):

| Titration | Start | Buffer region | Equivalence pH | Steep jump |
|---|---|---|---|---|
| Strong acid + strong base | low (pH 1 for 0.1 M) | none; pH climbs slowly then jumps | 7.00 | pH ≈ 3 to 11 |
| Weak acid + strong base | moderate (pH 2.9 for 0.1 M acetic) | yes; pH = pKa at half-equivalence | > 7 (conjugate base present) | shorter, centred above 7 |
| Weak base + strong acid | high (pH 11.1 for 0.1 M NH₃) | yes; pOH = pKb at half-equivalence | < 7 (conjugate acid present) | centred below 7 |
| Polyprotic acid + strong base | low | two buffer regions | two equivalence points | two jumps; the second at twice the volume |

**Calculating points on a weak-acid curve.** 25.0 mL of 0.100 M CH₃COOH (Ka = 1.8 × 10⁻⁵, pKa = 4.74) titrated with 0.100 M NaOH. Moles acid = 2.50 × 10⁻³. Equivalence at 25.0 mL.

- **Start (0 mL):** weak-acid ICE: x = √(1.8 × 10⁻⁵ × 0.100) = 1.3 × 10⁻³ M, pH **2.87**.
- **Before equivalence (10.0 mL):** 1.00 × 10⁻³ mol OH⁻ converts 1.00 × 10⁻³ mol acid to acetate: 1.50 × 10⁻³ mol CH₃COOH and 1.00 × 10⁻³ mol CH₃COO⁻ remain. A buffer; pH = pKa + log(base/acid) = 4.74 + log(1.00/1.50) = **4.56**. (The volumes cancel in the ratio.)
- **Half-equivalence (12.5 mL):** equal moles of acid and base; pH = **pKa = 4.74**. This is how Ka is measured from a titration curve.
- **Equivalence (25.0 mL):** all acid converted to 2.50 × 10⁻³ mol acetate in 50.0 mL, 0.0500 M. Weak-base ICE with Kb = 5.6 × 10⁻¹⁰: x = √(5.6 × 10⁻¹⁰ × 0.0500) = 5.3 × 10⁻⁶ M OH⁻, pOH 5.28, **pH 8.72**. Basic, because acetate is a base.
- **After equivalence (30.0 mL):** 0.50 × 10⁻³ mol excess OH⁻ in 55.0 mL: [OH⁻] = 9.1 × 10⁻³ M, pOH 2.04, **pH 11.96**. The weak base acetate is negligible beside the strong base.

For a **strong–strong** titration the same 25.0 mL of 0.100 M HCl gives pH 1.00 at the start, 2.69 at 24.0 mL (excess H⁺ = 0.10 × 10⁻³ mol in 49.0 mL), 7.00 at equivalence (NaCl is neutral), 11.29 at 26.0 mL. The jump from 24.9 to 25.1 mL is pH 3.70 to 10.30.

**Indicators.** An indicator is a weak acid HIn whose acid and base forms differ in colour; it changes over about pKa(HIn) ± 1. Choose one whose range lies on the steep part of the curve: phenolphthalein (8.3–10.0) for a weak acid–strong base titration (equivalence pH 8.7); methyl red (4.4–6.2) for a weak base–strong acid titration (equivalence pH about 5.3); either works for strong–strong because the jump spans both.

**Try it.** 20.0 mL of 0.200 M HNO₂ (Ka = 4.5 × 10⁻⁴) is titrated with 0.100 M KOH. Find the volume at equivalence, the pH at half-equivalence, and the pH at equivalence.
*Answer:* Moles acid = 4.00 × 10⁻³; equivalence at 40.0 mL. Half-equivalence pH = pKa = 3.35. At equivalence, [NO₂⁻] = 4.00 × 10⁻³/0.0600 L = 0.0667 M; Kb = 2.2 × 10⁻¹¹; x = √(2.2 × 10⁻¹¹ × 0.0667) = 1.2 × 10⁻⁶ M; pOH 5.91; pH 8.09.

## Molecular structure and acid strength (8.6)

An acid is strong when the H–X bond breaks easily *and* the resulting anion is stable.

**Binary acids (H–X).** Down a group, bond strength falls and the anion grows larger (charge spread over more volume): HF ≪ HCl < HBr < HI; H₂O < H₂S < H₂Se. Across a period, polarity dominates: CH₄ < NH₃ < H₂O < HF (electronegativity rises, the bond becomes more polar, the proton more easily lost). HF is weak not because the bond is non-polar (it is the most polar) but because it is the strongest bond and F⁻ is so strongly hydrated.

**Oxyacids (H–O–Y).** The more electronegative Y and the more oxygen atoms on Y, the more electron density is pulled away from the O–H bond, the more easily the proton leaves, and the better the negative charge is delocalised in the anion. HClO₄ (strong) > HClO₃ (strong) > HClO₂ (Ka 1.1 × 10⁻²) > HClO (3.0 × 10⁻⁸); HClO > HBrO > HIO; H₂SO₄ > H₂SO₃; HNO₃ > HNO₂.

**Carboxylic acids (R–COOH).** The carboxylate anion is resonance-stabilised (the negative charge is shared by two oxygens), so the O–H proton of a carboxyl group is acidic (Ka ≈ 10⁻⁵) while the O–H of an alcohol (ethanol, Ka ≈ 10⁻¹⁶) is not. Electron-withdrawing substituents strengthen them: CH₃COOH (1.8 × 10⁻⁵) < CH₂ClCOOH (1.4 × 10⁻³) < CCl₃COOH (0.2).

**Bases.** A base needs a lone pair to bind H⁺: NH₃ and amines (RNH₂; the N lone pair), anions of weak acids, hydroxide. Amines are weak bases (Kb ≈ 10⁻⁴ to 10⁻⁵); electron-donating alkyl groups make them slightly stronger than NH₃.

**Try it.** Rank from strongest to weakest acid: HBrO, HClO, HClO₂; and explain which of H₂S and H₂O is the stronger acid.
*Answer:* HClO₂ > HClO > HBrO (more oxygens, then more electronegative halogen). H₂S: the H–S bond is weaker and the larger S²⁻/HS⁻ spreads charge better, outweighing the lower polarity.

## pH and pKa (8.7)

pKa = −log Ka turns Ka into a number on the pH scale: acetic acid 4.74; HF 3.17; HOCl 7.52; HCN 9.21; NH₄⁺ 9.25. **Lower pKa, stronger acid.**

Rearranging Ka gives [A⁻]/[HA] = Ka/[H⁺], or in logs, log([A⁻]/[HA]) = pH − pKa. So:

- pH = pKa: [HA] = [A⁻], the acid is half-ionised.
- pH one unit below pKa: [HA]/[A⁻] = 10 (protonated form dominates).
- pH one unit above pKa: [A⁻]/[HA] = 10 (deprotonated form dominates).
- Two units: a factor of 100, and so on.

This is why aspirin (pKa 3.5) is mostly neutral molecules in the stomach (pH 1–2) and mostly anions in the intestine (pH 6–7); why an indicator with pKa 9 is in its acid colour below pH 8 and its base colour above pH 10; and why the species present at every point of a titration can be read from pH relative to pKa.

**Worked example.** Acetic acid (pKa 4.74) in a solution of pH 3.74. Which form dominates and by what ratio? What about pH 6.74?
pH − pKa = −1.00: [CH₃COO⁻]/[CH₃COOH] = 10⁻¹ = 0.10, so the acid form is ten times the base form. At pH 6.74, +2.00: the acetate is 100 times the acid.

**Try it.** At what pH is HOCl (pKa 7.52) 90% in the OCl⁻ form?
*Answer:* [OCl⁻]/[HOCl] = 9.0; log 9.0 = 0.95; pH = 7.52 + 0.95 = 8.47.

## Common mistakes

- Treating the pH at the equivalence point of every titration as 7; only strong–strong is neutral.
- Using the acid's initial molarity at the equivalence point instead of the *diluted* concentration of the conjugate base (moles ÷ total volume).
- Choosing an indicator by its colour rather than its pKa range.
- Reading pKa at the equivalence point instead of at half-equivalence.
- Ranking HF as the strongest hydrohalic acid because it is the most polar; bond strength wins down a group.
- Counting hydrogens instead of oxygens for oxyacids (H₃PO₄ is weaker than HNO₃ although it has more H).
- Confusing pKa (a property of the acid) with pH (a property of the solution).
- Forgetting that a salt of a weak acid and strong base is basic, and vice versa.

## Where this goes next

Week 29 makes buffers quantitative: the Henderson–Hasselbalch equation (which you already used in the buffer region above), how to choose and prepare a buffer, and buffer capacity. Unit 9 uses pH in the Nernst equation and in electrolysis of aqueous solutions, and the thermodynamic meaning of Ka through ΔG° = −RT ln K.

## Self-check

1. Is 0.10 M KCN acidic, basic or neutral? Find its pH (Ka of HCN = 6.2 × 10⁻¹⁰).
2. 25.0 mL of 0.100 M NH₃ (Kb = 1.8 × 10⁻⁵) is titrated with 0.100 M HCl. What is the pH at equivalence?
3. Which is the stronger acid, H₂SeO₄ or H₂SeO₃? HClO or HBrO?
4. At pH 5.74, what is the ratio [CH₃COO⁻]/[CH₃COOH] (pKa 4.74)?
5. Which indicator suits a weak base–strong acid titration: phenolphthalein (8.3–10.0) or methyl red (4.4–6.2)?

*Answers:* (1) Basic (CN⁻); Kb = 1.6 × 10⁻⁵; x = √(1.6 × 10⁻⁶) = 1.3 × 10⁻³ M OH⁻; pOH 2.90; pH 11.10. (2) 2.50 × 10⁻³ mol NH₄⁺ in 50.0 mL = 0.0500 M; Ka = 5.6 × 10⁻¹⁰; x = √(2.8 × 10⁻¹¹) = 5.3 × 10⁻⁶ M; pH 5.28. (3) H₂SeO₄ (more oxygens); HClO (Cl more electronegative than Br). (4) 10:1. (5) Methyl red; equivalence is at pH about 5.3.

---

*Original study material written for this course and organised around the College Board AP Chemistry Course and Exam Description (topics 8.4–8.7). Constants and data are public domain, from U.S. government sources (NIST Chemistry WebBook, NIST CODATA constants, PubChem), rounded as the AP equations sheet does. Accessed 2026-10-16.*
