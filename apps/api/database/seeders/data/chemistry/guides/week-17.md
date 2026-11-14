# Week 17 · Kinetic Molecular Theory and the Simple Gas Laws

**Topics:** 5.1 Kinetic Molecular Theory and Pressure · 5.2 Boyle's, Charles's and Gay-Lussac's Laws
**Practices:** 2 (Developing and Using Models), 4 (Analyzing and Interpreting Data), 5 (Using Mathematics and Computational Thinking)
**Spiral:** This week leans on the kelvin scale and the states of matter from week 3 (1.6), unit conversion and significant figures from weeks 2 and 3 (1.4, 1.5), and intermolecular forces from unit 3 (3.6). If you are shaky on converting °C to K or on keeping three significant figures through a calculation, review those first; every gas-law problem uses both.

## What you need to be able to do

- **5.1** Describe a gas using the five statements of kinetic molecular theory (KMT); explain pressure as collisions of particles with the container walls; convert between atm, kPa, torr (mm Hg) and psi; and explain how a barometer and a manometer measure pressure.
- **5.2** State Boyle's, Charles's and Gay-Lussac's laws in words, as proportionalities and as equations; identify which variable is held constant in each; solve for an unknown pressure, volume or temperature; and explain why temperature must be in kelvin.

## Key terms

| Term | Meaning |
|---|---|
| Kinetic molecular theory (KMT) | A model of an ideal gas: tiny particles in constant, random, straight-line motion; no volume of their own; no attractions; elastic collisions; average kinetic energy proportional to kelvin temperature. |
| Pressure | Force per unit area. A gas exerts pressure because its particles hit the walls of the container. |
| Atmosphere (atm) | A pressure unit: 1 atm = 101.3 kPa = 760 torr = 760 mm Hg = 14.7 psi. |
| Pascal (Pa), kilopascal (kPa) | The SI unit of pressure (1 Pa = 1 N/m²). Air pressure at sea level is about 101.3 kPa. |
| Torr / mm Hg | The height of a mercury column a pressure can support; 760 torr = 1 atm. |
| Barometer | A sealed tube of mercury inverted in a dish; the column height reads atmospheric pressure. |
| Manometer | A U-tube that compares a gas sample's pressure with the atmosphere. |
| Standard temperature and pressure (STP) | 0 °C (273.15 K) and 1 atm. |
| Boyle's law | At constant T and n, P₁V₁ = P₂V₂ (pressure and volume are inversely proportional). |
| Charles's law | At constant P and n, V₁/T₁ = V₂/T₂ (volume and kelvin temperature are directly proportional). |
| Gay-Lussac's law | At constant V and n, P₁/T₁ = P₂/T₂ (pressure and kelvin temperature are directly proportional). |
| Absolute zero | 0 K = −273.15 °C, the temperature at which an ideal gas would have zero volume and zero pressure. |
| Elastic collision | A collision in which no kinetic energy is lost; gas particles bounce without slowing down on average. |

## The model behind every gas law (5.1)

A gas is mostly empty space. In a litre of air at room conditions the molecules themselves take up less than a tenth of one percent of the volume; the rest is nothing. Kinetic molecular theory turns that picture into five working assumptions:

1. A gas is made of a huge number of tiny particles whose own volume is negligible compared with the space between them.
2. The particles move constantly, randomly and in straight lines until they collide with something.
3. Collisions between particles, and between particles and the walls, are perfectly elastic: kinetic energy is passed around but never lost.
4. The particles do not attract or repel one another.
5. The average kinetic energy of the particles depends only on the kelvin temperature; it is the same for every gas at the same temperature.

Statement 5 is the one that makes temperature meaningful. Kinetic energy is ½mv², so at a given temperature lighter molecules move faster: at 25 °C a hydrogen molecule averages about 1,900 m/s while an oxygen molecule averages about 480 m/s, yet both carry the same average kinetic energy because the oxygen molecule is sixteen times heavier. Doubling the kelvin temperature doubles the average kinetic energy, which is why the kelvin scale, and not Celsius, appears in every law this week: 0 K means zero kinetic energy, while 0 °C is just the freezing point of water with plenty of molecular motion left.

Pressure is the collective push of those collisions on the walls. Each molecule hitting a wall transfers a little momentum; billions of hits per second on every square centimetre add up to a steady force. Anything that makes collisions more frequent or harder raises the pressure: more molecules, a smaller container, or faster (hotter) molecules.

A real gas obeys the model best when it is hot and dilute, because fast-moving, widely spaced particles barely notice their own size or their weak attractions. Near the condensation point, where intermolecular forces (unit 3) start to matter, the model drifts; that is why water vapour at 100 °C behaves less ideally than helium at 100 °C.

### Measuring and converting pressure

Torricelli's barometer (1643) is a tube of mercury closed at one end, standing upside down in a dish of mercury. Air pushing down on the dish holds up a column of mercury about 760 mm tall at sea level; the space above the column is a vacuum. A higher column means higher air pressure. A manometer is the same idea bent into a U: one arm is open to the air, the other to a gas sample, and the difference in mercury heights is the difference between the sample's pressure and atmospheric pressure.

The conversions all run through 1 atm:

| Unit | Value of 1 atm |
|---|---|
| kilopascal (kPa) | 101.3 kPa |
| torr (= mm Hg) | 760 torr |
| pounds per square inch (psi) | 14.7 psi |
| bar | 1.013 bar |

**Worked example.** A tire gauge reads 32.0 psi above atmospheric pressure on a day when the barometer reads 752 torr. What is the absolute pressure inside the tire in kPa?

1. Convert the gauge reading: 32.0 psi × (101.3 kPa / 14.7 psi) = 220.5 kPa.
2. Convert the atmosphere: 752 torr × (101.3 kPa / 760 torr) = 100.2 kPa.
3. Absolute pressure = gauge + atmospheric = 220.5 + 100.2 = **320.7 kPa**, or 321 kPa to three significant figures.

The trap is forgetting that a gauge reads the *difference* from the atmosphere. The gas law equations need absolute pressure.

**Try it.** Convert 0.850 atm to torr and to kPa.
*Answers:* 0.850 × 760 = 646 torr; 0.850 × 101.3 = 86.1 kPa.

## Boyle's law: squeeze it and the pressure rises (5.2)

Robert Boyle (1662) trapped air in the closed end of a J-shaped tube and poured mercury into the open end. Each time he doubled the pressure, the trapped volume halved. In symbols, at constant temperature and amount of gas,

P₁V₁ = P₂V₂

The product PV is a constant, so pressure and volume are *inversely* proportional: a graph of P against V is a curve that falls away (a hyperbola), and a graph of P against 1/V is a straight line through the origin. KMT explains it directly: halving the volume doubles how often each particle hits a wall, with no change in how hard it hits, so the pressure doubles.

**Worked example.** A scuba diver's lungs hold 4.5 L of air at a depth where the pressure is 2.8 atm. If the diver holds her breath and rises to the surface (1.0 atm), what volume would that air try to occupy?

P₁V₁ = P₂V₂ → V₂ = P₁V₁ / P₂ = (2.8 atm × 4.5 L) / 1.0 atm = **12.6 L**, or 13 L to two significant figures.

That is almost three times the lungs' capacity, which is why divers are trained never to hold their breath while ascending. Temperature stays roughly constant here (the body keeps the air at 37 °C), so Boyle's law is the right tool.

**Try it.** A 250 mL sample of gas at 95.0 kPa is compressed to 175 mL at the same temperature. Find the new pressure.
*Answer:* P₂ = (95.0 kPa × 250 mL) / 175 mL = 136 kPa. Mixed units are fine as long as both volumes are in the same unit and both pressures are in the same unit.

## Charles's law: heat it and it expands (5.2)

Jacques Charles (1787) and Joseph Gay-Lussac (1802) found that every gas expands by the same fraction for the same rise in temperature. A plot of volume against Celsius temperature is a straight line, and extending every such line backwards reaches zero volume at the same point, −273.15 °C. That meeting point is absolute zero, and measuring temperature from it gives the kelvin scale, on which volume and temperature are *directly* proportional:

V₁/T₁ = V₂/T₂ (T in kelvin)

KMT again: warmer particles hit the walls harder and more often; for the pressure to stay the same, the gas must spread out so that each wall receives fewer hits.

**Worked example.** A balloon holds 2.00 L of air at 22 °C. It is taken outside on a −15 °C day. What is its new volume, assuming the pressure does not change?

1. Convert temperatures: T₁ = 22 + 273.15 = 295.15 K; T₂ = −15 + 273.15 = 258.15 K.
2. V₂ = V₁ × T₂/T₁ = 2.00 L × (258.15 / 295.15) = 2.00 × 0.8746 = **1.75 L**.

If you had used Celsius, you would have computed 2.00 × (−15/22), a negative volume, which is the quickest possible proof that the law needs kelvin.

**Try it.** At what Celsius temperature will the same balloon reach 2.50 L?
*Answer:* T₂ = T₁ × V₂/V₁ = 295.15 K × (2.50/2.00) = 368.9 K = 95.8 °C, about 96 °C.

## Gay-Lussac's law: heat a sealed can and the pressure rises (5.2)

Hold the volume fixed, as in a rigid steel cylinder or an aerosol can, and heating the gas raises its pressure in proportion to its kelvin temperature:

P₁/T₁ = P₂/T₂ (T in kelvin)

This is the law behind the warning label on every aerosol can and the reason a tire's pressure rises after a long drive. The KMT story is the same as for Charles's law, except that the walls cannot move, so the harder, more frequent collisions show up as pressure instead of volume.

**Worked example.** A sealed can holds gas at 1.20 atm at 20 °C. It is left in a car where the temperature reaches 60 °C. Find the pressure.

T₁ = 293.15 K, T₂ = 333.15 K. P₂ = P₁ × T₂/T₁ = 1.20 atm × (333.15/293.15) = 1.20 × 1.1364 = **1.36 atm**.

The pressure rises by 14%, not by a factor of 3, because 60 °C is only 14% hotter than 20 °C on the kelvin scale. Students who reason "three times the temperature" are working in the wrong scale.

**Try it.** A gas at 101 kPa and 25 °C is cooled until its pressure in a rigid container is 85.0 kPa. Find the final temperature in °C.
*Answer:* T₂ = 298.15 K × (85.0/101) = 250.9 K = −22.2 °C, about −22 °C.

### Choosing the law

Read the problem for the two variables that change and the one that is held constant:

| Constant | Changing | Law | Relationship |
|---|---|---|---|
| T (and n) | P and V | Boyle | inverse: P₁V₁ = P₂V₂ |
| P (and n) | V and T | Charles | direct: V₁/T₁ = V₂/T₂ |
| V (and n) | P and T | Gay-Lussac | direct: P₁/T₁ = P₂/T₂ |

Words that signal the constant: "at the same temperature" or "isothermal" for Boyle; "the balloon is free to expand", "at constant pressure" or "open to the atmosphere" for Charles; "rigid", "sealed steel", "constant volume" for Gay-Lussac. Next week the three combine into one equation, so learn them as one family with a shared logic rather than as three separate formulas.

## Common mistakes

- Using Celsius in Charles's or Gay-Lussac's law. Convert every temperature to kelvin before touching the equation, and convert back only at the end.
- Treating a gauge pressure as an absolute pressure. Add atmospheric pressure first.
- Mixing units on one side of the equation (torr on the left, kPa on the right). The same unit must appear in P₁ and P₂, and in V₁ and V₂; a factor of 760 then cancels and you do not need to convert at all.
- Forgetting that KMT assumes *no* attractions and *no* particle volume; a question asking why a real gas deviates from the model wants exactly those two assumptions named.
- Reporting 1.7500 L when the data had three significant figures. Carry extra digits while you calculate and round once at the end.

## Where this goes next

Week 18 merges the three laws into the combined gas law and then introduces the ideal gas law, PV = nRT, which brings in the mole from unit 4. Week 19 uses molar volume and the ideal gas law in stoichiometry and adds Dalton's law for mixtures. Week 20 leaves ideal gases behind to look at what happens when intermolecular forces win: condensation, freezing, heating curves and phase diagrams. The pressure units and the kelvin habit from this week are used in every one of those weeks and again in unit 7, where R returns in the gas constant form of equilibrium work.

## Self-check

1. State the two KMT assumptions that fail for a real gas at high pressure and low temperature.
2. Convert 745 torr to atm and to kPa.
3. A gas occupies 3.60 L at 1.00 atm. What volume does it occupy at 1.80 atm, temperature unchanged?
4. A 500 mL balloon at 300 K is warmed to 360 K at constant pressure. New volume?
5. A rigid tank at 2.50 atm and 300 K is cooled to 240 K. New pressure?

*Answers:* (1) Particles have negligible volume; particles do not attract one another. (2) 745/760 = 0.980 atm; 0.980 × 101.3 = 99.3 kPa. (3) 3.60 × 1.00/1.80 = 2.00 L. (4) 500 × 360/300 = 600 mL. (5) 2.50 × 240/300 = 2.00 atm.

---

*Original study material written for this course. Constants and data values are public domain, from U.S. government sources (NIST Chemistry WebBook, NIST CODATA constants, PubChem), rounded for classroom use.*
