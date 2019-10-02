<?php $this->layout('layout', ['title' => 'Create']) ?>

    <div class="container">
      <div class="row">
        <div class="col-md-12 mt-3 mb-2">
          <form action="/add" method="POST" enctype="multipart/form-data">
            <h2 class="mb-4">Create Product</h2>
            <div class="form-group mb-2">
              <h5>Title <span class="text-danger"><?= $_SESSION['title']; unset($_SESSION['title']); ?></span> </h5>
              <input type="text" name="title" id="title" class="form-control">
            </div>
            <div class="form-group mb-2">
              <h5>Description <span class="text-danger"><?= $_SESSION['description']; unset($_SESSION['description']); ?></span> </h5>
              <textarea name="description" id="description" class="form-control"></textarea>
            </div>
            <div class="form-group mb-2">
              <h5>Attribute</h5>
              <select name="attribute" class="custom-select">
                    <?php foreach ($attributes as $attribute) : ?>
                        <?php if (!empty($attribute)) : ?>
                      <option value="<?= $attribute['id'] ?>"><?= $attribute['title'] ?></option>
                        <?php endif ?>
                    <?php endforeach ?>
              </select>
            </div>
            <div class="form-group mb-2">
              <h5>Values</h5>
              <select name="value" class="custom-select">
                    <?php foreach ($values as $value) : ?>
                        <?php if (!empty($value)) : ?>
                      <option value="<?= $value['id'] ?>"><?= $value['title'] ?></option>
                        <?php endif ?>
                    <?php endforeach ?>
              </select>
            </div>
            <div class="form-group mb-2">
              <h5>Price <span class="text-danger"><?= $_SESSION['price']; unset($_SESSION['price']); ?></span> </h5>
              <input type="text" name="price" id="price" class="form-control">
            </div>
            <div class="form-group mb-2">
              <label for="image"><h5>Image file input</h5></label>
              <input type="file" name="image" id="image" class="form-control-file">
            </div>
            <div class="form-group mt-4">
              <button type="submit"  id="add" class="btn btn-success">Add Product</button>
            </div>
            <a href="/store/1"><b>Go Back</b></a>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>