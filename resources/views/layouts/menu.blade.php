<li class="nav-item">
    <a href="{{ route('petas.index') }}"
       class="nav-link {{ Request::is('petas*') ? 'active' : '' }}">
        <p>Petas</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('JenisLokasi.index') }}"
       class="nav-link {{ Request::is('JenisLokasi*') ? 'active' : '' }}">
        <p>Jenis Lokasi</p>
    </a>
</li>


