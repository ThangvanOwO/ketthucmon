/**
 * SPARKLE EASTER EGG - 花火 (Sparkle/Hanabi from Honkai Star Rail)
 * 
 * Sparkle's design: Traditional Japanese Kabuki mask, red-black-white colors,
 * Stellaron Hunter, Path of Nihility, Quantum element.
 * Personality: Playful, chaotic, theatrical, likes to "play" with everyone.
 * 
 * Logic: Single click → navigate to cart normally.
 *        Rapid clicks (3+ within 600ms) → Sparkle Easter Egg!
 */
(function() {
    'use strict';

    var clickCount = 0;
    var clickTimer = null;
    var CLICK_THRESHOLD = 3;
    var CLICK_TIMEOUT = 600;
    var isActive = false;

    // Sparkle's mask - Kabuki-inspired with her signature red/black/white design
    var sparkleMaskSVG = [
        '<svg viewBox="0 0 300 360" xmlns="http://www.w3.org/2000/svg">',
        '<defs>',
        '  <linearGradient id="sg" x1="0%" y1="0%" x2="100%" y2="100%">',
        '    <stop offset="0%" style="stop-color:#dc143c;stop-opacity:1"/>',
        '    <stop offset="40%" style="stop-color:#8b0000;stop-opacity:1"/>',
        '    <stop offset="100%" style="stop-color:#2d0a0a;stop-opacity:1"/>',
        '  </linearGradient>',
        '  <filter id="sglow">',
        '    <feGaussianBlur stdDeviation="4" result="blur"/>',
        '    <feMerge><feMergeNode in="blur"/><feMergeNode in="SourceGraphic"/></feMerge>',
        '  </filter>',
        '  <radialGradient id="rg" cx="50%" cy="40%" r="50%">',
        '    <stop offset="0%" style="stop-color:#ff2d55;stop-opacity:0.3"/>',
        '    <stop offset="100%" style="stop-color:#dc143c;stop-opacity:0"/>',
        '  </radialGradient>',
        '</defs>',
        '',
        '<!-- Face base -->',
        '<ellipse cx="150" cy="160" rx="110" ry="140" fill="url(#sg)" filter="url(#sglow)"/>',
        '',
        '<!-- Inner face (white kabuki style) -->',
        '<ellipse cx="150" cy="165" rx="95" ry="125" fill="#f5f0e8" opacity="0.95"/>',
        '',
        '<!-- Forehead decoration - Sparkle\'s signature star pattern -->',
        '<path d="M 150 45 L 160 75 L 190 75 L 165 95 L 175 125 L 150 108 L 125 125 L 135 95 L 110 75 L 140 75 Z" fill="#dc143c" opacity="0.9"/>',
        '',
        '<!-- Eye area - dramatic kabuki makeup -->',
        '<!-- Left eye -->',
        '<path d="M 70 130 Q 100 110 130 130 Q 100 150 70 130 Z" fill="#1a0000"/>',
        '<ellipse cx="100" cy="133" rx="18" ry="14" fill="#dc143c"/>',
        '<ellipse cx="100" cy="131" rx="10" ry="10" fill="#ff2d55"/>',
        '<ellipse cx="100" cy="129" rx="5" ry="6" fill="#fff" opacity="0.8"/>',
        '<!-- Right eye -->',
        '<path d="M 170 130 Q 200 110 230 130 Q 200 150 170 130 Z" fill="#1a0000"/>',
        '<ellipse cx="200" cy="133" rx="18" ry="14" fill="#dc143c"/>',
        '<ellipse cx="200" cy="131" rx="10" ry="10" fill="#ff2d55"/>',
        '<ellipse cx="200" cy="129" rx="5" ry="6" fill="#fff" opacity="0.8"/>',
        '',
        '<!-- Kabuki nose -->',
        '<path d="M 145 155 L 150 140 L 155 155" stroke="#8b0000" stroke-width="2" fill="none"/>',
        '',
        '<!-- Smile - theatrical grin -->',
        '<path d="M 100 190 Q 125 220 150 210 Q 175 220 200 190" stroke="#8b0000" stroke-width="3" fill="none" stroke-linecap="round"/>',
        '<path d="M 110 195 Q 130 210 150 205 Q 170 210 190 195" fill="#dc143c" opacity="0.3"/>',
        '',
        '<!-- Cheek marks - kabuki style -->',
        '<line x1="55" y1="150" x2="75" y2="170" stroke="#dc143c" stroke-width="3" stroke-linecap="round"/>',
        '<line x1="75" y1="150" x2="55" y2="170" stroke="#dc143c" stroke-width="3" stroke-linecap="round"/>',
        '<line x1="225" y1="150" x2="245" y2="170" stroke="#dc143c" stroke-width="3" stroke-linecap="round"/>',
        '<line x1="245" y1="150" x2="225" y2="170" stroke="#dc143c" stroke-width="3" stroke-linecap="round"/>',
        '',
        '<!-- Forehead dots -->',
        '<circle cx="120" cy="65" r="3" fill="#8b0000" opacity="0.6"/>',
        '<circle cx="180" cy="65" r="3" fill="#8b0000" opacity="0.6"/>',
        '<circle cx="150" cy="55" r="4" fill="#dc143c" opacity="0.7"/>',
        '',
        '<!-- Mask border -->',
        '<ellipse cx="150" cy="160" rx="110" ry="140" fill="none" stroke="#2d0a0a" stroke-width="4" opacity="0.5"/>',
        '',
        '</svg>'
    ].join('');

    // Sparkle's playful quotes (mix of Japanese and playful symbols)
    var sparkleQuotes = [
        '花火', '🎭', '♪', '♡', '✧', '✿', '☆',
        'ふふふ', 'あはは', '✨', '🎪', '♠',
        'This is my stage!', 'You found me~',
        'Let\'s play!', '花火は、今ここに'
    ];

    function init() {
        // Find cart link in navbar
        var navLinks = document.querySelectorAll('nav a[href*="cart"]');
        if (navLinks.length === 0) return;

        navLinks.forEach(function(cartLink) {
            cartLink.addEventListener('click', function(e) {
                if (window.location.pathname.includes('/cart')) return;

                clickCount++;

                if (clickTimer) clearTimeout(clickTimer);

                if (clickCount >= CLICK_THRESHOLD) {
                    e.preventDefault();
                    clickCount = 0;
                    activateSparkle();
                    return;
                }

                e.preventDefault();

                clickTimer = setTimeout(function() {
                    clickCount = 0;
                    window.location.href = cartLink.href;
                }, CLICK_TIMEOUT);
            }, true);
        });
    }

    function activateSparkle() {
        if (isActive) return;
        isActive = true;

        if (!document.querySelector('link[href*="sparkle.css"]')) {
            var link = document.createElement('link');
            link.rel = 'stylesheet';
            link.href = '/css/sparkle.css';
            document.head.appendChild(link);
        }

        showPreloader(function() {
            shatterScreen(function() {
                showMask(function() {
                    transformPage();
                });
            });
        });
    }

    function showPreloader(callback) {
        var preloader = document.createElement('div');
        preloader.id = 'sparkle-preloader';
        preloader.innerHTML = '<div class="sparkle-loading-logo">花火</div>' +
            '<div class="sparkle-loading-bar"></div>' +
            '<div class="sparkle-loading-text">Sparkle is coming...</div>';
        document.body.appendChild(preloader);

        requestAnimationFrame(function() { preloader.classList.add('active'); });

        // Glitch effect midway
        setTimeout(function() {
            var glitch = document.createElement('div');
            glitch.id = 'sparkle-glitch';
            document.body.appendChild(glitch);
            glitch.classList.add('active');
        }, 2000);

        setTimeout(function() {
            preloader.style.opacity = '0';
            setTimeout(function() {
                preloader.remove();
                callback();
            }, 300);
        }, 4000);
    }

    function shatterScreen(callback) {
        var shatter = document.createElement('div');
        shatter.id = 'sparkle-shatter';
        document.body.appendChild(shatter);

        var width = window.innerWidth;
        var height = window.innerHeight;
        var cols = 8, rows = 6;
        var pieceW = width / cols, pieceH = height / rows;

        for (var r = 0; r < rows; r++) {
            for (var c = 0; c < cols; c++) {
                var piece = document.createElement('div');
                piece.className = 'shatter-piece';
                piece.style.left = (c * pieceW) + 'px';
                piece.style.top = (r * pieceH) + 'px';
                piece.style.width = pieceW + 'px';
                piece.style.height = pieceH + 'px';

                var angle = Math.atan2(r - rows/2, c - cols/2);
                var distance = 200 + Math.random() * 400;
                piece.style.setProperty('--tx', Math.cos(angle) * distance + 'px');
                piece.style.setProperty('--ty', Math.sin(angle) * distance + 'px');
                piece.style.setProperty('--tr', (Math.random() * 360 - 180) + 'deg');
                piece.style.animationDelay = (Math.random() * 0.3) + 's';

                shatter.appendChild(piece);
            }
        }

        shatter.classList.add('active');
        setTimeout(function() { shatter.remove(); callback(); }, 1500);
    }

    function showMask(callback) {
        var mask = document.createElement('div');
        mask.id = 'sparkle-mask';
        mask.innerHTML = '<div class="sparkle-mask-container">' +
            '<div class="sparkle-mask-glow"></div>' +
            '<div class="sparkle-mask-svg">' + sparkleMaskSVG + '</div>' +
            '<div class="sparkle-mask-text">花火は、今ここに</div>' +
            '</div>';
        document.body.appendChild(mask);
        mask.classList.add('active');

        // Sparkle's playful laugh bubbles
        setTimeout(function() { spawnLaughBubbles(); }, 500);
        setTimeout(function() { spawnLaughBubbles(); }, 1200);
        setTimeout(function() { spawnLaughBubbles(); }, 1800);

        setTimeout(function() {
            mask.style.opacity = '0';
            mask.style.transition = 'opacity 0.8s ease';
            setTimeout(function() {
                mask.remove();
                var glitch = document.getElementById('sparkle-glitch');
                if (glitch) {
                    glitch.classList.remove('active');
                    setTimeout(function() { glitch.remove(); }, 500);
                }
                callback();
            }, 800);
        }, 3000);
    }

    function spawnLaughBubbles() {
        for (var i = 0; i < 6; i++) {
            (function(index) {
                setTimeout(function() {
                    var bubble = document.createElement('div');
                    bubble.className = 'sparkle-laugh';
                    bubble.textContent = sparkleQuotes[Math.floor(Math.random() * sparkleQuotes.length)];
                    bubble.style.left = (15 + Math.random() * 70) + 'vw';
                    bubble.style.top = (25 + Math.random() * 50) + 'vh';
                    bubble.style.fontSize = (1.2 + Math.random() * 2.5) + 'rem';
                    document.body.appendChild(bubble);
                    setTimeout(function() { bubble.remove(); }, 2500);
                }, index * 100);
            })(i);
        }
    }

    function transformPage() {
        document.body.classList.add('sparkle-mode');

        // Floating masks in background
        for (var i = 0; i < 10; i++) {
            var mask = document.createElement('div');
            mask.className = 'sparkle-floating-mask';
            mask.innerHTML = sparkleMaskSVG;
            mask.style.left = (5 + Math.random() * 90) + 'vw';
            mask.style.top = (5 + Math.random() * 90) + 'vh';
            mask.style.setProperty('--duration', (5 + Math.random() * 10) + 's');
            mask.style.setProperty('--delay', (Math.random() * 5) + 's');
            document.body.appendChild(mask);
        }

        showSparkleNotification();
        setTimeout(function() { removeSparkleMode(); }, 30000);
    }

    function showSparkleNotification() {
        var style = document.createElement('style');
        style.textContent = '@keyframes slideInRight{from{transform:translateX(100px);opacity:0}to{transform:translateX(0);opacity:1}}@keyframes fadeOut{from{opacity:1}to{opacity:0;visibility:hidden}}';
        document.head.appendChild(style);

        var notif = document.createElement('div');
        notif.style.cssText = 'position:fixed;bottom:24px;right:24px;z-index:99999;background:linear-gradient(135deg,rgba(220,20,60,0.15),rgba(139,0,0,0.1));border:1px solid rgba(220,20,60,0.3);border-radius:16px;padding:16px 24px;backdrop-filter:blur(20px);font-family:Manrope,sans-serif;color:#e2e2e5;box-shadow:0 8px 32px rgba(220,20,60,0.2);animation:slideInRight 0.5s ease-out,fadeOut 0.5s ease-in 28.5s forwards;max-width:320px;';
        notif.innerHTML = '<div style="display:flex;align-items:center;gap:10px;margin-bottom:8px;">' +
            '<span style="font-size:1.5rem;">🎭</span>' +
            '<span style="font-weight:700;font-size:0.9rem;color:#dc143c;">花火 SPARKLE</span>' +
            '</div>' +
            '<p style="font-size:0.8rem;color:#c3c5d8;margin:0;">Bạn đã tìm ra easter egg! Trang sẽ trở lại bình thường sau 30 giây. 🎪</p>';
        document.body.appendChild(notif);
        setTimeout(function() { notif.remove(); style.remove(); }, 30000);
    }

    function removeSparkleMode() {
        document.body.classList.remove('sparkle-mode');
        document.querySelectorAll('.sparkle-floating-mask').forEach(function(el) { el.remove(); });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();
