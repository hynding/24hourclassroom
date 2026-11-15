# Week 30 · Pressure

**Topics:** 8.2 Pressure
**Practices:** 1 (Creating Representations: free-body diagram of a fluid column, pressure–depth graphs), 2 (Mathematical Routines: P = F/A, P = P₀ + ρgh, hydraulic ratios), 3 (Scientific Questioning and Argumentation: explaining the container-shape paradox, analysing sensor data)
**Framework:** AP Physics 1: Algebra-Based CED (effective fall 2024), Unit 8, Topic 8.2, learning objectives in our own words
**Spiral:** Week 29 defined density and the ideal-fluid model. Weeks 5–7 taught free-body diagrams and Newton's first law for a system at rest; this week applies exactly that to a column of fluid. Week 13's work as force times distance returns in the hydraulic lift.

## What you need to be able to do

- **8.2** Define pressure as perpendicular force per area and compute it in pascals, converting areas correctly.
- **8.2** Explain why a fluid at rest pushes perpendicular to every surface and equally in all directions at a point.
- **8.2** Derive P = P₀ + ρgh from a free-body diagram of a column of fluid, and use it.
- **8.2** Distinguish absolute and gauge pressure.
- **8.2** Argue that the pressure at a depth does not depend on the shape of the container or the amount of fluid.
- **8.2** Apply Pascal's principle to hydraulic systems, including the work check.
- **8.2** Analyse pressure–depth data and U-tube readings.

## Key terms

| Term | Meaning |
|---|---|
| Pressure P | Perpendicular force per unit area, P = F⊥/A, a scalar, in pascals (Pa = N/m²). |
| Atmospheric pressure P₀ | Pressure of the air at Earth's surface, about 1.0 × 10⁵ Pa. |
| Absolute pressure | Total pressure, including the atmosphere's. |
| Gauge pressure | Pressure above atmospheric, P − P₀; in an open liquid, ρgh. |
| Hydrostatic | Describes a fluid at rest. |
| Pascal's principle | A pressure change in an enclosed fluid is transmitted undiminished to all of it. |
| Manometer | A U-tube of liquid whose level difference measures a pressure difference. |

## Equations

- **P = F⊥/A**: P is pressure (Pa), F⊥ the force perpendicular to the surface (N), A the area (m²).
- **P = P₀ + ρgh**: P is the absolute pressure at depth h (m) below the surface of a liquid of density ρ (kg/m³) at rest; P₀ is the pressure at the surface (Pa); g = 9.8 m/s².
- **P_gauge = P − P₀ = ρgh**.
- **F₁/A₁ = F₂/A₂**: hydraulic pistons at the same height (forces in N, areas in m²).
- **A₁d₁ = A₂d₂**: an incompressible fluid's volume is unchanged, so piston displacements d (m) are in inverse ratio to areas.
- Conversions: 1 cm² = 10⁻⁴ m²; 1 kPa = 10³ Pa.

## Pressure as force per area (8.2)

When a fluid touches a surface, its particles strike the surface and bounce off, each collision giving a tiny push. The total push per square metre is the **pressure**:

P = F⊥/A.

Three features matter:

1. **Pressure is a scalar.** It has a size but no direction. The force it produces on a surface always points perpendicular to that surface, pushing on it.
2. **A fluid at rest pushes perpendicular to every wall.** A force along the wall would need friction (viscosity), and an ideal fluid at rest has none.
3. **At any one point in a fluid at rest, the pressure is the same in every direction.** A tiny cube of fluid there is in equilibrium, so the pushes on opposite faces must balance.

**Worked example 1: boots versus snowshoes.** A 70 kg hiker stands on soft snow. Each boot sole has an area of 0.025 m²; each snowshoe has an area of 0.20 m². Compare the pressures on the snow.

- Weight: F = mg = 70 × 9.8 = 686 N, shared by two feet.
- Boots: A = 2 × 0.025 = 0.050 m², P = 686/0.050 ≈ 1.4 × 10⁴ Pa.
- Snowshoes: A = 2 × 0.20 = 0.40 m², P = 686/0.40 ≈ 1.7 × 10³ Pa.
- Ratio: the area is 8 times larger, so the pressure is 8 times smaller.

The force on the snow is the same, 686 N, in both cases (Newton's first law for the hiker). Only the pressure changes, and it is pressure that decides whether the snow gives way. Functional dependence: at fixed force, P ∝ 1/A.

Watch the units. 1 cm² = (0.01 m)² = 10⁻⁴ m², so a 1.0 cm² heel carrying 588 N exerts 5.9 × 10⁶ Pa, not 5.9 × 10⁴ Pa.

## Pressure and depth (8.2)

Why does pressure increase as you go deeper? Because the fluid below has to hold up the fluid above.

**The column derivation.** Imagine a vertical cylinder of liquid of cross-sectional area A, extending from the surface down to depth h, inside a larger body of the same liquid at rest. Treat the cylinder as the system. Its free-body diagram has three vertical forces:

- a downward arrow on the top face labelled P₀A (the air, or whatever is above, pushing down);
- a downward arrow from its centre labelled F_g = mg = ρAhg (its weight, using m = ρV and V = Ah);
- an upward arrow on the bottom face labelled PA (the liquid below pushing up).

The sideways pushes on the curved side cancel in pairs. The column is at rest, so the net force is zero:

PA = P₀A + ρAhg, and dividing by A, **P = P₀ + ρgh**.

The area cancels, which is the first sign that the shape of the container cannot matter.

**Absolute and gauge pressure.** P is the **absolute** pressure. The part due to the liquid, ρgh, is the **gauge** pressure, the amount by which the pressure exceeds atmospheric. A tyre gauge reads gauge pressure; a barometer and an absolute pressure sensor read absolute pressure. Gauge pressure can be negative, as inside a straw while you sip; absolute pressure cannot.

**Worked example 2: a diver in sea water.** A diver is 15 m below the surface of the sea (ρ = 1025 kg/m³), with P₀ = 1.0 × 10⁵ Pa.

- Gauge pressure: ρgh = 1025 × 9.8 × 15 ≈ 1.5 × 10⁵ Pa.
- Absolute pressure: P = 1.0 × 10⁵ + 1.5 × 10⁵ ≈ 2.5 × 10⁵ Pa, about two and a half atmospheres.
- Functional dependence: at 30 m the gauge pressure doubles to 3.0 × 10⁵ Pa, but the absolute pressure rises to 4.0 × 10⁵ Pa, which is not double. Doubling h doubles only the part that depends on h.
- Limiting case: at h = 0, P = P₀, as it must be at the open surface.

A handy figure: every 10.2 m of fresh water (about 10 m of sea water) adds one atmosphere.

**The container-shape paradox.** Fill a narrow vase, a wide bowl and a flask that flares outward to the same depth. The pressure at the bottom is P₀ + ρgh in each, even though the bowl holds far more water. The bowl's extra water is spread over a larger floor, so the force on its floor is larger but the force per square metre is not. In a flask with sloping walls, the walls themselves push on the water and carry part of its weight. The rule that settles every such question: **in one connected body of liquid at rest, all points at the same depth have the same pressure.** That is why water in connected tubes rises to the same level whatever their shapes.

**Worked example 3: a pressure-sensor lab.** A lab group lowers an absolute pressure sensor into a tank of salt water and records (invented data):

| Depth h (m) | 0.05 | 0.10 | 0.15 | 0.20 | 0.25 |
|---|---|---|---|---|---|
| Absolute pressure (kPa) | 101.6 | 102.0 | 102.6 | 103.1 | 103.6 |

- Representation: P = P₀ + ρgh is linear in h, so plot P (vertical) against h (horizontal).
- Slope from the end points: (103.6 − 101.6) kPa/(0.25 − 0.05) m = 10.0 kPa/m = 1.00 × 10⁴ Pa/m; a least-squares fit gives 10.2 kPa/m.
- Density: slope = ρg, so ρ = 1.00 × 10⁴/9.8 ≈ 1020 kg/m³ (the fit gives about 1040 kg/m³), consistent with salt water.
- Intercept: about 101.1 kPa, the atmospheric pressure that day.

A denser liquid would give a steeper line with the same intercept; a day of higher air pressure would shift the line up without changing its slope.

## Pascal's principle and hydraulics (8.2)

P = P₀ + ρgh says that if the pressure at the surface goes up by some amount, the pressure at every depth goes up by exactly the same amount. For an enclosed liquid this is **Pascal's principle**: a pressure change applied anywhere in an enclosed incompressible fluid is transmitted undiminished to every part of it.

A **hydraulic lift** uses this. Push down on a small piston of area A₁ with force F₁; the pressure rises by F₁/A₁ everywhere in the oil, so a large piston of area A₂ at the same height is pushed up with F₂ = (F₁/A₁)A₂. The force is multiplied by the area ratio A₂/A₁ (the square of the radius ratio for round pistons).

**The work check.** No machine creates energy. The oil is incompressible, so the volume pushed out of the small cylinder equals the volume added under the large piston: A₁d₁ = A₂d₂. The small piston moves farther by exactly the factor that its force is smaller, so F₁d₁ = F₂d₂: work in equals work out.

**Worked example 4: a garage lift.** A hydraulic lift has a small piston of area 5.0 cm² and a large piston of area 400 cm², at the same height. The car and platform together have a mass of 1200 kg.

- Area ratio: 400/5.0 = 80 (the units cancel, so no conversion is needed for a ratio).
- Input force: F₁ = mg/80 = 1200 × 9.8/80 = 147 N, about the weight of a 15 kg bag.
- To raise the car 0.10 m: d₁ = 80 × 0.10 = 8.0 m of total small-piston travel (many strokes of a pump).
- Work check: output = 11 760 N × 0.10 m = 1176 J; input = 147 N × 8.0 m = 1176 J. They agree.
- Limiting case: with equal pistons (ratio 1) the lift is just a tube, and F₁ = F₂.

## U-tubes and straws (8.2)

An open **U-tube** with one liquid in it has both surfaces at the same height. Pour a less dense liquid that does not mix (oil) into one arm, and the surfaces no longer line up. At the level of the oil–water interface, the two arms are joined by water at rest, so the pressures there are equal:

P₀ + ρ_oil g h_oil = P₀ + ρ_water g h_water.

**Worked example 5: oil on water.** A 0.20 m column of oil (900 kg/m³) sits on the water in one arm of an open U-tube.

- h_water = (ρ_oil/ρ_water)h_oil = 0.90 × 0.20 = 0.18 m of water above the interface level in the other arm.
- The oil's surface is 0.20 − 0.18 = 0.020 m = 2.0 cm higher than the water's.
- Reasoning check: the less dense oil needs a taller column to produce the same pressure, so its surface must be higher. If the oil had the density of water, the difference would be zero.

The same logic measures an unknown density: measure both column heights, then ρ_oil = ρ_water h_water/h_oil.

**Straws.** Sucking on a straw lowers the pressure inside it. The atmosphere, pushing on the drink's open surface, now pushes harder than the air in the straw, and the drink rises until the extra ρgh of liquid in the straw makes up the difference. Even a perfect vacuum could raise water only about 10 m.

## Common mistakes

- **Converting cm² to m² with 10⁻²** instead of 10⁻⁴.
- **Using mass instead of weight** in P = F/A.
- **Mixing absolute and gauge pressure.** Read whether the question wants the total or the amount above atmospheric; use the pressure difference for the net force on a wall with air on the other side.
- **Thinking more fluid means more pressure.** Only depth (and ρ, g, P₀) matters.
- **Giving pressure a direction**, or drawing a fluid's force along a wall.
- **Using the radius ratio** instead of the area ratio in a hydraulic lift.
- **Thinking a hydraulic lift multiplies energy.** It trades a smaller force for a longer distance.

## Self-check

1. A 2.0 kg book lies flat on a desk, covering 0.060 m². What pressure does it exert on the desk?
2. What is the gauge pressure 3.0 m below the surface of a pool? The absolute pressure?
3. A pressure-depth graph for a liquid has slope 7.8 kPa/m. What is the liquid's density?
4. A hydraulic jack has pistons of radius 1.0 cm and 6.0 cm. What force on the small piston lifts 9000 N?
5. Why does a tall, thin tube of water 3.0 m high produce the same pressure at its base as a 3.0 m deep pool?
6. In an open U-tube, a 12 cm column of an unknown liquid balances 15 cm of water above the interface. What is the liquid's density?

*Answers:* 1. P = 19.6/0.060 ≈ 330 Pa. 2. ρgh = 1000 × 9.8 × 3.0 ≈ 2.9 × 10⁴ Pa; absolute ≈ 1.3 × 10⁵ Pa. 3. ρ = 7800/9.8 ≈ 800 kg/m³. 4. Area ratio 36, so F₁ = 9000/36 = 250 N. 5. Pressure depends only on depth below the surface (P = P₀ + ρgh); the pool's extra weight rests on extra floor area. 6. ρ = 1000 × 15/12 = 1250 kg/m³.

---

*Original study material for this course, organised around the College Board AP Physics 1: Algebra-Based Course and Exam Description (Unit 8, Topic 8.2). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). All lab data are invented. AP® is a trademark of the College Board, which does not endorse this material.*
