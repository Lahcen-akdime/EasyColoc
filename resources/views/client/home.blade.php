<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>EasyColoc - My Colocations</title>

<script src="https://cdn.tailwindcss.com"></script>
<script>
tailwind.config = {
  theme: {
    extend: {
      colors: {
        background: "#0F172A",
        surface: "#1E293B",
        soft: "#334155",
        borderSoft: "#475569",
        primarySoft: "#3B82F6",
      }
    }
  }
}
</script>

<style>
  .status-dot {
    width: 8px; height: 8px;
    border-radius: 50%;
    background: #22c55e;
    display: inline-block;
    animation: blink 2s ease-in-out infinite;
  }
  @keyframes blink { 0%,100%{opacity:1} 50%{opacity:.4} }

  .card-hover { transition: border-color 200ms ease, box-shadow 200ms ease; }
  .card-hover:hover { border-color: #3B82F6; box-shadow: 0 4px 20px rgba(59,130,246,.10); }

  .row-hover { transition: background 150ms ease, transform 150ms ease; border-radius: 12px; }
  .row-hover:hover { background: #334155; transform: translateX(2px); }

  .fade-in { animation: fadeUp .4s ease both; }
  .fade-in:nth-child(1) { animation-delay: 60ms; }
  .fade-in:nth-child(2) { animation-delay: 120ms; }
  .fade-in:nth-child(3) { animation-delay: 180ms; }
  .fade-in:nth-child(4) { animation-delay: 240ms; }
  @keyframes fadeUp { from{opacity:0;transform:translateY(8px)} to{opacity:1;transform:translateY(0)} }

  .avatar-stack { display: flex; align-items: center; }
  .avatar-stack img {
    width: 24px; height: 24px;
    border-radius: 50%;
    border: 2px solid #1E293B;
    margin-left: -6px;
    object-fit: cover;
  }
  .avatar-stack img:first-child { margin-left: 0; }
  .avatar-stack .extra {
    width: 24px; height: 24px;
    border-radius: 50%;
    border: 2px solid #1E293B;
    background: #334155;
    display: flex; align-items: center; justify-content: center;
    font-size: 10px;
    color: #94a3b8;
    font-weight: 600;
    margin-left: -6px;
  }
</style>
</head>

<body class="bg-background text-slate-200 min-h-screen">
<div class="max-w-6xl mx-auto px-6 py-10">

  <!-- ── HEADER ── -->
<header class="flex items-start justify-between mb-10">
    <div>
      <h1 class="text-3xl font-semibold tracking-tight">My Colocations</h1>
      <p class="text-slate-400 mt-1.5 text-sm">Manage your shared apartments and access your current one.</p>
    </div>
    <div class="flex items-center gap-3">
      <div class="flex items-center gap-2 bg-surface border border-borderSoft rounded-full px-3 py-1.5">
        <img src="https://ui-avatars.com/api/?name=Alex+M&background=334155&color=94a3b8&bold=true&size=60"
             alt="Alex M" class="w-7 h-7 rounded-full">
        <span class="text-sm text-slate-300 font-medium">Alex M.</span>
      </div>
      <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
    </div>
</header>

  <div class="grid gap-8 lg:grid-cols-3">

    <!-- ════ LEFT COLUMN ════ -->
    <div class="lg:col-span-2 space-y-6">

      <!-- ACTIVE COLOCATION -->
      <section class="bg-surface border border-borderSoft rounded-2xl p-7 card-hover fade-in">

        <div class="flex items-center gap-2 mb-5">
          <span class="status-dot"></span>
          <span class="text-xs font-semibold text-green-400 uppercase tracking-widest">Active</span>
        </div>

        <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-5">
          <div>
            <h2 class="text-xl font-semibold">Appart' Paris 11e</h2>
            <p class="text-slate-400 text-sm mt-1">75 Rue de la Roquette, 75011 Paris</p>
            <p class="text-slate-500 text-xs mt-1">
              Since October 2024 ·
              <span class="text-amber-400 font-medium">★ Owner</span>
            </p>
          </div>

          <div class="flex flex-col sm:items-end gap-3 flex-shrink-0">
            <div class="flex gap-6">
              <div class="text-right">
                <p class="text-xs text-slate-500 uppercase tracking-wide">Monthly Rent</p>
                <p class="text-lg font-semibold text-blue-400">650€</p>
              </div>
              <div class="text-right">
                <p class="text-xs text-slate-500 uppercase tracking-wide">My Balance</p>
                <p class="text-lg font-semibold text-red-400">−34,50€</p>
              </div>
            </div>
            <button class="px-5 py-2.5 rounded-xl bg-primarySoft text-white text-sm font-medium hover:bg-blue-600 transition">
              Enter Colocation →
            </button>
          </div>
        </div>

        <div class="mt-5 pt-4 border-t border-borderSoft flex items-center justify-between flex-wrap gap-3">
          <div class="flex items-center gap-3">
            <div class="avatar-stack">
              <img src="https://ui-avatars.com/api/?name=Alex+M&background=1d4ed8&color=bfdbfe&bold=true&size=50" alt="Alex">
              <img src="https://ui-avatars.com/api/?name=Sarah+K&background=0f766e&color=99f6e4&bold=true&size=50" alt="Sarah">
              <img src="https://ui-avatars.com/api/?name=Marc+D&background=7c3aed&color=ddd6fe&bold=true&size=50" alt="Marc">
              <img src="https://ui-avatars.com/api/?name=Julie+P&background=92400e&color=fde68a&bold=true&size=50" alt="Julie">
              <div class="extra">+1</div>
            </div>
            <span class="text-sm text-slate-400">5 members</span>
          </div>
          <span class="text-xs text-slate-500 bg-soft px-3 py-1 rounded-full">Paris 11e</span>
        </div>
      </section>

      <!-- NO ACTIVE — empty state (uncomment when user has no colocation)
      <section class="bg-surface border border-borderSoft rounded-2xl p-10 text-center fade-in">
        <h2 class="text-xl font-medium mb-3">No Active Colocation</h2>
        <p class="text-slate-400 mb-7 text-sm">Create a new one or join an existing colocation with an invitation token.</p>
        <div class="flex justify-center gap-3 flex-wrap">
          <button class="px-6 py-3 rounded-xl bg-primarySoft text-white text-sm font-medium hover:bg-blue-600 transition">
            Create Colocation
          </button>
          <button class="px-6 py-3 rounded-xl border border-borderSoft text-slate-200 text-sm font-medium hover:bg-soft transition">
            Join via Token
          </button>
        </div>
      </section>
      -->

      <!-- ALL COLOCATIONS LIST -->
      <section class="bg-surface border border-borderSoft rounded-2xl p-7 fade-in">

        <div class="flex items-center justify-between mb-5">
          <h3 class="text-base font-semibold">All Colocations</h3>
          <div class="flex items-center gap-3">
            <span class="text-xs text-slate-500">4 total</span>
            <select class="bg-background border border-borderSoft rounded-lg px-3 py-1.5 text-sm text-slate-300 focus:outline-none focus:ring-2 focus:ring-primarySoft cursor-pointer">
              <option>All Years</option>
              <option selected>2025</option>
              <option>2024</option>
              <option>2023</option>
            </select>
          </div>
        </div>

        <div class="divide-y divide-borderSoft">

          @foreach($colocations as $colocation)
        
            <a href="{{route('colocation.show',$colocation)}}" class="row-hover flex items-center gap-4 py-4 px-3 -mx-3 block" >
              <div class="w-10 h-10 rounded-xl bg-blue-500/10 flex items-center justify-center text-xl flex-shrink-0">🏠</div>
              <div class="flex-1 min-w-0">
                <div class="flex items-center gap-2 flex-wrap">
                  <p class="text-sm font-semibold text-slate-100">{{$colocation->name}}</p>
                  <span class="text-xs bg-amber-500/10 text-amber-400 border border-amber-500/20 px-2 py-0.5 rounded-full">★ Owner</span>
                  @if($colocation->state == 'active')
                  <span class="text-xs bg-green-500/10 text-green-400 border border-green-500/20 px-2 py-0.5 rounded-full">active</span>
                  @else
                  <span class="text-xs bg-red-500/10 text-white-500 border border-red-500/20 px-2 py-0.5 rounded-full">inactive</span>
                  @endif
                </div>
                <div class="flex items-center gap-2 mt-1.5">
                  <span class="text-xs text-slate-400"> — now</span>
                  <span class="text-slate-600 text-xs">·</span>
                  <div class="avatar-stack">
                    <img src="https://ui-avatars.com/api/?name=Alex+M&background=1d4ed8&color=bfdbfe&bold=true&size=40" alt="">
                    <img src="https://ui-avatars.com/api/?name=Sarah+K&background=0f766e&color=99f6e4&bold=true&size=40" alt="">
                    <img src="https://ui-avatars.com/api/?name=Marc+D&background=7c3aed&color=ddd6fe&bold=true&size=40" alt="">
                    <div class="extra">+2</div>
                  </div>
                  <span class="text-xs text-slate-500">5 members</span>
                </div>
              </div>
              <svg class="w-4 h-4 text-slate-500 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg>
            </a>
    
          @endforeach
        </div>
      </section>

      <!-- HISTORY -->
      <section class="bg-surface border border-borderSoft rounded-2xl p-7 fade-in">
        <div class="flex items-center justify-between mb-5">
          <h3 class="text-base font-semibold">History</h3>
          <select class="bg-background border border-borderSoft rounded-lg px-3 py-1.5 text-sm text-slate-300 focus:outline-none focus:ring-2 focus:ring-primarySoft">
            <option>All Years</option>
            <option>2024</option>
            <option>2023</option>
          </select>
        </div>

        <div class="divide-y divide-borderSoft">
          <div class="py-4 flex justify-between items-center">
            <div>
              <p class="font-medium text-sm">Lyon République</p>
              <p class="text-xs text-slate-400 mt-0.5">Jan 2024 – Aug 2024</p>
            </div>
            <span class="text-xs text-slate-400 bg-soft px-3 py-1 rounded-full">Closed</span>
          </div>
          <div class="py-4 flex justify-between items-center">
            <div>
              <p class="font-medium text-sm">Bordeaux Centre</p>
              <p class="text-xs text-slate-400 mt-0.5">Mar 2023 – Dec 2023</p>
            </div>
            <span class="text-xs text-slate-400 bg-soft px-3 py-1 rounded-full">Closed</span>
          </div>
        </div>
      </section>

    </div>

    <!-- ════ RIGHT COLUMN ════ -->
    <div class="space-y-6">

      <!-- QUICK ACTIONS -->
      <section class="bg-surface border border-borderSoft rounded-2xl p-6 space-y-3 fade-in flex-col justify-around">
        <h3 class="text-base font-semibold mb-1">Quick Actions</h3>
        <div>
            <a href="{{route('colocation.create')}}" class="w-full px-5 py-3 rounded-xl bg-primarySoft text-white text-sm font-medium hover:bg-blue-600 transition">
              + Create New Colocation
            </a>
        </div>

        <div class="flex gap-2">
          <input type="text" placeholder="Invitation token…"
            class="flex-1 bg-background border border-borderSoft rounded-xl px-3 py-2.5 text-sm text-slate-200 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-primarySoft">
          <button class="px-4 py-2.5 rounded-xl border border-borderSoft text-slate-300 text-sm font-medium hover:bg-soft transition flex-shrink-0">
            Join
          </button>
        </div>
      </section>

      <!-- USER STATS -->
      <section class="bg-surface border border-borderSoft rounded-2xl p-6 fade-in">
        <h3 class="text-base font-semibold mb-4">Your Stats</h3>
        <div class="divide-y divide-borderSoft">
          <div class="flex justify-between items-center py-3">
            <span class="text-slate-400 text-sm">Total Joined</span>
            <span class="font-semibold">4</span>
          </div>
          <div class="flex justify-between items-center py-3">
            <span class="text-slate-400 text-sm">Currently Active</span>
            <span class="font-semibold text-green-400">1</span>
          </div>
          <div class="flex justify-between items-center py-3">
            <span class="text-slate-400 text-sm">As Owner</span>
            <span class="font-semibold text-amber-400">2</span>
          </div>
          <div class="flex justify-between items-center py-3">
            <span class="text-slate-400 text-sm">Pending Invites</span>
            <span class="font-semibold text-yellow-400">1</span>
          </div>
          <div class="flex justify-between items-center py-3">
            <span class="text-slate-400 text-sm">Expenses Shared</span>
            <span class="font-semibold">6 430€</span>
          </div>
          <div class="flex justify-between items-center pt-3">
            <span class="text-slate-400 text-sm">Reputation</span>
            <span class="font-semibold text-blue-400">+12 ⭐</span>
          </div>
        </div>
      </section>

      <!-- RECENT ACTIVITY -->
      <section class="bg-surface border border-borderSoft rounded-2xl p-6 fade-in">
        <h3 class="text-base font-semibold mb-4">Recent Activity</h3>
        <div class="space-y-4">
          <div class="flex items-start gap-3">
            <div class="w-8 h-8 rounded-lg bg-blue-500/10 flex items-center justify-center flex-shrink-0 text-sm">💸</div>
            <div>
              <p class="text-sm text-slate-300">Sarah paid <span class="text-slate-100 font-medium">Courses Franprix</span></p>
              <p class="text-xs text-slate-500 mt-0.5">7 Feb · 54€ split ÷3</p>
            </div>
          </div>
          <div class="flex items-start gap-3">
            <div class="w-8 h-8 rounded-lg bg-green-500/10 flex items-center justify-center flex-shrink-0 text-sm">✅</div>
            <div>
              <p class="text-sm text-slate-300">Marc marked rent as <span class="text-green-400 font-medium">paid</span></p>
              <p class="text-xs text-slate-500 mt-0.5">1 Feb · 650€</p>
            </div>
          </div>
          <div class="flex items-start gap-3">
            <div class="w-8 h-8 rounded-lg bg-yellow-500/10 flex items-center justify-center flex-shrink-0 text-sm">📩</div>
            <div>
              <p class="text-sm text-slate-300">Invite from <span class="text-slate-100 font-medium">Marseille Vieux-Port</span></p>
              <p class="text-xs text-slate-500 mt-0.5">28 Jan · Awaiting response</p>
            </div>
          </div>
        </div>
      </section>

    </div>
  </div>
</div>
</body>
</html>