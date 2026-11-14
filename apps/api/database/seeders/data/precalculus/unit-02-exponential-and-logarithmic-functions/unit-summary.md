# Unit 2 · Exponential and Logarithmic Functions · The night-before sheet

**AP exam weight:** 25–40% of the AP Precalculus exam (as listed in the course map)
**Topics:** 2.1 Change in Arithmetic and Geometric Sequences · 2.2 Change in Linear and Exponential Functions · 2.3 Exponential Functions · 2.4 Exponential Function Manipulation · 2.5 Exponential Function Context and Data Modeling · 2.6 Competing Function Model Validation · 2.7 Composition of Functions · 2.8 Inverse Functions · 2.9 Logarithmic Expressions · 2.10 Inverses of Exponential Functions · 2.11 Logarithmic Functions · 2.12 Logarithmic Function Manipulation · 2.13 Exponential and Logarithmic Equations and Inequalities · 2.14 Logarithmic Function Context and Data Modeling · 2.15 Semi-log Plots
**Practices:** 1 (procedural and symbolic fluency), 2 (multiple representations), 3 (communication and reasoning)
**Framework:** AP Precalculus CED, Unit 2, Topics 2.1–2.15, learning objectives in our own words

## The ideas that generate every question

1. **Adding versus multiplying.** Arithmetic sequences and linear functions change by equal *amounts* over equal input steps; geometric sequences and exponential functions change by equal *factors*. Logarithmic functions are the reverse of exponential: multiply the input by a constant factor and the output changes by a constant amount. Test a table with differences, ratios, or (for logs) by checking whether the inputs grow geometrically.
2. **An exponential function f(x) = abˣ is fixed by its initial value a and its factor b.** b > 1 is growth, 0 < b < 1 is decay. With a > 0 the graph is always concave up, with horizontal asymptote y = 0 (or y = k for abˣ + k), domain all reals and range on one side of the asymptote. Limit notation describes both ends.
3. **Exponent rules let you rewrite one model in many ways.** b^(x+k) = bᵏ · bˣ, so a horizontal shift of an exponential is a vertical dilation. Changing the time unit changes the base: 2^(t/3) doubles every 3 units; (1.05)^(12t) uses a monthly factor for t in years. e is the base for continuous growth.
4. **Models come from context or data.** Percent change r gives b = 1 + r (or 1 − r); doubling time d gives 2^(t/d); half-life h gives (1/2)^(t/h); continuous rate r gives e^(rt). With data, find a and b from two points or by regression, then judge the model by context and by residuals (actual − predicted): a good model leaves small residuals with no pattern.
5. **Composition chains functions; an inverse undoes one.** f(g(x)) feeds g's output into f, and its domain needs x in the domain of g and g(x) in the domain of f. A one-to-one function has an inverse whose table, graph and formula swap inputs and outputs: domain and range swap, and the graph reflects across y = x. Verify with f(f⁻¹(x)) = x.
6. **A logarithm is an exponent.** log_b c = a ⟺ bᵃ = c. The function log_b x is the inverse of bˣ: domain x > 0, range all reals, vertical asymptote x = 0, through (1, 0) and (b, 1), concave down and slowly increasing when b > 1.
7. **Log properties restate exponent rules.** Product → sum, quotient → difference, power → multiplier, and change of base shows every log is a constant multiple of ln x. Consequence: log_b(kx) = log_b k + log_b x, so a horizontal dilation of a log graph is a vertical translation.
8. **Equations and inequalities: isolate, then apply the inverse.** Bring an unknown exponent down with a log; turn a log equation into exponential form. Check log solutions for extraneous values. Inequalities keep their direction for bases above 1 and reverse for bases between 0 and 1 (or when dividing by a negative log).
9. **Logs straighten exponentials.** If y = abˣ then log y = log a + x log b, so exponential data are linear on a semi-log plot: slope = log b, intercept = log a. Levels such as pH and decibels are logarithms, so a difference in level is a ratio of quantities.

## Key formulas and procedures

| Want | Do this |
|---|---|
| nth term, arithmetic / geometric | aₙ = a₀ + dn; gₙ = g₀ · rⁿ (or from any known term: aₙ = aₖ + d(n − k), gₙ = gₖ · r^(n−k)) |
| Linear or exponential through two points | slope m = Δy/Δx; or factor b = (y₂/y₁)^(1/(x₂ − x₁)), then a from one point |
| Percent change per period | b = 1 + r (growth) or 1 − r (decay); percent = (b − 1) · 100% |
| Doubling time d / half-life h | A₀ · 2^(t/d); A₀ · (1/2)^(t/h); solve with logs: d = ln 2 / ln b |
| Compound / continuous interest | P(1 + r/n)^(nt); Pe^(rt) |
| Horizontal shift as dilation | b^(x−h) = b^(−h) · bˣ |
| Residual | actual − predicted; look for a pattern in the residual plot |
| Domain of f(g(x)) | x in domain of g with g(x) in domain of f |
| Inverse from a formula | swap x and y, solve for y; check f(f⁻¹(x)) = x |
| Log ⟷ exponential | log_b c = a ⟺ bᵃ = c |
| Special values | log_b 1 = 0, log_b b = 1, log_b(bᵏ) = k, b^(log_b x) = x (x > 0) |
| Product / quotient / power | log(MN) = log M + log N; log(M/N) = log M − log N; log(Mᵏ) = k log M |
| Change of base | log_b x = ln x / ln b |
| Exponential equation | isolate bˣ; x = log_b(value) = ln(value)/ln b; or match bases |
| Log equation | condense; rewrite as exponential; solve; reject candidates with non-positive arguments |
| Semi-log line log y = k + mx | a = 10ᵏ, b = 10ᵐ (use e for ln) |
| Level differences | pH: difference 1 = factor 10 in concentration; decibels: difference 10 = factor 10 in intensity |

## Classic question types

**"Is this table linear, exponential or logarithmic?"** Compute differences over equal input steps (constant → linear) and ratios (constant → exponential). If the inputs are themselves geometric (1, 2, 4, 8 or 1, 10, 100) and the outputs change by a constant amount, it is logarithmic. Check the input spacing before concluding anything.

**"Write the model."** From words: identify a (the starting amount) and b (the factor per period), and fit the time unit into the exponent. From two points: divide to eliminate a. For a log model y = a + b log x, subtract to eliminate a.

**"Rewrite this expression."** Exponentials: split sums in exponents (3^(x+2) = 9 · 3ˣ), change base (8ˣ = 2^(3x)), change time unit ((1.2)^t = ((1.2)^(1/12))^(12t)). Logs: expand or condense with the three properties, and note the domain.

**"Compose or invert from a table or graph."** Work from the inside out for f(g(a)). For an inverse, look up the output in the f row and read the input. On a graph, f⁻¹(c) is the x-coordinate where f = c.

**"Solve."** Common base if possible; otherwise isolate and take logs. For e^(2x) − ae^x + b = 0, substitute u = eˣ and discard u ≤ 0. For log equations, check every candidate. For inequalities, track the direction and the domain.

**"Use the model in context."** Interpret parameters with units ("the account grows 4% per year"), solve for the input ("the level first exceeds 5,000 after 23.4 years"), compute average rates of change with units, and state a limitation (domain of the data, ceilings in the real world).

**"Read the semi-log plot."** Slope and intercept of the line through (x, log y) give log b and log a; undo with powers of 10 (or e for ln). A rising line is growth, a falling line decay.

**"Which model is better?"** Compare residual plots: the one with small, patternless residuals wins; a U-shape means the model has the wrong shape. Consider context too: unbounded exponential growth rarely lasts.

## Common mistakes

- Using the wrong input spacing: ratios over intervals of 2 give b², not b.
- Reading (1.03)ᵗ as growth of 103% or 3 units; it is 3% per period.
- Confusing the inverse with the reciprocal: f⁻¹(x) ≠ 1/f(x).
- Treating log_b c as c/b, or log(M + N) as log M + log N.
- Pulling a coefficient out of a log: log(3x) = log 3 + log x, not 3 log x.
- Taking logs before isolating the exponential term.
- Forgetting to reject extraneous solutions, or losing real ones by rewriting log(x²) as 2 log x.
- Not reversing an inequality when the base is between 0 and 1 or when dividing by ln 0.8.
- Using the slope of a semi-log line as the base, or the intercept as a.
- Treating a 20 dB or 2 pH-unit difference as a factor of 20 or 2, rather than 100.

## Calculator or not?

Most of Unit 2 is done by hand on the no-calculator section: exact logs of powers, rewriting with exponent and log properties, solving with common bases, tables of compositions and inverses, and interpreting models. A calculator earns its place for decimal solutions of exponential equations in context, exponential and logarithmic regression, residuals, and semi-log computations with messy data. Even then, write the setup (the equation and the log step) before the number, since the setup is where the credit is.

## Self-test

1. A sequence has a₃ = 17 and a₇ = 37. Find a₀ if it is arithmetic, and the common ratio if instead it is geometric with g₃ = 17 and g₇ = 272 (r > 0).
2. Describe f(x) = −2 · 3ˣ + 5: asymptote, range, increasing or decreasing, concavity, and lim (x → −∞) f(x).
3. Rewrite 4 · 2^(x+3) in the form a · 2ˣ, and rewrite (1.21)^(t/2) in the form bᵗ.
4. A hypothetical isotope has a half-life of 5 days. Write a model for 60 g and find how much remains after 12 days, to the nearest hundredth of a gram.
5. If f(x) = √(x − 1) and g(x) = x² + 1, find f(g(x)) and its domain, and find f⁻¹(x) with its domain.
6. Evaluate log₈ 2, log 0.01 and ln √e without a calculator.
7. Expand log₅(25x³/√y) and condense ln 6 + 2 ln x − ln 3.
8. Solve 3^(x−1) = 20 exactly, and solve log₄ x + log₄(x − 6) = 2.
9. Solve (0.9)ᵗ < 0.5, and solve ln(x − 2) ≤ 1.
10. Data lie on the semi-log line log y = 0.8 + 0.1x. Write y = a · bˣ, and state the percent change per unit of x.

**Answers.** 1. d = 20/4 = 5, so a₀ = 17 − 15 = 2; r⁴ = 16, so r = 2. 2. Asymptote y = 5, range y < 5, decreasing, concave down, lim (x → −∞) f(x) = 5. 3. 32 · 2ˣ; (1.21)^(1/2) = 1.1, so 1.1ᵗ. 4. A(t) = 60(1/2)^(t/5); A(12) = 60 · 2^(−2.4) ≈ 11.37 g. 5. f(g(x)) = √(x²) = |x|, domain all reals; f⁻¹(x) = x² + 1 for x ≥ 0. 6. 1/3, −2, 1/2. 7. 2 + 3 log₅ x − (1/2) log₅ y; ln(2x²). 8. x = 1 + log₃ 20 = 1 + ln 20/ln 3 ≈ 3.727; x(x − 6) = 16 gives x = 8 (x = −2 is extraneous). 9. t > ln 0.5 / ln 0.9 ≈ 6.58; 2 < x ≤ 2 + e. 10. a = 10^0.8 ≈ 6.31, b = 10^0.1 ≈ 1.259: y ≈ 6.31(1.259)ˣ, about 25.9% growth per unit.

---

*Original study material for this course, organised around the College Board AP Precalculus Course and Exam Description (Unit 2, Topics 2.1–2.15). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). AP® is a trademark of the College Board, which does not endorse this material.*
