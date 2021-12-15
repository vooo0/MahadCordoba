<nav class="sidebar">
  <div class="sidebar-header">
    <a href="#" class="sidebar-brand">
      Ma'Had<span>Cordoba</span>
    </a>
    <div class="sidebar-toggler not-active">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </div>
  <div class="sidebar-body">
    <ul class="nav">
      @if(Auth::user()->level == 'umum')
      <li class="nav-item nav-category">Main</li>
      <li class="nav-item {{ active_class(['/admin']) }}">
        <a href="{{ url('/admin') }}" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Dashboard</span>
        </a>
      </li>
      @elseif(Auth::user()->level == 'keuangan')
      <li class="nav-item nav-category">Main</li>
      <li class="nav-item {{ active_class(['/keuangan']) }}">
        <a href="{{ url('/keuangan') }}" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Dashboard</span>
        </a>
      </li>
      @elseif(Auth::user()->level == 'guru')
      <li class="nav-item nav-category">Main</li>
      <li class="nav-item {{ active_class(['/guru']) }}">
        <a href="{{ url('/guru') }}" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Dashboard</span>
        </a>
      </li>
      @elseif(Auth::user()->level == 'siswa')
      <li class="nav-item nav-category">Main</li>
      <li class="nav-item {{ active_class(['/siswa']) }}">
        <a href="{{ url('/siswa') }}" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Dashboard</span>
        </a>
      </li>
      @endif
      @if(Auth::user()->level == 'umum')
        
      <li class="nav-item nav-category">Admin Umum</li>
      <li class="nav-item {{ active_class(['admin/pendaftaran']) }}">
        <a href="{{ url('/admin/pendaftaran') }}" class="nav-link">
          <i class="link-icon" data-feather="user-plus"></i>
          <span class="link-title">Pendaftar</span>
        </a>
      </li>
      <li class="nav-item {{ active_class(['admin/dataAdmin']) }}">
        <a href="{{ url('/admin/dataAdmin') }}" class="nav-link">
          <i class="link-icon" data-feather="user"></i>
          <span class="link-title">Data Admin</span>
        </a>
      </li>
      <li class="nav-item {{ active_class(['admin/dataGuru']) }}">
        <a href="{{ url('/admin/dataGuru') }}" class="nav-link">
          <i class="link-icon" data-feather="users"></i>
          <span class="link-title">Data Guru</span>
        </a>
      </li>
      <li class="nav-item {{ active_class(['admin/dataSiswa']) }}">
        <a href="{{ url('/admin/dataSiswa') }}" class="nav-link">
          <i class="link-icon" data-feather="users"></i>
          <span class="link-title">Data Siswa</span>
        </a>
      </li>
      <li class="nav-item {{ active_class(['admin/dataMatapelajaran']) }}">
        <a href="{{ url('/admin/dataMatapelajaran') }}" class="nav-link">
          <i class="link-icon" data-feather="book"></i>
          <span class="link-title">Matapelajaran</span>
        </a>
      </li>

      @elseif(Auth::user()->level == 'keuangan')
      <li class="nav-item nav-category">Keuangan</li>
      <li class="nav-item {{ active_class(['keuangan/pemasukkan']) }}">
        <a href="{{ url('/keuangan/pemasukkan') }}" class="nav-link">
          <i class="link-icon" data-feather="arrow-down-right"></i>
          <span class="link-title">Pemasukkan</span>
        </a>
      </li>
      <li class="nav-item {{ active_class(['keuangan/pengeluaran']) }}">
        <a href="{{ url('/keuangan/pengeluaran') }}" class="nav-link">
          <i class="link-icon" data-feather="arrow-up-left"></i>
          <span class="link-title">Pengeluaran</span>
        </a>
      </li>
      <li class="nav-item {{ active_class(['keuangan/gaji']) }}">
        <a href="{{ url('/keuangan/gaji') }}" class="nav-link">
          <i class="link-icon" data-feather="award"></i>
          <span class="link-title">Gaji</span>
        </a>
      </li>
      <li class="nav-item {{ active_class(['keuangan/pembayaran']) }}">
        <a href="{{ url('/keuangan/pembayaran') }}" class="nav-link">
          <i class="link-icon" data-feather="shopping-cart"></i>
          <span class="link-title">Pembayaran</span>
        </a>
      </li>
      <li class="nav-item {{ active_class(['keuangan/labaRugi']) }}">
        <a href="{{ url('/keuangan/labaRugi') }}" class="nav-link">
          <i class="link-icon" data-feather="bar-chart-2"></i>
          <span class="link-title">Laba/Rugi</span>
        </a>
      </li>

      @elseif(Auth::user()->level == 'guru')
      <li class="nav-item nav-category">Guru</li>
      <li class="nav-item {{ active_class(['guru/matapelajaran']) }}">
        <a href="{{ url('/guru/matapelajaran') }}" class="nav-link">
          <i class="link-icon" data-feather="book"></i>
          <span class="link-title">Kelas / Matapelajaran</span>
        </a>
      </li>
      <li class="nav-item {{ active_class(['guru/tugas']) }}">
        <a href="{{ url('/guru/tugas') }}" class="nav-link">
          <i class="link-icon" data-feather="file"></i>
          <span class="link-title">Tugas</span>
        </a>
      </li>
      <li class="nav-item {{ active_class(['guru/rapot']) }}">
        <a href="{{ url('/guru/rapot') }}" class="nav-link">
          <i class="link-icon" data-feather="gift"></i>
          <span class="link-title">Nilai / Rapor</span>
        </a>
      </li>
      <li class="nav-item {{ active_class(['guru/gaji']) }}">
        <a href="{{ url('/guru/gaji') }}" class="nav-link">
          <i class="link-icon" data-feather="award"></i>
          <span class="link-title">Gaji</span>
        </a>
      </li>
      <li class="nav-item {{ active_class(['guru/pengumuman']) }}">
        <a href="{{ url('/guru/pengumuman') }}" class="nav-link">
          <i class="link-icon" data-feather="bell"></i>
          <span class="link-title">Pengumuman</span>
        </a>
      </li>

      @elseif(Auth::user()->level == 'siswa')
      <li class="nav-item nav-category">Siswa</li>
      <li class="nav-item {{ active_class(['siswa/matapelajaran']) }}">
        <a href="{{ url('/siswa/matapelajaran') }}" class="nav-link">
          <i class="link-icon" data-feather="book"></i>
          <span class="link-title">Matapelajaran</span>
        </a>
      </li>
      <li class="nav-item {{ active_class(['siswa/tugas']) }}">
        <a href="{{ url('/siswa/tugas') }}" class="nav-link">
          <i class="link-icon" data-feather="file"></i>
          <span class="link-title">Tugas</span>
        </a>
      </li>
      <li class="nav-item {{ active_class(['siswa/pembayaran']) }}">
        <a href="{{ url('/siswa/pembayaran') }}" class="nav-link">
          <i class="link-icon" data-feather="shopping-cart"></i>
          <span class="link-title">Pembayaran</span>
        </a>
      </li>
      <li class="nav-item {{ active_class(['siswa/pengumuman']) }}">
        <a href="{{ url('/siswa/pengumuman') }}" class="nav-link">
          <i class="link-icon" data-feather="bell"></i>
          <span class="link-title">Pengumuman</span>
        </a>
      </li>
      @endif
    </ul>
  </div>
</nav>