<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    
    <!-- Custom CSS -->
    <link href="<?= base_url('css/styles.css'); ?>" rel="stylesheet">

    <title>Todo App</title>
    <style>
        .logo {
            width: 80px;
            height: 90px;
            margin-bottom: -10px; 
        }
        header {
            padding-bottom: 10px; 
        }

    </style>
  </head>
  <body>
    <main class="container">
        <header class="py-2 mb-4 border-bottom">
            <div class="container d-flex align-items-center">
                <img src="<?= base_url('image/logo.png'); ?>" alt="Todo App Logo" class="logo me-3">
            </div>
        </header>
        <div class="container">
            <p class="lead">Kelola tugas Anda dengan lebih efektif menggunakan Todo App. Tambahkan, edit, dan hapus daftar tugas Anda dengan mudah. Jadikan hari Anda lebih produktif dan terorganisir!</p>
            <?php if ($flashMessage = session()->getFlashdata('successMesssage')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <span><?= $flashMessage; ?></span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php endif; ?>

            <?php 
                $errors = session()->get('errorsMessages');
                session()->remove('errorsMessages');
            ?>

            <form class="row" method="POST" action="<?= base_url('home/store/' . ($dataEdit['id'] ?? '')); ?>">
                <?= csrf_field(); ?>
                <div class="col-10">
                    <input name="todoname" class="form-control mb-2 <?= isset($errors['todoname']) ? 'is-invalid' : '' ?>" value="<?= $dataEdit['todoname'] ?? ''; ?>" type="text" placeholder="Nama Agenda">
                    <div class="invalid-feedback"><?= $errors['todoname'] ?? ''; ?></div>
                    <textarea name="description" class="form-control mb-2 <?= isset($errors['description']) ? 'is-invalid' : '' ?>" placeholder="Deskripsi Agenda"><?= $dataEdit['description'] ?? ''; ?></textarea>
                    <div class="invalid-feedback"><?= $errors['description'] ?? ''; ?></div>
                </div>
                
                <div class="col-2">
                    <button class="btn btn-outline-primary" type="submit">
                        <?= !empty($dataEdit) ? "Update Rencana" : "Tambahkan Rencana"; ?>
                    </button>
                </div>
            </form>

            <?php foreach ($data as $chunk): ?>
            <div class="row mt-5">
                <?php foreach ($chunk as $todo): ?>
                <div class="col-3">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title"><?= $todo['todoname']; ?></h5>
                            <p class="card-text"><?= $todo['description']; ?></p>
                            <a href="<?= base_url('home/index/' . $todo['id']); ?>" class="btn btn-outline-info card-link" type="submit">Edit</a>
                            <a onclick="return confirm('Yakin untuk dihapus?');" href="<?= base_url('home/delete/' . $todo['id']); ?>" class="btn btn-outline-danger card-link">Delete</a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endforeach; ?>
        </div>
    </main>

    <!-- Optional JavaScript; choose one of the two! -->
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>
