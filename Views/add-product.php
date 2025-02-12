<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container ">
        <a class="navbar-brand font-weight-bold text-danger" href="#">Product Add</a>

        <div class="d-flex justify-content-center " id="navbarSupportedContent">

            <button class="btn btn-success m-2 my-sm-0" type="submit" form="product_form">Save</button>
            <a href="/" class="btn btn-danger m-2 my-sm-0">Cancel</a>
        </div>
    </div>
</nav>

<div class="container mt-4" id="app">

      <!-- Display success message if any -->
      <!-- <?php if (app()->session->hasFlash('success')): ?>
        <div class="alert alert-success" role="alert">
            <?= app()->session->getFlash('success'); ?>
        </div>
    <?php endif; ?> -->

    <!-- Display validation errors if any -->
    <?php if (app()->session->hasFlash('errors')): ?>
        <?php $errors = app()->session->getFlash('errors'); ?>
        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger" role="alert">
                <ul class="mb-0">
                    <?php foreach ($errors as $field => $errorMessages): ?>
                        <?php foreach ($errorMessages as $error): ?>
                            <li><?= $error; ?></li>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
    <?php endif; ?>


    <div class="row d-flex justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body">
                    <form action="/add-product" method="post" id="product_form">
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">SKU</label>
                            <div class="col-sm-9 mb-2">
                                <input type="text" id='sku' name="sku" placeholder="Enter SKU" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-9 mb-2">
                                <input type="text" id="name" name="name" placeholder="Name" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">Price ($)</label>
                            <div class="col-sm-9 mb-2">
                                <input type="text" id="price" name="price" placeholder="Price" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label name="type" for="productType" class="col-sm-3 col-form-label">Type Switcher</label>
                            <div class=" mb-3 col-sm-9">
                                <select class="form-control form-select" aria-label="Product type" id="productType"
                                    v-model="type" name="type">
                                    <!-- <option selected value="InvalidProduct">Type Switcher</option> -->
                                    <option value="book" id="Book">Book</option>
                                    <option value="dvd" id="DVD">DVD</option>
                                    <option value="furniture" id="Furniture">Furniture</option>
                                </select>
                            </div>
                        </div>

                        <!-- Book Attributes -->

                        <div class="form-group row" v-if="type === 'book'">
                            <small class="form-text">Please, provide weight</small>
                            <label for="size" class="col-sm-3 col-form-label">Weight (KG)</label>
                            <div class="col-sm-9 mb-2">
                                <input class="form-control" type="text" name="weight" id="weight">
                            </div>
                        </div>
                        <!-- Book Attributes -->

                        <!-- DVD Attributes -->
                        <div class="form-group row" v-if="type === 'dvd'">
                            <small class="form-text">Please, provide size</small>

                            <label for="size" class="col-sm-3 col-form-label">Size (MB)</label>
                            <div class="col-sm-9 mb-2">
                                <input class="form-control" type="text" name="size" id="size">
                            </div>
                        </div>
                        <!-- DVD Attributes -->

                        <!-- Furniture Attributes -->
                        <div class="furniture-attributes" v-if="type === 'furniture'">
                            <small class="form-text">Please, provide dimensions</small>

                            <div class="form-group row">
                                <label for="height" class="col-sm-3 col-form-label">Height (CM)</label>
                                <div class="col-sm-9 mb-2">
                                    <input name="height" type="text" class="form-control" id="height">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="width" class="col-sm-3 col-form-label">Width (CM)</label>
                                <div class="col-sm-9 mb-2">
                                    <input name="width" type="text" class="form-control" id="width">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="length" class="col-sm-3 col-form-label">Length (CM)</label>
                                <div class="col-sm-9 mb-2">
                                    <input name="length" type="text" class="form-control" id="length">
                                </div>
                            </div>
                        </div>
                        <!-- Furniture Attributes -->
                </div>


            </div>

        </div>
    </div>
</div>
</div>

</div>

<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
<script>
    const {
        createApp,
        ref
    } = Vue

    createApp({
        setup() {
            const type = ref('InvalidProduct')
            return {
                type
            }
        }
    }).mount('#app')
</script>