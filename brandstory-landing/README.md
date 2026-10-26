# Brandstory Landing – WordPress theme

Custom WordPress theme that recreates the **"Digital Marketing Agency In Abu Dhabi"** landing page from the supplied Figma file. Built for the Junior Associate – Web Developer assessment.

- Custom theme (no page builder), classic PHP templates
- Mobile-first CSS with design tokens, three breakpoints
- Vanilla JavaScript for the mobile nav, accordions, carousels and stat counters
- Automated test suite (`node --test`)

## Requirements

- WordPress 6.0+ (developed on 7.1), PHP 7.4+
- Node 18+ only if you want to run the tests

## Install

1. Copy `brandstory-landing/` into `wp-content/themes/` (or zip the folder and upload it under **Appearance → Themes → Add New → Upload**).
2. Activate **Brandstory Landing**.
3. **Pages → Add New**: create a page called *Home* and publish it.
4. **Settings → Reading**: choose *A static page* and set *Home* as the homepage.
5. **Settings → Permalinks**: choose *Post name*.
6. **Appearance → Menus**: create a *Primary* menu (six items with child links) and assign it to *Primary Menu*. Optional: create *Footer Links* and *Footer Services* menus. Each location renders a sensible fallback until a menu is assigned.

## Folder structure

```
brandstory-landing/
├── style.css                  theme header only
├── functions.php              setup, enqueues, menus, fallbacks, helpers
├── header.php / footer.php    document shell, sticky nav, five-column footer
├── front-page.php             assembles the landing page from section parts
├── index.php                  fallback template
├── template-parts/sections/   one file per design section
│   ├── hero.php               hero + "Trusted by" double marquee
│   ├── services.php           three service cards
│   ├── about.php              image + bullet copy
│   ├── difference.php         image + accordion
│   ├── partner.php            three illustrated cards
│   ├── stats.php              purple banner + overlapping stat cards
│   ├── team.php               looping photo carousel
│   ├── faq.php                accordion
│   ├── case-studies.php       looping card carousel
│   └── locations.php          link grid over the UAE map (rendered after the footer, as in Figma)
├── assets/
│   ├── css/main.css           tokens → reset → components → sections
│   ├── js/main.js             nav toggle, accordion, carousel, count-up
│   ├── images/                WebP photography, SVG/PNG icons, logos
│   └── fonts/                 optional self-hosted HK Grotesk
└── tests/theme.test.js        automated checks
```

Every repeated block (cards, logos, FAQ rows, links) is driven by a PHP array at the top of its template part and rendered with a loop, so the markup exists once.

## Design tokens and typography

Colours, type sizes, radii, container width and spacing live as custom properties on `:root` at the top of `main.css`. Headings use **HK Grotesk** when the licensed `.woff2` files are placed in `assets/fonts/` (an `@font-face` block is ready); otherwise they fall back to **Hanken Grotesk** from Google Fonts. Body copy and the footer use **Poppins**.

## Responsiveness

Mobile-first, with breakpoints at **768px** (tablet) and **1100px** (desktop). Verified with no horizontal overflow at 320, 360, 390, 414, 768, 820, 1024, 1280, 1440 and 1920px. Desktop-only overrides for the case-study, locations and footer grids sit at the end of `main.css` so they always win over the tablet rules.

## Interactions

- Sticky pill navigation with hover dropdowns; hamburger panel below 1100px
- Hover states on buttons, cards (dark → white), icons, links and accordion rows
- Double logo marquee in opposite directions, pauses on hover, static under `prefers-reduced-motion`
- Accordions (single open, `aria-expanded`, animated height)
- Carousels: native scroll-snap, arrow buttons, swipe, infinite loop via cloned slides, instant scrolling under `prefers-reduced-motion`
- Stat numbers count up when scrolled into view

## Performance and SEO

- All photography converted to WebP (page image payload ≈ 250 KB, down from ≈ 10 MB of PNG exports)
- `width`/`height` on every image, `loading="lazy"` below the fold, hero background preloaded
- Script enqueued with `defer`; fonts preconnected with `display=swap`
- Semantic landmarks, one `h1`, descriptive `alt` text, unique accessible names on repeated links, skip link, visible focus styles

## Tests

```bash
cd wp-content/themes/brandstory-landing
node --test tests/
```

Static checks (theme files, PHP lint, JS parse, CSS sanity, image naming and size budgets) and integration checks against the rendered front page (status, no PHP notices, document structure, section order, every image 200, accessible interactive components, functional CTAs). Set `BASE_URL` if the site is not at `http://localhost/wordpress-assesment/`.

## Deliberate deviations from Figma

- The open FAQ answer is set in a serif face in Figma; the theme keeps the body sans-serif for consistency.
- The statistics banner shows "Satisfied Clients" twice in Figma; the third card reads "Years of Experience".
- The "Trusted by" logos use the brands present in the Figma export.
