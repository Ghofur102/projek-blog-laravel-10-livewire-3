<?php

namespace App\Livewire;

use App\Models\comments;
use App\Models\likes_comments;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class KomentarBlog extends Component
{
    public $blog_id;
    public $modalDeleteComment = false;
    public $id_delete;
    public $komentar;
    public $closeModal;
    public $success = false;
    public $message_success;
    public $isEdit = false;
    public $id_edit;
    public $reply = false;
    public $id_reply = 0;
    public $selectedComment;

    public function render()
    {
        $comments = comments::where("blog_id", $this->blog_id)->get();
        $jumlah_komentar = $comments->count();
        return view('livewire.komentar-blog', compact("comments", "jumlah_komentar"));
    }
    public function store_comment()
    {
        $this->validate([
            "komentar" => "required|max:1000"
        ], [
            "komentar.required" => "Komentar harus diisi!",
            "komentar.max" => "Komentar tidak boleh lebih dari 1.000 karakter!"
        ]);
        comments::create([
            "user_id" => Auth::user()->id,
            "blog_id" => $this->blog_id,
            "komentar" => $this->komentar
        ]);
        $this->komentar = '';
    }
    public function like_comment(string $id)
    {
        $isLikeComment = likes_comments::where("user_id", Auth::user()->id)->where("comment_id", $id)->exists();
        if ($isLikeComment) {
            $delete_like = likes_comments::where("user_id", Auth::user()->id)->where("comment_id", $id)->first();
            $delete_like->delete();
        } else {
            likes_comments::create([
                "user_id" => Auth::user()->id,
                "comment_id" => $id
            ]);
        }
    }
    public function delete_confirmation(string $id)
    {
        $this->modalDeleteComment = true;
        $this->id_delete = $id;
    }
    public function delete_comment()
    {
        $delete_comment = comments::find($this->id_delete);
        $delete_comment->delete();
        $this->success = true;
        $this->modalDeleteComment = false;
        $this->message_success = "Sukses menghapus komentar!";
    }
    public function closeModalDelete() {
        $this->modalDeleteComment = false;
    }
    public function edit(string $id)
    {
        $komen = comments::find($id);
        $this->komentar = $komen->komentar;
        $this->id_edit = $komen->id;
        $this->isEdit = true;
    }
    public function update_comment()
    {
        $up_komen = comments::find($this->id_edit);
        $up_komen->komentar = $this->komentar;
        $up_komen->save();
        $this->isEdit = false;
        $this->komentar = '';
        $this->success = true;
        $this->message_success = "Sukses mengubah komentar!";
    }
    public function openReplies(string $id)
    {
        $this->reply = true;
        $this->id_reply = $id;
        $this->selectedComment = $id;
    }
}
