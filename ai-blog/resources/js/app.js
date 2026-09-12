import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.data('theme', () => ({
    dark: false,

    init() {
        this.dark = document.documentElement.dataset.theme === 'dark';
    },

    toggle() {
        this.dark = !this.dark;
        const theme = this.dark ? 'dark' : 'light';

        document.documentElement.dataset.theme = theme;
        localStorage.setItem('ink-signal-theme', theme);
    },
}));

Alpine.start();
