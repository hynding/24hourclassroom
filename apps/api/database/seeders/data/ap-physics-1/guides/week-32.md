# Week 32 · Fluids and Conservation Laws

**Topics:** 8.4 Fluids and Conservation Laws
**Practices:** 1 (Creating Representations: energy-per-volume bar charts, linearised outflow graphs), 2 (Mathematical Routines: continuity, Bernoulli's equation, Torricelli's result), 3 (Scientific Questioning and Argumentation: explaining pressure differences in moving fluids, testing a model against data)
**Framework:** AP Physics 1: Algebra-Based CED (effective fall 2024), Unit 8, Topic 8.4, learning objectives in our own words
**Spiral:** Week 29's incompressible fluid makes mass conservation a statement about volume; week 30's P = P₀ + ρgh turns out to be the no-flow case of this week's main equation. Weeks 12–15 built conservation of energy and work; weeks 3–4 treated projectiles. This week reuses all of them for fluids that move.

## What you need to be able to do

- **8.4** Define volume flow rate Q = Av and apply the continuity equation A₁v₁ = A₂v₂ as conservation of mass.
- **8.4** Predict how flow speed depends on a pipe's diameter (functional dependence through area).
- **8.4** State Bernoulli's equation, explain each term as an energy per unit volume, and apply it between two points.
- **8.4** Argue qualitatively that faster flow at the same height has lower pressure, and show it with an energy-per-volume bar chart.
- **8.4** Derive and use Torricelli's result v = √(2gh), and treat the outflow jet as a projectile.
- **8.4** Design and analyse an outflow experiment by choosing what to graph for a straight line.

## Key terms

| Term | Meaning |
|---|---|
| Steady flow | The velocity at each fixed point does not change with time. |
| Streamline | The path a small parcel of fluid follows in steady flow. |
| Volume flow rate Q | Volume passing a cross-section per second, Q = Av, in m³/s. |
| Continuity equation | A₁v₁ = A₂v₂: conservation of mass for an incompressible fluid. |
| Bernoulli's equation | P + ρgy + ½ρv² is constant along a streamline: conservation of energy. |
| Torricelli's result | Outflow speed v = √(2gh) from a hole a depth h below an open surface. |

## Equations

- **Q = Av**: Q in m³/s, A the cross-sectional area (m²), v the flow speed (m/s).
- **A₁v₁ = A₂v₂**, and for a round pipe **v₂/v₁ = (d₁/d₂)²**, d the diameter (m).
- **P₁ + ρgy₁ + ½ρv₁² = P₂ + ρgy₂ + ½ρv₂²**: P the pressure (Pa), ρ the fluid's density (kg/m³), y the height above a chosen reference (m), v the speed (m/s), g = 9.8 m/s². Each term is in Pa, which is the same as J/m³.
- **v = √(2gh)**: outflow speed (m/s) from a hole a depth h (m) below the open surface of a large tank.
- Jet as a projectile: **t = √(2H/g)**, **x = vt**, H the height of the hole above the ground (m).

## Continuity: mass is conserved (8.4)

Picture water flowing steadily through a pipe that changes width. Choose two cross-sections. In one second, a slab of water of volume A₁v₁ crosses the first and a slab of volume A₂v₂ crosses the second. The water between them cannot pile up or vanish, and for an incompressible fluid its density cannot change, so the two volumes must be equal:

A₁v₁ = A₂v₂ = Q.

This is the **continuity equation**, conservation of mass for an incompressible fluid. Where the pipe is narrow the fluid moves fast; where it is wide the fluid moves slowly. A river runs quickly through a narrow gorge and lazily across a wide valley for the same reason.

**Area, not diameter.** For a round pipe A = πd²/4, so the speed depends on the square of the diameter ratio. Halve the diameter and the speed quadruples.

**Worked example 1: a garden hose and nozzle.** Water moves at 2.0 m/s through a hose of inside diameter 1.6 cm and leaves through a nozzle of inside diameter 0.40 cm. How fast does it leave, and how long does it take to fill a 10 L bucket?

- Diameter ratio: 1.6/0.40 = 4, so the area ratio is 16.
- Nozzle speed: v₂ = 2.0 × 16 = 32 m/s.
- Flow rate: Q = A₁v₁ = π(0.0080 m)² × 2.0 m/s ≈ 4.0 × 10⁻⁴ m³/s (0.40 L per second).
- Filling time: t = V/Q = 0.010 m³/4.0 × 10⁻⁴ m³/s ≈ 25 s.

Notice that the nozzle makes the water faster but does **not** change the filling time: Q is the same in the hose and in the nozzle. (In a real hose, a nozzle also changes how the tap and hose behave, but the ideal model keeps Q fixed.)

## Bernoulli's equation: energy is conserved (8.4)

Why does water speed up as it enters a narrow section? Something must push it forward: a net force from higher pressure behind than ahead. So in the narrow, fast section the pressure must be **lower**. Bernoulli's equation makes this exact.

Follow a small parcel of fluid of volume V along a streamline. The surrounding fluid does work on it through the pressure difference, and that work changes its kinetic and gravitational potential energy. Dividing every energy by the parcel's volume gives three terms, each an **energy per unit volume**:

- ½ρv²: kinetic energy per unit volume (½mv² divided by V, with m = ρV);
- ρgy: gravitational potential energy per unit volume (mgy divided by V);
- P: the work done by pressure per unit volume pushed through (P = F/A, and F·d/(A·d) = W/V).

For an ideal fluid (no viscosity, so no energy turns into internal energy) in steady flow, their sum stays the same along a streamline:

**P + ρgy + ½ρv² = constant.**

**Special case: no flow.** With v = 0 everywhere, P + ρgy = constant. Going down a depth h lowers ρgy by ρgh, so P must rise by ρgh: that is week 30's P = P₀ + ρgh. Hydrostatics is Bernoulli's equation for a fluid at rest.

**Worked example 2: a horizontal pipe that narrows.** Water flows through a horizontal pipe at 1.0 m/s where the area is 12 cm² and the pressure is 2.00 × 10⁵ Pa. The pipe narrows to 4.0 cm². Find the speed and pressure in the narrow part, and represent the energy per unit volume.

- Continuity: v₂ = 1.0 × (12/4.0) = 3.0 m/s.
- Bernoulli at equal height: P₂ = P₁ − ½ρ(v₂² − v₁²) = 2.00 × 10⁵ − 500 × (9.0 − 1.0) = 1.96 × 10⁵ Pa.

Energy per unit volume, with y = 0 along the pipe:

| Point | P (J/m³) | ρgy (J/m³) | ½ρv² (J/m³) | Total (J/m³) |
|---|---|---|---|---|
| Wide section | 200 000 | 0 | 500 | 200 500 |
| Narrow section | 196 000 | 0 | 4 500 | 200 500 |

The bar chart's totals agree, and the 4000 J/m³ that the kinetic bar gains is exactly what the pressure bar loses. Functional dependence: tripling the speed multiplied the kinetic term by 9, which is why small changes in area can cause large pressure drops.

**Worked example 3: water pressure upstairs.** In a building, the water in the pipes at basement level has an absolute pressure of 4.00 × 10⁵ Pa. Water flows at the same speed through a pipe of the same size on a floor 12 m higher. Find the pressure there.

- Same speed, so the ½ρv² terms cancel: P₂ = P₁ − ρg(y₂ − y₁).
- P₂ = 4.00 × 10⁵ − 1000 × 9.8 × 12 ≈ 4.00 × 10⁵ − 1.18 × 10⁵ ≈ 2.8 × 10⁵ Pa.

Limiting case: for a floor about 30 m up, the pressure would drop to roughly atmospheric and the tap would barely run; tall buildings use pumps and rooftop tanks.

**Everyday consequences of "fast flow, low pressure".** Wind racing over a roof lowers the pressure above it while the still air inside stays at atmospheric pressure, so the net force on the roof is upward. Air blown between two hanging ping-pong balls pushes them together, not apart. A shower curtain drifts inward when the water runs.

## Torricelli's result and outflow jets (8.4)

Punch a hole in the side of an open tank, a depth h below the surface. Apply Bernoulli between a point on the surface (pressure P₀, speed nearly zero if the tank is wide, height h above the hole) and a point in the jet just outside the hole (pressure P₀, speed v, height 0):

P₀ + ρgh + 0 = P₀ + 0 + ½ρv², so **v = √(2gh)**.

The water leaves at the speed it would have gained falling freely through h. P₀ cancels and so does ρ: oil and water flow out at the same speed. Functional dependence: v ∝ √h, so four times the depth gives twice the speed. As a tank drains, h falls and the outflow slows.

**Worked example 4: a leaking water tower.** A water tank on a stand has a small horizontal leak 3.2 m above level ground; the water surface is 5.0 m above the leak. Where does the jet land?

- Exit speed: v = √(2 × 9.8 × 5.0) ≈ 9.9 m/s, horizontal.
- Fall time (a horizontal projectile, week 4): t = √(2 × 3.2/9.8) ≈ 0.81 s.
- Range: x = vt ≈ 9.9 × 0.81 ≈ 8.0 m.
- Symbolic check: x = √(2gh) × √(2H/g) = 2√(hH) = 2√(5.0 × 3.2) = 8.0 m. The g cancels, and the range is zero if either h or H is zero, as it must be.

**Worked example 5: testing Torricelli in the lab.** A lab group keeps the water in a bottle at a chosen height h above a small hole that is H = 0.30 m above a table, and measures where the horizontal jet lands (invented data):

| h (m) | 0.10 | 0.15 | 0.20 | 0.25 | 0.30 |
|---|---|---|---|---|---|
| Range x (m) | 0.34 | 0.41 | 0.48 | 0.54 | 0.59 |
| x² (m²) | 0.116 | 0.168 | 0.230 | 0.292 | 0.348 |

- Model: x = 2√(hH), so x² = 4H·h. A graph of x² against h should be a straight line through the origin with slope 4H = 1.20 m.
- Slope from the end points: (0.348 − 0.116)/(0.30 − 0.10) ≈ 1.16 m; a least-squares fit gives 1.18 m, with an intercept near zero.
- Interpretation: the measured slope is about 98% of the prediction. The small shortfall fits a little energy lost to viscosity at the hole, which the ideal model leaves out. Graphing x against h would curve and hide this comparison.

## Common mistakes

- **Using the diameter ratio instead of its square** in continuity.
- **"Narrow means high pressure."** In steady flow the narrow, fast section has the lower pressure.
- **Treating Q as changing** when a pipe narrows: the speed changes, the flow rate does not.
- **Dropping the factor of 2 or the square root** in v = √(2gh).
- **Including the liquid's density in Torricelli's speed.** It cancels.
- **Mixing Bernoulli points that are not on one streamline**, or across a pump.
- **Forgetting ½ρv₁²** when the fluid is already moving at the first point.

## Self-check

1. Water flows at 0.80 m/s in a pipe of area 50 cm². What is the flow rate, and the speed where the area is 10 cm²?
2. A pipe's diameter doubles. What happens to the flow speed?
3. Air flows faster over the top of a sign than behind it. Which way is the net force from the air?
4. Water leaves a hole 0.20 m below an open surface. How fast?
5. Water flows at 2.0 m/s in a horizontal pipe at 1.5 × 10⁵ Pa, then speeds up to 4.0 m/s. Find the new pressure.
6. Water at constant speed rises 6.0 m in a pipe. By how much does its pressure drop?

*Answers:* 1. Q = 0.0050 × 0.80 = 4.0 × 10⁻³ m³/s; v = 4.0 m/s. 2. It becomes one quarter. 3. Toward the faster flow (the lower pressure side). 4. v = √(2 × 9.8 × 0.20) ≈ 2.0 m/s. 5. P = 1.5 × 10⁵ − 500 × (16 − 4) = 1.44 × 10⁵ Pa. 6. ρgΔy = 1000 × 9.8 × 6.0 ≈ 5.9 × 10⁴ Pa.

---

*Original study material for this course, organised around the College Board AP Physics 1: Algebra-Based Course and Exam Description (Unit 8, Topic 8.4). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). All lab data are invented. AP® is a trademark of the College Board, which does not endorse this material.*
