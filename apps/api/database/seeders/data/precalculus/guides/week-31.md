# Week 31 · Matrices, Determinants and Inverses

**Topics:** 4.10 Matrices · 4.11 The Inverse and Determinant of a Matrix
**Practices:** 1 (procedural and symbolic fluency), 2 (multiple representations), 3 (communication and reasoning)
**Framework:** AP Precalculus CED, Unit 4, Topics 4.10–4.11, learning objectives in our own words. Unit 4 is not assessed on the AP exam.
**Spiral:** Week 30's vectors and dot product (each entry of a matrix product is a dot product of a row and a column); week 13's inverse functions and the identity function (a matrix inverse undoes a matrix just as f⁻¹ undoes f); week 30's parallelograms spanned by two vectors (the determinant measures their area). From Algebra 1 and 2: solving systems of two linear equations by substitution and elimination.

## What you need to be able to do

- **4.10** State the dimensions of a matrix, name its entries, and add, subtract and multiply matrices by scalars when the operations are defined.
- **4.10** Multiply matrices row by column, decide from the dimensions whether a product is defined and what size it is, and show with an example that AB and BA are generally different.
- **4.10** Use matrix products to organise calculations in a context, such as quantities times prices, and interpret the entries of the result.
- **4.11** Compute the determinant of a 2 × 2 matrix and interpret its absolute value as the area of the parallelogram spanned by its column (or row) vectors.
- **4.11** Find the inverse of a 2 × 2 matrix when it exists, explain why it exists exactly when the determinant is not 0, and check it by multiplying to get the identity.
- **4.11** Write a system of two linear equations as AX = B and solve it with X = A⁻¹B.

## Key terms

| Term | Meaning |
|---|---|
| Matrix | A rectangular array of numbers in rows and columns. |
| Dimensions | m × n: m rows and n columns (rows first). |
| Entry aᵢⱼ | The number in row i, column j. |
| Square matrix | A matrix with as many rows as columns. |
| Identity matrix I | The square matrix with 1s on the main diagonal and 0s elsewhere; AI = IA = A. |
| Determinant | For [[a, b], [c, d]], the number ad − bc, written det A. |
| Inverse A⁻¹ | The matrix with AA⁻¹ = A⁻¹A = I, when it exists. |
| Singular matrix | A square matrix with determinant 0; it has no inverse. |

Matrices in this guide are written row by row: [[2, −1], [3, 4]] has first row 2, −1 and second row 3, 4.

## Matrices and their arithmetic (4.10)

A **matrix** organises numbers into rows and columns. A hypothetical café's sales over two days might be

| | small | large |
|---|---|---|
| Monday | 40 | 25 |
| Tuesday | 55 | 30 |

which is the 2 × 2 matrix Q = [[40, 25], [55, 30]]. The entry q₂₁ = 55 is row 2 (Tuesday), column 1 (small coffees).

**Addition and subtraction** need matrices of the same dimensions and act entry by entry. **Scalar multiplication** multiplies every entry: 2[[0, 5], [1, −2]] = [[0, 10], [2, −4]].

**Worked example.** For A = [[2, −1], [3, 4]] and B = [[0, 5], [1, −2]], find A + 2B.

2B = [[0, 10], [2, −4]], so A + 2B = [[2, 9], [5, 0]].

## Matrix multiplication (4.10)

To multiply A (m × n) by B (n × p), the inner dimensions must match (n = n), and the product is m × p. The entry in row i, column j of AB is the dot product of row i of A with column j of B.

**Worked example.** With the same A and B, find AB and BA.

AB: row 1 of A is (2, −1). With column 1 of B, (0, 1): 0 − 1 = −1. With column 2, (5, −2): 10 + 2 = 12. Row 2 of A is (3, 4): with column 1, 0 + 4 = 4; with column 2, 15 − 8 = 7. So AB = [[−1, 12], [4, 7]].

BA: row 1 of B (0, 5) with the columns of A, (2, 3) and (−1, 4): 15 and 20. Row 2 (1, −2): 2 − 6 = −4 and −1 − 8 = −9. So BA = [[15, 20], [−4, −9]].

AB ≠ BA. **Matrix multiplication is not commutative**, so order always matters. (It is associative, (AB)C = A(BC), and the identity behaves like 1: AI = IA = A.)

**Worked example (a context).** The café charges $3.00 for a small coffee and $4.50 for a large. Put the prices in a column P = [[3], [4.5]] (2 × 1). Then QP is (2 × 2)(2 × 1) = 2 × 1:

QP = [[40 · 3 + 25 · 4.5], [55 · 3 + 30 · 4.5]] = [[232.5], [300]].

Monday's revenue was $232.50 and Tuesday's $300. The product PQ is not even defined: (2 × 1)(2 × 2) has mismatched inner dimensions.

**A matrix times a vector.** A 2 × 2 matrix times a 2 × 1 column vector gives another 2 × 1 vector: [[2, 1], [0, 3]] · [[x], [y]] = [[2x + y], [3y]]. Week 32 treats this as a function that moves points of the plane.

**Try it.**
1. A is 3 × 2 and B is 2 × 4. Which of AB and BA are defined, and what size?
2. Compute [[1, 2], [0, 1]] · [[0, 1], [1, 0]] and the product in the other order.

*Answers:* 1. AB is 3 × 4; BA is not defined (4 ≠ 3). 2. [[2, 1], [1, 0]] and [[0, 1], [1, 2]].

## The determinant (4.11)

For a 2 × 2 matrix A = [[a, b], [c, d]], the **determinant** is

det A = ad − bc.

For A = [[2, −1], [3, 4]]: det A = 8 − (−3) = 11.

**Area meaning.** The columns of A are vectors ⟨a, c⟩ and ⟨b, d⟩. The parallelogram they span has area |ad − bc|. For the vectors ⟨3, 1⟩ and ⟨1, 2⟩, det [[3, 1], [1, 2]] = 6 − 1 = 5, so the parallelogram has area 5 and the triangle with those two sides has area 5/2. The sign of the determinant records orientation (positive if the second vector is counterclockwise from the first), which is why area uses the absolute value.

A determinant of 0 means the two columns point along the same line: the "parallelogram" is flat. That is exactly when the matrix has no inverse.

## The inverse of a 2 × 2 matrix (4.11)

The inverse of A undoes A: AA⁻¹ = A⁻¹A = I. For A = [[a, b], [c, d]] with ad − bc ≠ 0,

A⁻¹ = (1/(ad − bc)) · [[d, −b], [−c, a]].

Swap the diagonal entries, change the signs of the off-diagonal entries, and divide by the determinant. If det A = 0 there is no inverse, since you would divide by 0.

**Worked example.** Find the inverse of A = [[2, −1], [3, 4]] and check it.

det A = 11. A⁻¹ = (1/11)[[4, 1], [−3, 2]]. Check: A · [[4, 1], [−3, 2]] = [[8 + 3, 2 − 2], [12 − 12, 3 + 8]] = [[11, 0], [0, 11]], and dividing by 11 gives I.

**Worked example.** For which k is [[6, k], [4, 2]] singular?

det = 12 − 4k = 0 when k = 3. Then the rows (6, 3) and (4, 2) are proportional.

## Solving systems with inverses (4.11)

The system 3x + 5y = 11, x + 2y = 4 is the matrix equation

[[3, 5], [1, 2]] · [[x], [y]] = [[11], [4]], or AX = B.

Multiply both sides on the left by A⁻¹: X = A⁻¹B. Here det A = 6 − 5 = 1 and A⁻¹ = [[2, −5], [−1, 3]], so X = [[22 − 20], [−11 + 12]] = [[2], [1]]: x = 2, y = 1. Check: 3(2) + 5(1) = 11 and 2 + 2 = 4.

The order matters: X = A⁻¹B, not BA⁻¹ (which is not even defined here). If det A = 0 the system has either no solution or infinitely many, and the inverse method fails.

**Worked example (a context).** At a hypothetical school play, adult tickets cost $12 and child tickets $8. Thirty tickets brought in $300. How many of each were sold?

x + y = 30 and 12x + 8y = 300. A = [[1, 1], [12, 8]], det A = 8 − 12 = −4, A⁻¹ = (−1/4)[[8, −1], [−12, 1]]. X = (−1/4)[[240 − 300], [−360 + 300]] = (−1/4)[[−60], [−60]] = [[15], [15]]: 15 adult and 15 child tickets.

**Try it.**
1. Find det [[5, 2], [3, 4]] and the inverse.
2. Solve 2x + y = 7, 5x + 3y = 18 with an inverse matrix.
3. Find the area of the parallelogram spanned by ⟨4, 1⟩ and ⟨2, 3⟩.

*Answers:* 1. 14; (1/14)[[4, −2], [−3, 5]]. 2. det 1, inverse [[3, −1], [−5, 2]], X = [[21 − 18], [−35 + 36]] = [[3], [1]]. 3. |12 − 2| = 10.

## Calculator notes

Graphing calculators have a matrix editor: enter the dimensions, then the entries. Products are typed [A]*[B], the inverse is [A]⁻¹ (the x⁻¹ key), and det( is in the matrix MATH menu. An error such as "dimension mismatch" means the product is undefined; "singular matrix" means the determinant is 0. Larger systems (3 × 3 and up) are solved the same way, X = A⁻¹B, and by hand they are far more work, which is why technology is normal there.

## Common mistakes

- **Multiplying entry by entry.** The product AB uses rows of A with columns of B; the entrywise product is not matrix multiplication.
- **Assuming AB = BA.** Check order every time, including in X = A⁻¹B.
- **Reading dimensions as columns × rows.** Rows come first.
- **Sign slips in the determinant.** det [[2, −1], [3, 4]] = 8 − (−3) = 11, not 5.
- **Forgetting to swap or negate** in the inverse formula, or forgetting to divide by the determinant.
- **Reporting a negative area.** Area is |det|.

## Where this goes next

Week 32 reads a 2 × 2 matrix as a function on the plane: it sends each vector ⟨x, y⟩ to a new vector, producing rotations, reflections, stretches and shears. The determinant becomes the factor by which the transformation scales area, the inverse matrix becomes the inverse transformation, and matrix multiplication becomes composition. Matrices acting on state vectors then model changes such as shoppers switching between stores.

## Self-check

1. A is 2 × 3 and B is 3 × 3. Which of AB, BA, A + B are defined? Give sizes.
2. Compute [[1, 3], [2, −1]] · [[4], [−2]].
3. Find the inverse of [[4, 7], [1, 2]] and check it.
4. Explain, using the determinant, why [[2, 6], [1, 3]] has no inverse, and what that means geometrically for its column vectors.
5. Write the system 4x − y = 9, 2x + 3y = 1 as AX = B and solve it with A⁻¹.

---

*Original study material for this course, organised around the College Board AP Precalculus Course and Exam Description (Unit 4, Topics 4.10–4.11). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). AP® is a trademark of the College Board, which does not endorse this material.*
