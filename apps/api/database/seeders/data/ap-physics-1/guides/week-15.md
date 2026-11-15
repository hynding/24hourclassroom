# Week 15 · Power

**Topics:** 3.5 Power
**Practices:** 1 (Creating Representations: energy–time graphs whose slope is power, tables of power at different speeds), 2 (Mathematical Routines: P = ΔE/Δt, P = W/Δt, P = Fv cos θ, linearising lab data), 3 (Scientific Questioning and Argumentation: predicting how power depends on speed, mass and time)
**Framework:** AP Physics 1: Algebra-Based CED (effective fall 2024), Unit 3, Topic 3.5, learning objectives in our own words
**Spiral:** Week 12 gave you work and the work–energy theorem; week 13 potential energy; week 14 the energy equation for open and closed systems. Newton's second law (week 7) and friction (week 9) supply the forces in this week's problems. Power adds one more question to the energy story: not "how much energy?" but "how fast?"

## What you need to be able to do

- **3.5** Define power as the rate at which energy is transferred or transformed, and compute average power, P_avg = ΔE/Δt = W/Δt.
- **3.5** Compute the instantaneous power delivered by a force, P = Fv cos θ, using the force component along the velocity.
- **3.5** Find power as the slope of an energy–time graph, and energy as the area under a power–time graph.
- **3.5** Distinguish power (W) from energy (J, or kW·h), and explain why the same work done faster needs more power.
- **3.5** Predict how power depends on speed, mass and time, and use limiting cases to check results.
- **3.5** Design and analyse a measurement of power, choosing what to graph for a straight line.

## Key terms

| Term | Meaning |
|---|---|
| Power | The rate at which energy is transferred into, out of or within a system. |
| Average power | The total energy transferred divided by the time taken, ΔE/Δt. |
| Instantaneous power | The power at one instant; for a force, P = Fv cos θ. |
| Watt (W) | The SI unit of power: 1 W = 1 J/s. |
| Kilowatt-hour (kW·h) | A unit of energy, not power: 1 kW for 1 hour = 3.6 × 10⁶ J. |
| Constant speed against resistance | A situation where the driving force equals the resistive force, so all the power goes into internal energy (or U_g on a hill). |

## Equations

| Relation | Symbols and SI units |
|---|---|
| P_avg = ΔE/Δt | P_avg average power (W), ΔE energy transferred or transformed (J), Δt time interval (s) |
| P_avg = W/Δt | W work done by a force or on a system (J) |
| P = F v cos θ | F magnitude of the force (N), v speed (m/s), θ angle between the force and the velocity |
| P = F_∥ v | F_∥ component of the force along the velocity (N) |
| ΔE = area under P versus t | the energy transferred over an interval (J) |
| P = slope of E versus t | the power at an instant, or on average over an interval (W) |

## Power as a rate (3.5)

Two students carry identical boxes up the same staircase. One walks; one runs. They do the same work against gravity and give the box–Earth system the same increase in U_g. What differs is the time, and so the **power**: the runner transfers energy faster.

P_avg = ΔE/Δt.

Power can describe any energy transfer: work done by a force, energy converted by friction, kinetic energy gained by a car. Always say which transfer you mean ("the power the motor delivers to the cab", "the rate at which friction converts kinetic energy into internal energy").

**Worked example 1: running versus walking up the stairs.** A 60 kg student climbs stairs that rise 3.6 m vertically. Running, she takes 4.5 s; walking, she takes 12 s. Find the average power she delivers to raise herself in each case.

- Energy needed either way: ΔU_g = mgΔy = (60)(9.8)(3.6) ≈ 2,117 J.
- Running: P = 2,117 J / 4.5 s ≈ 470 W.
- Walking: P = 2,117 J / 12 s ≈ 176 W.

| Climb | Energy (J) | Time (s) | Power (W) |
|---|---|---|---|
| Run | 2,117 | 4.5 | 470 |
| Walk | 2,117 | 12 | 176 |

Same energy, different power. (Her muscles also produce a lot of thermal energy, so her total metabolic power is several times larger; this is only the useful part.)

**Units.** A watt is a joule per second. A kilowatt-hour is a power multiplied by a time, so it is an **energy**: 1 kW·h = (1,000 J/s)(3,600 s) = 3.6 × 10⁶ J. An electricity bill charges for energy, not power.

## Power and force: P = Fv

If a force F acts along the motion of an object moving at speed v, then in a short time Δt the object moves vΔt and the force does work F(vΔt). Dividing by Δt:

P = Fv (or Fv cos θ when the force is at angle θ to the velocity).

This is the **instantaneous** power. A force perpendicular to the velocity (θ = 90°) delivers no power, just as it does no work.

**Worked example 2: a car on the highway.** A car cruises at a constant 25 m/s on a level road. Air drag and rolling resistance together exert 600 N backward.

- Constant velocity means zero net force, so the road's forward driving force on the car is 600 N.
- Power delivered by the driving force: P = Fv = (600 N)(25 m/s) = 15,000 W = 15 kW.
- All of it is converted into internal energy (of the air and tyres) by the resistive forces; the car's kinetic energy does not change.

**Functional dependence:** suppose air drag dominates and grows with v². At 30 m/s the resistive force becomes 600 × (30/25)² = 864 N, and the power becomes (864)(30) ≈ 25,900 W. A 20% increase in speed needs about 73% more power, because P grows with v³ when drag grows with v². This is why highway fuel use rises sharply with speed.

**Worked example 3: an elevator at two speeds.** A motor lifts an 800 kg elevator cab 20 m at constant speed in 16 s.

- Speed: v = 20/16 = 1.25 m/s. Tension equals weight (constant speed): T = (800)(9.8) = 7,840 N.
- Power: P = Tv = (7,840)(1.25) = 9,800 W. Check with energy: ΔU_g = (800)(9.8)(20) = 156,800 J, and 156,800/16 = 9,800 W.
- **Doubling the speed** (8.0 s for the trip) doubles the power to 19,600 W, but the energy delivered is the same, 156,800 J. **Doubling the mass** at the original speed also doubles the power.
- **Limiting case:** a cab held still (v = 0) needs tension but no power: a force with no motion transfers no energy.

## Average and instantaneous power differ when speed changes

**Worked example 4: a car accelerating from rest.** A 1,200 kg car speeds up from rest to 20 m/s in 8.0 s on a level road with a constant net force. Ignore resistive forces.

- **Average power:** ΔK = ½(1,200)(20)² = 240,000 J, so P_avg = 240,000/8.0 = 30,000 W = 30 kW.
- **Net force:** a = 20/8.0 = 2.5 m/s², F = ma = 3,000 N.
- **Instantaneous power at 20 m/s:** P = Fv = (3,000)(20) = 60,000 W = 60 kW.

The instantaneous power at the end is **twice** the average. With a constant force, P = Fv grows in proportion to v, which grows steadily from 0 to 20 m/s, so the average of P over the interval is half its final value. A power–time graph is a straight line from 0 to 60 kW; the triangle under it has area ½(8.0 s)(60,000 W) = 240,000 J, exactly ΔK.

## Reading power from graphs

On an **energy–time** graph, the slope is the power. On a **power–time** graph, the area is the energy.

**Worked example 5: a winch lifting a crate.** A winch raises a crate. The gravitational potential energy of the crate–Earth system is recorded:

| Time (s) | 0 | 2.0 | 4.0 | 6.0 | 8.0 |
|---|---|---|---|---|---|
| U_g (J) | 0 | 600 | 1,200 | 1,500 | 1,800 |

- From 0 to 4.0 s the slope is 1,200 J / 4.0 s = 300 W.
- From 4.0 to 8.0 s the slope is 600 J / 4.0 s = 150 W: the winch lifted the crate at half the rate (half the speed, if the crate's speed stayed constant within each stretch).
- Average power over the whole 8.0 s: 1,800/8.0 = 225 W.

## Lab: measuring the power of a small motor

**Worked example 6: linearising motor data.** A lab group uses a small electric motor to wind a string and lift different masses through a fixed height h = 1.00 m at constant speed. They time each lift.

| Mass m (kg) | 0.20 | 0.40 | 0.60 | 0.80 | 1.00 |
|---|---|---|---|---|---|
| Time t (s) | 0.41 | 0.79 | 1.22 | 1.58 | 2.03 |

- **Model:** if the motor's output power P is constant, P = mgh/t, so t = (gh/P)m.
- **Graph:** t against m should be a straight line through the origin with slope gh/P. The data fit a line of slope about 2.0 s/kg with an intercept near zero.
- **Interpretation:** P = gh/slope = (9.8)(1.00)/2.0 ≈ 4.9 W.
- **Design notes:** time several lifts per mass and average; start timing after the mass reaches steady speed (use a marked 1.00 m interval above the starting point); if heavier loads slowed the motor's power, the graph would curve upward and the constant-power model would fail.

## Common mistakes

- **Confusing power with energy.** Power is a rate (W = J/s); kW·h is energy.
- **Thinking a more powerful machine always does more work.** It does the same work in less time; how much work depends on the task.
- **Using P = Fv with the wrong force**: for constant velocity on a level road, the driving force equals the resistive force, not mg.
- **Forgetting cos θ.** Only the force component along the velocity delivers power.
- **Treating P = Fv as an average** when the speed changes. With constant force from rest, the average power is half the final instantaneous power.
- **Reading power from the value of an energy–time graph** instead of its slope.

## Self-check

1. A 70 kg hiker climbs 450 m vertically in 1.5 hours. What average power does she deliver to raise herself?
2. A boat's engine drives it at a constant 8.0 m/s against 1,500 N of water resistance. What power does the engine deliver to the boat?
3. A crane lifts a 500 kg load 10 m in 20 s, then a second crane lifts the same load the same height in 10 s. Compare the work and the power.
4. An energy–time graph is a straight line rising 900 J in 3.0 s. What is the power?
5. A 2,000 W kettle runs for 3.0 minutes. How much energy does it use, in joules and in kW·h?
6. A cart is pushed with a constant 10 N force from rest. At 2.0 m/s, what instantaneous power does the push deliver?

*Answers:* 1. (70)(9.8)(450)/5,400 s ≈ 57 W. 2. (1,500)(8.0) = 12,000 W. 3. Same work, 49,000 J; the second crane delivers twice the power (4,900 W versus 2,450 W). 4. 300 W. 5. (2,000)(180) = 360,000 J = 0.10 kW·h. 6. P = Fv = (10)(2.0) = 20 W.

---

*Original study material for this course, organised around the College Board AP Physics 1: Algebra-Based Course and Exam Description (Unit 3, Topic 3.5). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). All lab data are invented. AP® is a trademark of the College Board, which does not endorse this material.*
