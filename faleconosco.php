<section id="about" class="about">
    <div class="container" data-aos="fade-up">

        <div class="section-header">
            <p>Precisa de Ajuda? <span>Fale Conosco</span></p>
        </div>

        <div class="mb-3">
            <iframe style="border:0; width: 100%; height: 350px;" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12097.433213460943!2d-74.0062269!3d40.7101282!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb89d1fe6bc499443!2sDowntown+Conference+Center!5e0!3m2!1smk!2sbg!4v1539943755621" frameborder="0" allowfullscreen></iframe>
        </div>

        <div class="row gy-4">

            <div class="col-md-6">
                <div class="info-item  d-flex align-items-center">
                    <i class="icon bi bi-map flex-shrink-0"></i>
                    <div>
                        <h3>Nosso Endereço</h3>
                        <p>Rua das Tradições , N° 07, Centro, Fruta de Leite, Minas Gerais.</p>
                    </div>
                </div>
            </div><!-- End Info Item -->

            <div class="col-md-6">
                <div class="info-item d-flex align-items-center">
                    <i class="icon bi bi-envelope flex-shrink-0"></i>
                    <div>
                        <h3>E-mail</h3>
                        <p>daroca@gmail.com</p>
                    </div>
                </div>
            </div><!-- End Info Item -->

            <div class="col-md-6">
                <div class="info-item  d-flex align-items-center">
                    <i class="icon bi bi-telephone flex-shrink-0"></i>
                    <div>
                        <h3>Telefone</h3>
                        <p>3722-4768</p>
                    </div>
                </div>
            </div><!-- End Info Item -->

            <div class="col-md-6">
                <div class="info-item  d-flex align-items-center">
                    <i class="icon bi bi-share flex-shrink-0"></i>
                    <div>
                        <h3>Horários</h3>
                        <div><strong>Seg-Sáb:</strong> 11AM - 23PM;
                            <strong>Domingo:</strong> Closed
                        </div>
                    </div>
                </div>
            </div><!-- End Info Item -->

        </div>

        <div class="row">
            <div class="col-12">
                <h2>

                </h2>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <?php if (isset($_SESSION['msgSuccess'])): ?>

                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong><?= $_SESSION['msgSuccess'] ?></strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>

                <?php endif; ?>

                <?php if (isset($_GET['msgError'])): ?>

                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong><?= $_SESSION['msgError'] ?></strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>

                <?php endif; ?>
            </div>
        </div>

        <form class="g-3" action="faleConoscoEnvio.php" method="POST">

            <div class="row">

                <div class="col-12 mt-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control" name="nome" id="nome"
                        placeholder="Seu nome" required>
                </div>

                <div class="col-9 mt-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="text" class="form-control" name="email" id="email"
                        placeholder="Seu e-mail" required>
                </div>

                <div class="col-3 mt-3">
                    <label for="telefone" class="form-label">Telefone</label>
                    <input type="text" class="form-control" name="telefone" id="telefone"
                        placeholder="Seu telefone" required>
                </div>

                <div class="col-12 mt-3">
                    <label for="assunto" class="form-label">Assunto</label>
                    <input type="text" class="form-control" name="assunto" id="assunto"
                        placeholder="Assunto a ser tratado" required>
                </div>
                <div class="col-12 mt-3">
                    <label for="mensagem" class="form-label">Mensagem</label>
                    <textarea class="form-control" rows="10" name="mensagem" id="mensagem"
                        placeholder="Descreva mais sobre o assunto que deseja tratar conosoco."></textarea>
                </div>
            </div>

            <div class="col-auto mt-5">
                <button type="submit" class="btn btn-primary btn-sm">Enviar</button>
            </div>
        </form>

        </main>
</section>

<script src="assets/ckeditor5/ckeditor5-build-classic/ckeditor.js"></script>

<script>
    ClassicEditor
        .create(document.querySelector('#mensagem'))
        .catch(error => {
            console.error(error);
        });
</script>