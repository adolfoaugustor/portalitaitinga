import './bootstrap';
import '@coreui/coreui/dist/css/coreui.min.css';
import 'simplebar/dist/simplebar.min.css';
import '../css/app.css';

import * as coreui from '@coreui/coreui';
import SimpleBar from 'simplebar';

window.coreui = coreui;
window.SimpleBar = SimpleBar;

const themeKey = 'portalitaitinga-theme';

const applyTheme = (theme) => {
    const resolvedTheme = theme === 'auto'
        ? (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light')
        : theme;

    document.documentElement.setAttribute('data-coreui-theme', resolvedTheme);
};

applyTheme(localStorage.getItem(themeKey) ?? 'light');

window.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('[data-coreui-theme-value]').forEach((toggle) => {
        toggle.addEventListener('click', () => {
            const theme = toggle.getAttribute('data-coreui-theme-value') ?? 'light';
            localStorage.setItem(themeKey, theme);
            applyTheme(theme);
        });
    });

    const sidebar = document.querySelector('#sidebar');

    document.querySelectorAll('[data-admin-sidebar-toggle]').forEach((toggle) => {
        toggle.addEventListener('click', () => {
            if (sidebar) {
                coreui.Sidebar.getOrCreateInstance(sidebar).toggle();
            }
        });
    });

    const header = document.querySelector('header.header');

    document.addEventListener('scroll', () => {
        if (header) {
            header.classList.toggle('shadow-sm', document.documentElement.scrollTop > 0);
        }
    });
});
