import { Config } from '@stencil/core';

export const config: Config = {
  namespace: 'app',
  globalStyle: 'src/global/app.css',
  env: {
    apiBaseUrl: process.env.API_BASE_URL ?? 'http://localhost:8000',
  },
  devServer: {
    // 0.0.0.0 so the dev server is reachable from outside its Docker container
    address: '0.0.0.0',
    port: 3333,
  },
  outputTargets: [
    {
      type: 'www',
      serviceWorker: null,
      copy: [{ src: 'assets/.htaccess', dest: '.htaccess' }],
    },
  ],
  testing: {
    // @24hc/api-client and @24hc/shared publish ESM ("type": "module") dist
    // output. Jest's default transform only matches ts/tsx/jsx/css/mjs and
    // ignores all of node_modules, so their compiled `export class ...`
    // syntax fails to parse under jest's CommonJS runtime. Route .js through
    // Stencil's own preprocessor too, and stop ignoring our workspace scope,
    // so those two packages get transpiled like first-party source.
    transform: {
      '^.+\\.(ts|tsx|jsx|css|mjs|js)$': require.resolve('@stencil/core/testing/jest-preprocessor.js'),
    },
    transformIgnorePatterns: ['/node_modules/(?!@24hc)'],
  },
};
