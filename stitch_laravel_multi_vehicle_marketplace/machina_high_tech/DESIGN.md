# Design System Strategy: Kinetic Precision

## 1. Overview & Creative North Star
The Creative North Star for this design system is **"The Kinetic Gallery."** 

In the automotive world, luxury is defined by the tension between raw power and refined engineering. We are moving away from the "catalog" feel of traditional e-commerce. Instead, we are designing a high-end editorial experience where every vehicle is treated as a masterpiece in a digital showroom. 

The layout must break the rigid, boxy grid common in retail. We will utilize **intentional asymmetry**, where text elements might overlap high-fidelity imagery, and **tonal depth** that mimics the environment of a premium underground garage. This is about high-tech immersion—where the UI feels like a seamless extension of a vehicle’s heads-up display.

---

## 2. Colors: The Chromatic Palette
The palette is rooted in deep, charcoal foundations to allow metallic silvers and electric accents to "ignite" the screen.

### Tonal Foundations
*   **Background (`#121416`):** Our "Deep Charcoal." This is the canvas. It is not pure black, but a rich, matte finish that provides more depth for layering.
*   **Surface Tiers:** Use `surface-container-low` (`#1a1c1e`) through `surface-container-highest` (`#333537`) to define hierarchy. 

### Accent & Interaction
*   **Primary (`#b6c4ff`):** Our "Electric Cool." Used for primary actions and brand-critical highlights.
*   **Tertiary (`#00daf3`):** The "Tech Accent." Use this sparingly for data visualization, EV-specific features, or "Live" status indicators.

### The "No-Line" Rule
**Explicit Instruction:** You are prohibited from using 1px solid borders to section off content. Boundaries must be defined solely through background color shifts. For example, a vehicle specification card (`surface-container-low`) should sit on the main `surface` background. The shift in hex value is the border.

### The "Glass & Gradient" Rule
To avoid a flat, "web template" look:
*   **Glassmorphism:** For floating navigation bars or overlays, use `surface-variant` at 60% opacity with a `24px` backdrop blur.
*   **Signature Textures:** Apply a subtle linear gradient to Primary CTAs (from `primary_container` to `primary`). This mimics the light catch on a car’s metallic bodywork.

---

## 3. Typography: Editorial Authority
We use a high-contrast pairing to balance technical precision with premium readability.

*   **Display & Headlines (Space Grotesk):** This is our "Engineering" font. Its geometric, slightly industrial apertures feel high-tech and intentional. Use `display-lg` for hero statements—don't be afraid to use `negative-tracking` (-2%) to make it feel tighter and more aggressive.
*   **Body & Labels (Manrope):** This is our "Precision" font. Manrope offers exceptional legibility at small sizes for technical specs. Use `body-md` for standard descriptions and `label-sm` for technical data points (e.g., Torque, 0-60mph).

---

## 4. Elevation & Depth: Tonal Layering
Traditional shadows are often a crutch for poor layout. In this system, we use **Tonal Layering.**

*   **The Layering Principle:** Place a `surface-container-lowest` card on a `surface-container-low` section to create a "recessed" feel. Place a `surface-container-highest` element on a `surface` background to create "lift."
*   **Ambient Shadows:** If an element must float (like a "Book Test Drive" modal), use a shadow with a `48px` blur at `8%` opacity. The shadow color should be tinted with our primary color (`#b6c4ff`) to mimic the way light reflects off metallic surfaces.
*   **The Ghost Border:** For accessibility on inputs, use the `outline-variant` (`#434656`) at **15% opacity**. It should be felt, not seen.

---

## 5. Components: The Showroom Kit

### Product Cards (The Hero Component)
*   **Structure:** No dividers. Use `spacing-xl` (vertical whitespace) to separate the vehicle name from the price.
*   **Visuals:** Images must use a `surface-container-high` placeholder background.
*   **Interaction:** On hover, the card should transition from `surface-container-low` to `surface-container-high` with a smooth `300ms` cubic-bezier ease.

### Buttons
*   **Primary:** Bold, `primary` background with `on_primary` text. Use `rounded-sm` (0.125rem) for a sharp, precision-cut look. 
*   **Secondary:** No background. Use a `Ghost Border` and `primary` text.
*   **Tertiary/Ghost:** Text only, with an `electric blue` underline that appears only on hover.

### Inputs & Selectors
*   **Fields:** Use `surface-container-highest`. Labels should be in `label-md` and placed above the field, never inside.
*   **Selection Chips:** For choosing car colors or trim levels, use `rounded-full`. When selected, add a glowing outer ring using the `tertiary` token.

### Navigation
*   **Intuitive Flow:** The main nav should be pinned to the top using Glassmorphism. Navigation links use `title-sm` for a more authoritative, weighted presence than standard links.

---

## 6. Do’s and Don’ts

### Do:
*   **Embrace Negative Space:** Give the vehicles room to breathe. High-end brands aren't afraid of "empty" space.
*   **Use Asymmetry:** Place a heading on the left and the body text offset to the right. It creates a dynamic, editorial rhythm.
*   **Quality over Quantity:** Use one high-resolution hero image rather than a carousel of four mediocre ones.

### Don’t:
*   **Don't use dividers:** Never use a horizontal line to separate content. Use a background color shift or `2rem` of whitespace.
*   **Don't use standard "Blue":** Always stick to the `primary` and `tertiary` tokens provided. Avoid "safe" corporate blues.
*   **Don't over-round corners:** Stick to `sm` (0.125rem) or `md` (0.375rem). Overly rounded "bubbly" corners destroy the high-tech, aggressive aesthetic of the automotive industry.