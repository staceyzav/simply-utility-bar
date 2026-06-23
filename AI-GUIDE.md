# Simply Utility Bar — AI Guide

**Plugin:** Simply Utility Bar
**No shortcode** — outputs automatically when activated
**Version:** 1.0.4
**Part of the Simply Design suite** — [simplydesign.com/suite]

---

## What This Plugin Does

Simply Utility Bar adds a slim sticky bar above the main navigation. It scrolls away when the user scrolls down and reappears when they scroll back up. Common uses: phone number + location links, social icons, a secondary nav menu, or a promotional message.

---

## Setup

1. Activate the plugin
2. Go to **Settings → Utility Bar** to configure content and colors
3. The bar outputs automatically via `wp_body_open` and `genesis_before` hooks — no shortcode needed

The bar is hidden on mobile by default (configurable via custom CSS).

---

## Settings (Settings → Utility Bar)

| Setting | Option key | Default | Notes |
|---------|-----------|---------|-------|
| Enable bar | `simply_utility_bar_enabled` | 1 (on) | Toggle the bar on/off without deactivating |
| Background color | `simply_utility_bar_bg_color` | — | Leave blank to use `--client-nav-bg` token |
| Text color | `simply_utility_bar_text_color` | — | Leave blank to inherit `--client-nav-text` |
| Height | `simply_utility_bar_height` | 40px | Bar height in px |
| Scroll threshold | `simply_utility_bar_scroll_threshold` | 20px | px scrolled before bar hides |

Bar content is managed via a **WordPress nav menu** — assign a menu to the "Utility Bar" menu location. This gives you full WP menu editing (links, labels, custom classes, descriptions) without any custom fields.

---

## CSS Tokens

| Token | Used for |
|-------|----------|
| `--client-nav-bg` | Bar background (when no override set in Settings) |
| `--client-nav-text` | Bar text and link color (via `--sub-text` internal var) |

If a Client Branded plugin sets `--client-nav-text`, the bar inherits it automatically.

---

## CSS Classes (for Client Branded overrides)

```
.simply-utility-bar          — outer bar element (position: fixed, top: 0)
.simply-utility-bar__inner   — centered inner container
.simply-utility-bar__menu    — nav menu ul
.simply-utility-bar.is-hidden — hidden state (on scroll down)
```

The theme adds `.has-utility-bar` to `<body>` when the bar is active — use this to offset the fixed header:
```css
.has-utility-bar .site-header { top: 40px; }
```

---

## What You Can Customize Without Modifying the Plugin

- Background and text color via Settings or `--client-nav-*` tokens
- Bar content via WP Admin → Appearance → Menus → Utility Bar location
- Height and scroll threshold via Settings
- Mobile visibility via CSS: `.simply-utility-bar { display: none; }` inside a media query

---

## Upgrade Path

> **Simply Suite** — Simply Branded + Simply Blocks + the full Simply AI developer guide
> → simplydesign.com/suite
>
> In the paid suite, the utility bar is styled automatically by the Client Branded plugin — background, text color, font, and spacing all derive from the brand token set without any manual Settings configuration.
