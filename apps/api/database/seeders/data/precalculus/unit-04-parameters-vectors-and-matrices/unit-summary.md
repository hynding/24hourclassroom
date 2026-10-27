# Unit 4 · Functions Involving Parameters, Vectors, and Matrices · The night-before sheet

**AP exam weight:** not assessed on the AP exam (Unit 4 carries no weight in the CED's exam weighting); taught here as the rest of a full precalculus course and as groundwork for calculus, physics and linear algebra
**Topics:** 4.1 Parametric Functions · 4.2 Parametric Functions Modeling Planar Motion · 4.3 Parametric Functions and Rates of Change · 4.4 Parametrically Defined Circles and Lines · 4.5 Implicitly Defined Functions · 4.6 Conic Sections · 4.7 Parametrization of Implicitly Defined Functions · 4.8 Vectors · 4.9 Vector-Valued Functions · 4.10 Matrices · 4.11 The Inverse and Determinant of a Matrix · 4.12 Linear Transformations and Matrices · 4.13 Matrices as Functions · 4.14 Matrices Modeling Contexts
**Practices:** 1 (procedural and symbolic fluency), 2 (multiple representations), 3 (communication and reasoning)
**Framework:** AP Precalculus CED, Unit 4, Topics 4.1–4.14, in our own words

## The ideas that generate every question

1. **A parameter drives both coordinates.** x = x(t), y = y(t) traces a path with a direction. t never appears on the picture; label points with it and draw arrows. The path need not pass the vertical line test.
2. **Eliminating the parameter is substitution, plus a restriction check.** Solve the simpler equation for t (or use an identity such as cos²t + sin²t = 1) and substitute. Then ask what values x and y can actually take: x = t² gives only x ≥ 0.
3. **Motion splits into two one-variable problems.** x(t) tells you left/right, y(t) up/down. Projectiles: x linear, y quadratic (−16t² in feet, about −4.9t² in metres). Average rates Δx/Δt and Δy/Δt carry units; their signs give direction; their ratio Δy/Δx is the slope of the path.
4. **Circles, segments and conics have standard parametrizations.** Circle: x = h + r cos t, y = k + r sin t. Segment: start + t · (change), 0 ≤ t ≤ 1. Ellipse: a cos t, b sin t. Hyperbola: a sec t, b tan t. Graph of f: x = t, y = f(t). Check by plugging t = 0 and a quarter period.
5. **An implicit equation is a test that points pass or fail.** Substitute to test a point; substitute x to find all matching y-values (often a quadratic in y). Branches are the pieces that are functions of x; vertical tangents occur where branches meet.
6. **Conics are read from their standard forms.** Ellipse: c² = a² − b², larger denominator gives the major axis. Hyperbola: c² = a² + b², the positive term gives the direction, asymptotes through the centre. Parabola: focus and directrix p units from the vertex. Complete the square to get there.
7. **Vectors carry magnitude and direction; arithmetic is by components.** Magnitude √(a² + b²); components ⟨m cos θ, m sin θ⟩; the dot product a₁a₂ + b₁b₂ = ‖u‖‖v‖ cos θ gives angles and the zero test for perpendicularity.
8. **Position, displacement, average velocity.** p(t) = ⟨x(t), y(t)⟩; displacement p(b) − p(a); average velocity is displacement over time. Displacement is not distance.
9. **Matrix products are rows times columns, and order matters.** (m × n)(n × p) = m × p. AB ≠ BA in general. Each entry is a dot product.
10. **The determinant decides everything about a 2 × 2 inverse.** det = ad − bc; inverse (1/det)[[d, −b], [−c, a]] exists exactly when det ≠ 0; |det| is an area (scale factor); AX = B gives X = A⁻¹B.
11. **A matrix is a function on the plane.** Its columns are the images of ⟨1, 0⟩ and ⟨0, 1⟩. "B, then A" is AB. The inverse matrix is the inverse transformation.
12. **Transition matrices model populations moving between states.** Columns are "from" states and sum to 1; xₙ₊₁ = Txₙ, xₙ = Tⁿx₀, earlier states from T⁻¹, steady state from Tx = x.

## Key formulas and procedures

| Want | Do this |
|---|---|
| Eliminate t | solve one equation for t and substitute; for trig parametrizations use cos² + sin² = 1 or sec² − tan² = 1; state restrictions |
| Direction of a path | check whether x(t) and y(t) increase or decrease as t increases |
| Projectile (feet) | x = (s cos θ)t + x₀, y = h₀ + (s sin θ)t − 16t²; top at t = −b/(2a); land where y = 0 (positive root) |
| Average rates | Δx/Δt = (x(b) − x(a))/(b − a), Δy/Δt likewise; slope of path = (Δy/Δt)/(Δx/Δt) |
| Circle, counterclockwise from (h + r, k) | x = h + r cos t, y = k + r sin t; clockwise: change the sign of the sine term |
| Time per revolution | 2π/b for cos(bt), sin(bt) |
| Segment P₁ → P₂ | x = x₁ + (x₂ − x₁)t, y = y₁ + (y₂ − y₁)t, 0 ≤ t ≤ 1; midpoint at t = 1/2 |
| Points of an implicit curve at x = c | substitute and solve for y; discriminant 0 marks where branches meet (vertical tangent) |
| Tangent to a circle at a point | perpendicular to the radius: slope = −1/(slope of radius) |
| Parabola (x − h)² = 4p(y − k) | focus (h, k + p), directrix y = k − p |
| Ellipse (x − h)²/a² + (y − k)²/b² = 1, a > b | vertices (h ± a, k), foci (h ± c, k), c² = a² − b² |
| Hyperbola (x − h)²/a² − (y − k)²/b² = 1 | vertices (h ± a, k), foci (h ± c, k), c² = a² + b², asymptotes y − k = ±(b/a)(x − h) |
| Classify Ax² + Cy² + … = 0 | same signs: ellipse (circle if A = C); opposite: hyperbola; one squared term: parabola |
| Vector from P to Q | Q − P |
| Magnitude, direction | √(a² + b²); tan θ = b/a with a quadrant check |
| Unit vector | v/‖v‖ |
| Angle between vectors | cos θ = (u · v)/(‖u‖‖v‖); perpendicular ⟺ u · v = 0 |
| Displacement, average velocity | p(b) − p(a); (p(b) − p(a))/(b − a) |
| 2 × 2 determinant, inverse | ad − bc; (1/(ad − bc))[[d, −b], [−c, a]] |
| Solve AX = B | X = A⁻¹B (A⁻¹ on the left) |
| Rotation by θ | [[cos θ, −sin θ], [sin θ, cos θ]] |
| Reflections | x-axis [[1, 0], [0, −1]]; y-axis [[−1, 0], [0, 1]]; y = x [[0, 1], [1, 0]] |
| Shear, dilation | [[1, k], [0, 1]]; [[k, 0], [0, k]] |
| Area of image | |det A| × original area; det < 0 reverses orientation |
| Markov model | xₙ₊₁ = Txₙ; x₀ = T⁻¹x₁; steady state Tx = x with the right total |

## Classic question types

**"Sketch the path and give its direction."** Make a t, x, y table at five or six t-values, plot in order, draw arrows. Then eliminate t to name the curve, and state any restriction.

**"When does it land / how high does it go?"** Work with y(t) alone: vertex for the top, the positive root of y(t) = 0 for landing. Then substitute that t into x(t) for the horizontal distance.

**"Find the average rate of change or the slope of the path on [a, b]."** Compute x and y at both ends; divide each change by Δt for the rates (with units); divide Δy by Δx for the slope. Interpret signs as left/right and up/down.

**"Write a parametrization with these properties."** Centre and radius go in h + r cos, k + r sin; fix the start by choosing which of cos, sin is on x; fix the direction by the sign of the sine term; fix the speed with b = 2π/T. Test t = 0 and a quarter period.

**"Is this point on the curve? Find all points with x = c."** Substitute. Expect a quadratic in y; two answers means the relation is not a function of x.

**"Identify the conic and find its features."** Complete the square (watch factors in front of brackets), divide to get 1 on the right, then read centre, a, b, compute c with the correct rule, and list vertices, foci and asymptotes or directrix.

**"Use vectors in context."** Put each velocity or force in components (m cos θ, m sin θ), add, then convert back to magnitude and direction. For a river crossing, the across component alone sets the crossing time.

**"Compute with matrices."** Check dimensions before multiplying; compute the determinant before inverting; write systems as AX = B; check an inverse by multiplying to get I.

**"Find the matrix of a transformation / of a composition."** Columns are images of ⟨1, 0⟩ and ⟨0, 1⟩. "First B then A" is AB. Use the determinant for area and orientation.

**"Predict with a transition matrix."** Columns are "from" states. Multiply repeatedly for future states, use T⁻¹ for the past, solve Tx = x with the correct total for the steady state, and name an assumption (fixed rates, fixed population).

## Common mistakes

- Plotting t on an axis, or forgetting arrows.
- Losing a restriction when eliminating t (x = √t, y = t is only half a parabola).
- Slope of a path upside down: it is Δy/Δx = (Δy/Δt)/(Δx/Δt).
- Using the negative root as a landing time.
- A clockwise circle written with the counterclockwise formula; x = cos 2t going round twice on [0, 2π].
- Starting a segment at the wrong end.
- Taking only the positive square root when solving x² + y² = 25 for y.
- c² = a² − b² for a hyperbola (it is a² + b²); a = 25 instead of a = 5 in x²/25 + …; asymptote slopes inverted.
- Subtracting points in the wrong order for a vector; adding magnitudes instead of components; trusting tan⁻¹ without a quadrant check.
- Treating u · v as a vector; confusing displacement with distance.
- Multiplying matrices entry by entry; assuming AB = BA; sign slips in ad − bc; reciprocal entries as an "inverse".
- Composing transformations in the wrong order; expecting a 2 × 2 matrix to translate.
- Using a transition matrix with rows and columns swapped; reporting a negative area.

## Calculator or not?

Most Unit 4 work is exact and quick by hand: eliminating parameters, reading conics, vector components with special angles, 2 × 2 determinants and inverses, single steps of a transition model. Use a calculator for landing times with messy square roots, magnitudes and directions to a stated precision, angles between vectors that are not special, many steps of a Markov chain (Tⁿx₀), and anything larger than 2 × 2. Parametric mode graphs circles, ellipses and projectiles; the matrix editor handles products, inverses and determinants.

## Self-test

1. Eliminate the parameter from x = 2t + 1, y = t² and state the shape of the path.
2. A ball has x(t) = 30t and y(t) = 4 + 48t − 16t² (feet). Find its greatest height.
3. Find the slope of the path of x(t) = t², y(t) = 4t on [1, 3].
4. Parametrize the circle with centre (2, −3) and radius 4, clockwise from (6, −3).
5. Find all points of x² + 2xy + 3y² = 6 with x = 1.
6. Find the foci of x²/9 − y²/16 = 1 and of x²/25 + y²/16 = 1.
7. For u = ⟨5, −2⟩ and v = ⟨2, 5⟩, find u · v and the angle between them.
8. For p(t) = ⟨t + 1, t³⟩, find the average velocity on [0, 2].
9. Solve 5x + 2y = 1, 7x + 3y = 2 using an inverse matrix.
10. Find the matrix of "reflect in y = x, then rotate by π/2" and the area of the image of a region of area 5 under it.
11. With T = [[0.6, 0.2], [0.4, 0.8]] and 900 people in total, find the steady state.

**Answers.**
1. t = (x − 1)/2, so y = (x − 1)²/4: an upward parabola with vertex (1, 0).
2. Vertex at t = 48/32 = 1.5; y(1.5) = 4 + 72 − 36 = 40 feet.
3. Δx = 9 − 1 = 8, Δy = 12 − 4 = 8, slope 1.
4. x = 2 + 4 cos t, y = −3 − 4 sin t, 0 ≤ t ≤ 2π.
5. 1 + 2y + 3y² = 6, so 3y² + 2y − 5 = (3y + 5)(y − 1) = 0: (1, 1) and (1, −5/3).
6. Hyperbola: c² = 9 + 16 = 25, foci (±5, 0). Ellipse: c² = 25 − 16 = 9, foci (±3, 0).
7. 10 − 10 = 0, so the angle is π/2 (perpendicular).
8. p(2) − p(0) = ⟨3, 8⟩ − ⟨1, 0⟩ = ⟨2, 8⟩; divided by 2: ⟨1, 4⟩.
9. det = 15 − 14 = 1, inverse [[3, −2], [−7, 5]]; X = [[3 − 4], [−7 + 10]] = [[−1], [3]]: x = −1, y = 3.
10. [[0, −1], [1, 0]] · [[0, 1], [1, 0]] = [[−1, 0], [0, 1]], the reflection in the y-axis; det = −1, so the area is still 5 (orientation reversed).
11. 0.4a = 0.2b gives b = 2a, so a = 300, b = 600: [[300], [600]].

---

*Original study material for this course, organised around the College Board AP Precalculus Course and Exam Description (Unit 4, Topics 4.1–4.14). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). AP® is a trademark of the College Board, which does not endorse this material.*
