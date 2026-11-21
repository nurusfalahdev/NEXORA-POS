<script setup>
import { RouterLink } from 'vue-router';
</script>

<template>
    <aside class="sidebar d-flex flex-column bg-dark text-white p-3 min-vh-100">

        <!-- Logo -->
        <div class="d-flex align-items-center gap-3 px-2 py-3 mb-4">
            <div class="bg-primary rounded-3 p-2">
                <i class="bi bi-shop fs-4"></i>
            </div>
            <div>
                <h5 class="fw-bold mb-0">NEXUS POS</h5>
                <small class="text-secondary">Management System</small>
            </div>
        </div>

        <!-- Menu -->
        <div class="text-secondary small fw-bold px-2 mb-3">
            MENU UTAMA
        </div>

        <nav class="nav flex-column gap-2">

            <RouterLink to="/dashboard" class="nav-link d-flex align-items-center gap-3 rounded-3 px-3 py-3"
                exact-active-class="active">
                <i class="bi bi-grid-1x2-fill fs-5"></i>
                <span>Dashboard</span>
            </RouterLink>

            <RouterLink to="/produk" class="nav-link d-flex align-items-center gap-3 rounded-3 px-3 py-3"
                exact-active-class="active">
                <i class="bi bi-box-seam fs-5"></i>
                <span>Produk</span>
            </RouterLink>

            <RouterLink to="/kirim" class="nav-link d-flex align-items-center gap-3 rounded-3 px-3 py-3"
                exact-active-class="active">
                <i class="bi bi-truck fs-5"></i>
                <span>Kirim</span>
            </RouterLink>

            <RouterLink to="/terjual" class="nav-link d-flex align-items-center gap-3 rounded-3 px-3 py-3"
                exact-active-class="active">
                <i class="bi bi-cart-check fs-5"></i>
                <span>Terjual</span>
            </RouterLink>

        </nav>

        <!-- Spacer -->
        <div class="flex-grow-1"></div>

        <!-- Help -->
        <div class="d-flex align-items-center gap-3 bg-secondary bg-opacity-25 rounded-3 p-3 mb-3">
            <i class="bi bi-headset fs-4 text-info"></i>
            <div>
                <div class="fw-semibold small">Butuh bantuan?</div>
                <small class="text-secondary">Hubungi administrator</small>
            </div>
        </div>

        <!-- Profile -->
        <div class="border-top border-secondary pt-3 d-flex align-items-center gap-3">
            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold"
                style="width: 40px; height: 40px;">
                AD
            </div>

            <div class="flex-grow-1">
                <div class="fw-semibold small">Administrator</div>
                <small class="text-secondary">Super Admin</small>
            </div>

            <button class="btn btn-link text-secondary p-1" title="Logout" aria-label="Logout">
                <i class="bi bi-box-arrow-right fs-5"></i>
            </button>
        </div>

    </aside>
</template>

<style scoped>
.sidebar {
    width: 260px;
    flex-shrink: 0;
}

.nav-link {
    color: #adb5bd;
    font-size: 14px;
    font-weight: 500;
    transition: all .2s ease;
}

.nav-link:hover {
    background-color: #343a40;
    color: white;
    transform: translateX(3px);
}

.nav-link.active {
    background-color: #5d5fe5;
    color: white;
    box-shadow: 0 4px 12px rgba(93, 95, 229, .2);
}

.nav-link.active:hover {
    background-color: #7475f5;
}

.nav-link:focus-visible {
    outline: 2px solid #a5b4fc;
    outline-offset: 3px;
}
</style>
