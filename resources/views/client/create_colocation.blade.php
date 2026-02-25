<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>EasyColoc - Create Colocation</title>

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
  .input-field {
    width: 100%;
    background: #0F172A;
    border: 1px solid #475569;
    border-radius: 12px;
    color: #e2e8f0;
    font-size: 14px;
    padding: 11px 14px;
    outline: none;
    transition: border-color 180ms ease, box-shadow 180ms ease;
  }
  .input-field::placeholder { color: #475569; }
  .input-field:focus {
    border-color: #3B82F6;
    box-shadow: 0 0 0 3px rgba(59,130,246,.15);
  }

  .fade-in { animation: fadeUp .4s ease both; }
  @keyframes fadeUp { from{opacity:0;transform:translateY(8px)} to{opacity:1;transform:translateY(0)} }
</style>
</head>

<body class="bg-background text-slate-200 min-h-screen flex items-center justify-center px-6">

<div class="w-full max-w-md fade-in">

  <!-- Back link -->
  <a href="{{route('home')}}" class="inline-flex items-center gap-2 text-sm text-slate-400 hover:text-slate-200 transition mb-6">
    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
      <polyline points="15 18 9 12 15 6"/>
    </svg>
    Back to My Colocations
  </a>

  <!-- Card -->
  <div class="bg-surface border border-borderSoft rounded-2xl p-8">

    <h1 class="text-xl font-semibold mb-1">Create a Colocation</h1>
    <p class="text-slate-400 text-sm mb-7">Enter a name for your new shared apartment.</p>
    
    <form method="POST" action="{{ route('colocation.store') }}">
    @csrf
    <div class="mb-6">
      <label class="block text-sm font-medium text-slate-300 mb-2" for="name">
          Colocation Name <span class="text-red-400">*</span>
        </label>
        <input
        class="input-field"
        id="name"
        name="name"
        type="text"
        value="{{old('name')}}"
        placeholder="e.g. Appart' Paris 11e"
        maxlength="50"
        required
        autofocus
        >
        <p class="text-xs text-slate-500 mt-2">Give your colocation a short, recognisable name.</p>
        @if($errors->any())
        <ul>
          @foreach($errors->all() as $error)
          <li style="color:red">{{$error}}</li>
          @endforeach
        </ul>
        @endif
        @if(session('error'))
          <p style="color:red">{{session('error')}}</p>
        @endif

      </div>

      <div class="flex items-center gap-3">
        <button
          type="submit"
          class="flex-1 py-3 rounded-xl bg-primarySoft text-white text-sm font-medium hover:bg-blue-600 transition text-center"
        >
          Create Colocation
        </button>
        <a
          href="{{route('home')}}"
          class="px-5 py-3 rounded-xl border border-borderSoft text-slate-300 text-sm font-medium hover:bg-soft transition text-center"
        >
          Cancel
        </a>
      </div>
    </form>

  </div>

</div>

</body>
</html>