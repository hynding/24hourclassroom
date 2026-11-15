# Week 29 · Internal Structure and Density

**Topics:** 8.1 Internal Structure and Density
**Practices:** 1 (Creating Representations: mass–volume graphs and tables), 2 (Mathematical Routines: ρ = m/V, unit conversions, scaling), 3 (Scientific Questioning and Argumentation: designing a density measurement, arguing from data)
**Framework:** AP Physics 1: Algebra-Based CED (effective fall 2024), Unit 8, Topic 8.1, learning objectives in our own words
**Spiral:** Week 5 treated a system as a collection of objects with one centre of mass; weeks 12–15 built energy bookkeeping; weeks 27–28 analysed oscillators. Unit 8 now turns to matter that flows. This week sets up the model and the one quantity, density, that every later fluids week depends on.

## What you need to be able to do

- **8.1** Say what makes a liquid or a gas a fluid, and contrast the particle pictures of solids, liquids and gases.
- **8.1** State the ideal-fluid model (incompressible, nonviscous, steady flow) and recognise when a real fluid fits it.
- **8.1** Use ρ = m/V in both directions, converting between g/cm³, kg/m³, mL and m³.
- **8.1** Argue that density is a property of the material, not of the sample, and predict how mass and volume scale when dimensions change.
- **8.1** Find the average density of a hollow or composite object and the density of a mixture.
- **8.1** Design a density measurement, graph mass against volume, and interpret the slope and intercept.

## Key terms

| Term | Meaning |
|---|---|
| Fluid | A substance that flows and takes the shape of its container: a liquid or a gas. |
| Density ρ | Mass per unit volume, ρ = m/V, in kg/m³. |
| Incompressible | Density does not change when the fluid is squeezed; a good model for liquids. |
| Viscosity | Internal friction between layers of a fluid sliding past each other. |
| Ideal fluid | Incompressible, nonviscous, in steady flow: the AP Physics 1 model. |
| Average density | Total mass divided by the total volume inside the outer surface, air spaces included. |
| Displacement method | Finding a solid's volume from the rise in water level when it is submerged. |

## Equations

- **ρ = m/V**: ρ is density (kg/m³), m is mass (kg), V is volume (m³).
- **m = ρV** and **V = m/ρ**: the same relation rearranged.
- **ρ_avg = m_total/V_total**: for a hollow or composite object, V_total is the volume enclosed by the outer surface (m³).
- **ρ_mix = (ρ₁V₁ + ρ₂V₂)/(V₁ + V₂)**: two liquids whose volumes simply add.
- Conversions: 1 g/cm³ = 1000 kg/m³; 1 mL = 1 cm³ = 10⁻⁶ m³; 1 L = 10⁻³ m³.

## What a fluid is (8.1)

Solids, liquids and gases are all made of particles (atoms or molecules) held together by forces between them. In a **solid** each particle vibrates about a fixed place, so a solid keeps its shape. In a **liquid** the particles are still packed closely, touching their neighbours, but they can slide past one another: the liquid flows and takes the shape of its container while keeping nearly the same volume. In a **gas** the particles are far apart and move freely between collisions, so a gas spreads out to fill whatever container holds it and can be squeezed into a much smaller volume.

Liquids and gases are both **fluids**: they flow. In AP Physics 1 we do not track individual particles. We treat a fluid as continuous and describe it by bulk quantities (density, pressure, flow speed) that are averages over enormous numbers of particles, in the same way that week 5 replaced a system of many objects with one centre of mass.

**The ideal-fluid model.** Real fluids are messy, so we use a model with three assumptions:

1. **Incompressible.** The density is the same everywhere and never changes. Water is very close to this: squeezing it with the pressure 100 m underwater shrinks it by less than a tenth of a percent.
2. **Nonviscous.** There is no internal friction, so no mechanical energy is lost as the fluid flows. Water is nearly nonviscous; honey and motor oil are not.
3. **Steady flow.** The velocity of the fluid at any fixed point does not change with time (the flow pattern is not turbulent).

Gases fit the model only when their density barely changes, such as air flowing gently over a roof. Air in a syringe or a bicycle pump is clearly compressible, and you should say so if a question asks.

## Density (8.1)

Density is mass per unit volume:

ρ = m/V.

Its SI unit is kg/m³. Lab measurements usually come out in g/cm³ (or g/mL); multiply by 1000 to get kg/m³, because 1 g = 10⁻³ kg and 1 cm³ = 10⁻⁶ m³. Values worth knowing:

| Substance | Density (kg/m³) |
|---|---|
| Air (room conditions) | 1.2 |
| Packing foam | about 30–50 |
| Pine wood | about 500–600 |
| Ice | 917 |
| Fresh water | 1000 |
| Sea water | about 1025 |
| Aluminium | 2700 |
| Iron or steel | about 7900 |
| Mercury | 13 600 |

**Density belongs to the material.** Cut a steel bar into three equal pieces and each piece has one third of the mass and one third of the volume, so m/V is unchanged. That is why density is useful for identifying a material and why "heavier means denser" is wrong.

**Worked example 1: the air in a classroom.** A classroom is 9.0 m long, 7.0 m wide and 3.0 m high. What is the mass of the air in it?

- V = 9.0 × 7.0 × 3.0 = 189 m³.
- m = ρV = 1.2 kg/m³ × 189 m³ ≈ 230 kg.

Air is about 800 times less dense than water, but a room holds so much of it that its mass is about that of three adults. The weight of that air, mg ≈ 2200 N, is held up by the floor like any other load. (Units check: kg/m³ × m³ = kg.)

**Worked example 2: a scaling argument.** Two solid cubes are cut from the same block of aluminium. The second has sides twice as long as the first. Predict the ratios of their masses and densities, and check a limiting case.

- Volume scales as (side)³, so V₂/V₁ = 2³ = 8.
- The material is the same, so ρ₂ = ρ₁ and m₂/m₁ = ρV₂/(ρV₁) = 8.
- Surface area scales as (side)², a factor of 4, which is the classic wrong answer for the mass.
- Limiting case: as the second cube's side shrinks toward the first cube's, the factor (L₂/L₁)³ goes to 1, and the masses become equal, as they must.

The general functional dependence: for objects of one material and one shape, m ∝ L³ and ρ is independent of L.

**Gases are different.** A gas has no fixed volume, so its density depends on how it is confined. Push the plunger of a sealed syringe from 60 mL to 30 mL and the same mass of air occupies half the volume: its density doubles. Let half the air out of a rigid tank and the remaining air's density halves. Liquids barely change: heating water in an open pot lowers its density only slightly, because it expands only a little.

## Average density of hollow and composite objects (8.1)

A boat, a closed metal can or a ball with air inside contains more than one material. Its **average density** is the total mass divided by the total volume enclosed by its outer surface:

ρ_avg = m_total/V_total.

Next week and the week after, this is the density that decides whether an object floats.

**Worked example 3: a hollow steel float.** A sealed steel sphere has an outer radius of 0.100 m and a wall thickness of 3.0 mm (inner radius 0.097 m). Steel has ρ = 7900 kg/m³, and the air inside has negligible mass. Find the sphere's average density.

- Outer volume: V_total = (4/3)π(0.100 m)³ ≈ 4.19 × 10⁻³ m³.
- Steel volume: (4/3)π(0.100³ − 0.097³) m³ ≈ 3.66 × 10⁻⁴ m³.
- Mass of steel: m = 7900 × 3.66 × 10⁻⁴ ≈ 2.89 kg.
- Average density: ρ_avg = 2.89 kg/4.19 × 10⁻³ m³ ≈ 690 kg/m³.

The steel is almost eight times denser than water, yet the sphere as a whole is less dense than water. Check the dependence on wall thickness: with a 5.0 mm wall (inner radius 0.095 m) the steel volume rises to 5.97 × 10⁻⁴ m³, the mass to 4.72 kg and ρ_avg to about 1130 kg/m³, now denser than water. Limiting cases: as the wall thickness goes to zero, ρ_avg goes to zero; as the sphere becomes solid, ρ_avg goes to 7900 kg/m³.

**Mixtures.** When two liquids are mixed and their volumes simply add, the masses add and the volumes add, so

ρ_mix = (ρ₁V₁ + ρ₂V₂)/(V₁ + V₂),

a **volume-weighted** average. It equals the plain average of the two densities only when the volumes are equal.

**Worked example 4: diluting syrup.** A student mixes 150 mL of fruit syrup (1300 kg/m³ = 1.30 g/mL) with 350 mL of water (1.00 g/mL). Find the density of the drink.

- Masses: 1.30 × 150 = 195 g and 1.00 × 350 = 350 g, total 545 g.
- Volume: 150 + 350 = 500 mL.
- ρ_mix = 545 g/500 mL = 1.09 g/mL = 1090 kg/m³.

The plain average, 1150 kg/m³, is too high because there is more than twice as much water as syrup. Limiting cases: with no syrup, ρ_mix = 1000 kg/m³; with no water, 1300 kg/m³. The answer must lie between them, closer to the larger volume.

## Measuring density (8.1)

**Mass** comes from a balance. **Volume** comes from measuring a regular solid's dimensions, from the rise in water level in a graduated cylinder (the displacement method), or, for a liquid, from a syringe or a container of known volume. Read a graduated cylinder at eye level at the bottom of the meniscus.

A single measurement gives one value of m/V. A better design measures several samples (or adds liquid in steps), plots **mass on the vertical axis against volume on the horizontal axis**, and takes the slope of the best-fit line. Since m = ρV, the line is straight with slope ρ, and the slope averages out random reading errors.

**Worked example 5: brass washers.** A lab group stacks brass washers in five groups, finding each group's volume by displacement and its mass on a balance (invented data):

| Washers | 4 | 8 | 12 | 16 | 20 |
|---|---|---|---|---|---|
| Volume (cm³) | 3.0 | 6.1 | 8.9 | 12.2 | 15.0 |
| Mass (g) | 25.6 | 51.5 | 76.0 | 103.4 | 127.9 |

- Plot mass against volume. The points lie close to a straight line through the origin.
- Slope from the end points: (127.9 − 25.6) g/(15.0 − 3.0) cm³ ≈ 8.5 g/cm³; a least-squares fit gives 8.52 g/cm³.
- ρ ≈ 8.5 × 10³ kg/m³, typical of brass.
- The intercept is about −0.1 g, close to zero, as it should be: no extra mass is in the readings.

Why groups of washers? A 10 mL graduated cylinder is read to about ±0.1 mL. For one washer (about 0.75 cm³) that is more than 10% uncertainty; for twenty washers it is under 1%.

**When the intercept is not zero.** If every mass reading includes something constant, such as a beaker that was never weighed separately or a balance that was not zeroed, the line shifts up by that amount but keeps the same slope. The slope still gives ρ, and the intercept tells you the hidden mass. Dividing each reading by its volume would give wrong densities in that case; the graph is the safer method.

## Common mistakes

- **"Heavier means denser."** A larger sample of one material has more mass and proportionally more volume.
- **Skipping unit conversions.** 250 cm³ is 2.5 × 10⁻⁴ m³, not 250 m³. Convert before multiplying by a density in kg/m³.
- **Inverting the relation**: V = m/ρ, not m × ρ; m = ρV, not V/ρ.
- **Averaging densities instead of masses and volumes** when mixing liquids or finding a composite object's density.
- **Leaving the air out of average density.** For a hollow object, divide by the whole enclosed volume.
- **Calling a gas incompressible.** The ideal-fluid model suits liquids; a gas's density changes when it is compressed.
- **Graphing volume against mass** and calling the slope the density: that slope is 1/ρ.

## Self-check

1. A 0.40 m × 0.30 m × 0.050 m block of plastic has mass 7.2 kg. What is its density?
2. What is the mass of 2.0 L of sea water (1025 kg/m³)?
3. A solid ball's radius is tripled, same material. By what factor do its mass and its density change?
4. A sealed tank of gas is connected to an empty tank of the same size and the valve is opened. What happens to the density of the gas?
5. Equal volumes of a 700 kg/m³ liquid and water are mixed. What is the density of the mixture?
6. A graph of total mass against volume of a liquid added to a beaker has slope 1.26 g/cm³ and intercept 85 g. What do these numbers mean?

*Answers:* 1. V = 6.0 × 10⁻³ m³, ρ = 7.2/6.0 × 10⁻³ = 1200 kg/m³. 2. 2.0 L = 2.0 × 10⁻³ m³, m = 1025 × 2.0 × 10⁻³ ≈ 2.1 kg. 3. Mass × 27; density unchanged. 4. The same mass fills twice the volume, so its density halves. 5. Equal volumes, so the plain average applies: 850 kg/m³. 6. The liquid's density is 1.26 g/cm³ = 1260 kg/m³; the empty beaker's mass is 85 g.

---

*Original study material for this course, organised around the College Board AP Physics 1: Algebra-Based Course and Exam Description (Unit 8, Topic 8.1). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). All lab data are invented. AP® is a trademark of the College Board, which does not endorse this material.*
