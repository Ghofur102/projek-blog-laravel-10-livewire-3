<?php

namespace App\Livewire;

use App\Models\blogs;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CRUDTulisan extends Component
{
    use WithFileUploads;
    public $judul_blog;
    public $foto;
    public $isi_blog;
    public $success = false;
    public $message_success;
    public $foto_edit;
    public $isEdit = false;
    public $edit_id;
    public $hapus_id;
    public $modalDelete = false;
    public $iteration = 0;
    
    public function render()
    {
        $blogs = blogs::all();
        return view('livewire.create-tulisan', compact("blogs"));
    }
    public function store()
    {
        $this->validate([
            "judul_blog" => "required",
            "foto" => "required|image|max:50000",
            "isi_blog" => "required"
        ], [
            "judul_blog.required" => "judul blog harus diisi!",
            "foto.required" => "foto blog harus diisi!",
            "foto.image" => "inputan foto tidak valid!",
            "foto.max" => "foto tidak boleh lebih dari 50MB!",
            "isi_blog.required" => "isi blog tidak boleh kosong!"
        ]);
        blogs::create([
            "user_id" => Auth::user()->id,
            "judul_blog" => $this->judul_blog,
            "foto" => $this->foto->store('foto-blogs', 'public'),
            "isi_blog" => $this->isi_blog
        ]);
        $this->reset();
        $this->iteration = $this->iteration + rand();
        $this->success = true;
        $this->message_success = "Anda berhasil menambahkan blog!";
    }
    public function edit($id) {
        $blog = blogs::find($id);
        $this->judul_blog = $blog->judul_blog;
        $this->foto_edit = $blog->foto;
        $this->isi_blog = $blog->isi_blog;
        $this->edit_id = $blog->id;
        $this->isEdit = true;
    }
    public function update()
    {
        $blog = blogs::find($this->edit_id);
        $blog->judul_blog = $this->judul_blog;
        if ($this->foto) {
            Storage::delete("public/".$blog->foto);
            $blog->foto = $this->foto->store('foto-blogs', 'public');
        }
        $blog->isi_blog = $this->isi_blog;
        $blog->save();
        $this->isEdit = false;
        $this->reset();
        $this->success = true;
        $this->message_success = "Anda sukses mengupdate data!";
    }
    public function delete_confirmation($id)
    {
        $this->hapus_id = $id;
        $this->modalDelete = true;
    }
    public function closeModal()
    {
        $this->modalDelete = false;
    }
    public function delete()
    {
        $blog = blogs::find($this->hapus_id);
        Storage::delete("public/".$blog->foto);
        $blog->delete();
        $this->modalDelete = false;
        $this->success = true;
        $this->message_success = "Anda sukses menghapus data!";
    }
}
