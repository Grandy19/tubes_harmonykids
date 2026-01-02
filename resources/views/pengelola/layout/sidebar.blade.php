<div class="sidebar p-4">
    <h5 class="mb-4">HarmonyKids</h5>

    <a href="{{ route('pengelola.dashboard') }}"
       class="{{ request()->routeIs('pengelola.dashboard') ? 'active' : '' }}">
        <i class="fa-solid fa-chart-line me-2"></i> Dashboard
    </a>

    <a href="{{ route('pengelola.pendaftaran.index') }}"
       class="{{ request()->routeIs('pengelola.pendaftaran.*') ? 'active' : '' }}">
        <i class="fa-solid fa-clipboard-list me-2"></i> Pendaftaran Wali
    </a>

    <a href="{{ route('pengelola.instansi.edit') }}"
       class="{{ request()->routeIs('pengelola.instansi.*') ? 'active' : '' }}">
        <i class="fa-solid fa-school me-2"></i> Profil Instansi
    </a>

    <hr style="border-color: rgba(255,255,255,0.2)">

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit"
                class="btn btn-link text-start text-white p-0">
            <i class="fa-solid fa-right-from-bracket me-2"></i> Logout
        </button>
    </form>
</div>
