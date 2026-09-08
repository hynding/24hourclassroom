import { Component, h } from '@stencil/core';

@Component({ tag: 'page-home', shadow: true })
export class PageHome {
  render() {
    return (
      <section>
        <h1>24 Hour Classroom</h1>
        <p>
          A place for teachers to connect with other teachers and students — creating and sharing
          lesson plans, homework, study materials, practice tests, and reports.
        </p>
      </section>
    );
  }
}
