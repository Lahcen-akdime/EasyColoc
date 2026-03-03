<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>EasyColoc - Admin Dashboard</title>
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
  .fade-in { animation: fadeUp .4s ease both; }
  .fade-in:nth-child(1){animation-delay:40ms}
  .fade-in:nth-child(2){animation-delay:90ms}
  .fade-in:nth-child(3){animation-delay:140ms}
  .fade-in:nth-child(4){animation-delay:190ms}
  .fade-in:nth-child(5){animation-delay:240ms}
  @keyframes fadeUp{from{opacity:0;transform:translateY(8px)}to{opacity:1;transform:translateY(0)}}
  .row-hover{transition:background 150ms ease}
  .row-hover:hover{background:#334155}
  .input-field{background:#0F172A;border:1px solid #475569;border-radius:10px;color:#e2e8f0;font-size:13px;padding:8px 13px;outline:none;transition:border-color 150ms,box-shadow 150ms}
  .input-field::placeholder{color:#475569}
  .input-field:focus{border-color:#3B82F6;box-shadow:0 0 0 3px rgba(59,130,246,.15)}
  select.input-field{cursor:pointer;appearance:none;background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='6'%3E%3Cpath fill='%23475569' d='M0 0l5 6 5-6z'/%3E%3C/svg%3E");background-repeat:no-repeat;background-position:right 10px center;padding-right:28px}
  .modal-backdrop{position:fixed;inset:0;z-index:50;background:rgba(0,0,0,.6);backdrop-filter:blur(4px);display:flex;align-items:center;justify-content:center;padding:20px;opacity:0;pointer-events:none;transition:opacity 200ms ease}
  .modal-backdrop.open{opacity:1;pointer-events:all}
  .modal{background:#1E293B;border:1px solid #475569;border-radius:20px;padding:28px;width:100%;max-width:400px;transform:translateY(14px) scale(.97);transition:transform 200ms ease}
  .modal-backdrop.open .modal{transform:translateY(0) scale(1)}
  .stat-card{transition:border-color 180ms ease}
  .stat-card:hover{border-color:#3B82F6}
</style>
</head>
<body class="bg-background text-slate-200 min-h-screen">
<div class="max-w-7xl mx-auto px-6 py-10">

  <!-- HEADER -->
  <div class="flex items-start justify-between mb-10 fade-in">
    <div>
      <p class="text-xs font-semibold text-primarySoft uppercase tracking-widest mb-1">Admin Panel</p>
      <h1 class="text-2xl font-semibold tracking-tight">Global Dashboard</h1>
      <p class="text-slate-400 text-sm mt-1">Overview of all users, colocations and activity.</p>
    </div>
    <div class="flex items-center gap-3">
      <div class="flex items-center gap-2 bg-surface border border-borderSoft rounded-full px-3 py-1.5">
        <img src="https://ui-avatars.com/api/?name=Admin&background=1d4ed8&color=bfdbfe&bold=true&size=60" class="w-7 h-7 rounded-full" alt="Admin">
        <span class="text-sm text-slate-300 font-medium">Admin</span>
        <span class="text-xs bg-red-500/10 text-red-400 border border-red-500/20 px-2 py-0.5 rounded-full">Super Admin</span>
      </div>
    
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

  <!-- STAT CARDS -->
  <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-10">

    <div class="stat-card bg-surface border border-borderSoft rounded-2xl p-5 fade-in">
      <div class="flex items-center justify-between mb-3">
        <div class="w-9 h-9 rounded-xl bg-blue-500/10 flex items-center justify-center">
          <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/></svg>
        </div>
        <span class="text-xs text-green-400 font-medium bg-green-500/10 px-2 py-0.5 rounded-full">+12%</span>
      </div>
      <p class="text-2xl font-semibold text-slate-100">{{sizeof($users)}}</p>
      <p class="text-sm text-slate-400 mt-0.5">Total Users</p>
    </div>

    <div class="stat-card bg-surface border border-borderSoft rounded-2xl p-5 fade-in">
      <div class="flex items-center justify-between mb-3">
        <div class="w-9 h-9 rounded-xl bg-green-500/10 flex items-center justify-center">
          <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
        </div>
        <span class="text-xs text-green-400 font-medium bg-green-500/10 px-2 py-0.5 rounded-full">+5%</span>
      </div>
      <p class="text-2xl font-semibold text-slate-100">{{$colocationsActive}}</p>
      <p class="text-sm text-slate-400 mt-0.5">Active Colocations</p>
    </div>

    <div class="stat-card bg-surface border border-borderSoft rounded-2xl p-5 fade-in">
      <div class="flex items-center justify-between mb-3">
        <div class="w-9 h-9 rounded-xl bg-amber-500/10 flex items-center justify-center">
          <svg class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"/></svg>
        </div>
        <span class="text-xs text-green-400 font-medium bg-green-500/10 px-2 py-0.5 rounded-full">+18%</span>
      </div>
      <p class="text-2xl font-semibold text-slate-100">{{$colocationNB}} depences</p>
      <p class="text-sm text-slate-400 mt-0.5">All depences</p>
    </div>

    <div class="stat-card bg-surface border border-borderSoft rounded-2xl p-5 fade-in">
      <div class="flex items-center justify-between mb-3">
        <div class="w-9 h-9 rounded-xl bg-red-500/10 flex items-center justify-center">
          <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"/></svg>
        </div>
        <span class="text-xs text-red-400 font-medium bg-red-500/10 px-2 py-0.5 rounded-full"> new</span>
      </div>
      <p class="text-2xl font-semibold text-slate-100">{{$usersBannie}}</p>
      <p class="text-sm text-slate-400 mt-0.5">Banned Users</p>
    </div>

  </div>

  <!-- USERS TABLE -->
  <div class="bg-surface border border-borderSoft rounded-2xl fade-in">

    

    <div class="overflow-x-auto">
      <table class="w-full text-sm">
        <thead>
          <tr class="border-b border-borderSoft text-xs text-slate-500 uppercase tracking-wider">
            <th class="text-left px-6 py-3 font-medium">User</th>
            <th class="text-left px-6 py-3 font-medium">Reputation</th>
            <th class="text-left px-6 py-3 font-medium">Expenses</th>
            <th class="text-left px-6 py-3 font-medium">Joined</th>
            <th class="text-left px-6 py-3 font-medium">Status</th>
            <th class="text-right px-6 py-3 font-medium">Actions</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-borderSoft" id="users-tbody">
        @foreach($users as $user)
        @if($user->is_banned==false)
          <tr class="row-hover user-row" data-status="active" data-role="owner" data-name="alex martin alex.martin@email.com">
            <td class="px-6 py-4"><div class="flex items-center gap-3"><img src="https://ui-avatars.com/api/?name=Alex+M&background=1d4ed8&color=bfdbfe&bold=true&size=60"
             class="w-9 h-9 rounded-full flex-shrink-0" alt="Alex"><div><p class="font-medium text-slate-100">{{$user->name}}</p><p class="text-xs text-slate-500">{{$user->email}}</p></div></div></td>
            <td class="px-6 py-4 text-slate-300">{{$user->evaluation}}</td>
            <td class="px-6 py-4 text-slate-300">{{$user->depence()->count()}}</td>
            <td class="px-6 py-4 text-slate-500 text-xs">{{substr(($user->created_at),0,10)}}</td>
            <td class="px-6 py-4"><span class="status-badge text-xs bg-green-500/10 text-green-400 border border-green-500/20 px-2 py-1 rounded-full">Active</span></td>
            <td class="px-6 py-4 text-right">
                <form action="{{route('admin.update',$user->id)}}" method="post">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="action-btn text-xs text-red-400 hover:text-red-300 border border-red-500/20 hover:bg-red-500/10 px-3 py-1.5 rounded-lg transition">Ban</button>
                </form>
            </td>
          </tr>
          @endif
          @endforeach
        @foreach($users as $user)
        @if($user->is_banned==true)
          <tr class="row-hover user-row opacity-60" data-status="banned" data-role="owner" data-name="noah favier noah.f@email.com">
            <td class="px-6 py-4"><div class="flex items-center gap-3"><img src="https://ui-avatars.com/api/?name=Noah+F&background=334155&color=64748b&bold=true&size=60"
             class="w-9 h-9 rounded-full flex-shrink-0 grayscale" alt="Noah"><div><p class="font-medium text-slate-400">{{$user->name}}</p><p class="text-xs text-slate-600">{{$user->email}}</p></div></div></td>
            <td class="px-6 py-4 text-slate-500">{{$user->evaluation}}</td>
            <td class="px-6 py-4 text-slate-500">{{$user->depence()->count()}}</td>
            <td class="px-6 py-4 text-slate-600 text-xs">{{substr(($user->created_at),0,10)}}</td>
            <td class="px-6 py-4"><span class="status-badge text-xs bg-red-500/10 text-red-400 border border-red-500/20 px-2 py-1 rounded-full">Banned</span></td>
            <td class="px-6 py-4 text-right">
                <form action="{{route('admin.store')}}" method="post">
                    @csrf
                    @method('POST')
                    <input type="hidden" name="userid" value="{{$user->id}}">
                <button type="submit" class="action-btn text-xs text-green-400 hover:text-green-300 border border-green-500/20 hover:bg-green-500/10 px-3 py-1.5 rounded-lg transition">Unban</button>
             </form>
            </td>
          </tr>
        @endif
        @endforeach
        </tbody>
      </table>
      <div id="no-results" class="hidden text-center py-12 text-slate-500 text-sm">No users match your search.</div>
    </div>
  </div>
</div>

<!-- BAN CONFIRM MODAL -->
<div class="modal-backdrop" id="modal-confirm">
  <div class="modal">
    <div class="flex items-center justify-between mb-5">
      <h2 class="text-base font-semibold" id="modal-title">Ban User</h2>
      <button class="text-slate-400 hover:text-slate-200 transition">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
      </button>
    </div>
    <p class="text-sm text-slate-400 mb-6" id="modal-desc"></p>
    <div class="flex gap-3">
      <button id="modal-confirm-btn" class="flex-1 py-2.5 rounded-xl text-white text-sm font-medium transition bg-red-600 hover:bg-red-700">Confirm</button>
      <button class="px-5 py-2.5 rounded-xl border border-borderSoft text-slate-300 text-sm font-medium hover:bg-soft transition">Cancel</button>
    </div>
  </div>
</div>
</body>
</html>