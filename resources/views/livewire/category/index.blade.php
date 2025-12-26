<div class="p-6">
    <h1 class="text-xl font-bold mb-4">Category</h1>

    @if (session()->has('success'))
        <div class="mb-3 text-green-600">
            {{ session('success') }}
        </div>
    @endif

    <form wire:submit.prevent="{{ $categoryId ? 'update' : 'save' }}" class="mb-4">
        <input
            type="text"
            wire:model="name"
            placeholder="Nama Category"
            class="border p-2 w-full mb-2"
        >

        @error('name')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror

        <button
            type="submit"
            class="px-4 py-2 bg-blue-600 text-white"
        >
            {{ $categoryId ? 'Update' : 'Simpan' }}
        </button>
    </form>

    <table class="w-full border">
        <thead>
            <tr class="border">
                <th class="p-2">Nama</th>
                <th class="p-2">Slug</th>
                <th class="p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr class="border">
                    <td class="p-2">{{ $category->name }}</td>
                    <td class="p-2">{{ $category->slug }}</td>
                    <td class="p-2">
                        <button wire:click="edit({{ $category->id }})" class="text-blue-600">Edit</button>
                        <button wire:click="delete({{ $category->id }})" class="text-red-600 ml-2">Hapus</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
