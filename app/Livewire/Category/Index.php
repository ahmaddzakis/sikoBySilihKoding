<?php

namespace App\Livewire\Category;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;

class Index extends Component
{
    public $name;
    public $categoryId;

    protected $rules = [
        'name' => 'required|min:3'
    ];

    public function save()
    {
        $this->validate();

        Category::create([
            'nama' => $this->name,
            'deskripsi' => null,
        ]);


        $this->reset(['name']);
        session()->flash('success', 'Category berhasil ditambahkan');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $this->categoryId = $category->id;
        $this->name = $category->name;
    }

    public function update()
    {
        $this->validate();

        $category = Category::findOrFail($this->categoryId);
        $category->update([
            'nama' => $this->name,
            'slug' => Str::slug($this->name),
        ]);

        $this->reset(['name', 'categoryId']);
        session()->flash('success', 'Category berhasil diupdate');
    }

    public function delete($id)
    {
        Category::findOrFail($id)->delete();
        session()->flash('success', 'Category berhasil dihapus');
    }

    public function render()
    {
        return view('livewire.category.index', [
            'categories' => Category::latest()->get()
        ]);
    }
}
