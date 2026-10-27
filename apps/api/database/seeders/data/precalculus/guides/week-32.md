# Week 32 · Matrices as Linear Transformations and Models

**Topics:** 4.12 Linear Transformations and Matrices · 4.13 Matrices as Functions · 4.14 Matrices Modeling Contexts
**Practices:** 1 (procedural and symbolic fluency), 2 (multiple representations), 3 (communication and reasoning)
**Framework:** AP Precalculus CED, Unit 4, Topics 4.12–4.14, learning objectives in our own words. Unit 4 is not assessed on the AP exam.
**Spiral:** Week 31's matrix products, determinants and inverses; week 30's vectors; week 8's transformations of graphs (reflections and dilations return, now acting on points of the plane); week 13's composition and inverse functions; weeks 18–19's cos θ and sin θ (they fill the rotation matrix); weeks 10 and 12's repeated multiplication (a Markov chain is a matrix version of a geometric sequence).

## What you need to be able to do

- **4.12** Write the matrix of a linear transformation of the plane from a rule (x, y) → (ax + by, cx + dy), or from where it sends ⟨1, 0⟩ and ⟨0, 1⟩, and apply it to points and shapes.
- **4.12** Recognise and build matrices for rotations about the origin, reflections in the axes and in y = x, dilations, stretches and shears.
- **4.13** Treat a matrix as a function: compose transformations by multiplying matrices in the right order, undo a transformation with the inverse matrix, and use the determinant as the area scale factor (with its sign showing whether orientation is reversed).
- **4.14** Model a changing situation with a transition matrix and state vectors: predict future states with xₙ₊₁ = Txₙ (so xₙ = Tⁿx₀), find earlier states with T⁻¹, and find and interpret a steady state.
- **4.14** State the assumptions behind a matrix model and the limits of its predictions.

## Key terms

| Term | Meaning |
|---|---|
| Linear transformation | A function L on vectors with L(u + v) = L(u) + L(v) and L(kv) = kL(v); in the plane, it is multiplication by a 2 × 2 matrix. |
| Image | The output of a transformation; the image of a shape is the set of images of its points. |
| Rotation matrix | [[cos θ, −sin θ], [sin θ, cos θ]], rotation counterclockwise by θ about the origin. |
| Shear | A transformation that slides points parallel to an axis by an amount proportional to the other coordinate, such as (x, y) → (x + ky, y). |
| Area scale factor | |det A|: every region's area is multiplied by this. |
| State vector | A column listing how many (or what fraction) are in each state at one time. |
| Transition matrix | A matrix T whose column j gives the fractions moving from state j to each state in one step; each column sums to 1. |
| Steady state | A state vector x with Tx = x: once reached, it does not change. |

## Matrices that move the plane (4.12)

A 2 × 2 matrix A = [[a, b], [c, d]] turns each vector ⟨x, y⟩ (written as a column) into a new vector:

A · [[x], [y]] = [[ax + by], [cx + dy]].

Such a function is **linear**: it sends the origin to the origin, lines to lines, and the midpoint of a segment to the midpoint of the image segment. A translation such as (x, y) → (x + 1, y) is not linear (it moves the origin), so no 2 × 2 matrix produces it.

**The column trick.** A · ⟨1, 0⟩ is the first column of A and A · ⟨0, 1⟩ is the second. So to build the matrix of a transformation, ask where it sends ⟨1, 0⟩ and ⟨0, 1⟩ and write those images as columns.

**Worked example.** Find the matrix of the counterclockwise rotation by π/2.

⟨1, 0⟩ goes to ⟨0, 1⟩ and ⟨0, 1⟩ goes to ⟨−1, 0⟩. Columns: [[0, −1], [1, 0]]. Check: ⟨3, 1⟩ goes to ⟨−1, 3⟩, a quarter turn.

In general, rotating ⟨1, 0⟩ by θ gives ⟨cos θ, sin θ⟩ (week 19) and rotating ⟨0, 1⟩ gives ⟨−sin θ, cos θ⟩, so

R(θ) = [[cos θ, −sin θ], [sin θ, cos θ]].

**A catalogue.**

| Transformation | Matrix | Effect on (x, y) |
|---|---|---|
| Reflection in the x-axis | [[1, 0], [0, −1]] | (x, −y) |
| Reflection in the y-axis | [[−1, 0], [0, 1]] | (−x, y) |
| Reflection in y = x | [[0, 1], [1, 0]] | (y, x) |
| Rotation by π | [[−1, 0], [0, −1]] | (−x, −y) |
| Dilation by k | [[k, 0], [0, k]] | (kx, ky) |
| Horizontal stretch by a, vertical by b | [[a, 0], [0, b]] | (ax, by) |
| Horizontal shear by k | [[1, k], [0, 1]] | (x + ky, y) |
| Vertical shear by k | [[1, 0], [k, 1]] | (x, kx + y) |

Compare week 8: replacing y by −y in an equation reflected its graph in the x-axis. Here the same reflection is the matrix [[1, 0], [0, −1]] acting on every point.

**Worked example.** Apply M = [[1, 3], [0, 1]] to the triangle with vertices (0, 0), (2, 0), (0, 1).

M fixes (0, 0) and (2, 0) (points on the x-axis do not move under a horizontal shear) and sends (0, 1) to (3, 1). The image is the triangle (0, 0), (2, 0), (3, 1): same base, same height, slanted to the right.

**Try it.**
1. Write the matrix of the rotation by π/3.
2. Where does [[2, 0], [0, −1]] send ⟨3, 1⟩? Describe the transformation.
3. Which transformation does [[1, 2], [0, 1]] perform?

*Answers:* 1. [[1/2, −√3/2], [√3/2, 1/2]]. 2. ⟨6, −1⟩: a horizontal stretch by 2 combined with a reflection in the x-axis. 3. A horizontal shear: (x, y) → (x + 2y, y).

## Matrices as functions (4.13)

Since a matrix is a function on vectors, the ideas of week 13 carry over.

**Composition is multiplication.** To apply B first and then A, compute A(Bx) = (AB)x. The matrix of "B, then A" is AB: the first transformation sits on the right, next to the vector, just as in f(g(x)) the inner function acts first. Because matrix multiplication is not commutative, the order matters.

**Worked example.** Reflect in the x-axis (F = [[1, 0], [0, −1]]) and then rotate by π/2 (R = [[0, −1], [1, 0]]).

RF = [[0, 1], [1, 0]], the reflection in y = x. In the other order, FR = [[0, −1], [−1, 0]], the reflection in y = −x. Check with ⟨1, 0⟩: F leaves it alone, then R turns it to ⟨0, 1⟩, matching the first column of RF.

**Repeated transformations.** R(θ)² = R(2θ): rotating twice by π/3 is rotating by 2π/3. Aⁿ applies A n times.

**Inverse transformations.** If A is invertible, A⁻¹ undoes it: A⁻¹(Ax) = x. The inverse of a rotation by θ is the rotation by −θ, R(−θ) = [[cos θ, sin θ], [−sin θ, cos θ]]; a reflection is its own inverse; the inverse of the shear [[1, 3], [0, 1]] is [[1, −3], [0, 1]]. A matrix with determinant 0 squashes the whole plane onto a line (or a point), and that cannot be undone, which is why it has no inverse.

**The determinant as area scale factor.** The unit square, spanned by ⟨1, 0⟩ and ⟨0, 1⟩, is sent to the parallelogram spanned by the columns of A, whose area is |det A| (week 31). Every other region is scaled by the same factor. A negative determinant means the transformation also reverses orientation (it includes a reflection): counterclockwise turns become clockwise.

| Transformation | det | Meaning |
|---|---|---|
| Rotation | cos²θ + sin²θ = 1 | areas and orientation kept |
| Reflection | −1 | areas kept, orientation reversed |
| Dilation by k | k² | areas multiplied by k² |
| Shear | 1 | areas kept, shapes slanted |

**Worked example.** A region of area 4 is transformed by [[2, 1], [1, −1]]. Find the area of the image.

det = −2 − 1 = −3, so the image has area 3 · 4 = 12, and its orientation is reversed.

**Worked example.** Rotate by π/2 and then dilate by 2. Find the matrix, the image of ⟨1, 3⟩, and the inverse.

D = [[2, 0], [0, 2]], so DR = [[0, −2], [2, 0]]. Image of ⟨1, 3⟩: ⟨−6, 2⟩. det = 4, so areas are multiplied by 4. Inverse (1/4)[[0, 2], [−2, 0]] = [[0, 1/2], [−1/2, 0]]: rotate by −π/2 and shrink by 1/2.

**Try it.**
1. Find the matrix of "rotate by π, then reflect in the y-axis" and identify it.
2. By what factor does [[3, 1], [1, 2]] scale areas?

*Answers:* 1. [[−1, 0], [0, 1]] · [[−1, 0], [0, −1]] = [[1, 0], [0, −1]], the reflection in the x-axis. 2. det = 5.

## Matrix models: transition matrices (4.14)

Many situations involve a fixed population moving between a few states each time step: customers between two shops, bikes between two stations, households between two providers. If the fraction that moves from each state to each other state stays the same every step, a matrix models it.

**Setting up.** In a hypothetical model, a town has two coffee shops, A and B. Each week 80% of A's customers stay with A and 20% switch to B; 70% of B's customers stay with B and 30% switch to A. Write the **state vector** xₙ = [[aₙ], [bₙ]] (customers at A and B in week n) and the **transition matrix** with one column per "from" state:

T = [[0.8, 0.3], [0.2, 0.7]] (column 1: from A; column 2: from B).

Each column sums to 1, because everyone goes somewhere. Then xₙ₊₁ = Txₙ, and so xₙ = Tⁿx₀, a matrix version of the geometric sequence gₙ = g₀rⁿ from week 10.

**Predicting forward.** Start with x₀ = [[500], [500]].

- x₁ = Tx₀ = [[0.8 · 500 + 0.3 · 500], [0.2 · 500 + 0.7 · 500]] = [[550], [450]].
- x₂ = Tx₁ = [[440 + 135], [110 + 315]] = [[575], [425]].

**Steady state.** Look for x = [[a], [b]] with Tx = x. The first row gives 0.8a + 0.3b = a, so 0.3b = 0.2a and a : b = 3 : 2. With 1,000 customers, the steady state is [[600], [400]]. Check: T · [[600], [400]] = [[480 + 120], [120 + 280]] = [[600], [400]]. The weekly states 550, 575, … approach 600 for A: in the long run, each week's 20% loss from A (120 customers) balances the 30% gain from B (120 customers).

**Looking back.** Because x₁ = Tx₀, the earlier state is x₀ = T⁻¹x₁. Here det T = 0.56 − 0.06 = 0.5 and T⁻¹ = 2 · [[0.7, −0.3], [−0.2, 0.8]] = [[1.4, −0.6], [−0.4, 1.6]]. From x₁ = [[550], [450]]: T⁻¹x₁ = [[770 − 270], [−220 + 720]] = [[500], [500]], as expected.

**Assumptions and limits.** The model assumes the total is fixed (no one joins or leaves), the switching fractions never change, and everyone behaves independently of how long they have been a customer. Predictions far into the future, or far into the past, are only as good as those assumptions; and T⁻¹ can produce negative "populations" if you go back further than the model is valid.

**Try it.**
1. With the same T, find x₁ from x₀ = [[900], [100]].
2. A transition matrix is [[0.9, 0.2], [0.1, 0.8]]. Find the steady state for a total of 3,000.

*Answers:* 1. [[720 + 30], [180 + 70]] = [[750], [250]]. 2. 0.1a = 0.2b, so a : b = 2 : 1: [[2000], [1000]].

## Calculator notes

Store T and x₀ as matrices; then [T]*[X] gives the next state and [T]^10*[X] the state after 10 steps. Raising T to a large power (say 50) shows the long-run behaviour: every column of Tⁿ approaches the steady-state fractions. For a rotation matrix, use exact values for special angles by hand, or decimals on the calculator in radian mode.

## Common mistakes

- **Composing in the wrong order.** "B, then A" is AB, not BA.
- **Rows versus columns of a transition matrix.** In this course each column is a "from" state and sums to 1; multiplying by the transpose gives wrong predictions.
- **Expecting a translation from a 2 × 2 matrix.** Linear transformations always fix the origin.
- **Forgetting the absolute value** when using the determinant as an area scale factor.
- **Mixing up the rotation matrix signs.** Counterclockwise by θ is [[cos θ, −sin θ], [sin θ, cos θ]]; the −sin is in the top right.
- **Assuming the steady state is reached in finitely many steps.** It is usually approached, not reached.

## Where this goes next

This closes the course's mathematics. In calculus and beyond, linear transformations become the language of linear algebra: systems of many equations, computer graphics (every rotation of a 3D model is a matrix), and large Markov models such as the ones search engines use to rank pages. The determinant reappears as the factor that changes areas in multivariable integrals.

## Self-check

1. Write the matrix that reflects in y = x and then dilates by 3, and find the image of (2, −1).
2. Find the area of the image of the square with vertices (0, 0), (1, 0), (1, 1), (0, 1) under [[4, 1], [2, 3]], and say whether orientation is preserved.
3. Explain why the inverse of a rotation matrix is the rotation by the opposite angle, and verify it for θ = π/2.
4. In a hypothetical model, 90% of the bikes at station P stay each day and 10% move to Q, while 30% of Q's bikes move to P. Write the transition matrix and find the steady state for 200 bikes.
5. State two assumptions behind the model in question 4 and one way each might fail in real life.

---

*Original study material for this course, organised around the College Board AP Precalculus Course and Exam Description (Unit 4, Topics 4.12–4.14). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). AP® is a trademark of the College Board, which does not endorse this material.*
