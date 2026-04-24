/* ══════════════════════════════════════════════
   EXKNOT PREMIUM ANIMATION SYSTEM
   ══════════════════════════════════════════════ */

(function() {
    'use strict';
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    // ── INVISIBLE NETWORK CANVAS ──
    class NetworkCanvas {
        constructor() {
            this.canvas = document.getElementById('networkCanvas');
            if (!this.canvas || prefersReducedMotion) return;
            
            this.ctx = this.canvas.getContext('2d');
            this.particleCount = window.innerWidth > 1024 ? 70 : 40;
            this.connectionDistance = 150;
            
            this.init();
            window.addEventListener('resize', () => {
                this.particleCount = window.innerWidth > 1024 ? 70 : 40;
                this.init();
            });
            this.animate();
        }

        init() {
            this.canvas.width = window.innerWidth;
            this.canvas.height = window.innerHeight;
            this.particles = [];
            
            for(let i=0; i<this.particleCount; i++) {
                this.particles.push({
                    x: Math.random() * this.canvas.width,
                    y: Math.random() * this.canvas.height,
                    vx: (Math.random() - 0.5) * 0.3,
                    vy: (Math.random() - 0.5) * 0.3,
                    radius: Math.random() * 1 + 0.5
                });
            }
        }

        animate() {
            requestAnimationFrame(() => this.animate());
            this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);

            for(let i=0; i<this.particles.length; i++) {
                let p = this.particles[i];
                p.x += p.vx;
                p.y += p.vy;

                if(p.x < 0 || p.x > this.canvas.width) p.vx *= -1;
                if(p.y < 0 || p.y > this.canvas.height) p.vy *= -1;

                this.ctx.beginPath();
                this.ctx.arc(p.x, p.y, p.radius, 0, Math.PI * 2);
                this.ctx.fillStyle = 'rgba(255,255,255,0.15)';
                this.ctx.fill();

                for(let j=i+1; j<this.particles.length; j++) {
                    let p2 = this.particles[j];
                    let dx = p.x - p2.x;
                    let dy = p.y - p2.y;
                    let dist = Math.sqrt(dx*dx + dy*dy);

                    if(dist < this.connectionDistance) {
                        this.ctx.beginPath();
                        this.ctx.moveTo(p.x, p.y);
                        this.ctx.lineTo(p2.x, p2.y);
                        let opacity = (1 - (dist / this.connectionDistance)) * 0.12;
                        this.ctx.strokeStyle = `rgba(255,255,255,${opacity})`;
                        this.ctx.stroke();
                    }
                }
            }
        }
    }
    new NetworkCanvas();

    // ── Scroll Progress Bar ──
    const scrollBar = document.querySelector('.scroll-progress');
    if (scrollBar && !prefersReducedMotion) {
        window.addEventListener('scroll', () => {
            const h = document.documentElement.scrollHeight - window.innerHeight;
            scrollBar.style.transform = 'scaleX(' + (h > 0 ? window.scrollY / h : 0) + ')';
        }, { passive: true });
    }

    // ── Scroll Reveal (staggered) ──
    const revealEls = document.querySelectorAll('.reveal,.reveal-left,.reveal-right,.reveal-scale');
    if (prefersReducedMotion) {
        revealEls.forEach(el => el.classList.add('visible'));
    } else {
        const revealObs = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    revealObs.unobserve(entry.target);
                }
            });
        }, { threshold: 0.08, rootMargin: '0px 0px -40px 0px' });
        revealEls.forEach(el => revealObs.observe(el));
    }

    // ── Animated Counters ──
    document.querySelectorAll('[data-counter]').forEach(el => {
        const obs = new IntersectionObserver(([entry]) => {
            if (entry.isIntersecting) {
                obs.disconnect();
                const target = parseInt(el.dataset.target) || 0;
                const prefix = el.dataset.prefix || '';
                const suffix = el.dataset.suffix || '';
                const dur = 1800;
                const start = performance.now();
                const tick = (now) => {
                    const p = Math.min((now - start) / dur, 1);
                    const ease = 1 - Math.pow(1 - p, 4);
                    el.textContent = prefix + Math.floor(ease * target).toLocaleString() + suffix;
                    if (p < 1) requestAnimationFrame(tick);
                };
                requestAnimationFrame(tick);
            }
        }, { threshold: 0.3 });
        obs.observe(el);
    });

    // ── Nav scroll state ──
    const nav = document.getElementById('topNav');
    if (nav) {
        let ticking = false;
        window.addEventListener('scroll', () => {
            if (!ticking) {
                requestAnimationFrame(() => {
                    nav.classList.toggle('scrolled', window.scrollY > 30);
                    ticking = false;
                });
                ticking = true;
            }
        }, { passive: true });
    }

    // ── Mobile Drawer ──
    const drawerToggle = document.getElementById('mobileToggle');
    const drawer = document.getElementById('mobileDrawer');
    const drawerClose = document.getElementById('drawerClose');
    const drawerBackdrop = document.querySelector('.mobile-drawer-backdrop');
    if (drawerToggle && drawer) {
        const toggleDrawer = (open) => {
            drawer.classList.toggle('open', open);
            document.body.style.overflow = open ? 'hidden' : '';
        };
        drawerToggle.addEventListener('click', () => toggleDrawer(true));
        if (drawerClose) drawerClose.addEventListener('click', () => toggleDrawer(false));
        if (drawerBackdrop) drawerBackdrop.addEventListener('click', () => toggleDrawer(false));
    }

    // ── Magnetic Buttons ──
    if (!prefersReducedMotion) {
        document.querySelectorAll('.magnetic').forEach(btn => {
            btn.addEventListener('mousemove', (e) => {
                const rect = btn.getBoundingClientRect();
                const x = e.clientX - rect.left - rect.width / 2;
                const y = e.clientY - rect.top - rect.height / 2;
                btn.style.transform = 'translate(' + (x * 0.15) + 'px,' + (y * 0.15) + 'px)';
            });
            btn.addEventListener('mouseleave', () => {
                btn.style.transform = 'translate(0,0)';
            });
        });
    }

    // ── Card Tilt ──
    if (!prefersReducedMotion) {
        document.querySelectorAll('.tilt-card').forEach(card => {
            card.addEventListener('mousemove', (e) => {
                const rect = card.getBoundingClientRect();
                const x = (e.clientX - rect.left) / rect.width - 0.5;
                const y = (e.clientY - rect.top) / rect.height - 0.5;
                card.style.transform = 'perspective(800px) rotateY(' + (x * 6) + 'deg) rotateX(' + (-y * 6) + 'deg) translateY(-4px)';
            });
            card.addEventListener('mouseleave', () => {
                card.style.transform = 'perspective(800px) rotateY(0) rotateX(0) translateY(0)';
                card.style.transition = 'transform 0.5s ease';
                setTimeout(() => card.style.transition = '', 500);
            });
        });
    }

    // ── Parallax Elements ──
    if (!prefersReducedMotion) {
        const parallaxEls = document.querySelectorAll('[data-parallax]');
        if (parallaxEls.length > 0) {
            window.addEventListener('scroll', () => {
                const scrollY = window.scrollY;
                parallaxEls.forEach(el => {
                    const speed = parseFloat(el.dataset.parallax) || 0.1;
                    el.style.transform = 'translateY(' + (scrollY * speed) + 'px)';
                });
            }, { passive: true });
        }
    }
})();
