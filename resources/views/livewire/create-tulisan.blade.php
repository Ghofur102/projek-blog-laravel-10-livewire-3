<div>
    @if ($modalDelete)
        <div id="modal" class="modal">
            <div class="modal-content">
                <span id="closeModal" wire:click='closeModal' class="close">&times;</span>
                <h2>Yakin mau hapus data?</h2>
                <div class="card-footer">
                    <button type="submit" class="edit-button" style="background-color: orangered;"
                        wire:click='closeModal'>Tutup</button>
                    <button type="submit" class="delete-button" style="background-color: red;"
                        wire:click='delete()'>Hapus</button>
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
    <form action="proses.php" method="post" enctype="multipart/form-data">
        <label for="judul_blog">Judul Blog:</label>
        <input type="text" name="judul_blog" id="judul_blog" wire:model='judul_blog' required>

        <label for="foto">Foto:</label>
        @if ($foto)
            <img src="{{ $foto->temporaryUrl() }}" alt="">
        @else
            <img src="{{ asset('storage/' . $foto_edit) }}" alt="">
        @endif
        <input type="file" name="foto" id="foto{{ $iteration }}" accept="image/*" wire:model='foto' required>

        <label for="isi_blog">Isi Blog:</label>
        <textarea name="isi_blog" id="isi_blog" wire:model='isi_blog' required></textarea>

        @if ($isEdit)
            <input type="button" wire:click='update()' value="Update Blog">
        @else
            <input type="button" wire:click='store()' value="Tambah Blog">
        @endif
    </form>

    <h1 style="color: white;text-align:center;">Semua Daftar Blog</h1>
    <div class="card-container">
        @foreach ($blogs as $blog)
            <div class="card">
                <div class="card-header">
                    <h2>
                        <a href="/tulisan/{{ $blog->id }}">{{ $blog->judul_blog }}</a>
                    </h2>
                </div>
                <div class="card-body">
                    <img class="image-blog" src="{{ asset('storage/' . $blog->foto) }}" alt="{{ $blog->isi_blog }}">
                    <p>
                        {{ $blog->isi_blog }}
                    </p>
                </div>
                <div class="card-footer">
                    <button type="submit" class="edit-button" style="background-color: orangered;"
                        wire:click='edit({{ $blog->id }})'>Edit</button>
                    <button type="submit" class="delete-button" style="background-color: red;"
                        wire:click='delete_confirmation({{ $blog->id }})'>Hapus</button>

                </div>
            </div>
        @endforeach
    </div>


    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

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

        /* Styling the close button */
        .close {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 20px;
            cursor: pointer;
        }

        .image-blog {
            border-radius: 50%;
            width: 50%;
            margin: auto;
        }

        /* Styling the container using flex */
        .card-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }

        /* Styling the card */
        .card {
            border: 1px solid #ccc;
            border-radius: 5px;
            margin: 10px;
            overflow: hidden;
            background-color: white;
            width: calc(33.33% - 20px);
            /* Untuk 3 card dalam satu baris di laptop */
            max-width: 400px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Styling the card header */
        .card-header {
            background-color: #007BFF;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        /* Styling the card body */
        .card-body {
            padding: 10px;
            text-align: center;
        }

        /* Styling the image */
        .card-body img {
            max-width: 100%;
            height: auto;
        }

        /* Styling the card-footer */
        .card-footer {
            background-color: #f0f0f0;
            padding: 10px;
            display: flex;
            justify-content: center;
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


        /* Responsiveness */
        @media (max-width: 1200px) {
            .card {
                width: calc(50% - 20px);
                /* Untuk 2 card dalam satu baris di tablet */
            }
        }

        @media (max-width: 768px) {
            .card {
                width: calc(100% - 20px);
                /* Untuk 1 card dalam satu baris di hp */
            }
        }

        .alert {
            background-color: #f44336;
            color: white;
            padding: 15px;
            text-align: center;
            border-radius: 5px;
            margin: 20px;
        }

        form {
            background-color: #fff;
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="file"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="button"] {
            background-color: #007BFF;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="button"]:hover {
            background-color: #0056b3;
        }
    </style>
</div>
