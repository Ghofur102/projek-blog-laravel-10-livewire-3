<div>
    @if ($modalDeleteComment)
        <div id="modal" class="modal">
            <div class="modal-content">
                <span id="closeModal" wire:click='closeModalDelete()' class="close">&times;</span>
                <h2>Yakin mau hapus data?</h2>
                <div class="card-footer">
                    <button type="submit" class="edit-button" style="background-color: orangered;"
                        wire:click='closeModalDelete()'>Tutup</button>
                    <button type="submit" class="delete-button" style="background-color: red;"
                        wire:click='delete_comment()'>Hapus</button>
                </div>
            </div>
        </div>
    @endif
    @if ($errors->any())
        <div class="alert">
            {{ $errors->first() }}
        </div>
    @endif
    @if ($success)
        <div class="alert">
            {{ $message_success }}
        </div>
    @endif
    <section style="margin: 10%;">
        <div class="comment-form">
            <h2>Jumlah Komentar : {{ $jumlah_komentar }}</h2>
            <h3>Tinggalkan Komentar</h3>
            <form>
                <label for="komentar">Komentar:</label>
                <textarea id="komentar" name="komentar" wire:model='komentar' required></textarea>

                @if ($isEdit)
                    <button type="button" wire:click='update_comment()'>Update Komentar</button>
                @else
                    <button type="button" wire:click='store_comment()'>Kirim Komentar</button>
                @endif
            </form>
        </div>

        @foreach ($comments as $nomer => $comment)
            <div class="comment">
                <div class="comment-header">
                    <span class="comment-author">{{ $comment->user->name }}</span>
                    <div class="comment-actions">
                        @if ($comment->isLikeComment(Auth::user()->id))
                            <svg class="like-icon" style="color: #f44336;"
                                wire:click='like_comment({{ $comment->id }})' xmlns="http://www.w3.org/2000/svg"
                                width="20px" height="20px" fill="currentColor" class="bi bi-heart"
                                viewBox="0 0 16 16">
                                <path
                                    d="M8 14s-1.5-1.17-3-2C3.49 11.24 2 10.17 2 8.5 2 7.12 3.12 6 4.5 6c.71 0 1.38.26 2.29 1.35L8 8.86l1.21-1.51C10.12 6.26 10.79 6 11.5 6 12.88 6 14 7.12 14 8.5c0 1.67-1.49 2.74-3 3.5-1.5.83-3 2-3 2z" />
                            </svg>
                        @else
                            <svg class="like-icon" wire:click='like_comment({{ $comment->id }})'
                                xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="currentColor"
                                class="bi bi-heart" viewBox="0 0 16 16">
                                <path
                                    d="M8 14s-1.5-1.17-3-2C3.49 11.24 2 10.17 2 8.5 2 7.12 3.12 6 4.5 6c.71 0 1.38.26 2.29 1.35L8 8.86l1.21-1.51C10.12 6.26 10.79 6 11.5 6 12.88 6 14 7.12 14 8.5c0 1.67-1.49 2.74-3 3.5-1.5.83-3 2-3 2z" />
                            </svg>
                        @endif
                        <span class="like-count">{{ $comment->countLikeComment() }}</span>
                        @if ($comment->user->id === Auth::user()->id)
                            <!-- untuk pemilik komentar -->
                            <?xml version="1.0" encoding="utf-8"?>
                            <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                                wire:click='delete_confirmation({{ $comment->id }})'>
                                <path
                                    d="M18 6L17.1991 18.0129C17.129 19.065 17.0939 19.5911 16.8667 19.99C16.6666 20.3412 16.3648 20.6235 16.0011 20.7998C15.588 21 15.0607 21 14.0062 21H9.99377C8.93927 21 8.41202 21 7.99889 20.7998C7.63517 20.6235 7.33339 20.3412 7.13332 19.99C6.90607 19.5911 6.871 19.065 6.80086 18.0129L6 6M4 6H20M16 6L15.7294 5.18807C15.4671 4.40125 15.3359 4.00784 15.0927 3.71698C14.8779 3.46013 14.6021 3.26132 14.2905 3.13878C13.9376 3 13.523 3 12.6936 3H11.3064C10.477 3 10.0624 3 9.70951 3.13878C9.39792 3.26132 9.12208 3.46013 8.90729 3.71698C8.66405 4.00784 8.53292 4.40125 8.27064 5.18807L8 6"
                                    stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="15px" height="15px"
                                viewBox="0 0 50 50" wire:click='edit({{ $comment->id }})'>
                                <path
                                    d="M 43.125 2 C 41.878906 2 40.636719 2.488281 39.6875 3.4375 L 38.875 4.25 L 45.75 11.125 C 45.746094 11.128906 46.5625 10.3125 46.5625 10.3125 C 48.464844 8.410156 48.460938 5.335938 46.5625 3.4375 C 45.609375 2.488281 44.371094 2 43.125 2 Z M 37.34375 6.03125 C 37.117188 6.0625 36.90625 6.175781 36.75 6.34375 L 4.3125 38.8125 C 4.183594 38.929688 4.085938 39.082031 4.03125 39.25 L 2.03125 46.75 C 1.941406 47.09375 2.042969 47.457031 2.292969 47.707031 C 2.542969 47.957031 2.90625 48.058594 3.25 47.96875 L 10.75 45.96875 C 10.917969 45.914063 11.070313 45.816406 11.1875 45.6875 L 43.65625 13.25 C 44.054688 12.863281 44.058594 12.226563 43.671875 11.828125 C 43.285156 11.429688 42.648438 11.425781 42.25 11.8125 L 9.96875 44.09375 L 5.90625 40.03125 L 38.1875 7.75 C 38.488281 7.460938 38.578125 7.011719 38.410156 6.628906 C 38.242188 6.246094 37.855469 6.007813 37.4375 6.03125 C 37.40625 6.03125 37.375 6.03125 37.34375 6.03125 Z">
                                </path>
                            </svg>
                        @endif
                    </div>
                </div>
                <p class="comment-text">{{ $comment->komentar }}</p>
                <button type="button" class="accordion">Replies ({{ $comment->countReplyComment() }})</button>
                <div class="panel" style="display: none;">
                    @livewire('BalasanKomentarBlog', ['id_komentar' => $comment->id])
                </div>
            </div>
        @endforeach
    </section>

    <script>
        // JavaScript
        document.addEventListener("DOMContentLoaded", function() {
            // Temukan semua tombol "Balas"
            var acc = document.getElementsByClassName("accordion");

            // Tambahkan event listener ke setiap tombol "Balas"
            for (var i = 0; i < acc.length; i++) {
                acc[i].addEventListener("click", function() {
                    // Toggle kelas "active" pada tombol "Balas"
                    this.classList.toggle("active");

                    // Temukan panel yang berdekatan (komentar) dan toggle visibilitasnya
                    var panel = this.nextElementSibling;
                    if (panel.style.display === "none") {
                        panel.style.display = "block";
                    } else {
                        panel.style.display = "none";
                    }
                });
            }
        });
    </script>

    <style>
        /* Styling the modal background */
        .modal {
            display: block;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 1;
        }

        .accordion {
            color: #fff;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            background-color: #0056b3;
        }
        /* Styling the modal content */
        .modal-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 60%;
            max-width: 500px;
        }

        /* Style form komentar */
        .comment-form {
            margin-top: 20px;
        }

        .comment-form h3 {
            font-size: 20px;
        }

        .comment-form form {
            margin-top: 10px;
        }

        .comment-form label {
            display: block;
            margin-bottom: 5px;
        }

        .comment-form input,
        .comment-form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .comment-form button {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        /* Styling the edit and delete buttons */
        .edit-button,
        .delete-button {
            color: #fff;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        .edit-button {
            margin-right: 10px;
        }

        /* Hover effect for buttons */
        .edit-button:hover,
        .delete-button:hover {
            background-color: #0056b3;
        }

        /* Style komentar */
        .comment {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .comment-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .comment-author {
            font-weight: bold;
        }

        .comment-actions {
            display: flex;
            align-items: center;
        }

        .like-icon,
        .reply-icon {
            margin-right: 5px;
        }

        .comment-text {
            margin-top: 10px;
        }

        .alert {
            background-color: #f44336;
            color: white;
            padding: 15px;
            text-align: center;
            border-radius: 5px;
            margin: 20px;
        }
    </style>
</div>
