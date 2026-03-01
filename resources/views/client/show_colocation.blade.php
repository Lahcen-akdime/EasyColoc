<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>EasyColoc - Appart' Paris 11e</title>

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
  .fade-in:nth-child(1) { animation-delay: 40ms; }
  .fade-in:nth-child(2) { animation-delay: 100ms; }
  .fade-in:nth-child(3) { animation-delay: 160ms; }
  .fade-in:nth-child(4) { animation-delay: 220ms; }
  @keyframes fadeUp { from{opacity:0;transform:translateY(8px)} to{opacity:1;transform:translateY(0)} }

  .card-hover { transition: border-color 180ms ease; }
  .card-hover:hover { border-color: #3B82F6; }

  .row-hover { transition: background 150ms ease; border-radius: 10px; }
  .row-hover:hover { background: #334155; }

  .avatar-stack { display: flex; align-items: center; }
  .avatar-stack img {
    width: 28px; height: 28px;
    border-radius: 50%;
    border: 2px solid #1E293B;
    margin-left: -7px;
    object-fit: cover;
  }
  .avatar-stack img:first-child { margin-left: 0; }

  .select-field {
    background: #0F172A;
    border: 1px solid #475569;
    border-radius: 10px;
    color: #cbd5e1;
    font-size: 13px;
    padding: 7px 28px 7px 12px;
    outline: none;
    cursor: pointer;
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='6'%3E%3Cpath fill='%23475569' d='M0 0l5 6 5-6z'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 10px center;
    transition: border-color 150ms;
  }
  .select-field:focus { outline: none; border-color: #3B82F6; }

  /* Modal */
  .modal-backdrop {
    position: fixed; inset: 0; z-index: 50;
    background: rgba(0,0,0,.6);
    backdrop-filter: blur(4px);
    display: flex; align-items: center; justify-content: center;
    padding: 20px;
    opacity: 0; pointer-events: none;
    transition: opacity 200ms ease;
  }
  .modal-backdrop.open { opacity: 1; pointer-events: all; }
  .modal {
    background: #1E293B;
    border: 1px solid #475569;
    border-radius: 20px;
    padding: 28px;
    width: 100%; max-width: 420px;
    transform: translateY(16px) scale(.97);
    transition: transform 200ms ease;
  }
  .modal-backdrop.open .modal { transform: translateY(0) scale(1); }

  .input-field {
    width: 100%;
    background: #0F172A;
    border: 1px solid #475569;
    border-radius: 10px;
    color: #e2e8f0;
    font-size: 14px;
    padding: 10px 13px;
    outline: none;
    transition: border-color 150ms, box-shadow 150ms;
  }
  .input-field::placeholder { color: #475569; }
  .input-field:focus { border-color: #3B82F6; box-shadow: 0 0 0 3px rgba(59,130,246,.15); }
  select.input-field {
    cursor: pointer; appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='6'%3E%3Cpath fill='%23475569' d='M0 0l5 6 5-6z'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 12px center;
    padding-right: 32px;
  }

  .status-dot {
    width: 8px; height: 8px; border-radius: 50%;
    display: inline-block;
    animation: blink 2s ease-in-out infinite;
  }
  @keyframes blink { 0%,100%{opacity:1} 50%{opacity:.4} }
</style>
</head>

<body class="bg-background text-slate-200 min-h-screen">
<div class="max-w-6xl mx-auto px-6 py-10">

  <!-- ── HEADER ── -->
  <div class="mb-8 fade-in">
    <a href="{{route('colocation.index')}}" class="inline-flex items-center gap-2 text-sm text-slate-400 hover:text-slate-200 transition mb-4">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"/></svg>
      My Colocations
    </a>
    <div class="flex items-start justify-between gap-4 flex-wrap">
      <div>
        <div class="flex items-center gap-2 mb-1">
          <span class="status-dot bg-green-400"></span>
          <span class="text-xs font-semibold text-green-400 uppercase tracking-widest">Active</span>
        </div>
        <h1 class="text-2xl font-semibold tracking-tight">{{$colocation->name}}</h1>
        <b class="text-slate-400 text-sm mt-1">____________________________</b>
      </div>
      @foreach($colocation->user as $user)
        @if($user->pivot->type=='owner' && $user->name==$authuser->name)
      <form method="post" action="{{route('colocation.update',$colocation->id)}}">
        @csrf 
        @method('PATCH')
        <button type="submit" style="height: 3rem;" class="px-5 py-2.5 rounded-xl bg-red-400 text-white text-sm font-medium hover:bg-red-600 transition">
                Anuller la colocation
        </button>
      </form>
       @endif
      @endforeach
      <div class="flex items-center gap-2 flex-wrap">
        @foreach($colocation->user as $user)
        @if($user->pivot->type=='owner' && $user->name==$authuser->name)
        <button onclick="openModal('modal-category')"
          class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl border border-borderSoft text-slate-300 text-sm font-medium hover:bg-soft transition">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
          Add Category
        </button>
        @endif
        @endforeach
        <button onclick="openModal('modal-expense')"
          class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-primarySoft text-white text-sm font-medium hover:bg-blue-600 transition">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
          Add Expense
        </button>
        <button onclick="openModal('modal-invitation')"
          class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl border border-borderSoft text-slate-300 text-sm font-medium hover:bg-soft transition">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
          Send invitation
        </button>
        @if($errors->any())
        <ul>
          @foreach($errors->all() as $error)
          <li style="color:red">{{$error}}</li>
          @endforeach
        </ul>
        @endif
          @if(session('valide'))
          <p style="color:green">{{session('valide')}}</p>
          @endif
      </div>
    </div>
  </div>

  <!-- ── MAIN GRID ── -->
  <div class="grid gap-6 lg:grid-cols-3">

    <!-- ════ LEFT — Members + Expenses ════ -->
    <div class="lg:col-span-2 space-y-6">

      <!-- MEMBERS -->
      <section class="bg-surface border border-borderSoft rounded-2xl p-6 card-hover fade-in">
        <div class="flex items-center justify-between mb-5">
          <h2 class="text-base font-semibold">Members <span class="text-slate-500 font-normal text-sm ml-1">{{$sumMembers}}</span></h2>
          <button onclick="openModal('modal-invitation')" 
           class="text-xs text-primarySoft hover:underline">Invite member</button>
        </div>

        <div class="divide-y divide-borderSoft">

          <!-- Member row -->
           @foreach($colocation->user as $user)
           @if($user->pivot->left_at == null)
          <div class="row-hover flex items-center gap-4 py-3 px-2 -mx-2">
            <div class="w-10 h-10 rounded-full bg-orange-500/10 border border-orange-500/20 flex items-center justify-center text-orange-400 text-xs font-semibold flex-shrink-0">{{substr($user->name,0,2)}}</div>
            <div class="flex-1 min-w-0">
              <div class="flex items-center gap-2">
                <p class="text-sm font-medium text-slate-100">{{$user->name}}</p>
                @if($user->pivot->type=='owner')
                <span class="text-xs bg-amber-500/10 text-amber-400 border border-amber-500/20 px-2 py-0.5 rounded-full">&nbsp; {{ $user->pivot->type}} 👑</span>
                @else
                <span class="text-xs bg-blue-500 text-amber-50 border border-blue-900 px-2 py-0.5 rounded-full">{{$user->pivot->type}}</span>
                @endif
                @if($authuser->name!=$user->name && ($authuser->colocation)[0]->pivot->type=='owner')
                <form method="POST" action="{{route('extract')}}">
                  @csrf 
                  @method('POST')
                  <input type="hidden" name="user_id" value="{{$user->id}}">
                  <input type="hidden" name="colocation" value="{{$colocation}}">
                  <input type="hidden" name="membership" value="{{$user->pivot}}">
                  <button type="submit" class="text-xs bg-red-500 text-amber-50 border border-red-900 px-2 py-0.5 rounded-full">retier</button>
                </form>
                @endif
                <span class="text-xs text-green-400 font-medium">{{$authuser->name==$user->name?'You':''}}</span>
              </div>
            </div>
          </div>
           @endif
           @endforeach
        </div>
      </section>

      <!-- EXPENSES -->
      <section class="bg-surface border border-borderSoft rounded-2xl p-6 card-hover fade-in">

        <div class="flex items-center justify-between mb-5 flex-wrap gap-3">
          <h2 class="text-base font-semibold">Expenses</h2>
          <div class="flex items-center gap-2">
            <select class="select-field" aria-label="Filter by category">
              <option>All Categories</option>
              @foreach($colocation->categorie as $categorie)
              <option>{{$categorie->title}}</option>
              @endforeach
            </select>
            <select class="select-field" aria-label="Filter by month">
              <option>February 2025</option>
              <option>January 2025</option>
              <option>December 2024</option>
            </select>
          </div>
        </div>

        <div class="divide-y divide-borderSoft">

          <!-- Expense row -->
          @foreach($colocation->depences as $depence)
          <div class="row-hover flex items-center gap-4 py-3.5 px-2 -mx-2">
            <div class="w-9 h-9 rounded-xl bg-pink-500/10 flex items-center justify-center text-lg flex-shrink-0">🏠</div>
            <div class="flex-1 min-w-0">
              <p class="text-sm font-medium text-slate-100">{{$depence->title}}</p>
              <div class="flex items-center gap-2 mt-0.5">
                <img src="https://ui-avatars.com/api/?name=Alex+M&background=1d4ed8&color=bfdbfe&bold=true&size=40"
                     alt="" class="w-4 h-4 rounded-full">
                <span class="text-xs text-slate-400">{{$depence->user->name}} · {{$depence->created_at}}</span>
                <span class="text-xs bg-soft text-slate-400 px-2 py-0.5 rounded-full"> {{$depence->categorie->title}}</span>
              </div>
            </div>
            <div class="text-right flex-shrink-0">
              <p class="text-sm font-semibold text-slate-100">{{$depence->price}} DH</p>
              <p class="text-xs text-slate-500">650€ / each</p>
            </div>
          </div>
         @endforeach
        </div>

        <!-- Total row -->
        <div class="mt-4 pt-4 border-t border-borderSoft flex items-center justify-between">
          <span class="text-sm text-slate-400">Total </span>
          <span class="text-base font-semibold text-slate-100">{{$totalePrice}} DH</span>
        </div>

      </section>
       <!-- Paiment -->
      <section class="bg-surface border border-borderSoft rounded-2xl p-6 fade-in">
  
  {{-- Header --}}
  <div class="flex items-center gap-3 mb-6">
    <div class="w-9 h-9 rounded-xl bg-primarySoft/20 border border-primarySoft/30 flex items-center justify-center text-base flex-shrink-0">
      💸
    </div>
    <div>
      <h3 class="font-semibold text-sm text-white tracking-wide" style="font-family: 'Syne', sans-serif;">Remboursements</h3>
      <p class="text-xs text-gray-500 font-light mt-0.5">Qui doit rembourser qui ?</p>
    </div>
  </div>

  {{-- Debt List --}}
  <div class="flex flex-col gap-3">
    @foreach($colocation->depences as $depence)
      @foreach($depence->paiments as $paiment)
      @if($paiment->is_payed == 'unpayed')
        <div class="flex items-center gap-3 bg-white/5 border border-white/[0.07] hover:border-primarySoft/30 rounded-2xl px-4 py-3 transition-all duration-200 group">
          
          {{-- From Avatar --}}
          <div class="w-8 h-8 rounded-full bg-orange-500/10 border border-orange-500/20 flex items-center justify-center text-orange-400 text-xs font-semibold flex-shrink-0">
            {{ strtoupper(substr($paiment->fromuser->name, 0, 2)) }}
          </div>

          {{-- Transfer Info --}}
          <div class="flex items-center gap-2 flex-1 min-w-0">
            <span class="text-sm font-medium text-white truncate">{{ $paiment->fromuser->name }}</span>
            
            <div class="flex items-center gap-1 bg-primarySoft/10 border border-primarySoft/20 rounded-full px-2 py-0.5 flex-shrink-0">
              <svg class="w-3 h-3 text-primarySoft" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
              </svg>
            </div>

            <span class="text-sm font-medium text-white truncate">{{ $paiment->touser->name }} ( {{$depence->title}} ) | {{$paiment->amount}}DH  </span>
          </div>

          @if($authuser->name==$paiment->fromuser->name )
          <form action="{{route('paiment.update',$paiment)}}" method="POST">
            @csrf
            @method('PATCH')
            <button type="submit" class="flex-shrink-0 flex items-center gap-1.5 px-3 py-1.5 bg-primarySoft hover:bg-blue-600 text-white text-xs font-medium rounded-xl transition-all duration-150 hover:scale-105 hover:shadow-lg hover:shadow-primarySoft/20 active:scale-95">
              <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
              </svg>
              Marquer payé
            </button>
          </form>
          @else
          <span class="text-xs bg-red-600 text-white border border-red-900 px-2 py-0.5 rounded-full">{{$paiment->is_payed}}</span>
          @endif
        </div>
        @endif
      @endforeach
    @endforeach
  </div>

</section>
    </div>

    <!-- ════ RIGHT SIDEBAR ════ -->
    <div class="space-y-6">

      <!-- Summary -->
      <section class="bg-surface border border-borderSoft rounded-2xl p-6 fade-in">
        <h3 class="text-base font-semibold mb-4">Summary</h3>
        <div class="divide-y divide-borderSoft">
          <div class="flex justify-between items-center py-3">
            <span class="text-slate-400 text-sm">Total Expences</span>
            <span class="font-semibold text-blue-400">{{$totaleExpences}}</span>
          </div>
          <div class="flex justify-between items-center py-3">
            <span class="text-slate-400 text-sm">Sum Expenses</span>
            <span class="font-semibold">{{$totalePrice}} DH</span>
          </div>
          <div class="flex justify-between items-center py-3">
            <span class="text-slate-400 text-sm">Your Share</span>
            <span class="font-semibold text-red-400">−DH</span>
          </div>
          <div class="flex justify-between items-center pt-3">
            <span class="text-slate-400 text-sm">Members</span>
            <span class="font-semibold">{{$sumMembers}}</span>
          </div>
        </div>
      </section>

      <!-- Categories -->
      <section class="bg-surface border border-borderSoft rounded-2xl p-6 fade-in">
        <div class="flex items-center justify-between mb-4">
          <h3 class="text-base font-semibold">Categories</h3>
          <button onclick="openModal('modal-category')"
            class="text-xs text-primarySoft hover:underline">+ Add</button>
        </div>
        <div class="space-y-2">
          @foreach($colocation->categorie as $categorie)
          <div class="flex items-center justify-between py-2">
            <div class="flex items-center gap-2">
              <span class="text-base"></span>
              <span class="text-sm text-slate-300">{{$categorie->title}}</span>
            </div>
            <span class="text-xs text-slate-500">{{$categorie->depence()->count()}} expense</span>
          </div>
          @endforeach
        </div>
      </section>

     

      <!-- Quick actions -->
      <section class="bg-surface border border-borderSoft rounded-2xl p-6 fade-in">
        <h3 class="text-base font-semibold mb-4">Actions</h3>
        <div class="space-y-2">
          <button onclick="openModal('modal-expense')"
            class="w-full flex items-center gap-3 px-4 py-3 rounded-xl bg-primarySoft text-white text-sm font-medium hover:bg-blue-600 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Add Expense
          </button>
        @foreach($colocation->user as $user)
        @if($user->pivot->type=='owner' && $user->name==$authuser->name)
          <button onclick="openModal('modal-category')"
            class="w-full flex items-center gap-3 px-4 py-3 rounded-xl border border-borderSoft text-slate-300 text-sm font-medium hover:bg-soft transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
            Add Category
          </button>
        @endif
        @endforeach
          <button
            class="w-full flex items-center gap-3 px-4 py-3 rounded-xl border border-borderSoft text-slate-300 text-sm font-medium hover:bg-soft transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 12v8a2 2 0 002 2h12a2 2 0 002-2v-8M16 6l-4-4-4 4M12 2v13"/></svg>
            Export Report
          </button>
        </div>
      </section>

    </div>
  </div>
</div>

<!-- ══════════════════════════════════
     MODAL — Add Expense
══════════════════════════════════ -->
<div class="modal-backdrop" id="modal-expense" onclick="closeOnBackdrop(event, 'modal-expense')">
  <div class="modal">
    <div class="flex items-center justify-between mb-6">
      <h2 class="text-base font-semibold">Add Expense</h2>
      <button onclick="closeModal('modal-expense')" class="text-slate-400 hover:text-slate-200 transition">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
      </button>
    </div>

    <form method="POST" action="{{route('depence.store')}}" class="space-y-4">
  @csrf
  @method('POST')
      <div>
        <label class="block text-sm font-medium text-slate-300 mb-1.5" for="exp-title">
          Title <span class="text-red-400">*</span>
        </label>
        <input class="input-field" id="exp-title" name="name" value="{{old('name')}}" type="text" placeholder="e.g. Courses Franprix" required>
      </div>

      <div class="grid grid-cols-2 gap-3">
        <div>
          <label class="block text-sm font-medium text-slate-300 mb-1.5" for="exp-amount">
            Amount (€) <span class="text-red-400">*</span>
          </label>
          <input class="input-field" id="exp-amount" name="price" value="{{old('price')}}" type="number" min="0" step="0.01" placeholder="0.00" required>
        </div>
        
      </div>

      <div>
        <label class="block text-sm font-medium text-slate-300 mb-1.5" for="exp-category">
          Category <span class="text-red-400">*</span>
        </label>
        <select class="input-field" id="exp-category" name='categorie_id' required>
          <option value="">Select a category…</option>
          @foreach($colocation->categorie as $categorie)
          <option name='categorie_id'  value="{{$categorie->id}}">{{$categorie->title}}</option>
          @endforeach
        </select>
      </div>
    <input type="hidden" name="colocation" value="{{$colocation}}">
      <div>
        <label class="block text-sm font-medium text-slate-300 mb-1.5" for="exp-paid-by">
          Paid by <span class="text-red-400">*</span>
        </label>
        <select class="input-field" id="exp-paid-by" name='user_id' required>
          <option value="">Select member…</option>
          @foreach($colocation->user as $user)
          <option name='user_id' value="{{$user->id}}">{{$user->name}}</option>
          @endforeach
        </select>
      </div>

      <div class="flex gap-3 pt-2">
        <button type="submit"
          class="flex-1 py-2.5 rounded-xl bg-primarySoft text-white text-sm font-medium hover:bg-blue-600 transition">
          Add Expense
        </button>
        <button type="button" onclick="closeModal('modal-expense')"
          class="px-5 py-2.5 rounded-xl border border-borderSoft text-slate-300 text-sm font-medium hover:bg-soft transition">
          Cancel
        </button>
      </div>

    </form>
  </div>
</div>

<!-- ══════════════════════════════════
     MODAL — Add Category
══════════════════════════════════ -->
<div class="modal-backdrop" id="modal-category" onclick="closeOnBackdrop(event, 'modal-category')">
  <div class="modal">
    <div class="flex items-center justify-between mb-6">
      <h2 class="text-base font-semibold">Add Category</h2>
      <button onclick="closeModal('modal-category')" class="text-slate-400 hover:text-slate-200 transition">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
      </button>
    </div>

    <form method="POST" action="{{route('categorie.store')}}" class="space-y-4">
    @csrf
      <div>
        <label class="block text-sm font-medium text-slate-300 mb-1.5" for="cat-name">
          Category Name <span class="text-red-400">*</span>
        </label>
        <input class="input-field" id="cat-name" name="name" value="{{old('name')}}" type="text" placeholder="e.g. Groceries" required>
      </div>
      <input type="hidden" name="colocation_id" value="{{$colocation->id}}">
      <div>
        <label class="block text-sm font-medium text-slate-300 mb-1.5" for="cat-icon">
          Icon <span class="text-slate-500 font-normal">(emoji) (optionel)</span>
        </label>
        <input class="input-field" id="cat-icon" name="icon" type="text" placeholder="e.g. 🛒" maxlength="2">
      </div>
      @if($errors->any())
        <ul>
          @foreach($errors->all() as $error)
          <li style="color:red">{{$error}}</li>
          @endforeach
        </ul>
        @endif

      <div class="flex gap-3 pt-2">
        <button type="submit"
          class="flex-1 py-2.5 rounded-xl bg-primarySoft text-white text-sm font-medium hover:bg-blue-600 transition">
          Add Category
        </button>
        <button type="button" onclick="closeModal('modal-category')"
          class="px-5 py-2.5 rounded-xl border border-borderSoft text-slate-300 text-sm font-medium hover:bg-soft transition">
          Cancel
        </button>
      </div>

    </form>
  </div>
</div>
<!-- ══════════════════════════════════
     MODAL — INVITATION
══════════════════════════════════ -->
<div class="modal-backdrop" id="modal-invitation" onclick="closeOnBackdrop(event, 'modal-invitation')">
  <div class="modal">
    <div class="flex items-center justify-between mb-6">
      <h2 class="text-base font-semibold">Invite a member</h2>
      <button onclick="closeModal('modal-invitation')" class="text-slate-400 hover:text-slate-200 transition">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
      </button>
    </div>

    <form method="POST" action="{{route('invitation.store')}}" class="space-y-4">
    @csrf
      <div>
        <label class="block text-sm font-medium text-slate-300 mb-1.5" for="cat-name">
          Email user <span class="text-red-400">*</span>
        </label>
        <input class="input-field" id="cat-name" name="email" value="{{old('email')}}" type="text" placeholder="user@gmail.com" required>
        <input type="hidden" name="colocation" value="{{$colocation}}">
      </div>
      @if($errors->any())
        <ul>
          @foreach($errors->all() as $error)
          <li style="color:red">{{$error}}</li>
          @endforeach
        </ul>
        @endif

      <div class="flex gap-3 pt-2">
        <button type="submit"
          class="flex-1 py-2.5 rounded-xl bg-primarySoft text-white text-sm font-medium hover:bg-blue-600 transition">
          Invite
        </button>
        <button type="button" onclick="closeModal('modal-invitation')"
          class="px-5 py-2.5 rounded-xl border border-borderSoft text-slate-300 text-sm font-medium hover:bg-soft transition">
          Cancel
        </button>
      </div>

    </form>
  </div>
</div>

<script>
  function openModal(id) {
    document.getElementById(id).classList.add('open');
    document.body.style.overflow = 'hidden';
  }
  function closeModal(id) {
    document.getElementById(id).classList.remove('open');
    document.body.style.overflow = '';
  }
  function closeOnBackdrop(e, id) {
    if (e.target === document.getElementById(id)) closeModal(id);
  }
  document.addEventListener('keydown', e => {
    if (e.key === 'Escape') {
      document.querySelectorAll('.modal-backdrop.open').forEach(m => closeModal(m.id));
    }
  });
</script>

</body>
</html>