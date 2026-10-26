/**
 * Brandstory Landing - automated checks.
 *
 * Run from the theme folder:   node --test tests/
 * Optional:                    BASE_URL=http://localhost/wordpress-assesment/ node --test tests/
 *
 * Two groups:
 *  1. Static checks on the theme files (no server needed).
 *  2. Integration checks against the rendered front page (needs the local WordPress running).
 */

const { test, describe, before } = require('node:test');
const assert = require('node:assert/strict');
const fs = require('node:fs');
const path = require('node:path');
const { execFileSync } = require('node:child_process');

const THEME = path.resolve(__dirname, '..');
const BASE_URL = (process.env.BASE_URL || 'http://localhost/wordpress-assesment/').replace(/\/?$/, '/');
const PHP = process.env.PHP_BIN || 'C:/xampp/php/php.exe';

const walk = (dir, out = []) => {
	for (const entry of fs.readdirSync(dir, { withFileTypes: true })) {
		const full = path.join(dir, entry.name);
		if (entry.isDirectory()) {
			if (!['node_modules', 'tests', '.git'].includes(entry.name)) walk(full, out);
		} else {
			out.push(full);
		}
	}
	return out;
};

const files = walk(THEME);
const phpFiles = files.filter((f) => f.endsWith('.php'));
const imageFiles = files.filter((f) => /\.(png|jpe?g|webp|svg|gif)$/i.test(f));

/* --------------------------------------------------------------------------
   1. Static checks
   -------------------------------------------------------------------------- */
describe('theme structure', () => {
	test('required WordPress theme files exist', () => {
		for (const f of ['style.css', 'index.php', 'functions.php', 'header.php', 'footer.php', 'front-page.php']) {
			assert.ok(fs.existsSync(path.join(THEME, f)), f + ' is missing');
		}
	});

	test('style.css carries a valid theme header', () => {
		const css = fs.readFileSync(path.join(THEME, 'style.css'), 'utf8');
		assert.match(css, /Theme Name:\s*\S/);
		assert.match(css, /Text Domain:\s*brandstory-landing/);
		assert.doesNotMatch(css, /<your name>/i, 'Author placeholder was not replaced');
	});

	test('every section listed in front-page.php has a template part', () => {
		const src = fs.readFileSync(path.join(THEME, 'front-page.php'), 'utf8');
		const names = [...src.matchAll(/^\s*'([a-z-]+)',/gm)].map((m) => m[1]);
		assert.ok(names.length >= 9, 'expected at least 9 sections, found ' + names.length);
		for (const n of names) {
			assert.ok(fs.existsSync(path.join(THEME, 'template-parts/sections', n + '.php')), 'template-parts/sections/' + n + '.php is missing');
		}
	});
});

describe('code quality', () => {
	test('all PHP files pass php -l', () => {
		for (const f of phpFiles) {
			const out = execFileSync(PHP, ['-l', f], { encoding: 'utf8' });
			assert.match(out, /No syntax errors/, path.relative(THEME, f) + ': ' + out.trim());
		}
	});

	test('main.js parses', () => {
		execFileSync(process.execPath, ['--check', path.join(THEME, 'assets/js/main.js')]);
	});

	test('main.css has balanced braces and no truncated values', () => {
		const css = fs.readFileSync(path.join(THEME, 'assets/css/main.css'), 'utf8');
		const open = (css.match(/{/g) || []).length;
		const close = (css.match(/}/g) || []).length;
		assert.equal(open, close, 'unbalanced braces');
		// A bare "<number>f;" after whitespace is a truncated "fr" unit; hex colours like #16161f; are preceded by "#" so they do not match.
		assert.doesNotMatch(css, /[\s:]\d+(\.\d+)?f;/, 'found a value like "1.1f;" (truncated fr unit)');
	});

	test('no stray debugging output in templates', () => {
		for (const f of phpFiles) {
			const src = fs.readFileSync(f, 'utf8');
			assert.doesNotMatch(src, /\b(var_dump|print_r|console\.log)\s*\(/, path.relative(THEME, f) + ' contains debug output');
		}
	});
});

describe('assets', () => {
	test('image file names are lowercase, hyphenated and free of spaces', () => {
		for (const f of imageFiles) {
			const name = path.basename(f);
			assert.match(name, /^[a-z0-9][a-z0-9-]*\.[a-z0-9]+$/, 'bad file name: ' + path.relative(THEME, f));
		}
	});

	test('no single image exceeds 300 KB', () => {
		const heavy = imageFiles
			.map((f) => ({ f, kb: Math.round(fs.statSync(f).size / 1024) }))
			.filter((x) => x.kb > 300)
			.map((x) => path.relative(THEME, x.f) + ' (' + x.kb + ' KB)');
		assert.deepEqual(heavy, []);
	});

	test('total image payload stays under 2.5 MB', () => {
		const total = imageFiles.reduce((sum, f) => sum + fs.statSync(f).size, 0);
		assert.ok(total < 2.5 * 1024 * 1024, 'images total ' + (total / 1024 / 1024).toFixed(2) + ' MB');
	});

	test('every image referenced from CSS exists on disk', () => {
		const css = fs.readFileSync(path.join(THEME, 'assets/css/main.css'), 'utf8');
		const refs = [...css.matchAll(/url\(["']?\.\.\/images\/([^"')]+)["']?\)/g)].map((m) => m[1]);
		assert.ok(refs.length > 0, 'expected CSS image references');
		for (const r of refs) {
			assert.ok(fs.existsSync(path.join(THEME, 'assets/images', r)), 'CSS references missing image: ' + r);
		}
	});
});

/* --------------------------------------------------------------------------
   2. Integration checks against the rendered page
   -------------------------------------------------------------------------- */
describe('rendered front page', () => {
	let html = '';
	let status = 0;

	before(async () => {
		const res = await fetch(BASE_URL);
		status = res.status;
		html = await res.text();
	});

	test('responds with 200', () => assert.equal(status, 200));

	test('has no PHP warnings, notices or fatals in the output', () => {
		assert.doesNotMatch(html, /<b>(Warning|Notice|Fatal error|Deprecated)<\/b>/);
	});

	test('is a single well-formed document', () => {
		assert.equal((html.match(/<\/html>/g) || []).length, 1);
		assert.equal((html.match(/<main\b/g) || []).length, 1);
		assert.match(html, /<html[^>]*\blang=/);
		assert.match(html, /<meta name="viewport"/);
		assert.match(html, /<title>[^<]+<\/title>/);
	});

	test('has exactly one h1', () => {
		assert.equal((html.match(/<h1\b/g) || []).length, 1);
	});

	test('enqueues the theme stylesheet and script with cache-busting versions', () => {
		assert.match(html, /assets\/css\/main\.css\?ver=\d+/);
		assert.match(html, /assets\/js\/main\.js\?ver=\d+/);
	});

	test('renders every section in the design order', () => {
		const ids = [...html.matchAll(/<(?:section|footer)\b[^>]*\bid="([^"]+)"/g)].map((m) => m[1]);
		assert.deepEqual(ids, ['services', 'about', 'difference', 'partner', 'stats', 'team', 'faq', 'case-studies', 'contact', 'locations']);
		assert.match(html, /<section class="hero"/);
	});

	test('every <img> has an alt attribute', () => {
		const imgs = html.match(/<img\b[^>]*>/g) || [];
		assert.ok(imgs.length > 20, 'expected many images');
		const missing = imgs.filter((tag) => !/\balt=/.test(tag));
		assert.deepEqual(missing, []);
	});

	test('every image URL on the page returns 200', async () => {
		const urls = [...new Set((html.match(/<img\b[^>]*\bsrc="([^"]+)"/g) || []).map((tag) => tag.match(/src="([^"]+)"/)[1]))];
		const failures = [];
		for (const url of urls) {
			const res = await fetch(url, { method: 'HEAD' });
			if (res.status !== 200) failures.push(res.status + ' ' + url);
		}
		assert.deepEqual(failures, []);
	});

	test('interactive components are present with accessible state', () => {
		assert.equal((html.match(/data-accordion\b(?!-)/g) || []).length, 2, 'two accordions (Difference, FAQ)');
		assert.equal((html.match(/data-carousel\b(?!-)/g) || []).length, 2, 'two carousels (Team, Case studies)');
		assert.equal((html.match(/data-counter=/g) || []).length, 4, 'four stat counters');
		const triggers = html.match(/<button[^>]*data-accordion-trigger[^>]*>/g) || [];
		assert.ok(triggers.length >= 9, 'accordion triggers');
		assert.ok(triggers.every((t) => /aria-expanded="(true|false)"/.test(t)), 'each trigger has aria-expanded');
		assert.match(html, /data-nav-toggle[^>]*aria-expanded="false"/, 'mobile nav toggle');
	});

	test('navigation menu renders with dropdown children', () => {
		assert.ok((html.match(/menu-item-has-children/g) || []).length >= 6, 'six top-level items with children');
		assert.ok((html.match(/class="sub-menu"/g) || []).length >= 6, 'six sub-menus');
	});

	test('call-to-action buttons point at an existing anchor', () => {
		const targets = [...html.matchAll(/class="btn[^"]*"[^>]*href="#([^"]+)"/g)].map((m) => m[1]);
		assert.ok(targets.length >= 2, 'expected CTA buttons');
		for (const id of targets) {
			assert.match(html, new RegExp('\\bid="' + id + '"'), 'CTA target #' + id + ' does not exist on the page');
		}
	});

	test('no content links use a bare "#" href (menu items excluded)', () => {
		const bare = (html.match(/<a\b[^>]*href="#"[^>]*>/g) || []).filter((tag) => !/menu-item|footer__links/.test(tag));
		assert.deepEqual(bare, []);
	});
});
