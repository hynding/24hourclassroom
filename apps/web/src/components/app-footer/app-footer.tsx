import { Component, h } from '@stencil/core';

@Component({ tag: 'app-footer', shadow: true })
export class AppFooter {
  render() {
    return (
      <footer>
        <p>© 24 Hour Classroom</p>
      </footer>
    );
  }
}
