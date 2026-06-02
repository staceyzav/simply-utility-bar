# Simply Utility Bar — Changelog
https://simplydesign.com/simply-utility-bar

## [1.0.3] — 2026-06-02

### Changed
- Inner wrapper: padding changed from 5% to 5px left/right to match theme baseline
  IMF config overrides padding-right to 32px to align with CTA button right edge

---

## [1.0.2] — 2026-06-02

### Fixed
- Inner wrapper: removed 1200px max-width, now full width with 5% left/right padding to match main nav

---

## [1.0.1] — 2026-06-02

### Fixed
- Default text color changed from --client-nav-text (#fff) to --client-nav-bg (dark brand color)
  Transparent bar on a light page background requires dark text to be readable

---

## [1.0.0] — 2026-06-02

### Added
- Initial release
- WordPress menu location "Utility Bar" — supports links and plain text items
- Fixed position above site header, transparent by default, scrolls away on scroll
- CSS custom property token system: --sub-bg, --sub-text, --sub-height
  Inherits from --client-nav-text automatically when Simply Client Config is active
- Admin settings: enable/disable, background color, text color, height, scroll threshold
  Leave color fields blank to use token defaults (recommended)
- body_class filter adds .has-utility-bar server-side (no JS layout flash)
- Scroll-away JS: .scrolled-away on bar, .scrolled on body via RAF-throttled passive listener
- Hooks into wp_body_open (standard WP) and genesis_before (Genesis Framework)
  Static flag prevents double output
- sub-divider CSS class for optional separator between menu items
