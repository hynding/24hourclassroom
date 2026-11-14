# Week 27 · Acids, Bases, pH and Weak-Acid Equilibria

**Topics:** 8.1 Introduction to Acids and Bases · 8.2 pH and pOH of Strong Acids and Bases · 8.3 Weak Acid and Base Equilibria
**Practices:** 1 (Models and Representations), 2 (Question and Method), 4 (Model Analysis), 5 (Mathematical Routines), 6 (Argumentation)
**Spiral:** Everything here is an ICE table with a small K (7.3, 7.7) and the 5% rule; the magnitude of K (7.5) is what "strong" and "weak" mean; Ka × Kb = Kw is the rule for multiplying equilibrium constants (7.6); molarity and dilution (4.5) feed every concentration; logarithms from the pH scale introduced with Kw.

## What you need to be able to do

- **8.1** Identify Brønsted–Lowry acids and bases and conjugate acid–base pairs; write the autoionisation of water and use Kw = [H₃O⁺][OH⁻] = 1.0 × 10⁻¹⁴ at 25 °C; use pH = −log[H₃O⁺], pOH = −log[OH⁻] and pH + pOH = 14.00 at 25 °C; recognise that Kw, and so the pH of a neutral solution, changes with temperature.
- **8.2** Calculate pH and pOH for strong acids and strong bases, which ionise completely, including bases that release two hydroxide ions per formula unit.
- **8.3** Write Ka and Kb expressions, calculate the pH and percent ionisation of a weak acid or base from Ka or Kb using an ICE table (with the small-x approximation checked), calculate Ka or Kb from a measured pH, and relate Ka and Kb of a conjugate pair through Ka × Kb = Kw.

## Key terms

| Term | Meaning |
|---|---|
| Brønsted–Lowry acid / base | A proton (H⁺) donor / a proton acceptor. |
| Conjugate pair | Two species that differ by one H⁺: HA/A⁻, NH₄⁺/NH₃, H₂O/OH⁻, H₃O⁺/H₂O. |
| Amphoteric | Able to act as either acid or base (H₂O, HCO₃⁻, HSO₄⁻, H₂PO₄⁻). |
| Autoionisation | 2 H₂O ⇌ H₃O⁺ + OH⁻, Kw = 1.0 × 10⁻¹⁴ at 25 °C. |
| Strong acid / base | Ionises essentially completely in water (Ka ≫ 1). The six strong acids: HCl, HBr, HI, HNO₃, HClO₄, H₂SO₄ (first proton). Strong bases: group 1 hydroxides and Ca(OH)₂, Sr(OH)₂, Ba(OH)₂. |
| Weak acid / base | Ionises only partly (Ka or Kb ≪ 1); the equilibrium must be calculated. |
| Ka, Kb | Acid and base ionisation constants; Ka × Kb = Kw for a conjugate pair. |
| Percent ionisation | 100 × [H₃O⁺]eq/[HA]₀; falls as the acid is made more concentrated. |

## Acids, bases and water (8.1)

A Brønsted–Lowry acid donates a proton; a base accepts one. Every acid–base reaction is a proton transfer with two conjugate pairs:

HF(aq) + H₂O(l) ⇌ H₃O⁺(aq) + F⁻(aq)

HF/F⁻ is one pair (HF the acid, F⁻ its conjugate base); H₃O⁺/H₂O is the other (H₂O the base, H₃O⁺ its conjugate acid). Reverse the roles for a base:

NH₃(aq) + H₂O(l) ⇌ NH₄⁺(aq) + OH⁻(aq)

Water is amphoteric: a base toward HF, an acid toward NH₃, and both at once in its autoionisation:

2 H₂O(l) ⇌ H₃O⁺(aq) + OH⁻(aq), Kw = [H₃O⁺][OH⁻] = 1.0 × 10⁻¹⁴ at 25 °C

In pure water [H₃O⁺] = [OH⁻] = 1.0 × 10⁻⁷ M. The product is fixed, so raising one lowers the other: in 0.10 M HCl, [OH⁻] = 1.0 × 10⁻¹⁴/0.10 = 1.0 × 10⁻¹³ M. (H⁺ and H₃O⁺ are used interchangeably; the proton is always hydrated.)

**The pH scale.** pH = −log[H₃O⁺]; pOH = −log[OH⁻]; at 25 °C, pH + pOH = 14.00. Each pH unit is a factor of 10 in [H₃O⁺]. Acidic: pH < 7, [H₃O⁺] > [OH⁻]. Basic: pH > 7. Neutral: equal.

**Temperature.** Autoionisation is endothermic, so Kw rises with temperature: at 50 °C, Kw = 5.5 × 10⁻¹⁴ and neutral water has [H₃O⁺] = √(5.5 × 10⁻¹⁴) = 2.3 × 10⁻⁷ M, pH = 6.63. That water is still neutral: neutral means [H₃O⁺] = [OH⁻], not pH 7.

**Worked example.** Identify the conjugate pairs in HCO₃⁻(aq) + H₂O(l) ⇌ H₂CO₃(aq) + OH⁻(aq), and in HCO₃⁻(aq) + H₂O(l) ⇌ CO₃²⁻(aq) + H₃O⁺(aq).
In the first, HCO₃⁻ is the base (pair HCO₃⁻/H₂CO₃) and water the acid (H₂O/OH⁻). In the second, HCO₃⁻ is the acid (HCO₃⁻/CO₃²⁻) and water the base (H₂O/H₃O⁺). HCO₃⁻ is amphoteric.

**Try it.** A solution has [OH⁻] = 2.5 × 10⁻⁴ M at 25 °C. Find pOH, pH and [H₃O⁺].
*Answer:* pOH = 3.60; pH = 10.40; [H₃O⁺] = 10⁻¹⁰·⁴⁰ = 4.0 × 10⁻¹¹ M (or 1.0 × 10⁻¹⁴/2.5 × 10⁻⁴).

## Strong acids and bases (8.2)

A strong acid ionises completely, so [H₃O⁺] equals the acid's formal concentration (one proton per molecule for HCl, HNO₃, HClO₄, HBr, HI; H₂SO₄ gives one proton fully and the second only partly). A strong base dissociates completely; count the hydroxides.

**Worked example.** pH of 0.0050 M HCl: [H₃O⁺] = 5.0 × 10⁻³ M, pH = −log(5.0 × 10⁻³) = **2.30**.

**Worked example.** pH of 0.020 M Ba(OH)₂: [OH⁻] = 2 × 0.020 = 0.040 M, pOH = 1.40, pH = **12.60**.

**Dilution.** Diluting a strong acid ten-fold raises its pH by one unit (0.0050 M → 0.00050 M: pH 2.30 → 3.30). This stops working below about 10⁻⁶ M, where water's own 10⁻⁷ M H₃O⁺ matters: 1.0 × 10⁻⁸ M HCl has pH 6.98, not 8 (an acid cannot make water basic).

**Significant figures in pH.** The digits after the decimal point are the significant ones: [H₃O⁺] = 5.0 × 10⁻³ M (two sig figs) gives pH 2.30 (two decimals). Going back: pH 2.30 → [H₃O⁺] = 10⁻²·³⁰ = 5.0 × 10⁻³ M.

**Try it.** Find the pH of (a) 0.15 M HNO₃; (b) 0.0025 M NaOH; (c) a solution made by diluting 10.0 mL of 1.0 M HCl to 250.0 mL.
*Answer:* (a) 0.82. (b) pOH = 2.60, pH = 11.40. (c) M = 1.0 × 10.0/250.0 = 0.040 M; pH = 1.40.

## Weak acids and bases (8.3)

A weak acid sets up an equilibrium with a small Ka:

HA(aq) + H₂O(l) ⇌ H₃O⁺(aq) + A⁻(aq), Ka = [H₃O⁺][A⁻]/[HA]

Ka values: HF 6.8 × 10⁻⁴; HNO₂ 4.5 × 10⁻⁴; CH₃COOH 1.8 × 10⁻⁵; HOCl 3.0 × 10⁻⁸; HCN 6.2 × 10⁻¹⁰. The smaller Ka, the weaker the acid and the less H₃O⁺ a given concentration produces. Water, the solvent, is omitted.

**pH of a weak acid: the ICE table.** For 0.10 M acetic acid (Ka = 1.8 × 10⁻⁵):

| | CH₃COOH | H₃O⁺ | CH₃COO⁻ |
|---|---|---|---|
| Initial | 0.10 | ≈0 | 0 |
| Change | −x | +x | +x |
| Equilibrium | 0.10 − x | x | x |

Ka = x²/(0.10 − x) ≈ x²/0.10 → x² = 1.8 × 10⁻⁶ → x = 1.3 × 10⁻³ M. Check: 1.3 × 10⁻³/0.10 = 1.3% < 5%, fine. **pH = 2.87.** (A 0.10 M strong acid would have pH 1.00: the same formal concentration, 75 times less H₃O⁺.)

**Percent ionisation** = 100 × x/[HA]₀ = 1.3%. Diluting a weak acid *increases* its percent ionisation (Le Châtelier: more particles on the right, so dilution shifts toward ionisation) while its pH still rises; 0.010 M acetic acid is 4.2% ionised at pH 3.37.

**When the approximation fails.** 0.10 M HF (Ka = 6.8 × 10⁻⁴): the approximation gives x = 8.2 × 10⁻³, which is 8.2% of 0.10, over the limit. Solve x² + 6.8 × 10⁻⁴x − 6.8 × 10⁻⁵ = 0: x = 7.9 × 10⁻³ M, pH = 2.10, 7.9% ionised. The approximation would have given pH 2.08, a small error in pH but a large one in x.

**Ka from a measured pH.** A 0.050 M solution of a weak acid has pH 3.00. Then x = [H₃O⁺] = 1.0 × 10⁻³ M, [A⁻] = 1.0 × 10⁻³ M, [HA] = 0.050 − 0.001 = 0.049 M, and Ka = (1.0 × 10⁻³)²/0.049 = **2.0 × 10⁻⁵**. (Subtracting x here costs nothing and is more accurate.)

**Weak bases** are the mirror image:

NH₃(aq) + H₂O(l) ⇌ NH₄⁺(aq) + OH⁻(aq), Kb = [NH₄⁺][OH⁻]/[NH₃] = 1.8 × 10⁻⁵

For 0.20 M NH₃: x² = 1.8 × 10⁻⁵ × 0.20 = 3.6 × 10⁻⁶, x = [OH⁻] = 1.9 × 10⁻³ M, pOH = 2.72, **pH = 11.28**. Anions of weak acids are weak bases too (F⁻, CH₃COO⁻, CN⁻, CO₃²⁻), which is why their salts give basic solutions (week 28).

**Ka × Kb = Kw** for a conjugate pair, because adding HA ⇌ H⁺ + A⁻ and A⁻ + H₂O ⇌ HA + OH⁻ gives 2 H₂O ⇌ H₃O⁺ + OH⁻ (constants multiply, week 24). Kb of F⁻ = 1.0 × 10⁻¹⁴/6.8 × 10⁻⁴ = 1.5 × 10⁻¹¹; Kb of CN⁻ = 1.0 × 10⁻¹⁴/6.2 × 10⁻¹⁰ = 1.6 × 10⁻⁵. The weaker the acid, the stronger its conjugate base. The conjugate base of a strong acid (Cl⁻) has Kb ≈ 10⁻²⁰: no base at all in water.

**Polyprotic acids** lose protons one at a time with decreasing Ka (H₂CO₃: Ka1 = 4.3 × 10⁻⁷, Ka2 = 4.7 × 10⁻¹¹; H₃PO₄: 7.5 × 10⁻³, 6.2 × 10⁻⁸, 4.8 × 10⁻¹³). Each successive proton leaves a more negative ion, so Ka drops by about 10⁵ per step, and the pH is set almost entirely by the first ionisation. For H₂SO₄ the first proton is strong and the second has Ka2 = 1.2 × 10⁻².

**Try it.** (a) Find the pH of 0.25 M HOCl (Ka = 3.0 × 10⁻⁸). (b) A 0.050 M solution of a weak base has pH 11.65; find Kb.
*Answer:* (a) x = √(3.0 × 10⁻⁸ × 0.25) = √(7.5 × 10⁻⁹) = 8.7 × 10⁻⁵ M (0.03%, fine); pH = 4.06. (b) pOH = 2.35, [OH⁻] = 4.5 × 10⁻³ M; Kb = (4.5 × 10⁻³)²/(0.050 − 0.0045) = 2.0 × 10⁻⁵/0.0455 = 4.4 × 10⁻⁴.

## Common mistakes

- Treating a weak acid as strong (pH of 0.10 M acetic acid is 2.87, not 1.00) or a strong acid as weak.
- Forgetting the 2 in [OH⁻] for Ba(OH)₂ and Ca(OH)₂.
- Reporting pH to the wrong number of decimals, or taking the log of a concentration in the wrong units.
- Claiming pH 7 is always neutral; neutral means [H₃O⁺] = [OH⁻], and Kw depends on temperature.
- Dropping x from the numerator (it is the product term; only the denominator's x is dropped), or never checking the 5% rule.
- Using Ka for a base problem: find [OH⁻] from Kb, then pOH, then pH (or convert with Ka × Kb = Kw).
- Saying dilution lowers the percent ionisation of a weak acid; it raises it.
- Thinking the second proton of a diprotic acid contributes significantly to the pH.

## Where this goes next

Week 28 mixes acids and bases: the pH of salts, buffers (a weak acid plus its conjugate base) and titration curves, and relates acid strength to molecular structure. Week 29 handles buffers quantitatively with the Henderson–Hasselbalch equation and buffer capacity. Unit 9 reuses pH in Nernst-equation and electrolysis problems.

## Self-check

1. Identify the conjugate pairs in HSO₄⁻ + NH₃ ⇌ SO₄²⁻ + NH₄⁺.
2. Find the pH of 0.0040 M Ca(OH)₂.
3. Find the pH and percent ionisation of 0.050 M HNO₂ (Ka = 4.5 × 10⁻⁴); is the approximation valid?
4. Kb for CH₃COO⁻?
5. At 60 °C, Kw = 9.6 × 10⁻¹⁴. Is pure water at 60 °C acidic? What is its pH?

*Answers:* (1) HSO₄⁻/SO₄²⁻ (acid/conjugate base) and NH₄⁺/NH₃ (conjugate acid/base). (2) [OH⁻] = 0.0080 M, pOH = 2.10, pH = 11.90. (3) Approximation: x = √(2.25 × 10⁻⁵) = 4.7 × 10⁻³, 9.5% of 0.050, invalid; quadratic x² + 4.5 × 10⁻⁴x − 2.25 × 10⁻⁵ = 0 gives x = 4.5 × 10⁻³ M, pH = 2.35, 9.0% ionised. (4) 1.0 × 10⁻¹⁴/1.8 × 10⁻⁵ = 5.6 × 10⁻¹⁰. (5) No: [H₃O⁺] = [OH⁻] = √(9.6 × 10⁻¹⁴) = 3.1 × 10⁻⁷ M, pH = 6.51, and it is neutral.

---

*Original study material written for this course and organised around the College Board AP Chemistry Course and Exam Description (topics 8.1–8.3). Constants and data are public domain, from U.S. government sources (NIST Chemistry WebBook, NIST CODATA constants, PubChem), rounded as the AP equations sheet does. Accessed 2026-10-16.*
