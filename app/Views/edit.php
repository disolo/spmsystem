<?php $this->layout('layout', ['title' => 'Edit']);?>

<div class="container">
    <div class="row">
       <div class="col-md-12 mt-3 mb-2">
          <form action="/update/<?= $product['id'] ?>" method="post" enctype="multipart/form-data">
            <h2 class="mb-4">Edit Product</h2>
            <div class="form-group mb-2">
              <h5>Title</h5>
              <input type="text" name="title" id="title" class="form-control" value="<?= $product['title'] ?>">
            </div>
            <div class="form-group mb-2">
              <h5>Description</h5>
              <textarea name="description" id="description" class="form-control"><?= $product['description'] ?></textarea>
            </div>
            <div class="form-group mb-2">
              <h5>Attribute</h5>
              <select name="attribute" class="custom-select">
                    <?php foreach ($attributes as $attribute) : ?>
                        <?php if (!empty($attribute['title'])) : ?>
                      <option value="<?= $attribute['id'] ?>"><?= $attribute['title'] ?></option>
                        <?php endif ?>
                    <?php endforeach ?>
              </select>
            </div>
            <div class="form-group mb-2">
              <h5>Values</h5>
              <select name="value" class="custom-select">
                    <?php foreach ($values as $value) : ?>
                        <?php if (!empty($attribute['title']) && !empty($value['title'])) : ?>
                      <option value="<?= $value['id'] ?>"><?= $value['title'] ?></option>
                        <?php endif ?>
                    <?php endforeach ?>
              </select>
            </div>
            <div class="form-group mb-2">
              <h5>Price</h5>
              <input type="text" name="price" id="price" class="form-control" value="<?= $product['price'] ?>">
            </div>
            <div class="form-group mb-2">
              <label for="image"><h5>Image file input</h5></label>
              <input type="file" name="image" id="image" class="form-control-file">
            </div>
            <div class="form-group mt-4">
              <button type="submit" id="edit" class="btn btn-warning">Edit Product</button>
            </div>
            <a href="/store/1"><b>Go Back</b></a>
          </form>
       </div>
    </div>
</div>
