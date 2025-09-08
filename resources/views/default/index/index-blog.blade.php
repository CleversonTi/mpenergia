@if (!empty($blog))
    <section class="index-blog">
        <div class="container big">
            <h2 class="section-title blog"><strong>Fique por dentro</strong> do nosso blog</h2>
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="row">
                        @foreach ($blog as $post)
                            <div class="col-lg-4">
                                <a class="blog-card" href="{{ route('blog-interna', ['uri' => $post['uri']]) }}">

                                    @php
                                        $imgBlog = $helpers->getImage(
                                            $post['imagem']['url'] ??
                                                ($post['imagem']['url'] ?? ($post['imagem'] ?? '')),
                                        );
                                    @endphp
                                    <img src="{{ $imgBlog }}" alt="" class="img-fluid blog-img image-blog"
                                        loading="lazy">
                                    <div class="content-desc">
                                        <h3>{{ $post['titulo'] }}</h3>
                                        <div class="link">
                                            <span class="continue">LER MAIS...</span>

                                        </div>

                                    </div>
                                </a>
                            </div>
                        @endforeach
                        <div class="row-ctas text-center mt-5 links">
                            <a href="{{ $blogUrl }}" class="btn btn-outline-primary btn-lg"
                                aria-label="Acessar blogURL">
                                <span>Acesse nosso blog</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endif
