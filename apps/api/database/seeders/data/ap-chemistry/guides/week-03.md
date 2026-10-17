# Week 03 · Electron Configuration and Photoelectron Spectroscopy

**Topics:** 1.5 Atomic Structure and Electron Configuration · 1.6 Photoelectron Spectroscopy
**Practices:** 1 (Models and Representations), 3 (Representing Data and Phenomena), 4 (Model Analysis), 6 (Argumentation)
**Spiral:** Week 1 taught you to read a mass spectrum: peak position is a property, peak height is a count. A photoelectron spectrum is read the same way, with energy on the x-axis instead of mass. Week 1's mole also returns: binding energies are quoted per mole of electrons (MJ/mol), and converting to joules per electron is a division by Avogadro's number.

## What you need to be able to do

- **1.5** Describe the atom with the shell model and Coulomb's law: electrons are held by electrostatic attraction to the nucleus, and the energy of that attraction depends on the nuclear charge and the distance.
- **1.5** Write the ground-state electron configuration of any element in the first four periods and of its common ions, using the Aufbau principle, the Pauli exclusion principle and Hund's rule, and draw the orbital diagram.
- **1.5** Use effective nuclear charge and shielding to explain why electrons in different subshells have different energies and why ionization energies rise across a period.
- **1.6** Interpret a photoelectron spectrum: each peak is a subshell, its position is the energy needed to remove an electron from that subshell, its height is proportional to the number of electrons in it; identify an element from its spectrum and justify configuration and shell models with it.

## Key terms

| Term | Meaning |
|---|---|
| Coulomb's law | The force (and energy) between two charges is proportional to the product of the charges and inversely proportional to the distance between them (force ∝ q₁q₂/r²). |
| Shell (principal energy level, n) | A group of electrons at roughly the same average distance from the nucleus; n = 1, 2, 3, ... |
| Subshell (s, p, d, f) | Divisions of a shell that differ slightly in energy; hold 2, 6, 10 and 14 electrons. |
| Orbital | A region of space holding at most two electrons of opposite spin; an s subshell has one, p has three, d has five. |
| Aufbau principle | Electrons fill the lowest-energy available subshells first: 1s 2s 2p 3s 3p 4s 3d 4p ... |
| Pauli exclusion principle | No orbital holds more than two electrons, and the two must have opposite spins. |
| Hund's rule | Within a subshell, electrons occupy orbitals singly with parallel spins before any orbital is doubled up. |
| Valence electrons | Electrons in the outermost shell (and, for transition metals, the partly filled d subshell); the ones involved in bonding. |
| Core electrons | Inner-shell electrons, not involved in bonding; represented by a noble-gas symbol in shorthand. |
| Shielding | Inner electrons repel outer electrons and partly cancel the nuclear attraction felt by them. |
| Effective nuclear charge (Z_eff) | The net positive charge an electron experiences: roughly the nuclear charge minus the number of shielding core electrons. |
| Ionization energy | The energy needed to remove an electron from a gaseous atom or ion. |
| Photoelectron spectroscopy (PES) | Ejecting electrons from atoms with high-energy photons and measuring their kinetic energies to find the binding energy of every electron. |
| Binding energy | The energy that held an electron in its subshell, found from photon energy minus the ejected electron's kinetic energy; plotted on the PES x-axis, usually in MJ/mol. |

## Coulomb's law and the shell model (1.5)

An atom is a positive nucleus with electrons held around it by electrostatic attraction. Coulomb's law says the attraction is stronger when the charges are larger and when they are closer. That one sentence explains most of the unit:

- An electron close to a highly charged nucleus (a 1s electron in fluorine) is held very tightly and needs a lot of energy to remove.
- An electron far from a nucleus whose charge is partly cancelled by inner electrons (the 3s electron in sodium) is held loosely.

Electrons do not all sit at the same distance. The **shell model** groups them by principal quantum number n: n = 1 is closest to the nucleus and lowest in energy, n = 2 is farther and higher, and so on. Within a shell the s subshell is slightly lower in energy than p, which is lower than d, because an s electron spends more of its time close to the nucleus and is less shielded.

**Shielding and effective nuclear charge.** Inner electrons sit between the nucleus and an outer electron and repel it, cancelling part of the nuclear pull. The net charge the outer electron feels, Z_eff, is roughly the proton number minus the number of core electrons. Across a period the proton number rises but the core stays the same, so Z_eff on the valence electrons rises; that is why atoms get smaller and harder to ionize from left to right. Down a group a new shell is added each time, so valence electrons are farther away and better shielded, and atoms get larger and easier to ionize.

## Writing electron configurations (1.5)

Three rules fill the subshells.

1. **Aufbau:** fill from lowest energy up. The order is 1s 2s 2p 3s 3p 4s 3d 4p 5s 4d 5p 6s. The 4s fills before 3d because for a neutral atom the 4s is slightly lower in energy while 3d is empty.
2. **Pauli:** at most two electrons per orbital, with opposite spins.
3. **Hund:** spread electrons over the orbitals of a subshell one at a time, spins parallel, before pairing.

Capacities: s holds 2, p holds 6, d holds 10. A period's number of elements is the number of electrons its subshells hold: period 2 is 2 + 6 = 8; period 4 is 2 + 10 + 6 = 18.

**Worked example 1.** Write the configuration of sulfur (Z = 16) and draw its orbital diagram.

1s² 2s² 2p⁶ 3s² 3p⁴. Shorthand: [Ne] 3s² 3p⁴. Orbital diagram for the valence shell:

```
3s: ↑↓     3p: ↑↓  ↑   ↑
```

Hund's rule puts the four 3p electrons as one pair plus two unpaired, so sulfur has two unpaired electrons.

**Worked example 2.** Iron (Z = 26) and its two common ions.

Fe: [Ar] 4s² 3d⁶. Transition metals lose their 4s electrons first when they form ions, because once the 3d subshell has electrons the 4s is the outermost and highest-energy. So Fe²⁺ is [Ar] 3d⁶ and Fe³⁺ is [Ar] 3d⁵. A half-filled d⁵ is especially stable, which is one reason Fe³⁺ is so common.

**Worked example 3.** Ions of main-group elements.

Cl⁻ gains one electron: [Ne] 3s² 3p⁶, the same configuration as argon. Ca²⁺ loses two: [Ar]. Al³⁺: [Ne]. Ions that share a configuration are **isoelectronic**; they differ only in nuclear charge, so the one with more protons is smaller.

**The two exceptions you must know.** Chromium is [Ar] 4s¹ 3d⁵ and copper is [Ar] 4s¹ 3d¹⁰, not 4s² 3d⁴ and 4s² 3d⁹. Half-filled and filled d subshells are slightly more stable than the Aufbau prediction. No other exceptions are tested.

**Try it.**
1. Write the full configuration of phosphorus and state how many unpaired electrons it has.
2. Write the shorthand configurations of Zn, Zn²⁺, Br and Br⁻.
3. Which of these is isoelectronic with Ne: Na⁺, Mg, F⁻, Cl⁻?

*Answers:* (1) 1s² 2s² 2p⁶ 3s² 3p³; three unpaired (one in each 3p orbital). (2) Zn [Ar] 4s² 3d¹⁰; Zn²⁺ [Ar] 3d¹⁰; Br [Ar] 4s² 3d¹⁰ 4p⁵; Br⁻ [Ar] 4s² 3d¹⁰ 4p⁶. (3) Na⁺ and F⁻ (both 10 electrons); Mg has 12 and Cl⁻ has 18.

## Photoelectron spectroscopy: evidence for the shell model (1.6)

The shell model is a model; PES is the experiment that supports it. A sample of gaseous atoms is hit with photons energetic enough to eject any electron, including core electrons. Each ejected electron leaves with kinetic energy equal to the photon energy minus the energy that bound it. Measuring the kinetic energies therefore measures the **binding energies** of every electron in the atom.

A photoelectron spectrum plots signal against binding energy. Three reading rules:

1. **One peak per subshell.** Electrons in the same subshell have the same binding energy, so they produce one peak. An atom with electrons in 1s, 2s and 2p gives three peaks.
2. **Position = binding energy.** Peaks farther along the energy axis (by convention drawn to the left, with energy decreasing to the right, on most AP spectra) are core electrons held tightly near the nucleus. The 1s peak is always the highest energy.
3. **Height = number of electrons.** A 2p⁶ peak is three times as tall as a 2s² peak. Heights are relative, so compare them.

Graph description: a photoelectron spectrum of neon shows three peaks. A peak at 84.0 MJ/mol of relative height 2 (the 1s electrons); a peak at 4.68 MJ/mol of relative height 2 (2s); and a peak at 2.08 MJ/mol of relative height 6 (2p). The 1s peak sits far to the high-energy side, the 2s and 2p peaks close together at low energy.

That spectrum is the shell model in data. Two electrons are held at a very high energy, far from the other eight: that is the n = 1 shell. Eight electrons sit at much lower energy, split into 2 and 6: the n = 2 shell with its s and p subshells, the p slightly easier to remove than the s.

**Worked example 4.** A spectrum shows peaks at 104 MJ/mol (height 2), 6.84 MJ/mol (height 2), 3.67 MJ/mol (height 6) and 0.50 MJ/mol (height 1). Identify the element.

Count electrons: 2 + 2 + 6 + 1 = 11. Eleven electrons is sodium. The configuration read off the spectrum is 1s² 2s² 2p⁶ 3s¹, and the 0.50 MJ/mol peak is the single, easily removed valence electron, consistent with sodium's low first ionization energy.

**Worked example 5.** Compare the 1s peaks of lithium (6.26 MJ/mol) and beryllium (11.5 MJ/mol). Why is beryllium's at higher energy?

Both 1s subshells hold two electrons at nearly the same distance from the nucleus, but beryllium has four protons to lithium's three. By Coulomb's law the larger nuclear charge holds the 1s electrons more tightly. Every peak in a spectrum shifts to higher energy as you move across a period for the same reason.

**Worked example 6.** Converting units. The 2p binding energy of neon is 2.08 MJ/mol. What is the binding energy of one electron in joules?

2.08 × 10⁶ J/mol ÷ 6.022 × 10²³ mol⁻¹ = 3.45 × 10⁻¹⁸ J per electron.

**Reading an unknown spectrum.** The sequence is: count peaks (number of subshells), add heights (number of electrons, which is Z for a neutral atom), check that the heights follow 2, 2, 6, 2, 6, 2 ... and that energies fall as you move outward, then name the element and write its configuration.

**Try it.**
1. A spectrum has peaks at 273 (height 2), 26.8 (2), 20.2 (6), 2.44 (2) and 1.25 MJ/mol (height 5). Identify the element and write its configuration.
2. Why does the 2p peak of oxygen (1.31 MJ/mol) sit at a slightly lower energy than the 2p peak of nitrogen (1.40 MJ/mol), even though oxygen has the higher nuclear charge?
3. Predict the number of peaks in the spectrum of argon and the height of the tallest.

*Answers:* (1) 2 + 2 + 6 + 2 + 5 = 17 electrons: chlorine, 1s² 2s² 2p⁶ 3s² 3p⁵. (2) Oxygen's fourth 2p electron must pair with another in the same orbital; the repulsion between the paired electrons makes it slightly easier to remove, outweighing the extra proton. (3) Five peaks (1s, 2s, 2p, 3s, 3p); the tallest are the 2p and 3p, each of height 6.

## Common mistakes

- Writing 3d before 4s when filling (fine as a way of writing, 4s² 3d⁶ or 3d⁶ 4s² are both accepted), but removing 3d electrons first when forming a transition-metal ion: the 4s electrons leave first.
- Pairing electrons in a p subshell before each orbital has one (violates Hund's rule).
- Reading PES peak height as energy, or position as a count; height is electrons, position is binding energy.
- Assuming the tallest peak is the outermost; the tallest is whichever filled p subshell has six electrons, often a core subshell.
- Forgetting that the 1s binding energy rises steeply across a period because of nuclear charge, so no two elements share a 1s energy.
- Confusing binding energy (holding the electron) with the kinetic energy of the ejected electron (photon energy minus binding energy).

## Where this goes next

Week 4 uses Z_eff and shells to explain the periodic trends in radius, ionization energy and electronegativity, and uses valence configurations to predict ionic charges and formulas. Unit 2 builds bonding on valence electrons. Unit 3 returns to light and electrons with absorption spectra and the photoelectric effect, which is PES with visible and ultraviolet light on a metal surface.

## Self-check

1. State Coulomb's law in words and use it to explain why a 1s electron in neon is harder to remove than a 1s electron in helium.
2. Write the electron configuration of Cu and of Cu²⁺.
3. How many unpaired electrons does a ground-state nitrogen atom have? Draw its 2p orbital diagram in text.
4. A PES spectrum shows four peaks with heights 2, 2, 6, 2. Identify the element and explain which peak is at the lowest energy.
5. Explain, using shielding, why the 3s electron of sodium has a binding energy of only 0.50 MJ/mol while its 1s electrons have 104 MJ/mol.

*Answers:* (1) The attraction between charges grows with the size of the charges and shrinks with distance; neon's nucleus has 10 protons to helium's 2, so its 1s electrons, at a similar distance, are held far more tightly (84.0 against 2.37 MJ/mol). (2) Cu [Ar] 4s¹ 3d¹⁰; Cu²⁺ [Ar] 3d⁹. (3) Three unpaired: 2p: ↑ ↑ ↑. (4) 12 electrons: magnesium; the 3s peak (height 2) is at the lowest energy because those electrons are outermost and most shielded. (5) The 3s electron is in the third shell, shielded by ten inner electrons, so it feels a Z_eff of roughly +1 at a large distance; the 1s electrons are unshielded, close to the nucleus and feel nearly the full +11.

---

*Original study material written for this course and organised around the College Board AP Chemistry Course and Exam Description (topics 1.5–1.6). Constants and data are public domain, from U.S. government sources (NIST Chemistry WebBook, NIST CODATA constants, PubChem), rounded as the AP equations sheet does; electron binding energies are rounded tabulated values. Accessed 2026-10-16.*
