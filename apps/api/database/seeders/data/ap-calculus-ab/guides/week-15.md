# Week 15 · Solving Related Rates Problems

**Topics:** 4.5 Solving Related Rates Problems
**Practices:** 1 (Implementing Mathematical Processes), 2 (Connecting Representations), 4 (Communication and Notation)
**Framework:** AP Calculus AB and BC CED, Unit 4, Topic 4.5, learning objectives in our own words
**Spiral:** Week 14 introduced the core move: differentiate an equation that links changing quantities with respect to t, and substitute only afterwards. This week adds the geometry that produces those equations (the Pythagorean theorem, similar triangles, right-triangle trigonometry) and the step of eliminating an extra variable. Trigonometric derivatives from week 9 (sec²θ for tan θ) and the chain rule from week 10 do the calculus.

## What you need to be able to do

- **4.5** Translate a word problem into a labelled diagram drawn at a general moment, with letters for every changing quantity.
- **4.5** Choose a relationship that holds at every moment: Pythagorean theorem, similar triangles, an area or volume formula, or a trigonometric ratio.
- **4.5** Use a fixed geometric relationship (such as similar triangles in a cone) to eliminate an extra variable before differentiating.
- **4.5** Differentiate implicitly with respect to t, substitute the values at the instant, and solve for the unknown rate.
- **4.5** Report the answer with correct units and sign, and interpret it in context (radians per unit time for angles).

## Key terms

| Term | Meaning |
|---|---|
| General moment | Any time t, not the special instant in the question; the diagram is drawn for this. |
| Given instant | The moment at which the values (x = 30, h = 6, …) are known. |
| Eliminating a variable | Using a fixed relation (r = h/3) to write the equation in fewer changing quantities. |
| Similar triangles | Triangles with equal angles, whose corresponding sides are in a fixed ratio. |
| Angle of elevation | The angle between the horizontal and the line of sight up to an object. |
| Radian measure | Angles in radians, needed for d/dθ [tan θ] = sec²θ to hold. |

## Solving related rates (4.5)

### The method

Every related-rates problem in AP Calculus AB can be solved with the same seven steps.

1. **Draw** the situation at a general moment.
2. **Label** every changing quantity with a letter and every fixed quantity with its number. If you write "x = 30" on the picture, x has stopped changing.
3. **List** the given rates and the wanted rate in derivative notation, with signs. Something shrinking has a negative rate.
4. **Relate** the quantities with an equation that is true at every moment.
5. **Eliminate**, if the equation contains a variable whose rate you neither know nor want, using another fixed relationship.
6. **Differentiate** with respect to t, with a chain-rule factor on every changing quantity.
7. **Substitute** the values at the instant (finding any missing ones from the diagram) and solve. Write a sentence with units.

### Right triangles: the Pythagorean theorem

**Worked example (a drone at constant altitude).** A hypothetical drone flies horizontally at a constant altitude of 40 m, moving away from an observer at 6 m/s. It started directly above the observer. How fast is the distance between drone and observer increasing when the drone is 30 m (horizontally) from the point above the observer?

- Changing: horizontal distance x and straight-line distance s. Fixed: altitude 40.
- Given dx/dt = 6 m/s. Wanted ds/dt when x = 30.
- Relate: x² + 40² = s².
- Differentiate: 2x · dx/dt = 2s · ds/dt (the 40² is a constant, derivative 0).
- At the instant: s = √(30² + 40²) = 50. So ds/dt = (x/s)(dx/dt) = (30/50)(6) = 3.6 m/s.

*At that moment the distance from the observer to the drone is increasing at 3.6 metres per second.* Notice that ds/dt < dx/dt: only part of the drone's horizontal motion points directly away from the observer. As x grows, x/s approaches 1 and ds/dt approaches 6.

The same equation handles a plank sliding down a wall (x² + y² = L² with L fixed) and two objects moving on perpendicular roads (x² + y² = D² with all three changing). In the second case, a frequent error is to combine the speeds directly: perpendicular rates do not add, and they do not combine by Pythagoras either, except by coincidence. Always use the positions at the instant.

### Cones and similar triangles

A cone holds water to a depth h with surface radius r. The volume formula V = (1/3)πr²h contains two changing quantities, but usually only dh/dt is wanted. Similar triangles fix the ratio of r to h, so r can be eliminated **before** differentiating.

**Worked example (a draining funnel).** A conical funnel, vertex down, is 12 cm deep with a top radius of 4 cm. Liquid drains from it at 2 cm³/s. How fast is the liquid level falling when the liquid is 6 cm deep?

- Similar triangles: r/h = 4/12, so r = h/3.
- Volume in h alone: V = (1/3)π(h/3)²h = πh³/27.
- Differentiate: dV/dt = (3πh²/27) · dh/dt = (π/9)h² · dh/dt.
- At h = 6 with dV/dt = −2 (draining): −2 = (π/9)(36) · dh/dt = 4π · dh/dt, so dh/dt = −1/(2π) ≈ −0.159 cm/s.

*When the liquid is 6 cm deep, its level is falling at about 0.159 cm per second.* If you had instead frozen r at its current value 2 cm, you would have used V = (4/3)πh and found dh/dt = −3/(2π), three times too fast. The radius is changing, and that change matters.

Because the surface widens with depth, a cone filled (or drained) at a constant rate has a level that changes more slowly near the top and more quickly near the vertex. Troughs with triangular ends behave the same way; cylinders and boxes with vertical sides do not.

### Shadows: similar triangles with motion

**Worked example (a walker's shadow).** A person 1.8 m tall walks directly away from a 6 m streetlamp at 1.5 m/s. How fast is the shadow lengthening, and how fast is the tip of the shadow moving?

Let x be the distance from the lamp to the person and s the length of the shadow. The lamp and the person make two similar right triangles that share the tip of the shadow:

6/(x + s) = 1.8/s.

Cross-multiplying: 6s = 1.8x + 1.8s, so 4.2s = 1.8x and s = (3/7)x. Then

- ds/dt = (3/7)(dx/dt) = (3/7)(1.5) = 9/14 ≈ 0.643 m/s;
- the tip is x + s from the lamp, so it moves at dx/dt + ds/dt = 1.5 + 9/14 = 15/7 ≈ 2.143 m/s.

Both rates are constant: they do not depend on how far the person has walked. Read the question carefully to know which one it wants: the *length* of the shadow, or the *tip* of the shadow.

### Angles: right-triangle trigonometry

When the wanted rate is an angle, write a trigonometric ratio linking the angle to the sides. Tangent is the usual choice when one side is fixed.

**Worked example (a rising balloon).** An observer stands 300 m from the spot where a hypothetical hot-air balloon lifts off vertically at 5 m/s. How fast is the angle of elevation increasing when the balloon is 300 m up?

- Relate: tan θ = h/300.
- Differentiate: sec²θ · dθ/dt = (1/300) · dh/dt.
- At h = 300, the triangle is isosceles: θ = π/4, sec θ = √2, sec²θ = 2.
- So dθ/dt = (5/300)/2 = 1/120 radian per second (about 0.48° per second).

You never need θ itself, only sec²θ, which the triangle gives: sec θ = hypotenuse/adjacent, here (300√2)/300. Angle rates are in **radians** per unit time, because d/dθ [tan θ] = sec²θ is a radian fact.

## Common mistakes

- **Substituting too early.** Fixed numbers go on the diagram; values at the instant go in at step 7.
- **Freezing a radius that changes.** Use similar triangles to replace r by an expression in h.
- **Adding perpendicular speeds.** Differentiate the Pythagorean relation instead.
- **Forgetting sec²θ** when differentiating tan θ, or dividing by it the wrong way.
- **Dropping the sign of a decreasing quantity**, or reporting "−0.159 cm/s, increasing".
- **Answering the wrong question:** shadow length versus shadow tip; dh/dt versus dV/dt.
- **Wrong units:** an angle rate in metres per second, a depth rate in cubic units.

## Self-check

1. A 13 ft ladder slides down a wall; the bottom moves out at 2 ft/s. How fast is the top moving when the bottom is 5 ft from the wall?
2. A cone, vertex down, is 10 m deep with top radius 5 m. Water flows in at 2π m³/min. How fast is the level rising when the water is 4 m deep?
3. In the streetlamp example, how fast would the shadow lengthen if the person walked at 2.1 m/s?
4. A plane at 3 km altitude flies away from an observer at 600 km/h. At what rate is the angle of elevation changing when the horizontal distance is 3 km?
5. Why do the cone and shadow problems need a similar-triangles step but the drone problem does not?

*Answers:* 1. y = 12; dy/dt = −(5/12)(2) = −5/6 ft/s: the top slides down at 5/6 ft per second. 2. r = h/2, V = πh³/12, dV/dt = (π/4)h² · dh/dt: 2π = 4π · dh/dt, so dh/dt = 1/2 m per minute. 3. (3/7)(2.1) = 0.9 m/s. 4. tan θ = 3/x; sec²θ · dθ/dt = −(3/x²)(dx/dt). At x = 3, sec²θ = 2: dθ/dt = −(3/9)(600)/2 = −100 radians per hour (decreasing). 5. In the drone problem the equation already contains only the two quantities whose rates matter; in the others an extra changing quantity (r, or the lamp triangle's base) must be tied to the main variable first.

---

*Original study material for this course, organised around the College Board AP Calculus AB and BC Course and Exam Description (Unit 4, Topic 4.5). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). AP® is a trademark of the College Board, which does not endorse this material.*
