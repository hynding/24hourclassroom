# Unit 8 · Fluids · The night-before sheet

**AP exam weight:** 10–15% of the multiple-choice section, and fluids can appear in any of the four free-response types
**Topics:** 8.1 Internal Structure and Density · 8.2 Pressure · 8.3 Fluids and Newton's Laws · 8.4 Fluids and Conservation Laws
**Practices:** 1 (Creating Representations), 2 (Mathematical Routines), 3 (Scientific Questioning and Argumentation)
**Framework:** AP Physics 1: Algebra-Based CED (effective fall 2024), Unit 8, Topics 8.1–8.4, in our own words

## The ideas that generate every question

1. **A fluid is a model (8.1).** Liquids and gases flow. AP Physics 1 uses the ideal fluid: incompressible (constant density), nonviscous (no energy lost to internal friction) and in steady flow. Liquids fit well; a gas being compressed does not.
2. **Density belongs to the material (8.1).** ρ = m/V. Cutting, scaling or reshaping a sample changes m and V together and leaves ρ alone. Hollow and composite objects have an average density, total mass over total enclosed volume, and that is what decides floating.
3. **Pressure is force per area, and it grows with depth (8.2).** P = F⊥/A is a scalar; a fluid at rest pushes perpendicular to every surface and equally in all directions at a point. A column of fluid must hold up the fluid above it, so P = P₀ + ρgh. Only depth matters, not the container's shape.
4. **Pressure changes spread through an enclosed liquid (8.2).** Pascal's principle: a hydraulic lift multiplies force by the area ratio and divides distance by the same ratio, so the work in equals the work out.
5. **Buoyancy is a pressure difference, and floating is Newton's first law (8.3).** The fluid pushes harder on the bottom than the top: F_b = ρ_fluid V_displaced g. Every buoyancy problem is a free-body diagram plus ΣF = 0 or ΣF = ma, and the object's push on the fluid is the third-law partner that shows up on a scale.
6. **Flow conserves mass (8.4).** For an incompressible fluid A₁v₁ = A₂v₂: narrow means fast.
7. **Flow conserves energy (8.4).** Bernoulli's equation, P + ρgy + ½ρv² = constant along a streamline, is energy per unit volume. Fast flow at the same height means low pressure. With no flow it becomes P = P₀ + ρgh; for a hole in an open tank it gives v = √(2gh).

## Equations and what each symbol means

| Relation | Symbols and units |
|---|---|
| ρ = m/V | density (kg/m³), mass (kg), volume (m³) |
| P = F⊥/A | pressure (Pa = N/m²), perpendicular force (N), area (m²) |
| P = P₀ + ρgh | absolute pressure at depth h (m); P₀ at the surface; P_gauge = ρgh |
| F₁/A₁ = F₂/A₂ and A₁d₁ = A₂d₂ | hydraulic pistons at equal height |
| F_b = ρ_fluid V_displaced g | buoyant force (N); fluid density; submerged volume |
| V_sub/V = ρ_object/ρ_fluid | floating at rest |
| Q = Av and A₁v₁ = A₂v₂ | volume flow rate (m³/s), area (m²), speed (m/s) |
| P₁ + ρgy₁ + ½ρv₁² = P₂ + ρgy₂ + ½ρv₂² | Bernoulli; every term in Pa = J/m³ |
| v = √(2gh) | outflow from a hole a depth h below an open surface |

Conversions that cost points: 1 g/cm³ = 1000 kg/m³; 1 cm² = 10⁻⁴ m²; 1 L = 10⁻³ m³; 1 kPa = 10³ Pa. Values: ρ_water = 1000 kg/m³, P₀ = 1.0 × 10⁵ Pa, g = 9.8 m/s². Every 10.2 m of water adds one atmosphere.

## Representations to know

**Free-body diagrams.** Floating at rest: F_g down, F_b up, equal lengths. Hanging from a spring scale underwater: T and F_b up, F_g down, T = mg − F_b. Tied under by a string to the bottom: F_b up, F_g and T down, T = F_b − mg. Resting on the bottom: F_b and F_N up, F_g down. The object's push on the fluid never goes on the object's diagram.

**A column of fluid.** P₀A down on top, ρAhg down (weight), PA up on the bottom: the derivation of P = P₀ + ρgh. Expect to reproduce it.

**Energy per unit volume bar charts.** Bars for P, ρgy and ½ρv² at two points, with equal totals. A horizontal pipe that narrows: the ½ρv² bar grows and the P bar shrinks by the same amount. A pipe that rises at constant area: ρgy grows, P shrinks, ½ρv² unchanged.

**Linearised lab graphs.**

| Experiment | Graph | Slope | Intercept |
|---|---|---|---|
| Mass of samples of one material | m against V | ρ | 0 (or a container's mass) |
| Pressure sensor lowered into a liquid | P against h | ρg | P₀ |
| Spring scale, object lowered gradually | T against submerged depth d | −ρ_fluid g A | the object's weight |
| Outflow speed from a hole | v² against h | 2g | 0 |
| Range of an outflow jet from height H | x² against h | 4H | 0 |

## Reasoning moves that earn AP points

- **Name the law.** "Pressures are equal at the same depth in connected fluid at rest." "At rest, Newton's first law: F_b = mg." "Continuity (conservation of mass): A₁v₁ = A₂v₂." "Bernoulli (conservation of energy per unit volume)."
- **Choose the right density and volume.** The fluid's density goes into F_b; the object's into its weight. Only the submerged volume counts.
- **Argue functional dependence.** Gauge pressure ∝ depth; absolute pressure does not double when depth doubles. Speed ∝ 1/(diameter²). Outflow speed ∝ √h. A floating object's submerged volume ∝ 1/ρ_fluid while its buoyant force stays fixed.
- **Check limiting cases.** ρ_object = ρ_fluid gives neutral buoyancy and zero acceleration. Equal hydraulic pistons give F₁ = F₂. A very wide pipe section gives nearly still fluid and hydrostatic pressure. h = 0 gives P = P₀ and v = 0.
- **Use the system view for scale readings.** Two scales supporting a container, its liquid and a hanging object must together read the total weight. Lowering an object into a beaker on a scale raises the reading by F_b.
- **Explain everyday pressure effects with a pressure difference.** Wind over a roof, ping-pong balls blown together, a straw lifting a drink: name where the pressure is higher, where lower, and which way the net force points.

## Classic question types and how to attack them

**"Find the pressure at a depth."** Decide gauge or absolute, then ρgh (plus P₀). Use the pressure difference for the net force on a wall with air on the other side.

**"Compare pressures in containers of different shapes."** Depth only.

**"Hydraulic lift."** Equal pressure, area ratio (square of the radius ratio), then the work check.

**"Does it float, and how high?"** Compare densities; fraction submerged = ρ_object/ρ_fluid.

**"What does the scale read?"** Free-body diagram of the object, then Newton's third law for the container.

**"Pipe narrows."** Continuity for the speed, then Bernoulli for the pressure; include ½ρv₁² if the fluid already moves.

**"Water leaks from a tank."** v = √(2gh); then, if asked, a horizontal projectile: t = √(2H/g), x = vt = 2√(hH).

## Common mistakes

- "Heavier means denser"; dividing by litres or cm³ while using kg/m³.
- cm² to m² with 10⁻² instead of 10⁻⁴; mass instead of weight in P = F/A.
- Mixing absolute and gauge pressure; thinking more liquid means more pressure.
- The object's density in F_b; the whole volume for a floating object; "sinking objects feel no buoyant force"; "floating means F_b is greater than the weight".
- Thinking a rigid submerged object feels more buoyant force deeper down.
- The diameter ratio instead of its square in continuity; "narrow means high pressure".
- Dropping the 2 or the square root in √(2gh); putting ρ into Torricelli's speed.

## Self-test

1. A 0.25 kg sample has volume 1.0 × 10⁻⁴ m³. Density?
2. Gauge pressure 4.0 m down in fresh water?
3. Hydraulic pistons of radius 1.0 cm and 5.0 cm. Force on the small one to lift 5000 N?
4. A 2.0 × 10⁻³ m³ block of density 600 kg/m³ is tied under water. Tension?
5. Speed 1.2 m/s in a pipe of diameter 3.0 cm. Speed where the diameter is 1.0 cm?
6. Outflow speed 1.25 m below an open water surface?

**Answers.** 1. 2500 kg/m³. 2. 1000 × 9.8 × 4.0 ≈ 3.9 × 10⁴ Pa. 3. Area ratio 25, so 200 N. 4. (1000 − 600) × 2.0 × 10⁻³ × 9.8 ≈ 7.8 N. 5. 1.2 × 9 = 10.8 m/s. 6. √(2 × 9.8 × 1.25) ≈ 4.9 m/s.

---

*Original study material for this course, organised around the College Board AP Physics 1: Algebra-Based Course and Exam Description (Unit 8, Topics 8.1–8.4). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). All lab data are invented. AP® is a trademark of the College Board, which does not endorse this material.*
