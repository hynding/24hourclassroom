# Week 23 · Equilibrium, the Reaction Quotient and K

**Topics:** 7.1 Introduction to Equilibrium · 7.2 Direction of Reversible Reactions · 7.3 Reaction Quotient and Equilibrium Constant · 7.4 Calculating the Equilibrium Constant
**Practices:** 1 (Models and Representations), 3 (Representing Data and Phenomena), 4 (Model Analysis), 5 (Mathematical Routines)
**Spiral:** Rate laws and elementary steps (5.2, 5.4) explain why equilibrium is reached and why K is a ratio of rate constants; the ideal gas law (3.4) connects Kp and Kc; molarity (3.7) and stoichiometry (4.5) are how equilibrium concentrations are found; particle diagrams (3.8, 4.3) are how the exam often shows an equilibrium mixture.

## What you need to be able to do

- **7.1** Explain that many reactions are reversible and that chemical equilibrium is a dynamic state in which the forward and reverse rates are equal, so concentrations stop changing although both reactions continue; read a concentration–time graph to find when equilibrium is reached.
- **7.2** Explain that the direction a reversible reaction proceeds depends on the initial concentrations relative to the equilibrium ones, and that the same equilibrium is reached from either side.
- **7.3** Write the expression for the reaction quotient Q (and K) for any balanced equation, omitting pure solids and liquids; compare Q with K to predict the direction of change: Q < K forward, Q > K reverse, Q = K at equilibrium.
- **7.4** Calculate K from equilibrium concentrations or pressures (Kc or Kp), including from a particle diagram or a data table, and from initial amounts with an ICE table when one equilibrium value is known.

## Key terms

| Term | Meaning |
|---|---|
| Reversible reaction | One that can proceed in both directions; written with ⇌. |
| Dynamic equilibrium | Forward rate = reverse rate; macroscopic properties are constant, molecular change continues. |
| Equilibrium constant, K | The value of the mass-action ratio at equilibrium at a given temperature. Kc uses molarities, Kp uses partial pressures (atm or bar). |
| Reaction quotient, Q | The same ratio evaluated at any moment, not necessarily at equilibrium. |
| Law of mass action | For a A + b B ⇌ c C + d D, K = [C]ᶜ[D]ᵈ / ([A]ᵃ[B]ᵇ). |
| Heterogeneous equilibrium | One involving more than one phase; pure solids and liquids are left out of Q and K because their concentrations do not change. |
| ICE table | Initial, Change, Equilibrium rows used to organise an equilibrium calculation. |
| Δn | Moles of gaseous products minus moles of gaseous reactants; Kp = Kc(RT)^Δn. |

## What equilibrium is (7.1)

Put N₂O₄, a colourless gas, in a sealed flask. It decomposes: N₂O₄ ⇌ 2 NO₂, and the brown colour of NO₂ grows, then stops growing. The reaction has not stopped: NO₂ molecules keep combining into N₂O₄ as fast as N₂O₄ molecules keep splitting. At the start the forward rate is high (lots of N₂O₄) and the reverse rate is zero (no NO₂); as the reaction proceeds the forward rate falls and the reverse rate rises until they are equal. From then on the concentrations are constant. That is **dynamic equilibrium**: constant at the macroscopic level, busy at the molecular level.

Graph description you should recognise: concentration against time for a reactant (falling, then flat) and a product (rising, then flat); the moment both curves go flat is when equilibrium is reached. A second plot, rate against time, shows the forward rate falling and the reverse rate rising until the two lines meet and run together.

Every chemical reaction is reversible in principle. Reactions we call "complete" have such a large K that almost no reactant remains at equilibrium; reactions that "do not occur" have a tiny K. The language of equilibrium applies to all of them.

Evidence for dynamic equilibrium: add a radioactive isotope of iodine to a saturated solution of iodine in equilibrium with solid iodine; radioactivity soon appears in the solid, although its mass never changes. Dissolving and crystallising continue at equal rates.

## Which way does it go? (7.2)

Start with pure reactants and the reaction runs forward until equilibrium; start with pure products and it runs backward to the *same* equilibrium (for the same total composition and temperature). Start with a mixture and the direction depends on whether the mixture holds more product than the equilibrium ratio allows or less. The reaction quotient (next section) makes that comparison quantitative. The important idea here is that equilibrium is a destination fixed by K, not by where you started.

A concentration–time graph that starts with [products] high and [reactants] zero, with products falling and reactants rising to plateaus, shows a reaction approaching equilibrium from the product side; the plateaus satisfy the same K as the graph that starts from reactants.

## Q and K (7.3)

For the general reaction a A + b B ⇌ c C + d D,

Q = [C]ᶜ[D]ᵈ / ([A]ᵃ[B]ᵇ)

evaluated with whatever concentrations are present right now. At equilibrium Q takes its special value, K. Rules for writing the expression:

- Products over reactants, each raised to its coefficient.
- **Omit pure solids and pure liquids** (and the solvent in dilute solutions): their concentration is a constant that is folded into K. For CaCO₃(s) ⇌ CaO(s) + CO₂(g), K = [CO₂]. For the autoionisation of water, Kw = [H⁺][OH⁻].
- Gases can be written with partial pressures: Kp = (P_C)ᶜ(P_D)ᵈ / ((P_A)ᵃ(P_B)ᵇ).
- K has no units on the AP exam (concentrations are understood relative to 1 M, pressures relative to 1 atm).

**Predicting direction.** Compare Q with K:

| Comparison | Meaning | What happens |
|---|---|---|
| Q < K | too little product | reaction proceeds forward (to the right) |
| Q > K | too much product | reaction proceeds in reverse (to the left) |
| Q = K | at equilibrium | no net change |

**Worked example.** For H₂(g) + I₂(g) ⇌ 2 HI(g), K = 50 at 450 °C. A flask contains [H₂] = 0.10 M, [I₂] = 0.20 M and [HI] = 0.40 M. Which way does the reaction go?
Q = [HI]²/([H₂][I₂]) = (0.40)²/(0.10 × 0.20) = 0.16/0.020 = 8.0. Q < K, so the reaction proceeds **forward**: HI increases, H₂ and I₂ decrease until Q = 50.

**Why K is constant: the kinetic view.** For a single-step reaction A ⇌ B with forward rate k_f[A] and reverse rate k_r[B], equilibrium means k_f[A] = k_r[B], so [B]/[A] = k_f/k_r = K. The equilibrium constant is a ratio of rate constants, which is why it depends on temperature (both k values follow Arrhenius, with different Ea) and on nothing else. The same conclusion holds for multistep mechanisms, which is why the overall coefficients, not the orders, appear in K.

**Try it.** Write Kc for 2 SO₂(g) + O₂(g) ⇌ 2 SO₃(g) and for Fe₃O₄(s) + 4 H₂(g) ⇌ 3 Fe(s) + 4 H₂O(g).
*Answer:* K = [SO₃]²/([SO₂]²[O₂]); K = [H₂O]⁴/[H₂]⁴.

## Calculating K (7.4)

**From equilibrium concentrations.** Substitute into the expression.

**Worked example.** At 700 K, an equilibrium mixture contains [CO] = 0.012 M, [H₂O] = 0.012 M, [CO₂] = 0.028 M and [H₂] = 0.028 M for CO(g) + H₂O(g) ⇌ CO₂(g) + H₂(g). K = (0.028 × 0.028)/(0.012 × 0.012) = 7.84 × 10⁻⁴/1.44 × 10⁻⁴ = **5.4**.

**From a particle diagram.** Count the particles of each kind in the box at equilibrium and use the counts as concentrations (the box volume cancels when Δn = 0, and otherwise you are told the volume). A box holding 2 A₂, 2 B₂ and 4 AB for A₂ + B₂ ⇌ 2 AB gives K = 4²/(2 × 2) = 4.

**From initial amounts plus one equilibrium value: the ICE table.** Write Initial concentrations, the Change in terms of the coefficients (−x for reactants, +x for products, scaled by coefficient), and the Equilibrium values; use the one known equilibrium value to find x, then fill in the rest.

**Worked example.** 1.00 mol of N₂O₄ is placed in a 2.00 L flask. At equilibrium 0.28 mol of NO₂ is present. Find Kc for N₂O₄(g) ⇌ 2 NO₂(g).
[N₂O₄]₀ = 1.00/2.00 = 0.500 M; [NO₂]eq = 0.28/2.00 = 0.140 M.

| | N₂O₄ | NO₂ |
|---|---|---|
| Initial (M) | 0.500 | 0 |
| Change | −x | +2x |
| Equilibrium | 0.500 − x | 2x = 0.140 |

x = 0.070, so [N₂O₄]eq = 0.430 M. Kc = (0.140)²/0.430 = 0.0196/0.430 = **0.046**.

**Kp from Kc.** Kp = Kc(RT)^Δn, with R = 0.08206 L·atm/(mol·K) and Δn = moles of gas on the right minus moles on the left. For N₂O₄ ⇌ 2 NO₂, Δn = +1, so at 298 K Kp = Kc × (0.08206 × 298) = 24.5 Kc. When Δn = 0 (H₂ + I₂ ⇌ 2 HI), Kp = Kc.

**Worked example (Kp directly).** At equilibrium at 1,000 K, P(SO₂) = 0.20 atm, P(O₂) = 0.10 atm and P(SO₃) = 0.60 atm. Kp for 2 SO₂ + O₂ ⇌ 2 SO₃ = (0.60)²/((0.20)² × 0.10) = 0.36/0.0040 = **90**.

**Try it.** 0.500 M HI is placed in a flask; at equilibrium [HI] = 0.390 M. Find K for 2 HI ⇌ H₂ + I₂.
*Answer:* HI fell by 0.110 M, so 2x = 0.110, x = 0.055 = [H₂] = [I₂]. K = (0.055)²/(0.390)² = 0.0030/0.152 = 0.020.

## Common mistakes

- Including solids, pure liquids or the solvent in K.
- Forgetting to raise each concentration to its coefficient, or raising to the order from a rate law (orders have nothing to do with K).
- Using moles instead of molarity in Kc when the volume is not 1 L.
- Writing the change row as −x for every species regardless of coefficient; the change for a species with coefficient 2 is 2x.
- Comparing Q with K in the wrong direction (Q < K means go forward, toward products).
- Thinking equilibrium means equal concentrations, or that the reaction has stopped.
- Expecting K to change when concentrations change; only temperature changes K.

## Where this goes next

Week 24 interprets the size of K, manipulates K (reversing, scaling, adding reactions) and solves the general ICE problem for equilibrium concentrations, including the small-x approximation and reading particle diagrams. Week 25 is Le Châtelier's principle, explained through Q and K. Week 26 applies all of it to the solubility of salts. Unit 8 is equilibrium for acids and bases (Ka, Kb, Kw), and Unit 9 links K to ΔG° through ΔG° = −RT ln K.

## Self-check

1. Write Kc for 2 NO(g) + Cl₂(g) ⇌ 2 NOCl(g) and for NH₄Cl(s) ⇌ NH₃(g) + HCl(g).
2. For the first reaction in (1), K = 6.5 × 10⁴ at 35 °C. A mixture has [NO] = 0.010 M, [Cl₂] = 0.010 M, [NOCl] = 0.10 M. Which way does it go?
3. At equilibrium a 1.00 L flask holds 0.20 mol PCl₅, 0.10 mol PCl₃ and 0.10 mol Cl₂. Find K for PCl₅ ⇌ PCl₃ + Cl₂.
4. 0.800 M COCl₂ decomposes (COCl₂ ⇌ CO + Cl₂) until [CO] = 0.040 M. Find K.
5. For N₂ + 3 H₂ ⇌ 2 NH₃, how are Kp and Kc related at 500 K?

*Answers:* (1) K = [NOCl]²/([NO]²[Cl₂]); K = [NH₃][HCl]. (2) Q = (0.10)²/((0.010)² × 0.010) = 0.010/10⁻⁶ = 1.0 × 10⁴ < K, so forward. (3) K = (0.10 × 0.10)/0.20 = 0.050. (4) x = 0.040; K = (0.040)²/(0.760) = 2.1 × 10⁻³. (5) Δn = 2 − 4 = −2; Kp = Kc(RT)⁻² = Kc/(0.08206 × 500)² = Kc/1,684.

---

*Original study material written for this course and organised around the College Board AP Chemistry Course and Exam Description (topics 7.1–7.4). Constants and data are public domain, from U.S. government sources (NIST Chemistry WebBook, NIST CODATA constants, PubChem), rounded as the AP equations sheet does. Accessed 2026-10-16.*
