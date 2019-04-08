<div class="sidebar">
  <nav class="sidebar-nav">
    <ul class="nav">
      <li class="nav-item">
        <a class="nav-link" href="{{ url('/') }}"><i class="icon-speedometer"></i> Dashboard </a>
      </li>

      <li class="nav-title">
        Master
      </li>

      @if (session('levelid')=="1")
        {{-- expr --}}
      @include('panel.admin_menu');

      @else
      @include('panel.contributor_menu');
      @endif
     
    </ul>
  </nav>
  <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>
