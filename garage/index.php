<body class="brick">
    <?php
    require_once("templates/header.php")
    ?>



    <main>

        <section>
            <div class="card bg-dark text-white">
                <img src="upload/services/vidange.jpg" class="card-img" alt="...">
                <div class="card-img-overlay">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    <p class="card-text">Last updated 3 mins ago</p>
                </div>
            </div>

            <div class="card bg-dark text-white">
                <img src="upload/services/entretien.jpg" class="card-img" alt="...">
                <div class="card-img-overlay">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    <p class="card-text">Last updated 3 mins ago</p>
                </div>
            </div>

            <div class="card bg-dark text-white">
                <img src="upload/services/reparation.jpg" class="card-img" alt="...">
                <div class="card-img-overlay">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    <p class="card-text">Last updated 3 mins ago</p>
                </div>
            </div>

        </section>



        <section id="voiture">
            <div class="card-group">
                <div class="card">
                    <img src="upload/cars/cadillac1.png" class="card-img-top" alt="cadillac escalade">
                    <div class="card-body text-center">
                        <h5 class="card-title">Cadillac Escalade</h5>
                        <div class="d-grid gap-2">
                            <a href="#" class="btn btn-outline-primary btn-lg link-light text-dark">details</a>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <img src="upload/cars/hummer1.png" class="card-img-top" alt="hummer h2">
                    <div class="card-body text-center">
                        <h5 class="card-title">Hummer 2</h5>
                        <div class="d-grid gap-2">
                            <a href="" class="btn btn-outline-primary btn-lg link-light text-dark">details</a>
                        </div>

                    </div>
                </div>
                <div class="card">
                    <img src="upload/cars/lexus1.png" class="card-img-top" alt="lexus rx450h">
                    <div class="card-body text-center">
                        <h5 class="card-title">Lexus rx450h</h5>
                        <div class="d-grid gap-2">
                            <a href="#" class="btn btn-outline-primary btn-lg link-light text-dark">details</a>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <section class="commentaires container mt-4">
            <h2 style="color:aliceblue">Commentaires Clients</h2>
            <div id="commentaires-container">
                <!-- Les commentaires seront injectés ici par JavaScript -->
            </div>
        </section>

    </main>
    <?php
    require_once("templates/footer.php");
    ?>
    <script src="app/script/comments.js"></script>

</body>

</html>