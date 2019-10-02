<?php $this->layout('layout', ['title' => 'Show']) ?>

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h2 class="text-center mt-3 mb-4">Show Product</h2>
    </div>
    <div class="col-md-4">
      <img src="<?= '/'.$product['image'] ?>" class="rounded float-left img-thumbnail img-fluid" alt="Image">
    </div>
    <div class="col-md-8 mt-3 mb-2">
      <h5>Title</h5>
      <p><?= $product['title'] ?></p>
      <h5>Description</h5>
      <p><?= $product['description'] ?></p>
      <h5>Attribute</h5>
      <p><?= $attribute ?></p>
      <h5>Value</h5>
      <p><?= $value ?></p>
      <h5>Price</h5>
      <p><?= $product['price'] ?></p>
    </div>
    <div class="col-md-12">
      <a href="/store/1"><b>Go Back</b></a>
    </div>
  </div>
</div>
