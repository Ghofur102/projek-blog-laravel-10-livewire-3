<?php

namespace App\Livewire;

use App\Models\like_replies_comments;
use App\Models\replies_comments;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class BalasanKomentarBlog extends Component
{
    public $komentar_balasan;
    public $id_komentar;
    public $success = false;
    public $message_success;
    public $modalDelete = false;
    public $id_delete;
    public $id_edit;
    public $isEdit = false;
    public function render()
    {
        $replies_comments = replies_comments::where("comment_id", $this->id_komentar)->get();
        return view('livewire.balasan-komentar-blog', compact("replies_comments"));
    }
    public function store_reply_comment()
    {
        $this->validate([
            "komentar_balasan" => "required|max:1000"
        ]);
        replies_comments::create([
            "user_id" => Auth::user()->id,
            "comment_id" => $this->id_komentar,
            "komentar" => $this->komentar_balasan
        ]);
        $this->komentar_balasan = '';
        $this->success = true;
        $this->message_success = "Sukses membalas komentar!";
    }
    public function like_reply_comment(string $id)
    {
        $check = like_replies_comments::where("user_id", Auth::user()->id)->where("reply_comment_id", $id)->exists();
        if ($check) {
            like_replies_comments::where("user_id", Auth::user()->id)->where("reply_comment_id", $id)->delete();
        } else {
            like_replies_comments::create([
                "user_id" => Auth::user()->id,
                "reply_comment_id" => $id
            ]);
        }
    }
    public function delete_confirmation(string $id)
    {
        $this->modalDelete = true;
        $this->id_delete = $id;
    }
    public function closeModalDelete()
    {
        $this->modalDelete = false;
    }
    public function delete()
    {
        replies_comments::find($this->id_delete)->delete();
        $this->modalDelete = false;
        $this->success = true;
        $this->message_success = "Sukses menghapus komentar!";
    }
    public function edit(string $id)
    {
        $this->isEdit = true;
        $this->id_edit = $id;
        $replies = replies_comments::find($id);
        $this->komentar_balasan = $replies->komentar;
    }
    public function update()
    {
        $up_replies = replies_comments::find($this->id_edit);
        $up_replies->komentar = $this->komentar_balasan;
        $up_replies->save();
        $this->isEdit = false;
        $this->komentar_balasan = '';
        $this->success = true;
        $this->message_success = "Sukses mengubah komentar!";
    }
}
