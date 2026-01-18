# Tim Hykes - UX Designer Portfolio

The personal portfolio website for **Tim Hykes**, a DC-based UX Designer turning complex challenges into seamless, human-centered digital experiences.

🌐 **Live Site:** [timhykes.com](https://timhykes.com)

## 🛠️ Technology Stack

Built with performance, flexibility, and design in mind:

- **[Kirby CMS v5](https://getkirby.com/):** A file-based CMS that provides a powerful and flexible backend without the complexity of a database.
- **[Tailwind CSS](https://tailwindcss.com/):** Utility-first CSS framework for rapid, responsive, and custom UI development.
- **PHP 8.2+:** Server-side scripting language driving the CMS logic.
- **Lazy Loading & Masonry Layouts:** Custom implementation for optimized image loading and dynamic grid displays.

## ✨ Key Features

- **Dynamic "Works" Grid:** Automatically fetches and displays published projects from the CMS.
- **Custom Block System:** Flexible content blocks (Challenges, Strategies, Pull Quotes, Technical Callouts) allowing for unique layouts per case study.
- **Featured Projects:** Homepage "Featured" section controllable directly via the Panel.
- **SEO Optimization:** Integrated `tobimori/kirby-seo` plugin for full control over Meta Tags, Open Graph, and Twitter Cards.
- **Responsive Design:** Fully fluid layout adapting from mobile devices to large desktop screens.
- **Dark Mode Aesthetic:** sophisticated dark theme with neon accents and glassmorphism effects.

## 🚀 Setup & Development

To run this project locally:

1.  **Clone the repository:**

    ```bash
    git clone https://github.com/thykes/uxdesigner-portfolio.git
    cd uxdesigner-portfolio
    ```

2.  **Install Dependencies:**

    ```bash
    composer install
    npm install
    ```

3.  **Start Development Server:**
    You can use Laravel Herd, Valet, or PHP's built-in server:

    ```bash
    php -S localhost:8000 -t .
    ```

4.  **Access the Panel:**
    Go to `http://localhost:8000/panel` to manage content.

## 📦 Deployment

This project is deployed on **Fortrabbit** (Professional Stack).

- **Production URL:** `https://timhykes.com`
- **Staging/App URL:** `https://timhykes.frb.io`

**Deployment Command:**

```bash
git push fortrabbit main
```

## 📄 License

© 2026 Tim Hykes. All Rights Reserved.
Designed & Developed by Tim Hykes.
