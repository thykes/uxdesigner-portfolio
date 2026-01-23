<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-1P12XNP41H"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'G-1P12XNP41H');
    </script>
    <?php if($icon = $site->favicon()->toFile()): ?>
    <link rel="icon" type="<?= $icon->mime() ?>" href="<?= $icon->url() ?>">
    <?php endif ?>
    <?php snippet('seo/head') ?>
    
    <!-- Robots: Explicitly allow indexing -->
    <meta name="robots" content="index, follow">

    <!-- Schema Markup -->
    <script type="application/ld+json">
    <?= json_encode([
        "@context" => "https://schema.org",
        "@type" => "Person",
        "name" => $site->title()->value(),
        "url" => $site->url(),
        "jobTitle" => "UI/UX Designer",
        "description" => $site->seo()->metaDescription()->exists() ? $site->seo()->metaDescription()->value() : $site->description()->value(),
        "sameAs" => $site->social_links()->toStructure()->map(function($social) {
            return $social->url()->value();
        })->values()
    ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) ?>
    </script>    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&amp;family=Inter:wght@300;400;500;600&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <?= css('assets/css/index.css') ?>
    
    <style type="text/tailwindcss">
        :root {
            --bg-deep: #0D0D0D;
            --charcoal: #1A1A1A;
            --accent: #E0FF00;
            --text-main: #FFFFFF;
            --text-muted: #A0A0A0;
        }
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-deep);
            color: var(--text-main);
            -webkit-font-smoothing: antialiased;
            min-height: max(884px, 100dvh);
        }
        .serif-display {
            font-family: 'Playfair Display', serif;
        }
        .masonry-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 2rem;
            row-gap: 6rem;
        }
        @media (min-width: 768px) {
            .masonry-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        @media (min-width: 1024px) {
            .masonry-grid {
                grid-template-columns: repeat(12, 1fr);
            }
            .item-large { grid-column: span 7; }
            .item-small { grid-column: span 5; }
            .item-tall { grid-column: span 5; grid-row: span 2; }
            .item-wide { grid-column: span 7; }
            .mt-offset { margin-top: 4rem; }
        }
        .filter-link {
            position: relative;
            transition: color 0.3s ease;
        }
        .filter-link::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 0;
            height: 1px;
            background-color: var(--accent);
            transition: width 0.3s ease;
        }
        .filter-link:hover::after, .filter-link.active::after {
            width: 100%;
        }
        .filter-link.active {
            color: var(--accent);
        }
        
        /* Neon Rainbow Logic */
        @keyframes neonflow {
            0% { stop-color: #ff0000; }
            20% { stop-color: #ffff00; }
            40% { stop-color: #00ff00; }
            60% { stop-color: #00ffff; }
            80% { stop-color: #0000ff; }
            100% { stop-color: #ff00ff; }
        }
        .neon-stop-1 { animation: neonflow 4s infinite linear 0s; }
        .neon-stop-2 { animation: neonflow 4s infinite linear -1s; }
        .neon-stop-3 { animation: neonflow 4s infinite linear -2s; }
    </style>
</head>
<body class="selection:bg-[var(--accent)] selection:text-black">
    <div class="max-w-[1440px] mx-auto px-6 md:px-12 lg:px-20">
        <header class="py-10 flex justify-between items-center">
            <div class="group cursor-pointer">
                <!-- Logo Container: Removed border box for cleaner look with SVG, kept dimensions -->
                <a href="<?= $site->url() ?>" class="w-12 h-12 flex items-center justify-center transition-transform duration-300 group-hover:scale-110">
                    <svg viewBox="0 0 291 315" fill="none" class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <linearGradient id="neonGradient" x1="0%" y1="0%" x2="200%" y2="200%">
                                <stop offset="0%" class="neon-stop-1" stop-color="#ff0000" />
                                <stop offset="50%" class="neon-stop-2" stop-color="#00ff00" />
                                <stop offset="100%" class="neon-stop-3" stop-color="#0000ff" />
                            </linearGradient>
                        </defs>
                        <path d="M235.379 5.5H55.6213H5V122.955H55.6213V56.2818H120.017V138.5H170.983V56.2818H235.379V122.955H286V5.5H235.379Z" fill="url(#neonGradient)"/>
                        <path d="M171.159 186.5H119.841V258.853H55V309.5H236V258.853H171.159V186.5Z" fill="url(#neonGradient)"/>
                    </svg>
                </a>
            </div>
            <nav class="flex items-center">
                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-8 text-sm uppercase tracking-widest font-medium">
                    <?php foreach($site->navigation()->toStructure() as $navItem): ?>
                        <?php 
                            $linkUrl = ($navItem->link_type() == 'internal') ? ($navItem->page()->toPage() ? $navItem->page()->toPage()->url() : '') : $navItem->url(); 
                            if (!$linkUrl) continue;
                        ?>
                        <a class="hover:text-[var(--accent)] transition-colors <?= $page->url() == $linkUrl ? 'text-[var(--accent)]' : '' ?>" 
                           href="<?= $linkUrl ?>" 
                           <?= ($navItem->link_type() == 'external') ? 'target="_blank" rel="noopener noreferrer"' : '' ?>>
                            <?= $navItem->label() ?>
                        </a>
                    <?php endforeach ?>
                </div>

                <!-- Mobile Menu Toggle -->
                <button id="menu-toggle" class="material-symbols-outlined text-3xl md:hidden z-50 relative hover:text-[var(--accent)] transition-colors">menu</button>
            </nav>
        </header>

        <!-- Mobile Menu Overlay -->
        <div id="mobile-menu" class="fixed inset-0 bg-[var(--bg-deep)]/95 backdrop-blur-xl z-40 translate-x-full transition-transform duration-500 ease-in-out md:hidden flex flex-col justify-center items-center space-y-12 text-3xl uppercase tracking-widest font-light">
            <a class="hover:text-[var(--accent)] transition-colors" href="<?= $site->url() ?>">Home</a>
            <?php foreach($site->navigation()->toStructure() as $navItem): ?>
                <?php 
                    $linkUrl = ($navItem->link_type() == 'internal') ? ($navItem->page()->toPage() ? $navItem->page()->toPage()->url() : '') : $navItem->url(); 
                    if (!$linkUrl) continue;
                ?>
                <a class="hover:text-[var(--accent)] transition-colors <?= $page->url() == $linkUrl ? 'text-[var(--accent)]' : '' ?>" 
                   href="<?= $linkUrl ?>"
                   <?= ($navItem->link_type() == 'external') ? 'target="_blank" rel="noopener noreferrer"' : '' ?>>
                    <?= $navItem->label() ?>
                </a>
            <?php endforeach ?>
        </div>

        <script>
            const menuToggle = document.getElementById('menu-toggle');
            const mobileMenu = document.getElementById('mobile-menu');
            const body = document.body;

            menuToggle.addEventListener('click', () => {
                const isOpen = mobileMenu.classList.contains('translate-x-0');
                
                if (isOpen) {
                    mobileMenu.classList.remove('translate-x-0');
                    mobileMenu.classList.add('translate-x-full');
                    menuToggle.innerText = 'menu';
                    body.style.overflow = '';
                } else {
                    mobileMenu.classList.remove('translate-x-full');
                    mobileMenu.classList.add('translate-x-0');
                    menuToggle.innerText = 'close';
                    body.style.overflow = 'hidden';
                }
            });
        </script>

        <main>
