<div class="sidebar-heading text-center mt-1 py-4 text-white fs-4 fw-bold text-lowercase border-bottom">
                votehub</div>
<div class="list-group list-group-flush my-3">
    <a href="{{ route('dashboard') }}" class="list-group-item list-group-item-action bg-transparent second-text fw-bold @yield('dashboard')"><i
            class="fas fa-home me-2"></i>Overview</a>
    <a href="{{ route('positions') }}" class="list-group-item list-group-item-action bg-transparent second-text fw-bold @yield('positions')"><i
            class="fas fa-map-pin me-3"></i>Positions</a>
    <a href="{{ asset('partylist') }}" class="list-group-item list-group-item-action bg-transparent second-text fw-bold @yield('partylist')"><i
            class="fas fa-parking me-25"></i>Partylist</a>
    <a href="{{ asset('candidates') }}" class="list-group-item list-group-item-action bg-transparent second-text fw-bold @yield('candidates')"><i
            class="fas fa-list-alt me-25"></i>Candidates</a>
    <a href="{{ asset('voters') }}" class="list-group-item list-group-item-action bg-transparent second-text fw-bold @yield('voters')"><i
            class="fas fa-users me-2"></i>Voters</a>
    <a href="{{ asset('results') }}" class="list-group-item list-group-item-action bg-transparent second-text fw-bold @yield('view-election')"><i
            class="fas fa-poll-h me-3"></i>View Election</a>
</div>
