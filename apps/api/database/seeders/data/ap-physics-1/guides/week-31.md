# Week 31 · Fluids and Newton's Laws

**Topics:** 8.3 Fluids and Newton's Laws
**Practices:** 1 (Creating Representations: free-body diagrams of floating, submerged and suspended objects), 2 (Mathematical Routines: Archimedes' principle, Newton's laws, fraction submerged), 3 (Scientific Questioning and Argumentation: predicting scale readings, functional-dependence arguments)
**Framework:** AP Physics 1: Algebra-Based CED (effective fall 2024), Unit 8, Topic 8.3, learning objectives in our own words
**Spiral:** Week 29 gave density and average density; week 30 gave P = P₀ + ρgh. Weeks 5–7 built free-body diagrams, Newton's first and second laws and third-law pairs. This week the buoyant force joins the list of forces, and every buoyancy problem becomes a Newton's-law problem you already know how to solve.

## What you need to be able to do

- **8.3** Explain the buoyant force as the net force from a fluid's pressure, larger on the bottom of an object than on its top.
- **8.3** Use Archimedes' principle, F_b = ρ_fluid V_displaced g, choosing the right density and the right volume.
- **8.3** Draw free-body diagrams for floating, fully submerged, string-held and spring-scale-supported objects, and apply Newton's first and second laws.
- **8.3** Predict whether an object sinks, floats or hovers, and the fraction of a floating object that is submerged.
- **8.3** Identify the third-law partner of the buoyant force and use it to predict scale readings.
- **8.3** Reason about functional dependence: depth, fluid density, object density, volume.

## Key terms

| Term | Meaning |
|---|---|
| Buoyant force F_b | The net upward force a fluid exerts on an object in it. |
| Displaced volume | The volume of fluid pushed aside: the submerged part of the object. |
| Archimedes' principle | F_b equals the weight of the displaced fluid, ρ_fluid V_displaced g. |
| Apparent weight | The reading of a scale supporting an object in a fluid: mg − F_b. |
| Neutral buoyancy | Average density equal to the fluid's: the object stays where it is put. |
| Fraction submerged | For a floating object, V_sub/V = ρ_object/ρ_fluid. |

## Equations

- **F_b = ρ_fluid V_displaced g**: F_b in N, ρ_fluid the fluid's density (kg/m³), V_displaced the submerged volume (m³), g = 9.8 m/s².
- **F_g = mg = ρ_object V g**: the object's weight, with ρ_object its (average) density and V its whole volume.
- **Floating at rest: F_b = mg**, so **V_sub/V = ρ_object/ρ_fluid**.
- **Hanging from a scale underwater: T = mg − F_b**.
- **Held under by a string: T = F_b − mg = (ρ_fluid − ρ_object)Vg**.
- **Released underwater: a = (F_b − mg)/m = g(ρ_fluid/ρ_object − 1)**, positive meaning upward, drag ignored.

## Where the buoyant force comes from (8.3)

Put any object in a fluid. The fluid pushes perpendicular to every part of its surface, and the push is stronger deeper down. The sideways pushes cancel in pairs, but the upward push on the bottom beats the downward push on the top. The difference is the **buoyant force**.

**Worked example 1: a brick under water.** A brick 0.20 m × 0.10 m × 0.050 m lies flat in a pond, its top face 0.30 m below the surface (so its bottom face is 0.35 m down). Find the net force of the water on it.

- Top face area: A = 0.20 × 0.10 = 0.020 m².
- Gauge pressure on top: ρgh = 1000 × 9.8 × 0.30 = 2940 Pa, pushing down. On the bottom: 1000 × 9.8 × 0.35 = 3430 Pa, pushing up. (The atmosphere adds equally to both and cancels.)
- Net upward force: (3430 − 2940) × 0.020 = 490 × 0.020 = 9.8 N.
- Check with Archimedes: V = 0.20 × 0.10 × 0.050 = 1.0 × 10⁻³ m³, and ρ_water V g = 1000 × 1.0 × 10⁻³ × 9.8 = 9.8 N. They agree, as they must, because ΔP × A = ρg(height)(area) = ρgV.

Two consequences follow at once. **Depth does not matter** for a fully submerged object in an incompressible fluid: lower the brick another metre and both pressures rise by the same ρg(1 m), so their difference is unchanged. And **the object's material does not matter**: the calculation never used the brick's density. If the brick (density about 2000 kg/m³, weight 19.6 N) rests on the bottom, its free-body diagram has F_g = 19.6 N down, F_b = 9.8 N up and a normal force of 9.8 N up from the pond floor.

## Archimedes' principle and floating (8.3)

The result generalises to any shape: **the buoyant force equals the weight of the fluid displaced**, F_b = ρ_fluid V_displaced g. Imagine the object replaced by fluid of the same shape: that fluid would sit at rest, so the surrounding fluid must push up on it with exactly its weight. The surrounding fluid does not know what is inside the shape, so it pushes on the object the same way.

Two choices decide every calculation:

- **Which density?** The fluid's. The object's density goes into its weight.
- **Which volume?** The volume below the surface: the whole object if it is fully submerged, only the submerged part if it floats.

**Sink, float or hover.** For a fully submerged object, compare F_b = ρ_fluid V g with mg = ρ_object V g. The common factor Vg cancels, so the comparison is simply one of densities. If ρ_object (the average density, air spaces included) is greater than ρ_fluid, the object sinks; if less, it rises and floats partly submerged; if equal, it is neutrally buoyant.

**Floating at rest** is Newton's first law with two forces: a downward arrow F_g = mg and an upward arrow F_b of equal length. So ρ_fluid V_sub g = ρ_object V g, and

V_sub/V = ρ_object/ρ_fluid.

**Worked example 2: ice and icebergs.** An ice cube (917 kg/m³) floats in fresh water: V_sub/V = 917/1000 ≈ 0.92, so 92% is below the surface. An iceberg in sea water (1025 kg/m³): 917/1025 ≈ 0.89, so 89% is hidden. Functional dependence: a denser fluid gives a smaller submerged fraction, which is why you float more easily in salty water. Limiting case: if ρ_object = ρ_fluid, the fraction is 1, the object is just fully submerged and hovers.

Note what does **not** change when a floating object moves to a denser liquid: the buoyant force. It still equals the weight. Only the submerged volume adjusts.

## Apparent weight and suspended objects (8.3)

Hang an object from a spring scale and lower it into water. The free-body diagram now has three forces: tension T up (the scale's reading), buoyant force F_b up and weight mg down. At rest, T = mg − F_b. The object weighs less on the scale, but its true weight has not changed.

**Worked example 3: finding a sinker's density.** A fishing sinker reads 3.40 N on a spring scale in air and 2.96 N fully submerged in water.

- Buoyant force: F_b = 3.40 − 2.96 = 0.44 N.
- Volume: V = F_b/(ρ_water g) = 0.44/(1000 × 9.8) ≈ 4.5 × 10⁻⁵ m³.
- Density: ρ = m/V = (3.40/9.8)/4.5 × 10⁻⁵ ≈ 7.7 × 10³ kg/m³.
- Shortcut: ρ/ρ_water = (weight in air)/(loss of weight) = 3.40/0.44 ≈ 7.7, the same answer with g and V cancelled.

The result is close to iron or steel. Because the loss of weight is small, a 0.01 N reading error changes F_b by over 2%: in a lab, use a sensitive scale.

**Held under by a string.** A cork or a wooden block tied to the bottom of a tank has F_b up, and both its weight and the string's tension down. At rest, T = F_b − mg = (ρ_fluid − ρ_object)Vg.

## Objects accelerating in a fluid (8.3)

When the forces do not balance, use Newton's second law. Just after release, before the object picks up speed (so drag is still negligible):

a = (F_b − mg)/m = g(ρ_fluid/ρ_object − 1).

**Worked example 4: a ball held under and released.** A hollow plastic ball of volume 5.0 × 10⁻⁴ m³ and mass 0.40 kg (average density 800 kg/m³) is held fully under water, then let go.

| Force on the ball | Direction | Size |
|---|---|---|
| Buoyant force, ρ_water V g | up | 1000 × 5.0 × 10⁻⁴ × 9.8 = 4.9 N |
| Weight, mg | down | 0.40 × 9.8 = 3.92 N |
| Hand (before release) | down | 4.9 − 3.92 ≈ 0.98 N |

- While held: the hand pushes down with 0.98 N so the net force is zero.
- Just after release: F_net = 4.9 − 3.92 = 0.98 N up, so a = 0.98/0.40 ≈ 2.5 m/s² upward. The formula agrees: 9.8 × (1000/800 − 1) = 2.45 m/s².
- As the ball speeds up, drag grows and the acceleration falls; at the surface the ball rises partly out of the water and settles where F_b = mg, with 80% submerged.
- Limiting cases: a ball of density 1000 kg/m³ has a = 0 (neutral buoyancy); a very light ball has a huge initial acceleration, limited in reality by drag.

For a dense object the same formula gives a negative value: a steel ball (7900 kg/m³) starts downward at 9.8 × (1 − 1000/7900) ≈ 8.6 m/s², less than g.

## The third-law partner and scale readings (8.3)

The water pushes up on a submerged object with F_b; by Newton's third law, the object pushes down on the water with a force of the same size. That partner acts on the water, so it never appears on the object's free-body diagram, but it does appear on a scale under the container.

**Worked example 5: a block lowered into a beaker on a scale.** A beaker of water on an electronic scale reads 9.00 N. A 0.89 kg copper cylinder (8900 kg/m³) hangs from a spring scale and is lowered until fully submerged, not touching the beaker.

- Copper's weight: 0.89 × 9.8 ≈ 8.72 N. Volume: 0.89/8900 = 1.0 × 10⁻⁴ m³.
- Buoyant force: 1000 × 1.0 × 10⁻⁴ × 9.8 = 0.98 N.
- Spring scale: 8.72 − 0.98 ≈ 7.74 N.
- Electronic scale: 9.00 + 0.98 = 9.98 N, because the cylinder pushes down on the water with 0.98 N.
- System check: treat beaker, water and cylinder as one system. The two scales together must support its whole weight: 7.74 + 9.98 = 17.72 N = 9.00 + 8.72 N. They do.

If the string is cut and the cylinder rests on the bottom, the electronic scale reads the full 9.00 + 8.72 = 17.72 N.

## Common mistakes

- **Using the object's density in F_b.** Archimedes' principle uses the fluid's density.
- **Using the whole volume for a floating object.** Only the submerged part displaces fluid.
- **"Sinking objects feel no buoyant force."** They do; it is smaller than their weight.
- **"Floating means F_b is bigger than the weight."** At rest, the two are equal.
- **Thinking deeper means more buoyancy** for a rigid, fully submerged object.
- **Putting the object's push on the water on the object's diagram**, or forgetting it when predicting a scale reading.
- **Drawing tension upward** for a string that ties an object to the bottom of a tank.

## Self-check

1. What is the buoyant force on a 2.0 × 10⁻³ m³ rock fully submerged in sea water (1025 kg/m³)?
2. A cube of density 450 kg/m³ floats in water. What fraction is above the surface?
3. A 6.0 N object reads 4.0 N fully submerged in a liquid. Find the buoyant force and the object's density if the liquid is water.
4. A foam block of volume 3.0 × 10⁻³ m³ and density 100 kg/m³ is tied under water. What is the tension in the string?
5. A floating duck toy is moved from water into oil (900 kg/m³) and still floats. What happens to the buoyant force and to its depth?
6. A block on a spring scale is lowered fully into a beaker on a balance. The spring scale reading drops by 1.5 N. What happens to the balance reading?

*Answers:* 1. F_b = 1025 × 2.0 × 10⁻³ × 9.8 ≈ 20 N. 2. 45% submerged, so 55% above. 3. F_b = 2.0 N; ρ = 1000 × 6.0/2.0 = 3000 kg/m³. 4. T = (1000 − 100) × 3.0 × 10⁻³ × 9.8 ≈ 26 N. 5. The buoyant force is unchanged (still equal to the weight); the toy floats lower, because oil is less dense. 6. It rises by 1.5 N, the third-law partner of the buoyant force.

---

*Original study material for this course, organised around the College Board AP Physics 1: Algebra-Based Course and Exam Description (Unit 8, Topic 8.3). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). All lab data are invented. AP® is a trademark of the College Board, which does not endorse this material.*
