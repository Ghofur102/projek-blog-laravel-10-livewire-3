<x-app-layout>
    <section style="background-color: white;">
        <header>
            <h1>{{ $blog->judul_blog }}</h1>
        </header>
        <main>
            <article>
                <img style="width: 50%; border-radius: 50%;margin:auto;" src="{{ asset('storage/' . $blog->foto) }}"
                    alt="Gambar Blog">
                <p>
                    {{ $blog->isi_blog }}
                </p>
            </article>
        </main>
        @livewire('KomentarBlog', ['blog_id' => $blog->id])
    </section>
</x-app-layout>

<style>
    /* Reset CSS */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    /* Style header */
    header {
        background-color: #007BFF;
        color: #fff;
        text-align: center;
        padding: 20px;
    }

    /* Style judul blog */
    h1 {
        font-size: 24px;
    }

    /* Style konten blog */
    main {
        width: 80%;
        margin: 0 auto;
        padding: 20px;
    }

    article {
        margin: 20px 0;
    }

    img {
        max-width: 100%;
        height: auto;
    }

    /* Style paragraf konten */
    p {
        font-size: 16px;
        line-height: 1.5;
        margin-top: 10px;
    }
</style>
