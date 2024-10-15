<?php require base_path('views/partials/head.php') ?>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand font-weight-bold text-danger " href="/">Product List</a>

            <div class="d-flex justify-content-end " id="navbarSupportedContent">
                <a href="/add-product" class="btn btn-success m-2 my-sm-0" type="submit">Add</a>
                <button name="delete" value="Delete"  class="btn btn-danger m-2 my-sm-0" type="submit" form="delete-form">Mass Delete</button>
            </div>
        </div>
    </nav>

    <div class="container mt-4">

        <form action="/products" method="POST" id="delete-form">
            <input type="hidden" id="" name="_method" value="DELETE" />
            <div class="row justify-content-start">
                <?php foreach ($products as $product): ?>
                    <div class="col-md-3 mb-3">
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="form-check">
                                    <input class="form-check-input delete-checkbox" type="checkbox" name="checkedProducts[]" value="<?= $product['id'] ?>">
                                </div>

                                <!-- <div class="form-group row">
                                    <label for="" class="col-form-label text-center"><?= $product['id'] ?></label>
                                </div> -->

                                <div class="form-group row">
                                    <label for="" class="col-form-label text-center"><?= $product['sku'] ?></label>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-form-label text-center"><?= $product['name'] ?></label>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-form-label text-center"><?= $product['price'] ?>($)</label>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-form-label text-center"><?= $product['value'] ?></label>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </form>

    </div>

    <?php require base_path('views/partials/footer.php') ?>
