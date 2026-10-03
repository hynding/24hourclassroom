import { h, VNode } from '@stencil/core';

/**
 * A deliberately small markdown subset, rendered straight to vnodes.
 *
 * Nothing here ever builds an HTML string: every run of author text becomes
 * a text node, so `<script>` in a prompt renders as the six characters
 * "<script>". That is the whole safety argument -- there is no sanitizer
 * because there is nothing to sanitize.
 *
 * Inline (always): paragraphs separated by a blank line, a single newline
 * inside a paragraph is a line break, pipe tables, **bold**, *italic* and
 * `code`. Underscore emphasis is NOT supported so a fill-in-the-blank
 * `____` survives untouched. Superscripts and subscripts are plain Unicode.
 *
 * Blocks (materials only, `blocks: true`): `#`/`##`/`###` headings, `-`/`*`
 * and `1.` lists one level deep, `>` quotes, ``` fences, `---` rules and
 * [text](http…) links. Images render as their alt text: the file disk is
 * private and signed, so there is no URL a document could point at.
 */
export interface RichTextOptions {
  blocks?: boolean;
}

const TABLE_RULE = /^\|?\s*:?-{3,}:?\s*(\|\s*:?-{3,}:?\s*)*\|?\s*$/;
const FENCE = /^```/;
const HEADING = /^(#{1,3})\s+(.*)$/;
const BULLET = /^[-*]\s+(.*)$/;
const ORDERED = /^\d+[.)]\s+(.*)$/;
const QUOTE = /^>\s?(.*)$/;
const RULE = /^-{3,}$|^\*{3,}$/;

export function renderRich(text: string, options: RichTextOptions = {}): VNode[] {
  const blocks = options.blocks === true;
  const lines = (text ?? '').replace(/\r\n?/g, '\n').split('\n');
  const out: VNode[] = [];
  let i = 0;

  const isTableStart = (at: number) => lines[at]?.includes('|') && TABLE_RULE.test(lines[at + 1] ?? '');

  while (i < lines.length) {
    const line = lines[i];

    if (line.trim() === '') {
      i++;
      continue;
    }

    if (blocks && FENCE.test(line)) {
      const code: string[] = [];
      i++;
      while (i < lines.length && !FENCE.test(lines[i])) {
        code.push(lines[i]);
        i++;
      }
      i++; // closing fence (or end of text)
      out.push(<pre><code>{code.join('\n')}</code></pre>);
      continue;
    }

    if (isTableStart(i)) {
      const header = cells(lines[i]);
      i += 2;
      const rows: string[][] = [];
      while (i < lines.length && lines[i].includes('|') && lines[i].trim() !== '') {
        rows.push(cells(lines[i]));
        i++;
      }
      out.push(
        <table>
          <thead><tr>{header.map((c) => <th>{inline(c, blocks)}</th>)}</tr></thead>
          <tbody>{rows.map((r) => <tr>{header.map((_, k) => <td>{inline(r[k] ?? '', blocks)}</td>)}</tr>)}</tbody>
        </table>,
      );
      continue;
    }

    if (blocks) {
      const heading = HEADING.exec(line);
      if (heading) {
        const level = heading[1].length;
        const content = inline(heading[2], blocks);
        // The page already has an h1 (the material title), so `#` is an h2.
        out.push(level === 1 ? <h2>{content}</h2> : level === 2 ? <h3>{content}</h3> : <h4>{content}</h4>);
        i++;
        continue;
      }
      if (RULE.test(line.trim())) {
        out.push(<hr />);
        i++;
        continue;
      }
      if (BULLET.test(line) || ORDERED.test(line)) {
        const ordered = ORDERED.test(line);
        const matcher = ordered ? ORDERED : BULLET;
        const items: VNode[] = [];
        while (i < lines.length && matcher.test(lines[i])) {
          items.push(<li>{inline(matcher.exec(lines[i])[1], blocks)}</li>);
          i++;
        }
        out.push(ordered ? <ol>{items}</ol> : <ul>{items}</ul>);
        continue;
      }
      if (QUOTE.test(line)) {
        const quoted: string[] = [];
        while (i < lines.length && QUOTE.test(lines[i])) {
          quoted.push(QUOTE.exec(lines[i])[1]);
          i++;
        }
        out.push(<blockquote>{paragraph(quoted, blocks)}</blockquote>);
        continue;
      }
    }

    // A paragraph: every following non-blank line that does not start a
    // block of its own. A single newline becomes a line break, because
    // authors lay out data and multi-part prompts line by line.
    const para: string[] = [];
    while (i < lines.length && lines[i].trim() !== '' && !isTableStart(i) && !(blocks && startsBlock(lines[i]))) {
      para.push(lines[i]);
      i++;
    }
    out.push(paragraph(para, blocks));
  }

  return out;
}

function startsBlock(line: string): boolean {
  return FENCE.test(line) || HEADING.test(line) || BULLET.test(line) || ORDERED.test(line) || QUOTE.test(line) || RULE.test(line.trim());
}

function paragraph(lines: string[], blocks: boolean): VNode {
  const children: (VNode | string)[] = [];
  lines.forEach((l, k) => {
    if (k > 0) {
      children.push(<br />);
    }
    children.push(...inline(l, blocks));
  });
  return <p>{children}</p>;
}

function cells(row: string): string[] {
  let r = row.trim();
  if (r.startsWith('|')) {
    r = r.slice(1);
  }
  if (r.endsWith('|')) {
    r = r.slice(0, -1);
  }
  return r.split('|').map((c) => c.trim());
}

// Order matters: bold before italic so `**x**` is not read as two italics.
const INLINE = /(\*\*([^*\n]+)\*\*)|(\*([^*\n]+)\*)|(`([^`\n]+)`)|(!?\[([^\]\n]*)\]\(([^)\s]+)\))/g;

function inline(text: string, blocks: boolean): (VNode | string)[] {
  const out: (VNode | string)[] = [];
  let last = 0;
  INLINE.lastIndex = 0;
  let m: RegExpExecArray | null;
  while ((m = INLINE.exec(text)) !== null) {
    if (m.index > last) {
      out.push(text.slice(last, m.index));
    }
    if (m[1]) {
      out.push(<strong>{m[2]}</strong>);
    } else if (m[3]) {
      out.push(<em>{m[4]}</em>);
    } else if (m[5]) {
      out.push(<code>{m[6]}</code>);
    } else {
      const label = m[8];
      const target = m[9];
      const isImage = m[7].startsWith('!');
      // Only http(s) links, only in block mode; everything else -- an
      // image, a javascript: URL, a link inside a question -- is its label.
      if (!isImage && blocks && /^https?:\/\//i.test(target)) {
        out.push(<a href={target} rel="noopener noreferrer" target="_blank">{label}</a>);
      } else {
        out.push(label);
      }
    }
    last = m.index + m[0].length;
  }
  if (last < text.length) {
    out.push(text.slice(last));
  }
  return out;
}
