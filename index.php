<?php
require_once('get_posts.php');
$posts = get_posts();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Eliminación Masiva de Datos en PHP y MySQL</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/js/all.min.js" integrity="sha512-naukR7I+Nk6gp7p5TMA4ycgfxaZBJ7MO5iC3Fp6ySQyKFHOGfpkSZkYVWV5R7u7cfAicxanwYQ5D1e17EfJcMA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="custom.css">

    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <style>

    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-danger bg-gradient">
        <div class="container">
            <a class="navbar-brand" href="./">Eliminación Masiva</a>
            <div>
                <a href="https://www.configuroweb.com/46-aplicaciones-gratuitas-en-php-python-y-javascript/#Aplicaciones-gratuitas-en-PHP,-Python-y-Javascript" class="text-light fw-bolder h6 text-decoration-none" target="_blank">Para más desarrollos ConfiguroWeb</a>
            </div>
        </div>
    </nav>
    <div class="container px-5 my-3">
        <h2 class="text-center">Sistema de Eliminación Masiva de Datos en PHP y MySQL</h2>
        <div class="row">
            <!-- Page Content Container -->
            <div class="col-lg-12 col-md-12 col-sm-12 mt-4 pt-4 mx-auto">
                <div class="container-fluid">
                    <div class="card rounded-0 shadow">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                <div class="card-title col-auto flex-shrink-1 flex-grow-1">Selecciona los checks en específico que deseas eliminar</div>
                                <div class="col-atuo">
                                    <button class="btn btn-danger btn-sm btn-flat d-none" id="delete_btn">Eliminar los Post Selecciionados</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="container-fluid">
                                <table class="table table-stripped table-bordered">
                                    <colgroup>
                                        <col width="5%">
                                        <col width="20%">
                                        <col width="20%">
                                        <col width="55%">
                                    </colgroup>
                                    <thead>
                                        <tr>
                                            <th class="text-center">
                                                <input class="form-check-input" type="checkbox" id="selectAll">

                                            </th>
                                            <th class="text-center">Título</th>
                                            <th class="text-center">Autor</th>
                                            <th class="text-center">Contenido</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($posts as $post) : ?>
                                            <tr>
                                                <td class="text-center">
                                                    <input class="form-check-input" type="checkbox" name="post_id[]" value="<?= $post['id'] ?>">
                                                </td>
                                                <td><?= $post['title'] ?></td>
                                                <td><?= $post['author'] ?></td>
                                                <td>
                                                    <div class="" style=""><?= $post['content'] ?></div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of Page Content Container -->
        </div>
    </div>
    <!-- Confirmation Modal -->
    <div class="modal fade" id="confrimModal" data-bs-backdrop="static" aria-labelledby="confrimModal" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable rounded-0">
            <div class="modal-content rounded-0">
                <div class="modal-header rounded-0">
                    <h1 class="modal-title fs-5">Confirmation</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body rounded-0">
                    <div class="container-fluid">
                        <p>Are you sure to delete to following post(s)? This action cannot be undone.</p>
                        <ul id="post_to_delete_list"></ul>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="confirm-deletion" class="btn btn-danger btn-sm rounded-0">Confirm Deletion</button>
                    <button type="button" class="btn btn-secondary btn-sm rounded-0" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Confirmation Modal -->

    <script src="app.js"></script>

</body>

</html>