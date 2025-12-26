<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;

class CreateEvent extends Component
{
    public $judul;
    public $lokasi;
    public $waktu_mulai;
    public $waktu_selesai;
    public $category_id = null;
    public $description;
    public $events = [];
    public $editingEventId = null;

    protected $rules = [
        'judul' => 'required|string|max:255',
        'lokasi' => 'required|string|max:255',
        'description' => 'nullable|string',
        'waktu_mulai' => 'required|date',
        'waktu_selesai' => 'required|date|after:waktu_mulai',
        'category_id' => 'nullable|exists:categories,id',
    ];

    public function save()
    {
        $this->validate();
        $event = Event::create([
            'organizer_id' => Auth::id(),
            'category_id' => $this->category_id,
            'judul' => $this->judul,
            'lokasi' => $this->lokasi,
            'description' => $this->description,
            'waktu_mulai' => $this->waktu_mulai,
            'waktu_selesai' => $this->waktu_selesai,
        ]);

        session()->flash('success', 'Event berhasil dibuat');

        $this->resetForm();
        $this->loadEvents();
        return redirect('/dashboard');
    }

    public function mount()
    {
        $this->loadEvents();
    }

    protected function resetForm()
    {
        $this->judul = null;
        $this->lokasi = null;
        $this->waktu_mulai = null;
        $this->waktu_selesai = null;
        $this->category_id = null;
        $this->editingEventId = null;
    }

    public function loadEvents()
    {
        if (Auth::check()) {
            $this->events = Event::where('organizer_id', Auth::id())->orderBy('waktu_mulai', 'desc')->get();
        } else {
            $this->events = [];
        }
    }

    public function edit($id)
    {
        $event = Event::findOrFail($id);
        $this->editingEventId = $event->id;
        $this->judul = $event->judul;
        $this->lokasi = $event->lokasi;
        $this->waktu_mulai = $event->waktu_mulai;
        $this->waktu_selesai = $event->waktu_selesai;
        $this->category_id = $event->category_id;
    }

    public function update()
    {
        $this->validate();
        if (!$this->editingEventId) {
            session()->flash('error', 'Tidak ada event yang dipilih untuk diupdate');
            return;
        }

        $event = Event::findOrFail($this->editingEventId);
        $event->update([
            'category_id' => $this->category_id,
            'judul' => $this->judul,
            'lokasi' => $this->lokasi,
            'description' => $this->description,
            'waktu_mulai' => $this->waktu_mulai,
            'waktu_selesai' => $this->waktu_selesai,
        ]);

        session()->flash('success', 'Event berhasil diperbarui');
        $this->resetForm();
        $this->loadEvents();
    }

    public function delete($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();
        session()->flash('success', 'Event berhasil dihapus');
        $this->loadEvents();
    }

    public function render()
    {
        return view('livewire.dashboard.create-event');
    }
}
