import { formatStandards, parseStandards, standardsError } from './standards';

describe('standards', () => {
  it('splits on commas, semicolons and spaces, uppercases and de-duplicates', () => {
    expect(parseStandards(' 3.nf.a.1, 3.NF.A.1;K-ESS2-1  rl.3.2 ,, ')).toEqual(['3.NF.A.1', 'K-ESS2-1', 'RL.3.2']);
    expect(parseStandards('')).toEqual([]);
  });

  it('formats a list back for the input', () => {
    expect(formatStandards(['3.NF.A.1', 'K-ESS2-1'])).toBe('3.NF.A.1, K-ESS2-1');
    expect(formatStandards(undefined)).toBe('');
  });

  it('finds an error on the list or on any one code', () => {
    expect(standardsError({ 'standards.2': ['Bad code'] })).toBe('Bad code');
    expect(standardsError({ standards: ['Too many'] })).toBe('Too many');
    expect(standardsError({ title: ['x'] })).toBeNull();
  });
});
